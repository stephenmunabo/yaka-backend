@extends('layouts.app')

@section('content')
    <form method="post" action="@if ($item->id == null) {{ route('restaurants.store') }} @else {{ route('restaurants.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.restaurants.f_name')}}</label>
            <input type="text" class="form-control" value="{{$item->name}}" name="name"/>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        @if (\App\Settings::getSettings()->multiple_cities)
            <div class="form-group">
                <label for="" class="control-label">{{__('messages.restaurants.f_city')}}</label>
                <select name="city_id" class="form-control">
                    <option value=""></option>
                    @foreach(\App\City::policyScope()->get() as $city)
                        <option value="{{$city->id}}" @if ($item->city_id == $city->id) selected @endif>
                            {{$city->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="form-group {{ $errors->has('sort') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.restaurants.f_sort')}}</label>
            <input type="text" class="form-control" value="{{$item->sort}}" name="sort"/>
            @if ($errors->has('sort'))
                <span class="help-block">
                    <strong>{{ $errors->first('sort') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.restaurants.f_image')}}</label>
            @if ($item->image != null)
                <div class="row">
                    <div class="col-xs-6">
                        <img src="{{ $item->image }}" alt="" class="img-responsive">
                    </div>
                </div>
            @endif
            <input type="file" name="image">
        </div>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
    </form>
@endsection