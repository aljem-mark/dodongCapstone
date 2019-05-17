 
<div class="container-fluid" style="position: relative;">
	<div class="row">
		<div class="col-md-12 col-xs-12">
<nav class="custom-navbar navbar navbar-expand-md">
	
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
            <?php if( $_SESSION['userType'] == 3 ) { ?>
              <a class="dropdown-item" href="transaction.php">Transactions</a>
            <?php } ?>
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
	<div id="wrapper">
		<main class="col-md-12 ml-sm-auto px-10">

 
            
             <div id="wrapper" >
    
   

     <?php if (isset($_SESSION['userType']) && $_SESSION['userType'] ==2) {
     	?> <!-- Divider 
      <hr class="sidebar-divider my-0">

       Nav Item - Dashboard -->
  <ul class="main-sidebar navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <!--<i class="fas fa-laugh-wink"></i>-->
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo  $_SESSION['userFullname'];?> <sup> </sup></div>
      </a>

      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
		  
		  <?php
		 
		  ?>Dashboard <span class="badge badge-warning" id="ihed" ></span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>
      <li class="nav-item">
        <a class="nav-link" href="services.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Services</span></a>
      </li>
      <hr class="sidebar-divider">
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
       <!--  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Notification</span>
        </a> -->
       <!--  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Appointments</a>
            <a class="collapse-item" href="cards.html">Cards</a>
          </div>
        </div> -->
      </li>

		<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
		<i class="fa fa-bars"></i>
		</button>
  </ul> 
 <?php
     }?>  


          <!-- Topbar Navbar -->
        
            <!-- Nav Item - Alerts 
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                Counter - Alerts 
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
            Dropdown - Alerts 
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>
           </ul>
       </nav> -->
   
</div>

     


		</div>
	</div>
</div>



<script>
var i = 0;
var ix = 0;

var myVar = setInterval(myTimer, 2000);


function myTimer() { 
		$.get("ajax_dashCount.php", function(data, status){
		if(data != 0 ){
		 document.getElementById("ihed").innerHTML = data; 
		i++; 
			if (ix != data && i > 5){
			 var r = confirm("You have a new Request! Do you want to open it?");
					if (r == true) {
					location.reload();
					}
			
			}
		 ix = data;
  }
  else{
		 document.getElementById("ihed").innerHTML = ""; 
		}
				 	 
		});
} 


</script>