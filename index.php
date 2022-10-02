<?php
include'functions.php';
if(empty($_SESSION['login']))
  header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link rel="icon" href="favicon.png"/>

  <title>SPK VIKOR</title>
  <link href="assets/css/solar-bootstrap.min.css" rel="stylesheet"/>
  <link href="assets/css/general.css" rel="stylesheet"/>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>    
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?">VIKOR</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="?m=kriteria"><span class="glyphicon glyphicon-th"></span> Kriteria</a></li>
                <li>
                    <a href="#" class="dropdown" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> Alternatif<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="?m=alternatif">Alternatif</a></li>
                        <li><a href="?m=rel_alternatif"> Nilai Alternatif</a></li>
                    </ul>
                </li>
                <li><a href="?m=hitung"><span class="glyphicon glyphicon-signal"></span> Hitung</a></li>       
                <li><a href="?m=password"><span class="glyphicon glyphicon-lock"></span> Password</a></li>          
                <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>                   
            </ul>          
        </div>
    </div>
</nav>
<div class="container">
    <?php
    if(file_exists($mod.'.php'))
    include $mod.'.php';
    else
    include 'home.php';
    ?>
</div>
<footer class="footer bg-primary">
  <div class="container">
    <p>Copyright &copy; <?=date('Y')?> Topical Konveksi <em class="pull-right">Oktober 2020</em></p>
  </div>
</footer>
</body>
</html>