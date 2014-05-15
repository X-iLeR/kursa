<?php

class BattleController extends Controller
{
    /**
     * Хост принимает вызов
     * @param int $id ID противника
     */
    public function actionAcceptOpponent($id)
	{
        $battle = Battle::acceptBattle(Yii::app()->user->id, $id);
            if($battle) {
                echo json_encode(array('accepted' => 'true'));
                return;
            }
        echo json_encode(array('accepted' => 'false'));
	}

    /**
     * Хост проверяет, появился ли противник
     */
	public function actionCheckOpponent()
	{
        if (Yii::app()->user->isGuest || empty(Yii::app()->user->id)) {
            throw new HttpException(null, 403);
        }
        $user_id = Yii::app()->user->id;
        $user = User::model()->findByPk($user_id);
        $battle = Battle::getBattleLobby($user_id);
        /**
         * @var $battle Battle
         */
        if ($battle && empty ($battle->user2)) {
            $data = array('user2' => 'false');
        } else {
            $data = array('user2' => $battle->user20->attributes);
        }
        if(isset($_POST['ajax'])) {
            echo json_encode($data);
        } else {
            $this->render('checkOpponent', array ('battle' => $battle,'user1' => $user, 'user2' => $battle->user20) );
        }
	}

    /**
     * TODO запилить страницу создания лобби
     */
    public function actionCreate()
	{
        $user_id = Yii::app()->user->id;
        $user = User::model()->findByPk($user_id);
        if (isset ($_POST['create']) ) {
            $battle = new Battle;
            $battle->user10 = $user;
            $battle->save();
            $this->redirect(Yii::app()->createUrl('battle/index'));
        }
		$this->render('create', array('user' => $user) );
	}

    /**
     * TODO запилить страницу или функцию получения статистики боя
     */
	public function actionGetResults($id)
	{
		$this->render('getResults');
	}

    /**
     * TODO Гравець має отримати сторінку боя або сторінку інформаціі про попередній бій
     */
	public function actionIndex()
	{
        $user_id = Yii::app()->user->isGuest ? false : Yii::app()->user->id;

        if(!empty ($user_id)) {
            $battle = Battle::getActiveBattle($user_id);
            if( empty($battle) ) {
                Yii::app()->user->setFlash('notice', 'У Вас нет текущих битв.');
                $lobby = Battle::getBattleLobby($user_id);
                if($lobby) {
                    Yii::app()->clientScript->registerScriptFile('/js/lobby.js', CClientScript::POS_END);
                    $this->render('lobby', array('lobby' => $lobby));
                }
                $this->render('lobby', array('lobby' => array()));
//                $this->redirect(Yii::app()->createUrl('site/index'));
            } else {
                $user_number = $battle->getUserNumber($user_id);
                $turn = Turn::getCurrent($battle->id);
                if($turn) {
                    if(!empty($_REQUEST)) {
                        $turn->processFormData($_REQUEST);
                    }
                    $turn = $turn->toTurnArrayForUser($user_id);
                } else {
                    $turn = array();
                }
                $last_turn = Turn::getLast($battle->id);
                $this->render('index', array('battle' => $battle, 'last_turn'=>$last_turn, 'turn'=>$turn));
            }
        } else {
            $this->redirect(Yii::app()->createUrl('/login'));
        }
	}

    /**
     * поки не знаю навіщо
     */
    public function actionInit()
	{
		$this->render('init');
	}

    /**
     * Суперник робить заявку увійти до лоббі
     * @param int $id ID хоста
     * TODO Вирішити, можливо буде реалізація з id битви
     */
	public function actionJoin($id)
	{
        $user_id = Yii::app()->user->id;
        if(!is_numeric($id) || $id == $user_id) {
            throw new InvalidArgumentException;
        }
        $battle = Battle::getBattleLobby($id);
        if ($battle) {
           if( empty($battle->user2) ) {
               $battle->user2 = $user_id;
               $battle->validate() && $battle->save();
               echo json_encode(array('status'=>'joined'));
           } else {
               if($battle->user2 == $user_id) {
                   if(!empty($battle->time_begin)) {
                       echo json_encode( array('status' => 'started') );
                   } else {
                       echo json_encode( array('status' => 'waiting') );
                   }
               } else {
                   if(!empty($battle->time_begin)) {
                       echo json_encode( array('status' => 'another'));
                   } else {
                       echo json_encode( array('status' => 'closed'));
                   }
               }
           }
        } else {
            echo json_encode( array( 'status' => 'false'));
        }

		$this->render('join');
	}

    public function actionLobbyList() {
        $user_id = Yii::app()->user->id;
        $user = User::model()->findByPk($user_id);
        $battles = Battle::findLobbies();
        if (isset($_POST['ajax']) ) {
            $data = array();
            foreach ($battles as $battle) {
                $battle_data = array(
                    'battle' => $battle->attributes,
                    'user1' => $battle->user10->attlibutes
                );
                $data[] = $battle_data;
            }
            echo json_encode($data);
        } else {
            $this->render('lobbyList');
        }
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
                //TODO перевірити, чи є екшни, для яких не потрібна авторізація
            )
        );
    }
}