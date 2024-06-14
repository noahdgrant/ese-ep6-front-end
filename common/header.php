<header class="fixed-top">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link <?php if ($title=='Home') echo 'active';?>" href="./index.php">Home</a>
        <a class="nav-item nav-link <?php if ($title=='About') echo 'active';?>" href="./about.php">About</a>
        <a class="nav-item nav-link <?php if ($title=='Project Plan') echo 'active';?>" href="./project_plan.php">Project Plan</a>
        <a class="nav-item nav-link <?php if ($title=='Assignments') echo 'active';?>" href="./assignments.php">Assignments</a>
        <a class="nav-item nav-link <?php if ($title=="Noah's Logbook") echo 'active';?>" href="./logbook_noah.php">Noah's Logbook</a>
        <a class="nav-item nav-link <?php if ($title=="Wyatt's Logbook") echo 'active';?>" href="./logbook_wyatt.php">Wyatt's Logbook</a>
      </div>
    </div>
  </nav>
</header>

