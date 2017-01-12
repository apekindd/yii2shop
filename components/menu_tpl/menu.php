<?php
use yii\helpers\Url;
?>
<li>
    <!--<a href="<?=Url::to(['category/view', 'alias'=>$category['alias']])?>">-->
    <a href="<?=Yii::$app->urlManager->createAbsoluteUrl("category".$path)?>">
        <?= $category['name'] ?>
        <?php if(isset($category['childs'])){ ?>
            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
        <?php } ?>
    </a>
    <?php if(isset($category['childs'])){ ?>
        <ul>
            <?=$this->getMenuHtml($category['childs'])?>
        </ul>
    <?php } ?>
</li>

