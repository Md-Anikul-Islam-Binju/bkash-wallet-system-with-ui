<?php

namespace App\Services;

use App\Models\User;

class BkashService
{
    public function createAgreement(User $user)
    {
        /**
         * Normally:
         * POST /tokenized-checkout/agreement/create
         * Redirect user to bkashURL
         */

        // MOCK RESPONSE
        $agreementId = 'AGREEMENT_' . uniqid();
        $masked = '01905****528';

        return [
            'agreementId' => $agreementId,
            'masked' => $masked
        ];
    }

    public function paymentWithAgreement(string $agreementId, float $amount): array
    {
        /**
         * POST /payment-with-agreement/create
         */

        return [
            'paymentId' => 'bkash_' . uniqid(),
            'trxId'     => 'TRX' . rand(100000,999999),
            'status'    => 'success'
        ];
    }

    public function refund(string $paymentId,string $trx,float $amount): bool
    {
        /**
         * POST /payment/refund
         */
        return true;
    }
}
