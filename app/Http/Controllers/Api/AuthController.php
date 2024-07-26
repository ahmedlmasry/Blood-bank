<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\BloodType;
use App\Models\Client;
use App\Models\Token;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function register(Request $request){
        $valdiator = validator()->make($request->all(),[
            'name'=> 'required',
            'city_id'=> 'required',
            'phone'=> 'required',
            'password'=> 'required|confirmed',
            'last_donation_date'=> 'required',
            'email'=> 'required|unique:clients',
            'blood_type_id'=> 'required',
        ]);
        if($valdiator->fails()){
            return responseJson(0,$valdiator->errors()->first(),$valdiator->errors());
        }
        $request->merge(['password'=>bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = str::random(60);
        $client->save();
        return responseJson(1,'تم الاضافة بنجاح',[
            'api_token' => $client->api_token,
            'client' => $client
        ]);
    }
    public function login (Request $request){
        $valdiator= validator()->make($request->all(),[
            'phone'=> 'required',
            'password'=> 'required',
        ]);
        if($valdiator->fails()){
            return responseJson(0,$valdiator->errors()->first(),$valdiator->errors());
        }
        $client = Client::where('phone',$request->phone)->first();
        if($client){
            if(Hash::check($request->password,$client->password)){
                return responseJson(1,'بيانات الدخول صحيحه',[
                    'api_token'=>$client->api_token,
                    'client'=>$client
                ]);
            }
            else{
                return responseJson(0,'بيانات الدخول غير صحيحة');
            }
        }
    }
    public function resetPassword (Request $request){
        $valdiator= validator()->make($request->all(),[
            'phone'=> 'required'
        ]);
        if($valdiator->fails()){
            return responseJson(0,$valdiator->errors()->first(),$valdiator->errors());
        }
        $user = Client::where('phone',$request->phone)->first();
        if($user){
            $code = rand(1111,9999);
            $update = $user->update(['pin_code'=>$code]);
            if($update){
                Mail::to($user->email)->
                bcc("test@gmail.com")
                ->send(new ResetPassword($code));
                return responseJson(1,'برجاء فحص هاتفك',[
                    'pin_code_for_test'=>$code
                ]);
            }
            else{
                return responseJson(0,'حدث خطأ حاول مرة اخري');
            }
        }
    }
    public function newPassword(Request $request){
        $valdiator = validator()->make($request->all(),[
            'pin_code'=>'required',
            'phone'=>'required',
            'password'=>'required|confirmed'
        ]);
        if($valdiator->fails()){
            return responseJson(0,$valdiator->errors()->first(),$valdiator->errors());
        }
        $user = Client::where('pin_code',$request->pin_code)->where('phone',$request->phone)->first();
        if($user){
            $user->password = bcrypt($request->password);
            $user->pin_code =null;
            if($user->save()){
                return responseJson(1,'تم تغيير كلمة المرور بنجاح');
            }
            else{
                return responseJson(0,'حدث خطأ حاول مرة اخري');
            }
        }else{
            return responseJson(0,'هذا الكود غير صالح');
        }
    }
    public function profile(Request $request){
        $valdiator = validator()->make($request->all(),[
            'password'=>'confirmed',
            'phone'=> Rule::unique('clients')->ignore($request->user()->id),
            'email'=> Rule::unique('clients')->ignore($request->user()->id),
        ]);
        if($valdiator->fails()){
            return responseJson(0,$valdiator->errors()->first(),$valdiator->errors());
        }
        $login_user= $request->user();
        $request->merge(['password'=>bcrypt($request->password)]);
        $login_user->update($request->all());
        if($login_user->save()){
            return responseJson(1,'تم تعديل البيانات بنجاح');
        }else{
            return responseJson(0,'حدث خطأ حاول مرة اخري');
        }
    }
    /*
public function notificationSettings(Request $request, Client $client)
    {
        $validated = validator()->make($request->all(), [
            'blood_type_id' => 'required|array',
            'blood_type_id.*' => 'required|exists:blood_types,id|string',
            'government_id' => 'required|exists:governments,id',
        ]);
        if ($validated->fails()) {
            $errors = $validated->errors()->all();
            return responseJson(0, $errors);
        }
        $client = $request->user();
        //Blood types
        if ($request->has('blood_type_id')) {
            $bloodTypeId = $request->blood_type_id;
            $types = $client->bloodTypes()->sync($bloodTypeId);
        }
        //city
        if ($request->has('government_id')) {
            $governmentId = $request->government_id;
            $governments = $client->governments()->sync($governmentId);
        }
        return responseJson(1, 'success', ['types' => $types, 'governments' => $governments]);
    }
 */
    public function notificationsSettings(Request $request){
        $valdiator = validator()->make($request->all(),[
            'governorate_id'=> 'required',
            'blood_type_id'=> 'required',
        ]);
        if($valdiator->fails()){
            return responseJson(0,$valdiator->errors()->first(),$valdiator->errors());
        }
        if($request->has('governorate_id')){
        $governorate = $request->user()->governorates()->sync($request->governorate_id);
        }
        if($request->has('blood_type_id')){
            // $bloodtype = BloodType::where('name',$request->blood_type_id)->first();
            $bloodtype = $request->blood_type_id;
            $b = $request->user()->bloodTypes()->sync($bloodtype);
        }
        return responseJson(1,'تم اضافة الاشعارات بنجاح',[
            'bloodtypes' => $b,
            'governorates' => $governorate
        ]);
        }

    public function registerToken(Request $request){
        $valdiator = validator()->make($request->all(),[
            'token'=> 'required',
            'platform'=> 'required|in:android,ios',
        ]);
        if($valdiator->fails()){
            return responseJson(0,$valdiator->errors()->first(),$valdiator->errors());
        }
        Token::where('token',$request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return responseJson(1,'تم التسجيل بنجاح');
    }
    public function removeToken(Request $request){
        $valdiator = validator()->make($request->all(),[
            'token'=> 'required',
        ]);
        if($valdiator->fails()){
            return responseJson(0,$valdiator->errors()->first(),$valdiator->errors());
        }
        Token::where('token',$request->token)->delete();
        return responseJson(1,'تم الحذف بنجاح');
    }
}


