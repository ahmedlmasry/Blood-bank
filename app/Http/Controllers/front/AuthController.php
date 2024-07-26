<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Post;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request){
        return view('front.register');
    }
    public function postRegister(Request $request){
        $valdiation = Validator()->make($request->all(), [
            'name'=> 'required',
            'phone'=> 'required|unique:clients',
            'd_o_b'=> 'required',
            'password'=> 'required|confirmed',
            'last_donation_date'=> 'required',
            'email'=> 'required|unique:clients',
            'blood_type_id'=> 'required',
        ]);
        if($valdiation->fails()){
            return back()->withErrors($valdiation)->withInput();
        }
        $password = $request->password;
        $request->merge(['password'=>bcrypt($password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->save();
        return view('front.home');
    }

    public function login(Request $request){
        return view('front.login');
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:clients,phone',
            'password' => 'required'
        ]);
        $phone = $request->phone;
        $client = Client::Where('phone', $phone)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                return view('front.home');
            } else {
                return back()->withErrors('wrong password');
            }
        }
    }


}
