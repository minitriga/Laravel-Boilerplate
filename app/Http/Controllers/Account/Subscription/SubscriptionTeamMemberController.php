<?php

namespace App\Http\Controllers\Account\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Account\SubscriptionTeamMemberStoreRequest;

class SubscriptionTeamMemberController extends Controller
{
    public function store(SubscriptionTeamMemberStoreRequest $request)
    {
        if ($this->teamLimitReached($request)) {
            return back()->withError('You have reached the team limit for your plan.');
        }

        $request->user()->team->users()->syncWithoutDetaching([
            User::where('email', $request->email)->first()->id
        ]);

        return back()->withSuccess('Team member added.');
    }

    public function destroy(User $user, Request $request)
    {
        $request->user()->team->users()->detach($user->id);
        return back()->withSuccess('User successfully removed from the team.');
    }

    protected function teamLimitReached($request)
    {
        return $request->user()->team->users->count() === $request->user()->plan->teams_limit;
    }
}
