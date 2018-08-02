@extends('layouts.app')

@section('content')
    <form method="post" action="@if ($item->id == null) {{ route('products.store') }} @else {{ route('products.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.products.f_name')}}</label>
            <input type="text" class="form-control" value="{{$item->name}}" name="name"/>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="row">
            @if (\App\Settings::getSettings()->multiple_cities)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="" class="control-label">{{__('messages.products.f_city')}}</label>
                        <select name="city_id" class="form-control" id="cities">
                            <option value=""></option>
                            @foreach(\App\City::policyScope()->get() as $city)
                                <option value="{{$city->id}}" @if ($item->city_id == $city->id) selected @endif>
                                    {{$city->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            @if (\App\Settings::getSettings()->multiple_restaurants)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="" class="control-label">{{__('messages.products.f_restaurant')}}</label>
                        <select name="restaurant_id" class="form-control" id="restaurants">
                            <option value=""></option>
                            @foreach(\App\Restaurant::policyScope()->get() as $restaurant)
                                <option data-city="{{ $restaurant->city_id }}" value="{{$restaurant->id}}" @if ($item->restaurant_id == $restaurant->id) selected @endif>
                                    {{$restaurant->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="" class="control-label">{{__('messages.products.f_category')}}</label>
            <select name="category_id" class="form-control" id="categories">
                <option value=""></option>
                @foreach($categories as $category)
                    <option data-city="{{ $category->city }}" data-restaurant="{{ $category->restaurant_id }}" value="{{$category->id}}" @if ($item->category_id == $category->id) selected @endif>
                        @for ($i = 0; $i < $category->depth; $i++) - @endfor {{$category->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="" class="control-label">{{__('messages.products.f_tax_group')}}</label>
            <select name="tax_group_id" class="form-control">
                <option value=""></option>
                @foreach(\App\TaxGroup::all() as $tg)
                    <option value="{{$tg->id}}" @if ($item->tax_group_id == $tg->id) selected @endif>
                        {{$tg->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="" class="control-label">{{__('messages.products.f_price')}}</label>
                    <input type="text" class="form-control" value="{{$item->price}}" name="price"/>
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group {{ $errors->has('price_old') ? ' has-error' : '' }}">
                    <label for="" class="control-label">{{__('messages.products.f_price_old')}}</label>
                    <input type="text" class="form-control" value="{{$item->price_old}}" name="price_old"/>
                    @if ($errors->has('price_old'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price_old') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="control-label">{{__('messages.products.f_description')}}</label>
            <textarea name="description" class="form-control">{{ $item->description }}</textarea>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>

        <h3>{{__('messages.products.f_image')}}</h3>
        <div class="row">
            @foreach($item->productImages as $image)
                <div class="col-sm-4 js-product-image-{{$image->id}}">
                    <div class="product-image-holder">
                        <a href="#" class="product-image-delete js-delete-product-image" data-id="{{$image->id}}">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                        <img src="{{$image->image}}" alt="" class="img-responsive">
                    </div>
                </div>
            @endforeach
        </div>
        <h4>{{__('messages.products.add_images')}}</h4>
        <div class="js-product-images-holder row">
            <div class="form-group js-product-image col-sm-4">
                <input type="file" name="image[]">
            </div>
        </div>
        <a href="#" class="js-add-image">
            <span class="glyphicon glyphicon-plus"></span>
            {{__('messages.products.add_image')}}
        </a>

        <br>
        <br>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
    </form>
    @if (\App\Settings::getSettings()->multiple_cities || \App\Settings::getSettings()->multiple_restaurants)
        <script src="/custom_js/products.js"></script>
    @endif
@endsection