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

    protected function getRadius()
    {
        $this->validateRequest($this->request->input(), [
            'radius' => 'nullable|integer',
        ]);

        return $radius = empty($this->request->radius) ? config('global.api.radius') : $this->request->radius;
    }

    protected function checkBookmarkStatus($model, $user = null)
    {
        if (empty($user)) {
            return $model;
        }
        if (isset($model->id)) {
            if ($model instanceof Shop) {
                $model->isBookmark = $user->bookmarks->contains($model->id) ? 1 : 0;
            } elseif ($model instanceof Post) {
                $model->isBookmark = $user->bookmarksPost->contains($model->id) ? 1 : 0;
            }

            return $model;
        }

        foreach ($model as $selected) {

            if ($selected instanceof Shop) {
                $selected->isBookmark = $user->bookmarks->contains($selected->id) ? 1 : 0;
            } elseif ($selected instanceof Post) {
                $selected->isBookmark = $user->bookmarksPost->contains($selected->id) ? 1 : 0;
            }

        }

        return $model;
    }


    protected function checkLikeStatus($model, $user = null)
    {

        if (empty($user)) {
            return $model;
        }
        if (isset($model->id)) {
            if ($model instanceof Shop) {
                $model->liked = $user->likes->contains($model->id) ? 1 : 0;
                $model->comments = $this->checkLikeStatus($model->comments, $user);
            } elseif ($model instanceof Product) {
                $model->liked = $user->productLikes->contains($model->id) ? 1 : 0;
            } elseif ($model instanceof Post) {
                $model->liked = $user->postLikes->contains($model->id) ? 1 : 0;
                $model->comments = $this->checkLikeStatus($model->comments, $user);
            } elseif ($model instanceof Comment) {
                $model->liked = $user->commentLikes->contains($model->id) ? 1 : 0;
            }

            return $model;
        }

        foreach ($model as $selected) {

            if ($selected instanceof Shop) {
                $selected->liked = $user->likes->contains($selected->id) ? 1 : 0;
                $selected->comments = $this->checkLikeStatus($selected->comments, $user);

            } elseif ($selected instanceof Product) {
                $selected->liked = $user->productLikes->contains($selected->id) ? 1 : 0;
            } elseif ($selected instanceof Post) {
                $selected->liked = $user->postLikes->contains($selected->id) ? 1 : 0;
                $selected->comments = $this->checkLikeStatus($selected->comments, $user);

            } elseif ($selected instanceof Comment) {
                $selected->liked = $user->commentLikes->contains($selected->id) ? 1 : 0;
            }
        }

        return $model;
    }

    protected function checkViewStatus($model, $user = null)
    {
        if (empty($user)) {
            return $model;
        }
        if (isset($model->id)) {

            if ($model instanceof Post) {
                $model->viewed = $user->postViews->contains($model->id) ? 1 : 0;
            }

            return $model;
        }

        foreach ($model as $selected) {

            if ($selected instanceof Post) {
                $selected->viewed = $user->postViews->contains($selected->id) ? 1 : 0;
            }
        }

        return $model;
    }


    protected function checkDislikeStatus($model, $user = null)
    {
        if (empty($user)) {
            return $model;
        }
        if (isset($model->id)) {
            if ($model instanceof Shop) {
                $model->disliked = $user->dislikes->contains($model->id) ? 1 : 0;
            } elseif ($model instanceof Product) {
                $model->disliked = $user->productDislikes->contains($model->id) ? 1 : 0;
            } elseif ($model instanceof Post) {
                $model->disliked = $user->postDislikes->contains($model->id) ? 1 : 0;
            }

            return $model;
        }

        foreach ($model as $selected) {

            if ($selected instanceof Shop) {
                $selected->disliked = $user->dislikes->contains($selected->id) ? 1 : 0;
            } elseif ($selected instanceof Product) {
                $selected->disliked = $user->productDislikes->contains($selected->id) ? 1 : 0;
            } elseif ($selected instanceof Post) {
                $selected->disliked = $user->postDislikes->contains($selected->id) ? 1 : 0;
            }
        }

        return $model;
    }


    public function parsNatCode($code)
    {
        $province_code = explode("A", $code)[0];
        $town_code = explode("B", $code)[0];

        $helper = 0;
        $nat = "";
        $province = Region::where('code', $province_code)->where('type', 1)->first();
        $town = Region::where('code', $town_code)->where('type', 2)->first();

        if ($province) {
            $nat .= $helper ? '، ' : '';
            $nat .= $province->title;
            $helper = 1;
        }

        if ($town) {
            $nat .= $helper ? '، ' : '';
            $nat .= $town->title;
            $helper = 1;
        }


        if (!strpos($code, 'D')) {
            $city_code = $code;
            $city = Region::where('code', $city_code)->where('type', 3)->first();

            if ($city) {
                $nat .= $helper ? '، ' : '';
                $nat .= $city->title;
                $helper = 1;
            }

        } else {
            $rural_code = explode("D", $code)[0];
            $village_code = $code;
            $rural = Region::where('code', $rural_code)->where('type', 5)->first();
            $village = Region::where('code', $village_code)->where('type', 6)->first();

            if ($rural) {
                $nat .= $helper ? '، ' : '';
                $nat .= $rural->title;
                $helper = 1;
            }

            if ($village) {
                $nat .= $helper ? '، ' : '';
                $nat .= $village->title;
                $helper = 1;
            }
        }

        return $nat;
    }

    public function parsNatCodeArray($code)
    {

        $province_code = explode("A", $code)[0];
        $town_code = explode("B", $code)[0];

        $nat_code["province"] = $province_code;
        $nat_code["town"] = $town_code;


        $nat_code["city"] = "";
        $nat_code["rural"] = "";
        $nat_code["village"] = "";

        if (!strpos($code, 'D')) {
            $nat_code["city"] = $code;
        } else {
            $rural_code = explode("D", $code)[0];
            $village_code = $code;

            $nat_code["rural"] = $rural_code;
            $nat_code["village"] = $village_code;
        }

        return $nat_code;

    }

}
