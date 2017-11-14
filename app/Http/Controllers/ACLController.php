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
    	/*$admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'User Administrator'; // optional
        $admin->description  = 'User is allowed to manage and edit other users'; // optional
        $admin->save();*/

        /*$user = new Role();
        $user->name         = 'agent';
        $user->display_name = 'agent'; // optional
        $user->description  = 'Agent associated with a company'; // optional
        $user->save();*/
	}

    /**
     * Function to assign permission
     */
    public function assignPerm()
    {
        $user = User::where('email', '=', 'admin@email.com')->first();

        // role attach alias
        $user->attachRole(1);
    }

    /**
     * Function to check permission
     */
    public function checkPerm()
    {
        $user = User::where('email', '=', 'admin@email.com')->first();

        if( $user->hasRole('admin') )
        {
            echo "User role is admin";
        }
        else
        {
            echo "User Role not defined";
        }
    }
}
