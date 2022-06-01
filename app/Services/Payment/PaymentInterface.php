<?php

namespace App\Services\Payment;
interface PaymentInterface
{
    public function payRequest($user, int $amount, string $callbackUrl);

    public function payVerify(array $data);
}
