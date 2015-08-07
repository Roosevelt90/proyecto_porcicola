<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <script>alert("Felicidades")</script>
        <?php
        $url = $_SESSION['url'];
        header("location:" . $url);
        ?>
    </body>
</html>
