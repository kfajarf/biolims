-- jumlah Per kategori klien
select kategori, count(*) as jumlah from (
	(select lpsb_order_no, kategori from nolims_data_jasa_layanan group by lpsb_order_no) as test
)

-- jenis analisis per jasa layanan
select analisis, count(*) as jumlah from (
	(SELECT lpsb_order_no, nama_lengkap, institusi_perusahaan, analisis 
		FROM `total_data_jasa_layanan`
		group by lpsb_order_no, analisis
	) as lpsb_analisis
) group by analisis  

SELECT d.id, d.nama_departemen, f.nama_fakultas 
FROM departemen as d 
left join fakultas as f on f.id = d.id_fakultas