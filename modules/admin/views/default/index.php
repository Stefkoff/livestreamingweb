<?php
use app\modules\admin\components\UsersWidget;
use app\assets\DashboardAsset;
use app\assets\SocketAsset;

SocketAsset::register($this);
DashboardAsset::register($this);
?>
<h1>Dashboard</h1>
<div class="admin-dashboard">
    <div class="row">
        <div class="col-md-4">
            <?= UsersWidget::widget() ?>
        </div>
    </div>
</div>