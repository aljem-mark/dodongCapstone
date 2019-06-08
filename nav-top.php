<nav class="navbar navbar-dark bg-dark fixed-top flex-md-nowrap shadow navbar-expand-md">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php echo isset($_SESSION['homepage']) ? $_SESSION['homepage'] : "index.php"; ?>">Dental Finder</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav ml-auto">

            <?php if (isset($_SESSION['userFullname'])) : ?>

                <li class="nav-item dropdown mr-2">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['userFullname']; ?></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="profile-edit.php?user_id=<?= $_SESSION['uid']; ?>">Profile</a>
                        <a class="dropdown-item" href="clinic-manage-appointment.php?clinic_id=<?= $_SESSION['ClinicID']; ?>">Number of Appointments/day</a>
                        <!-- Triggers the logout form -->
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="logout.php" method="POST">
                            <input type="hidden" name="logout" value="1">
                        </form>
                    </div>
                </li>

            <?php else : ?>

                <li class="nav-item mr-2">
                    <a class="nav-link" href="cliniclist.php" >View Clinic List</a>
                </li>

                <form class="form-inline">
                    <a class="btn btn-secondary mr-2" href="login.php">Sign in</a>
                    <a class="btn btn-info" href="addclinic.php">Register Clinic</a>
                </form>

            <?php endif; ?>

        </ul>
    </div>
</nav>