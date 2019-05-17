<html>
<body>

<p>A script on this page starts this clock:</p>

<p id="demo"></p>



<?php 
include 'config.php';

?>

<form action = "" method="POST">
	
	
	

</form>


<script>
var myVar = setInterval(myTimer, 1000);
i = 0 ;
function myTimer() {
    var d = new Date();
	i++;
    document.getElementById("demo").innerHTML = i; 
	
					$.get("demo_test.asp", function(data, status){
								alert("Data: " + data + "\nStatus: " + status);
					});
}
 
 
</script>

</body>