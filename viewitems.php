<?php
include 'navbar.php';
?>
<?php
    $sql = "SELECT * FROM items";
    $result = $conn->query($sql);
    if ($result->num_rows>0) {
      ?>
<div class="container  session_start();
  $transid = mt_rand(11111,99999);">
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
            echo "<td>";
            echo $r['stock'];
            echo "</td>";
            ?>
          <td>
            <form action="delete.php" method="post">
              <input type="hidden" name="itemname" value="<?php echo $r['itemname']; ?>">
              <button class="btn btn-danger btn-sm" type="submit" name="delete"> Delete <span class="glyphicon glyphicon-trash"></span></button>
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
       <a href="additems.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> Add Items</a>
     </div>
      </div>