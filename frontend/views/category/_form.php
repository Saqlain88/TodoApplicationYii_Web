<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'id' => 'cat-form',
        'method' => 'POST',
        'action' => Url::toRoute([
            '/category/create'
        ])
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <center>
        	<?= Html::submitButton('Add Category', ['class' => 'btn btn-success', 'id'=> 'cat-form-submit']) ?>
       	</center>
    </div>

    <?php ActiveForm::end(); ?>

</div>
