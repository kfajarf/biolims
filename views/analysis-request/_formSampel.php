<?php

use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-sampels',
    'widgetItem' => '.sampel-item',
    'limit' => 14,
    'min' => 1,
    'insertButton' => '.add-sampel',
    'deleteButton' => '.remove-sampel',
    'model' => $modelsSampel[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'description'
    ],
]); ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Rincian</th>
            <th class="text-center">
                <button type="button" class="add-sampel btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
            </th>
        </tr>
    </thead>
    <tbody class="container-sampels">
    <?php foreach ($modelsSampel as $indexSampel => $modelSampel): ?>
        <tr class="sampel-item">
            <td class="vcenter">
                <?php
                    // necessary for update action.
                    if (! $modelSampel->isNewRecord) {
                        echo Html::activeHiddenInput($modelSampel, "[{$indexAnalisis}][{$indexSampel}]id");
                    }
                ?>
                    <div class="row" >
                        <div class="col-sm-3" style="padding-right: 0px">
                            <?= $form->field($modelSampel, "[{$indexAnalisis}][{$indexSampel}]sampel_id")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-7" style="padding-right: 0px">
                            <?= $form->field($modelSampel, "[{$indexAnalisis}][{$indexSampel}]nama_sampel")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-2">
                            <?= $form->field($modelSampel, "[{$indexAnalisis}][{$indexSampel}]kemasan")->textInput(['maxlength' => true]) ?>
                        </div>  
                    </div> 
            </td>
            <td class="text-center vcenter" style="width: 90px;">
                <button type="button" class="remove-sampel btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
            </td>
        </tr>
     <?php endforeach; ?>
    </tbody>
</table>
<?php DynamicFormWidget::end(); ?>