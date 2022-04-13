<?php

namespace App\Services\Logger\ReqLog;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;
use Carbon\Carbon;

/**
 * Class Logger
 * @package App\Services
 */
class RequestLogger
{

	public static function log( $text ) {

		$myfile = fopen("log.txt", "w") or die("Unable to open file!");

		fwrite($myfile, json_encode($text)."\n".Carbon::now());
		fclose($myfile);

	}

}

