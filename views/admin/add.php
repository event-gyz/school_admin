<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Admin */

?>
<div class="admin-create">

    <div class="add_partner_manage">
        <p>添加合作商</p>
        <div class="partner_manage_form">
            <div class="img_upload">
                <p>
                    <img class="partner_img" src="" alt="">
                    <img class="defaule_img" src="../images/gogo-star.png" alt="">
                    <input class="upload_file"
                           ref="input"
                           type="file"
                           accept="image/gif,image/jpeg,image/png,image/bmp,image/jpg"
                    >
                </p>
                <span>(点击图片，重新上传)</span>
                <input class="partner_name" type="text" placeholder="名称">
                <input class="partner_type" type="text" placeholder="合作类型">
                <input class="partner_address" type="text" placeholder="地区">
                <button class="partner_manage_sub">提交</button>
            </div>
        </div>
    </div>

</div>
<script>
    $('.add_partner_manage').fadeIn()
</script>
