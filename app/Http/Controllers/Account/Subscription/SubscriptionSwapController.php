<?php

namespace App\Http\Controllers\Account\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use App\Http\Requests\Subscription\SubscriptionSwapStoreRequest;

class SubscriptionSwapController extends Controller
{
    public function index()
    {
        $plans = Plan::except(auth()->user()->plan->id)->active()->get();
        return view('account.subscription.swap.index', compact('plans'));
    }

    public function store(SubscriptionSwapStoreRequest $request)
    {
        $user = $request->user();

        $plan = Plan::where('gateway_id', $request->plan)->first();

        if ($this->downgratesFromTeamPlan($user, $plan)) {
            $user->team->users()->detach();
        }

        $user->subscription('main')->swap($plan->gateway_id);

        return back()->withSuccess('Your subscription was changed');
    }

    protected function downgratesFromTeamPlan(User $user, Plan $plan)
    {
        if ($user->plan->isForTeams() && $plan->isNotForTeams()) {
            return true;
        }

        return false;
    }
}
