<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

	private static $data = array();

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('helperssl'));
		$this->load->model('chat/ChatOperationsHandler', 'chat');
		$this->load->model('DatabaseOperationsHandler', 'database');
		$this->load->model('CommonOperationsHandler', 'common');
		$this->load->model('EmailOperationsHandler', 'email_op');

		self::$data['categoriesData']		=	$this->database->_count_listings_categories_wise();
		self::$data['languages']			=	$this->database->load_all_languages();
		self::$data['default_currency']		=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies', array('default_status' => '1'), 'currency'), 'symbol');
		self::$data['userdata'] 			= 	$this->database->getUserData($this->session->userdata('user_id'));
		self::$data['selectedLanguage'] 	= 	$this->common->is_language();
		self::$data['language'] 			= 	$this->database->_get_single_data('tbl_languages', array('status' => 1, 'default_status' => 1), 'language_code');
		self::$data['listingCount']			= 	$this->database->_count_listings_user_wise();
		self::$data['messageCount']			= 	$this->chat->get_unviewed_msg($this->session->userdata('user_id'));
		self::$data['imagesData']			=	$this->database->_get_row_data('tbl_siteimages', array('id' => 1));
		self::$data['announcements']        =   $this->database->_get_row_data('tbl_announcement', array('status' => 1));
		self::$data['payments']             =   $this->database->_get_row_data('tbl_payment_settings', array('status' => 1));
		self::$data['settings']             =   $this->database->_get_row_data('tbl_settings', array('id' => 1));
		self::$data['pages']                =   $this->database->_get_row_data('tbl_pages', array('page_visibility_status' => 1));
		self::$data['ads']                	=   $this->database->_get_row_data('tbl_ads', array('id' => 1));
		self::$data['token'] 				= 	$this->security->get_csrf_hash();
		self::$data['platforms']   	 		=   $this->database->_get_row_data('tbl_platforms', array('type' => 'listing', 'status' => 1));
		self::$data['options']              =   $this->database->_get_row_data('tbl_platforms', array('type' => 'option', 'status' => 1));

		if (self::$data['settings'][0]['ssl_enable'] === '1') {
			force_ssl();
		}

		$this->getUserMembershipLevel();
		//pre(fileCache(getUserSlug("_permission"), " ", "get"));

	}

	public function getUserMembershipLevel()
	{
		$user_id = $this->session->userdata('user_id');

		if (!fileCache(getUserSlug("_permission"), " ", "get") && $user_id) {

			$membership_permissions = 0;
			$user = $this->database->_get_row_data('tbl_users', ['user_id' => $user_id]);
			@$membership_level_id = $user[0]['membership_level'];

			if (!empty($membership_level_id)) {
				$membership_permissions = $this->database->getUserAllowePermission($membership_level_id, $user);
				fileCache(getUserSlug("_permission"), $membership_permissions,  "save");
			}
		} else if (empty($user_id)) {

			$membership_level_id	=	$this->database->_get_single_data('tbl_membership_level', ['is_guest' => 1], 'id');
			$membership_permissions = 	$this->database->getUserAllowePermission($membership_level_id);

			fileCache(getUserSlug("_permission"), $membership_permissions,  "save");
		}
	}

	public function index()
	{

		if (!empty($this->session->userdata('user_id')) && $this->session->userdata('user_level') == 1) {
		}
		$this->home();


		/**
		 * put sample to see the permission
		 */
		// pre(fileCache(getUserSlug("_permission"), " ", "get"));

	}


	/*Homepage*/
	public function home()
	{


		// $data = self::$data;
		// $data['sponsoredAds']		= 	$this->database->_get_specific_listing();
		// $data['slider_name']		= 	'featured-slider';
		// $data['endingSoon']			=   $this->database->_get_auction_ending_soon('', 'app');
		// $data['domainlist']			=   $this->partition($this->database->_get_row_data('tbl_listings', array('listing_type' => 'domain', 'status' => 1), 30, '', true), 3);

		// $data['featuredPosts']		= 	$this->database->_fetch_blog_posts(RESULTS_PER_BLOG, 0, false, 'views');

		// // stop-----
		// // $data['featuredDomains']	=	$this->database->_get_selected_listing_types('date', 0, RESULTS_PER_HOMEPAGE, array('tbl_listings.listing_type' => 'domain'));
		// // $data['soldDomains']		=	$this->database->_get_selected_listing_types('date', 1, RESULTS_PER_HOMEPAGE, array('tbl_listings.listing_type' => 'domain'));
		// // $data['auctionedDomains']	=	$this->database->_get_selected_listing_types('date', 0, RESULTS_PER_HOMEPAGE, array('tbl_listings.listing_type' => 'domain', 'listing_option' => 'auction'));
		// // $data['featuredApps']		=	$this->database->_get_selected_listing_types('date', 0, RESULTS_PER_HOMEPAGE, array('tbl_listings.listing_type' => 'app'), '');
		// // end-----------------

		// $pageName = "home";

		// // Buy Featured Premium Shopify Dropship Stores & Ecommerce Websites for sale
		// $data['featuredWebsite']	=	$this->database->_get_selected_listing_types_frontend('date', 0, RESULTS_PER_HOMEPAGE, array('tbl_listings.listing_type' => 'website', 'frontend_section' => 'featured'), 'app', $pageName);


		// //BUY PREMIUM SHOPIFY STORES & DROPSHIP WEBSITES FOR SALE
		// $data['premiumWebsites']	=	$this->database->_get_selected_listing_types_frontend('date', 0, RESULTS_PER_HOMEPAGE, array('tbl_listings.listing_type' => 'website', 'frontend_section' => 'premium'), 'app', $pageName);

		// //BUY LATEST SHOPIFY STORES & DROPSHIP WEBSITES FOR SALE
		// $data['latestWebsites']	=	$this->database->_get_selected_listing_types_frontend('date', 0, RESULTS_PER_HOMEPAGE, array('tbl_listings.listing_type' => 'website', 'frontend_section' => 'latest'), 'app', $pageName);

		// $data['featuredApp']		=	$this->database->_get_selected_listing_types('date', 0, RESULTS_PER_HOMEPAGE, array('tbl_listings.listing_type' => 'app'));

		// $data['featuredBusiness']	=	$this->database->_get_selected_listing_types('date', 0, RESULTS_PER_HOMEPAGE, array('tbl_listings.listing_type' => 'business'));
		// $data['blogs']				= 	$this->database->_fetch_blog_posts(RESULTS_PER_BLOG, 0, false, 'date');

		$data = self::$data;
		$perPage =  SECTION_WISE;
		$page = $this->input->get('page') ?? 1;
		$searchterm = $this->input->get('search') ?? "";

		// Buy Featured Premium Shopify Dropship Stores & Ecommerce Websites for sale
		$pageName = PAGESNAME_SECTION['home_feature'];
		$data['featuredWebsite']	=	$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');

		$data['featuredWebsite']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];



		//BUY PREMIUM SHOPIFY STORES & DROPSHIP WEBSITES FOR SALE
		$pageName = PAGESNAME_SECTION['home_premium'];
		$data['premiumWebsites']	=	$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['premiumWebsites']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];


		//BUY LATEST SHOPIFY STORES & DROPSHIP WEBSITES FOR SALE
		$pageName = PAGESNAME_SECTION['home_latest'];
		$data['latestWebsites']	=		$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['latestWebsites']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];


		$data['featuredApp']		=	$this->database->_get_selected_listing_types('date', 0, RESULTS_PER_HOMEPAGE, array('tbl_listings.listing_type' => 'app'));

		$data['featuredBusiness']	=	$this->database->_get_selected_listing_types('date', 0, RESULTS_PER_HOMEPAGE, array('tbl_listings.listing_type' => 'business'));
		$data['blogs']				= 	$this->database->_fetch_blog_posts(RESULTS_PER_BLOG, 0, false, 'date');
		$data['heading'] = "";
		// $this->loadPage('websites-for-sale', $data);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');


		// $data['home_type_1']	=	$this->database->_get_row_data('tbl_frontend_products', array('status' => '1', 'item_type'=>'home_type_1'), '', true);
		// $data['home_type_2']	=	$this->database->_get_row_data('tbl_frontend_products', array('status' => '1', 'item_type'=>'home_type_2'), '', true);
		// $data['home_type_3']	=	$this->database->_get_row_data('tbl_frontend_products', array('status' => '1', 'item_type'=>'home_type_3'), '', true);
		// $data = html_escape($this->security->xss_clean($data));
		// $data['home_type_1']			=   $this->database->_get_row_data('tbl_listings', array('listing_type' => 'home_type_1', 'status' => 0));
		// pre($data, 1);
		// $this->loadPage('home_Static_Home_page', $data);

		$data['heading'] = "";

		//code to show promotion message on home page
		$text_below_main_menu = fileCache("text_below_main_menu", "",  "get");
		if (trim($text_below_main_menu) == "") {
			// it means cache does not have data
			$text_below_main_menu_arr  =  $this->database->_get_row_data('tbl_advertisement', array('type' => 'text_below_main_menu', 'text_or_icon!=' => NULL, 'text_or_icon!=' => ""));
			if (isset($text_below_main_menu_arr[0]) && isset($text_below_main_menu_arr[0]['text_or_icon'])) {
				fileCache("text_below_main_menu", $text_below_main_menu_arr[0]['text_or_icon'],  "save");
				$data['text_below_main_menu'] = $text_below_main_menu_arr[0]['text_or_icon'];
			}
		} else {
			$data['text_below_main_menu'] = $text_below_main_menu;
		}



		$this->loadPage('home', $data);
	}

	/*Contact Page*/
	public function contact()
	{
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_contact');
		$this->loadPage('contact', $data);
	}

	/*Not found Page*/
	public function pageNotFound()
	{
		$this->load->view('main/404');
	}

	/*Offers Page*/
	public function offers($page = 0)
	{
		$data = self::$data;
		$data['offers'] 			= 	$this->database->_get_offers_data(array('tbl_listings.listing_option' => 'classified'), RESULTS_PER_PAGE, false, $page);
		$data = html_escape($this->security->xss_clean($data));
		$data['links'] 				=	$this->offer_pagination_loader(array('tbl_listings.listing_option' => 'classified'), $page);
		$this->load->view('main/offers', $data);
	}

	/* Offers pagination*/
	public function offers_pag($type, $page)
	{
		$page = intval($page);
		$data = self::$data;
		if (!empty($type)) {
			switch ($type) {
				case 'tab-all':
					$data['offers'] 		= $this->database->_get_offers_data(array('tbl_listings.listing_option' => 'classified'), RESULTS_PER_PAGE, false, $page);
					$data 					= html_escape($this->security->xss_clean($data));
					$data["links"] 			= $this->offer_pagination_loader(array('tbl_listings.listing_option' => 'classified'), $page);
					break;
				case 'tab-websites':
					$data['offers'] 		= $this->database->_get_offers_data(array('tbl_listings.listing_option' => 'classified', 'tbl_listings.listing_type' => 'website'), RESULTS_PER_PAGE, false, $page);
					$data 					= html_escape($this->security->xss_clean($data));
					$data["links"] 			= $this->offer_pagination_loader(array('tbl_listings.listing_option' => 'classified', 'tbl_listings.listing_type' => 'website'), $page);
					break;
				case 'tab-domains':
					$data['offers'] 		= $this->database->_get_offers_data(array('tbl_listings.listing_option' => 'classified', 'tbl_listings.listing_type' => 'domain'), RESULTS_PER_PAGE, false, $page);
					$data 					= html_escape($this->security->xss_clean($data));
					$data["links"] 			= $this->offer_pagination_loader(array('tbl_listings.listing_option' => 'classified', 'tbl_listings.listing_type' => 'domain'), $page);
					break;
				default:
					return;
			}
		}

		$response 			= $this->load->view('main/add-ons/offers-table', $data, TRUE);
		$data['response'] 	= $response;
		$data['token'] 		= $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode($data));
	}


	/*Auctions Page*/
	public function auctions($page = 0)
	{
		$data = self::$data;
		$data['auctions'] 			= 	$this->database->_get_auction_data(array('tbl_listings.listing_option' => 'auction'), RESULTS_PER_PAGE, false, false, $page);
		$data = html_escape($this->security->xss_clean($data));
		$data['links'] 				=	$this->auction_pagination_loader(array('tbl_listings.listing_option' => 'auction'), $page);
		$this->load->view('main/auctions', $data);
	}

	/* Auctions pagination*/
	public function auction_pag($type, $page)
	{
		$page = intval($page);
		$data = self::$data;
		if (!empty($type)) {
			switch ($type) {
				case 'tab-all':
					$data['auctions'] 		= $this->database->_get_auction_data(array('tbl_listings.listing_option' => 'auction'), RESULTS_PER_PAGE, false, false, $page);
					$data 					= html_escape($this->security->xss_clean($data));
					$data["links"] 			= $this->auction_pagination_loader(array('tbl_listings.listing_option' => 'auction'), $page);
					break;
				case 'tab-ending':
					$data['auctions'] 		= $this->database->_get_auction_data(array('tbl_listings.listing_option' => 'auction'), RESULTS_PER_PAGE, true, false, $page, '', true);
					$data 					= html_escape($this->security->xss_clean($data));
					$data["links"] 			= $this->auction_pagination_loader(array('tbl_listings.listing_option' => 'auction'), $page, true);
					break;
				case 'tab-sold':
					$data['auctions'] 		= $this->database->_get_auction_data(array('tbl_listings.sold_status' => '1'), RESULTS_PER_PAGE, false, false, $page);
					$data 					= html_escape($this->security->xss_clean($data));
					$data["links"] 			= $this->auction_pagination_loader(array('tbl_listings.sold_status' => '1'), $page);
					break;
				default:
					return;
			}
		}

		$response 			= $this->load->view('main/add-ons/auctions-table', $data, TRUE);
		$data['response'] 	= $response;
		$data['token'] 		= $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode($data));
	}

	/*Checkout Page*/
	// Old Code
	/*public function checkout($type, $id)
	{
		$data = self::$data;
		$data['error']   =   $this->session->userdata('error');
		$this->session->unset_userdata('error');
		$this->session->set_userdata('url', current_url());
		$this->common->is_logged();

		$data['name'] 		= '';
		$data['amount'] 	= '';
		$data['fee'] 		= 0;
		$data['currency'] 	= $data['default_currency'];
		$data['percentage'] = $data['settings'][0]['processing_fee'];
		$data['total'] 		= '';

		if (!empty($type)) {
			switch ($type) {
				case 'buynow':
					$data['listing_data'] =	$this->database->_get_row_data('tbl_listings', array('id' => $id), '', true);
					if (!empty($data['listing_data'])) {
						$data['type'] 		= 'buynow';
						$data['id'] 		= $id;
						$data['name'] 		= $data['listing_data'][0]['website_BusinessName'];
						$data['amount'] 	= $data['listing_data'][0]['website_buynowprice'];
						if (!empty($data['percentage']) && $data['percentage'] > 0) {
							$data['fee'] 	= (floatval($data['amount']) * (floatval($data['percentage']))) / 100;
						}
						$data['currency'] 	= $data['default_currency'];
						$data['total'] 		= floatval($data['amount']) + floatval($data['fee']);
						$data['owner_id'] 	= $data['listing_data'][0]['user_id'];
					}
					break;
				case 'contract':
					$data['contract']			=	$this->database->_get_contract($id);
					if (!empty($data['contract'])) {
						$data['listing_data']	=	$this->database->_get_row_data('tbl_listings', array('id' => $data['contract'][0]['listing_id']), '', true);
						$data['type'] 			= 'contract';
						$data['id'] 			= $data['contract'][0]['listing_id'];
						$data['name'] 			= 'CONTRACT NO' . '-' . '(' . '#' . $data['contract'][0]['contract_id'] . ')';

						if ($data['contract'][0]['type'] === 'bid') {
							$data['biddata']	= 	$this->database->_get_bid($data['contract'][0]['bid_id']);
						}

						if ($data['contract'][0]['type'] === 'offer') {
							$data['biddata']	= 	$this->database->_get_offer($data['contract'][0]['bid_id']);
						}

						$data['amount'] 		= $data['biddata'][0]['bid_amount'];
						if (!empty($data['percentage']) && $data['percentage'] > 0) {
							$data['fee'] 		= (floatval($data['amount']) * (floatval($data['percentage']))) / 100;
						}
						$data['currency'] 		= $data['default_currency'];
						$data['total'] 			= floatval($data['amount']) + floatval($data['fee']);
						$data['contract_id'] 	= $data['contract'][0]['id'];
						$data['owner_id'] 		= $data['contract'][0]['owner_id'];
					}
					break;
				default:
					return;
			}
		}

		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('main/checkout', $data);
	}*/

	public function checkout($type, $id)
	{

		//pre("$type,$id" , 1);
		$data = self::$data;
		$data['error']   =   $this->session->userdata('error');
		$this->session->unset_userdata('error');
		$this->session->set_userdata('url', current_url());
		$this->common->is_logged();

		$data['name'] 		= '';
		$data['amount'] 	= '';
		$data['fee'] 		= 0;
		$data['currency'] 	= $data['default_currency'];
		$data['percentage'] = $data['settings'][0]['processing_fee'];
		$data['total'] 		= '';

		if (!empty($type)) {

			switch ($type) {
				case 'buynow':
					$id = 	$this->database->_get_row_data('tbl_listings', array('slug' => $id))[0]['id'];

					$data['listing_data'] =	$this->database->_get_row_data('tbl_listings', array('id' => $id), '', true);

					if (count($data['listing_data']) > 0) {
						if (!empty($data['listing_data'])) {
							$data['type'] 		= 'buynow';
							$data['id'] 		= $id;
							$data['name'] 		= $data['listing_data'][0]['website_BusinessName'];
							$data['amount'] 	= $data['listing_data'][0]['website_buynowprice'];
							if (!empty($data['percentage']) && $data['percentage'] > 0) {
								$data['fee'] 	= (floatval($data['amount']) * (floatval($data['percentage']))) / 100;
							}
							$data['currency'] 	= $data['default_currency'];
							$data['total'] 		= floatval($data['amount']) + floatval($data['fee']);
							$data['owner_id'] 	= $data['listing_data'][0]['user_id'];
							$this->session->set_userdata('checkout_actual_total_', floatval($data['amount']));
							$this->session->set_userdata('checkout_fee_', floatval($data['fee']));
						}
					} else {
						$this->pageNotFound();
					}
					break;


					// Custom code to checkout the solution
				case 'buynow-solution':

					$solutionRow = $this->database->_get_row_data('tbl_solutions', array('slug' => $id));
					$solutionRow = $this->database->_get_row_data('tbl_listings', array('solution_id' => $solutionRow[0]['id']));
					$id = $solutionRow[0]['id'];

					/**
					 * This code is commented now due to change in logic.
					 */
					// $data['listing_data'] =	$this->database->_get_row_data('tbl_solutions', array('id' => $id), '', true);

					// if (!empty($data['listing_data'])) {
					// 	$data['type'] 		= 'buynow';
					// 	$data['id'] 		= $id;
					// 	$data['name'] 		= $data['listing_data'][0]['name'];
					// 	$data['amount'] 	= $data['listing_data'][0]['price'];
					// 	if (!empty($data['percentage']) && $data['percentage'] > 0) {
					// 		$data['fee'] 	= (floatval($data['amount']) * (floatval($data['percentage']))) / 100;
					// 	}
					// 	$data['currency'] 	= $data['default_currency'];
					// 	$data['total'] 		= floatval($data['amount']) + floatval($data['fee']);
					// 	$data['owner_id'] 	= $data['listing_data'][0]['user_id'];
					// }

					/**
					 * Solution table data is duplicate due to payment system become common.
					 * so individual soltuion getting data from listing table .
					 */
					$data['listing_data']   =	$this->database->_get_row_data('tbl_listings', array('id' => $id), '', true);

					/**
					 * below common helper function is for testing purporse
					 * pre($data['listing_data'] , 1);
					 */


					if (!empty($data['listing_data'])) {
						$data['type'] 			= 'buynow';
						$data['solution_id'] 	= $id;
						$data['name'] 			= $data['listing_data'][0]['website_BusinessName'];
						$data['amount'] 		= $data['listing_data'][0]['website_buynowprice'];
						if (!empty($data['percentage']) && $data['percentage'] > 0) {
							$data['fee'] 	= (floatval($data['amount']) * (floatval($data['percentage']))) / 100;
						}
						$data['currency'] 	= $data['default_currency'];
						$data['total'] 		= floatval($data['amount']) + floatval($data['fee']);
						$data['owner_id'] 	= $data['listing_data'][0]['user_id'];
						$data['id'] 	= $id;
						$this->session->set_userdata('checkout_actual_total_', floatval($data['amount']));
						$this->session->set_userdata('checkout_fee_', floatval($data['fee']));
					}


					// Set this session varaible here and used in payment.php file
					$this->session->set_userdata('lisiting_type', 'solution');
					break;
				case 'contract':
					//$id = 	$this->database->_get_row_data('tbl_listings', array('slug' => $id))[0]['id'];
					$data['contract']			=	$this->database->_get_contract($id);

					if (!empty($data['contract'])) {
						$data['listing_data']	=	$this->database->_get_row_data('tbl_listings', array('id' => $data['contract'][0]['listing_id']), '', true);

						$data['type'] 			= 'contract';
						$data['id'] 			= $data['contract'][0]['listing_id'];
						$data['name'] 			= 'CONTRACT NO' . '-' . '(' . '#' . $data['contract'][0]['contract_id'] . ')';

						if ($data['contract'][0]['type'] === 'bid') {
							$data['biddata']	= 	$this->database->_get_bid($data['contract'][0]['bid_id']);
						}

						if ($data['contract'][0]['type'] === 'offer') {
							$data['biddata']	= 	$this->database->_get_offer($data['contract'][0]['bid_id']);
						}

						$data['amount'] 		= $data['biddata'][0]['bid_amount'];
						if (!empty($data['percentage']) && $data['percentage'] > 0) {
							$data['fee'] 		= (floatval($data['amount']) * (floatval($data['percentage']))) / 100;
						}
						$data['currency'] 		= $data['default_currency'];
						$data['total'] 			= floatval($data['amount']) + floatval($data['fee']);
						$data['contract_id'] 	= $data['contract'][0]['id'];
						$data['owner_id'] 		= $data['contract'][0]['owner_id'];
						$this->session->set_userdata('checkout_actual_total_', floatval($data['amount']));
						$this->session->set_userdata('checkout_fee_', floatval($data['fee']));
						//pre($data);
						//pre($data['listing_data'],1);
					}
					break;
				case 'membership':

					$user 							=   $this->database->getUserData($this->session->userdata('user_id'));
					$old_membership_id  			= "";
					$balance_amount 				= 0;
					$row = $this->database->_get_row_data('tbl_membership_level', "id = " . $user[0]['membership_level']);
					if (!empty($user)) {
						if (!empty($user[0]['membership_level']) && ($row[0]['is_guest'] != 1) &&  $row[0]['is_default'] != 1) {

							$membershipId 					= 	$user[0]['membership_level'];
							$membership_assign_date 		= 	$user[0]['membership_assign_date'];
							$old_membership 				= 	$this->database->_get_row_data('tbl_membership_level', "id = $membershipId");

							$current_date 				    =  	date("Y-m-d");
							$old_membership_id 				=   $old_membership[0]['id'];
							$old_memberhsip_validity 		=  	$old_membership[0]['validity'];
							$old_membership_price			= 	$old_membership[0]['price'];

							if (!empty($old_memberhsip_validity) && !empty($old_membership_price)) {

								$old_membership_end_date 		=   date('Y-m-d', strtotime($membership_assign_date . ' + ' . $old_memberhsip_validity . ' days'));
								$old_memberhsip_price_per_day 	=  number_format((float)($old_membership_price / $old_memberhsip_validity), 3, '.', '');

								if ($old_membership_end_date > $current_date) {
									$now = time(); // or your date as well
									$your_date 		= strtotime($old_membership_end_date);
									$datediff		= $your_date - $now;
									$balance_days   =	round($datediff / (60 * 60 * 24));
									$balance_amount =  number_format((float)($balance_days * $old_memberhsip_price_per_day), 2, '.', '');
								}
							}

							// pre("balance days " . $balance_days);
							// pre("balance amount " . $balance_amount);$old_membership_price
							// pre("assign-date " . $membership_assign_date);
							// pre($old_memberhsip_validity);
							// pre($old_membership, 1);
						}
					}
					$membership 	= 	$this->database->_get_row_data('tbl_membership_level', array('slug' => $id));
					$id 			= 	$membership[0]['id'];
					// pre($id);
					// pre($membershipId);
					// pre($old_membership_price);
					// echo 'pric--';
					// pre($membership[0]['price'] >= $old_membership_price);echo "---id";
					// pre($id !=  $membershipId);
					// pre($membership[0]['price'], 1);
					if (!empty($old_memberhsip_validity) && !empty($old_membership_price)) {
						if (($membership[0]['price'] <= $old_membership_price) || ($id ==  $membershipId)) {
							$this->session->set_flashdata('error_membership', 'You Can Not Downgrade Membership Plan.');
							redirect(site_url('pricing'));
						}
					}

					//pre($id);
					// pre($membershipId);
					// pre($old_membership_price);
					// echo 'pric--';
					// pre($membership[0]['price'] >= $old_membership_price);echo "---id";
					// pre($id !=  $membershipId);
					// pre($membership[0]['price'], 1);
					$data['listing_data']   =	$this->database->_get_row_data('tbl_membership_level', array('id' => $id), '', true);


					if (!empty($data['listing_data'])) {
						$data['type'] 				= 	'buynow';
						$data['name'] 				= 	$data['listing_data'][0]['name'];
						$data['amount'] 			= 	$data['listing_data'][0]['price'];
						$data['balance_amount']		=	$balance_amount;
						// comment the processing fees

						// if (!empty($data['percentage']) && $data['percentage'] > 0) {
						// //	$data['fee'] 	= (floatval($data['amount']) * (floatval($data['percentage']))) / 100;
						// }

						$data['currency'] 			= 	$data['default_currency'];
						//$data['total'] 			= 	floatval($data['amount']) + floatval($data['fee']);
						$data['total'] 				= 	floatval($data['amount']) - floatval($data['balance_amount']);
						$data['owner_id'] 			= 	ADMIN_ID;
						$data['id'] 				= 	$id;
						$data['membership_buy'] 	= 	"membership_buy";
						if (!empty($balance_amount)) {
							$this->session->set_userdata('checkout_actual_total_', floatval($data['total']));
						} else {
							$this->session->set_userdata('checkout_actual_total_', floatval($data['amount']));
						}
						// $this->session->set_userdata('checkout_fee_', floatval($data['fee']));
						$this->session->set_userdata('membership_buy_module', 'membership_buy_module');
						$this->session->set_userdata('checkout_fee_', 0);
						$this->session->set_userdata('old_membership_id', $old_membership_id);
						$this->session->set_userdata('old_memberhip_balance_amount', $balance_amount);
					}


					// Set this session varaible here and used in payment.php file
					$this->session->set_userdata('lisiting_type_membership', 'membership');
					break;
				default:
					return;
			}
		}

		//$data = html_escape($this->security->xss_clean($data));
		// $this->load->view('main/checkout', $data);
		$this->loadPage('checkout-new', $data);
	}

	/*validate discount coupons*/
	public function validate_discount_code()
	{
		$token 							= 	$this->security->get_csrf_hash();
		return $this->database->discount_coupons($token);
	}

	/*view page*/
	public function view_page($id)
	{
		$data = self::$data;
		$data['page']			= $this->database->_get_row_data('tbl_pages', array('page_id' => $id, 'page_visibility_status' => 1), '', false, array('txt_page_url_slug' => $id));
		$data['sponsoredAds']	= $this->database->_get_specific_listing();
		$data['slider_name']	= 'featured-slider-page';
		if (!empty($data['page'])) {
			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('main/page', $data);
			return;
		}
		$this->pageNotFound();
	}

	// Updated Code
	public function blog_comments_loader($page, $blog_id, $id)
	{
		$config = array();
		$config["base_url"] 					= base_url() . '/blog/' . $id;
		$config["total_rows"] 					= $this->database->_get_comments(RESULTS_PER_BLOG, 0, true, $blog_id, 'blog');
		$config["per_page"] 					= RESULTS_PER_COMMENT;
		$config['use_page_numbers'] 			= TRUE;

		$config['num_tag_open'] 				= '<li class="page-item">';
		$config['num_tag_close'] 				= '</li>';
		$config['cur_tag_open'] 				= '<li class="page-item"><a class="page-link active">';
		$config['cur_tag_close']				= '</a></li>';
		$config['prev_tag_open'] 				= '<li class="page-item">';
		$config['prev_tag_close'] 				= '</li>';
		$config['first_tag_open'] 				= '<li class="page-item">';
		$config['first_tag_close']				= '</li>';
		$config['last_tag_open'] 				= '<li class="page-item">';
		$config['last_tag_close'] 				= '</li>';

		$config['prev_link'] 					= '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
		$config['prev_tag_open'] 				= '<li class="page-item">';
		$config['prev_tag_close'] 				= '</li>';

		$config['next_link']		 			= '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
		$config['next_tag_open'] 				= '<li class="page-item">';
		$config['next_tag_close'] 				= '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	/*view page*/
	public function view_blog($id, $page = 0)
	{
		$data = self::$data;
		$data['blog']			= $this->database->_get_row_data('tbl_blog', array('id' => $id, 'status' => 1), '', false, array('slug' => $id));
		$data['sponsoredAds']	= $this->database->_get_specific_listing();
		$data['ownerData']		= $this->database->getUserData(1);
		$data['trendingPosts']	= $this->database->_fetch_blog_posts(RESULTS_PER_BLOG, 0, false, 'views');
		$data['comment_section'] = 'blog';
		$data['slider_name']	= 'featured-slider-page';

		//code to show promotion message on home page
		$blog_detail_page_left_side = fileCache("blog_detail_page_left_side", "",  "get");
		if (!is_array($blog_detail_page_left_side) || count($blog_detail_page_left_side) == 0) {
			// it means cache does not have data
			$blog_detail_page_left_side_arr  =  $this->database->_get_row_data('tbl_advertisement', array('type' => 'blog_detail_page_left_side', 'text_or_icon!=' => NULL, 'text_or_icon!=' => ""));
			if (count($blog_detail_page_left_side_arr) > 0) {
				fileCache("blog_detail_page_left_side", $blog_detail_page_left_side_arr,  "save");
				$data['blog_detail_page_left_side'] = $blog_detail_page_left_side_arr;
			}
		} else {
			$data['blog_detail_page_left_side'] = $blog_detail_page_left_side;
		}

		//code to show promotion message on home page
		$blog_detail_page_right_side = fileCache("blog_detail_page_right_side", "",  "get");
		if (!is_array($blog_detail_page_right_side) || count($blog_detail_page_right_side) == 0) {
			// it means cache does not have data
			$blog_detail_page_right_side_arr  =  $this->database->_get_row_data('tbl_advertisement', array('type' => 'blog_detail_page_right_side', 'text_or_icon!=' => NULL, 'text_or_icon!=' => ""));
			if (count($blog_detail_page_right_side_arr) > 0) {
				fileCache("blog_detail_page_right_side", $blog_detail_page_right_side_arr,  "save");
				$data['blog_detail_page_right_side'] = $blog_detail_page_right_side_arr;
			}
		} else {
			$data['blog_detail_page_right_side'] = $blog_detail_page_right_side;
		}

		if (!empty($data['blog'])) {
			$data['nextPost']		= $this->database->_fetch_most_recent($data['blog'][0]['id'], 'max');
			$data['prevPost']		= $this->database->_fetch_most_recent($data['blog'][0]['id'], 'min');

			$data['comments']		= $this->database->_get_comments(RESULTS_PER_COMMENT, $page, false, $data['blog'][0]['id'], 'blog');
			$data 					= html_escape($this->security->xss_clean($data));
			$data['links']		= $this->blog_comments_loader($page, $data['blog'][0]['id'], $id);
			$this->database->_views_counter($id, 'tbl_blog');
			//$data = html_escape($this->security->xss_clean($data));
			// $this->load->view('main/blog-post', $data);			
			$this->loadPage('blog-post-new', $data);
			return;
		}
		$this->pageNotFound();
	}

	/*view page*/
	public function blog($page = 1)
	{
		$additional['blogs']			= $this->database->_fetch_blog_posts(RESULTS_PER_BLOG, $page, false, 'date');
		$additional['sponsoredAds']		= $this->database->_get_specific_listing();
		// $additional['featuredPosts']	= $this->database->_fetch_blog_posts(RESULTS_PER_BLOG, 0, false, 'views');
		// $additional['trendingPosts']	= $this->database->_fetch_blog_posts(RESULTS_PER_BLOG, 0, false, 'views');
		$additional['ownerData']		= $this->database->getUserData(1);
		$additional 					= html_escape($this->security->xss_clean($additional));
		$additional["links"] 			= $this->blog_pagination_loader($page);
		$additional['site_name'] 				= $this->lang->line('site_name');
		$additional['site_title'] 			= $this->lang->line('site_blog');
		$this->loadPage('blog', $additional);
	}

	/*Blog Next/Prev*/
	public function blog_nextprev($id, $type)
	{
		$data['nextPost']		= $this->database->_fetch_most_recent($id, $type);
		$data['prevPost']		= $this->database->_fetch_most_recent($id, $type);

		$data 					= html_escape($this->security->xss_clean($data));
		$response 				= $this->load->view('main/add-ons/next-post', $data, TRUE);
		$output['response'] 	= $response;
		$output['token'] 		= $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode($output));
	}

	/*Blog pagination*/
	/*public function blog_pagination($page)
	{
		$data['blogs']			= $this->database->_fetch_blog_posts(RESULTS_PER_BLOG, $page, false, 'date');
		$data 					= html_escape($this->security->xss_clean($data));
		$data["links"] 			= $this->blog_pagination_loader($page);
		$response 				= $this->load->view('main/add-ons/single-blog', $data, TRUE);
		$output['response'] 	= $response;
		$output['token'] 		= $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode($output));
	}*/
	public function blog_pagination($page)
	{
		$data['blogs']			= $this->database->_fetch_blog_posts(RESULTS_PER_BLOG, $page, false, 'date');
		$data 					= html_escape($this->security->xss_clean($data));
		$data["links"] 			= $this->blog_pagination_loader($page);
		$response 				= $this->load->view('main/add-ons/single-blog-new', $data, TRUE);
		$output['response'] 	= $response;
		$output['token'] 		= $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode($output));
	}

	/*Ad Post/ Listing*/
	public function adpost()
	{
		$data = self::$data;
		$this->session->unset_userdata('FormValues');
		$data['user_id']						=	$this->is_logged();
		$data['verifiedGA']						=	"";
		$data['FormValues'] 					= 	"";
		$data['reportData'] 					= 	"";

		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('main/adpost', $data);
	}

	/*search page*/
	public function search($type = '', $page = 0, $searchterm = '')
	{

		$arr = '';
		$data = self::$data;
		if (!empty($this->input->post('searchterm')) || !empty($this->input->post('listing_type'))) {
			$arr = array();
			$arr['business_registeredCountry']	= 	'';
			$arr['category']					= 	'';
			$arr['searchterm']					= 	$this->input->post('searchterm');
			$arr['listing_option']				= 	'';

			$data['searchterm']					= 	$arr['searchterm'];
			$data['results']					= 	$this->database->_search_table(array('status' => 1, 'tbl_listings.listing_type' => $this->input->post('listing_type')), RESULTS_PER_SEARCH, $page, 'tbl_listings.date', $arr);
			$data["searchtype"] 				= 	$this->input->post('listing_type');
			// $data = html_escape($this->security->xss_clean($data));
			$data["links"] 						= 	$this->search_pagination_loader(array('status' => 1, 'tbl_listings.listing_type' => $this->input->post('listing_type')), RESULTS_PER_SEARCH, $page, 'tbl_listings.date', $arr);
			$this->load->view('main/single-search', $data);
			return;
		}
		// if (!empty($data['listing_data'])) {
		// 	if (!$this->database->_check_listing_expiry_status($data['listing_data'][0]['id'])) {
		// 		$data['expiredStatus']				= 	true;
		// 	}

		// 	if ($type === 'website' || $type === 'app') {
		// 		$data['selectedcategoriesData']		=	$this->database->_get_row_data('tbl_categories', array('id' => $data['listing_data'][0]['website_industry']));
		// 	}

		// 	if (!empty($data['AuctionEndingDate'][0]['ENDDATE'])) {
		// 		$data['nofdaysleft']				=	$this->common->DateDiffCalculate($data['AuctionEndingDate'][0]['ENDDATE']);

		// 		if ($data['nofdaysleft']['days'] >= 0 && $data['nofdaysleft']['hours'] >= 0) {
		// 			$data['auctionstatus']			= 	'valid';
		// 		}
		// 	}

		// 	$data['domainStatics']					=	$this->AnalyticsOperationsHandler->getUsersAndPageViews($id);
		// 	$data['currentPrice']					=   $this->database->_get_current_price($id, $type);
		// 	$data['validBids']						=   $this->database->_get_all_bids($id, '1', $type, "", "", "", "off");
		// 	$data['comments']						=   $this->database->_get_comments($id);
		// 	$data['domainData']						=	$this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
		// 	$data['ownerData']						=	$this->database->getUserData($data['listing_data'][0]['user_id']);

		// 	if ($type !== 'app') {
		// 		$data['alexaRank']						=   $this->common->alexaRank('//' . $data['domainData'][0]['domain']);
		// 	}

		// 	$this->database->_views_counter($id);
		// 	$data = html_escape($this->security->xss_clean($data));
		// 	$this->load->view('main/single-auction', $data);
		// 	return;
		// }

		$data['results']						= 	$this->database->_search_table(array('status' => 1, 'tbl_listings.listing_type' => $type), RESULTS_PER_SEARCH, $page, 'tbl_listings.date');
		$data["searchtype"] 					= 	$type;
		// $data = html_escape($this->security->xss_clean($data));
		$data["links"] 							= 	$this->search_pagination_loader(array('status' => 1, 'tbl_listings.listing_type' => $type), RESULTS_PER_SEARCH, $page, 'tbl_listings.date', $arr);
		// $this->load->view('main/single-search', $data);

		$this->loadPage('single-search-new', $data);
	}

	// public function solution($type = '', $page = 0, $searchterm = '')
	// {
	// 	$arr = '';
	// 	$data = self::$data;
	// 	if (!empty($this->input->post('searchterm')) || !empty($this->input->post('listing_type'))) {
	// 		$arr = array();
	// 		$arr['business_registeredCountry']	= 	'';
	// 		$arr['category']					= 	'';
	// 		$arr['searchterm']					= 	$this->input->post('searchterm');
	// 		$arr['listing_option']				= 	'';

	// 		$data['searchterm']					= 	$arr['searchterm'];
	// 		$data['results']					= 	$this->database->_search_table(array('status' => 1, 'tbl_listings.listing_type' => $this->input->post('listing_type')), RESULTS_PER_SEARCH, $page, 'tbl_listings.date', $arr);
	// 		$data["searchtype"] 				= 	$this->input->post('listing_type');
	// 		// $data = html_escape($this->security->xss_clean($data));
	// 		$data["links"] 						= 	$this->search_pagination_loader(array('status' => 1, 'tbl_listings.listing_type' => $this->input->post('listing_type')), RESULTS_PER_SEARCH, $page, 'tbl_listings.date', $arr);
	// 		$this->load->view('main/single-search', $data);
	// 		return;
	// 	}

	// 	$data['results']						= 	$this->database->_get_row_data('tbl_solutions', array(), RESULTS_PER_SEARCH, 1, array());

	// 	$data["searchtype"] 					= 	$type;
	// 	// pre($data, 1);
	// 	$data["links"] 							= 	$this->search_pagination_loader(array('status' => 1, 'tbl_listings.listing_type' => $type), RESULTS_PER_SEARCH, $page, 'tbl_listings.date', $arr);

	// 	$this->loadPage('solution', $data);
	// }

	/*search page loading*/
	// Old Function
	/*public function single_search($type, $page, $sort = 'tbl_listings.date')
	{

		if (!empty($this->input->post('parameters'))) {
			$arr = json_decode($this->input->post('parameters'), TRUE);
		}

		if ($type === 'any') {
			$arr['in_conditions']					= 	array('app', 'website');
			$data['results']						= 	$this->database->_search_table(array('tbl_listings.status' => 1), RESULTS_PER_SEARCH, intval($page), $sort, $arr);
			$data 									= 	html_escape($this->security->xss_clean($data));
			$data["links"] 							= 	$this->search_pagination_loader(array('tbl_listings.status' => 1), RESULTS_PER_SEARCH, intval($page), $sort, $arr);
		} else {
			$data['results']						= 	$this->database->_search_table(array('tbl_listings.status' => 1, 'tbl_listings.listing_type' => $type), RESULTS_PER_SEARCH, intval($page), $sort, $arr);
			$data 									= 	html_escape($this->security->xss_clean($data));
			$data["links"] 							= 	$this->search_pagination_loader(array('tbl_listings.status' => 1, 'tbl_listings.listing_type' => $type), RESULTS_PER_SEARCH, intval($page), $sort, $arr);
		}

		$response 								= 	$this->load->view('main/add-ons/searched-results', $data, TRUE);
		$output['response'] 					= 	$response;
		$output['token'] 						= 	$this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode($output));
	}*/

	// Modify Function
	public function single_search($type, $page, $sort = 'tbl_listings.date')
	{
		if (!empty($this->input->post('parameters'))) {
			$arr = json_decode($this->input->post('parameters'), TRUE);
		}

		if ($type === 'any') {
			$arr['in_conditions']					= 	array('app', 'website');
			$data['results']						= 	$this->database->_search_table(array('tbl_listings.status' => 1), RESULTS_PER_SEARCH, intval($page), $sort, $arr);
			// $data 									= 	html_escape($this->security->xss_clean($data));
			$data["links"] 							= 	$this->search_pagination_loader(array('tbl_listings.status' => 1), RESULTS_PER_SEARCH, intval($page), $sort, $arr);
		} else {
			$data['results']						= 	$this->database->_search_table(array('tbl_listings.status' => 1, 'tbl_listings.listing_type' => $type), RESULTS_PER_SEARCH, intval($page), $sort, $arr);
			// $data 									= 	html_escape($this->security->xss_clean($data));
			$data["links"] 							= 	$this->search_pagination_loader(array('tbl_listings.status' => 1, 'tbl_listings.listing_type' => $type), RESULTS_PER_SEARCH, intval($page), $sort, $arr);
		}

		$response 								= 	$this->load->view('main/add-ons/searched-results-new', $data, TRUE);
		$output['response'] 					= 	$response;
		$output['token'] 						= 	$this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode($output));
	}

	/*category page*/
	public function category($category, $page = 0)
	{
		$data = self::$data;
		if (!empty($category)) {
			$resultsdata						= 	$this->database->_get_row_data('tbl_categories', array('id' => $category), '', false, array('url_slug' => $category));

			if (empty($resultsdata)) {
				$this->pageNotFound();
				return;
			}

			$arr = array();
			$arr['business_registeredCountry']	= 	'';
			$arr['category']					= 	$resultsdata[0]['id'];
			$arr['searchterm']					= 	'';
			$arr['listing_option']				= 	'';
			$arr['in_conditions']				= 	array('app', 'website');

			$data['results']					= 	$this->database->_search_table(array('tbl_listings.status' => 1), RESULTS_PER_SEARCH, $page, 'tbl_listings.date', $arr);
			$data["category_name"] 				= 	$resultsdata[0]['c_name'];
			$data["category_id"] 				=	$resultsdata[0]['id'];
			$data["categories"] 				=	$resultsdata;
			$data = html_escape($this->security->xss_clean($data));
			$data["links"] 						= 	$this->search_pagination_loader(array('tbl_listings.status' => 1), RESULTS_PER_SEARCH, $page, 'tbl_listings.date', $arr);
			$this->load->view('main/single-category', $data);
			return;
		}
		$this->pageNotFound();
	}

	/*search results pagination loader*/
	// Old Code
	/*public function search_pagination_loader($data, $type, $page, $sort = 'tbl_listings.date', $arr)
	{
		$config = array();
		$config["base_url"] 					= '#';
		$config["total_rows"] 					= $this->database->_search_table($data, RESULTS_PER_SEARCH, $page, $sort, $arr, true);
		$config["per_page"] 					= RESULTS_PER_SEARCH;
		$config['use_page_numbers'] 			= TRUE;

		$config['num_tag_open'] 				= '<li class="ripple-effect">';
		$config['num_tag_close'] 				= '</li>';
		$config['cur_tag_open'] 				= '<li><a class="ripple-effect current-page">';
		$config['cur_tag_close']				= '</a></li>';
		$config['prev_tag_open'] 				= '<li class="pagination-arrow">';
		$config['prev_tag_close'] 				= '</li>';
		$config['first_tag_open'] 				= '<li class="ripple-effect">';
		$config['first_tag_close']				= '</li>';
		$config['last_tag_open'] 				= '<li class="ripple-effect">';
		$config['last_tag_close'] 				= '</li>';

		$config['prev_link'] 					= '<i class=" mdi mdi-chevron-left"></i>';
		$config['prev_tag_open'] 				= '<li class="pagination-arrow">';
		$config['prev_tag_close'] 				= '</li>';

		$config['next_link']		 			= '<i class=" mdi mdi-chevron-right"></i>';
		$config['next_tag_open'] 				= '<li class="pagination-arrow">';
		$config['next_tag_close'] 				= '</li>';

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}*/

	// Updated Code
	public function search_pagination_loader($data, $type, $page, $sort = 'tbl_listings.date', $arr)
	{
		$config = array();
		$config["base_url"] 					= '#';
		$config["total_rows"] 					= $this->database->_search_table($data, RESULTS_PER_SEARCH, $page, $sort, $arr, true);
		$config["per_page"] 					= RESULTS_PER_SEARCH;
		$config['use_page_numbers'] 			= TRUE;

		$config['num_tag_open'] 				= '<li class="page-item">';
		$config['num_tag_close'] 				= '</li>';
		$config['cur_tag_open'] 				= '<li class="page-item"><a class="page-link active">';
		$config['cur_tag_close']				= '</a></li>';
		$config['prev_tag_open'] 				= '<li class="page-item">';
		$config['prev_tag_close'] 				= '</li>';
		$config['first_tag_open'] 				= '<li class="page-item">';
		$config['first_tag_close']				= '</li>';
		$config['last_tag_open'] 				= '<li class="page-item">';
		$config['last_tag_close'] 				= '</li>';

		$config['prev_link'] 					= '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
		$config['prev_tag_open'] 				= '<li class="page-item">';
		$config['prev_tag_close'] 				= '</li>';

		$config['next_link']		 			= '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
		$config['next_tag_open'] 				= '<li class="page-item">';
		$config['next_tag_close'] 				= '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	/*Blog results pagination loader*/
	// Old Code
	/*public function blog_pagination_loader($page)
	{
		$config = array();
		$config["base_url"] 					= '#';
		$config["total_rows"] 					= $this->database->_fetch_blog_posts(RESULTS_PER_BLOG, $page, true);
		$config["per_page"] 					= RESULTS_PER_BLOG;
		$config['use_page_numbers'] 			= TRUE;

		$config['num_tag_open'] 				= '<li class="ripple-effect">';
		$config['num_tag_close'] 				= '</li>';
		$config['cur_tag_open'] 				= '<li><a class="ripple-effect current-page">';
		$config['cur_tag_close']				= '</a></li>';
		$config['prev_tag_open'] 				= '<li class="pagination-arrow">';
		$config['prev_tag_close'] 				= '</li>';
		$config['first_tag_open'] 				= '<li class="ripple-effect">';
		$config['first_tag_close']				= '</li>';
		$config['last_tag_open'] 				= '<li class="ripple-effect">';
		$config['last_tag_close'] 				= '</li>';

		$config['prev_link'] 					= '<i class=" mdi mdi-chevron-left"></i>';
		$config['prev_tag_open'] 				= '<li class="pagination-arrow">';
		$config['prev_tag_close'] 				= '</li>';

		$config['next_link']		 			= '<i class=" mdi mdi-chevron-right"></i>';
		$config['next_tag_open'] 				= '<li class="pagination-arrow">';
		$config['next_tag_close'] 				= '</li>';

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}*/

	// Updated Code
	public function blog_pagination_loader($page)
	{
		$config = array();
		$config["base_url"] 					= '#';
		$config["total_rows"] 					= $this->database->_fetch_blog_posts(RESULTS_PER_BLOG, $page, true);
		$config["per_page"] 					= RESULTS_PER_BLOG;
		$config['use_page_numbers'] 			= TRUE;

		$config['num_tag_open'] 				= '<li class="page-item">';
		$config['num_tag_close'] 				= '</li>';
		$config['cur_tag_open'] 				= '<li class="page-item"><a class="page-link active">';
		$config['cur_tag_close']				= '</a></li>';
		$config['prev_tag_open'] 				= '<li class="page-item">';
		$config['prev_tag_close'] 				= '</li>';
		$config['first_tag_open'] 				= '<li class="page-item">';
		$config['first_tag_close']				= '</li>';
		$config['last_tag_open'] 				= '<li class="page-item">';
		$config['last_tag_close'] 				= '</li>';

		$config['prev_link'] 					= '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
		$config['prev_tag_open'] 				= '<li class="page-item">';
		$config['prev_tag_close'] 				= '</li>';

		$config['next_link']		 			= '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
		$config['next_tag_open'] 				= '<li class="page-item">';
		$config['next_tag_close'] 				= '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	/*Auction pagination loader*/
	public function auction_pagination_loader($data, $page, $ending = false)
	{
		$config = array();
		$config["base_url"] 					= '#';
		$config["total_rows"] 					= $this->database->_get_auction_data($data, RESULTS_PER_PAGE, $ending, true, $page, '', true);
		$config["per_page"] 					= RESULTS_PER_PAGE;
		$config['use_page_numbers'] 			= TRUE;

		$config['num_tag_open'] 				= '<li class="ripple-effect">';
		$config['num_tag_close'] 				= '</li>';
		$config['cur_tag_open'] 				= '<li><a class="ripple-effect current-page">';
		$config['cur_tag_close']				= '</a></li>';
		$config['prev_tag_open'] 				= '<li class="pagination-arrow">';
		$config['prev_tag_close'] 				= '</li>';
		$config['first_tag_open'] 				= '<li class="ripple-effect">';
		$config['first_tag_close']				= '</li>';
		$config['last_tag_open'] 				= '<li class="ripple-effect">';
		$config['last_tag_close'] 				= '</li>';

		$config['prev_link'] 					= '<i class=" mdi mdi-chevron-left"></i>';
		$config['prev_tag_open'] 				= '<li class="pagination-arrow">';
		$config['prev_tag_close'] 				= '</li>';

		$config['next_link']		 			= '<i class=" mdi mdi-chevron-right"></i>';
		$config['next_tag_open'] 				= '<li class="pagination-arrow">';
		$config['next_tag_close'] 				= '</li>';

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	/*Offer pagination loader*/
	public function offer_pagination_loader($data, $page)
	{
		$config = array();
		$config["base_url"] 					= '#';
		$config["total_rows"] 					= $this->database->_get_offers_data($data, RESULTS_PER_PAGE, true, $page);
		$config["per_page"] 					= RESULTS_PER_PAGE;
		$config['use_page_numbers'] 			= TRUE;

		$config['num_tag_open'] 				= '<li class="ripple-effect">';
		$config['num_tag_close'] 				= '</li>';
		$config['cur_tag_open'] 				= '<li><a class="ripple-effect current-page">';
		$config['cur_tag_close']				= '</a></li>';
		$config['prev_tag_open'] 				= '<li class="pagination-arrow">';
		$config['prev_tag_close'] 				= '</li>';
		$config['first_tag_open'] 				= '<li class="ripple-effect">';
		$config['first_tag_close']				= '</li>';
		$config['last_tag_open'] 				= '<li class="ripple-effect">';
		$config['last_tag_close'] 				= '</li>';

		$config['prev_link'] 					= '<i class=" mdi mdi-chevron-left"></i>';
		$config['prev_tag_open'] 				= '<li class="pagination-arrow">';
		$config['prev_tag_close'] 				= '</li>';

		$config['next_link']		 			= '<i class=" mdi mdi-chevron-right"></i>';
		$config['next_tag_open'] 				= '<li class="pagination-arrow">';
		$config['next_tag_close'] 				= '</li>';

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	/*profile reviews pagination*/
	public function profile_reviews($userid, $page)
	{
		$data["profileRatings"] 				= $this->database->get_reviews($userid, "", "", 4, $page);
		$data 									= html_escape($this->security->xss_clean($data));
		$data["links"] 							= $this->common->reviews_pagination_loader($userid);
		$response 								= $this->load->view('main/add-ons/user_reviews', $data, TRUE);
		$output['response'] 					= $response;
		$output['token'] 						= $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode($output));
	}

	/*Post Reviews*/
	public function post_review()
	{
		$output['token']       = $this->security->get_csrf_hash();
		header('Content-Type: application/json');

		$data = array(
			'reviewer_id' => $this->session->userdata('user_id'),
			'user_id' => $this->input->post('review_user_id'),
			'review' => $this->input->post('review_msg'),
			'ratings' => $this->input->post('rating'),
			'type' => $this->input->post('review_type'),
			'status' => 1,
			'date' => date('Y-m-d H:i:s')
		);

		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('ratings', 'ratings', 'required|numeric|trim|xss_clean');
		$this->form_validation->set_rules('review', 'review', 'required|trim|xss_clean');

		if ($this->form_validation->run()) {
			$data = html_escape($this->security->xss_clean($data));
			if (!empty($this->input->post('review_id'))) {
				$output['response']         = $this->database->_update_to_table('tbl_reviews', $data, array('id' => $this->input->post('review_id')));
				exit(json_encode($output));
			} else {
				$output['response']         = $this->database->_insert_to_table('tbl_reviews', $data);
				exit(json_encode($output));
			}
		}

		$output['response']         = false;
		exit(json_encode($output));
	}

	/*Single Domain*/
	public function single_domain()
	{
		$this->load->view('main/single-domain-page');
	}

	/*Pricing Page old code*/
	// public function pricing()
	// {
	// 	$data = self::$data;
	// 	$data['website_headers']			=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => 'website', 'status' => 1));
	// 	$data['domains_headers']			=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => 'domain', 'status' => 1));
	// 	$data['app_headers']				=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => 'app', 'status' => 1));
	// 	$data['sponsored_headers']			=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => 'sponsored', 'status' => 1));

	// 	$data = html_escape($this->security->xss_clean($data));
	// 	$this->load->view('main/pricing', $data);
	// }


	/*Pricing Page*/
	public function newPricing()
	{
		$data = self::$data;
		$data['membershipPlans'] = $this->database->getAllMembershipPlain();
		$data = html_escape($this->security->xss_clean($data));
		$this->loadPage('membership_plan', $data);
	}

	/*Single Auction*/
	public function single_auction($type, $id)
	{
		$data = self::$data;
		$data['listing_data']					=	$this->database->_get_row_data('tbl_listings', array('id' => $id, 'listing_type' => $type, 'listing_option' => 'auction'), '', true);
		$data['comment_section']				= 	'listing';
		$data['auctionstatus']					= 	'invalid';
		$data['expiredStatus']					=	false;
		$data['AuctionEndingDate']				=	$this->database->_get_auction_ending_date($id, 'tbl_listings');

		if (!empty($this->session->userdata('user_id'))) {
			$data['userdata'] 						= 	$this->database->getUserData($this->session->userdata('user_id'));
		}

		if (!empty($data['listing_data'])) {
			if (!$this->database->_check_listing_expiry_status($data['listing_data'][0]['id'])) {
				$data['expiredStatus']				= 	true;
			}

			if ($type === 'website' || $type === 'app') {
				$data['selectedcategoriesData']		=	$this->database->_get_row_data('tbl_categories', array('id' => $data['listing_data'][0]['website_industry']));
			}

			if (!empty($data['AuctionEndingDate'][0]['ENDDATE'])) {
				$data['nofdaysleft']				=	$this->common->DateDiffCalculate($data['AuctionEndingDate'][0]['ENDDATE']);

				if ($data['nofdaysleft']['days'] >= 0 && $data['nofdaysleft']['hours'] >= 0) {
					$data['auctionstatus']			= 	'valid';
				}
			}

			$data['domainStatics']					=	$this->AnalyticsOperationsHandler->getUsersAndPageViews($id);
			$data['currentPrice']					=   $this->database->_get_current_price($id, $type);
			$data['validBids']						=   $this->database->_get_all_bids($id, '1', $type, "", "", "", "off");
			$data['comments']						=   $this->database->_get_comments($id);
			$data['domainData']						=	$this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
			$data['ownerData']						=	$this->database->getUserData($data['listing_data'][0]['user_id']);

			if ($type !== 'app') {
				$data['alexaRank']						=   $this->common->alexaRank('//' . $data['domainData'][0]['domain']);
			}

			$this->database->_views_counter($id);
			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('main/single-auction', $data);
			return;
		}
		$this->pageNotFound();
	}

	/*Single Classified*/
	public function single_offers($type, $slug)
	{
		$id =  $this->database->getIdBySlug('tbl_listings', $slug);



		if (!empty($id)) {
			$data = self::$data;
			$data['listing_data']					=	$this->database->_get_row_data('tbl_listings', array('id' => $id, 'listing_type' => $type, 'listing_option' => 'classified'), '', true);
			$data['default_currency']				=	$data['default_currency'];
			$data['comment_section']				= 	'listing';
			$data['expiredStatus']					=	false;
			$data['badges']							=	 $this->database->getUserBadge($id);

			$sold_or_not =  $this->database->getSoldORNot($id);
			if (isset($sold_or_not) && !empty($sold_or_not)) {
				$data['sold_or_not'] = 'yes';
			} else {
				$data['sold_or_not'] = 'no';
			}
			//code to show promotion message on home page
			$listing_detail_page_left_side = fileCache("listing_detail_page_left_side", "",  "get");
			if (!is_array($listing_detail_page_left_side) || count($listing_detail_page_left_side) == 0) {
				// it means cache does not have data
				$listing_detail_page_left_side_arr  =  $this->database->_get_row_data('tbl_advertisement', array('type' => 'listing_detail_page_left_side', 'text_or_icon!=' => NULL, 'text_or_icon!=' => ""));
				if (count($listing_detail_page_left_side_arr) > 0) {
					fileCache("listing_detail_page_left_side", $listing_detail_page_left_side_arr,  "save");
					$data['listing_detail_page_left_side'] = $listing_detail_page_left_side_arr;
				}
			} else {
				$data['listing_detail_page_left_side'] = $listing_detail_page_left_side;
			}



			$listing_detail_page_right_side = fileCache("listing_detail_page_right_side", "",  "get");
			if (!is_array($listing_detail_page_right_side) || count($listing_detail_page_right_side) == 0) {
				// it means cache does not have data
				$listing_detail_page_right_side_arr  =  $this->database->_get_row_data('tbl_advertisement', array('type' => 'listing_detail_page_right_side', 'text_or_icon!=' => NULL, 'text_or_icon!=' => ""));
				if (count($listing_detail_page_right_side_arr) > 0) {
					fileCache("listing_detail_page_right_side", $listing_detail_page_right_side_arr,  "save");
					$data['listing_detail_page_right_side'] = $listing_detail_page_right_side_arr;
				}
			} else {
				$data['listing_detail_page_right_side'] = $listing_detail_page_right_side;
			}

			if (!empty($this->session->userdata('user_id'))) {

				$data['userdata'] 						= 	$this->database->getUserData($this->session->userdata('user_id'));
			}

			if (!empty($data['listing_data'])) {

				if (!$this->database->_check_listing_expiry_status($data['listing_data'][0]['id'])) {
					$data['expiredStatus']				= 	true;
				}

				if ($type === 'website' || $type === 'app') {
					$data['selectedcategoriesData']		=	$this->database->_get_row_data('tbl_categories', array('id' => $data['listing_data'][0]['website_industry']));
				}

				$data['domainStatics']					=	$this->AnalyticsOperationsHandler->getUsersAndPageViews($id);
				$data['comments']						=   $this->database->_get_comments(RESULTS_PER_BLOG, 0, true, $id, 'website');
				$data['domainData']						=	$this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
				$data['ownerData']						=	$this->database->getUserData($data['listing_data'][0]['user_id']);

				//$data['alexaRank']						=   $this->common->alexaRank('//' . $data['domainData'][0]['domain']);
				$this->database->_views_counter($id);
				$data = html_escape($this->security->xss_clean($data));
				$data['listing_data'][0]['description'] = $this->security->xss_clean(strip_tags($data['listing_data'][0]['description']));
				// $this->load->view('main/single-offers', $data);
				// pre($data, 1);
				$data['listing_data']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")[$type];

				$this->loadPage('single-static-item', $data);
				return;
			}
		}
		$this->pageNotFound();
	}


	function solutionDetails($slug = "")
	{
		if (!empty($slug)) {

			$data = self::$data;
			$data['listing_data']		 =	$this->database->getSolutionDetailsBySlug($slug);

			if (!empty($data['listing_data'])) {

				// pre($data['listing_data'],1);
				$data['default_currency']	 	=	$data['default_currency'] ?? '';
				$data['comment_section']	 	= 	'listing';
				$data['expiredStatus']			=	false;
				$data['site_title'] 			=  $data['listing_data']['title'] ?? '';
				$data['site_metadescription'] 	=  $data['listing_data']['metakeywords'] ?? '';
				$data['site_keywords'] 			=  $data['listing_data']['metadescription'] ?? '';
				if (!empty($this->session->userdata('user_id'))) {
					$data['userdata'] 						= 	$this->database->getUserData($this->session->userdata('user_id'));
				}
				//pre($data['userdata'][0]['user_id']);
				$data['ownerData']		= $this->database->getUserData($data['listing_data']['user_id']);
				//pre($data['ownerData'][0]['user_id'],1);

				if (!empty($data['listing_data'])) {
					// $data['listing_data']['description'] = $this->security->xss_clean(strip_tags($data['listing_data']['description']));
					$data['listing_data']['description'] = $data['listing_data']['description'];;

					$data['listing_data']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];


					//code to show promotion message on home page
					$listing_detail_page_left_side = fileCache("listing_detail_page_left_side", "",  "get");
					if (!is_array($listing_detail_page_left_side) || count($listing_detail_page_left_side) == 0) {
						// it means cache does not have data
						$listing_detail_page_left_side_arr  =  $this->database->_get_row_data('tbl_advertisement', array('type' => 'listing_detail_page_left_side', 'text_or_icon!=' => NULL, 'text_or_icon!=' => ""));
						if (count($listing_detail_page_left_side_arr) > 0) {
							fileCache("listing_detail_page_left_side", $listing_detail_page_left_side_arr,  "save");
							$data['listing_detail_page_left_side'] = $listing_detail_page_left_side_arr;
						}
					} else {
						$data['listing_detail_page_left_side'] = $listing_detail_page_left_side;
					}

					$listing_detail_page_right_side = fileCache("listing_detail_page_right_side", "",  "get");
					if (!is_array($listing_detail_page_right_side) || count($listing_detail_page_right_side) == 0) {
						// it means cache does not have data
						$listing_detail_page_right_side_arr  =  $this->database->_get_row_data('tbl_advertisement', array('type' => 'listing_detail_page_right_side', 'text_or_icon!=' => NULL, 'text_or_icon!=' => ""));
						if (count($listing_detail_page_right_side_arr) > 0) {
							fileCache("listing_detail_page_right_side", $listing_detail_page_right_side_arr,  "save");
							$data['listing_detail_page_right_side'] = $listing_detail_page_right_side_arr;
						}
					} else {
						$data['listing_detail_page_right_side'] = $listing_detail_page_right_side;
					}

					$this->loadPage('single-static-item-solution', $data);
					return;
				}
			}
		}

		$this->pageNotFound();
	}


	/*Add Bid*/
	public function add_bid()
	{
		$output['token']       = $this->security->get_csrf_hash();
		header('Content-Type: application/json');

		$datas = self::$data;
		$status = 0;
		if ($datas['settings'][0]['allow_approvedbidder_tobid'] === '1') {
			if ($this->database->_check_user_has_pending_bid('1') > 0) {
				if (floatval($this->database->_get_current_price($this->input->post('bid_listing_id'), $this->input->post('bid_listing_type'))) < floatval($this->input->post('bid_amount'))) {
					if ($this->database->_get_highest_bid_details('1')[0]['bidder_id'] !== $this->input->post('bid_bidder_id')) {
						$status = 1;
					} else {
						if ($datas['settings'][0]['allow_approvedbidder_tobid'] !== 1) {
							$output['response'] 	= 'Sorry, Your Current Bid is the Highest So Far';
							exit(json_encode($output));
						}

						$status = 1;
					}
				} else {
					$output['response'] 	= 'Sorry, Your Bidding Amount Should be Greater than ' . $data['default_currency'] . ' ' . (floatval($this->database->_get_current_price($this->input->post('bid_listing_id'), $this->input->post('bid_listing_type'))) + floatval($this->database->getSettingsData()[0]['bid_value_gap']));
					exit(json_encode($output));
				}
			}
		}

		$data = array(
			'listing_id' => $this->input->post('bid_listing_id'),
			'listing_type' => $this->input->post('bid_listing_type'),
			'bidder_id' => $this->input->post('bid_bidder_id'),
			'owner_id' => $this->input->post('bid_owner_id'),
			'bid_amount' => $this->input->post('bid_amount'),
			'bid_status ' => $status,
			'date' => date('Y-m-d H:i:s')
		);

		$data = html_escape($this->security->xss_clean($data));
		if ($datas['settings'][0]['hold_bidding_until_approval'] === '1') {
			if ($this->database->_check_user_has_pending_bid() > 0) {
				$output['response'] 	= 'Sorry, You cannot bid again untill Owner approves your current bid';
				exit(json_encode($output));
			}

			$output['response'] 	= $this->database->_insert_to_table('tbl_bids', $data);
			if ($datas['settings'][0]['email_notifications'] === '1') {
				$this->email_op->_user_email_notification('place-bid', $data);
			}
			exit(json_encode($output));
		}

		$output['response'] 		= 'Something went wrong, please try again later';
		exit(json_encode($output));
	}


	/*Add Offer*/
	public function add_offer()
	{
		$output['token']       = $this->security->get_csrf_hash();
		header('Content-Type: application/json');

		$datas = self::$data;
		$status 				= 	0;
		$listing_data         	=   $this->database->_get_row_data('tbl_listings', array('id' => $this->input->post('offer_listing_id'), 'listing_type' => $this->input->post('offer_listing_type')));

		if (empty($listing_data[0]['website_minimumoffer'])) {
			$output['response'] 		= 'Invalid Action. Please contact Support for additional information';
			exit(json_encode($output));
		}

		if (floatval($listing_data[0]['website_minimumoffer']) <= floatval($this->input->post('offer_amount'))) {

			$data = array(
				'listing_id' => $this->input->post('offer_listing_id'),
				'listing_type' => $this->input->post('offer_listing_type'),
				'customer_id' => $this->input->post('customer_id'),
				'owner_id' => $this->input->post('listing_owner_id'),
				'offer_amount' => $this->input->post('offer_amount'),
				'offer_msg' => $this->input->post('offer_msg'),
				'offer_status ' => $status,
				'date' => date('Y-m-d H:i:s')
			);

			$this->form_validation->set_data($data);
			$this->form_validation->set_rules('offer_amount', 'Offer Amount', 'required|numeric|trim|xss_clean');
			$this->form_validation->set_rules('offer_msg', 'Offer Message', 'trim|xss_clean');

			if ($this->form_validation->run()) {
				$data = html_escape($this->security->xss_clean($data));
				$output['response'] 		= $this->database->_insert_to_table('tbl_offers', $data);

				if ($datas['settings'][0]['email_notifications'] === '1') {
					$this->email_op->_user_email_notification('place-offer', $data);
				}

				exit(json_encode($output));
			} else {
				$output['response'] 		= 'Sorry, Your Offer Should be Greater than ' . $listing_data[0]['website_minimumoffer'];
				exit(json_encode($output));
			}
		}

		$output['response'] 		= 'Something went wrong, please try again later';
		exit(json_encode($output));
	}

	/*Mark as delivered */
	public function markAsDelivered()
	{
		$datas = self::$data;
		$uploadProof = "";
		if (!empty($_FILES['uploadProof']['name'])) {
			if ($this->security->xss_clean($_FILES['uploadProof']['name'], TRUE) === TRUE) {
				$uploadProof = $this->upload__files('uploadProof');
			}
		}

		$this->create_history($this->input->post('contract_id'), 5, html_escape($this->input->post('messagetoBuyer', true)), $uploadProof);
		$this->change_contract_status($this->input->post('contract_id'), 5);
		if ($datas['settings'][0]['email_notifications'] === '1') {
			$this->email_op->_user_email_notification('mark-delivered', $this->input->post('contract_id'));
		}
		redirect($this->session->userdata('url'));
		return;
	}

	/*Mark as Accepted */
	public function markAsAccepted()
	{
		$datas = self::$data;
		$this->create_history($this->input->post('contract_id'), 4, '', '');
		$this->change_contract_status($this->input->post('contract_id'), 4);
		$invoice_id = $this->database->_get_single_data('tbl_contracts', array('contract_id' => $this->input->post('contract_id')), 'invoice_id');
		$this->_change_invoice_status($invoice_id, 4);
		if ($this->session->userdata('user_id') === '1' && $this->session->userdata('user_level') === '0') {
			$this->database->_update_to_table('tbl_disputes', array('status' => 1), array('contract_id' => $this->input->post('contract_id')));
		}
		if ($datas['settings'][0]['email_notifications'] === '1') {
			$this->email_op->_user_email_notification('mark-accepted', $this->input->post('contract_id'));
		}
		redirect($this->session->userdata('url'));
		return;
	}

	/* Request a Revision */
	public function requestaRivision()
	{
		$datas = self::$data;
		$this->create_history($this->input->post('contract_id'), 6, html_escape($this->input->post('messagetoBuyer', true)), '');
		$this->change_contract_status($this->input->post('contract_id'), 6);
		if ($datas['settings'][0]['email_notifications'] === '1') {
			$this->email_op->_user_email_notification('mark-revision', $this->input->post('contract_id'));
		}
		redirect($this->session->userdata('url'));
		return;
	}

	/* Cancel Contract */
	public function requestaCancel()
	{
		$datas = self::$data;
		$this->create_history($this->input->post('contract_id'), 3, html_escape($this->input->post('messagetoBuyer', true)), '');
		$this->change_contract_status($this->input->post('contract_id'), 3);
		if ($datas['settings'][0]['email_notifications'] === '1') {
			$this->email_op->_user_email_notification('cancel-contract', $this->input->post('contract_id'));
		}
		redirect($this->session->userdata('url'));
		return;
	}

	/* Cancel Contract Admin*/
	public function requestaCanceladmin()
	{
		$datas = self::$data;
		$this->create_history($this->input->post('contract_id'), 7, 'BY ADMIN : ' . html_escape($this->input->post('messagetoBuyer', true)), '');
		$this->change_contract_status($this->input->post('contract_id'), 7);
		$invoice_id 	= $this->database->_get_single_data('tbl_contracts', array('contract_id' => $contract_id), 'invoice_id');
		$this->_change_invoice_status($invoice_id, 3);
		$this->database->_update_to_table('tbl_disputes', array('status' => 1), array('contract_id' => $this->input->post('contract_id')));
		if ($datas['settings'][0]['email_notifications'] === '1') {
			$this->email_op->_user_email_notification('accept-cancel', $this->input->post('contract_id'));
		}
		redirect($this->session->userdata('url'));
		return;
	}

	/* Cancel Request Accept */
	public function acceptCancelreq($contract_id)
	{
		if (!empty($contract_id)) {
			$output['token']       = $this->security->get_csrf_hash();
			header('Content-Type: application/json');
			$datas = self::$data;
			$this->create_history($contract_id, 7, '', '');
			$this->change_contract_status($contract_id, 7);
			$invoice_id 	= $this->database->_get_single_data('tbl_contracts', array('contract_id' => $contract_id), 'invoice_id');
			$this->_change_invoice_status($invoice_id, 3);
			if ($datas['settings'][0]['email_notifications'] === '1') {
				$this->email_op->_user_email_notification('accept-cancel', $contract_id);
			}
			$output['response'] 		= true;
			exit(json_encode($output));
			redirect($this->session->userdata('url'));
			return;
		}

		$output['response'] 		= false;
		exit(json_encode($output));
	}

	/* Cancel Request Reject */
	public function rejectCancelreq($contract_id)
	{
		if (!empty($contract_id)) {
			$datas = self::$data;
			$this->create_history($contract_id, 8, '', '');
			$this->change_contract_status($contract_id, 8);
			if ($datas['settings'][0]['email_notifications'] === '1') {
				$this->email_op->_user_email_notification('reject-cancel', $contract_id);
			}
			$output['response'] 		= true;
			exit(json_encode($output));
			redirect($this->session->userdata('url'));
			return;
		}

		$output['response'] 		= false;
		exit(json_encode($output));
	}

	/* Raise a dispute */
	public function raisedaDispute($contract_id)
	{
		if (!empty($contract_id)) {
			$datas = self::$data;
			$this->create_history($contract_id, 9, '', '');
			$this->change_contract_status($contract_id, 9);
			$contract_data = $this->database->_get_row_data('tbl_opens', array('id' => $contract_id));
			if (!empty($contract_data)) {
				$this->database->_insert_to_table('tbl_disputes', array('contract_id' => $contract_id, 'seller_id' => $contract_data[0]['owner_id'], 'buyer_id' => $contract_data[0]['customer_id'], 'status' => 0));

				if ($datas['settings'][0]['email_notifications'] === '1') {
					$this->email_op->_user_email_notification('raised-dispute', $contract_id);
				}
			}
			$output['response'] 		= true;
			exit(json_encode($output));
			redirect($this->session->userdata('url'));
			return;
		}

		$output['response'] 		= false;
		exit(json_encode($output));
	}

	/*withdrawal request*/
	public function request_withdraw()
	{
		$this->database->_create_withdrawal();
	}




	/*Domains Page*/
	public function domains()
	{

		$data = self::$data;
		$data['sponsoredAds']		= 	$this->database->_get_specific_listing('sponsored', 'domain');
		$data['slider_name']		= 	'featured-slider';
		$data['slider_feat_name']	= 	'feature-active';
		$data['type']				= 	'domain';
		$data['featuredDomains']	=	$this->database->_get_selected_listing_types('date', 0, RESULTS_PER_COLUMN, array('tbl_listings.listing_type' => 'domain'));
		$data['soldDomains']		=	$this->database->_get_selected_listing_types('date', 1, RESULTS_PER_COLUMN, array('tbl_listings.listing_type' => 'domain'));
		$data['endingSoon']			=	$this->database->_get_auction_ending_soon('domain');
		// $data = html_escape($this->security->xss_clean($data));

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');

		$this->load->view('main/domains', $data);
	}



	/*Websites Page*/
	public function websites()
	{
		$data = self::$data;
		$data['sponsoredAds']		= 	$this->database->_get_specific_listing('sponsored', 'website');
		$data['slider_name']		= 	'featured-slider';
		$data['slider_feat_name']	= 	'feature-active';
		$data['type']				= 	'website';
		$data['featuredDomains']	=	$this->database->_get_selected_listing_types('date', 0, RESULTS_PER_COLUMN, array('tbl_listings.listing_type' => 'website'));
		$data['soldDomains']		=	$this->database->_get_selected_listing_types('date', 1, RESULTS_PER_COLUMN, array('tbl_listings.listing_type' => 'website'));
		$data['endingSoon']			=	$this->database->_get_auction_ending_soon('website');
		// $data = html_escape($this->security->xss_clean($data));
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');
		$this->load->view('main/websites', $data);
	}

	/*apps Page*/
	public function apps()
	{
		$data = self::$data;
		$data['sponsoredAds']		= 	$this->database->_get_specific_listing('sponsored', 'app');
		$data['slider_name']		= 	'featured-slider-app';
		$data['slider_feat_name']	= 	'feature-active-app';
		$data['type']				= 	'website';
		$data['featuredDomains']	=	$this->database->_get_selected_listing_types('date', 0, RESULTS_PER_COLUMN, array('tbl_listings.listing_type' => 'app'), 'all');
		$data['soldDomains']		=	$this->database->_get_selected_listing_types('date', 1, RESULTS_PER_COLUMN, array('tbl_listings.listing_type' => 'app'), 'all');
		$data['endingSoon']			=	$this->database->_get_auction_ending_soon('app');
		// $data = html_escape($this->security->xss_clean($data));
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');
		$this->load->view('main/apps', $data);
	}

	/*Trending Ads*/
	public function loadTrendingAds()
	{
		$data = self::$data;
		$data['recentlyAdded'] 					= 	$this->database->_get_selected_listing_types('date', '', RESULTS_PER_HOMEPAGE);
		$data['popularAdded'] 					= 	$this->database->_get_selected_listing_types('views', '', RESULTS_PER_HOMEPAGE);
		$data['soldDomains'] 					= 	$this->database->_get_selected_listing_types('date', 1, RESULTS_PER_HOMEPAGE);

		$data 									= 	html_escape($this->security->xss_clean($data));
		$response								=	$this->load->view('main/add-ons/featured-domains', $data, TRUE);
		$data['response'] 						= 	$response;
		$data['token'] 							= 	$this->security->get_csrf_hash();

		header('Content-Type: application/json');
		exit(json_encode($data));
	}


	/*Load Auction Listings*/
	public function loadAuctions()
	{
		$data = self::$data;
		$data['auctions'] 						= 	$this->database->_get_auction_data(array('tbl_listings.listing_option' => 'auction'), AUCTION_HOMEPAGE_RESULTS, false, false, 0);
		$data['ending'] 						= 	$this->database->_get_auction_data(array('tbl_listings.listing_option' => 'auction'), AUCTION_HOMEPAGE_RESULTS, true, false, 0, '', true);
		$data['sold'] 							= 	$this->database->_get_auction_data(array('tbl_listings.sold_status' => '1'), AUCTION_HOMEPAGE_RESULTS, false, false, 0);

		$data 									= 	html_escape($this->security->xss_clean($data));
		$response								=	$this->load->view('main/add-ons/all-bids', $data, TRUE);
		$data['response'] 						= 	$response;
		$data['token'] 							= 	$this->security->get_csrf_hash();

		header('Content-Type: application/json');
		exit(json_encode($data));
	}

	/*Exsting listing check*/
	public function CheckListingExistsDomainWise()
	{
		return $this->database->CheckListingExistsDomainWise();
	}

	/*History records insertion*/
	public function create_history($contract_id, $status, $remarks, $uploads)
	{
		$data = array(
			'status' => $status,
			'contract_id' => $contract_id,
			'remarks' => $remarks,
			'uploads' => $uploads,
			'user' => $this->session->userdata('user_id')
		);
		$data = html_escape($this->security->xss_clean($data));
		return $this->database->_insert_to_table('tbl_history', $data);
	}

	/*Change Delivery Dates*/
	public function change_delivery_date($contract_id, $status)
	{
		$listing    = $this->database->_get_row_data('tbl_opens', array('id' => $contract_id, 'status' => $status));
		$data = array(
			'delivery_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + " . $listing[0]['delivery'] . " day"))
		);
		return $this->database->_update_to_DB('tbl_opens', $data, $contract_id);
	}

	/*Change Contract Status*/
	public function change_contract_status($contract_id, $status)
	{
		$percentage = 0;
		if (!empty($status)) {
			switch ($status) {
				case '0':
					$percentage = 0;
					break;
				case '1':
					$percentage = 10;
					break;
				case '2':
					$percentage = 10;
					break;
				case '3':
					$percentage = 20;
					break;
				case '4':
					$percentage = 100;
					break;
				case '5':
					$percentage = 75;
					break;
				case '6':
					$percentage = 60;
					break;
				case '7':
					$percentage = 100;
					break;
				case '8':
					$percentage = 75;
					break;
				case '9':
					$percentage = 80;
					break;
				default:
					return;
			}
		}

		$data = array(
			'status' => $status,
			'date' => date('Y-m-d H:i:s'),
			'percentage' => $percentage
		);
		return $this->database->_update_to_DB('tbl_opens', $data, $contract_id);
	}

	/*Change invoice status*/
	public function _change_invoice_status($invoice_id, $status)
	{
		$data = array(
			'status' => $status,
			'updated' => date('Y-m-d H:i:s')
		);
		return $this->database->_update_to_table('tbl_invoices', $data, array('invoice_id' => $invoice_id));
	}

	/*partition in to seperate arrays*/
	public function partition($list, $p)
	{
		$listlen = count($list);
		$partlen = floor($listlen / $p);
		$partrem = $listlen % $p;
		$partition = array();
		$mark = 0;
		for ($px = 0; $px < $p; $px++) {
			$incr = ($px < $partrem) ? $partlen + 1 : $partlen;
			$partition[$px] = array_slice($list, $mark, $incr);
			$mark += $incr;
		}
		return $partition;
	}

	/*Find and mark as completed all pendings*/
	public function markAsCompletedAuto($manual = false)
	{
		$data = $this->database->_markAsCompletedAuto();
		if (!empty($data)) {
			foreach ($data as $key) {
				$this->create_history($key['contract_id'], 4, '', '');
				$this->change_contract_status($key['contract_id'], 4);
				$invoice_id = $this->database->_get_single_data('tbl_contracts', array('contract_id' => $key['contract_id']), 'invoice_id');
				$this->_change_invoice_status($invoice_id, 4);
			}
		}

		if ($manual) {
			return true;
		}
	}

	/*Upload Files */
	public function upload__files($nameBox)
	{
		$this->load->library("upload");
		$this->load->helper("file");
		$config['upload_path'] = FILES_UPLOAD;
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = 1048576;
		$this->upload->initialize($config);
		$this->upload->overwrite = false;
		if (!$this->upload->do_upload($nameBox)) {
			$error = array('error' => $this->upload->display_errors('', ''));
			if (isset($error['error'])) {
				return 'N/A';
			}
		} else {
			$image_data = $this->upload->data();
			$upload_image_name = $image_data['file_name'];
			$full_path = $image_data['full_path'];
			if (isset($full_path)) {
				return $upload_image_name;
			}
		}
	}

	public function faq()
	{

		$data['faqData'] =	$this->database->_get_row_data('tbl_cms', array('page_name' => 'faq'));
		$this->loadPage('faq', $data);
	}

	public function about()
	{
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_aboutus');
		$data['aboutData'] =	$this->database->_get_row_data('tbl_cms', array('page_name' => 'about_us'));
		$this->loadPage('about', $data);
	}


	public function course($page = 1)
	{
		$data = self::$data;
		$table          		=   'tbl_course';
		$url           			=   'course';
		$perPage        		=  	COURSE_PERPAGE_COUNT;
		$page	        		=  	$this->input->get('page') ?? 1;
		$condition				=	 "";


		$data['records'] 		= 	$this->database->_get_courses('', $perPage, $page);
		$data['links']          =   $this->pagination_loader($url, $table, $perPage,  $sort = "", $condition);



		// $data 					= 	html_escape($this->security->xss_clean($data));
		$this->loadPage('course', $data);
	}



	/*Common per user list pagination creator*/
	public function pagination_loader($url, $table, $perPage, $sort = "", $condition = "")
	{
		$config = array();
		$config["base_url"]                     = site_url($url);
		if (!empty($condition)) {
			$config["total_rows"]               = $this->database->_get_courses($id = "", $limit = "", $start = "", $condition, 1);
		} else {
			$config["total_rows"]                = $this->database->_total_results_count($table);
		}
		$config["per_page"]                     = $perPage;
		$config['use_page_numbers']             = TRUE;

		$config['num_tag_open']                 = '<li class="page-item">';
		$config['num_tag_close']                = '</li>';
		$config['cur_tag_open']                 = '<li class="page-item"><a class="page-link  active">';
		$config['cur_tag_close']                = '</a></li>';
		$config['prev_tag_open']                = '<li class="page-item">';
		$config['prev_tag_close']               = '</li>';
		$config['first_tag_open']               = '<li class="page-item">';
		$config['first_tag_close']              = '</li>';
		$config['last_tag_open']                = '<li class="page-item">';
		$config['last_tag_close']               = '</li>';

		$config['prev_link']                    = '<i class="fa fa-angle-double-left"></i>';
		$config['prev_tag_open']                = '<li class="page-item">';
		$config['prev_tag_close']               = '</li>';


		$config['next_link']                    = '<i class="fa fa-angle-double-right"></i>';
		$config['next_tag_open']                = '<li class="page-item">';
		$config['next_tag_close']               = '</li>';
		$config['suffix']               		= '#courses';
		$config['enable_query_strings'] 		= TRUE;
		$config['page_query_string'] 			= TRUE;
		$config['use_page_numbers'] 			= TRUE;
		$config['reuse_query_string'] 			= TRUE;
		$config['query_string_segment'] 		= 'page';


		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	// get all lesson course wise.
	function courseDetail($slug = "")
	{
		if (!empty($slug)) {

			$data 								=  self::$data;
			$active 							=   1; // get all active lesson
			$limit								=	7; //  get 7 latest course 
			$start 								=	1;
			$table          					=   'tbl_course_lession';
			$condition							=  "";


			$courseIds							= 		fileCache(getUserSlug("_permission"), " ", "get")['course'];
			//pre($courseIds);
			$data['user_permission']			=		$courseIds;



			if (!empty($courseIds)) {

				$data['records']  		=	$this->database->_get_courses("", "",  "",  "",  "", $slug);
				$data['lessons'] 		= 	$this->database->_get_lession($table, '',  '', '', $active, $slug, 'ASC');

				if (in_array($data['records'][0]['course_type'], array_values($courseIds))) {

					if (!empty($data['lessons'])) {
						foreach ($data['lessons']  as $k => $v) {
							$data['lessons'][$k]['free_view'] = 1;
						}
					}
				}
			} else {
				$data['records'] 				= 	$this->database->_get_courses('', '', '', $condition, '', $slug);
				$data['lessons'] 		        = 	$this->database->_get_lession($table, '',  '', '', $active, $slug, 'ASC');
			}
			$data['site_title']					= 	$data['records'][0]['site_title'] ?? '';
			$data['site_keywords']				=	$data['records'][0]['site_keywords'] ?? '';
			$data['site_metadescription']		=	$data['records'][0]['site_metadescription'] ?? '';

			$data['courses'] 		= 	$this->database->_get_courses("", $limit, $start);

			//code to show promotion message on home page
			$course_detail_page_left_side = fileCache("course_detail_page_left_side", "",  "get");
			if (!is_array($course_detail_page_left_side) || count($course_detail_page_left_side) == 0) {
				// it means cache does not have data
				$course_detail_page_left_side_arr  =  $this->database->_get_row_data('tbl_advertisement', array('type' => 'course_detail_page_left_side', 'text_or_icon!=' => NULL, 'text_or_icon!=' => ""));
				if (count($course_detail_page_left_side_arr) > 0) {
					fileCache("course_detail_page_left_side", $course_detail_page_left_side_arr,  "save");
					$data['course_detail_page_left_side'] = $course_detail_page_left_side_arr;
				}
			} else {
				$data['course_detail_page_left_side'] = $course_detail_page_left_side;
			}



			$course_detail_page_right_side = fileCache("course_detail_page_right_side", "",  "get");
			if (!is_array($course_detail_page_right_side) || count($course_detail_page_right_side) == 0) {
				// it means cache does not have data
				$course_detail_page_right_side_arr  =  $this->database->_get_row_data('tbl_advertisement', array('type' => 'course_detail_page_right_side', 'text_or_icon!=' => NULL, 'text_or_icon!=' => ""));
				if (count($course_detail_page_right_side_arr) > 0) {
					fileCache("course_detail_page_right_side", $course_detail_page_right_side_arr,  "save");
					$data['course_detail_page_right_side'] = $course_detail_page_right_side_arr;
				}
			} else {
				$data['course_detail_page_right_side'] = $course_detail_page_right_side;
			}

			$this->loadPage('course-details', $data);
		} else {
			redirect('course');
		}
	}

	public function whatIsDropShipping()
	{
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');







		$this->loadPage('what-is-drop-shipping', $data);
	}
	public function startDropShipping()
	{
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');
		$this->loadPage('start-drop-shipping', $data);
	}


	public function makeMoneyDropShipping()
	{
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');
		$this->loadPage('make-money-drop-shipping', $data);
	}

	public function startOnlineShop()
	{
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');

		$this->loadPage('start-online-shop', $data);
	}

	public function get_static_data($type = 'shopify_dropship', $page = 0, $searchterm = '')
	{
		$arr = '';
		$data = self::$data;
		$data['results']						= 	$this->database->_search_table(
			array('status' => 1, 'tbl_listings.display_on_page' => $type),
			RESULTS_PER_SEARCH,
			$page,
			'tbl_listings.date'
		);
		$data["searchtype"] 					= 	$type;
		$data["links"] 							= 	$this->search_pagination_loader(array('status' => 1, 'tbl_listings.display_on_page' => $type), RESULTS_PER_SEARCH, $page, 'tbl_listings.date', $arr);
		return $data;
	}



	/*solution listing Page*/
	public function solution($page = 0)
	{
		$data = self::$data;
		$page = $this->input->get('page') ?? 1;
		$perPage =  RESULTS_PER_SEARCH;
		$searchterm = $this->input->get('search') ?? "";
		$data['heading'] = "solution_listing";
		$url =  site_url("solution");
		$data['commonData']			=	$this->database->front_solution_listings($perPage, $page, $searchterm);
		// pre(count($data['commonData']) , 1);

		$data["links"] 				= 	$this->front_pagination_loader(
			$page,
			"tbl_solutions",
			'', // condition 
			$perPage,
			$url,
			$searchterm,
			'tbl_solutions.name',
			'', // pageName
			'#solution'
		);
		if (!empty($data['commonData'])) {
			$data['commonData']['user_permission'] = fileCache(getUserSlug("_permission"), " ", "get")['solution'];
		}
		// $data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');
		// pre($data['commonData']['user_permission'] 	,1);
		$this->loadPage('solution', $data);
	}

	public function allMarketplaces($page = 0)
	{


		$data = self::$data;
		$page = $this->input->get('page') ?? 1;
		$perPage =  RESULTS_PER_SEARCH;
		$pageName = "";
		$searchterm = $this->input->get('search') ?? "";



		$data['heading'] = "site_all_marketplaces";
		$url =  site_url("all-marketplaces");
		$data['commonData']	= $this->database->_custome_get_selected_listing_types_frontend('date', 0, $perPage, array('status' => 1), 'app', $pageName, $page, $searchterm);
		$data['commonData2'] = $this->database->front_solution_listings($perPage, $page, $searchterm);

		// $data['commonData']	= $lisitng_data;
		$listing_link = $this->custome_front_pagination_loader($page, "tbl_listings",  array('status' => 1), $perPage, $url, $searchterm, 'tbl_listings.website_BusinessName', '', '#section');


		$data["links"] 	= $listing_link;

		//pre($data['commonData'],1);

		// ($page =  0, $table = 'tbl_listings', $condition = '', $limit = RESULTS_PER_BLOG, $url, $search = '', $column = 'tbl_listings.website_BusinessName', $pageName = '', $hashId = '')


		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');
		$data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['domain'];
		$data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['website'];
		$data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];
		$data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['business'];
		$data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['app'];

		$this->loadPage('all-for-sale', $data);
	}

	public function custome_front_pagination_loader($page =  0, $table = 'tbl_listings', $condition = '', $limit = RESULTS_PER_BLOG, $url, $search = '', $column = 'tbl_listings.website_BusinessName', $pageName = '', $hashId = '')
	{


		$config = array();
		$config["base_url"] 					=  $url;
		$listing_total_rows 					= $this->database->_custome_fetch_frontend_result($table, $limit, $page, true, $condition, $search, $column, '', $pageName);
		$sloutin_total_rows 					= $this->database->_fetch_frontend_result('tbl_solutions', $limit, $page, true, $condition, $search, 'tbl_solutions.name', '', $pageName);


		$config["total_rows"] = $listing_total_rows + $sloutin_total_rows;

		// ($table, $limit = "", $start = 0, $count = false, $condition = "", $search = "", $column = "", $sort = 'date', $pageName = "")
		$config["per_page"] 					= $limit;
		$config['use_page_numbers'] 			= TRUE;

		$config['num_tag_open'] 				= '<li class="page-item">';
		$config['num_tag_close'] 				= '</li>';
		$config['cur_tag_open'] 				= '<li class="page-item"><a class="page-link active">';
		$config['cur_tag_close']				= '</a></li>';
		$config['prev_tag_open'] 				= '<li class="page-item">';
		$config['prev_tag_close'] 				= '</li>';
		$config['first_tag_open'] 				= '<li class="page-item">';
		$config['first_tag_close']				= '</li>';
		$config['last_tag_open'] 				= '<li class="page-item">';
		$config['last_tag_close'] 				= '</li>';

		$config['prev_link'] 					= '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
		$config['prev_tag_open'] 				= '<li class="page-item">';
		$config['prev_tag_close'] 				= '</li>';

		$config['next_link']		 			= '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
		$config['next_tag_open'] 				= '<li class="page-item">';
		$config['next_tag_close'] 				= '</li>';

		$config['enable_query_strings'] 		= TRUE;
		$config['page_query_string'] 			= TRUE;
		$config['use_page_numbers'] 			= TRUE;
		$config['reuse_query_string'] 			= TRUE;
		$config['query_string_segment'] 		= 'page';
		if (!empty($hashId)) {
			$config['suffix'] 						= $hashId;
		}
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
	public function newDomain($page = 0)
	{

		$data = self::$data;
		$page = $this->input->get('page') ?? 0;
		$perPage =  RESULTS_PER_SEARCH;
		$pageName = "";
		$searchterm = $this->input->get('search') ?? "";

		$data['heading'] = "site_domains";
		$url =  site_url("domains");
		$data['commonData']	=	$this->database->_get_selected_listing_types_frontend('date', 0, $perPage, array('tbl_listings.listing_type' => 'domain'), 'app', $pageName, $page, $searchterm);
		$data["links"] 				= 	$this->front_pagination_loader($page, "tbl_listings",  array('status' => 1, 'tbl_listings.listing_type' => 'domain'), $perPage, $url, $searchterm, 'tbl_listings.website_BusinessName', '', '#section');
		//pre($data['commonData'],1);

		// ($page =  0, $table = 'tbl_listings', $condition = '', $limit = RESULTS_PER_BLOG, $url, $search = '', $column = 'tbl_listings.website_BusinessName', $pageName = '', $hashId = '')


		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');
		// $data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['domain'];
		if (!empty($data['commonData'])) {
			$data['commonData']['user_permission'] = fileCache(getUserSlug("_permission"), " ", "get")['domain'];
		}
		$this->loadPage('doamins-for-sale', $data);
	}

	public function newWebsite($page = 0)
	{

		$data = self::$data;
		$page = $this->input->get('page') ?? 0;
		$searchterm = $this->input->get('search') ?? "";
		$perPage =  RESULTS_PER_SEARCH;
		$pageName = "";
		$data['heading'] = "site-newwebsites";
		$url =  site_url("websites");
		$data['commonData']	=	$this->database->_get_selected_listing_types_frontend('date', 0, $perPage, array('tbl_listings.listing_type' => 'website'), 'app', $pageName, $page, $searchterm, 'tbl_listings.website_BusinessName', '', '#section');

		$data["links"] 				= 	$this->front_pagination_loader($page, "tbl_listings",  array('status' => 1, 'tbl_listings.listing_type' => 'website'), $perPage, $url, $searchterm);
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');
		// $data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['website'];
		if (!empty($data['commonData'])) {
			$data['commonData']['user_permission'] = fileCache(getUserSlug("_permission"), " ", "get")['website'];
		}
		$this->loadPage('newwebiste-for-sale', $data);
	}

	public function newApps($page = 0)
	{
		$data = self::$data;
		$page = $this->input->get('page') ?? 0;
		$searchterm = $this->input->get('search') ?? "";
		$perPage =  RESULTS_PER_SEARCH;
		$pageName = "";
		$data['heading'] = "apps_listing";
		$url =  site_url("apps");
		$data['commonData']	=	$this->database->_get_selected_listing_types_frontend('date', 0, $perPage, array('tbl_listings.listing_type' => 'app'), 'app', $pageName, $page, $searchterm);

		$data["links"] 				= 	$this->front_pagination_loader($page, "tbl_listings",  array('status' => 1, 'tbl_listings.listing_type' => 'app'), $perPage, $url, $searchterm, 'tbl_listings.website_BusinessName', '', '#section');


		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');
		// $data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['app'];
		if (!empty($data['commonData'])) {
			$data['commonData']['user_permission'] = fileCache(getUserSlug("_permission"), " ", "get")['app'];
		}
		$this->loadPage('newapps-for-sale', $data);
	}

	public function newBusiness($page = 0)
	{

		$data = self::$data;
		$page = $this->input->get('page') ?? 0;
		$perPage =  RESULTS_PER_SEARCH;
		$pageName = "";
		$searchterm = $this->input->get('search') ?? "";
		$data['heading'] = "site-newbusiness";
		$url =  site_url("businesses");
		$data['commonData']	=	$this->database->_get_selected_listing_types_frontend('date', 0, $perPage, array('tbl_listings.listing_type' => 'business'), 'app', $pageName, $page, $searchterm);
		$data["links"] 				= 	$this->front_pagination_loader($page, "tbl_listings",  array('status' => 1, 'tbl_listings.listing_type' => 'business'), $perPage, $url, $searchterm, 'tbl_listings.website_BusinessName', '', '#section');
		if (!empty($data['commonData'])) {
			$data['commonData']['user_permission'] = fileCache(getUserSlug("_permission"), " ", "get")['business'];
		}
		$data['site_title'] 			= $this->lang->line('site-newbusiness');

		$this->loadPage('newbusiness-for-sale', $data);
	}


	public function searchFor($page = 0)
	{
		$searchterm = $this->input->get('p');
		$opt = $this->input->get('opt');

		redirect($opt . '?search=' . $searchterm);
	}

	// frontend pagination
	public function front_pagination_loader($page =  0, $table = 'tbl_listings', $condition = '', $limit = RESULTS_PER_BLOG, $url, $search = '', $column = 'tbl_listings.website_BusinessName', $pageName = '', $hashId = '')
	{

		$config = array();
		$config["base_url"] 					=  $url;
		$config["total_rows"] 					= $this->database->_fetch_frontend_result($table, $limit, $page, true, $condition, $search, $column, '', $pageName);



		// ($table, $limit = "", $start = 0, $count = false, $condition = "", $search = "", $column = "", $sort = 'date', $pageName = "")
		$config["per_page"] 					= $limit;
		$config['use_page_numbers'] 			= TRUE;

		$config['num_tag_open'] 				= '<li class="page-item">';
		$config['num_tag_close'] 				= '</li>';
		$config['cur_tag_open'] 				= '<li class="page-item"><a class="page-link active">';
		$config['cur_tag_close']				= '</a></li>';
		$config['prev_tag_open'] 				= '<li class="page-item">';
		$config['prev_tag_close'] 				= '</li>';
		$config['first_tag_open'] 				= '<li class="page-item">';
		$config['first_tag_close']				= '</li>';
		$config['last_tag_open'] 				= '<li class="page-item">';
		$config['last_tag_close'] 				= '</li>';

		$config['prev_link'] 					= '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
		$config['prev_tag_open'] 				= '<li class="page-item">';
		$config['prev_tag_close'] 				= '</li>';

		$config['next_link']		 			= '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
		$config['next_tag_open'] 				= '<li class="page-item">';
		$config['next_tag_close'] 				= '</li>';

		$config['enable_query_strings'] 		= TRUE;
		$config['page_query_string'] 			= TRUE;
		$config['use_page_numbers'] 			= TRUE;
		$config['reuse_query_string'] 			= TRUE;
		$config['query_string_segment'] 		= 'page';
		if (!empty($hashId)) {
			$config['suffix'] 						= $hashId;
		}
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}




	// public function websitesForSaleAjax($page)
	// {

	// 	$data = self::$data;
	// 	$data = self::$data;
	// 	$page = $page;
	// 	$perPage =  RESULTS_PER_SEARCH;
	// 	$pageName = "shopify_dropship";
	// 	$data['featuredWebsite']	=	$this->database->_get_selected_listing_types_frontend('date', 0, $perPage, array('tbl_listings.listing_type' => 'website', 'frontend_section' => 'featured'), 'app', $pageName, $page);

	// 	$data["links"] 				= 	$this->front_pagination_loader($page , "tbl_listings" ,  array('status' => 1, 'tbl_listings.listing_type' => 'website', 'frontend_section' => 'featured') , $perPage  );

	// 	$response 				= $this->load->view('main/includes/common-pagination', $data, TRUE);
	// 	$output['response'] 	= $response;
	// 	$output['token'] 		= $this->security->get_csrf_hash();
	// 	header('Content-Type: application/json');
	// 	exit(json_encode($output));
	// }
	//-------------------
	public function websitesForSale($page = 0)
	{
		//$data = self::$data;
		// $page = $page;
		// $searchterm = $this->input->get('search') ?? "";

		$data = self::$data;

		$perPage =  SECTION_WISE;
		$page = $this->input->get('page') ?? 1;
		$searchterm = $this->input->get('search') ?? "";

		// Buy Featured Premium Shopify Dropship Stores & Ecommerce Websites for sale
		$pageName = PAGESNAME_SECTION["websites-for-sale-feature"];
		$data['featuredWebsite']	=	$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['featuredWebsite']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];



		//BUY PREMIUM SHOPIFY STORES & DROPSHIP WEBSITES FOR SALE
		$pageName = PAGESNAME_SECTION["websites-for-sale-premium"];
		$data['premiumWebsites']	=	$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['premiumWebsites']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];


		//BUY LATEST SHOPIFY STORES & DROPSHIP WEBSITES FOR SALE
		$pageName = PAGESNAME_SECTION["websites-for-sale-latest"];
		$data['latestWebsites']	=		$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['latestWebsites']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];


		// $data['featuredApp']		=	$this->database->_get_selected_listing_types('date', 0, RESULTS_PER_HOMEPAGE, array('tbl_listings.listing_type' => 'app'));

		// $data['featuredBusiness']	=	$this->database->_get_selected_listing_types('date', 0, RESULTS_PER_HOMEPAGE, array('tbl_listings.listing_type' => 'business'));
		// $data['blogs']				= 	$this->database->_fetch_blog_posts(RESULTS_PER_BLOG, 0, false, 'date');
		$data['site_name'] 				= $this->lang->line('site_name');

		$data['site_title'] 			= $this->lang->line('websitesForSale_site_home');
		$data['site_metadescription'] 	= $this->lang->line('websitesForSale_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('websitesForSale_site_keywords');
		$data['canonical']              = $this->lang->line('websitesForSale_canonical');
		$data['og_type']                = $this->lang->line('websitesForSale_og_type');
		$data['og_title']               = $this->lang->line('websitesForSale_og_title');
		$data['og_description']         = $this->lang->line('websitesForSale_og_description');
		$data['og_url']                 = $this->lang->line('websitesForSale_og_url');
		$data['og_site_name']           = $this->lang->line('websitesForSale_og_site_name');
		$data['twitter_description']    = $this->lang->line('websitesForSale_site_name');
		$data['twitter_title']          = $this->lang->line('websitesForSale_twitter_description');


		$this->loadPage('websites-for-sale', $data);
	}

	public function shopifyDropWebsitesForSale($page = 0)
	{
		//$data = self::$data;
		//$page = $page;
		// $searchterm = $this->input->get('search') ?? "";
		//$perPage =  RESULTS_PER_SEARCH;
		// $pageName = "product-category-shopify-dropship-websites-for-sale";
		// $data['heading'] = "site_websites_premium";
		// $pageName = "product-category-shopify-dropship-websites-for-sale";
		// $data['heading'] = "shopify-dropship-websites-for-sale";
		// $url =  site_url("product-category/shopify-dropship-websites-for-sale");
		// $data['commonData']	=	$this->database->_get_selected_listing_types_frontend('date', 0, $perPage, array('tbl_listings.listing_type' => 'website'), 'app', $pageName,  $page);
		// if (!empty($data['commonData'])) {
		// 	$data["links"] 				= 	$this->front_pagination_loader($page, "tbl_listings",  array('status' => 1, 'tbl_listings.listing_type' => 'website'), $perPage, $url);
		// }


		$datac['heading'] = "shopify-dropship-websites-for-sale";
		// $datac['pageName'] = "product-category-shopify-dropship-websites-for-sale";
		$datac['pageName'] = "";
		$datac['url'] = site_url("product-category/shopify-dropship-websites-for-sale");
		$datac['condition'] = 'category_id = "1" ';
		// $datac['condition'] = "frontend_section = 'feature'";
		$data = $this->commonListing($datac);


		$data['site_name'] 				= $this->lang->line('site_name');

		$data['site_title'] 			= $this->lang->line('websitesForSale_site_title');
		$data['site_metadescription'] 	= $this->lang->line('websitesForSale_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('websitesForSale_site_keywords');
		$data['canonical']              = $this->lang->line('websitesForSale_canonical');
		$data['og_type']                = $this->lang->line('websitesForSale_og_type');
		$data['og_title']               = $this->lang->line('websitesForSale_og_title');
		$data['og_description']         = $this->lang->line('websitesForSale_og_description');
		$data['og_url']                 = $this->lang->line('websitesForSale_og_url');
		$data['og_site_name']           = $this->lang->line('websitesForSale_og_site_name');
		$data['twitter_description']    = $this->lang->line('websitesForSale_site_name');
		$data['twitter_title']          = $this->lang->line('websitesForSale_twitter_description');


		$this->loadPage('shopify-dropship-websites-for-sale', $data);
	}

	public function websitesForPremiumSale($page = 0)
	{
		// $data = self::$data;
		// $page = $page;
		// $perPage =  RESULTS_PER_SEARCH;
		// $pageName = "product-category-shopify-premium-dropship-websites-for-sale";
		// $data['heading'] = "site_websites_premium";
		// $url =  site_url("product-category/shopify-premium-dropship-websites-for-sale");
		// $data['commonData']	=	$this->database->_get_selected_listing_types_frontend('date', 0, $perPage, array('tbl_listings.listing_type' => 'website', 'frontend_section' => 'premium'), 'app', $pageName, $page);
		// $data["links"] 				= 	$this->front_pagination_loader($page, "tbl_listings",  array('status' => 1, 'tbl_listings.listing_type' => 'website', 'frontend_section' => 'premium'), $perPage, $url);



		$datac['heading'] = "site_websites_premium";
		//  $datac['pageName'] = "product-category-shopify-premium-dropship-websites-for-sale";
		$datac['pageName'] = "";
		$datac['url'] = site_url("product-category/shopify-premium-dropship-websites-for-sale");
		// $datac['condition'] = 'frontend_section = "premium" ';
		$datac['condition'] = 'category_id = "2" ';
		$data = $this->commonListing($datac);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('websitesForPremiumSale_site_title');
		$data['site_metadescription'] 	= $this->lang->line('websitesForPremiumSale_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('websitesForPremiumSale_site_keywords');
		$data['canonical']              = $this->lang->line('websitesForPremiumSale_canonical');
		$data['og_type']                = $this->lang->line('websitesForPremiumSale_og_type');
		$data['og_title']               = $this->lang->line('websitesForPremiumSale_og_title');
		$data['og_description']         = $this->lang->line('websitesForPremiumSale_og_description');
		$data['og_url']                 = $this->lang->line('websitesForPremiumSale_og_url');
		$data['og_site_name']           = $this->lang->line('websitesForPremiumSale_og_site_name');
		$data['twitter_description']    = $this->lang->line('websitesForPremiumSale_site_name');
		$data['twitter_title']          = $this->lang->line('websitesForPremiumSale_twitter_description');

		$this->loadPage('websites-for-premium_sale', $data);
	}

	public function websitesForExclusiveSale($page = 0)
	{
		// $datac['heading'] = "site_websites_exclusive";
		// //  $datac['pageName'] = "product-category-shopify-premium-dropship-websites-for-sale";
		// $datac['pageName'] = "";
		// $datac['url'] = site_url("product-category/exclusive-shopify-dropship-stores-for-sale");
		// // $datac['condition'] = 'frontend_section = "premium" ';
		// $datac['condition'] = 'category_id = "39" ';
		// $data = $this->commonListing($datac);
		$data = self::$data;
		$page = $this->input->get('page') ?? 0;
		$perPage =  RESULTS_PER_SEARCH;
		$pageName = "";
		$searchterm =  "";

		$data['heading'] = "site_websites_exclusive";
		$data['pageName'] = "";
		$data['url'] = site_url("product-category/exclusive-shopify-dropship-stores-for-sale");
		$url =  site_url("product-category/exclusive-shopify-dropship-stores-for-sale");
		$data['commonData']	= $this->database->_get_selected_listing_types_frontend('date', 0, $perPage, array('page_tags' => 'exclusive-shopify-store'), 'app', $pageName, $page, $searchterm);
		$data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['domain'];
		$data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['website'];
		$data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];
		$data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['business'];
		$data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['app'];

		$data["links"] = $this->front_pagination_loader($page, "tbl_listings",  array('page_tags' => 'exclusive-shopify-store'), $perPage, $url, $searchterm, 'tbl_listings.website_BusinessName', '', '#section');

		// var_dump($data['commonData']);
		// var_dump($data['links']);
		// exit;
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('websitesForExclusiveSale_site_title');
		$data['site_metadescription'] 	= $this->lang->line('websitesForExclusiveSale_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('websitesForExclusiveSale_site_keywords');
		$data['canonical']              = $this->lang->line('websitesForExclusiveSale_canonical');
		$data['og_type']                = $this->lang->line('websitesForExclusiveSale_og_type');
		$data['og_title']               = $this->lang->line('websitesForExclusiveSale_og_title');
		$data['og_description']         = $this->lang->line('websitesForExclusiveSale_og_description');
		$data['og_url']                 = $this->lang->line('websitesForExclusiveSale_og_url');
		$data['og_site_name']           = $this->lang->line('websitesForExclusiveSale_og_site_name');
		$data['twitter_description']    = $this->lang->line('websitesForExclusiveSale_site_name');
		$data['twitter_title']          = $this->lang->line('websitesForExclusiveSale_twitter_description');

		$this->loadPage('websites-for-exclusive_sale', $data);
	}
	
	public function websitesForLatestSale($page = 0)
	{
		// $data = self::$data;
		// $page = $page;
		// $perPage =  RESULTS_PER_SEARCH;
		// $pageName = "product-category-shopify-latest-dropship-websites-for-sale";
		// $data['heading'] = "site_websites_latest";
		// $url = site_url("product-category/shopify-latest-dropship-websites-for-sale");
		// $data['commonData']	=	$this->database->_get_selected_listing_types_frontend('date', 0, $perPage, array('tbl_listings.listing_type' => 'website', 'frontend_section' => 'latest'), 'app', $pageName, $page);
		// $data["links"] 				= 	$this->front_pagination_loader($page, "tbl_listings",  array('status' => 1, 'tbl_listings.listing_type' => 'website', 'frontend_section' => 'latest'), $perPage, $url);


		$datac['heading'] = "site_websites_latest";
		// $datac['pageName'] = "product-category-shopify-latest-dropship-websites-for-sale";
		$datac['pageName'] = "";
		// product-category-shopify-latest-dropship-websites-for-sale
		$datac['url'] = site_url("product-category/shopify-latest-dropship-websites-for-sale");
		$datac['condition'] = 'service_type_id = "1" ';
		//$datac['condition'] = 'frontend_section = "latest" ';
		$data = $this->commonListing($datac);

		// pre($data,1);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');

		$this->loadPage('websites-for-latest-sale', $data);
	}



	public function getStarted()
	{
		$data = self::$data;
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_getStarted');
		$data['count']				= $this->database->all_website_count();

		$this->loadPage('get-started', $data);
	}

	public function terms_of_services()
	{
		$data = self::$data;

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_terms_of_services');
		$this->loadPage('terms-of-services', $data);
	}
	public function privacy_policy()
	{
		$data = self::$data;
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_privacy_policy');
		$this->loadPage('privacy_policy', $data);
	}
	public function purchase_agreement()
	{
		$data = self::$data;
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_purchase');
		$this->loadPage('purchase_agreement', $data);
	}

	public function dropShipping($page = 0)
	{

		$data = self::$data;
		$perPage =  SECTION_WISE;
		$page = $this->input->get('page') ?? 1;
		$searchterm = $this->input->get('search') ?? "";


		// Buy Featured Premium Shopify Dropship Stores & Ecommerce Websites for sale
		$pageName = PAGESNAME_SECTION["dropshipping_feature"];
		$data['featuredWebsite']	=	$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['featuredWebsite']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];


		//BUY PREMIUM SHOPIFY STORES & DROPSHIP WEBSITES FOR SALE
		$pageName = PAGESNAME_SECTION["dropshipping_premium"];
		$data['premiumWebsites']	=	$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['premiumWebsites']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];
		//BUY LATEST SHOPIFY STORES & DROPSHIP WEBSITES FOR SALE
		$pageName = PAGESNAME_SECTION["dropshipping_latest"];
		$data['latestWebsites']	=		$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['latestWebsites']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];


		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('dropShipping_site_title');
		$data['site_metadescription'] 	= $this->lang->line('dropShipping_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('dropShipping_site_keywords');
		$data['canonical']              = $this->lang->line('dropShipping_canonical');
		$data['og_type']                = $this->lang->line('dropShipping_og_type');
		$data['og_title']               = $this->lang->line('dropShipping_og_title');
		$data['og_description']         = $this->lang->line('dropShipping_og_description');
		$data['og_url']                 = $this->lang->line('dropShipping_og_url');
		$data['og_site_name']           = $this->lang->line('dropShipping_og_site_name');
		$data['twitter_description']    = $this->lang->line('dropShipping_site_name');
		$data['twitter_title']          = $this->lang->line('dropShipping_twitter_description');


		$this->loadPage('drop-shipping', $data);
	}

	public function ecommerceBusiness($page = 0)
	{
		// $data = self::$data;
		// $page = $this->input->get('page') ?? 0;
		// $perPage =  RESULTS_PER_SEARCH;
		// $url =  site_url("product-category/ecommerce-business");
		// $pageName = "product-category-ecommerce-business";
		// $data['heading'] = "ecommerce-business";

		// $data['commonData']				=	$this->database->_get_selected_listing_types_frontend('date', 0, $perPage, array('tbl_listings.listing_type' => 'website'), 'app', $pageName, $page);
		// $data["links"] 					= 	$this->front_pagination_loader($page, "tbl_listings",  array('status' => 1, 'tbl_listings.listing_type' => 'website'), $perPage, $url, '', '', $pageName);


		$datac['heading'] = "ecommerce-business";
		$datac['pageName'] = "product-category-ecommerce-business";
		$datac['url'] = site_url("product-category/ecommerce-business");
		$data = $this->commonListing($datac);

		// $page, $table = "tbl_listings", $condition = "", $limit = RESULTS_PER_BLOG, $url , $search = "" ,$column= 'tbl_listings.website_BusinessName' ,$pageName = ""

		$data['site_name'] 				= $this->lang->line('ecommerceBusiness_site_name');
		$data['site_title'] 			= $this->lang->line('ecommerceBusiness_site_title');
		$data['site_metadescription'] 	= $this->lang->line('ecommerceBusiness_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('ecommerceBusiness_site_keywords');
		$data['canonical']              = $this->lang->line('ecommerceBusiness_canonical');
		$data['og_type']                = $this->lang->line('ecommerceBusiness_og_type');
		$data['og_title']               = $this->lang->line('ecommerceBusiness_og_title');
		$data['og_description']         = $this->lang->line('ecommerceBusiness_og_description');
		$data['og_url']                 = $this->lang->line('ecommerceBusiness_og_url');
		$data['og_site_name']           = $this->lang->line('ecommerceBusiness_og_site_name');
		$data['twitter_description']    = $this->lang->line('ecommerceBusiness_site_name');
		$data['twitter_title']          = $this->lang->line('ecommerceBusiness_twitter_description');


		$this->loadPage('ecommerce-business', $data);
	}

	function loadPage($template, $data = null)
	{
		$data['template_name'] 		= 	$template;
		$data['data'] 				= 	$data;
		// $data 						= 	html_escape($this->security->xss_clean($data));
		$this->load->view('main/master-template', $data);
	}

	public function static_product($id)
	{

		$data['single_item'] = $this->database->_get_row_data('tbl_listings', array('id' => $id));
		$this->loadPage('single-static-item', $data);
	}
	//----


	public function commonListing($arr)
	{

		extract($arr);
		$data = self::$data;
		$page = $this->input->get('page') ?? 1;
		$data['heading'] = $heading;
		$pageName = $pageName;
		$perPage =  RESULTS_PER_SEARCH;
		$searchterm = $this->input->get('search') ?? "";
		$data['detailed_url'] = $detailed_url ?? '';
		$url =  $url ?? '';
		$condition = $condition ?? '';
		$data['commonData']			=	$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, $condition);

		$data["links"] 				= 	$this->front_pagination_loader(
			$page,
			"tbl_solutions",
			$condition,
			$perPage,
			$url,
			$searchterm,
			'tbl_solutions.name',
			$pageName,
			'#solution'
		);
		$data['commonData']['user_permission'] 		= fileCache(getUserSlug("_permission"), " ", "get")['solution'];

		return $data;
	}

	public function starterWebsitesForSaleFashion($page = 0)
	{

		$datac['heading'] = "fashion_website";
		$datac['pageName'] = "starter-websites-for-sale-fashion";

		$datac['detailed_url'] = "product-category/fashion";
		$datac['url'] =  '';

		$data = $this->commonListing($datac);
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('starterWebsitesForSaleFashion_site_title');
		$data['site_metadescription'] 	= $this->lang->line('starterWebsitesForSaleFashion_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('starterWebsitesForSaleFashion_site_keywords');
		$data['canonical']              = $this->lang->line('starterWebsitesForSaleFashion_canonical');
		$data['og_type']                = $this->lang->line('starterWebsitesForSaleFashion_og_type');
		$data['og_title']               = $this->lang->line('starterWebsitesForSaleFashion_og_title');
		$data['og_description']         = $this->lang->line('starterWebsitesForSaleFashion_og_description');
		$data['og_url']                 = $this->lang->line('starterWebsitesForSaleFashion_og_url');
		$data['og_site_name']           = $this->lang->line('starterWebsitesForSaleFashion_og_site_name');
		$data['twitter_description']    = $this->lang->line('starterWebsitesForSaleFashion_site_name');
		$data['twitter_title']          = $this->lang->line('starterWebsitesForSaleFashion_twitter_description');

		$this->loadPage('starter_websites_for_sale_fashion', $data);
	}
	public function starterWebsitesForSaleGadgetsElectronics($page = 0)
	{

		$datac['heading'] = "gadgets_electronics_websites";
		$datac['pageName'] = "starter-websites-for-sale-gadgets-electronics";

		$datac['detailed_url'] = "product-category/gadgets-electronics";
		$datac['url'] =  '';

		$data = $this->commonListing($datac);



		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('starterWebsitesForSaleGadgetsElectronics_site_title');
		$data['site_metadescription'] 	= $this->lang->line('starterWebsitesForSaleGadgetsElectronics_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('starterWebsitesForSaleGadgetsElectronics_site_keywords');
		$data['canonical']              = $this->lang->line('starterWebsitesForSaleGadgetsElectronics_canonical');
		$data['og_type']                = $this->lang->line('starterWebsitesForSaleGadgetsElectronics_og_type');
		$data['og_title']               = $this->lang->line('starterWebsitesForSaleGadgetsElectronics_og_title');
		$data['og_description']         = $this->lang->line('starterWebsitesForSaleGadgetsElectronics_og_description');
		$data['og_url']                 = $this->lang->line('starterWebsitesForSaleGadgetsElectronics_og_url');
		$data['og_site_name']           = $this->lang->line('starterWebsitesForSaleGadgetsElectronics_og_site_name');
		$data['twitter_description']    = $this->lang->line('starterWebsitesForSaleGadgetsElectronics_site_name');
		$data['twitter_title']          = $this->lang->line('starterWebsitesForSaleGadgetsElectronics_twitter_description');


		$this->loadPage('starter_websites_for_sale_gadgets_electronics', $data);
	}
	public function starterWebsitesForSaleHealth($page = 0)
	{

		$datac['heading'] 	=	"health_websites";
		$datac['pageName'] 	= 	"starter-websites-for-sale-health";
		$datac['detailed_url'] = "product-category/health";
		$datac['url'] =  '';
		$data = $this->commonListing($datac);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('starterWebsitesForSaleHealth_site_title');
		$data['site_metadescription'] 	= $this->lang->line('starterWebsitesForSaleHealth_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('starterWebsitesForSaleHealth_site_keywords');
		$data['canonical']              = $this->lang->line('starterWebsitesForSaleHealth_canonical');
		$data['og_type']                = $this->lang->line('starterWebsitesForSaleHealth_og_type');
		$data['og_title']               = $this->lang->line('starterWebsitesForSaleHealth_og_title');
		$data['og_description']         = $this->lang->line('starterWebsitesForSaleHealth_og_description');
		$data['og_url']                 = $this->lang->line('starterWebsitesForSaleHealth_og_url');
		$data['og_site_name']           = $this->lang->line('starterWebsitesForSaleHealth_og_site_name');
		$data['twitter_description']    = $this->lang->line('starterWebsitesForSaleHealth_site_name');
		$data['twitter_title']          = $this->lang->line('starterWebsitesForSaleHealth_twitter_description');


		$this->loadPage('starter_websites_for_sale_health', $data);
	}
	public function starterWebsitesForSaleHomeDecor($page = 0)
	{


		$datac['heading'] 	=	"home_decore_websites";
		$datac['pageName'] 	= 	 "starter-websites-for-sale-home-decor";
		// $datac['pageName'] 	= 	 "";
		$datac['detailed_url'] = "product-category/home-decor";
		$datac['url'] =  '';
		// $datac['condition'] = 'service_type_id = "1" ';

		$data = $this->commonListing($datac);


		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('starterWebsitesForSaleHomeDecor_site_title');
		$data['site_metadescription'] 	= $this->lang->line('starterWebsitesForSaleHomeDecor_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('starterWebsitesForSaleHomeDecor_site_keywords');
		$data['canonical']              = $this->lang->line('starterWebsitesForSaleHomeDecor_canonical');
		$data['og_type']                = $this->lang->line('starterWebsitesForSaleHomeDecor_og_type');
		$data['og_title']               = $this->lang->line('starterWebsitesForSaleHomeDecor_og_title');
		$data['og_description']         = $this->lang->line('starterWebsitesForSaleHomeDecor_og_description');
		$data['og_url']                 = $this->lang->line('starterWebsitesForSaleHomeDecor_og_url');
		$data['og_site_name']           = $this->lang->line('starterWebsitesForSaleHomeDecor_og_site_name');
		$data['twitter_description']    = $this->lang->line('starterWebsitesForSaleHomeDecor_site_name');
		$data['twitter_title']          = $this->lang->line('starterWebsitesForSaleHomeDecor_twitter_description');


		$this->loadPage('starter_websites_for_sale_home_decor', $data);
	}
	public function starterWebsitesForSaleJewelry($page = 0)
	{

		$datac['heading'] 		=	"jewelary_websites";
		$datac['pageName'] 		= 	"starter-websites-for-sale-jewelry";
		$datac['detailed_url'] 	= 	"product-category/jewelry";
		$datac['url'] =  '';
		$data  = $this->commonListing($datac);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('starterWebsitesForSaleJewelry_site_title');
		$data['site_metadescription'] 	= $this->lang->line('starterWebsitesForSaleJewelry_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('starterWebsitesForSaleJewelry_site_keywords');
		$data['canonical']              = $this->lang->line('starterWebsitesForSaleJewelry_canonical');
		$data['og_type']                = $this->lang->line('starterWebsitesForSaleJewelry_og_type');
		$data['og_title']               = $this->lang->line('starterWebsitesForSaleJewelry_og_title');
		$data['og_description']         = $this->lang->line('starterWebsitesForSaleJewelry_og_description');
		$data['og_url']                 = $this->lang->line('starterWebsitesForSaleJewelry_og_url');
		$data['og_site_name']           = $this->lang->line('starterWebsitesForSaleJewelry_og_site_name');
		$data['twitter_description']    = $this->lang->line('starterWebsitesForSaleJewelry_site_name');
		$data['twitter_title']          = $this->lang->line('starterWebsitesForSaleJewelry_twitter_description');


		$this->loadPage('starter_websites_for_sale_jewelry', $data);
	}
	public function starterWebsitesForSalePets($page = 0)
	{

		$datac['heading'] 		=	"pets_websites";
		$datac['pageName'] 		= 	"starter-websites-for-sale-pets";
		$datac['detailed_url'] 	= 	"product-category/pets";
		$data  = $this->commonListing($datac);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('starterWebsitesForSalePets_site_title');
		$data['site_metadescription'] 	= $this->lang->line('starterWebsitesForSalePets_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('starterWebsitesForSalePets_site_keywords');
		$data['canonical']              = $this->lang->line('starterWebsitesForSalePets_canonical');
		$data['og_type']                = $this->lang->line('starterWebsitesForSalePets_og_type');
		$data['og_title']               = $this->lang->line('starterWebsitesForSalePets_og_title');
		$data['og_description']         = $this->lang->line('starterWebsitesForSalePets_og_description');
		$data['og_url']                 = $this->lang->line('starterWebsitesForSalePets_og_url');
		$data['og_site_name']           = $this->lang->line('starterWebsitesForSalePets_og_site_name');
		$data['twitter_description']    = $this->lang->line('starterWebsitesForSalePets_site_name');
		$data['twitter_title']          = $this->lang->line('starterWebsitesForSalePets_twitter_description');


		$this->loadPage('starter_websites_for_sale_pets', $data);
	}
	public function starterWebsitesForSaleSports($page = 0)
	{


		$datac['heading'] 		=	"sports_websites";
		$datac['pageName'] 		= 	"starter-websites-for-sale-sports";
		$datac['detailed_url'] 	= 	"product-category/sports";
		$data  = $this->commonListing($datac);


		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('starterWebsitesForSaleSports_site_title');
		$data['site_metadescription'] 	= $this->lang->line('starterWebsitesForSaleSports_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('starterWebsitesForSaleSports_site_keywords');
		$data['canonical']              = $this->lang->line('starterWebsitesForSaleSports_canonical');
		$data['og_type']                = $this->lang->line('starterWebsitesForSaleSports_og_type');
		$data['og_title']               = $this->lang->line('starterWebsitesForSaleSports_og_title');
		$data['og_description']         = $this->lang->line('starterWebsitesForSaleSports_og_description');
		$data['og_url']                 = $this->lang->line('starterWebsitesForSaleSports_og_url');
		$data['og_site_name']           = $this->lang->line('starterWebsitesForSaleSports_og_site_name');
		$data['twitter_description']    = $this->lang->line('starterWebsitesForSaleSports_site_name');
		$data['twitter_title']          = $this->lang->line('starterWebsitesForSaleSports_twitter_description');


		$this->loadPage('starter_websites_for_sale_sports', $data);
	}
	public function starterWebsitesForSaleToys($page = 0)
	{

		$datac['heading'] 		=	"toys_websites";
		$datac['pageName'] 		= 	"starter-websites-for-sale-toys";
		$datac['detailed_url'] 	= 	"product-category/toys";
		$data  = $this->commonListing($datac);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('starterWebsitesForSaleToys_site_title');
		$data['site_metadescription'] 	= $this->lang->line('starterWebsitesForSaleToys_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('starterWebsitesForSaleToys_site_keywords');
		$data['canonical']              = $this->lang->line('starterWebsitesForSaleToys_canonical');
		$data['og_type']                = $this->lang->line('starterWebsitesForSaleToys_og_type');
		$data['og_title']               = $this->lang->line('starterWebsitesForSaleToys_og_title');
		$data['og_description']         = $this->lang->line('starterWebsitesForSaleToys_og_description');
		$data['og_url']                 = $this->lang->line('starterWebsitesForSaleToys_og_url');
		$data['og_site_name']           = $this->lang->line('starterWebsitesForSaleToys_og_site_name');
		$data['twitter_description']    = $this->lang->line('starterWebsitesForSaleToys_site_name');
		$data['twitter_title']          = $this->lang->line('starterWebsitesForSaleToys_twitter_description');


		$this->loadPage('starter_websites_for_sale_toys', $data);
	}
	public function starterWebsitesForSaleTravel($page = 0)
	{


		$datac['heading'] 		=	"travel_websites";
		$datac['pageName'] 		= 	"starter-websites-for-sale-travel";
		$datac['detailed_url'] 	= 	"product-category/travel";
		$data  = $this->commonListing($datac);


		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('starterWebsitesForSaleTravel_site_title');
		$data['site_metadescription'] 	= $this->lang->line('starterWebsitesForSaleTravel_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('starterWebsitesForSaleTravel_site_keywords');
		$data['canonical']              = $this->lang->line('starterWebsitesForSaleTravel_canonical');
		$data['og_type']                = $this->lang->line('starterWebsitesForSaleTravel_og_type');
		$data['og_title']               = $this->lang->line('starterWebsitesForSaleTravel_og_title');
		$data['og_description']         = $this->lang->line('starterWebsitesForSaleTravel_og_description');
		$data['og_url']                 = $this->lang->line('starterWebsitesForSaleTravel_og_url');
		$data['og_site_name']           = $this->lang->line('starterWebsitesForSaleTravel_og_site_name');
		$data['twitter_description']    = $this->lang->line('starterWebsitesForSaleTravel_site_name');
		$data['twitter_title']          = $this->lang->line('starterWebsitesForSaleTravel_twitter_description');


		$this->loadPage('starter_websites_for_sale_travel', $data);
	}

	public function productCategoryFashion($page = 0)
	{

		$datac['heading'] = "fashion_website";
		// $datac['pageName'] = "product-category-fashion";
		$datac['pageName'] = "";
		$datac['condition'] = 'sub_category_id = "13" or sub_category_id = "3"';
		$datac['url'] =  site_url("product-category/fashion");
		$data = $this->commonListing($datac);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('productCategoryFashion_site_title');
		$data['site_metadescription'] 	= $this->lang->line('productCategoryFashion_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('productCategoryFashion_site_keywords');
		$data['canonical']              = $this->lang->line('productCategoryFashion_canonical');
		$data['og_type']                = $this->lang->line('productCategoryFashion_og_type');
		$data['og_title']               = $this->lang->line('productCategoryFashion_og_title');
		$data['og_description']         = $this->lang->line('productCategoryFashion_og_description');
		$data['og_url']                 = $this->lang->line('productCategoryFashion_og_url');
		$data['og_site_name']           = $this->lang->line('productCategoryFashion_og_site_name');
		$data['twitter_description']    = $this->lang->line('productCategoryFashion_site_name');
		$data['twitter_title']          = $this->lang->line('productCategoryFashion_twitter_description');

		$this->loadPage('product_category_fashion', $data);
	}
	public function productCategoryGadgetsElectronics($page = 0)
	{

		$datac['heading'] = "gadgets_electronics_websites";
		$datac['pageName'] = "product-category-gadgets-electronics";
		$datac['url'] = site_url("product-category/gadgets-electronics");
		$data = $this->commonListing($datac);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('productCategoryGadgetsElectronics_site_title');
		$data['site_metadescription'] 	= $this->lang->line('productCategoryGadgetsElectronics_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('productCategoryGadgetsElectronics_site_keywords');
		$data['canonical']              = $this->lang->line('productCategoryGadgetsElectronics_canonical');
		$data['og_type']                = $this->lang->line('productCategoryGadgetsElectronics_og_type');
		$data['og_title']               = $this->lang->line('productCategoryGadgetsElectronics_og_title');
		$data['og_description']         = $this->lang->line('productCategoryGadgetsElectronics_og_description');
		$data['og_url']                 = $this->lang->line('productCategoryGadgetsElectronics_og_url');
		$data['og_site_name']           = $this->lang->line('productCategoryGadgetsElectronics_og_site_name');
		$data['twitter_description']    = $this->lang->line('productCategoryGadgetsElectronics_site_name');
		$data['twitter_title']          = $this->lang->line('productCategoryGadgetsElectronics_twitter_description');


		$this->loadPage('product_category_gadgets_electronics', $data);
	}
	public function productCategoryHealth($page = 0)
	{


		$datac['heading'] = "health_websites";
		$datac['pageName'] = "product-category-health";
		$datac['url'] = site_url("product-category/health");
		$data = $this->commonListing($datac);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('productCategoryHealth_site_title');
		$data['site_metadescription'] 	= $this->lang->line('productCategoryHealth_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('productCategoryHealth_site_keywords');
		$data['canonical']              = $this->lang->line('productCategoryHealth_canonical');
		$data['og_type']                = $this->lang->line('productCategoryHealth_og_type');
		$data['og_title']               = $this->lang->line('productCategoryHealth_og_title');
		$data['og_description']         = $this->lang->line('productCategoryHealth_og_description');
		$data['og_url']                 = $this->lang->line('productCategoryHealth_og_url');
		$data['og_site_name']           = $this->lang->line('productCategoryHealth_og_site_name');
		$data['twitter_description']    = $this->lang->line('productCategoryHealth_site_name');
		$data['twitter_title']          = $this->lang->line('productCategoryHealth_twitter_description');


		$this->loadPage('product_category_health', $data);
	}
	public function productCategoryJewelry($page = 0)
	{

		$datac['heading'] = "jewelary_websites";
		$datac['pageName'] = "product-category-jewelry";
		$datac['url'] = site_url("product-category/jewelry");
		$data = $this->commonListing($datac);


		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('productCategoryJewelry_site_title');
		$data['site_metadescription'] 	= $this->lang->line('productCategoryJewelry_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('productCategoryJewelry_site_keywords');
		$data['canonical']              = $this->lang->line('productCategoryJewelry_canonical');
		$data['og_type']                = $this->lang->line('productCategoryJewelry_og_type');
		$data['og_title']               = $this->lang->line('productCategoryJewelry_og_title');
		$data['og_description']         = $this->lang->line('productCategoryJewelry_og_description');
		$data['og_url']                 = $this->lang->line('productCategoryJewelry_og_url');
		$data['og_site_name']           = $this->lang->line('productCategoryJewelry_og_site_name');
		$data['twitter_description']    = $this->lang->line('productCategoryJewelry_site_name');
		$data['twitter_title']          = $this->lang->line('productCategoryJewelry_twitter_description');

		$this->loadPage('product_category_jewelry', $data);
	}
	public function productCategoryPets($page = 0)
	{

		$datac['heading'] = "pets_websites";
		$datac['pageName'] = "product-category-pets";
		$datac['url'] = site_url("product-category/pets");
		$data = $this->commonListing($datac);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('productCategoryPets_site_title');
		$data['site_metadescription'] 	= $this->lang->line('productCategoryPets_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('productCategoryPets_site_keywords');
		$data['canonical']              = $this->lang->line('productCategoryPets_canonical');
		$data['og_type']                = $this->lang->line('productCategoryPets_og_type');
		$data['og_title']               = $this->lang->line('productCategoryPets_og_title');
		$data['og_description']         = $this->lang->line('productCategoryPets_og_description');
		$data['og_url']                 = $this->lang->line('productCategoryPets_og_url');
		$data['og_site_name']           = $this->lang->line('productCategoryPets_og_site_name');
		$data['twitter_description']    = $this->lang->line('productCategoryPets_site_name');
		$data['twitter_title']          = $this->lang->line('productCategoryPets_twitter_description');


		$this->loadPage('product_category_pets', $data);
	}
	public function productCategorySport($page = 0)
	{


		$datac['heading'] = "sports_websites";
		$datac['pageName'] = "product-category-sports";
		$datac['url'] = site_url("product-category/sport");
		$data = $this->commonListing($datac);


		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('productCategorySport_site_title');
		$data['site_metadescription'] 	= $this->lang->line('productCategorySport_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('productCategorySport_site_keywords');
		$data['canonical']              = $this->lang->line('productCategorySport_canonical');
		$data['og_type']                = $this->lang->line('productCategorySport_og_type');
		$data['og_title']               = $this->lang->line('productCategorySport_og_title');
		$data['og_description']         = $this->lang->line('productCategorySport_og_description');
		$data['og_url']                 = $this->lang->line('productCategorySport_og_url');
		$data['og_site_name']           = $this->lang->line('productCategorySport_og_site_name');
		$data['twitter_description']    = $this->lang->line('productCategorySport_site_name');
		$data['twitter_title']          = $this->lang->line('productCategorySport_twitter_description');


		$this->loadPage('product_category_sport', $data);
	}
	public function productCategoryToys($page = 0)
	{

		$datac['heading'] 	= "toys_websites";
		$datac['pageName'] 	= "product-category-toys";
		$datac['url'] 		= site_url("product-category/toys");
		$data = $this->commonListing($datac);


		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('productCategoryToys_site_title');
		$data['site_metadescription'] 	= $this->lang->line('productCategoryToys_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('productCategoryToys_site_keywords');
		$data['canonical']              = $this->lang->line('productCategoryToys_canonical');
		$data['og_type']                = $this->lang->line('productCategoryToys_og_type');
		$data['og_title']               = $this->lang->line('productCategoryToys_og_title');
		$data['og_description']         = $this->lang->line('productCategoryToys_og_description');
		$data['og_url']                 = $this->lang->line('productCategoryToys_og_url');
		$data['og_site_name']           = $this->lang->line('productCategoryToys_og_site_name');
		$data['twitter_description']    = $this->lang->line('productCategoryToys_site_name');
		$data['twitter_title']          = $this->lang->line('productCategoryToys_twitter_description');


		$this->loadPage('product_category_toys', $data);
	}
	public function productCategoryTravel($page = 0)
	{

		$datac['heading'] 	= "travel_websites";
		$datac['pageName'] 	= "product-category-travel";
		$datac['url'] 		= site_url("product-category/travel");
		$data = $this->commonListing($datac);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('productCategoryTravel_site_title');
		$data['site_metadescription'] 	= $this->lang->line('productCategoryTravel_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('productCategoryTravel_site_keywords');
		$data['canonical']              = $this->lang->line('productCategoryTravel_canonical');
		$data['og_type']                = $this->lang->line('productCategoryTravel_og_type');
		$data['og_title']               = $this->lang->line('productCategoryTravel_og_title');
		$data['og_description']         = $this->lang->line('productCategoryTravel_og_description');
		$data['og_url']                 = $this->lang->line('productCategoryTravel_og_url');
		$data['og_site_name']           = $this->lang->line('productCategoryTravel_og_site_name');
		$data['twitter_description']    = $this->lang->line('productCategoryTravel_site_name');
		$data['twitter_title']          = $this->lang->line('productCategoryTravel_twitter_description');


		$this->loadPage('product_category_travel', $data);
	}


	public function productCategoryHomeDecor($page = 0)
	{

		$datac['heading'] 	= "home-decor";
		$datac['pageName'] 	= "";
		// $datac['pageName'] 	= "product-category-home-decor";

		$datac['condition'] = 'sub_category_id = "16" or sub_category_id = "6"';
		$datac['url'] 		= site_url("product-category/home-decor");
		$data = $this->commonListing($datac);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('productCategoryHomeDecor_site_title');
		$data['site_metadescription'] 	= $this->lang->line('productCategoryHomeDecor_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('productCategoryHomeDecor_site_keywords');
		$data['canonical']              = $this->lang->line('productCategoryHomeDecor_canonical');
		$data['og_type']                = $this->lang->line('productCategoryHomeDecor_og_type');
		$data['og_title']               = $this->lang->line('productCategoryHomeDecor_og_title');
		$data['og_description']         = $this->lang->line('productCategoryHomeDecor_og_description');
		$data['og_url']                 = $this->lang->line('productCategoryHomeDecor_og_url');
		$data['og_site_name']           = $this->lang->line('productCategoryHomeDecor_og_site_name');
		$data['twitter_description']    = $this->lang->line('productCategoryHomeDecor_site_name');
		$data['twitter_title']          = $this->lang->line('productCategoryHomeDecor_twitter_description');


		$this->loadPage('product_category_home_decor', $data);
	}





	public function dropshippingProducts($page = 0)
	{

		$datac['heading'] 	= "site_websites_premium";
		$datac['pageName'] 	= "dropshipping-products";
		$datac['url'] 		= site_url("dropshipping-products");
		$data = $this->commonListing($datac);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('dropshippingProducts_site_title');
		$data['site_metadescription'] 	= $this->lang->line('dropshippingProducts_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('dropshippingProducts_site_keywords');
		$data['canonical']              = $this->lang->line('dropshippingProducts_canonical');
		$data['og_type']                = $this->lang->line('dropshippingProducts_og_type');
		$data['og_title']               = $this->lang->line('dropshippingProducts_og_title');
		$data['og_description']         = $this->lang->line('dropshippingProducts_og_description');
		$data['og_url']                 = $this->lang->line('dropshippingProducts_og_url');
		$data['og_site_name']           = $this->lang->line('dropshippingProducts_og_site_name');
		$data['twitter_description']    = $this->lang->line('dropshippingProducts_site_name');
		$data['twitter_title']          = $this->lang->line('dropshippingProducts_twitter_description');



		$this->loadPage('dropshipping_products', $data);
	}


	public function dropshippingWebsites($page = 0)
	{
		$data = self::$data;
		$data['sponsoredAds']		= 	$this->database->_get_specific_listing();
		$data['slider_name']		= 	'featured-slider';
		$data['endingSoon']			=   $this->database->_get_auction_ending_soon('', 'app');
		$data['domainlist']			=   $this->partition($this->database->_get_row_data('tbl_listings', array('listing_type' => 'domain', 'status' => 1), 30, '', true), 3);

		$data['featuredPosts']		= 	$this->database->_fetch_blog_posts(RESULTS_PER_BLOG, 0, false, 'views');


		$data = self::$data;

		$perPage =  SECTION_WISE;
		$page = $this->input->get('page') ?? 1;
		$searchterm = $this->input->get('search') ?? "";

		// Buy Featured Premium Shopify Dropship Stores & Ecommerce Websites for sale
		$pageName = PAGESNAME_SECTION["dropshipping-websites-feature"];
		$data['featuredWebsite'] = $this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['featuredWebsite']['user_permission'] = fileCache(getUserSlug("_permission"), " ", "get")['solution'];

		//BUY PREMIUM SHOPIFY STORES & DROPSHIP WEBSITES FOR SALE
		$pageName = PAGESNAME_SECTION["dropshipping-websites-premium"];
		$data['premiumWebsites'] =	$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['premiumWebsites']['user_permission'] = fileCache(getUserSlug("_permission"), " ", "get")['solution'];

		//BUY LATEST SHOPIFY STORES & DROPSHIP WEBSITES FOR SALE
		$pageName = PAGESNAME_SECTION["dropshipping-websites-latest"];
		$data['latestWebsites']	= $this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['latestWebsites']['user_permission'] 	= fileCache(getUserSlug("_permission"), " ", "get")['solution'];

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('dropshippingWebsites_site_title');
		$data['site_metadescription'] 	= $this->lang->line('dropshippingWebsites_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('dropshippingWebsites_site_keywords');
		$data['canonical']              = $this->lang->line('dropshippingWebsites_canonical');
		$data['og_type']                = $this->lang->line('dropshippingWebsites_og_type');
		$data['og_title']               = $this->lang->line('dropshippingWebsites_og_title');
		$data['og_description']         = $this->lang->line('dropshippingWebsites_og_description');
		$data['og_url']                 = $this->lang->line('dropshippingWebsites_og_url');
		$data['og_site_name']           = $this->lang->line('dropshippingWebsites_og_site_name');
		$data['twitter_description']    = $this->lang->line('dropshippingWebsites_site_name');
		$data['twitter_title']          = $this->lang->line('dropshippingWebsites_twitter_description');


		$this->loadPage('dropshipping_websites', $data);
	}
	public function shopifyStoresForSale($page = 0)
	{
		$data = self::$data;
		$data['sponsoredAds']		= 	$this->database->_get_specific_listing();
		$data['slider_name']		= 	'featured-slider';
		$data['endingSoon']			=   $this->database->_get_auction_ending_soon('', 'app');
		$data['domainlist']			=   $this->partition($this->database->_get_row_data('tbl_listings', array('listing_type' => 'domain', 'status' => 1), 30, '', true), 3);

		$data['featuredPosts']		= 	$this->database->_fetch_blog_posts(RESULTS_PER_BLOG, 0, false, 'views');

		$data = self::$data;

		$perPage =  SECTION_WISE;
		$page = $this->input->get('page') ?? 1;
		$searchterm = $this->input->get('search') ?? "";

		// Buy Featured Premium Shopify Dropship Stores & Ecommerce Websites for sale
		$pageName = PAGESNAME_SECTION["shopify-stores-for-sale-feature"];
		$data['featuredWebsite']	=	$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['featuredWebsite']['user_permission'] = fileCache(getUserSlug("_permission"), " ", "get")['solution'];


		//BUY PREMIUM SHOPIFY STORES & DROPSHIP WEBSITES FOR SALE
		$pageName = PAGESNAME_SECTION["shopify-stores-for-sale-premium"];
		$data['premiumWebsites']	=	$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['premiumWebsites']['user_permission'] = fileCache(getUserSlug("_permission"), " ", "get")['solution'];

		//BUY LATEST SHOPIFY STORES & DROPSHIP WEBSITES FOR SALE
		$pageName = PAGESNAME_SECTION["shopify-stores-for-sale-latest"];
		$data['latestWebsites']	=		$this->database->front_solution_listings($perPage, $page, $searchterm, $pageName, '');
		$data['latestWebsites']['user_permission'] = fileCache(getUserSlug("_permission"), " ", "get")['solution'];


		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('shopifyStoresForSale_site_title');
		$data['site_metadescription'] 	= $this->lang->line('shopifyStoresForSale_site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('shopifyStoresForSale_site_keywords');
		$data['canonical']              = $this->lang->line('shopifyStoresForSale_canonical');
		$data['og_type']                = $this->lang->line('shopifyStoresForSale_og_type');
		$data['og_title']               = $this->lang->line('shopifyStoresForSale_og_title');
		$data['og_description']         = $this->lang->line('shopifyStoresForSale_og_description');
		$data['og_url']                 = $this->lang->line('shopifyStoresForSale_og_url');
		$data['og_site_name']           = $this->lang->line('shopifyStoresForSale_og_site_name');
		$data['twitter_description']    = $this->lang->line('shopifyStoresForSale_site_name');
		$data['twitter_title']          = $this->lang->line('shopifyStoresForSale_twitter_description');


		$this->loadPage('shopify-stores-for-sale', $data);
	}

	public function specialCourses($page = 0)
	{
		$data = self::$data;

		$table          		=   'tbl_course';
		$url           			=   'course';
		$perPage        		=  	COURSE_PERPAGE_COUNT;
		$page	        		=  	$this->input->get('page') ?? 1;
		$condition				=   ['t1.course_type' => array_search('Special', COURSE_TYPE)];

		$data['records'] 		= 	$this->database->_get_courses('', $perPage, $page, $condition);
		$data['links']          =   $this->pagination_loader($url, $table, $perPage,  $sort = "", $condition);

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');

		$this->loadPage('special_courses', $data);
	}
	public function standardCourses($page = 0)
	{


		$data = self::$data;

		$table          		=   'tbl_course';
		$url           			=   'course';
		$perPage        		=  	COURSE_PERPAGE_COUNT;
		$page	        		=  	$this->input->get('page') ?? 1;
		$condition				=   ['t1.course_type' => array_search('Standard', COURSE_TYPE)];
		$data['records'] 		= 	$this->database->_get_courses('', $perPage, $page, $condition);
		$data['links']          =   $this->pagination_loader($url, $table, $perPage,  $sort = "", $condition);
		// pre($data['records'],1);
		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');


		$this->loadPage('standard_courses', $data);
	}

	public function howToStartDropshopping()
	{

		$data = self::$data;

		$data['site_name'] 				= $this->lang->line('site_name');
		$data['site_title'] 			= $this->lang->line('site_title');
		$data['site_metadescription'] 	= $this->lang->line('site_metadescription');
		$data['site_keywords'] 			= $this->lang->line('site_keywords');
		$data['canonical']              = $this->lang->line('canonical');
		$data['og_type']                = $this->lang->line('og_type');
		$data['og_title']               = $this->lang->line('og_title');
		$data['og_description']         = $this->lang->line('og_description');
		$data['og_url']                 = $this->lang->line('og_url');
		$data['og_site_name']           = $this->lang->line('og_site_name');
		$data['twitter_description']    = $this->lang->line('site_name');
		$data['twitter_title']          = $this->lang->line('twitter_description');


		$this->loadPage('how-to-start-drop-shipping', $data);
	}



	public function expertDirectory($pageNo = 0)
	{
		$data 							= self::$data;
		$page                           = !empty($pageNo) ? $pageNo : 1;
		$condition					    =  ['admin_approved' => 1];
		$data['experts']                = $this->database->getExpertById('all', PERPAGE9, $page, '', $condition);
		$data["links"]                  = $this->expertDirectory_loader($page, $condition);
		$data['permission']   			= fileCache(getUserSlug("_permission"), " ", "get");
		$data['site_title'] 		    = $this->lang->line('site_expert_directory');

		$this->loadPage('expert-directory', $data);
	}

	/*expert list pagination creator*/
	public function expertDirectory_loader($count = '', $condition = '')
	{

		$config = array();
		$config["base_url"]                     = site_url('expert-directory');
		$config["total_rows"]                   = $this->database->_results_count('tbl_expert_directory', $condition, $count = true);
		//pre($config["total_rows"],1 );
		$config["per_page"]                     = PERPAGE9;
		$config['use_page_numbers']             = TRUE;

		$config['num_tag_open']                 = '<li class="ripple-effect">';
		$config['num_tag_close']                = '</li>';
		$config['cur_tag_open']                 = '<li><a class="ripple-effect current-page">';
		$config['cur_tag_close']                = '</a></li>';
		$config['prev_tag_open']                = '<li class="pagination-arrow">';
		$config['prev_tag_close']               = '</li>';
		$config['first_tag_open']               = '<li class="ripple-effect">';
		$config['first_tag_close']              = '</li>';
		$config['last_tag_open']                = '<li class="ripple-effect">';
		$config['last_tag_close']               = '</li>';

		$config['prev_link']                    = '<i class=" mdi mdi-chevron-left"></i>';
		$config['prev_tag_open']                = '<li class="pagination-arrow">';
		$config['prev_tag_close']               = '</li>';


		$config['next_link']                    = '<i class=" mdi mdi-chevron-right"></i>';
		$config['next_tag_open']                = '<li class="pagination-arrow">';
		$config['next_tag_close']               = '</li>';

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	public function aboutExpert($slug)
	{
		$data = self::$data;

		$data['expert']               	= $this->database->getExpertBySlug($slug);
		$data['permission']   			= fileCache(getUserSlug("_permission"), " ", "get");

		if (empty($data['expert'])) {
			redirect('expert-directory');
		}
		$this->loadPage('expert_user', $data);
	}
	public function user_accessed_pages()
	{
		$data = array(
			'currentOpenedPageHidden' => $this->input->post('currentOpenedPageHidden')
		);

		$data = $this->security->xss_clean($data);

		if (trim($data['currentOpenedPageHidden']) != '') {
			$insertArr = array();
			$userPages = explode(",", $data['currentOpenedPageHidden']);


			if (count($userPages) > 0) {
				$getTagsAsPerPages = $this->database->getTagsAsPerPages($userPages, 'tbl_pages_tags');

				$ip = $this->input->ip_address();
				if (!$this->session->userdata('user_id')) {
					$user_id = 0;
				} else {
					$user_id = $this->session->userdata('user_id');
				}

				//First Step: for all static pages
				foreach ($getTagsAsPerPages as $key => $value) {

					if (isset($value['page']) && isset($value['tags'])) {
						$insertArr[] = array(
							'user_id' => $user_id,
							'user_ip'     => $ip,
							'page'        => site_url($value['page']),
							'tags'        => $value['tags']
						);

						//in one array we have static pages, solution detail, listing detail, course detail and blog detail page URLs, after after processing "Admin > page tags" URL, we are removing one by one so that we can left with those URL and then we can process those
						if (($key = array_search($value['page'], $userPages)) !== false) {
							unset($userPages[$key]);
						}
					}
				}

				//Next all steps for detail pages like course detail, blog detail, solution detail and listing detail pages

				//second step: for solution
				if (count($userPages) > 0) {
					$userPages = $this->makeTempArrayForEmail($userPages, "solution-details/");

					if (count($userPages) > 0) {
						$userPages = $this->makeTempArrayForEmail($userPages, "product/");
					}
					if (count($userPages) > 0) {
						$getTagsAsPerPages = $this->database->getTagsAsPerPages($userPages, 'tbl_solutions');

						foreach ($getTagsAsPerPages as $key => $value) {

							if (isset($value['slug']) && isset($value['page_tags'])) {
								$insertArr[] = array(
									'user_id' => $user_id,
									'user_ip' => $ip,
									'page'    => site_url('product/' . $value['slug']),
									'tags'    => $value['page_tags']
								);

								//in one array we have static pages, solution detail, listing detail, course detail and blog detail page URLs, after after processing "Admin > page tags" URL, we are removing one by one so that we can left with those URL and then we can process those
								if (($key = array_search($value['slug'], $userPages)) !== false) {
									unset($userPages[$key]);
								}
							}
						}
					}
				}

				//Third Step: For Course detail Page
				if (count($userPages) > 0) {
					$userPages = $this->makeTempArrayForEmail($userPages, "course-detail/");
					if (count($userPages) > 0) {
						$getTagsAsPerPages = $this->database->getTagsAsPerPages($userPages, 'tbl_course');
						foreach ($getTagsAsPerPages as $key => $value) {

							if (isset($value['slug']) && isset($value['page_tags'])) {
								$insertArr[] = array(
									'user_id' => $user_id,
									'user_ip' => $ip,
									'page'    => site_url('course-detail/' . $value['slug']),
									'tags'    => $value['page_tags']
								);

								//in one array we have static pages, solution detail, listing detail, course detail and blog detail page URLs, after after processing "Admin > page tags" URL, we are removing one by one so that we can left with those URL and then we can process those
								if (($key = array_search($value['slug'], $userPages)) !== false) {
									unset($userPages[$key]);
								}
							}
						}
					}
				}

				//Fourth Step: Blog Detail Page

				if (count($userPages) > 0) {
					$userPages = $this->makeTempArrayForEmail($userPages, "blog_post/");
					if (count($userPages) > 0) {
						$getTagsAsPerPages = $this->database->getTagsAsPerPages($userPages, 'tbl_blog');
						foreach ($getTagsAsPerPages as $key => $value) {

							if (isset($value['slug']) && isset($value['blog_tags'])) {
								$insertArr[] = array(
									'user_id' => $user_id,
									'user_ip' => $ip,
									'page'    => site_url('blog_post/' . $value['slug']),
									'tags'    => $value['blog_tags']
								);

								//in one array we have static pages, solution detail, listing detail, course detail and blog detail page URLs, after after processing "Admin > page tags" URL, we are removing one by one so that we can left with those URL and then we can process those
								if (($key = array_search($value['slug'], $userPages)) !== false) {
									unset($userPages[$key]);
								}
							}
						}
					}
				}

				//Fifth Step: For listing
				if (count($userPages) > 0) {
					$userPages = $this->makeTempArrayForEmail($userPages, "classified/domain/");

					if (count($userPages) > 0) {
						$getTagsAsPerPages = $this->database->getTagsAsPerPages($userPages, 'tbl_listings', 'domain');
						foreach ($getTagsAsPerPages as $key => $value) {

							if (isset($value['slug']) && isset($value['page_tags'])) {
								$insertArr[] = array(
									'user_id' => $user_id,
									'user_ip' => $ip,
									'page'    => site_url('classified/' . $value['listing_type'] . '/' . $value['slug']),
									'tags'    => $value['page_tags']
								);

								//in one array we have static pages, solution detail, listing detail, course detail and blog detail page URLs, after after processing "Admin > page tags" URL, we are removing one by one so that we can left with those URL and then we can process those
								if (($key = array_search($value['slug'], $userPages)) !== false) {
									unset($userPages[$key]);
								}
							}
						}
					}
				}

				if (count($userPages) > 0) {
					$userPages = $this->makeTempArrayForEmail($userPages, "classified/app/");
					if (count($userPages) > 0) {
						$getTagsAsPerPages = $this->database->getTagsAsPerPages($userPages, 'tbl_listings', 'app');
						foreach ($getTagsAsPerPages as $key => $value) {

							if (isset($value['slug']) && isset($value['page_tags'])) {
								$insertArr[] = array(
									'user_id' => $user_id,
									'user_ip' => $ip,
									'page'    => site_url('classified/' . $value['listing_type'] . '/' . $value['slug']),
									'tags'    => $value['page_tags']
								);

								//in one array we have static pages, solution detail, listing detail, course detail and blog detail page URLs, after after processing "Admin > page tags" URL, we are removing one by one so that we can left with those URL and then we can process those
								if (($key = array_search($value['slug'], $userPages)) !== false) {
									unset($userPages[$key]);
								}
							}
						}
					}
				}

				if (count($userPages) > 0) {
					$userPages = $this->makeTempArrayForEmail($userPages, "classified/business/");
					if (count($userPages) > 0) {
						$getTagsAsPerPages = $this->database->getTagsAsPerPages($userPages, 'tbl_listings', 'business');
						foreach ($getTagsAsPerPages as $key => $value) {

							if (isset($value['slug']) && isset($value['page_tags'])) {
								$insertArr[] = array(
									'user_id' => $user_id,
									'user_ip' => $ip,
									'page'    => site_url('classified/' . $value['listing_type'] . '/' . $value['slug']),
									'tags'    => $value['page_tags']
								);

								//in one array we have static pages, solution detail, listing detail, course detail and blog detail page URLs, after after processing "Admin > page tags" URL, we are removing one by one so that we can left with those URL and then we can process those
								if (($key = array_search($value['slug'], $userPages)) !== false) {
									unset($userPages[$key]);
								}
							}
						}
					}
				}

				if (count($userPages) > 0) {
					$userPages = $this->makeTempArrayForEmail($userPages, "classified/website/");
					if (count($userPages) > 0) {
						$getTagsAsPerPages = $this->database->getTagsAsPerPages($userPages, 'tbl_listings', 'website');
						foreach ($getTagsAsPerPages as $key => $value) {

							if (isset($value['slug']) && isset($value['page_tags'])) {
								$insertArr[] = array(
									'user_id' => $user_id,
									'user_ip' => $ip,
									'page'    => site_url('classified/' . $value['listing_type'] . '/' . $value['slug']),
									'tags'    => $value['page_tags']
								);

								//in one array we have static pages, solution detail, listing detail, course detail and blog detail page URLs, after after processing "Admin > page tags" URL, we are removing one by one so that we can left with those URL and then we can process those
								if (($key = array_search($value['slug'], $userPages)) !== false) {
									unset($userPages[$key]);
								}
							}
						}
					}
				}
			}

			if (count($insertArr) > 0) {
				$this->db->insert_batch('tbl_user_surfing_pages', $insertArr);
			}
		}

		$data['token'] 		= $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode($data));
	}

	function makeTempArrayForEmail($arr, $removeWord)
	{
		$userPages = array();

		foreach ($arr as $key => $value) {
			$newWord = str_replace($removeWord, "", $value);

			if ($removeWord == "classified/domain/" || $removeWord == "classified/app/" || $removeWord == "classified/business/" || $removeWord == "classified/website/") {
				if ($newWord != $value) {
					// it identifies that it is URL for specific type like domain, app etc so put in array
					$userPages[] = $newWord;
				}
			} else {
				$userPages[] = $newWord;
			}
		}
		return $userPages;
	}
}
