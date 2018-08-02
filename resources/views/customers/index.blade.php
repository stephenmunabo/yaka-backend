@extends('layouts.app')

@section('content')
    <form action="{{ route('customers.index') }}" method="get">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">{{ __('messages.customers.filter_text') }}</label>
                    <input name="filter[q]" type="text" class="form-control" value="{{ is_array($filter) && isset($filter['q']) ? $filter['q'] : '' }}">
                </div>
            </div>
            @if (\App\Settings::getSettings()->multiple_cities)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('messages.customers.f_city') }}</label>
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
        </div>
        <button class="btn btn-primary">{{ __('messages.actions.filter') }}</button>
        <a href="{{ route('customers.index') }}" class="btn btn-default">{{ __('messages.actions.clear_filter') }}</a>
    </form>
    <br>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>{{__('messages.customers.f_name')}}</th>
                <th>{{__('messages.customers.f_email')}}</th>
                <th>{{__('messages.customers.f_phone')}}</th>
                @if (\App\Settings::getSettings()->multiple_cities)
                    <th>{{__('messages.customers.f_city')}}</th>
                @endif
                <th>{{__('messages.customers.f_orders_count')}}</th>
                <th>{{__('messages.customers.f_orders_sum')}}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    @if (\App\Settings::getSettings()->multiple_cities)
                        <td>
                            @if ($item->city != null)
                                {{ $item->city->name }}
                            @endif
                        </td>
                    @endif
                    <td>{{ $item->orders->count() }}</td>
                    <td>{{ \App\Settings::currency($item->orders()->sum('total_with_tax')) }}</td>
                    @can ('create', App\Order::class)
                        <td>
                            <a href="{{ route('orders.index', ['filter' => ['customer_id' => $item->id]]) }}" class="btn btn-primary">{{ __('messages.customers.orders_list') }}</a>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $items->appends(['filter' => $filter])->links() }} 
@endsection