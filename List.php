<script language='JavaScript'>
var txt="Technical Project - Catalog - ";
var speed=200;
var refresh=null;
function action() { document.title=txt;
txt=txt.substring(1,txt.length)+txt.charAt(0);
refresh=setTimeout("action()",speed);}action();
</script>
<link rel="icon" type="image/png" href="icon.jpg">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php
$connect = mysqli_connect("localhost", "root", "", "suj_catalog");
$output = '';
$query = "SELECT * FROM item_list ORDER BY ID ASC";
$result = mysqli_query($connect, $query);
$output = '
<br />
<h3 align="center">Catalog Warehouse 4B</h3>
<table class="table table-bordered table-responsive">
 <tr>
  <th align="center">No</th>
  <th align="center">Nomor PO</th>
  <th align="center">Item Barang</th>
  <th align="center">Location</th>
  <th align="center">Qty</th>
  <th align="center">User By</th>
  <th align="center">Date</th>
 </tr>
';
while($row = mysqli_fetch_array($result))
{
 $output .= '
 <tr>
  <td align="center">'.$row["ID"].'</td>
  <td align="center">'.$row["no_po"].'</td>
  <td align="center">'.$row["item"].'</td>
  <td align="center">'.$row["location"].'</td>
  <td align="center">'.$row["qtyPO"].'</td>
  <td align="center">'.$row["userBY"].'</td>
  <td align="center">'.$row["DATE"].'</td>
 </tr>
 ';
}
$output .= '</table>';
echo $output;
?>
