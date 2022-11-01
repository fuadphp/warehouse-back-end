<?php 
include'header.php';
echo'<div class="container">';
$tarix=date('Y-m-d H:i:s');




if(isset($_POST['edit']))
{
	$select=mysqli_query($con,"SELECT * FROM products WHERE id='".$_POST['id']."'");
	$info=mysqli_fetch_array($select);

	echo'
	<div class="alert alert-primary" role="alert">
	<form method="post" enctype="multipart/form-data">
	<select name="brand_id" class="form-control">
	<option value="">Brend Sechin</option>';

	$bsec=mysqli_query($con,"SELECT * FROM brands ORDER BY ad ASC");

	while($binfo=mysqli_fetch_array($bsec)) 
	{
		if($info['brand_id']==$binfo['id'])
		{echo'<option selected value="'.$binfo['id'].'">'.$binfo['ad'].'</option>';}
		else
		{echo'<option value="'.$binfo['id'].'">'.$binfo['ad'].'</option>';}
	}
echo'
</select>
Ad:<br>
<input type="text" name="ad" value="'.$info['ad'].'" class="form-control"><br>
Alish:<br>
<input type="text" name="alish" value="'.$info['alish'].'" class="form-control"><br>
Satish:<br>
<input type="text" name="satish" value="'.$info['satish'].'" class="form-control"><br>
Miqdar:<br>
<input type="text" name="miqdar" value="'.$info['miqdar'].'" class="form-control"><br>
Logo:<br><img style="width:70px; height:60px" src="'.$info['logo'].'"><br>
<input type="file" name="foto" class="form-control">
<input type="hidden" name="cari_foto" value="'.$info['logo'].'">
<input type="hidden" name="id" value="'.$info['id'].'">
<button type="submit" name="update" class="btn btn-primary btn-sm">Yenile</button>
</form>
</div>';

}
if(isset($_POST['update']))
{
	$brand_id=trim($_POST['brand_id']);
	$brand_id=strip_tags($brand_id);
	$brand_id=htmlspecialchars($brand_id);
	$brand_id=mysqli_real_escape_string($con,$brand_id);

	$ad=trim($_POST['ad']);
	$ad=strip_tags($ad);
	$ad=htmlspecialchars($ad);
	$ad=mysqli_real_escape_string($con,$ad);

	$alish=trim($_POST['alish']);
	$alish=strip_tags($alish);
	$alish=htmlspecialchars($alish);
	$alish=mysqli_real_escape_string($con,$alish);

	$satish=trim($_POST['satish']);
	$satish=strip_tags($satish);
	$satish=mysqli_real_escape_string($con,$satish);
	$satish=htmlspecialchars($satish);

	$miqdar=trim($_POST['miqdar']);
	$miqdar=strip_tags($miqdar);
	$miqdar=htmlspecialchars($miqdar);
	$miqdar=mysqli_real_escape_string($con,$miqdar);

	if(!empty($ad) && !empty($alish) && !empty($satish) && !empty($miqdar))

		{
			if($_FILES['foto']['size']<1024)
				{$unvan=$_POST['cari_foto'];}
			else
				
			include'upload.php';

			if(!isset($error))

		{
				$update=mysqli_query($con,"UPDATE products SET 
									brand_id='".$brand_id."',
									ad='".$ad."',
									alish='".$alish."',
									satish='".$satish."',
									miqdar='".$miqdar."',
									logo='".$unvan."'


									WHERE id='".$_POST['id']."' ");

				if($update==true)
					{echo'<div class="alert alert-success" role="alert">Melumatiniz Ugurla Yenilendi</div>';}
				else
					{echo'<div class="alert alert-danger" role="alert">Melumatiniz yenilenmedi</div>';}
		}
}
else
{echo'<div class="alert alert-warning" role="alert">Zehmet olmasa Melumatlari tam doldurun</div';}

}





if(isset($_POST['delete']))
{
	

	echo'<form method="post">
	Bunu silmek istediyinizden eminsinizmi?<br>
	<button type="submit" name="beli" class="btn btn-primary">beli</button>
	<input type="hidden" name="id" value="'.$_POST['id'].'">
	<button type="submit" name="xeyr" class="btn btn-secondary">xeyr</button>
	</form>';
	

}

if(isset($_POST['beli']))
		{
				$sil=mysqli_query($con,"DELETE FROM products WHERE id='".$_POST['id']."'");
				if($sil==true)
				{echo'<div class="alert alert-success" role="alert">Melumatiniz ugurla silindi</div>';}
				else
				{echo'<div class="alert alert-danger" role="alert">Melumatiniz silinmedi</div>';}

		}	



if(!isset($_POST['edit']))
{
	echo'
	<div class="alert alert-primary" role="alert">
<form method="post" enctype="multipart/form-data">
Brend:<br>
<select name="brand_id" class="form-control">
<option value="">Brend sechin</option>';



$select=mysqli_query($con,"SELECT * FROM brands ORDER BY ad ASC");


while($info=mysqli_fetch_array($select))
{
	echo'<option value="'.$info['id'].'">'.$info['ad'].'</option>';
}

echo'
</select>
Ad:<br>
<input type="text" name="ad" class="form-control">
Alish:<br>
<input type="text" name="alish" class="form-control">
Satish:<br>
<input type="text" name="satish" class="form-control">
Miqdar:<br>
<input type="text" name="miqdar" class="form-control">
Logo:<br>
<input type="file" name="foto"><br>
<button type="submit" name="d1" class="btn btn-primary btn-sm">Gonder</button>
</form>
</div>';
}
if(isset($_POST['d1']))
{
	$brand_id=trim($_POST['brand_id']);
	$brand_id=strip_tags($brand_id);
	$brand_id=htmlspecialchars($brand_id);
	$brand_id=mysqli_real_escape_string($con,$brand_id);

	$ad=trim($_POST['ad']);
	$ad=strip_tags($ad);
	$ad=htmlspecialchars($ad);
	$ad=mysqli_real_escape_string($con,$ad);

	$alish=trim($_POST['alish']);
	$alish=strip_tags($alish);
	$alish=htmlspecialchars($alish);
	$alish=mysqli_real_escape_string($con,$alish);

	$satish=trim($_POST['satish']);
	$satish=strip_tags($satish);
	$satish=mysqli_real_escape_string($con,$satish);
	$satish=htmlspecialchars($satish);

	$miqdar=trim($_POST['miqdar']);
	$miqdar=strip_tags($miqdar);
	$miqdar=htmlspecialchars($miqdar);
	$miqdar=mysqli_real_escape_string($con,$miqdar);

{
	if(!empty($ad) && !empty($alish) && !empty($satish) && !empty($miqdar))
	{
		include'upload.php';

		if(!isset($error))
		{
			$ins=mysqli_query($con, "INSERT INTO products(brand_id,ad,alish,satish,miqdar,tarix,logo) VALUES
			('".$brand_id."','".$ad."','".$alish."','".$satish."','".$miqdar."','".$tarix."','".$unvan."')");

			//echo mysqli_error($con);


				if($ins==true)
					{echo' <div class="alert alert-success" role="alert">Melumatiniz Gonderildi</div>';}
				else
					{echo'<div class="alert alert-danger" role="alert">Melumatiniz Gonderilmedi</div>';}
			}
		else
				{echo'<div class="alert alert-warning" role="alert">Zehmet olmasa Melumatlari Tam doldurun</div>';}
		}
}



}

if(isset($_POST['axtar']) && !empty($_POST['sorgu']))
{
	$sorgu=trim($_POST['sorgu']);
	$sorgu=strip_tags($sorgu);
	$sorgu=" AND (products.ad LIKE '%".$sorgu."%' OR brands.ad LIKE '%".$sorgu."%') ";

}
else
{$sorgu = '';}



			$select=mysqli_query($con,"SELECT 
							brands.ad AS brend,
							products.id,
							products.ad AS mehsul,
							products.alish,
							products.satish,
							products.miqdar,
							products.logo,
							products.tarix FROM brands,products 
							WHERE 
							brands.id=products.brand_id ".$sorgu." 
							ORDER BY products.id DESC ");




$say=mysqli_num_rows($select);

$bvibor=mysqli_query($con,"SELECT * FROM brands");
$bsay=mysqli_num_rows($bvibor);

$cvibor=mysqli_query($con,"SELECT * FROM clients");
$csay=mysqli_num_rows($cvibor);

$xvibor=mysqli_query($con,"SELECT * FROM xerc");
$xsay=mysqli_num_rows($xvibor);

$pvibor=mysqli_query($con,"SELECT * FROM products");
$psay=mysqli_num_rows($pvibor);

$ovibor=mysqli_query($con,"SELECT * FROM orders");
$osay=mysqli_num_rows($ovibor);

$vibor1=mysqli_query($con,"SELECT * FROM products");

$qazanc1 = 0;
while($info=mysqli_fetch_array($vibor1))
{
	$qazanc1=$qazanc1+(($info['satish']-$info['alish'])*$info['miqdar']);
}
$pvibor1=mysqli_query($con,"SELECT miqdar FROM products");

$miqdar1 = 0;
while($info=mysqli_fetch_array($pvibor1))
{
	$miqdar1=$miqdar1+$info['miqdar'];
}
$pvibor2=mysqli_query($con,"SELECT alish FROM products");
$alish1=0;
while($info=mysqli_fetch_array($pvibor2))
{
	$alish1=$alish1+$info['alish'];
}
$pvibor3=mysqli_query($con,"SELECT satish FROM products");
$satish1=0;
while($info=mysqli_fetch_array($pvibor3))
{
	$satish1=$satish1+$info['satish'];
}
$qvibor=mysqli_query($con,"SELECT * FROM products");
$qazanc1=0;
while ($info=mysqli_fetch_array($qvibor))
{
	$qazanc=($info['satish']-$info['alish'])*$info['miqdar'];
	$qazanc1=$qazanc1+$qazanc;
}
$xerc=mysqli_query($con,"SELECT SUM(mebleg) as txerc FROM xerc");
$xinfo=mysqli_fetch_array($xerc);

$txerc = $xinfo['txerc'];




echo'

<div class="alert alert-primary" role="alert">

<b>Mushteri: </b>'.$csay.' | 
<b>Brend: </b>'.$bsay.' | 
<b>Mehsul: </b>'.$psay.' | 
<b>Stok:</b>'.$miqdar1.' | 
<b>Alish:</b>'.$alish1.' | 
<b>Satish:</b>'.$satish1.' | 
<b>Xerc:</b>'.$txerc.' | 
<b>Sifarish:</b>'.$osay.' | 
<b>Qazanc:</b>'.$qazanc1.' | 
</div>


';


echo'<div class="alert alert-primary" role="alert">Sizin Bazada <b>'.$say.'</b> melumat var</div>';

$i=0;
echo'<table class="table">
<thead>
<th>#</th>
<th>logo</th>
<th>Brend</th>
<th>Ad</th>
<th>Alish</th>
<th>Satish</th>
<th>Miqdar</th>
<th>Qazanc</th>
<th>Tarix</th>
<th></th>
<tbody>
';

while ($info=mysqli_fetch_array($select))
{
	$qazanc=($info['satish']-$info['alish'])*$info['miqdar'];
	$i++;
	echo'<tr>';
	echo'<td>'.$i.'</td>';
	echo'<td><img style="width:70px; height:60px" src="'.$info['logo'].'"></td>';
	echo'<td>'.$info['brend'].'</td>';
	echo'<td>'.$info['mehsul'].'</td>';
	echo'<td>'.$info['alish'].'</td>';
	echo'<td>'.$info['satish'].'</td>';
	echo'<td>'.$info['miqdar'].'</td>';
	echo'<td>'.$qazanc.'</td>';
	echo'<td>'.$info['tarix'].'</td>';
	echo'
	<td>
	<form method="post">
	<button type="submit" name="delete" class="btn btn-danger btn-sm"><i class="bi bi-x"></i></button>
	<input type="hidden" name="id" value="'.$info['id'].'">
	<input type="hidden" name="ad" value="'.$info['brend'].'">
	<button type="submit" name="edit" class="btn btn-warning btn-sm" ><i class="bi bi-pen"></i></button>
	</form>
	</td>';
}


echo'</tbody>
</table>
</div>';

?>
