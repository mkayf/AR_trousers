<?php 
    include_once __DIR__ . '/../config/App.php';

    // $arr = ['image1', 'image2'];

    // $img1 = $arr[0] ?? 'no image';
    // $img2 = $arr[1] ?? 'no image';
    // $img3 = $arr[2] ?? 'no image';

    $arr = ['name' => 'kaif', 'age' => '21'];

    echo "$arr[name], $arr[age]";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test file</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="images[]" multiple>
        <input type="submit" value="Submit">
    </form>

</body>
</html>