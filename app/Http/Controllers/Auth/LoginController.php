<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Menu;
use App\Models\Config;


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

    public function username()
    {
        return 'email';
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        //EVITAR 2 LOGIN
        if(Auth::check()){
            Auth::logoutOtherDevices($request->input('password'));
        }
    }

    public function showLoginForm()
    {
        $config_cache = Cache::get('config_cache');
        return view('auth.login', compact('config_cache'));
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $user = User::where('email', $request->email)->first();
        if ( $user ) {
            if ($user->activo != 'S') {
                return $this->sendLockedAccountResponse($request);
            }
        }
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            if( !Cache::has('config_cache') ) {
                $config_cache = Config::first();
                Cache::forever('config_cache', $config_cache);
            }
            // Guardar datos del menu en cache
            $menu_cache = 'menu_rol_'.$user->rol_id;
            if( !Cache::has($menu_cache) ) {
                $menus = Menu::where('activo', 'S')
                ->whereHas('permiso', function ($q) use ($user) {
                    $q->where('rol_id', $user->rol_id);
                })
                ->with(['permiso' => function ($query) use ($user) {
                    $query->where('rol_id', $user->rol_id)
                    ->select('id', 'rol_id', 'menu_id', 'activo');
                }])
                ->orderBy('id', 'ASC')
                ->orderBy('orden', 'ASC');
        
                $administrativos = clone $menus;
                $operativos = clone $menus;
                $sistemas = clone $menus;
        
                $data_cache = [
                    'administrativos' => $administrativos->where('categoria', 'A')->get(),
                    'operativos' => $operativos->where('categoria', 'O')->get(),
                    'sistemas' => $sistemas->where('categoria', 'S')->get()
                ];
                Cache::forever($menu_cache, $data_cache);
            }

            Auth::logoutOtherDevices($request->password); //EVITAR 2 LOGIN
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    
    protected function sendLockedAccountResponse(Request $request)
    {
        return redirect('login')
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $this->getLockedAccountMessage(),
            ]);
    }

    protected function getLockedAccountMessage()
    {
        return 'Su cuenta esta Inactiva o se encuentra Bloqueada.';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        //Cache::forget('config_cache');

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
