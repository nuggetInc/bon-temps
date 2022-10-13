<?php

declare(strict_types=1);

$reservations = Reservation::getByCustomerID($customer->getID());

?>
<div class="vh-100 d-flex flex-column">
    <header class="bg-light shadow-sm mb-auto">
        <div class="container navbar navbar-expand-md navbar-light px-3">
            <a class="navbar-brand fw-bold" href="<?= ROOT ?>">Bon Temps</a>
            <span class="navbar-text">
                Reserveringen
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
    <main class="container mb-auto">
        <table class="table table-striped table-hover shadow-sm">
            <thead>
                <tr>
                    <th class="align-middle px-3">#</th>
                    <th class="align-middle px-3">Datum</th>
                    <th class="align-middle px-3">Tijd</th>
                    <th class="align-middle px-3">Aantal</th>
                    <th class="text-end"><a title="Nieuwe reservering aanmaken" href="<?= ROOT . "/reservations/create" ?>" class=" fa-solid fa-square-plus btn btn-lg p-1"></a></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $index = 0;

                ?>
                <?php foreach ($reservations as $reservation) : ?>
                    <tr>
                        <td class="align-middle px-3"><?= ++$index ?></td>
                        <td class="align-middle px-3"><?= date("d-m-Y", $reservation->getDatetime()) ?></td>
                        <td class="align-middle px-3"><?= date("H:i", $reservation->getDatetime()) ?></td>
                        <td class="align-middle px-3"><?= $reservation->getCount() ?></td>
                        <td class="text-end">
                            <a title="Reservering bekijken" href="<?= ROOT . "/reservations/view/" . $reservation->getID() ?>" class="fa-solid fa-square-arrow-up-right btn btn-lg p-1"></a>
                            <?php if ($reservation->getDatetime() > strtotime('+1 week')) : ?>
                                <a title="Reservering bewerken" href="<?= ROOT . "/reservations/edit/" . $reservation->getID() ?>" class="fa-solid fa-square-pen btn btn-lg p-1"></a>
                                <a title="Reservering verwijderen" href="<?= ROOT . "/reservations/delete/" . $reservation->getID() ?>" class="fa-solid fa-square-minus btn btn-lg p-1"></a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </main>
</div>