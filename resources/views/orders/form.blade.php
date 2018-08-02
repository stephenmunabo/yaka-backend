@extends('layouts.app')

@section('content')
    <form method="post" action="@if ($item->id == null) {{ route('orders.store') }} @else {{ route('orders.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.orders.f_name')}}</label>
            <input type="text" class="form-control" value="{{$item->name}}" name="name"/>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.orders.f_address')}}</label>
            <input type="text" class="form-control" value="{{$item->address}}" name="address"/>
            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>

        @if (\App\Settings::getSettings()->multiple_cities)
            <div class="form-group {{ $errors->has('city_id') ? ' has-error' : '' }}">
                <label class="control-label">{{ __('messages.orders.f_city') }}</label>
                <select name="city_id" id="cities" class="form-control">
                    <option value=""></option>
                    @foreach(\App\City::policyScope()->get() as $city)
                        <option value="{{ $city->id }}" @if($item->city_id == $city->id) selected @endif>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('city_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('city_id') }}</strong>
                    </span>
                @endif
            </div>
        @endif
        @if (\App\Settings::getSettings()->multiple_restaurants)
            <div class="form-group {{ $errors->has('restaurant_id') ? ' has-error' : '' }}">
                <label class="control-label">{{ __('messages.orders.f_restaurant') }}</label>
                <select name="restaurant_id" id="restaurants" class="form-control">
                    <option value=""></option>
                    @foreach(\App\Restaurant::policyScope()->get() as $restaurant)
                        <option data-city="{{ $restaurant->city_id }}" value="{{ $restaurant->id }}" @if($item->restaurant_id == $restaurant->id) selected @endif>
                            {{ $restaurant->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('restaurant_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('restaurant_id') }}</strong>
                    </span>
                @endif
            </div>
        @endif

        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.orders.f_phone')}}</label>
            <input type="text" class="form-control" value="{{$item->phone}}" name="phone"/>
            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="" class="control-label">{{__('messages.orders.f_area')}}</label>
            <select name="delivery_area_id" class="form-control">
                <option value=""></option>
                @foreach(\App\DeliveryArea::all() as $da)
                    <option value="{{$da->id}}" @if ($item->delivery_area_id == $da->id) selected @endif>
                        {{$da->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group {{ $errors->has('promo_code') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.orders.f_promo_code')}}</label>
            <input type="text" class="form-control" value="{{$item->promo_code}}" name="promo_code"/>
            @if ($errors->has('promo_code'))
                <span class="help-block">
                    <strong>{{ $errors->first('promo_code') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="" class="control-label">{{__('messages.orders.f_payment_method')}}</label>
            <select name="payment_method" class="form-control">
                <option value=""></option>
                <option value="cash" @if ($item->payment_method == 'cash') selected @endif>{{__('messages.orders.payment_methods.cash')}}</option>
                <option value="paypal" @if ($item->payment_method == 'paypal') selected @endif>{{__('messages.orders.payment_methods.paypal')}}</option>
                <option value="stripe" @if ($item->payment_method == 'stripe') selected @endif>{{__('messages.orders.payment_methods.stripe')}}</option>
            </select>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input value="1" type="checkbox" name="is_paid" @if ($item->is_paid) checked @endif>
                    {{__('messages.orders.f_is_paid')}}
                </label>
            </div>
        </div>

         <div class="form-group">
            <label for="" class="control-label">{{__('messages.orders.f_status')}}</label>
            <select name="order_status_id" class="form-control">
                <option value=""></option>
                @foreach(\App\OrderStatus::all() as $da)
                    <option value="{{$da->id}}" @if ($item->order_status_id == $da->id) selected @endif>
                        {{$da->name}}
                    </option>
                @endforeach
            </select>
        </div>

        @if ($item->id != null)
            <a href="{{ route('ordered_products.index', ['filter' => ['order_id' => $item->id]]) }}" class="btn btn-info btn-block">{{__('messages.actions.edit_products')}}</a>
        @endif
        <br>
        <br>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
    </form>
    @if (\App\Settings::getSettings()->multiple_restaurants || \App\Settings::getSettings()->multiple_cities)
        <script src="/custom_js/products.js"></script>
    @endif
@endsection