<?php
/**
 *
 * @var BattleController $this
 * @var PsiWhiteSpace $battle
 */
?>
<h1>Поиск боя</h1>

<form method="post" action="<?php echo Yii::app()->createUrl('battle/create'); ?>">
    <input type="submit" value="Создать лобби" name="create">
</form>
<form method="post" action="<?php echo Yii::app()->createUrl('battle/lobbyList'); ?>">
    <input type="submit" value="Найти лобби" name="submit">
</form>