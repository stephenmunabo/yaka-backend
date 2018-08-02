@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{ route('categories.create') }}">{{__('messages.categories.new')}}</a>
    <br>
    <br>
    <form action="{{ route('categories.index') }}" method="get">
        <div class="row">
            @if (\App\Settings::getSettings()->multiple_cities)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('messages.categories.f_city') }}</label>
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
            @if (\App\Settings::getSettings()->multiple_restaurants)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('messages.categories.f_restaurant') }}</label>
                        <select name="filter[restaurant_id]" id="" class="form-control">
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
        <button class="btn btn-primary">{{ __('messages.actions.filter') }}</button>
        <a href="{{ route('categories.index') }}" class="btn btn-default">{{ __('messages.actions.clear_filter') }}</a>
    </form>
    <br>
    @foreach($items as $item)
        <div class="tree-item" style="margin-left: {{ 30 * $item->depth }}px;">
            {{ $item->name }}
            <div class="pull-right">
                @can('update', $item)
                    <a href="{{ route('categories.edit', ['id' => $item->id]) }}" class="btn btn-info btn-xs">{{__('messages.actions.edit')}}</a>
                @endcan
                @can('delete', $item)
                    <form action="{{ route('categories.destroy', ['id' => $item->id]) }}" class="inline-form" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-xs" type="submit">{{__('messages.actions.delete')}}</button>
                    </form>
                @endcan
            </div>
        </div>
    @endforeach
    {{ $items->appends(['filter' => $filter])->links() }}
@endsection