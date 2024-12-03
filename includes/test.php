
<?php

$auth_token = bin2hex(random_bytes(16));
$hashed_token = hash('SHA256', $auth_token);
$verify_token = hash('SHA256', $auth_token);

if(hash_equals($hashed_token, $verify_token)){
    echo 'token verified';
} else{
    echo 'token not verified';
}

?>