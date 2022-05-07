<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Suppliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Create Supplier', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::button('Export', array('id'=>'exportBtn','class'=>'btn btn-primary', 'disabled'=>'disabled')); ?>
    </p>

    <div id="prompt" class="alert alert-secondary" style="display: none"><span></span> <a id="selectAll" href="javascript:;"></a></div>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'id' => 'grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->id];
                }
            ],

            'id',
            'name',
            'code',
            [
                'attribute'=>'t_status',
                'filter'=>ArrayHelper::map($searchModel::find()->asArray()->all(), 't_status', 't_status'),
                'filterInputOptions' => ['prompt' => 'All status', 'class' => 'form-control', 'id' => null],
            ],

        ],
    ]); ?>

    <?php
    $totalCount = $dataProvider->totalCount;
    $pageSize = $dataProvider->pagination->pageSize;
    $exportUrl = yii\helpers\Url::to(["/supplier/export"]);
    $this->registerJsVar('totalCount', $totalCount);
    $this->registerJsVar('selectAll', false);
    $this->registerJsVar('selectedCount', 0);
    $this->registerJsVar('exportUrl', $exportUrl);

    $registerJS = <<<registerJS
$(document).ready(function(){
    function setDanger(){
        $("#prompt").removeClass("alert-secondary");
        $("#prompt").addClass("alert-danger");
        $("#prompt > span").html("All " + selectedCount + " suppliers on this page have been selected.");
        $("#selectAll").html("Select all suppliers that match this search.");
    }
    function setSecondary(){
        $("#prompt").removeClass("alert-danger");
        $("#prompt").addClass("alert-secondary");
        $("#prompt > span").html("All suppliers in this search have been selected.");
        $("#selectAll").html("clear selection");
    }
    $("input:checkbox").on("change", function() {
        var keys = $("#grid").yiiGridView("getSelectedRows");
        if (keys.length > 0) {
            $('#exportBtn').removeAttr('disabled');
        } else {
            $('#exportBtn').attr('disabled','disabled');
        }
    });
    $("input.select-on-check-all").on("change", function() {
        if ($(this).prop("checked")) {
            var keys = $("#grid").yiiGridView("getSelectedRows");
            selectedCount = keys.length;
            if (totalCount > selectedCount) {
                setDanger();
                $("#prompt").show();
            }
        } else {
            setSecondary();
            $("#prompt > span").html("");
            $("#prompt").hide();
        }
    });

    $("#selectAll").unbind('click').on("click", function() {
        selectAll = !selectAll;
        if (selectAll) {
            setSecondary();
        } else {
            setDanger();
        }
    });

    $('#exportBtn').unbind('click').on('click',function() {

        var params = {'selectAll':selectAll};
        if (selectAll) {
            $("#grid-filters").find("input,select").each(function(){
                params[$(this).attr("name")] = $(this).val();
            });
        } else {
            params['id'] = $("#grid").yiiGridView("getSelectedRows");
            if (params['id'].length == 0) {
                alert('Please select.');
            }
        }
        var downloadUrl = exportUrl + '&' + $.param( params );
        window.location = downloadUrl;
        return true;

        $.ajax({
            type: "GET",
            url: exportUrl,
            data: params,
            xhrFields: {
                responseType: 'blob' // to avoid binary data being mangled on charset conversion
            },
            success:function(response, status, xhr){

                // check for a filename
                var filename = "";
                var disposition = xhr.getResponseHeader('Content-Disposition');
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    var filenameRegex = /filename[^;=\\n]*=((['"]).*?\\2|[^;\\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                }
        
                var type = xhr.getResponseHeader('Content-Type');
                var blob = new Blob([response], { type: type });
        
                if (typeof window.navigator.msSaveBlob !== 'undefined') {
                    // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                    window.navigator.msSaveBlob(blob, filename);
                } else {
                    var URL = window.URL || window.webkitURL;
                    var downloadUrl = URL.createObjectURL(blob);
        
                    if (filename) {
                        // use HTML5 a[download] attribute to specify filename
                        var a = document.createElement("a");
                        // safari doesn't support this yet
                        if (typeof a.download === 'undefined') {
                            window.location = downloadUrl;
                        } else {
                            a.href = downloadUrl;
                            a.download = filename;
                            document.body.appendChild(a);
                            a.click();
                        }
                    } else {
                        window.location = downloadUrl;
                    }
        
                    setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
                }
            },
            error: function(data) {
                alert("Error occured.please try again");
            }
        });

    });
   
});
registerJS;

    $this->registerJs($registerJS);

    ?>


    <?php Pjax::end(); ?>

</div>
