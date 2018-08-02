@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{ route('delivery_boy_messages.create', ['filter' => ['delivery_boy_id' => $delivery_boy_id]]) }}">{{__('messages.delivery_boy_messages.new')}}</a>
    <br>
    <br>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{{__('messages.delivery_boy_messages.f_read')}}</th>
            <th>{{__('messages.delivery_boy_messages.f_message')}}</th>
            <th>{{__('messages.delivery_boy_messages.f_created_at')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>
                    @if ($item->read)
                        <span class="label label-success">{{ __('messages.common.yes') }}</span>
                    @else
                        <span class="label label-default">{{ __('messages.common.no') }}</span>
                    @endif
                </td>
                <td>{{ $item->message }}</td>
                <td>{{ $item->created_at->format(\App\Settings::getSettings()->time_format_backend) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $items->appends(['filter' => $filter])->links() }} 
@endsection