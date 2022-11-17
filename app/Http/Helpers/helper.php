<?php
namespace App\Http\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;

class Helper{
    public static function sendError($message,$error = [],$code =401){
        $response = ['success' => false,'message' => $message];
        if(!empty($error)){
            $response['data'] = $error;
        }

        throw new HttpResponseException(response()->json([$response,$code]));

        /* return response()->json([$response,$code]); */

    }
    public static function sendSuccess($message,$data = [],$code = 200){
        $response = ['status' => $code ,'success' => true, 'message' => $message];
        if(!empty($data)){
            $response['data'] = $data;
            
        }
        return response()->json($response);


    }
    public static function takaSign(){
      
        return '৳';


    }

    public function profileImageUrl($url)
    {
        return '/image/profile/'.$url;
    }
}
