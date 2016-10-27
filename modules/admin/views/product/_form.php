<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
<?php //echo '<pre>';print_r($model); echo '</pre>'; ?>
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <div class="form-group field-product-category_id has-success">
        <label class="control-label" for="product-category_id">Родительская категория</label>
        <select id="product-category_id" class="form-control" name="Product[category_id]">
            <?= \app\components\MenuWidget::widget(['tpl'=>'select_product', 'model'=>$model]); ?>
        </select>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

   <?php
   echo $form->field($model, 'content')->widget(CKEditor::className(),[
       'editorOptions' => ElFinder::ckeditorOptions([
           'elfinder',
           //'path' => 'some/sub/path'
       ],[]),
    ]);
   ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true]) ?>

    <?= $form->field($model, 'hit')->checkbox([ '0'=>'Нет', '1'=>"Да", ]) ?>

    <?= $form->field($model, 'new')->checkbox([ '0'=>'Нет', '1'=>"Да", ]) ?>

    <?= $form->field($model, 'sale')->checkbox([ '0'=>'Нет', '1'=>"Да", ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
