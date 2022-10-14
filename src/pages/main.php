<?php

declare(strict_types=1);

if (isset($_POST["login"], $_POST["username"], $_POST["password"])) {
    $user = User::login($_POST["username"], $_POST["password"]);

    if (!isset($user)) {
        $_SESSION["username"] = $_POST["username"];

        $_SESSION["error"] = "Gebruikersnaam en wachtwoord komen niet overeen";

        header("Location: " . PATH);
        exit;
    }

    $_SESSION["loginID"] = $user->getID();

    header("Location: " . ROOT . "/reservations");
    exit;
}

$_SESSION["username"] = $_SESSION["username"] ?? "";

?>
<div class="min-vh-100 gradient d-flex flex-column">
    <header class="container navbar navbar-expand-md navbar-dark justify-content-between mb-auto px-3">
        <a class="navbar-brand fw-bold" href="<?= $_SERVER["REDIRECT_ROOT"] ?>">Bon Temps</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <nav class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <?php if (isset($user) && $user->getType() === UserType::Customer) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/reservations">Reserveringen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/account">Account</a>
                    </li>
                <?php endif ?>
                <?php if (isset($user)) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/logout">Uitloggen</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $_SERVER["REDIRECT_ROOT"] ?>/login">Inloggen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $_SERVER["REDIRECT_ROOT"] ?>/register">Registreren</a>
                    </li>
                <?php endif ?>
            </ul>
        </nav>
    </header>
    <main class="container pb-5 mb-auto">
        <div class="row h-100 justify-content-around align-content-center align-items-center gy-5">
            <form class="col-lg-4 text-light fw-bold" method="POST">
                <h1 class="mb-3">Inloggen</h1>

                <div class="mb-4 position-relative">
                    <label name="username" class="form-label" for="inputUsername">Gebruikersnaam</label>
                    <?php if (isset($_SESSION["error"])) : ?>
                        <input type="text" name="username" class="form-control is-invalid" id="inputUsername" placeholder="Gebruikersnaam" value="<?= htmlspecialchars($_SESSION["username"]) ?>" required />
                        <div class="invalid-tooltip"><?= $_SESSION["error"] ?></div>
                    <?php else : ?>
                        <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Gebruikersnaam" value="<?= htmlspecialchars($_SESSION["username"]) ?>" required />
                    <?php endif ?>
                </div>

                <div class="mb-4">
                    <label name="password" class="form-label" for="inputPassword">Wachtwoord</label>
                    <?php if (isset($_SESSION["error"])) : ?>
                        <input type="password" name="password" class="form-control is-invalid" id="inputPassword" placeholder="Wachtwoord" required>
                    <?php else : ?>
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Wachtwoord" required>
                    <?php endif ?>
                </div>

                <button type="submit" name="login" class="btn btn-light">Log in</button>
            </form>
            <div class="col-lg-4 text-light">
                <h1 class="mb-3">Bon Temps</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam similique tempore tempora at, nesciunt eaque?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, dolorem officia expedita modi dolores rerum.</p>
            </div>
        </div>
    </main>
</div>
<div class="container mainpage-content p-5 ">
    <h1>Lorem ipsum</h1>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Beatae explicabo officiis iusto, eaque dignissimos voluptatibus odio ut accusamus blanditiis aut ea itaque vero? Totam, sint exercitationem? Sed quasi animi dolorem!</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit totam possimus velit? Mollitia, architecto ad aliquam repudiandae facere harum consequatur distinctio suscipit officia exercitationem hic voluptas aut et cupiditate libero?</p>
</div>
<?php

unset($_SESSION["username"]);

unset($_SESSION["error"]);

?>