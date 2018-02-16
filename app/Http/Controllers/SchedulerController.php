<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

use Log;

class SchedulerController extends Controller
{
	public function sendInvitationEmail()
	{
		Log::useDailyFiles(storage_path().'/logs/cron.log');
		Log::info('Hello');
	}
}
