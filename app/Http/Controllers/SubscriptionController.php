<?php

namespace App\Http\Controllers;

use Log;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request){
        return view('subscriptions.subLanding',[
            'categories' => Category::all(),
            'user' => $request->user(),
        ]);
    }
//subscribe to specific category
    public function subscribe($categoryID, Request $request){
        $user = $request->user();
        if (!$user->categories()->where('category_id', $categoryID)->exists()){
            $user->categories()->attach($categoryID);
            return to_route('subscription.index', ['subscribed' => true]);
        } else if ($user->categories()->where('category_id', $categoryID)->exists()){
            return to_route('subscription.index', ['subscribed' => false]);
        }
        
    }
}
