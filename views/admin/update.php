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
    if($model->type == 1 && $model->uid != \Yii::$app->user->identity->uid){

    ?>
        <div class="quit">
            <a href="/site/logout">退出</a>
        </div>
        <div class="partner_account">
            <div class="partner_account_manage">
                <p><?=$model->username?></p>
                <div class="partner_account_eqit">
                    <form action="/admin/update?id=<?=$model->uid?>" method="post" enctype="multipart/form-data">
<!--                        <img class="defaule_img"  src="" alt="" style="width:40px;height:40px">-->
<!--                        <input type="file" name="file" accept="image/gif,image/jpeg,image/png,image/bmp,image/jpg" name="file">-->
                        <div class="img_upload">
                            <p>
                                <?php
                                if(empty($model->img)){
                                ?>
                                <img class="defaule_img" src="../images/gogo-star.png" alt="">
                                <?php
                                }else{
                                ?>
                                <img class="partner_img" src="<?= $model->img?>" alt="">
                                <?php
                                }
                                ?>
                                <input class="upload_file"
                                       ref="input"
                                       type="file"
                                       name="file"
                                       accept="image/gif,image/jpeg,image/png,image/bmp,image/jpg"
                                >
                            </p>
                            <span>(点击图片，重新上传)</span>
                        </div>
                        <input class="account" name="username" type="text" value="<?= $model->username; ?>" placeholder="登录名">
                        <input class="pwd" type="password" name="password" value="<?= $model->password; ?>" placeholder="密码">
                        <input class="account" type="text" name="type_of_cooperation" value="<?= $model->type_of_cooperation; ?>" placeholder="合作方式">
                        <input class="account" type="text" name="area" value="<?= $model->area; ?>" placeholder="区域">
                        <button class="partner_account_sub">提交</button>
                    </form>
                </div>
            </div>
            <div class="partner_account_list">
                <p><?= Html::encode($this->title) ?></p>
                <?php
                    $info = \app\models\Admin::find()->where(['type'=>3])->andWhere(['not in','uid',$model->uid])->asArray()->all();

                ?>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>名称</th>
                            <th>密码</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($info as $value){

                        ?>
                            <tr>
                                <td>
                                    <p><img src="<?= $value['img']?>" alt=""></p>
                                </td>
                                <td><?= $value['username']?></td>
                                <td><?= $value['password']?></td>
                                <td><a href="/admin/update?id=<?=$value['uid'];?>">编辑</a></td>
                            </tr>
                            <?php
                        }

                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    <?php
    }else{
        if(\Yii::$app->user->identity->uid != $model->uid){
            echo "<script>window.history.back(-1);</script>";
        }
    ?>
        <div class="quit">
            <a href="/site/logout">退出</a>
            <p class="extension_link">
                成长日记推广链接：<a href="#">https://www.colavia.com.cn/cn/index.php?id=6</a>
            </p>
        </div>
        <div class="main_account_manage">
            <p><?= Html::encode($this->title) ?></p>
            <div class="main_account_eqit">
                <form action="/admin/update?id=<?=$model->uid?>" method="post" enctype="multipart/form-data">
                    <!--                        <img class="defaule_img"  src="" alt="" style="width:40px;height:40px">-->
                    <!--                        <input type="file" name="file" accept="image/gif,image/jpeg,image/png,image/bmp,image/jpg" name="file">-->
                    <div class="img_upload">
                        <p>
                            <?php
                            if(empty($model->img)){
                            ?>
                            <img class="defaule_img" src="../images/gogo-star.png" alt="">
                            <?php
                            }else{
                            ?>
                            <img class="partner_img" src="<?= $model->img?>" alt="">
                            <?php
                            }
                            ?>
                            <input class="upload_file"
                                   ref="input"
                                   type="file"
                                   name="file"
                                   accept="image/gif,image/jpeg,image/png,image/bmp,image/jpg"
                            >
                        </p>
                        <span>(点击图片，重新上传)</span>
                    </div>
                    <input class="account" name="username" type="text" value="<?= $model->username; ?>" placeholder="登录名">
                    <input class="pwd" type="text" name="password" value="<?= $model->password; ?>" placeholder="密码">
                    <button class="partner_account_sub">提交</button>
                </form>
            </div>
        </div>
    <?php
    }
    ?>
</div>
