@extends('admin.layouts.app')
@section('panel')
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">

                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>{{ __('Платежная сиситема') }}</th>
                                <th>{{ __('Кол-во вкладов') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gateways as $gateway)
                                <tr>
                                    <td><span class="font-weight-600">{{ $gateway->alias }}</span></td>
                                    <td><span class="font-weight-600">{{ $gateway->deposits->count() }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
        </div><!-- card end -->
    </div>
@endsection

