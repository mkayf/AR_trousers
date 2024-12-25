<?php

include __DIR__ . '/../config/App.php';

function checkingReturn(){
    return [1,2,3,4,5];
    for($i = 0; $i < 10; $i++){
        echo 'Hello world';
    }

}

print_r(checkingReturn());

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