@extends('themes.master')
@section('content')
    <!-- Start All Title Box -->
    @php 
        $image = null;
        if (isset($banners) && count($banners) > 0) {
            $image = $banners[0]->image;
        }
    @endphp
    <div class="all-title-box" @if($image) style="background: url({{ $image }})" @endif>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Liên Hệ</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
                        <li class="breadcrumb-item active"> Liên Hệ </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Contact Us  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        <input type="hidden" 
                            value="{{ route('contact.post') }}" 
                            id="action-contact"
                        >
                        <h2>{{  $page->description }}</h2>
                        <p>{!!  $page->content !!}</p>
                        <form id="contactForm" name="contactForm"
                            action="{{ route('contact.post') }}" 
                            method="post"
                        >
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Tên của bạn" required data-error="Vui lòng nhập tên">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Email của bạn" id="email" class="form-control" name="name" required data-error="Vui lòng nhập email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="subject" name="name" placeholder="Chủ đề bạn muốn nói" required data-error="Vui lòng nhập chủ đề">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="message" placeholder="Tin nhắn của bạn" rows="4" data-error="Hãy ghi nội dung của bạn" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="submit-button text-center">
                                        <button class="btn hvr-hover" id="submit" type="submit">Gửi</button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
				<div class="col-lg-4 col-sm-12">
                    <div class="contact-info-left">
                        <h2>{{ $arr_setting['contact_title'] }}</h2>
                        <p>{{ $arr_setting['contact_description'] }}</p>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>
                                    Địa Chỉ: {{ $arr_setting['address'] }}
                                </p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>
                                    Số điện thoại: <a href="tel:{{ $arr_setting['phone'] }}">{{ $arr_setting['phone'] }}</a>
                                </p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>
                                    Email: 
                                    <a href="mailto:{{ $arr_setting['email'] }}">
                                        {{ $arr_setting['email'] }}
                                    </a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->
@endsection