<?php

namespace app\controllers;

use Yii;
use app\components\NavigationAiSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'ai-navegar'],
                'rules' => [
                    [
                        'actions' => ['ai-navegar'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'ai-navegar' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays admission page.
     *
     * @return string
     */
    public function actionAdmision()
    {
        return $this->render('admision');
    }

    /**
     * Displays gallery page.
     *
     * @return string
     */
    public function actionGaleria()
    {
        return $this->render('galeria');
    }

    /**
     * Displays news page.
     *
     * @return string
     */
    public function actionNoticias()
    {
        return $this->render('noticias');
    }

    /**
     * Displays magazine page.
     *
     * @return string
     */
    public function actionRevista()
    {
        return $this->render('revista');
    }

    /**
     * Displays team/professors page.
     *
     * @return string
     */
    public function actionEquipo()
    {
        return $this->render('equipo');
    }

    /**
     * Búsqueda asistida (embeddings Hugging Face + catálogo en español). Respuesta JSON.
     *
     * @return array<string, mixed>
     */
    public function actionAiNavegar()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $q = Yii::$app->request->post('q', '');
        if (!is_string($q)) {
            $q = '';
        }

        $service = new NavigationAiSearch();

        return $service->search($q);
    }
}
