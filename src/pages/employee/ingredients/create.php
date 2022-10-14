<?php

declare(strict_types=1);

if (isset($_POST["create"], $_POST["name"], $_POST["amount"], $_POST["unit"], $_POST["price"])) {

    Ingredient::create(
        $_POST["name"],
        (float)$_POST["amount"],
        $_POST["unit"],
        (float)$_POST["price"]
    );

    header("Location: " . ROOT . "/ingredients");
    exit;
}

?>
<div class="vh-100 d-flex flex-column">
    <header class="bg-light shadow-sm mb-auto">
        <div class="container navbar navbar-expand-md navbar-light px-3">
            <a class="navbar-brand fw-bold" href="<?= ROOT ?>">Bon Temps</a>
            <span class="navbar-text">
                Ingredient aanmaken
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/menus">Menu's</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/dishes">Gerechten</a>
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
                <h1 class="mb-3">Aanmaken</h1>

                <div class="mb-3">
                    <label name="name" class="form-label" for="inputName">Naam</label>
                    <input type="text" name="name" class="form-control" id="inputName" required>
                </div>

                <div class="row align-items-center g-3 mb-3">
                    <div class="col-8">
                        <label name="amount" class="form-label" for="inputAmount">Hoeveelheid</label>
                        <input type="number" step="0.01" name="amount" class="form-control" id="inputAmount" required>
                    </div>

                    <div class="col-4">
                        <label name="unit" class="form-label" for="inputUnit">Eenheid</label>
                        <input type="text" name="unit" class="form-control" id="inputUnit">
                    </div>
                </div>

                <div class="mb-3">
                    <label name="price" class="form-label" for="inputPrice">Prijs</label>
                    <input type="number" step="0.01" name="price" class="form-control" id="inputPrice" required>
                </div>

                <button type="submit" name="create" class="btn btn-primary">Aanmaken</button>
            </form>
        </div>
    </main>
</div>
<?php

unset($_SESSION["name"]);
unset($_SESSION["amount"]);
unset($_SESSION["unit"]);
unset($_SESSION["price"]);

?>