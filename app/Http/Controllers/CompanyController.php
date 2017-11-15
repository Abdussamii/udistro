<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\User;
use App\Role;
use App\Permission;
use App\CmsNavigationType;
use App\CmsNavigationCategory;
use App\CmsNavigation;
use App\CmsPage;
use App\Province;
use App\UtilityServiceCategory;
use App\Country;
use App\State;
use App\UtilityServiceType;
use App\UtilityServiceProvider;
use App\CompanyCategory;
use App\PaymentPlan;
use App\City;
use App\Company;

use Validator;
use Helper;

class CompanyController extends Controller
{
    /**
     * Function to return the company categories view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function companyCategories()
    {
    	return view('administrator/companyCategories');
    }

    /**
     * Function to return the company categories view
     * @param void
     * @return array
     */
    public function saveCompanyCategory()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $categoryData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'category_name'		=> $categoryData['category_name'],
		        'category_status'	=> $categoryData['category_status'],
		    ),
		    array(
		        'category_name' 	=> array('required'),
		        'category_status' 	=> array('required'),
		    ),
		    array(
		        'category_name.required' 	=> 'Please enter category name',
		        'category_status.required' 	=> 'Please select status',
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			// Check if category id is available or not. If not available, insert it, othewise update it
			if( $categoryData['category_id'] == '' )	// Add the company category
			{
				$companyCategory = new CompanyCategory;

				$companyCategory->category 	= $categoryData['category_name'];
				$companyCategory->status 	= $categoryData['category_status'];
				$companyCategory->created_by= $userId;

				if( $companyCategory->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Company category added successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in adding company category';
				}

			}
			else 											// Update the company category
			{
				$companyCategory = CompanyCategory::find($categoryData['category_id']);

				$companyCategory->category 	= $categoryData['category_name'];
				$companyCategory->status 	= $categoryData['category_status'];
				$companyCategory->updated_by= $userId;

				if( $companyCategory->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Company category updated successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in updating company category';
				}
			}
		}

		return response()->json($response);
    }

    /**
     * Function to show show the company categories list in datatable
     * @param void
     * @return array
     */
    public function fetchCompanyCategories()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'category',
            2 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $categories = CompanyCategory::where('category','like', '%'.$sSearch.'%')
                    ->orderBy($sortBy, $sortType)
                    ->limit($length)
                    ->offset($start)
                    ->select('id', 'category', 'status')
                    ->get();

        $iTotal = CompanyCategory::where('category','like', '%'.$sSearch.'%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $categories ) > 0 )
        {
            foreach ($categories as $category)
            {
            	$response['aaData'][$k] = array(
                    0 => $category->id,
                    1 => ucwords( strtolower( $category->category ) ),
                    2 => Helper::getStatusText($category->status),
                    3 => '<a href="javascript:void(0);" id="'. $category->id .'" class="edit_company_category"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function get the details of the selected company category
     * @param void
     * @return array
     */
    public function getCompanyCategoryDetails()
    {
    	$categoryId = Input::get('categoryId');

    	$response = array();
    	if( $categoryId != '' )
    	{
    		$categoryDetails = CompanyCategory::find($categoryId);

    		if( count( $categoryDetails ) > 0 )
    		{
	    		$response['id'] 		= $categoryDetails->id;
    			$response['category'] 	= $categoryDetails->category;
    			$response['status'] 	= $categoryDetails->status;
    		}
    	}

    	return response()->json($response); 
    }

    /**
     * Function to return the company listing view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function companies()
    {
    	// Get company categories
    	$companyCategories = CompanyCategory::where(['status' => '1'])->select('id', 'category')->orderBy('category', 'asc')->get();

    	// Get province list
    	$provinces = Province::where(['status' => '1'])->select('id', 'name')->orderBy('name', 'asc')->get();

    	return view('administrator/companies', ['provinces' => $provinces, 'companyCategories' => $companyCategories]);
    }

    /**
     * Function to save the company details
     * @param void
     * @return array
     */
    public function saveCompanyDetails()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $companyDetails);

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'rep_fname'			=> $companyDetails['representative_fname'],
		        'rep_email'			=> $companyDetails['representative_email'],
		        'rep_password'		=> $companyDetails['representative_password'],
		        'company_name'		=> $companyDetails['company_name'],
		        'company_category'	=> $companyDetails['company_category'],
		        'company_address'	=> $companyDetails['company_address'],
		        'company_province'	=> $companyDetails['company_province'],
		        'company_city'		=> $companyDetails['company_city'],
		        'postal_code'		=> $companyDetails['postal_code'],
		        'company_status'	=> $companyDetails['company_status'],
		    ),
		    array(
		        'rep_fname'			=> array('required'),
		        'rep_email'			=> array('required', 'email'),
		        'rep_password'		=> array('required', 'min:6', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$%^&]).*$/'),
		        'company_name'		=> array('required'),
		        'company_category'	=> array('required'),
		        'company_address'	=> array('required'),
		        'company_province'	=> array('required'),
		        'company_city'		=> array('required'),
		        'postal_code'		=> array('required'),
		        'company_status'	=> array('required')
		    ),
		    array(
		        'rep_fname.required' 		=> 'Please enter representative first name',
		        'rep_email.required' 		=> 'Please enter representative email',
		        'rep_email.email' 			=> 'Please enter valid representative email',
		        'rep_password.required' 	=> 'Please enter password',
		        'rep_password.min' 			=> 'Password must contain atleat 6 characters',
		        'rep_password.regex' 		=> 'Password must contain a lower case, upper case, a number, and a special symbol in it',
		        'company_name.required' 	=> 'Please enter company name',
		        'company_category.required' => 'Please select company category',
		        'company_address.required' 	=> 'Please enter company address',
		        'company_province.required' => 'Please select province',
		        'company_city.required' 	=> 'Please select city',
		        'postal_code.required' 		=> 'Please enter postal code',
		        'company_status.required' 	=> 'Please select status',
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			// Check if company already exist, otherwise add it. 
			$company = Company::where(['company_name' => $companyDetails['company_name']])->select('id')->get();

			if( count( $company ) == 0 )
			{
				// Step I: Add the user
				// Step II: Add the role_user to sales representative
				// Step III: Add the company
				// Step IV: map the user to company

				// Begin transaction
				DB::beginTransaction();

				// Add the user
				$user = new User;

				$user->email 		= $companyDetails['representative_email'];
				$user->fname 		= $companyDetails['representative_fname'];
				$user->lname 		= $companyDetails['representative_lname'];
				$user->password 	= Hash::make($companyDetails['representative_password']);
				$user->status 		= '1';
				$user->created_by 	= $userId;

				if( $user->save() )
				{
					// Add the role user
					$user->attachRole(2);	// 2: company representative

					// Add the company
					$company = new Company;

					$company->company_name 			= $companyDetails['company_name'];	
					$company->company_category_id 	= $companyDetails['company_category'];
					$company->address 				= $companyDetails['company_address'];
					$company->province_id 			= $companyDetails['company_province'];
					$company->city_id 				= $companyDetails['company_city'];
					$company->postal_code 			= $companyDetails['postal_code'];
					$company->status 				= $companyDetails['company_status'];
					$company->created_by 			= $userId;

					if( $company->save() )
					{
						// Map the user to company
						$user->company()->attach($company->id);

						DB::commit();

						$response['errCode']    = 0;
				        $response['errMsg']     = 'Company added successfully';
					}
					else
					{
						DB::rollBack();

						$response['errCode']    = 3;
		        		$response['errMsg']     = 'Some error in adding the company';
					}
				}
				else
				{
					DB::rollBack();

					$response['errCode']    = 3;
		        	$response['errMsg']     = 'Some error in adding the company';
				}
			}
			else
			{
				$response['errCode']    = 2;
		        $response['errMsg']     = 'Company with the same name already exist';
			}
		}

		return response()->json($response);
    }

    /**
     * Function to update the company details
     * @param void
     * @return array
     */
    public function updateCompanyDetails()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $companyDetails);

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'rep_fname'			=> $companyDetails['representative_fname'],
		        'rep_email'			=> $companyDetails['representative_email'],
		        'company_name'		=> $companyDetails['company_name'],
		        'company_category'	=> $companyDetails['company_category'],
		        'company_address'	=> $companyDetails['company_address'],
		        'company_province'	=> $companyDetails['company_province'],
		        'company_city'		=> $companyDetails['company_city'],
		        'postal_code'		=> $companyDetails['postal_code'],
		        'company_status'	=> $companyDetails['company_status'],
		    ),
		    array(
		        'rep_fname'			=> array('required'),
		        'rep_email'			=> array('required', 'email'),
		        'company_name'		=> array('required'),
		        'company_category'	=> array('required'),
		        'company_address'	=> array('required'),
		        'company_province'	=> array('required'),
		        'company_city'		=> array('required'),
		        'postal_code'		=> array('required'),
		        'company_status'	=> array('required')
		    ),
		    array(
		        'rep_fname.required' 		=> 'Please enter representative first name',
		        'rep_email.required' 		=> 'Please enter representative email',
		        'rep_email.email' 			=> 'Please enter valid representative email',
		        'company_name.required' 	=> 'Please enter company name',
		        'company_category.required' => 'Please select company category',
		        'company_address.required' 	=> 'Please enter company address',
		        'company_province.required' => 'Please select province',
		        'company_city.required' 	=> 'Please select city',
		        'postal_code.required' 		=> 'Please enter postal code',
		        'company_status.required' 	=> 'Please select status',
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			$company = Company::find($companyDetails['company_id']);

			$company->company_name 			= $companyDetails['company_name'];	
			$company->company_category_id 	= $companyDetails['company_category'];
			$company->address 				= $companyDetails['company_address'];
			$company->province_id 			= $companyDetails['company_province'];
			$company->city_id 				= $companyDetails['company_city'];
			$company->postal_code 			= $companyDetails['postal_code'];
			$company->status 				= $companyDetails['company_status'];
			$company->updated_by 			= $userId;

			if( $company->save() )
			{
				$userDetails = DB::table('users as t1')
						            ->join('company_user as t2', 't1.id', '=', 't2.user_id')
						            ->join('role_user as t3', 't3.user_id', '=', 't1.id')
						            ->select('t1.id')
						            ->where('t3.role_id', '2')
						            ->first();

				$user = User::find($userDetails->id);

				$user->email 		= $companyDetails['representative_email'];
				$user->fname 		= $companyDetails['representative_fname'];
				$user->lname 		= $companyDetails['representative_lname'];
				$user->updated_by 	= $userId;

				if( $user->save() )
				{
					DB::commit();

					$response['errCode']    = 0;
			        $response['errMsg']     = 'Company details updated successfully';
				}
			}
			else
			{
				DB::rollBack();

				$response['errCode']    = 3;
        		$response['errMsg']     = 'Some error in updating the company details';
			}
		}

		return response()->json($response);
    }

    /**
     * Function to fetch the companies list and show in datatable
     * @param void
     * @return array
     */
    public function fetchCompanies()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 't1.id',
            1 => 't1.company_name',
            9 => 't1.status'
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        $companies 	= DB::select(
                        DB::raw(
                        	"SELECT t1.id, t1.company_name, t1.address, t1.postal_code, t1.status, t3.email, t3.fname, CONCAT_WS(' ', t3.fname, t3.lname) AS rep_name, 
							t5.category,
							t6.name AS province, t7.name AS city 
							FROM companies AS t1 
							LEFT JOIN company_user AS t2 ON t1.id = t2.company_id 
							LEFT JOIN users AS t3 ON t2.user_id = t3.id 
							LEFT JOIN role_user AS t4 on t4.user_id = t3.id 
							LEFT JOIN company_categories AS t5 ON t1.company_category_id = t5.id 
							LEFT JOIN provinces AS t6 ON t1.province_id = t6.id 
							LEFT JOIN cities AS t7 ON t1.city_id = t7.id 
							WHERE t4.role_id = 2 AND t1.company_name LIKE ('%". $sSearch ."%')
                        	ORDER BY " . $sortBy . " " . $sortType ." LIMIT ".$start.", ".$length
                        )
                    );

        $companiesCount = DB::select(
                            DB::raw("
                            SELECT t1.id
							FROM companies AS t1 
							LEFT JOIN company_user AS t2 ON t1.id = t2.company_id 
							LEFT JOIN users AS t3 ON t2.user_id = t3.id 
							LEFT JOIN role_user AS t4 on t4.user_id = t3.id 
							LEFT JOIN company_categories AS t5 ON t1.company_category_id = t5.id 
							LEFT JOIN provinces AS t6 ON t1.province_id = t6.id 
							LEFT JOIN cities AS t7 ON t1.city_id = t7.id 
							WHERE t4.role_id = 2 AND t1.company_name LIKE ('%". $sSearch ."%')")
                        );

   	    // Assign it to the datatable pagination variable
   	    $iTotal = count($companiesCount);

   	    $response = array(
   	        'iTotalRecords' => $iTotal,
   	        'iTotalDisplayRecords' => $iTotal,
   	        'aaData' => array()
   	    );

   	    $k=0;
   	    if ( count( $companies ) > 0 )
   	    {
   	        foreach ($companies as $company)
   	        {
   	            $response['aaData'][$k] = array(
   	                0 => $company->id,
   	                1 => ucwords( strtolower( $company->company_name ) ),
   	                2 => ucwords( strtolower( $company->category ) ),
   	                3 => ucfirst( strtolower( $company->address ) ),
   	                4 => ucfirst( strtolower( $company->province ) ),
   	                5 => ucfirst( strtolower( $company->city ) ),
   	                6 => $company->postal_code,
   	                7 => ucwords( strtolower( $company->rep_name ) ),
   	                8 => $company->email,
   	                9 => Helper::getStatusText($company->status),
   	                10 => '<a href="javascript:void(0);" id="'. $company->id .'" class="edit_company"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
   	            );
   	            $k++;
   	        }
   	    }

   		return response()->json($response);
    }

    /**
     * Function to get the details of the selected company
     * @param void
     * @return array
     */
    public function getCompanyDetails()
    {
		$companyId = Input::get('companyId');

		$response = array();
		if( $companyId != '' )
		{
			// Get the company details
			$companyDetails = Company::find($companyId);

			if( count( $companyDetails ) > 0 )
			{
	    		$response['id'] 				= $companyDetails->id;
	    		$response['company_name'] 		= $companyDetails->company_name;
	    		$response['company_category_id']= $companyDetails->company_category_id;
	    		$response['address'] 			= $companyDetails->address;
	    		$response['province_id'] 		= $companyDetails->province_id;
	    		$response['city_id'] 			= $companyDetails->city_id;
	    		$response['postal_code'] 		= $companyDetails->postal_code;
	    		$response['status'] 			= $companyDetails->status;

	    		// Get the company representative details
	    		// $companyRepDetails = User::find($companyDetails->user_id);

	    		$companyRepDetails = DB::table('users as t1')
						            ->join('company_user as t2', 't1.id', '=', 't2.user_id')
						            ->join('role_user as t3', 't3.user_id', '=', 't1.id')
						            ->select('t1.id', 't1.email', 't1.fname', 't1.lname')
						            ->where('t3.role_id', '2')
						            ->first();

				if( count( $companyRepDetails ) > 0 )
	    		{
	    			$response['email'] = $companyRepDetails->email;
	    			$response['fname'] = $companyRepDetails->fname;
	    			$response['lname'] = $companyRepDetails->lname;
	    		}

	    		// Get the cities list for the selected province as the city list is filtered to the selected province by using the ajax
	    		$cities = City::where(['province_id' => $companyDetails->province_id])->get();

	    		if( count( $cities ) > 0 )
	    		{
	    			foreach ($cities as $city)
	    			{
		    			$response['cities'][] = array(
		    				'id' 	=> $city->id,
		    				'city' 	=> ucwords( strtolower( $city->name ) ),
		    			);
	    			}
	    		}
			}
		}

		return response()->json($response);
    }

    /**
     * Function to return the company agent view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function agents()
    {
    	// Get company list
    	$companies = Company::where(['status' => '1'])->select('id', 'company_name')->orderBy('company_name', 'asc')->get();

    	// Get province list
    	$provinces = Province::where(['status' => '1'])->select('id', 'name')->orderBy('name', 'asc')->get();

    	return view('administrator/agents', ['companies' => $companies, 'provinces' => $provinces]);
    }

    /**
     * Function to save the agent details
     * @param void
     * @return array
     */
    public function saveAgent()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $agentData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'agent_company'		=> $agentData['agent_company'],
		        'agent_fname'		=> $agentData['agent_fname'],
		        'agent_lname'		=> $agentData['agent_lname'],
		        'agent_email'		=> $agentData['agent_email'],
		        'agent_password'	=> $agentData['agent_password'],
		        'agent_address'		=> $agentData['agent_address'],
		        'agent_province'	=> $agentData['agent_province'],
		        'agent_city'		=> $agentData['agent_city'],
		        'agent_postalcode'	=> $agentData['agent_postalcode'],
		        'agent_status'		=> $agentData['agent_status']
		    ),
		    array(
		        'agent_company' 	=> array('required'),
		        'agent_fname' 		=> array('required'),
		        'agent_lname' 		=> array('required'),
		        'agent_email' 		=> array('required', 'email'),
		        'agent_password'	=> array('required', 'min:6', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$%^&]).*$/'),
		        'agent_address'		=> array('required'),
		        'agent_province'	=> array('required'),
		        'agent_city' 		=> array('required'),
		        'agent_postalcode' 	=> array('required'),
		        'agent_status' 		=> array('required')
		    ),
		    array(
		        'agent_company.required'	=> 'Please select company',
		        'agent_fname.required' 		=> 'Please enter first name',
		        'agent_lname.required' 		=> 'Please enter last name',
		        'agent_email.required' 		=> 'Please enter email',
		        'agent_email.email' 		=> 'Please enter valid email',
		        'agent_password.required' 	=> 'Please enter password',
		        'agent_password.min' 		=> 'Password must contain atleat 6 characters',
		        'agent_password.regex' 		=> 'Password must contain a lower case, upper case, a number, and a special symbol in it',
		        'agent_address.required' 	=> 'Please enter address',
		        'agent_province.required' 	=> 'Please select province',
		        'agent_city.required' 		=> 'Please select city',
		        'agent_postalcode.required'	=> 'Please enter postal code',
		        'agent_status.required' 	=> 'Please select status'
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			// Check if the agent already exist
			$agent = User::where(['fname' => $agentData['agent_fname'], 'lname' => $agentData['agent_lname']])->get();

			if( count( $agent ) == 0 )
			{
				// Add the agent as a user
				$user = new User;

				DB::beginTransaction();

				$user->email 		= $agentData['agent_email'];				
				$user->password 	= Hash::make($agentData['agent_password']);
				$user->fname 		= $agentData['agent_fname'];
				$user->lname 		= $agentData['agent_lname'];
				$user->address 		= $agentData['agent_address'];
				$user->province_id 	= $agentData['agent_province'];
				$user->city_id 		= $agentData['agent_city'];
				$user->postalcode 	= $agentData['agent_postalcode'];
				$user->status 		= $agentData['agent_status'];
				$user->created_by 	= $userId;

				if( $user->save() )
				{
					// Map the user to role
					$user->attachRole(3);	// 3: agent

					// Map the user to company
					$user->company()->attach($agentData['agent_company']);

					DB::commit();

					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Agent added successfully';
		        	
				}
				else
				{
					DB::rollBack();

					$response['errCode']    = 3;
		        	$response['errMsg']     = 'Some error in adding agent';
				}
			}
			else
			{
				$response['errCode']    = 2;
		        $response['errMsg']     = 'Agent with the same name already exist';
			}
		}

		return response()->json($response);
    }

    /**
     * Function to fetch the agent list and show in datatable
     * @param void
     * @return array
     */
    public function fetchAgents()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 't1.id',
            1 => 't1.id',
            2 => 't1.id',
            8 => 't1.status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        $agents 	= DB::select(
                        DB::raw(
                        	"SELECT t1.id, t1.email, CONCAT_WS(' ', t1.fname, t1.lname) AS agent_name, t1.address, t1.postalcode, t1.status, 
                        	t3.name as province, t4.name as city, t6.company_name
							FROM users AS t1 
							LEFT JOIN role_user AS t2 ON t1.id = t2.user_id 
							LEFT JOIN provinces AS t3 ON t1.province_id = t3.id 
							LEFT JOIN cities AS t4 ON t1.city_id = t4.id 
							LEFT JOIN company_user AS t5 ON t5.user_id = t1.id
							LEFT JOIN companies AS t6 ON t5.company_id = t6.id
							WHERE t2.role_id = '3' 
                        	and t1.fname LIKE ('%". $sSearch ."%')
                        	ORDER BY " . $sortBy . " " . $sortType ." LIMIT ".$start.", ".$length
                        )
                    );

        $agentsCount = DB::select(
                            DB::raw("
	                        SELECT t1.id
							FROM users AS t1 
							LEFT JOIN role_user AS t2 ON t1.id = t2.user_id 
							LEFT JOIN provinces AS t3 ON t1.province_id = t3.id 
							LEFT JOIN cities AS t4 ON t1.city_id = t4.id 
							LEFT JOIN company_user AS t5 ON t5.user_id = t1.id
							LEFT JOIN companies AS t6 ON t5.company_id = t6.id
							WHERE t2.role_id = '3' 
                        	and t1.fname LIKE ('%". $sSearch ."%')
                            ")
                        );

   	    // Assign it to the datatable pagination variable
   	    $iTotal = count($agentsCount);

   	    $response = array(
   	        'iTotalRecords' => $iTotal,
   	        'iTotalDisplayRecords' => $iTotal,
   	        'aaData' => array()
   	    );

   	    $k=0;
   	    if ( count( $agents ) > 0 )
   	    {
   	        foreach ($agents as $agent)
   	        {
   	            $response['aaData'][$k] = array(
   	                0 => $agent->id,
   	                1 => ucwords( strtolower( $agent->company_name ) ),
   	                2 => ucwords( strtolower( $agent->agent_name ) ),
   	                3 => $agent->email,
   	                4 => $agent->address,
   	                5 => ucwords( strtolower( $agent->province) ),
   	                6 => ucwords( strtolower( $agent->city ) ),
   	                7 => $agent->postalcode,
   	                8 => Helper::getStatusText($agent->status),
   	                9 => '<a href="javascript:void(0);" id="'. $agent->id .'" class="edit_agent"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
   	            );
   	            $k++;
   	        }
   	    }

   		return response()->json($response);
    }

    /**
     * Function to get the agent details
     * @param void
     * @return array
     */
    public function getAgentDetails()
    {
		$agentId = Input::get('agentId');

		$response = array();
		if( $agentId != '' )
		{
			$agentDetails = User::find($agentId);

			$agentCompanyDetails = $agentDetails->company;

	        $response = array(
	        	'id' 			=> $agentDetails->id,
	        	'email' 		=> $agentDetails->email,
	        	'fname' 		=> $agentDetails->fname,
	        	'lname' 		=> $agentDetails->lname,
	        	'address' 		=> $agentDetails->address,
	        	'province_id' 	=> $agentDetails->province_id,
	        	'city_id' 		=> $agentDetails->city_id,
	        	'postalcode' 	=> $agentDetails->postalcode,
	        	'company_id' 	=> $agentCompanyDetails[0]->id,
	        	'status' 		=> $agentDetails->status,
	        );

	        // Get the cities list for the selected province as the city list is filtered to the selected province by using the ajax
    		$cities = City::where(['province_id' => $agentDetails->province_id])->get();

    		if( count( $cities ) > 0 )
    		{
    			foreach ($cities as $city)
    			{
	    			$response['cities'][] = array(
	    				'id' 	=> $city->id,
	    				'city' 	=> ucwords( strtolower( $city->name ) ),
	    			);
    			}
    		}
		}

		return response()->json($response);
    }

    /**
     * Function to update the agent details
     * @param void
     * @return array
     */
    public function updateAgent()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $agentData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'agent_company'		=> $agentData['agent_company'],
		        'agent_fname'		=> $agentData['agent_fname'],
		        'agent_lname'		=> $agentData['agent_lname'],
		        'agent_email'		=> $agentData['agent_email'],
		        'agent_address'		=> $agentData['agent_address'],
		        'agent_province'	=> $agentData['agent_province'],
		        'agent_city'		=> $agentData['agent_city'],
		        'agent_postalcode'	=> $agentData['agent_postalcode'],
		        'agent_status'		=> $agentData['agent_status']
		    ),
		    array(
		        'agent_company' 	=> array('required'),
		        'agent_fname' 		=> array('required'),
		        'agent_lname' 		=> array('required'),
		        'agent_email' 		=> array('required', 'email'),
		        'agent_address'		=> array('required'),
		        'agent_province'	=> array('required'),
		        'agent_city' 		=> array('required'),
		        'agent_postalcode' 	=> array('required'),
		        'agent_status' 		=> array('required')
		    ),
		    array(
		        'agent_company.required'	=> 'Please select company',
		        'agent_fname.required' 		=> 'Please enter first name',
		        'agent_lname.required' 		=> 'Please enter last name',
		        'agent_email.required' 		=> 'Please enter email',
		        'agent_email.email' 		=> 'Please enter valid email',
		        'agent_address.required' 	=> 'Please enter address',
		        'agent_province.required' 	=> 'Please select province',
		        'agent_city.required' 		=> 'Please select city',
		        'agent_postalcode.required'	=> 'Please enter postal code',
		        'agent_status.required' 	=> 'Please select status'
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			$user = User::find($agentData['agent_id']);

			DB::beginTransaction();

			$user->email 		= $agentData['agent_email'];
			$user->fname 		= $agentData['agent_fname'];
			$user->lname 		= $agentData['agent_lname'];
			$user->address 		= $agentData['agent_address'];
			$user->province_id 	= $agentData['agent_province'];
			$user->city_id 		= $agentData['agent_city'];
			$user->postalcode 	= $agentData['agent_postalcode'];
			$user->status 		= $agentData['agent_status'];
			$user->updated_by 	= $userId;

			if( $user->save() )
			{
				// Check if the user company mapping exist or not
				$user->company()->sync($agentData['agent_company']);

				DB::commit();

				$response['errCode']    = 0;
	        	$response['errMsg']     = 'Agent added successfully';
	        	
			}
			else
			{
				DB::rollBack();

				$response['errCode']    = 3;
	        	$response['errMsg']     = 'Some error in adding agent';
			}
		}

		return response()->json($response);
    }
}