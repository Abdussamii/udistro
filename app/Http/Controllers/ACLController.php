<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// For query builder
use Illuminate\Support\Facades\DB;

// For Eloquent ORM
use App\User;
use App\Role;
use App\Permission;

class ACLController extends Controller
{
	/**
	 * Function to add role
	 */
	public function addRole()
	{
		// $admin = new Role();
		// $admin->name         = 'admin';
		// $admin->display_name = 'User Administrator'; // optional
		// $admin->description  = 'User is allowed to manage and edit other users'; // optional
		// $admin->save();

		// $user = new Role();
		// $user->name         = 'agent';
		// $user->display_name = 'agent'; // optional
		// $user->description  = 'Agent associated with a company'; // optional
		// $user->save();
	}

    /**
     * Function to assign role
     */
    public function assignRole()
    {
        $user = User::where('email', '=', 'admin@udistro.com')->first();

        // role attach alias
        $user->attachRole(1);
    }

    /**
	 * Function to add role
	 */
	public function addPermission()
	{
		/*$createPost = new Permission();
		$createPost->name         = 'create-post';
		$createPost->display_name = 'Create Posts'; // optional
		$createPost->description  = 'create new blog posts'; // optional
		$createPost->save();*/

		$editUser = new Permission();
		$editUser->name         = 'edit-user';
		$editUser->display_name = 'Edit Users'; // optional
		$editUser->description  = 'edit existing users'; // optional
		$editUser->save();
	}

	/**
	 * Function to attach permission to role
	 */
	public function assignRolePermission()
	{
		// Find the role
		$role = Role::first();

		// Find the permission
		$permission = Permission::first();

		// Attach permission to role
		$role->attachPermission($permission); // parameter can be a Permission object, array or id
	}

	/**
	 * Function to attach permission to user
	 */
	public function assignUserPermission()
	{
		// Find the role
        $user = User::where('email', '=', 'admin@udistro.com')->first();

		// Find the permission
		$permission = Permission::find(2);

		// Attach permission to role
		$user->attachPermission($permission); // parameter can be a Permission object, array or id
	}

	/**
     * Function to check role
     */
    public function checkRole()
    {
        $user = User::where('email', '=', 'admin@udistro.com')->first();

        if( $user->hasRole('admin') )
        {
            echo "User role is admin";
        }
        else
        {
            echo "User Role not defined";
        }
    }

    /**
     * Function to check role
     */
    public function checkRolePermission()
    {
    	$user = User::where('email', '=', 'mayank1234@gmail.com')->first();
    	// $user = User::where('email', '=', 'admin@udistro.com')->first();

    	if( $user->can('create-post') )
    	{
    		echo 'User can create post';
    	}
    	else
    	{
    		echo 'User dont have the permission to create post';
    	}
    }

    /**
     * Function to check role
     */
    public function checkUserPermission()
    {
    	// $user = User::where('email', '=', 'mayank1234@gmail.com')->first();
    	// $user = User::where('email', '=', 'admin@udistro.com')->first();

    	if( $user->can('edit-user') )
    	{
    		echo 'User can edit user';
    	}
    	else
    	{
    		echo 'User dont have the permission to edit user';
    	}
    }
}
