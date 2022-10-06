<?php

declare(strict_types=1);

require_once "classes/User.php";

session_start();

define("ROOT", $_SERVER["REDIRECT_ROOT"]);
define("ROUTE", $_SERVER["REDIRECT_ROUTE"]);

function getPDO(): PDO
{
    static $pdo = new PDO("mysql:host=localhost;dbname=bon_temps", "root", "");

    return $pdo;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <title>Bon Temps</title>
</head>

<body>
    <?php

    // Get the route and split on "/"
    $route = explode("/", trim(ROUTE, "/"));

    switch ($route[0] ?? null) {
        case "login":
            require("pages/login.php");
            break;
        case "register":
            require("pages/register.php");
            break;
        case "logout":
            require("pages/logout.php");
            break;
        case "home":
            require("pages/home.php");
            break;
        case "main":
            require("pages/main.php");
            break;
        default:
            if (isset($_SESSION["loginID"]))
                require("pages/home.php");
            else
                require("pages/main.php");
            break;
    }

    ?>
</body>

</html>