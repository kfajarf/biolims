<!DOCTYPE html>
<html>
<head>
</head>
<body>


<div class="row">
<table class="test" cellspacing="0" style="padding-right: 12; padding-left: 12" width="100%">
	<tr>
		<td width=13% align=center >
			<img src="/images/ipb.jpg" vAlign=center width=60 height=60>
		</td>
		<td width=76% align=center vAlign=center>
			<font style="font-size: 11"><b>Kementerian Riset, Teknologi dan Pendidikan Tinggi</b>
			<br>
			LABORATORIUM PUSAT STUDI BIOFARMAKA
			<br>
			LEMBAGA PENELITIAN DAN PENGABDIAN KEPADA MASYARAKAT - INSTITUT PERTANIAN BOGOR</font>
			<br>
			<font style="font-size: 8">Kampus IPB Taman Kencana, Jl. Taman Kencana No. 3, Bogor 16101, Jawa Barat
			Telp Telp 0251-8373561 Faks 0251-8347525 HP 0813 1195164 Email bfarmaka@gmail.com, Website www.biofarmaka.or.id</font>
		</td>
		<td width=13% align=center vAlign=center></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid black" height="15" colSpan=3>
			
		</td>
	</tr>
	<tr>
		<td align>
			
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
	</tr>
</table>
<table cellspacing="1" style="padding-right: 11; padding-left: 11" width="100%">
	<tr>
		<td align=center style="border-top: 1px solid black" colspan=10 height="30" vAlign=bottom> <b>INVOICE</b></td>
	</tr>
	<tr>
		<td height=12></td>
	</tr>
	<tr>
		<td align="right" style="width: 30%"><font style="font-size: 12">
			No
		</font></td>
		<td align="center" style="width: 5%"><font style="font-size: 12">
			:
		</font></td>
		<td align="left" style="width: 65%"><font style="font-size: 12">
			<?= $invoice->no_invoice ?>
		</font></td>
	</tr>
	<tr>
		<td align="right" style="width: 30%"><font style="font-size: 12">
			Nama
		</font></td>
		<td align="center" style="width: 5%"><font style="font-size: 12">
			:
		</font></td>
		<td align="left" style="width: 65%"><font style="font-size: 12">
			<?= $model->nama_lengkap ?>
		</font></td>
	</tr>
	<tr>
		<td align="right" style="width: 30%"><font style="font-size: 12">
			Instansi
		</font></td>
		<td align="center" style="width: 5%"><font style="font-size: 12">
			:
		</font></td>
		<td align="left" style="width: 65%"><font style="font-size: 12">
			<?= $model->institusi ?>
		</font></td>
	</tr>
	<tr>
		<td align="right" style="width: 30%"><font style="font-size: 12">
			Alamat
		</font></td>
		<td align="center" style="width: 5%"><font style="font-size: 12">
			:
		</font></td>
		<td align="left" style="width: 65%"><font style="font-size: 12">
			<?= $model->alamat_dan_no_telp_bogor ?>
		</font></td>
	</tr>
	<tr>
		<td align="right" style="width: 30%"><font style="font-size: 12">
			Tlp
		</font></td>
		<td align="center" style="width: 5%"><font style="font-size: 12">
			:
		</font></td>
		<td align="left" style="width: 65%"><font style="font-size: 12">
			<?= $model->no_handphone ?>
		</font></td>
	</tr>
	<tr>
		<td height=12></td>
	</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="1">
	<tr>
		<th height="30" align="center" align="center" style="width: 10%; border-top: 1px solid black; border-bottom: 1px solid black">
			<font style="font-size: 11">NO</font>
		</th>
		<th align="center" style="width: 30%; border-top: 1px solid black; border-bottom: 1px solid black">
			<font style="font-size: 11">SAMPEL</font>
		</th>
		<th align="center" style="width: 10%; border-top: 1px solid black; border-bottom: 1px solid black">
			<font style="font-size: 11">KODE</font>
		</th>
		<th align="center" style="width: 15%; border-top: 1px solid black; border-bottom: 1px solid black">
			<font style="font-size: 11">ANALISIS</font>
		</th>
		<th align="center" style="width: 5%; border-top: 1px solid black; border-bottom: 1px solid black">
			<font style="font-size: 11">JML</font>
		</th>
		<th align="center" style="width: 10%; border-top: 1px solid black; border-bottom: 1px solid black">
			<font style="font-size: 11">HARGA</font>
		</th>
		<th align="center" style="width: 20%; border-top: 1px solid black; border-bottom: 1px solid black">
			<font style="font-size: 11">JUMLAH HARGA</font>
		</th>
	<?php //////////SAMPEL SECTION///////
		foreach ($sampelInvoice as $idx => $sampelItem) {
			echo '<tr>
				<td height="25" align="center"><font style="font-size: 11">
					'.++$idx.'
				</font></td>
				<td align="center"><font style="font-size: 11">
					'.$sampelItem->sampel.'
				</font></td>
				<td align="center"><font style="font-size: 11">
					'.$sampelItem->kode.'
				</font></td>
				<td align="center"><font style="font-size: 11">
					'.$sampelItem->analisis.'
				</font></td>
				<td align="center"><font style="font-size: 11">
					'.$sampelItem->jumlah.'
				</font></td>
				<td align="right" style="padding-right: 15"><font style="font-size: 11">
					'.\Yii::$app->formatter->format($sampelItem->harga,(['decimal',0])).'
				</font></td>
				<td align="right" style="padding-right: 15"><font style="font-size: 11">
					'.\Yii::$app->formatter->format($sampelItem->jumlah*$sampelItem->harga,(['decimal',0])).'
				</font></td>
			</tr>';
		}
	?>
	<tr>
		<td height="30" colspan="5" style="border-top: 1px solid black; border-bottom: 1px solid black">
		</td>
		<th style="border-top: 1px solid black; border-bottom: 1px solid black">
			<font style="font-size: 11">Total</font>
		</th>
		<th align="right" style="border-top: 1px solid black; border-bottom: 1px solid black; padding-right: 15">
			<font style="font-size: 11"><?= \Yii::$app->formatter->format($invoice->total_biaya,(['decimal',0])) ?>	</font>
		</th>
	</tr>
	<tr>
		<td height="25" colspan="7" align="left" style=" border-bottom: 1px solid black; padding-left: 15">
			<font style="font-size: 11">Terbilang # <?= \Yii::$app->formatter->asSpellout($invoice->total_biaya) ?> rupiah #</font>
		</td>
	</tr>
	<tr>
		<td height="35">
			
		</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="6">
			<font style="font-size: 11">Bogor, <?= date('d-m-Y', strtotime($invoice->tanggal_penerbitan_invoice)) ?></font>
		</td>
	</tr>
	<tr>
		<td></td>
		<td colspan="6">
			<font style="font-size: 11">Lab Pusat Studi Biofarmaka,</font>
		</td>
	</tr>
	<tr>
		<td colspan="3"></td>
		<td>
			<font style="font-size: 11">Bank:</font>
		</td>
		<td colspan="3">
			<font style="font-size: 11">BNI Cab Bogor</font>
		</td>
	</tr>
	<tr>
		<td colspan="3"></td>
		<td>
			<font style="font-size: 11">No Rek:</font>
		</td>
		<td colspan="3">
			<font style="font-size: 11">0252 019457</font>
		</td>
	</tr>
	<tr>
		<td colspan="3"></td>
		<td>
			<font style="font-size: 11">Nama:</font>
		</td>
		<td colspan="3">
			<font style="font-size: 11">Pusat Studi Biofarmaka</font>
		</td>
	</tr>
	<tr><td colspan="7"></td></tr>
	<tr><td></td></tr>
	<tr>
		<td></td>
		<td colspan="6">
			<font style="font-size: 11"><b>Salina Febriany, M.Si</b></font>
		</td>
	</tr>
</table>
</div>

</body>
</html>