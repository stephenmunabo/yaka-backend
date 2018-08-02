@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{ route('products.create') }}">{{__('messages.products.new')}}</a>
    <!-- <a href="{{ route('products.bulk_upload') }}" class="btn btn-default">{{__('messages.products.bulk_upload')}}</a> -->
    <br>
    <br>
    <form action="{{ route('products.index') }}" method="get">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">{{ __('messages.products.filter_text') }}</label>
                    <input name="filter[q]" type="text" class="form-control" value="{{ is_array($filter) && isset($filter['q']) ? $filter['q'] : '' }}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">{{ __('messages.products.f_tax_group') }}</label>
                    <select name="filter[tax_group]" id="" class="form-control">
                        <option value=""></option>
                        @foreach(\App\TaxGroup::get() as $item)
                            <option value="{{ $item->id }}" @if(is_array($filter) && isset($filter['category']) && $filter['category'] == $item->id) selected @endif>
                                @for($i = 0; $i < $item->depth; $i++) -- @endfor
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if (\App\Settings::getSettings()->multiple_cities)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('messages.products.f_city') }}</label>
                        <select name="filter[city]" id="cities" class="form-control">
                            <option value=""></option>
                            @foreach(\App\City::policyScope()->get() as $item)
                                <option value="{{ $item->id }}" @if(is_array($filter) && isset($filter['city']) && $filter['city'] == $item->id) selected @endif>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            @if (\App\Settings::getSettings()->multiple_restaurants)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('messages.products.f_restaurant') }}</label>
                        <select name="filter[restaurant]" id="restaurants" class="form-control">
                            <option value=""></option>
                            @foreach(\App\Restaurant::policyScope()->get() as $item)
                                <option data-city="{{ $item->city_id }}" value="{{ $item->id }}" @if(is_array($filter) && isset($filter['restaurant']) && $filter['restaurant'] == $item->id) selected @endif>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">{{ __('messages.products.f_category') }}</label>
                    <select name="filter[category]" id="categories" class="form-control">
                        <option value=""></option>
                        @foreach(\App\Category::policyScope()->get() as $item)
                            <option data-city="{{ $item->city_id }}" data-restaurant="{{ $item->restaurant_id }}" value="{{ $item->id }}" @if(is_array($filter) && isset($filter['category']) && $filter['category'] == $item->id) selected @endif>
                                @for($i = 0; $i < $item->depth; $i++) -- @endfor
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button class="btn btn-primary">{{ __('messages.actions.filter') }}</button>
        <a href="{{ route('products.index') }}" class="btn btn-default">{{ __('messages.actions.clear_filter') }}</a>
    </form>
    <br>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>{{__('messages.products.f_image')}}</th>
                <th>{{__('messages.products.f_name')}}</th>
                <th>{{__('messages.products.f_category')}}</th>
                <th>{{__('messages.products.f_price')}}</th>
                <th>{{__('messages.products.f_price_old')}}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>
                        @if ($item->productImages->count() > 0)
                            <img src="{{ $item->productImages->first()->image }}" alt="" class="img-responsive product-image-table">
                        @endif
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ \App\Settings::currency($item->price) }}</td>
                    <td>{{ \App\Settings::currency($item->price_old) }}</td>
                    <td>
                        @can('update', $item)
                            <a href="{{ route('products.edit', ['id' => $item->id]) }}" class="btn btn-info btn-xs">{{__('messages.actions.edit')}}</a>
                        @endcan
                        @can('delete', $item)
                            <form action="{{ route('products.destroy', ['id' => $item->id]) }}" class="inline-form" method="post">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="btn btn-danger btn-xs" type="submit">{{__('messages.actions.delete')}}</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $items->appends(['filter' => $filter])->links() }}
    @if (\App\Settings::getSettings()->multiple_cities || \App\Settings::getSettings()->multiple_restaurants)
        <script src="/custom_js/products.js"></script>
    @endif
@endsection