<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ImportController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($city = 'bj') {
        $file = './data/bch_' . $city . '.txt';
        $content = file_get_contents($file);
        $content = explode("\n", $content);
        //        $data = json_decode($content, true);
        foreach ($content as $row) {
            $data = json_decode($row, true);
            print_r($data);exit;

        }
    }

}
