<?php include 'navbar.php';
  session_start();
  $transid = mt_rand(100,9999);
  
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ASBS</title>
  </head>
  <body>
<div class="container text-center">
  <h1>Billing System</h1>
  <img src="coco.png" alt="asbs logo" class="img-circle" width="400px"><br>
  

		<div class="col-md-4 ">
			<br><a class="btn btn-success col-md-12 btn-lg" href="additems.php"><i class="fa fa-database" aria-hidden="true"></i>  Add Item</a>
		</div>
		<div class="col-md-4">
		<br>
			<form action="transaction.php" method="post">
				<input type="hidden" value=<?php echo "$transid"; $_SESSION['transid']=$transid; ?> name="transid" />
	            <button class="btn btn-primary btn-lg col-md-12" type="submit" name="transidsubmit"><i class="fa fa-print" aria-hidden="true"></i> Start Billing</button>
			</form>
		</div>
		<div class="col-md-4">
			<br><a class="btn btn-warning btn-lg col-md-12" href="transaction.php"><i class="fa fa-file-text" aria-hidden="true"></i> Transactions</a>
		</div>
	
</div>
  </body>
</html>
