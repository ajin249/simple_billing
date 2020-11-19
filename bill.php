<?php
include 'navbar.php';
session_start();
//Checking transid session is set or not
if (!isset($_SESSION['transid'])) {
  die("Error contact system admin");
}
//Creating variable transid to insert it into db
$transid = $_SESSION['transid'];
  //Displaying the bill
  $sql = "SELECT item,amount,quantity,price FROM transactions WHERE transid='$transid'";
  $result = $conn->query($sql);
  
  if (!mysqli_num_rows($result)>0) {
    echo '<div class="text-center">';
    echo '<br><br><h1 style="font-size:50px;">Not allowed</h1>';
    echo '<a href="transaction.php" class="btn btn-default btn-lg">Go Back</a>';
    echo "</div>";
    die();
    }
	$sql1 = "SELECT * FROM customer WHERE transid='$transid'";
	$result1 = $conn->query($sql1);
	$cs = $result1->fetch_assoc();
  ?>
  <div class="container" >
  <div id="printableArea" >

<table class="table table-striped">
  <thead>
	<tr>
		<td colspan="2">cocotechrotary@gmail.com</td>
		<td colspan="3" class="text-right">+91 94474 31952 | +91 97442 43932</td>
	</tr>
	<tr>
		<td colspan="2"><br><img src="logo.png" height="80px"></td>
		<td colspan="3" class="text-right"><br><img src="text.png" height="100px"></td>
	</tr>
	<tr>	
		<th colspan="3" class="text-left"><br><br><?php echo $cs['name']; ?> <br> <?php echo $cs['address']; ?><br><?php echo $cs['phone']; ?><br><?php echo $cs['email']; ?></th>	
		<th colspan="2" class="text-right"><br><br>Bill No : <?php echo $transid; ?><br> Date : <?php echo date("d-m-Y"); ?> </th> 
	</tr>
	<tr><td></td></tr>
    <tr>
      <th>No.</th>
      <th>Item</th>
      <th>Amount</th>
      <th>Quantity</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $total = 0;
      foreach ($result as $key => $r) {
        echo "<tr>";
        echo "<td>";
        echo $key+1;
        echo "</td>";
        echo "<td>";
        echo $r['item'];
        echo "</td>";
        echo "<td>";
        echo $r['amount'];
        echo "</td>";
        echo "<td>";
        echo $r['quantity'];
        echo "</td>";
        echo "<td>";
        echo $r['price'];
        echo "</td>";
        echo "</tr>";
        $total = $total + $r['price'];
      }
        //Checking whether transaction is getting repeated
        $sql="SELECT transid from bills WHERE transid=$transid";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if ($transid==$row['transid']) {
          echo '<div class="alert alert-danger text-center" id="alerts">';
          echo "Repeated Transaction";
          echo "</div>";
        }
        else {
          //Making bill and this confirms the successful transaction
          $sql = "INSERT INTO bills VALUES(DEFAULT,$transid,$total,DEFAULT)";
          if (!$conn->query($sql)) {
            echo "Transactions Unsuccessful Try Again...!";
          }
          else {
            echo '<div class="alert alert-success text-center" id="alerts">';
            echo "Transaction Completed.";
            echo "</div>";
          }
        }
    ?>
   
   <tr><th colspan="4" class="text-right"><br>Grand Total</th><th><br> <?php echo "₹ $total /-"; ?></th></tr>
	<tr><td colspan="5"></td></tr>
</tbody>
 </table>
 </div>
 <hr>
 <div class="text-right">
  <button class="btn btn-success" onclick="printDiv('printableArea')" data-toggle="tooltip" data-placement="top" title="Print this Bill"><span class="glyphicon glyphicon-print"></span> Print</button>
  <a href="transaction.php" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Add item to this bill"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add Item</a>
  <a href="cancel.php" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Create New Bill"><i class="fa fa-file-text-o" aria-hidden="true"></i> Add New Bill</a>
  <a href="index.php" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Back to Home Screen"><i class="fa fa-home" aria-hidden="true"></i> Back to Home</a>
 <br><br>
 <br><br></div>
 <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
 <script>
function printDiv(divName) {
	 document.getElementById('alerts').style.display = "none";
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
		
     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
