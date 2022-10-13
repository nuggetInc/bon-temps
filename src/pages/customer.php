<?php

declare(strict_types=1);

$customer = Customer::getByUserID($_SESSION["loginID"]);

switch ($route[0] ?? null) {
    case "reservations":
        require("customer/reservations.php");
        break;
    default:
        require("main.php");
        break;
}
