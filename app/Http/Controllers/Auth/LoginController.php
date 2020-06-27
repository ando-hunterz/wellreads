<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Canvas\UserMeta;
use Illuminate\Support\Str;
use App\Canvas;


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

    public function showLoginForm()
    {
        $metaData = null;

        return view('studio.app', [
            'scripts' => [
                'avatar' => $avatar ?? null,
                'darkMode' =>  false,
                'locale' =>  config('app.locale'),
                'maxUpload' => config('canvas.upload_filesize'),
                'languageCodes' => Canvas::getAvailableLanguageCodes(),
                'canvasPath' => config('canvas.path'),
                'path' => config('studio.path'),
                'identifier' => config('studio.identifier'),
                'timezone' => config('app.timezone'),
                'translations' => collect(['app' => trans('canvas::app', [], optional($metaData)->locale)])->toJson(),
                'unsplash' => config('canvas.unsplash.access_key'),
                'user' => null,
            ],
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        $user = auth()->user();

        if ($user) {
            $metaData = UserMeta::where('user_id', $user->id)->first();
            $avatar = !empty(optional($metaData)->avatar) ? $metaData->avatar : $this->generateDefaultGravatar($user->email);
        }

        $user['avatar'] = $avatar;


        return $request->wantsJson()
            ? response($user, 200)
            : redirect()->intended($this->redirectPath());
    }

    /**
     * Generate a default Gravatar image url from a given email.
     *
     * @param string $email
     * @param int $size
     * @return string
     */
    protected function generateDefaultGravatar(string $email, int $size = 200): string
    {
        $emailHash = md5(trim(Str::lower($email)));

        return "https://secure.gravatar.com/avatar/{$emailHash}?s={$size}";
    }
}
