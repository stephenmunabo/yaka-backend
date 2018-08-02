@extends('layouts.app')

@section('content')
    <form method="post" action="@if ($item->id == null) {{ route('delivery_areas.store') }} @else {{ route('delivery_areas.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.delivery_areas.f_name')}}</label>
            <input type="text" class="form-control" value="{{$item->name}}" name="name"/>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.delivery_areas.f_price')}}</label>
            <input type="text" class="form-control" value="{{$item->price}}" name="price"/>
            @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>

        @if (\App\Settings::getSettings()->multiple_cities)
            <div class="form-group">
                <label for="" class="control-label">{{__('messages.delivery_areas.f_city')}}</label>
                <select name="city_id" class="form-control" id="cities">
                    <option value=""></option>
                    @foreach(\App\City::policyScope()->get() as $city)
                        <option value="{{$city->id}}" @if ($item->city_id == $city->id) selected @endif>
                            {{$city->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="form-group">
            <input type="hidden" name="coords" class="js-area-coords" value="{{ $item->coords }}">
            <div id="delivery_area_map"></div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
    </form>
@endsection