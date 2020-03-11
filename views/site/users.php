<?php

use app\models;
use app\assets;

/**
 * @var yii\web\View $this
 * @var models\User[] $users
 */

use yii\helpers\Html;

assets\UsersListAsset::register($this);

$this->title = 'Users list';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach ($users as $user) { ?>
        <div class="row">
            <div class="col-md-1"><?= $user->getId() ?></div>
            <div class="col-md-2"><?= Html::encode($user->username()) ?></div>
            <div class="col-md-3"><?= $user->balance() ?></div>

            <?php if (!empty(Yii::$app->user->id) && $user->getId() !== Yii::$app->user->id) { ?>
                <div class="col-md-3 btn btn-default js-transfer-money-button" data-user-id="<?= $user->getId() ?>">Transfer money</div>
            <?php } ?>
        </div>
    <?php } ?>
</div>


<div class="js-transfer-money-popup transfer-money-popup popover">
    <div class="popover-title"></div>
    <div class="popover-content">
        <form href="">
            <label>Amount<input name="amount" type="number" required></label>
            <button>Send</button>
        </form>
    </div>
</div>
