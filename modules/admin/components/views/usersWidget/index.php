<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/22/2016
 * Time: 3:37 PM
 *
 * @var $message string
 * @var $registeredUsers integer
 */
?>

<div class="container-fluid users-widget">
    <div class="header">
        <h4>Потребители</h4>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-11">
                <p>Активни потребители</p>
            </div>
            <div class="col-md-1">
                <strong><span class="active-users"></span></strong>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11">
                <p>Регистрирани потребители</p>
            </div>
            <div class="col-md-1">
                <strong><span class="registered-users"><?= $registeredUsers ?></span></strong>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var activeUsers = new ActiveUsers();
</script>