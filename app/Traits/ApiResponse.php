<?php
namespace App\Traits;

trait ApiResponse
{
    private $failMessage = 'بروز خطا در انجام عملیات.';
    private $successMessage = 'عملیات با موفقیت انجام شد.';

    public function getFailResponse($code = 400, $message = '')
    {
        $failMessage = empty($message) ? $this->failMessage : $message;
        return response()
            ->json(['status' => 'fail', 'message' => $failMessage], $code, [],JSON_UNESCAPED_UNICODE);
    }

    public function getSuccessResponse($data, $message = '', $code = 200)
    {
        $successMessage = empty($message) ? $this->successMessage : $message;
        return response()
            ->json(['result' => ['status' => 'success', 'message' => $successMessage], 'data' => $data], $code, [], JSON_UNESCAPED_UNICODE);
    }
}

?>