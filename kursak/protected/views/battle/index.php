<?php
/* @var $this BattleController
 * @var $battle Battle
 */

$this->breadcrumbs=array(
	'Battle',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>
<input type="hidden" id="user1_id" value="<?php echo $battle->user1;?>">
<input type="hidden" id="time_begin" value="<?php echo $battle->time_begin;?>">
<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
