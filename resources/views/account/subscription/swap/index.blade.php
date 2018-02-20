@extends('account.layouts.default')

@section('account.content')
    <div class="card">
        <div class="card-body">
            <p>Current plan: {{ auth()->user()->plan->name }} - £{{ auth()->user()->plan->price }}</p>
            <form action="{{ route('account.subscription.swap.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email" class="control-label">Plan</label>

                    <select name="plan" id="plan" class="form-control {{ $errors->has('plan') ? ' is-invalid' : '' }}" required>
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->gateway_id }}">{{ $plan->name }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('plan'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('plan') }}</strong>
                        </span>
                    @endif
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
