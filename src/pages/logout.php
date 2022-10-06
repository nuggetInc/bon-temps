<?php

declare(strict_types=1);

unset($_SESSION["loginID"]);

header("Location: " . ROOT);
exit;
