<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
    <ul>
        <li>姓名：<a href="https://www.daichongweb.com">戴崇</a></li>
        <li>年龄：27</li>
        <li>性别：男</li>
        <li>籍贯：河南</li>
        <li>工作经验：5年</li>
        <li>爱好：羽毛球、乒乓球、钓鱼、骑行、王者农药</li>
        <li>熟练掌握技能：php、mysql、redis、css、html、js、功能测试、压力测试等等</li>
        <li>其他技能：vue、python、java</li>
    </ul>

    <p>感谢您花时间review我的代码，期待与您共事~</p>
</div>
