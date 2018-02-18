<ul class="nav nav-pills nav-stacked nav-fill">
    <li class="nav-item">
        <a href="{{ route('account.index') }}" class="nav-link text-left {{ Nav::isRoute('account.index') }}">Account Overview</a>
    </li>

    <li class="nav-item">
            <a href="{{ route('account.profile.index') }}" class="nav-link text-left {{ Nav::isRoute('account.profile.index') }}">Profile</a>
    </li>

    <li class="nav-item">
            <a href="{{ route('account.password.index') }}" class="nav-link text-left {{ Nav::isRoute('account.password.index') }}">Change Password</a>
    </li>
</ul>