<?php
include 'db.php';
if (isset($_POST['delete'])&&isset($_POST['itemname'])) {
  $itemname = $_POST['itemname'];
  $sql="DELETE FROM items WHERE itemname='$itemname'";
  if ($conn->query($sql)) {
    header('Location: additems.php');
  }
  else {
    echo "Not deleted";
  }
}
else {
  header('Location: additems.php');
}
 ?>
