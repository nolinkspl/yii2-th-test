<?php

use app\models;

/**
 * @var yii\web\View $this
 * @var models\User[] $users
 */

use yii\helpers\Html;

$this->title = 'Users list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach ($users as $user) { ?>
        <p>
            <?= "{$user->getId()}. {$user->username()} - {$user->balance()}" ?>
        </p>
    <?php } ?>
</div>
