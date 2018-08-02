@extends('layouts.app')

@section('content')
    <form method="post" action="@if ($item->id == null) {{ route('news_items.store') }} @else {{ route('news_items.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.news.f_title')}}</label>
            <input type="text" class="form-control" value="{{$item->title}}" name="title"/>
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
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

        <div class="form-group">
            <label for="" class="control-label">{{__('messages.news.f_image')}}</label>
            @if ($item->image != null)
                <div class="row">
                    <div class="col-xs-6">
                        <img src="{{ $item->image }}" alt="" class="img-responsive">
                    </div>
                </div>
            @endif
            <input type="file" name="image">
        </div>

        <div class="form-group {{ $errors->has('announce') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.news.f_announce')}}</label>
            <textarea name="announce" class="form-control">{{$item->announce}}</textarea>
            @if ($errors->has('announce'))
                <span class="help-block">
                    <strong>{{ $errors->first('announce') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('full_text') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.news.f_full_text')}}</label>
            <textarea name="full_text" class="form-control">{{$item->full_text}}</textarea>
            @if ($errors->has('full_text'))
                <span class="help-block">
                    <strong>{{ $errors->first('full_text') }}</strong>
                </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
    </form>
@endsection