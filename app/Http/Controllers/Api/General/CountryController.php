<?php

namespace App\Http\Controllers\Api\General;

use App\Exceptions\AppException;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;
use App\Models\Region;
use App\Models\Country;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CountryController extends Controller {
	protected $request;

	public function __construct( Request $request ) {
		$this->request = $request;
	}

	public function getAllCountriesByCitites() {
		$cityTitle = $this->request->title;
		$cities    = City::select( 'id', 'country_id', 'title', 'en_title', 'lat', 'long' )
		                 ->with( 'country:id,iso_code3' )
		                 ->when( ! empty( $cityTitle ), function ( $query ) use ( $cityTitle ) {
			                 return $query->where( 'title', 'like', '%' . $cityTitle . '%' )->orWhere( 'en_title', 'like', '%' . $cityTitle . '%' );
		                 } )
		                 ->orderBy( 'country_id' )
		                 ->orderBy( 'title' )
		                 ->get();

		return $this->sendResponse( CityResource::collection( $cities ) );
	}


	public function getRegion( $type ) {

		$perPage      = $this->getPerPage();
		$searchString = $this->request->sc;
		$code         = $this->request->code;

		if ( $type > 7 || $type < 1 ) {
			throw new AppException( trans( 'messages.region.failed' ), config( 'customCodes.response.badRequest' ) );
		}

		$region = Region::
		when( ! empty( $searchString ), function ( $query ) use ( $searchString ) {
			return $query->where( 'title', 'Like', '%' . $searchString . '%' );
		} )
		                ->when( ! empty( $code ), function ( $query ) use ( $code ) {
			                return $query->where( 'code', 'Like', '%' . $code . '%' );
		                } )
		                ->when( $type < 7, function ( $query ) use ( $type ) {
			                return $query->where( 'type', $type );
		                } )
		                ->when( $type == 7, function ( $query ) use ( $type ) {
			                return $query->where( 'type', '>=', 2 )->where( 'type', '<=', 6 );
		                } )
		                ->paginate( $perPage );


		foreach ( $region as $key => $value ) {
			$nat = $this->parsNatCode( $value->code );

			if ( ! strpos( $value->code, 'D' ) ) {
				$nat_type = 0;
			} else {
				$nat_type = 1;
			}
			$region[ $key ]["address"]  = $nat;
			$region[ $key ]["nat_type"] = $nat_type;
		}


		return $this->sendResponse( [
			'regions'    => CityResource::collection( $region ),
			'pagination' => [
				"totalItems"      => $region->total(),
				"perPage"         => $region->perPage(),
				"nextPageUrl"     => $region->nextPageUrl(),
				"previousPageUrl" => $region->previousPageUrl(),
				"lastPageUrl"     => $region->url( $region->lastPage() )
			]
		] );

	}


}
