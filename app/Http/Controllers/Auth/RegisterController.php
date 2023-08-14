<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:conf_users'],
            // 'nik' => ['required', 'string', 'nik', 'max:255', 'unique:conf_users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        if (request()->hasfile('avatar')) {
            // $avatarName = time() . '.' . request()->avatar->getClientOriginalExtension();
            $extension = request()->avatar->getClientOriginalExtension();
            $fileName = request()->avatar->getClientOriginalName();
            $date = date('Y-m-d');
            $avatarName = "{$date}-{$fileName}";
            request()->avatar->move(public_path('storage/images/profile_picture'), $avatarName);
        } else {
            $avatarName = "-";
        }
        if (request()->hasfile('dokument')) {
            // $dokumentName = time() . '.' . request()->dokument->getClientOriginalExtension();
            $extension = request()->dokument->getClientOriginalExtension();
            $fileName = request()->dokument->getClientOriginalName();
            $date = date('Y-m-d');
            $dokumentName = "{$date}-{$fileName}";
            request()->dokument->move(public_path('storage/images/dokument'), $dokumentName);
        } else {
            $dokumentName = "-";
        }
        // dd($avatarName);
        return User::create([
            'fullname' => $data['name'],
            'nik' => $data['nik'],
            'profile_picture' => 'profile_picture/' . $avatarName ?? NULL,
            // 'dokument' => 'dokument/' . $dokumentName ?? NULL,
            // 'dokument' => ($dokumentName ? 'dokument/' . $dokumentName : NULL),
            'dokument' => ($dokumentName && $dokumentName != '-' ? 'dokument/' . $dokumentName : null),
            'tempat_lahir' => $data['tempat_lahir'],
            'tgl_lahir' => $data['tgl_lahir'],
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'],
            'group_id' => $data['group_id'],
            'agama_id' => $data['agama_id'],
            'kategori_id' => $data['kategori_id'],
            'sabuk_id' => $data['sabuk_id'],
            'unlat_id' => $data['unlat_id'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'created_by' => 'SYSTEM',
            'updated_by' => 'SYSTEM',
        ]);
    }
}
