<?php
session_start();

// Configuration
$max_requests = 5; // Number of allowed requests
$time_window = 60; // Time window in seconds (e.g., 60 seconds)

// Get the current timestamp
$current_time = time();

// Initialize rate limiter session variables
if (!isset($_SESSION['rate_limiter'])) {
    $_SESSION['rate_limiter'] = [
        'requests' => 0,
        'start_time' => $current_time
    ];
}

// Check time window
if ($current_time - $_SESSION['rate_limiter']['start_time'] > $time_window) {
    // Reset counter and timestamp if time window has passed
    $_SESSION['rate_limiter']['requests'] = 0;
    $_SESSION['rate_limiter']['start_time'] = $current_time;
}

// Increment the request counter
$_SESSION['rate_limiter']['requests']++;

// Check if request count exceeds the limit
if ($_SESSION['rate_limiter']['requests'] > $max_requests) {
    // Block the request
    http_response_code(429); // Too Many Requests
    echo "Rate limit exceeded. Please try again later.";
    exit;
}

// Allow the request (normal execution)
echo "Request successful. You are within the limit.";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test file</title>
</head>
<body>

</body>
</html>
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test file</title>
</head>
<body>

</body>
</html>