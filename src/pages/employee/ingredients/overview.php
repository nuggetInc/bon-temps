<?php

declare(strict_types=1);

$ingredients = Ingredient::all();

if (isset($_POST["edit"], $_POST["name"], $_POST["amount"], $_POST["unit"], $_POST["price"])) {

    Ingredient::update(
        $ingredient->getID(),
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
                Ingredienten
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
        <div class="row justify-content-around align-items-center g-5">
            <?php if (isset($ingredient)) : ?>
                <div class="col-lg-8">
                <?php endif ?>
                <table class="table table-striped table-hover shadow-sm">
                    <thead>
                        <tr>
                            <th class="align-middle px-3">#</th>
                            <th class="align-middle px-3">Ingredient</th>
                            <th class="align-middle px-3">Hoeveelheid</th>
                            <th class="align-middle px-3">Prijs</th>
                            <th class="text-end"><a title="Nieuw ingredient aanmaken" href="<?= ROOT . "/ingredients/create" ?>" class="fa-solid fa-square-plus btn btn-lg p-1"></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $index = 0;

                        ?>
                        <?php foreach ($ingredients as $row) : ?>
                            <tr>
                                <td class="align-middle px-3"><?= ++$index ?></td>
                                <td class="align-middle px-3"><?= $row->getName() ?></td>
                                <td class="align-middle px-3"><?= $row->getAmount() . $row->getUnit() ?></td>
                                <td class="align-middle px-3">€<?= $row->getPrice() ?></td>
                                <td class="text-end">
                                    <a title="Reservering bewerken" href="<?= ROOT . "/ingredients/" . $row->getID() ?>" class="fa-solid fa-square-pen btn btn-lg p-1"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <?php if (isset($ingredient)) : ?>
                </div>
                <form class="col-lg-4 col-sm-8 text-dark fw-bold" method="POST">
                    <h1 class="mb-3">Aanpassen</h1>

                    <div class="mb-3">
                        <label name="name" class="form-label" for="inputName">Naam</label>
                        <input type="text" name="name" class="form-control" id="inputName" value="<?= $ingredient->getName() ?>" required>
                    </div>

                    <div class="row align-items-center g-3 mb-3">
                        <div class="col-8">
                            <label name="amount" class="form-label" for="inputAmount">Hoeveelheid</label>
                            <input type="number" step="0.01" name="amount" class="form-control" id="inputAmount" value="<?= $ingredient->getAmount() ?>" required>
                        </div>

                        <div class="col-4">
                            <label name="unit" class="form-label" for="inputUnit">Eenheid</label>
                            <input type="text" name="unit" class="form-control" id="inputUnit" value="<?= $ingredient->getUnit() ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label name="price" class="form-label" for="inputPrice">Prijs</label>
                        <input type="number" step="0.01" name="price" class="form-control" id="inputPrice" value="<?= $ingredient->getPrice() ?>" required>
                    </div>

                    <button type="submit" name="edit" class="btn btn-primary">Aanpassen</button>
                </form>
            <?php endif ?>
        </div>
    </main>
</div>