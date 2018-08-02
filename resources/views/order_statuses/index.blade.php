@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{ route('order_statuses.create') }}">{{__('messages.order_statuses.new')}}</a>
    <br>
    <br>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>{{__('messages.order_statuses.f_name')}}</th>
                <th>{{__('messages.order_statuses.f_is_default')}}</th>
                <th>{{__('messages.order_statuses.f_available_to_delivery_boy')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>
                        @if ($item->is_default)
                            <span class="label label-success">{{ __('messages.common.yes') }}</span>
                        @else
                            <span class="label label-default">{{ __('messages.common.no') }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($item->available_to_delivery_boy)
                            <span class="label label-success">{{ __('messages.common.yes') }}</span>
                        @else
                            <span class="label label-default">{{ __('messages.common.no') }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('order_statuses.edit', ['id' => $item->id]) }}" class="btn btn-info btn-xs">{{__('messages.actions.edit')}}</a>
                        <form action="{{ route('order_statuses.destroy', ['id' => $item->id]) }}" class="inline-form" method="post">
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