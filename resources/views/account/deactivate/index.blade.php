@extends('account.layouts.default')

@section('account.content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('account.deactivate.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="password_current" class="control-label">Current Password</label>
                    <input type="password" class="form-control {{ $errors->has('password_current') ? ' is-invalid' : '' }}" id="password_current" name="password_current" >

                    @if ($errors->has('password_current'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password_current') }}</strong>
                        </span>
                    @endif
                </div>

                @subscriptionnotcancelled
                    <p>This will also cancel your active subscription.</p>
                @endsubscriptionnotcancelled

                <button type="submit" class="btn btn-primary">Deactivate Account</button>
            </form>
        </div>
    </div>
@endsection
