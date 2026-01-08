<?php
namespace App\Services;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class WalletService
{
    public function pay(User $user, float $amount)
    {
        $lockKey = 'wallet_pay_' . $user->id;
        $lock = Cache::lock($lockKey, 10);

        if (! $lock->get()) {
            throw new \Exception('Duplicate payment attempt');
        }

        try {
            DB::transaction(function () use ($user, $amount) {

                $wallet = $user->wallet;

                if (! $wallet || ! $wallet->agreement_id) {
                    throw new \Exception('Wallet not connected');
                }

                $bkash = app(BkashService::class);

                $response = $bkash->paymentWithAgreement(
                    $wallet->agreement_id,
                    $amount
                );

                $wallet->increment('balance', $amount);

                Transaction::create([
                    'user_id'    => $user->id,
                    'wallet_id'  => $wallet->id,
                    'payment_id' => $response['paymentId'],
                    'trx_id'     => $response['trxId'],
                    'amount'     => $amount,
                    'type'       => 'credit',
                    'status'     => 'success'
                ]);
            });
        } finally {
            $lock->release();
        }
    }
}
