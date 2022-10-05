<div class="vh-100 gradient">
    <header class="container navbar navbar-expand-md navbar-dark justify-content-between">
        <div class="col-auto">
            <a class="navbar-brand" href="<?= $_SERVER["REDIRECT_ROOT"] ?>">Bon Temps</a>
        </div>
        <div class="col-auto">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
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
    <main class="container center">
        <div class="row justify-content-around gy-5">
            <form class="col-lg-4 text-light fw-bold">
                <h1 class="mb-3">Inloggen</h1>
                <div class="mb-3">
                    <label class="form-label" for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="inputPassword">Wachtwoord</label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Wachtwoord">
                </div>
                <button type="submit" class="btn btn-light">Log in</button>
            </form>
            <div class="col-lg-4 text-light">
                <h1 class="mb-3">Bon Temps</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam similique tempore tempora at, nesciunt eaque?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, dolorem officia expedita modi dolores rerum.</p>
            </div>
        </div>
    </main>
</div>
<div class="container main p-5 ">
    <h1>Lorem ipsum</h1>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Beatae explicabo officiis iusto, eaque dignissimos voluptatibus odio ut accusamus blanditiis aut ea itaque vero? Totam, sint exercitationem? Sed quasi animi dolorem!</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit totam possimus velit? Mollitia, architecto ad aliquam repudiandae facere harum consequatur distinctio suscipit officia exercitationem hic voluptas aut et cupiditate libero?</p>
</div>