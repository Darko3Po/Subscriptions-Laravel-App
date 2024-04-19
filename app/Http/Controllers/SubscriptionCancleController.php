<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionCancleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('account.subscriptions.cancel');
    }

    public function store(Request $request)
    {
       $subscription = $request->user()->subscription('default');

       $subscription->cancel();

       return redirect()->route('account.subscriptions');
    }
}
