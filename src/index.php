<?php

declare(strict_types=1);

require_once "classes/Customer.php";
require_once "classes/Reservation.php";
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/style.css">
    <title>Bon Temps</title>
</head>

<body>
    <?php

    // Get the route and split on "/"
    $route = explode("/", trim(ROUTE, "/"));

    if (isset($_SESSION["loginID"])) {
        $user = User::get($_SESSION["loginID"]);

        switch ($route[0] ?? null) {
            case "login":
                require("pages/login.php");
                break;
            case "logout":
                require("pages/logout.php");
                break;
            case "register":
                require("pages/register.php");
                break;
            case "main":
                require("pages/main.php");
                break;
        }

        switch ($user->getType()) {
            case UserType::Customer:
                require("pages/customer.php");
                break;
            case UserType::Employee:
                require("pages/employee.php");
                break;
        }
    } else {
        switch ($route[0] ?? null) {
            case "login":
                require("pages/login.php");
                break;
            case "logout":
                require("pages/logout.php");
                break;
            case "register":
                require("pages/register.php");
                break;
            case "main":
            default:
                require("pages/main.php");
                break;
        }
    }

    ?>
</body>

</html>