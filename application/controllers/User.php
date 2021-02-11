<?php
defined('BASEPATH') or exit('No direct script access allowed');

ini_set('max_execution_time', '0'); // for infinite time of execution 

class user extends CI_Controller
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
		$this->common->is_logged();

		/*Load Defaults*/
		self::$data['settings'] 						= 	$this->database->getSettingsData();
		self::$data['platforms']                        =   $this->database->_get_row_data('tbl_platforms', array('type' => 'listing', 'status' => 1));
		self::$data['options']                        	=   $this->database->_get_row_data('tbl_platforms', array('type' => 'option', 'status' => 1, 'platform' => 'classified'));
		self::$data['languages']						=	$this->database->load_all_languages();
		self::$data['default_currency']					=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies', array('default_status' => '1'), 'currency'), 'symbol');
		self::$data['userdata'] 						= 	$this->database->getUserData($this->session->userdata('user_id'));
		self::$data['selectedLanguage'] 				= 	$this->common->is_language();
		self::$data['language'] 						= 	$this->database->_get_single_data('tbl_languages', array('default_status' => 1), 'language_code');
		self::$data['openContracts']					= 	$this->database->_get_my_contracts();
		self::$data['closeContracts']					= 	$this->database->_get_my_contracts(false);
		self::$data['listingCount']						= 	$this->database->_count_listings_user_wise('auction');
		self::$data['listingOfferCount']				= 	$this->database->_count_listings_user_wise('classified');
		//pre(self::$data['listingOfferCount'],1);
		self::$data['listingSolutionCount']				= 	$this->database->_count_solution_listings_user_wise();
		//pre(self::$data['listingSolutionCount']);
		self::$data['messageCount']						= 	$this->chat->get_unviewed_msg($this->session->userdata('user_id'));
		//echo "start count---------";
		//echo (self::$data['messageCount']);
		//echo "----------end count";
		self::$data['categoriesData']					=	$this->database->_count_listings_categories_wise();
		self::$data['announcements']                    =   $this->database->_get_row_data('tbl_announcement', array('status' => 1));
		self::$data['pages']                    		=   $this->database->_get_row_data('tbl_pages', array('page_visibility_status' => 1));
		self::$data['imagesData']						=	$this->database->_get_row_data('tbl_siteimages', array('id' => 1));
		self::$data['payments']                     	=   $this->database->_get_row_data('tbl_payment_settings', array('status' => 1));
		self::$data['ads']                				=   $this->database->_get_row_data('tbl_ads', array('id' => 1));
		self::$data['token'] 							= 	$this->security->get_csrf_hash();


		if (self::$data['settings'][0]['ssl_enable'] === '1') {
			force_ssl();
		}
	}

	/*User Dashboard*/
	public function dashboard()
	{
		$data 				= self::$data;
		$data['contracts'] 	= $this->database->_get_recent_contract(true, false, false);
		$data['TE'] 		= $this->database->_user_total_earnings($this->session->userdata('user_id'));
		$data['TL1']			= $this->database->_results_count('tbl_listings', array('status' => 1, 'user_id' => $this->session->userdata('user_id')), true);
		$data['TL2']			= $this->database->_results_count('tbl_solutions', array('status' => 1, 'user_id' => $this->session->userdata('user_id')), true);
		$data['TL'] = $data['TL1'] + $data['TL2'];
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/dashboard', $data);
		return;
	}

	/*Alexa Rank*/
	public function alexaRank($url)
	{
		return $this->common->alexaRank($url);
	}

	/*Manage Bidders Page*/
	public function manage_bidders($type, $id)
	{
		$data = self::$data;
		if (!empty($id)) {
			$data['listing_data']						=	$this->database->_get_row_data('tbl_listings', array('id' => $id, 'listing_type' => $type, 'user_id' => $this->session->userdata('user_id')), '', true);
			if (!empty($data['listing_data'][0]['domain_id']) || $type === 'app') {
				$data['domainData']						=	$this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
				$data['listingType']					= 	$type;
				$data['bids']							= 	$this->database->_get_bidders($id);
				$data = html_escape($this->security->xss_clean($data));
				$this->load->view('user/manage-bidders', $data);
				return;
			}
		}

		$this->pageNotFound();
	}

	/*Manage Bids Page*/
	public function manage_bids($type, $id)
	{
		$data = self::$data;
		if (!empty($id)) {
			$this->_update_winning_auction($id, $type);
			$data['AuctionEndingDate']					=	$this->database->_get_auction_ending_date($id);
			$data['websitelistings'] 					= 	$this->_userwise__listings($this->session->userdata('user_id'), 'auction', true, false, $id);
			$data['nofdaysleft']						=	$this->common->DateDiffCalculate($data['AuctionEndingDate'][0]['ENDDATE']);
			$data['auctionstatus']						= 	'invalid';
			if ($data['nofdaysleft']['days'] >= 0 && $data['nofdaysleft']['hours'] >= 0) {
				$data['auctionstatus']					= 	'valid';
			}

			$data['listing_data']						=	$this->database->_get_row_data('tbl_listings', array('id' => $id, 'listing_type' => $type, 'user_id' => $this->session->userdata('user_id')), '', true);
			if (!empty($data['listing_data'][0]['domain_id']) || $type === 'app') {
				$data['domainData']						=	$this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
				$data['listingType']					= 	$type;
				$data['bids']							= 	$this->database->_get_all_bids($id, '1', $type, "tbl_bids.bid_amount", "desc", "1");
				$data = html_escape($this->security->xss_clean($data));
				$this->load->view('user/manage-bids', $data);
				return;
			}
		}
		$this->pageNotFound();
	}

	/*Manage Offers Page*/
	public function manage_offer($type, $id)
	{

		$data = self::$data;
		if (!empty($id)) {
			$this->_update_winning_auction($id, $type);
			$data['websitelistings'] 					= 	$this->_userwise__listings($this->session->userdata('user_id'), 'classified', true, false, $id);
			$data['listing_data']						= 	$this->database->_get_row_data('tbl_listings', array('id' => $id, 'listing_type' => $type, 'user_id' => $this->session->userdata('user_id')), true);
			if (!empty($data['listing_data'][0]['domain_id']) || $type === 'app') {
				$data['domainData']						=	$this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
				$data['listingType']					= 	$type;
				$data['bids']							= 	$this->database->_get_all_offers($id, '0', $type, "tbl_offers.offer_amount", "desc", "1");
				$data = html_escape($this->security->xss_clean($data));
				$this->load->view('user/manage-offers', $data);
				return;
			}
		}
		$this->pageNotFound();
	}

	/*Manage Listings Page*/
	public function manage_listings()
	{
		$data = self::$data;
		$data['websitelistings'] 				= 	$this->_userwise__listings($this->session->userdata('user_id'), 'auction', '');
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/manage-listings', $data);
	}

	/*Manage Listings Page*/
	public function manage_offers()
	{
		$data = self::$data;
		$websitelistings 				= 	$this->_userwise__listings($this->session->userdata('user_id'), 'classified', '');
		//pre($_SESSION);
		//pre($this->session->userdata('user_id'));
		// pre($websitelistings,1);

		if (!empty($websitelistings)) {
			rsort($websitelistings);
		}
		$data['websitelistings'] 	 = $websitelistings;
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/manage-classified-listings', $data);
	}

	public function manage_solutions()
	{
		$data = self::$data;
		$page                          = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
		$data['solutionListing']	   = $this->database->_userwise_solution_listings($this->session->userdata('user_id'), PERPAGE, $page);

		$data["links"]				   = 	$this->solutions_pagination_loader();
		$this->load->view('user/manage-solution-listings', $data);
	}

	public function search_solutions()
	{

		$data = self::$data;
		$page                          = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
		$search                        = $this->input->post('search') ?? '';
		if (empty($search)) {
			$perpage = PERPAGE;
		} else {
			$perpage = '';
		}
		$data['solutionListing']       = $this->database->_userwise_solution_listings($this->session->userdata('user_id'), $perpage, $page, $search);

		if (empty($search)) {
			$data["links"]             =     $this->solutions_pagination_loader();
		}

		$response                     = $this->load->view('user/manage-solution-listings-ajax', $data, TRUE);
		$data['response']             = $response;

		$data['token']         		  = $this->security->get_csrf_hash();
		echo json_encode($data);
		exit;
	}
	/*
	 Images */
	public function upload__image($nameBox, $path = IMAGES_UPLOAD)
	{
		$this->load->library("upload");
		$this->load->helper("file");
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
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

	/*Upload Files */
	public function upload__files($nameBox)
	{
		$this->load->library("upload");
		$this->load->helper("file");
		$config['upload_path'] = FILES_UPLOAD;
		$config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
		$config['max_size'] = 104857600;
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

	public function editUploadImage()
	{
		if (!empty($_FILES['file']['name'])) {
			if ($this->security->xss_clean($_FILES['file']['name'], TRUE) === TRUE) {
				$thumbnail = $this->upload__image('file');
				//$response['token']  	= $this->security->get_csrf_hash();
				$response 	= site_url(IMAGES_UPLOAD . $thumbnail);
				//$response = html_escape($this->security->xss_clean($response));
				//header('Content-Type: application/json');
				exit($response);
			}
		}
	}



	/*Create Website Listings Page*/
	public function create_listings()
	{
		$data = self::$data;
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/create-listings', $data);
		return;
	}

	/*Create Website Listings Page*/
	public function create__listings($type, $id = "")
	{

		if (!empty($type) && $type === 'website') {
			$data = self::$data;

			$data['listingOptions']						=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => $type));
			$data['sponsorOptions']						=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => 'sponsored'));
			if (!empty($id)) {
				$data['listing_data']					=	$this->database->_get_row_data('tbl_listings', array('id' => $id, 'listing_type' => $type, 'status' => 0, 'user_id' => $this->session->userdata('user_id')), '', false);
				if (!empty($data['listing_data'])) {
					$data['domainData']					=	$this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
				} else {
					redirect(base_url() . 'user/manage_listings');
					return;
				}
				$data['domainStatics']					=	$this->AnalyticsOperationsHandler->getUsersAndPageViews($id);
			}



			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('user/create-website-listings', $data);
			return;
		} else if (!empty($type) && $type === 'domain') {
			$data = self::$data;
			$data['listingOptions']						=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => $type));
			$data['sponsorOptions']						=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => 'sponsored'));
			if (!empty($id)) {
				$data['listing_data']					=	$this->database->_get_row_data('tbl_listings', array('id' => $id, 'listing_type' => $type, 'status' => 0, 'user_id' => $this->session->userdata('user_id')), '', false);
				if (!empty($data['listing_data'])) {
					$data['domainData']					=	$this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
				} else {
					redirect(base_url() . 'user/manage_listings');
					return;
				}
			}
			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('user/create-domain-listings', $data);
			return;
		} else if (!empty($type) && $type === 'app') {
			$data = self::$data;
			$data['listingOptions']						=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => $type));
			$data['sponsorOptions']						=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => 'sponsored'));
			if (!empty($id)) {
				$data['listing_data']					=	$this->database->_get_row_data('tbl_listings', array('id' => $id, 'listing_type' => $type, 'status' => 0, 'user_id' => $this->session->userdata('user_id')), '', false);
				if (!empty($data['listing_data'])) {
					$data['domainData']					=	$this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
				} else {
					redirect(base_url() . 'user/manage_listings');
					return;
				}
			}

			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('user/create-app-listings', $data);
			return;
		} else if (!empty($type) && $type === 'business') {

			$data = self::$data;
			$data['listingOptions']						=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => $type));
			$data['sponsorOptions']						=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => 'sponsored'));
			if (!empty($id)) {
				$data['listing_data']					=	$this->database->_get_row_data('tbl_listings', array('id' => $id, 'listing_type' => $type, 'status' => 0, 'user_id' => $this->session->userdata('user_id')), '', false);
				if (!empty($data['listing_data'])) {
					$data['domainData']					=	$this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
				} else {
					redirect(base_url() . 'user/manage_listings');
					return;
				}
			}

			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('user/create-business-listings', $data);
			return;
		}

		$this->pageNotFound();
	}

	/*User Profile Settings*/
	public function user_settings()
	{
		$data = self::$data;
		$data['metaData']						=	$this->database->getSettingsData();
		$data['withdraw_meths'] 				=  	$this->database->_get_row_data('tbl_withdrawal_methods', array('status' => 1));
		$data['reviewRatings'] 					= 	$this->database->get_reviews($this->session->userdata('user_id'), $this->session->userdata('user_id'));
		$data['profileid'] 						= 	$this->session->userdata('user_id');
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/user-settings', $data);
	}

	/*Change Password*/
	public function change_password()
	{
		$data = self::$data;
		$data['metaData']						=	$this->database->getSettingsData();
		$data['profileid'] 						= 	$this->session->userdata('user_id');
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/change-password', $data);
	}

	/*Edit Listings Page*/
	public function edit_listings($type, $id)
	{
		$data = self::$data;
		if (!empty($type) && !empty($id) && $type == 'website') {

			$data['listing_data']					=	$this->database->_get_row_data('tbl_listings', array('id' => $id, 'status' => 1, 'user_id' => $this->session->userdata('user_id')), '', true);
			if (!empty($data['listing_data'][0]['domain_id'])) {
				$data['domainData']					=	$this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
				$data['domainStatics']				=	$this->AnalyticsOperationsHandler->getUsersAndPageViews($id);
				$data['selectedLanguage'] 			= 	$this->common->is_language();

				if (!DECODE_DESCRIPTIONS) {
					$data = html_escape($this->security->xss_clean($data));
				} else {
					$data = $this->security->xss_clean($data);
				}

				$this->load->view('user/edit-listings', $data);
				return;
			}
		} else if (!empty($type) && !empty($id) && $type == 'domain') {
			$data = self::$data;
			$data['listing_data']					=	$this->database->_get_row_data('tbl_listings', array('id' => $id, 'status' => 1, 'user_id' => $this->session->userdata('user_id')), '', true);
			if (!empty($data['listing_data'][0]['domain_id'])) {
				$data['domainData']					=	$this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
				$data['selectedLanguage'] 			= 	$this->common->is_language();

				if (!DECODE_DESCRIPTIONS) {
					$data = html_escape($this->security->xss_clean($data));
				} else {
					$data = $this->security->xss_clean($data);
				}

				$this->load->view('user/edit-domain-listings', $data);
				return;
			}
		} else if (!empty($type) && !empty($id) && $type == 'app') {
			$data = self::$data;
			$data['listing_data']					=	$this->database->_get_row_data('tbl_listings', array('id' => $id, 'status' => 1, 'user_id' => $this->session->userdata('user_id')), '', true);
			if (!empty($data['listing_data'][0]['website_BusinessName'])) {
				$data['selectedLanguage'] 			= 	$this->common->is_language();

				if (!DECODE_DESCRIPTIONS) {
					$data = html_escape($this->security->xss_clean($data));
				} else {
					$data = $this->security->xss_clean($data);
				}

				$this->load->view('user/edit-app-listings', $data);
				return;
			}
		} else if (!empty($type) && !empty($id) && $type == 'business') {
			$data = self::$data;
			$data['listing_data']					=	$this->database->_get_row_data('tbl_listings', array('id' => $id, 'status' => 1, 'user_id' => $this->session->userdata('user_id')), '', true);
			if (!empty($data['listing_data'][0]['domain_id'])) {
				$data['domainData']					=	$this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
				$data['domainStatics']				=	$this->AnalyticsOperationsHandler->getUsersAndPageViews($id);
				$data['selectedLanguage'] 			= 	$this->common->is_language();

				if (!DECODE_DESCRIPTIONS) {
					$data = html_escape($this->security->xss_clean($data));
				} else {
					$data = $this->security->xss_clean($data);
				}

				$this->load->view('user/edit-business-listings', $data);
				return;
			}
		}

		$this->pageNotFound();
	}

	/*Userwise Pending Offers*/
	public function pending_offers()
	{
		$data = self::$data;
		$data['groupedOffers'] 					=  	$this->database->_userwise_offers($this->session->userdata('user_id'), 'group');
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/pending-offers', $data);
		return;
	}

	/*Userwise View Offers*/
	public function view_offers($id)
	{
		$data = self::$data;
		if (!empty($id)) {
			$data['Offers'] 					=  	$this->database->_get_userwise_offers($id, $this->session->userdata('user_id'), 'group');
			if (!empty($data['Offers'])) {
				$data = html_escape($this->security->xss_clean($data));
				$this->load->view('user/view-offers', $data);
				return;
			}
		}
		$this->pageNotFound();
	}

	/*Userwise Pending Bids*/
	public function pending_bids()
	{
		$data = self::$data;
		$data['groupedOffers'] 					=  	$this->database->_userwise_bids($this->session->userdata('user_id'), 'group');
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/pending-bids', $data);
		return;
	}

	/*Userwise View Bids*/
	public function view_bids($id)
	{
		$data = self::$data;
		if (!empty($id)) {
			$data['bids'] 						=  	$this->database->_get_userwise_bids($id, $this->session->userdata('user_id'), 'group');
			if (!empty($data['bids'])) {
				$data = html_escape($this->security->xss_clean($data));
				$this->load->view('user/view-bids', $data);
				return;
			}
		}
		$this->pageNotFound();
	}

	/*withdrawals list pagination creator*/
	public function withdrawals_pagination_loader()
	{

		$config = array();
		$config["base_url"] 					= '#';
		$config["total_rows"] 					= $this->database->_results_count('tbl_withdrawals', array('user_id' => $this->session->userdata('user_id')), true);
		$config["per_page"] 					= 5;
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

	/*Withdrawals*/
	public function withdrawals()
	{
		$data = self::$data;
		$data['withdraw_meths'] 				=  	$this->database->_get_row_data('tbl_withdrawal_methods', array('status' => 1));
		$data['TE'] 							= 	$this->database->_user_total_earnings($this->session->userdata('user_id'));
		$data['FC'] 							= 	$this->database->_user_withdrawals($this->session->userdata('user_id'));
		$data['PE'] 							= 	$this->database->_user_pending_earnings($this->session->userdata('user_id'));
		$data['AW'] 							= 	$this->database->_user_availableto_withdraw($this->session->userdata('user_id'));
		$data['withdrawals'] 					=	$this->database->_get_withdrawals($this->session->userdata('user_id'));
		$data['currency'] 						=	$this->database->_get_single_data('tbl_currencies', array('default_status' => '1'), 'currency');
		$data = html_escape($this->security->xss_clean($data));
		$data["links"]							= 	$this->withdrawals_pagination_loader();
		$this->load->view('user/withdrawals', $data);
		return;
	}

	/*user withdrawals list*/
	public function user_withdrawals($page = 0)
	{
		$output['token']       = $this->security->get_csrf_hash();
		header('Content-Type: application/json');

		$data['withdrawals'] 					=	$this->database->_get_withdrawals($this->session->userdata('user_id'), '', 5, $page);
		$data = html_escape($this->security->xss_clean($data));
		$data["links"]							= 	$this->withdrawals_pagination_loader();
		$response 								= 	$this->load->view('user/includes/user_withdrawals', $data, TRUE);
		$output['response']         			= 	$response;
		exit(json_encode($output));
	}

	/*Update offer status*/
	public function update_offer_status($value)
	{
		$output['token']       = $this->security->get_csrf_hash();
		header('Content-Type: application/json');

		if (!empty($value)) {
			$output['response'] 	= $this->database->_update_to_DB('tbl_offers', array('offer_status' => '3'), $value);
			exit(json_encode($output));
		}

		$output['response'] 		= false;
		exit(json_encode($output));
	}

	/*Get Comments*/
	public function get_comments()
	{
		$response['token']  	= $this->security->get_csrf_hash();
		$response['response']  	= $this->database->_get_comments($this->input->post('listing_id'), $this->input->post('type'));
		$response = html_escape($this->security->xss_clean($response));
		header('Content-Type: application/json');
		exit(json_encode($response));
	}

	/*Change User Password*/
	public function changePasswordUpdate()
	{
		$data = array(
			'password' => md5(trim($this->input->post('txt_user_password')))
		);
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
		if ($this->form_validation->run()) {
			exit($this->database->_update_to_table('tbl_users', $data, array('user_id' => $this->input->post('txt_user_id'))));
		}
		exit('false');
	}

	/*accept Bidder*/
	public function accept_bidder()
	{
		$output['token']       = $this->security->get_csrf_hash();
		header('Content-Type: application/json');

		$datas = self::$data;
		$data = array(
			'bid_status' => 1,
		);

		if ($datas['settings'][0]['email_notifications'] === '1') {
			$dataemail	= array(
				'bid_status' => 1,
				'id' => $this->input->post('o_bid_id')
			);
			$this->email_op->_user_email_notification('accept-bidder', $dataemail);
		}

		$output['response'] 	= $this->database->_update_to_DB('tbl_bids', $data, $this->input->post('o_bid_id'));
		exit(json_encode($output));
	}

	/*remove listing */
	public function remove_listing($id)
	{
		$data = array(
			'status' => 6,
		);
		if ($this->database->_update_to_DB('tbl_listings', $data, $id)) {
			redirect($this->session->userdata('url'));
		}
	}

	/*reject bid */
	public function reject_bid($id)
	{
		$datas = self::$data;
		$data = array(
			'bid_status' => 2,
		);

		if ($datas['settings'][0]['email_notifications'] === '1') {
			$dataemail	= array(
				'bid_status' => 2,
				'id' => $id
			);
			$this->email_op->_user_email_notification('reject-bid', $dataemail);
		}

		if ($this->database->_update_to_DB('tbl_bids', $data, $id)) {
			redirect($this->session->userdata('url'));
		}
	}

	/*remove bid */
	public function remove_offer($id)
	{
		$datas = self::$data;
		$data = array(
			'offer_status' => 1,
		);

		if ($datas['settings'][0]['email_notifications'] === '1') {
			$dataemail	= array(
				'offer_status' => 1,
				'id' => $id
			);
			$this->email_op->_user_email_notification('reject-offer', $dataemail);
		}

		if ($this->database->_update_to_DB('tbl_offers', $data, $id)) {
			redirect($this->session->userdata('url'));
		}
	}

	/*add notification*/
	public function add_notification()
	{
		$user 			= $this->session->userdata('user_id');
		$subject 		= $this->input->post('subject');
		$notification 	= $this->input->post('notification');
		$url 			= $this->input->post('url');

		$noti_id = $this->notify->insert(array(
			'subject' 			=> $subject,
			'notification' 		=> $notification,
			'url' 				=> $url,
			'user_id ' 			=> $user,
			'view_status ' 		=> 0
		));
	}

	/*Open Contract*/
	public function open_contract()
	{
		
		$datas = self::$data;
		if (empty($this->input->post('offer_id'))) {
			$bid            =  $this->database->_get_row_data('tbl_bids', array('id' => $this->input->post('o_bid_id_cont'), 'bid_status' => 1));
			if (isset($bid[0]['id'])) {
				$listing    =  $this->database->_get_row_data('tbl_listings', array('id' => $bid[0]['listing_id']));
				$data = array(
					'contract_id' => $this->database->_unique_id('tbl_opens', 'alnum', 'contract_id'),
					'listing_id' => $bid[0]['listing_id'],
					'bid_id' => $bid[0]['id'],
					'type' => 'bid',
					'customer_id' => $bid[0]['bidder_id'],
					'owner_id' => $bid[0]['owner_id'],
					'delivery_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + " . $listing[0]['deliver_in'] . " day")),
					'delivery' => $listing[0]['deliver_in'],
					'status' => 0,
					'date' => date('Y-m-d H:i:s')

				);

				$insert_id = $this->database->_insert_to_DB('tbl_opens', $data);
				if (!empty($insert_id)) {
					$this->database->_update_to_DB('tbl_bids', array('bid_status' => '6'), $this->input->post('o_bid_id'));
					if (!empty($insert_id)) {
						if ($datas['settings'][0]['email_notifications'] === '1') {
							$this->email_op->_user_email_notification('won-bid', $data);
						}
						redirect('user/contract/' . $insert_id);
						return;
					}
				}
			}
			return;
		} else {
			$offer            =  $this->database->_get_offer($this->input->post('offer_id'));
			if (isset($offer[0]['id'])) {
				$listing    =   $this->database->_get_row_data('tbl_listings', array('id' => $offer[0]['listing_id']));
				$data = array(
					'contract_id' => $this->database->_unique_id('tbl_opens', 'alnum', 'contract_id'),
					'listing_id' => $offer[0]['listing_id'],
					'bid_id' => $offer[0]['id'],
					'type' => 'offer',
					'customer_id' => $offer[0]['bidder_id'],
					'owner_id' => $offer[0]['owner_id'],
					'delivery_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + " . $listing[0]['deliver_in'] . " day")),
					'delivery' => $listing[0]['deliver_in'],
					'status' => 0,
					'date' => date('Y-m-d H:i:s')

				);
				$insert_id = $this->database->_insert_to_DB('tbl_opens', $data);
				if (!empty($insert_id)) {
					$this->database->_update_to_DB('tbl_offers', array('offer_status' => '6'), $this->input->post('offer_id'));
					if (!empty($insert_id)) {
						if ($datas['settings'][0]['email_notifications'] === '1') {
							$this->email_op->_user_email_notification('accept-offer', $data);
						}
						redirect('user/contract/' . $insert_id);
						return;
					}
				}
			}
			return;
		}
	}

	/*contract view page*/
	public function contract($id)
	{
		//echo $id; exit;
		$data = self::$data;
		if (!empty($id)) {
			//echo "test";exit;
			$data['contract']		=	$this->database->_get_contract($id);

			//echo $data['contract'][0]['bid_id'];
			
			echo "<pre>";
			print_r($data['contract']);
			exit;
			// pre($data['contract'],1);
			if (isset($data['contract'][0]['bid_id'])) {
				$data['userprofile'] 		= 	$this->database->getUserData($data['contract'][0]['owner_id']);
				$data['reviewRatings'] 		= 	$this->database->get_reviews($data['contract'][0]['owner_id'], $this->session->userdata('user_id'));
				$data['contractsHistory'] 	= 	$this->database->_load_history($data['contract'][0]['id']);

				if ($data['contract'][0]['type'] === 'bid') {
					$data['biddata']		= 	$this->database->_get_bid($data['contract'][0]['bid_id']);
				}

				if ($data['contract'][0]['type'] === 'offer') {
					$data['biddata']		= 	$this->database->_get_offer($data['contract'][0]['bid_id']);
				}

				$data['contractamount']		= 	$this->database->_get_single_data('tbl_contracts', array('contract_id' => $data['contract'][0]['id']), 'amount');
				$data['listing_data']		=	$this->database->_get_row_data('tbl_listings', array('id' => $data['contract'][0]['listing_id']));
			}
			$data = $this->security->xss_clean($data);
			$this->load->view('user/open-contract', $data);
			return;
		}
		$this->pageNotFound();
	}

	/*Closed Contract view page*/
	public function closed_contracts($id)
	{
		$data = self::$data;
		if (!empty($id)) {
			$data['contract']		=	$this->database->_get_contract($id);
			if (isset($data['contract'][0]['bid_id'])) {
				$data['userprofile'] 		= 	$this->database->getUserData($data['contract'][0]['owner_id']);
				$data['reviewRatings'] 		= 	$this->database->get_reviews($data['contract'][0]['owner_id'], $this->session->userdata('user_id'));
				$data['contractsHistory'] 	= 	$this->database->_load_history($data['contract'][0]['id']);
				if ($data['contract'][0]['bid_id'] !== 'direct') {
					$data['biddata']		= 	$this->database->_get_bid($data['contract'][0]['bid_id']);
				}
				$data['contractamount']		= 	$this->database->_get_single_data('tbl_contracts', array('contract_id' => $data['contract'][0]['id']), 'amount');
				$data['listing_data']		=	$this->database->_get_row_data('tbl_listings', array('id' => $data['contract'][0]['listing_id']));
			}
			$data = $this->security->xss_clean($data);
			$this->load->view('user/open-contract', $data);
			return;
		}
		$this->pageNotFound();
	}

	/*invoices*/
	public function invoices()
	{
		$data = self::$data;
		$data['invoices']	  	=	$this->database->_get_invoices();
		$data = $this->security->xss_clean($data);
		$this->load->view('user/invoices', $data);
		return;
	}

	/*view selected invoice*/
	public function invoice_get($id)
	{
		$data = self::$data;
		if (!empty($id)) {
			$data['invoice']			=	$this->database->_get_row_data('tbl_invoices', array('invoice_id' => $id));
			if (!empty($data['invoice'])) {
				$data['customerinfo']	=	$this->database->getUserData($data['invoice'][0]['paid_by']);
				$data['ownerinfo']		=	$this->database->getUserData($data['invoice'][0]['paid_to']);
				$data['listing_data']	=	$this->database->_get_row_data('tbl_listings', array('id' => $data['invoice'][0]['listing_id']));
				$data = html_escape($this->security->xss_clean($data));
				$this->load->view('user/invoice', $data);
				return;
			}
		}
		$this->pageNotFound();
		return;
	}

	/*Get Selected Listing Header*/
	public function get_selectedListingHeader($header_id)
	{
		$output['token']  = $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		if (!empty($header_id)) {
			$output['response']  = $this->database->_get_row_data('tbl_listing_header', array('listing_id' => $header_id));
			exit(json_encode($output));
		}

		$output['response']  = false;
		exit(json_encode($output));
	}

	/*Not found Page*/
	public function pageNotFound()
	{
		$this->load->view('main/404');
	}
	public function deleteFileCache()
	{
		$this->load->driver('cache');
		$this->cache->file->delete(getUserSlug("_course"));
		$this->cache->file->delete(getUserSlug("_permission"));
	}
	/*User logout*/
	public function logout()
	{
		$this->deleteFileCache();
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_level');
		$this->session->unset_userdata('role');
		redirect(base_url());
		return;
	}

	/*User Profile*/
	public function user_profile($userid, $page = 0)
	{
		$data = self::$data;
		$data['userprofile'] 					= 	$this->database->getUserData($userid);
		$data['reviewRatings'] 					= 	$this->database->get_reviews($userid, $this->session->userdata('user_id'));
		$data['profileid'] 						= 	$userid;
		$data['profileRatingsAvg'] 				= 	$this->database->get_reviews($userid, "", "", '', '', 'avg');
		$data["profileRatings"] 				= 	$this->database->get_reviews($userid, "", "");
		$data['websitelistings'] 				= 	$this->_userwise__listings($userid, '');
		$data['soldlistings'] 					= 	$this->_userwise__listings($data['userprofile'][0]['user_id'], '', true, true);
		$data['listingCount']					= 	$this->database->_count_listings_user_wise();
		$data['totalEarnings']					=	$this->database->_user_total_earnings($userid);
		$data['verifiedGA']						=	"";
		$data['FormValues'] 					= 	"";
		$data['reportData'] 					= 	"";

		if (!empty($data['userprofile'])) {
			$data = html_escape($this->security->xss_clean($data));
			$data["links"] 							= 	$this->common->reviews_pagination_loader($userid);
			$this->loadPage('user-profile', $data);
			return;
		}
		$this->pageNotFound();
		return;
	}

	function loadPage($template, $data = null)
	{
		$data['template_name'] 		= 	$template;
		$data['data'] 				= 	$data;
		// $data 						= 	html_escape($this->security->xss_clean($data));
		$this->load->view('main/master-template', $data);
	}


	/*Get Userwise Listings*/
	public function _userwise__listings($userid, $type = '', $limit = false, $sold = false, $listing_id = '')
	{


		if (!$limit) {
			$userListings = $this->database->_userwise_all_listings($userid, $type);
			//pre("limit....");
			//pre($userListings, 1);

		} else {
			if (empty($listing_id)) {
				if (!$sold) {
					$userListings = $this->database->_get_row_data('tbl_listings', array('user_id' => $userid, 'listing_option' => $type), '', true);
				} else {
					return $userListings = $this->database->_get_row_data('tbl_listings', array('user_id' => $userid, 'status' => 1, 'sold_status' => 1), '', false);
				}
			} else {
				$userListings = $this->database->_get_row_data('tbl_listings', array('id' => $listing_id, 'user_id' => $userid, 'listing_option' => $type), '', true);
			}
		}


		if (!empty($userListings)) {
			$i = 0;
			foreach ($userListings as $listing) {
				$userListings[$i]['listingType']            	= $listing['listing_type'];

				if ($type === 'auction') {
					$userListings[$i]['activecount']            = $this->database->numberOfBids($listing['id'], $listing['listing_type'], '1', 1);
					$userListings[$i]['inactivecount']          = $this->database->numberOfBids($listing['id'], $listing['listing_type'], '1', 0);
					$userListings[$i]['rejectedcount']          = $this->database->numberOfBids($listing['id'], $listing['listing_type'], '1', 2);
					$userListings[$i]['totalBids']              = $this->database->numberOfBids($listing['id'], $listing['listing_type'], '1', 1);
					$userListings[$i]['totalBidders']           = $this->database->numberOfBidders($listing['id'], $listing['listing_type'], '1', 0);
					$userListings[$i]['totalBidValue']          = array_sum(array_column($this->database->numberOfBids($listing['id'], $listing['listing_type'], '', 1), 'bid_amount'));
					$endingArr                                  = $this->common->DateDiffCalculate($this->database->_get_auction_ending_date($listing['id'], 'tbl_listings')[0]['ENDDATE']);
					$userListings[$i]['endingdays']             = $endingArr['days'];
					$userListings[$i]['endinghours']            = $endingArr['hours'];
					$userListings[$i]['highestbid']             = 0;
					$userListings[$i]['highestbidder']          = 'n/a';
					$userListings[$i]['averageBid']             = 0;
					$userListings[$i]['reservedprice']          = $this->database->_get_single_data('tbl_listings', array('id' => $listing['id']), 'website_reserveprice');
					$userListings[$i]['highestbidrow']          = 0;
					if (isset($userListings[$i]['activecount']) && $userListings[$i]['activecount'] !== 0) {
						$userListings[$i]['averageBid']         = $this->common->ConvertToMillions($userListings[$i]['totalBidValue'] / $userListings[$i]['activecount']);
					}

					if (isset($this->DatabaseOperationsHandler->_get_highest_bid_details('1', $listing['id'], $listing['listing_type'])[0]['bid_amount'])) {
						$userListings[$i]['highestbidrow']         = $this->database->_get_highest_bid_details('1', $listing['id'], $listing['listing_type'])[0]['bid_amount'];
						$userListings[$i]['highestbid']            = $this->common->ConvertToMillions($userListings[$i]['highestbidrow']);
						$userListings[$i]['highestbidder']         = $this->database->getUserData($this->DatabaseOperationsHandler->_get_highest_bid_details('1', $listing['id'], $listing['listing_type'])[0]['bidder_id'])[0]['username'];
					}
				} else {
					$userListings[$i]['cancelcount']            = $this->database->numberOfOffers($listing['id'], $listing['listing_type'], '1', 3);
					$userListings[$i]['inactivecount']          = $this->database->numberOfOffers($listing['id'], $listing['listing_type'], '1', 0);
					$userListings[$i]['rejectedcount']          = $this->database->numberOfOffers($listing['id'], $listing['listing_type'], '1', 1);
					$userListings[$i]['totalBids']              = $this->database->numberOfOffers($listing['id'], $listing['listing_type'], '1', '');
					$userListings[$i]['totalBidders']           = $this->database->numberOfClients($listing['id'], $listing['listing_type'], '1', 0);
					$userListings[$i]['totalBidValue']          = array_sum(array_column($this->database->numberOfOffers($listing['id'], $listing['listing_type'], '', 1), 'offer_amount'));
					$userListings[$i]['highestbid']             = 0;
					$userListings[$i]['highestbidder']          = 'n/a';
					$userListings[$i]['averageBid']             = 0;
					$userListings[$i]['highestbidrow']          = 0;

					if (isset($userListings[$i]['activecount']) && $userListings[$i]['activecount'] !== 0) {
						$userListings[$i]['averageBid']         = $this->common->ConvertToMillions($userListings[$i]['totalBidValue'] / $userListings[$i]['activecount']);
					}

					if (isset($this->database->_get_highest_offer_details('0', $listing['id'], $listing['listing_type'])[0]['offer_amount'])) {
						$userListings[$i]['highestbidrow']          = $this->database->_get_highest_offer_details('0', $listing['id'], $listing['listing_type'])[0]['offer_amount'];
						$userListings[$i]['highestbid']             = $this->common->ConvertToMillions($userListings[$i]['highestbidrow']);
						$userListings[$i]['highestbidder']          = $this->database->getUserData($this->DatabaseOperationsHandler->_get_highest_offer_details('0', $listing['id'], $listing['listing_type'])[0]['customer_id'])[0]['username'];
					}
				}
				$i++;
			}
			return $userListings;
		}
		return;
	}

	/*Update the Bid Status After Finish the Auction*/
	public function _update_winning_auction($id, $type)
	{

		$data['AuctionEndingDate']     	= $this->database->_get_auction_ending_date($id, 'tbl_listings');
		$expire 						= $data['AuctionEndingDate'][0]['ENDDATE'];
		$today  						= strtotime("today");

		if ($today <= $expire) {
			$aleadyExists                           = $this->_get_highest_bid_details('3', $id, $type);
			if (empty($aleadyExists)) {
				$HighestBidInfo                     = $this->_get_highest_bid_details('1', $id, $type);
				if (isset($HighestBidInfo[0]['bid_amount'])) {
					if (!empty($HighestBidInfo[0]['id']) && isset($HighestBidInfo[0]['id'])) {
						$data = array(
							'bid_status' => 3
						);
						return $this->database->_update_to_table('tbl_bids', $data, array('id' => $HighestBidInfo[0]['id']));
					}
				}
			}
		}
		return;
	}

	/*Revoke Tokens*/
	public function revokeTokens($domain)
	{
		$data = array(
			'acc_id' => "",
			'prop_id' => "",
			'view_id' => "",
			'google_token' => "",
			'google_anastatus' => 0
		);
		if ($this->database->_update_to_table('tbl_domains', $data, array('id' => $domain, 'status' => 1))) {
			return true;
		} else {
			return false;
		}
	}

	/*Create Withdrawal Record*/
	public function create_withdrawal()
	{
		$output['token']       = $this->security->get_csrf_hash();
		header('Content-Type: application/json');

		$datas = self::$data;
		$withdrawalDetails      = $this->database->_get_row_data('tbl_withdrawal_methods', array('id' => $this->input->post('withdrawal_method'), 'status' => 1));
		$availableToWithdraw    = $this->database->_user_availableto_withdraw($this->session->userdata('user_id'));

		if ($availableToWithdraw < $this->input->post('withdraw_amount')) {
			$output['response'] = 'Sorry You can withdraw only $' . $availableToWithdraw;
			exit(json_encode($output));
		}

		if ($withdrawalDetails[0]['threshold'] > $this->input->post('withdraw_amount')) {
			$output['response'] = 'Sorry Your Withdrawal Threshold for this method is $' . $withdrawalDetails[0]['threshold'];
			exit(json_encode($output));
		}

		$fee = $withdrawalDetails[0]['fee'];
		if ($withdrawalDetails[0]['cal_meth'] === '1') {
			$fee = ($this->input->post('withdraw_amount') * $withdrawalDetails[0]['fee']) / 100;
		}

		$data = array(
			'withdrawal_id' => $this->database->_unique_id('tbl_withdrawals', 'alnum', 'withdrawal_id'),
			'user_id' => $this->session->userdata('user_id'),
			'updated' => date('Y-m-d H:i:s'),
			'amount' => $this->input->post('withdraw_amount'),
			'fee' => $fee,
			'final_amount' => ($this->input->post('withdraw_amount') - $fee),
			'method' => $this->input->post('withdrawal_method'),
			'status' => 0
		);

		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('amount', 'Withdrawal Amount', 'required|numeric|trim|xss_clean');

		if ($this->form_validation->run()) {
			$data = $this->security->xss_clean($data);
			if ($datas['settings'][0]['email_notifications'] === '1') {
				$this->email_op->_admin_email_notification('withdraw-request', $data);
			}

			$output['response']     = 	$this->database->_insert_to_table('tbl_withdrawals', $data);
			exit(json_encode($output));
		}

		$output['response']         = 	'Sorry, right now we cannot process your request. Please contact support';
		exit(json_encode($output));
	}

	/*Insert domain purchases*/
	public function InsertDomainPurchaseData($user_id, $Arr)
	{
		if (!empty($Arr['domain_list'])) {
			foreach (json_decode($Arr['domain_list'], true) as $domain) {
				$domain_id  =	$this->database->_get_single_data('tbl_listings', array('id' => $domain['id']), 'domain_id');
				if ($domain['sale'] === 'direct') {
					$data = array(
						'user_id' => $user_id,
						'domain_id' => $domain_id,
						'listing_id' => $domain['id'],
						'amount' => $domain['price'],
						'invoice_id' => $Arr['transactionId'],
					);

					$contract_id = $this->common->open_direct_contract($data['listing_id']);

					$contractArr = array(
						'user_id' => $user_id,
						'domain_id' => $domain_id,
						'contract_id' => $contract_id,
						'listing_id' => $domain['id'],
						'amount' => $domain['price'],
						'invoice_id' => $Arr['transactionId'],
					);

					if ($this->database->_update_to_DB('tbl_listings', array('sold_status' => 1), $data['listing_id'])) {
						if (!empty($contract_id)) {
							$this->database->_insert_to_table('tbl_domain_purchases', $data);
							if ($this->database->_insert_to_table('tbl_contracts', $contractArr)) {
								$this->common->change_contract_status($contract_id, 1);
								$this->common->change_delivery_date($contract_id, 1);
								$this->common->create_invoice($contractArr);
							}
						}
					}
				} else {
					$data = array(
						'user_id' => $user_id,
						'domain_id' => $domain_id,
						'contract_id' => $domain['sale'],
						'listing_id' => $domain['id'],
						'amount' => $domain['price'],
						'invoice_id' => $Arr['transactionId'],
					);

					if ($this->database->_update_to_DB('tbl_listings', array('sold_status' => 1), $data['listing_id'])) {
						if ($this->database->_insert_to_table('tbl_contracts', $data)) {
							$this->common->change_contract_status($domain['sale'], 1);
							$this->common->change_delivery_date($domain['sale'], 1);
							$this->common->create_invoice($data);
						}
					}
				}
			}
		}
	}

	/*Insert Report*/
	public function insert_report()
	{
		$output['token']       = $this->security->get_csrf_hash();
		header('Content-Type: application/json');

		$data = array(
			'listing_id	' => $this->input->post('listing_id'),
			'reporter' => $this->session->userdata('user_id'),
			'reason' => $this->input->post('txt_reason'),
			'status' => 0
		);

		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('reason', 'reason', 'required|trim|xss_clean');

		if ($this->form_validation->run()) {
			$data = html_escape($this->security->xss_clean($data));
			$output['response']     = $this->database->_insert_to_table('tbl_reports', $data);
			exit(json_encode($output));
		}

		$output['response']         = false;
		exit(json_encode($output));
	}

	

	public function CommissionUserOrProductWise()
	{
		if (empty($this->input->post('listing_id'))) {
			// get user commission
			$userComm = $this->database->getUserCommission($this->session->userdata('user_id'));
			//get commission amount
			$admin_commission = $userComm[0]['admin_commission'] ?? 0;
		} else {

			$listing_id             =  $this->input->post('listing_id');
			if (!empty($listing_id)) {
				//get listing to be going to update
				$userComm        =  $this->database->_get_row_data('tbl_listings', ['id' =>  $listing_id]);
				// get commission amount
				$admin_commission  = $userComm[0]['commission_amount'] ?? 0;
			}
		}
		if (!empty($userComm)) {
			// get commission type  
			$commission_type = $userComm[0]['commission_type'] ?? 0;
			// get minimum-offer , buy-now , discount-price
			$original_minimumoffer 	= $this->input->post('website_minimumoffer') ?? 0;
			$original_buynowprice 	= $this->input->post('website_buynowprice') ?  $this->input->post('website_buynowprice') : ($this->input->post('price') ? $this->input->post('price') : 0);
			$original_discountprice = $this->input->post('website_discountprice') ?? 0;
			$commission_user_product =  1;
			// commission_type == 1 then fixed commission
			if (!empty($commission_type) && $commission_type == 1) {

				$commission_amount 		=  $admin_commission;

				if (!empty($original_minimumoffer)) {
					$website_minimumoffer 	= 	$original_minimumoffer + $admin_commission;
				}
				if (!empty($original_buynowprice)) {
					$website_buynowprice 	= 	$original_buynowprice  + $admin_commission;
				}
				if (!empty($original_discountprice)) {
					$website_discountprice 	= 	$original_discountprice + $admin_commission;
				}
			}
		}


		// commission_type == 2 then percentage commission
		if (!empty($commission_type) && $commission_type ==  2) {

			$commission_amount 		=  $admin_commission;
			if (!empty($original_minimumoffer)) {
				$commission_amount1 		= ($original_minimumoffer * ($admin_commission / 100));
				$website_minimumoffer 	= 	$original_minimumoffer + $commission_amount1;
			}
			if (!empty($original_buynowprice)) {
				$commission_amount2		= ($original_buynowprice * ($admin_commission / 100));
				$website_buynowprice 	= 	$original_buynowprice  + $commission_amount2;
			}
			if (!empty($original_discountprice)) {
				$commission_amount3 	= ($original_discountprice * ($admin_commission / 100));
				$website_discountprice 	= 	$original_discountprice + $commission_amount3;
			}
		}

		return [
			'commission_type' 			=> $commission_type ?? 0,
			'admin_commission'			=> $admin_commission ?? 0,
			'original_minimumoffer'		=> $original_minimumoffer ?? 0,
			'original_buynowprice'		=> $original_buynowprice ?? 0,
			'original_discountprice' 	=> $original_discountprice ?? 0,
			'commission_user_product' 	=>  $commission_user_product ?? 0,
			'commission_amount' 		=> $commission_amount ?? 0,
			'website_minimumoffer'		=> $website_minimumoffer ?? 0,
			'website_buynowprice'		=> $website_buynowprice ?? 0,
			'website_discountprice'		=> $website_discountprice ?? 0,

		];
	}

	/*Save Ad Listings*/
	public function add_listing()
	{

		$output['token']       = $this->security->get_csrf_hash();
		header('Content-Type: application/json');

		$datas = self::$data;

		$deviceData     	= $this->common->detectVisitorDevice();
		$thumbnailCover 	= '';
		$thumbnail      	= '';
		$uploadVisual   	= '';
		$uploadProfitLoss   = '';

		$output['token']  	= $this->security->get_csrf_hash();
		header('Content-Type: application/json');

		if (empty($this->input->post('listing_type'))) {
			$output['response']  =  false;
			exit(json_encode($output));
		}
		if (!empty($this->input->post('display_on_page'))) {
			$display_on_page = implode(",", array_filter($this->input->post('display_on_page')));
			$section = $this->input->post('frontend_section');
		}

		// calculate the commission user or product wise... 
		$commission = $this->CommissionUserOrProductWise();




		if ($this->input->post('listing_type') === 'domain') {

			if (!empty($_FILES['uploadThumbnailImage']['name'])) {
				if ($this->security->xss_clean($_FILES['uploadThumbnailImage']['name'], TRUE) === TRUE) {
					$thumbnail = $this->upload__image('uploadThumbnailImage');
				}
			}

			if (empty($this->input->post('listing_id'))) {
				if ($this->input->post('website_1_group_2') === 'classified') {
					$listing_option = 'classified';
				} else if ($this->input->post('website_1_group_2') === 'auction') {
					$listing_option = 'auction';
				}
			} else {
				$listing_option = $this->input->post('listing_option');
			}

			$extesnion = explode(".", $this->input->post('website_BusinessName'));





			$data = array(
				'domain_id' => $this->input->post('domain_id'),
				'listing_type' => $this->input->post('listing_type'),
				'user_id' => $this->session->userdata('user_id'),
				'website_BusinessName' => $this->input->post('website_BusinessName'),
				'extension' => end($extesnion),
				'website_age' => $this->input->post('website_age'),
				'business_registeredCountry' => $this->input->post('business_registeredCountry'),
				'website_industry' => "",
				'monetization_methods' => 'N/A',
				'last12_monthsrevenue' => "",
				'last12_monthsexpenses' => "",
				'annual_profit' => "",
				'google_verified' => 0,
				'financial_uploadVisual' => "",
				'financial_uploadProfitLoss' => "",
				'website_tagline' => $this->input->post('website_tagline') ?? '',
				'website_metadescription' => $this->input->post('website_metadescription') ?? '',
				'website_metakeywords' =>  $this->input->post('website_metakeywords') ?? '',
				'description' => $this->input->post('editordata'),
				'website_how_make_money' => "",
				'website_purchasing_fulfilment' => "",
				'website_whyselling' => "",
				'website_suitsfor' => "",
				'website_thumbnail' =>  $thumbnail,
				'screenshot' => '',
				'website_cover' => "",
				'status' => 0,
				'sold_status' => 0,
				'deliver_in' => $this->input->post('deliver_in'),
				'listing_option' => $listing_option,
				'website_startingprice' => $this->input->post('website_startingprice') ?? 0,
				'website_reserveprice' => $this->input->post('website_reserveprice') ?? 0,

				'website_minimumoffer' => 	!empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
				'website_buynowprice' =>  !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],
				'website_discountprice' => !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],

				'original_minimumoffer' => $commission['original_minimumoffer'],
				'original_buynowprice' => $commission['original_buynowprice'],
				'original_discountprice' => $commission['original_discountprice'],

				'commission_type'   => $commission['commission_type'] ?? 0,
				'commission_user_product' => $commission['commission_user_product'] ?? 0,
				'commission_amount' => $commission['commission_amount'],

				'monthly_downloads' => 0,
				'app_url' => "n/a",
				'app_market' => "n/a",
				'user_ip' => $deviceData['ip_address'],
				'date' => date('Y-m-d H:i:s'),
				'token' => '',
				'slug' => $this->input->post('slug'),
			);

			$dataUp = array(
				'website_tagline' => $this->input->post('website_tagline'),
				'website_metadescription' => $this->input->post('website_metadescription'),
				'description' => $this->input->post('editordata'),
				// 'established_date' => $this->input->post('established_date') ?? "",
				'website_age' => $this->input->post('website_age') ?? "",
				'business_registeredCountry' => $this->input->post('business_registeredCountry'),
				'screenshot' => '',
				'slug' => $this->input->post('slug'),

				'website_minimumoffer' => 	!empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
				'website_buynowprice' =>  !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],
				'website_discountprice' => !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],

				'original_minimumoffer' => $commission['original_minimumoffer'],
				'original_buynowprice' => $commission['original_buynowprice'],
				'original_discountprice' => $commission['original_discountprice'],
				'commission_type'   => $commission['commission_type'] ?? 0,
				'commission_user_product' => $commission['commission_user_product'] ?? 0,
				'commission_amount' => $commission['commission_amount'],

			);
		} else if ($this->input->post('listing_type') === 'website') {

			if (!empty($_FILES['uploadListingImage']['name'])) {
				if ($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === TRUE) {
					$thumbnailCover = $this->upload__image('uploadListingImage');
				}
			}

			if (!empty($_FILES['uploadThumbnailImage']['name'])) {
				if ($this->security->xss_clean($_FILES['uploadThumbnailImage']['name'], TRUE) === TRUE) {
					$thumbnail = $this->upload__image('uploadThumbnailImage');
				}
			}

			if (!empty($_FILES['uploadVisual']['name'])) {
				if ($this->security->xss_clean($_FILES['uploadVisual']['name'], TRUE) === TRUE) {
					$uploadVisual = $this->upload__files('uploadVisual');
				}
			}

			if (!empty($_FILES['uploadProfitLoss']['name'])) {
				if ($this->security->xss_clean($_FILES['uploadProfitLoss']['name'], TRUE) === TRUE) {
					$uploadProfitLoss = $this->upload__files('uploadProfitLoss');
				}
			}

			if (empty($this->input->post('listing_id'))) {
				if ($this->input->post('website_1_group_2') === 'classified') {
					$listing_option = 'classified';
				} else if ($this->input->post('website_1_group_2') === 'auction') {
					$listing_option = 'auction';
				}
			} else {
				$listing_option = $this->input->post('listing_option');
			}

			$extesnion = explode(".", $this->input->post('website_BusinessName'));

			if (!empty($datas['settings'][0]['google_api_key'])) {
				$screenshot =  $this->AnalyticsOperationsHandler->snap($this->input->post('siteURL'), $this->common->_generate_unique_tokens('tbl_listings', 'screenshot'), $datas['settings'][0]['google_api_key']);
			} else {
				$screenshot = '';
			}


			if (!empty($this->input->post('monetization_through'))) {
				$monetization_through = implode(",", $this->input->post('monetization_through'));
				//pre($monetization_through , 1);
			} else {
				$monetization_through = '';
			}
			if (!empty($this->input->post('traffic_sources'))) {
				$traffic_sources = implode(",", $this->input->post('traffic_sources'));
			} else {
				$traffic_sources = '';
			}


			$data = array(
				'domain_id' => $this->input->post('domain_id'),
				'listing_type' => $this->input->post('listing_type'),
				'user_id' => $this->session->userdata('user_id'),
				'website_BusinessName' => $this->input->post('website_BusinessName'),
				'extension' => end($extesnion),
				'established_date' => $this->input->post('established_date') ?? "",
				'monetized_since' => $this->input->post('monetized_since') ?? "",
				'six_months_revenue' => $this->input->post('six_months_revenue') ?? "",
				'six_months_profit' => $this->input->post('six_months_profit') ?? "",
				'traffic_sources' =>  $traffic_sources,
				'monthly_visitors' => $this->input->post('monthly_visitors') ?? "",
				'sales_support' => $this->input->post('sales_support') ?? 0,
				'website_facebook' => $this->input->post('website_facebook') ?? "",
				'website_twitter' => $this->input->post('website_twitter') ?? "",
				'website_instagram' => $this->input->post('website_instagram') ?? "",

				'monetization_through' => $monetization_through,
				'website_status' => $this->input->post('website_status'),
				'website_age' => $this->input->post('website_age'),
				'business_registeredCountry' => $this->input->post('business_registeredCountry'),
				'website_industry' => $this->input->post('website_industry'),
				'monetization_methods' => 'N/A',
				'last12_monthsrevenue' => $this->input->post('last12_monthsrevenue') ?? '',
				'last12_monthsexpenses' => $this->input->post('last12_monthsexpenses') ?? '',
				'annual_profit' => $this->input->post('annual_profit') ?? '',
				'google_verified' => 0,
				'financial_uploadVisual' => $uploadVisual,
				'financial_uploadProfitLoss' => $uploadProfitLoss,
				'website_tagline' => $this->input->post('website_tagline') ?? '',
				'website_metadescription' => $this->input->post('website_metadescription') ?? '',
				'website_metakeywords' => $this->input->post('website_metakeywords') ?? '',
				'description' => $this->input->post('editordata'),
				'website_how_make_money' => $this->input->post('website_how_make_money') ?? "",
				'website_purchasing_fulfilment' => $this->input->post('website_purchasing_fulfilment') ?? "",
				'website_whyselling' => $this->input->post('website_whyselling') ?? "",
				'website_suitsfor' => $this->input->post('website_suitsfor') ?? "",
				'website_thumbnail' =>  $thumbnail,
				'screenshot' => $screenshot,
				'website_cover' => $thumbnailCover,
				'status' => 0,
				'sold_status' => 0,
				'deliver_in' => $this->input->post('deliver_in'),
				'listing_option' => $listing_option,
				'website_startingprice' => $this->input->post('website_startingprice') ?? 0,
				'website_reserveprice' => $this->input->post('website_reserveprice') ?? 0,

				'website_minimumoffer' => 	!empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
				'website_buynowprice' =>  !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],
				'website_discountprice' => !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],

				'original_minimumoffer' => $commission['original_minimumoffer'],
				'original_buynowprice' => $commission['original_buynowprice'],
				'original_discountprice' => $commission['original_discountprice'],

				'commission_type'   => $commission['commission_type'] ?? 0,
				'commission_user_product' => $commission['commission_user_product'] ?? 0,

				'commission_amount' => $commission['commission_amount'],

				'monthly_downloads' => 0,
				'app_url' => "n/a",
				'app_market' => "n/a",
				'user_ip' => $deviceData['ip_address'],
				'date' => date('Y-m-d H:i:s'),
				'token' => '',
				'slug' => $this->input->post('slug'),

			);



			$dataUp = array(
				'website_tagline' => $this->input->post('website_tagline'),
				'website_metadescription' => $this->input->post('website_metadescription'),
				'website_status' => $this->input->post('website_status'),
				'website_age' => $this->input->post('website_age'),
				'business_registeredCountry' => $this->input->post('business_registeredCountry'),
				'description' => $this->input->post('editordata'),
				'website_industry' => $this->input->post('website_industry'),
				'last12_monthsrevenue' => $this->input->post('last12_monthsrevenue') ?? '',
				'last12_monthsexpenses' => $this->input->post('last12_monthsexpenses') ?? '',
				'website_how_make_money' => $this->input->post('website_how_make_money') ?? '',
				'website_purchasing_fulfilment' => $this->input->post('website_purchasing_fulfilment'),
				'website_whyselling' => $this->input->post('website_whyselling'),
				'website_suitsfor' => $this->input->post('website_suitsfor'),
				'slug' => $this->input->post('slug'),

				'website_minimumoffer' => 	!empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
				'website_buynowprice' =>  !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],
				'website_discountprice' => !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],

				'original_minimumoffer' => $commission['original_minimumoffer'],
				'original_buynowprice' => $commission['original_buynowprice'],
				'original_discountprice' => $commission['original_discountprice'],

				'commission_type'   => $commission['commission_type'] ?? 0,
				'commission_user_product' => $commission['commission_user_product'] ?? 0,

				'commission_amount' => $commission['commission_amount'],
			);
		} else if ($this->input->post('listing_type') === 'app') {


			if (!empty($_FILES['uploadListingImage']['name'])) {
				if ($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === TRUE) {
					$thumbnailCover = $this->upload__image('uploadListingImage');
				}
			}

			if (!empty($_FILES['uploadThumbnailImage']['name'])) {
				if ($this->security->xss_clean($_FILES['uploadThumbnailImage']['name'], TRUE) === TRUE) {
					$thumbnail = $this->upload__image('uploadThumbnailImage');
				}
			}

			if (!empty($_FILES['uploadVisual']['name'])) {
				if ($this->security->xss_clean($_FILES['uploadVisual']['name'], TRUE) === TRUE) {
					$uploadVisual = $this->upload__files('uploadVisual');
				}
			}

			if (!empty($_FILES['uploadProfitLoss']['name'])) {
				if ($this->security->xss_clean($_FILES['uploadProfitLoss']['name'], TRUE) === TRUE) {
					$uploadProfitLoss = $this->upload__files('uploadProfitLoss');
				}
			}

			if (empty($this->input->post('listing_id'))) {
				if ($this->input->post('website_1_group_2') === 'classified') {
					$listing_option = 'classified';
				} else if ($this->input->post('website_1_group_2') === 'auction') {
					$listing_option = 'auction';
				}
			} else {
				$listing_option = $this->input->post('listing_option');
			}

			$extesnion = explode(".", $this->input->post('website_BusinessName'));

			$data = array(
				'domain_id' => $this->input->post('domain_id'),
				'listing_type' => $this->input->post('listing_type'),
				'user_id' => $this->session->userdata('user_id'),
				'website_status' => $this->input->post('website_status'),
				'website_BusinessName' => $this->input->post('website_BusinessName'),
				'extension' => end($extesnion),
				'website_age' => $this->input->post('website_age'),
				'business_registeredCountry' => $this->input->post('business_registeredCountry'),
				'website_industry' => $this->input->post('website_industry'),
				'monetization_methods' => 'N/A',
				'last12_monthsrevenue' => $this->input->post('last12_monthsrevenue') ?? '',
				'last12_monthsexpenses' => $this->input->post('last12_monthsexpenses') ?? '',
				'annual_profit' => $this->input->post('annual_profit') ?? '',
				'google_verified' => 0,
				'financial_uploadVisual' => $uploadVisual,
				'financial_uploadProfitLoss' => $uploadProfitLoss,
				'website_tagline' => $this->input->post('website_tagline') ?? '',
				'website_metadescription' => $this->input->post('website_metadescription') ?? '',
				'website_metakeywords' => $this->input->post('website_metakeywords') ?? '',
				'description' => $this->input->post('editordata'),
				'website_how_make_money' => $this->input->post('website_how_make_money'),
				'website_purchasing_fulfilment' => $this->input->post('website_purchasing_fulfilment'),
				'website_whyselling' => $this->input->post('website_whyselling'),
				'website_suitsfor' => $this->input->post('website_suitsfor'),
				'website_thumbnail' => $thumbnail,
				'screenshot' => '',
				'website_cover' => $thumbnailCover,
				'status' => 0,
				'sold_status' => 0,
				'deliver_in' => $this->input->post('deliver_in'),
				'listing_option' => $listing_option,
				'website_startingprice' => $this->input->post('website_startingprice') ?? 0,
				'website_reserveprice' => $this->input->post('website_reserveprice') ?? 0,


				'website_minimumoffer' => 	!empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
				'website_buynowprice' =>  !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],
				'website_discountprice' => !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],

				'original_minimumoffer' => $commission['original_minimumoffer'],
				'original_buynowprice' => $commission['original_buynowprice'],
				'original_discountprice' => $commission['original_discountprice'],

				'commission_type'   => $commission['commission_type'] ?? 0,
				'commission_user_product' => $commission['commission_user_product'] ?? 0,

				'commission_amount' => $commission['commission_amount'],

				'monthly_downloads' => $this->input->post('monthly_downloads'),
				'app_url' => $this->input->post('appURL'),
				'app_market' => $this->common->get_full_domain_url($this->input->post('appURL')),
				'user_ip' => $deviceData['ip_address'],
				'date' => date('Y-m-d H:i:s'),
				'token' => '',
				'established_date' => $this->input->post('established_date') ?? "",
				'monetized_since' => $this->input->post('monetized_since') ?? "",
				'six_months_revenue' => $this->input->post('six_months_revenue') ?? "",
				'six_months_profit' => $this->input->post('six_months_profit') ?? "",
				'monthly_visitors' => $this->input->post('monthly_visitors') ?? "",
				'slug' => $this->input->post('slug'),
			);


			$dataUp = array(
				'website_tagline' => $this->input->post('website_tagline'),
				'website_metadescription' => $this->input->post('website_metadescription'),
				'website_age' => $this->input->post('website_age'),
				'business_registeredCountry' => $this->input->post('business_registeredCountry'),
				'description' => $this->input->post('editordata'),
				'website_industry' => $this->input->post('website_industry'),
				'last12_monthsrevenue' => $this->input->post('last12_monthsrevenue') ?? '',
				'last12_monthsexpenses' => $this->input->post('last12_monthsexpenses') ?? '',
				'annual_profit' => $this->input->post('annual_profit') ?? '',
				'website_how_make_money' => $this->input->post('website_how_make_money') ?? '',
				'website_purchasing_fulfilment' => $this->input->post('website_purchasing_fulfilment'),
				'website_whyselling' => $this->input->post('website_whyselling'),
				'website_suitsfor' => $this->input->post('website_suitsfor'),
				'monthly_downloads' => $this->input->post('monthly_downloads'),
				'screenshot' => '',
				'slug' => $this->input->post('slug'),

				'website_minimumoffer' => 	!empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
				'website_buynowprice' =>  !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],
				'website_discountprice' => !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],

				'original_minimumoffer' => $commission['original_minimumoffer'],
				'original_buynowprice' => $commission['original_buynowprice'],
				'original_discountprice' => $commission['original_discountprice'],

				'commission_type'   => $commission['commission_type'] ?? 0,
				'commission_user_product' => $commission['commission_user_product'] ?? 0,

				'commission_amount' => $commission['commission_amount'],
			);
		} else if ($this->input->post('listing_type') === 'business') {

			if (!empty($_FILES['uploadListingImage']['name'])) {
				if ($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === TRUE) {
					$thumbnailCover = $this->upload__image('uploadListingImage');
				}
			}

			if (!empty($_FILES['uploadThumbnailImage']['name'])) {
				if ($this->security->xss_clean($_FILES['uploadThumbnailImage']['name'], TRUE) === TRUE) {
					$thumbnail = $this->upload__image('uploadThumbnailImage');
				}
			}

			if (!empty($_FILES['uploadVisual']['name'])) {
				if ($this->security->xss_clean($_FILES['uploadVisual']['name'], TRUE) === TRUE) {
					$uploadVisual = $this->upload__files('uploadVisual');
				}
			}

			if (!empty($_FILES['uploadProfitLoss']['name'])) {
				if ($this->security->xss_clean($_FILES['uploadProfitLoss']['name'], TRUE) === TRUE) {
					$uploadProfitLoss = $this->upload__files('uploadProfitLoss');
				}
			}

			if (empty($this->input->post('listing_id'))) {
				if ($this->input->post('website_1_group_2') === 'classified') {
					$listing_option = 'classified';
				} else if ($this->input->post('website_1_group_2') === 'auction') {
					$listing_option = 'auction';
				}
			} else {
				$listing_option = $this->input->post('listing_option');
			}

			$extesnion = explode(".", $this->input->post('website_BusinessName'));
			$screenshot = '';

			if (!empty($this->input->post('monetization_through'))) {
				$monetization_through = implode(",", $this->input->post('monetization_through'));
			} else {
				$monetization_through = '';
			}

			$data = array(
				'domain_id' => $this->input->post('domain_id'),
				'listing_type' => $this->input->post('listing_type'),
				'user_id' => $this->session->userdata('user_id'),
				'website_BusinessName' => $this->input->post('website_BusinessName'),
				'extension' => end($extesnion),
				'established_date' => $this->input->post('established_date') ?? "",
				'monetized_since' => $this->input->post('monetized_since') ?? "",
				'six_months_revenue' => $this->input->post('six_months_revenue') ?? "",
				'six_months_profit' => $this->input->post('six_months_profit') ?? "",
				//'traffic_sources' =>  "",
				//'monthly_visitors' =>  "",
				//'monetization_through' => "",
				//'website_status' => "",
				'website_age' => "",
				'business_registeredCountry' => $this->input->post('business_registeredCountry'),
				'city' => $this->input->post('city'),
				'website_industry' => $this->input->post('website_industry'),
				'monetization_methods' => 'N/A',
				'last12_monthsrevenue' => $this->input->post('last12_monthsrevenue') ?? '',
				'last12_monthsexpenses' => $this->input->post('last12_monthsexpenses') ?? '',
				'annual_profit' => $this->input->post('annual_profit') ?? '',
				'google_verified' => 0,
				'website_facebook' => $this->input->post('website_facebook') ?? "",
				'website_twitter' => $this->input->post('website_twitter') ?? "",
				'website_instagram' => $this->input->post('website_instagram') ?? "",

				'financial_uploadVisual' => $uploadVisual,
				'financial_uploadProfitLoss' => $uploadProfitLoss,
				'website_tagline' => $this->input->post('website_tagline') ?? '',
				'website_metadescription' => $this->input->post('website_metadescription') ?? '',
				'website_metakeywords' => $this->input->post('website_metakeywords') ?? '',
				'description' => $this->input->post('editordata'),
				'website_how_make_money' => $this->input->post('website_how_make_money') ?? '',
				'website_purchasing_fulfilment' => $this->input->post('website_purchasing_fulfilment') ?? '',
				'website_whyselling' => $this->input->post('website_whyselling') ?? '',
				'website_suitsfor' => $this->input->post('website_suitsfor') ?? '',
				'website_thumbnail' =>  $thumbnail,
				'screenshot' => $screenshot,
				'website_cover' => $thumbnailCover,
				'status' => 0,
				'sold_status' => 0,
				'deliver_in' => $this->input->post('deliver_in'),
				'listing_option' => $listing_option,
				'website_startingprice' => $this->input->post('website_startingprice') ?? 0,
				'website_reserveprice' => $this->input->post('website_reserveprice') ?? 0,

				'website_minimumoffer' => 	!empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
				'website_buynowprice' =>  !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],
				'website_discountprice' => !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],

				'original_minimumoffer' => $commission['original_minimumoffer'],
				'original_buynowprice' => $commission['original_buynowprice'],
				'original_discountprice' => $commission['original_discountprice'],

				'commission_type'   => $commission['commission_type'] ?? 0,
				'commission_user_product' => $commission['commission_user_product'] ?? 0,

				'commission_amount' => $commission['commission_amount'],


				'monthly_downloads' => 0,
				'app_url' => "n/a",
				'app_market' => "n/a",
				'user_ip' => $deviceData['ip_address'],
				'date' => date('Y-m-d H:i:s'),
				'token' => '',
				'slug' => $this->input->post('slug'),

			);

			$dataUp = array(
				'website_tagline' => $this->input->post('website_tagline'),
				'website_metadescription' => $this->input->post('website_metadescription'),
				'website_status' => $this->input->post('website_status'),

				'business_registeredCountry' => $this->input->post('business_registeredCountry'),
				'city' => $this->input->post('city'),
				'description' => $this->input->post('editordata'),
				'website_industry' => $this->input->post('website_industry'),

				'last12_monthsrevenue' => $this->input->post('last12_monthsrevenue') ?? '',
				'last12_monthsexpenses' => $this->input->post('last12_monthsexpenses') ?? '',
				'annual_profit' => $this->input->post('annual_profit') ?? '',

				'website_how_make_money' => $this->input->post('website_how_make_money') ?? '',
				'website_purchasing_fulfilment' => $this->input->post('website_purchasing_fulfilment'),
				'website_whyselling' => $this->input->post('website_whyselling'),
				'website_suitsfor' => $this->input->post('website_suitsfor'),
				'slug' => $this->input->post('slug'),

				'website_minimumoffer' => 	!empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
				'website_buynowprice' =>  !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],
				'website_discountprice' => !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],

				'original_minimumoffer' => $commission['original_minimumoffer'],
				'original_buynowprice' => $commission['original_buynowprice'],
				'original_discountprice' => $commission['original_discountprice'],

				'commission_type'   => $commission['commission_type'] ?? 0,
				'commission_user_product' => $commission['commission_user_product'] ?? 0,

				'commission_amount' => $commission['commission_amount'],

			);
		}


		if (empty($this->input->post('listing_id'))) {
			$data = $this->security->xss_clean($data);
			$data['id']  = $this->database->_insert_to_DB('tbl_listings', $data);
			if (!empty($data['id'])) {
				$output['response']  =  $data;
				exit(json_encode($output));
			} else {
				$output['response']  =  false;
				exit(json_encode($output));
			}
		} else {
			if (!empty($thumbnailCover)) {
				$dataUp['website_cover'] = $thumbnailCover;
			}
			if (!empty($thumbnail)) {
				$dataUp['website_thumbnail'] = $thumbnail;
			}
			if (!empty($uploadVisual)) {
				$dataUp['financial_uploadVisual'] = $uploadVisual;
			}
			if (!empty($uploadProfitLoss)) {
				$dataUp['financial_uploadProfitLoss'] = $uploadProfitLoss;
			}
			//
			//$dataUp = array_map("html_entity_decode", html_escape($this->security->xss_clean($dataUp)));
			$output['response']  =  $this->database->_update_to_DB('tbl_listings', $dataUp, $this->input->post('listing_id'));
			exit(json_encode($output));
		}
	}

	public function loadPartialAjaxView()
	{
		$page = $this->input->post('page');
		$data = array();  //data for this contents view
		if ($page == 'user/includes/_business_established') {
			$data['monetization_through']	=	$this->database->_get_row_data('tbl_common', array('options' => 'monetization_method'));
		}
		$response 			= $this->load->view($page, $data, TRUE);
		$data['response'] 	= $response;
		$data['token'] 		= $this->security->get_csrf_hash();
		echo json_encode($data);
	}


	public function subCategorySolution()
	{
		$categoryId =  $this->input->post('categoryId');
		$data['subCategories']    =  $this->database->_get_row_data('tbl_solution_categories', array('parent_id' => $categoryId));
		$data['token'] 		= $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode($data));
	}

	public function createSolutions($type, $id = "")
	{

		// pre($this->database->getLatestImage('437'));

		if (!empty($type) && $type === 'solution') {
			$data = self::$data;
			// -----backup use data--------------
			/*$data['listingOptions']						=	$this->database->_get_row_data('tbl_listing_header',array('listing_type'=>$type));
			$data['sponsorOptions']						=	$this->database->_get_row_data('tbl_listing_header',array('listing_type'=>'sponsored'));

			if(!empty($id)){
				$data['listing_data']					=	$this->database->_get_row_data('tbl_listings',array('id'=>$id,'listing_type'=>$type,'status'=>0,'user_id'=>$this->session->userdata('user_id')),'',false);
				if(!empty($data['listing_data'])){
					$data['domainData']					=	$this->database->_get_row_data('tbl_domains',array('id'=>$data['listing_data'][0]['domain_id']));
				}
				else
				{
					redirect(base_url().'user/manage_listings');
					return;
				}
			}*/
			if (!empty($id)) {
				$data['solution_data']	= $this->database->_get_solutionById($id, $this->session->userdata('user_id'));

				$listData	=	$this->database->_get_row_data('tbl_listings', ['solution_id' => $data['solution_data']['solution'][0]['id']]);
				// pre($listData,1);

				$data['list_id']  	=  @$listData[0]["id"];
				$data['domain_id']  =  @$listData[0]["domain_id"];
				$data['soln_title'] = "Edit solutions";
				if (isset($data['solution_data']['solution'][0]['category_id'])) {
					$data['subCategories']    =  $this->database->_get_row_data('tbl_solution_categories', array('parent_id' => $data['solution_data']['solution'][0]['category_id']));
				}
			} else {
				$data['soln_title'] = "Create solutions";
				$data['listingOptions']	=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => 'solution'));
				$data['sponsorOptions']	=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => 'sponsored'));

			}

			$data['mainCategories']    =  $this->database->_get_row_data('tbl_solution_categories', array('parent_id' => 0));
			$data['serviceTypes']      =  $this->database->_get_row_data('tbl_solution_service_types', []);
			//$data = html_escape($this->security->xss_clean($data));
			$this->load->view('user/create-solution-listings', $data);
			return;
		}
		$this->pageNotFound();
	}

	public function addSolutionToList($udata)
	{

		$list_id = $udata['list_id'] ?? 0;
		if (!empty($list_id)) {

			$data = [];

			if (!empty($udata['website_minimumoffer'])) {
				$data['website_minimumoffer'] = $udata['website_minimumoffer'];
			}

			if (!empty($udata['original_minimumoffer'])) {
				$data['original_minimumoffer'] = $udata['original_minimumoffer'];
			}

			if (!empty($udata['original_buynowprice'])) {
				$data['original_buynowprice'] = $udata['original_buynowprice'];
			}

			if (!empty($udata['original_discountprice'])) {
				$data['original_discountprice'] = $udata['original_discountprice'];
			}

			if (!empty($udata['commission_type'])) {
				$data['commission_type'] = $udata['commission_type'];
			}

			if (!empty($udata['commission_user_product'])) {
				$data['commission_user_product'] = $udata['commission_user_product'];
			}

			if (!empty($udata['commission_amount'])) {
				$data['commission_amount'] = $udata['commission_amount'];
			}
			if (!empty($udata['website_BusinessName'])) {
				$data['website_BusinessName'] = $udata['website_BusinessName'];
			}

			if (!empty($udata['website_buynowprice'])) {
				$data['website_buynowprice'] =  $udata['website_buynowprice'];
			}

			if (!empty($udata['website_discountprice'])) {
				$data['website_discountprice'] =  $udata['discount'];
			}

			if (!empty($udata['deliver_in'])) {
				$data['deliver_in'] =  $udata['deliver_in'];
			}
			if (!empty($data)) {
				// pre($udata);
				// pre($data,1);
				$this->database->_update_to_DB('tbl_listings', $data, $list_id);
			}
		} else {

			$data = [
				'domain_id' => $udata['domain_id'],
				'listing_type' => $udata['listing_type'],
				'user_id' => $udata['user_id'],
				'website_BusinessName' => $udata['website_BusinessName'],
				'extension' => 'aa',
				'established_date' => "aa",
				'monetized_since' => "aa",
				'six_months_revenue' =>  "aa",
				'six_months_profit' =>  "aa",
				'traffic_sources' => "aa",
				'monthly_visitors' => "aa",
				'sales_support' => 'aa',
				'website_facebook' =>  "aa",
				'website_twitter' => "aa",
				'website_instagram' =>  "aa",
				'monetization_through' => 'aa',
				'website_status' => 'aa',
				'website_age' => 'aa',
				'business_registeredCountry' => 'aa',
				'website_industry' => '0',
				'monetization_methods' => 'N/A',
				'last12_monthsrevenue' => 'aa',
				'last12_monthsexpenses' => 'aa',
				'annual_profit' => 'aa',
				'google_verified' => 0,
				'financial_uploadVisual' => 'aa',
				'financial_uploadProfitLoss' => 'aa',
				'website_tagline' => 'aa',
				'website_metadescription' => 'aa',
				'website_metakeywords' => 'aa',
				'description' => 'aa',
				'website_how_make_money' => "aa",
				'website_purchasing_fulfilment' =>  "aa",
				'website_whyselling' =>  "aa",
				'website_suitsfor' => "aa",
				'website_thumbnail' =>  'aa',
				'screenshot' => 'aa',
				'website_cover' => 'aa',
				'status' => 1,
				'sold_status' => 0,
				'deliver_in' => 0,
				'listing_option' => 'aa',
				'website_startingprice' => 0,
				'website_reserveprice' => 0,
				'website_minimumoffer' => 0,
				'solution_id' => $udata['solution_id'],
				'website_buynowprice' =>  $udata['price'] ?? 0, // buy now price
				'website_discountprice' =>  $udata['discount'] ?? 0, // discount price
				'website_minimumoffer'	=> 	$udata['original_minimumoffer'] ?? 0,
				'website_discountprice' 	=> $udata['original_discountprice'] ?? 0,
				'original_minimumoffer' 	=> $udata['original_minimumoffer'] ?? 0,
				'original_buynowprice'		=> $udata['original_buynowprice'] ?? 0,
				'original_discountprice'	=> $udata['original_discountprice'] ?? 0,
				'commission_type'   		=> $udata['commission_type'] ?? 0,
				'commission_user_product' 	=> $udata['commission_user_product'] ?? 0,
				'commission_amount' 		=> $udata['commission_amount'] ?? 0,
				'monthly_downloads' => 0,
				'app_url' => "n/a",
				'app_market' => "n/a",
				'user_ip' => $udata['user_ip'],
				'date' => date('Y-m-d H:i:s'),
				'token' => '',

			];
			// pre($data,1);

			return $this->database->_insert_to_DB('tbl_listings', $data);
		}
	}
	public function addSolution($solution_id = "")
	{

		$deviceData     	= $this->common->detectVisitorDevice();
		$output['token']  	= $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		$list = [];
		if ($this->input->post('step') == 1) {
			if (empty($this->input->post('solution_id'))) {

				$user =  	$this->database->getUserData($this->session->userdata('user_id'));
				$commission_type = $user[0]['commission_type'];
				$commission_user_product =  1;
				$commission_amount = 0;
				$admin_commission = $user[0]['admin_commission'];
				$commission_amount =  $admin_commission;
			
				$data = array(
					'name' => $this->input->post('name'),
					'solution_url' => $this->input->post('solution_url') ?? '',
					'slug' => $this->input->post('slug'),
					'description' => $this->input->post('description'),
					'user_id' => $this->session->userdata('user_id'),
					'user_ip' => $deviceData['ip_address'],
					'date' => date('Y-m-d H:i:s'),
					'status' => 9,
					'commission_type'=> !empty($commission_type) ? $commission_type : 1,
					'commission_user_product'=> $commission_user_product,
					'commission_amount'=> !empty($commission_amount) ? $commission_amount : 0
				);

				$token  = $this->common->_generate_unique_tokens('tbl_domains');
				$dataIns = array(
					'domain' => $data['name'],
					'category_id' => 2,
					'user_id' => $this->session->userdata('user_id'),
					'status' => 0,
					'token' => $token,
					'date' => date('Y-m-d H:i:s')
				);
				// $dataIns = $this->security->xss_clean($dataIns);
				$domain_id  = $this->database->_insert_to_DB('tbl_domains', $dataIns);
				$list = [
					'website_BusinessName' => $data['name'],
					'user_id' => $data['user_id'],
					'user_ip' => $data['user_ip'],
					'listing_type' => 'solution',
					'domain_id' => $domain_id,
					'status' => '1',
				];
			} else {
				$dataUp = array(
					'name' => $this->input->post('name'),
					'solution_url' => $this->input->post('solution_url') ?? '',
					'description' => $this->input->post('description'),
					'slug' => $this->input->post('slug'),
				);

				$token  = $this->common->_generate_unique_tokens('tbl_domains');
				$dataUpDomain = array(
					'domain' => $dataUp['name'],
				);
				$this->database->_update_to_DB('tbl_domains', $dataUpDomain, $this->input->post('domain_id'));
				if (!empty($this->input->post('list_id'))) {
					$list = [
						'website_BusinessName' => $dataUp['name'],
						'list_id' => $this->input->post('list_id'),
					];
				} else if (empty($this->input->post('list_id'))) {


					$list['status'] 				=  '9';
					$list['user_ip'] 				= $deviceData['ip_address'];
					$list['user_id'] 				= $this->session->userdata('user_id');
					$list['domain_id']   			= $this->input->post('domain_id');
					$list['status']    				= 1;
					$list['website_BusinessName'] 	= $dataUp['name'];
					$list['listing_type'] 			= 'solution';
					$list['date'] 			        = date('Y-m-d H:i:s');
					$list['solution_id']    		= $this->input->post('solution_id');
					$data['list_id'] 				= $this->addSolutionToList($list);
					$this->database->_update_to_DB('tbl_listings', ['solution_id' => $data['id']], $data['list_id']);
				}
			}
		}

		if ($this->input->post('step') == 3) {
			if (!empty($this->input->post('solution_id'))) {
				$dataUp = array(
					'category_id' => $this->input->post('category_id') ?? '',
					'sub_category_id' => $this->input->post('sub_category_id') ?? '',
					'service_type_id' => $this->input->post('service_type_id'),
				);

				$list = [
					'list_id' => $this->input->post('list_id'),
				];
			}
		}


		if ($this->input->post('step') == 4) {
			if (!empty($this->input->post('solution_id'))) {
				if (!empty($this->input->post('display_on_page'))) {
					$display_on_page = implode(",", array_filter($this->input->post('display_on_page')));
					$section = $this->input->post('frontend_section');
				}

				// calculate the commission user or product wise... 
				$commission = $this->CommissionUserOrProductWise();
				$dataUp = array(
					// 'price' => $this->input->post('price'),
					'delivery_days'		=> $this->input->post('delivery_days') ?? 0,
					"display_on_page"	=> $display_on_page ?? '',
					'frontend_section' 	=> $section ?? '',
					'title' 			=> $this->input->post('title'),
					'metadescription' 	=> $this->input->post('metadescription'),
					'metakeywords'  	=> $this->input->post('metakeywords'),


					'price' 			=>  !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],

					'original_minimumoffer' 	=> $commission['original_minimumoffer'],
					'original_buynowprice'		=> $commission['original_buynowprice'],
					'original_discountprice'	=> $commission['original_discountprice'],
					'commission_type'   		=> $commission['commission_type'] ?? 0,
					'commission_user_product' 	=> $commission['commission_user_product'] ?? 0,
					'commission_amount' 		=> $commission['commission_amount'] ?? 0,
				);

				$list = [
					'list_id' 				=> $this->input->post('list_id'),
					'website_buynowprice'	=> $dataUp['price'],
					'deliver_in' 			=> $dataUp['delivery_days'],
					'website_minimumoffer'		 => 	!empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
					'website_discountprice' 	=> !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],
					'original_minimumoffer' 	=> $commission['original_minimumoffer'],
					'original_buynowprice'		=> $commission['original_buynowprice'],
					'original_discountprice'	=> $commission['original_discountprice'],
					'commission_type'   		=> $commission['commission_type'] ?? 0,
					'commission_user_product' 	=> $commission['commission_user_product'] ?? 0,
					'commission_amount' 		=> $commission['commission_amount'] ?? 0,


				];
			}
		}


		if (empty($this->input->post('solution_id'))) {
			//$data = $this->security->xss_clean($data);
			$data['id']  			= $this->database->_insert_to_DB('tbl_solutions', $data);
			$list['solution_id']    = $data['id'];
			$data['list_id'] 		= $this->addSolutionToList($list);
			$this->database->_update_to_DB('tbl_listings', ['solution_id' => $data['id']], $data['list_id']);
			$data['domain_id'] 		= $domain_id;

			if (!empty($data['id'])) {
				$output['response']  =  $data;
				exit(json_encode($output));
			} else {
				$output['response']  =  false;
				exit(json_encode($output));
			}
		} else {
			//$dataUp = array_map("html_entity_decode", html_escape($this->security->xss_clean($dataUp)));
			$output['response']  	=  $this->database->_update_to_DB('tbl_solutions', $dataUp, $this->input->post('solution_id'));
			$this->addSolutionToList($list);

			$data['id'] 			=  $this->input->post('solution_id');
			$data['list_id'] 		=  $this->input->post('list_id');
			$data['domain_id'] 		= $this->input->post('domain_id');
			$output['response'] 	= $data;
			exit(json_encode($output));
		}
	}

	public function deleteTempMedia()
	{

		$fullPath =  IMAGES_UPLOAD . $this->input->get('file');
		unlink($fullPath);
		// if (file_exists($fullPath)) {
		// 	unlink($fullPath);
		// 	$data['file_delete'] = $fullPath;
		// }
	}

	public function uploadSolutionMedia($path = IMAGES_UPLOAD)
	{
		set_time_limit(0);
		ini_set('memory_limit', '6000M');
		ini_set('post_max_size', '500M');
		ini_set('upload_max_filesize', '500M');
		$this->load->library("upload");
		$this->load->helper("file");
		//-----------------------

		//----------------------------

		$deviceData     	         = $this->common->detectVisitorDevice();
		$config['upload_path']       = $path;
		// $config['allowed_types']     = 'doc|docx|jpg|png|jpeg|pdf|mp4|ogg|mov|3gp|wmv|xls|xlsx|txt|avi';
		$config['allowed_types']     = 'jpg|png|jpeg';
		$config['max_size']          = 104857600;
		$this->upload->initialize($config);
		$this->upload->overwrite     = false;
		$nameBox 					 = $_FILES;
		$errorUploadType 			 = '';
		$uploadData 				 = [];
		$filesCount 				 = count($nameBox['file']['name'], true);
		if (!empty($nameBox['file']['name'])) {
			for ($i = 0; $i < $filesCount; $i++) {
				$_FILES['file']['name']     = $nameBox['file']['name'][$i];
				$_FILES['file']['type']     = $nameBox['file']['type'][$i];
				$_FILES['file']['tmp_name'] = $nameBox['file']['tmp_name'][$i];
				$_FILES['file']['error']     = $nameBox['file']['error'][$i];
				$_FILES['file']['size']     = $nameBox['file']['size'][$i];

				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				$imgArr = ['jpg', 'png', 'jpeg'];

				if (in_array($ext, $imgArr)) {
					$img = getimagesize($_FILES['file']['tmp_name']);
					$minimum = array('width' => '500', 'height' => '200');
					$width = $img[0];
					$height = $img[1];
					if ($width < $minimum['width']) {
						$errorUploadType .= "Image dimensions are too small. Minimum width is {$minimum['width']}px and height is {$minimum['height']} px.  Uploaded image width is $width px and height is $height px | ";
					} elseif ($height <  $minimum['height']) {
						$errorUploadType .= "Image dimensions are too small. Minimum width is {$minimum['width']}px and height is {$minimum['height']} px. Uploaded image width is $width and height is $height px ";
					}
				}
				// Upload file to server 
				if ($this->upload->do_upload('file') && empty($errorUploadType)) {

					// Uploaded file data 
					$fileData = $this->upload->data();
					$uploadData[$i]['file_name'] = $fileData['file_name'];
					$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
					$form_data = [
						'solution_id' =>  $this->input->post('id'),
						'name' =>  $fileData['file_name'],
						'mime' =>  $fileData['file_type'],
						'ext' =>  $fileData['file_ext'],
						'user_ip'   =>  $deviceData['ip_address'],
						'date' =>  date('Y-m-d H:i:s'),
					];

					$solutionImgId = 	$this->database->_insert_to_DB('tbl_solution_media', $form_data);
				} else {

					$errorUploadType .= $_FILES['file']['name'];
				}
			}
		} else {
			$statusMsg = 'Please select image files to upload.';
		}

		// $data['images'] = $this->database->_get_row_data('tbl_solution_media', ['solution_id' => $this->input->post('id')]);

		$data['solution_data'] = $this->database->_get_row_data('tbl_solution_media', ['solution_id' => $this->input->post('id')]);
		// _get_single_data($table_name, $data, $returnVal)

		if (!empty($this->database->getLatestImage($this->input->post('id'))[0])) {
			$data['latest_image'] = $this->database->getLatestImage($this->input->post('id'))[0];
		}

		// add image on upload ajax

		$data['img_div']    = $this->load->view('user/includes/_solution_media_ajax.php', $data, TRUE);

		$data['errorUploadType'] = $errorUploadType;
		$data['uploadData'] = $uploadData;
		$data['token'] = $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode($data));
	}
	public function deleteSolutionMedia()
	{

		$id = $this->input->post('solution_id');
		if (!empty($id)) {

			// get file name from db
			$image_name = $this->database->_get_single_data('tbl_solution_media', array('id' => $id), 'name');
			// full path of image
			$fullPath =  IMAGES_UPLOAD . $image_name;

			// delete entry folder from tbl_solution_media table
			$result = $this->database->_delete_from_table('tbl_solution_media', array('id' => $id));
			$data['images'] = $this->database->_get_row_data('tbl_solution_media', ['solution_id' => $this->input->post('id')]);

			// if deleted then remove file from folder
			if ($result ==  1) {
				// if file exists the delete file
				if (file_exists($fullPath)) {
					unlink($fullPath);
					$data['file_delete'] = $fullPath;
				}
			}
		}
		$name = $this->input->post('name');

		if (!empty($name)) {


			// full path of image
			$fullPath =  IMAGES_UPLOAD . $name;

			// delete entry folder from tbl_solution_media table
			$result = $this->database->_delete_from_table('tbl_solution_media', array('name' => $name));

			// if deleted then remove file from folder
			if ($result ==  1) {
				// if file exists the delete file
				if (file_exists($fullPath)) {
					unlink($fullPath);
					$data['file_delete'] = $fullPath;
				}
			}
		}

		$data['token'] = $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode($data));
	}

	public function deleteSolution()
	{
		$id = $this->input->post('solution_id');
		if ($id) {
			// get file name from db
			$image_name = $this->database->_get_single_data('tbl_solution_media', array('id' => $id), 'name');
			// full path of image
			$fullPath =  IMAGES_UPLOAD . $image_name;
			//delete from database first 
			$result = $this->database->_delete_from_table('tbl_solutions', array('id' => $id));
			if ($result) {
				$data['status'] = 1;
				if (isset($image_name) &&  !empty(isset($image_name))) {
					// if file exists the delete file
					if (file_exists($fullPath)) {
						unlink($fullPath);
						$data['file_delete'] = $fullPath;
					}
				}
			} else {
				$data['status'] = 2;
			}
		}
		$data['token'] = $this->security->get_csrf_hash();
		header('Content-Type: application/json');
		exit(json_encode($data));
	}


	/*solutions list pagination creator*/
	public function solutions_pagination_loader()
	{

		$config = array();
		$config["base_url"] 					= site_url('user/manage_solutions');
		$config["total_rows"] 					= $this->database->_results_count('tbl_solutions', array('user_id' => $this->session->userdata('user_id')), true);
		$config["per_page"] 					= PERPAGE;
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


	public function admin_login()
	{
		$this->deleteFileCache();
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_level');
		$this->session->unset_userdata('role');
		$this->database->backAdminLogin();
		redirect(site_url('admin/user_control'));
	}

	public function becomeExpert()
	{
		$data = self::$data;
		$data['user'] = $this->database->getExpertById($this->session->userdata('user_id'));
		$this->load->view('user/become_expert', $data);
	}

	public function addProfileBecomeExpert()
	{
		$output['token']       = $this->security->get_csrf_hash();
		header('Content-Type: application/json');

		if (!empty($_FILES['uploadThumbnailImage']['name'])) {
			if ($this->security->xss_clean($_FILES['uploadThumbnailImage']['name'], TRUE) === TRUE) {
				$thumbnail = $this->upload__image('uploadThumbnailImage');
			}
		}
		$rdata = $this->input->post();
		if ($this->input->post('id') !== null && !empty($this->input->post('id'))) {
			$UpData = [
				'profile_name' => $rdata['profile_name'],
				'slug' => $rdata['slug'],
				'user_id' =>  $this->session->userdata('user_id'),
				'name' => $rdata['name'],
				'type' => $rdata['type'],
				'specialization' => $rdata['specialization'],
				'description' => $rdata['description'],
				'year' => $rdata['year'],
				'month' => $rdata['month'],
				'availability' => $rdata['availability'] ? implode(',', $rdata['availability']) : '',
				'solution_category' => $rdata['solution_category'],
				'service_type' => $rdata['service_type'],
				'service_offered' => $rdata['service_offered'],
				'rate' => $rdata['rate'],
				'rate_time' => $rdata['rate_time'],
				'business_registeredCountry' => $rdata['business_registeredCountry'],
				'city' => $rdata['city'],
				'status' => 1,
				'admin_approved' => 0,
				'updated_date' => date('Y-m-d H:i:s'),
			];

			if (!empty($thumbnail)) {
				$UpData = array_merge($UpData, ['profile_image' => $thumbnail]);
			}
			$this->database->_update_to_DB('tbl_expert_directory', $UpData, $rdata['id']);
			$this->session->set_flashdata('expert_msg', 'Updated Record Successfully');
			redirect("user/become-expert");
		} else {
			$data = [
				'profile_name' => $rdata['profile_name'],
				'slug' => $rdata['slug'],
				'name' => $rdata['name'],
				'user_id' =>  $this->session->userdata('user_id'),
				'type' => $rdata['type'],
				'specialization' => $rdata['specialization'],
				'year' => $rdata['year'],
				'month' => $rdata['month'],
				'description' => $rdata['description'],
				'availability' => $rdata['availability'] ? implode(',', $rdata['availability']) : '',
				'solution_category' => $rdata['solution_category'],
				'service_type' => $rdata['service_type'],
				'service_offered' => $rdata['service_offered'],
				'rate' => $rdata['rate'],
				'rate_time' => $rdata['rate_time'],
				'business_registeredCountry' => $rdata['business_registeredCountry'],
				'city' => $rdata['city'],
				'profile_image' => $thumbnail ?? '',
				'status' => 1,
				'admin_approved' => 0,
				'created_date' => date('Y-m-d H:i:s'),
				'updated_date' => date('Y-m-d H:i:s'),
			];
			$this->database->_insert_to_DB('tbl_expert_directory', $data);
			$this->session->set_flashdata('expert_msg', 'Insert Record Successfully');
			redirect("user/become-expert");
		}
	}

	public function userMembershipList()
	{
		$data    = self::$data;
		$data['membership_details']  =  $this->database->getCurrentMembershipPlan($this->session->userdata('user_id'));
		// $data['membership_history'] =  $this->database->getMembershipPlanHistory($this->session->userdata('user_id'), $data['membership_details'][0]['membership_level']);
		$data['all_plans'] = $this->database->_get_row_data('tbl_membership_level', '');

		$data['membership_history'] =  $this->database->getMembershipPlanHistory($this->session->userdata('user_id'));

		$this->load->view('user/membership_user', $data);
	}
}
