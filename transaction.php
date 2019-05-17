<?php include 'header.php';
include 'nav.php'; ?>

<?php
  if(isset($_POST['update'])) {
    $query = mysqli_query($con,"UPDATE `appointments` SET `idServ`=".$_POST['clinic_services_list']." WHERE `id`=".$_POST['id']);
  }

  if(isset($_POST['cancel'])) {
    $query = mysqli_query($con,"UPDATE `appointments` SET `status`='cancelled' WHERE `id`=".$_POST['id']);
  }
?>
 
 <a href="cliniclist.php" style="text-decoration: none;"><h4 >Dental Finder</h4>
</a>
<div class="container-fluid">
	<div><h1>Transactions</h1></div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Clinic</th>
      <th scope="col">Message</th>
      <th scope="col">Service</th>
      <th scope="col">Appointment Date</th>
      <th scope="col">Price</th>
      <th scope="col">Feedback</th> 
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  	<?php $query = mysqli_query($con,"SELECT a.*, c.name as clinic_name, cs.service_name, cs.price FROM `appointments` as a LEFT JOIN `clinic` as c ON c.id = a.clinic_id LEFT JOIN `clinic_services` as cs ON cs.id = a.idServ WHERE a.user_id = ".$_SESSION['uid']); 
  		while ($row = mysqli_fetch_array($query)) {
  			$clinicName = $row['clinic_name'];
  			$message = $row['description'];
  			$service = $row['service_name'];
        $timeApnted = explode("|", $row['timeApnted']);
        $first = $timeApnted[0];
        $end = end($timeApnted);
        $appointmentDate = $row['dateApnted']."<br>".$first." - ".$end;
  			$price = $row['price'];
  			$status = $row['status'];
        $rowData = array(
          'id' => $row['id'],
          'clinicId' => $row['clinic_id'],
          'idServ' => $row['idServ']
        );
	?>
	<tr>
		<td><?php echo $clinicName; ?></td>
		<td><?php echo $message; ?></td>
    <td><?php echo $service; ?></td>
		<td><?php echo $appointmentDate; ?></td>
		<td><?php echo $price; ?></td>
		<td><?php echo $status;?></td>
    <td>
      <?php if($status == "pending") { ?>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTransactionEdit" data-json='<?php echo json_encode($rowData); ?>' onClick="handleEdit(this)">Edit</button>
      <?php } ?>
      <?php if($status != "cancelled" && $status != "delete") { ?>
        <form class="d-inline" method="post" action="">
          <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
          <button type="submit" class="btn btn-warning" name="cancel">Cancel</button>
        </form>
      <?php } ?>
    </td>
	</tr>

	<?php } ?>
    	
  </tbody>
</table>

</div>

<form method="post" action="">
  <div class="modal fade" id="modalTransactionEdit" role="dialog">
    <div class="modal-dialog">       
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="id" id="appointment_id">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Transaction</h4>
        </div>
        <div class="modal-body">
          Select Service: <select name="clinic_services_list" id="clinic_services_list"></select>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" name="update">Update</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
  function handleEdit(el) {
    var data = JSON.parse($(el).attr('data-json'));
    $.get('ajax_services.php', data, function(response) {
      $('#clinic_services_list').html(response.message);
      $('#clinic_services_list').val(data.idServ);
      $('#appointment_id').val(data.id);
    }, "json");
  }
</script>