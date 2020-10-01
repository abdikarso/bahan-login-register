<?php
$connect = mysqli_connect("localhost", "root", "", "suj_catalog");
if(isset($_POST["no_po"]))
{
 $no_po = $_POST["no_po"];
 $item = $_POST["item"];
 $location = $_POST["location"];
 $userBY = $_POST["userBY"];
 $query = '';
 for($count = 0; $count<count($no_po); $count++)
 {
  $no_po_clean = mysqli_real_escape_string($connect, $no_po[$count]);
  $item_clean = mysqli_real_escape_string($connect, $item[$count]);
  $location_clean = mysqli_real_escape_string($connect, $location[$count]);
  $userBY_clean = mysqli_real_escape_string($connect, $userBY[$count]);
  if($no_po_clean != '' && $item_clean != '' && $location_clean != '' && $userBY_clean != '')
  {
   $query .= '
   INSERT INTO item_list(no_po, item, location, userBY)
   VALUES("'.$no_po_clean.'", "'.$item_clean.'", "'.$location_clean.'", "'.$userBY_clean.'");
   ';
  }
 }
 if($query != '')
 {
  if(mysqli_multi_query($connect, $query))
  {
   echo 'Data Berhasil disimpan';
  }
  else
  {
   echo 'Error';
  }
 }
 else
 {
  echo 'All Fields are Required';
 }
}
?>
