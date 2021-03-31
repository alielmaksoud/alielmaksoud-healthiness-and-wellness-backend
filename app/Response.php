<?php
namespace App;

class Response
{
    public static function success($data, $message)
    {
        if ($data!=null) {
            $response=['success'=>true,'data'=>$data,'message'=>$message];
        } else {
            $response=['success'=>true];
        }
        return response()->json($response);
    }
    public static function error($code, $message, $reason=null)
    {
        $error=['code'=>$code,"message"=>$message,'reason'=>$reason];
        $response=['success'=>false,'error'=>$error];
        return response()->json($response, $code);
    }
    public static function successWithPaging($data)
    {
        if ($data !=null) {
            $reesponse['success']=true;
            if (is_array($data)) {
                $response = array_merge($response, $data);
            } else {
                $response = array_merge($response, $data->toArray);
            }
        } else {
            $response=["success"=>true];
        }
        return response()->json($response);
    }
}