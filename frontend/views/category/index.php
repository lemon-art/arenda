<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin category index">
  <?php
  $this->breadcrumbs=array(
   'Дерево категорий',
  );
  $this->menu=array(
   array('label'=>'Создать', 'url'=>array('create')),
   array('label'=>'Менеджер', 'url'=>array('admin')),
  );
  ?>
  <h1>Дерево категорий</h1>
  [<?=$root->id?>] <?=$root->name?>
  <a class="view" title="View" href="<?=Yii::app()->createUrl('/admin/category/view', array('id'=>$root->id))?>">view</a>
  <a class="update" title="Update" href="<?=Yii::app()->createUrl('/admin/category/update', array('id'=>$root->id))?>">update</a>
  <?php echo CHtml::link('delete" alt="Delete">',"#", array("submit"=>array('delete', 'id'=>$root->id), 'confirm' => 'Are you sure?')); ?>
  <?
  $level=0;
  foreach($categories as $n=>$category)
  {
  if($category->level==$level)
  echo '</li>';
  else if($category->level>$level)
  echo '<ul>';
  else
  {
  echo '</li>';
  for($i=$level-$category->level;$i;$i--)
  {
  echo '</ul>';
  echo '</li>';
  }
  }
  ?>
  <li>
  [<?=$category->id?>] <?=$category->name?>
  <a class="view" title="View" href="<?=Yii::app()->createUrl('/admin/category/view', array('id'=>$category->id))?>">view</a>
  <a class="update" title="Update" href="<?=Yii::app()->createUrl('/admin/category/update', array('id'=>$category->id))?>">update</a>
  <?php echo CHtml::link('delete',"#", array("submit"=>array('delete', 'id'=>$category->id), 'confirm' => 'Are you sure?')); ?>
  <?
  $level=$category->level;
  }
  ?>
  <? for($i=$level;$i;$i--): ?>
  </li>
  </ul>
  <? endfor;?>
</div>