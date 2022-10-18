<?php

declare(strict_types=1);

switch ($route[0] ?? null) {
    case "menu":
        require("menu.php");
        break;
    case "menuadd":
        require("menuadd.php");
        break;
    case "ingredients":
        require("employee/ingredients.php");
        break;
    default:
        require("main.php");
        break;
}
