<?php


namespace App\Services\Payment;


class Payment
{

    public $payment;

    public function __construct(PaymentInterface $payment)
    {
        $this->payment = $payment;
    }

    public function payRequest($user, int $amount, string $callbackUrl)
    {
        return $this->payment->payRequest($user, $amount, $callbackUrl);
    }

    public function payVerify(array $data)
    {
        return $this->payment->payVerify($data);

    }

}
