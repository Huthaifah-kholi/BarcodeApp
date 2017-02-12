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
     	$users = User::select('users.name','barcodes.user_id','barcodes.id','barcodes.text','barcodes.format')
					    ->where('users.role','user')
					    ->join('barcodes', 'users.id', '=', 'barcodes.user_id')
					    // ->groupBy('barcodes.user_id')
					    // ->toArray()
					    ->get;

        return $users;
     }
}
