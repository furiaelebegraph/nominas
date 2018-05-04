<?php

namespace App\Http\Controllers\SellerAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Auth facade
use Auth;

class LoginController extends Controller
{
    //Where to redirect seller after login.
    protected $redirectTo = '/dash';

    //Trait
    use AuthenticatesUsers;

    //Custom guard for seller
    protected function guard(){
      return Auth::guard('web_seller');
    }

    //Shows seller login form
    public function showLoginForm(){
       return view('seller.auth.login');
    }

    public function username(){
        return 'correo';
    }

    public function login(Request $request) {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // This section is the only change
        if ($this->guard()->validate($this->credentials($request))) {
            $user = $this->guard()->getLastAttempted();

            // Make sure the user is active
            if ($user->verificado && $this->attemptLogin($request)) {
                // Send the normal successful login response
                return $this->sendLoginResponse($request);
            } else {
                // Increment the failed login attempts and redirect back to the
                // login form with an error message.
                $this->incrementLoginAttempts($request);
                return redirect()
                    ->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors(['active' => 'You must be active to login.']);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    protected function credentials(Request $request){
        return array_merge($request->only($this->username(), 'password'), ['verificado' => 1]);
    }  

    protected function sendLoginResponse(Request $request){
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        return $this->authenticated($request, $this->guard())
                ?: redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request){ 
        $this->guard()->logout();
        $request->session()->flush();
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
