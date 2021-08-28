@if($metadata)
    <title>{{ $metadata->title }} | {{ System::content('website_title', null) }}</title>
    <meta name="description" content="{{ $metadata->description }}"/>
    <meta name="keywords" content="{{ $metadata->key_word }}"/>

    <meta property="og:title" content="{{ $metadata->title }}"/>
    <meta property="og:description" content="{{ $metadata->description }}"/>
    @if(!empty($image_seo))
        <meta property="og:image" content="{!! $image_seo !!}"/>
    @endif
    <meta property="og:url" content="{!! Request::fullUrl() !!}"/>
    <meta property="og:site_name" content="DalatHasfarm"/>
    <meta property="og:type" content="website"/>

    <meta name="twitter:title" content="{{ $metadata->title }}"/>
    <meta name="twitter:description" content="{{ $metadata->description }}"/>
    @if(!empty($image_seo))
        <meta property="twitter:image" content="{!! $image_seo !!}"/>
    @endif
    <meta name="twitter:card" content="summary_large_image"/>
    <meta property="fb:app_id" content="{!! config("service.facebook.app_id") !!}"/>
    <meta name="twitter:site" content="@dalathasfarm"/>
@endif