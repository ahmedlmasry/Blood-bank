<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function home(Request $request)
    {
        $client = Client::first();
        auth('client-web')->login($client);
        $posts = Post::take(6)->get();
        return view('front.home', compact('posts'));
    }

    public function toggleFavourite(Request $request)
    {
        $toggle = $request->user()->posts()->toggle($request->post_id);
        return responseJson(1, 'success', $toggle);
    }

    public function about()
    {
        return view('front.about');
    }

    public function allPosts()
    {
        $posts = Post::all();
        $model = Post::first();
        return view('front.posts', compact('posts','model'));
    }

    public function posts(string $id)
    {
        $model = Post::findorfail($id);

        return view('front.posts', compact('model'));
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function donations()
    {
        return view('front.donations');
    }

    public function donationDetails(string $id)
    {
        $model = DonationRequest::findorfail($id);
        return view('front.donation-details', compact('model'));
    }

}
