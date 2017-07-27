<?php  
	//var_dump($kajiUlang);die();
	$int = 500 + 500;
	$date = date('Y-m-d');
?>

<img src="/images/kwitansi.png" />
<DIV style="position: absolute; left:55px; right:55px; height:2000px; padding-right: 20px">
	<table style="font-size: 10pt" width=100% BORDER=0 BORDERCOLOR="#00000a" CELLPADDING=10 CELLSPACING=0 >
		<tr>
			<td vAlign="bottom" width=15% ROWSPAN=8>
				
			</td>
			<td vAlign="bottom" height=45 width=22%>
				No
			</td>
			<td vAlign="bottom" width=3%>:</td>
			<td vAlign="bottom" width=60%>
				<?= $kwitansi->no_kwitansi ?>
			</td>
		</tr>
		<tr>
			<td width=22%>
				Telah Terima Dari
			</td>
			<td width=3%>:</td>
			<td width=60%>
				<?= $model->nama_lengkap ?>
			</td>
		</tr>
		<tr>
			<td vAlign="top" height=50 width=22%>
				Uang Sejumlah
			</td>
			<td vAlign="top" width=3%>:</td>
			<td style="border: 1;" vAlign="top" align=center height=50 width=60%>
				#&nbsp;<?= $kwitansi->terbilang ?>&nbsp; rupiah # 
			</td>
		</tr>
		<tr>
			<td vAlign="top" width=22%>
				Untuk Pembayaran
			</td>
			<td vAlign="top" width=3%>:</td>
			<td vAlign="top" height=50 width=60%>
				Analisis&nbsp;
				<?php
					$sampelInvoice = \app\models\SampelInvoice::find()->where(['id_peneliti'=>$model->id])->asArray()->all();
					$invoiceUnique = \app\controllers\AnalysisRequestController::unique_multidim_array($sampelInvoice, 'analisis');
					foreach ($invoiceUnique as $idx => $invoiceItem) {
					  	if($idx!==0) echo ', ';
					  	echo $invoiceItem['analisis'];
					}  echo '.';
				?>
			</td>
		</tr>		
	</table>
	<table style="font-size: 10pt" width=100% BORDER=0 BORDERCOLOR="#00000a" CELLPADDING=10 CELLSPACING=0>
		<tr>
			<td vAlign="bottom" width=15% ROWSPAN=8>
					
			</td>
			<td vAlign="bottom" width=40%>
				
			</td>
			<td vAlign="bottom" width=15%>
				
			</td>
			<td vAlign="bottom" align=center width=30%>
				Bogor, <?= date('d-m-Y', strtotime($date)) ?>
			</td>
		</tr>
		<tr>
			<td style="border: 1;" align=center>
				<b>Rp <?= \Yii::$app->formatter->format($kwitansi->jumlah_biaya, ['decimal',0]); ?>, -</b>
			</td>			
			<td>
				
			</td>			
			<td>
				
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td>
				
			</td>			
			<td vAlign="bottom" height=45 align=center>
				<b>(Salina Febriany, M.Si)</b>
			</td>
		</tr>
	</table>
</DIV>