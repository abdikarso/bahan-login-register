<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script language='JavaScript'>
  var txt="Technical Project - ";
  var speed=200;
  var refresh=null;
  function action() { document.title=txt;
  txt=txt.substring(1,txt.length)+txt.charAt(0);
  refresh=setTimeout("action()",speed);}action();
  </script>
    <link rel="icon" type="image/png" href="icon.jpg">
    <link rel="stylesheet" href="css/bootstrap.css">
  </head>
  <body>
    <div class="container" align="center">
      <img src="suj.png" width="" alt="">
      <p>PT SENTRA USAHATAMA JAYA</p>
        <br>
      <h5>I-Cat Technical Project</h5>
    </div>
    <div class="container" style="width:300px">
      <form>
        <div class="form-group">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
          </div>
        </div>
        <div class="form-group">
          <input type="password" placeholder="Password" class="form-control" id="exampleInputPassword1">
        </div>
        <div align="center">
          <button class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
    <hr>
    <div class="container">
      <p>Layout yang akan direview !</p>
      <a href="Index.php"><button type="button" class="btn-primary">Halaman Awal</button></a>
      <a href="InputPo.php"><button type="button" class="btn-primary">Form Input PO</button></a>
      </div>
  </body>
</html>
