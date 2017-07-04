<?php 
	$kadaluarsa = date("Y-m-d");
	$warning = strtotime("+3 Months", strtotime($kadaluarsa));
	$today = strtotime(date('Y-m-d'));
	
	echo $kadaluarsa . "\n";
	echo $warning . "\n";
	echo $today . "\n";

	if($today >= $warning)
	{
	    echo 'PERINGATAN KADALUARSA';
	}
	else echo 'BELUM KADALUARSA';
?>