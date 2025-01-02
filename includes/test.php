<?php

include __DIR__ . '/../config/App.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $radio = $_POST['radio'];
    echo $radio;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test file</title>
</head>
<body>

<form method="POST">
    <label  style="padding: 4px; border: 2px solid red;">
        <input type="radio" name="radio" id="radio1" value="radio-1">
        <span>'Hello</span>
    </label>
    <label  style="padding: 4px; border: 2px solid red;">
        <input type="radio" name="radio" id="radio2" value="radio-2">
        <span>'Hello</span>
    </label>
    <input type="submit" value="check">
</form>


</body>
</html>