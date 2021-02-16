<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);

class Admin extends CI_Controller
{

    private static $data = array();

    function __construct()
    {
        parent::__construct();        

        $this->load->helper(array('helperssl'));
        $this->load->library('form_validation');

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

    public function checkPermission()
    {
        // if (!checkRoutePermission()) {
        //     redirect('authpermission');
        // }
    }

    public function index()
    {

       
        $data = self::$data;
        $data['TU']                = $this->database->_results_count('tbl_users', array('user_level' => 1), true);
        $data['TE']                = $this->get_totalearnings();
        $data['ME']                = $this->get_totalearnings();
        $data['OC']                = $this->database->_multiple_results_count('tbl_opens', 'status', array(0, 1, 2, 5, 6, 8, 9), true);
        $data['TL']                = $this->database->_results_count('tbl_listings', array('status' => 1), true);
        $data['contracts']      = $this->database->_get_recent_contract();
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/dashboard', $data);
        return;
    }

    /*pending to mark as complete*/
    public function pending_completes()
    {
        $this->checkPermission();
        $data = self::$data;
        $data['pendings']        =    $this->database->_markAsCompletedAuto();
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/pending_complete', $data);
        return;
    }

    /*User Control*/
    public function user_control()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $data['badges']     =   $this->database->_get_row_data('tbl_badges', []);
        $this->load->view('admin/user-control', $data);
        return;
    }

    /*Ads Control*/
    public function ads_manager()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/ads-manager', $data);
        return;
    }

    /*pages manager*/
    public function pages_manager()
    {
        $this->checkPermission();

        $data = self::$data;
        $data['pages']        =    $this->database->_get_row_data('tbl_pages', array('page_visibility_status' => 1), '');
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/pages_manager', $data);
        return;
    }

    /*Cron Jobs Manager*/
    public function cron_jobs()
    {
        $this->checkPermission();
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/cron-jobs', $data);
        return;
    }

    /*Bulk Upload*/
    public function bulk_upload()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/bulk-upload', $data);
        return;
    }

    // /*About Developers*/
    // public function about_developers()
    // {
    //     $this->checkPermission();

    //     $data = self::$data;
    //     $data = html_escape($this->security->xss_clean($data));
    //     $this->load->view('admin/about-developers', $data);
    //     return;
    // }

    /*Reported Listings*/
    public function reported_listings()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/reported-listings', $data);
        return;
    }

    /*Announcement Manager*/
    public function announcement_control()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/announcement-control', $data);
        return;
    }

    /*Category Manager*/
    public function category_control()
    {
        //$this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/category-manager', $data);
        return;
    }

    /*Monetization Manager*/
    public function monetization_control()
    {
        $this->checkPermission();
        $data = self::$data;
        $this->load->view('admin/monetization-manager', $data);
        return;
    }

    /*Monetization Manager*/
    public function category_solution()
    {
        $this->checkPermission();

        $data = self::$data;
        $data['mainCategories']    =  $this->database->_get_row_data('tbl_solution_categories', array('parent_id' => 0));
        $data['category_id']    =  0;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/solution-manager', $data);
        return;
    }


    /*Service Manager*/
    public function category_service_type()
    {
        $this->checkPermission();

        $data = self::$data;
        $data['mainCategories']    =  $this->database->_get_row_data('tbl_solution_categories', array('parent_id' => 0));
        $data['category_id']       =  0;
        $this->load->view('admin/service-type-manager', $data);
        return;
    }

    /*sub category solution*/
    public function subCategorySolution()
    {
        $this->checkPermission();

        $categoryId =  $this->input->post('categoryId');
        $data['subCategories']    =  $this->database->_get_row_data('tbl_solution_categories', array('parent_id' => $categoryId));
        $data['token']         = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        exit(json_encode($data));
    }




    /* List of memebership level */
    public function listing_membership_level($page = 1)
    {
        $this->checkPermission();

        $data                   = self::$data;
        $table                  = "tbl_membership_level";
        $url                    = "admin/membership-level-list";
        $column                 = ['created_at', 'updated_at', 'description', 'no_validity'];
        $perPage                =  PERPAGE;
        $search                 = "";
        $sort                   = "";
        $data['orderBy']        = "";
        $data['orderColumn']    = "";
        $data['addUrl']         = "admin/view-membership-level";

        $rdata      = $this->showPaginateLisitng($table, $url, $column, $perPage, $page, $search, $sort);

        $data       = array_merge($data, $rdata);
        // pre($data);
        $this->load->view('admin/membership_listing', $data);
    }

    /* view form for add or edit Memebership level */
    public function membership_level($id = 0)
    {
        $this->checkPermission();

        $data = $_POST;
        $table = 'tbl_membership_level';

        $membership_id = $this->input->post("membership_id");

        $allowedPermission  = $data['is_allowed'];
        unset($data['is_allowed']);
        unset($data['membership_id']);
        unset($data['pageNo']);
        unset($data['queryString']);


        if (!empty($membership_id)) // Come for Update
        {
            $this->database->_delete_from_table('tbl_membership_permissions', ['membership_level_id' => $membership_id]);
            $this->database->_update_to_DB($table, $data, $membership_id);
            $newMembershipId    =   $membership_id;

            foreach ($allowedPermission as $key => $val) {
                $premissionNewarray[]   =   array(
                    'membership_level_id' => $newMembershipId,
                    'permission_id' => null,
                    'permission_slug' => $key,
                    'is_allowed' => $val
                );
            }
            $this->db->insert_batch('tbl_membership_permissions', $premissionNewarray);
            $this->deleteAllFileCache();
            redirect("admin/membership-level-list");
        } else    //  Come for Add new 
        {
            $newMembershipId = $this->database->_insert_to_DB($table, $data);

            foreach ($allowedPermission as $key => $val) {
                $premissionNewarray[]   =   array(
                    'membership_level_id' => $newMembershipId,
                    'permission_id' => null,
                    'permission_slug' => $key,
                    'is_allowed' => $val
                );
            }
            $this->db->insert_batch('tbl_membership_permissions', $premissionNewarray);
            $this->deleteAllFileCache();
            redirect("admin/membership-level-list");
        }
    }

    public function defaultMembership()
    {
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $membership_id = $this->input->post('membership_id');
        if (!empty($membership_id)) {
            $this->database->defalutMembership($membership_id);
        }
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }


    public function guestMembership()
    {
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $membership_id = $this->input->post('membership_id');

        $membership_level_id    =    $this->database->_get_single_data('tbl_membership_level', ['is_guest' => 1], 'id');
        $membership_permissions =     $this->database->getUserAllowePermission($membership_level_id);
        fileCache(getUserSlug("_permission"), $membership_permissions,  "delete");

        if (!empty($membership_id)) {
            $this->database->guestMembership($membership_id);
        }

        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }

    public function membership_level_delete($id = 0)
    {
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if ($id != 0) {
            $flag = 0;
            // chech membership is assign to user or not
            $count =   $this->db->where("membership_level", $id)
                ->from('tbl_users')
                ->count_all_results();
            $output['count']  = $count;
            if (!empty($count)) {
                $flag = 1;
            }
        }
        if (empty($flag)) {
            // if membership is not assigned then delete
            $output['response']   =  $this->database->_delete_from_table('tbl_membership_level', array('id' => $id));
        } else {
            $output['response']   = 0;
            $output['type']  = " Users";
        }
        $this->deleteAllFileCache();
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }


    public function view_membership_level($id = 0)
    {
        $data = self::$data;
        $data['url'] = "admin/membership_level";

        if ($id != 0) {
            $data['records']    = $this->database->_get_row_data('tbl_membership_level', array('id' => $id));
            $data['membership_premissions']    = $this->database->_get_row_data('tbl_membership_permissions', array('membership_level_id' => $id));

            // pre($data['records']);
            // pre($data['membership_premissions'] , 1);

            foreach ($data['membership_premissions'] as $key => $val) {
                $slug   =   explode('-', $val['permission_slug']);
                $slug   =   end($slug);
                $newArray[$slug][]   =   $val;
            }
            $data['membership_premissions'] =   $newArray;
        } else {
            $data['membership_premissions']    = $this->database->_get_row_data('tbl_permissions', '');

            foreach ($data['membership_premissions'] as $membership_premission) {
                if ($membership_premission['master_id']  == 0) {
                    $extArray = [];
                    foreach ($data['membership_premissions'] as $value) {
                        if ($value['master_id'] == $membership_premission['id']) {
                            $value['id'] = $value['id'];
                            $value['name'] = $value['name'];
                            $value['permission_slug'] = $value['slug'];
                            $value['is_allowed'] = 0;
                            $extArray[] = $value;
                        }
                    }
                    $newArray[strtolower($membership_premission['name'])] =   $extArray;
                }
            }
            $data['membership_premissions'] =   $newArray;
        }

        $this->load->view('admin/membership_manage', $data);
    }

    /* List of Permission level */
    public function listing_permission($page = 1)
    {
        $data                   = self::$data;
        $table                  = "tbl_permissions";
        $url                    = "admin/permission-list";
        $column                 = ['created_at', 'updated_at', 'description'];
        $perPage                =  10;
        $search                 = "";
        $sort                   = "";
        $data['orderBy']        = "";
        $data['orderColumn']    = "";
        $data['addUrl']         = "admin/view-permission";

        $rdata      = $this->showPaginateLisitng($table, $url, $column, $perPage, $page, $search, $sort);

        $data       = array_merge($data, $rdata);
        $this->load->view('admin/permission_listing', $data);
    }

    /* view permisssion */
    public function viewPermission($id = 0)
    {
        $data = self::$data;
        $table = 'tbl_permissions';
        $data['url'] = "admin/permission";
        if ($id != 0) {
            $data['record']     =   $this->database->_get_row_data($table, array('id' => $id));
            $data['heading']    =   "Edit Permission";
        }
        $data['permssions']     =   $this->database->_get_row_data($table, '');
        $this->load->view('admin/permission_manage', $data);
    }

    /* view form for add or edit permission level */
    public function permission()
    {
        $data = self::$data;
        $table = 'tbl_permissions';
        $permission_id = $this->input->post("permission_id");
        if (isset($permission_id) && !empty($permission_id)) {
            $formdata = $this->input->post();
            unset($formdata['permission_id']);
            unset($formdata['pageNo']);
            unset($formdata['queryString']);
            $upldate =  $this->database->_update_to_DB($table, $formdata, $permission_id);
            $this->deleteAllFileCache();
            redirect('admin/permission-list');
        } else {
            $formdata = $this->input->post();
            unset($formdata['permission_id']);
            unset($formdata['pageNo']);
            unset($formdata['queryString']);
            $this->database->_insert_to_table($table, $formdata);
            $this->deleteAllFileCache();
            redirect('admin/permission-list');
        }
    }


    /* show column and data for pagination */
    public function showPaginateLisitng($table, $url, $column = [], $perPage, $page, $search = "", $sort = '')
    {
        $data['fields']             =   $this->db->list_fields($table);
        $data['fields']             =   array_diff($data['fields'], $column);
        $data['listDatas']          =   $this->database->_get_row_selected_data($table, '', implode(',', $data['fields']), $perPage, $page, $search, $sort);
        array_push($data['fields'], 'action');
        $data["links"] =  $this->pagination_loader($url, $table, $perPage, $sort = "");
        return $data;
    }
    /*Common per user list pagination creator*/
    public function pagination_loader($url, $table, $perPage, $sort = "")
    {
        $config = array();
        $config["base_url"]                     = site_url($url);
        $config["total_rows"]                   = $this->database->_total_results_count($table);
        $config["per_page"]                     = $perPage;
        $config['use_page_numbers']             = TRUE;

        $config['num_tag_open']                 = '<li class="ripple-effect mypage">';
        $config['num_tag_close']                = '</li>';
        $config['cur_tag_open']                 = '<li><a class="ripple-effect  current-page">';
        $config['cur_tag_close']                = '</a></li>';
        $config['prev_tag_open']                = '<li class="pagination-arrow">';
        $config['prev_tag_close']               = '</li>';
        $config['first_tag_open']               = '<li class="ripple-effect mypage">';
        $config['first_tag_close']              = '</li>';
        $config['last_tag_open']                = '<li class="ripple-effect mypage">';
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

    /*pagination creator lession*/
    public function pagination_loader_lession($url, $table, $perPage, $course_id = "")
    {
        $config = array();
        $config["base_url"]                     = site_url($url);
        $config["total_rows"]                   = $this->database->_results_count($table, ['course_id' => $course_id], true);
        $config["per_page"]                     = $perPage;
        $config['use_page_numbers']             = TRUE;
        $config['page_query_string']            = TRUE;

        $config['num_tag_open']                 = '<li class="ripple-effect mypage">';
        $config['num_tag_close']                = '</li>';
        $config['cur_tag_open']                 = '<li><a class="ripple-effect  current-page">';
        $config['cur_tag_close']                = '</a></li>';
        $config['prev_tag_open']                = '<li class="pagination-arrow">';
        $config['prev_tag_close']               = '</li>';
        $config['first_tag_open']               = '<li class="ripple-effect mypage">';
        $config['first_tag_close']              = '</li>';
        $config['last_tag_open']                = '<li class="ripple-effect mypage">';
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
    /*Listing Manager*/
    public function listing_control()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/listing-manager', $data);
        return;
    }

    /*Sponsored & Regular Listings*/
    public function listings_types()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/any-listings', $data);
        return;
    }

    /*Listing Manager*/
    public function language_setup()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/language-setup', $data);
        return;
    }

    /*Payments Data*/
    public function payments_data()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/payments-data', $data);
        return;
    }

    /*Withdrawal Settings*/
    public function withdrawal_settings()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/withdrawal-settings', $data);
        return;
    }

    /*Platform Control*/
    public function plugins_manager()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/plugins-manager', $data);
        return;
    }

    /*Payments Setup*/
    public function payments_setup()
    {
        $this->checkPermission();

        $data = self::$data;
        $data['payments']  =   $this->database->_get_row_data('tbl_payment_settings', '');
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/payments-setup', $data);
        return;
    }

    /*Manage Disputes*/
    public function manage_disputes($id='')
    {
        
        $this->checkPermission();

        $data = self::$data;
        if (!empty($id)) {
            $data['contract']  =   $this->database->_get_contract($id);

            if (isset($data['contract'][0]['bid_id'])) {
                $data['dispute']            =   $this->database->_get_disputes_data('', $data['contract'][0]['id']);
                $data['seller']             =   $this->database->getUserData($data['contract'][0]['owner_id']);
                $data['buyer']              =   $this->database->getUserData($data['contract'][0]['customer_id']);
                $data['userprofile']        =   $this->database->getUserData($data['contract'][0]['owner_id']);
                $data['reviewRatings']      =   $this->database->get_reviews($data['contract'][0]['owner_id'], $this->session->userdata('user_id'));
                $data['contractsHistory']   =   $this->database->_load_history($data['contract'][0]['id']);

                if ($data['contract'][0]['type'] === 'bid') {
                    $data['biddata']        =   $this->database->_get_bid($data['contract'][0]['bid_id']);
                }

                if ($data['contract'][0]['type'] === 'offer') {
                    $data['biddata']        =   $this->database->_get_offer($data['contract'][0]['bid_id']);
                }

                $data['contractamount']     =   $this->database->_get_single_data('tbl_contracts', array('contract_id' => $data['contract'][0]['id']), 'amount');
                $data['listing_data']       =   $this->database->_get_row_data('tbl_listings', array('id' => $data['contract'][0]['listing_id']));
            }
            $data = html_escape($this->security->xss_clean($data));
            $this->load->view('admin/manage-disputes', $data);
            return;
        }
        else
        {
            $data['contract'] = $this->database->_get_disputes_data(0,'');

            $data['dispute']            =   $this->database->_get_disputes_data('0','');
  
            $data['seller']             =   $this->database->getUserData($data['contract'][0]['owner_id']);
            $data['buyer']              =   $this->database->getUserData($data['contract'][0]['customer_id']);
            $data['userprofile']        =   $this->database->getUserData($data['contract'][0]['owner_id']);
            $data['reviewRatings']      =   $this->database->get_reviews($data['contract'][0]['owner_id'], $this->session->userdata('user_id'));
            $data['contractsHistory']   =   $this->database->_load_history($data['contract'][0]['id']);

            if ($data['contract'][0]['type'] === 'bid') {
                $data['biddata']        =   $this->database->_get_bid($data['contract'][0]['bid_id']);
            }

            if ($data['contract'][0]['type'] === 'offer') {
                $data['biddata']        =   $this->database->_get_offer($data['contract'][0]['bid_id']);
            }

            $data['contractamount']     =   $this->database->_get_single_data('tbl_contracts', array('contract_id' => $data['contract'][0]['id']), 'amount');
            $data['listing_data']       =   $this->database->_get_row_data('tbl_listings', array('id' => $data['contract'][0]['listing_id']));
            
            $data = html_escape($this->security->xss_clean($data));
            $this->load->view('admin/all-manage-disputes', $data);
            return;
        }

        $this->pageNotFound();
    }

   
    /*admin Profile Settings*/
    public function user_settings()
    {

        $data = self::$data;
        $data['metaData']                       =   $this->database->getSettingsData();
        $data['withdraw_meths']                 =   $this->database->_get_row_data('tbl_withdrawal_methods', array('status' => 1));
        $data['profileid']                      =   $this->session->userdata('user_id');
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/admin-settings', $data);
    }


    /*admin Profile Settings*/
    public function images_manager()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/images-manager', $data);
    }

    /*Email Settings*/
    public function email_settings()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/email-settings', $data);
    }

    /*Change Admin Password*/
    public function change_password()
    {
        $this->checkPermission();

        $data = self::$data;
        $data['metaData']                       =   $this->database->getSettingsData();
        $data['profileid']                      =   $this->session->userdata('user_id');
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/change-password', $data);
    }

    /*pages manager*/
    public function general_settings()
    {
        $this->checkPermission();

        $data = self::$data;
        $data['settings']   =   $this->database->getSettingsData();
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/general-settings', $data);
        return;
    }

    /*current listings*/
    public function current_listings()
    {
        $this->checkPermission();

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/current-listings', $data);
        return;
    }

    /*blog manager*/
    public function blog_manager()
    {
        $this->checkPermission();

        $data = self::$data;
        
        $data['posts']      =   $this->database->_get_row_data('tbl_blog', array('status' => 1), '');
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/blog_manager', $data);
        return;
    }

    /*view blog comments*/
    public function view_comments($id = null){

        $this->checkPermission();
        
        $data = self::$data;
        if($id != '')
            $data['comments']      =   $this->database->_get_row_data('tbl_comments', array('listing_id' => $id,  'tbl_comments.section' => 'blog'), '');           
        else 
            $data['comments']      =   $this->database->_get_row_data('tbl_comments', array('status' => 0,  'tbl_comments.section' => 'blog'), '');
           // echo '<pre>';print_r($data['comments']);exit;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/comments_manager', $data);
        return;
    }

    public function deleteFileCache()
    {
        $this->load->driver('cache');
        $this->cache->file->delete(getUserSlug());
        $this->cache->file->delete(getAdminSlug());
        $this->cache->file->delete(getUserSlug("_course"));
        $this->cache->file->delete(getUserSlug("_permission"));
    }

    public function deleteAllFileCache()
    {
        $this->load->driver('cache');
        $this->cache->file->clean();
    }

    /*Admin logout*/
    public function logout()
    {
        $this->deleteFileCache();
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_level');
        redirect(base_url());
        return;
    }

    /*Get Total Earnings*/
    public function get_totalearnings()
    {
        $arr = $this->database->_get_statics('tbl_payments', 'SUM(AMOUNT) as total', array('ACK' => 'Success'), array('ACK' => 'SuccessWithWarning'), 'PAYMENTINFO_0_TRANSACTIONID');
        if (isset($arr[0]['total'])) {
            return $arr[0]['total'];
        }
        return;
    }

    /*Get Total Earnings*/
    public function get_monthlyearnings()
    {
        $arr = $this->database->_get_statics('tbl_payments', 'SUM(AMOUNT) as total', array('ACK' => 'Success'), array('ACK' => 'SuccessWithWarning'), 'PAYMENTINFO_0_TRANSACTIONID', array('TIMESTAMP' => date('Y-m')));
        if (isset($arr[0]['total'])) {
            return $arr[0]['total'];
        }
        return;
    }

    /*Get Total Listings*/
    public function get_monthlywisetotallistings($year = '', $previousYear = '')
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if (empty($year)) {
            $year = date('Y');
        }

        if (empty($previousYear)) {
            $previousYear = date("Y") - 1;
        }

        $finalArr = array();
        $arr    = $this->database->_get_monthlywisetotallistings($year);
        $arrPrv = $this->database->_get_monthlywisetotallistings($previousYear);
        if (!empty($arr)) {
            for ($i = 0; $i < 12; $i++) {
                $finalArr[0][$i] =  $arr[$i]['total'];
            }
        }

        if (!empty($arrPrv)) {
            for ($i = 0; $i < 12; $i++) {
                $finalArr[1][$i] =  $arrPrv[$i]['total'];
            }
        }

        $output['response']         = $finalArr;
        exit(json_encode($output));
    }

    /*Get Monthlwise Total Earnings*/
    public function get_monthlywisetotalearnings($year = '')
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if (empty($year)) {
            $year = date('Y');
        }

        $finalArr = array();
        $arr = $this->database->_get_monthlywisetotalearnings($year);
        if (!empty($arr)) {
            for ($i = 0; $i < 12; $i++) {
                $finalArr[$i] =  $arr[$i]['total'];
            }
        }

        $output['response']         = $finalArr;
        exit(json_encode($output));
    }

    /*upload_key*/
    public function upload_key()
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        if (!empty($_FILES['uploadGoogleKey']['name'])) {
            if ($this->security->xss_clean($_FILES['uploadGoogleKey']['name'], TRUE) === TRUE) {
                $key = $this->upload__files('uploadGoogleKey', KEY_UPLOAD, true);
                $output['response']   = $this->database->_update_to_table('tbl_settings', array('json_key_file' => $key), array('id' => 1));
                exit(json_encode($output));
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    /*Bulk Import*/
    public function bulk_import()
    {
        $this->checkPermission();

        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        if (!empty($_FILES['uploadExcel']['name'])) {
            if ($this->security->xss_clean($_FILES['uploadExcel']['name'], TRUE) === TRUE) {
                $data = $this->database->_import_excel('uploadExcel');
                $output['response']   = $data;
                exit(json_encode($output));
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }


    /*Save page data*/
    public function save_page_data()
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
            'txt_page_title' => $this->input->post('txt_page_title'),
            'txt_page_meta_description' => $this->input->post('txt_page_meta_description'),
            'txt_page_meta_keywords' => $this->input->post('txt_page_meta_keywords'),
            'txt_page_url_slug' => $this->input->post('txt_page_url_slug'),
            'txt_page_description' => $this->input->post('txt_page_description'),
            'page_visibility_group' => $this->input->post('page_visibility_group'),
            'page_visibility_status' => $this->input->post('page_visibility_status'),
            'date' => date('Y-m-d H:i:s')
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('txt_page_title', 'Page Title', 'required|trim|xss_clean');
        $this->form_validation->set_rules('txt_page_meta_description', 'Page Meta', 'required|trim|xss_clean');
        $this->form_validation->set_rules('txt_page_meta_keywords', 'Page Keywrords', 'required|trim|xss_clean');
        $this->form_validation->set_rules('txt_page_url_slug', 'Page Slug', 'required|trim|xss_clean');
        $this->form_validation->set_rules('txt_page_description', 'Description', 'required|trim|xss_clean');

        if ($this->form_validation->run()) {
            $data = $this->security->xss_clean($data);

            if (!empty($data['txt_page_meta_keywords'])) {
                $data['txt_page_meta_keywords'] = json_encode(explode(",", $data['txt_page_meta_keywords']));
            }

            if (!empty($this->input->post('txt_page_id'))) {
                $output['response']     = $this->database->_update_to_table('tbl_pages', $data, array('page_id' => $this->input->post('txt_page_id')));
                exit(json_encode($output));
            } else {
                $output['response']     = $this->database->_insert_to_table('tbl_pages', $data);
                exit(json_encode($output));
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    /*Save Language data*/
    public function save_language_data()
    {
        $data = array(
            'language' => $this->input->post('language_name'),
            'language_code' => $this->input->post('language_code'),
            'status' => $this->input->post('language_active')
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('language', 'Language', 'required|trim|xss_clean');
        $this->form_validation->set_rules('language_code', 'Language Code', 'required|trim|xss_clean');

        if ($this->form_validation->run()) {
            $data = $this->security->xss_clean($data);
            if (empty($this->input->post("language_id"))  && empty($this->database->_get_single_data('tbl_languages', array('language_code' => $this->input->post('language_code')), 'language'))) {
                $this->copy_language_file('application/language/english', 'application/language/' . $this->security->sanitize_filename($this->input->post('language_name')));
                $output['response']     = $this->database->_insert_to_table('tbl_languages', $data);
                exit(json_encode($output));
            } else {
                $this->rename_language_directory('application/language/' . ($this->database->_get_single_data('tbl_languages', array('language_code' => $this->input->post('language_code')), 'language'))[0]['language'], 'application/language/' . $this->security->sanitize_filename($this->input->post('language_name')));
                $output['response']     = $this->database->_update_to_table('tbl_languages', $data, array('id' => $this->input->post('language_id')));
                exit(json_encode($output));
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    /*Copy Language File according to the created language*/
    public function copy_language_file($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /*Rename Language Directory accordingly*/
    public function rename_language_directory($src, $dst)
    {
        rename($src, $dst);
    }

    /*Save Blog data*/
    public function save_blog_data()
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $icon = '';
        if (!empty($_FILES['uploadListingImage']['name'])) {
            if ($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === FALSE) {
                $icon = '';
            } else {
                $icon = $this->upload__image('uploadListingImage', BLOG_UPLOAD);
            }
        }

        $data = array(
            'title' => $this->input->post('txt_blogpost_title'),
            'metadescription' => $this->input->post('txt_blogpost_meta_description'),
            'metakeywords' => json_encode(explode(",", $this->input->post('txt_blogpost_meta_keywords'))),
            'slug' => $this->input->post('txt_blogpost_url_slug'),
            'blog_post' => $this->input->post('txt_blogpost_description'),
            'blog_tags' => json_encode(explode(",", $this->input->post('txt_blogpost_tags'))),
            'status' => $this->input->post('blogpostvisibility_status'),
            'date' => date('Y-m-d H:i:s'),
            'views' => 0
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('title', 'Blog Title', 'required|trim|xss_clean');
        $this->form_validation->set_rules('metadescription', 'Meta Description', 'required|trim|xss_clean');
        $this->form_validation->set_rules('metakeywords', 'Keywords', 'required|trim|xss_clean');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim|xss_clean');
        $this->form_validation->set_rules('blog_post', 'Blog Post', 'required|trim|xss_clean');

        if ($this->form_validation->run()) {
            $data = $this->security->xss_clean($data);
            if (!empty($this->input->post('txt_blogpost_id'))) {
                if (!empty($icon)) {
                    $data['thumbnail']  = $icon;
                }
                $output['response']     = $this->database->_update_to_table('tbl_blog', $data, array('id' => $this->input->post('txt_blogpost_id')));
                exit(json_encode($output));
            } else {
                if (!empty($data['title'])) {
                    $data['thumbnail']      = $icon;
                    $output['response']     = $this->database->_insert_to_table('tbl_blog', $data);
                    exit(json_encode($output));
                }
            }
        }
        $output['response']         = false;
        exit(json_encode($output));
    }

    /*Save Image data*/
    public function save_images_data()
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if (!empty($_FILES['sitelogo']['name'])) {
            if ($this->security->xss_clean($_FILES['sitelogo']['name'], TRUE) === TRUE) {
                $sitelogo = $this->upload__image('sitelogo', ADMIN_IMAGES, true);
            }
        }

        if (!empty($_FILES['invoice_logo']['name'])) {
            if ($this->security->xss_clean($_FILES['invoice_logo']['name'], TRUE) === TRUE) {
                $invoice_logo = $this->upload__image('invoice_logo', ADMIN_IMAGES, true);
            }
        }

        if (!empty($_FILES['favicons']['name'])) {
            if ($this->security->xss_clean($_FILES['favicons']['name'], TRUE) === TRUE) {
                $favicon = $this->upload__image('favicons', ADMIN_IMAGES, true);
            }
        }

        if (!empty($_FILES['mainback']['name'])) {
            if ($this->security->xss_clean($_FILES['mainback']['name'], TRUE) === TRUE) {
                $mainback = $this->upload__image('mainback', ADMIN_IMAGES, true);
            }
        }

        if (!empty($_FILES['homepage']['name'])) {
            if ($this->security->xss_clean($_FILES['homepage']['name'], TRUE) === TRUE) {
                $homepage = $this->upload__image('homepage', ADMIN_IMAGES, true);
            }
        }

        if (!empty($_FILES['loader']['name'])) {
            if ($this->security->xss_clean($_FILES['loader']['name'], TRUE) === TRUE) {
                $loader = $this->upload__image('loader', ADMIN_IMAGES, true);
            }
        }

        if (!empty($_FILES['backgrounds']['name'])) {
            if ($this->security->xss_clean($_FILES['backgrounds']['name'], TRUE) === TRUE) {
                $backgrounds = $this->upload__image('backgrounds', ADMIN_IMAGES, true);
            }
        }

        $data = array();

        if (!empty($sitelogo)) {
            $data['sitelogo'] = $sitelogo;
        }

        if (!empty($invoice_logo)) {
            $data['invoice_logo'] = $invoice_logo;
        }

        if (!empty($favicon)) {
            $data['favicon'] = $favicon;
        }

        if (!empty($mainback)) {
            $data['mainback'] = $mainback;
        }

        if (!empty($homepage)) {
            $data['homepage'] = $homepage;
        }

        if (!empty($loader)) {
            $data['loader'] = $loader;
        }

        if (!empty($backgrounds)) {
            $data['backgrounds'] = $backgrounds;
        }

        if (!empty($data)) {
            $output['response']    = $this->database->_update_to_table('tbl_siteimages', $data, array('id' => 1));
            exit(json_encode($output));
        }

        $output['response']     = false;
        exit(json_encode($output));
    }


    /*Save Announcement data*/
    public function save_announcement()
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
            'announcement_heading' => $this->input->post('txt_announcement_heading'),
            'announcement' => $this->input->post('txt_announcement'),
            'announcement_type' => $this->input->post('announcement_type'),
            'group_id' => $this->input->post('visibility_group'),
            'status' => $this->input->post('visibility_status'),
            'date' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('announcement_heading', 'Announcement Title', 'required|trim|xss_clean');
        $this->form_validation->set_rules('announcement', 'Announcement', 'required|trim|xss_clean');

        if ($this->form_validation->run()) {
            $data = $this->security->xss_clean($data);
            if (!empty($this->input->post('txt_announcement_id'))) {
                $output['response']     = $this->database->_update_to_table('tbl_announcement', $data, array('id' => $this->input->post('txt_announcement_id')));
                exit(json_encode($output));
            } else {
                $output['response']     = $this->database->_insert_to_table('tbl_announcement', $data);
                exit(json_encode($output));
            }
        }

        $output['response']     = false;
        exit(json_encode($output));
    }

    /*Save Blog data*/
    public function save_general_settings()
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
            'activate_one_listing_per_domain' => $this->input->post('activate_one_listing_per_domain'),
            'show_expired_records' => $this->input->post('show_expired_records'),
            'default_currency' => $this->input->post('default_currency'),
            'auction_period' => $this->input->post('auction_period'),
            'bid_value_gap' => $this->input->post('bid_value_gap'),
            'sale_commission' => $this->input->post('sale_commission'),
            'hold_bidding_until_approval' => $this->input->post('hold_bidding_until_approval'),
            'allow_multiple_bidding' => $this->input->post('allow_multiple_bidding'),
            'allow_approvedbidder_tobid' => $this->input->post('allow_approvedbidder_tobid'),
            'processing_fee' => $this->input->post('processing_fee'),
            'image_thumbnails' => $this->input->post('image_thumbnails'),
            'email_notifications' => $this->input->post('email_notifications'),
            'office_add1' => $this->input->post('office_add1'),
            'office_add2' => $this->input->post('office_add2'),
            'office_tel' => $this->input->post('office_tel'),
            'office_email' => $this->input->post('office_email'),
            'user_facebook' => $this->input->post('user_facebook'),
            'user_twitter' => $this->input->post('user_twitter'),
            'user_Instagram' => $this->input->post('user_Instagram'),
            'user_github' => $this->input->post('user_github'),
            'user_google' => $this->input->post('user_google'),
            'user_youtube' => $this->input->post('user_youtube'),
            'google_analytics' => $this->input->post('google_analytics'),
            'ssl_enable' => $this->input->post('ssl_enable'),
            'google_api_key' => $this->input->post('google_api_key'),
            'active_domain_verification' => $this->input->post('active_domain_verification'),
            'active_app_verification' => $this->input->post('active_app_verification'),
            'active_domain_screenshots' => $this->input->post('active_domain_screenshots'),
            'footer_credits' => $this->input->post('footer_credits'),
            'blacklisted_domains' => json_encode(explode(",", $this->input->post('blacklisted_domains')))
        );

        $data = $this->security->xss_clean($data);
        if (!empty($data)) {
            $this->database->_update_to_table_not_in('tbl_currencies', array('default_status' => 0), 'currency', array($this->input->post('default_currency')));
            $this->database->_update_to_table('tbl_currencies', array('default_status' => 1), array('currency' => $this->input->post('default_currency')));
            $output['response']    = $this->database->_update_to_table('tbl_settings', $data, array('id' => 1));
            exit(json_encode($output));
        }

        $output['response']     = false;
        exit(json_encode($output));
    }

    /*Payment Gateway Settings*/
    public function paypal_data_Save($id)
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
            'status' => $this->input->post('paypal_status'),
            'username' => $this->input->post('paypal_username'),
            'password' => $this->input->post('paypal_password'),
            'signature' => $this->input->post('paypal_signature'),
            'icon_url' => $this->input->post('icon_url'),
            'sandbox' => $this->input->post('paypal_sandbox')
        );

        if (!empty($id)) {
            $this->form_validation->set_data($data);
            switch ($id) {
                case '1':
                    $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
                    $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
                    $this->form_validation->set_rules('signature', 'Signature', 'required|trim|xss_clean');
                    break;
                case '2':
                    $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
                    $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
                    $this->form_validation->set_rules('signature', 'Signature', 'required|trim|xss_clean');
                    break;
                case '3':
                    $this->form_validation->set_rules('signature', 'Signature', 'required|trim|xss_clean');
                    break;
                default:
                    return;
            }

            if ($this->form_validation->run()) {
                $data = $this->security->xss_clean($data);
                $output['response']     = $this->database->_update_to_table('tbl_payment_settings', $data, array('id' => $id));
                exit(json_encode($output));
            } else {
                $output['response']     = false;
                exit(json_encode($output));
            }
        } else {
            $output['response']     = false;
            exit(json_encode($output));
        }
    }


    /*Save Withdrawal Setup */
    public function withdrawals_setup()
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
            'threshold' => $this->input->post('withdrawal_threshold'),
            'fee' => $this->input->post('fee_amount'),
            'cal_meth' => $this->input->post('fee_method'),
            'status' => $this->input->post('withdrawal_status')
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('threshold', 'Threshold', 'required|numeric|trim|xss_clean');
        $this->form_validation->set_rules('fee', 'Fee', 'required|numeric|trim|xss_clean');
        $this->form_validation->set_rules('cal_meth', 'Method', 'required|trim|xss_clean');

        if ($this->form_validation->run()) {
            $data = $this->security->xss_clean($data);
            $output['response']     = $this->database->_update_to_table('tbl_withdrawal_methods', $data, array('id' => $this->input->post('withdrawal_methods')));
            exit(json_encode($output));
        }

        $output['response']     = false;
        exit(json_encode($output));
    }

    /*Save Withdrawal Setup */
    public function save_email_settings()
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
            'site_email' => $this->input->post('site_email'),
            'site_email_name' => $this->input->post('site_email_name'),
            'mail_sending_option' => $this->input->post('mail_sending_option'),
            'mail_smtp_server' => $this->input->post('mail_smtp_server'),
            'mail_smtp_user' => $this->input->post('mail_smtp_user'),
            'mail_smtp_password' => $this->input->post('mail_smtp_password'),
            'mail_smtp_port' => $this->input->post('mail_smtp_port'),
            'mail_smtp_encryption' => $this->input->post('mail_smtp_encryption')
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('site_email', 'Site Email', 'required|trim|xss_clean|valid_email');
        $this->form_validation->set_rules('site_email_name', 'Email Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('mail_smtp_server', 'Mail Server', 'required|trim|xss_clean');
        $this->form_validation->set_rules('mail_smtp_user', 'User', 'required|trim|xss_clean');
        $this->form_validation->set_rules('mail_smtp_password', 'Password', 'required|trim|xss_clean');
        $this->form_validation->set_rules('mail_smtp_port', 'Port', 'required|trim|xss_clean');

        if ($this->form_validation->run()) {
            $data = $this->security->xss_clean($data);
            $output['response']     = $this->database->_update_to_table('tbl_email_settings', $data, array('id' => 1));
            exit(json_encode($output));
        }

        $output['response']     = false;
        exit(json_encode($output));
    }

    /*Save Category data for website*/
    public function save_category_data()
    {
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if (!empty($this->input->post('category_name'))) {
            $icon = '';
            if (!empty($_FILES['uploadListingImage']['name'])) {
                if ($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === TRUE) {
                    $icon = $this->upload__image('uploadListingImage', CATEGORY_IMAGES);
                }
            }

            $data = array(
                'c_name' => $this->input->post('category_name'),
                'c_description' => $this->input->post('category_meta_description'),
                'c_keywords' => json_encode(explode(",", $this->input->post('category_meta_keywords'))),
                // 'c_level' => $this->input->post('category_level'),
                // 'url_slug' => $this->input->post('category_url_slug'),
            );

            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('c_name', 'Category Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('c_description', 'Category Description', 'required|trim|xss_clean');
            $this->form_validation->set_rules('c_keywords', 'Category Keywords', 'required|trim|xss_clean');
            // $this->form_validation->set_rules('url_slug', 'Slug', 'required|trim|xss_clean');

            if ($this->form_validation->run()) {
                $data = $this->security->xss_clean($data);
                if (!empty($this->input->post('category_id'))) {
                    if (!empty($icon)) {
                        $data['c_thumb']    = $icon;
                    }

                    $output['response']     = $this->database->_update_to_table('tbl_categories', $data, array('id' => $this->input->post('category_id')));
                    exit(json_encode($output));
                } else {
                    $data['c_thumb']        = $icon;
                    $output['response']     = $this->database->_insert_to_table('tbl_categories', $data);
                    exit(json_encode($output));
                }
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }


    /*Save Service Category Type */
    public function service_category_data()
    {
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if (!empty($this->input->post('category_name'))) {
            $icon = '';
            if (!empty($_FILES['uploadListingImage']['name'])) {
                if ($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === TRUE) {
                    $icon = $this->upload__image('uploadListingImage', CATEGORY_IMAGES);
                }
            }

            $data = array(
                'c_name' => $this->input->post('category_name'),
                'c_description' => $this->input->post('category_meta_description'),
                'c_keywords' => json_encode(explode(",", $this->input->post('category_meta_keywords'))),

            );

            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('c_name', 'Category Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('c_description', 'Category Description', 'required|trim|xss_clean');
            $this->form_validation->set_rules('c_keywords', 'Category Keywords', 'required|trim|xss_clean');

            if ($this->form_validation->run()) {
                $data = $this->security->xss_clean($data);


                if (!empty($this->input->post('category_id'))) {
                    if (!empty($icon)) {
                        $data['c_thumb']    = $icon;
                    }

                    $output['response']     = $this->database->_update_to_table('tbl_solution_service_types', $data, array('id' => $this->input->post('category_id')));
                    exit(json_encode($output));
                } else {
                    $data['c_thumb']        = $icon;
                    $output['response']     = $this->database->_insert_to_table('tbl_solution_service_types', $data);
                    exit(json_encode($output));
                }
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    /*Save monitization method for website*/
    public function save_monetiztion_method_data()
    {
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if (!empty($this->input->post('name'))) {
            $data = array(
                'name' => $this->input->post('name'),
            );

            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('name', 'Monetization Method Name', 'required|trim|xss_clean');


            if ($this->form_validation->run()) {
                $data = $this->security->xss_clean($data);
                if (!empty($this->input->post('monetization_id'))) {
                    $output['response']     = $this->database->_update_to_table(' tbl_common', $data, array('id' => $this->input->post('monetization_id')));
                    exit(json_encode($output));
                } else {
                    $output['response']     = $this->database->_insert_to_table(' tbl_common', $data);
                    exit(json_encode($output));
                }
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }


    /*Save Solution Category data for Solutions*/
    public function save_solution_category_data()
    {
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if (!empty($this->input->post('category_name'))) {
            $icon = '';
            if (!empty($_FILES['uploadListingImage']['name'])) {
                if ($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === TRUE) {
                    $icon = $this->upload__image('uploadListingImage', CATEGORY_IMAGES);
                }
            }

            $data = array(
                'c_name' => $this->input->post('category_name'),
                'c_description' => $this->input->post('category_meta_description'),
                'c_keywords' => json_encode(explode(",", $this->input->post('category_meta_keywords'))),
            );


            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('c_name', 'Category Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('c_description', 'Category Description', 'required|trim|xss_clean');
            $this->form_validation->set_rules('c_keywords', 'Category Keywords', 'required|trim|xss_clean');


            if ($this->form_validation->run()) {
                if (!empty($this->input->post('parent_id'))) {
                    $data['parent_id']      = $this->input->post('parent_id');
                }
                $data = $this->security->xss_clean($data);


                if (!empty($this->input->post('category_id'))) {
                    if (!empty($icon)) {
                        $data['c_thumb']    = $icon;
                    }
                    $output['response']     = $this->database->_update_to_table('tbl_solution_categories', $data, array('id' => $this->input->post('category_id')));
                    exit(json_encode($output));
                } else {
                    $data['c_thumb']        = $icon;
                    $output['response']     = $this->database->_insert_to_table('tbl_solution_categories', $data);
                    exit(json_encode($output));
                }
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }


    /*Save Listing Header data*/
    public function save_listing_header_data()
    {
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $icon = '';
        if (!empty($_FILES['uploadListingImage']['name'])) {
            if ($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === TRUE) {
                $icon = $this->upload__image('uploadListingImage', ICON_UPLOAD);
            }
        }

        $data = array(
            'listing_name' => $this->input->post('listing_name'),
            'listing_description' => $this->input->post('listing_description'),
            'listing_price' => $this->input->post('listing_price'),
            'listing_duration' => $this->input->post('listing_duration'),
            'listing_discount' => $this->input->post('listing_discount'),
            'listing_type' => $this->input->post('listing_type'),
            'status' => $this->input->post('listing_status')
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('listing_name', 'Name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('listing_description', 'Description', 'required|trim|xss_clean');
        $this->form_validation->set_rules('listing_price', 'Price', 'required|numeric|trim|xss_clean');
        $this->form_validation->set_rules('listing_discount', 'Discount Price', 'required|numeric|trim|xss_clean');
        $this->form_validation->set_rules('listing_duration', 'Duration', 'required|numeric|trim|xss_clean');

        if ($this->form_validation->run()) {
            $data = $this->security->xss_clean($data);
            if (!empty($this->input->post('listing_id'))) {
                if (!empty($icon)) {
                    $data['listing_icon']   = $icon;
                }
                $output['response']         = $this->database->_update_to_table('tbl_listing_header', $data, array('listing_id' => $this->input->post('listing_id')));
                exit(json_encode($output));
            } else {
                $data['listing_icon']       = $icon;
                $output['response']         = $this->database->_insert_to_table('tbl_listing_header', $data);
                exit(json_encode($output));
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    /*Save Ads*/
    public function save_ads()
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
            'homepage_banner_720x90' => $this->input->post('homepage_banner_720x90'),
            'webpage_banner_720x90' => $this->input->post('webpage_banner_720x90'),
            'blog_page_720x90' => $this->input->post('blog_page_720x90'),
            'blog_300x250' => $this->input->post('blog_300x250'),
            'blog__post_page_720x90' => $this->input->post('blog__post_page_720x90'),
            'blog__post_page_300x250' => $this->input->post('blog__post_page_300x250')
        );

        if (!GOOGLE_ADSENSE) {
            $data = $this->security->xss_clean($data, TRUE);
        }

        $output['response']  = $this->database->_update_to_table('tbl_ads', $data, array('id' => 1));
        exit(json_encode($output));
    }

    /*Upload Images */
    public function upload__image($nameBox, $path = IMAGES_UPLOAD, $overwrite = false)
    {
        $this->load->library("upload");
        $this->load->helper("file");
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['max_size'] = 1048576;
        $this->upload->initialize($config);
        $this->upload->overwrite = $overwrite;
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
    public function upload__files($nameBox, $path = FILES_UPLOAD, $overwrite = false)
    {
        $this->load->library("upload");
        $this->load->helper("file");
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['max_size'] = 1048576;
        $this->upload->initialize($config);
        $this->upload->overwrite = $overwrite;
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

    public function course_category($page = 1)
    {
        $this->checkPermission();

        $data           =   self::$data;
        $table          =   'tbl_course_category';
        $url            =   "admin/course_category";
        $perPage        =    PERPAGE;
        $formData       =   $this->input->post();
        $this->session->userdata('url', base_url(uri_string()));
        if (!empty($formData)) {
            // update course category
            if (!empty($formData['course_category'])) {
                $upData = [
                    'name' => $formData['name'],
                    'parent_id' => $formData['parent_id'],
                    'status' => $formData['status'],
                    'updated_at' => date("Y-m-d H:i:s"),
                ];
                $update_id = $formData['course_category'];
                $this->database->_update_to_DB($table, $upData, $update_id);
                redirect($this->session->userdata('url'));
            } else {
                //insert course category
                $insData = [
                    'name' => $formData['name'],
                    'parent_id' => $formData['parent_id'],
                    'status' => $formData['status'],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ];
                $this->database->_insert_to_table($table, $insData);
            }
        }

        $data = html_escape($this->security->xss_clean($data));
        $data['records']        =    $this->database->_get_catsubcat_course($table, '', $perPage, $page);
        $data['links']          =   $this->pagination_loader($url, $table, $perPage,  $sort = "");
        $data['categories']     =   $this->database->_get_row_data($table, ['parent_id' => 0]);
        $this->load->view('admin/course-category', $data);
        return;
    }
    // get all courser category
    public function getCouseCategory()
    {

        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $table      =   "tbl_course_category";
        $id = $this->input->post('categoryId');
        if (!empty($id)) {
            $category       =   $this->database->_get_catsubcat_course($table, $id);
            $categories     =   $this->database->_get_row_data($table, ['parent_id' => 0]);
            $output['response']     = true;
        } else {
            $output['response']     = false;
        }
        $output['category']         =   $category[0];
        $output['categories']       =   $categories;
        exit(json_encode($output));
    }

    // delete course category if not attached
    public function course_category_delete($id = 0)
    {
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if ($id != 0) {
            $flag = 0;
            // check course category id in course 
            $count =   $this->db->where("course_category_id", $id)
                ->from('tbl_course')
                ->count_all_results();
            $output['count']  = $count;
            if (!empty($count)) {
                $output['type']  = " Courses";
                $flag = 1;
            }
        }
        if (empty($flag)) {
            // delete course category
            $output['response']   =  $this->database->_delete_from_table('tbl_course_category', array('id' => $id));
        } else {
            $output['response']   = 0;
        }
        $output['query']  = $this->db->last_query();
        $output = html_escape($this->security->xss_clean($output));
        exit(json_encode($output));
    }


    public function add_course($id =  "")
    {


        $data = self::$data;
        $formData = $this->input->post();

        if (isset($formData) && !empty($formData)) {
            $imageName = 'N/A';
            $imageType = 'N/A';
            $errorUploadType = "";
            if (!empty($_FILES['uploadCourseImage']['name'])) {
                if ($this->security->xss_clean($_FILES['uploadCourseImage']['name'], TRUE) === FALSE) {
                    $imageName = 'N/A';
                    $imageType = 'N/A';
                } else {
                    /**
                     * comment validation to check size of image.
                     */
                    // $img = getimagesize($_FILES['uploadCourseImage']['tmp_name']);
                    // $minimum = array('width' => '640', 'height' => '480');
                    // $width = $img[0];
                    // $height = $img[1];
                    // if ($width < $minimum['width'] ) {
                    // 	$errorUploadType .= "Image dimensions are too small. Minimum width is {$minimum['width']}px and height is {$minimum['height']} px.  Uploaded image width is $width px and height is $height px | ";
                    // } elseif ($height <  $minimum['height']) {
                    // 	$errorUploadType .= "Image dimensions are too small. Minimum width is {$minimum['width']}px and height is {$minimum['height']} px. Uploaded image width is $width and height is $height px ";
                    // }
                    // if(!empty($errorUploadType)){
                    //     return $errorUploadType;
                    // }
                    $imageName  =   $this->upload__image('uploadCourseImage', COURSE_IMAGE);
                    $imageType  =   1;
                }
            }
            if (!empty($formData['membership_level_id'])) {
                $formData['membership_level_id'] = implode(",", $formData['membership_level_id']);
            }
            $course_id = $this->input->post('course_id');
            if (empty($course_id) && empty($id)) {
                $insArr =   [
                    'name'                  =>  $formData['course_name'],
                    'slug'                  =>  $formData['slug'],
                    'metatitle'             =>  $formData['metatitle'] ?? '',
                    'metadescription'       =>  $formData['metadescription'] ?? '',
                    'metakeywords'          =>  $formData['metakeywords'] ?? '',
                    'course_category_id'    =>  $formData['course_category_id'],
                    // 'membership_level_id'   =>  $formData['membership_level_id'] ,
                    'course_type'           =>  $formData['course_type'],
                    'description'           =>  $formData['description'],
                    'status'                =>  $formData['status'],
                    'price'                 =>  $formData['price'],
                    'page_tags'             =>  $formData['page_tags'],
                    'created_at'            =>  date('Y-m-d H:i:s'),
                    'updated_at'            =>  date('Y-m-d H:i:s')
                ];
                $insert_id = $this->database->_insert_to_DB('tbl_course', $insArr);
                $insArrMedia    =   [
                    'course_id'     =>  $insert_id,
                    'created_at'    =>  date('Y-m-d H:i:s'),
                    'updated_at'    =>  date('Y-m-d H:i:s')
                ];

                if ($imageName != 'N/A' &&   $imageType != 'N/A') {
                    $insArrMedia['name']        =   $imageName;
                    $insArrMedia['type']        =   $imageType;
                }
                $this->database->_insert_to_table('tbl_course_media', $insArrMedia);
                redirect('admin/list_courses');
            } else  if (!empty($course_id) && empty($id)) {
                $upArr =   [
                    'name'                  =>  $formData['course_name'],
                    'slug'                  =>  $formData['slug'],
                    'metatitle'             =>  $formData['metatitle'] ?? '',
                    'metadescription'       =>  $formData['metadescription'] ?? '',
                    'metakeywords'          =>  $formData['metakeywords'] ?? '',
                    'course_category_id'    =>  $formData['course_category_id'],
                    'membership_level_id'   =>  $formData['membership_level_id'],
                    'course_type'           =>  $formData['course_type'],
                    'description'           =>  $formData['description'],
                    'status'                =>  $formData['status'],
                    'price'                 =>  $formData['price'],
                    'page_tags'             =>  $formData['page_tags'],
                    'updated_at'            =>  date('Y-m-d H:i:s')
                ];

                $this->database->_update_to_table('tbl_course', $upArr, ['id' => $course_id]);
                if (!empty($imageName)) {
                    $insArrMedia    =   [
                        'created_at'    =>  date('Y-m-d H:i:s'),
                        'updated_at'    =>  date('Y-m-d H:i:s')
                    ];
                    if ($imageName != 'N/A' &&   $imageType != 'N/A') {
                        $insArrMedia['name']        =   $imageName;
                        $insArrMedia['type']        =   $imageType;
                    }
                    $this->database->_update_to_table('tbl_course_media', $insArrMedia, ['course_id'  =>  $course_id]);
                }
                redirect('admin/list_courses');
            }
        }
        $data['courses'] = "";
        $data['pageHeader'] = "Add Course";
        if (!empty($id)) {
            $data['courses'] = $this->database->_get_courses($id)[0];
            $data['pageHeader'] = "Edit Course";
        }


        //pre($data['courses'] , 1);


        $data = html_escape($this->security->xss_clean($data));
        $data['courseCategories']     =   $this->database->_get_row_data('tbl_course_category', ['status' => 1]);
        $data['membershipLevels']     =   $this->database->_get_row_data('tbl_membership_level', ['status' => 1]);
        $this->load->view('admin/add-courses', $data);
        return;
    }
    public function list_courses($page = 1)
    {
        $data = self::$data;
        $table              =   'tbl_course';
        $url                =   "admin/list_courses";
        $perPage            =  PERPAGE;
        $data               = html_escape($this->security->xss_clean($data));
        $data['records']    = $this->database->_get_courses('', $perPage, $page);
        $data['links']      =   $this->pagination_loader($url, $table, $perPage,  $sort = "");

        $this->load->view('admin/listing-courses', $data);
        return;
    }
    public function view_lession($course_id = '')
    {

        if (empty($course_id)) {
            redirect('admin/list_courses');
        }
        $data = self::$data;
        $table          =   'tbl_course_lession';
        $url            =   "admin/view_lession/$course_id";
        $perPage        =   PERPAGE;
        $page           =    !empty($_GET['per_page']) ? $_GET['per_page'] : 1;
        $data = html_escape($this->security->xss_clean($data));
        $data['records'] = $this->database->_get_lession($table, $course_id,  $perPage, $page);

        $data['links']          =   $this->pagination_loader_lession($url, $table, $perPage,  $course_id);
        if (!empty($course_id)) {
            $data['course'] = $this->database->_get_courses($course_id)[0];
        }
        $this->load->view('admin/view-lession', $data);
        return;
    }

    public function add_lession($course_id = "")
    {
        $data = self::$data;
        $data['course_id'] = $course_id;
        $formData = $this->input->post();
        if (isset($formData) && !empty($formData)) {
            $lession_id = $this->input->post('id');

            if (empty($lession_id)) {
                $insArr =   [
                    'name'          =>  $formData['lession_name'],
                    'course_id'     =>  $formData['course_id'],
                    'description'   =>  $formData['lession_description'],
                    'vimeo_id'      =>  $formData['vimeo_id'],
                    'status'        =>  $formData['status'],
                    'created_at'    =>  date('Y-m-d H:i:s'),
                    'updated_at'    =>  date('Y-m-d H:i:s')
                ];
                $this->database->_insert_to_table('tbl_course_lession', $insArr);
                redirect('admin/view_lession/' . $formData['course_id']);
            } else  if (!empty($lession_id)) {
                $upArr =   [
                    'name'           =>  $formData['lession_name'],
                    'course_id'      =>  $formData['course_id'],
                    'description'    =>  $formData['lession_description'],
                    'vimeo_id'       =>  $formData['vimeo_id'],
                    'status'         =>  $formData['status'],
                    'updated_at'     =>  date('Y-m-d H:i:s')
                ];

                $this->database->_update_to_table('tbl_course_lession', $upArr, ['id' => $lession_id]);
                redirect('admin/view_lession/' . $formData['course_id']);
            }
        }
        if (!empty($course_id)) {
            $data['course'] = $this->database->_get_courses($course_id)[0];
        }

        $data['pageHeader'] = "Add Lesson";
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/add-lession', $data);
        return;
    }

    public function checkVimeoNumber()
    {
        $vimeo_id = $this->input->post('vimeo_number');
        $course_id =  $this->input->post('course_id');
        $lesson_id =  $this->input->post('lesson_id');

        $condition = ['vimeo_id' => $vimeo_id, 'course_id' => $course_id];
        $data = $this->database->_get_row_data('tbl_course_lession', $condition);
        if (!empty($data)) { // if vimeo id  present in course
            if (!empty($lesson_id)) {  // if exist in course have lesson id
                $condition = ['vimeo_id' => $vimeo_id, 'course_id' => $course_id, 'id' => $lesson_id];
                $datal = $this->database->_get_row_data('tbl_course_lession', $condition);

                if (!empty($datal)) { // update same recode
                    $output['vimeo_id']  = 0;
                } else { // can not update same vimeo id in same course
                    $output['vimeo_id']  = 1;
                }
            } else { // can not add same vimeo id in course
                $output['vimeo_id']  = 1;
            }
        } else { // if vimeo id not exists then added 
            $output['vimeo_id']  = 0;
        }
        // }


        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        exit(json_encode($output));
    }

    public function free_lesson()
    {

        if (!empty($this->input->post())) {

            $formData       =   $this->input->post();
            $lessonId       =   $formData['lessonId'];
            $status         =   $formData['status'];
            if ($status == 0) {
                $status = 1;
            } else {
                $status = 0;
            }
            $table = "tbl_course_lession";
            $result     =   $this->database->_update_to_DB($table, ['free_view' => $status], $lessonId);

            if ($result == 1) {
                $output['response'] = "success";
            } else {
                $output['response'] = "error";
            }
        }
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        exit(json_encode($output));
    }

    public function delete_course()
    {

        $formData = $this->input->post();
        if ($formData['course_id'] != null) {
            $result =  $this->database->_deleteCourseLesson($formData['course_id'], 0, 0);
            if ($result == 1) {
                $output['response'] = "success";
            } else {
                $output['response'] = "error";
            }
        }

        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        exit(json_encode($output));
    }



    public function edit_lession($lesson_id)
    {
        $data = self::$data;
        if (!empty($lesson_id)) {
            $data['records'] = $this->database->_get_row_data('tbl_course_lession', ['id' => $lesson_id]);
            $courseName = $this->database->_get_single_data('tbl_course', ['id' => $data['records'][0]['course_id']], 'name');
            $data['course']['name'] = $courseName;
        }
        $data['pageHeader'] = "Edit Lesson";
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/add-lession', $data);
        return;
    }

    // delete lesson 
    public function delete_lesson($id = 0)
    {

        if ($id != 0) {
            $result =  $this->database->_deleteCourseLesson(0, $id, 0);
            if ($result == 1) {
                $output['response'] = 1;
            } else {
                $output['response']   = 0;
                $output['type']  = " Users";
            }
        }




        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        exit(json_encode($output));
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
        $data['solutionListing']       = $this->database->_userwise_solution_listings('', $perpage, $page, $search);

        if (empty($search)) {
            $data["links"]             =     $this->solutions_pagination_loader();
        }
        // $data["links"]             =     $this->solutions_pagination_loader();

        $response                     = $this->load->view('admin/includes/manage-solution-listings-ajax', $data, TRUE);
        $data['response']             = $response;

        $data['token']         = $this->security->get_csrf_hash();
        echo json_encode($data);
        exit;
    }



    public function solution_listings()
    {
        $this->checkPermission();

        $data = self::$data;
        $page                           = !empty($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $data['solutionListing']         =  $this->database->_userwise_solution_listings('', PERPAGE, $page);
        $data["links"]                   =     $this->solutions_pagination_loader();
        $this->load->view('admin/solution-listings', $data);
        return;
    }


    /*solutions list pagination creator*/
    public function solutions_pagination_loader($count = '')
    {

        $config = array();
        $config["base_url"]                     = site_url('admin/solution_listings');
        $config["total_rows"]                   = !empty($count) ? $count : $this->database->_total_results_count('tbl_solutions');
        $config["per_page"]                     = PERPAGE;
        $config['use_page_numbers']             = TRUE;

        $config['num_tag_open']                 = '<li class="ripple-effect">';
        $config['num_tag_close']                 = '</li>';
        $config['cur_tag_open']                 = '<li><a class="ripple-effect current-page">';
        $config['cur_tag_close']                = '</a></li>';
        $config['prev_tag_open']                 = '<li class="pagination-arrow">';
        $config['prev_tag_close']                 = '</li>';
        $config['first_tag_open']                 = '<li class="ripple-effect">';
        $config['first_tag_close']                = '</li>';
        $config['last_tag_open']                 = '<li class="ripple-effect">';
        $config['last_tag_close']                 = '</li>';

        $config['prev_link']                     = '<i class=" mdi mdi-chevron-left"></i>';
        $config['prev_tag_open']                 = '<li class="pagination-arrow">';
        $config['prev_tag_close']                 = '</li>';


        $config['next_link']                     = '<i class=" mdi mdi-chevron-right"></i>';
        $config['next_tag_open']                 = '<li class="pagination-arrow">';
        $config['next_tag_close']                 = '</li>';

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }


    public function addSolutionToList($udata)
    {

        $list_id = $udata['list_id'] ?? 0;

        if (!empty($list_id)) {
            $data = [];
            //     'website_buynowprice'       => $udata['price'] ?? 0,
            //     'deliver_in'                => $udata['delivery_days'] ?? 0,
            //     'website_minimumoffer'      => $udata['website_minimumoffer'] ?? 0,
            //     'website_discountprice'     => $udata['website_discountprice'] ?? 0,
            //     'original_minimumoffer'     => $udata['original_minimumoffer'] ?? 0,
            //     'original_buynowprice'      => $udata['original_buynowprice'] ?? 0,
            //     'original_discountprice'    => $udata['original_discountprice'] ?? 0,
            //     'commission_type'           => $udata['commission_type'] ?? 0,
            //     'commission_user_product'     => $udata['commission_user_product'] ?? 0,
            //     'commission_amount'         => $udata['commission_amount'] ?? 0,
            // ];

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
                $this->database->_update_to_DB('tbl_listings', $data, $list_id);
            }
        }
    }
    public function addSolution($solution_id = "")
    {

        $deviceData         = $this->common->detectVisitorDevice();
        $output['token']      = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $list = [];
        if ($this->input->post('step') == 1) {
            if (!empty($this->input->post('solution_id'))) {

                $dataUp = array(
                    'name' => $this->input->post('name'),
                    'slug' => $this->input->post('slug'),
                    'solution_url' => $this->input->post('solution_url') ?? '',
                    'description' => $this->input->post('description'),

                );
                $token  = $this->common->_generate_unique_tokens('tbl_domains');
                $dataUpDomain = array(
                    'domain' => $dataUp['name'],
                );
                $this->database->_update_to_DB('tbl_domains', $dataUpDomain, $this->input->post('domain_id'));
                $list = [
                    'website_BusinessName' => $dataUp['name'],
                    'list_id' => $this->input->post('list_id'),
                    'domain_id' => $this->input->post('domain_id'),
                ];
            }
        }



        if ($this->input->post('step') == 3) {
            if (!empty($this->input->post('solution_id'))) {
                $dataUp = array(
                    'category_id'     => $this->input->post('category_id') ?? '',
                    'sub_category_id' => $this->input->post('sub_category_id') ?? '',
                    'service_type_id' => $this->input->post('service_type_id'),
                    'page_tags'       => $this->input->post('page_tags')
                );

                $list = [
                    'list_id' => $this->input->post('list_id'),
                ];
            }
        }


        if ($this->input->post('step') == 4) {
            if (!empty($this->input->post('solution_id'))) {

                // calculate the commission user or product wise... 
                $commission = $this->CommissionUserOrProductWise();

                $dataUp = array(
                    //'price' => $this->input->post('price'),
                    'delivery_days' => $this->input->post('delivery_days'),
                    'frontend_section' => $section ?? '',
                    'title' => $this->input->post('title'),
                    'metadescription' => $this->input->post('metadescription'),
                    'metakeywords'  => $this->input->post('metakeywords'),
                    'status'  => $this->input->post('status'),
                    'price'             =>  !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],

                    'original_minimumoffer'     => $commission['original_minimumoffer'],
                    'original_buynowprice'      => $commission['original_buynowprice'],
                    'original_discountprice'    => $commission['original_discountprice'],
                    'commission_type'           => $commission['commission_type'] ?? 0,
                    'commission_user_product'    => $commission['commission_user_product'] ?? 0,
                    'commission_amount'         => $commission['commission_amount'] ?? 0,
                );

                $list = [
                    'list_id'                   => $this->input->post('list_id'),
                    'website_buynowprice'       => $dataUp['price'],
                    'deliver_in'                => $dataUp['delivery_days'],
                    'website_minimumoffer'      =>    !empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
                    'website_discountprice'     => !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],
                    'original_minimumoffer'     => $commission['original_minimumoffer'] ?? 0,
                    'original_buynowprice'      => $commission['original_buynowprice'] ?? 0,
                    'original_discountprice'    => $commission['original_discountprice'] ?? 0,
                    'commission_type'           => $commission['commission_type'] ?? 0,
                    'commission_user_product'     => $commission['commission_user_product'] ?? 0,
                    'commission_amount'         => $commission['commission_amount'] ?? 0,
                ];
            }
        }

        
        if (!empty($this->input->post('solution_id'))) {
            //$dataUp = array_map("html_entity_decode", html_escape($this->security->xss_clean($dataUp)));
            //pre($dataUp );
            //update sponsorship
            $ListingData 		= $this->database->_get_row_data('tbl_listings', array('solution_id' => $this->input->post('solution_id')));

            $sponsorshipDataHeader 	= $this->database->_get_row_data('tbl_listing_header', array('listing_id' => $this->input->post('sponsorship_priority')));
            $sponsorDataUp = array();
            if($this->input->post('sponsorship_priority') != '' && $ListingData[0]['sponsorship_priority'] != array_search($this->input->post('sponsorship_priority'), LISTING_HEADER_SPONSORSHIP)){

                $sponsorDataUp['sponsorship_priority'] = array_search($this->input->post('sponsorship_priority'), LISTING_HEADER_SPONSORSHIP);            
                $sponsorDataUp['sponsorship_expires'] = 	 Date('Y-m-d H:i:s ', strtotime('+' . $sponsorshipDataHeader[0]['listing_duration'] . ' days'));            
            
            } 
        
            $postData = $this->input->post();
            if(isset($postData['sponsorship_priority']) && $this->input->post('sponsorship_priority') == ''){

                $sponsorDataUp['sponsorship_priority'] = 0;
                $sponsorDataUp['sponsorship_expires'] = null;
            }
            // echo $ListingData[0]['sponsorship_priority'];
            // echo array_search($this->input->post('sponsorship_priority'), LISTING_HEADER_SPONSORSHIP);
            
            $dataUp = array_merge($dataUp, $sponsorDataUp);
            
            if(!empty($sponsorDataUp))
            $this->database->_update_to_DB('tbl_listings', $sponsorDataUp, $ListingData[0]['id']);

            $output['response']      =  $this->database->_update_to_DB('tbl_solutions', $dataUp, $this->input->post('solution_id'));
           
            $this->addSolutionToList($list);

            //update listing header priority             
            if($this->input->post('listing_header_priority') != '') {
               
                $ListingDataHeader 	= $this->database->_get_row_data('tbl_listing_header', array('listing_id' => $this->input->post('listing_header_priority')));
                
                $this->addPlanHeaderIntoListing($ListingDataHeader, $ListingData);
                 
            }           

            $data['id']             =  $this->input->post('solution_id');
            $data['list_id']         =  $this->input->post('list_id');
            $data['domain_id']         = $this->input->post('domain_id');
            $output['response']     = $data;
            exit(json_encode($output));
        }
    }


    public function editUploadImage()
    {
        if (!empty($_FILES['file']['name'])) {
            if ($this->security->xss_clean($_FILES['file']['name'], TRUE) === TRUE) {
                $thumbnail = $this->upload__image('file');
                //$response['token']  	= $this->security->get_csrf_hash();
                $response     = site_url(IMAGES_UPLOAD . $thumbnail);
                //$response = html_escape($this->security->xss_clean($response));
                //header('Content-Type: application/json');
                exit($response);
            }
        }
    }




    public function editSolution($id = 0)
    {

        $data = self::$data;
        $data['listingOptions']	=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => 'solution'));
        $data['sponsorOptions']	=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => 'sponsored'));
        //echo '<pre>';print_r($data['sponsorOptions']);exit;
        if (!empty($id)) {
            $data['solution_data']    =    $this->database->_get_solutionById($id, '');
            $data['soln_title'] = "Edit solutions";
            if (isset($data['solution_data']['solution'][0]['category_id'])) {
                $data['subCategories']    =  $this->database->_get_row_data('tbl_solution_categories', array('parent_id' => $data['solution_data']['solution'][0]['category_id']));
            }
        }
        $data['mainCategories']    =  $this->database->_get_row_data('tbl_solution_categories', array('parent_id' => 0));
        $data['serviceTypes']      =  $this->database->_get_row_data('tbl_solution_service_types', []);
        $data['token']      = $this->security->get_csrf_hash();
        $listing = $this->database->_get_row_data('tbl_listings', array('solution_id' => $id));
        $data['list_id']            = @$listing[0]['id']; //
        $data['domain_id']         = @$listing[0]['domain_id'];
       
        $this->load->view('admin/create-solution-listings', $data);
    }


    public function solutionData()
    {
        $data = self::$data;
        $id = "";
        $id = $this->input->post('sid');

        if (!empty($id)) {
            $data['solution_data']    =    $this->database->_get_solutionById($id, '');
            $data['success'] = 1;
            $data['pageName'] = PAGESNAME;
            $data['section'] = SECTION;
        }
        $data['token']      = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        if (empty($this->input->post('listing_type'))) {
            $data['response']  =  false;
            exit(json_encode($data));
        }
    }

    public function updateSolutionPage()
    {
        // pre($_POST);
        if (!empty($this->input->post('solution_id'))) {
            if (!empty($this->input->post('display_on_page'))) {
                $displayData = $this->input->post('display_on_page');
                $sectionData = $this->input->post('frontend_section');
                $newData = "";
                for ($i = 0; $i < count($displayData); $i++) {
                    $sectionData[$i] = !empty($sectionData[$i]) ? ":" . $sectionData[$i] : '';
                    $newData .=  "," . $displayData[$i] . $sectionData[$i];
                }
                $newData = trim($newData, ',');
            }
            $dataUp = [
                "display_on_page" => $newData ?? '',
            ];
            $this->database->_update_to_DB('tbl_solutions', $dataUp, $this->input->post('solution_id'));
            //$this->session->set_flashdata('sussess_listing', 'Record Successfully Updated');
            redirect("admin/solution_listings");
        }
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

        $deviceData                  = $this->common->detectVisitorDevice();
        $config['upload_path']       = $path;
        // $config['allowed_types']     = 'doc|docx|jpg|png|jpeg|pdf|mp4|ogg|mov|3gp|wmv|xls|xlsx|txt|avi';
        $config['allowed_types']      = 'jpg|png|jpeg';
        $config['max_size']          = 104857600;
        $this->upload->initialize($config);
        $this->upload->overwrite     = false;
        $nameBox                      = $_FILES;
        $errorUploadType              = '';
        $uploadData                  = [];
        $filesCount                  = count($nameBox['file']['name'], true);
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

                    $this->database->_insert_to_DB('tbl_solution_media', $form_data);
                } else {
                    //$errorUploadType .= $this->upload->display_errors() . ' | ';
                    $errorUploadType .= $_FILES['file']['name'];
                }
            }
        } else {
            $statusMsg = 'Please select image files to upload.';
        }

        // $data['images'] = $this->database->_get_row_data('tbl_solution_media', ['solution_id' => $this->input->post('id')]);
        $data['solution_data'] = $this->database->_get_row_data('tbl_solution_media', ['solution_id' => $this->input->post('id')]);
        $data['img_div']    = $this->load->view('admin/partials/_solution_media_ajax', $data, TRUE);
        $data['errorUploadType'] = $errorUploadType;
        $data['uploadData'] = $uploadData;
        $data['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        exit(json_encode($data));
    }
    public function deleteSolutionMedia()
    {
        $id = $this->input->post('solution_id');
        // get file name from db
        $image_name = $this->database->_get_single_data('tbl_solution_media', array('id' => $id), 'name');
        // full path of image
        $fullPath =  IMAGES_UPLOAD . $image_name;

        // delete entry folder from tbl_solution_media table
        $result = $this->database->_delete_from_table('tbl_solution_media', array('id' => $id));
        // if deleted then remove file from folder
        if ($result ==  1) {
            // if file exists the delete file
            if (file_exists($fullPath)) {
                unlink($fullPath);
                $data['file_delete'] = $fullPath;
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

    /*Admin Edit Listings Page*/
    public function edit_listings($type, $id)
    {
        $data = self::$data;
        $data['listingOptions']	=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => $type));
        $data['sponsorOptions']	=	$this->database->_get_row_data('tbl_listing_header', array('listing_type' => 'sponsored'));
        
        if (!empty($type) && !empty($id) && $type == 'website') {
            
            $data['listing_data']             =    $this->database->_get_row_data('tbl_listings', array('id' => $id));

            if (!empty($data['listing_data'][0]['domain_id'])) {
                $data['domainData']           =    $this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
                $data['domainStatics']        =    $this->AnalyticsOperationsHandler->getUsersAndPageViews($id);
                $data['selectedLanguage']     =     $this->common->is_language();

                if (!DECODE_DESCRIPTIONS) {
                    $data = html_escape($this->security->xss_clean($data));
                } else {
                    $data = $this->security->xss_clean($data);
                }
                $data['monetization_options']    =    $this->database->_get_row_data('tbl_common', array('options' => 'monetization_method'));
                //pre( $data['listing_data'] ,1);
                $this->load->view('admin/edit-listings', $data);
                return;
            }
        } else if (!empty($type) && !empty($id) && trim($type) == 'domain') {


            
            $data['listing_data']                    =    $this->database->_get_row_data('tbl_listings', array('id' => $id));

            if (!empty($data['listing_data'][0]['domain_id'])) {
                $data['domainData']                    =    $this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
                $data['selectedLanguage']             =     $this->common->is_language();

                if (!DECODE_DESCRIPTIONS) {
                    $data = html_escape($this->security->xss_clean($data));
                } else {
                    $data = $this->security->xss_clean($data);
                }
                $data = $this->security->xss_clean($data);
                // pre( $data  , 1);
                $this->load->view('admin/edit-domain-listings', $data);
                return;
            }
        } else if (!empty($type) && !empty($id) && $type == 'app') {

            
            $data['listing_data']                    =    $this->database->_get_row_data('tbl_listings', array('id' => $id));
            
            if (!empty($data['listing_data'][0]['website_BusinessName'])) {
                $data['domainData']                    =    $this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
                $data['domainStatics']                =    $this->AnalyticsOperationsHandler->getUsersAndPageViews($id);
                $data['selectedLanguage']             =     $this->common->is_language();

               

                if (!DECODE_DESCRIPTIONS) {
                    $data = html_escape($this->security->xss_clean($data));
                } else {
                    $data = $this->security->xss_clean($data);
                }

                
                $this->load->view('admin/edit-app-listings', $data);
                return;
            }
        } else if (!empty($type) && !empty($id) && $type == 'business') {
            
            $data['listing_data']                    =    $this->database->_get_row_data('tbl_listings', array('id' => $id));
            if (!empty($data['listing_data'][0]['domain_id'])) {
                $data['domainData']                    =    $this->database->_get_row_data('tbl_domains', array('id' => $data['listing_data'][0]['domain_id']));
                $data['domainStatics']                =    $this->AnalyticsOperationsHandler->getUsersAndPageViews($id);
                $data['selectedLanguage']             =     $this->common->is_language();

                if (!DECODE_DESCRIPTIONS) {
                    $data = html_escape($this->security->xss_clean($data));
                } else {
                    $data = $this->security->xss_clean($data);
                }

                //pre( $data, 1 );

                $this->load->view('admin/edit-business-listings', $data);
                return;
            }
        }


        $this->pageNotFound();
    }


    /*Not found Page*/
    public function pageNotFound()
    {
        $this->load->view('main/404');
    }
    public function CommissionUserOrProductWise()
    {

        // get commission type and commission amount
        $commission_type = $this->input->post('commission_type') ?? 0;
        $admin_commission = $this->input->post('commission_amount') ?? 0;



        // get minimum-offer , buy-now , discount-price
        $original_minimumoffer     = $this->input->post('website_minimumoffer') ?? 0;
        $original_buynowprice     = $this->input->post('website_buynowprice') ?  $this->input->post('website_buynowprice') : ($this->input->post('price') ? $this->input->post('price') : 0);
        $original_discountprice = $this->input->post('website_discountprice') ?? 0;
        $commission_user_product =  $this->input->post('commission_base') ?? 0;

        // commission_type == 1 then fixed commission
        if (!empty($commission_type) && $commission_type == 1) {

            $commission_amount         =  $admin_commission;

            if (!empty($original_minimumoffer)) {
                $website_minimumoffer     =     $original_minimumoffer + $admin_commission;
            }
            if (!empty($original_buynowprice)) {
                $website_buynowprice     =     $original_buynowprice  + $admin_commission;
            }
            if (!empty($original_discountprice)) {
                $website_discountprice     =     $original_discountprice + $admin_commission;
            }
        }

        // commission_type == 2 then percentage commission
        if (!empty($commission_type) && $commission_type ==  2) {

            $commission_amount         =  $admin_commission;

            if (!empty($original_minimumoffer)) {
                $commission_amount1         = ($original_minimumoffer * ($admin_commission / 100));
                $website_minimumoffer     =     $original_minimumoffer + $commission_amount1;
            }
            if (!empty($original_buynowprice)) {
                $commission_amount2        = ($original_buynowprice * ($admin_commission / 100));
                $website_buynowprice     =     $original_buynowprice  + $commission_amount2;
            }
            if (!empty($original_discountprice)) {
                $commission_amount3     = ($original_discountprice * ($admin_commission / 100));
                $website_discountprice     =     $original_discountprice + $commission_amount3;
            }
        }

        return [
            'commission_type'             => $commission_type ?? 0,
            'admin_commission'            => $admin_commission ?? 0,
            'original_minimumoffer'        => $original_minimumoffer ?? 0,
            'original_buynowprice'        => $original_buynowprice ?? 0,
            'original_discountprice'     => $original_discountprice ?? 0,
            'commission_user_product'     =>  $commission_user_product ?? 0,
            'commission_amount'         => $commission_amount ?? 0,
            'website_minimumoffer'        => $website_minimumoffer ?? 0,
            'website_buynowprice'        => $website_buynowprice ?? 0,
            'website_discountprice'        => $website_discountprice ?? 0,

        ];
    }

    /*Save Ad Listings*/
    public function add_listing()
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $datas = self::$data;

        $deviceData         = $this->common->detectVisitorDevice();
        $thumbnailCover     = '';
        $thumbnail          = '';
        $uploadVisual       = '';
        $uploadProfitLoss   = '';

        $output['token']      = $this->security->get_csrf_hash();
        header('Content-Type: application/json');



        if (empty($this->input->post('listing_type'))) {
            $output['response']  =  false;
            exit(json_encode($output));
        }


        // calculate the commission user or product wise... 
        $commission = $this->CommissionUserOrProductWise();


        if ($this->input->post('listing_type') === 'domain') {
            //pre($_POST );

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

            $dataUp = array(
                'domain_id' => $this->input->post('domain_id'),
                'listing_type' => $this->input->post('listing_type'),

                'website_BusinessName' => $this->input->post('website_BusinessName'),
                'extension' => end($extesnion),
                'website_age' => $this->input->post('website_age'),
                'business_registeredCountry' => trim($this->input->post('business_registeredCountry')),
                // 'website_industry' => "",
                //'monetization_methods' => 'N/A',
                //'last12_monthsrevenue' => "",
                // 'last12_monthsexpenses' => "",
                // 'annual_profit' => "",
                // 'google_verified' => 0,
                'website_tagline' => $this->input->post('website_tagline'),
                'website_metadescription' => $this->input->post('website_metadescription'),
                'website_metakeywords' => $this->input->post('website_metakeywords'),
                'description' => $this->input->post('editordata'),
                //'website_how_make_money' => "",
                //'website_purchasing_fulfilment' => "",
                //'website_whyselling' => "",
                //'website_suitsfor' => "",

                //'screenshot' => '',
                //'website_cover' => "",
                'status' =>  $this->input->post('status') ?? '9',
                //'sold_status' => 0,
                'deliver_in' => $this->input->post('deliver_in'),
                // 'listing_option' => $listing_option,
                // 'website_startingprice' => $this->input->post('website_startingprice') ?? 0,
                //'website_reserveprice' => $this->input->post('website_reserveprice') ?? 0,
                // 'website_minimumoffer' => $this->input->post('website_minimumoffer') ?? 0,
                // 'website_buynowprice' => $this->input->post('website_buynowprice') ?? 0,
                // 'website_discountprice' => $this->input->post('website_discountprice') ?? 0,

                'website_minimumoffer' =>     !empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
                'website_buynowprice' =>    !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],
                'website_discountprice' => !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],

                'original_minimumoffer' => $commission['original_minimumoffer'] ?? 0,
                'original_buynowprice' => $commission['original_buynowprice'] ?? 0,
                'original_discountprice' => $commission['original_discountprice'] ?? 0,

                'commission_type'   => $commission['commission_type'] ?? 0,
                'commission_user_product' => $commission['commission_user_product'] ?? 0,
                'commission_amount' => $commission['commission_amount'] ?? 0,
                'page_tags' => $this->input->post('page_tags'),
                //'monthly_downloads' => 0,
                // 'app_url' => "n/a",
                //'app_market' => "n/a",
                'user_ip' => $deviceData['ip_address'],
                'date' => date('Y-m-d H:i:s'),
                //'token' => '',
                'slug' => $this->input->post('slug'),
            );
            if (isset($thumbnail) && !empty($thumbnail)) {
               // array_push($dataUp, ['website_thumbnail' =>  $thumbnail]);
               $dataUp['website_thumbnail'] = $thumbnail;
            }
           
            // pre($dataUp,1);
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
            } else {
                $monetization_through = '';
            }
            if (!empty($this->input->post('traffic_sources'))) {
                $traffic_sources = implode(",", $this->input->post('traffic_sources'));
            } else {
                $traffic_sources = '';
            }

            $dataUp  = array(
                'domain_id' => $this->input->post('domain_id'),
                'listing_type' => $this->input->post('listing_type'),

                'website_BusinessName' => $this->input->post('website_BusinessName'),
                'extension' => end($extesnion),
                'website_facebook' => $this->input->post('website_facebook') ?? "",
                'website_twitter' => $this->input->post('website_twitter') ?? "",
                'website_instagram' => $this->input->post('website_instagram') ?? "",
                'established_date' => $this->input->post('established_date') ?? "",
                'six_months_revenue' => $this->input->post('six_months_revenue') ?? "",
                'six_months_profit' => $this->input->post('six_months_profit') ?? "",

                'website_status' => $this->input->post('website_status'),
                'website_age' => $this->input->post('website_age'),
                'business_registeredCountry' => $this->input->post('business_registeredCountry'),
                'website_industry' => $this->input->post('website_industry'),
                //'monetization_methods' => 'N/A',
                'last12_monthsrevenue' => $this->input->post('last12_monthsrevenue') ?? '',
                'last12_monthsexpenses' => $this->input->post('last12_monthsexpenses') ?? '',
                'annual_profit' => $this->input->post('annual_profit') ?? '',
                'google_verified' => 0,

                'website_tagline' => $this->input->post('website_tagline'),
                'website_metadescription' => $this->input->post('website_metadescription'),
                'website_metakeywords' => $this->input->post('website_metakeywords'),
                'description' => $this->input->post('editordata'),
                'website_how_make_money' => $this->input->post('website_how_make_money') ?? "",
                'website_purchasing_fulfilment' => $this->input->post('website_purchasing_fulfilment') ?? "",
                'website_whyselling' => $this->input->post('website_whyselling') ?? "",
                'website_suitsfor' => $this->input->post('website_suitsfor') ?? "",

                'status' =>  $this->input->post('status') ?? '9',
                // 'sold_status' => 0,
                'deliver_in' => $this->input->post('deliver_in'),
                'listing_option' => $listing_option,
                'website_startingprice' => $this->input->post('website_startingprice') ?? 0,
                'website_reserveprice' => $this->input->post('website_reserveprice') ?? 0,
                // 'website_minimumoffer' => $this->input->post('website_minimumoffer') ?? 0,
                // 'website_buynowprice' => $this->input->post('website_buynowprice') ?? 0,
                // 'website_discountprice' => $this->input->post('website_discountprice') ?? 0,


                'website_minimumoffer' =>     !empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
                'website_buynowprice' =>  !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],
                'website_discountprice' => !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],

                'original_minimumoffer' => $commission['original_minimumoffer'],
                'original_buynowprice' => $commission['original_buynowprice'],
                'original_discountprice' => $commission['original_discountprice'],

                'commission_type'   => $commission['commission_type'] ?? 0,
                'commission_user_product' => $commission['commission_user_product'] ?? 0,
                'commission_amount' => $commission['commission_amount'],

                'page_tags' => $this->input->post('page_tags'),
                'monthly_downloads' => 0,
                'app_url' => "n/a",
                'app_market' => "n/a",
                'user_ip' => $deviceData['ip_address'],
                'date' => date('Y-m-d H:i:s'),
                'token' => '',
                'slug' => $this->input->post('slug'),

            );

            $dataUp1 = [
                'monetization_through' => $monetization_through,
                'monetized_since' => $this->input->post('monetized_since') ?? "",
                'traffic_sources' => $traffic_sources,
                'monthly_visitors' => $this->input->post('monthly_visitors') ?? "",
                'sales_support' => $this->input->post('sales_support') ?? 0,
            ];

            if ($this->input->post('website_status') == 'Established') {
                $dataUp = array_merge($dataUp, $dataUp1);
            }
            if (!empty($screenshot)) {
                $dataUp2 = ['screenshot' => $screenshot];
                $dataUp = array_merge($dataUp, $dataUp2);
            }
        } else if ($this->input->post('listing_type') === 'app') {


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

            $dataUp = array(
                'domain_id' => $this->input->post('domain_id'),
                'listing_type' => $this->input->post('listing_type'),
                'website_BusinessName' => $this->input->post('website_BusinessName'),
                'extension' => end($extesnion),
                // 'website_age' => $this->input->post('website_age'),
                'business_registeredCountry' => $this->input->post('business_registeredCountry'),
                'website_industry' => $this->input->post('website_industry'),
                // 'monetization_methods' => 'N/A',
                'last12_monthsrevenue' => $this->input->post('last12_monthsrevenue'),
                'last12_monthsexpenses' => $this->input->post('last12_monthsexpenses'),
                'annual_profit' => $this->input->post('annual_profit'),
                'google_verified' => 0,
                'website_tagline' => $this->input->post('website_tagline'),
                'website_metadescription' => $this->input->post('website_metadescription'),
                'website_metakeywords' =>  $this->input->post('website_metakeywords'),
                'description' => $this->input->post('editordata'),
                'website_how_make_money' => $this->input->post('website_how_make_money'),
                'website_purchasing_fulfilment' => $this->input->post('website_purchasing_fulfilment'),
                'website_whyselling' => $this->input->post('website_whyselling'),
                'website_suitsfor' => $this->input->post('website_suitsfor'),
                //'screenshot' => '',
                'status' =>  $this->input->post('status') ?? '9',
                // 'sold_status' => 0,
                'deliver_in' => $this->input->post('deliver_in'),
                'listing_option' => $listing_option,
                // 'website_startingprice' => $this->input->post('website_startingprice') ?? 0,
                // 'website_reserveprice' => $this->input->post('website_reserveprice') ?? 0,

                // 'website_minimumoffer' => $this->input->post('website_minimumoffer') ?? 0,
                // 'website_buynowprice' => $this->input->post('website_buynowprice') ?? 0,
                // 'website_discountprice' => $this->input->post('website_discountprice') ?? 0,


                'website_minimumoffer' =>     !empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
                'website_buynowprice' =>  !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],
                'website_discountprice' => !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],

                'original_minimumoffer' => $commission['original_minimumoffer'],
                'original_buynowprice' => $commission['original_buynowprice'],
                'original_discountprice' => $commission['original_discountprice'],

                'commission_type'   => $commission['commission_type'] ?? 0,
                'commission_user_product' => $commission['commission_user_product'] ?? 0,
                'commission_amount' => $commission['commission_amount'],


                'website_status' => $this->input->post('website_status'),
                'monthly_downloads' => $this->input->post('monthly_downloads'),
                //'app_url' => $this->input->post('appURL'),
                //'app_market' => $this->common->get_full_domain_url($this->input->post('appURL')),
                'user_ip' => $deviceData['ip_address'],
                'date' => date('Y-m-d H:i:s'),
                'token' => '',
                'established_date' => $this->input->post('established_date') ?? "",
                'monetized_since' => $this->input->post('monetized_since') ?? "",
                'six_months_revenue' => $this->input->post('six_months_revenue') ?? "",
                'six_months_profit' => $this->input->post('six_months_profit') ?? "",
                'monthly_visitors' => $this->input->post('monthly_visitors') ?? "",
                'page_tags' => $this->input->post('page_tags'),
                'slug' => $this->input->post('slug'),
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



            $dataUp = array(
                'domain_id' => $this->input->post('domain_id'),
                'listing_type' => $this->input->post('listing_type'),

                'website_BusinessName' => $this->input->post('website_BusinessName'),
                'extension' => '',
                'established_date' => $this->input->post('established_date') ?? "",
                'monetized_since' => $this->input->post('monetized_since') ?? "",
                'six_months_revenue' => $this->input->post('six_months_revenue') ?? "",
                'six_months_profit' => $this->input->post('six_months_profit') ?? "",
                'traffic_sources' =>  "",
                'monthly_visitors' =>  "",
                'monetization_through' => "",
                'website_status' => "",
                'website_age' => "",
                'business_registeredCountry' => $this->input->post('business_registeredCountry'),
                'city' => $this->input->post('city'),
                'website_industry' => $this->input->post('website_industry'),
                'monetization_methods' => 'N/A',
                'last12_monthsrevenue' => $this->input->post('last12_monthsrevenue'),
                'last12_monthsexpenses' => $this->input->post('last12_monthsexpenses'),
                'annual_profit' => $this->input->post('annual_profit'),
                'google_verified' => 0,

                'website_tagline' => $this->input->post('website_tagline'),
                'website_metadescription' => $this->input->post('website_metadescription'),
                'website_metakeywords' => $this->input->post('website_metakeywords'),
                'description' => $this->input->post('editordata'),
                'website_how_make_money' => $this->input->post('website_how_make_money'),
                'website_purchasing_fulfilment' => $this->input->post('website_purchasing_fulfilment'),
                'website_whyselling' => $this->input->post('website_whyselling'),
                'website_suitsfor' => $this->input->post('website_suitsfor'),

                'website_facebook' => $this->input->post('website_facebook'),
                'website_twitter' => $this->input->post('website_twitter'),
                'website_instagram' => $this->input->post('website_instagram'),


                'status' =>  $this->input->post('status') ?? '9',
                'sold_status' => 0,
                'deliver_in' => $this->input->post('deliver_in'),
                'listing_option' => $listing_option,
                'website_startingprice' => $this->input->post('website_startingprice') ?? 0,
                'website_reserveprice' => $this->input->post('website_reserveprice') ?? 0,

                // 'website_minimumoffer' => $this->input->post('website_minimumoffer') ?? 0,
                // 'website_buynowprice' => $this->input->post('website_buynowprice') ?? 0,
                // 'website_discountprice' => $this->input->post('website_discountprice') ?? 0,


                'website_minimumoffer' =>     !empty($commission['website_minimumoffer']) ? $commission['website_minimumoffer'] : $commission['original_minimumoffer'],
                'website_buynowprice' =>  !empty($commission['website_buynowprice']) ? $commission['website_buynowprice']  : $commission['original_buynowprice'],
                'website_discountprice' => !empty($commission['website_discountprice'])  ? $commission['website_discountprice']  : $commission['original_discountprice'],

                'original_minimumoffer' => $commission['original_minimumoffer'],
                'original_buynowprice' => $commission['original_buynowprice'],
                'original_discountprice' => $commission['original_discountprice'],

                'commission_type'   => $commission['commission_type'] ?? 0,
                'commission_user_product' => $commission['commission_user_product'] ?? 0,
                'commission_amount' => $commission['commission_amount'],



                'page_tags' => $this->input->post('page_tags'),

                'monthly_downloads' => 0,
                'app_url' => "n/a",
                'app_market' => "n/a",
                'user_ip' => $deviceData['ip_address'],
                'date' => date('Y-m-d H:i:s'),
                'token' => '',
                'slug' => $this->input->post('slug'),

            );
        }


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

        if (!empty($commission['commission_user_product']) && $commission['commission_user_product'] == 1) {

            $user_id = $this->database->_get_single_data('tbl_listings', array('id' => $this->input->post('listing_id')), 'user_id');
            if (!empty($user_id)) {
                $data = [
                    'commission_type' => $commission['commission_type'],
                    'admin_commission' => $commission['commission_amount']
                ];
                $this->database->_update_to_table('tbl_users', $data, ['user_id' => $user_id]);
            }
        }
        
        //update sponsorship
        $ListingData 		= $this->database->_get_row_data('tbl_listings', array('id' => $this->input->post('listing_id')));

        $sponsorshipDataHeader 	= $this->database->_get_row_data('tbl_listing_header', array('listing_id' => $this->input->post('sponsorship_priority')));
        if($this->input->post('sponsorship_priority') != '' && $ListingData[0]['sponsorship_priority'] != array_search($this->input->post('sponsorship_priority'), LISTING_HEADER_SPONSORSHIP)){

            $dataUp['sponsorship_priority'] = array_search($this->input->post('sponsorship_priority'), LISTING_HEADER_SPONSORSHIP);            
			$dataUp['sponsorship_expires'] = 	 Date('Y-m-d H:i:s ', strtotime('+' . $sponsorshipDataHeader[0]['listing_duration'] . ' days'));
            
        } 
        
        if($this->input->post('sponsorship_priority') == ''){

            $dataUp['sponsorship_priority'] = 0;
			$dataUp['sponsorship_expires'] = 	 null;
        }
        
        $dataUp = array_map("html_entity_decode", html_escape($this->security->xss_clean($dataUp)));
       
        $output['response']  =  $this->database->_update_to_DB('tbl_listings', $dataUp, $this->input->post('listing_id'));

        //update listing header priority
        
        $ListingDataHeader 	= $this->database->_get_row_data('tbl_listing_header', array('listing_id' => $this->input->post('listing_header_priority')));
        
        $this->addPlanHeaderIntoListing($ListingDataHeader, $ListingData);

        exit(json_encode($output));
    }

    // adding listing_header plan and expiry date in tbl_listings table
	public function addPlanHeaderIntoListing($ListingDataHeader, $ListingData)
	{

		$plan_header_id = $ListingDataHeader[0]['listing_id'];
		$listing_duration = $ListingDataHeader[0]['listing_duration'];

		if (!empty($plan_header_id) && !empty($listing_duration)) {
			// get list on which update plan;
			$listing_id = $ListingData[0]['id'];
			$listing_type = $ListingData[0]['listing_type'];
			if ($listing_type == 'domain') {
				$listing_header_priority =  array_search($plan_header_id, LISTING_HEADER_DOMAIN);
				if (empty($listing_header_priority)) {
					$listing_header_priority =  1;
				}
			} else
			if ($listing_type == 'website') {
				$listing_header_priority =  array_search($plan_header_id, LISTING_HEADER_WEBSITE);
				if (empty($listing_header_priority)) {
					$listing_header_priority =  1;
				}
			} else
			if ($listing_type == 'app') {
				$listing_header_priority =  array_search($plan_header_id, LISTING_HEADER_APP);
				if (empty($listing_header_priority)) {
					$listing_header_priority =  1;
				}
			} else
			if ($listing_type == 'business') {
				$listing_header_priority =  array_search($plan_header_id, LISTING_HEADER_BUSINESS);
				if (empty($listing_header_priority)) {
					$listing_header_priority =  1;
				}
			} else if ($listing_type == 'solution') {
				$listing_header_priority =  array_search($plan_header_id, LISTING_HEADER_SOLUTION);
				if (empty($listing_header_priority)) {
					$listing_header_priority =  1;
				}
			}
           
            if($ListingData[0]['listing_header_priority'] != $listing_header_priority){

                //get expire date
                $listing_validate = Date('Y-m-d H:i:s ', strtotime('+' . $listing_duration . ' days'));

                
                $data = [
                    'listing_header_priority' => $listing_header_priority,
                    'listing_header_expiry' => $listing_validate,
                ];
            
                $this->database->_update_to_DB('tbl_listings', $data, $listing_id);
                if ($listing_type == 'solution') {
                    $list = $this->database->_get_row_data('tbl_listings', array('id' => $listing_id));
                    $solution_id = $list[0]['solution_id'];
                    $this->database->_update_to_DB('tbl_solutions', $data, $solution_id);
                }
            }
			
		}
	}

    public function adminPermissions($id = 0)
    {

        $this->checkPermission();

        $data = self::$data;
        if ($id != 0) {
            // get user records
            $data['users'] = $this->database->_get_row_data('tbl_users', ['user_id' => $id]);

            // check use has product or not
            $data['listing'] = $this->database->_get_row_data('tbl_listings', ['user_id' => $id]);
            $data['solutions'] = $this->database->_get_row_data('tbl_solutions', ['user_id' => $id]);
            $data['not_become_admin'] =  0;
            if (count($data['solutions']) > 0 || count($data['listing']) > 0) {
                $data['not_become_admin'] =  1;
            }


            $data['permissions'] = $this->database->getAdminPermission();
            $user_permissions = $this->database->getUserAdminPermission($id);
            if (!empty($user_permissions)) {
                $data['user_permissions'] = array_column($user_permissions, 'id');
            }
            $data = html_escape($this->security->xss_clean($data));
            $this->load->view('admin/admin_permissions', $data);
            return;
        } else {
            $this->pageNotFound();
        }
    }




    public function addAdminPermissions()
    {

        $this->checkPermission();

        $data = self::$data;

        if ($this->input->post('id') != 0) {
            $data['permissions'] = $this->database->getAdminPermission();
            $id =  $this->input->post('id');
            $user = $this->database->_get_row_data('tbl_users', ['user_id' => $id]);


            // check use has product or not
            $data['listing'] = $this->database->_get_row_data('tbl_listings', ['user_id' => $id]);
            $data['solutions'] = $this->database->_get_row_data('tbl_solutions', ['user_id' => $id]);
            $data['not_become_admin'] =  0;
            if (count($data['solutions']) > 0 || count($data['listing']) > 0) {
                $data['not_become_admin'] =  1;
            }
            if (!empty($user) && empty($data['not_become_admin'])) {

                $user = $this->database->_update_to_table('tbl_users', ['user_level' => 0], ['user_id' => $id]);
                $this->database->_delete_from_table('tbl_admin_permission', ['user_id' => $id]);
                $permissions =  $this->input->post('permissions');
                foreach ($permissions as $permission) {
                    $data = ['user_id' => $id, 'menu_id' => $permission];
                    $this->database->_insert_to_table('tbl_admin_permission', $data);
                }
            }
            redirect("admin/admin_permissions/$id");
            return;
        } else {
            $this->pageNotFound();
        }
    }

    /**
     * Assigning membership level to User
     *
     * @param integer $id
     * @return void
     */
    public function membershipPermission($id = 0)
    {
        /**
         * check permssion for sub Admin
         */
        $this->checkPermission();

        $data = self::$data;
        if ($id != 0) {
            $data['permissions'] = $this->database->getMembershipLevelPermission();
            //pre($data['permissions'] , 1 );
            $data['users'] = $this->database->_get_row_data('tbl_users', ['user_id' => $id]);
            $user_membership = $this->database->getUserMembershipLevelPermission($id);

            if (!empty($user_membership)) {
                $data['user_membership'] = array_column($user_membership, 'id');
            }
            $data = html_escape($this->security->xss_clean($data));
            $this->load->view('admin/membership_permission', $data);
            return;
        } else {
            $this->pageNotFound();
        }
    }

    public function addMembershipLevel($id = 0)
    {
        /**
         * check permssion for sub Admin
         */
        $this->checkPermission();
        if ($this->input->post('id') != 0) {
            $id =  $this->input->post('id');
            $membership_level =  $this->input->post('membership_level');
            $user = $this->database->_get_row_data('tbl_users', ['user_id' => $id]);
            if (!empty($user)) {
                // update membership level 
                $dataArr = ['membership_assign_date' => date('Y-m-d'), 'membership_level' => $membership_level];
                $user = $this->database->_update_to_table('tbl_users', $dataArr, ['user_id' => $id]);
                // generate membership level
                $this->common->refreshUserMembershipLevel($membership_level, $id);

                // show success message
                $this->session->set_flashdata('membership', 'Membership successfully assigned');
                redirect("admin/membership-permissions/$id");
            }
            $this->pageNotFound();
            return;
        } else {
            $this->pageNotFound();
        }
    }

    public function user_login($id)
    {
        if (!empty($id)) {
            if (!empty($this->database->AdminLoginUser($id))) {
                $this->deleteAllFileCache();
                $this->session->unset_userdata('user_id');
                $this->session->unset_userdata('user_level');
                $this->database->AdminLoginUser($id);
                redirect(site_url('user/create_listings'));
            } else {
                $this->session->set_userdata('adminMessage', 'You can not login to Admin or SubAdmin');
                redirect(site_url('admin/user_control'));
            }
        }
    }

    public function listing_badges($page = 1)
    {

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/badges', $data);
    }

    public function save_badge_data()
    {
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if (!empty($this->input->post('name'))) {
            $icon = '';
            if (!empty($_FILES['uploadListingImage']['name'])) {
                if ($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === TRUE) {
                    $icon = $this->upload__image('uploadListingImage', CATEGORY_IMAGES);
                }
            }

            $data = array(
                'name' => $this->input->post('name'),
            );

            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');

            if ($this->form_validation->run()) {
                $data = $this->security->xss_clean($data);
                if (!empty($this->input->post('id'))) {
                    if (!empty($icon)) {
                        $data['icon']    = $icon;
                    }
                    $data['updated_at']  = date('Y-m-d H:i:s');
                    $output['response']     = $this->database->_update_to_table('tbl_badges', $data, array('id' => $this->input->post('id')));
                    exit(json_encode($output));
                } else {
                    $data['icon']        = $icon;
                    $data['created_at']  = date('Y-m-d H:i:s');
                    $data['updated_at']  = date('Y-m-d H:i:s');
                    $output['response']     = $this->database->_insert_to_table('tbl_badges', $data);
                    exit(json_encode($output));
                }
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    function save_user_badge()
    {
        $data           =   self::$data;
        $table          =   'tbl_users';
        $url            =   "admin/user_control";
        $formData       =   $this->input->post();
        $this->session->userdata('url', base_url(uri_string()));
        if (!empty($formData)) {
            // update course category
            if (!empty($formData['modalUserId']) && !empty($formData['userBadge'])) {
                $upData = [
                    'badge_id' => $formData['userBadge']
                ];
                $update_id = $formData['modalUserId'];
                $this->database->_update_to_table('tbl_users', $upData, ['user_id' => $update_id]);
                //$this->database->_update_to_DB($table, $upData, $update_id);
                redirect($this->session->userdata('url'));
            }
        }
        redirect('admin/user_control');
    }

    public function manage_advertisements($page = 1)
    {
        fileCache('text_below_main_menu', '',  "delete");
        fileCache('listing_detail_page_left_side', '',  "delete");
        fileCache('listing_detail_page_right_side', '',  "delete");
        fileCache('course_detail_page_left_side', '',  "delete");
        fileCache('course_detail_page_right_side', '',  "delete");
        fileCache('blog_detail_page_left_side', '',  "delete");
        fileCache('blog_detail_page_right_side', '',  "delete");

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/manage-advertisements', $data);
    }

    public function save_advertisement_data()
    {

        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if (!empty($this->input->post('type'))) {
            $icon = '';
            if (!empty($_FILES['uploadListingImage']['name'])) {
                if ($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === TRUE) {
                    $icon = $this->upload__image('uploadListingImage', CATEGORY_IMAGES);
                }
            }

            $data = array(
                'type' => $this->input->post('type'),
            );

            if (trim($this->input->post('text_below_main_menu')) != "") {
                $icon =  $this->input->post('text_below_main_menu');
            }
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('type', 'Type', 'required|trim|xss_clean');

            if ($this->form_validation->run()) {
                $data = $this->security->xss_clean($data);
                if (!empty($this->input->post('id'))) {
                    if (!empty($icon)) {
                        $data['text_or_icon']    = $icon;
                    }
                    $data['updated_at']  = date('Y-m-d H:i:s');
                    $output['response']     = $this->database->_update_to_table('tbl_advertisement', $data, array('id' => $this->input->post('id')));
                    exit(json_encode($output));
                } else {
                    $data['text_or_icon']        = $icon;
                    $data['created_at']  = date('Y-m-d H:i:s');
                    $data['updated_at']  = date('Y-m-d H:i:s');

                    $output['response']     = $this->database->_insert_to_table('tbl_advertisement', $data);
                    exit(json_encode($output));
                }
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    public function manage_email_subscribers($page = 1)
    {

        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/manage-email-subscribers', $data);
    }

    public function manage_coupons($page = 1)
    {
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $this->load->view('admin/manage-coupons', $data);
    }

    public function save_coupon_data()
    {
        $output['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if (!empty($this->input->post('amount'))) {

            $data = array(
                'amount'       => $this->input->post('amount'),
                'discount_type' => $this->input->post('discountType'),
                'discount_code' => $this->input->post('discount_code'),
                'valid_from' => $this->input->post('valid_from'),
                'valid_till' => $this->input->post('valid_till'),
                'status' => $this->input->post('status')
            );

            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('amount', 'Amount', 'required|trim|xss_clean');

            if ($this->form_validation->run()) {

                $data = $this->security->xss_clean($data);


                if (!empty($this->input->post('id'))) {


                    $output['response']     = $this->database->_update_to_table('tbl_coupons', $data, array('id' => $this->input->post('id')));
                    exit(json_encode($output));
                } else {

                    $data['created_date']  = date('Y-m-d H:i:s');
                    $data['created_user']  = $this->session->userdata('user_id');
                    $output['response']     = $this->database->_insert_to_table('tbl_coupons', $data);
                    exit(json_encode($output));
                }
            }
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    /*solutions list pagination creator*/
    public function expertDirectory_loader($count = '')
    {

        $config = array();
        $config["base_url"]                     = site_url('admin/expert-directory');
        $config["total_rows"]                   = !empty($count) ? $count : $this->database->_total_results_count('tbl_expert_directory');
        $config["per_page"]                     = PERPAGE;
        $config['use_page_numbers']             = TRUE;

        $config['num_tag_open']                 = '<li class="ripple-effect">';
        $config['num_tag_close']                 = '</li>';
        $config['cur_tag_open']                 = '<li><a class="ripple-effect current-page">';
        $config['cur_tag_close']                = '</a></li>';
        $config['prev_tag_open']                 = '<li class="pagination-arrow">';
        $config['prev_tag_close']                 = '</li>';
        $config['first_tag_open']                 = '<li class="ripple-effect">';
        $config['first_tag_close']                = '</li>';
        $config['last_tag_open']                 = '<li class="ripple-effect">';
        $config['last_tag_close']                 = '</li>';

        $config['prev_link']                     = '<i class=" mdi mdi-chevron-left"></i>';
        $config['prev_tag_open']                 = '<li class="pagination-arrow">';
        $config['prev_tag_close']                 = '</li>';


        $config['next_link']                     = '<i class=" mdi mdi-chevron-right"></i>';
        $config['next_tag_open']                 = '<li class="pagination-arrow">';
        $config['next_tag_close']                 = '</li>';

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function expertDirectory($pageNo = 0)
    {
        $data = self::$data;
        $page                          = !empty($pageNo) ? $pageNo : 1;
        $data['experts']               = $this->database->getExpertById('all', PERPAGE, $page);
        $data["links"]                 = $this->expertDirectory_loader();
        $this->load->view('admin/expert-directory', $data);
    }

    public function editExpert($id = 0)
    {

        if ($id !== 0) {
            $data = self::$data;
            $data['expert']               = $this->database->getExpertById($id);
        }
        $this->load->view('admin/become_expert', $data);
    }

    // /admin/addProfileBecomeExpert
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
                'admin_approved' => $rdata['admin_approved'] ?? 0,
                'updated_date' => date('Y-m-d H:i:s'),
            ];

            if (!empty($thumbnail)) {
                $UpData = array_merge($UpData, ['profile_image' => $thumbnail]);
            }
            $this->database->_update_to_table('tbl_expert_directory', $UpData, ['user_id' => $rdata['id']]);
            $this->session->set_flashdata('expert_msg', 'Updated Record Successfully');
        }
        redirect("admin/edit-expert/" . $this->input->post('id'));
    }

    public function searchExpert()
    {

        $data = self::$data;
        $page                          = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $search                        = $this->input->post('search') ?? '';
        if (empty($search)) {
            $perpage = PERPAGE;
        } else {
            $perpage = '';
        }
        $data['experts']       = $this->database->getExpertById('', $perpage, $page, $search);

        if (empty($search)) {
            $$data["links"]            = $this->expertDirectory_loader();
        }
        // $data["links"]             =     $this->solutions_pagination_loader();

        $response                     = $this->load->view('admin/includes/expert_directory_ajax', $data, TRUE);
        $data['response']             = $response;

        $data['token']         = $this->security->get_csrf_hash();
        echo json_encode($data);
        exit;
    }

    public function deleteExpert()
    {
        $expertId = $this->input->post('expert_id');
        if (!empty($expertId)) {
            $this->database->_delete_from_table('tbl_expert_directory', ['id' => $expertId]);
        }

        $data['token'] = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        exit(json_encode($data));
    }




    // save user commission 
    public function save_user_commission()
    {
        $data    = self::$data;
        $rawData = $this->input->post();
        if (!empty($rawData['commissionUserId']) && !empty($rawData['admin_commission']) && !empty($rawData['commission_type'])) {
            $insArr = [
                'admin_commission' => $this->input->post('admin_commission'),
                'commission_type'  => $this->input->post('commission_type')
            ];
            $user_id = $this->input->post('commissionUserId');
            $this->database->_update_to_table('	tbl_users', $insArr, ['user_id' => $user_id]);

            // Only App , Domain , website , business
            // prepareing data for update
            $rows = $this->database->getListing($user_id);

            if (!empty($rows)) {
                $preData = [];
                $temp = [];
                foreach ($rows as $k => $v) {
                    $temp = [
                        'id' => $v['id'],
                        'admin_commission' => $insArr['admin_commission'],
                        'commission_type' => $insArr['commission_type'],
                        'original_minimumoffer' => $v['original_minimumoffer'],
                        'original_buynowprice' => $v['original_buynowprice'],
                        'original_discountprice' => $v['original_discountprice'],
                        'commission_user_product' => 1,
                    ];
                    $preData[] = $this->prepareDataCommissionUserWise($temp);
                }

                // all rows update atOnce. listing
                $this->database->update_batch('tbl_listings', $preData, 'id');
            }

            // Only solution
            // prepareing data for update
            $rows1 = $this->database->getListingSolution($user_id);

            if (!empty($rows1)) {
                $preData1 = [];
                $temp1 = [];
                foreach ($rows1 as $k => $v) {
                    $temp1 = [
                        'id' => $v['id'],
                        'admin_commission' => $insArr['admin_commission'],
                        'commission_type' => $insArr['commission_type'],
                        'original_minimumoffer' => $v['original_minimumoffer'],
                        'original_buynowprice' => $v['original_buynowprice'],
                        'original_discountprice' => $v['original_discountprice'],
                        'commission_user_product' => 1,
                    ];
                    $preData1[] = $this->prepareDataCommissionUserSolutionWise($temp1);
                }

                // adding data into solution
                $this->database->update_batch('tbl_solutions', $preData1, 'id');
            }
        }
        redirect('admin/user_control');
    }

    // prepare data fpr commissions user wise .
    public function prepareDataCommissionUserWise($temp = [])
    {

        extract($temp);

        // commission_type == 1 then fixed commission
        if (!empty($commission_type) && $commission_type == 1) {

            $commission_amount         =  $admin_commission;

            if (!empty($original_minimumoffer)) {
                $website_minimumoffer     =     $original_minimumoffer + $admin_commission;
            }
            if (!empty($original_buynowprice)) {
                $website_buynowprice     =     $original_buynowprice  + $admin_commission;
            }
            if (!empty($original_discountprice)) {
                $website_discountprice     =     $original_discountprice + $admin_commission;
            }
        }

        // commission_type == 2 then percentage commission
        if (!empty($commission_type) && $commission_type ==  2) {

            $commission_amount         =  $admin_commission;

            if (!empty($original_minimumoffer)) {
                $commission_amount1         = ($original_minimumoffer * ($admin_commission / 100));
                $website_minimumoffer     =     $original_minimumoffer + $commission_amount1;
            }
            if (!empty($original_buynowprice)) {
                $commission_amount2        = ($original_buynowprice * ($admin_commission / 100));
                $website_buynowprice     =     $original_buynowprice  + $commission_amount2;
            }
            if (!empty($original_discountprice)) {
                $commission_amount3     = ($original_discountprice * ($admin_commission / 100));
                $website_discountprice     =     $original_discountprice + $commission_amount3;
            }
        }

        return [
            'id'                        => $id,
            'commission_type'             => $commission_type ?? 0,
            'original_minimumoffer'        => $original_minimumoffer ?? 0,
            'original_buynowprice'        => $original_buynowprice ?? 0,
            'original_discountprice'     => $original_discountprice ?? 0,
            'commission_user_product'     =>  $commission_user_product ?? 0,
            'commission_amount'         => $commission_amount ?? 0,
            'website_minimumoffer'        => $website_minimumoffer ?? 0,
            'website_buynowprice'        => $website_buynowprice ?? 0,
            'website_discountprice'        => $website_discountprice ?? 0,

        ];
    }
    // prepare data for commissions user soluiton wise .
    public function prepareDataCommissionUserSolutionWise($temp = [])
    {

        extract($temp);

        // commission_type == 1 then fixed commission
        if (!empty($commission_type) && $commission_type == 1) {

            $commission_amount         =  $admin_commission;

            if (!empty($original_minimumoffer)) {
                $website_minimumoffer     =     $original_minimumoffer + $admin_commission;
            }
            if (!empty($original_buynowprice)) {
                $website_buynowprice     =     $original_buynowprice  + $admin_commission;
            }
            if (!empty($original_discountprice)) {
                $website_discountprice     =     $original_discountprice + $admin_commission;
            }
        }

        // commission_type == 2 then percentage commission
        if (!empty($commission_type) && $commission_type ==  2) {

            $commission_amount         =  $admin_commission;

            if (!empty($original_minimumoffer)) {
                $commission_amount1         = ($original_minimumoffer * ($admin_commission / 100));
                $website_minimumoffer     =     $original_minimumoffer + $commission_amount1;
            }
            if (!empty($original_buynowprice)) {
                $commission_amount2        = ($original_buynowprice * ($admin_commission / 100));
                $website_buynowprice     =     $original_buynowprice  + $commission_amount2;
            }
            if (!empty($original_discountprice)) {
                $commission_amount3     = ($original_discountprice * ($admin_commission / 100));
                $website_discountprice     =     $original_discountprice + $commission_amount3;
            }
        }

        return [
            'id'                        => $id,
            'commission_type'             => $commission_type ?? 0,
            'commission_amount'            => $admin_commission ?? 0,
            'original_minimumoffer'        => $original_minimumoffer ?? 0,
            'original_buynowprice'        => $original_buynowprice ?? 0,
            'original_discountprice'     => $original_discountprice ?? 0,
            'commission_user_product'     =>  $commission_user_product ?? 0,
            'commission_amount'         => $commission_amount ?? 0,
            'price'        => $website_buynowprice ?? 0,
        ];
    }

    // get commission type and admin-commission User wise
    public function getUserCommission()
    {
        $data                   = self::$data;
        $listing_id             =  $this->input->post('listing_id');
        if (!empty($listing_id)) {
            $listing        =  $this->database->_get_row_data('tbl_listings', ['id' =>  $listing_id]);
            if ($listing) {
                $user_id = $listing[0]['user_id'];
                $user        =  $this->database->_get_row_data('tbl_users', ['user_id' =>  $user_id]);


                $data['commission_type'] = $user[0]['commission_type'] ?? 0;
                $data['admin_commission'] = $user[0]['admin_commission'] ?? 0;
            }
        }
        $data['token']          = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        exit(json_encode($data));
    }
    // get commission type and admin-commission product list wise
    public function getUserProductCommission()
    {

        $data                   = self::$data;
        $listing_id             =  $this->input->post('listing_id');
        if (!empty($listing_id)) {
            $listing        =  $this->database->_get_row_data('tbl_listings', ['id' =>  $listing_id]);
            if ($listing) {
                $data['commission_type'] = $listing[0]['commission_type'] ?? 0;
                $data['admin_commission'] = $listing[0]['commission_amount'] ?? 0;
            }
        }

        $data['token']          = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        exit(json_encode($data));
    }


    // get commission type and admin-commission User wise for solution
    public function getUserCommissionSolution()
    {
        $data                   = self::$data;
        $listing_id             =  $this->input->post('listing_id');
        if (!empty($listing_id)) {
            $listing        =  $this->database->_get_row_data('tbl_solutions', ['id' =>  $listing_id]);
            if ($listing) {
                $user_id = $listing[0]['user_id'];
                $user        =  $this->database->_get_row_data('tbl_users', ['user_id' =>  $user_id]);
                $data['commission_type'] = $user[0]['commission_type'] ?? 0;
                $data['admin_commission'] = $user[0]['admin_commission'] ?? 0;
            }
        }
        $data['token']          = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        exit(json_encode($data));
    }
    // get commission type and admin-commission product list wise for solutions
    public function getUserProductCommissionSolution()
    {
        $data                   = self::$data;
        $listing_id             =  $this->input->post('listing_id');
        if (!empty($listing_id)) {
            $listing        =  $this->database->_get_row_data('tbl_solutions', ['id' =>  $listing_id]);
            if ($listing) {
                $data['commission_type'] = $listing[0]['commission_type'] ?? 0;
                $data['admin_commission'] = $listing[0]['commission_amount'] ?? 0;
            }
        }
        $data['token']          = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        exit(json_encode($data));
    }

    //  purchanse membersip level


    public function allUsersMembershipList()
    {
        $data    = self::$data;
        $page                       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $data['membership_details'] =  $this->database->getCurrentMembershipPlan('', PERPAGE, $page);
        $data["links"]              =     $this->membership_pagination_loader();
        $this->load->view('admin/membership_user', $data);
    }


    public function userWiseMembershipList($id = 0)
    {
        if (!empty($id)) {
            $data    = self::$data;
            $data['membership_details']  =  $this->database->getCurrentMembershipPlan($id);
            // $data['membership_history'] =  $this->database->getMembershipPlanHistory($this->session->userdata('user_id'), $data['membership_details'][0]['membership_level']);
            $data['all_plans'] = $this->database->_get_row_data('tbl_membership_level', '');
            $data['membership_history'] =  $this->database->getMembershipPlanHistory($id);
            $this->load->view('admin/user-wise-membership-list', $data);
        } else {
            redirect('admin/users-membership-list');
        }
    }
    public function membership_purchase_search()
    {

        $data = self::$data;
        $page                          = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        $search                        = $this->input->post('search') ?? '';
        if (empty($search)) {
            $perpage = PERPAGE;
        } else {
            $perpage = '';
        }
        $data['membership_details']       = $this->database->getCurrentMembershipPlan('', $perpage, $page, $search);
        if (empty($search)) {
            $data["links"]             =     $this->membership_pagination_loader();
        }
        $response                     = $this->load->view('admin/partials/_membership_user_ajax', $data, TRUE);
        $data['response']             = $response;
        $data['token']         = $this->security->get_csrf_hash();
        echo json_encode($data);
        exit;
    }


    /*solutions list pagination creator*/
    public function membership_pagination_loader($count = '')
    {

        $config = array();
        $config["base_url"]                     = site_url('admin/users-membership-list');
        $config["total_rows"]                   = !empty($count) ? $count : count($this->database->getCurrentMembershipPlan('', '', '', '', 11));
        $config["per_page"]                     = PERPAGE;
        $config['use_page_numbers']             = TRUE;

        $config['num_tag_open']                 = '<li class="ripple-effect">';
        $config['num_tag_close']                 = '</li>';
        $config['cur_tag_open']                 = '<li><a class="ripple-effect current-page">';
        $config['cur_tag_close']                = '</a></li>';
        $config['prev_tag_open']                 = '<li class="pagination-arrow">';
        $config['prev_tag_close']                 = '</li>';
        $config['first_tag_open']                 = '<li class="ripple-effect">';
        $config['first_tag_close']                = '</li>';
        $config['last_tag_open']                 = '<li class="ripple-effect">';
        $config['last_tag_close']                 = '</li>';

        $config['prev_link']                     = '<i class=" mdi mdi-chevron-left"></i>';
        $config['prev_tag_open']                 = '<li class="pagination-arrow">';
        $config['prev_tag_close']                 = '</li>';


        $config['next_link']                     = '<i class=" mdi mdi-chevron-right"></i>';
        $config['next_tag_open']                 = '<li class="pagination-arrow">';
        $config['next_tag_close']                 = '</li>';

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function manage_pages_tags($page = 1)
    {
        $data = self::$data;
        $data = html_escape($this->security->xss_clean($data));
        $data['pageTags'] = WEBSITE_ALL_PAGES;

        $pageTagsData = $this->database->getPageTag();
        $data['pageTagsData'] = $pageTagsData;
        
        $this->load->view('admin/pages-tags', $data);
    }

    function save_pages_tags()
    {
        $data = array(
            'pages' => $this->input->post('pages'),
            'tags' => $this->input->post('tags'),
        );

        $data = $this->security->xss_clean($data);

        $insertArr = array();
        if (count($data['pages']) > 0) {
            for ($i = 0; $i < count($data['pages']); $i++) {
                if (isset($data['pages'][$i]) && isset($data['tags'][$i]) && trim($data['pages'][$i]) != '' && trim($data['tags'][$i]) != '') {
                    $insertArr[] = array(
                        'page'  => $data['pages'][$i],
                        'tags'  => $data['tags'][$i],
                    );
                }
            }
        }

        if (count($insertArr) > 0) {
            $this->database->deletePageTagsData();
            $this->db->insert_batch('tbl_pages_tags', $insertArr);
            fileCache('page_tags', $insertArr);
        }
        redirect('admin/manage-pages-tags');
    }
}
