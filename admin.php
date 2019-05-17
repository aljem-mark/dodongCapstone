<?php 

include 'header.php';
 ?>
 
 <div class="container">        
  <table class="table table-bordered">
  <div><h3>Admin Verification for Dental Clinic</h3></div>
    <thead>
      <tr>
      <th >Clinic name			</th>
      <th >Clinic Address		</th>
      <th >Clinic Description	</th>
      <th >Owner name	</th>
      <th >Date Created			</th>
      <th ></th>
      </tr>
    </thead>
    <tbody>
      <tr>
	  
	  	<?php $query = mysqli_query($con,"SELECT c.*   , U.id as id , U.fname as fname , U.mname as mname , U.lname as lname FROM clinic as C LEFT JOIN user as U ON C.user_id = U.id WHERE u.type = '4'"); 
  		while ($row = mysqli_fetch_array($query)) {
  		
      
	?>
	<tr>
		<td><?php echo $row['name']; ?></td>
		<td><?php echo $row['address']; ?></td>
		<td><?php echo $row['description']; ?></td>
		<td><?php echo $row['lname'].', '.$row['mname'].''.$row['fname']; ?></td>
		<td><?php echo $row['created']; ?></td>
		<td><a href="adminver.php?id=<?php echo $row['id']; ?>">Verify</a></td>
	</tr>
   <?php } ?>
      </tr>
    </tbody>
  </table>
</div>
 