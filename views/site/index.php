<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
Yii::$app->user->isGuest ? [
    $link1='/site/login',
    $link2='/site/login',
    $link3='/site/login'] : [
        $link1 = '/analysis-request',
        $link2 = '/chem-storage',
        $link3 = '/lab-kit'
];
//$this->title = 'My Yii Application';
?>
<div class="/">

     <div>
        <table align=center>
        <tr>
            <td>
                <P>
                    <IMG SRC="/images/ipb2.png" VALIGN=CENTER HSPACE=15 WIDTH=150 HEIGHT=225 BORDER=0>
                </P>
            </td>
            <td class="jumbotron">
                <p>
                    <br><br>
                    <h1>Biofarmaka</h1>
                </p>
                <p><h3>Lab Information Management System</h3></p> 
            </td>
        </tr>       
            
        </table>
    </div>

    
    <div class="body-content")">

        <div class="row">
            <div class="col-lg-4">
                <div class="col-md-11" style="border-top: 7px solid rgba(0, 100, 170, 1); background-color: white; border-bottom: 4px solid rgba(0, 100, 170, 1); padding: 0px; padding-left: 10px">
                <h2>Sample Analysis</h2>

                <p>Pendataan sampel-sampel yang akan dianalisis serta pembuatan dokumen permohonan analisis sampel <br></p>

                <p>
                <a class="btn btn-default" href= <?= ($link1) ?>> Buat Surat &raquo;</a></p>
                </div> <br>
            </div>
            <div class="col-lg-4">
                <div class="col-md-11" style="border-top: 7px solid rgba(0, 100, 170, 1); background-color: white; border-bottom: 4px solid rgba(0, 100, 170, 1); padding: 0px; padding-left: 10px">
                <h2>Chem Storage</h2>

                <p>Pengecekkan bahan-bahan kimia yang tersedia, penambahan bahan kimia baru, serta pengambilan/penggunaan bahan kimia</p>

                <p><a class="btn btn-default" href= <?= ($link2) ?>> Lihat Storage &raquo;</a></p>
                </div> <br>
            </div>
            <div class="col-lg-4">
                <div class="col-md-11" style="border-top: 7px solid rgba(0, 100, 170, 1); background-color: white; border-bottom: 4px solid rgba(0, 100, 170, 1); padding: 0px; padding-left: 10px">
                <h2>Lab Kit Schedule</h2>

                <p>Pengecekkan perangkat yang tersedia, serta pengecekkan maupun pembuatan jadwal kalibrasi perangkat yang ada <br></p>

                <p><a class="btn btn-default" href= <?= ($link3) ?>> Lihat Perangkat &raquo;</a></p>
                </div> <br>
            </div>
        </div>

    </div>
</div>
