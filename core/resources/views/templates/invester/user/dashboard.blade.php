@extends($activeTemplate.'layouts.master')
@section('content')

    <div class="dashboard-inner">

        @if ($user->unreadNotifications)
            @foreach($user->unreadNotifications as $notification)
                <div class="alert border border--{{ $notification->data['message_type'] }}" role="alert">
                    <div class="alert__icon d-flex align-items-center text--{{ $notification->data['message_type'] }}"><i class="fas {{ $notification->data['icon'] }}"></i></div>
                    <p class="alert__message">
                        <span class="fw-bold">{{ $notification->data['title'] }}</span><br>
                        <small>
                            {{ $notification->data['body'] }}
                        </small>
                    </p>
                </div>
            @endforeach
        @endif

        @if ($user->deposit_wallet <= 0 && $user->interest_wallet <= 0)
        <div class="alert border border--danger" role="alert">
            <div class="alert__icon d-flex align-items-center text--danger"><i class="fas fa-exclamation-triangle"></i></div>
            <p class="alert__message">
                <span class="fw-bold">@lang('Empty Balance')</span><br>
                <small><i>@lang('Your balance is empty. Please make') <a href="{{ route('user.deposit.index') }}" class="link-color">@lang('deposit')</a> @lang('for your next investment.')</i></small>
            </p>
        </div>
        @endif

        @if ($user->deposits->where('status',1)->count() == 1 && !$user->invests->count())
        <div class="alert border border--success" role="alert">
            <div class="alert__icon d-flex align-items-center text--success"><i class="fas fa-check"></i></div>
            <p class="alert__message">
                <span class="fw-bold">@lang('First Deposit')</span><br>
                <small><i><span class="fw-bold">@lang('Congratulations!')</span> @lang('You\'ve made your first deposit successfully. Go to') <a href="{{ route('plan') }}" class="link-color">@lang('investment plan')</a> @lang('page and invest now')</i></small>
            </p>
        </div>
        @endif

        @if($pendingWithdrawals)
        <div class="alert border border--primary" role="alert">
            <div class="alert__icon d-flex align-items-center text--primary"><i class="fas fa-spinner"></i></div>
            <p class="alert__message">
                <span class="fw-bold">Ожидает выплаты</span><br>
                <small><i>Заявка на {{ showAmount($pendingWithdrawals) }} {{ $general->cur_text }} ждет подтверждения вывода. Сумма будет отправлена на Ваши реквизиты. Смотрите в  <a href="{{ route('user.withdraw.history') }}" class="link-color">истории выплат</a></i></small>
            </p>
        </div>
        @endif
<!--
        @if($pendingDeposits)
        <div class="alert border border--primary" role="alert">
            <div class="alert__icon d-flex align-items-center text--primary"><i class="fas fa-spinner"></i></div>
            <p class="alert__message">
                <span class="fw-bold">@lang('Deposit Pending')</span><br>
                <small><i>@lang('Total') {{ showAmount($pendingDeposits) }} {{ $general->cur_text }} @lang('deposit request is pending. Please wait for admin approval. See') <a href="{{ route('user.deposit.history') }}" class="link-color">@lang('deposit history')</a></i></small>
            </p>
        </div>
        @endif

        @if(!$user->ts)
        <div class="alert border border--warning" role="alert">
            <div class="alert__icon d-flex align-items-center text--warning"><i class="fas fa-user-lock"></i></div>
            <p class="alert__message">
                <span class="fw-bold">2FA Аутентификация</span><br>
                <small><i>Рекомендуем Вам использовать 2FA Аутентификацию для повышенной безопаности аккаунта</small>
            </p>
        </div>
        @endif -->

        @if($isHoliday)
        <div class="alert border border--info" role="alert">
            <div class="alert__icon d-flex align-items-center text--info"><i class="fas fa-toggle-off"></i></div>
            <p class="alert__message">
                <span class="fw-bold">@lang('Holiday')</span><br>
                <small><i>@lang('Today is holiday on this system. You\'ll not get any interest today from this system. Also you\'re unable to make withdrawal request today.') <br> @lang('The next working day is coming after') <span id="counter" class="fw-bold text--primary fs--15px"></span></i></small>
            </p>
        </div>
        @endif

        @if($user->kv == 0)
        <div class="alert border border--info" role="alert">
            <div class="alert__icon d-flex align-items-center text--info"><i class="fas fa-file-signature"></i></div>
            <p class="alert__message">
                <span class="fw-bold">@lang('KYC Verification Required')</span><br>
                <small><i>@lang('Please submit the required KYC information to verify yourself. Otherwise, you couldn\'t make any withdrawal requests to the system.') <a href="{{ route('user.kyc.form') }}" class="link-color">@lang('Click here')</a> @lang('to submit KYC information').</i></small>
            </p>
        </div>
        @elseif($user->kv == 2)
        <div class="alert border border--warning" role="alert">
            <div class="alert__icon d-flex align-items-center text--warning"><i class="fas fa-user-check"></i></div>
            <p class="alert__message">
                <span class="fw-bold">@lang('KYC Verification Pending')</span><br>
                <small><i>@lang('Your submitted KYC information is pending for admin approval. Please wait till that.') <a href="{{ route('user.kyc.data') }}" class="link-color">@lang('Click here')</a> @lang('to see your submitted information')</i></small>
            </p>
        </div>
        @endif

        <div class="row g-3 mt-4">
            <div class="col-lg-4">
                <div class="dashboard-widget">
                    <div class="d-flex justify-content-between">
                        <h5 class="text-secondary">Пополнено</h5>
                    </div>
                    <h3 class="text--secondary my-4">{{ showAmount($successfulDeposits) }} {{ $general->cur_text }}</h3><!--
                    <div class="widget-lists">
                        <div class="row">
                            <div class="col-4">
                                <p class="fw-bold">@lang('Submitted')</p>
                                <span>{{ $general->cur_sym }}{{ showAmount($submittedDeposits) }}</span>
                            </div>
                            <div class="col-4">
                                <p class="fw-bold">@lang('Pending')</p>
                                <span>{{ $general->cur_sym }}{{ showAmount($pendingDeposits) }}</span>
                            </div>
                            <div class="col-4">
                                <p class="fw-bold">@lang('Rejected')</p>
                                <span>{{ $general->cur_sym }}{{ showAmount($rejectedDeposits) }}</span>
                            </div>
                        </div>
                        <hr>
                        <p><small><i>@lang('You\'ve requested to deposit') {{ $general->cur_sym }}{{ showAmount($requestedDeposits) }}. @lang('Where') {{ $general->cur_sym }}{{ showAmount($initiatedDeposits) }} @lang('is just initiated but not submitted.')</i></small></p>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-4">
                <div class="dashboard-widget">
                    <div class="d-flex justify-content-between">
                        <h5 class="text-secondary">Выплачено</h5>
                    </div>
                    <h3 class="text--secondary my-4">{{ showAmount($submittedWithdrawals) }} {{ $general->cur_text }}</h3> <!--
                    <div class="widget-lists">
                        <div class="row">
                            <div class="col-4">
                                <p class="fw-bold">Успешно</p>
                                <span>{{ $general->cur_sym }}{{ showAmount($submittedWithdrawals) }}</span>
                            </div>
                            <div class="col-4">
                                <p class="fw-bold">В ожидании</p>
                                <span>{{ $general->cur_sym }}{{ showAmount($pendingWithdrawals) }}</span>
                            </div>
                            <div class="col-4">
                                <p class="fw-bold">@lang('Rejected')</p>
                                <span>{{ $general->cur_sym }}{{ showAmount($rejectedWithdrawals) }}</span>
                            </div>
                        </div>

                    </div> -->
                </div>
            </div>
            <div class="col-lg-4">
                <div class="dashboard-widget">
                    <div class="d-flex justify-content-between">
                        <h5 class="text-secondary">Инвестированно</h5>
                    </div>
                    <h3 class="text--secondary my-4">{{ showAmount($invests) }} {{ $general->cur_text }}</h3><hr>
                    <div class="widget-lists">
                        <div class="row">
                            <div class="col-4">
                                <p class="fw-bold">Закрытые</p>
                                <span>{{ $general->cur_sym }}{{ showAmount($completedInvests) }}</span>
                            </div>
                            <div class="col-4">
                                <p class="fw-bold">Активные</p>
                                <span>{{ $general->cur_sym }}{{ showAmount($runningInvests) }}</span>
                            </div>
                            <div class="col-4">
                                <p class="fw-bold">Прибыль</p>
                                <span>{{ $general->cur_sym }}{{ showAmount($interests) }}</span>
                            </div>
                        </div>
                         <!--
                        <p><small><i>Вы инвестировали {{ $general->cur_sym }}{{ showAmount($depositWalletInvests) }} с депозитного кошелька {{ $general->cur_sym }}{{ showAmount($interestWalletInvests) }} с процентного кошелька</i></small></p> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4 mb-4">
            <div class="card-body">
                <div class="mb-2">
                    <h5 class="title">График вашей прибыли</h5>
                    <p> <small><i>Тут показан Ваш график прибыли за последние 30 дней</i></small></p>
                </div>
                <div id="chart"></div>
            </div>
        </div>
    </div>

@endsection

@push('script')
<script src="{{ asset($activeTemplateTrue.'/js/lib/apexcharts.min.js') }}"></script>

<script>

    // apex-line chart
    var options = {
        chart: {
            height: 350,
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
                opacity: 0.08,
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
        series: [
            {
                name: "Доход",
                data: [
                    @foreach($chartData as $cData)
                        {{ getAmount($cData->amount) }},
                    @endforeach

                ]
            }
        ],
        fill: {
            type: "gradient",
            colors: ['#4c7de6', '#4c7de6', '#4c7de6'],
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.6,
                opacityTo: 0.9,
                stops: [0, 90, 100]
            }
        },
        xaxis: {
            title: "Value",
            categories: [
                @foreach($chartData as $cData)
                "{{ Carbon\Carbon::parse($cData->date)->format('d F') }}",
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

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();

    @if($isHoliday)
        function createCountDown(elementId, sec) {
            var tms = sec;
            var x = setInterval(function () {
                var distance = tms * 1000;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                var days = `<span>${days}d</span>`;
                var hours = `<span>${hours}h</span>`;
                var minutes = `<span>${minutes}m</span>`;
                var seconds = `<span>${seconds}s</span>`;
                document.getElementById(elementId).innerHTML = days +' '+ hours + " " + minutes + " " + seconds;
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById(elementId).innerHTML = "COMPLETE";
                }
                tms--;
            }, 1000);
        }

        createCountDown('counter', {{\Carbon\Carbon::parse($nextWorkingDay)->diffInSeconds()}});
    @endif

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

</script>
@endpush
