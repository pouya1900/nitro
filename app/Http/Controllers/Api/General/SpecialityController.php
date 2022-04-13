<?php

namespace App\Http\Controllers\Api\General;

use App\Exceptions\AppException;
use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\SpecialtiesGroup;
use App\Http\Resources\SpecialitiesGroupResource;

class SpecialityController extends Controller {

	protected $request;
	protected $user;
	protected $profile;

	public function __construct( Request $request ) {
		$this->request = $request;
	}


	public function getEducation( $type ) {

		$perPage = $this->getPerPage();
		$searchString   = $this->request->sc;


		$speciality = SpecialtiesGroup::where( 'type', $type )
		                              ->when( ! empty( $searchString ), function ( $query ) use ( $searchString ) {
			                              return $query->where( 'title', 'Like', '%' . $searchString . '%' );
		                              } )
		                              ->paginate( $perPage );


		return $this->sendResponse( [
			'education'  => SpecialitiesGroupResource::collection( $speciality ),
			'pagination' => [
				"totalItems"      => $speciality->total(),
				"perPage"         => $speciality->perPage(),
				"nextPageUrl"     => $speciality->nextPageUrl(),
				"previousPageUrl" => $speciality->previousPageUrl(),
				"lastPageUrl"     => $speciality->url( $speciality->lastPage() )
			]
		] );


	}


}
