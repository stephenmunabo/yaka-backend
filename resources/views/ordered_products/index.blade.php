@extends('layouts.app')

@section('content')
    <h2>{{ __('messages.orders.products_title', ['id' => $order->id]) }}</h2>
    <a class="btn btn-primary" href="{{ route('ordered_products.create', ['order_id' => $order->id]) }}">{{__('messages.ordered_products.new')}}</a>
    <br>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th>{{__('messages.ordered_products.f_name')}}</th>
                <th>{{__('messages.ordered_products.f_price')}}</th>
                <th>{{__('messages.ordered_products.f_count')}}</th>
                <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>
                        @if ($item->product->productImages->count() > 0)
                            <img src="{{ $item->product->productImages->first()->image }}" alt="" class="img-responsive product-image-table">
                        @endif
                    </td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ \App\Settings::currency($item->product->price) }}</td>
                    <td>{{ $item->count }}</td>
                    <td>
                        <a href="{{ route('ordered_products.edit', ['id' => $item->id, 'order_id' => $item->order_id]) }}" class="btn btn-info btn-xs">{{__('messages.actions.edit')}}</a>
                        <form action="{{ route('ordered_products.destroy', ['id' => $item->id]) }}" class="inline-form" method="post">
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