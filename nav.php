<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">

            <?php if($_SESSION['userType'] == 1) : ?>

            <?php elseif($_SESSION['userType'] == 2) : ?>

            <li class="nav-item">
                <a class="nav-link" href="dentist-index.php">
                    <i class="fas fa-calendar-alt mr-1"></i>     
                    Appointments
                </a>
            </li>

            <?php endif; ?>

        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10" style="padding-top: 40px;">
