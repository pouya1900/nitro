<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\AppException;
use App\Models\Comment;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Traits\ResponseUtilsTrait;
use Illuminate\Support\Facades\Validator;
use App\Models\Region;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Post;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use ResponseUtilsTrait;

    public function fallback()
    {
        return $this->sendError(trans('api/messages.fallback'), config('responseCode.notFound'));
    }

    protected function validateRequest(array $requestData, array $rules)
    {
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            throw new AppException($validator->errors()->first(), config('responseCode.validationFail'));
        }
    }

    protected function getPerPage()
    {
        $this->validateRequest($this->request->input(), [
            'per_page' => 'nullable|integer|between:1,100',
        ]);

        return $perPage = empty($this->request->per_page) ? config('global.api.perPage') : $this->request->per_page;
    }



}
