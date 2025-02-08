<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

	

class AuthenticationUser extends BaseController
{
    public function login(Request $request)
    {
        $apiKey = $request->header('X-API-KEY');
        if ($apiKey !== env('THIRD_PARTY_API_KEY')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

         // Verify HMAC Signature
        $secretKey = env('THIRD_PARTY_SECRET_KEY');
        $payload = json_encode($request->except('signature'));
        $expectedSignature = hash_hmac('sha256', $payload, $secretKey);

        if ($request->header('X-SIGNATURE') !== $expectedSignature) {
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Validation Error.', 'errors' => $validator->errors()], 422);
        }


        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;

           return response()->json(['success' => $success, 'message' => 'User login successfully.']);
        }
        else{
            return response()->json(['error' => 'Unauthorised.', 'message' => 'Unauthorised']);
        }
    }
}