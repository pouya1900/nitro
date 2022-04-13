<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Api\Controller;
use App\Traits\ImageUtilsTrait;
use App\Traits\VideoUtilsTrait;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Services\Logger\ReqLog\RequestLogger;


/**
 * Class ImageController
 * @package App\Http\Controllers\Api\General
 */
class ImageController extends Controller {
	use ImageUtilsTrait;
	use VideoUtilsTrait;

	protected $image;

	/**
	 * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
	 */
	protected $storageDisk;

	/**
	 * ImageController constructor.
	 */
	public function __construct( Image $image ) {
		$this->storageDisk = config( 'image.storage.global' );
		$this->image       = $image;
	}

	/**
	 * @param Request $request
	 *
	 * @return mixed
	 * @throws \App\Exceptions\AppException
	 * @throws \App\Services\ImageUploader\Exceptions\FileExtensionInvalidException
	 * @throws \App\Services\ImageUploader\Exceptions\FileSizeException
	 * @throws \App\Services\ImageUploader\Exceptions\FileUploadFailedException
	 */
	public function store( Request $request ) {

//		RequestLogger::log($request->file('image')->getSize());

		RequestLogger::log($request->all());


		$this->validateRequest( $request->all(), [
			'image' => 'required|file|max:5120|mimes:jpeg,png,jpg',
			'model' => 'required|in:' . implode( ',', config( 'image.validModels' ) ),
			'type'  => 'required|in:' . implode( ',', config( 'image.validTypes' ) ),
		] );


		return $this->storeImage( $request, $this->storageDisk );
	}

	public function store_video( Request $request ) {


		$this->validateRequest( $request->all(), [
			'video' => 'required|file|max:10240|mimes:mp4,mov,wmv,mkv',
			'model' => 'required|in:' . implode( ',', config( 'image.validModels' ) ),
			'type'  => 'required|in:' . implode( ',', config( 'image.validTypes' ) ),
		] );

		return $this->storeVideo( $request, $this->storageDisk , "video");
	}


	public function delete( Image $image ) {

		$this->deleteImages( $image );

		$image->delete();

		return $this->sendResponse( [], trans( 'api/messages.deleteImage.success' ) );


	}


}
