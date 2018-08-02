@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{ route('cities.create') }}">{{__('messages.cities.new')}}</a>
    <br>
    <br>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>{{__('messages.cities.f_name')}}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>
                        <a href="{{ route('cities.edit', ['id' => $item->id]) }}" class="btn btn-info btn-xs">{{__('messages.actions.edit')}}</a>
                        <form action="{{ route('cities.destroy', ['id' => $item->id]) }}" class="inline-form" method="post">
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