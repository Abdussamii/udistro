<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

use App\AgentPartner;
use App\AgentClient;
use App\AgentPartnerDigitalServiceRequest;
use App\AgentPartnerDigitalServiceTypeRequest;
use App\AgentPartnerDigitalAdditionalServiceTypeRequest;
use App\Province;
use App\Country;
use App\City;

class AgentPartnerController extends Controller
{

    /**
     * Function to get the Cable Service Request
     * @param void
     * @return array
     */
    public function fetchQuotationRequest($id)
    {
        $cableInternetId = $id;

        $response = array();
        if( $cableInternetId != '' )
        {
        	$cableInternetServiceDetails = AgentPartnerDigitalServiceRequest::find($cableInternetId);

        	$response['moving_from_house_type'] 	= ucwords( strtolower( $cableInternetServiceDetails['moving_from_house_type'] ) );
        	$response['moving_from_floor'] 			= $cableInternetServiceDetails['moving_from_floor'];
        	$response['moving_from_bedroom_count'] 	= $cableInternetServiceDetails['moving_from_bedroom_count'];
        	$response['moving_from_property_type'] 	= ucwords( strtolower( $cableInternetServiceDetails['moving_from_property_type'] ) );

        	$response['moving_to_house_type'] 		= ucwords( strtolower( $cableInternetServiceDetails['moving_to_house_type'] ) );
        	$response['moving_to_floor'] 			= $cableInternetServiceDetails['moving_to_floor'];
        	$response['moving_to_bedroom_count'] 	= $cableInternetServiceDetails['moving_to_bedroom_count'];
        	$response['moving_to_property_type'] 	= ucwords( strtolower( $cableInternetServiceDetails['moving_to_property_type'] ) );

			$response['have_cable_internet_already']		= ( $cableInternetServiceDetails['have_cable_internet_already'] == 1 ) ? 'Yes' : 'No';
			$response['employment_status'] 					= ( $cableInternetServiceDetails['employment_status'] == 1 ) ? 'Yes' : 'No';
			$response['want_to_receive_electronic_bill']	= ( $cableInternetServiceDetails['want_to_receive_electronic_bill'] == 1 ) ? 'Yes' : 'No';
			$response['want_to_contract_plan'] 				= ( $cableInternetServiceDetails['want_to_contract_plan'] == 1 ) ? 'Yes' : 'No';
			$response['want_to_setup_preauthorise_payment']	= ( $cableInternetServiceDetails['want_to_setup_preauthorise_payment'] == 1 ) ? 'Yes' : 'No';

			$response['additional_information']				= ucfirst( strtolower( $cableInternetServiceDetails['additional_information'] ) );

            // Get the moving from address
            $clientMovingFromAddress = DB::table('agent_partner_digital_service_requests as t1')
                					->join('agent_client_moving_from_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
                					->join('provinces as t3', 't2.province_id', '=', 't3.id')
                					->join('cities as t4', 't2.city_id', '=', 't4.id')
                					->join('countries as t5', 't2.country_id', '=', 't5.id')
                					->where(['t1.id' => $cableInternetId, 't1.status' => '1'])
                					->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country')
                					->first();

            // Get the moving to address
            $clientMovingToAddress = DB::table('agent_partner_digital_service_requests as t1')
                					->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
                					->join('provinces as t3', 't2.province_id', '=', 't3.id')
                					->join('cities as t4', 't2.city_id', '=', 't4.id')
                					->join('countries as t5', 't2.country_id', '=', 't5.id')
                					->where(['t1.id' => $cableInternetId, 't1.status' => '1'])
                					->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country', 't3.gst', 't3.hst', 't3.pst', 't3.service_charge')
                					->first();

            $response['pst'] 			= round($clientMovingToAddress->pst, 2) . '%';
            $response['gst'] 			= round($clientMovingToAddress->gst, 2) . '%';
            $response['hst'] 			= round($clientMovingToAddress->hst, 2) . '%';
            $response['service_charge']	= round($clientMovingToAddress->service_charge, 2) . '%';

            $response['moving_from_address']= $clientMovingFromAddress->address1 . ', ' . $clientMovingFromAddress->city . ', ' . $clientMovingFromAddress->province . ', ' . $clientMovingFromAddress->country;

	        $response['moving_to_address'] 	= $clientMovingToAddress->address1 . ', ' . $clientMovingToAddress->city . ', ' . $clientMovingToAddress->province . ', ' . $clientMovingToAddress->country;

	        // Get the selected services
	        $services = DB::table('agent_partner_digital_service_type_requests as t1')
    					->join('digital_service_types as t2', 't1.digital_service_type_id', '=', 't2.id')
    					->where(['t1.digital_service_request_id' => $cableInternetId])
    					->select('t1.id as service_request_id', 't2.id as service_id', 't2.service')
    					->get();

			$html = '';
	        if( count( $services ) > 0 )
	        {
	        	foreach( $services as $service )
	        	{
	        		$html .= '<tr>';

	        		$html .= '<td>Services</td>';
	        		$html .= '<td>'. ucwords( strtolower( $service->service ) ) .'</td>';
	        		$html .= '<td>NA</td>';
	        		$html .= '<td><input name="service_time_estimate['. $service->service_id .']" class="service_time_estimate form-control cable_internet_service_budget" style="width: 100px;"></td>';
	        		$html .= '<td><input name="service_budget_estimate['. $service->service_id .']" class="service_budget_estimate form-control cable_internet_service_amount" style="width: 100px;"></td>';

	        		$html .= '</tr>';
	        	}
	        }

	        $response['request_services_details'] = $html;

	        $additionalServiceHtml = '';
	        // Get the selected additional services
	        $additionalServices = DB::table('agent_partner_digital_additional_service_type_requests as t1')
    					->join('digital_additional_services as t2', 't1.digital_additional_service_type_id', '=', 't2.id')
    					->where(['t1.digital_service_request_id' => $cableInternetId])
    					->select('t1.id as service_request_id', 't2.id as additional_service_id', 't2.additional_service')
    					->get();

	        if( count( $additionalServices ) > 0 )
	        {
	        	foreach( $additionalServices as $additionalService )
	        	{
	        		$additionalServiceHtml .= '<tr>';

	        		$additionalServiceHtml .= '<td>Additional Services</td>';
	        		$additionalServiceHtml .= '<td>'. ucwords( strtolower( $additionalService->additional_service ) ) .'</td>';

	        		$additionalServiceHtml .= '</tr>';
	        	}
	        }

	        $response['request_additional_services_details'] = $additionalServiceHtml;

        }
        
        return response()->json($response);
    }
	
}