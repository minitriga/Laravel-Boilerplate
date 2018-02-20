<ul class="nav nav-pills nav-stacked nav-fill flex-column">
    <li class="nav-item">
        <a href="{{ route('account.index') }}" class="nav-link text-left {{ Nav::isRoute('account.index') }}">Account Overview</a>
    </li>

    <li class="nav-item">
        <a href="{{ route('account.profile.index') }}" class="nav-link text-left {{ Nav::isRoute('account.profile.index') }}">Edit Profile</a>
    </li>

    <li class="nav-item">
        <a href="{{ route('account.password.index') }}" class="nav-link text-left {{ Nav::isRoute('account.password.index') }}">Change Password</a>
    </li>

    <li class="nav-item">
        <a href="{{ route('account.deactivate.index') }}" class="nav-link text-left {{ Nav::isRoute('account.deactivate.index') }}">Deactivate Account</a>
    </li>

    <li class="nav-item">
            <a href="{{ route('account.twofactor.index') }}" class="nav-link text-left {{ Nav::isRoute('account.twofactor.index') }}">Two Factor Authentication</a>
    </li>
</ul>



@subscribed
    @notpiggybacksubscription
    <hr>

    <ul class="nav nav-pills nav-stacked nav-fill flex-column" >
        @subscriptionnotcancelled
        <li class="nav-item">
            <a href="{{ route('account.subscription.swap.index') }}" class="nav-link text-left {{ Nav::isRoute('account.subscription.swap.index') }}">Change Plan</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('account.subscription.cancel.index') }}" class="nav-link text-left {{ Nav::isRoute('account.subscription.cancel.index') }}">Cancel Subscription</a>
        </li>
        @endsubscriptionnotcancelled
        @subscriptioncancelled
        <li class="nav-item">
            <a href="{{ route('account.subscription.resume.index') }}" class="nav-link text-left {{ Nav::isRoute('account.subscription.resume.index') }}">Resume Plan</a>
        </li>
        @endsubscriptioncancelled

        <li class="nav-item">
            <a href="{{ route('account.subscription.card.index') }}" class="nav-link text-left {{ Nav::isRoute('account.subscription.card.index') }}">Update Card</a>
        </li>
    </ul>

    @teamsubscription
        <hr>

        <ul class="nav nav-pills nav-stacked nav-fill flex-column">
            <li class="nav-item">
                <a href="{{ route('account.subscription.team.index') }}" class="nav-link text-left {{ Nav::isRoute('account.subscription.team.index') }}">Manage Team</a>
            </li>
        </ul>
    @endteamsubscription
    @endnotpiggybacksubscription
@endsubscribed