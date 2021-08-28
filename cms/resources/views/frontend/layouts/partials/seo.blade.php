@if(!empty($metadata) && !empty($metadata->title)  )
    <title>{{ $metadata->title }}</title>
    @if($metadata->description)
        <meta name="description" content="{{ $metadata->description }}"/>
    @endif
    @if($metadata->key_word)
        <meta name="keywords" content="{{ $metadata->key_word }}"/>
    @endif
@else
    <title>{{ System::content('website_title', null) }}</title>
    <meta name="description" content="{{ System::content('website_description', null) }}"/>
    <meta name="keywords" content="{{ System::content('website_keywords', null) }}"/>
@endif