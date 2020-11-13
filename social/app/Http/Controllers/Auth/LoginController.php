<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectToProviderForGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $newUser = $this->userCreate($user, 'google');

        Auth::login($newUser);
        return redirect('/home');
    }

    public function handleProviderCallbackForGithub()
    {
        $user = Socialite::driver('github')->stateless()->user();
        $newUser = $this->userCreate($user, 'github');

        Auth::login($newUser);
        return redirect('/home');
    }


    public function userCreate($user, $provider){

        $finduser = User::where('social', $user->id)->first();

        if($finduser){
            Auth::login($finduser);
            return redirect('/home');
        }else{
            $finduser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'social'=> $user->id,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'provider' => 'github',
            ]);
        }

        return $finduser;
    }
}
