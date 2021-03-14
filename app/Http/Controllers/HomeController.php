<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\HomeCollection;
use App\Models\User;
use DB;
use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class HomeController extends Controller
{
    public function index()
    {
       return new HomeCollection(User::all());
    }
    public function delete($id)
    {
      $user = User::find($id);

      $user->delete();

      return response()->json('successfully deleted');
    }
    public function store(Request $request)
    {
      $user = new User([
        'username' => $request->username,
        'password' => bcrypt($request->password),
        'type'     => $request->type,
      ]);

      $user->save();

      return response()->json('successfully added');
    }
    public function login(Request $request){
      $arr = $request->only('username', 'password');
      // return response()->json(!$token = JWTAuth::attempt($arr));

      try {
        if (!$token = JWTAuth::attempt($arr)) {
            return response()->json([
                'status' => false,
                'msg' => 'Invalid Username or Password',
            ], 202);
        }else{
            $user = Auth::user();
            if($user->type == '2'){
              return $this->respondWithToken($token);
            }else{
              return response()->json([ 
                'status' => false,
                'msg'=>'Incorrect login detail '],201);
            }
            
        }
      }catch (JWTException $e) {
          return response()->json(['msg' => 'could_not_create_token'], 203);
      }

  }
  public function checklogin(Request $request)
  {
      return view('admin/index');
  }
  public function logout()
  {
    
    auth('api')->logout();
    return response()->json(['message' => 'Successfully logged out']);
  
  }
  protected function respondWithToken($token)
  {
      return response()->json([
          'access_token' => $token,
          'msg' => 'Login Success',
          'user' => $this->guard(),
          'token_type' => 'bearer',
          'expires_in' => auth('api')->factory()->getTTL() * 60
      ]);
  }
  public function guard()
  {
      return Auth::Guard('api')->user();
  }
}
