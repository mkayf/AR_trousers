<?php

class RateLimiter {
    private $time_window;   // Time window in seconds
    private $request_limit; // Max requests allowed in the time window

    public function __construct($time_window = 60, $request_limit = 5) {
        $this->time_window = $time_window;
        $this->request_limit = $request_limit;
    }

    // Function to check if the rate limit is exceeded
    public function checkRateLimit() {
        // session_start();

        // If rate limit data isn't set in the session, initialize it
        if (!isset($_SESSION['rate_limiter'])) {
            $_SESSION['rate_limiter'] = [
                'requests' => 0,
                'start_time' => time()
            ];
        }

        $current_time = time();

        // Reset counter if the time window has passed
        if ($current_time - $_SESSION['rate_limiter']['start_time'] > $this->time_window) {
            $_SESSION['rate_limiter']['requests'] = 0;  // Reset request count
            $_SESSION['rate_limiter']['start_time'] = $current_time;  // Reset start time
        }

        // If the user has exceeded the request limit, deny the request
        if ($_SESSION['rate_limiter']['requests'] >= $this->request_limit) {
            return false;
        }

        // Increment the request counter
        $_SESSION['rate_limiter']['requests']++;

        return true; // Rate limit check passed
    }
}


?>