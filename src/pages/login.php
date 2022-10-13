<?php

declare(strict_types=1);

if (isset($_POST["login"], $_POST["username"], $_POST["password"])) {
    $user = User::login($_POST["username"], $_POST["password"]);

    if (!isset($user)) {
        header("Location: " . PATH);
        exit;
    }

    $_SESSION["loginID"] = $user->getID();

    header("Location: " . ROOT . "/reservations");
    exit;
}

?>
<div class="vh-100 d-flex flex-column">
    <header class="bg-light shadow-sm mb-auto">
        <div class="container navbar navbar-expand-md navbar-light px-3">
            <a class="navbar-brand fw-bold" href="<?= ROOT ?>">Bon Temps</a>
            <span class="navbar-text">
                Inloggen
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/register">Registreren</a>
                    </li>
                    <?php if (isset($_SESSION["loginID"])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT ?>/reservations">Reserveringen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT ?>/account">Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT ?>/logout">Uitloggen</a>
                        </li>
                    <?php endif ?>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container mb-auto">
        <div class="row justify-content-around gy-5">
            <form class="col-lg-4 text-dark fw-bold" method="POST">
                <h1 class="mb-3">Inloggen</h1>

                <div class="mb-3">
                    <label name="username" class="form-label" for="inputUsername">Gebruikersnaam</label>
                    <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Gebruikersnaam" required>
                </div>

                <div class="mb-3">
                    <label name="password" class="form-label" for="inputPassword">Wachtwoord</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Wachtwoord" required>
                </div>

                <button type="submit" name="login" class="btn btn-primary">Log in</button>
            </form>
        </div>
    </main>
</div>