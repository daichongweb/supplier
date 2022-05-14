<?php

use app\models\Supplier;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchSupplier */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Suppliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Supplier', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Export Supplier', 'javascript:exportTable()', ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([

        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'id',
            ],
            'id',
            'name',
            'code',
            [
                'attribute' => 't_status',
                'filter' => \app\models\SearchSupplier::statusMap(),
                'options' => ['placeholder' => '请选择状态']
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Supplier $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
    <script>
        function exportTable() {
            // 选择了全部
            let checkAll = $('.select-on-check-all').is(':checked');
            let data = {
                'all': checkAll ? 1 : 0,
                'check_item': []
            };
            if (!checkAll) {
                let checkVal = []
                $("input[name*='id[]']:checked").each(function () {
                    checkVal.push($(this).val());
                })
                data.check_item = checkVal.join(',');
            }
            window.location.href = "<?=Url::to('?r=supplier/export')?>" + '&is_all=' + data.all + '&check_item=' + data.check_item
        }

    </script>
</div>
