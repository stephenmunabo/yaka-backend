@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{ route('delivery_boys.create') }}">{{__('messages.delivery_boys.new')}}</a>
    <br>
    <br>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{{__('messages.delivery_boys.f_name')}}</th>
            <th>{{__('messages.delivery_boys.f_login')}}</th>
            <th>{{__('messages.delivery_boys.f_orders_count')}}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->login }}</td>
                <td>{{ $item->orders->count() }}</td>
                <td>
                    <a href="{{ route('delivery_boy_messages.index', ['filter' => ['delivery_boy_id' => $item->id]]) }}" class="btn btn-default btn-xs">{{__('messages.delivery_boys.messages')}}</a>
                    <a href="{{ route('delivery_boys.edit', ['id' => $item->id]) }}" class="btn btn-info btn-xs">{{__('messages.actions.edit')}}</a>
                    <form action="{{ route('delivery_boys.destroy', ['id' => $item->id]) }}" class="inline-form" method="post">
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