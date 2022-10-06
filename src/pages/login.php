<div class="vh-100  d-flex flex-column">
    <header class="bg-light shadow-sm mb-auto">
        <div class="container navbar navbar-expand-md navbar-light px-3">
            <a class="navbar-brand" href="<?= $_SERVER["REDIRECT_ROOT"] ?>">Bon Temps</a>
            <span class="navbar-text">
                Inloggen
            </span>
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
        </div>
    </header>
    <main class="container mb-auto">
        <div class="row justify-content-around gy-5">
            <form class="col-lg-4 text-dark fw-bold">
                <h1 class="mb-3">Inloggen</h1>
                <div class="mb-3">
                    <label class="form-label" for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="inputPassword">Wachtwoord</label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Wachtwoord">
                </div>
                <button type="submit" class="btn btn-primary">Log in</button>
            </form>
        </div>
    </main>
</div>