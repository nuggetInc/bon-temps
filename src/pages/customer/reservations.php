<?php

declare(strict_types=1);

if ($id = $route[2] ?? null) {
    $reservation = Reservation::get((int)$id);

    if (!isset($reservation) || $reservation->getCustomerID() !== $customer->getID())
        unset($reservation);
}

switch ($route[1] ?? null) {
    case "create":
        require("reservations/create.php");
        break;
    case "view":
        if (isset($reservation))
            require("reservations/view.php");
        else
            require("reservations/overview.php");

        break;
    case "edit":
    case "delete":
        if (isset($reservation) && $reservation->getDatetime() > strtotime('+1 week'))
            require("reservations/{$route[1]}.php");
        else
            require("reservations/overview.php");

        break;
    case "overview":
    default:
        require("reservations/overview.php");
        break;
}
