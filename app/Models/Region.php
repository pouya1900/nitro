<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Region extends Model

{

	static $province=1;
	static $town=2;
	static $city=3;
	static $section=4;
	static $rural=5;
	static $village=6;
}
