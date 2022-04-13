<?php

namespace App\Traits;

/**
 * make json responses
 *
 * Trait ResponseUtilsTrait
 * @package App\Traits
 */
trait ResponseUtilsTrait
{
    /**
     * send a success json message
     *
     * @param string $message
     * @param int|null $httpCode
     * @param int|null $responseCode
     * @param string $responseStatus
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError(string $message = '', int $httpCode = null, int $responseCode = null, string $responseStatus = '')
    {
        $message = empty($message) ? trans('apiMessages.response.failed') : $message;
        $httpCode = empty($httpCode) ? config('responseCode.badRequest') : $httpCode;
        $responseCode = empty($responseCode) ? config('responseCode.globalError') : $responseCode;
        $responseStatus = empty($responseStatus) ? trans('apiMessages.response.failedStatus') : $responseStatus;

        $result = [
            'status' => strval($responseStatus),
            'responseCode' => intval($responseCode),
            'message' => strval($message),
        ];

        return response()->json(
            $result,
            $httpCode,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * send an error json message
     *
     * @param array $data
     * @param int|null $httpCode
     * @param string $message
     * @param int|null $responseCode
     * @param string $responseStatus
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($data = [], string $message = '', int $httpCode = null, int $responseCode = null, string $responseStatus = '')
    {
        $message = empty($message) ? trans('apiMessages.response.success') : $message;
        $httpCode = empty($httpCode) ? config('responseCode.responseOk') : $httpCode;
        $responseCode = empty($responseCode) ? config('responseCode.globalSuccess') : $responseCode;
        $responseStatus = empty($responseStatus) ? trans('apiMessages.response.successStatus') : $responseStatus;

        $result = [
            'status' => strval($responseStatus),
            'responseCode' => intval($responseCode),
            'message' => strval($message),
            'data' => $data,
        ];

        return response()->json(
            $result,
            $httpCode,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }

}
