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
     * Function to save the province details
     * @param void
     * @return Array
     */
    public function saveProvince()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $provinceData);

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server side validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'province_name'		=> $provinceData['province_name'],
		        'province_status'	=> $provinceData['province_status']
		    ),
		    array(
		        'province_name' 	=> array('required'),
		        'province_status' 	=> array('required')
		    ),
		    array(
		        'province_name.required'	=> 'Please enter the province name',
		        'province_status.required' 	=> 'Please select status',
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
			if( $provinceData['province_id'] == '' )	// Check if the province id is available or not, if not add the province
			{
				$province = new Province;

				$province->name 		= $provinceData['province_name'];
				$province->status 		= $provinceData['province_status'];
				$province->updated_by 	= $userId;

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
				$province = Province::find($provinceData['province_id']);

				$province->name 		= $provinceData['province_name'];
				$province->status 		= $provinceData['province_status'];
				$province->created_by 	= $userId;

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

				$serviceCategory->service_type 	= $serviceCategoryData['service_type'];
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

				$serviceCategory->service_type 	= $serviceCategoryData['service_type'];
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
            1 => 'service_type',
            3 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $serviceCategories = UtilityServiceCategory::where('service_type','like', '%'.$sSearch.'%')
		                    ->orderBy($sortBy, $sortType)
		                    ->limit($length)
		                    ->offset($start)
		                    ->select('id', 'service_type', 'description', 'status')
		                    ->get();

        $iTotal = UtilityServiceCategory::where('service_type','like', '%'.$sSearch.'%')->count();

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
                    1 => ucfirst( strtolower( $serviceCategory->service_type ) ),
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
    			$response['service_type'] 	= $serviceCategoryDetails->service_type;
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

    	$response = array();
    	if( $provinceId != '' )
    	{
    		$cities = Province::find($provinceId)->cities;

    		if( count( $cities ) > 0 )
    		{
	    		foreach($cities as $city)
	    		{
	    			$response[] = array(
	    				'id' 	=> $city->id,
	    				'city' 	=> ucwords( strtolower( $city->name ) )
	    			);
	    		}
    		}
    	}

    	return response()->json($response); 
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
}