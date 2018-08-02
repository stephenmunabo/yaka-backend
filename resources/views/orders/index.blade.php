@extends('layouts.app')

@section('content')
    <h2>{{ __('messages.orders.index_title') }}</h2>
    <a class="btn btn-primary" href="{{ route('orders.create') }}">{{__('messages.orders.new')}}</a>
    <br>
    <br>
    <form action="{{ route('orders.index') }}" method="get">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">{{ __('messages.orders.filter_text') }}</label>
                    <input name="filter[q]" type="text" class="form-control" value="{{ is_array($filter) && isset($filter['q']) ? $filter['q'] : '' }}">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">{{ __('messages.orders.f_created') }}</label>
                    <input name="filter[dt]" type="date" class="form-control" value="{{ is_array($filter) && isset($filter['dt']) ? $filter['dt'] : '' }}">
                </div>
            </div>
        </div>
        <div class="row">
            @if (\App\Settings::getSettings()->multiple_cities)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('messages.orders.f_city') }}</label>
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
                        <label class="control-label">{{ __('messages.orders.f_restaurant') }}</label>
                        <select name="filter[restaurant_id]" id="restaurants" class="form-control">
                            <option value=""></option>
                            @foreach(\App\Restaurant::policyScope()->get() as $item)
                                <option data-city="{{ $item->city_id }}" value="{{ $item->id }}" @if(is_array($filter) && isset($filter['restaurant_id']) && $filter['restaurant_id'] == $item->id) selected @endif>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">{{ __('messages.orders.f_status') }}</label>
                    <select name="filter[order_status_id]" class="form-control">
                        <option value=""></option>
                        @foreach(\App\OrderStatus::orderBy('sort', 'ASC')->get() as $item)
                            <option value="{{ $item->id }}" @if(is_array($filter) && isset($filter['order_status_id']) && $filter['order_status_id'] == $item->id) selected @endif>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button class="btn btn-primary">{{ __('messages.actions.filter') }}</button>
        <a href="{{ route('orders.index') }}" class="btn btn-default">{{ __('messages.actions.clear_filter') }}</a>
    </form>
    
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{{__('messages.orders.id') }}</th>
            <th>{{__('messages.orders.f_created')}}</th>
            <th>{{__('messages.orders.f_name')}}</th>
            <th>{{__('messages.orders.f_address')}}</th>
            <th>{{__('messages.orders.f_area')}}</th>
            <th>{{__('messages.orders.f_phone')}}</th>
            <th>{{__('messages.orders.f_promo_code')}}</th>
            <th>{{__('messages.orders.f_sum')}}</th>
            <th>{{__('messages.orders.f_payment_method')}}</th>
            <th>{{__('messages.orders.f_status')}}</th>
            <th>{{__('messages.orders.f_is_paid')}}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->created_at->format(\App\Settings::getSettings()->time_format_backend) }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->address }}</td>
                <td>
                    @if ($item->deliveryArea != null)
                        {{ $item->deliveryArea->name }}
                    @endif
                </td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->promo_code }}</td>
                <td>{{ \App\Settings::currency($item->total_with_tax + $item->delivery_price) }}</td>
                <td>{{ __('messages.orders.payment_methods')[$item->payment_method] }}</td>
                <td>
                    @if ($item->orderStatus != null)
                        {{ $item->orderStatus->name }}
                    @endif
                </td>
                <td>
                    @if ($item->is_paid)
                        <span class="label label-success">{{ __('messages.common.yes') }}</span>
                    @else
                        <span class="label label-default">{{ __('messages.common.no') }}</span>
                    @endif
                </td>
                <td>
                    @can('update', $item)
                        <a href="{{ route('orders.show', ['id' => $item->id]) }}" class="btn btn-success btn-xs">{{__('messages.actions.show')}}</a>
                        <a href="{{ route('orders.edit', ['id' => $item->id]) }}" class="btn btn-default btn-xs">{{__('messages.actions.edit')}}</a>
                    @endcan
                    @can('delete', $item)
                        <a href="{{ route('ordered_products.index', ['filter' => ['order_id' => $item->id]]) }}" class="btn btn-info btn-xs">{{__('messages.actions.edit_products')}}</a>
                    @endcan
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