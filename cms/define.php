<?php
define("JS_DATE", "dd/mm/yyyy");
define("PHP_DATE", "d/m/Y");
define("JS_DATE_TIME", "dd/mm/yyyy");
define("PHP_DATE_TIME", "d/m/Y H:i:s");
define("DB_TIME", "Y-m-d H:i:s");
define("DB_DATE", "Y-m-d");

define('THEME_PATH', 'resources/views/themes');
define('THEME_PATH_VIEW', 'themes');

define('COMING_SOON', 'coming-soon');

// language require field
define('LOCALES_REQUIRE', ['en']);



define("MAX_IMAGE_UPLOAD_SIZE", 1048576 * 5); //5MB
define("MAX_FILE_UPLOAD_SIZE", 1048576 * 30); //30MB
define("IMAGE_TYPE_ACCEPT", "png|jpg|jpeg|gif|svg|svg+xml"); //B
define('ROOT_PATH_PAGE', '../resources/views/frontend/pages/');
define('NO_IMAGE_CAREER', '/assets/images/no_image/career-image.jpg');
define('NO_BANNER_CAREER', '/assets/images/no_image/career-banner.jpg');
define('NO_IMAGE_NEWS', '/assets/images/no_image/news-image.jpg');
define('NO_BANNER_NEWS', '/assets/images/no_image/news-banner.jpg');
define('NO_ICON_CATEGORY', '/assets/images/no_image/category-icon.jpg');
define('NO_IMAGE_CATEGORY', '/assets/images/no_image/category-image.jpg');
define('IMAGE_DEFAULT_VIDEO', '/assets/images/no_image/video-default.png');
define('DEFAULT_FB_SHARE_IMAGE', '/assets/images/no_image/fb-share.jpg');

// Slider define
define('SLIDER_HOME','HOME');
define('SLIDER_CAREER_CULTURE','CAREER-CULTURE');

// Service type
define('SERVICE_TYPE_WHY_NOW','WHY_NOW');
define('SERVICE_TYPE_VALUE_ADDED','VALUE_ADDED');

define('GUARD_CUSTOMER', 'customer');

/*
 * Transaction status
 */
define('TRANSACTION_IN_PROCESS', 'IN_PROCESS');
define('TRANSACTION_COMPLETED', 'COMPLETED');
define('TRANSACTION_CANCEL', 'CANCEL');

//CUSTOMER STATUS
define('CUSTOMER_INACTIVE', 0);
define('CUSTOMER_ACTIVE', 1);
define('CUSTOMER_INVALID', 2);

//CUSTOMER IMAGE
define('DIR_CUSTOMER_IMAGE', '/customer');

// Participant type
define('PARTICIPANT_TYPE_EVENT_EXHIBITOR','EVENT_EXHIBITOR');
define('PARTICIPANT_TYPE_INVESTOR','INVESTOR');
define('PARTICIPANT_TYPE_BUYERS','BUYERS');
define('PARTICIPANT_TYPE_VISITOR','VISITOR');
define('PARTICIPANT_TYPE_OTHER','OTHER');

define('SHOW_LOGIN_FORM',['show_login_form' => true]);
define('SHOW_REGISTER_FORM',['show_register_form' => true]);

/*
 * Distance config
 */
define('CIRCLE_RADIUS', 3959);
define('MILES_TO_KM', 1.60934);
define('MAX_DISTANCE', 10); // km unit

/*
 * Provider define
 */
define('PROVIDER_NAVER','naver');
define('PROVIDER_KAKAO','kakao');
define('PROVIDER_FACEBOOK','facebook');

define('ADMIN_ROLE','admin');