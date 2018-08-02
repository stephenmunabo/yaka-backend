@extends('layouts.app')

@section('content')
    <form method="post" action="@if ($item->id == null) {{ route('promo_codes.store') }} @else {{ route('promo_codes.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="" class="control-label">{{__('messages.promo_codes.f_name')}}</label>
                    <input type="text" class="form-control" value="{{$item->name}}" name="name"/>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                    <label for="" class="control-label">{{__('messages.promo_codes.f_code')}}</label>
                    <input type="text" class="form-control" value="{{$item->code}}" name="code"/>
                    @if ($errors->has('code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        @if (\App\Settings::getSettings()->multiple_cities)
            <div class="form-group">
                <label class="control-label">{{ __('messages.promo_codes.f_city') }}</label>
                <select name="city_id" id="cities" class="form-control">
                    <option value=""></option>
                    @foreach(\App\City::policyScope()->get() as $city)
                        <option value="{{ $city->id }}" @if($item->city_id == $city->id) selected @endif>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        @if (\App\Settings::getSettings()->multiple_restaurants)
            <div class="form-group">
                <label class="control-label">{{ __('messages.promo_codes.f_restaurant') }}</label>
                <select name="restaurant_id" id="restaurants" class="form-control">
                    <option value=""></option>
                    @foreach(\App\Restaurant::policyScope() as $restaurant)
                        <option data-city="{{ $restaurant->city_id }}" value="{{ $restaurant->id }}" @if($item->restaurant_id == $restaurant->id) selected @endif>
                            {{ $restaurant->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group {{ $errors->has('discount') ? ' has-error' : '' }}">
                    <label for="" class="control-label">{{__('messages.promo_codes.f_discount')}}</label>
                    <input type="text" class="form-control" value="{{$item->discount}}" name="discount"/>
                    @if ($errors->has('discount'))
                        <span class="help-block">
                            <strong>{{ $errors->first('discount') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                    <label for="" class="control-label">&nbsp;</label>
                    <div class="checkbox">
                        <label>
                            <input value="1" type="checkbox" name="discount_in_percent" @if ($item->discount_in_percent) checked @endif>
                            {{__('messages.promo_codes.f_discount_in_percent')}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group {{ $errors->has('limit_use_count') ? ' has-error' : '' }}">
                    <label for="" class="control-label">{{__('messages.promo_codes.f_limit')}}</label>
                    <input type="text" class="form-control" value="{{$item->limit_use_count}}" name="limit_use_count"/>
                    @if ($errors->has('limit_use_count'))
                        <span class="help-block">
                            <strong>{{ $errors->first('limit_use_count') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group {{ $errors->has('min_price') ? ' has-error' : '' }}">
                    <label for="" class="control-label">{{__('messages.promo_codes.f_min_price')}}</label>
                    <input type="text" class="form-control" value="{{$item->min_price}}" name="min_price"/>
                    @if ($errors->has('min_price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('min_price') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('active_from') ? ' has-error' : '' }}">
                    <label for="" class="control-label">{{__('messages.promo_codes.f_active_from')}}</label>
                    <input type="date" class="form-control" value="{{$item->active_from == null ? '' : $item->active_from->format('Y-m-d')}}" name="active_from"/>
                    @if ($errors->has('active_from'))
                        <span class="help-block">
                            <strong>{{ $errors->first('active_from') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('active_to') ? ' has-error' : '' }}">
                    <label for="" class="control-label">{{__('messages.promo_codes.f_active_to')}}</label>
                    <input type="date" class="form-control" value="{{$item->active_to == null ? '' : $item->active_to->format('Y-m-d')}}" name="active_to"/>
                    @if ($errors->has('active_to'))
                        <span class="help-block">
                            <strong>{{ $errors->first('active_to') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
        @if (\App\Settings::getSettings()->multiple_restaurants || \App\Settings::getSettings()->multiple_cities)
            <script src="/custom_js/products.js"></script>
        @endif
    </form>
@endsection