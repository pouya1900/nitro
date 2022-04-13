<?php

namespace App\Http\Controllers\Administrator;

use App\Events\SeenAdminEvent;
use App\Http\Requests\Site\ReportRequest;
use App\Models\Ads;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\AdminImageTrait;
use App\Traits\VideoUtilsTrait;

class ImageUploaderController extends Controller {
	use AdminImageTrait;
	use VideoUtilsTrait;

	protected $storageDisk;

	public function __construct() {
		$this->storageDisk = config( 'image.storage.global' );
	}

	public function upload_image( Request $request ) {

		if ( $request->has( 'file' ) ) {
			$request->merge( [
				'model' => $request->model,
			] );


            $imageName = $this->storeImage( $request, $this->storageDisk, 'file' );

			return $imageName;
		}


	}

	public function upload_video( Request $request ) {

		if ( $request->has( 'file' ) ) {
			$request->merge( [
				'model' => $request->model,
				"type"  => $request->type
			] );


			$image_id = $this->storeVideo( $request, $this->storageDisk, 'file' );

			return $image_id;
		}


	}

}
