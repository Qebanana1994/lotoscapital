@extends($activeTemplate.'layouts.master')
@section('content')

    <div class="dashboard-inner">
        <div class="mb-4">
            <h3 class="mb-2">@lang('Profile')</h3>
        </div>

        <div class="card custom--card">
            <div class="card-body">
                <form class="register" action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="form-label">@lang('First Name')</label>
                            <input type="text" class="form-control form--control" name="firstname" value="{{$user->firstname}}" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="form-label">@lang('Last Name')</label>
                            <input type="text" class="form-control form--control" name="lastname" value="{{$user->lastname}}" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="form-label">@lang('Country')</label>
                            <select name="country" class="form--control form-select">
                                @foreach ($countries as $key => $country)
                                    <option data-mobile_code="{{ $country->dial_code }}" value="{{ $key }}" data-code="{{ $key }}">
                                        {{ __($country->country) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>@lang('Mobile Number') </label>
                                <div class="input-group ">
                                    <span class="input-group-text mobile-code"></span>
                                    <input type="hidden" name="mobile_code">
                                    <input type="hidden" name="country_code">
                                    <input type="number" name="mobile" value="{{ old('mobile') }}" id="mobile" class="form-control checkUser">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label class="form-label">@lang('E-mail Address')</label>
                            <input class="form-control form--control" value="{{$user->email}}" readonly>
                        </div>

                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>


    </div>

@endsection

@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobileCode)
            $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });


            let mobileElement = $('.mobile-code');
            $('select[name=country]').val('{{@$user->country_code}}');
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));

            let dialCode        = $('select[name=country] :selected').data('mobile_code');
            let mobileNumber    = `{{ $user->mobile }}`;
            mobileNumber        = mobileNumber.replace(dialCode,'');
            $('input[name=mobile]').val(mobileNumber);
            mobileElement.text(`+${dialCode}`);

            $('.checkUser').on('focusout', function(e) {
                var url = `{{ route('user.check.user') }}`;
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
