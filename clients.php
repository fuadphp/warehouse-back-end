<?php 

include'header.php';
echo'<div class="container">';
$tarix=date('Y-m-d H:i:s');


error_reporting(0);

if(isset($_POST['edit']))
{
	$ed=mysqli_query($con,"SELECT * FROM clients WHERE id='".$_POST['id']."'");
	$info=mysqli_fetch_array($ed);

	echo'
	<div class="alert alert-primary" role="alert">
	<form method="post" enctype="multipart/form-data">
	Ad:<br>
	<input type="text" name="ad" value="'.$info['ad'].'" class="form-control">
	Soyad:<br>
	<input type="text" name="soyad" value="'.$info['soyad'].'" class="form-control">
	Telefon:<br>
	<input type="text" name="telefon" value="'.$info['telefon'].'" class="form-control">
	Email:<br>
	<input type="text" name="email" value="'.$info['email'].'" class="form-control">
	Shirket:<br>
	<input type="text" name="shirket" value="'.$info['shirket'].'" class="form-control">
	Logo:<br><img style="width:70px; height:60px" src="'.$info['loqo'].'"><br>
	<input type="file" name="foto" class="form-control">
	<input type="hidden" name="cari_foto" value="'.$info['loqo'].'">
	<input type="hidden" name="id" value="'.$info['id'].'">
	<button type="submit" name="update" class="btn btn-primary btn-sm">Yenile</button>
	</form>
	</div>';
}

if(isset($_POST['update']))
{
	$ad=trim($_POST['ad']);
	$soyad=trim($_POST['soyad']);
	$telefon=trim($_POST['telefon']);
	$email=trim($_POST['email']);
	$shirket=trim($_POST['shirket']);
	$ad=strip_tags($ad);
	$soyad=strip_tags($soyad);
	$telefon=strip_tags($telefon);
	$email=strip_tags($email);
	$shirket=strip_tags($shirket);
	$ad=htmlspecialchars($ad);
	$soyad=htmlspecialchars($soyad);
	$telefon=htmlspecialchars($telefon);
	$email=htmlspecialchars($email);
	$shirket=htmlspecialchars($shirket);
	$ad=mysqli_real_escape_string($con,$ad);
	$soyad=mysqli_real_escape_string($con,$soyad);
	$telefon=mysqli_real_escape_string($con,$telefon);
	$email=mysqli_real_escape_string($con,$email);
	$shirket=mysqli_real_escape_string($con,$shirket);


	if(!empty($ad) && !empty($soyad) && !empty($telefon) && !empty($email) && !empty($shirket))

	{
		if($_FILES['foto']['size']<1024)
			{$unvan=$_POST['cari_foto'];}
		else
			{include"upload.php";}
		if(!isset($error))
		{
	$update=mysqli_query($con,"UPDATE clients SET 
			ad='".$ad."',
			soyad='".$soyad."',
			telefon='".$telefon."',
			email='".$email."',
			shirket='".$shirket."',
			loqo='".$unvan."'
			WHERE id='".$_POST['id']."'");

	if($update==true)
		{echo'<div class="alert alert-success" role="alert">Melumatiniz Ugurla yenilendi</div><br>';}
		}
	else
		{echo'<div class="alert alert-success" role="alert">Melumatiniz yenilenmedi</div>';}
	}
else
{echo'<div class="alert alert-warning" role="alert">Zehmet olmasa melumatlari tam doldurun</div><br>';}

}



if(isset($_POST['sil']))
{
	echo'<form method="post">
	Bunu silmek istediyinizden eminsinizmi?<br>
	<button type="submit" name="beli" class="btn btn-primary btn-sm">Beli</button>
	<button type="submit" name="xeyr" class="btn btn-secondary btn-sm">Xeyr</button>
	<input type="hidden" name="id" value="'.$_POST['id'].'">
	</form><br>';
}
if(isset($_POST['beli']))
{
	$sil=mysqli_query($con,"DELETE FROM clients WHERE id='".$_POST['id']."'");

	if($sil==true)
	{echo' <div class="alert alert-success" role="alert">Melumatiniz Ugurla silindi</div>';}
	else
	{echo'<div class="alert alert-danger" role="alert">Melumatiniz Silinmedi</div>';}
}

if(!isset($_POST['edit']))
{
	echo'
	<div class="alert alert-primary" role="alert">
	<form method="post" enctype="multipart/form-data">

	Ad:<br>
	<input type="text" name="ad" class="form-control">
	Soyad:<br>
	<input type="text" name="soyad" class="form-control">
	Telefon:<br>
	<input type="text" name="telefon" class="form-control">
	Email:<br>
	<input type="text" name="email" class="form-control">
	Shirket:<br>
	<input type="text" name="shirket" class="form-control">
	Logo:<br>
	<input type="file" name="foto"><br>
	<button type="submit" name="d" class="btn btn-primary btn-sm">gonder</button>
	</form>
	</div>';
}

if(isset($_POST['d']))
{
	$ad=trim($_POST['ad']);
	$soyad=trim($_POST['soyad']);
	$telefon=trim($_POST['telefon']);
	$email=trim($_POST['email']);
	$shirket=trim($_POST['shirket']);
	$ad=strip_tags($ad);
	$soyad=strip_tags($soyad);
	$telefon=strip_tags($telefon);
	$email=strip_tags($email);
	$shirket=strip_tags($shirket);
	$ad=htmlspecialchars($ad);
	$soyad=htmlspecialchars($soyad);
	$telefon=htmlspecialchars($telefon);
	$email=htmlspecialchars($email);
	$shirket=htmlspecialchars($shirket);
	$ad=mysqli_real_escape_string($con,$ad);
	$soyad=mysqli_real_escape_string($con,$soyad);
	$telefon=mysqli_real_escape_string($con,$telefon);
	$email=mysqli_real_escape_string($con,$email);
	$shirket=mysqli_real_escape_string($con,$shirket);
	include'upload.php';
	if(!isset($error))
	{

	if(!empty($ad) && !empty($soyad) && !empty($telefon) && !empty($email) && !empty($shirket))
	{
		$ins=mysqli_query($con,"INSERT INTO clients(ad,soyad,telefon,email,shirket,loqo,tarix)
		VALUES ('".$ad."','".$soyad."','".$telefon."','".$email."','".$shirket."','".$unvan."','".$tarix."')");

		if($ins=true)
			{echo'<div class="alert alert-success" role="alert">Melumatiniz Gonderildi</div><br>';}
		else
			{echo'<div class="alert alert-danger" role="alert">Melumatiniz Gonderilmedi</div><br>';}
	}
	}
	else
		{echo'<div class="alert alert-warning" role="alert">Zehmet olmasa Melumatlari Tam doldurun</div>';}
}

if($_GET['f1']=='ASC')
{
	
	$order='ORDER BY ad ASC';
	$f1='<a href="?f1=DESC#cedvel"><i class="bi bi-sort-alpha-down-alt"></i></a>';
}
elseif($_GET['f1']=='DESC')
{
	$order='ORDER BY ad DESC';
	$f1='<a href="?f1=ASC#cedvel"><i class="bi bi-sort-alpha-down"></i></a>';
}
else
{
	$f1='<a href="?f1=ASC#cedvel"><i class="bi bi-sort-alpha-down"></i></a>';
}
if(!isset($_GET['f1']))
{$order='ORDER BY id DESC';}

if(isset($_POST['axtar']) && !empty($_POST['sorgu']))
{
	$sorgu=trim($_POST['sorgu']);
	$sorgu=strip_tags($sorgu);
	$sorgu="WHERE (ad LIKE '%".$sorgu."%') ";
}



$select=mysqli_query($con,"SELECT * FROM clients ".$sorgu.$order);

$say=mysqli_num_rows($select);

echo'<div class="alert alert-primary" role="alert">Sizin Bazada <b>'.$say.'</b> məlumat var</div> <br>';

$i=0;
echo'<table class="table id=cedvel">
<thead>
<th>#</th>
<th>logo</th>
<th>ad'.$f1.'</th>
<th>soyad'.$f1.'</th>
<th>telefon</th>
<th>shirket'.$f1.'</th>
<th>email</th>
<th>tarix</th>
<th></th>
<tbody>
';

while ($info=mysqli_fetch_array($select))
{
	$i++;
	echo'<tr>';
	echo'<td>'.$i.'</td>';
	echo'<td><img style="width:65px; height:45px;" src="'.$info['loqo'].'"></td>';
	echo'<td>'.$info['ad'].'</td>';
	echo'<td>'.$info['soyad'].'</td>';
	echo'<td>'.$info['telefon'].'</td>';
	echo'<td>'.$info['shirket'].'</td>';
	echo'<td>'.$info['email'].'</td>';
	echo'<td>'.$info['tarix'].'</td>';
	echo'
	<td>
	<form method="post">
	<button type="submit" class="btn btn-danger btn-sm"  name="sil"><i class="bi bi-x"></i></button>
	<input type="hidden" name="id" value="'.$info['id'].'">
	<button type="submit" class="btn btn-success btn-sm" name="edit"><i class="bi bi-pen"></i></button>
	</form>
	</td>';

}
echo'</table>
</tbody></div>';

?>
