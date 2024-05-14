@extends('admin.layouts.app')

@section('panel')
    <div class="row justify-content-center">
        @if (request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.method') || request()->routeIs('admin.users.withdrawals') || request()->routeIs('admin.users.withdrawals.method'))
            <div class="col-xl-4 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 has-link b-radius--5 bg--success">
                    <a href="{{ route('admin.withdraw.approved') }}" class="item-link"></a>
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($successful) }}</h2>
                        <p class="text-white">@lang('Approved Withdrawals')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
            <div class="col-xl-4 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 has-link b-radius--5 bg--6">
                    <a href="{{ route('admin.withdraw.pending') }}" class="item-link"></a>
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($pending) }}</h2>
                        <p class="text-white">@lang('Pending Withdrawals')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
            <div class="col-xl-4 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 b-radius--5 has-link bg--pink">
                    <a href="{{ route('admin.withdraw.rejected') }}" class="item-link"></a>
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ __($general->cur_sym) }}{{ showAmount($rejected) }}</h2>
                        <p class="text-white">@lang('Rejected Withdrawals')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
        @endif
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">

                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Gateway | Transaction')</th>
                                    <th>@lang('Initiated')</th>
                                    <th>@lang('User')</th>
                                    <th>Кошелек</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Conversion')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($withdrawals as $withdraw)
                                    @php
                                        $details = $withdraw->withdraw_information != null ? json_encode($withdraw->withdraw_information) : null;
                                    @endphp
                                    <tr>
                                        <td>
                                            <span class="fw-bold"><a href="{{ appendQuery('method', @$withdraw->method->id) }}"> {{ __(@$withdraw->method->name) }}</a></span>
                                            <br>
                                            <small>{{ $withdraw->trx }}</small>
                                        </td>
                                        <td>
                                            {{ showDateTime($withdraw->created_at) }} <br> {{ diffForHumans($withdraw->created_at) }}
                                        </td>

                                        <td>
                                            <span class="fw-bold">{{ $withdraw->user->fullname }}</span>
                                            <br>
                                            <span class="small"> <a href="{{ appendQuery('search', @$withdraw->user->username) }}"><span>@</span>{{ $withdraw->user->username }}</a> </span>
                                        </td>

                                        <td>
 @if($details != null)
                        @foreach(json_decode($details) as $val)
                            
                                    <h6>{{__(@$val->name)}}</h6>
                                    @if($val->type == 'checkbox')
                                        {{ implode(',', @$val->value ?? []) }}
                                    @elseif($val->type == 'file')
                                        @if(@$val->value)
                                            <a href="{{ route('admin.download.attachment',encrypt(getFilePath('verify').'/'.$val->value)) }}" class="me-3"><i class="fa fa-file"></i>  @lang('Attachment') </a>
                                        @else
                                            @lang('No File')
                                        @endif
                                    @else
                                    <p><strong>{{__(@$val->value)}}</strong></p>
                                    @endif
                                
                        @endforeach
                    @endif
                                        </td>
                                        <td>
                                            {{ __($general->cur_sym) }}{{ showAmount($withdraw->amount) }} - <span class="text-danger" title="@lang('charge')">{{ showAmount($withdraw->charge) }} </span>
                                            <br>
                                            <strong title="@lang('Amount after charge')">
                                                {{ showAmount($withdraw->amount - $withdraw->charge) }} {{ __($general->cur_text) }}
                                            </strong>

                                        </td>
                                        <td>
                                            1 {{ __($general->cur_text) }} = {{ showAmount($withdraw->rate) }} {{ __($withdraw->currency) }}
                                            <br>
                                            <strong>{{ showAmount($withdraw->final_amount) }} {{ __($withdraw->currency) }}</strong>
                                        </td>

                                        <td>
                                            @php echo $withdraw->statusBadge @endphp
                                        </td>
                                        <td>
                                            @if($withdraw->status == 2)
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-outline--success ms-1 approveBtn" data-id="{{ $withdraw->id }}" data-amount="{{ showAmount($withdraw->final_amount) }} {{$withdraw->currency}}">
                                                            <i class="fas la-check"></i> @lang('Approve')
                                                        </button>

                                                        <button class="btn btn-outline--danger ms-1 rejectBtn" data-id="{{ $withdraw->id }}">
                                                            <i class="fas fa-ban"></i> @lang('Reject')
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif

                                            <a href="{{ route('admin.withdraw.details', $withdraw->id) }}" class="btn btn-sm btn-outline--primary ms-1">
                                                <i class="la la-desktop"></i> @lang('Details')
                                            </a>
                                        </td>
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
                @if ($withdrawals->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($withdrawals) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

    {{-- APPROVE MODAL --}}
    <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Approve Withdrawal Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.withdraw.approve') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Have you sent') <span class="fw-bold withdraw-amount text-success"></span>?</p>
                        <p class="withdraw-detail"></p>
                        <textarea name="details" class="form-control pt-3" value="{{ old('details') }}" rows="3" placeholder="@lang('Provide the details. eg: transaction number')" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- REJECT MODAL --}}
    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reject Withdrawal Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{route('admin.withdraw.reject')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <strong>@lang('Reason of Rejection')</strong>
                            <textarea name="details" class="form-control pt-3" rows="3" value="{{ old('details') }}" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




@push('breadcrumb-plugins')
    <x-search-form dateSearch='yes' />
@endpush
@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#approveModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.modal('show');
            });

            $('.rejectBtn').on('click', function() {
                var modal = $('#rejectModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });
        })(jQuery);

    </script>
@endpush
