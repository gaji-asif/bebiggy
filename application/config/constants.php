<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('CATEGORY_IMAGES', 'assets/img/categories');
define('VERIFICATION_FILE', './assets/verification/');
define('IMAGES_UPLOAD', 'assets/img/uploads/');
define('BLOG_UPLOAD', 'assets/img/blog/');
define('FILES_UPLOAD', 'assets/img/uploads/documents/');
define('USER_UPLOAD', 'assets/img/users/');
define('ICON_UPLOAD', 'assets/img/svgs/');
define('ICON_FLAGS', 'assets/img/svg/');
define('DATA_FOLDER', 'assets/data/');
define('IMPORT_FOLDER', 'assets/imports/');
define('DATA_SMILEYS', 'assets/img/smileys');
define('ADMIN_IMAGES', 'assets/img/admin/');
define('SCREENSHOTS', 'assets/img/screenshots/');
define('JSON_KEY_LOC', 'application/third_party/Google/');
define('APP_URLS', array('play.google.com', 'apps.apple.com', 'itunes.apple.com'));
define('COURSE_IMAGE', 'assets/img/course/');
define('NO_IMAGE', 'assets/img/');




define('PAYMENT_SUCCESS', 'payments/success');
define('PAYMENT_FAIL', 'payments/fail');
define('PAYMENT_CANCEL', 'payments/cancel');
define('PAYMENT_RETURN', 'http://example.com');
define('PAYMENT_PAYPAL_RETURN', 'payments/return');
define('KEY_UPLOAD', 'application/third_party/Google');
define('RESULTS_PER_PAGE', 2);
define('RESULTS_PER_HOMEPAGE', 5);
define('AUCTION_HOMEPAGE_RESULTS', 5);
define('RESULTS_PER_COLUMN', 10);
define('RESULTS_PER_BLOG', 3);
define('RESULTS_PER_COMMENT', 30);
define('RESULTS_PER_SEARCH', 15);
define('GOOGLE_ADSENSE', FALSE);
define('DECODE_DESCRIPTIONS', TRUE);
define('RANGE_MAX', 15000000);
define('RANGE_MIN', 0);
define('RANGE_STEP', 10);
define('IMAGE_EXT', ['png', 'jpeg', 'jpg', 'gif']);
define('PERPAGE', 5);
define('PERPAGE8', 8);
define('PERPAGE9', 9);
define("MAX_LENGTH_4", 4);
define("MAX_LENGTH_5", 5);
define("MAX_LENGTH_6", 6);
define("MAX_LENGTH_7", 7);
define("MAX_LENGTH_8", 8);

define('COURSE_TYPE', ['1' => 'Free', '2' => 'Standard', '3' => 'Special',]);
/***
 * course type id will set as id in  tbl_permissions.
 * this is used for display permission on front-end
 */
define('COURSE_MEMBERSHIP_TYPE', ['1' => '32', '2' => '33', '3' => '34',]);

define('STATUS', ['1' => 'Active', '0' => 'Inactive']);

define('TRAFFIC_SOURCES', [
    '1' => 'Organic Search',
    '2' => 'Paid Search',
    '3' => 'Organic Social',
    '4' => 'Paid Social',
    '5' => 'Dipslay Ads'
]);

// max currency length.
define('CURRENCY_MAXLENGTH', 8);

// url => 'name to be display on menu
define(
    'MAIN_MENU',
    [
        'Website For Sale' => [

            'websites-for-sale' => 'Website For Sale',
            'Shopify Dropship Websites For Sale' => [
                'product-category/shopify-dropship-websites-for-sale'   => 'Shopify Dropship Websites For Sale',
                'starter-websites-for-sale/fashion'                     => 'fashion',
                'starter-websites-for-sale/gadgets-electronics'         => 'gadgets electronics',
                'starter-websites-for-sale/health'                      => 'health',
                'starter-websites-for-sale/home-decor'                  => 'home-decor',
                'starter-websites-for-sale/jewelry'                     => 'jewelry',
                'starter-websites-for-sale/pets'                        => 'pets',
                'starter-websites-for-sale/sports'                      => 'sports',
                'starter-websites-for-sale/toys'                        => 'toys',
                'starter-websites-for-sale/travel'                      => 'travel',
            ],
            'Shopify Premium Dropship Websites For Sale' => [
                'product-category/shopify-premium-dropship-websites-for-sale'   => 'Shopify Premium Dropship Websites For Sale',
                'product-category/fashion'                                      => 'fashion',
                'product-category/gadgets-electronics'                          => 'gadgets electronics',
                'product-category/health'                                       => 'health',
                'product-category/home-decor'                                   => 'home-decor',
                'product-category/jewelry'                                      => 'jewelry',
                'product-category/pets'                                         => 'pets',
                'product-category/sports'                                       => 'sports',
                'product-category/toys'                                         => 'toys',
                'product-category/travel'                                       => 'travel'
            ],
            'product-category/ecommerce-business' => 'Profitable Ecommerce Business',
        ],
        'dropshipping'  => [
            'dropshipping'                          => 'dropshipping',
            'dropshipping-products'                 => 'WINNING PRODUCTS',
            'dropshipping-websites'                 => 'DROPSHIPPING WEBSITES',
            'shopify-stores-for-sale'               => 'Shopify Stores',
            'product-category/ecommerce-business'   => 'PROFITABLE ECOMMERCE BUSINESS',
        ],
        'learn'         => [
            'course'            => 'learn',
            'standard-courses'  => 'STANDARD COURSES',
            'special-courses'   => 'SPECIAL COURSES',
        ],
        'faq' => [
            'faq-3'                                     => 'faq',
            'faq-3/how-to-make-money-drop-shipping'     => 'How to Make Money Drop Shipping',
            'faq-3/how-to-start-an-online-shop'         => 'How to Start an Online Shop',
            'faq-3/how-to-start-drop-shipping'          => 'how to start drop shipping',
            'faq-3/what-is-drop-shipping'               => 'What is Drop Shipping',
        ],        
        'contact-us' => 'contact us',
        '/' => 'home',
        //'solution'      =>  'Solution',
    ]
);

define('MAIN_HEAD_MENU', [
    'MARKETPLACE' => [
        'domains'       => 'Domain',
        'websites'      => 'Website',
        'businesses'    => 'Business',
        'apps'          => 'app',
        'solution'      => 'solution'
    ],
    'ABOUT Us' => [
        'about-us' => 'about-us',
        'get-started' => 'HOW TO GET STARTED?',
    ],
    'blog' => 'blog',
]);

define("OTHER-MENU", [
    'product-category-shopify-latest-dropship-websites-for-sale' => 'product-category-shopify-latest-dropship-websites-for-sale'
]);

define("SEARCH_OPTION", [
    'websites'      => 'websites',
    'domains'       => 'domains',
    'businesses'    => 'business',
    'apps'          => 'app',
    'solution'      => 'solution'

]);

define('PAGES', [
    'home' => 'home',
    'websites-for-sale'                                 =>  'websites for sale',
    'shopify-dropship-websites-for-sale'                =>  'Shopify Dropship Websites for Sale',
    'starter-websites-for-sale-fashion'                 =>  'Starter Websites For Sale - Fashion',
    'starter-websites-for-sale-gadgets-electronics'     =>  'Starter Websites For Sale - Gadgets Electronics',
    'home-decor'                                        =>  'Home Decor',
    'starter-websites-for-sale-jewelry'                 =>  'Starter Websites For Sale Jewelry',

]);

define('SECTION', [
    'feature' => 'feature',
    'premium' => 'premium',
    'latest'  => 'latest',
]);

define('BUSIENSS_REGISTERED', [
    "Tucows Domain"             =>  "Tucows Domain",
    "GoDaddy"                   =>  "GoDaddy",
    "NameCheap"                 =>  "NameCheap",
    "Network Solutions"         =>  "Network Solutions",
    "1&1"                       =>  "1&1",
    "eNom"                      =>  "eNom",
    "GMO Internet"              =>  "GMO Internet",
    "PDR"                       =>  "PDR",
    "Alibaba Cloud Computing"   =>  "Alibaba Cloud Computing",
    "Other" => "Other"
]);


define('PAGESNAME',  [
    'home',
    'websites-for-sale',
    'product-category-shopify-dropship-websites-for-sale',
    'starter-websites-for-sale-fashion',
    'starter-websites-for-sale-gadgets-electronics',
    'starter-websites-for-sale-health',
    'starter-websites-for-sale-home-decor',
    'starter-websites-for-sale-jewelry',
    'starter-websites-for-sale-pets',
    'starter-websites-for-sale-sports',
    'starter-websites-for-sale-toys',
    'starter-websites-for-sale-travel',
    'product-category-shopify-premium-dropship-websites-for-sale',
    'product-category-fashion',
    'product-category-gadgets-electronics',
    'product-category-health',
    'product-category-jewelry',
    'product-category-pets',
    'product-category-sports',
    'product-category-toys',
    'product-category-travel',
    'product-category-home-decor',
    'product-category-ecommerce-business',
    'solution',
    'dropshipping',
    'dropshipping-products',
    'dropshipping-websites',
    'shopify-stores-for-sale',
    'product-category-shopify-latest-dropship-websites-for-sale',



]);

/**
 *   'feature' => 'feature',
 *'premium' => 'premium',
 *'latest'  => 'latest',
 */
define('PAGESNAME_SECTION',  [
    'home_feature' => 'home:feature',
    'home_premium' => 'home:premium',
    'home_latest' => 'home:latest',
    'websites-for-sale-feature' => 'websites-for-sale:feature',
    'websites-for-sale-premium' => 'websites-for-sale:premium',
    'websites-for-sale-latest' => 'websites-for-sale:latest',
    'dropshipping_feature'  => 'dropshipping:feature',
    'dropshipping_premium'  => 'dropshipping:premium',
    'dropshipping_latest'  => 'dropshipping:latest',
    'dropshipping-websites-feature' => 'dropshipping-websites:feature',
    'dropshipping-websites-premium' => 'dropshipping-websites:premium',
    'dropshipping-websites-latest' => 'dropshipping-websites:latest',
    'shopify-stores-for-sale-feature' => 'shopify-stores-for-sale:feature',
    'shopify-stores-for-sale-premium' => 'shopify-stores-for-sale:premium',
    'shopify-stores-for-sale-latest' => 'shopify-stores-for-sale:latest',


]);

define('SIDEMENU', [
    'Dashboard'             =>  1,
    'General_Settings'      =>  2,
    'Plugins_Manager'       =>  4,
    'Monetization_Control'  =>  5,
    'Website_Industry'      =>  9,
    'Solution_Industry'     =>  13,
    'Service_Type'          =>  17,
    'Membership_Level'      =>  21,

    'Course_Category'       => 25,  // course_category
    'Courses'               => 26,  // list_courses
    'Solution_Listings'     => 27, //  solution_listings
    'Current_Listings'      => 28,  // current_listings
    'Cron_Jobs'             => 29,  // cron_jobs
    'Email_Settings'        => 30,  // email_settings
    'Listing_Control'       => 31,  // listing_control
    'Bulk_Upload'           => 32,  // bulk_upload
    'Reported_Listings'     => 33,  // reported_listings 
    'Pages_Manager'         => 34,  // pages_manager  
    'Blog_Manager'          => 35,  // blog_manager  
    'Language_Setup'        => 36,  // language_setup  
    'Images_Manager'        => 37,  // images_manager  
    'Ads_Manager'           => 38,  // ads_manager  
    'Payments_Setup'        => 39,  // payments_setup  
    'Payments_Data'         => 40,  // payments_data  
    'Withdrawal_Settings'   => 41,  // withdrawal_settings  
    'Listings_Types'        => 42,  // listings_types  
    'User_Control'          => 43,  // user_control  
    'Announcement_Control'  => 44,  // announcement_control  
    'User_Settings'         => 45,  // user_settings  
    'About_Developers'      => 46,  // about_developers  
    'Manage_Disputes'       => 47,  // manage_disputes  
    'Change_Password'       => 48,  // change_password  
    'Admin_Permissions'     => 49,  // admin_permissions     
]);

define('COURSE_PERPAGE_COUNT', 12);

define("ALLOW_USER", [1, 27, 28]);

/**
 * To make common permission for membership level
 */
define('MEMBERSHIP_PERMISSION', [
    'domain' =>
    [
        'price'             => 'can-view-price-domain',
        'make-offer'        => 'can-make-offer-domain',
        'buy-now'           => 'buy-now-domain',
        'contact-seller'    => 'contact-seller-domain',
        'view-demo'         => 'view-demo-domain',
        'ask-price'         => 'ask-price-domain',

    ],
    'website' =>
    [
        'price'             => 'can-view-price-website',
        'make-offer'        => 'can-make-offer-website',
        'buy-now'           => 'buy-now-website',
        'contact-seller'    => 'contact-seller-website',
        // 'contact-seller'    => '1',
        'view-demo'         => 'view-demo-website',
        'ask-price'         => 'ask-price-website',
        'stats'             => 'can-view-stats-website',


    ],
    'app' =>
    [
        'price'             => 'can-view-price-app',
        'make-offer'        => 'can-make-offer-app',
        'buy-now'           => 'buy-now-app',
        'contact-seller'    => 'contact-seller-app',
        'view-demo'         => 'view-demo-app',
        'ask-price'         => 'ask-price-app',
        'stats'             => 'can-view-stats-app',


    ],
    'business' =>
    [
        //'price'             => 'can-view-price-business',
        'make-offer'        => 'can-make-offer-business',
        // 'buy-now'           => 'buy-now-business',
        'contact-seller'    => 'contact-seller-business',
        'stats'             => 'can-view-stats-business',
        // 'view-demo'         => 'view-demo-business',
        'ask-price'         => 'ask-price-business',

    ],
    'solution' =>
    [
        'price'             => 'can-view-price-solution',
        // 'make-offer'        => 'can-make-offer-solution',
        'buy-now'           => 'buy-now-solution',
        'contact-seller'    => 'contact-seller-solution',
        'view-demo'         => 'view-demo-solution',
        // 'ask-price'         => 'ask-price',

    ],
    'course' =>
    [
        'Free'             => 'free-course',
        'Standard'         => 'standard-course',
        'Special'          => 'special-course',


    ],
    'expert' =>
    [
        'contact-seller'    => 'contact-expert',
        'view-demo'         => 'view-demo-expert',


    ],

]);
/*
 * on frontend, on each page email subscriber popup opens so each page we have different tags so this constant basically contains constant for all pages.
*/
define('EMAIL_SUBSCRIBER_PAGE_TAGS',  [
    'home' => 'home',
    'websites-for-sale' => 'websites-for-sale',
    'product-category-shopify-dropship-websites-for-sale' => 'shopify-dropship-websites-for-sale',
    'starter-websites-for-sale-fashion' => 'fashion,starter-websites-for-sale',
    'starter-websites-for-sale-gadgets-electronics' => 'starter-websites-for-sale',
    'starter-websites-for-sale-health' => 'starter-websites-for-sale',
    'starter-websites-for-sale-home-decor' => 'starter-websites-for-sale',
    'starter-websites-for-sale-jewelry' => 'starter-websites-for-sale',
    'starter-websites-for-sale-pets' => 'starter-websites-for-sale',
    'starter-websites-for-sale-sports' => 'starter-websites-for-sale',
    'starter-websites-for-sale-toys' => 'starter-websites-for-sale',
    'starter-websites-for-sale-travel' => 'starter-websites-for-sale',
    'product-category-shopify-premium-dropship-websites-for-sale' => 'shopify-premium-dropship-websites-for-sale',
    'product-category-fashion' => 'fashion',
    'product-category-gadgets-electronics' => 'electronics',
    'product-category-health' => 'health',
    'product-category-jewelry' => 'jewelry',
    'product-category-pets' => 'pets',
    'product-category-sports' => 'sports',
    'product-category-toys' => 'toys',
    'product-category-travel' => 'travel',
    'product-category-ecommerce-business' => 'ecommerce-business',
    'solution' => 'solution',
    'dropshipping' => 'dropshipping',
    'dropshipping-products' => 'dropshipping-products',
    'dropshipping-websites' => 'dropshipping-websites',
    'shopify-stores-for-sale' => 'dropshipping-websites',
    'product-category-shopify-latest-dropship-websites-for-sale' => 'dropship-websites-for-sale',
    'blog' => 'blog',
    'about-us' => 'about-us',
    'get-started' => 'get-started',
    'domains' => 'domains',
    'websites' => 'websites',
    'businesses' => 'businesses',
    'apps' => 'apps',
    'solution' => 'solution',
    'contact-us' => 'contact-us',
    'course' => 'course',
    'standard-courses' => 'standard-courses',
    'special-courses' => 'special-courses',
    'faq-3' => 'faq-3',
    'faq-3-how-to-make-money-drop-shipping' => 'faq-3,how-to-make-money-drop-shipping',
    'faq-3-how-to-start-an-online-shop' => 'faq-3,how-to-start-an-online-shop',
    'faq-3-how-to-start-drop-shipping' => 'faq-3,how-to-start-drop-shipping',
    'faq-3-what-is-drop-shipping' => 'faq-3,what-is-drop-shipping',
    'signup' => 'signup',
    'login' => 'login',
    'forgotpassword' => 'forgotpassword',
    'terms-of-services' => 'terms-of-services',
    'privacy-policy' => 'privacy-policy',
    'purchase-agreement' => 'purchase-agreement'

]);

// credentials of mailchip
define("MAILCHIMP_LIST_ID", "3f9facd96c");
define("MAILCHIMP_KEY", "c206ea96def4eb579f1b7deeef8474e4");
define("MAILCHIMP_SERVER", "us2");

// show text length in desceription of all products
define('text_lenght_front', 200);
// show section wise image
define('SECTION_WISE', 4);

// set product as url before 1-dec-2020 after that solution-details
define('PRODUCT_DATE', '2020-12-1');
define('SOLUTION_DETAILS_URL', [
    'product',
    'solution-details'
]);

// set type in expert
define('EXPERT_TYPE', [
    'individual' => 'Individual',
    'business'   => 'Business',
]);


// set qualification  in expert
define('QUALIFICATION', [
    '10TH' => '10TH',
    '12TH'   => '12TH',
    'graduation'   => 'Graduation',
    'post_graduation'   => 'Post Graduation ',
]);

// set solution category  in expert
define('SOLUTION_CATEGORY', [
    'soution-cateory' => 'soution-cateory',
    'soution-cateory1' => 'soution-cateory1',
    'soution-cateory2' => 'soution-cateory2',

]);

// set solution Service  in expert
define('SOLUTION_SERVICE_TYPE', [
    'service-type' => 'service-type',
    'service-type1' => 'service-type1',
    'service-type2' => 'service-type2',
]);


// define constant location availablity (expert directory)
define('AVAILABILITY', [
    'onsite' => 'Onsite',
    'online' => 'Online',
    'offsite' => 'Offsite',

]);

// price heading
define('PRICE_HEADING', 15);

// admin id
define('ADMIN_ID', 1);

// common array price and commission
define('COMMISSION_TYPE', [
    '1' => 'Fixed',
    '2' =>  'Percentage',
]);

//Commission Base  commission_user_product
define('COMMISSION_BASE', [
    '1' => 'User Profile',
    '2' =>  'Product',
]);



// START OF LISTING HEADER PLANS 
// For now we have 4  lisiting header plans.
define('LISTING_HEADER_DOMAIN', [
    '1' => 15, //'Regular listing header',   (these id's will set from database)
    '2' => 16, //'Heightlighted listing header',
    '3' => 17, //'Permium listing header',
]);

define('LISTING_HEADER_WEBSITE', [
    '1' => 14, //'Regular listing header',   (these id's will set from database)
    '2' => 13, //'Heightlighted listing header',
    '3' => 12, //'Permium listing header',
]);


define('LISTING_HEADER_APP', [
    '1' => 18, //'Regular listing header',   (these id's will set from database)
    '2' => 19, //'Heightlighted listing header',
    '3' => 20, //'Permium listing header',
]);


define('LISTING_HEADER_BUSINESS', [
    '1' => 22, //'Regular listing header',   (these id's will set from database)
    '2' => 23, //'Heightlighted listing header',
    '3' => 24, //'Permium listing header',
]);
define('LISTING_HEADER_SPONSORSHIP', [
    '4' => 21, //'sponsorship listing header'
]);
define('SPONSORSHIP_DISPALY_LIMIT', 5);


define('LISTING_HEADER_SOLUTION', [
    '1' => 25, //'Regular listing header',   (these id's will set from database)
    '2' => 26, //'Heightlighted listing header',
    '3' => 27, //'Permium listing header',
]);
// END OF LISTING HEADER PLANS


// for display Listing-Header Plans in front
define('LISTING_HEADER', [
    '1' => 'Regular Listing',
    '2' => 'Highlighted Listing',
    '3' => 'Premium Listing',
]);


// Listing plans types is used in select option

define('LISTING_PALNS_TYPES', [
    'website' => 'Website',
    'domain' => 'Domain',
    'app' => 'App',
    'business' => 'Business',
    'solution' => 'Solution',
    'sponsored' => 'Sponsored',
]);



define('WEBSITE_ALL_PAGES',  [
    'home' => 'Home',
    'websites-for-sale' => 'Websites for Sale',
    'product-category/shopify-dropship-websites-for-sale' => 'Shopify Dropship Websites for Sale',
    'starter-websites-for-sale/fashion' => 'Starter Websites for Sale > Fashion',
    'starter-websites-for-sale/gadgets-electronics' => 'Starter Websites for Sale > Gadgets Electronics',
    'starter-websites-for-sale/health' => 'Starter Websites for Sale > Health',
    'starter-websites-for-sale/home-decor' => 'Starter Websites for Sale > Home Decor',
    'starter-websites-for-sale/jewelry' => 'Shopify Dropship Websites For Sale > Jewelry',
    'starter-websites-for-sale/pets' => 'Shopify Dropship Websites For Sale > Pets',
    'starter-websites-for-sale/sports' => 'Shopify Dropship Websites For Sale > Sports',
    'starter-websites-for-sale/toys' => 'Shopify Dropship Websites For Sale > Toys',
    'starter-websites-for-sale/travel' => 'Shopify Dropship Websites For Sale > Travel',
    'product-category/shopify-premium-dropship-websites-for-sale' => 'Shopify Premium Dropship Websites For Sale',
    'product-category/fashion' => 'Shopify Premium Dropship Websites For Sale > fashion',
    'product-category/gadgets-electronics' => 'Shopify Premium Dropship Websites For Sale > electronics',
    'product-category/health' => 'Shopify Premium Dropship Websites For Sale > health',
    'product-category/home-decor' => 'Shopify Premium Dropship Websites For Sale > Home Decor',
    'product-category/jewelry' => 'Shopify Premium Dropship Websites For Sale > jewelry',
    'product-category/pets' => 'Shopify Premium Dropship Websites For Sale > pets',
    'product-category/sports' => 'Shopify Premium Dropship Websites For Sale > sports',
    'product-category/toys' => 'Shopify Premium Dropship Websites For Sale > toys',
    'product-category/travel' => 'Shopify Premium Dropship Websites For Sale > travel',
    'product-category/ecommerce-business' => 'Shopify Premium Dropship Websites For Sale > ecommerce-business',
    'solution' => 'Solution',
    'dropshipping' => 'Dropshipping',
    'dropshipping-products' => 'Dropshipping > Winning Products',
    'dropshipping-websites' => 'Dropshipping > Dropshipping Websites',
    'shopify-stores-for-sale' => 'Dropshipping > Shopify Stores',
    'product-category/shopify-latest-dropship-websites-for-sale' => 'Shopify Premium Dropship Websites For Sale > Latest Shopify Stores',
    'blog' => 'Blog',
    'about-us' => 'About Us',
    'get-started' => 'Get Started',
    'domains' => 'Domains',
    'websites' => 'Websites',
    'businesses' => 'Businesses',
    'apps' => 'Apps',
    'solution' => 'Solution',
    'contact-us' => 'Contact Us',
    'course' => 'Course',
    'standard-courses' => 'Course > standard-courses',
    'special-courses' => 'Course > special-courses',
    'faq-3' => 'FAQ',
    'faq-3/how-to-make-money-drop-shipping' => 'FAQ > How to make money drop shipping',
    'faq-3/how-to-start-an-online-shop' => 'FAQ > How to start an online shop',
    'faq-3/how-to-start-drop-shipping' => 'FAQ > How to start drop shipping',
    'faq-3/what-is-drop-shipping' => 'FAQ > What is drop shipping',
    'signup' => 'Signup',
    'login' => 'Login',
    'forgotpassword' => 'Forgot Password',
    'terms-of-services' => 'Terms of Services',
    'privacy-policy' => 'Privacy Policy',
    'purchase-agreement' => 'Purchase Agreement',
    'expert-directory'   => 'Expert Directory'

]);
