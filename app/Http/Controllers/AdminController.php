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

use Validator;
use Helper;

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
     * Function for admin login
     * @param void
     * @return \Illuminate\Http\Response
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
			
			$user = User::where('email', '=', $loginData['username'])->first();

			if( count($user)  > 0 )
			{
		        if( $user->hasRole(['admin', 'agent']) )	// list of allowed users
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
                    3 => ( $category->status ) ? 'Active' : 'Inactive',
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
		   				$categoryNavigation = array();
		   				// Iterate over the categories and save the mapping
		   				foreach ($inputData['navigation_categories'] as $key => $value)
				   		{
				   			$categoryNavigation[] = array(
				   				'category_id' 	=> $value,
				   				'navigation_id' => $navigation->id,
				   				'status' 		=> $inputData['navigation_status']
				   			);
				   		}

				   		if( count( $categoryNavigation ) > 0 )
				   		{
					   		if( DB::table('category_navigation')->insert($categoryNavigation) )
				   			{
				   				DB::commit();

				   				$response['errCode']    = 0;
					        	$response['errMsg']     = 'Navigation added successfully';
				   			}
				   		}
				   		else
				   		{
				   			DB::rollBack();

			   				$response['errCode']    = 5;
				        	$response['errMsg']     = 'Some error in saving the navigation';
				   		}
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
                    4 => ( $navigation->status ) ? 'Active' : 'Inactive',
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

				if( $navigation->update() )
				{
					// Update the navigation categories mapping also

					// DB::commit();

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
}