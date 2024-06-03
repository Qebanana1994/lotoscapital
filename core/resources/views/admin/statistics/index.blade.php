@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> @lang('Кол-во клиентов: ') {{ $realUsers }}</label>
                                    <input class="form-control" type="text" name="total_users" required value="{{ $users }}">
                                    <label> @lang('Название')</label>
                                    <input class="form-control" type="text" name="users_title" required value="{{ $usersInfo->title }}">
                                    <label> @lang('Описание')</label>
                                    <input class="form-control" type="text" name="users_description" required value="{{ $usersInfo->desc }}">
                                    <label class="mt-2 d-block text-center"> @lang('Диапазон')</label>
                                    <div class="form-group d-flex gap-3 align-items-center">
                                        <input class="form-control text-center" type="text" name="users_min" required value="{{ $usersRange->min }}">
                                        -
                                        <input class="form-control text-center" type="text" name="users_max" required value="{{ $usersRange->max }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Кол-во вложено: ') {{ $realDeposits }}</label>
                                    <input class="form-control" type="text" name="total_deposits" required value="{{ $deposits }}">
                                    <label> @lang('Название')</label>
                                    <input class="form-control" type="text" name="deposits_title" required value="{{ $depositsInfo->title }}">
                                    <label> @lang('Описание')</label>
                                    <input class="form-control" type="text" name="deposits_description" required value="{{ $depositsInfo->desc }}">
                                    <label class="mt-2 d-block text-center"> @lang('Диапазон')</label>
                                    <div class="form-group d-flex gap-3 align-items-center">
                                        <input class="form-control text-center" type="text" name="deposits_min" required value="{{ $depositsRange->min }}">
                                        -
                                        <input class="form-control text-center" type="text" name="deposits_max" required value="{{ $depositsRange->max }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Кол-во выведено: ') {{ $realWithdraws }}</label>
                                    <input class="form-control" type="text" name="total_withdraws" required value="{{ $withdraws }}">
                                    <label> @lang('Название')</label>
                                    <input class="form-control" type="text" name="withdraws_title" required value="{{ $withdrawsInfo->title }}">
                                    <label> @lang('Описание')</label>
                                    <input class="form-control" type="text" name="withdraws_description" required value="{{ $withdrawsInfo->desc }}">
                                    <label class="mt-2 d-block text-center"> @lang('Диапазон')</label>
                                    <div class="form-group d-flex gap-3 align-items-center">
                                        <input class="form-control text-center" type="text" name="withdraws_min" required value="{{ $withdrawsRange->min }}">
                                        -
                                        <input class="form-control text-center" type="text" name="withdraws_max" required value="{{ $withdrawsRange->max }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
