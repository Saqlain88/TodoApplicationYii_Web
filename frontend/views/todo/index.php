<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TodoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Todos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="todo-index">


	<h1><?= Html::encode($this->title) ?></h1>
	<br>
		<?php echo $this->render('_index_form', ['model' => $todo]); ?>
	<br>
	<p>
        <?= Html::a('Remove All', ['clear'], ['class' => 'btn btn-danger', 'id' => 'remove-button']) ?>
    </p>
	<?php Pjax::begin(['id'=>'todo-grid']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'category_id',
                'format' => 'raw',
                'value' => function ($data) {
                return !empty($data->category->name)?$data->category->name:'';
                }
            ],
            [
                'attribute' => 'timestamp',
                'format' => 'raw',
                'filter' => DatePicker::widget([
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                    ],
                    'model' => $searchModel,
                    'attribute' => 'timestamp',
                    'options' => [
                        'id' => 'timestamp',
                        'class' => 'form-control'
                    ]
                ]),
                'value' => function ($data) {
                return date('Y-m-d', strtotime($data->timestamp));
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
	</div>
<?php
$script = <<< JS
        	$(document).ready(function(){
        	$('#todo-form').on('beforeSubmit', function(e) {
            var form = $(this);
            var formData = form.serialize();
            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: formData,
                success: function (data) {
                    $('#todo-form').trigger("reset");
                    $.pjax.reload({container:'#todo-grid'});
                },
                error: function () {
                    alert("Something went wrong");
                }
            });
        }).on('submit', function(e){
            e.preventDefault();
        });
        });
JS;
$this->registerJs($script);
?>
