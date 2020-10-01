<?php

  $conn = mysqli_connect("localhost","root","","suj_catalog");

  $count = count($_POST['name']);

  for ($i=0; $i < $count; $i++) {
    $sql = "INSERT INTO `item_list`(`no_po`, `item`, `location`, `userBY`) VALUES ('{$_POST['name'][$i]}','{$_POST['mail'][$i]}','{$_POST['phone'][$i]}','');";
    $conn->query($sql);
  }
 ?>
