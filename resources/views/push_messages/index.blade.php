@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{ route('push_messages.create') }}">{{__('messages.push_messages.new')}}</a>
    <br>
    <br>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{{__('messages.push_messages.f_message')}}</th>
            <th>{{__('messages.push_messages.f_created_at')}}</th>
            <th>{{__('messages.push_messages.f_status')}}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->message }}</td>
                <td>{{ $item->created_at->format(\App\Settings::getSettings()->time_format_backend) }}</td>
                <td>{{ __('messages.push_messages.status')[$item->status] }}</td>
                <td>{{ $item->error }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $items->appends(['filter' => $filter])->links() }} 
@endsection