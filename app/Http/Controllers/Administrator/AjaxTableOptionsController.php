<?php

namespace App\Http\Controllers\Administrator;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Http\RedirectResponse;

/**
 * Class AjaxTableOptionsController
 * @package App\Http\Controllers\Administrator
 */
class AjaxTableOptionsController extends Controller
{

    /**
     * @param string $modelType
     * @param $id
     * @return JsonResponse
     */
    public function publish($modelType='', $id)
    {
      $method = $modelType . 'Publish';
        if(!method_exists($this,  $method)){
            $data = [
                'status' => 'fault',
                'message' => 'ورود داده نامعتبر!',
                'data' => [$method],
                'code' => 400
            ];
            return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
        }
        return $this->$method($id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function blogPublish($id)
    {
        return redirect()->route('admin.blog.publish', $id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function adsPublish($id)
    {
        return redirect()->route('admin.ads.publish', $id);
    }

	private function appViewPublish($id)
	{
		return redirect()->route('admin.app-view.publish', $id);
	}

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function commentPublish($id)
    {
        return redirect()->route('admin.comment.reversePublishState', $id);
    }

    /**
     * @param string $modelType
     * @param $id
     * @return JsonResponse
     */
    public function trash(string $modelType = '', $id)
    {
        $method = $modelType . 'Trash';
        if(!method_exists($this,  $method)){
            $data = [
                'status' => 'fault',
                'message' => 'ورود داده نامعتبر!',
                'data' => [$method],
                'code' => 400
            ];
            return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
        }
        return $this->$method($id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function blogTrash($id)
    {
        return redirect()->route('admin.blog.trash', $id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function adsTrash($id)
    {
        return redirect()->route('admin.ads.trash', $id);
    }
	private function appViewTrash($id)
	{
		return redirect()->route('admin.app-view.trash', $id);
	}

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function adsAttributeDescriptionTrash($id)
    {
        return redirect()->route('admin.ads-attribute.trash', $id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function userTrash($id)
    {
        return redirect()->route('admin.user.trash', $id);
    }

    /**
     * @param string $modelType
     * @param $id
     * @return JsonResponse
     */
    public function delete(string $modelType = '', $id)
    {
        $method = $modelType . 'Delete';
        if(!method_exists($this,  $method)){
            $data = [
                'status' => 'fault',
                'message' => 'ورود داده نامعتبر!',
                'data' => [$method],
                'code' => 400
            ];
            return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
        }
        return $this->$method($id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function adsAttributeDescriptionDelete($id)
    {
        return redirect()->route('admin.ads-attribute.delete', $id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function adsDelete($id)
    {
        return redirect()->route('admin.ads.delete', $id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function adsCategoryDelete($id)
    {
        return redirect()->route('admin.category.delete', $id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function blogDelete($id)
    {
        return redirect()->route('admin.blog.delete', $id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function blogCategoryDelete($id)
    {
        return redirect()->route('admin.blog-category.delete', $id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function supportDelete($id)
    {
        return redirect()->route('admin.support.delete', $id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function roleDelete($id)
    {
        return redirect()->route('admin.role.delete', $id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function reportDelete($id)
    {
        return redirect()->route('admin.report.delete', $id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function userDelete($id)
    {
        return redirect()->route('admin.user.delete', $id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function commentDelete($id)
    {
        return redirect()->route('admin.comment.delete', $id);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    private function unitDelete($id)
    {
        return redirect()->route('admin.unit.delete', $id);
    }
}
