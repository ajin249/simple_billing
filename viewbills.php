<?php
include 'navbar.php';
if(isset($_GET['cd'])){
	
	if($_GET['cd']==2){
		$sql = "SELECT * FROM bills inner join customer on bills.transid=customer.transid";
	}
	else if($_GET['cd']==0){
		$sql = "SELECT * FROM bills";
	}
	else if($_GET['cd']==1){ 
		$sql = "SELECT bills.id,bills.transid,bills.total,bills.date FROM bills LEFT JOIN customer ON bills.transid = customer.transid WHERE customer.transid IS NULL"; 
	}
	
	else{
		$sql = "SELECT * FROM bills";
	}
}
else{
	$sql = "SELECT * FROM bills";
}


$result = $conn->query($sql);
if (!mysqli_num_rows($result)>0){
  echo '<h1 class="text-center">No transactions found</h1>';
}
else {
?>
<title>Bills</title>
<div class="container">
<a href="viewbills.php?cd=0" class="btn <?php if($_GET['cd']==0){echo "btn-info";}else{echo "btn-default";} ?>"><i class="fa fa-search" aria-hidden="true"></i> View All Bills</a>
<a href="viewbills.php?cd=1" class="btn <?php if($_GET['cd']==1){echo "btn-info";}else{echo "btn-default";} ?>"><i class="fa fa-search" aria-hidden="true"></i> Bills without Customer Details</a>
<a href="viewbills.php?cd=2" class="btn <?php if($_GET['cd']==2){echo "btn-info";}else{echo "btn-default";} ?>"><i class="fa fa-search" aria-hidden="true"></i> Bills with Customer Details</a>

 
  <table class="table table-striped">
  <thead>
    <tr>
      <th>No.</th>
      <th>Bill Number</th>
      <th>Total</th>
      <th>Date & Time</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($result as $key => $r) {
        echo '<tr style="cursor:pointer" class="userinfo" data-toggle="modal" data-id='.$r['transid'].' data-target="#orderModal">';
        echo "<td>";
        echo $key+1;
        echo "</td>";
        echo "<td>";
        echo $r['transid'];
        echo "</td>";
        echo "<td>";
        echo $r['total'];
        echo "</td>";
        echo "<td>";
        echo $r['date'];
        echo "</td>";
        echo "<td>";
        echo "</tr>";
      }
    }
     ?>
   </tbody>
  </table>
</div>

<div class="modal fade" id="empModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <label for="itemname">Invoice Details</label>
      </div>
      <div class="modal-body" id="modal-body">
			
			
      </div>
      <div class="modal-footer">
        
        
		<button type="button" class="btn btn-secondary" onClick="window.location.reload()" id="cl" style="visibility:hidden">Close</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cl1">Close</button>
        <button class="btn btn-primary" onclick="printDiv('modal-body')" title="Print Bill Copy">Print</button>
		
      </div>
    </div>
  </div>
</div>
<script type='text/javascript'>
            $(document).ready(function(){

                $('.userinfo').click(function(){
                   
                    var userid = $(this).data('id');

                    // AJAX request
                    $.ajax({
                        url: 'ajaxfile.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){ 
                            // Add response in Modal body
                            $('.modal-body').html(response); 

                            // Display Modal
                            $('#empModal').modal('show'); 
                        }
                    });
                });
				
            });
</script>
 <script>
function printDiv(divName) {
	document.getElementById('hd').style.display = "block";
	document.getElementById('cl1').style.display = "none";
	document.getElementById('cl').style.visibility = "visible";
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
		
     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
