<!-- navbar.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/tp">Mon Site</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/tp/index.php?ctrl=user&action=view">Liste des utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tp/index.php?ctrl=user&action=createForm">Create</a>
                </li>
                <?php
                if (isset($_SESSION['email'])) {
                    echo '
                    <li class="nav-item">
                    <a class="nav-link" href="/tp/index.php?ctrl=login&action=logout">Logout</a>
                    </li>
                    ';
                    echo $_SESSION['email'] ;
                    if ($_SESSION['admin'] == 1) {
                        echo "true";
                    }
                    else {
                        echo "false";
                    }

                } else{
                    echo'
                   <li class="nav-item">
                    <a class="nav-link" href="/tp/index.php?ctrl=login&action=index">Login</a>
                    </li> 
                    ';
                }




                ?>
            </ul>
        </div>
    </div>
</nav>
