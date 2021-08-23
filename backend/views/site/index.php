<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-2"><?php echo Yii::t('yii', 'Welcome') ?></h1><br>

        <p><a class="btn btn-lg btn-light" href="<?= Url::toRoute(['/frontend/site/create-todo']) ?>"><?= Yii::t('yii', 'Create your Todo') ?></a></p>
    </div>

    <div class="body-content">

        

    </div>
</div>
