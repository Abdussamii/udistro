<?php

/*
|--------------------------------------------------------------------------
| Application wide constants
|--------------------------------------------------------------------------
|
| This file contains Application wide constants in it
|
*/

return [
    'LOGIN_ATTEMPT_COUNT' 	=> 5,								// 5 times
    'LOGIN_ATTEMPT_DURATION'=> 30,								// 30 minutes
    'LOCAL_APP_URL'			=> 'http://localhost/udistro',		// Local app url
    'SERVER_APP_URL' 		=> 'http://udistro.ca/', 			// Server app url
];

// We can access its values in controller like config('constants.LOGIN_ATTEMP_COUNT')