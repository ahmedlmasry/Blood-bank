<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\BloodTypes;
use App\Models\Categorie;
use App\Models\category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Token;
use Illuminate\Http\Request;


class MainController extends Controller
{
    public function governorates (){
        $gvernorate = Governorate::all();
        return responseJson(1,'success',$gvernorate);
    }
    public function cities (Request $request){
        $city = City::where(
        function ($query) use($request){
        if($request->has('governorate_id')){
            $query->where('governorate_id',$request->governorate_id);
        }
        }
        )->get();
        return responseJson(1,'success',$city);
    }
    public function bloodTypes (){
        $blood_type = BloodType::all();
        return responseJson(1,'success',$blood_type);
    }
    public function contacts (){
        $contact = Contact::all();
        return responseJson(1,'success',$contact);
    }
    public function settings (){
        $setting = Setting::all();
        return responseJson(1,'success',$setting);
    }
    public function posts (){
        $post = Post::with('category')->paginate();
        return responseJson(1,'success',$post);
    }
    public function categories (){
        $categorie = Category::all();
        return responseJson(1,'success',$categorie);
    }
    public function postFavourite (Request $request){
        $valdiator = validator()->make($request->all(),[
            'post_id'=>'required|exists:posts,id',
        ]);
        if($valdiator->fails()){
            return responseJson(0,$valdiator->errors()->first(),$valdiator->errors());
        }
        $toggle = $request->user()->posts()->toggle($request->post_id);
        return responseJson(1,'success',$toggle);
    }
    public function myFavourite(Request $request){
        $posts = $request->user()->posts()->oldest()->paginate();
        return responseJson(1,'success',$posts);
    }

    public function donationRequest(Request $request){
        $valdiator = validator()->make($request->all(),[
            'name'=>'required',
            'age'=>'required:digits',
            'phone'=>'required',
            'address'=>'required',
            'bags'=>'required:digits',
            'blood_type_id'=>'required',
            'city_id'=>'required',
        ]);
        if($valdiator->fails()){
            return responseJson(0,$valdiator->errors()->first(),$valdiator->errors());
        }
        $donationRequest = $request->user()->donationRequstes()->create($request->all());
        // dd($donationRequest);
        $send = null;
        $clientIds = $donationRequest->city->governorate->clients()->whereHas('bloodTypes',
        function($q) use($request){
            $q->where('blood_types.id',$request->blood_type_id);
        })->pluck('clients.id')->toArray();
        // dd($clientIds);

        if(count($clientIds)){
            $notification = $donationRequest->notifications()->create([
                'notification_title'=>'يوجد حالة تبرع قريبة منك',
                'notification_content'=>$donationRequest->bloodType->name . ' احتاج متبرع لفصيلة',
            ]);
            $notification->clients()->attach($clientIds);
            $tokens = Token::whereIn('client_id',$clientIds)->where('token','!=',null)->pluck('token')->toArray();
            // dd($tokens);
            if(count($tokens)){
                $title = $notification->notification_title;
                $body = $notification->notification_content;
                $data = [
                    'donation_request_id' => $donationRequest->id
                ];
                $send = notifyByFirebase($title,$body,$tokens,$data);
            }
        }
        return responseJson(1,'تم الاضافة بنجاح',compact('donationRequest','send'));
    }

}
