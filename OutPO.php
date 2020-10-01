<?php

$conn = mysqli_connect("localhost","root","","suj_catalog");
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
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="container">
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <table id="myTable" class=" table order-list">
    <thead>
        <tr style="vertical-align: middle;" align="center">
            <td>No. PO</td>
            <td>Item</td>
            <td>Qty</td>
            <td>Location</td>
            <td>Delivered By</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="col-sm-4">
              <select class="form-control" name="po[]">
                <?php
                  $sql1 = "SELECT * FROM item_list";
                  $hasil = mysqli_query($conn, $sql1);
                  $no=0;
                  while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                    ?>
                    <option name="locationPO[]" value="<?php echo $data['no_po'];?>"><?php echo $data['no_po']; ?></option>
                    <?php
                  }

                 ?>

              </select>
            </td>
            <td class="col-sm-4">
              <select class="form-control" name="itemPO[]">
                <?php
                  $sql1 = "SELECT * FROM item_list";
                  $hasil = mysqli_query($conn, $sql1);
                  $no=0;
                  while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                    ?>
                    <option name="locationPO[]" value="<?php echo $data['item'];?>"><?php echo $data['item']; ?></option>
                    <?php
                  }

                 ?>

              </select>
            </td>
            <td class="col-sm-4">
                <input type="number" name="qtyPO[]"  class="form-control"/>
            </td>
            <td class="col-sm-4">
              <select class="form-control" name="itemPO[]">
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
            <td class="col-sm-4">
                <input type="text" name="userPO[]"  class="form-control"/>
            </td>
            <td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>

            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: left;">
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
      $sql = "INSERT INTO `barang_keluar`(`poOut`, `itemPOOut`, `qtyOut`, `userPOOut`) VALUES ('{$_POST['po'][$i]}','{$_POST['itemPO'][$i]}','{$_POST['qtyPO'][$i]}','{$_POST['userPO'][$i]}');";
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
