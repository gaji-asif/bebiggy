<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);

class Authpermission extends CI_Controller
{

    private static $data = array();

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('helperssl'));

        $this->load->model('DatabaseOperationsHandler', 'database');
        $this->load->model('CommonOperationsHandler', 'common');
        $this->common->is_logged_admin();

        self::$data['options']                          =   $this->database->_get_row_data('tbl_platforms', array('type' => 'option', 'status' => 1, 'platform' => 'classified'));
        self::$data['listingCount']                     =   $this->database->_count_listings_user_wise('auction');
        self::$data['listingOfferCount']                =   $this->database->_count_listings_user_wise('classified');
        self::$data['listingSolutionCount']             =   $this->database->_count_solution_listings_user_wise();
        self::$data['messageCount']                     =   $this->chat->get_unviewed_msg($this->session->userdata('user_id'));
        self::$data['openContracts']                    =   $this->database->_get_my_contracts();
        self::$data['closeContracts']                   =   $this->database->_get_my_contracts(false);

        self::$data['settings']                         =   $this->database->getSettingsData();
        self::$data['platforms']                        =   $this->database->_get_row_data('tbl_platforms', array('type' => 'listing'));
        self::$data['platforms']                        =   $this->database->_get_row_data('tbl_platforms', array('type' => 'option'));
        self::$data['plugins']                          =   $this->database->_get_row_data('tbl_platforms', '');
        self::$data['languages']                        =   $this->database->load_all_languages();
        self::$data['default_currency']                 =   $this->common->getCurrency($this->database->_get_single_data('tbl_currencies', array('default_status' => '1'), 'currency'), 'symbol');
        self::$data['language']                         =   $this->database->_get_single_data('tbl_languages', array('default_status' => 1), 'language_code');
        self::$data['userdata']                         =     $this->database->getUserData($this->session->userdata('user_id'));
        self::$data['announcements']                    =   $this->database->_get_row_data('tbl_announcement', array('status' => 1));
        self::$data['disputes']                         =   $this->database->_get_disputes_data(0);
        self::$data['imagesData']                       =   $this->database->_get_row_data('tbl_siteimages', array('id' => 1));
        self::$data['ads']                              =   $this->database->_get_row_data('tbl_ads', array('id' => 1));
        self::$data['email_settings']                   =   $this->database->_get_row_data('tbl_email_settings', array('id' => 1));
        self::$data['token']                            =   $this->security->get_csrf_hash();
        self::$data['categoriesData']                   =    $this->database->_count_listings_categories_wise();

        if (self::$data['settings'][0]['ssl_enable'] === '1') {
            force_ssl();
        }

       

        
    }
    public function index()
    {
        $data = self::$data;
        $this->load->view('admin/unauthorized', $data);
        return false;
    }
}