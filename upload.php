<?php 

//images/foto.jpg
$unvan='images/'.basename($_FILES['foto']['name']);

//jpeg/png/jpg/JPG/Jpeg


$tip=strtolower(pathinfo($unvan,PATHINFO_EXTENSION));


if($tip!='jpeg' && $tip!='jpg' && $tip!='png' && $tip!='GIF')
	{$error='<div class="alert alert-warning" role="alert">Yalniz <b> jpeg,jpg,png,GIF </b> fayl formatlarina icaze verilir!</div>';}

if($_FILES['foto']['size']>5242880)

	{
		$error='<div class="alert alert-danger" role="alert">Maksimum <b>5MB</b> fayl hecmine icaze verilir</div>';
	}

if(!isset($error))
{
	$unvan='images/'.time().'.'.$tip;

	move_uploaded_file($_FILES['foto']['tmp_name'],$unvan);
}
else
	{echo $error;}




?>