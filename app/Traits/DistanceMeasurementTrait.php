<?php

namespace App\Traits;

trait DistanceMeasurementTrait {
	public function getDistance( $lat1, $lon1, $lat2, $lon2 ) {
		$rad      = M_PI / 180;
		$radius   = 6371; //earth radius in kilometers
		$distance = acos( sin( $lat2 * $rad ) * sin( $lat1 * $rad ) + cos( $lat2 * $rad ) * cos( $lat1 * $rad ) * cos( $lon2 * $rad - $lon1 * $rad ) ) * $radius; //result in Kilometers

		$distance = round( $distance, 1 );

		$distance=$distance*1000;

		return $distance;


	}
	

}