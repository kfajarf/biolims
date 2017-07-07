<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\models\User;
use app\themes\adminLTE\components\ThemeNav;
use kartik\sidenav\SideNav;
use yii\helpers\Url;

?>
<?php $this->beginContent('@app/themes/adminLTE/layouts/main.php'); ?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

     <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/user_accounts.png" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>
                      <?php
                          if(isset(Yii::$app->user->identity->username))
                              $info[] = ucfirst(\Yii::$app->user->identity->username);
                          else $info[] = Yii::t('app','Hello'); 

                          echo implode($info);
                      ?>
                    </p>
                    <a><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <?php
                echo Menu::widget([
                  'encodeLabels'=>false,
                  'options' => [
                    'class' => 'sidebar-menu'
                  ],
                  'items' => [
                      ['label'=>Yii::t('app','MAIN NAVIGATION'), 'options'=>['class'=>'header']],
                      ['label' => ThemeNav::link('Data Report', 'fa fa-dashboard'), 'url' => ['/'], 'active' => \Yii::$app->request->getUrl() == Url::toRoute(['/']), 'visible'=>!Yii::$app->user->isGuest],
                      ['label' => ThemeNav::link('Surat Administrasi', 'fa fa-pencil-square-o'), 'url' => ['/analysis-request'], 'active' => (Yii::$app->controller->id == 'analysis-request'), 'visible'=>(!Yii::$app->user->isGuest && User::notUpperManagement()), 'items' => [
                          ['label' => (Yii::$app->controller->id == 'analysis-request' ? '&#10148; Permohonan Analisis': 'Permohonan Analisis' ), 'url' => ['/analysis-request'], 'visible'=> (!Yii::$app->user->isGuest && (Yii::$app->controller->id == 'analysis-request' || Yii::$app->controller->id == 'peneliti')), 'options'=>['class'=>'sidebar-menu header'],
                          ],
                          //ThemeNav::link('Surat Administrasi', 'fa fa-circle text-success')
                          ['label' => (Yii::$app->controller->id == 'peneliti' ? '&#10148; Permohonan Penelitian': 'Permohonan Penelitian' ), 'url' => ['/peneliti'], 'visible'=> (!Yii::$app->user->isGuest && (Yii::$app->controller->id == 'analysis-request' || Yii::$app->controller->id == 'peneliti')), 'options'=>['class'=>'sidebar-menu header'],
                          ],
                        ],
                      ],
                      ['label' => ThemeNav::link('Penyimpanan Bahan Kimia', 'fa fa-flask'), 'url' => ['/chem-storage'], 'active' => (\Yii::$app->request->getUrl() == Url::toRoute(['/chem-storage']) || \Yii::$app->request->getUrl() == Url::toRoute(['/chem-storage/create']) || \Yii::$app->request->getUrl() == Url::toRoute(['/lokasi/index']) || \Yii::$app->request->getUrl() == Url::toRoute(['/supplier/index'])), 'visible'=>(!Yii::$app->user->isGuest && User::notUpperManagement())],
                      ['label' => ThemeNav::link('Alat Laboratorium', 'fa fa-bell'), 'url' => ['/lab-kit'], 'active' => (\Yii::$app->request->getUrl() == Url::toRoute(['/lab-kit']) || \Yii::$app->request->getUrl() == Url::toRoute(['/lab-kit/list-peminjaman'])), 'visible'=>(!Yii::$app->user->isGuest && User::notUpperManagement())],
                      ['label' => ThemeNav::link('Arsip Surat', 'fa fa-archive'), 'url' => ['/surat-masuk'], 'active' => (Yii::$app->controller->id == 'surat-masuk'), 'visible'=>(!Yii::$app->user->isGuest && User::notUpperManagement()), 'items' => [
                          ['label' => (Yii::$app->controller->id == 'surat-masuk' ? '&#10148; Surat Masuk': 'Surat Masuk' ), 'url' => ['/surat-masuk'], 'visible'=> (!Yii::$app->user->isGuest && (Yii::$app->controller->id == 'surat-masuk' || Yii::$app->controller->id == 'surat-keluar')), 'options'=>['class'=>'sidebar-menu header'],
                          ],
                          //ThemeNav::link('Surat Administrasi', 'fa fa-circle text-success')
                          ['label' => (Yii::$app->controller->id == 'surat-keluar' ? '&#10148; Surat Keluar': 'Surat Keluar' ), 'url' => ['/surat-keluar'], 'visible'=> (!Yii::$app->user->isGuest && (Yii::$app->controller->id == 'surat-masuk' || Yii::$app->controller->id == 'surat-keluar')), 'options'=>['class'=>'sidebar-menu header'],
                          ],
                        ],
                      ],

                      /*['label'=>Yii::t('app','SUB NAVIGATION'), 'options'=>['class'=>'header']],
                      ['label' => ThemeNav::link('Lokasi Penyimpanan', 'fa fa-bullseye'), 'url' => ['/lokasi'], 'visible'=>(!Yii::$app->user->isGuest && User::notUpperManagement())],
                      ['label' => ThemeNav::link('Supplier', 'fa fa-bullseye'), 'url' => ['/supplier'], 'visible'=>!Yii::$app->user->isGuest],*/

                  ],
                ]);
              /*echo SideNav::widget([
                'type' => $type,
                'encodeLabels' => false,
                'heading' => $heading,
                'items' => [
                    // Important: you need to specify url as 'controller/action',
                    // not just as 'controller' even if default action is used.
                    //
                    // NOTE: The variable `$item` is specific to this demo page that determines
                    // which menu item will be activated. You need to accordingly define and pass
                    // such variables to your view object to handle such logic in your application
                    // (to determine the active status).
                    //
                    ['label' => 'Home', 'icon' => 'home', 'url' => Url::to(['/site/home', 'type'=>$type]), 'active' => ($item == 'home')],
                    ['label' => 'Books', 'icon' => 'book', 'items' => [
                        ['label' => '<span class="pull-right badge">10</span> New Arrivals', 'url' => Url::to(['/site/new-arrivals', 'type'=>$type]), 'active' => ($item == 'new-arrivals')],
                        ['label' => '<span class="pull-right badge">5</span> Most Popular', 'url' => Url::to(['/site/most-popular', 'type'=>$type]), 'active' => ($item == 'most-popular')],
                        ['label' => 'Read Online', 'icon' => 'cloud', 'items' => [
                            ['label' => 'Online 1', 'url' => Url::to(['/site/online-1', 'type'=>$type]), 'active' => ($item == 'online-1')],
                            ['label' => 'Online 2', 'url' => Url::to(['/site/online-2', 'type'=>$type]), 'active' => ($item == 'online-2')]
                        ]],
                    ]],
                    ['label' => '<span class="pull-right badge">3</span> Categories', 'icon' => 'tags', 'items' => [
                        ['label' => 'Fiction', 'url' => Url::to(['/site/fiction', 'type'=>$type]), 'active' => ($item == 'fiction')],
                        ['label' => 'Historical', 'url' => Url::to(['/site/historical', 'type'=>$type]), 'active' => ($item == 'historical')],
                        ['label' => '<span class="pull-right badge">2</span> Announcements', 'icon' => 'bullhorn', 'items' => [
                            ['label' => 'Event 1', 'url' => Url::to(['/site/event-1', 'type'=>$type]), 'active' => ($item == 'event-1')],
                            ['label' => 'Event 2', 'url' => Url::to(['/site/event-2', 'type'=>$type]), 'active' => ($item == 'event-2')]
                        ]],
                    ]],
                    ['label' => 'Profile', 'icon' => 'user', 'url' => Url::to(['/site/profile', 'type'=>$type]), 'active' => ($item == 'profile')],
                ],
              ]);*/ 
            ?>
            

        </section>
  <!-- /.sidebar -->
</aside>

<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">

   <!-- Content Header (Page header) -->
   <section class="content-header">
        <h1> <?php echo Html::encode($this->title); ?> </h1>
           <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php echo $content; ?>
    </section><!-- /.content -->

</div><!-- /.right-side -->
<?php $this->endContent();