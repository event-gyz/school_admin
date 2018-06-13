<?php

namespace app\commands;

use yii\console\Controller;
use app\models\RfpRequestForProposal;


class UpdaterfpstatusController extends Controller
{

    public function actionIndex()
    {
        $data = RfpRequestForProposal::find()->where(['id'=>944])->one();
        print_r($data  );
    }
}
