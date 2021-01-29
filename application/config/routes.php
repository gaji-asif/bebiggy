<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'main';
// $route['default_controller'] = 'mainold';

$route['login'] = 'common/user_login';
$route['admin/login'] = 'common/admin_login';
$route['signup'] = 'common/user_signup';
$route['user'] = 'user/dashboard';
$route['user-accessed-pages'] = 'main/user_accessed_pages';

$route['activate/(:any)'] = 'common/AccountActivation/$1';
$route['postad'] = 'main/adpost';
$route['analytics/verify/(:any)'] = 'analytics/index/$1';
$route['adlisting/(:any)'] = 'main/ad_listing/$1';
$route['checkout/(:any)/(:any)'] = 'main/checkout/$1/$2';
$route['auction/(:any)/(:any)'] = 'main/single_auction/$1/$2';
$route['classified/(:any)/(:any)'] = 'main/single_offers/$1/$2';
$route['user_profile/(:any)'] = 'user/user_profile/$1';
$route['user/edit_listings/(:any)/(:any)'] = 'user/edit_listings/$1/$2';
$route['user/create_listings'] = 'user/create_listings';
$route['user/create_listings/(:any)'] = 'user/create__listings/$1';
$route['user/create_listings/(:any)/(:any)'] = 'user/create__listings/$1/$2';


$route['user/create_solution'] = 'user/createSolutions';
$route['user/create_solution/(:any)'] = 'user/createSolutions/$1';
$route['user/create_solution/(:any)/(:any)'] = 'user/createSolutions/$1/$2';
$route['user/upload_solution'] = 'user/uploadSolutionMedia';
$route['user/delete_solution_media'] = 'user/deleteSolutionMedia';
$route['user/add_solution/(:any)'] = 'user/addSolution/$1';

// edit assets
$route['admin/edit_listings/(:any)/(:any)'] = 'admin/edit_listings/$1/$2';
$route['admin/user-login/(:any)'] = 'admin/user_login/$1';
$route['user/admin-login'] = 'user/admin_login';


// admin route
$route['admin/manage-badges'] 		  	 = 'admin/listing_badges';
$route['admin/manage-advertisements'] 	 = 'admin/manage_advertisements';
$route['admin/manage-email-subscribers'] = 'admin/manage_email_subscribers';
$route['admin/manage-coupons'] 			 = 'admin/manage_coupons';
$route['admin/manage-pages-tags'] 	     = 'admin/manage_pages_tags';
$route['admin/save-pages-tags'] 	     = 'admin/save_pages_tags';

$route['admin/membership-level-list'] = 'admin/listing_membership_level';
$route['admin/membership-level-list/(:any)'] = 'admin/listing_membership_level/$1';
$route['admin/membership-level'] = 'admin/membership_level';
$route['admin/membership-level/(:any)'] = 'admin/membership_level/$1';

$route['admin/view-membership-level'] = 'admin/view_membership_level';
$route['admin/view-membership-level/(:any)'] = 'admin/view_membership_level/$1';
$route['admin/save_user_commission'] = 'admin/save_user_commission';



// permission
$route['admin/permission-list'] = 'admin/listing_permission';
$route['admin/permission-list/(:any)'] = 'admin/listing_permission/$1';
$route['admin/permission'] = 'admin/permission';
$route['admin/permission/(:any)'] = 'admin/permission/$1';
$route['admin/view-permission'] = 'admin/viewPermission';
$route['admin/view-permission/(:any)'] = 'admin/viewPermission/$1';


$route['admin/add_solution/(:any)'] = 'admin/addSolution/$1';
$route['admin/edit-solution/(:any)'] = 'admin/editSolution/$1';
$route['admin/upload_solution'] = 'admin/uploadSolutionMedia';
$route['admin/delete_solution_media'] = 'admin/deleteSolutionMedia';
$route['admin/admin_permissions/(:any)']       = 'admin/adminPermissions/$1';
$route['admin/add_permissions']       = 'admin/addAdminPermissions';
$route['admin/membership-permissions/(:any)']       = 'admin/membershipPermission/$1';
$route['admin/add-membership-level']       = 'admin/addMembershipLevel';
$route['admin/search_expert']       = 'admin/searchExpert';
$route['admin/delete-expert']       = 'admin/deleteExpert';
$route['common/get_comments_table_data/(:any)']       = 'common/get_comments_table_data/$1';
$route['common/delete_comment/(:any)/(:any)']       = 'common/delete_comment/$1/$2';
$route['common/approve_comment/(:any)/(:any)']       = 'common/approve_comment/$1/$2';

$route['product/(:any)'] = 'main/solutionDetails/$1';
$route['solution-details/(:any)'] = 'main/solutionDetails/$1';



$route['search/(:any)'] = 'main/search/$1';
$route['user/load_partial'] = 'user/loadPartialAjaxView';

$route['page/(:any)'] = 'main/view_page/$1';
$route['blog/(:any)'] = 'main/view_blog/$1';
$route['blog/(:any)/(:any)'] = 'main/view_blog/$1/$2';
$route['blog'] = 'main/blog';
$route['markascompleted'] = 'main/markAsCompletedAuto';
$route['contact-us'] = 'main/contact';
$route['auctions'] = 'main/auctions';
$route['offers'] = 'main/offers';
$route['pricing'] = 'main/newPricing';
//$route['domains'] = 'main/domains';
//$route['websites'] = 'main/websites';
//$route['apps'] = 'main/apps';
$route['user_profile/(:any)'] = 'user/user_profile/$1';

$route['user-membership-list'] = 'user/userMembershipList';


$route['forgotpassword'] = 'common/reset_password';
$route['reset/(:any)'] = 'common/password_reset_request/$1';
$route['resetPassword/(:any)'] = 'common/reset_password_complete/$1';

/*Language*/
$route['language/(:any)'] = 'LanguageSwitcher/switchLang/$1';

$route['404_override'] = 'common/pageNotFound';

$route['translate_uri_dashes'] = FALSE;

// new user

$route['user/create_post'] = 'user/createPost';
$route['user/list_post'] = 'user/listPost';
$route['user/become-expert'] = 'user/becomeExpert';
$route['user/addProfileBecomeExpert'] = 'user/addProfileBecomeExpert';
$route['user/contact-expert'] = 'user/contactExpert';
$route['admin/expert-directory'] = 'admin/expertDirectory';
$route['admin/expert-directory/(:any)'] = 'admin/expertDirectory/$1';
$route['admin/edit-expert/(:any)'] = 'admin/editExpert/$1';
$route['admin/addProfileBecomeExpert'] = 'admin/addProfileBecomeExpert';
$route['admin/users-membership-list'] = 'admin/allUsersMembershipList';
$route['admin/users-membership-list/(:any)'] = 'admin/allUsersMembershipList/$1';
$route['admin/user-wise-membership-list/(:any)'] = 'admin/userWiseMembershipList/$1';
$route['admin/view_comments/(:any)'] = 'admin/view_comments/$1';
$route['admin/view_comments'] = 'admin/view_comments';

// new routs
// $route['temp-page']		='template/page';
// $route['temp-home']	='template/home'; 1
// $route['temp-course']	='template/course';1
// $route['temp-course_detail']	='template/course_detail';1
// $route['temp-about']	='template/about'; 1
// $route['temp-contact']	='template/contact'; 1
// $route['temp-blog']	='template/blog';1
// $route['temp-faq']	='template/faq'; 1
// $route['pricing']	='main/priceShow';

// Frontend routes
$route['faq-3']                        =    'main/faq';
$route['about-us']                    =    'main/about';
$route['course']                    =    'main/course';
$route['course/(:any)']             =   'main/course/$1';
$route['course-detail']                =    'main/courseDetail';
$route['course-detail/(:any)']      =   'main/courseDetail/$1';

$route['faq-3/what-is-drop-shipping']               =   'main/whatIsDropShipping';
$route['faq-3/how-to-make-money-drop-shipping']     =   'main/makeMoneyDropShipping';
$route['faq-3/how-to-start-an-online-shop']         =   'main/startOnlineShop';
$route['faq-3/how-to-start-drop-shipping']         =   'main/howToStartDropshopping';

$route['expert-directory'] = 'main/expertDirectory';
$route['expert-directory/(:any)'] = 'main/expertDirectory/$1';
$route['about-expert/(:any)'] = 'main/aboutExpert/$1';



$route['solution'] = 'main/solution';
$route['websites-for-sale']         =   'main/websitesForSale';

$route['product-category/shopify-dropship-websites-for-sale']                   =   'main/shopifyDropWebsitesForSale';
$route['product-category/shopify-dropship-websites-for-sale/(:any)']             =   'main/shopifyDropWebsitesForSale/$1';


$route['product-category/shopify-premium-dropship-websites-for-sale']   =   'main/websitesForPremiumSale';
$route['product-category/shopify-premium-dropship-websites-for-sale/(:any)']   =   'main/websitesForPremiumSale/$1';


$route['product-category/exclusive-shopify-dropship-stores-for-sale']   =   'main/websitesForExclusiveSale';
$route['product-category/exclusive-shopify-dropship-stores-for-sale/(:any)']   =   'main/websitesForExclusiveSale/$1';


$route['product-category/shopify-latest-dropship-websites-for-sale']   =   'main/websitesForLatestSale';
$route['product-category/shopify-latest-dropship-websites-for-sale/(:any)']   =   'main/websitesForLatestSale/$1';

// MarketPlace
$route['domains'] = 'main/newDomain';
$route['domains/(:any)'] = 'main/newDomain/$1';

$route['websites'] = 'main/newWebsite';
$route['websites/(:any)'] = 'main/newWebsite/$1';

$route['businesses'] = 'main/newBusiness';
$route['businesses/(:any)'] = 'main/newBusiness/$1';

$route['apps'] = 'main/newApps';
$route['apps/(:any)'] = 'main/newApps/$1';

//-- cronjob route here ---
$route['plans-vaidate'] = 'cronjob/getListingHeaderPlanValidate';
// cronjob route end

//-- search main header 
$route['q'] = 'main/searchFor';

// $route['product-category/shopify-premium-dropship-websites-for-sale']   =   'main/dropShipping';
$route['product-category/ecommerce-business']                             =   'main/ecommerceBusiness';

$route['get-started']               =   'main/getStarted';

$route['static-products/(:any)']    =   'main/static_product/$1';

/*Footer Pages*/
$route['terms-of-services']               =   'main/terms_of_services';
$route['privacy-policy']               =   'main/privacy_policy';
$route['purchase-agreement']               =   'main/purchase_agreement';

/*Dropshipping*/
$route['dropshipping']               =   'main/dropshipping';


$route['starter-websites-for-sale/fashion']                 =   'main/starterWebsitesForSaleFashion';
$route['starter-websites-for-sale/fashion/(:any)']                 =   'main/starterWebsitesForSaleFashion/$1';

// $route['websites-for-sale']                                 =   'main/starterWebsitesForSale';
$route['starter-websites-for-sale/gadgets-electronics']     =   'main/starterWebsitesForSaleGadgetsElectronics';
$route['starter-websites-for-sale/health']                  =   'main/starterWebsitesForSaleHealth';
$route['starter-websites-for-sale/home-decor']              =   'main/starterWebsitesForSaleHomeDecor';
$route['starter-websites-for-sale/jewelry']                 =   'main/starterWebsitesForSaleJewelry';
$route['starter-websites-for-sale/pets']                    =   'main/starterWebsitesForSalePets';
$route['starter-websites-for-sale/sports']                  =   'main/starterWebsitesForSaleSports';
$route['starter-websites-for-sale/toys']                    =   'main/starterWebsitesForSaleToys';
$route['starter-websites-for-sale/travel']                  =   'main/starterWebsitesForSaleTravel';

$route['product-category/fashion']                          =   'main/productCategoryFashion';
$route['product-category/fashion/(:any)']                   =   'main/productCategoryFashion/$1';

$route['product-category/gadgets-electronics']              =   'main/productCategoryGadgetsElectronics';
$route['product-category/gadgets-electronics/(:any)']       =   'main/productCategoryGadgetsElectronics/$1';

$route['product-category/health']                           =   'main/productCategoryHealth';
$route['product-category/health/(:any)']                    =   'main/productCategoryHealth/$1';

$route['product-category/jewelry']                          =   'main/productCategoryJewelry';
$route['product-category/jewelry/(:any)']                   =   'main/productCategoryJewelry/$1';

$route['product-category/pets']                             =   'main/productCategoryPets';
$route['product-category/pets/(:any)']                      =   'main/productCategoryPets/$1';

$route['product-category/sports']                            =   'main/productCategorySport';
$route['product-category/sports/(:any)']                     =   'main/productCategorySport/$1';

$route['product-category/toys']                             =   'main/productCategoryToys';
$route['product-category/toys/(:any)']                      =   'main/productCategoryToys/$1';

$route['product-category/travel']                           =   'main/productCategoryTravel';
$route['product-category/travel/(:any)']                    =   'main/productCategoryTravel/$1';

$route['product-category/home-decor']                           =   'main/productCategoryHomeDecor';
$route['product-category/home-decor/(:any)']                    =   'main/productCategoryHomeDecor/$1';



$route['dropshipping-products']               =   'main/dropshippingProducts';
$route['dropshipping-products/(:any)']               =   'main/dropshippingProducts/$1';
$route['dropshipping-websites']               =   'main/dropshippingWebsites';
$route['shopify-stores-for-sale']               =   'main/shopifyStoresForSale';
$route['special-courses']               =   'main/specialCourses';
$route['standard-courses']               =   'main/standardCourses';
// $route['']               =   'main/dropshipping';
// $route['']               =   'main/dropshipping';
// $route['']               =   'main/dropshipping';
// $route['']               =   'main/dropshipping';
// $route['']               =   'main/dropshipping';
// $route['']               =   'main/dropshipping';
// $route['']               =   'main/dropshipping';
