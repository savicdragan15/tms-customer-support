<?php
namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\Response;
use Validator;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['status' => 'success'], Response::HTTP_OK);
    }

  /**
   * Login user and return a token
   * @param LoginRequest $request
   *
   * @return \Illuminate\Http\JsonResponse
   */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success'], Response::HTTP_OK)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], Response::HTTP_BAD_REQUEST);
    }
    /**
     * Logout User
     */
    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], Response::HTTP_OK);
    }
    /**
     * Get authenticated user
     */
    public function user(Request $request)
    {
        $user = new UserResource(User::find(Auth::user()->id));
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
    /**
     * Refresh JWT token
     */
    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], Response::HTTP_OK)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], Response::HTTP_UNAUTHORIZED);
    }
    /**
     * Return auth guard
     */
    private function guard()
    {
        return Auth::guard();
    }
}
