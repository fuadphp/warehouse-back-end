<?php 
include'header.php';
echo'<div class="container">';
$con=mysqli_connect('localhost','anbar','anbar12345','anbar');
$tarix=date('Y-m-d H:i:s');
if(isset($_POST['update']))
{
	$teyinat=trim($_POST['teyinat']);
	$teyinat=strip_tags($teyinat);
	$teyinat=htmlspecialchars($teyinat);
	$teyinat=mysqli_real_escape_string($con,$teyinat);
	$mebleg=trim($_POST['mebleg']);
	$mebleg=strip_tags($mebleg);
	$mebleg=htmlspecialchars($mebleg);
	$mebleg=mysqli_real_escape_string($con,$mebleg);
	if(!empty($teyinat) && !empty($mebleg))
	{
		$update=mysqli_query($con,"UPDATE xerc SET 
			teyinat='".$teyinat."',
			mebleg='".$mebleg."'");
		if($update==true)
			{echo'<div class="alert alert-success" role="alert">MELUMATLARINIZ UGURLA YENILENDI</div>';}
		else
			{echo'<div class="alert alert-danger" role="alert">Melumatlariniz yenilenmedi</div>';}
	}
	else
		{echo'<div class="alert alert-warning" role="alert">Zehmet olmasa melumatlari tam doldurun</div> ';}
}

if(!isset($_POST['edit']))
{
	echo'
<div class="alert alert-primary" role="alert">
<form method="post">
Teyinat:<br>
<input type="text" name="teyinat" class="form-control">
Mebleg:<br>
<input type="text" name="mebleg" class="form-control">
<button type="submit" name="d1" class="btn btn-primary btn-sm">Gonder</button><br>
</form>
</div>
';
}
if(isset($_POST['delete']))
{
	echo'
	<form method="post">
	Bunu silmek istediyinizden eminsinizmi?<br>
	<button type="submit" name="beli" class="btn btn-primary btn-sm" >beli</button>
	<button type="submit" name="xeyr" class="btn btn-secondary btn-sm"> xeyr</button>
	<input type="hidden" name="id" value="'.$_POST['id'].'">
	</form>';
}
if(isset($_POST['beli']))
{$sil=mysqli_query($con,"DELETE FROM xerc WHERE id='".$_POST['id']."'");
if($sil==true)
	{echo'<div class="alert alert-success" role="alert">Melumatiniz ugurla silindi</div>';}
else
	{echo'<div class="alert alert-danger" role="alert">Melumatiniz silinmedi</div>';}
}
if(isset($_POST['edit']))
{
	$ed=mysqli_query($con,"SELECT * FROM xerc WHERE id='".$_POST['id']."'");

	$info=mysqli_fetch_array($ed);
	echo'
	<div class="alert alert-primary" role="alert">
<form method="post">
Teyinat:<br>
<input type="text" name="teyinat" value="'.$info['teyinat'].'" class="form-control">
Mebleg:<br>
<input type="text" name="mebleg" value="'.$info['mebleg'].'" class="form-control">
<button type="submit" name="update"class="btn btn-primary btn-sm">Yenile</button>
</form method>
</div>
';
}




if(isset($_POST['d1']))
{
	$teyinat=trim($_POST['teyinat']);
	$teyinat=strip_tags($teyinat);
	$teyinat=htmlspecialchars($teyinat);
	$teyinat=mysqli_real_escape_string($con,$teyinat);
	$mebleg=trim($_POST['mebleg']);
	$mebleg=strip_tags($mebleg);
	$mebleg=htmlspecialchars($mebleg);
	$mebleg=mysqli_real_escape_string($con,$mebleg);

		if(!empty($teyinat) && !empty($mebleg))
	{
		$ins=mysqli_query($con,"INSERT INTO xerc(teyinat,mebleg,tarix) VALUES
			('".$teyinat."','".$mebleg."','".$tarix."')");
			if($ins==true)
				{echo'<div class="alert alert-success" role="alert">Melumatiniz Gonderildi</div>';}
			else
				{echo'<div class="alert alert-danger" role="alert">Melumatiniz Gonderilmedi</div>';}
	}
	else
		{echo'<div class="alert alert-warning" role="alert">Zehmet olmasa Melumatlari tam doldurun</div>';}
}




if(isset($_POST['axtar']) && !empty($_POST['sorgu']))
{
	$sorgu=trim($_POST['sorgu']);
	$sorgu=strip_tags($sorgu);
	$sorgu="WHERE (teyinat LIKE '%".$sorgu."%') ";


}
else
{$sorgu=' ';}


	$sec=mysqli_query($con,"SELECT * FROM xerc  ".$sorgu." ORDER BY id DESC ");
	$say=mysqli_num_rows($sec);
	echo'<div class="alert alert-primary">Sizin bazada <b>'.$say.' </b> melumatiniz var</div>';
	$i=0;
	echo'<table class="table">
	<thead>
	<th>#</th>
	<th>Teyinat</th>
	<th>Mebleg</th>
	<th>Tarix</th>
	</thead>
	<tbody>';
	while ($info=mysqli_fetch_array($sec))
	{
		$i++;
		echo'<tr>';
		echo'<td>'.$i.'</td><br>';
		echo'<td>'.$info['teyinat'].'';
		echo'<td>'.$info['mebleg'].'';
		echo'<td>'.$info['tarix'].'';
		echo'<td>
		<form method="post">
		<button type="submit" name="delete" class="btn btn-danger btn-sm"><i class="bi bi-x"></i></button>
		<button type="submit" name="edit" class="btn btn-warning btn-sm"><i class="bi bi-pen"></i></button>
		<input type="hidden" name="id" value="'.$info['id'].'">
		</form></td>';
	}
	echo'
	</table>
	</tbody>';
?>
</div>


