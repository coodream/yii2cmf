<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $dataModel common\models\ArticleData */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">附加内容</a></li>
    </ul>
    <?php $form = ActiveForm::begin([
            'options' => ['class' => 'tab-content'],
        ]); ?>
        <div class="tab-pane active" id="tab_1">

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'category_id')->dropDownList(\common\models\Category::getDropDownlist()) ?>

            <?php //$form->field($dataModel, 'content')->widget('kucha\ueditor\UEditor', ['options' => ['style' => 'height:500px']]) ?>
            <?= $form->field($dataModel, 'content')->widget(\yidashi\markdown\Markdown::className(), ['options' => ['style' => 'height:500px']]) ?>

            <?= $form->field($model, 'cover')->widget('yidashi\webuploader\Webuploader') ?>

            <?= $form->field($model, 'status')->checkbox() ?>

        </div>
        <div class="tab-pane" id="tab_2">
            <?= $form->field($model, 'published_at')->widget(
                \kartik\datetime\DateTimePicker::className(),
                [
                    'type' => 1,
                    'convertFormat' => true,
                    'pluginOptions' => ['format' => 'php:Y-m-d H:i:s']
                ]
            ) ?>
            <?= $form->field($model, 'desc')->textarea()?>

            <?= $form->field($model, 'tagNames')->widget(\common\widgets\tag\Tag::className()) ?>

            <?= $form->field($model, 'source')->textInput() ?>

        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? '发布' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>