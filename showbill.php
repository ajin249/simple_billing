<?php
  $sql = "SELECT id,item,amount,quantity,price FROM transactions WHERE transid='$transid'";
  $result = $conn->query($sql);
  if(isset($_GET['dlt'])){
	$id=$_GET['dlt'];
	$sqld="delete from transactions where id=$id and transid=$transid";
	$conn->query($sqld);
	header('location:transaction.php');
  }
  ?>
 
<table class="table table-striped">
  <thead>
    <tr>
      <th>No.</th>
      <th>Item</th>
      <th>Amount</th>
      <th>Quantity</th>
      <th>Price</th>
      <th class='text-center'>Remove</th>
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
		echo "<td class='text-center'>";
		echo '<a href="transaction.php?dlt='.$r['id'].'"><i class="fa fa-trash" style="color:red"></i></a>';
		echo "</td>";
        echo "</tr>";
        $total = $total + $r['price'];
      }
     ?>
	 <tr><th colspan="3"></th><th>Total</th>  <th colspan="2"><?php echo "₹ $total /-"; ?></th></tr>
   </tbody>
 </table>
 </div>
 </div>
