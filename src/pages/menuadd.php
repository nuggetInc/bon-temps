<?php

declare(strict_types=1);
if (isset($_POST['gerechttoe'])) {
    $gerecht = $_POST['name'];
    $categorie = $_POST['category'];
    $soort = $_POST['kind'];

    $sth = getPDO()->prepare("INSERT INTO `dishes`(`name`, `category`, `kind`) VALUES(:name,:category,:kind)");

    $pdoExec = $sth->execute(array(":name"=>$gerecht,":category"=>$categorie,":kind"=>$soort));

    if ($pdoExec) {
        echo 'Data Inserted';
    }else {
        echo 'Data Not Inserted';
    }
}

?>
<div class="vh-100 d-flex flex-column">
    <header class="bg-light shadow-sm mb-auto">
        <div class="container navbar navbar-expand-md navbar-light px-3">
            <a class="navbar-brand fw-bold" href="<?= ROOT ?>">Bon Temps</a>
            <span class="navbar-text">
                Menu toevoegen
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/logout">Uitloggen</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container mb-auto">
        <div class="row justify-content-around gy-5">
            <form class="col-lg-2 text-dark fw-bold" method="post">
                <h2 class="mb-3">Gerecht toevoegen</h2>
                <div>
                    <label class="form-label" for="name">Gerecht</label>
                    <br>
                    <input type="text" name="name" class="form-control" id="gerecht">
                </div>
                <div>
                    <label class="form-label" for="category">Categorie</label>
                    <br>
                    <select class="form-control" name="category" id="categorie">
                        <option value="voorgerecht">Voorgerecht</option>
                        <option value="hoofdgerecht">Hoofdgerecht</option>
                        <option value="nagerecht">Na gerecht</option>
                    </select>
                </div>
                <div>
                    <label class="form-label" for="kind">Soort</label>
                    <br>
                    <select class="form-control" name="kind" id="soort">
                        <option value="vlees">Vlees</option>
                        <option value="vis">Vis</option>
                        <option value="vega">Vega</option>                        
                    </select>
                </div>
                <br>
                <button type="submit" name="gerechttoe" class="btn btn-primary">toevoegen</button>
            </form>            
        </div>
    </main>
</div>