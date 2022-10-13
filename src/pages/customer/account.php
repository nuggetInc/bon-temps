<?php

declare(strict_types=1);

switch ($route[1] ?? null) {
    case "edit":
    default:
        require("account/edit.php");
        break;
}
