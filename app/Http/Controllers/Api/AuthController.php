<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private $apiToken;
    public function __construct(){
        // API Token
        $this->apiToken = Str::random(60);
    }
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        // Validations
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);
        if ($validator->fails()) {
            // Validation failed
            return response()->json(['error' => $validator->errors()], 401);
        } else {
            // Fetch User
            $user = User::where('email',$request->email)->first();
            if($user) {
                // Verify the password
                if( password_verify($request->password, $user->password) ) {
                    return response()->json([
                        'message'      => 'success',
                        'name'         => $user->name,
                        'email'        => $user->email,
                        'api_token'    => $user->apiToken,
                    ]);
                } else {
                    return response()->json(['error' => 'Invalid Password']);
                }
            } else {
                return response()->json(['error' => 'Invalid Email']);
            }
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['api_token'] = $this->apiToken;
        $input['role'] = 2; // 2 = user
        $user = User::create($input);
        if($user) {
            return response()->json([
                'message' => 'success',
                'api_token' => $user->api_token,
                'name' => $user->name,     
            ]);
        }else{
            return response()->json([
                'error' => 'Registration failed, please try again.',
            ]);
        }
    }
}
