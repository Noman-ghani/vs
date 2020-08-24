<?php

namespace App\Http\Helpers;


use App\Http\Models\Model_Site_Settings;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

use App\PostAnswer;

use App\CmsMenu;
use Cache;
use App\Http\Controllers\projects\Toby\Api_Services;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\projects\Toby\helpers\EnumValues;
use App\Http\Helpers\EnumConstants;
use URL;
use Auth;


class GeneralHelper
{
	
	static function format_date( $date,  $format = false, $without_strtotime = false)
	{
		
		if ($without_strtotime)
		{
			$date = explode("GMT",$date);
			$date = strtotime($date[0]);
			$date = date($format,$date);
			return $date ;
		}
		else
		{
			if ( (bool)strtotime($date) )
			{
				return date( $format, strtotime( $date) );
			}
			else
			{
				return NULL;	
			}

		}
	}

    static function split_date_range( $date_range = '', $split_text = ' - ')
	{
		
        $_temp                      = $date_range;

		if ( count($_temp) == 2 )
		{
			
			
			$first_date							= str_replace("/", "-", isset($_temp['startDate']) ? $_temp['startDate'] :  $_temp[0]);
			$second_date						= str_replace("/", "-", isset($_temp['endDate']) ? $_temp['endDate'] :  $_temp[1]);
			$_min_date                 			= GeneralHelper::format_date($first_date,'Y-m-d',true);
			$_max_date                  		= GeneralHelper::format_date($second_date,'Y-m-d',true);
		
			return [$_min_date, $_max_date];
		}
		else
		{
			return FALSE;	
		}
	}
}