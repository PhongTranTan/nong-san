<?php
return [
    'product_index' => 'products',
    'product_show' => 'products/{slug}',
    'product_book' => 'reservation-register',
    'product_register' => 'visit-registration',

    'news_category' => 'communication/{category_slug}', // loai tin
    'news_show' => 'communication/{category_slug}/{slug}', // chi tiet
    'library_photo' =>'communication/photo-library',
    'library_photo_show' => 'communication/photo-library/{slug}',
    'video_clip' => 'communication/video-clip',
    'video_clip_show' => 'communication/video-clip/{slug}',
    'news_lhc' => 'communication/lhc-news',
    'news_lhc_show' =>'communication/lhc-news/{slug}',

    'faqs' => 'faqs',
    'coming_soon' => 'coming-soon',
    'ebrochure' => 'e-brochure',
    'ebrochure_show' => 'e-brochure/{slug}',

    'career_index' => 'careers',//cho mac dinh vao lhc
    'career_lhc' => 'careers/lhc-career', //cho mac dinh vao lhc
    'career_lhc_show' => 'careers/lhc-career/{slug}',
    'career_investors' => 'careers/investors-career',
    'career_investors_show' => 'careers/investors-career/{slug}',
    'legal_documents' => 'legal-documents',
    'legal_documents_show' => 'legal-documents/{slug}',
    // Không có trong router, chỉ dùng trans
    'page_home' => '/en',
    'page_solutions' => '/en/solutions',
    'page_capabilities' => '/en/capabilities',


    'page_resources' => '/en/resources',
    'page_resources_show' => 'resources/{slug}',


    'page_contact' => '/en/contact',
    'page_term_condition' => '/en/terms-conditions',
    'page_submit_rfp' => '/en/submit-rfp',
    'page_investment-consultancy' => '/en/investment-consultancy',
    'page_investment-incentives' => '/en/investment-incentives',
    'page_service-one-gate' => '/en/service-one-gate',
    'page_before-investment' => '/en/before-investment',
    'page_after-investment' => '/en/after-investment',
    'page_consultancy-materials' => '/en/consultancy-materials',
    'page_regulations' => '/en/regulations',
    'page_technical-infrastructure' => '/en/technical-infrastructure',
    'page_social-infrastructure' => '/en/social-infrastructure',
    'page_sustainable-development' => '/en/sustainable-development',
    'career_inviroment' => '/en/careers/enviromental-working ',

    'page_dream' => '/en/dream',
    'page_live'=>'/en/live',
    'page_general'=>'/en/general',
    'page_news'=>'en/news',
    'page_news_detail'=>'news/{slug}',
    'page_brochures'=>'en/brochures',


    'login' => 'login',
    'registry' => 'registry',
    'forgot' => 'forgot',
    'reset' => 'reset',
    'logout' => 'logout',
    'reset_link' => '/auth/reset/{token}',
    'dashboard' => 'dashboard',
    'profile' => 'profile'
];