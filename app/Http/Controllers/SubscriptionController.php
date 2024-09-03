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
            session()->flash('success', 'Subscription successful!');
        } else if ($user->categories()->where('category_id', $categoryID)->exists()){
            session()->flash('info', 'You are already subscribed to this category.');
        }
        return redirect()->route('subscription.index');
        
    }
}
