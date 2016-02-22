<?php

/* @var $this app\components\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="/js/socket.js"></script>
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
        'brandLabel' => '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAMAAAC7IEhfAAAA81BMVEX///9VPnxWPXxWPXxWPXxWPXxWPXxWPXz///9hSYT6+vuFc6BXPn37+vz8+/z9/f2LeqWMe6aOfqiTg6uXiK5bQ4BZQX9iS4VdRYFdRYJfSINuWI5vWY9xXJF0YJR3Y5Z4ZZd5ZZd6Z5h9apq0qcW1qsW1q8a6sMqpnLyrn76tocCvpMGwpMJoUoprVYxeRoJjS4abjLGilLemmbrDutDFvdLPx9nX0eDa1OLb1uPd1+Td2OXe2eXh3Ofj3+nk4Orl4evp5u7u7PLv7fPx7/T08vb08/f19Pf29Pj39vn6+fuEcZ9YP35aQn/8/P1ZQH5fR4PINAOdAAAAB3RSTlMAIWWOw/P002ipnAAAAPhJREFUeF6NldWOhEAUBRvtRsfdfd3d3e3/v2ZPmGSWZNPDqScqqaSBSy4CGJbtSi2ubRkiwXRkBo6ZdJIApeEwoWMIS1JYwuZCW7hc6ApJkgrr+T/eW1V9uKXS5I5GXAjW2VAV9KFfSfgJpk+w4yXhwoqwl5AIGwp4RPgdK3XNHD2ETYiwe6nUa18f5jYSxle4vulw7/EtoCdzvqkPv3bn7M0eYbc7xFPXzqCrRCgH0Hsm/IjgTSb04W0i7EGjz+xw+wR6oZ1MnJ9TWrtToEx+4QfcZJ5X6tnhw+nhvqebdVhZUJX/oFcKvaTotUcvUnY188ue/n38AunzPPE8yg7bAAAAAElFTkSuQmCC" /> <h3>Stefkoff</h3>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse ',
        ],
    ]);

    $items = [
        ['label' => 'Начало', 'url' => ['/site/index']]
    ];

    if(Yii::$app->user->isGuest){
        if(isset($this->settings['show_panel_events']) && $this->settings['stop_registrations'] != '1'){
            $items[] = ['label' => 'Регистрация', 'url' => ['/site/register']];
        }
    } else{
        $items = array_merge($items, [
            ['label' => 'На живо', 'url' => ['/site/live']],
            ['label' => 'Програма', 'url' => ['/site/schedule']]
        ]);
    }

    $items = array_merge($items, [
        ['label' => 'За нас', 'url' => ['/site/about']],
    ]);

    if(Yii::$app->user->checkAccess(\app\models\Group::GROUP_ADMIN)){
        $items = array_merge($items, [
            ['label' => 'Амин панел', 'url' => ['/admin/default/index']]
        ]);
    }

    $items = array_merge($items, [
        Yii::$app->user->isGuest ?
            ['label' => 'Вход', 'url' => ['/site/login']] :
            [
                'label' => 'Изход (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ],
    ]);


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items
    ]);
    NavBar::end();
    ?>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <?php if(isset($this->settings['show_panel_events']) && $this->settings['show_panel_events'] == '1'): ?>
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3>Събития</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            test
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-8 text-left">
            <?= $content ?>
        </div>
        <div class="col-sm-2 sidenav">
            <div class="well">
                <p>ADS</p>
            </div>
            <div class="well">
                <p>ADS</p>
            </div>
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
