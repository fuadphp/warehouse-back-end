<?php
session_start();
if(!isset($_SESSION['email']) or !isset($_SESSION['parol']))
{echo'<meta http-equiv="refresh" content="0; URL=index.php"> '; exit;}
$con=mysqli_connect('localhost','anbar','anbar12345','anbar');


?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">



<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Anbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="profile.php">Profil</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="brands.php">Brend</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="clients.php">Müştəri</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="xerc.php">Xərc</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="products.php">Məhsul</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="orders.php">Sifariş</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="exit.php">Çıxış<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post">
      <input class="form-control mr-sm-2" name="sorgu" type="search" placeholder="Axtar" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="axtar">Axtar</button>&nbsp; 
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="hamisi">Hamisi</button>

    </form>
  </div>
</nav>

<br><br><br><br>