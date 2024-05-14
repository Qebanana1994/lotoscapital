@extends('admin.layouts.app')

@section('panel')
    @if (@json_decode($general->system_info)->version > systemDetails()['version'])
        <div class="row">
            <div class="col-md-12">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">
                        <h3 class="card-title"> @lang('New Version Available') <button class="btn btn--dark float-end">@lang('Version') {{ json_decode($general->system_info)->version }}</button> </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-dark">@lang('What is the Update?')</h5>
                        <p>
                            <pre class="f-size--24">{{ json_decode($general->system_info)->details }}</pre>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (@json_decode($general->system_info)->message)
        <div class="row">
            @foreach (json_decode($general->system_info)->message as $msg)
                <div class="col-md-12">
                    <div class="alert border border--primary" role="alert">
                        <div class="alert__icon bg--primary">
                            <i class="far fa-bell"></i>
                            <p class="alert__message">@php echo $msg; @endphp</p>
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($isHoliday)
        <div class="alert border border--primary" role="alert">
            <div class="alert__icon bg--primary d-flex align-items-center"><i class="far fa-bell"></i></div>
            <p class="alert__message">
                <span class="fw-bold">@lang('Today is holiday')</span><br>
                <small><i>@lang('No interest will be provided today.') @if (!$general->holiday_withdraw)
                            @lang('Also withdrawal requests is disable for today.')
                        @endif @lang('The next working is') {{ $nextWorkingDay }}</i></small>
            </p>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="las la-times"></i></span>
            </button>
        </div>
    @endif

    @if (!$general->registration)
        <div class="alert border border--info" role="alert">
            <div class="alert__icon bg--info d-flex align-items-center"><i class="far fa-bell"></i></div>
            <p class="alert__message">
                <span class="fw-bold">@lang('User registration module is disable')</span><br>
                <small><i>@lang('No one can be registered to this system due to disabling the registration module')</i></small>
            </p>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="las la-times"></i></span>
            </button>
        </div>
    @endif

    <div class="row gy-4"> 
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ route('admin.deposit.list') }}" icon="fas fa-hand-holding-usd" icon_style="false" title="Пополнено" value="{{ showAmount($deposit['total_deposit_amount']/100*93) }} {{ $general->cur_sym }}" color="success" />
        </div>
        <div class="col-xxl-3 col-sm-6">
        <x-widget style="2" link="{{ route('admin.withdraw.log') }}" icon="lar la-credit-card" title="Выплачено" value="{{ showAmount($withdrawals['total_withdraw_amount']) }} {{ $general->cur_sym }}" color="danger" />
        </div>
            <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" icon="lar la-credit-card" icon_style="false" title="Примерный баланс" value="{{ showAmount($deposit['total_deposit_amount']/100*93-$withdrawals['total_withdraw_amount']) }} {{ $general->cur_sym }}" color="success" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" icon="fas fa-user" icon_style="false" title="Общее кол-во пользователей" value="{{ $widget['total_users']  }} / {{ $deposit['total_active_users'] }} ({{ $percent_active_users }})" color="success" />
        </div>

    </div><!-- row end-->

    <div class="row gy-4 mt-2">
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ route('admin.deposit.pending') }}" icon="fas fa-spinner" icon_style="false" title="Pending Deposits" value="{{ $deposit['total_deposit_pending'] }}" color="warning" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ route('admin.deposit.rejected') }}" icon="fas fa-ban" icon_style="false" title="Rejected Deposits" value="{{ $deposit['total_deposit_rejected'] }}" color="danger" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ route('admin.withdraw.pending') }}" icon="las la-sync" title="Pending Withdrawals" value="{{ $withdrawals['total_withdraw_pending'] }}" color="warning" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ route('admin.withdraw.rejected') }}" icon="las la-times-circle" title="Rejected Withdrawals" value="{{ $withdrawals['total_withdraw_rejected'] }}" color="danger" />
        </div>
    </div><!-- row end--><!--
    <div class="row gy-4 mt-2">
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ route('admin.withdraw.log') }}" icon="lar la-credit-card" title="Total Withdrawal" value="{{ $general->cur_sym }}{{ showAmount($withdrawals['total_withdraw_amount']) }}" color="success" />
        </div>
        
        
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="2" link="{{ route('admin.withdraw.log') }}" icon="las la-percent" title="Withdrawal Charge" value="{{ $general->cur_sym }}{{ showAmount($withdrawals['total_withdraw_charge']) }}" color="primary" />
        </div>
    </div>

    <div class="row gy-4 mt-2">
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="3" link="{{ route('admin.report.invest.history') }}" icon="las la-chart-bar" title="Total Investment" value="{{ $general->cur_sym }}{{ showAmount($invest['invests']) }}" bg="primary" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="3" link="{{ route('admin.report.transaction') }}?remark=interest" icon="las la-chart-pie" title="Total Interest" value="{{ $general->cur_sym }}{{ showAmount($invest['interests']) }}" bg="1" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="3" link="{{ route('admin.report.invest.history') }}?status=1" icon="las la-chart-area" title="Active Investments" value="{{ $general->cur_sym }}{{ showAmount($invest['active_invests']) }}" bg="14" />
        </div>
        <div class="col-xxl-3 col-sm-6">
            <x-widget style="3" link="{{ route('admin.report.invest.history') }}?status=0" icon="las la-chart-line" title="Closed Investments" value="{{ $general->cur_sym }}{{ showAmount($invest['closed_invests']) }}" bg="19" />
        </div>
    </div> -->

    <div class="row mb-none-30 mt-30">
        <div class="col-xl-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">@lang('Transactions Report') (@lang('Last 30 Days'))</h5>
                    <div id="apex-line"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-none-30 mt-30">
        <div class="col-xl-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Регистрации пользователей за последние 30 дней</h5>
                    <div id="apex-line-users"></div>
                </div>
            </div>
        </div>
    </div>

    @php
        $lastCron = Carbon\Carbon::parse($general->last_cron)->diffInSeconds();
    @endphp

    @if ($lastCron >= 900)
        @include('admin.partials.cron')
    @endif

@endsection

@push('breadcrumb-plugins')
    <span class="{{ $lastCron >= 900 ? 'text--danger' : 'text--primary' }}">@lang('Last Cron Run:')
        <strong>{{ diffForHumans($general->last_cron) }}</strong>
    </span>
@endpush

@push('script')
    <script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/chart.js.2.8.0.js') }}"></script>

    <script>
        "use strict";
        // apex-line chart
        var options = {
            chart: {
                height: 450,
                type: "area",
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    enabledSeries: [0],
                    top: -2,
                    left: 0,
                    blur: 10,
                    opacity: 0.08
                },
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                    name: "Пополнения {{ $general->cur_sym }}",
                    data: [
                        @foreach($moneyDates['date'] as $moneyDate)
                                {{ $deposit['total_successful_deposits']->where('date', $moneyDate)->first()->amount ?? 0 }},
                        @endforeach
{{--                        @foreach ($trxReport['date'] as $trxDate)--}}
{{--                            {{ @$plusTrx->where('date', $trxDate)->first()->amount ?? 0 }},--}}
{{--                        @endforeach--}}
                    ]
                },
                {
                    name: "Списания {{ $general->cur_sym }}",
                    data: [
                        @foreach($moneyDates['date'] as $moneyDate)
                                {{ $withdrawals['total_successful_withdrawals']->where('date', $moneyDate)->first()->amount ?? 0 }},
                        @endforeach
{{--                        @foreach ($trxReport['date'] as $trxDate)--}}
{{--                            {{ @$minusTrx->where('date', $trxDate)->first()->amount ?? 0 }},--}}
{{--                        @endforeach--}}
                    ]
                },
                {
                    name: "Баланс <b>{{ $general->cur_sym }}</b>",
                    data: [
                        @foreach ($moneyDates['date'] as $moneyDate)
                                {{ ($deposit['total_successful_deposits']->where('date', $moneyDate)->first()->amount ?? 0) - ($withdrawals['total_successful_withdrawals']->where('date', $moneyDate)->first()->amount ?? 0) }},
                        @endforeach
{{--                        @foreach ($trxReport['date'] as $trxDate)--}}
{{--                            {{ (@$plusTrx->where('date', $trxDate)->first()->amount ?? 0) - (@$minusTrx->where('date', $trxDate)->first()->amount ?? 0) }},--}}
{{--                        @endforeach--}}
                    ]
                }
            ],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: [
                    @foreach($moneyDates['date'] as $moneyDate)
                        "{{ $moneyDate }}",
                    @endforeach
{{--                    @foreach ($trxReport['date'] as $trxDate)--}}
{{--                        "{{ $trxDate }}",--}}
{{--                    @endforeach--}}
                ]
            },
            tooltip: {
                enabled: true,
                y: {
                    show: true,
                    formatter: function (value) {
                        // Форматирование значения с пробелом-разделителем
                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                    },
                },
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5
                },
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#apex-line"), options);

        chart.render();


        // apex-line chart
        var options = {
            chart: {
                height: 450,
                type: "area",
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    enabledSeries: [0],
                    top: -2,
                    left: 0,
                    blur: 10,
                    opacity: 0.08
                },
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
            },
            dataLabels: {
                enabled: false
            },
            tooltip: {
                enabled: true,
                y: {
                    show: true,
                    formatter: function (value) {
                        // Форматирование значения с пробелом-разделителем
                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                    },
                },
            },
            series: [{
                name: "Регистрации",
                data: [
                    @foreach ($monthUser['date'] as $userDate)
                        {{ @$monthUsers->where('date', $userDate)->first()->count ?? 0 }},
                    @endforeach
                ]
            }

            ],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: [
                    @foreach ($monthUser['date'] as $userDate)
                        "{{ $userDate }}",
                    @endforeach
                ]
            },
            grid: {
                padding: {
                    left: 5,
                    right: 5
                },
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#apex-line-users"), options);

        chart.render();
    </script>
@endpush
