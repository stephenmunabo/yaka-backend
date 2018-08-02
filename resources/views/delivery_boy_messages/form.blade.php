@extends('layouts.app')

@section('content')
    <form method="post" action="@if ($item->id == null) {{ route('delivery_boy_messages.store') }} @else {{ route('delivery_boy_messages.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif
        <input type="hidden" value="{{ $delivery_boy_id }}" name="delivery_boy_id">

        <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
            <label for="" class="control-label">{{__('messages.delivery_boy_messages.f_message')}}</label>
            <textarea name="message" class="form-control">{{ $item->message }}</textarea>
            @if ($errors->has('message'))
                <span class="help-block">
                    <strong>{{ $errors->first('message') }}</strong>
                </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
    </form>
@endsection