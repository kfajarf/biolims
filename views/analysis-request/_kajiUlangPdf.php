<?php  
	//var_dump($kajiUlang);die();
	$int = 500 + 500;
	$date = date('Y-m-d');
?>
<CENTER>
	<TABLE ALIGN="Center" WIDTH=879 BORDER=1 BORDERCOLOR="#00000a" CELLPADDING=5 CELLSPACING=1>
		<TR>
			<TD ROWSPAN=3 WIDTH=110 HEIGHT=20 HALIGN=CENTER>
				<P CLASS="western"><IMG SRC="/images/ipb.jpg" VALIGN=CENTER HSPACE=15 WIDTH=100 HEIGHT=100 BORDER=0><BR>
				</P>
			</TD>
			<TD WIDTH=389>
				<P CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">LABORATORIUM</FONT></FONT></P>
				<P CLASS="western" ALIGN=CENTER STYLE="margin-bottom: 0in"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">PUSAT
				STUDI BIOFARMAKA</FONT></FONT></P>
				<P CLASS="western" ALIGN=CENTER><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">LPPM-IPB</FONT></FONT></P>
			</TD>
			<TD WIDTH=159 VALIGN=TOP>
				<P CLASS="western" STYLE="margin-bottom: 0in"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">Nomor</FONT></FONT></P>
				<P CLASS="western" STYLE="margin-bottom: 0in"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">Edisi/Revisi</FONT></FONT></P>
				<P CLASS="western" STYLE="margin-bottom: 0in"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">Terbitan/tgl
				Revisi/tgl</FONT></FONT><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">
				</FONT></FONT>
				</P>
				<P CLASS="western"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">Halaman</FONT></FONT></P>
			</TD>
			<TD WIDTH=157 VALIGN=TOP>
				<P CLASS="western" STYLE="margin-bottom: 0in"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">:
				LPSB IPB-I</FONT></FONT><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt"><SPAN LANG="id-ID">V</SPAN></FONT></FONT><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">.</FONT></FONT><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt"><SPAN LANG="id-ID">4.2</SPAN></FONT></FONT></P>
				<P CLASS="western" STYLE="margin-bottom: 0in"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">:
				</FONT></FONT><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">2</FONT></FONT><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">/0</FONT></FONT></P>
				<P CLASS="western" STYLE="margin-bottom: 0in"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">:
				11 Juli 2014</FONT></FONT></P>
				<P CLASS="western" STYLE="margin-bottom: 0in"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">:
				</FONT></FONT><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">_ dari _</FONT></FONT></P>
				
			</TD>
		</TR>
		<TR VALIGN=TOP>
			<TD WIDTH=389 ALIGN=CENTER>
				<P CLASS="western"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt"><SPAN LANG="id-ID"><B>FORMULIR</B></SPAN></FONT></FONT><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt"><B>
				MUTU</B></FONT></FONT></P>
			</TD>
			<TD ROWSPAN=2 WIDTH=159>
				<P CLASS="western"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">Disetujui
				Manajer Mutu</FONT></FONT></P>
			</TD>
			<TD ROWSPAN=2 WIDTH=157>
				<P CLASS="western"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">:</FONT></FONT></P>
			</TD>
		</TR>
		<TR>
			<TD WIDTH=389 VALIGN=TOP ALIGN=CENTER>
				<P CLASS="western" ><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 12pt">KAJI ULANG PERMINTAAN, TENDER DAN KONTRAK</FONT></FONT></P>
			</TD>
		</TR>
	</TABLE>
</CENTER>
<br/>
<div>

<div style="height: 180px">
	<table width=100% BORDER=0 BORDERCOLOR="#00000a" CELLPADDING=2 CELLSPACING=6>
	<tr>
		<td width="40%">
			LPSB Order No
		</td>
		<td width="60%">
			: <?= $model->lpsb_order_no ?>
		</td>
	</tr>
	<tr>
		<td width="40%">
			Nama Pelanggan
		</td>
		<td width="60%">
			: <?= $pemohon->nama_lengkap ?>
		</td>
	</tr>
	<tr>
		<td height="50" valign="top" width="40%">
			Alamat Lengkap
		</td>
		<td valign="top" width="60%">
			: <?= $pemohon->alamat ?>
		</td>
	</tr>
	<tr>
		<td width="40%">
			Tanggal Barang Diterima di Laboratorium
		</td>
		<td width="60%">
			: <?= date('d-m-Y', strtotime($model->tanggal_diterima)) ?>
		</td>
	</tr>
	<tr>
		<td width="40%">
			Tanggal Prakiraan Selesai Pengujian
		</td>
		<td width="60%">
			: 
		</td>
	</tr>
	</table>
</div>

<div style="height: 500px">
	<table width=100% BORDER=1 BORDERCOLOR="#00000a" CELLPADDING=2 CELLSPACING=0>
		<tr>
			<td ROWSPAN=2 width=17%> <b>
				<b>Parameter Yang<br>Diuji</b>
			</b></td>
			<td colspan="5" align="center"> <b>
				Kaji Ulang Kompetensi Sumber Daya Laboratorium
			</b></td>
			<td ROWSPAN=2 align="center"> <b>
				Kesimpulan
			</b></td>
		</tr>
		<tr>
			<td align=center width="10%">
				Metode 
			</td>
			<td align=center width="10%">
				Peralatan
			</td>
			<td align=center width="10%">
				Personel
			</td>
			<td align=center width="10%">
				Bahan Kimia
			</td>
			<td align=center width="12%">
				Kondisi Akomodasi
			</td>		
		</tr>
		<?php
			// foreach ($kajiUlang as $idx => $kajiUlangItem)
			for($idx=0; $idx<18; $idx++)
			{
				$isDataExist = array_key_exists($idx,$kajiUlang);
				if($isDataExist)
				{
					$val1 = $kajiUlang[$idx]['metode'];
					$val2 = $kajiUlang[$idx]['peralatan'];  
					$val3 = $kajiUlang[$idx]['personel'];
					$val4 = $kajiUlang[$idx]['bahan_kimia'];  
					$val5 = $kajiUlang[$idx]['kondisi_akomodasi']; 
					$kesimpulan = ($val1 && $val2 && $val3 && $val4 && $val5);
					echo 
					"
						<tr>
							<td> <font size=2>
								".$kajiUlang[$idx]['parameter']."
							</font></td>
							<td align=center> <font size=2>
								".($kajiUlang[$idx]['metode'] ? '&#10004;' : '&minus;')."
							</font></td>
							<td align=center> <font size=2>
								".($kajiUlang[$idx]['peralatan'] ? '&#10004;' : '&minus;')."
							</font></td>
							<td align=center> <font size=2>
								".($kajiUlang[$idx]['personel'] ? '&#10004;' : '&minus;')."
							</font></td>
							<td align=center> <font size=2>
								".($kajiUlang[$idx]['bahan_kimia'] ? '&#10004;' : '&minus;')."
							</font></td>
							<td align=center> <font size=2>
								".($kajiUlang[$idx]['kondisi_akomodasi'] ? '&#10004;' : '&minus;')."
							</font></td>
							<td> <font size=2>
								".($kesimpulan ? 'OK' : 'Subkontrak')."
							</font></td>
						</tr>

					";
				} else {
					echo "
						<tr>
							<td> <font size=2>
								&nbsp;
							</font> </td>
							<td> <font size=2>
								&nbsp;
							</font> </td>
							<td> <font size=2>
								&nbsp;
							</font> </td>
							<td> <font size=2>
								&nbsp;
							</font> </td>
							<td> <font size=2>
								&nbsp;
							</font> </td>
							<td> <font size=2>
								&nbsp;
							</font> </td>
							<td> <font size=2>
								&nbsp;
							</font> </td>
						</tr>
					";
				}
			}

		?>
		<div style="height: 450px">
			<tr>
				<td HEIGHT=50 valign="top" COLSPAN=7>
					<b> <font size=2>Catatan: 
					</font></b>
				</td>
			</tr>
		</div>
	</table>
</div>

<div>
	<table width="100%">
		<tr>
			<div>
			<td align="left">
				<FONT FACE="Tahoma, serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manajer Teknis<br><br><br><br><br><br>(……………………………………)<br></FONT>
			</td>
			</div>
			<div>
			<td align="right">
				<FONT FACE="Tahoma, serif">Manajer Administrasi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br><br><br><br><br>(……………………………………)<br></FONT>
			</td>
			</div>
		</tr>
	</table>
</div>

		
			<!-- <P CLASS="western" STYLE="margin-bottom: 0in; line-height: 150%"><FONT FACE="Tahoma, serif"><FONT SIZE=2>Keterangan:</FONT></FONT></P>
			<P CLASS="western" STYLE="margin-left: 0.5in; margin-bottom: 0in"><FONT FACE="Tahoma, serif"><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;Lembar 1: untuk yang menerima</FONT></FONT></P>
			<P CLASS="western" STYLE="margin-left: 0.5in; margin-bottom: 0in"><FONT FACE="Tahoma, serif"><FONT SIZE=2>&nbsp;&nbsp;&nbsp;&nbsp;Lembar 2: untuk yang menyerahkan</FONT></FONT></P>
		 -->


