@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Impersonate a user</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.impersonate.start') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="control-label">Email</label>
                            <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email">
        
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Impersonate
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
