<?php

declare(strict_types=1);

if ($id = $route[1] ?? null) {
    $ingredient = Ingredient::get((int)$id);
}

switch ($route[1] ?? null) {
    case "create":
        if (!isset($ingredient)) {
            require("ingredients/create.php");
            break;
        }
    case "overview":
    default:
        require("ingredients/overview.php");
        break;
}
