<?php
include'config.php';
?>

<?php


			if (isset($_POST['saveC'])){

					$address = stripslashes($_POST['address']);
					$address = htmlentities($address);
					$address = strip_tags($address);
					$address = addslashes($address);

$ins = mysqli_query($con,"INSERT INTO user (id, fname, mname, lname, email, pass, gender, description, address, type, contact, created) VALUES ".
					"('', '". $_POST['fname'] . "', 
					'". $_POST['mname'] . "',
					 '". $_POST['lname'] . "', 
					 '". $_POST['email'] . "', 
					 '". $_POST['p1'] . "', 
					 '". $_POST['gender'] . "', 
					 '". $_POST['desc'] . "',
					 '". $_POST['address'] . "', 
					 '4',
					 '". $_POST['cont'] . "', 
					 CURRENT_TIMESTAMP);");
if ($ins == true) {
$s = mysqli_query($con,"SELECT id FROM user WHERE 
		address	 ='".$_POST['address']."' AND
		description	 ='".$_POST['desc']."' AND
		fname	 ='".$_POST['fname']."' AND
		mname 	='".$_POST['mname']."' AND
		lname 	='".$_POST['lname']."' AND
		email 	='".$_POST['email']."' AND
		pass 	='".$_POST['p1']."'
		LIMIT 1
		");
		while ($r = mysqli_fetch_assoc($s)){
			
			$_SESSION['uid'] = $r['id'];
			header("location:addclinic.php?id=".$r['id']);	
		}
			
}

}

			if (isset($_POST['save'])){
			echo "okay if 1";
			if ($_POST['save']) {
			echo "okay if 2";
				if ($_POST['p1'] == $_POST['p2']){
				
			echo "okay if 3";

					$address = stripslashes($_POST['address']);
					$address = htmlentities($address);
					$address = strip_tags($address);
					$address = addslashes($address);

$ins = mysqli_query($con,"INSERT INTO user (id, fname, mname, lname, email, pass, gender, description, address, type, contact, created) VALUES ".
					"('', '". $_POST['fname'] . "', 
					'". $_POST['mname'] . "',
					 '". $_POST['lname'] . "', 
					 '". $_POST['email'] . "', 
					 '". $_POST['p1'] . "', 
					 '". $_POST['gender'] . "', 
					 '". $_POST['desc'] . "',
					 '". $_POST['cont'] . "', 
					 '". $_POST['address'] . "', 
					 '3',
					 CURRENT_TIMESTAMP);");
					
					
					
					
					/*$insert = mysqli_query($con,"INSERT INTO user (id,fname,mname,lname,email,pass,gender,description,address,type,contact,timestamp)".   <<<< OLD QUERY
						"VALUES('', 
						'".$_POST['fname']."' ,
						 '".$_POST['mname']."' ,
						  '".$_POST['lname']."' ,
						   '".$_POST['email']."' ,
						    '".$_POST['p1']."'  ,
						    '".$_POST['gender']."' ,
						     '".$_POST['desc']."' , 
						     '".$_POST['cont']."' , 
						     '".mysqli_real_escape_string($address)."' , 
						     3 , 
						     '".$_POST['cont']."',
						     'NOW()'
							 )"); */
						
			echo "okay if 4";
						if ($ins){
						
			echo "okay if 5";
								header("location: index.php");			
						}else{
							echo 'sayup';
				}
			}
			}
			}else{
			echo "nothing";
			}
		?>