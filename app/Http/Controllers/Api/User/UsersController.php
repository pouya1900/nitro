<?php

namespace App\Http\Controllers\Api\User;


use App\Traits\DistanceMeasurementTrait;
use Carbon\Carbon;
use http\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\DB;
use App\Services\Logger\ReqLog\RequestLogger;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use App\Http\Resources\UserPublicResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserFullResource;


class UsersController extends Controller {

	use DistanceMeasurementTrait;

	protected $request;
	protected $user;


	public function __construct( Request $request, User $user ) {

		$this->request = $request;
		$this->user    = $user;
	}


	public function index() {

		$perPage      = $this->getPerPage();
		$radius       = $this->request->radius;
		$type         = $this->request->type;
		$lang_id      = $this->request->lang_id;
		$evidence_id  = $this->request->evidence_id;
		$workGroup_id = $this->request->work_group_id;
		$long         = $this->request->lon;
		$lat          = $this->request->lat;
		$user         = $this->request->user;

		$nat_code = $this->parsNatCodeArray( $user->profile->nat_code );


		$users = $this->user->
		query()
		                    ->when( ! empty( $type ), function ( $query ) use ( $type, $nat_code, $radius, $long, $lat ) {

			                    return $query->whereHas( 'profile', function ( $q ) use ( $type, $nat_code, $radius, $long, $lat ) {

				                    if ( $type == 1 ) {
					                    return $q->where( 'nat_code', 'Like', '%' . $nat_code["village"] . '%' );
				                    } elseif ( $type == 2 ) {
					                    return $q->where( 'nat_code', 'Like', '%' . $nat_code["town"] . 'B' . '%' );
				                    } elseif ( $type == 3 ) {
					                    return $q->where( 'nat_code', 'Like', '%' . $nat_code["province"] . 'A' . '%' );
				                    } else {
					                    $rad = M_PI / 180;
					                    $r   = 6371; //earth radius in kilometers

					                    return $q->whereRaw( "(acos( sin( lat * $rad ) * sin( $lat * $rad ) + cos( lat * $rad ) * cos( $lat * $rad ) * cos( profiles.long * $rad - $long * $rad ) ) * $r ) < $radius  " );

				                    }
			                    } );
		                    } )
		                    ->when( ! empty( $lang_id ), function ( $query ) use ( $lang_id ) {
			                    return $query->whereHas( 'profile', function ( $q ) use ( $lang_id ) {
				                    return $q->where( 'language_id', $lang_id );
			                    } );
		                    } )
		                    ->when( ! empty( $evidence_id ), function ( $query ) use ( $evidence_id ) {
			                    return $query->whereHas( 'profile', function ( $q ) use ( $evidence_id ) {
				                    return $q->where( 'evidence_id', $evidence_id );
			                    } );
		                    } )
		                    ->when( ! empty( $workGroup_id ), function ( $query ) use ( $workGroup_id ) {
			                    return $query->whereHas( 'work', function ( $q ) use ( $workGroup_id ) {
				                    return $q->where( 'job_group_id', $workGroup_id );
			                    } );
		                    } )
		                    ->where( 'id', '<>', $user->id )
		                    ->paginate( $perPage );

		return $this->sendResponse( [
			'users'      => UserPublicResource::collection( $users ),
			'pagination' => [
				"totalItems"      => $users->total(),
				"perPage"         => $users->perPage(),
				"nextPageUrl"     => $users->nextPageUrl(),
				"previousPageUrl" => $users->previousPageUrl(),
				"lastPageUrl"     => $users->url( $users->lastPage() )
			]
		] );


	}

	public function search() {

		$perPage = $this->getPerPage();
		$name    = $this->request->sc;
		$user    = $this->request->user;

		$users = $this->user
			->query()
			->when( ! empty( $name ), function ( $query ) use ( $name ) {
				return $query->where( 'first_name', 'Like', '%' . $name . '%' )->orwhere( 'last_name', 'Like', '%' . $name . '%' )->orwhere( function ( $q ) use ( $name ) {
					return $q->whereraw( "CONCAT(first_name,' ',last_name) Like  '%$name%' " );
				} )->orwhere( 'username', 'Like', '%' . $name . '%' );
			} )
			->paginate( $perPage );


		return $this->sendResponse( [
			'users'      => UserPublicResource::collection( $users ),
			'pagination' => [
				"totalItems"      => $users->total(),
				"perPage"         => $users->perPage(),
				"nextPageUrl"     => $users->nextPageUrl(),
				"previousPageUrl" => $users->previousPageUrl(),
				"lastPageUrl"     => $users->url( $users->lastPage() )
			]
		] );
	}

	public function show( User $user ) {

		$current_user = $this->request->user;

		$this->addView( $user );

		return $this->sendResponse(
			new UserFullResource( $user )
		);

	}

	public function showWithUsername() {

		$current_user = $this->request->user;

		$username = $this->request->username;

		$user = User::where( 'username', $username )->first();

		$this->addView( $user );

		return $this->sendResponse(
			new UserFullResource( $user )
		);

	}


	public function addView( User $user ) {
		$cur_user = $this->request->user;

		$user_login = $cur_user->getUserLogin();

		if ( $cur_user->id != $user->id ) {
			$user->views()->Create( [
				'user_id'  => $cur_user->id,
				'uuid'     => $user_login->uuid,
				'platform' => $user_login->platform,
				'model'    => $user_login->model,
				'os'       => $user_login->os,
			] );
		}

		return $this->sendResponse();
	}


}
