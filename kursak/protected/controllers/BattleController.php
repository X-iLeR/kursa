<?php

class BattleController extends Controller
{
	public function actionAcceptOpponent($id)
	{
		$this->render('acceptOpponent');
	}

	public function actionCheckOpponent()
	{
        if (Yii::app()->user->isGuest || empty(Yii::app()->user->id)) {
            throw new HttpException(null, 403);
        }
        $user_id = Yii::app()->user->id;
        $user = User::model()->findByPk($user_id);
        $battle = Battle::model()->find('time_begin IS NULL AND user1=:user1', array('user1' => $user_id));
        /**
         * @var $battle Battle
         */
        if (empty ($battle->user2)) {
            $data = array('user2' => 'false');
        } else {
            $data = array('user2' => $battle->user20->attributes);
        }
        if(isset($_POST['ajax'])) {
            echo json_encode($data);
        } else {
            $this->render('checkOpponent', array ('battle' => $battle,'user1' => $user, 'user2' => $data['user2']) );
        }
	}

	public function actionCreate()
	{
		$this->render('create');
	}

	public function actionGetResults()
	{
		$this->render('getResults');
	}

	public function actionIndex()
	{
        $user_id = Yii::app()->user->isGuest ? false : Yii::app()->user->id;
        if(!empty ($user_id)) {
            $battle = Battle::model()->find('time_end IS NULL AND (user1=:user_id OR user2=:user_id)', array("user_id" => $user_id));
            if( empty($battle) ) {
                Yii::app()->user->setFlash('notice', 'У Вас нет текущих битв.');
                $this->redirect(Yii::app()->createUrl('site/index'));
            } else {
                Yii::app()->clientScript->registerScriptFile('/js/battle.js', CClientScript::POS_END);
                $this->render('index', array('battle' => $battle));
            }
        } else {
            $this->redirect(Yii::app()->createUrl('site/login'));
        }
	}

	public function actionInit()
	{
		$this->render('init');
	}

	public function actionJoin()
	{
		$this->render('join');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}