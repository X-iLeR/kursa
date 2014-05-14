<?php
/**
 * Created by PhpStorm.
 * User: shikon
 * Date: 12.05.14
 * Time: 21:31
 */

class Helpers {

    public static function echoErrorSuccessFlashes() {
        if (Yii::app()->user->hasFlash('OK')) {
            echo '<div class="flash-success">' . Yii::app()->user->getFlash('OK')."<br /></div>";
        }
        if (Yii::app()->user->hasFlash('error')) {
            echo '<div class="flash-error">' . Yii::app()->user->getFlash('error')."<br /></div>";
        }
    }

    public static function echoBool($expression) {
        if(!empty($expression) && !!$expression) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

} 