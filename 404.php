<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page not found</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon-16x16.png">
    <link rel="manifest" href="./config/site.webmanifest">
    <style>
        body{
            height: 100vh;
            display: flex;
        }
        h1{
            font-size: 6rem;
            color: var(--primary-color);
            font-family: 'proxima-bold';
        }
        h2{
            font-family: 'proxima-semibold';
            font-size: 3rem;
        }
        .container .anchor{
            text-decoration: none;
            color: var(--background-color);
            background-color: var(--primary-color);
            font-family: 'proxima-regular';
            padding: 12px 16px;
        }

    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center flex-column">
        <h1>404</h1>
        <h2>Page not found</h2>
        <a href="index.php" class="anchor">Go to home page</a>
    </div>
</body>
</html>