<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Barcode;
use DNS2D;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

class BarcodeController extends Controller
{	
	// check if the bar code is exist in databse
    public function checkBarcode(Request $request)
    { 	
        $userBarcode = Barcode::select()
                            ->where('text', $request->input('text'))
                            // ->where('user_id', $request->input('userid'))
                            ->get();
// return $userBarcode;
        if ($userBarcode->isEmpty()) 
        {
        	return "barcode not exist";
        }
        else
        {
			return "barcode exist";
        }
    }

    // testFunction for fake API
    public function genrateBarcode(Request $request)
    // public function genrateBarcode()
    {
        
        // genrate randome type & str
        $randstr = $this->ranodmStrGen(5);
        // $updateUser = User::find($request->input('userid'));

        // create new barcode obj
        $newBarcode = new Barcode();
            $newBarcode->user_id = $request->input('newUserId');
            $newBarcode->text = $randstr;
            $newBarcode->format = 'CODE_39';
            $newBarcode->save();
            return $newBarcode;
            return "the barcode changed corectly for the user";        
        
    }

    // 
    private function ranodmStrGen($len){
        $result = "";
        $chars = "ABC0123456789";
        $charArray = str_split($chars);

        for($i = 0; $i < $len; $i++){
            $randItem = array_rand($charArray);
            $result .= "".$charArray[$randItem];
        }
         // $result .= "*";
        return $result;
        }

    // 
    // private function randomTypeGen(){
    //    $barcodeType = array(
    //         'CODE128B',
    //         'CODE128C',
    //         // 'EAN',
    //         // 'UPC',
    //         'CODE39',
    //         // 'ITF14',
    //     );

    //     $randomeIndex = array_rand($barcodeType);
    //     return $barcodeType[$randomeIndex];
    // }    

}    
