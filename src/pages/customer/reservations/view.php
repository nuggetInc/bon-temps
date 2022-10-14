<?php

declare(strict_types=1);

$reservationDishes = ReservationDish::getByReservationID($reservation->getID());

$_SESSION["amount"] = count($reservationDishes);

$index = 0;
foreach ($reservationDishes as $reservationDish) {
    $dish = $reservationDish->getDish();
    $_SESSION["dishID$index"] = $dish->getID();
    $_SESSION["amount$index"] = $reservationDish->getAmount();

    $index++;
}

$_SESSION["date"] = date("Y-m-d", $reservation->getDatetime());
$_SESSION["time"] = date("H:i", $reservation->getDatetime());
$_SESSION["count"] = $reservation->getCount();

$dishes = Dish::all();

?>
<div class="vh-100 d-flex flex-column">
    <header class="bg-light shadow-sm mb-auto">
        <div class="container navbar navbar-expand-md navbar-light px-3">
            <a class="navbar-brand fw-bold" href="<?= ROOT ?>">Bon Temps</a>
            <span class="navbar-text">
                Reservering bekijken
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/account">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/logout">Uitloggen</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container py-5 mb-auto">
        <h1 class="text-center mb-3">Aanpassen</h1>
        <div class="row g-5">
            <div class="col-lg-4 col-sm-8 text-dark fw-bold">
                <div class="mb-3">
                    <label name="date" class="form-label" for="inputDate">Datum</label>
                    <input type="date" name="date" class="form-control" id="inputDate" value="<?= $_SESSION["date"] ?>" disabled>
                </div>

                <div class="mb-3">
                    <label name="time" class="form-label" for="inputTime">Tijd</label>
                    <input type="time" name="time" class="form-control" id="inputTime" value="<?= $_SESSION["time"] ?>" disabled>
                </div>

                <div class="mb-3">
                    <label name="count" class="form-label" for="inputCount">Aantal personen</label>
                    <input type="number" name="count" class="form-control" id="inputCount" value="<?= $_SESSION["count"] ?>" disabled>
                </div>
            </div>
            <div class="col-lg-8">
                <table class="table table-striped table-hover shadow-sm mt-3">
                    <thead>
                        <tr>
                            <th class="align-middle px-3">#</th>
                            <th class="align-middle px-3">Gerecht</th>
                            <th class="align-middle px-3">Hoeveelheid</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($index = 0; $index < $_SESSION["amount"]; $index++) : ?>
                            <tr>
                                <td class="align-middle px-3"><?= $index + 1 ?></td>
                                <td class="px-3">
                                    <select name="dishID<?= $index ?>" class="form-select" disabled>
                                        <?php

                                        $dishID = $_SESSION["dishID$index"];

                                        ?>
                                        <?php if ($dishID === 0) : ?>
                                            <option value="" disabled selected>Kies een gerecht</option>
                                        <?php else : ?>
                                            <option value="<?= $dishID ?>" selected><?= $dishes[$_SESSION["dishID$index"]]->getName() ?></option>
                                        <?php endif ?>
                                        <?php foreach ($dishes as $dish) : ?>
                                            <?php if ($dish->getID() != $dishID) : ?>
                                                <option value="<?= $dish->getID() ?>"><?= $dish->getName() ?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                </td>
                                <td class="px-3"><input type="number" name="amount<?= $index ?>" class="form-control" value="<?= $_SESSION["amount$index"]  ?>" disabled /></td>
                            </tr>
                        <?php endfor ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<?php

for ($index = 0; $index < $_SESSION["amount"]; $index++) {
    unset($_SESSION["dishID$index"]);
    unset($_SESSION["amount$index"]);
}

unset($_SESSION["amount"]);
unset($_SESSION["date"]);
unset($_SESSION["time"]);
unset($_SESSION["count"]);

?>