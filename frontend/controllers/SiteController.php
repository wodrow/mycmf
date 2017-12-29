<?php
namespace frontend\controllers;

use frontend\models\GetEmailCodeForm;
use frontend\models\ResetPasswordForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\SignupForm;

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

        $model = new LoginForm();
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
        $get_email_code_form = new GetEmailCodeForm();
        $model = new SignupForm();
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
        $get_email_code_form = new GetEmailCodeForm();
        $model = new ResetPasswordForm();
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
}
