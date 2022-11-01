<?php

include 'header.php';
$con=mysqli_connect('localhost','anbar','anbar12345','anbar');
$tarix=date('Y-m-d H:i:s');
error_reporting(0);




	echo'<div class="container">';


	if(isset($_POST['delete']))
{
	echo'<form method="post">
	Bunu silmek istediyinzden eminsiniz?<br>
	<button type="submit" class="btn btn-info btn-sm" name="sil1">Beli</button>
		<button type="submit" class="btn btn-secondary btn-sm" name="silme">Xeyr</button>
	<input type="hidden" name="id" value="'.$_POST['id'].'">
	</form>
	';
}

	if(isset($_POST['sil1']))
	{
	$sil=mysqli_query($con,"DELETE FROM orders WHERE id='".$_POST['id']."'");
				if($sil==true)
				{echo'<div class="alert alert-success" role="alert">Melumatiniz ugurla silindi</div>';}
				else
				{echo'<div class="alert alert-danger" role="alert">Melumatiniz silinmedi</div>';}
		}




if(!isset($_POST['edit']))
	{

		echo'
		<div class="alert alert-primary" role="alert">

<form method="post">
	Mushteri:<br>
	<select name="client_id" class="form-control">
	<option value="">Mushteri secin</option>
	';

	$csec=mysqli_query($con,"SELECT * FROM clients ORDER BY ad ASC");
	
	while($cinfo=mysqli_fetch_array($csec)) 
	{
		echo'<option value="'.$cinfo['id'].'">'.$cinfo['ad'].' '.$cinfo['soyad'].'</option>';
	}
	echo'

	
		
	</select>
	<br>
	Mehsul:<br>
	<select name="product_id" class="form-control">
		<option value="">Mehsul secin</option>
		';
		$psec=mysqli_query($con,"SELECT 
							brands.ad AS brend,
							products.id,
							products.ad AS mehsul,
							products.miqdar
							FROM brands,products 
							WHERE 
							brands.id=products.brand_id 
							ORDER BY brands.ad ASC");

		while ($pinfo=mysqli_fetch_array($psec))
		{
		echo'<option value="'.$pinfo['id'].'">'.$pinfo['brend'].' - '.$pinfo['mehsul'].' ['.$pinfo['miqdar'].']</option>';
		}
		echo'
		
	</select>
	<br>
	Miqdar:<br>
	<input type="text" name="miqdar" class="form-control"><br>
	<button type="submit" class="btn btn-primary btn-sm" name="d">Daxilet</button>
</form> </div>';
}

//print_r($_POST);
if(isset($_POST['edit']))
{
	$select=mysqli_query($con,"SELECT * FROM orders WHERE id='".$_POST['id']."'");
	$info=mysqli_fetch_array($select);
	
	echo'
	<div class="alert alert-primary" role="alert">
	<form method="post" enctype="multipart/form-data">
	Mushteri:
	<select name="client_id" class="form-control">

	<option value="">Mushteri Sechin</option>
	';

	$csec=mysqli_query($con,"SELECT * FROM clients ORDER BY ad ASC");
	while ($cinfo=mysqli_fetch_array($csec))
	{
	if($info['client_id']==$cinfo['id'])
		{echo'<option selected value="'.$cinfo['id'].'">'.$cinfo['ad'].' '.$cinfo['soyad'].'</option>';}
		else
		{echo'<option value="'.$cinfo['id'].'">'.$cinfo['ad'].' '.$cinfo['soyad'].'</option>';}

	}
	echo'
	</select>

Mehsul:
<select name="product_id" class="form-control">
<option value="">Mehsul sechin</option>

	</div>
	';
	$psec=mysqli_query($con,"SELECT products.id,
									brands.ad AS brend,
									products.ad AS mehsul,
									products.miqdar 
									FROM products,brands WHERE brands.id=products.brand_id ORDER BY products.ad ASC");

	while($pinfo=mysqli_fetch_array($psec))
	{
		if($info['product_id']==$pinfo['id'])
			{echo'<option selected value="'.$pinfo['id'].'">'.$pinfo['brend'].'-'.$pinfo['mehsul'].'-'.$pinfo['miqdar'].' </option>';}
		else
			{echo'<option value="'.$pinfo['id'].'">'.$pinfo['brend'].'-'.$pinfo['mehsul'].'-'.$pinfo['miqdar'].' </option>';}
	}
echo'</select>
Miqdar:<br>
<input type="text" class="form-control" name="miqdar" value="'.$info['miqdar'].'" autocomplete="of"><br>
<button type="submit" name="update" class="btn btn-primary" btn-sm>Yenilə</button>
<button type="submit" name="cancel" class="btn btn-danger btn-sm">Ləğv et </button>
<input type="hidden" name="id" value="'.$_POST['id'].'">
</form>
</div>

';

}
if(isset($_POST['update']))
{
	$miqdar=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['miqdar']))));
	$client_id=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['client_id']))));
	$product_id=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['product_id']))));
	if(!empty($client_id) && !empty($product_id) && !empty($miqdar))
	{
		$update = mysqli_query($con,"UPDATE orders SET
			product_id='".$product_id."',
			client_id='".$client_id."',
			miqdar='".$miqdar."'
			WHERE id='".$_POST['id']."'");
				if($update==true)
					{echo'<div class="alert alert-success" role="alert">Melumatiniz Ugurla Yenilendi</div>';}
				else
					{echo'<div class="alert alert-danger" role="alert">Melumatiniz yenilenmedi</div>';}
	}
	else
{echo'<div class="alert alert-warning" role="alert">Zehmet olmasa Melumatlari tam doldurun</div';}
}

if(isset($_POST['d']))
{

	$miqdar=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['miqdar']))));
	$client_id=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['client_id']))));
	$product_id=mysqli_real_escape_string($con,htmlspecialchars(strip_tags(trim($_POST['product_id']))));

	if(!empty($client_id) && !empty($product_id) && !empty($miqdar))
{

	$ins=mysqli_query($con,"INSERT INTO orders(client_id,product_id,miqdar,tarix)
	 VALUES ('".$client_id."','".$product_id."','".$miqdar."','".$tarix."')");

		if($ins==true)
			{echo'<div class="alert alert-success" role="alert">Melumatiniz ugurla gonderildi</div>';}
		else
			{echo'<div class="alert alert-danger" role="alert">Melumatiniz gonderilmedi</div>';}
}
else
{echo'<div class="alert alert-warning" role="alert">Zehmet olmasa melumatlari tam doldurun</div>';}

}


	//tesdiq---------

	if(isset($_POST['tesdiq']))
	{
		if($_POST['order']<=$_POST['stok'])
		{
			$pupdate=mysqli_query($con,"UPDATE products SET miqdar=miqdar-".$_POST['order']." WHERE id='".$_POST['pid']."'");
			if($pupdate==true)
				{
					$oupdate=mysqli_query($con,"UPDATE orders SET tesdiq=1 WHERE id='".$_POST['id']."'");
					if($oupdate==true)
					{
						echo'<div class="alert alert-warning" role="alert">Sifarish ugurla tesdiq edildi</div>';
					}
					else
					{
						$pupdate=mysqli_query($con,"UPDATE products SET miqdar=miqdar+".$_POST['order']." WHERE id='".$_POST['pid']."'");
						echo'<div class="alert alert-warning" role="alert">Sifarishi tesdiq etmek mumkun olmadi</div>';

					}
				
				}

		}
		else
			{echo '<div class="alert alert-warning" role="alert">Sifarisi tesdiq etmek ucun anbarda kifayet qeder mehsul yoxdur</div>';}
	}

if(isset($_POST['legv']))
	{
		
			$pupdate=mysqli_query($con,"UPDATE products SET miqdar=miqdar+".$_POST['order']." WHERE id='".$_POST['pid']."'");
			if($pupdate==true)
				{
					$oupdate=mysqli_query($con,"UPDATE orders SET tesdiq=0 WHERE id='".$_POST['id']."'");
					if($oupdate==true)
					{
						echo'<div class="alert alert-warning" role="alert">Sifarish ugurla legv edildi</div>';
					}
					else
					{
						$pupdate=mysqli_query($con,"UPDATE products SET miqdar=miqdar-".$_POST['order']." WHERE id='".$_POST['pid']."'");
						echo'<div class="alert alert-warning" role="alert">Sifarishi legv etmek mumkun olmadi</div>';

				}	}
	}

				
				

$select=mysqli_query($con,"SELECT  
							clients.ad AS mushteri,
							clients.soyad,
							brands.ad AS brend,
							products.id AS pid,
							products.ad AS mehsul,
							products.miqdar AS stok,
							products.alish,
							products.satish,
							orders.id,
							orders.product_id,
							orders.miqdar AS amount,
							orders.tesdiq,
							orders.tarix
							FROM clients,products,brands,orders
							WHERE 
							brands.id=products.brand_id AND 
							clients.id=orders.client_id AND 
							products.id=orders.product_id    
							ORDER BY orders.id DESC");

$say=mysqli_num_rows($select);

echo'<div class="alert alert-primary" role="alert">Sizin Bazada '.$say.' Melumat var</div>';
$i=0;

echo'<table class="table">

			<thead>
			<th>#</th>
			<th>Mushteri</th>
			<th>Brend</th>
			<th>Mehsul</th>
			<th>Alish</th>
			<th>Satish</th>
			<th>Stok</th>
			<th>Miqdar</th>
			<th>Qazanc</th>
			<th>Tarix</th>
			<th></th>
			<tbody>';



while ($info=mysqli_fetch_array($select))
{
	$qazanc=($info['satish']-$info['alish'])*$info['amount'];
	$i++;
	echo'<tr>';
	echo'<td>'.$i.'</td>';
	echo'<td>'.$info['mushteri'].'</td>';
	echo'<td>'.$info['brend'].'</td>';
	echo'<td>'.$info['mehsul'].'</td>';
	echo'<td>'.$info['alish'].'</td>';
	echo'<td>'.$info['satish'].'</td>';	
	echo'<td>'.$info['stok'].'</td>';
	echo'<td>'.$info['amount'].'</td>';
	echo'<td>'.$qazanc.'</td>';
	echo'<td>'.$info['tarix'].'</td>';
	echo'<td>
	<form method="post">
	<input type="hidden" name="id" value="'.$info['id'].'">
	<input type="hidden" name="pid" value="'.$info['product_id'].'">
	<input type="hidden" name="stok" value="'.$info['stok'].'">
	<input type="hidden" name="order" value="'.$info['amount'].'">
	';

	if($info['tesdiq']==0)
	{
		echo'
		<button type="submit" name="delete" class="btn btn-danger btn-sm" title="Sil"><i class="bi bi-x"></i></button>
		<button type="submit" name="edit" class="btn btn-warning btn-sm" title="Redaktə et"><i class="bi bi-pen"></i></button>
		<button type="submit" name="tesdiq" class="btn btn-success btn-sm" title="Təsdiq et"><i class="bi bi-check"></i></button>
		';
	}
	else
	{
		echo'
		<button type="submit" name="legv" class="btn btn-danger btn-sm" title="Legv et"><i class="bi bi-x"></i></button>';
	}
	echo'</form></td>';
	

}




echo'</tbody>';
echo'</table>';
echo'</div>';
?>








