<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\AnalysisRequestData;
use app\models\TotalDataJasaLayananSearch;
use app\models\InfoDepartemenPenelitiSearch;
use app\models\DataPenggunaJasaLayananSearch;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if(\Yii::$app->user->isGuest)
            return $this->actionLogin();
        else {
            //SM => SearchModel, DP => dataProvider
            $smFrekuensiDepartemen = new \app\models\FrekuensiDepartemenSearch();
            $dpFrekuensiDepartemen = $smFrekuensiDepartemen->search(Yii::$app->request->queryParams);
            $smFrekuensiFakultas = new \app\models\FrekuensiFakultasSearch();
            $dpFrekuensiFakultas = $smFrekuensiFakultas->search(Yii::$app->request->queryParams);
            $smFrekuensiKlienJasaLayanan = new \app\models\FrekuensiKlienJasaLayananSearch();
            $dpFrekuensiKlienJasaLayanan = $smFrekuensiKlienJasaLayanan->search(Yii::$app->request->queryParams);
            $smFrekuensiPilihanJenisAnalisis = new \app\models\FrekuensiPilihanJenisAnalisisSearch();
            $dpFrekuensiPilihanJenisAnalisis = $smFrekuensiPilihanJenisAnalisis->search(Yii::$app->request->queryParams);
            $smFrekuensiJasaLayananPerBulan = new \app\models\FrekuensiJasaLayananPerBulanSearch();
            $dpFrekuensiJasaLayananPerBulan = $smFrekuensiJasaLayananPerBulan->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'smFrekuensiDepartemen' => $smFrekuensiDepartemen,
                'dpFrekuensiDepartemen' => $dpFrekuensiDepartemen,
                'smFrekuensiFakultas' => $smFrekuensiFakultas,
                'dpFrekuensiFakultas' => $dpFrekuensiFakultas,
                'smFrekuensiKlienJasaLayanan' => $smFrekuensiKlienJasaLayanan,
                'dpFrekuensiKlienJasaLayanan' => $dpFrekuensiKlienJasaLayanan,
                'smFrekuensiPilihanJenisAnalisis' => $smFrekuensiPilihanJenisAnalisis,
                'dpFrekuensiPilihanJenisAnalisis' => $dpFrekuensiPilihanJenisAnalisis,
                'smFrekuensiJasaLayananPerBulan' => $smFrekuensiJasaLayananPerBulan,
                'dpFrekuensiJasaLayananPerBulan' => $dpFrekuensiJasaLayananPerBulan,
            ]);
        }
    }

    public function actionJasaLayanan()
    {
        $this->checkPrivilege();
        $smFrekuensiKlienJasaLayanan = new \app\models\FrekuensiKlienJasaLayananSearch();
        $dpFrekuensiKlienJasaLayanan = $smFrekuensiKlienJasaLayanan->search(Yii::$app->request->queryParams);
        $smFrekuensiPilihanJenisAnalisis = new \app\models\FrekuensiPilihanJenisAnalisisSearch();
        $dpFrekuensiPilihanJenisAnalisis = $smFrekuensiPilihanJenisAnalisis->search(Yii::$app->request->queryParams);
        $smFrekuensiJasaLayananPerBulan = new \app\models\FrekuensiJasaLayananPerBulanSearch();
        $dpFrekuensiJasaLayananPerBulan = $smFrekuensiJasaLayananPerBulan->search(Yii::$app->request->queryParams);

        return $this->render('jasaLayanan', [
            'smFrekuensiKlienJasaLayanan' => $smFrekuensiKlienJasaLayanan,
            'dpFrekuensiKlienJasaLayanan' => $dpFrekuensiKlienJasaLayanan,
            'smFrekuensiPilihanJenisAnalisis' => $smFrekuensiPilihanJenisAnalisis,
            'dpFrekuensiPilihanJenisAnalisis' => $dpFrekuensiPilihanJenisAnalisis,
            'smFrekuensiJasaLayananPerBulan' => $smFrekuensiJasaLayananPerBulan,
            'dpFrekuensiJasaLayananPerBulan' => $dpFrekuensiJasaLayananPerBulan,
        ]);
    }

    public function actionDepartemenPeneliti()
    {
        $this->checkPrivilege();
        $smFrekuensiDepartemen = new \app\models\FrekuensiDepartemenSearch();
        $dpFrekuensiDepartemen = $smFrekuensiDepartemen->search(Yii::$app->request->queryParams);
        $smFrekuensiFakultas = new \app\models\FrekuensiFakultasSearch();
        $dpFrekuensiFakultas = $smFrekuensiFakultas->search(Yii::$app->request->queryParams);
        $smInfoDepartemenPeneliti = new \app\models\InfoDepartemenPenelitiSearch();
        $dpInfoDepartemenPeneliti = $smInfoDepartemenPeneliti->search(Yii::$app->request->queryParams);


        return $this->render('departemenPeneliti', [
            'smFrekuensiDepartemen' => $smFrekuensiDepartemen,
            'dpFrekuensiDepartemen' => $dpFrekuensiDepartemen,
            'smFrekuensiFakultas' => $smFrekuensiFakultas,
            'dpFrekuensiFakultas' => $dpFrekuensiFakultas,
            'smInfoDepartemenPeneliti' => $smInfoDepartemenPeneliti,
            'dpInfoDepartemenPeneliti' => $dpInfoDepartemenPeneliti,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Yii::$app->user->loginUrl);
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            // change layout for error action
            if ($action->id=='login')
                 $this->layout = 'login';
            return true;
        } else {
            return false;
        }
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function checkPrivilege() {
        if (Yii::$app->user->isGuest) throw new \yii\web\HttpException(403, 'You don\'t have permission to access this page.');
    }
}
