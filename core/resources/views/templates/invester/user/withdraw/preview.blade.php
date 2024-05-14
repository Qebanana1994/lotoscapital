@extends($activeTemplate.'layouts.master')
@section('content')
<div class="dashboard-inner">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-4">
                <h3 class="mb-2">Подтверждение выплаты</h3>
                <p class="mb-1">Укажите реквизиты для выплаты</p>
                <p class="mb-1">Срок Выплаты зависит от работы платежного шлюза, от 5 минут до 32 рабочих часов. В ночное время выплаты не осуществляются.</p>
            </div>
            <div class="card custom--card">
                <div class="card-body">
                    <form action="{{route('user.withdraw.submit')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            @php
                                echo $withdraw->method->description;
                            @endphp
                        </div>
                        <x-viser-form identifier="id" identifierValue="{{ $withdraw->method->form_id }}" />
                        @if(auth()->user()->ts)
                        <div class="form-group">
                            <label>@lang('Google Authenticator Code')</label>
                            <input type="text" name="authenticator_code" class="form-control form--control" required>
                        </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
