<header class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                <a class="nav-item nav-link <?php if ($title=='Home') echo 'active';?>" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-item nav-link <?php if ($title=='About') echo 'active';?>" href="./about.php">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-item nav-link <?php if ($title=='Project Plan') echo 'active';?>" href="./project_plan.php">Project Plan</a>
                </li>
                <li class="nav-item">
                <a class="nav-item nav-link <?php if ($title=='Assignments') echo 'active';?>" href="./assignments.php">Assignments</a>
                </li>
                <li class="nav-item">
                <a class="nav-item nav-link <?php if ($title=="Noah's Logbook") echo 'active';?>" href="./logbook_noah.php">Noah's Logbook</a>
                </li>
                <li class="nav-item">
                <a class="nav-item nav-link <?php if ($title=="Wyatt's Logbook") echo 'active';?>" href="./logbook_wyatt.php">Wyatt's Logbook</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php
                if(isset($_SESSION['username'])){
                    echo <<<EOT
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php?request=logout">Logout</a>
                    </li>
                    EOT;
                }
                else{
                    echo <<<EOT
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Signup</a>
                    </li>
                    EOT;
                }
                ?>
                
                
            </ul>
        </div>
    </nav>
</header>