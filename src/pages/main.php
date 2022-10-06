<?php

declare(strict_types=1);

if (isset($_POST["login"], $_POST["username"], $_POST["password"])) {
    $user = User::login($_POST["username"], $_POST["password"]);

    if (!isset($user)) {
        header("Location: .");
        exit;
    }

    $_SESSION["loginID"] = $user->getID();

    header("Location: " . ROOT);
    exit;
}

?>
<div class="min-vh-100 gradient d-flex flex-column">
    <header class="container navbar navbar-expand-md navbar-dark justify-content-between mb-auto px-3">
        <a class="navbar-brand fw-bold" href="<?= $_SERVER["REDIRECT_ROOT"] ?>">Bon Temps</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <nav class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $_SERVER["REDIRECT_ROOT"] ?>/login">Inloggen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $_SERVER["REDIRECT_ROOT"] ?>/register">Registreren</a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="container pb-5 mb-auto">
        <div class="row h-100 justify-content-around align-content-center align-items-center gy-5">
            <form class="col-lg-4 text-light fw-bold" method="POST">
                <h1 class="mb-3">Inloggen</h1>

                <div class="mb-3">
                    <label name="username" class="form-label" for="inputEmail">Gebruikersnaam</label>
                    <input type="text" name="username" class="form-control" id="inputEmail" placeholder="Gebruikersnaam">
                </div>

                <div class="mb-3">
                    <label name="password" class="form-label" for="inputPassword">Wachtwoord</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Wachtwoord">
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