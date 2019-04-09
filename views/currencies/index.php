<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurrencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Курс валюты';
?>
<div class="currency-index">

    <h1><?= Html::encode($this->title) . ' ' . Html::a('Обновления данных', ['set-course'], ['target' => '_blank', 'class' => 'btn btn-success']) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'rate',
        ],
    ]); ?>


</div>
