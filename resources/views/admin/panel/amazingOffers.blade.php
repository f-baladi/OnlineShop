@extends('layouts.admin')

@section('content')

    <div class="container">
        @include('partials.alert')
        @php $i=(isset($_GET['page'])) ? (($_GET['page']-1)*10): 0 ; @endphp
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                {{ __('public.manage',['name' => 'پیشنهادات شگفت انگیز']) }}
            </div>
            <div class="card-body">
                <amazing-offers-component></amazing-offers-component>
            </div>
        </div>
    </div>
@endsection

@section('head')
    <link href="{{ asset('css/js-persian-cal.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/js-persian-cal.min.js') }}"></script>
    <script>
        const pcal1= new AMIB.persianCalendar('pcal1');
        const pcal2= new AMIB.persianCalendar('pcal2');
    </script>
@endsection
