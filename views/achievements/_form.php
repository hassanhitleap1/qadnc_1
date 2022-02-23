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
    $image_path='';
    if(str_contains($model->image, 'youtube')){
        $image_path=  $model->image;
        }else{
            $image_path= Yii::getAlias('@web') . '/' . $model->image;
        }
    $dataImages = [
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false,
        'initialPreview' => [
            $image_path
        ],
        'initialPreviewAsData' => true,
        'initialCaption' => $image_path,
        'initialPreviewConfig' => [
            ['caption' => $image_path],
        ],
        'overwriteInitial'=>true

    ];
}


/* @var $this yii\web\View */
/* @var $model app\models\achievements\Achievements */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="achievements-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file')->widget(\kartik\file\FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => $dataImages
            ]);

            ?>

    <?= $form->field($model, 'vedio')->textInput();?>

    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
