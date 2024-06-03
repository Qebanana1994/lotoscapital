@extends('admin.layouts.app')
@section('panel')
    <div class="col-lg-12">

        @foreach($referrals as $refer)
            @php
                $refsByThisUser = \App\Models\User::query()->where('ref_by', $refer->user_id)->pluck('id')->toArray();
                $deposits = \App\Models\Deposit::query()->where('status', "!=", 0)->whereIn('user_id', $refsByThisUser);
                $data = round($deposits->sum('amount'), 2);
                $firstLevel = $data * $levels[1] / 100;
            @endphp
            @if($deposits->count())
                <h5 class="mb-3">{{ __('Рефералы: 1 уровень') }}</h5>
                <div class="card b-radius--10 mb-4">
                    <div class="card-body p-0">
                        <div class="table-responsive--sm table-responsive">
                            <table class="table table--light style--two">
                                <thead>
                                <tr>
                                    <th>Логин</th>
                                    <th>Дата регистрации</th>
                                    <th>Сумма пополнений</th>
                                    <th>Доход</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        {{$refer->user->fullname}}
                                        <a href="{{ route('admin.users.detail', $refer->user_id) }}"><span>@</span>{{ $refer->user->username }}</a>
                                    </td>
                                    <td>{{ $refer->user->created_at }}</td>
                                    <td>{{ $data }}</td>
                                    <td>{{ $firstLevel }}</td>

                                </tr>
                                @empty($refer)
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                </tbody>
                                @endempty
                            </table><!-- table end -->
                        </div>
                    </div>
                    @if ($referrals->hasPages())
                        <div class="card-footer py-4">
                            {{ paginateLinks($referrals) }}
                        </div>
                    @endif
                </div><!-- card end -->
                @foreach($refsByThisUser as $refUser)
                    @php
                        $users = \App\Models\User::query()->where('ref_by', $refUser)->pluck('id');
                        $userDeposits = \App\Models\Deposit::query()->where('status', "!=", 0)->whereIn('user_id', $users->toArray());
                    @endphp
                    @if ($users->count())
                        @php
                            $secondLevel = round($deposits->sum('amount'), 2) * $levels[2] / 100;
                        @endphp
                        <h5 class="mb-3">{{ __('Рефералы: 2 уровень') }}</h5>
                        <div class="card b-radius--10 mb-4">
                            <div class="card-body p-0">
                                <div class="table-responsive--sm table-responsive">
                                    <table class="table table--light style--two">
                                        <thead>
                                        <tr>
                                            <th>Логин</th>
                                            <th>Дата регистрации</th>
                                            <th>Сумма пополнений</th>
                                            <th>Доход</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                {{$refer->user->fullname}}
                                                <a href="{{ route('admin.users.detail', $refer->user_id) }}"><span>@</span>{{ $refer->user->username }}</a>
                                            </td>
                                            <td>{{ $refer->user->created_at }}</td>
                                            <td>{{ $data }}</td>
                                            <td>{{ $secondLevel }}</td>
                                        </tr>
                                        @empty($refer)
                                            <tr>
                                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                            </tr>
                                        </tbody>
                                        @endempty
                                    </table><!-- table end -->
                                </div>
                            </div>
                            @if ($referrals->hasPages())
                                <div class="card-footer py-4">
                                    {{ paginateLinks($referrals) }}
                                </div>
                            @endif
                        </div><!-- card end -->
                        @foreach($users as $user)
                            @php
                                $users = \App\Models\User::query()->where('ref_by', $user)->pluck('id');
                                $userDeposits = \App\Models\Deposit::query()->where('status', "!=", 0)->whereIn('user_id', $users->toArray());
                            @endphp
                            @if ($users->count())
                                @php
                                    $thirdLevel = round($userDeposits->sum('amount'), 2) * $levels[3] / 100;
                                @endphp
                                <h5 class="mb-3">{{ __('Рефералы: 3 уровень') }}</h5>
                                <div class="card b-radius--10 mb-4">
                                    <div class="card-body p-0">
                                        <div class="table-responsive--sm table-responsive">
                                            <table class="table table--light style--two">
                                                <thead>
                                                <tr>
                                                    <th>Логин</th>
                                                    <th>Дата регистрации</th>
                                                    <th>Сумма пополнений</th>
                                                    <th>Доход</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        {{$refer->user->fullname}}
                                                        <a href="{{ route('admin.users.detail', $refer->user_id) }}"><span>@</span>{{ $refer->user->username }}</a>
                                                    </td>
                                                    <td>{{ $refer->user->created_at }}</td>
                                                    <td>{{ $data }}</td>
                                                    <td>{{ $thirdLevel }}</td>
                                                </tr>
                                                @empty($refer)
                                                    <tr>
                                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                                    </tr>
                                                </tbody>
                                                @endempty
                                            </table><!-- table end -->
                                        </div>
                                    </div>
                                    @if ($referrals->hasPages())
                                        <div class="card-footer py-4">
                                            {{ paginateLinks($referrals) }}
                                        </div>
                                    @endif
                                </div><!-- card end -->
                                @foreach($newUsers as $newUser)
                                    @php
                                        $thirdnewUsers = \App\Models\User::query()->where('ref_by', $newUser)->pluck('id');
                                        $thirdUserDeposits = \App\Models\Deposit::query()->where('status', "!=", 0)->whereIn('user_id', $thirdnewUsers->toArray());
                                    @endphp
                                    @if($thirdnewUsers->count())
                                        @php
                                            $fouthLevel = round($thirdUserDeposits->sum('amount'), 2) * $levels[4] / 100;
                                        @endphp
                                        <h5 class="mb-3">{{ __('Рефералы: 4 уровень') }}</h5>
                                        <div class="card b-radius--10 mb-4">
                                            <div class="card-body p-0">
                                                <div class="table-responsive--sm table-responsive">
                                                    <table class="table table--light style--two">
                                                        <thead>
                                                        <tr>
                                                            <th>Логин</th>
                                                            <th>Дата регистрации</th>
                                                            <th>Сумма пополнений</th>
                                                            <th>Доход</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                {{$refer->user->fullname}}
                                                                <a href="{{ route('admin.users.detail', $refer->user_id) }}"><span>@</span>{{ $refer->user->username }}</a>
                                                            </td>
                                                            <td>{{ $refer->user->created_at }}</td>
                                                            <td>{{ $data }}</td>
                                                            <td>{{ $fouthLevel }}</td>
                                                        </tr>
                                                        @empty($refer)
                                                            <tr>
                                                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                                            </tr>
                                                        </tbody>
                                                        @endempty
                                                    </table><!-- table end -->
                                                </div>
                                            </div>
                                            @if ($referrals->hasPages())
                                                <div class="card-footer py-4">
                                                    {{ paginateLinks($referrals) }}
                                                </div>
                                            @endif
                                        </div><!-- card end -->
                                        @foreach($thirdnewUsers as $thirdUser)
                                            @php
                                                $fourthnewUsers = \App\Models\User::query()->where('ref_by', $thirdUser)->pluck('id');
                                                $fourthnewUsersDeposit = \App\Models\Deposit::query()->where('status', "!=", 0)->whereIn('user_id', $fourthnewUsers->toArray());
                                            @endphp
                                            @if($fourthnewUsers->count())
                                                @php
                                                    $fifthLevel = round($thirdUserDeposits->sum('amount'), 2) * $levels[4] / 100;
                                                @endphp
                                                <h5 class="mb-3">{{ __('Рефералы: 5 уровень') }}</h5>
                                                <div class="card b-radius--10 mb-4">
                                                    <div class="card-body p-0">
                                                        <div class="table-responsive--sm table-responsive">
                                                            <table class="table table--light style--two">
                                                                <thead>
                                                                <tr>
                                                                    <th>Логин</th>
                                                                    <th>Дата регистрации</th>
                                                                    <th>Сумма пополнений</th>
                                                                    <th>Доход</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        {{$refer->user->fullname}}
                                                                        <a href="{{ route('admin.users.detail', $refer->user_id) }}"><span>@</span>{{ $refer->user->username }}</a>
                                                                    </td>
                                                                    <td>{{ $refer->user->created_at }}</td>
                                                                    <td>{{ $data }}</td>
                                                                    <td>{{ $fifthLevel }}</td>
                                                                </tr>
                                                                @empty($refer)
                                                                    <tr>
                                                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                                                    </tr>
                                                                </tbody>
                                                                @endempty
                                                            </table><!-- table end -->
                                                        </div>
                                                    </div>
                                                    @if ($referrals->hasPages())
                                                        <div class="card-footer py-4">
                                                            {{ paginateLinks($referrals) }}
                                                        </div>
                                                    @endif
                                                </div><!-- card end -->
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @endif
        @endforeach

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
                <form action="{{ route('admin.referrals.add-ref') }}" method="POST" class="verify-gcaptcha account-form">
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
