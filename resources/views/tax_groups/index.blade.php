@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{ route('tax_groups.create') }}">{{__('messages.tax_groups.new')}}</a>
    <br>
    <br>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{{__('messages.tax_groups.f_name')}}</th>
            <th>{{__('messages.tax_groups.f_value')}}</th>
            <th>{{__('messages.tax_groups.f_is_default')}}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->value }}</td>
                <td>
                    @if ($item->is_default)
                        <span class="label label-success">{{ __('messages.common.yes') }}</span>
                    @else
                        <span class="label label-default">{{ __('messages.common.no') }}</span>
                    @endif
                </td>
                <td>
                    @can('update', $item)
                        <a href="{{ route('tax_groups.edit', ['id' => $item->id]) }}" class="btn btn-info btn-xs">{{__('messages.actions.edit')}}</a>
                    @endcan
                    @can('delete', $item)
                        <form action="{{ route('tax_groups.destroy', ['id' => $item->id]) }}" class="inline-form" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-xs" type="submit">{{__('messages.actions.delete')}}</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $items->appends(['filter' => $filter])->links() }}
@endsection