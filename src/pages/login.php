<div class="vh-100">
    <header class="bg-light shadow-sm">
        <div class="container navbar navbar-expand-md navbar-light justify-content-between">
            <div class="col-auto">
                <a class="navbar-brand" href="<?= $_SERVER["REDIRECT_ROOT"] ?>">Bon Temps</a>
            </div>
            <div class="col-auto">
                <span class="navbar-text">
                    Inloggen
                </span>
            </div>
            <div class="col-auto">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <nav class="collapse navbar-collapse" id="navbarSupportedContent">
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
        </div>
    </header>
    <main class="container center">
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