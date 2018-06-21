<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
if(empty($model->type) || ($model->type == 3)){
    $this->title = '合作商';
}else{
    $this->title = '账号管理';
}


?>
<div class="admin-update">

    <?php
    if(empty($model->type) || ($model->type == 3)){
    ?>
        <div class="partner_account">
            <div class="partner_account_manage">
                <p>宝贝星球</p>
                <div class="partner_account_eqit">
                    <p>
                        <img class="defaule_img" src="../images/gogo-star.png" alt="">
                    </p>
                    <input class="account" type="text" placeholder="someone">
                    <input class="pwd" type="password" placeholder="Password">
                    <button class="partner_account_sub">提交</button>
                </div>
            </div>
            <div class="partner_account_list">
                <p><?= Html::encode($this->title) ?></p>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>名称</th>
                            <th>账号</th>
                            <th>密码</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p><img src="../images/logo.png" alt=""></p>
                            </td>
                            <td>巴布豆</td>
                            <td>bobdog</td>
                            <td>bobdog2018</td>
                            <td><a href="#">编辑</a></td>
                        </tr>
                        <tr>
                            <td>
                                <p><img src="../images/nestle.png" alt=""></p>
                            </td>
                            <td>雀巢</td>
                            <td>nestle</td>
                            <td>nestle2018</td>
                            <td><a href="#">编辑</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    }else{
    ?>
        <div class="main_account_manage">
            <p><?= Html::encode($this->title) ?></p>
            <div class="main_account_eqit">
                <div class="img_upload">
                    <p>
                        <img class="designated_img" src="" alt="">
                        <img class="defaule_img" src="../images/gogo-star.png" alt="">
                        <input class="upload_file"
                               ref="input"
                               type="file"
                               accept="image/gif,image/jpeg,image/png,image/bmp,image/jpg"
                        >
                    </p>
                    <span>(点击图片，重新上传)</span>
                </div>
                <input class="account" type="text" placeholder="someone">
                <input class="pwd" type="password" placeholder="Password">
                <button class="main_account_sub">提交</button>
            </div>
        </div>
    <?php
    }
    ?>
</div>
