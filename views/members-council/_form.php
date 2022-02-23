<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\memberscouncil\MembersCouncil */
/* @var $form yii\widgets\ActiveForm */


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
?>

<div class="members-council-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'file')->widget(\kartik\file\FileInput::classname(), [
        'options' => ['accept' => 'image/*','placeholder'=>Yii::t('app','Logo')],
        'pluginOptions' => $dataImages
    ])->label(Yii::t('app','Image'));
    ?>

    <?= $form->field($model, 'general_definition')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'experiences')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'certificates')->textarea(['rows' => 6]) ?>

    

    <?= $form->field($model, 'courses')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
