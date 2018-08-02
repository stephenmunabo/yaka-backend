@extends('layouts.app')

@section('content')
    <form method="post" action="@if ($item->id == null) {{ route('categories.store') }} @else {{ route('categories.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.categories.f_name')}}</label>
            <input type="text" class="form-control" value="{{$item->name}}" name="name"/>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="" class="control-label">{{__('messages.categories.f_parent')}}</label>
            <select name="parent_id" class="form-control" id="parent">
                <option value=""></option>
                @foreach($categories as $category)
                    <option data-city="{{ $category->city_id }}" data-restaurant="{{ $category->restaurant_id }}" value="{{$category->id}}" @if ($item->parent_id == $category->id) selected @endif>
                        @for ($i = 0; $i < $category->depth; $i++) - @endfor {{$category->name}}
                    </option>
                @endforeach
            </select>
        </div>

        @if (\App\Settings::getSettings()->multiple_cities)
            <div class="form-group">
                <label for="" class="control-label">{{__('messages.categories.f_city')}}</label>
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

        @if (\App\Settings::getSettings()->multiple_restaurants)
            <div class="form-group">
                <label for="" class="control-label">{{__('messages.categories.f_restaurant')}}</label>
                <select name="restaurant_id" class="form-control" id="restaurants">
                    <option value=""></option>
                    @foreach(\App\Restaurant::policyScope()->get() as $restaurant)
                        <option data-city="{{ $restaurant->city_id }}" value="{{$restaurant->id}}" @if ($item->restaurant_id == $restaurant->id) selected @endif>
                            {{$restaurant->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="form-group">
            <label for="" class="control-label">{{__('messages.categories.f_image')}}</label>
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
    @if (\App\Settings::getSettings()->multiple_cities && \App\Settings::getSettings()->multiple_restaurants)
        <script>
            $(document).ready(function () {
                $('#cities').change(function () {
                    var c = $('#cities').val();
                    $('#restaurants option').hide();
                    $('#restaurants option[data-city=' + c + ']').show();
                });
                $('#cities').trigger('change');
            });
        </script>
    @endif
    @if (\App\Settings::getSettings()->multiple_cities || \App\Settings::getSettings()->multiple_restaurants)
        <script>
            $(document).ready(function () {
                $('#parent').change(function () {
                    var c = $('#parent option:selected');
                    $('#cities').val(c.data('city'));
                    $('#restaurants').val(c.data('restaurant'));
                });
            });
        </script>
    @endif
@endsection