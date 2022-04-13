<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserFullResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function toArray( $request ) {
		return [
			'id'               => $this->id,
			'mobile'           => $this->mobile,
			'mobileVisibility' => intval( $this->mobile_visibility ),
			'email'            => $this->email ?? '',
			'firstName'        => $this->first_name ?? '',
			'lastName'         => $this->last_name ?? '',
			'fullName'         => $this->full_name ?? '',
			'username'         => $this->username ?? '',
			'accountType'      => $this->account_type ?? 0,
			'image'            => $this->avatar,
			'hasProfile'       => ! empty( $this->profile ) ? true : false,
			'profile'          => ! empty( $this->profile ) ? new ProfileResource( $this->profile ) : null,
			'job'              => ! empty( $this->work ) ? new WorkResource( $this->work ) : null,
			'workplace'        => ! empty( $this->work ) ? new WorkplaceResource( $this->work ) : null,
			'postsCount'            => $this->post()->count() ?? 0,
			'followersCount'        => $this->AcceptedFollowers->count() ?? 0,
//            'followers' => !empty($this->AcceptedFollowers) ?   FollowersResource::collection($this->AcceptedFollowers) : [],
			'followingsCount'       => $this->AcceptedFollowings->count() ?? 0,
//            'following' => !empty($this->AcceptedFollowings) ?   FollowingsResource::collection($this->AcceptedFollowings) : [],
			'requestedUserCount'   => $this->FollowRequested->count() ?? 0,
			'invitesCount'          => $this->invites->count() ?? 0,
//			'invites'    => ! empty( $this->FollowRequested ) ? FollowersResource::collection( $this->FollowRequested ) : [],
			'posts'            => [],
			'relation'         => $request->user->relation( $this->resource )
		];
	}
}
