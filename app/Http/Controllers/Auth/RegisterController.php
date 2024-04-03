<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Roles;
use App\Models\Tenant;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
        $check_company=Company::where('name','=',$data['tenant'])->first();
        if($check_company){
            throw ValidationException::withMessages(['tenant' => 'This tenant name been taken']);
        }
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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

        $newUser=User::create([
            'name' => ($data['name']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $_position=Roles::find(4);
        $newUser->syncRoles($_position->name);
        $input = [
            'name'                  => $data['tenant'],
            'domain'                => str::slug($data['tenant'],'-').' '.Str::uuid(),
            'slug'                  => str::slug($data['tenant'],'-').' '.Str::uuid(),
            'default_password'      => NULL,
            'is_new_company'        => '0',
            'master_id'        =>$newUser->id,

        ];

        $newCompany=Company::Create($input);

        $new_tenant_input=  Tenant::create([
            'user_id' =>  $newUser->id,
            'action' =>  'User '.$newUser->id .' Create this',
            'company_id' => $newCompany->id
        ]);
        $newUser->company_id=$newCompany->id;
        $newUser->save();
        return $newUser;
    }
}
