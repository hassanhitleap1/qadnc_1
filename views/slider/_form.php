<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



if ($model->isNewRecord) {
    $dataImages = [
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
    ];
}else{
    $dataImages = [
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false,
        'initialPreview' => [
            Yii::getAlias('@web') . '/' . $model->image
        ],
        'initialPreviewAsData' => true,
        'initialCaption' => Yii::getAlias('@web') . '/' . $model->image,
        'initialPreviewConfig' => [
            ['caption' => $model->image],
        ],
        'overwriteInitial'=>true

    ];
}

/* @var $this yii\web\View */
/* @var $model app\models\slider\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

         <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


        <?= $form->field($model, 'file')->widget(\kartik\file\FileInput::classname(), [
            'options' => ['accept' => 'image/*','placeholder'=>Yii::t('app','Logo')],
            'pluginOptions' => $dataImages
            ])->label(Yii::t('app','Image'));?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
