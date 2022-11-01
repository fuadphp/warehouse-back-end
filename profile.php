<?php
session_start();
include'header.php'; 

$con=mysqli_connect('localhost','anbar','anbar12345','anbar');
$tarix=date('Y-m-d H:i:s');
error_reporting(0);


echo'
<form method="post" enctype="multipart/form-data">
<div class="alert alert-primary" role="alert">
Ad:<br>
<input type="text" name="ad" class="form-control" value="'.$_SESSION['ad'].'"><br>
Soyad:<br>
<input type="text" name="soyad" class="form-control" value="'.$_SESSION['soyad'].'"><br>
Email:<br>
<input type="text" name="email" class="form-control" value="'.$_SESSION['email'].'"><br>
Telefon:<br>
<input type="text" name="telefon" class="form-control" value="'.$_SESSION['telefon'].'"><br>
Şəkil:<br><img style="width:70px; height:60px" src="'.$_SESSION['loqo'].'"><br>
<input type="file" name="foto" class="form-control" >
Parol:<br>
<input type="password" name="parol" class="form-control" value="'.$_SESSION['parol'].'"><br>
Təkrar Parol:<br>
<input type="password" name="tparol" class="form-control" value="'.$_SESSION['parol'].'"><br>

<button type="submit" name="d" class="btn btn-primary btn-sm">Yenilə</button>
<input type="hidden" name="cari_foto" value="'.$_SESSION['loqo'].'">
</div>


</form>
';


if(isset($_POST['d']))
{
	$ad=trim($_POST['ad']);
	$ad=strip_tags($ad);
	$ad=htmlspecialchars($ad);
	$ad=mysqli_real_escape_string($con,$ad);

	$soyad=trim($_POST['soyad']);
	$soyad=strip_tags($soyad);
	$soyad=htmlspecialchars($soyad);
	$soyad=mysqli_real_escape_string($con,$soyad);

	$telefon=trim($_POST['telefon']);
	$telefon=strip_tags($telefon);
	$telefon=htmlspecialchars($telefon);
	$telefon=mysqli_real_escape_string($con,$telefon);

	$email=trim($_POST['email']);
	$email=strip_tags($email);
	$email=mysqli_real_escape_string($con,$email);
	$email=htmlspecialchars($email);

	$parol=trim($_POST['parol']);
	$parol=strip_tags($parol);
	$parol=htmlspecialchars($parol);
	$parol=mysqli_real_escape_string($con,$parol);

	$tparol=trim($_POST['tparol']);
	$tparol=strip_tags($parol);
	$tparol=htmlspecialchars($parol);
	$tparol=mysqli_real_escape_string($con,$parol);
	

if(!empty($ad) && !empty($soyad) && !empty($email) && !empty($telefon) && !empty($parol) && !empty($tparol))
{	

	if($_FILES['foto']['size']<1024)
			{$unvan=$_POST['cari_foto'];}
		else
			{include"upload.php";}

		if(!isset($error))
		{
	$update=mysqli_query($con,"UPDATE users SET 
		ad='".$ad."',
		soyad='".$soyad."',
		telefon='".$telefon."',
		email='".$email."',
		loqo='".$unvan."',
		parol='".$parol."' WHERE id='".$_SESSION['user_id']."'
		" );


	if($update==true)
	{echo'<div class="alert alert-success" role="alert">Melumatiniz Uğurla yeniləndi</div><br>
';
$_SESSION['ad']=$ad;
$_SESSION['soyad']=$soyad;
$_SESSION['telefon']=$telefon;
$_SESSION['email']=$email;
$_SESSION['loqo']=$unvan;
$_SESSION['parol']=$parol;
echo'<meta http-equiv="refresh" content="2; URL = profile.php">';

}

}
	else
		{echo'<div class="alert alert-danger" role="alert">Melumatiniz Yenilənmedi</div><br>';}

}
else
{echo'<div class="alert alert-warning" role="alert">Zəhmət olmasa məlumatları tam doldurun</div><br>';}
}





?>

