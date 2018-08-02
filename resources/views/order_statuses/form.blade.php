@extends('layouts.app')

@section('content')
    <form method="post" action="@if ($item->id == null) {{ route('order_statuses.store') }} @else {{ route('order_statuses.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.order_statuses.f_name')}}</label>
            <input type="text" class="form-control" value="{{$item->name}}" name="name"/>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('sort') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.order_statuses.f_sort')}}</label>
            <input type="text" class="form-control" value="{{$item->sort}}" name="sort"/>
            @if ($errors->has('sort'))
                <span class="help-block">
                    <strong>{{ $errors->first('sort') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input value="1" type="checkbox" name="is_default" @if ($item->is_default) checked @endif>
                    {{__('messages.order_statuses.f_is_default')}}
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input value="1" type="checkbox" name="available_to_delivery_boy" @if ($item->available_to_delivery_boy) checked @endif>
                    {{__('messages.order_statuses.f_available_to_delivery_boy')}}
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
    </form>
@endsection