@extends('layouts.app')

@section('content')
    <form method="post" action="@if ($item->id == null) {{ route('tax_groups.store') }} @else {{ route('tax_groups.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.tax_groups.f_name')}}</label>
            <input type="text" class="form-control" value="{{$item->name}}" name="name"/>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('value') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.tax_groups.f_value')}}</label>
            <input type="text" class="form-control" value="{{$item->value}}" name="value"/>
            @if ($errors->has('value'))
                <span class="help-block">
                    <strong>{{ $errors->first('value') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input value="1" type="checkbox" name="is_default" @if ($item->is_default) checked @endif>
                    {{__('messages.tax_groups.f_is_default')}}
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
    </form>
@endsection