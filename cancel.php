  <?php 
  include 'db.php';
  unset($_SESSION['transid']);
 
  session_start();
  $transid = mt_rand(111,9999);
  $_SESSION['transid']=$transid;
  header('location:transaction.php');
  ?>
  