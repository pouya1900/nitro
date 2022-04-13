<?php

namespace App\Traits;

use App\Services\ImageUploader\ImageUploader;
use FFMpeg\FFMpeg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Trait ImageUtilsTrait
 * @package App\Traits
 */
trait VideoUtilsTrait {
	/**
	 * @param $request
	 * @param string $storageDisk
	 *
	 * @return mixed
	 * @throws \App\Services\ImageUploader\Exceptions\FileExtensionInvalidException
	 * @throws \App\Services\ImageUploader\Exceptions\FileSizeException
	 * @throws \App\Services\ImageUploader\Exceptions\FileUploadFailedException
	 */
	public function storeVideo( $request, string $storageDisk, $file_name ) {

		ini_set( 'memory_limit', '10240M' );

		$customPath = $request->model . '/';


		$destinationPath = Storage::disk( $storageDisk )->path( $customPath ) . '/';
		$urlPath         = Storage::disk( $storageDisk )->url( '' ) . $customPath;


		$file          = $request->file( $file_name );
		$fileExtension = $file->getClientOriginalExtension();
		$baseName      = preg_replace( [ '/\s+/' ], [ '-' ], pathinfo( $file->getClientOriginalName(), PATHINFO_FILENAME ) ) . '_' . time();
		$fileName      = $baseName . '.' . $fileExtension;

		$file_size = $file->getSize();

		$request->file( $file_name )->move( $destinationPath, $fileName );


//		code for get duratin of file , need ffmpeg install on server
//		$ffmpeg = FFMpeg::create();
//		$video = $ffmpeg->open($destinationPath.$fileName);
//		$duration=$video->getFormat()->get('duration');


		DB::beginTransaction();
		$createdImage = \App\Models\Image::create( [
			'title'      => $fileName,
			'ext'        => $fileExtension,
			'size'       => $file_size,
			'model_type' => $request->model,
			'width'      => 200,
			'height'     => 200,
//			'duration'        => $duration,

			// manual duration set , will be delete in developed app
			'duration'   => $request->duration,
			// manual duration set , will be delete in developed app

			'imagable_type' => $request->imagable_type,
			'imagable_id'   => $request->imagable_id,
		] );

		$link=$urlPath.$fileName;

		$imageData = [
			'id' => $createdImage->id,
			'link' => $link,
			'duration' => $createdImage->duration
		];


		DB::commit();

		return $this->sendResponse( $imageData );


	}

	/**
	 * @param Model $appModel
	 * @param string $model
	 * @param string $type
	 * @param array $newImages
	 * @param array $oldImages
	 *
	 * @throws \App\Services\ImageUploader\Exceptions\FileNotFoundException
	 */
	public function updateVideo( Model $appModel, string $model, array $newImages, array $oldImages = [] ) {
		$oldImages  = \App\Models\Image::find( $oldImages );
		$newImages  = \App\Models\Image::find( $newImages );
		$customPath = $model;


		$storageDisk     = config( 'image.storage.global' );
		$destinationPath = Storage::disk( $storageDisk )->path( $customPath ) . '/';


		if ( ! empty( $oldImages->count() ) ) {
			foreach ( $oldImages as $image ) {
				$image->imagable()->dissociate( $appModel );
				$image->delete();

				if ( file_exists( $destinationPath . $image->title ) ) {
					Storage::disk( $storageDisk )->delete( $customPath . '/' . $image->title );

				}

			}
		}

		if ( ! empty( $newImages->count() ) ) {
			foreach ( $newImages as $image ) {
				$image->imagable()->associate( $appModel );
				$image->save();
			}
		}
	}


}
