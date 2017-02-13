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
        $code_type="";
        // check the barcode type?  // by using the length of text
        $barcode_legth = strlen($request->input('text'));
        switch ($barcode_legth) {
            case 4:
                $code_type = 'clothes';
                break;
            case 5:
                $code_type = 'shoes';
                break;
            case 6:
                $code_type = 'vegetable';
                break;
            case 7:
                $code_type = 'chips';
                break;
        }

        $userBarcode = Barcode::select('text','code_type')
                            ->where('text', $request->input('text'))
                            ->where('code_type', $code_type)
                            ->get();

        if ($userBarcode->isEmpty()) 
        {
        	return "barcode not exist";
        }
        else
        {
			return $userBarcode;
        }
    }

    // testFunction for fake API
    public function genrateBarcode(Request $request)
    // public function genrateBarcode()
    {
        
        // genrate randome type & str
        $randType = $this->randomTypeGen();
        $barcodeText = $this->ranodmBarcodeGen($randType);

        // create new barcode obj
        $newBarcode = new Barcode();
            $newBarcode->user_id = $request->input('newId');
            $newBarcode->text = $barcodeText; /////////////////////////////////////
            $newBarcode->format = 'CODE_39';
            $newBarcode->code_type= $randType;
            $newBarcode->save();
            return $newBarcode;
            return "the barcode changed corectly for the user";        
    }

    // 
    private function ranodmBarcodeGen($barcodeType){
        // ***** this befor ***/
        // $result = "";
        // $chars = "ABC0123456789";
        // $charArray = str_split($chars);

        // for($i = 0; $i < $len; $i++){
        //     $randItem = array_rand($charArray);
        //     $result .= "".$charArray[$randItem];
        // }
        //  // $result .= "*";
        // return $result;

        $result = "";
        $chars = "ABCDEFGHIJKLMNOPQRSTUVXWYZ123456789abcdefghigklmnopqrstuvwxyz";
        $charArray = str_split($chars);

        if ($barcodeType === 'clothes') 
        {
            for($i = 0; $i < 4; $i++){
                $randItem = array_rand($charArray);
                $result .= "".$charArray[$randItem];
            }
        }
        elseif ($barcodeType === 'shoes') {
            for($i = 0; $i < 5; $i++){
                $randItem = array_rand($charArray);
                $result .= "".$charArray[$randItem];
            }
        }
        elseif ($barcodeType === 'vegetable') {
            for($i = 0; $i < 6; $i++){
                $randItem = array_rand($charArray);
                $result .= "".$charArray[$randItem];
            }            
        }
        elseif ($barcodeType === 'chips') {
                for($i = 0; $i < 7; $i++){
                        $randItem = array_rand($charArray);
                        $result .= "".$charArray[$randItem];
                }           
        }
        return $result;
        }

    
    private function randomTypeGen(){
       $barcodeType = array(
            'clothes',
            'shoes',
            'vegetable',
            'chips'
        );

        $randomeIndex = array_rand($barcodeType);
        return $barcodeType[$randomeIndex];
    }    

    // private function FunctionName($value='')
    // {
    //     # code...
    // }

}    
