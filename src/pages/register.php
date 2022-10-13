<?php

declare(strict_types=1);

if (isset($_POST["register"])) {
    $user = User::create(
        $_POST["username"],
        $_POST["password"],
        UserType::Customer
    );

    $customer = Customer::create(
        $_POST["email"],
        $_POST["phonenumber"],
        $_POST["postalCode"],
        $_POST["houseNumber"],
        $user->getID()
    );

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
                        <a class="nav-link" href="<?= ROOT ?>/login">Inloggen</a>
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
                <h1 class="mb-3">Registreren</h1>

                <div class="mb-3">
                    <label name="username" class="form-label" for="inputUsername">Gebruikersnaam</label>
                    <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Gebruikersnaam" required>
                </div>

                <div class="mb-3">
                    <label name="email" class="form-label" for="inputEmail">Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" required>
                </div>

                <div class="mb-3">
                    <label name="phonenumber" class="form-label" for="inputPhonenumber">Telefoonnummer</label>
                    <input type="tel" name="phonenumber" class="form-control" id="inputPhonenumber" placeholder="Telefoonnummer" required>
                </div>

                <div class="mb-3">
                    <label name="postalCode" class="form-label" for="inputPostalCode">Postcode</label>
                    <input type="text" name="postalCode" class="form-control" id="inputPostalCode" placeholder="Postcode" required>
                </div>

                <div class="mb-3">
                    <label name="houseNumber" class="form-label" for="inputHouseNumber">Huisnummer</label>
                    <input type="text" name="houseNumber" class="form-control" id="inputHouseNumber" placeholder="Huisnummer" required>
                </div>

                <div class="mb-3">
                    <label name="password" class="form-label" for="inputPassword">Wachtwoord</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Wachtwoord" required>
                </div>

                <div class="mb-3">
                    <label name="rePassword" class="form-label" for="inputRePassword">Herhaal wachtwoord</label>
                    <input type="password" name="rePassword" class="form-control" id="inputRePassword" placeholder="Herhaal wachtwoord" required>
                </div>

                <button type="submit" name="register" class="btn btn-primary">Registreer</button>
            </form>
        </div>
    </main>
</div>