@extends('layouts.app')

@section('content')
	<h1>{{ __('messages.dashboard.title') }}</h1>
	<br>
	<form action="{{ route('home') }}" method="get">
		<select name="range" id="range" class="form-control">
			<option @if ($range == 'today') selected @endif value="today">{{ __('messages.dashboard.today') }}</option>
			<option @if ($range == 'yesterday') selected @endif value="yesterday">{{ __('messages.dashboard.yesterday') }}</option>
			<option @if ($range == 'this_month') selected @endif value="this_month">{{ __('messages.dashboard.this_month') }}</option>
			<option @if ($range == 'last_month') selected @endif value="last_month">{{ __('messages.dashboard.last_month') }}</option>
		</select>
	</form>
	<br>
	<div class="row">
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">{{ __('messages.dashboard.sales') }}</div>
				<div class="panel-body">
					<h2 class="text-center">{{ \App\Settings::currency($orders_sum) }}</h2>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">{{ __('messages.dashboard.bills') }}</div>
				<div class="panel-body">
					<h2 class="text-center">{{ $orders_count }}</h2>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">{{ __('messages.dashboard.users') }}</div>
				<div class="panel-body">
					<h2 class="text-center">{{ $new_customers }}</h2>
				</div>
			</div>
		</div>
	</div>
	@if ($range != 'today' && $range != 'yesterday')
	    <div class="panel panel-default">
	        <div class="panel-heading">{{ __('messages.dashboard.sales_int') }}</div>

	        <div class="panel-body">
	            <canvas id="myChart" width="400" height="400"></canvas>
	        </div>
	    </div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
		<script>
			$(document).ready(function() {
				var ctx = document.getElementById("myChart").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: {!! json_encode($days_stats['days']) !!},
						datasets: [{
							label: " ",
							data: {!! json_encode($days_stats['sums']) !!},
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
								}
							}]
						}
					}
				});
			});
		</script>
	@endif
	<script>
		$(document).ready(function () {
			$('#range').change(function () {
				$(this).parents('form').submit();
			});
		});
	</script>
@endsection
