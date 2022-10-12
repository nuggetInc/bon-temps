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
                <tr class="row flex-nowrap">
                    <th class="col-1">#</th>
                    <th class="col-4">Datum</th>
                    <th class="col-4">Tijd</th>
                    <th class="col-2">Aantal</th>
                    <th class="col-1 text-end"><i class="fa-solid fa-square-plus fa-xl"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php

                $index = 0;

                ?>
                <?php foreach ($reservations as $reservation) : ?>
                    <tr class="row flex-nowrap">
                        <td class="col-1"><?= ++$index ?></td>
                        <td class="col-4"><?= date("d-m-Y", $reservation->getDatetime()) ?></td>
                        <td class="col-4"><?= date("H:i", $reservation->getDatetime()) ?></td>
                        <td class="col-2"><?= $reservation->getCount() ?></td>
                        <td class="col-1 text-end"><i class="fa-solid fa-square-arrow-up-right fa-xl"></i></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </main>
</div>