<?php

	if(isset($_SESSION['userType']) && $_SESSION['userType']) {
		if(isset($_SESSION['uid']) && $_SESSION['uid']) {
			include 'nav-close.php';
		}
	}

?>

</div> <!-- end container fluid -->
</body>
</html>