<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 03.05.17
 * Time: 12:46
 */

namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
class KnrController extends Controller
{
    var $co=array(5,1,10,23,88);
    public function actionIndex()
    {
        return $this->render('index', [
            'c'=>$this->co
        ]);
    }
}