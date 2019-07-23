<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\data\ArrayDataProvider;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;


/* @var $this View */
/* @var $dataProvider ArrayDataProvider */

$this->title = 'Files Application';
?>
<div class="site-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'name',
            'size',
            'extension',
            [
                'format' => ['datetime', 'php: d.m.Y H:i:s'],
                'attribute' => 'date',
            ]
        ],
    ]); ?>

    <?php $form = ActiveForm::begin(['action' => Url::to(['/site/refresh'])])?>

    <?= Html::submitButton('Refresh', ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>

</div>
