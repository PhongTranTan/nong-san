@extends('frontend.layouts.master')


@push('style')
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
@endpush

@section('content')
    <section class="sBannerChild">
        @if($bt = optional($blocks->get('BANNER'))->first())
            <div class="image" style="background-image:url('{{$bt->photo}}')"><img alt="" src="{{$bt->photo}}"></div>
        @else
            <div class="image" style="background-image:url('/images/banner-about.jpg')"><img alt="" src="/images/banner-about.jpg"></div>
        @endif

        <div class="sBannerChild__title">
            <h4>ABOUT US</h4>
        </div>
    </section>
    <section class="mainContent">
        @if($bt = optional($blocks->get('CONTENT'))->first())
        <div class="container">
            <div class="document">
                {!! $bt->content !!}
            </div>
        </div>
        @endif
    </section>
@endsection

@section('footer')
    @include('frontend.layouts.partials.footer')
@endsection

@push('script')
    <script>
        $('.headerNobanner').removeClass('headerNobanner');
    </script>
@endpush