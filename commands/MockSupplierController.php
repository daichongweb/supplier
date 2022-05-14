<?php

namespace app\commands;

use Yii;
use yii\base\Exception;
use yii\console\Controller;

class MockSupplierController extends Controller
{
    const T_STATUS = ['ok', 'hold'];

    /**
     * @throws Exception
     */
    public function actionIndex()
    {
        // mock20条数据
        $faker = \Faker\Factory::create();
        $suppliers = [];
        for ($i = 1; $i <= 20; $i++) {
            $suppliers[] = [
                'name' => $faker->name(),
                'code' => Yii::$app->getSecurity()->generateRandomString(3),
                't_status' => self::T_STATUS[array_rand(self::T_STATUS)],
            ];
        }
        // 批量插入
        $connection = \Yii::$app->db;
        $connection->createCommand()->batchInsert(
            '{{%supplier}}',
            ['name', 'code', 't_status'],
            $suppliers
        )->execute();
    }
}