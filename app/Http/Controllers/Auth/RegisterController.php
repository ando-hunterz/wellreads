<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Canvas;
use Illuminate\Support\Str;
use Canvas\UserMeta;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function showRegistrationForm()
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
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $lastId = User::latest()->first('id');

        return User::create([
            'name' => 'WellReadUser'.($lastId->id+1),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        $userData = auth()->user();
        $userData['avatar'] = $this->generateDefaultGravatar($user->email);

        UserMeta::create([
            'user_id' => $userData->id,
            'username' => $userData->name,
        ]);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? response($userData, 200)
                    : redirect($this->redirectPath());
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
