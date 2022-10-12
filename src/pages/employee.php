<?php

declare(strict_types=1);

switch ($route[0] ?? null) {
    default:
        require("main.php");
        break;
}
