<?php

namespace App\Http\Controllers\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
	public function __construct() {
		$this->middleware('guest')->except('logout');
	}

    public function login(Request $request)
    {
        $this->validateLogin($request);
        //dd("hola");
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
            $adm_vigencia = new Carbon($user->adm_vigencia);
            $now = Carbon::today();
            $activo = $adm_vigencia->greaterThanOrEqualTo($now);//funcion compara y erifica si se encuentra activo
            if ($user->adm_estado==1 &&$activo && $this->attemptLogin($request)) {
                if ($request->modal)
                    return json_encode((Object)['status' => 'logued']);
                else
                    return $this->sendLoginResponse($request);
            }
            elseif($user->adm_estado!=1) {

                $this->incrementLoginAttempts($request);
                return redirect()
                    ->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors([$this->username() => 'su cuenta se encuentra desactivada.']);
            }
            elseif(!$activo) {

                $this->incrementLoginAttempts($request);
                return redirect()
                    ->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors([$this->username() => 'Su cuenta no se encuentra vigente.']);
            }

        }
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
        //return view("welcome");
    }
	public function username() {
		// $login = request()->input("adm_password");
		// $fieldtype = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'adm_password';
		// request()->merge([$fieldtype => $login]);

		// return $fieldtype;
		return 'adm_email';
	}
}
