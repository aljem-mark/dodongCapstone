<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow navbar-expand-md">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">Dental Finder</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['userFullname']) && $_SESSION['userFullname']) {
                ?>
            <li class="nav-item dropdown mr-2">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['userFullname']; ?></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown04">
                    <a class="dropdown-item" href="userprofile.php">Profile</a>
                    <?php if( $_SESSION['userType'] == 2 ) { ?>
                    <!-- <a class="dropdown-item" href="addclinic.php">Clinic Profile</a> -->
                    <?php } ?>
                    <a class="dropdown-item" href="logout.php" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="logout.php" method="POST" style="display: none;">
                        <input type="hidden" name="logout" value="1">
                    </form>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>