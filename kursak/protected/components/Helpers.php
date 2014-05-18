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

    public static function echoIfTrue($text, $condition = true) {
        if(!isset($text)) {
            $text = '';
        }
        if( $condition) {
            echo($text);
            return $text;
        }
        return false;
    }

    public static function returnJson ($answer) {
        echo json_encode($answer);
        die();
    }

    public static function secs_to_str($secs)
    {
        $units = array(
            "нед"   => 7*24*3600,
            "дн"    =>   24*3600,
            "ч"   =>      3600,
            "мин" =>        60,
            "сек" =>         1,
        );

        // specifically handle zero
        if ( $secs == 0 ) return "0 секунд";

        $s = "";

        foreach ( $units as $name => $divisor ) {
            if ( $quot = intval($secs / $divisor) ) {
                $s .= "$quot $name";
                $s .= /*(abs($quot) > 1 ? "s" : "") . */  ", ";
                $secs -= $quot * $divisor;
            }
        }

        return substr($s, 0, -2);
    }

} 