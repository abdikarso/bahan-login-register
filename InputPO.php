<?php

$conn = mysqli_connect("localhost","root","","suj_catalog");
?>
<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['username']))
{
header("location:index.php?pesan=gagal");

}

//cek level user
if($_SESSION['level']!="admin")
{
header("location:index.php?pesan=gagallevel");
}
?>
<script language='JavaScript'>
var txt="Technical Project - Catalog - ";
var speed=200;
var refresh=null;
function action() { document.title=txt;
txt=txt.substring(1,txt.length)+txt.charAt(0);
refresh=setTimeout("action()",speed);}action();
</script>
<link rel="icon" type="image/png" href="icon.jpg">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<!------ Include the above in your HEAD tag ---------->
  <nav class="navbar bg-info" style="height:60px;">
    <div class="container-fluid">
      <div class="col-sm">
        <div class="navbar-header">
          <h4 class="text-light">Welcome to Technical Project Departement</h4>
        </div>
      </div>

      <div class="col-sm">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="index.php"  class="text-light"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
      </div>

    </div>
  </nav>
  <br>
  <div class="container-fluid">
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <table id="myTable" class=" table order-list">
    <thead class="table-active">
        <tr class="table-active" style="vertical-align: middle;" align="center">
            <th scope="col">No. PO</td>
            <th scope="col">Item</td>
            <th scope="col">Location</td>
            <th scope="col">Qty</td>
            <th scope="col">Delivered By</td>
            <th scope="col">Option</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="">
                <input type="text" name="po[]" class="form-control" />
            </td>
            <td class="">
                <input type="text" name="itemPO[]"  class="form-control"/>
            </td>
            <td class="">
                <select style="width:fill; height:auto;" class="form-control" name="locationPO[]">
                  <?php
                    $sql1 = "SELECT * FROM locator";
                    $hasil = mysqli_query($conn, $sql1);
                    $no=0;
                    while ($data = mysqli_fetch_array($hasil)) {
                      $no++;
                      ?>
                      <option name="locationPO[]" value="<?php echo $data['locator'];?>"><?php echo $data['locator']; ?></option>
                      <?php
                    }

                   ?>

                </select>
            </td>
            <td class="">
                <input type="number" name="qtyPO[]"  class="form-control"/>
            </td>
            <td class="">
                <input type="text" name="userPO[]"  class="form-control" value="<?php echo $_SESSION['username'] ?>"/>
            </td>
            <td align="center"><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>

            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" style="text-align: left;">
                <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Row" />
            </td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: left;">
                <button class="btn btn-info">Submit</button>
            </td>
        </tr>
    </tfoot>
</table>
</div>

<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $count = count($_POST['po']);
    for ($i=0; $i < $count; $i++) {
      $sql = "INSERT INTO `item_list`(`no_po`, `item`, `location`, `qtyPO`, `userBY`) VALUES ('{$_POST['po'][$i]}','{$_POST['itemPO'][$i]}','{$_POST['locationPO'][$i]}','{$_POST['qtyPO'][$i]}','{$_POST['userPO'][$i]}');";
      $conn->query($sql);
    }

  }

 ?>

<script type="text/javascript">
$(document).ready(function () {
  var counter = 0;

  $("#addrow").on("click", function () {
      var newRow = $("<tr>");
      var cols = "";

      cols += '<td><input type="text" name="po[]" class="form-control" name="po' + counter + '"/></td>';
      cols += '<td><input type="text" name="itemPO[]" class="form-control" name="itemPO' + counter + '"/></td>';
      cols += '<td><select class="form-control" name="locationPO[]"><?php $sql1 = "SELECT * FROM locator"; $hasil = mysqli_query($conn, $sql1); $no=0; while ($data = mysqli_fetch_array($hasil)) { $no++; ?> <option name="locationPO[]" value="<?php echo $data['locator'];?>"><?php echo $data['locator']; ?></option> <?php } ?> </select></td>';
      cols += '<td><input type="text" name="qtyPO[]" class="form-control" name="qtyPO' + counter + '"/></td>';
      cols += '<td><input type="text" name="userPO[]" class="form-control" name="userPO' + counter + '"/></td>';

      cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
      newRow.append(cols);
      $("table.order-list").append(newRow);
      counter++;
  });



  $("table.order-list").on("click", ".ibtnDel", function (event) {
      $(this).closest("tr").remove();
      counter -= 1
  });


});


function calculateRow(row) {
  var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
  var grandTotal = 0;
  $("table.order-list").find('input[name^="price"]').each(function () {
      grandTotal += +$(this).val();
  });
  $("#grandtotal").text(grandTotal.toFixed(2));
}
</script>
<hr>

<div class="container">
  <p>Layout yang akan direview !</p>
  <a href="Index.php"><button type="button" class="btn-primary">Halaman Awal</button></a>
    <a href="InputPo.php"><button type="button" class="btn-primary">Form Input PO</button></a>
      <a href="OutPo.php"><button type="button" class="btn-primary">Form Out PO</button></a>
        <a href="List.php"><button type="button" class="btn-primary">Form List PO</button></a>
          <a href="cek_out.php"><button type="button" class="btn-primary">Log Out</button></a>
  </div>
