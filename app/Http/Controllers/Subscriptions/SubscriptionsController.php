<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function index(Request $request)
    {
        $intent = $request->user()->createSetupIntent();

        return view('subscriptions.checkout',compact('intent'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }


}
