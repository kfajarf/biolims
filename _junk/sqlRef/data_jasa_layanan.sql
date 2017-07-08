ALTER view data_jasa_layanan as SELECT ar.id, ar.lpsb_order_no, kk.kategori, pa.nama_lengkap, pa.institusi_perusahaan, pa.alamat, pa.telp_fax, pa.no_hp, pa.email, ka.analisis, s.sampel_id, s.nama_sampel, s.kemasan, s.jumlah, s.jenis_metode_analisis, ar.status_pengujian, ar.tanggal_diterima, ar.tanggal_selesai, ar.total_biaya, ar.dp, ar.sisa, ar.keterangan, ar.status
FROM ((((analysis_request as ar left join pemohon_analisis as pa on pa.request_id = ar.id)
      left join kategori_klien as kk on kk.id = ar.id_kategori_klien)
      left join kategori_analisis as ka on ka.request_id = ar.id)
      left join sampel as s on s.kategori_analisis_id = ka.id);