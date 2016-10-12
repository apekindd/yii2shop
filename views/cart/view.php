<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="container">
    <?php
    if(Yii::$app->session->hasFlash('success')){?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php } ?>
    <?php if(Yii::$app->session->hasFlash('error')){?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php  echo Yii::$app->session->getFlash('error'); ?>
        </div>

    <?php  }  ?>

    <?php if(!empty($session['cart'])){?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Сумма</th>
                <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </thead>
                <tbody>
                <?php foreach($session['cart'] as $id=>$item){?>
                    <tr>
                        <td><a href="<?= Url::to(['product/view', 'id'=>$id]) ?>"><?= \yii\helpers\Html::img("@web/images/products/{$item['img']}", ['alt'=>$item['name'], 'height'=>50]); ?></a></td>
                        <td><a href="<?= Url::to(['product/view', 'id'=>$id]) ?>"><?= $item['name'] ?></a></td>
                        <td><?= $item['qty'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['qty'] * $item['price'] ?></td>
                        <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="4">Итого:</td>
                    <td colspan="3"><?= $session['cart.qty'] ?></td>
                </tr>
                <tr>
                    <td colspan="4">На сумму:</td>
                    <td colspan="3"><?= $session['cart.sum'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr/>
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($order, 'name') ?>
        <?= $form->field($order, 'email') ?>
        <?= $form->field($order, 'phone') ?>
        <?= $form->field($order, 'address') ?>
        <?= Html::submitButton('Оформить',['class'=>'btn btn-success']) ?>
        <?php $form = ActiveForm::end() ?>
    <?php }else{ ?>
        <h3>Корзина пуста</h3>
    <?php } ?>
</div>
