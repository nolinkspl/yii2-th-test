<?php namespace app\components\BalanceHandler;

use app\components\BalanceHandler\exceptions\TransferMoneyException;
use app\models\User;
use Yii;

class Handler
{

    /**
     * @param User $user
     * @param $amount
     * @throws TransferMoneyException
     * @throws \Throwable
     */
    public function transferMoneyTransaction(User $user, $amount)
    {
        /** @var User $currentUser */
        $currentUser = User::findIdentity(Yii::$app->user->getId());
        if ($user->id === $currentUser->id) {
            throw new TransferMoneyException('Same user transfer');
        }

        if ($currentUser->balance - $amount < -1000) {
            throw new TransferMoneyException('Balance can not be smaller than -1000');
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            $currentUser->charge($amount);
            $user->income($amount);

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}