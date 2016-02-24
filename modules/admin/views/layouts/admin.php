<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


\app\assets\Dialog2Assets::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <script src="../../js/socket.js"></script>
    <script type="text/javascript">
        socket = new __Socket({
            host: '<?= Yii::$app->params['socketHost'] ?>'
        });
    </script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Админ Панел',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse',
        ],
    ]);

    $items = [
        ['label' => 'Dashboard', 'url' => ['/admin/default/index']]
    ];

    if(Yii::$app->user->checkAccess(\app\models\Group::GROUP_ADMIN)){
        $items[] = ['label' => 'Потребители', 'url' => ['/admin/users/index']];
        $items[] = ['label' => 'Настройки', 'url' => ['/admin/settings/index']];
    }

    $items = array_merge($items, [
        ['label' => 'Събития', 'url' => ['/admin/event/index']],
        ['label' => 'Изход', 'url' => ['/site/index']]
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<script type="text/javascript">
    $(function(){
        $(document).controls();
    });
</script>
</body>
</html>
<?php $this->endPage() ?>
