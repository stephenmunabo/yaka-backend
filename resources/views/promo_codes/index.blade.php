@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{ route('promo_codes.create') }}">{{__('messages.promo_codes.new')}}</a>
    <br>
    <br>
    <form action="{{ route('promo_codes.index') }}" method="get">
        <div class="row">
            @if (\App\Settings::getSettings()->multiple_cities)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('messages.promo_codes.f_city') }}</label>
                        <select name="filter[city_id]" id="cities" class="form-control">
                            <option value=""></option>
                            @foreach(\App\City::policyScope()->get() as $item)
                                <option value="{{ $item->id }}" @if(is_array($filter) && isset($filter['city_id']) && $filter['city_id'] == $item->id) selected @endif>
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
                        <label class="control-label">{{ __('messages.promo_codes.f_restaurant') }}</label>
                        <select name="filter[restaurant_id]" id="restaurants" class="form-control">
                            <option value=""></option>
                            @foreach(\App\Restaurant::policyScope() as $item)
                                <option data-city="{{ $item->city_id }}" value="{{ $item->id }}" @if(is_array($filter) && isset($filter['restaurant_id']) && $filter['restaurant_id'] == $item->id) selected @endif>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>
        <button class="btn btn-primary">{{ __('messages.actions.filter') }}</button>
        <a href="{{ route('promo_codes.index') }}" class="btn btn-default">{{ __('messages.actions.clear_filter') }}</a>
    </form>
    <br>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{{__('messages.promo_codes.f_name')}}</th>
            <th>{{__('messages.promo_codes.f_code')}}</th>
            <th>{{__('messages.promo_codes.f_discount')}}</th>
            <th>{{__('messages.promo_codes.f_limit')}}</th>
            <th>{{__('messages.promo_codes.f_used')}}</th>
            <th>{{__('messages.promo_codes.f_min_price')}}</th>
            <th>{{__('messages.promo_codes.f_active_from')}}</th>
            <th>{{__('messages.promo_codes.f_active_to')}}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->code }}</td>
                <td>
                    {{ $item->discount }}@if ($item->discount_in_percent)% @endif
                </td>
                <td>{{ $item->limit_use_count }}</td>
                <td>{{ $item->times_used }}</td>
                <td>
                    {{ \App\Settings::currency($item->min_price) }}
                </td>
                <td>
                    {{ $item->active_from->format(\App\Settings::getSettings()->time_format_backend) }}
                </td>
                <td>
                    @if ($item->active_to != null)
                        {{ $item->active_to->format(\App\Settings::getSettings()->time_format_backend) }}
                    @endif
                </td>
                <td>
                    <a href="{{ route('promo_codes.edit', ['id' => $item->id]) }}" class="btn btn-info btn-xs">{{__('messages.actions.edit')}}</a>
                    <form action="{{ route('promo_codes.destroy', ['id' => $item->id]) }}" class="inline-form" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-xs" type="submit">{{__('messages.actions.delete')}}</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $items->appends(['filter' => $filter])->links() }}
    @if (\App\Settings::getSettings()->multiple_restaurants || \App\Settings::getSettings()->multiple_cities)
        <script src="/custom_js/products.js"></script>
    @endif
@endsection