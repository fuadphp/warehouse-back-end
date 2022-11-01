<?php 
include'header.php';
echo'<div class="container">';
$tarix=date('Y-m-d H:i:s');


error_reporting(0);
if(isset($_POST['edit']))
{
	$select=mysqli_query($con,"SELECT * FROM brands  ORDER BY id DESC");
	$info=$info=mysqli_fetch_array($select);

	echo'
	<div class="alert alert-primary" role="alert">
<form method="post" enctype="multipart/form-data">
	Brend:<br>
	<input type="text" name="ad" value="'.$info['ad'].'" class="form-control">
	Logo:<br><img style="width:70px; height:60px" src="'.$info['logo'].'"><br>
	<input type="file" name="foto" class="form-control"><br>
	<input type="hidden" name="id" value="'.$info['id'].'">
	<input type="hidden" name="cari_foto" value="'.$info['logo'].'">
	<button type="submit" class="btn btn-success" name="update">Yenile</button>
</form>
</div>';
}

if(isset($_POST['update']))
{

	$ad=trim($_POST['ad']);
	$ad=strip_tags($ad);
	$ad=htmlspecialchars($ad);
	$ad=mysqli_real_escape_string($con,$ad);
	
	if(!empty($ad))
	{

		if($_FILES['foto']['size']<1024)
			{$unvan = $_POST['cari_foto'];}
		else
			{include"upload.php";}

		if(!isset($error))
		{
			$update=mysqli_query($con,"UPDATE brands SET 

			ad='".$ad."',
			logo='".$unvan."'
			WHERE id='".$_POST['id']."'");

			if($update==true)
			{echo'<div class="alert alert-success" role="alert">Məlumat uğurla yeniləndi</diV>';}
		}
	}
	else
	{echo'<div class="alert alert-warning" role="alert">Məlumatlar tam deyil</div>';}
}




if(!isset($_POST['edit']))
{
	echo'
	<div class="alert alert-primary" role="alert">
<form method="post" enctype="multipart/form-data">
	Brend:<br>
	<input type="text" class="form-control" name="ad"><br>
	Logo:<br>
	<input type="file" name="foto">
	<button type="submit" class="btn btn-primary btn-sm" name="d">Daxilet</button>
</form>
</div>';
}


if(isset($_POST['d']))
{
	$ad=trim($_POST['ad']);
	$ad=strip_tags($ad);
	$ad=htmlspecialchars($ad);
	$ad=mysqli_real_escape_string($con,$ad);

include'upload.php';

if(!isset($error))
{
	if(!empty($ad))
	{
		$ins=mysqli_query($con,"INSERT INTO brands(ad,logo,tarix,user_id)
		VALUES('".$ad."','".$unvan."','".$tarix."','".$_SESSION['user_id']."') ");

		if($ins==true)
			{echo'<div class="alert alert-success" role="alert">Melumatlariniz Ugurla gonderildi</div>';}
		else
		{echo'<div class="alert alert-danger" role="alert">Melumatlariniz gonderilmedi</div>';}
}
}
else
{echo'<div class="alert alert-warning" role="alert">Zehmet olmasa melumatlari tam doldurun!</div>';}

}



if(isset($_POST['sil']))
{
	$yoxla = mysqli_query($con,"SELECT brand_id FROM products WHERE brand_id='".$_POST['id']."'");

	if(mysqli_num_rows($yoxla)==0)
	{
		echo'
		<form method="post">
		Bunu silmek istediyinizden eminsinizmi?<br>
		<input type="hidden" name="id" value="'.$_POST['id'].'">
		<button type="submit" class="btn btn-info btn-sm" name="sil1">Beli</button>
		<button type="submit" class="btn btn-secondary btn-sm" name="silme">Xeyr</button>
		</form>';
	}
	else
	{echo'<div class="alert alert-warning" role="alert">Brendi silmek mumkun olmadi, brend aktiv mehsula malikdir.</div>';}
}
if(isset($_POST['sil1']))
{
	$sil=mysqli_query($con,"DELETE FROM brands WHERE id='".$_POST['id']."' ");
	if($sil==true)
		{echo'<div class="alert alert-success" role="alert">Melumatiniz Ugurla silindi</div><br>';}
	else
		{echo'<div class="alert alert-danger" role="alert">Melumatiniz Silinmedi</div><br>';}
}

//FILTERS START
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
//FILTERS END

//AXTAR START
if(isset($_POST['axtar']) && !empty($_POST['sorgu']))
{
	$sorgu=trim($_POST['sorgu']);
	$sorgu=strip_tags($sorgu);
	$sorgu="AND (ad LIKE '%".$sorgu."%') ";

}

//AXTAR END




$select=mysqli_query($con,"SELECT * FROM brands  WHERE user_id = '".$_SESSION['user_id']."'".$sorgu.$order);

$say=mysqli_num_rows($select);

echo'<div class="alert alert-primary" role="alert">Bazada <b>'.$say.'</b> məlumat var</div>';



echo'<table class="table id=cedvel">
		<thead>
		<th>#</th>
		<th>Logo'.$f1.'</th>
		<th>Brend'.$f1.'</th>
		<th>Tarix</th>
		<th></th>

		</thead>

		<tbody>';


for($i=1;$info=mysqli_fetch_array($select);$i++)
{
	
	echo'<tr>';
	echo'<td>'.$i.'</td>';
	echo'<td><img style="width:70px; height:60px" src="'.$info['logo'].'"></td>';
	echo'<td>'.$info['ad'].'</td>';
	echo'<td>'.$info['tarix'].'</td>';
	echo'
	<td>
<form method="post">
<input type="hidden" name="id" value="'.$info['id'].'">
<button type="submit" class="btn btn-danger btn-sm" name="sil" title="Sil"><i class="bi bi-x"></i></button>
<button type="submit" class="btn btn-success btn-sm" name="edit" title="Redaktə"><i class="bi bi-pen"></i></button>
</form>
</td>';

}

echo'
</tbody>
</table>';

?>