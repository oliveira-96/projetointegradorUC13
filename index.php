<?php
$m = filter_input(INPUT_GET, 'm', FILTER_DEFAULT);
if (empty($m))
    $m = 'home';
?>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/bootstrep.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" type="text/css" href="./css/slick.css" />
    <title>Ana Rufatto Store</title>
</head>

<body>

    <?php
    include 'navbar.php';
    ?>

    <?php
    include "{$m}.php";
    ?>

    <?php
    include 'footer.php';
    ?>

    <script type="text/javascript" src="./js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="./js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="./js/slick.min.js"></script>
    <script type="text/javascript" src="./js/main.js"></script>
</body>

</html>