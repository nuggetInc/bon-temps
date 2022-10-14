<?php

declare(strict_types=1);

if (isset($_POST["edit"], $_POST["amount"], $_POST["date"], $_POST["time"], $_POST["count"])) {

    ReservationDish::deleteByReservationID($reservation->getID());

    $reservationDishes = array();

    for ($index = 0; $index < (int)$_POST["amount"]; $index++) {
        $dishID = (int)$_POST["dishID$index"];
        $amount = (int)$_POST["amount$index"];

        if (array_key_exists($dishID, $reservationDishes)) {
            $reservationDishes[$dishID] += $amount;
        } else {
            $reservationDishes[$dishID] = $amount;
        }
    }

    foreach ($reservationDishes as $dishID => $amount) {
        if ($dishID !== 0 && $amount !== 0)
            ReservationDish::create($reservation->getID(), $dishID, $amount);
    }

    Reservation::update(
        $reservation->getID(),
        strtotime($_POST["date"] . " " . $_POST["time"]),
        (int)$_POST["count"],
        $reservation->getCustomerID(),
    );

    header("Location: " . ROOT . "/reservations");
    exit;
}

if (isset($_POST["add"], $_POST["amount"], $_POST["date"], $_POST["date"], $_POST["date"])) {

    $_SESSION["amount"] = (int)$_POST["amount"];

    for ($index = 0; $index < $_SESSION["amount"]; $index++) {
        $_SESSION["dishID$index"] = (int)$_POST["dishID$index"];
        $_SESSION["amount$index"] = (int)$_POST["amount$index"];
    }

    $_SESSION["amount"]++;
    $_SESSION["dishID$index"] = 0;
    $_SESSION["amount$index"] = 1;

    $_SESSION["date"] = $_POST["date"];
    $_SESSION["time"] = $_POST["time"];
    $_SESSION["count"] = (int)$_POST["count"];

    header("Location: " . PATH);
    exit;
}

if (isset($_POST["remove"], $_POST["amount"], $_POST["date"], $_POST["date"], $_POST["date"])) {

    $_SESSION["amount"] = (int)$_POST["amount"];
    if ($_SESSION["amount"] > 1) {

        for ($index = 0; $index < $_SESSION["amount"]; $index++) {
            if ($index < (int)$_POST["remove"]) {
                $_SESSION["dishID$index"] = (int)$_POST["dishID$index"];
                $_SESSION["amount$index"] = (int)$_POST["amount$index"];
                echo "test1";
            } elseif ($index > (int)$_POST["remove"]) {
                $_SESSION["dishID" . $index - 1] = (int)$_POST["dishID$index"];
                $_SESSION["amount" . $index - 1] = (int)$_POST["amount$index"];
            }
        }

        $_SESSION["amount"]--;
        unset($_SESSION["dishID" . $index - 1]);
        unset($_SESSION["amount" . $index - 1]);
    } else {
        $_SESSION["dishID0"] = 0;
        $_SESSION["amount0"] = 1;
    }

    $_SESSION["date"] = $_POST["date"];
    $_SESSION["time"] = $_POST["time"];
    $_SESSION["count"] = (int)$_POST["count"];

    header("Location: " . PATH);
    exit;
}

if (!isset($_SESSION["amount"], $_SESSION["date"], $_SESSION["time"], $_SESSION["count"])) {
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
}

$dishes = Dish::all();

?>
<div class="vh-100 d-flex flex-column">
    <header class="bg-light shadow-sm mb-auto">
        <div class="container navbar navbar-expand-md navbar-light px-3">
            <a class="navbar-brand fw-bold" href="<?= ROOT ?>">Bon Temps</a>
            <span class="navbar-text">
                Reservering aanpassen
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
        <form class="row g-5" method="POST">
            <input type="hidden" name="amount" value="<?= $_SESSION["amount"] ?>" />
            <div class="col-lg-4 col-sm-8 text-dark fw-bold">
                <div class="mb-3">
                    <label name="date" class="form-label" for="inputDate">Datum</label>
                    <input type="date" name="date" class="form-control" id="inputDate" value="<?= $_SESSION["date"] ?>" min="<?= date("Y-m-d", strtotime("+1 week")) ?>">
                </div>

                <div class="mb-3">
                    <label name="time" class="form-label" for="inputTime">Tijd</label>
                    <input type="time" name="time" class="form-control" id="inputTime" value="<?= $_SESSION["time"] ?>">
                </div>

                <div class="mb-3">
                    <label name="count" class="form-label" for="inputCount">Aantal personen</label>
                    <input type="number" name="count" class="form-control" id="inputCount" value="<?= $_SESSION["count"] ?>" placeholder="Aantal personen" min="4">
                </div>

                <button type="submit" name="edit" class="btn btn-primary">Aanpassen</button>
            </div>
            <div class="col-lg-8">
                <table class="table table-striped table-hover shadow-sm mt-3">
                    <thead>
                        <tr>
                            <th class="align-middle px-3">#</th>
                            <th class="align-middle px-3">Gerecht</th>
                            <th class="align-middle px-3">Hoeveelheid</th>
                            <th class="text-end"><button type="submit" name="add" title="Nieuw gerecht toevoegen" class="fa-solid fa-square-plus btn btn-lg p-1" formnovalidate></button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($index = 0; $index < $_SESSION["amount"]; $index++) : ?>
                            <tr>
                                <td class="align-middle px-3"><?= $index + 1 ?></td>
                                <td class="px-3">
                                    <select name="dishID<?= $index ?>" class="form-select" required>
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
                                <td class="px-3"><input type="number" name="amount<?= $index ?>" class="form-control" value="<?= $_SESSION["amount$index"]  ?>" min="0" /></td>
                                <td class="text-end"><button type="submit" name="remove" value="<?= $index ?>" title="Gerecht verwijderen" class="fa-solid fa-square-minus btn btn-lg p-1" formnovalidate></button></th>
                            </tr>
                        <?php endfor ?>
                    </tbody>
                </table>
            </div>
        </form>
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