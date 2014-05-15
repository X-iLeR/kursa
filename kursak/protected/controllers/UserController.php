<?php
/**
 * Created by PhpStorm.
 * User: shikon
 * Date: 15.05.14
 * Time: 21:10
 */

class UserController extends Controller {

    public  function actionAddAttribute() {
        if(isset($_POST['attr'])) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $user->addAttribute($_POST['attr']);
        }
        $this->redirect(Yii::app()->createUrl('/site/index'));
    }

    public function filters()
    {
        return array(
            'accessControl', //вмикає правила доступу, дивитись accessRules() нижче
        );
    }

    public function accessRules() {
        return array(
            array(
                'allow',
                'users' => ['@'] //дозволяє все авторизованим користувачам
            ),
            array(
                'deny',
                'users' => ['?'] //забороняє все не авторизованим користувачам
            )
        );
    }
} 