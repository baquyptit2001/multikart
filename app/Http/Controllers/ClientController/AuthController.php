<?php

namespace App\Http\Controllers\ClientController;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    public function register(Request $request){
//        return $request;
        $fields = $request->validate([
            'user_name' => 'bail|required|string|unique:users|min:6|max:16',
            'email' => 'bail|required|string|unique:users|email',
            'password' => 'bail|required|string|min:6|max:16|confirmed'
        ]);
        $user = User::create([
            'user_name' => $fields['user_name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'display_name' => $fields['user_name'],
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response()->json(['user'=>$user, 'token'=>$token], 201);
    }

    public function user($id)
    {
        $user = User::find($id);
        return response()->json($user,200);
    }

    public function login(Request $request){
//        return $request;
        $fields = $request->validate([
            'user_name' => 'bail|required|string|min:6|max:16',
            'password' => 'bail|required|string|min:6|max:16'
        ]);

        $user = User::where('user_name', $fields['user_name'])->first();

        if(!$user or !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Tài khoản hoặc mật khẩu không đúng !',
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logOut(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out'
        ];
    }

    public function users(){
        return User::all();
    }

    public function forgot()
    {
        return view('frontend.page.login.forgot');
    }

    public function checkForgot(Request $request){
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status), 'success'=>'Email phục hồi mật khẩu đã được gửi!!'])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function passReset($token)
    {
        return view('frontend.page.login.reset', ['token' => $token]);
    }

    public function passUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function updateInfo(Request $request){
        $user = User::find($request->id);
        if($request->current_password != ''){
            $request->validate([
                'password' => 'required|confirmed',
            ]);
            if(Hash::check($request->current_password, $user->password)){
                $user->update([
                    'password' => bcrypt($request->password)
                ]);
            }
        }
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'display_name' => $request->display_name,
            'email' => $request->email,
        ]);
        return response()->json($user, 200);
    }
}
