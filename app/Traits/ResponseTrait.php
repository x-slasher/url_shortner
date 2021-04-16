<?php
namespace App\Traits;

trait ResponseTrait
{
    public function withSuccess($message)
    {
        return response()->json(['status' => 200, 'message' => $message],200);
    }

    public function withError($message, $code) {
        return response()->json(['status' => $code, 'message' => $message],$code);
    }

    public function withData($message, $data) {
        return response()->json(['status' => 200, 'message' => $message, 'data' => $data],200);
    }
}
