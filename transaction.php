<?php
include 'navbar.php';
session_start();
$ec=0;
//Checking transid session is set or not
if (!isset($_SESSION['transid'])) {
  die("Error! Billing  not started yet. Start from Home Screen");
}
//Creating variable transid to insert it into db
$transid = $_SESSION['transid'];

//add customer
$chsql= "SELECT * from customer where transid='$transid'";
$checkcustomer=$conn->query($chsql);
if (isset($_POST['addcustomer'])) {
	
	$cname = $_POST['cusname'];
	$cphone = $_POST['cusphone'];
	$cemail = $_POST['cusemail'];
	$caddress = $_POST['cusaddress'];
	
	if(empty($cname) || empty($cphone)){
    ?>
    <div class="alert alert-danger text-center">
		<strong>Alert!</strong> Customer details cannot be empty.
    </div>
    <?php
	}
  else{
		
		$exist = $checkcustomer->num_rows;
		if($exist == 0){
			$sqlc = "INSERT INTO customer (transid,name,phone,email,address)VALUES($transid,'$cname','$cphone','$cemail','$caddress')"; 
		$conn->query($sqlc);}
		else{ $ec=1;}
	}
	
}



//Checking form is submitted or not
if (isset($_POST['transadd'])) {
  $itemname = ucfirst($_POST['itemname']);
  $quantity = $_POST['quantity'];
 /* */
 
  
  //Checking if input is empty
  if (empty($itemname)||$quantity==0) {
    ?>
    <div class="alert alert-danger text-center">
		<strong>Alert!</strong> Item name cannot be empty.
    </div>
    <?php
  }
  
  else
  {
    //Checking if product exisits
    $sql = "SELECT itemname FROM items WHERE itemname='$itemname'";
    $result =$conn->query($sql);
    $item = mysqli_fetch_row($result);
    if($item[0]==$itemname)
      {
        //Checking the price of the item
        $sql = "SELECT price FROM items WHERE itemname='$itemname'";
        $result = $conn->query($sql);
        $price = mysqli_fetch_row($result);
        //Saving price vairable in amount
        $amount = $price[0];
        //Calculating the total price
        $totalprice = $amount * $quantity;
        //Inserting the item into transactions table using transid
        $sql = "INSERT INTO transactions VALUES(DEFAULT,$transid,'$itemname',$amount,$quantity,$totalprice)";
        $conn->query($sql);
      }
    else {
      ?>
      <div class="alert alert-danger text-center">
			<strong>Sorry!</strong> Item not available
      </div>
      <?php
    }
  }
}
 ?>
 <div class="container">
   <h1 class="text-center">COCO Tech Rotary</h1><br>
   <div class="row">
   
	<div class=" col-md-6 text-left">
		<?php 
		$cs = $checkcustomer->fetch_assoc();
		if($cs['transid'] == $transid){ echo $cs['name'].'<br>'.$cs['address'].'<br>'.$cs['phone'].'<br>'.$cs['email'];} else{ ?>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-user" aria-hidden="true"></i> Add Customer Details</button>
		<?php } ?>
		
	</div>

   <div class=" col-md-6 text-right">
     <label>Bill No : <?php echo $transid; ?> </label><br>
	 <label>Date : <?php echo date("d-m-Y"); ?></label><br><br>
   </div>
   </div>
   <div><br>
<?php include 'showbill.php'; ?>
<div class="container">
	<form class="form-inline" action="transaction.php" method="post">
			<div class="form-group">
				<label for="itemname">Item: </label>
				<input class="form-control" type="text" name="itemname" placeholder="itemname" autofocus >
			</div>
			<div class="form-group">
				<label for="quantity">Quantity: </label><input class="form-control" type="number" name="quantity" value="1">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit" name="transadd" ><i class="fa fa-cart-plus" aria-hidden="true"></i> Add Item</button>
			</div>
			<hr>
			<div class="form-group text-right">
				<a class="btn btn-danger " href="cancel.php"> Cancel <i class="fa fa-close" aria-hidden="true"></i></a>
				<a class="btn btn-success" href="bill.php"><i class="fa fa-check" aria-hidden="true"></i> Confirm Transaction</a>
			</div>
	</form>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <label for="itemname">Customer Details</label>
      </div>
      <div class="modal-body">
			<form action="transaction.php" method="post">
				<input class="form-control" type="text" name="cusname" placeholder="Customer Name" required><br>
				<input class="form-control" type="number" name="cusphone" placeholder="#phone" maxlength="10" required><br>
				<input class="form-control" type="email" name="cusemail" placeholder="E-mail" ><br>
				<textarea class="form-control" placeholder="Address" name="cusaddress"></textarea>
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addcustomer" class="btn btn-primary">Submit Details</button>
		</form>
      </div>
    </div>
  </div>
</div>
<!----end modal---->