<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=us-ascii">
	<TITLE></TITLE>
	<META NAME="GENERATOR" CONTENT="OpenOffice 4.1.1  (FreeBSD/amd64)">
	<META NAME="CREATED" CONTENT="20160827;5580300">
	<META NAME="CHANGED" CONTENT="0;0">
	<META NAME="AppVersion" CONTENT="16.0000">
	<META NAME="DocSecurity" CONTENT="0">
	<META NAME="HyperlinksChanged" CONTENT="false">
	<META NAME="LinksUpToDate" CONTENT="false">
	<META NAME="ScaleCrop" CONTENT="false">
	<META NAME="ShareDoc" CONTENT="false">
	<STYLE TYPE="text/css">
	<!--
		p {
			font-size: 2pt;
		}
		td {
			font-size: 2pt;
		}
	-->
	</STYLE>
</HEAD>
<BODY LANG="en-US" TEXT="#000000" DIR="LTR">
<CENTER>
	<TABLE ALIGN="left" WIDTH=100% CELLPADDING=0 CELLSPACING=0>
		<TR>
			<TD width=9% style="border-bottom: 1px solid black">
				<P CLASS="western"><IMG SRC="/images/ipb.jpg" VALIGN=CENTER HSPACE=15 WIDTH=80 HEIGHT=80 BORDER=0><BR>
				</P>
			</TD>
			<td height=120 style="border-bottom: 1px solid black;" >
				<p>
					FORMULIR PERMOHONAN ANALISIS<br>
					<b>LABORATORIUM PUSAT STUDI BIOFARMAKA</b><br>
					LPPM - INSTITUT PERTANIAN BOGOR<br>
					Jl. Taman Kencana No. 03 Bogor 16151<br>
					Telp/Fax: +62-251-8373561/ +62-251-8347525;<br>
					website: www.biofarmaka.or.id; Email: bfarmaka.lub@gmail.com<br>
				</p>
			</td>
		</TR>
	</TABLE>
</CENTER>
<div style="padding: 0px 15px 0px 15px; height: 70px">
<TABLE WIDTH=1000 BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<tr>
		<td colspan="5"><font style="font-size: 5pt">&nbsp;</font></td>
	</tr>
	<TR VALIGN=TOP>
		<TD WIDTH=135>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><FONT FACE="Tahoma, serif">Nama
			Lengkap</FONT></FONT></FONT></P>
		</TD>
		<TD WIDTH=298>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><FONT FACE="Tahoma, serif">: <?= $pemohon -> nama_lengkap ?></FONT></FONT></FONT></P>
		</TD>
		<TD WIDTH=80>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><FONT FACE="Tahoma, serif">No
			Telp/Fax</FONT></FONT></FONT></P>
		</TD>
		<TD WIDTH=170>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><FONT FACE="Tahoma, serif">: <?= $pemohon -> telp_fax ?></FONT></FONT></FONT></P>
		</TD>
		<TD VALIGN=TOP ROWSPAN=3 WIDTH=157 STYLE="border: 1px solid black"> 
			<P CLASS="western"><FONT FACE="Tahoma, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><?= "&nbsp;" ?>LPSB Order No: <br><br> <FONT SIZE=2 STYLE="font-size: 16pt"> <?= "&nbsp;&nbsp;" .$model -> lpsb_order_no ?></FONT></FONT></FONT></P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=135>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><FONT FACE="Tahoma, serif">Institusi/Perusahaan</FONT></FONT></FONT></P>
		</TD>
		<TD WIDTH=298>
			<P><A NAME="_GoBack"></A><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><FONT FACE="Tahoma, serif">: <?= $pemohon -> institusi_perusahaan ?></FONT></FONT></FONT></P>
		</TD>
		<TD WIDTH=80>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><FONT FACE="Tahoma, serif">No
			HP</FONT></FONT></FONT></P>
		</TD>
		<TD WIDTH=135>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><FONT FACE="Tahoma, serif">: <?= $pemohon -> no_hp ?></FONT></FONT></FONT></P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD WIDTH=135>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><FONT FACE="Tahoma, serif">Alamat</FONT></FONT></FONT></P>
		</TD>
		<TD WIDTH=298>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><FONT FACE="Tahoma, serif">: <?= $pemohon -> alamat ?></FONT></FONT></FONT></P>
		</TD>
		<TD WIDTH=80>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><FONT FACE="Tahoma, serif">Email</FONT></FONT></FONT></P>
		</TD>
		<TD WIDTH=135>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 9pt"><FONT FACE="Tahoma, serif">: <?= $pemohon -> email ?></FONT></FONT></FONT></P>
		</TD>
	</TR>
</TABLE>
</div>



<!--//////////////////////////////////////BEFORE///////////////////////////////////////-->
<TABLE CLASS="mycell" STYLE="overflow: nowrap;" WIDTH=1005 BORDER=1 BORDERCOLOR="#00000a" CELLPADDING="1px" CELLSPACING=0>
	<TR>
		<TD ROWSPAN=2 ALIGN=center WIDTH="3%">
			<P CLASS="western" ALIGN=CENTER><FONT FACE="Tahoma, serif"><FONT SIZE=2><B>No.</B></FONT></FONT></P>
		</TD>
		<TD COLSPAN=3  ALIGN=CENTER VALIGN=TOP WIDTH="35%">
			<P CLASS="western" ALIGN=CENTER><FONT FACE="Tahoma, serif"><FONT SIZE=2><B>KONDISI
			SAMPEL</B></FONT></FONT></P>
		</TD>
		<TD ROWSPAN=2  ALIGN=CENTER  WIDTH="27%">
			<P CLASS="western" ><FONT FACE="Tahoma, serif"><FONT SIZE=2><B>JENIS &amp; METODE ANALISIS</B></FONT></FONT></P>
		</TD>
		<TD ALIGN=center ROWSPAN=2 WIDTH="7%">
			<P CLASS="western" ALIGN=CENTER><FONT FACE="Tahoma, serif"><FONT SIZE=2><B>SAMPEL
			ID</B></FONT></FONT></P>
		</TD>
		<TD COLSPAN=2 ALIGN=CENTER VALIGN=TOP WIDTH="16%">
			<P CLASS="western"><FONT FACE="Tahoma, serif"><FONT SIZE=2><B>LAMA PENGUJIAN</B></FONT></FONT></P>
		</TD>
		<TD ROWSPAN=2 ALIGN=CENTER WIDTH="12%">
			<P CLASS="western" ALIGN=CENTER><FONT FACE="Tahoma, serif"><FONT SIZE=2><B>BIAYA<br>PENGUJIAN (Rp)</B></FONT></FONT></P>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD width=22% ALIGN=CENTER>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><FONT FACE="Tahoma, serif"><FONT SIZE=2><B>NAMA SAMPEL</B></FONT></FONT></FONT></FONT></P>
		</TD>
		<TD width=7% ALIGN=CENTER>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><FONT FACE="Tahoma, serif"><FONT SIZE=2><B>KEMASAN</B></FONT></FONT></FONT></FONT></P>
		</TD>
		<TD width=6% ALIGN=CENTER>
			<P><FONT FACE="Calibri, serif"><FONT SIZE=2 STYLE="font-size: 11pt"><FONT FACE="Tahoma, serif"><FONT SIZE=2><B>JUMLAH</B></FONT></FONT></FONT></FONT></P>
		</TD>
		<TD ALIGN=CENTER>
			<P CLASS="western"><FONT FACE="Tahoma, serif"><FONT SIZE=2><B>BIASA</B></FONT></FONT></P>
		</TD>
		<TD ALIGN=CENTER>
			<P CLASS="western"><FONT FACE="Tahoma, serif"><FONT SIZE=2><B>PERCEPATAN</B></FONT></FONT></P>
		</TD>
	</TR>

	<!-- DATA SECTION START -->
	
	<?php 
		count($data);
	for ($idx = 0; $idx < 14; $idx++) {
		$isDataExist = array_key_exists($idx, $data); 
		echo "<TR CLASS='mycell' VALIGN=TOP>";
		if ($isDataExist) {
			$dataRow = $data[$idx];
			// var_dump($data[$idx]['id']);die();
			echo "<TD ALIGN=center >
					<P style='font-size: 8pt'><FONT FACE='Tahoma, serif'>".($idx+1)."</FONT></P>
				</TD>
				<div>
					<TD>
						<P style='font-size: 8pt'><FONT FACE='Tahoma, serif'>".$dataRow['nama_sampel']."</FONT></P>
					</TD>
					<TD>
						<P style='font-size: 8pt'><FONT FACE='Tahoma, serif'>".$dataRow['kemasan']."</FONT></P>
					</TD>
					<TD ALIGN=center>
						<P style='font-size: 8pt'><FONT FACE='Tahoma, serif'>".$dataRow['jumlah']."</FONT></P>
					</TD>
				</div>
				<TD>
					<P style='font-size: 8pt'><FONT FACE='Tahoma, serif'>".$dataRow['analisis'].': '.$dataRow['metode']."</FONT></P>
				</TD>
				<TD ALIGN=center>
					<P style='font-size: 8pt'><FONT FACE='Tahoma, serif'>".$dataRow['sampel_id']."</FONT></P>
				</TD>";
		} else {
			echo "<TD><P><BR></P></TD>
				<TD><P><BR></P></TD>
				<TD><P><BR></P></TD>
				<TD><P><BR></P></TD>
				<TD><P><BR></P></TD>
				<TD><P><BR></P></TD>";
		}

		if ($idx == 0) {
			if($model-> status_pengujian === "biasa")
			{echo "<TD VALIGN=TOP ROWSPAN=2>
					<P><FONT FACE='Tahoma, serif'><FONT SIZE=3>Diterima
					tgl:<br>".date('d-m-Y', strtotime($model->tanggal_diterima))."</FONT></FONT></P>
				</TD>
				<TD VALIGN=TOP ROWSPAN=2>
					<P><FONT FACE='Tahoma, serif'><FONT SIZE=3>Diterima
					tgl:</FONT></FONT></P>
				</TD>";
			} else {
			echo "<TD VALIGN=TOP ROWSPAN=2>
					<P><FONT FACE='Tahoma, serif'><FONT SIZE=3>Diterima
					tgl:</FONT></FONT></P>
				</TD>
				<TD VALIGN=TOP ROWSPAN=2>
					<P><FONT FACE='Tahoma, serif'><FONT SIZE=3>Diterima
					tgl:<br>".date('d-m-Y', strtotime($model->tanggal_diterima))."</FONT></FONT></P>
				</TD>";
			}
			echo "<TD ROWSPAN=2>
					<P><FONT FACE='Tahoma, serif'><B>Total: <br>".\Yii::$app->formatter->format($model-> total_biaya,['decimal',0]).", -</B></FONT></P>
				</TD>";
		} else if ($idx == 2) {
			if($model -> status_pengujian === "biasa")
			{echo "<TD VALIGN=TOP ROWSPAN=3>
					<P><FONT FACE='Tahoma, serif'><FONT SIZE=3>Selesai
					tgl:<br>".date('d-m-Y', strtotime($model->tanggal_selesai))."</FONT></FONT></P>
				</TD>
				<TD VALIGN=TOP ROWSPAN=3>
					<P><FONT FACE='Tahoma, serif'><FONT SIZE=3>Selesai
					tgl:</FONT></FONT></P>
				</TD>";
			} else {
			echo "<TD VALIGN=TOP ROWSPAN=3>
					<P><FONT FACE='Tahoma, serif'><FONT SIZE=3>Selesai
					tgl:</FONT></FONT></P>
				</TD>
				<TD VALIGN=TOP ROWSPAN=3>
					<P><FONT FACE='Tahoma, serif'><FONT SIZE=3>Selesai
					tgl:<br>".date('d-m-Y', strtotime($model->tanggal_selesai))."</FONT></FONT></P>
				</TD>";
			}
			echo "<TD>
					<P><FONT FACE='Tahoma, serif'><B>DP: ".\Yii::$app->formatter->format($model-> dp,['decimal',0]).", -</B></FONT></P>
				</TD>";
		} else if ($idx == 3) {
			echo "<TD ROWSPAN=2>
					<P><FONT FACE='Tahoma, serif'><B>SISA: <br>".\Yii::$app->formatter->format($model-> sisa,['decimal',0]).", -</B></FONT></P>
				</TD>";
		} elseif ($idx == 5) {
			echo "<TD ROWSPAN=9></TD><TD ROWSPAN=9></TD><TD ROWSPAN=9></TD>";
		}

		echo "</TR>";
	}
	?>

	<!-- DATA SECTION END -->
	<TR>
		<TD COLSPAN=9 VALIGN=TOP>
			<P CLASS="western" STYLE="margin-top: 0.08in"><FONT FACE="Tahoma, serif"><B>KETERANGAN: </B><?= $model -> keterangan ?></FONT></P>
		</TD>
	</TR>
	<TR>
		<TD  ALIGN=LEFT COLSPAN=5 VALIGN=TOP STYLE="border-right:0px">
			<P CLASS="western" STYLE="margin-bottom: 0in">
				<FONT ALIGN=LEFT FACE="Tahoma, serif">Pengirim Sampel,</FONT><BR>
			</P><br><br>
			<P CLASS="western">
				<FONT FACE="Tahoma, serif">(&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.)
				</FONT>
			</P>
		</TD>
		<TD  ALIGN=RIGHT COLSPAN=4 VALIGN=TOP STYLE="border-left:0px">
			<P CLASS="western" STYLE="margin-bottom: 0in">
				<FONT ALIGN=LEFT FACE="Tahoma, serif">Staff Administrasi,</FONT><BR>
			</P><br><br>
			<P CLASS="western">
				<FONT FACE="Tahoma, serif">(&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.)
				</FONT>
			</P>
		</TD>
	</TR>
</TABLE>
</BODY>
</HTML>
