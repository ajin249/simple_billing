<?php
include "db.php";

$userid = $_POST['userid'];

$f=0;
$sql = "select * from bills inner join customer on bills.transid=customer.transid where bills.transid=".$userid;
$result = mysqli_query($conn,$sql);

if($result->num_rows==0){
	$f=1;
	$sql = "select * from bills where transid=".$userid;
	$result = mysqli_query($conn,$sql);
}

$sql1 = "select * from transactions where transid=".$userid;
$result1 = mysqli_query($conn,$sql1);



$response = "<table border='0' width='100%'>";
while( $row = mysqli_fetch_array($result) ){
	
	$id = $row['transid'];
	
	$total = $row['total'];
	
	$dates = strtotime($row['date']);
	$date = date('d - m - Y',$dates);
	
	$response .='<div id="hd" style="display:none; text-align:center;"> <h2> COCOTECH ROTARY </h2> GSTIN:987456321<br> +91 94474 31952 | +91 97442 43932 <br> cocotechrotary@gmail.com <br><br> </div>';
	
	if($f==0){
    $name = $row['name'];
    $phone = $row['phone'];
    $email = $row['email'];
    $address = $row['address'];
	
	$response .= "<tr>";
    $response .= "<td colspan='4'>".$name."<br>".$phone."<br>".$email."<br>".$address."</td><td style='text-align:right' colspan='1'><b>Bill No: ".$id."<br>".$date."</b></td>";
    $response .= "</tr>";
	}
	
	else{
	$response .= "<tr>";
    $response .= "<td colspan='2'><b>Bill No: ".$id."</b></td><td style='text-align:right' colspan='3'><b>".$date."</b></td>";
    $response .= "</tr>";
	}

    $response .= "<tr>";
    $response .= "<td colspan='5'><hr></td>";
    $response .= "</tr>";

	$response .= "<tr>";
	$response .= "<th>#</th><th>Item</th><th>Amount</th><th>Quantity</th><th>Price</th>";
	$response .= "</tr>";
	
	$i=1;
	while( $row = mysqli_fetch_array($result1)){
	$response .= "<tr>";
	$response .= "<td>".$i."</td><td>".$row['item']."</td><td>".$row['amount']."</td><td>".$row['quantity']."</td><td>".$row['price']."</td>";
	$response .= "</tr>";
	$i=$i+1;
	}
}
	$response .= "<tr>";
    $response .= "<td colspan='5'><hr></td>";
    $response .= "</tr>";
	$response .= "<tr>";
	
	$response .= "<th colspan='3' style='text-align:right'>Total</th><th></th><th>".$total." /-</th>";
	$response .= "</tr>";
	$response .= "</table>";
	
	$response .= "<tr>";
    $response .= "<td colspan='5'><hr></td>";
    $response .= "</tr>";

echo $response;
exit;