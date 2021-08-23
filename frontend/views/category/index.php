<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <br>
		<?php echo $this->render('_form', ['model' => $category]); ?>
	<br>
	
	<?php Pjax::begin(['id'=>'cat-grid']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',

            [   
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}'
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>

<?php
$script = <<< JS
        	$(document).ready(function(){
        	$('#cat-form').on('beforeSubmit', function(e) {
            var form = $(this);
            var formData = form.serialize();
            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: formData,
                
                success: function (data) {
                console.log(data);
                    $('#cat-form').trigger("reset");
                    $.pjax.reload({container:'#cat-grid'});
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