@extends($activeTemplate.'layouts.master')
@section('content')
<div class="dashboard-inner">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4">
                <h3 class="mb-2">Оплата депозита</h3>
                <p class="mb-1">Произведите оплату по указанным реквизитам и предоставьте номер транзакции, вклад будет подтверждет в рабочии часа в течении 1 часа.</p>
            </div>
            <div class="card custom--card">
                <div class="card-header card-header-bg">
                    <h5 class="text-center"> <i class="las la-wallet"></i> {{ $data->gateway->name }} <!--@lang('Payment')--></h5>
                </div>
                <div class="card-body  ">
                    <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center mt-2">Вы хотите открыть вклад на <b class="text--success">{{ showAmount($data['amount'])  }} {{__($general->cur_text)}}</b> , Оплатите
                                    <b class="text--success">{{showAmount($data['final_amo']) .' '.$data['method_currency'] }} </b> для успешного открытия вклада
                                </p>

                                <div class="my-4">
                                    <p>@php echo  $data->gateway->description @endphp</p>
                                </div>

                            </div>

                            <x-viser-form identifier="id" identifierValue="{{ $gateway->form_id }}" />

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn--base w-100">@lang('Pay Now')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
