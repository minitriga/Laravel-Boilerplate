@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Subscription</div>

                <div class="card-body">
                    <form method="POST" id="payment-form" action="{{ route('subscription.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="plan" class="col-md-4 col-form-label text-md-right">Plan</label>

                            <div class="col-md-6">
                                <select name="plan" id="plan" class="form-control{{ $errors->has('plan') ? ' is-invalid' : '' }}" required>
                                    @foreach ($plans as $plan)
                                    <option value="{{ $plan->gateway_id }}" {{ request('plan') === $plan->slug || old('plan') === $plan->gateway_id ? 'selected' : '' }}>{{ $plan->name }} - £{{ $plan->price }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('plan'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('plan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coupon" class="col-md-4 col-form-label text-md-right">Coupons</label>
    
                            <div class="col-md-6">
                                <input id="coupon" type="text" class="form-control{{ $errors->has('coupon') ? ' is-invalid' : '' }}" name="coupon" value="{{ old('coupon') }}" required autofocus>
    
                                @if ($errors->has('coupon'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('coupon') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="pay" class="btn btn-primary">
                                    Pay
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
        let handler = StripeCheckout.configure({
            key: '{{ config('services.stripe.key') }}',
            locale: 'auto',
            token: function(token) {
                let form = $('#payment-form')

                $('#pay').prop('disabled', true)
                $('<input>').attr({
                    type: 'hidden',
                    name: 'token',
                    value: token.id
                }).appendTo(form)
                
                form.submit();
            }
        })

        $('#pay').click(function (e) {
            handler.open({
                name: 'Alex Gittings Ltd.', 
                description: 'Membership',
                currency: 'gbp',
                key: '{{ config('services.stripe.key') }}',
                email: '{{ auth()->user()->email }}'
            })
            e.preventDefault();
        })
    </script>
@endsection
