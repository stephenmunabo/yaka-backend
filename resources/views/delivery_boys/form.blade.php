@extends('layouts.app')

@section('content')
    <form method="post" action="@if ($item->id == null) {{ route('delivery_boys.store') }} @else {{ route('delivery_boys.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.delivery_boys.f_name')}}</label>
            <input type="text" class="form-control" value="{{$item->name}}" name="name"/>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('login') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.delivery_boys.f_login')}}</label>
            <input type="text" class="form-control" value="{{$item->login}}" name="login"/>
            @if ($errors->has('login'))
                <span class="help-block">
                    <strong>{{ $errors->first('login') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.delivery_boys.f_password')}}</label>
            <input type="password" class="form-control" name="password"/>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.delivery_boys.f_password_confirmation')}}</label>
            <input type="password" class="form-control" name="password_confirmation"/>
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
    </form>
@endsection