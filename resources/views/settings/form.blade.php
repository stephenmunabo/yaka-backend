@extends('layouts.app')

@section('content')
    <form method="post" action="@if ($item->id == null) {{ route('settings.store') }} @else {{ route('settings.update', ['id' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">{{ __('messages.settings.general') }}</a>
            </li>
            <li role="presentation">
                <a href="#push" aria-controls="profile" role="tab" data-toggle="tab">{{ __('messages.settings.push') }}</a>
            </li>
            <li role="presentation">
                <a href="#payment" aria-controls="profile" role="tab" data-toggle="tab">{{ __('messages.settings.payment') }}</a>
            </li>
            <li role="presentation">
                <a href="#layout" aria-controls="profile" role="tab" data-toggle="tab">{{ __('messages.settings.layout') }}</a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <h3>{{ __('messages.settings.general') }}</h3>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('currency_format') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_currency_format')}}</label>
                            <input type="text" class="form-control" value="{{$item->currency_format}}" name="currency_format"/>
                            @if ($errors->has('currency_format'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('currency_format') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="control-label">&nbsp;</label>
                            <div class="checkbox">
                                <label>
                                    <input value="1" type="checkbox" name="tax_included" @if ($item->tax_included) checked @endif>
                                    {{__('messages.settings.f_tax_included')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('time_format_backend') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_time_format_backend')}}</label>
                            <input type="text" class="form-control" value="{{$item->time_format_backend}}" name="time_format_backend"/>
                            @if ($errors->has('time_format_backend'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('time_format_backend') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('time_format_app') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_time_format_app')}}</label>
                            <input type="text" class="form-control" value="{{$item->time_format_app}}" name="time_format_app"/>
                            @if ($errors->has('time_format_app'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('time_format_app') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('date_format') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_date_format')}}</label>
                            <input type="text" class="form-control" value="{{$item->date_format}}" name="date_format"/>
                            @if ($errors->has('date_format'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('date_format') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('date_format_app') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_date_format_app')}}</label>
                            <input type="text" class="form-control" value="{{$item->date_format_app}}" name="date_format_app"/>
                            @if ($errors->has('date_format_app'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('date_format_app') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="control-label">&nbsp;</label>
                            <div class="checkbox">
                                <label>
                                    <input value="1" type="checkbox" name="signup_required" @if ($item->signup_required) checked @endif>
                                    {{__('messages.settings.f_signup_required')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <h3>{{ __('messages.settings.multi_location') }}</h3>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="control-label">&nbsp;</label>
                            <div class="checkbox">
                                <label>
                                    <input value="1" type="checkbox" name="multiple_restaurants" @if ($item->multiple_restaurants) checked @endif>
                                    {{__('messages.settings.f_multiple_restaurants')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="control-label">&nbsp;</label>
                            <div class="checkbox">
                                <label>
                                    <input value="1" type="checkbox" name="multiple_cities" @if ($item->multiple_cities) checked @endif>
                                    {{__('messages.settings.f_multiple_cities')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>{{ __('messages.settings.notifications') }}</h3>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('notification_email') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_notification_email')}}</label>
                            <input type="text" class="form-control" value="{{$item->notification_email}}" name="notification_email"/>
                            @if ($errors->has('notification_email'))
                                <span class="help-block">
                            <strong>{{ $errors->first('notification_email') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('mail_from_new_order_subject') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_mail_from_new_order_subject')}}</label>
                            <input type="text" class="form-control" value="{{$item->mail_from_new_order_subject}}" name="mail_from_new_order_subject"/>
                            @if ($errors->has('mail_from_new_order_subject'))
                                <span class="help-block">
                            <strong>{{ $errors->first('mail_from_new_order_subject') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('mail_from_name') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_mail_from_name')}}</label>
                            <input type="text" class="form-control" value="{{$item->mail_from_name}}" name="mail_from_name"/>
                            @if ($errors->has('mail_from_name'))
                                <span class="help-block">
                            <strong>{{ $errors->first('mail_from_name') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('mail_from_mail') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_mail_from_mail')}}</label>
                            <input type="text" class="form-control" value="{{$item->mail_from_mail}}" name="mail_from_mail"/>
                            @if ($errors->has('mail_from_mail'))
                                <span class="help-block">
                            <strong>{{ $errors->first('mail_from_mail') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div role="tabpanel" class="tab-pane" id="push">
                <h3>{{ __('messages.settings.push') }}</h3>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('pushwoosh_id') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_pushwoosh_id')}}</label>
                            <input type="text" class="form-control" value="{{$item->pushwoosh_id}}" name="pushwoosh_id"/>
                            @if ($errors->has('pushwoosh_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pushwoosh_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('pushwoosh_token') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_pushwoosh_token')}}</label>
                            <input type="text" class="form-control" value="{{$item->pushwoosh_token}}" name="pushwoosh_token"/>
                            @if ($errors->has('pushwoosh_token'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pushwoosh_token') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('driver_onesignal_id') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_driver_onesignal_id')}}</label>
                            <input type="text" class="form-control" value="{{$item->driver_onesignal_id}}" name="driver_onesignal_id"/>
                            @if ($errors->has('driver_onesignal_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('driver_onesignal_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('driver_onesignal_token') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_driver_onesignal_token')}}</label>
                            <input type="text" class="form-control" value="{{$item->driver_onesignal_token}}" name="driver_onesignal_token"/>
                            @if ($errors->has('driver_onesignal_token'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('driver_onesignal_token') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="payment">
                <h3>{{ __('messages.settings.stripe') }}</h3>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('stripe_publishable') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_stripe_publishable')}}</label>
                            <input type="text" class="form-control" value="{{$item->stripe_publishable}}" name="stripe_publishable"/>
                            @if ($errors->has('stripe_publishable'))
                                <span class="help-block">
                        <strong>{{ $errors->first('stripe_publishable') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('stripe_private') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_stripe_private')}}</label>
                            <input type="text" class="form-control" value="{{$item->stripe_private}}" name="stripe_private"/>
                            @if ($errors->has('stripe_private'))
                                <span class="help-block">
                        <strong>{{ $errors->first('stripe_private') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>
                </div>

                <h3>{{ __('messages.settings.paypal') }}</h3>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('paypal_client_id') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_paypal_client_id')}}</label>
                            <input type="text" class="form-control" value="{{$item->paypal_client_id}}" name="paypal_client_id"/>
                            @if ($errors->has('paypal_client_id'))
                                <span class="help-block">
                        <strong>{{ $errors->first('paypal_client_id') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('paypal_client_secret') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_paypal_client_secret')}}</label>
                            <input type="text" class="form-control" value="{{$item->paypal_client_secret}}" name="paypal_client_secret"/>
                            @if ($errors->has('paypal_client_secret'))
                                <span class="help-block">
                        <strong>{{ $errors->first('paypal_client_secret') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('paypal_currency') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_paypal_currency')}}</label>
                            <input type="text" class="form-control" value="{{$item->paypal_currency}}" name="paypal_currency"/>
                            @if ($errors->has('paypal_currency'))
                                <span class="help-block">
                        <strong>{{ $errors->first('paypal_currency') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="" class="control-label">&nbsp;</label>
                            <div class="checkbox">
                                <label>
                                    <input value="1" type="checkbox" name="paypal_production" @if ($item->paypal_production) checked @endif>
                                    {{__('messages.settings.f_paypal_production')}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div role="tabpanel" class="tab-pane" id="layout">
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('products_layout') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_product_layout')}}</label>
                            <select name="products_layout" class="form-control">
                                <option value="0" @if ($item->products_layout == 0) selected @endif>{{__('messages.settings.product_layout_1')}}</option>
                                <option value="1" @if ($item->products_layout == 1) selected @endif>{{__('messages.settings.product_layout_2')}}</option>
                                <option value="2" @if ($item->products_layout == 2) selected @endif>{{__('messages.settings.product_layout_3')}}</option>
                            </select>
                            @if ($errors->has('products_layout'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('products_layout') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('categories_layout') ? ' has-error' : '' }}">
                            <label for="" class="control-label">{{__('messages.settings.f_category_layout')}}</label>
                            <select name="categories_layout" class="form-control">
                                <option value="0" @if ($item->categories_layout == 0) selected @endif>{{__('messages.settings.category_layout_1')}}</option>
                                <option value="1" @if ($item->categories_layout == 1) selected @endif>{{__('messages.settings.category_layout_2')}}</option>
                            </select>
                            @if ($errors->has('categories_layout'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('categories_layout') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">{{__('messages.actions.save')}}</button>
    </form>
@endsection