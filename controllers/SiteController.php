<?php

namespace app\controllers;

use app\components\BalanceHandler\exceptions\TransferMoneyException;
use app\components\BalanceHandler\Handler;
use app\models\TransferMoneyForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends Controller
{

    const STATUS_VALUE_OK = 'ok';
    const STATUS_VALUE_ERROR = 'error';

    /** @var Handler */
    protected $balanceHandler;

    public function init()
    {
        $this->balanceHandler = Yii::$app->balance_handler;
    }

    /**
     * {@inheritdoc}
     */
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
        $data = Yii::$app->request->post();

        if ($model->load($data) && $model->login()) {
            return $this->goBack();
        }

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
     * Displays about page.
     *
     * @return string
     */
    public function actionUsers()
    {
        return $this->render('users', [
            'users' => User::findAllUsers(),
        ]);
    }

    public function actionTransferMoney()
    {
        $requestData = Yii::$app->request->post();
        $transaction = new TransferMoneyForm();
        if (!$transaction->load($requestData, '') || !$transaction->validate($requestData)) {
            return $this->jsonFailResponse($transaction->getErrors());
        }

        $user = User::findIdentity(ArrayHelper::getValue($requestData, 'user_id'));
        if ($user === null) {
            return $this->jsonFailResponse('User not found');
        }

        try {
            $this->balanceHandler->transferMoneyTransaction($user, ArrayHelper::getValue($requestData, 'amount'));
        } catch (TransferMoneyException $e) {
            return $this->jsonFailResponse($e->getMessage());
        } catch (\Exception $e) {
            return $this->jsonFailResponse($e->getMessage());
        } catch (\Throwable $e) {
            Yii::error($e->getMessage());
            return $this->jsonFailResponse('Internal error');
        }

        return $this->jsonSuccessResponse();
    }

    /**
     * @param array $data
     * @return array
     */
    protected function jsonSuccessResponse(array $data = [])
    {
        return $this->_jsonResponse(static::STATUS_VALUE_OK, $data);
    }

    /**
     * @param string|array $errors
     * @return array
     */
    protected function jsonFailResponse($errors)
    {
        if (!is_array($errors)) {
            $errors = [$errors];
        }
        return $this->_jsonResponse(static::STATUS_VALUE_ERROR, $errors);
    }
    /**
     * @param string $status
     * @param array $data
     * @return array
     */
    private function _jsonResponse($status, array $data)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'status' => $status,
            'data'   => $data,
        ];
    }
}
