<?php
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use kartik\date\DatePicker;

$form = ActiveForm::begin([
    'id' => 'todo-form',
    'method' => 'POST',
    'action' => Url::toRoute([
        '/todo/add-todo'
    ])
]);
?>
<div class="form-row">
	<div class="col">
		<?= $form->field($model, 'category_id')->dropDownList($model->getCategoryList())->label(false) ?>
    </div>
	<div class="col">
      <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => "Name"])->label(false) ?>
    </div>

	<div class="col-auto">
		<button type="submit" class="btn btn-success mb-2">Add Task</button>
	</div>
</div>
<?php ActiveForm::end();?>

