@extends('frontend.layouts.master')

@push('style')
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
@endpush

@section('content')
<main class="wrapper">
    <div class="page-internal-wrapper">
        <!-- BREADCRUMB-->
        <div class="breadcrumb-page">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" title="Homepage">Homepage</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="contact-page-section">
            <div class="container">
                <div class="contact-content">
                    <div class="box-border">
                        @if(!empty($blocks['CONTACT-US']) && $block = $blocks->get('CONTACT-US')->first())
                        <h2 class="title big text-center"><span><span>{!! $block->name !!}</span></span></h2>
                        <div class="title sub-title italic">{!! str_replace("\r\n","<br/>",$block->description) !!}</div>
                        @endif
                    </div>
                    <div class="box-border">
                        <div class="info-contact">
                            <div class="item-contact">
                                <i class="icon icon-mail-big"></i>
                                @if(!empty($blocks['CONTACT-EMAIL']) && $block_email = $blocks->get('CONTACT-EMAIL')->first())
                                <span class="font-weight-700">{!! $block_email->name !!}</span>
                                @endif
                            </div>
                            <div class="item-contact">
                                <i class="icon icon-call-big"></i>
                                @if(!empty($blocks['CONTACT-PHONE']) && $block_phone = $blocks->get('CONTACT-PHONE')->first())
                                <span class="font-weight-700">{!! $block_phone->name !!}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="box-border">              
                        <div class="form-style form-sub">
                            <form class="form-validate" action="{{ route('contact.post') }}" method="post">
                                {!! csrf_field() !!}
                                <div class="form-line"><span class="input-group-addon">Name <span class="required">*</span></span>
                                    <div class="has-input">
                                        <input id="name" type="text" placeholder="Enter your name" required name="name">
                                    </div>
                                </div>
                                <div class="form-line"><span class="input-group-addon">Email <span class="required">*</span></span>
                                    <div class="has-input">
                                        <input id="email" type="email" placeholder="Enter your email" name="email">
                                    </div>
                                </div>
                                <div class="form-line"><span class="input-group-addon">Phone number <span class="required">*</span></span>
                                    <div class="has-input">
                                        <input id="phone" type="text" placeholder="Enter your phone number" minlength="8" pattern="[-+]?[0-9]*[.,]?[0-9]+" required name="phone">
                                    </div>
                                </div>
                                <div class="form-line"><span class="input-group-addon">Message <span class="required">*</span></span>
                                    <div class="has-input">
                                        <textarea id="msg-contact" rows="4" placeholder="Enter your message" name="message"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="other_data" value="{{ !empty(request()->get('issurer')) ? 'Issurer: '.request()->get('issurer') : NULL }}">

                                @if(\Session::has('success-contact'))
                                <div id="success-subscribe">{!! \Session::get('success-contact') !!}</div>
                                @endif

                                <div class="form-line no-margin text-center a-center">
                                    <button class="btn-nlp small blue" type="submit">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection

@section('footer')
    @include('frontend.layouts.partials.footer')
@endsection

@section('footer-page')
footer-page
@endsection

@section('button-bottom')
<div class="container-fluid footer-btn" id="btn-foot">                       
    <button class="btn-nlp blue" data-toggle="modal" data-target="#modalPopovers">Schedule Showflat Tour</button>
    <button class="btn-nlp green" onclick="window.location.href='https://wa.me/{{ (isset($arr_setting['whatsapp'])) ? $arr_setting['whatsapp'] : '#' }}'">WhatsApp</button>
</div>
@endsection

@push('script')
<script src="{{ url('assets/js/library.js') }}"></script>
<script async src="{{ url('assets/js/pages.js') }}"></script>    
@endpush
