@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="table-section">
                <table class="table style-two table--responsive--lg">
                    <thead>
                        <tr>
                            <th>@lang('Subject')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Priority')</th>
                            <th>@lang('Last Reply')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supports as $support)
                            <tr>
                                <td> <a href="{{ route('ticket.view', $support->ticket) }}" class="fw-bold">
                                        [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a></td>
                                <td>
                                    @php echo $support->statusBadge; @endphp
                                </td>
                                <td>
                                    @if ($support->priority == 1)
                                        <span class="badge badge--dark">@lang('Low')</span>
                                    @elseif($support->priority == 2)
                                        <span class="badge badge--success">@lang('Medium')</span>
                                    @elseif($support->priority == 3)
                                        <span class="badge badge--primary">@lang('High')</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                                <td>
                                    <a href="{{ route('ticket.view', $support->ticket) }}"
                                        class="btn btn--base btn--sm">
                                        <i class="fa fa-desktop"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($supports->hasPages())
                    <div class="card-footer mt-4">
                        {{ $supports->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .badge--dark {
            color: #999;
            border-color: #999;
            background-color: rgba(153, 153, 153, 0.15);
        }
    </style>
@endpush
