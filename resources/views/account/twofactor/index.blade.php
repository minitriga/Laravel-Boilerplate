@extends('account.layouts.default')

@section('account.content')
    <div class="card">
        <div class="card-body">
            @if (auth()->user()->twoFactorEnabled())
                <p>Two factor authentication is enabled for your account.</p>
                <form action="{{ route('account.twofactor.destroy') }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-primary">Disable</button>
                </form>
            @else
                @if (auth()->user()->twoFactorPendingVerification())
                    <form action="{{ route('account.twofactor.verify') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="token" class="control-label">Verification Token</label>
                            <input type="text" class="form-control {{ $errors->has('token') ? ' is-invalid' : '' }}" id="token" name="token" required>
                            
                            @if ($errors->has('token'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('token') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Verify</button>
                    </form>

                    <hr>
                    <form action="{{ route('account.twofactor.destroy') }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-default">Cancel</button>
                    </form>
                @else            
                    <form action="{{ route('account.twofactor.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="dial_code" class="control-label">Dialling Code</label>

                            <select name="dial_code" id="dial_code" class="form-control {{ $errors->has('dial_code') ? ' is-invalid' : '' }}" >
                                @foreach ($countries as $country)
                                    <option value="{{ $country->dial_code }}">{{ $country->name }} (+{{ $country->dial_code }})</option>
                                @endforeach
                            </select>

                            @if ($errors->has('dial_code'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('dial_code') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone_number" class="control-label">Phone Number</label>
                            <input type="text" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" id="phone_number" name="phone_number" >
                            
                            @if ($errors->has('phone_number'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Enable</button>
                    </form>
                @endif
            @endif
        </div>
    </div>
@endsection
