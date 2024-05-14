@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="dashboard-inner">
        <div class="mb-4">
            <p>Депозиты</p>
            <h3>Ваша инвестиционная статистика</h3>
            <p>Тут Вы можете найти вашу историю вкладов</p>
        </div>

        <div class="mt-4">
            @include($activeTemplate.'partials.invest_history',['invests'=>$invests])
            <div class="mt-3">
                {{ $invests->links() }}
            </div>
        </div>
    </div>
@endsection
