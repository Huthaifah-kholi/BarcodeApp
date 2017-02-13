<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Barcode;
use App\User;
use Illuminate\Database\Eloquent\Collection;
class UsersController extends Controller
{
	// return specific data for normal users (id, name , barcode) to show it for admin 
     public function getUsers(Request $request){
		$r = User::with('Barcodes')
					->select('users.id','users.name')
					->where('users.role','user')
					->get();
		return $r;
     }
}