<?php

declare(strict_types=1);

session_start();

require_once "classes/User.php";

function getPDO(): PDO
{
    static $pdo = new PDO("mysql:host=localhost;dbname=advanced_login", "root", "");

    return $pdo;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <title>Bon Temps</title>
</head>

<body>
    <?php

    // Get the route and split on "/"
    $route = explode("/", trim($_SERVER["REDIRECT_ROUTE"], "/"));

    switch ($route[0] ?? null) {
        case "login":
            require("pages/login.php");
            break;
        case "register":
            require("pages/register.php");
            break;
        case "home":
            require("pages/home.php");
            break;
        case "main":
            require("pages/main.php");
            break;
        default:
            if (isset($_SESSION["userID"]))
                require("pages/home.php");
            else
                require("pages/main.php");
            break;
    }

    ?>
</body>

</html>