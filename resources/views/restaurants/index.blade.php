@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{ route('restaurants.create') }}">{{__('messages.restaurants.new')}}</a>
    <br>
    <br>
    <form action="{{ route('restaurants.index') }}" method="get">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">{{ __('messages.restaurants.filter_text') }}</label>
                    <input name="filter[q]" type="text" class="form-control" value="{{ is_array($filter) && isset($filter['q']) ? $filter['q'] : '' }}">
                </div>
            </div>
            @if (\App\Settings::getSettings()->multiple_cities)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label">{{ __('messages.restaurants.f_city') }}</label>
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
        <a href="{{ route('restaurants.index') }}" class="btn btn-default">{{ __('messages.actions.clear_filter') }}</a>
    </form>
    <br>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>{{__('messages.restaurants.f_image')}}</th>
                <th>{{__('messages.restaurants.f_name')}}</th>
                @if (\App\Settings::getSettings()->multiple_cities)
                    <th>{{__('messages.restaurants.f_city')}}</th>
                @endif
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>
                        @if (!empty($item->image))
                            <img src="{{ $item->image }}" alt="" class="img-responsive product-image-table">
                        @endif
                    </td>
                    <td>{{ $item->name }}</td>
                    @if (\App\Settings::getSettings()->multiple_cities)
                        <td>{{ $item->city == null ? '' : $item->city->name }}</td>
                    @endif
                    <td>
                        <a href="{{ route('restaurants.edit', ['id' => $item->id]) }}" class="btn btn-info btn-xs">{{__('messages.actions.edit')}}</a>
                        <form action="{{ route('restaurants.destroy', ['id' => $item->id]) }}" class="inline-form" method="post">
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