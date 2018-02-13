<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\AgentClient;
use App\AgentClientInvite;

class SendInviteEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email template to movers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	// Working hours in Canada: 07:00 to 17:00
    	$workingHourStartTime 	= '07:00:00';
    	$workingHourEndTime 	= '17:00:00';

    	// Check the current time of the server
    	$currentDate = date('Y-m-d');
    	$currentTime = date('H:i:s');

    	// If the current time is between the working hours then get the scheduled email listing
    	if( $currentTime >= $workingHourStartTime && $currentTime <= $workingHourEndTime )
    	{
    		// Check for the email scheduled for today's date
    		$agentClientInvite = AgentClientInvite::where(['status' => '0', 'schedule_status' => '1', 'schedule_date' => $currentDate])
    							->select('id', 'client_id', 'schedule_status')
    							->first();

    		if( count( $agentClientInvite ) == 1 )	// There is an email scheduled for today's date, send it first
    		{
    			if( AgentClientInvite::find($agentClientInvite->id)->update(['status' => '1']) )
    			{
    				echo 'Scheduled email with id '. $agentClientInvite->id .' send successfully' . PHP_EOL;
    			}
    		}
    		else  									// There is no email scheduled for today's date. Send the email with schedule_status as "Send Immediately"
    		{
    			$agentClientInvite = AgentClientInvite::where(['status' => '0', 'schedule_status' => '0'])
    							->select('id', 'client_id', 'schedule_status')
    							->first();

    			if( count( $agentClientInvite ) == 1 )
    			{
    				if( AgentClientInvite::find($agentClientInvite->id)->update(['status' => '1']) )
    				{
    					echo 'Immediate email with id '. $agentClientInvite->id .' send successfully' . PHP_EOL;
    				}
    			}
    		}
    	}
    }
}
