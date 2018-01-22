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
use Illuminate\Support\Facades\URL;
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
use App\CategoryService;
use App\PaymentPlan;
use App\PaymentPlanType;
use App\City;
use App\EmailTemplate;
use App\ClientActivityList;
use App\MovingItemCategory;
use App\MovingItemDetail;
use App\ProvincialAgencyDetail;
use App\ForgotPassword;
use App\EmailTemplateCategory;

use Validator;
use Helper;
use PDF;

class AdminController extends Controller
{
    /**
     * Function to return login view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::check() || Auth::viaRemember() )	// User is already logged-in or remembered
        {
        	return redirect('administrator/dashboard');
        }
        else 					// User is not logged-in, show the login page
        {
        	return view('administrator/index');
        }
    }

    /**
     * Function to return login or dashboard view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('administrator/dashboard');
    }

    /**
     * Function for Change Password
     * @param void
     * @return array
     */
    public function getchangepassword()
    {
        return view('administrator/changepassword');
    }

    /**
     * Function for Change Password
     * @param void
     * @return array
     */
    public function changePassword()
    {
        // Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $pwddata);

        // Server Side Validation
        $response =array();

        $validation = Validator::make(
            array(
                'oldpassword'  => $pwddata['oldpassword'],
                'newpassword'  => $pwddata['newpassword'],
                'cnfpassword'  => $pwddata['cnfpassword']
            ),
            array(
                'oldpassword'  => array('required'),
                'newpassword'  => array('required'),
                'cnfpassword'  => array('required')
            ),
            array(
                'oldpassword.required' => 'Please enter old password',
                'newpassword.required' => 'Please enter new password',
                'cnfpassword.required' => 'Please enter confirm password'
            )
        );

        if ( $validation->fails() )     // Some data is not valid as per the defined rules
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

            $userId = Auth::id();
            $user = User::find($userId);

            if(($pwddata['newpassword'] == $pwddata['cnfpassword']) && ($pwddata['newpassword'] != '') && ($pwddata['cnfpassword'] != '')) 
            {
                if (Hash::check($pwddata['oldpassword'], $user->password))
                {    
                    $user->password = Hash::make($pwddata['newpassword']);
                    $user->update();
                    $response['errCode']    = 0;
                    $response['errMsg']     = 'Password change successfully.';
                }
                else
                {
                    $response['errCode']    = 2;
                    $response['errMsg']     = 'Old password does not match.';
                }
            } 
            else 
            {
                $response['errCode']    = 3;
                $response['errMsg']     = 'Password and confirm password doest not match.';
            }
        }

        return response()->json($response);
    }

    /**
     * Function for Forgot Password
     * @param void
     * @return array
     */
    public function getForgotPassword(Request $request)
    {
        $type = 1;
        $q = $request->input('q');
        $hash = $request->input('hash');
        if($q != '' && $hash != '')
        {
            $type = 2;
        }

        return view('administrator/forgotpassword',['type' => $type, 'q' => $q, 'hash' => $hash]);
    }

    /**
     * Function for Forgot Password
     * @param void
     * @return array
     */
    public function forgotPassword()
    {
        // Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $pwddata);

        // Server Side Validation
        $response =array();

        if($pwddata['type'] == 1) 
        {

            $validation = Validator::make(
                array(
                    'email'  => $pwddata['email']
                ),
                array(
                    'email'  => array('required', 'email')
                ),
                array(
                    'email.required' => 'Please enter email',
                    'email.email'    => 'Please enter valid email',
                )
            );

            if ( $validation->fails() )     // Some data is not valid as per the defined rules
            {
                $error = $validation->errors()->first();

                if( isset( $error ) && !empty( $error ) )
                {
                    $response['errCode']    = 1;
                    $response['errMsg']     = $error;
                }
            }
            else                            // The data is valid, go ahead and check the login credentials and do login
            {
                $user = User::where(['email' => $pwddata['email'], 'status' => '1'])->first();
                if( count($user)  > 0 )
                {
                    if(1)
                    {
                        $response['errCode'] = 0;
                        $response['errMsg']  = 'Email has been sent successfully. Please check you email';
                    }
                    else
                    {
                        $response['errCode'] = 2;
                        $response['errMsg']  = 'Error while sending mail'; 
                    }

                }
                else
                {
                    $response['errCode'] = 3;
                    $response['errMsg']  = 'Invalid user credentials';
                }
            }

            return response()->json($response);
        
        } 
        elseif ($pwddata['type'] == 2)
        {
            $validation = Validator::make(
                array(
                    'newpassword'  => $pwddata['newpassword'],
                    'cnfpassword'  => $pwddata['cnfpassword']
                ),
                array(
                    'newpassword'  => array('required'),
                    'cnfpassword'  => array('required')
                ),
                array(
                    'newpassword.required' => 'Please enter new password',
                    'cnfpassword.required' => 'Please enter confirm password'
                )
            );

            if ( $validation->fails() )     // Some data is not valid as per the defined rules
            {
                $error = $validation->errors()->first();

                if( isset( $error ) && !empty( $error ) )
                {
                    $response['errCode']    = 1;
                    $response['errMsg']     = $error;
                }
            }
            else                            // The data is valid, go ahead and check the login credentials and do login
            {
                $email = base64_decode($pwddata['q']);
                $hash  = base64_decode($pwddata['hash']);
                $array = ForgotPassword::where(['email' => $email, 'hash' => $pwddata['hash'], 'status' => 0])->first();
                $user = User::where(['email' => $loginData['username'], 'status' => '1'])->first();

                if (count($array) > 0) 
                {
                    if(($pwddata['newpassword'] == $pwddata['cnfpassword']) && ($pwddata['newpassword'] != '') && ($pwddata['cnfpassword'] != '')) 
                    {
                        $user = User::find($user->id);
                        $user->password = Hash::make($pwddata['newpassword']);
                        $user->update();

                        $forgotPassword = ForgotPassword::find($array->id);
                        $forgotPassword->status = 1;
                        $forgotPassword->update();
                        
                        $response['errCode']    = 0;
                        $response['errMsg']     = 'Password change successfully.';
                    } 
                    else 
                    {
                        $response['errCode']    = 3;
                        $response['errMsg']     = 'Password and confirm password doest not match.';
                    }
                }
                else
                {
                    $response['errCode']    = 4;
                    $response['errMsg']     = 'Error';
                }
            }

            return response()->json($response);
        }
    }

    /**
     * Function for admin login
     * @param void
     * @return array
     */
    public function login()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $loginData);

        $remember = false;
        if( isset( $loginData['remember'] ) )
        {
        	$remember = true;
        }

        // Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'username'	=> $loginData['username'],
		        'password' 	=> $loginData['password']
		    ),
		    array(
		        'username' 	=> array('required', 'email'),
		        'password'	=> array('required', 'min:6'),
		    ),
		    array(
		        'username.required' => 'Please enter email',
		        'username.email'   	=> 'Please enter valid email',
		        'password.required'	=> 'Please enter password',
		        'password.min'    	=> 'Password must contain atleat 6 characters',
		    )
		);

		if ( $validation->fails() )		// Some data is not valid as per the defined rules
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else 							// The data is valid, go ahead and check the login credentials and do login
		{
			// Check for the credential and role. Only back-end user can login here
			
			// $user = User::where('email', '=', $loginData['username'])->first();
			$user = User::where(['email' => $loginData['username'], 'status' => '1'])->first();

			if( count($user)  > 0 )
			{
		        if( $user->hasRole(['admin']) )	// list of allowed users
		        {
		            if(Auth::attempt(['email' => $loginData['username'], 'password' => $loginData['password'], 'status' => '1'], $remember))
		            {
		                // Get the logged-in user id
		                $userId = Auth::id();

		                // If user credentials are valid, update the last_login time in users table.
		                $user = User::find($userId);
		                $user->last_login = date('Y-m-d H:i:s');
		                $user->update();

		                $response['errCode']    = 0;
		                $response['errMsg']     = 'Successful login';
		            }
		            else
		            {
		                $response['errCode']    = 2;
		                $response['errMsg']     = 'Invalid user credentials';
		            }
		        }
		        else
		        {
		        	$response['errCode']    = 3;
		           	$response['errMsg']     = 'Invalid user';
		        }
			}
			else
	        {
	        	$response['errCode']    = 4;
	           	$response['errMsg']     = 'Invalid user credentials';
	        }
		}

		return response()->json($response);
    }

    /**
     * Function to return the navigation category view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function navigationCategory()
    {
    	// Get the navigation types
    	$navigationTypes = CmsNavigationType::where(['status' => '1'])->select('id', 'type')->get();

    	return view('administrator/navigationcategory', ['navigationTypes' => $navigationTypes]);
    }

    /**
     * Function to return the activity feedback page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function activityFeedback()
    {
        return view('administrator/activityfeedback');
    }

    /**
     * Function to return the activity feedback view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function fetchActivityFeedback()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
                0 => 't1.id',
                1 => 't1.activity',
                2 => 'YesCount',
                3 => 'NoCount',
            );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $activityFeedback  = DB::select(
                        		DB::raw("SELECT SUM(case t2.action when '1' then 1 else 0 end) YesCount, SUM(case t2.action when '0' then 1 else 0 end) NoCount, t1.id, t1.activity FROM client_activity_lists as t1 left join client_activity_logs as t2 ON (t1.id = t2.activity_id) where t1.id != 1 and t1.listing_event = '1' and t1.status = '1' GROUP BY t1.id ORDER BY t1.id asc")
                    		);

        // Assign it to the datatable pagination variable
        $iTotal = count($activityFeedback);

        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $activityFeedback ) > 0 )
        {
            foreach ($activityFeedback as $activities)
            {
                $response['aaData'][$k] = array(
                    0 => $activities->id,
                    1 => ucfirst( strtolower($activities->activity)),
                    2 => $activities->YesCount,
                    3 => $activities->NoCount
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to save the navigation category
     * @param void
     * @return array
     */
    public function saveNavigationCategory()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $inputData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'categoryType'	=> $inputData['navigation_category_type'],
		        'categoryName' 	=> $inputData['navigation_category_name'],
		        'categoryStatus'=> $inputData['navigation_category_status'],
		    ),
		    array(
		        'categoryType' 	=> array('required'),
		        'categoryName'	=> array('required'),
		        'categoryStatus'=> array('required'),
		    ),
		    array(
		        'categoryType.required' 	=> 'Please select navigation type',
		        'categoryName.required'		=> 'Please enter category name',
		        'categoryStatus.required'	=> 'Please select status'
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
			if( $inputData['navigation_category_id'] == '' )		// Add the category
			{
				// Check for the already existing navigation category
				$category = CmsNavigationCategory::where(['category' => $inputData['navigation_category_name']])->first();

				if( count( $category ) == 0 )	// Category doesn't exist. Save the data
				{
					$cmsNavigationCategory = new CmsNavigationCategory;

			        $cmsNavigationCategory->navigation_type_id 	= $inputData['navigation_category_type'];
			        $cmsNavigationCategory->category 			= $inputData['navigation_category_name'];
			        $cmsNavigationCategory->status 				= $inputData['navigation_category_status'];
			        $cmsNavigationCategory->created_by 			= $userId;

			        if( $cmsNavigationCategory->save() )
			        {
			        	$response['errCode']    = 0;
			        	$response['errMsg']     = 'Navigation category added successfully';
			        }
			        else
			        {
			        	$response['errCode']    = 2;
			        	$response['errMsg']     = 'Some error in saving the navigation category';
			        }
				}
				else 							// Category already exist
				{
					$response['errCode']    = 3;
			        $response['errMsg']     = 'Navigation category already exist';
				}
			}
			else 	// Update the category
			{
				$cmsNavigationCategory = CmsNavigationCategory::find($inputData['navigation_category_id']);

				$cmsNavigationCategory->navigation_type_id 	= $inputData['navigation_category_type'];
		        $cmsNavigationCategory->category 			= $inputData['navigation_category_name'];
		        $cmsNavigationCategory->status 				= $inputData['navigation_category_status'];
		        $cmsNavigationCategory->updated_by 			= $userId;

				if( $cmsNavigationCategory->save() )
		        {
		        	$response['errCode']    = 0;
		        	$response['errMsg']     = 'Navigation category updated successfully';
		        }
		        else
		        {
		        	$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in updating the navigation category';
		        }
			}

		}

		return response()->json($response);
    }

    /**
     * Function to show the navigation category list in datatable
     * @param void
     * @return array
     */
    public function fetchNavigationCategories()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
                0 => 't1.id',
                1 => 't2.type',
                2 => 't1.category',
                3 => 't1.status',
            );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $categories = DB::select(
                        DB::raw("SELECT t1.id, t2.type as navigation_type, t1.category, t1.status FROM cms_navigation_categories t1 JOIN cms_navigation_types t2 ON t1.navigation_type_id = t2.id
                        	WHERE ( t1.category LIKE ('%". $sSearch ."%') OR t2.type LIKE ('%". $sSearch ."%') ) ORDER BY " . $sortBy . " " . $sortType ." LIMIT ".$start.", ".$length)
                    );

        // Get the total count without any condition to maintian the pagination
        $categoryCount = DB::select(
                            DB::raw("SELECT t1.id, t2.type, t1.category, t1.status FROM cms_navigation_categories t1 JOIN cms_navigation_types t2 ON t1.navigation_type_id = t2.id
                        	WHERE ( t1.category LIKE ('%". $sSearch ."%') OR t2.type LIKE ('%". $sSearch ."%') )")
                        );

        // Assign it to the datatable pagination variable
        $iTotal = count($categoryCount);

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
                    1 => ucfirst( strtolower( $category->navigation_type ) ),
                    2 => ucfirst( strtolower( $category->category ) ),
                    3 => Helper::getStatusText($category->status),
                    4 => '<a href="javascript:void(0);" id="'. $category->id .'" class="edit_navigation_category"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>',	// Category edit
                );
                $k++;
            }
        }

    	return response()->json($response);

    }

    /**
     * Function to get the details for the selected navigation category
     * @param void
     * @return array
     */
    public function getNavigationCategoryDetails()
    {
    	$categoryId = Input::get('categoryId');

    	$response = array();

    	if( $categoryId != '' )
    	{
    		$category = CmsNavigationCategory::where(['id' => $categoryId])->select('navigation_type_id', 'category', 'status')->first();

    		if( count( $category ) > 0 )
    		{
    			$response = array(
    				'type_id' 	=> $category->navigation_type_id,
    				'category' 	=> $category->category,
    				'status' 	=> $category->status
    			);
    		}
    	}

    	return response()->json($response);
    }

    /**
     * Function to return the navigation view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function navigation()
    {
    	// Get the categories list
    	$categories = CmsNavigationCategory::where(['status' => '1'])->select('id', 'category')->get();

    	return view('administrator/navigation', ['categories' => $categories]);
    }

    /**
     * Function to save the navigation
     * @param void
     * @return array
     */
    public function saveNavigation()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $inputData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

        // Server side validation
        $validation = Validator::make(
		    array(
		        'navigationText'	=> $inputData['navigation_text'],
		        'navigationURL'		=> $inputData['navigation_url'],
		        'navigationStatus'	=> $inputData['navigation_status'],
		    ),
		    array(
		        'navigationText'	=> array('required', 'regex:/(^[A-Za-z ]+$)+/'),	// Only alphabets and white spaces are allowed
		        'navigationURL'		=> array('required', 'regex:/(^[a-z]+$)+/'),		// Only alphabets in smallcase are allowed in url
		        'navigationStatus'	=> array('required'),
		    ),
		    array(
		        'navigationText.required'	=> 'Please enter navigation text',
		        'navigationText.regex'		=> 'Please enter valid navigation text',
		        'navigationURL.required'	=> 'Please enter navigation url',
		        'navigationURL.regex'		=> 'Only small case letter are allowed',
		        'navigationStatus.required'	=> 'Please select status'
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
			// Check if any one of the category is selected or not
			if( isset( $inputData['navigation_categories'] ) )
			{
				// Check for the already existing navigation
		   		$navigation = CmsNavigation::where(['navigation_text' => $inputData['navigation_text']])->first();

		   		if( count( $navigation ) == 0 )
		   		{
		   			// Save the data in navigation as well as in navigation category mapping table
		   			DB::beginTransaction();

		   			$navigation = new CmsNavigation;

		   			$navigation->navigation_text= $inputData['navigation_text'];
		   			$navigation->navigation_url = $inputData['navigation_url'];
		   			$navigation->status 		= $inputData['navigation_status'];
		   			$navigation->created_by 	= $userId;

		   			if( $navigation->save() )
		   			{
		   				$navigation->categories()->sync($inputData['navigation_categories']);
		   				DB::commit();
		   				$response['errCode']    = 0;
		   				$response['errMsg']     = 'Navigation added successfully';
		   			}
		   			else
		   			{
		   				DB::rollBack();

		   				$response['errCode']    = 4;
			        	$response['errMsg']     = 'Some error in saving the navigation';
		   			}
		   		}
		   		else
		   		{
		   			$response['errCode']    = 2;
			        $response['errMsg']     = 'Navigation already exist';
		   		}

			}
			else
			{
				$response['errCode']    = 1;
		        $response['errMsg']     = 'Please select atleast one category';
			}

		}

		return response()->json($response);

    }

    /**
     * Function to show the navigation list in datatable
     * @param void
     * @return array
     */
    public function fetchNavigation()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
                0 => 't1.id',
                1 => 't1.navigation_text',
                4 => 't1.status',
            );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $navigations = DB::select(
                        DB::raw("SELECT t1.id, t1.navigation_text, t1.navigation_url, t1.status, 
                        	GROUP_CONCAT(UCASE(LEFT(t3.category, 1)), SUBSTRING(t3.category, 2)  order by t3.category)
                        	as categories FROM cms_navigations t1 
                        	JOIN cms_navigation_cms_navigation_category t2 ON t1.id = t2.cms_navigation_id 
                        	JOIN cms_navigation_categories t3 ON t3.id = t2.cms_navigation_category_id 
                        	WHERE t1.navigation_text LIKE ('%". $sSearch ."%')
                        	GROUP BY t1.id, t1.navigation_text, t1.navigation_url, t1.status ORDER BY " . $sortBy . " " . $sortType ." LIMIT ".$start.", ".$length)
                    );

        // Get the total count without any condition to maintian the pagination
        $navigationCount = DB::select(
                            DB::raw("SELECT t1.id FROM cms_navigations t1 
                        	JOIN cms_navigation_cms_navigation_category t2 ON t1.id = t2.cms_navigation_id 
                        	JOIN cms_navigation_categories t3 ON t3.id = t2.cms_navigation_category_id 
                        	WHERE t1.navigation_text LIKE ('%". $sSearch ."%')
                        	GROUP BY t1.id, t1.navigation_text, t1.navigation_url, t1.status")
                        );

        // Assign it to the datatable pagination variable
        $iTotal = count($navigationCount);

        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $navigations ) > 0 )
        {
            foreach ($navigations as $navigation)
            {
                $response['aaData'][$k] = array(
                    0 => $navigation->id,
                    1 => ucwords( strtolower( $navigation->navigation_text ) ),
                    2 => $navigation->navigation_url,
                    3 => $navigation->categories,
                    4 => Helper::getStatusText($navigation->status),
                    5 => '<a href="javascript:void(0);" id="'. $navigation->id .'" class="edit_navigation"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>',	// Category edit
                );
                $k++;
            }
        }

    	return response()->json($response);

    }

    /**
     * Function to get the details for the selected navigation
     * @param void
     * @return array
     */
    public function getNavigationDetails()
    {
    	$navigationId = Input::get('navigationId');

    	$response = array();

    	if( $navigationId != '' )
    	{
    		// Get the details of the navigation and its associated categories
    		$navigationDetails = CmsNavigation::find($navigationId);

    		$navigationCategories = CmsNavigation::find($navigationId)->categories;

    		$categories = array();
    		foreach ($navigationCategories as $category)
    		{
    			array_push($categories, $category->id);
    		}

    		// Convert it into an array and return the array
    		$response = array(
    			'navigationText'		=> $navigationDetails->navigation_text,
    			'navigationURL'			=> $navigationDetails->navigation_url,
    			'navigationStatus'		=> $navigationDetails->status,
    			'navigationCategories'	=> $categories,
    		);
    	}

    	return response()->json($response);
    }

    /**
     * Function to update the navigation details
     * @param void
     * @return array
     */
    public function updateNavigation()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $inputData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

        // Server side validation
        $validation = Validator::make(
		    array(
		    	'navigationId'		=> $inputData['navigation_id'],
		        'navigationText'	=> $inputData['navigation_edit_text'],
		        'navigationURL'		=> $inputData['navigation_edit_url'],
		        'navigationStatus'	=> $inputData['navigation_edit_status']
		    ),
		    array(
		    	'navigationId' 		=> array('required'),
		        'navigationText'	=> array('required', 'regex:/(^[A-Za-z ]+$)+/'),	// Only alphabets and white spaces are allowed
		        'navigationURL'		=> array('required', 'regex:/(^[a-z]+$)+/'),		// Only alphabets in smallcase are allowed in url
		        'navigationStatus'	=> array('required')
		    ),
		    array(
		    	'navigationId.required'		=> 'Navigation id is missing',
		        'navigationText.required'	=> 'Please enter navigation text',
		        'navigationText.regex'		=> 'Please enter valid navigation text',
		        'navigationURL.required'	=> 'Please enter navigation url',
		        'navigationURL.regex'		=> 'Only small case letter are allowed',
		        'navigationStatus.required'	=> 'Please select status'
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
			// Check if any one of the category is selected or not
			if( isset( $inputData['navigation_edit_categories'] ) )
			{

				DB::beginTransaction();

				$navigation = CmsNavigation::find($inputData['navigation_id']);
	   			$navigation->navigation_text= $inputData['navigation_edit_text'];
	   			$navigation->navigation_url = $inputData['navigation_edit_url'];
	   			$navigation->status 		= $inputData['navigation_edit_status'];
	   			$navigation->updated_by 	= $userId;

				if($navigation->save())
				{
					// Update the navigation categories mapping also
					$navigation->categories()->sync($inputData['navigation_edit_categories']);
					DB::commit();
					$response['errCode']    = 0;
			        $response['errMsg']     = 'Navigation details updated successfully';
				}
				else
				{
					DB::rollBack();
					
					$response['errCode']    = 2;
			        $response['errMsg']     = 'Some issue in updating the navigation details';
				}
			}
			else
			{
				$response['errCode']    = 1;
		        $response['errMsg']     = 'Please select atleast one category';
			}
		}

		return response()->json($response);
    }

    /**
     * Function to return the page details
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function pages()
    {
    	// Get the navigation list. every page is bind with some unique navigation link
    	$navigations = CmsNavigation::where(['status' => '1'])->select('id', 'navigation_text')->get();

        return view('administrator/pages', ['navigations' => $navigations]);
    }

    /**
     * Function to save the page content
     * @param void
     * @return Array
     */
    public function savePage()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $pageData);

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server side validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'page_name'			=> $pageData['page_name'],
		        'page_navigation' 	=> $pageData['page_navigation'],
		        'page_content' 		=> $pageData['page_content'],
		        'page_status' 		=> $pageData['page_status']
		    ),
		    array(
		        'page_name' 		=> array('required'),
		        'page_navigation' 	=> array('required'),
		        'page_content' 		=> array('required'),
		        'page_status' 		=> array('required')
		    ),
		    array(
		        'page_name.required' 		=> 'Please enter the page name',
		        'page_navigation.required' 	=> 'Please select the navigation',
		        'page_content.required'		=> 'Please enter some page content',
		        'page_status.required'    	=> 'Please select status',
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
			if( $pageData['page_id'] == '' )	// Page id is not available, add the page
			{
				// Check if the page is already exist, only one page can be attached with a navigation
				$page = CmsPage::where(['navigation_id' => $pageData['page_navigation']])->first();

				if( count( $page ) == 0 )	// Add the page content
				{
					$cmsPage = new CmsPage;

					$cmsPage->navigation_id = $pageData['page_navigation'];
					$cmsPage->page_name 	= $pageData['page_name'];
					$cmsPage->page_content 	= $pageData['page_content'];
					$cmsPage->status 		= $pageData['page_status'];
					$cmsPage->created_by 	= $userId;

					if( $cmsPage->save() )
					{
						$response['errCode']    = 0;
			        	$response['errMsg']     = 'Page added successfully';
					}
					else
					{
						$response['errCode']    = 3;
			        	$response['errMsg']     = 'Some error in adding the page';
					}
				}
				else 						// Page already exist
				{
					$response['errCode']    = 2;
			        $response['errMsg']     = 'A page already exist with the selected navigation';
				}
			}
			else 								// Page id is available, edit the page
			{
				$cmsPage = CmsPage::find($pageData['page_id']);

				$cmsPage->navigation_id = $pageData['page_navigation'];
				$cmsPage->page_name 	= $pageData['page_name'];
				$cmsPage->page_content 	= $pageData['page_content'];
				$cmsPage->status 		= $pageData['page_status'];
				$cmsPage->updated_by 	= $userId;

				if( $cmsPage->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Page updated successfully';
				}
				else
				{
					$response['errCode']    = 3;
		        	$response['errMsg']     = 'Some error in updating the page';
				}
			}
		}

		return response()->json($response);
    }

    /**
     * Function to show the page list in datatable
     * @param void
     * @return array
     */
    public function fetchPages()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
                0 => 't1.id',
                1 => 't2.navigation_text',
                2 => 't1.page_name',
                4 => 't1.status',
            );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $pages 	= DB::select(
                    DB::raw("SELECT t1.id, t1.page_name, t1.page_content, t1.status, t2.navigation_text FROM cms_pages AS t1 
                    	JOIN cms_navigations AS t2 ON t1.navigation_id = t2.id WHERE ( t1.page_name LIKE '%". $sSearch ."%' OR t2.navigation_text LIKE '%". $sSearch ."%' )
                    	ORDER BY " . $sortBy . " " . $sortType ." LIMIT ".$start.", ".$length)
                );

        // Get the total page count
        $pageCount = DB::select(
                    DB::raw("SELECT t1.id FROM cms_pages AS t1 
                    	JOIN cms_navigations AS t2 ON t1.navigation_id = t2.id WHERE ( t1.page_name LIKE '%". $sSearch ."%' OR t2.navigation_text LIKE '%". $sSearch ."%' )")
                );

        // Assign it to the datatable pagination variable
        $iTotal = count($pageCount);

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $pages ) > 0 )
        {
            foreach ($pages as $page)
            {
            	$response['aaData'][$k] = array(
                    0 => $page->id,
                    1 => ucfirst( strtolower( $page->navigation_text ) ),
                    2 => ucfirst( strtolower( $page->page_name ) ),
                    3 => Helper::truncateString($page->page_content, 60),
                    4 => Helper::getStatusText($page->status),
                    5 => '<a href="javascript:void(0);" id="'. $page->id .'" class="edit_page_content"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to get the details for the selected page
     * @param void
     * @return array
     */
    public function getPageDetails()
    {
    	$pageId = Input::get('pageId');

    	$response = array();

    	if( $pageId != '' && $pageId != 0 )
    	{
    		$pageDetails = CmsPage::where(['id' => $pageId])->first();

    		if( count( $pageDetails ) > 0 )
    		{
    			$response['navigation_id'] 	= $pageDetails->navigation_id;
    			$response['page_name'] 		= $pageDetails->page_name;
    			$response['page_content'] 	= $pageDetails->page_content;
    			$response['status'] 		= $pageDetails->status;
    		}
    	}

		return response()->json($response);	
    }

    /**
     * Function to return the provinces page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function provinces()
    {
        return view('administrator/province');
    }

    /**
     * Function to return the moving category page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function movingCategory()
    {
        return view('administrator/movingcategory');
    }

    /**
     * Function to return the moving category page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function movingItemDetails()
    {
        $movingItemArray = MovingItemCategory::where(['status' => '1'])->select('id', 'item_name')->get();
        return view('administrator/movingitemdetails', ['movingItemArray' => $movingItemArray]);
    }

    /**
     * Function to return the activity page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function activity()
    {
        return view('administrator/activity');
    }

    /**
     * Function to return the provincial agency details page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function provincialAgencies()
    {
    	// Get the province lists
    	$provinces = Province::where(['status' => '1'])->select('id', 'name')->orderBy('name', 'asc')->get();

        return view('administrator/provincialAgencies', ['provinces' => $provinces]);
    }

    /**
     * Function to return the IndustryType page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function industryType()
    {
        return view('administrator/industrytype');
    }

    /**
     * Function to return the Services page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function services()
    {
    	$companyCategories = CompanyCategory::where(['status' => '1'])->select('id', 'category')->orderBy('category', 'asc')->get();
        return view('administrator/services', ['companyCategories' => $companyCategories]);
    }

    /**
     * Function to save the province details
     * @param void
     * @return Array
     */
    public function saveProvince(Request $request)
    {
    	$provinceImage   = $request->file('fileData');
    	$provinceId      = $request->input('province_id');
    	$countryId       = $request->input('country_id');
    	$abbreviation    = $request->input('abbreviation');
    	$provinceName    = $request->input('province_name');
    	$provinceStatus  = $request->input('province_status');

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server side validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'province_name'		=> $provinceName,
		        'province_status'	=> $provinceStatus,
		        'abbreviation'		=> $abbreviation
		    ),
		    array(
		        'province_name' 	=> array('required'),
		        'province_status' 	=> array('required'),
		        'abbreviation' 	    => array('required')
		    ),
		    array(
		        'province_name.required'	=> 'Please enter the province name',
		        'province_status.required' 	=> 'Please select status',
		        'abbreviation.required' 	=> 'Please enter the abbreviation'
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
			if(!is_null($provinceImage) && ($provinceImage->getSize() > 0))
			{

				// Image destination folder
				$destinationPath = storage_path() . '/uploads/province';
				if( $provinceImage->isValid() )  // If the file is valid or not
				{
				    $fileExt  = $provinceImage->getClientOriginalExtension();
				    $fileType = $provinceImage->getMimeType();
				    $fileSize = $provinceImage->getSize();

				    if( ( $fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png' ) && $fileSize <= 3000000 )     // 3 MB = 3000000 Bytes
				    {
				        // Rename the file
				        $fileNewName = str_random(40) . '.' . $fileExt;

				        if( $provinceImage->move( $destinationPath, $fileNewName ) )
				        {
				        	$response['errCode']    = 1;
				        }
			        	else
			        	{
			        		$response['errCode']    = 3;
			                $response['errMsg']     = 'Some error in image upload';
			        	}
				    }
			    	else
			    	{
			    		$response['errCode']    = 4;
			            $response['errMsg']     = 'Only image file with size less then 3MB is allowed';
			    	}
				}
				else
				{
					$response['errCode']    = 5;
			        $response['errMsg']     = 'Invalid file';
				}
			} else {
				$response['errCode']    = 2;
			}

			if($response['errCode'] == 1 || $response['errCode'] == 2)
			{
				if( $provinceId == '' )	// Check if the province id is available or not, if not add the province
				{
					$province = new Province;

					$province->name 		= $provinceName;
					$province->status 		= $provinceStatus;
					$province->country_id 	= $countryId;
					$province->abbreviation = $abbreviation;
					$province->updated_by 	= $userId;
					$province->created_by 	= $userId;
					if($response['errCode'] == 1)
					{
						$province->image 	= $fileNewName;
						$response['image']  = URL::to('/').'/images/province/'.$fileNewName;
					}
					if( $province->save() )
					{
						$response['errCode']    = 0;
			        	$response['errMsg']     = 'Province added successfully';
					}
					else
					{
						$response['errCode']    = 2;
			        	$response['errMsg']     = 'Some error in adding the province';
					}
				}
				else 										// Check if the province id is available or not, if available update the province
				{
					$province = Province::find($provinceId);

					$province->name 		= $provinceName;
					$province->status 		= $provinceStatus;
					$province->country_id 	= $countryId;
					$province->abbreviation = $abbreviation;
					$province->created_by 	= $userId;
					if($response['errCode'] == 1)
					{
						$province->image 	= $fileNewName;
						$response['image']  = URL::to('/').'/images/province/'.$fileNewName;
					}

					if( $province->save() )
					{
						$response['errCode']    = 0;
			        	$response['errMsg']     = 'Province updated successfully';
					}
					else
					{
						$response['errCode']    = 2;
			        	$response['errMsg']     = 'Some error in updating the province';
					}
				}
			}
		}

		return response()->json($response);
    }

    /**
     * Function to save the activity details
     * @param void
     * @return Array
     */
    public function saveActivity(Request $request)
    {
    	$activityImage   = $request->file('fileData');
    	$activityId      = $request->input('activity_id');
    	$description    = $request->input('description');
    	$activityName    = $request->input('activity_name');
    	$activityStatus  = $request->input('activity_status');

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server side validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'activity_name'		=> $activityName,
		        'activity_status'	=> $activityStatus,
		        'description'		=> $description
		    ),
		    array(
		        'activity_name' 	=> array('required'),
		        'activity_status' 	=> array('required'),
		        'description' 	    => array('required')
		    ),
		    array(
		        'activity_name.required'	=> 'Please enter the activity name',
		        'activity_status.required' 	=> 'Please select status',
		        'description.required' 	=> 'Please enter the description'
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
			if(!is_null($activityImage) && ($activityImage->getSize() > 0))
			{

				// Image destination folder
				$destinationPath = storage_path() . '/uploads/activities';
				if( $activityImage->isValid() )  // If the file is valid or not
				{
				    $fileExt  = $activityImage->getClientOriginalExtension();
				    $fileType = $activityImage->getMimeType();
				    $fileSize = $activityImage->getSize();

				    if( ( $fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png' ) && $fileSize <= 3000000 )     // 3 MB = 3000000 Bytes
				    {
				        // Rename the file
				        $fileNewName = str_random(40) . '.' . $fileExt;

				        if( $activityImage->move( $destinationPath, $fileNewName ) )
				        {
				        	$response['errCode']    = 1;
				        }
			        	else
			        	{
			        		$response['errCode']    = 3;
			                $response['errMsg']     = 'Some error in image upload';
			        	}
				    }
			    	else
			    	{
			    		$response['errCode']    = 4;
			            $response['errMsg']     = 'Only image file with size less then 3MB is allowed';
			    	}
				}
				else
				{
					$response['errCode']    = 5;
			        $response['errMsg']     = 'Invalid file';
				}
			} else {
				$response['errCode']    = 2;
			}

			if($response['errCode'] == 1 || $response['errCode'] == 2)
			{
				if( $activityId == '' )	// Check if the activity id is available or not, if not add the activity
				{
					$activities = new ClientActivityList;

					$activities->activity 		= $activityName;
					$activities->status 		= $activityStatus;
					$activities->description    = $description;
					$activities->updated_by 	= $userId;
					$activities->created_by 	= $userId;
					if($response['errCode'] == 1)
					{
						$activities->image_name = $fileNewName;
						$response['image']  = URL::to('/').'/images/activity/'.$fileNewName;
					}
					if( $activities->save() )
					{
						$response['errCode']    = 0;
			        	$response['errMsg']     = 'Activity added successfully';
					}
					else
					{
						$response['errCode']    = 2;
			        	$response['errMsg']     = 'Some error in adding the activity';
					}
				}
				else 										// Check if the activity id is available or not, if available update the activity
				{
					$activities = ClientActivityList::find($activityId);

					$activities->activity 		= $activityName;
					$activities->status 		= $activityStatus;
					$activities->description    = $description;
					$activities->created_by 	= $userId;
					if($response['errCode'] == 1)
					{
						$activities->image_name = $fileNewName;
						$response['image']  = URL::to('/').'/images/activity/'.$fileNewName;
					}

					if( $activities->save() )
					{
						$response['errCode']    = 0;
			        	$response['errMsg']     = 'Activity updated successfully';
					}
					else
					{
						$response['errCode']    = 2;
			        	$response['errMsg']     = 'Some error in updating the activity';
					}
				}
			}
		}

		return response()->json($response);
    }


    /**
     * Function to save the provincial agency details
     * @param void
     * @return Array
     */
    public function saveProvincialAgency()
    {
    	$agencyId 	= Input::get('agencyId');

    	$agencyName = Input::get('agencyName');
    	$provinceId = Input::get('province');

    	$logo 		= Input::file('logo');

    	$label1 	= Input::get('label1');
    	$label2 	= Input::get('label2');
    	$label3 	= Input::get('label3');
    	$label4 	= Input::get('label4');
    	$label5 	= Input::get('label5');
    	$label6 	= Input::get('label6');
    	$label7 	= Input::get('label7');
    	$label8 	= Input::get('label8');
    	$label9 	= Input::get('label9');
    	$label10	= Input::get('label10');

    	$heading1 	= Input::get('heading1');
    	$heading2	= Input::get('heading2');
    	$heading3	= Input::get('heading3');
    	$heading4	= Input::get('heading4');

    	$detail1	= Input::get('detail1');
    	$detail2	= Input::get('detail2');
    	$detail3	= Input::get('detail3');
    	$detail4	= Input::get('detail4');

    	$link 		= Input::get('link');
    	$status		= Input::get('status');

        // Get the logged in user id
        $userId = Auth::user()->id;

        $response = array();
        if( $agencyId == '' )	// Add the provincial agency data
        {
        	$fileName = null;
        	if( isset( $logo ) && count( $logo ) > 0 )
        	{
        		// Image destination folder
				$destinationPath = storage_path() . '/uploads/provincial_agencies';

				if( $logo->isValid() )  // If the file is valid or not
				{
					$fileExt  = $logo->getClientOriginalExtension();
				    $fileType = $logo->getMimeType();
				    $fileSize = $logo->getSize();

				    if( ( $fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png' ) && $fileSize <= 3000000 )     // 3 MB = 3000000 Bytes
				    {
				    	// Rename the file
				        $fileName = str_random(40) . '.' . $fileExt;

				        if( $logo->move( $destinationPath, $fileName ) )
				        {
	        	        	$provincialDetail = new ProvincialAgencyDetail;

    						$provincialDetail->province_id 	= $provinceId;
	        	    		$provincialDetail->agency_name 	= $agencyName;

	        	    		$provincialDetail->label1 		= $label1;
	        	    		$provincialDetail->label2 		= $label2;
	        	    		$provincialDetail->label3		= $label3;
	        	    		$provincialDetail->label4 		= $label4;
	        	    		$provincialDetail->label5 		= $label5;
	        	    		$provincialDetail->label6 		= $label6;
	        	    		$provincialDetail->label7 		= $label7;
	        	    		$provincialDetail->label8 		= $label8;
	        	    		$provincialDetail->label9 		= $label9;
	        	    		$provincialDetail->label10 		= $label10;

	        	    		$provincialDetail->heading1 	= $heading1;
	        	    		$provincialDetail->heading2 	= $heading2;
	        	    		$provincialDetail->heading3 	= $heading3;
	        	    		$provincialDetail->heading4 	= $heading4;

	        	    		$provincialDetail->detail1 		= $detail1;
	        	    		$provincialDetail->detail2 		= $detail2;
	        	    		$provincialDetail->detail3 		= $detail3;
	        	    		$provincialDetail->detail4 		= $detail4;

	        	    		$provincialDetail->link 		= $link;
	        	    		$provincialDetail->logo 		= $fileName;
	        	    		$provincialDetail->status 		= $status;
	        	    		$provincialDetail->created_by 	= $userId;

	        	    		if( $provincialDetail->save() )
	        				{
	        					$response['errCode']    = 0;
	        		        	$response['errMsg']     = 'Address added successfully';
	        				}
	        				else
	        				{
	        					$response['errCode']    = 2;
	        		        	$response['errMsg']     = 'Some error in adding the address';
	        				}
				        }
				        else
				        {
				        	$response['errCode']    = 3;
	        		        $response['errMsg']     = 'Invalid file type';
				        }
				    }
				}
		        else
		        {
		        	$response['errCode']    = 4;
    		        $response['errMsg']     = 'Invalid file type';
		        }
        	}
        	else
        	{
	        	$provincialDetail = new ProvincialAgencyDetail;

	    		$provincialDetail->province_id 	= $provinceId;
				$provincialDetail->agency_name 	= $agencyName;

	    		$provincialDetail->label1 		= $label1;
	    		$provincialDetail->label2 		= $label2;
	    		$provincialDetail->label3		= $label3;
	    		$provincialDetail->label4 		= $label4;
	    		$provincialDetail->label5 		= $label5;
	    		$provincialDetail->label6 		= $label6;
	    		$provincialDetail->label7 		= $label7;
	    		$provincialDetail->label8 		= $label8;
	    		$provincialDetail->label9 		= $label9;
	    		$provincialDetail->label10 		= $label10;

	    		$provincialDetail->heading1 	= $heading1;
	    		$provincialDetail->heading2 	= $heading2;
	    		$provincialDetail->heading3 	= $heading3;
	    		$provincialDetail->heading4 	= $heading4;

	    		$provincialDetail->detail1 		= $detail1;
	    		$provincialDetail->detail2 		= $detail2;
	    		$provincialDetail->detail3 		= $detail3;
	    		$provincialDetail->detail4 		= $detail4;

	    		$provincialDetail->link 		= $link;
	    		$provincialDetail->logo 		= $fileName;
	    		$provincialDetail->status 		= $status;
	    		$provincialDetail->created_by 	= $userId;

	    		if( $provincialDetail->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Address added successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in adding the address';
				}
        	}
        }
        else 					// Update the provincial agency data
        {
        	$fileName = null;
        	if( isset( $logo ) && count( $logo ) > 0 )
        	{
        		// Image destination folder
				$destinationPath = storage_path() . '/uploads/provincial_agencies';

				if( $logo->isValid() )  // If the file is valid or not
				{
					$fileExt  = $logo->getClientOriginalExtension();
				    $fileType = $logo->getMimeType();
				    $fileSize = $logo->getSize();

				    if( ( $fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png' ) && $fileSize <= 3000000 )     // 3 MB = 3000000 Bytes
				    {
				    	// Rename the file
				        $fileName = str_random(40) . '.' . $fileExt;

				        if( $logo->move( $destinationPath, $fileName ) )
				        {
	        	        	$provincialDetail = ProvincialAgencyDetail::find($agencyId);

	        	    		$provincialDetail->province_id 	= $provinceId;
							$provincialDetail->agency_name 	= $agencyName;

	        	    		$provincialDetail->label1 		= $label1;
	        	    		$provincialDetail->label2 		= $label2;
	        	    		$provincialDetail->label3		= $label3;
	        	    		$provincialDetail->label4 		= $label4;
	        	    		$provincialDetail->label5 		= $label5;
	        	    		$provincialDetail->label6 		= $label6;
	        	    		$provincialDetail->label7 		= $label7;
	        	    		$provincialDetail->label8 		= $label8;
	        	    		$provincialDetail->label9 		= $label9;
	        	    		$provincialDetail->label10 		= $label10;

	        	    		$provincialDetail->heading1 	= $heading1;
	        	    		$provincialDetail->heading2 	= $heading2;
	        	    		$provincialDetail->heading3 	= $heading3;
	        	    		$provincialDetail->heading4 	= $heading4;

	        	    		$provincialDetail->detail1 		= $detail1;
	        	    		$provincialDetail->detail2 		= $detail2;
	        	    		$provincialDetail->detail3 		= $detail3;
	        	    		$provincialDetail->detail4 		= $detail4;

	        	    		$provincialDetail->link 		= $link;
	        	    		$provincialDetail->logo 		= $fileName;
	        	    		$provincialDetail->status 		= $status;
	        	    		$provincialDetail->updated_by 	= $userId;

	        	    		if( $provincialDetail->save() )
	        				{
	        					$response['errCode']    = 0;
	        		        	$response['errMsg']     = 'Provincial agency details updated successfully';
	        				}
	        				else
	        				{
	        					$response['errCode']    = 2;
	        		        	$response['errMsg']     = 'Some error in updating the provincial agency details';
	        				}
				        }
				        else
				        {
				        	$response['errCode']    = 3;
	        		        $response['errMsg']     = 'Invalid file type';
				        }
				    }
				}
		        else
		        {
		        	$response['errCode']    = 4;
    		        $response['errMsg']     = 'Invalid file type';
		        }
        	}
        	else
        	{
	        	$provincialDetail = ProvincialAgencyDetail::find($agencyId);

	    		$provincialDetail->province_id 	= $provinceId;
				$provincialDetail->agency_name 	= $agencyName;

	    		$provincialDetail->label1 		= $label1;
	    		$provincialDetail->label2 		= $label2;
	    		$provincialDetail->label3		= $label3;
	    		$provincialDetail->label4 		= $label4;
	    		$provincialDetail->label5 		= $label5;
	    		$provincialDetail->label6 		= $label6;
	    		$provincialDetail->label7 		= $label7;
	    		$provincialDetail->label8 		= $label8;
	    		$provincialDetail->label9 		= $label9;
	    		$provincialDetail->label10 		= $label10;

	    		$provincialDetail->heading1 	= $heading1;
	    		$provincialDetail->heading2 	= $heading2;
	    		$provincialDetail->heading3 	= $heading3;
	    		$provincialDetail->heading4 	= $heading4;

	    		$provincialDetail->detail1 		= $detail1;
	    		$provincialDetail->detail2 		= $detail2;
	    		$provincialDetail->detail3 		= $detail3;
	    		$provincialDetail->detail4 		= $detail4;

	    		$provincialDetail->link 		= $link;
	    		$provincialDetail->logo 		= $fileName;
	    		$provincialDetail->status 		= $status;
	    		$provincialDetail->updated_by 	= $userId;

	    		if( $provincialDetail->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Provincial agency details updated successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in adding the provincial agency details';
				}
        	}
        }

        return response()->json($response);
    }

    /**
     * Function to save the industry details
     * @param void
     * @return Array
     */
    public function saveIndustryType(Request $request)
    {
    	$industry_id      = $request->input('industry_id');
    	$industry_name    = $request->input('industry_name');
    	$industry_status  = $request->input('industry_status');

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server side validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'industry_name'		=> $industry_name,
		        'industry_status'	=> $industry_status
		    ),
		    array(
		        'industry_name' 	=> array('required'),
		        'industry_status' 	=> array('required')
		    ),
		    array(
		        'industry_name.required'	=> 'Please enter the industry name',
		        'industry_status.required' 	=> 'Please select status'
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
			if($industry_id != '') 
			{
				$industry = CompanyCategory::find($industry_id);

				$industry->category 		= $industry_name;
				$industry->status 			= $industry_status;
				$industry->updated_by 		= $userId;

				if( $industry->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Industry updated successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in updating the industry';
				}
			} else {
				$response['errCode']    = 2;
		        $response['errMsg']     = 'Some error in updating the industry';
			}
		}

		return response()->json($response);
    }

    /**
     * Function to save the service details
     * @param void
     * @return Array
     */
    public function saveServices(Request $request)
    {
    	$services_id      = $request->input('services_id');
    	$services_name    = $request->input('services_name');
    	$description      = $request->input('description');
    	$category      = $request->input('category');
    	$services_status  = $request->input('services_status');

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server side validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'services_name'		=> $services_name,
		        'description'		=> $description,
		        'services_status'	=> $services_status,
		        'category'			=> $category,
		    ),
		    array(
		        'services_name' 	=> array('required'),
		        'description' 		=> array('required'),
		        'services_status' 	=> array('required'),
		        'category' 			=> array('required')
		    ),
		    array(
		        'services_name.required'	=> 'Please enter the service name',
		        'description.required'		=> 'Please enter the service description',
		        'services_status.required' 	=> 'Please select status',
		        'category.required' 		=> 'Please select category'
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
			if($services_id == '') 
			{
				$services = new CategoryService;
				$services->service 				= $services_name;
				$services->description 			= $description;
				$services->status    			= $services_status;
				$services->company_category_id  = $category;
				$services->updated_by 			= $userId;
				$services->created_by 			= $userId;

				if( $services->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Service added successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in adding the service';
				}
			}
			else
			{ 

				$services = CategoryService::find($services_id);
				$services->service 				= $services_name;
				$services->description 			= $description;
				$services->status 				= $services_status;
				$services->company_category_id 	= $category;
				$services->updated_by 			= $userId;

				if( $services->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Service updated successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in updating the service';
				}
			}
		}

		return response()->json($response);
    }

    /**
     * Function to save the moviing category details
     * @param void
     * @return Array
     */
    public function saveMovingCategory(Request $request)
    {
        $category_id      = $request->input('category_id');
        $category_name    = $request->input('category_name');
        $category_status  = $request->input('category_status');

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server side validation
        $response =array();

        $validation = Validator::make(
            array(
                'category_name'     => $category_name,
                'category_status'   => $category_status
            ),
            array(
                'category_name'     => array('required'),
                'category_status'   => array('required')
            ),
            array(
                'category_name.required'    => 'Please enter the category name',
                'category_status.required'  => 'Please select status'
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
            if($category_id == '') 
            {
                $movingItem = new MovingItemCategory;
                $movingItem->item_name          = $category_name;
                $movingItem->status             = $category_status;
                $movingItem->updated_by         = $userId;
                $movingItem->created_by         = $userId;

                if( $movingItem->save() )
                {
                    $response['errCode']    = 0;
                    $response['errMsg']     = 'Category added successfully';
                }
                else
                {
                    $response['errCode']    = 2;
                    $response['errMsg']     = 'Some error in adding the category';
                }
            }
            else
            { 

                $movingItem = MovingItemCategory::find($category_id);
                $movingItem->item_name            = $category_name;
                $movingItem->status               = $category_status;
                $movingItem->updated_by           = $userId;

                if( $movingItem->save() )
                {
                    $response['errCode']    = 0;
                    $response['errMsg']     = 'Category updated successfully';
                }
                else
                {
                    $response['errCode']    = 2;
                    $response['errMsg']     = 'Some error in updating the category';
                }
            }
        }

        return response()->json($response);
    }

    /**
     * Function to save the moviing category details
     * @param void
     * @return Array
     */
    public function saveMovingItemDetails(Request $request)
    {
        $item_id            = $request->input('item_id');
        $item_name          = $request->input('item_name');
        $item_weight        = $request->input('item_weight');
        $item_category      = $request->input('item_category');
        $item_status        = $request->input('item_status');

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server side validation
        $response =array();

        $validation = Validator::make(
            array(
                'item_name'      => $item_name,
                'item_weight'    => $item_weight,
                'item_category'  => $item_category,
                'item_status'    => $item_status
            ),
            array(
                'item_name'     => array('required'),
                'item_weight'   => array('required'),
                'item_category' => array('required'),
                'item_status'   => array('required')
            ),
            array(
                'item_name.required'        => 'Please enter the item name',
                'item_weight.required'      => 'Please enter the item weight',
                'item_category.required'    => 'Please enter the item category',
                'item_status.required'      => 'Please select status'
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
            if($item_id == '') 
            {
                $movingItem = new MovingItemDetail;
                $movingItem->item_name                  = $item_name;
                $movingItem->item_weight                = $item_weight;
                $movingItem->moving_item_category_id    = $item_category;
                $movingItem->status                     = $item_status;
                $movingItem->updated_by                 = $userId;
                $movingItem->created_by                 = $userId;

                if( $movingItem->save() )
                {
                    $response['errCode']    = 0;
                    $response['errMsg']     = 'Category added successfully';
                }
                else
                {
                    $response['errCode']    = 2;
                    $response['errMsg']     = 'Some error in adding the category';
                }
            }
            else
            { 

                $movingItem = MovingItemDetail::find($item_id);
                $movingItem->item_name                  = $item_name;
                $movingItem->item_weight                = $item_weight;
                $movingItem->moving_item_category_id    = $item_category;
                $movingItem->status                     = $item_status;
                $movingItem->updated_by                 = $userId;

                if( $movingItem->save() )
                {
                    $response['errCode']    = 0;
                    $response['errMsg']     = 'Category updated successfully';
                }
                else
                {
                    $response['errCode']    = 2;
                    $response['errMsg']     = 'Some error in updating the category';
                }
            }
        }

        return response()->json($response);
    }

    /**
     * Function to show the province list in datatable
     * @param void
     * @return array
     */
    public function fetchProvinces()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'name',
            2 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $provinces = Province::where('name','like', '%'.$sSearch.'%')
                    ->orderBy($sortBy, $sortType)
                    ->limit($length)
                    ->offset($start)
                    ->select('id', 'name', 'status')
                    ->get();

        $iTotal = Province::where('name','like', '%'.$sSearch.'%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $provinces ) > 0 )
        {
            foreach ($provinces as $province)
            {
            	$response['aaData'][$k] = array(
                    0 => $province->id,
                    1 => ucfirst( strtolower( $province->name ) ),
                    2 => Helper::getStatusText($province->status),
                    3 => '<a href="javascript:void(0);" id="'. $province->id .'" class="edit_province"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to show the moving Category list in datatable
     * @param void
     * @return array
     */
    public function fetchMovingCategory()
    {
        $start      = Input::get('iDisplayStart');      // Offset
        $length     = Input::get('iDisplayLength');     // Limit
        $sSearch    = Input::get('sSearch');            // Search string
        $col        = Input::get('iSortCol_0');         // Column number for sorting
        $sortType   = Input::get('sSortDir_0');         // Sort type

        // Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'name',
            2 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $movingItemArray = MovingItemCategory::where('item_name','like', '%'.$sSearch.'%')
                    ->orderBy($sortBy, $sortType)
                    ->limit($length)
                    ->offset($start)
                    ->select('id', 'item_name', 'status')
                    ->get();

        $iTotal = MovingItemCategory::where('item_name','like', '%'.$sSearch.'%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $movingItemArray ) > 0 )
        {
            foreach ($movingItemArray as $movingItem)
            {
                $response['aaData'][$k] = array(
                    0 => $movingItem->id,
                    1 => ucfirst( strtolower( $movingItem->item_name ) ),
                    2 => Helper::getStatusText($movingItem->status),
                    3 => '<a href="javascript:void(0);" id="'. $movingItem->id .'" class="edit_moving_category"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

        return response()->json($response);
    }

    /**
     * Function to show the moving Category list in datatable
     * @param void
     * @return array
     */
    public function fetchMovingItemDetails()
    {
        $start      = Input::get('iDisplayStart');      // Offset
        $length     = Input::get('iDisplayLength');     // Limit
        $sSearch    = Input::get('sSearch');            // Search string
        $col        = Input::get('iSortCol_0');         // Column number for sorting
        $sortType   = Input::get('sSortDir_0');         // Sort type

        // Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'name',
            2 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $movingItemArray = DB::table('moving_item_details')
                            ->leftJoin('moving_item_categories', 'moving_item_categories.id', '=', 'moving_item_details.moving_item_category_id')
                            ->orderBy($sortBy, $sortType)
                            ->limit($length)
                            ->offset($start)
                            ->select('moving_item_details.*', 'moving_item_categories.item_name as cname')
                            ->get();

        $iTotal = DB::table('moving_item_details')
                    ->leftJoin('moving_item_categories', 'moving_item_categories.id', '=', 'moving_item_details.moving_item_category_id')
                    ->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $movingItemArray ) > 0 )
        {
            foreach ($movingItemArray as $movingItem)
            {
                $response['aaData'][$k] = array(
                    0 => $movingItem->id,
                    1 => ucfirst( strtolower( $movingItem->cname ) ),
                    2 => ucfirst( strtolower( $movingItem->item_name ) ),
                    3 => $movingItem->item_weight,
                    4 => Helper::getStatusText($movingItem->status),
                    5 => '<a href="javascript:void(0);" id="'. $movingItem->id .'" class="edit_moving_item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

        return response()->json($response);
    }

    /**
     * Function to show the activity list in datatable
     * @param void
     * @return array
     */
    public function fetchActivity()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'name',
            2 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $activitylist = ClientActivityList::orderBy($sortBy, $sortType)
                    ->limit($length)
                    ->offset($start)
                    ->get();

        $iTotal = ClientActivityList::count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $activitylist ) > 0 )
        {
            foreach ($activitylist as $activities)
            {
            	$response['aaData'][$k] = array(
                    0 => $activities->id,
                    1 => ucfirst( strtolower( $activities->activity ) ),
                    2 => ucfirst( strtolower( $activities->description ) ),
                    3 => Helper::getStatusText($activities->status),
                    4 => '<a href="javascript:void(0);" id="'. $activities->id .'" class="edit_activity"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to show the provincial agency list in datatable
     * @param void
     * @return array
     */
    public function fetchProvincialAgencies()
    {
        $start      = Input::get('iDisplayStart');      // Offset
        $length     = Input::get('iDisplayLength');     // Limit
        $sSearch    = Input::get('sSearch');            // Search string
        $col        = Input::get('iSortCol_0');         // Column number for sorting
        $sortType   = Input::get('sSortDir_0');         // Sort type

        // Datatable column number to table column name mapping
        $arr = array(
            0 => 'id'
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        $provincialAgencies = ProvincialAgencyDetail::where('agency_name','like', '%'.$sSearch.'%')
        					->orderBy($sortBy, $sortType)
	                        ->limit($length)
	                        ->offset($start)
	                        ->select('id', 'province_id', 'agency_name')
                        	->get();

        $iTotal = ProvincialAgencyDetail::count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $provincialAgencies ) > 0 )
        {
            foreach ($provincialAgencies as $provincialAgency)
            {
            	$province = Province::find($provincialAgency->province_id);

                $response['aaData'][$k] = array(
                    0 => $provincialAgency->id,
                    1 => ucfirst(strtolower($provincialAgency->agency_name)),
                    2 => ucwords( strtolower( $province->name ) ),
                    3 => '<a href="javascript:void(0);" id="'. $provincialAgency->id .'" class="edit_provincial_agency_details"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

        return response()->json($response);
    }

    /**
     * Function to show the Services list in datatable
     * @param void
     * @return array
     */
    public function fetchServices()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'name',
            2 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
      	$servicelist = DB::table('category_services')
           				->leftJoin('company_categories', 'company_categories.id', '=', 'category_services.company_category_id')
           				->orderBy($sortBy, $sortType)
           				->limit($length)
           				->offset($start)
            			->select('category_services.*', 'company_categories.category')
            			->get();

        $iTotal = DB::table('category_services')
           			->leftJoin('company_categories', 'company_categories.id', '=', 'category_services.company_category_id')
            		->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $servicelist ) > 0 )
        {
            foreach ($servicelist as $services)
            {
            	$response['aaData'][$k] = array(
                    0 => $services->id,
                    1 => ucfirst( strtolower( $services->service ) ),
                    2 => $services->description,
                    3 => ucfirst( strtolower( $services->category ) ),
                    4 => Helper::getStatusText($services->status),
                    5 => '<a href="javascript:void(0);" id="'. $services->id .'" class="edit_services"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to show the Industry Type list in datatable
     * @param void
     * @return array
     */
    public function fetchIndustryType()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'name',
            2 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $industrylist = CompanyCategory::orderBy($sortBy, $sortType)
                    ->limit($length)
                    ->offset($start)
                    ->get();

        $iTotal = CompanyCategory::count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $industrylist ) > 0 )
        {
            foreach ($industrylist as $industry)
            {
            	$response['aaData'][$k] = array(
                    0 => $industry->id,
                    1 => ucfirst( strtolower( $industry->category ) ),
                    2 => Helper::getStatusText($industry->status),
                    3 => '<a href="javascript:void(0);" id="'. $industry->id .'" class="edit_industry"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to get the details for the selected province
     * @param void
     * @return array
     */
    public function getProvinceDetails()
    {
    	$provinceId = Input::get('provinceId');

    	$response = array();
    	if( $provinceId != '' )
    	{
    		$province = Province::find($provinceId);

    		$response['name'] 	= $province->name;
    		$response['status'] = $province->status;
    		$response['image']  = URL::to('/').'/images/province/'.$province->image;
    		$response['country_id']  = $province->country_id;
    		$response['abbreviation'] = $province->abbreviation;

    	}

    	return response()->json($response);
    }

    /**
     * Function to get the details for the selected moving item details
     * @param void
     * @return array
     */
    public function getMovingCategory()
    {
        $movingItemId = Input::get('movingItemId');

        $response = array();
        if( $movingItemId != '' )
        {
            $movingItem = MovingItemCategory::find($movingItemId);
            $response['item_name']   = $movingItem->item_name;
            $response['status'] = $movingItem->status;
        }

        return response()->json($response);
    }

    /**
     * Function to get the details for the selected moving item details
     * @param void
     * @return array
     */
    public function getMovingItemDetails()
    {
        $movingItemId = Input::get('movingItemId');

        $response = array();
        if( $movingItemId != '' )
        {
            $movingItem = MovingItemDetail::find($movingItemId);
            $response['moving_item_category_id']    = $movingItem->moving_item_category_id;
            $response['item_name']                  = $movingItem->item_name;
            $response['item_weight']                = $movingItem->item_weight;
            $response['status']                     = $movingItem->status;
        }

        return response()->json($response);
    }

    /**
     * Function to get the details for the selected activity
     * @param void
     * @return array
     */
    public function getActivityDetails()
    {
    	$activityId = Input::get('activityId');

    	$response = array();
    	if( $activityId != '' )
    	{
    		$activities = ClientActivityList::find($activityId);

    		$response['name'] 	= $activities->activity;
    		$response['status'] = $activities->status;
    		$response['image']  = URL::to('/').'/images/activity/'.$activities->image_name;
    		$response['description']  = $activities->description;

    	}

    	return response()->json($response);
    }

    /**
     * Function to get the details for the selected provincial agency
     * @param void
     * @return array
     */
    public function getProvincialAgencyDetails()
    {
        $agencyId = Input::get('agencyId');

        $provincialAgencyDetails = ProvincialAgencyDetail::find($agencyId);

        return response()->json($provincialAgencyDetails);
    }

    /**
     * Function to get the details for the selected Industry
     * @param void
     * @return array
     */
    public function getIndustryTypeDetails()
    {
    	$industryId = Input::get('industryId');

    	$response = array();
    	if( $industryId != '' )
    	{
    		$industry = CompanyCategory::find($industryId);

    		$response['category'] 	= $industry->category;
    		$response['status'] = $industry->status;

    	}

    	return response()->json($response);
    }

    /**
     * Function to get the details for the selected services
     * @param void
     * @return array
     */
    public function getServicesDetails()
    {
    	$serviceId = Input::get('serviceId');

    	$response = array();
    	if( $serviceId != '' )
    	{
    		$services = CategoryService::find($serviceId);

    		$response['service'] 	= $services->service;
    		$response['status'] = $services->status;
    		$response['category'] = $services->company_category_id;
    		$response['description']  = $services->description;

    	}

    	return response()->json($response);
    }

    /**
     * Function to return service categories view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function utilityServiceCategories()
    {
        return view('administrator/servicecategories');
    }

    /**
     * Function to return service categories view
     * @param void
     * @return array
     */
    public function saveUtilityServiceCategory()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $serviceCategoryData);

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server side validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'service_type'			=> $serviceCategoryData['service_type'],
		        'service_description'	=> $serviceCategoryData['service_description'],
		        'service_status'		=> $serviceCategoryData['service_status']
		    ),
		    array(
		        'service_type' 			=> array('required'),
		        'service_description' 	=> array('required'),
		        'service_status' 		=> array('required')
		        
		    ),
		    array(
		        'service_type.required'			=> 'Please enter service type',
		        'service_description.required'	=> 'Please enter service description',
		        'service_status.required'		=> 'Please select status'
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
			if( $serviceCategoryData['service_id'] == '' ) // Check if service category id is available or not. If not available, add the service category
			{
				$serviceCategory = new UtilityServiceCategory;

				$serviceCategory->category_type = $serviceCategoryData['service_type'];
				$serviceCategory->description 	= $serviceCategoryData['service_description'];
				$serviceCategory->status 		= $serviceCategoryData['service_status'];
				$serviceCategory->created_by 	= $userId;

				if( $serviceCategory->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Service category added successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in adding the service category';
				}
			}
			else
			{
				$serviceCategory = UtilityServiceCategory::find( $serviceCategoryData['service_id'] );

				$serviceCategory->category_type = $serviceCategoryData['service_type'];
				$serviceCategory->description 	= $serviceCategoryData['service_description'];
				$serviceCategory->status 		= $serviceCategoryData['service_status'];
				$serviceCategory->created_by 	= $userId;

				if( $serviceCategory->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Service category updated successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in updating the service category';
				}
			}
		}

		return response()->json($response);
    }

    /**
     * Function show the utility service categories list in datatable
     * @param void
     * @return array
     */
    public function fetchUtilityServiceCategories()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'category_type',
            3 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $serviceCategories = UtilityServiceCategory::where('category_type','like', '%'.$sSearch.'%')
		                    ->orderBy($sortBy, $sortType)
		                    ->limit($length)
		                    ->offset($start)
		                    ->select('id', 'category_type', 'description', 'status')
		                    ->get();

        $iTotal = UtilityServiceCategory::where('category_type','like', '%'.$sSearch.'%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $serviceCategories ) > 0 )
        {
            foreach ($serviceCategories as $serviceCategory)
            {
            	$response['aaData'][$k] = array(
                    0 => $serviceCategory->id,
                    1 => ucfirst( strtolower( $serviceCategory->category_type ) ),
                    2 => ucfirst( strtolower( $serviceCategory->description ) ),
                    3 => Helper::getStatusText($serviceCategory->status),
                    4 => '<a href="javascript:void(0);" id="'. $serviceCategory->id .'" class="edit_utility_service_category"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to get the details for the selected utility service category
     * @param void
     * @return array
     */
    public function getUtilityServiceCategoryDetails()
    {
    	$serviceCategoryId = Input::get('serviceCategoryId');

    	$response = array();
    	if( $serviceCategoryId != '' )
    	{
    		$serviceCategoryDetails = UtilityServiceCategory::find($serviceCategoryId);

    		if( count( $serviceCategoryDetails ) > 0 )
    		{
    			$response['category_type'] 	= $serviceCategoryDetails->category_type;
    			$response['description'] 	= $serviceCategoryDetails->description;
    			$response['status'] 		= $serviceCategoryDetails->status;
    		}
    	}

    	return response()->json($response);
    }

    /**
     * Function to return the utility service types page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function utilityServiceTypes()
    {
    	// Get the service category list
    	$serviceCategories = UtilityServiceCategory::where(['status' => '1'])->orderBy('category_type', 'asc')->select('id', 'category_type')->get();

    	return view('administrator/utilityServiceTypes', ['serviceCategories' => $serviceCategories]);
    }

    /**
     * Function to save the utility service types
     * @param void
     * @return array
     */
    public function saveUtilityServiceType()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $serviceTypeData);

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server side validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'service_type_category'	=> $serviceTypeData['service_type_category'],
		        'service_type'			=> $serviceTypeData['service_type'],
		        'service_type_status'	=> $serviceTypeData['service_type_status']
		    ),
		    array(
		        'service_type_category'	=> array('required'),
		        'service_type' 			=> array('required'),
		        'service_type_status' 	=> array('required')
		        
		    ),
		    array(
		        'service_type_category.required'=> 'Please select category',
		        'service_type.required'			=> 'Please enter service type',
		        'service_type_status.required'	=> 'Please select status'
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
			if( $serviceTypeData['service_type_id'] == '' ) // Check if service type id is available or not. If not available, add the service type
			{
			 	$serviceType = new UtilityServiceType;

			 	$serviceType->utility_service_category_id = $serviceTypeData['service_type_category'];
			 	$serviceType->service_type = $serviceTypeData['service_type'];
			 	$serviceType->status = $serviceTypeData['service_type_status'];
			 	$serviceType->created_by = $userId;

			 	if( $serviceType->save() )
			 	{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Service type added successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in adding the service type';
				}
			}
			else 											// Check if service type id is available or not. If available, edit the service type
			{
				$serviceType = UtilityServiceType::find($serviceTypeData['service_type_id']);

			 	$serviceType->utility_service_category_id = $serviceTypeData['service_type_category'];
			 	$serviceType->service_type = $serviceTypeData['service_type'];
			 	$serviceType->status = $serviceTypeData['service_type_status'];
			 	$serviceType->created_by = $userId;

			 	if( $serviceType->save() )
			 	{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Service type updated successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in updating the service type';
				}
			}
		}

		return response()->json($response);
    }

    /**
     * Function to show the utility service type list in datatable
     * @param void
     * @return array
     */
    public function fetchUtilityServiceTypes()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
                0 => 't1.id',
                1 => 't2.category_type',
                2 => 't1.service_type',
                3 => 't1.status'
            );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $serviceTypes = DB::select(
                        	DB::raw("SELECT t1.id, t1.service_type, t1.status, t2.category_type FROM utility_service_types t1 JOIN utility_service_categories t2 
	                        	ON t1.utility_service_category_id = t2.id 
	                        	WHERE t1.service_type LIKE '%". $sSearch ."%'
	                        	ORDER BY " . $sortBy . " " . $sortType ." LIMIT ".$start.", ".$length
                        	)
                    	);

        // Get the total count without any condition to maintian the pagination
        $serviceCount = DB::select(
                            DB::raw("SELECT t1.id FROM utility_service_types t1 JOIN utility_service_categories t2 ON t1.utility_service_category_id = t2.id WHERE t1.service_type LIKE '%". $sSearch ."%'"
                        	)
                        );

       	// Assign it to the datatable pagination variable
        $iTotal = count($serviceCount);

        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $serviceTypes ) > 0 )
        {
            foreach ($serviceTypes as $serviceType)
            {
                $response['aaData'][$k] = array(
                    0 => $serviceType->id,
                    1 => ucwords( strtolower( $serviceType->category_type ) ),
                    2 => ucwords( strtolower( $serviceType->service_type ) ),
                    3 => Helper::getStatusText($serviceType->status),
                    4 => '<a href="javascript:void(0);" id="'. $serviceType->id .'" class="edit_service_type"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to get the details for the selected utility service type
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function getUtilityServiceTypeDetails()
    {
    	$serviceTypeId = Input::get('serviceTypeId');

    	$response = array();
    	if( $serviceTypeId != '' )
    	{
    		$serviceTypeDetails = UtilityServiceType::find($serviceTypeId);

    		if( count( $serviceTypeDetails ) > 0 )
    		{
    			$response['utility_service_category_id'] = $serviceTypeDetails->utility_service_category_id;
    			$response['service_type'] = $serviceTypeDetails->service_type;
    			$response['status'] = $serviceTypeDetails->status;
    		}
    	}

    	return response()->json($response);
    }

    /**
     * Function to return the utility service page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function utilityServiceProviders()
    {
    	// Get the service category list
    	$serviceCategories = UtilityServiceCategory::where(['status' => '1'])->orderBy('category_type', 'asc')->select('id', 'category_type')->get();

    	// Get the country list
    	$countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();

    	// Get the province list
    	$provinces = Province::where(['status' => '1'])->select('id', 'name')->orderBy('name', 'asc')->get();

        return view('administrator/utilityServiceProviders', ['serviceCategories' => $serviceCategories, 'countries' => $countries, 'provinces' => $provinces]);
    }

    /**
     * Function to get the service type on the basis of selected service category
     * @param void
     * @return array
     */
    public function getCategoryServiceTypes()
    {
    	$categoryId = Input::get('categoryId');

    	$response = array();
    	if( $categoryId != '' )
    	{
    		$serviceTypes = UtilityServiceCategory::find($categoryId)->serviceTypes;

    		if( count( $serviceTypes ) > 0 )
    		{
	    		foreach($serviceTypes as $serviceType)
	    		{
	    			$response[] = array(
	    				'id' => $serviceType->id,
	    				'service_type' => ucwords( strtolower( $serviceType->service_type ) ),
	    			);
	    		}
    		}
    	}

    	return response()->json($response); 
    }

    /**
     * Function to get the cities on the basis of selected province
     * @param void
     * @return array
     */
    public function getProvinceCities()
    {
    	$provinceId = Input::get('provinceId');

    	// $response = array();
    	$response = '<option value="">Select</option>';
    	if( $provinceId != '' )
    	{
    		$cities = Province::find($provinceId)->cities;

    		if( count( $cities ) > 0 )
    		{
	    		foreach($cities as $city)
	    		{
	    			/*$response[] = array(
	    				'id' 	=> $city->id,
	    				'city' 	=> utf8_encode( ucwords( strtolower( $city->name ) ) )
	    			);*/

	    			$response .= '<option value="'. $city->id .'">'. $city->name .'</option>';
	    		}
    		}
    	}

    	// return response()->json($response); 	// These changes are done to deal with the unicode character encoding issue
    	echo $response;
    }

    /**
     * Function to save the utility service provider details
     * @param void
     * @return array
     */
    public function saveServiceProvider()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $serviceProviderDetails);

        // Get the logged-in user id
		$userId = Auth::id();

        // Server Side Validation
        $response =array();
        $validation = Validator::make(
            array(
                'service_provider_name'		=> $serviceProviderDetails['service_provider_name'],
                'service_provider_category'	=> $serviceProviderDetails['service_provider_category'],
                'service_provider_country'	=> $serviceProviderDetails['service_provider_country'],
                'service_provider_province'	=> $serviceProviderDetails['service_provider_province'],
                'service_provider_city'		=> $serviceProviderDetails['service_provider_city'],
                'service_provider_address'	=> $serviceProviderDetails['service_provider_address'],
                'service_provider_status'	=> $serviceProviderDetails['service_provider_status']
            ),
            array(
                'service_provider_name' 	=> array('required'),
                'service_provider_category' => array('required'),
                'service_provider_country' 	=> array('required'),
                'service_provider_province' => array('required'),
                'service_provider_city' 	=> array('required'),
                'service_provider_address' 	=> array('required'),
                'service_provider_status' 	=> array('required')
                
            ),
            array(
                'service_provider_name.required' 	=> 'Please enter service provider name',
                'service_provider_category.required'=> 'Please select service category',
                'service_provider_country.required' => 'Please select country',
                'service_provider_province.required'=> 'Please select province',
                'service_provider_city.required'	=> 'Please enter city name',
                'service_provider_address.required' => 'Please enter address',
                'service_provider_status.required' 	=> 'Please select status'
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
        	// Check if atleast one option is selected or not from service_types
        	if( isset( $serviceProviderDetails['service_types'] ) )
        	{
        		// Check if the service provider id is available or not.
        		if( $serviceProviderDetails['service_provider_id'] == '' )		// Add the service provider
        		{
	        		$serviceProvider = new UtilityServiceProvider;

	        		$serviceProvider->utility_service_category_id = $serviceProviderDetails['service_provider_category'];
	        		$serviceProvider->company_name 	= $serviceProviderDetails['service_provider_name'];
	        		$serviceProvider->country_id 	= $serviceProviderDetails['service_provider_country'];
	        		$serviceProvider->province_id 	= $serviceProviderDetails['service_provider_province'];
	        		$serviceProvider->city_id 		= $serviceProviderDetails['service_provider_city'];
	        		$serviceProvider->address 		= $serviceProviderDetails['service_provider_address'];
	        		$serviceProvider->status 		= $serviceProviderDetails['service_provider_status'];
	        		$serviceProvider->created_by 	= $userId;

	        		if( $serviceProvider->save() )
				 	{
				 		$serviceProvider->serviceTypes()->sync($serviceProviderDetails['service_types']);

						$response['errCode']    = 0;
			        	$response['errMsg']     = 'Service provider added successfully';
					}
					else
					{
						$response['errCode']    = 2;
			        	$response['errMsg']     = 'Some error in adding the service provider';
					}
        		}
        		else 															// Update the service provider
        		{
        			$serviceProvider = UtilityServiceProvider::find($serviceProviderDetails['service_provider_id']);

	        		$serviceProvider->utility_service_category_id = $serviceProviderDetails['service_provider_category'];
	        		$serviceProvider->company_name 	= $serviceProviderDetails['service_provider_name'];
	        		$serviceProvider->country_id 	= $serviceProviderDetails['service_provider_country'];
	        		$serviceProvider->province_id 	= $serviceProviderDetails['service_provider_province'];
	        		$serviceProvider->city_id 		= $serviceProviderDetails['service_provider_city'];
	        		$serviceProvider->address 		= $serviceProviderDetails['service_provider_address'];
	        		$serviceProvider->status 		= $serviceProviderDetails['service_provider_status'];
	        		$serviceProvider->updated_by 	= $userId;

	        		if( $serviceProvider->save() )
				 	{
				 		$serviceProvider->serviceTypes()->sync($serviceProviderDetails['service_types']);

						$response['errCode']    = 0;
			        	$response['errMsg']     = 'Service provider updated successfully';
					}
					else
					{
						$response['errCode']    = 2;
			        	$response['errMsg']     = 'Some error in updating the service provider';
					}
        		}

        	}
        	else
        	{
        		$response['errCode']    = 2;
                $response['errMsg']     = 'Please select atleast one service type';
        	}
        }

        return response()->json($response);
    }

    /**
     * Function to show the utility service providers list in datatable
     * @param void
     * @return array
     */
    public function fetchServiceProviders()
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
                2 => 't5.category_type',
                7 => 't1.status'
            );

       	// Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $serviceProviders = DB::select(
		                        DB::raw("SELECT t1.id, t1.company_name, t6.name as city, t1.address, t1.status, 
		                        GROUP_CONCAT(UCASE(LEFT(t3.service_type, 1)), SUBSTRING(t3.service_type, 2) order by t3.service_type) as services,
		                        t4.name AS province, t5.category_type
		                        FROM utility_service_providers AS t1 
								JOIN utility_service_provider_utility_service_type as t2 ON t1.id = t2.utility_service_provider_id 
								JOIN utility_service_types AS t3 ON t3.id = t2.utility_service_type_id
								JOIN provinces AS t4 ON t4.id = t1.province_id
								JOIN utility_service_categories AS t5 ON t5.id = t1.utility_service_category_id
								JOIN cities AS t6 ON t6.id = t1.city_id
								WHERE t1.company_name LIKE '%". $sSearch ."%'
								GROUP BY t1.id, t1.company_name, t6.name, t1.address, t1.status, t4.name, t5.category_type
								ORDER BY " . $sortBy . " " . $sortType ." LIMIT ".$start.", ".$length)
		                    );

        // Get the total count without any condition to maintian the pagination
        $serviceProviderCount = DB::select(
	                            	DB::raw("SELECT t1.id
				                        FROM utility_service_providers AS t1 
										JOIN utility_service_provider_utility_service_type as t2 ON t1.id = t2.utility_service_provider_id 
										JOIN utility_service_types AS t3 ON t3.id = t2.utility_service_type_id
										JOIN provinces AS t4 ON t4.id = t1.province_id
										JOIN utility_service_categories AS t5 ON t5.id = t1.utility_service_category_id
										JOIN cities AS t6 ON t6.id = t1.city_id
										WHERE t1.company_name LIKE '%". $sSearch ."%'
										GROUP BY t1.id, t1.company_name, t6.name, t1.address, t1.status, t4.name, t5.category_type")
	                        	);

        // Assign it to the datatable pagination variable
        $iTotal = count($serviceProviderCount);

        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $serviceProviders ) > 0 )
        {
            foreach ($serviceProviders as $serviceProvider)
            {
                $response['aaData'][$k] = array(
                    0 => $serviceProvider->id,
                    1 => ucwords( strtolower( $serviceProvider->company_name ) ),
                    2 => $serviceProvider->category_type,
                    3 => $serviceProvider->services,
                    4 => ucwords( strtolower( $serviceProvider->province ) ),
                    5 => ucfirst( strtolower( $serviceProvider->city ) ),
                    6 => ucfirst( strtolower( $serviceProvider->address ) ),
                    7 => Helper::getStatusText( $serviceProvider->status ),
                    8 => '<a href="javascript:void(0);" id="'. $serviceProvider->id .'" class="edit_service_provider"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to get the details of the selected service provider
     * @param void
     * @return array
     */
    public function getServiceProviderDetails()
    {
    	$serviceProviderId = Input::get('serviceProviderId');

    	$response = array();
    	if( $serviceProviderId != '' )
    	{
    		$serviceProviderDetails = UtilityServiceProvider::find($serviceProviderId);

    		$serviceProviderTypes 	= $serviceProviderDetails->serviceTypes;

    		if( count( $serviceProviderDetails ) > 0 )
    		{
    			$response['category_id'] 	= $serviceProviderDetails->utility_service_category_id;
    			$response['company_name'] 	= $serviceProviderDetails->company_name;
    			$response['country_id'] 	= $serviceProviderDetails->country_id;
    			$response['province_id'] 	= $serviceProviderDetails->province_id;
    			$response['city_id'] 		= $serviceProviderDetails->city_id;
    			$response['address'] 		= $serviceProviderDetails->address;
    			$response['status'] 		= $serviceProviderDetails->status;
    		}

    		if( count( $serviceProviderTypes ) > 0 )
    		{
    			foreach ($serviceProviderTypes as $serviceProviderType)
    			{
    				$response['selectedServiceTypes'][] = $serviceProviderType->id;
    			}
    		}

    		// Get the service type list, as the service type list comes on the service category selection by using ajax, so we are not able to make the service type list selected
    		$serviceTypes = UtilityServiceCategory::find($serviceProviderDetails->utility_service_category_id)->serviceTypes;

    		if( count( $serviceTypes ) > 0 )
    		{
	    		foreach($serviceTypes as $serviceType)
	    		{
	    			$response['serviceTypes'][] = array(
	    				'id' => $serviceType->id,
	    				'service_type' => ucwords( strtolower( $serviceType->service_type ) ),
	    			);
	    		}
    		}

    		// Get the cities list, as the cities list comes on the province selection by using ajax, so we are not able to make the cities list selected
    		$cities = Province::find($serviceProviderDetails->province_id)->cities;

    		if( count( $cities ) > 0 )
    		{
	    		foreach($cities as $city)
	    		{
	    			$response['cities'][] = array(
	    				'id' 	=> $city->id,
	    				'city' 	=> ucwords( strtolower( $city->name ) )
	    			);
	    		}
    		}
    	}

    	return response()->json($response);
    }

    /**
     * Function to return the payment plans view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function paymentPlans()
    {
    	// Get the payment plan type list
    	$paymentPlanTypes = PaymentPlanType::where(['status' => '1'])->select('id', 'plan_type')->orderBy('plan_type', 'asc')->get();

    	return view('administrator/paymentPlans', ['paymentPlanTypes' => $paymentPlanTypes]);
    }

    /**
     * Function to save payment plan details 
     * @param void
     * @return array
     */
    public function savePaymentPlan()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $planDetails);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'payment_plan_name'		=> $planDetails['payment_plan_name'],
		        'payment_plan_charge'	=> $planDetails['payment_plan_charge'],
		        'payment_plan_validity'	=> $planDetails['payment_plan_validity'],
		        'payment_plan_emails'	=> $planDetails['payment_plan_emails'],
		        'payment_plan_discount'	=> $planDetails['payment_plan_discount'],
		        'payment_plan_type'		=> $planDetails['payment_plan_type'],
		        'payment_plan_status'	=> $planDetails['payment_plan_status']
		    ),
		    array(
		        'payment_plan_name' 	=> array('required'),
		        'payment_plan_charge' 	=> array('required', 'numeric'),
		        'payment_plan_validity' => array('required', 'integer'),
		        'payment_plan_emails' 	=> array('required', 'integer'),
		        'payment_plan_discount' => array('numeric'),
		        'payment_plan_type' 	=> array('required'),
		        'payment_plan_status' 	=> array('required')
		    ),
		    array(
		        'payment_plan_name.required' 	=> 'Please enter plan name',
		        'payment_plan_charge.required' 	=> 'Please enter charge',
		        'payment_plan_charge.numeric' 	=> 'Please enter valid charge',
		        'payment_plan_validity.required'=> 'Please enter validity',
		        'payment_plan_validity.integer' => 'Please enter a valid value',
		        'payment_plan_emails.required' 	=> 'Please enter number of emails',
		        'payment_plan_emails.integer' 	=> 'Please enter a valid value',
		        'payment_plan_discount.required'=> 'Please enter valid discount value',
		        'payment_plan_type.required' 	=> 'Please select plan type',
		        'payment_plan_status.required' 	=> 'Please select status'
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
			// Check if the payment plan id is available or not, If not, add it, otherwise update it
			if( $planDetails['payment_plan_id'] == '' )
			{
				$paymentPlan = new PaymentPlan;

				$paymentPlan->plan_name 		= $planDetails['payment_plan_name'];
				$paymentPlan->plan_charges 		= $planDetails['payment_plan_charge'];
				$paymentPlan->validity_days 	= $planDetails['payment_plan_validity'];
				$paymentPlan->allowed_count 	= $planDetails['payment_plan_emails'];
				$paymentPlan->plan_type_id 		= $planDetails['payment_plan_type'];
				$paymentPlan->discount 			= $planDetails['payment_plan_discount'];
				$paymentPlan->status 			= $planDetails['payment_plan_status'];
				$paymentPlan->created_by 		= $userId;

				if( $paymentPlan->save() )
		        {
		        	$response['errCode']    = 0;
		        	$response['errMsg']     = 'Payment plan added successfully';
		        }
		        else
		        {
		        	$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in saving payment plan';
		        }
			}
			else
			{
				$paymentPlan = PaymentPlan::find($planDetails['payment_plan_id']);

				$paymentPlan->plan_name 		= $planDetails['payment_plan_name'];
				$paymentPlan->plan_charges 		= $planDetails['payment_plan_charge'];
				$paymentPlan->validity_days 	= $planDetails['payment_plan_validity'];
				$paymentPlan->allowed_count 	= $planDetails['payment_plan_emails'];
				$paymentPlan->plan_type_id 		= $planDetails['payment_plan_type'];
				$paymentPlan->discount 			= $planDetails['payment_plan_discount'];
				$paymentPlan->status 			= $planDetails['payment_plan_status'];
				$paymentPlan->updated_by 		= $userId;

				if( $paymentPlan->save() )
		        {
		        	$response['errCode']    = 0;
		        	$response['errMsg']     = 'Payment plan updated successfully';
		        }
		        else
		        {
		        	$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in updating payment plan';
		        }
			}
		}

		return response()->json($response);
    }

    /**
     * Function to show the payment plans list in datatable
     * @param void
     * @return array
     */
    public function fetchPaymentPlans()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'plan_name',
            2 => 'plan_charges',
            3 => 'discount',
            4 => 'validity_days',
            5 => 'allowed_count',
            7 => 'status'
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $paymentPlans = PaymentPlan::where('plan_name','like', '%'.$sSearch.'%')
                    ->orderBy($sortBy, $sortType)
                    ->limit($length)
                    ->offset($start)
                    ->select('id', 'plan_type_id', 'plan_name', 'plan_charges', 'discount', 'validity_days', 'allowed_count', 'status')
                    ->get();

        $iTotal = PaymentPlan::where('plan_name','like', '%'.$sSearch.'%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $paymentPlans ) > 0 )
        {
            foreach ($paymentPlans as $paymentPlan)
            {
            	$response['aaData'][$k] = array(
                    0 => $paymentPlan->id,
                    1 => ucwords( strtolower( $paymentPlan->plan_name ) ),
                    2 => $paymentPlan->plan_charges,
                    3 => ( $paymentPlan->discount != '' ) ? $paymentPlan->discount: 'NA',
                    4 => $paymentPlan->validity_days,
                    5 => $paymentPlan->allowed_count,
                    6 => ucwords( strtolower( PaymentPlan::find($paymentPlan->plan_type_id)->paymentPlanType->plan_type ) ),
                    7 => Helper::getStatusText($paymentPlan->status),
                    8 => '<a href="javascript:void(0);" id="'. $paymentPlan->id .'" class="edit_payment_plan"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to return the cities listing view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function cities()
    {
    	// Get the province list
    	$provinces = Province::where(['status' => '1'])->select('id', 'name')->orderBy('name', 'asc')->get();

    	return view('administrator/cities', ['provinces' => $provinces]);
    }

    /**
     * Function to get the details of the selected payment plan
     * @param void
     * @return array
     */
    public function getPaymentPlanDetails()
    {
    	$planId = Input::get('planId');

    	$response = array();
    	if( $planId != '' )
    	{
    		$planDetails = PaymentPlan::find($planId);

    		if( count( $planDetails ) > 0 )
    		{
	    		$response['id'] 			= $planDetails->id;
	    		$response['plan_type_id'] 	= $planDetails->plan_type_id;
    			$response['plan_name'] 		= $planDetails->plan_name;
    			$response['plan_charge'] 	= $planDetails->plan_charges;
	    		$response['discount'] 		= $planDetails->discount;
    			$response['validity_days'] 	= $planDetails->validity_days;
    			$response['no_of_emails'] 	= $planDetails->number_of_emails;
    			$response['status'] 		= $planDetails->status;
    		}
    	}

    	return response()->json($response); 
    }

    /**
     * Function to save the city details
     * @param void
     * @return array
     */
    public function saveCity()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $cityDetails);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'province'		=> $cityDetails['province'],
		        'city_name'		=> $cityDetails['city_name'],
		        'city_status'	=> $cityDetails['city_status']
		    ),
		    array(
		        'province' 		=> array('required'),
		        'city_name' 	=> array('required'),
		        'city_status' 	=> array('required')
		    ),
		    array(
		        'province.required' 	=> 'Please select province',
		        'city_name.required' 	=> 'Please enter city name',
		        'city_status.required' 	=> 'Please select status'
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
			// Check if city id is available or not. If available, update the data, if not add the data
			if( $cityDetails['city_id'] == '' )		// Add the city
			{
				$city = new City;

				$city->province_id 	= $cityDetails['province'];
				$city->name 		= $cityDetails['city_name'];
				$city->status 		= $cityDetails['city_status'];
				$city->created_by 	= $userId;

				if( $city->save() )
		        {
		        	$response['errCode']    = 0;
		        	$response['errMsg']     = 'City added successfully';
		        }
		        else
		        {
		        	$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in saving city';
		        }
			}
			else 									// Update the city
			{
				$city = City::find($cityDetails['city_id']);

				$city->province_id 	= $cityDetails['province'];
				$city->name 		= $cityDetails['city_name'];
				$city->status 		= $cityDetails['city_status'];
				$city->updated_by 	= $userId;

				if( $city->save() )
		        {
		        	$response['errCode']    = 0;
		        	$response['errMsg']     = 'City updated successfully';
		        }
		        else
		        {
		        	$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in updating city';
		        }
			}
		}

		return response()->json($response); 
    }

    /**
     * Function to show the cities list in datatable
     * @param void
     * @return array
     */
    public function fetchCities()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            2 => 'name',
            3 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $cities = City::where('name','like', '%'.$sSearch.'%')
                    ->orderBy($sortBy, $sortType)
                    ->limit($length)
                    ->offset($start)
                    ->get();

        $iTotal = City::where('name','like', '%'.$sSearch.'%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $cities ) > 0 )
        {
            foreach ($cities as $city)
            {
            	$response['aaData'][$k] = array(
                    0 => $city->id,
                    1 => ucwords( strtolower( $city->province->name ) ),
                    2 => ucwords( strtolower( $city->name ) ),
                    3 => Helper::getStatusText( $city->status ),
                    4 => '<a href="javascript:void(0);" id="'. $city->id .'" class="edit_city"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to get the details of the selected city
     * @param void
     * @return array
     */
    public function getCityDetails()
    {
    	$pageId = Input::get('pageId');

    	$response = array();
    	if( $pageId != '' )
    	{
    		$cityDetails = City::find($pageId);

    		if( count( $cityDetails ) > 0 )
    		{
	    		$response['id']			= $cityDetails->id;
	    		$response['province_id']= $cityDetails->province_id;
	    		$response['name']		= $cityDetails->name;
	    		$response['status']		= $cityDetails->status;
    		}
    	}

    	return response()->json($response); 
    }

    /**
     * Function to return email template listing view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function emailTemplates()
    {
        $templateCategories = EmailTemplateCategory::get();
        return view('administrator/emailTemplates', ['templateCategories' => $templateCategories]);
    }

    /**
     * Function to save the email template details
     * @param void
     * @return array
     */
    public function saveEmailTemplate()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $templateData);

        // Get the logged in user id
        $userId = Auth::user()->id;

        $response =array();

        // Server side validation
        $validation = Validator::make(
		    array(
		    	'email_template_name' 	=> $templateData['email_template_name'],
		    	'email_template_content'=> $templateData['email_template_content'],
		    	'email_template_status' => $templateData['email_template_status']
		    ),
		    array(
		    	'email_template_name'	=> array('required'),
		    	'email_template_content'=> array('required'),
		    	'email_template_status'	=> array('required')
		    ),
		    array(
		    	'email_template_name.required'		=> 'Please enter template name',
		        'email_template_content.required'	=> 'Please enter some content',
		        'email_template_status.required'	=> 'Please select status'
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
			// Check if email template id is present. If yes, update the content, otherwise add the content
			if( $templateData['email_template_id'] == '' )	// Add the content
			{
				// Check if the same email template already exist
				$templateExist = EmailTemplate::where(['template_name' => $templateData['email_template_name']])->first();

				if( count( $templateExist ) == 0 )
				{
					$emailTemplate = new EmailTemplate;

                    $emailTemplate->category_id     = $templateData['template_category'];
					$emailTemplate->template_name 	= $templateData['email_template_name'];
					$emailTemplate->template_content= $templateData['email_template_content'];				
					$emailTemplate->status 			= $templateData['email_template_status'];
					$emailTemplate->created_by 		= $userId;

					if( $emailTemplate->save() )
					{
						$response['errCode']    = 0;
			        	$response['errMsg']     = 'Email template added successfully';
					}
					else
					{
						$response['errCode']    = 2;
			        	$response['errMsg']     = 'Some error in saving email template';
					}
				}
				else
				{
					$response['errCode']    = 3;
			        $response['errMsg']     = 'Email template already exist with the same name';
				}
			}
			else 											// Update the content
			{
				$emailTemplate = EmailTemplate::find($templateData['email_template_id']);

                $emailTemplate->category_id     = $templateData['template_category'];
				$emailTemplate->template_name 	= $templateData['email_template_name'];
				$emailTemplate->template_content= $templateData['email_template_content'];				
				$emailTemplate->status 			= $templateData['email_template_status'];
				$emailTemplate->updated_by 		= $userId;

				if( $emailTemplate->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Email template updated successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in updating email template';
				}
			}
		}

		return response()->json($response);
    }

    /**
     * Function to show the email template list in datatable
     * @param void
     * @return array
     */
    public function fetchEmailTemplates()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'template_name',
            3 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $emailTemplates = EmailTemplate::where('template_name','like', '%'.$sSearch.'%')
	                    ->orderBy($sortBy, $sortType)
	                    ->limit($length)
	                    ->offset($start)
	                    ->select('id', 'template_name', 'template_content', 'status')
	                    ->get();

        $iTotal = EmailTemplate::where('template_name','like', '%'.$sSearch.'%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $emailTemplates ) > 0 )
        {
            foreach ($emailTemplates as $emailTemplates)
            {
            	$response['aaData'][$k] = array(
                    0 => $emailTemplates->id,
                    1 => ucfirst( strtolower( $emailTemplates->template_name ) ),
                    2 => '<div><a href="javascript:void(0);" class="datatable_template_check_preview">Check Preview</a><div class="datatable_template_preview" style="display:none;">'. $emailTemplates->template_content .'</div></div>',
                    3 => Helper::getStatusText($emailTemplates->status),
                    4 => '<a href="javascript:void(0);" id="'. $emailTemplates->id .'" class="edit_email_template"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to get the details of selected email template
     * @param void
     * @return array
     */
    public function getEmailTemplateDetails()
    {
    	$templateId = Input::get('templateId');

    	$response = array();
    	if( $templateId != '' )
    	{
    		$templateDetails = EmailTemplate::find($templateId);

    		if( count( $templateDetails ) > 0 )
    		{
	    		$response['id']					= $templateDetails->id;
                $response['category_id']        = $templateDetails->category_id;
	    		$response['template_name']		= $templateDetails->template_name;
	    		$response['template_content']	= $templateDetails->template_content;
	    		$response['status']				= $templateDetails->status;
    		}
    	}

    	return response()->json($response);
    }

    /**
     * Function to return the generate invoice page
     * @param void
     * @return array
     */
    public function generateInvoice()
    {
    	return view('administrator/generateInvoice');
    }

    /**
     * Function to convert html to dompdf
     * @param void
     * @return array
     */
    public function htmltopdfview(Request $request)
    {
    	if($request->has('download')){

    		// Pass the data to the view
            $pdf = PDF::loadView('htmltopdfview', ['userInput' => Input::get()]);
            
            // To download the file in browser
            return $pdf->download('htmltopdfview');
            
            // To save the pdf into a directory
           // $pdf->save(base_path().'/storage/pdf/invoice_'. time() .'.pdf','F');
        }

        // return view('htmltopdfview');

       	return redirect('/administrator/generateinvoice');
    }
}