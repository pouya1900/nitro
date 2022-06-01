<?php

namespace App\Traits;

use App\Services\ImageUploader\ImageUploader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Trait ImageUtilsTrait
 * @package App\Traits
 */
trait ImageUtilsTrait {
	/**
	 * @param $request
	 * @param string $storageDisk
	 *
	 * @return mixed
	 * @throws \App\Services\ImageUploader\Exceptions\FileExtensionInvalidException
	 * @throws \App\Services\ImageUploader\Exceptions\FileSizeException
	 * @throws \App\Services\ImageUploader\Exceptions\FileUploadFailedException
	 */
	public function storeImage( $request, string $storageDisk ) {
		$imageUploader = new ImageUploader( $storageDisk, '', '', [ 'png', 'jpg', 'jpeg' , 'PNG' , "JPG" , 'JPEG' , 'GIF ' , 'gif'] );
		$customPath    = $request->model . '/';
		$image         = $imageUploader->uploadFile( $request->file( 'image' ), '', '', $customPath );

		DB::beginTransaction();
		$createdImage = \App\Models\Image::create( [
			'title'         => $image['name'],
			'ext'           => $image['extension'],
			'size'          => $image['size'],
			'width'         => $image['width'],
			'height'        => $image['height'],
			'model_type'    => $request->model,
			'imagable_type' => $request->imagable_type,
			'imagable_id'   => $request->imagable_id,
		] );

		$destinationPath = Storage::disk( $storageDisk )->path( $customPath ) . '/';
		$urlPath         = Storage::disk( $storageDisk )->url( '' ) . $customPath;
		$imageData       = [ 'id' => $createdImage->id ];


		foreach ( config( 'image.sizes.' . $request->type ) as $imageSize => $value ) {
			$imageName               = $image['originalFileName'] . $value['postfix'] . '.' . $image['extension'];
			$imageData[ $imageSize ] = $urlPath . $imageName;

			if ( $value['height'] ) {

				Image::make( $destinationPath . $image['name'] )
				     ->resize( $value['width'], $value['height'] )
				     ->save( $destinationPath . $imageName );
			} else {
				Image::make( $destinationPath . $image['name'] )
				     ->resize( $value['width'], null, function ( $constraint ) {
					     $constraint->aspectRatio();
				     } )
				     ->save( $destinationPath . $imageName );
			}

		}


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
	public function updateImages( Model $appModel, string $model, array $newImages, array $oldImages = [], string $type ) {
		$oldImages     = \App\Models\Image::find( $oldImages );
		$newImages     = \App\Models\Image::find( $newImages );
		$imageUploader = new ImageUploader();
		$customPath    = $model;

//        $destinationPath = Storage::disk(config('image.storage.global'))
//                ->getDriver()
//                ->getAdapter()
//                ->getPathPrefix() . $customPath . '/';

		$storageDisk     = config( 'image.storage.global' );
		$destinationPath = Storage::disk( $storageDisk )->path( $customPath ) . '/';


		if ( ! empty( $oldImages->count() ) ) {
			foreach ( $oldImages as $image ) {
				$image->imagable()->dissociate( $appModel );
				$image->delete();

				if ( file_exists( $destinationPath . $image->title ) ) {

					$imageUploader->deleteFile( $destinationPath . $image->title );
				}
				foreach ( config( 'image.sizes.' . $type ) as $imageSize => $value ) {
					if ( file_exists( $destinationPath . $this->makeImageName( $image->title, $image->ext, $value['postfix'] ) ) ) {
						$imageUploader->deleteFile( $destinationPath . $this->makeImageName( $image->title, $image->ext, $value['postfix'] ) );
					}
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

	/**
	 * @param string $name
	 * @param string $ext
	 * @param string $postfix
	 *
	 * @return string
	 */
	public function makeImageName( string $name, string $ext, string $postfix = '' ) {
		$ext          = '.' . $ext;
		$originalName = str_replace( $ext, '', $name );

		return $originalName . $postfix . $ext;
	}


	public function deleteImages( \App\Models\Image $image ) {


		$imageUploader = new ImageUploader();

		$customPath      = $image->model_type;
		$storageDisk     = config( 'image.storage.global' );
		$destinationPath = Storage::disk( $storageDisk )->path( $customPath ) . '/';

		$type = config( 'image.ModelsToType.' . $customPath );
		if ( file_exists( $destinationPath . $image->title ) ) {

			$imageUploader->deleteFile( $destinationPath . $image->title );
		}
		foreach ( config( 'image.sizes.' . $type ) as $imageSize => $value ) {
			if ( file_exists( $destinationPath . $this->makeImageName( $image->title, $image->ext, $value['postfix'] ) ) ) {
				$imageUploader->deleteFile( $destinationPath . $this->makeImageName( $image->title, $image->ext, $value['postfix'] ) );
			}
		}


	}


}
