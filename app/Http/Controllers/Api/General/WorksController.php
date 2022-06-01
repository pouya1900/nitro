<?php

namespace App\Http\Controllers\Api\General;

use App\Exceptions\AppException;
use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\WorkGroup;
use App\Http\Resources\WorkGroupResource;

class WorksController extends Controller {

	protected $request;
	protected $user;
	protected $profile;

	public function __construct( Request $request ) {
		$this->request = $request;
	}


	public function getWorks() {

		$perPage      = $this->getPerPage();
		$searchString = $this->request->sc;


		$works = WorkGroup::when( ! empty( $searchString ), function ( $query ) use ( $searchString ) {
			return $query->where( 'title', 'Like', '%' . $searchString . '%' );
		} )
		                  ->paginate( $perPage );


		return $this->sendResponse( [
			'works'      => WorkGroupResource::collection( $works ),
			'pagination' => [
				"totalItems"      => $works->total(),
				"perPage"         => $works->perPage(),
				"nextPageUrl"     => $works->nextPageUrl(),
				"previousPageUrl" => $works->previousPageUrl(),
				"lastPageUrl"     => $works->url( $works->lastPage() )
			]
		] );


	}


}
