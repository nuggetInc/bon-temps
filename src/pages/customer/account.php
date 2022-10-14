<?php

declare(strict_types=1);

if (isset($_POST["edit"])) {
    if ($_POST["username"] !== $user->getUsername()) {
        $user = User::updateUsername(
            $user->getID(),
            $_POST["username"]
        );
    }

    if (!isset($user)) {
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["phonenumber"] = $_POST["phonenumber"];
        $_SESSION["postalCode"] = $_POST["postalCode"];
        $_SESSION["houseNumber"] = $_POST["houseNumber"];

        $_SESSION["username-error"] = "Gebruikersnaam is niet beschikbaar";

        header("Location: " . PATH);
        exit;
    }

    $customer = Customer::update(
        $customer->getID(),
        $_POST["email"],
        $_POST["phonenumber"],
        $_POST["postalCode"],
        $_POST["houseNumber"],
        $user->getID()
    );

    $_SESSION["loginID"] = $user->getID();

    header("Location: " . ROOT . "/reservations");
    exit;
}

if (isset($_POST["passwordEdit"])) {
    if (strlen($_POST["password"]) < 4) {
        $_SESSION["password-error"] = "Wachtwoord moet minstens 4 karakters lang zijn";

        header("Location: " . PATH);
        exit;
    }

    if ($_POST["password"] !== $_POST["rePassword"]) {
        $_SESSION["password-error"] = "Wachtwoorden komen niet overheen";

        header("Location: " . PATH);
        exit;
    }

    $user = User::updatePassword(
        $user->getID(),
        $_POST["password"]
    );

    header("Location: " . ROOT . "/reservations");
    exit;
}

$_SESSION["username"] = $_SESSION["username"] ?? $user->getUsername();
$_SESSION["email"] = $_SESSION["email"] ?? $customer->getEmail();
$_SESSION["phonenumber"] = $_SESSION["phonenumber"] ?? $customer->getPhonenumber();
$_SESSION["postalCode"] = $_SESSION["postalCode"] ?? $customer->getPostalCode();
$_SESSION["houseNumber"] = $_SESSION["houseNumber"] ?? $customer->getHouseNumber();

?>
<div class="vh-100 d-flex flex-column">
    <header class="bg-light shadow-sm mb-auto">
        <div class="container navbar navbar-expand-md navbar-light px-3">
            <a class="navbar-brand fw-bold" href="<?= ROOT ?>">Bon Temps</a>
            <span class="navbar-text">
                Account
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/reservations">Reserveringen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/logout">Uitloggen</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container mb-auto">
        <div class="row justify-content-around gy-5">
            <form class="col-lg-4 text-dark fw-bold" method="POST">
                <h1 class="mb-3">Account aanpassen</h1>

                <div class="mb-3">
                    <label name="username" class="form-label" for="inputUsername">Gebruikersnaam</label>
                    <?php if (isset($_SESSION["username-error"])) : ?>
                        <input type="text" name="username" class="form-control is-invalid" id="inputUsername" placeholder="Gebruikersnaam" value="<?= htmlspecialchars($_SESSION["username"]) ?>" required />
                        <div class="invalid-feedback"><?= $_SESSION["username-error"] ?></div>
                    <?php else : ?>
                        <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Gebruikersnaam" value="<?= htmlspecialchars($_SESSION["username"]) ?>" required />
                    <?php endif ?>
                </div>

                <div class="mb-3">
                    <label name="email" class="form-label" for="inputEmail">Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="<?= htmlspecialchars($_SESSION["email"]) ?>" required>
                </div>

                <div class="mb-3">
                    <label name="phonenumber" class="form-label" for="inputPhonenumber">Telefoonnummer</label>
                    <input type="tel" name="phonenumber" class="form-control" id="inputPhonenumber" placeholder="Telefoonnummer" value="<?= htmlspecialchars($_SESSION["phonenumber"]) ?>" required>
                </div>

                <div class="mb-3">
                    <label name="postalCode" class="form-label" for="inputPostalCode">Postcode</label>
                    <input type="text" name="postalCode" class="form-control" id="inputPostalCode" placeholder="Postcode" value="<?= htmlspecialchars($_SESSION["postalCode"]) ?>" required>
                </div>

                <div class="mb-3">
                    <label name="houseNumber" class="form-label" for="inputHouseNumber">Huisnummer</label>
                    <input type="text" name="houseNumber" class="form-control" id="inputHouseNumber" placeholder="Huisnummer" value="<?= htmlspecialchars($_SESSION["houseNumber"]) ?>" required>
                </div>

                <button type="submit" name="edit" class="btn btn-primary">aanpassen</button>
            </form>

            <form class="col-lg-4 text-dark fw-bold" method="POST">
                <h1 class="mb-3">Wachtwoord aanpassen</h1>

                <div class="mb-3">
                    <label name="password" class="form-label" for="inputPassword">Wachtwoord</label>
                    <?php if (isset($_SESSION["password-error"])) : ?>
                        <input type="password" name="password" class="form-control is-invalid" id="inputPassword" placeholder="Wachtwoord" required>
                        <div class="invalid-feedback"><?= $_SESSION["password-error"] ?></div>
                    <?php else : ?>
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Wachtwoord" required>
                    <?php endif ?>
                </div>

                <div class="mb-3">
                    <label name="rePassword" class="form-label" for="inputRePassword">Herhaal wachtwoord</label>
                    <?php if (isset($_SESSION["password-error"])) : ?>
                        <input type="password" name="rePassword" class="form-control is-invalid" id="inputPassword" placeholder="Herhaal wachtwoord" required>
                    <?php else : ?>
                        <input type="password" name="rePassword" class="form-control" id="inputRePassword" placeholder="Herhaal wachtwoord" required>
                    <?php endif ?>
                </div>

                <button type="submit" name="passwordEdit" class="btn btn-primary">aanpassen</button>
            </form>
        </div>
    </main>
</div>
<?php

unset($_SESSION["username"]);
unset($_SESSION["email"]);
unset($_SESSION["phonenumber"]);
unset($_SESSION["postalCode"]);
unset($_SESSION["houseNumber"]);

unset($_SESSION["username-error"]);
unset($_SESSION["password-error"]);

?>