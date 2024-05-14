@extends('admin.layouts.app')
@section('panel')
    <div class="col-lg-12">


                <div class="d-flex flex-wrap justify-content-end gap-2 align-items-right breadcrumb-plugins py-2">
                    <div class="flex-right">
                        <button data-bs-toggle="modal" data-bs-target="#addReferModal" class="btn btn--success btn--shadow w-100 btn-lg bal-btn" data-act="add">
                            <i class="las la-plus-circle"></i> Добавить реферал</button>
                    </div>
                </div>
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">

                    <table class="table table--light style--two">
                        <thead>
                        <tr>
                            <th>Логин</th>
                            <th>Ссылка для приглашений</th>
                            <th>Количество переходов</th>
                            <th>Приглашено пользователей</th>
                            <th>Активно</th>
                            <th>Вложили</th>
                            <th>Реферальные</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($referrals as $refer)
                        <tr>
                            <td>{{$refer->user->fullname}}
                                <a href="{{ route('admin.users.detail', $refer->user_id) }}"><span>@</span>{{ $refer->user->username }}</a>
                            </td>
                            <td>{{ route('home') }}?reference={{$refer->user->username}}</td>
                            <td>{{$refer->hitCount}}</td>
                            <td>{{\App\Models\User::query()->where('ref_by', $refer->user_id)->count()}}</td>
                            <td>Активно</td>
                            @php
                                $refs = \App\Models\Referral::query()->get();
                                $levels = array();
                                foreach ($refs as $level) {
                                    $levels[$level->level] = $level->percent;
                                }

                                $refsByThisUser = \App\Models\User::query()->where('ref_by', $refer->user_id)->pluck('id')->toArray();
                                $deposits = \App\Models\Deposit::query()->where('status', "!=", 0)->whereIn('user_id', $refsByThisUser);
                                $data = round($deposits->sum('amount'), 2);
                                $firstLevel = $data * $levels[1] / 100;


                                foreach ($refsByThisUser as $refUser) {
                                    $users = \App\Models\User::query()->where('ref_by', $refUser)->pluck('id')->toArray();
                                    $userDeposits = \App\Models\Deposit::query()->where('status', "!=", 0)->whereIn('user_id', $users);
                                    if ($userDeposits->count()) {
                                        $secondLevel = round($deposits->sum('amount'), 2) * $levels[2] / 100;
                                        $firstLevel += $secondLevel;
                                    }
                                    foreach ($users as $user) {
                                        $newUsers = \App\Models\User::query()->where('ref_by', $user)->pluck('id')->toArray();
                                        $userDeposits = \App\Models\Deposit::query()->where('status', "!=", 0)->whereIn('user_id', $newUsers);
                                        if ($userDeposits->count()) {
                                            $thirdLevel = round($userDeposits->sum('amount'), 2) * $levels[3] / 100;
                                            $firstLevel += $thirdLevel;
                                        }
                                        foreach ($newUsers as $newUser) {
                                            $thirdnewUsers = \App\Models\User::query()->where('ref_by', $newUser)->pluck('id')->toArray();
                                            $thirdUserDeposits = \App\Models\Deposit::query()->where('status', "!=", 0)->whereIn('user_id', $thirdnewUsers);
                                            if ($thirdUserDeposits->count()) {
                                                $fouthLevel = round($thirdUserDeposits->sum('amount'), 2) * $levels[4] / 100;
                                                $firstLevel += $fouthLevel;
                                            }

                                            foreach ($thirdnewUsers as $thirdUser) {
                                                $fourthnewUsers = \App\Models\User::query()->where('ref_by', $thirdUser)->pluck('id')->toArray();
                                                $fourthnewUsersDeposit = \App\Models\Deposit::query()->where('status', "!=", 0)->whereIn('user_id', $fourthnewUsers);
                                                if ($fourthnewUsersDeposit->count()) {
                                                    $fifthLevel = round($fourthnewUsersDeposit->sum('amount'), 2) * $levels[5] / 100;
                                                    $firstLevel += $fifthLevel;
                                                }
                                            }
                                        }
                                    }
                                }

                            @endphp
                            <td>{{$data}}</td>
                            <td>{{$firstLevel}}</td>
                        </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
            @if ($referrals->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($referrals) }}
                </div>
            @endif
        </div><!-- card end -->
    </div>
    <div id="addReferModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class="type"></span> <span>Пользователь</span></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.add-ref') }}" method="POST" class="verify-gcaptcha account-form">
                    @csrf
                    <div class="row modal-body">
                        <div class="col-md-12">
                            <input type="hidden" value="1" name="registerReferer">
                            <div class="form-group">
                                <label for="select2-value-dropdown">
                                    @lang('Username')
                                </label>
                                <select name="user_id" id="select2-value-dropdown">
                                    @foreach(\App\Models\User::get() as $user)
                                        <option value="{{$user->id}}">
                                            {{$user->username}} ({{$user->id}})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-danger usernameExist"></small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100">Сохранить</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#select2-value-dropdown').select2();
        });
    </script>
{{--    <script>--}}
{{--        "use strict";--}}
{{--        (function($) {--}}
{{--            @if ($mobileCode)--}}
{{--            $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');--}}
{{--            @endif--}}
{{--            $('select[name=country]').change(function() {--}}
{{--                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));--}}
{{--                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));--}}
{{--                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));--}}
{{--            });--}}
{{--            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));--}}
{{--            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));--}}
{{--            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));--}}
{{--            $('.checkUser').on('focusout', function(e) {--}}
{{--                var url = '{{ route('user.checkUser') }}';--}}
{{--                var value = $(this).val();--}}
{{--                var token = '{{ csrf_token() }}';--}}
{{--                if ($(this).attr('name') == 'mobile') {--}}
{{--                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;--}}
{{--                    var data = {--}}
{{--                        mobile: mobile,--}}
{{--                        _token: token--}}
{{--                    }--}}
{{--                }--}}
{{--                if ($(this).attr('name') == 'email') {--}}
{{--                    var data = {--}}
{{--                        email: value,--}}
{{--                        _token: token--}}
{{--                    }--}}
{{--                }--}}
{{--                if ($(this).attr('name') == 'username') {--}}
{{--                    var data = {--}}
{{--                        username: value,--}}
{{--                        _token: token--}}
{{--                    }--}}
{{--                }--}}
{{--                $.post(url, data, function(response) {--}}
{{--                    if (response.data != false && response.type == 'email') {--}}
{{--                        $('#existModalCenter').modal('show');--}}
{{--                    } else if (response.data != false) {--}}
{{--                        $(`.${response.type}Exist`).text(`${response.type} already exist`);--}}
{{--                    } else {--}}
{{--                        $(`.${response.type}Exist`).text('');--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        })(jQuery);--}}
{{--    </script>--}}
@endpush
