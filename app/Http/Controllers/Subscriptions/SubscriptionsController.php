<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user() === NULL)
        {
            dd('Uloguj se');
        }
        $intent = $request->user()->createSetupIntent();

        return view('subscriptions.checkout',compact('intent'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'token' => 'required'
        ]);

        $plan = Plan::where('slug', $request->plan)->orWhere('slug', 'monthly')->first();

        $request->user()->newSubscription('default', $plan->stripe_id)->create($request->token);

        return back();

    }


}
