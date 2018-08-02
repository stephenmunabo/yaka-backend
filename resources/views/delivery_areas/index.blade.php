@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{ route('delivery_areas.create') }}">{{__('messages.delivery_areas.new')}}</a>
    <br>
    <br>
    <form action="{{ route('delivery_areas.index') }}" method="get">
        <div class="row">
            @if (\App\Settings::getSettings()->multiple_cities)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('messages.delivery_areas.f_city') }}</label>
                        <select name="filter[city_id]" id="" class="form-control">
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
        </div>
        <button class="btn btn-primary">{{ __('messages.actions.filter') }}</button>
        <a href="{{ route('delivery_areas.index') }}" class="btn btn-default">{{ __('messages.actions.clear_filter') }}</a>
    </form>
    <br>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{{__('messages.delivery_areas.f_name')}}</th>
            <th>{{__('messages.delivery_areas.f_price')}}</th>
            @if (\App\Settings::getSettings()->multiple_cities)
                <th>{{ __('messages.delivery_areas.f_city') }}</th>
            @endif
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ \App\Settings::currency($item->price) }}</td>
                @if (\App\Settings::getSettings()->multiple_cities)
                    <td>
                        @if ($item->city != null)
                            {{ $item->city->name }}
                        @endif
                    </td>
                @endif
                <td>
                    <a href="{{ route('delivery_areas.edit', ['id' => $item->id]) }}" class="btn btn-info btn-xs">{{__('messages.actions.edit')}}</a>
                    <form action="{{ route('delivery_areas.destroy', ['id' => $item->id]) }}" class="inline-form" method="post">
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
@endsection