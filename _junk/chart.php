
<div class="row" style="padding: 15px">
            <div class="col-md-6" style="border-top: 7px solid rgba(0, 100, 170, 1); background-color: white; padding: 10px 10px 10px 10px">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
           <div id="chart_div"></div>
        <script type="text/javascript">
        //load google chart
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);
        var metodejs = [];
        var peralatanjs = [];
        var personeljs = [];
        var bahanKimiajs = [];
        var akomodasijs = [];

        <?php
          for ($idx = 0; $idx <= 1; $idx++) {
            $metode = \Yii::$app->db->createCommand("Select count(*) as jumlah from kaji_ulang where metode = $idx")->queryOne();
            $peralatan = \Yii::$app->db->createCommand("Select count(*) as jumlah from kaji_ulang where peralatan = $idx")->queryOne();
            $personel = \Yii::$app->db->createCommand("Select count(*) as jumlah from kaji_ulang where personel = $idx")->queryOne();
            $bahanKimia = \Yii::$app->db->createCommand("Select count(*) as jumlah from kaji_ulang where bahan_kimia = $idx")->queryOne();
            $akomodasi = \Yii::$app->db->createCommand("Select count(*) as jumlah from kaji_ulang where kondisi_akomodasi = $idx")->queryOne();
            ?>
            var i = <?= $idx ?>;
            metodejs[i] = <?= $metode['jumlah'] ?>;
            peralatanjs[i] = <?= $peralatan['jumlah'] ?>;
            personeljs[i] = <?= $personel['jumlah'] ?>;
            bahanKimiajs[i] = <?= $bahanKimia['jumlah'] ?>;
            akomodasijs[i] = <?= $akomodasi['jumlah'] ?>;
          <?php }
        ?>

          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Pengujian Parameter', 'Internal', 'Eksternal'],
              ['Metode', metodejs[1], metodejs[0]],
              ['Peralatan', peralatanjs[1], peralatanjs[0]],
              ['Personel', personeljs[1], personeljs[0]],
              ['Bahan Kimia', bahanKimiajs[1], bahanKimiajs[0]],
              ['Akomodasi', akomodasijs[1], akomodasijs[0]],
            ]);

            var options = {
              chart: {
                title: 'Kompetensi Sumber Daya Laboratorium',
                subtitle: 'Kaji Ulang Permintaan, Tender, dan Kontrak',
              },
              bars: 'vertical',
              vAxis: {format: 'decimal'},
              height: 300,
              colors: ['#3498DB', '#E74C3C'],

            };

            var chart = new google.charts.Bar(document.getElementById('chart_div'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
          }
        </script>
            </div>
            <div class="col-md-6" style="padding: 10px 10px 10px 10px; border-top: 7px solid rgba(0, 100, 170, 1); background-color: white">
          
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <div id="chart1"></div>
            <script type="text/javascript">
              google.charts.load('current', {'packages':['line', 'corechart']});
              google.charts.setOnLoadCallback(drawChart);

              //get value on each status (percepatan, biasa)
                var percepatanjs = [];
                var biasajs = [];
                <?php 
                for ($idx=1; $idx <= 12; $idx++) {
                    $eachMonthBiasa = \Yii::$app->db->createCommand("Select count(id) as jumlah from analysis_request where month(tanggal_diterima) = $idx and status_pengujian = 'biasa'")->queryOne();
                    $eachMonthPercepatan = \Yii::$app->db->createCommand("Select count(id) as jumlah from analysis_request where month(tanggal_diterima) = $idx and status_pengujian = 'percepatan'")->queryOne(); ?>
                    // biasajs[$idx]
                    var i = <?= $idx ?>;
                    biasajs[i] = <?= $eachMonthBiasa['jumlah']?>;
                    percepatanjs[i] = <?= $eachMonthPercepatan['jumlah']?>;
                <?php }
                ?> 
                // document.write(percepatanjs);

            function drawChart() {

              var chartDiv = document.getElementById('chart1');

              var data = google.visualization.arrayToDataTable([
                  ['Bulan', 'Biasa', 'Percepatan'],
                  ['Januari', biasajs[1], percepatanjs[1]],
                  ['Februari', biasajs[2], percepatanjs[2]],
                  ['Maret', biasajs[3], percepatanjs[3]],
                  ['April', biasajs[4], percepatanjs[4]],
                  ['Mei', biasajs[5], percepatanjs[5]],
                  ['Juni', biasajs[6], percepatanjs[6]],
                  ['Juli', biasajs[7], percepatanjs[7]],
                  ['Agustus', biasajs[8], percepatanjs[8]],
                  ['September', biasajs[9], percepatanjs[9]],
                  ['Oktober', biasajs[10], percepatanjs[10]],
                  ['November', biasajs[11], percepatanjs[11]],
                  ['Desember', biasajs[12], percepatanjs[12]],
                ]);

              var materialOptions = {
                chart: {
                  title: 'Analisis Sampel',
                  subtitle: 'Perbandingan Status Pengujian Permohonan Analisis'
                },
                height: 300,
                
              };

              function drawMaterialChart() {
                var materialChart = new google.charts.Line(chartDiv);
                materialChart.draw(data, materialOptions);
              }

              drawMaterialChart();

            }
            </script>
          
    </div></div>
