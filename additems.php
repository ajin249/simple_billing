<?php
include 'navbar.php';
?>
<head>
  <title>Add Items</title>
</head>
<section class="col-md-12">
	<h2 class="text-center">Billing Items</h2><hr>
</section>
<div class="container text-left">
<div class="row">
<div class="col-md-4">
	<h3 class="text-center">Add Item</h3><hr>
    <form class="form-group" action="additems.php" method="post" >
      <label for="itemname">Enter item name: </label><br>
      <input class="form-control" type="text" name="itemname" placeholder="Item Name" autofocus required><br>
      <label for="price">Enter the price of item: </label><br>
      <input class="form-control" type="number" name="price" placeholder="Item Price" required><br>
      <label for="stock">Enter GST % : </label><br>
      <input class="form-control" type="number" name="stock" placeholder="SGST + CGST"><br>
      <input class="btn btn-primary" style="font-weight:bold;"type="submit" name="additemsubmit" value="Add Item">
	 <!-- <a href="viewitems.php" class="btn btn-default">View Items</a> -->
    </form>
    <br><br>
	</div>
	<div class="col-md-1"></div>
	<div class="col-md-7">
	
	<?php
    $sql = "SELECT * FROM items ORDER BY id DESC limit 7";
    $result = $conn->query($sql);
    if ($result->num_rows>0) {
      ?>
<div class="row">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Price</th>
              <th>Tax (GST) %</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach ($result as $key => $r) {
            echo "<tr>";
            echo "<td>";
            echo $key+1;
            echo "</td>";
            echo "<td>";
            echo $r['itemname'];
            echo "</td>";
            echo "<td>";
            echo $r['price'];
            echo "</td>";
            echo "<td >";
            echo $r['stock'];
            echo "</td>";
            ?>
          <td>
            <form action="delete.php" method="post">
              <input type="hidden" name="itemname" value="<?php echo $r['itemname']; ?>">
              <button class="btn btn-danger btn-sm" type="submit" name="delete">Delete <span class="glyphicon glyphicon-trash"></span></button>
            </form>
          </td>
        </tr>
            <?php
          }
        }
      else {
        echo "Nothing found in db";
      }
       ?>
         </tbody>
     </table>
     <div class="text-left">
       <a href="viewitems.php" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i> View All Items</a>
     </div>
      </div>
	</div>
	</div>
	</div>
	
    <?php
    if (isset($_POST['additemsubmit'])){
      $item = ucfirst($_POST['itemname']);
      $price = $_POST['price'];
      $stock = $_POST['stock'];
      if (empty($_POST['itemname'])) {
        echo '<div class="alert alert-danger text-center">';
        echo "Item Name is requied";
        echo '</div>';
      }
      elseif (empty($_POST['price'])) {
        echo '<div class="alert alert-danger text-center">';
        echo "Price is requied";
        echo "</div>";
      }
      elseif (empty($_POST['stock'])) {
        echo '<div class="alert alert-danger text-center">';
        echo "Quantity is requied";
        echo "</div>";
      }
      else {
        $sql = "INSERT INTO items VALUES(DEFAULT,'$item',$price,$stock)";

        if ($conn->query($sql)==TRUE) {
          echo '<div class="alert alert-success text-center">';
		  echo '<script>window.location="additems.php"</script>';
          echo "Item inserted into database";
          echo "</div>";
        }
        else {
          echo '<div class="alert alert-danger text-center">';
          echo "Item not inserted";
          echo "</div>";
        }
      }
    $conn->close();
    }
     ?>
</div>
