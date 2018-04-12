<?php
namespace frontend\controllers;

use frontend\models\FormGetEmailCode;
use frontend\models\FormResetPassword;
use frontend\models\FormUpload;
use Yii;
use yii\httpclient\Client;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\FormLogin;
use frontend\models\FormSignup;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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

    /**
     * @inheritdoc
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
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
//                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new FormLogin();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $get_email_code_form = new FormGetEmailCode();
        $model = new FormSignup();
        $wait = 0;
        if ($get_email_code_form->load(Yii::$app->request->post())){
            if ($get_email_code_form->validate()){
                if ($get_email_code_form->sendCode()){
                    Yii::$app->session->setFlash('success', '邮箱校验码发送成功，请进入邮箱查看。');
                    $wait = 120;
                }else{
                    Yii::$app->session->setFlash('error', '邮箱校验码发送失败！请稍后重试。');
                    $wait = 10;
                }
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'get_email_code_form' => $get_email_code_form,
            'model' => $model,
            'wait' => $wait,
        ]);
    }

    /**
     * reset password
     */
    public function actionResetPassword()
    {
        $get_email_code_form = new FormGetEmailCode();
        $model = new FormResetPassword();
        $wait = 0;
        if ($get_email_code_form->load(Yii::$app->request->post())){
            if ($get_email_code_form->sendCode()){
                Yii::$app->session->setFlash('success', '邮箱校验码发送成功，请进入邮箱查看。');
                $wait = 120;
            }else{
                Yii::$app->session->setFlash('error', '邮箱校验码发送失败！请稍后重试。');
                $wait = 10;
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->resetPassword()) {
                return $this->redirect(['login']);
            }else{
                Yii::$app->session->setFlash('error', '重置密码失败！');
            }
        }
        return $this->render('reset-password', [
            'get_email_code_form' => $get_email_code_form,
            'model' => $model,
            'wait' => $wait,
        ]);
    }

    public function actionUpload()
    {
        $model = new FormUpload();
        if (Yii::$app->request->isPost){
            $model->file = UploadedFile::getInstance($model, "file");
            $fileName = date("HiiHsHis").$model->file->baseName . "." . $model->file->extension;
            echo $model->file->saveAs(\Yii::getAlias('@runtime/uploads'). DIRECTORY_SEPARATOR. $fileName);
            exit;
        }
        return $this->render('upload', [
            'model' => $model,
        ]);
    }

    public function actionTestUpload()
    {
        $url = 'https://sm.ms/api/upload';
//        $url = 'http://test.mycmf.deepin.me.tt/site/upload';
        $client = new Client();
        $r = $client->createRequest()
            ->setMethod('POST')
            ->setUrl($url)
            ->addFile('smfile', '/var/www/mycmf/frontend/runtime/uploads/092020090709200778528e38bc323ec7633fc12b0e6122e9.jpg')
            ->send();
        echo $r->content;
    }
}
