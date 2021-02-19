<?php defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);

class DatabaseOperationsHandler extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('CommonOperationsHandler', 'common');
    }

    /*Load all settings data*/
    public function getSettingsData()
    {
        $this->db->where('id', 1);
        $query = $this->db->get('tbl_settings');
        return $query->result_array();
    }

    /*Load Userdata*/
    public function getUserData($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('tbl_users');

        if (!empty($query->result_array())) {
            return $query->result_array();
        } else {
            $this->db->where('username', $user_id);
            $query = $this->db->get('tbl_users');
            return $query->result_array();
        }
    }

    /*Load All Languages*/
    public function load_all_languages($json = false)
    {
        $this->db->where('status', 1);
        $query = $this->db->get('tbl_languages');
        return $query->result_array();
    }

    /*Get Default Language*/
    public function GetDefaultLanguage()
    {
        $this->db->where('default_status', '1');
        $query = $this->db->get('tbl_languages');
        return $query->result_array();
    }

    /*Login User*/
    public function LoginUser()
    {
        $this->db->or_where('username', $this->input->post('login_username'));
        $this->db->or_where('email', $this->input->post('login_username'));
        $query = $this->db->get('tbl_users');
        if (isset($query->result_array()[0]['user_id'])) {
            if (!empty($this->input->post('login_password'))) {
                if ($query->result_array()[0]['password'] == md5(trim($this->input->post('login_password')))) {
                    return $query->result_array();
                }
            }
        }
        return;
    }


    /*Login User*/
    public function AdminLoginUser($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('tbl_users');

        if (isset($query->result_array()[0]['user_id']) && !empty($query->result_array()[0]['user_level'])) {
            $this->session->set_userdata('user_id', $query->result_array()[0]['user_id']);
            $this->session->set_userdata('user_level', $query->result_array()[0]['user_level']);
            $this->session->set_userdata('role', 'admin');
            return true;
        }
        return false;
    }

    public function backAdminLogin()
    {
        $this->db->where('user_id', 1);
        $query = $this->db->get('tbl_users');
        if (isset($query->result_array()[0]['user_id'])) {
            $this->session->set_userdata('user_id', $query->result_array()[0]['user_id']);
            $this->session->set_userdata('user_level', $query->result_array()[0]['user_level']);

            return true;
        }
        return false;
    }


    /*Get User Related Contracts*/
    public function _get_my_contracts($open = true)
    {
        $ignore = array(0, 1, 2, 3, 5, 6, 8, 9);
        if ($open) {
            $ignore = array(4, 7);
        }
        $this->db->where_not_in('status', $ignore);
        $this->db->group_start();
        $this->db->where('owner_id', $this->session->userdata('user_id'));
        $this->db->or_where('customer_id', $this->session->userdata('user_id'));
        $this->db->group_end();
        $query = $this->db->get('tbl_opens');
        return $query->result_array();
    }

    /*Count website Listings Userwise*/
    public function _count_listings_user_wise($listing_option = "")
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where_in('status', [1, 9]);
        $this->db->where('solution_id = ', 0);


        if (!empty($listing_option)) {
            $this->db->where('listing_option', $listing_option);
        }
        $query  = $this->db->get('tbl_listings');
        //pre($this->db->last_query());
        return $query->num_rows();
    }


    /*Count solution Listings Userwise*/
    public function _count_solution_listings_user_wise()
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where_in('status', [1, 9]);
        $query  = $this->db->get('tbl_solutions');
        return $query->num_rows();
    }

    /*Registration Availability Checks*/
    public function RegistrationAvailabilityChecks($table, $column, $value)
    {
        $this->db->where($column, $value);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            exit(json_encode('false'));
        }
        exit(json_encode('true'));
    }

    /*Change User Table*/
    public function ChangeUserOnlineStatus($column)
    {
        $data = array(
            $column => $this->input->post('status')
        );
        $this->db->where('user_id', $this->session->userdata('user_id'));
        return $this->db->update('tbl_users', $data);
    }

    /* Existing Listing Domain Check*/
    public function CheckAlreadyExists($table_name, $data, $exclude = '')
    {
        $this->db->from($table_name);
        $this->db->where($data);

        if (!empty($include)) {
            $this->db->where_not_in('user_id', $exclude);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    /* Return Single Column Value*/
    public function _get_single_data($table_name, $data, $returnVal)
    {
        $this->db->from($table_name);
        $this->db->where($data);
        $query = $this->db->get();
        $ret = $query->row();
        if (!empty($ret)) {
            return $ret->$returnVal;
        }
        return;
    }

    /* Return Row Data Array*/
    public function _get_row_data($table_name, $data, $limit = '', $status_limit = false, $or_condition = '')
    {

        if (!empty($data)) {
            $this->db->group_start();
            $this->db->where($data);
            if (!empty($or_condition)) {
                $this->db->or_where($or_condition);
            }
            $this->db->group_end();
        }
        if (!empty($limit)) {
            $query = $this->db->get($table_name, $limit);
            return $query->result_array();
        }

        if ($status_limit) {

            $this->db->where_not_in('status', array(0, 6));
        }

        $query = $this->db->get($table_name);
        // pre($this->db->last_query());
        return $query->result_array();
    }



    /* Return Row Data Array*/
    public function _get_row_single_data($table_name, $condition)
    {
        $this->db->where($condition);
        $query = $this->db->get($table_name);
        return $query->result_array();
    }

    /* Return Row Data Array order by*/
    public function _get_row_data_order($table_name, $order = 'DESC')
    {
        $this->db->order_by('id', $order);
        $query = $this->db->get($table_name);
        return $query->result_array();
    }

    /* Return Row selected column Data Array --al*/
    public function _get_row_selected_data($table_name, $data, $columns = '', $limit = '', $start = '', $search = '', $sort = '')
    {
        if (!empty($data)) {
            $this->db->group_start();
            $this->db->where($data);
            if (!empty($or_condition)) {
                $this->db->or_where($or_condition);
            }
            $this->db->group_end();
        }
        if (!empty($column)) {
            $this->db->select($columns);
        }
        if (!empty($search)) {
            // $this->db->like($search, $keyword);
        }
        if (!empty($sort)) {
            $sortData = explode(":", $sort);
            $this->db->order_by($sortData[0], $sortData[1]);
        } else {
            $this->db->order_by('id', 'desc');
        }
        if (!empty($limit) && !empty($start)) {
            $offset = ($start - 1) * $limit;
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get($table_name);
        $query->result_array();
        return $query->result_array();
    }

    /*Insert Data to Database*/
    public function _insert_to_DB($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    /*Insert to Table*/
    public function _insert_to_table($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    /*Update Table */
    public function _update_to_DB($table, $data, $update_id)
    {
        $this->db->where('id', $update_id);
        return $this->db->update($table, $data);
    }

    /*Update Given Column Table */
    public function _update_to_table($table, $data, $conditions)
    {
        $this->db->where($conditions);
        return $this->db->update($table, $data);
    }

    /*Update Given Column Table */
    public function _update_to_table_not_in($table, $data, $column, $conditions)
    {
        $this->db->where_not_in($column, $conditions);
        return $this->db->update($table, $data);
    }

    /*Delete Data from Table */
    public function _delete_from_table($table, $conditions)
    {
        $this->db->where($conditions);
        return $this->db->delete($table);
    }

    /* Results Count on with table name*/
    public function _total_results_count($table)
    {
        return $this->db
            ->count_all_results($table);
    }
    /* Results Count*/
    public function _results_count($table, $condition, $count = false)
    {
        if ($count) {
            return $this->db
                ->where($condition)
                ->count_all_results($table);
        }

        return $this->db
            ->where($condition)
            ->count_all_results($table) > 0;
    }

    /* Results Count Multiple*/
    public function _multiple_results_count($table, $key, $condition, $count = false)
    {
        if ($count) {
            return $this->db
                ->where_in($condition)
                ->count_all_results($table);
        }

        return $this->db
            ->where_in($key, $condition)
            ->count_all_results($table) > 0;
    }

    /*get statics data*/
    public function _get_statics($table, $select, $condition, $or_condition = '', $distinct = '', $like = '')
    {
        $this->db->select($select);
        $this->db->group_start();
        $this->db->where($condition);
        if (!empty($or_condition)) {
            $this->db->or_where($or_condition);
        }
        $this->db->group_end();
        if (!empty($like)) {
            $this->db->like($like);
        }

        if (!empty($distinct)) {
            $this->db->distinct($distinct);
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }


    /*Update Domain Token Old */
    public function _update_domain_token_old($data)
    {
        $this->db->where('domain', $data['domain']);
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('token', $data['token']);
        if ($this->db->update('tbl_domains', array('status' => 1))) {
            $this->db->group_start();
            $this->db->where('domain', $data['domain']);
            $this->db->where_not_in('user_id', $data['user_id']);
            $this->db->where_not_in('token', $data['token']);
            $this->db->group_end();
            return $this->db->update('tbl_domains', array('status' => 0));
        }
    }

    /*Update Domain Token New */
    public function _update_domain_token($data)
    {
        $this->db->where('domain', $data['domain']);
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('token', $data['token']);

        if ($this->db->update('tbl_domains', array('status' => 1))) {
            //UPDATE OTHER DOMAINS AS UNVERIFIED
            $this->db->group_start();
            $this->db->where('domain', $data['domain']);
            $this->db->where_not_in('user_id', $data['user_id']);
            $this->db->where_not_in('token', $data['token']);
            $this->db->group_end();
            $domain_data = $this->db->get('tbl_domains', 1)->row();
            if (!empty($domain_data)) {
                $domain_id = $domain_data->id;

                $dom_auto_arr = array(
                    'status' => 0,
                    'acc_id' => "",
                    'prop_id' => "",
                    'view_id' => "",
                    'google_token' => "",
                    'google_anastatus' => 0
                );

                $this->db->where('id', $domain_id);
                $this->db->update('tbl_domains', $dom_auto_arr);
            }

            if (!empty($domain_id)) {
                $listing_id = $this->_get_single_data('tbl_listings', array('domain_id' => $domain_id), 'id');
                if (!empty($listing_id)) {
                    $contract_id = $this->_get_single_data('tbl_opens', array('listing_id' => $listing_id), 'contract_id');
                    $status      = $this->_get_single_data('tbl_opens', array('contract_id' => $contract_id), 'status');

                    if (empty($contract_id)) {
                        return $this->_update_to_table('tbl_listings', array('status' => 5), array('id' => $listing_id));
                    }

                    if ($status !== 4 && $status !== 5) {
                        $data = array(
                            'status' => 7,
                            'contract_id' => $contract_id,
                            'remarks' => 'Domain Ownership Changed',
                            'uploads' => '',
                            'user' => $this->_get_single_data('tbl_listings', array('id' => $listing_id), 'user_id')
                        );

                        if ($this->_insert_to_table('tbl_history', $data)) {
                            if ($this->_update_to_table('tbl_opens', array('status' => 7, 'date' => date('Y-m-d H:i:s')), array('contract_id' => $contract_id))) {
                                $invoice_id  = $this->_get_single_data('tbl_contracts', array('contract_id' => $contract_id), 'invoice_id');
                                $data = array(
                                    'status' => 3,
                                    'updated' => date('Y-m-d H:i:s')
                                );
                                $this->_update_to_table('tbl_invoices', $data, array('invoice_id' => $invoice_id));
                                return $this->_update_to_table('tbl_listings', array('status' => 5), array('domain_id' => $domain_id));
                            }
                        }
                    } else {
                        if ($status === 5) {
                            $customer_id    = $this->_get_single_data('tbl_opens', array('contract_id' => $contract_id), 'customer_id');
                            if ($customer_id === $this->session->userdata('user_id')) {
                                $data = array(
                                    'status' => 4,
                                    'contract_id' => $contract_id,
                                    'remarks' => 'Accepted Delivery Automatically',
                                    'uploads' => '',
                                    'user' => $this->_get_single_data('tbl_listings', array('id' => $listing_id), 'user_id')
                                );

                                if ($this->_insert_to_table('tbl_history', $data)) {
                                    if ($this->_update_to_table('tbl_opens', array('status' => 4, 'date' => date('Y-m-d H:i:s')), array('contract_id' => $contract_id))) {
                                        $invoice_id  = $this->_get_single_data('tbl_contracts', array('contract_id' => $contract_id), 'invoice_id');
                                        $data = array(
                                            'status' => 4,
                                            'updated' => date('Y-m-d H:i:s')
                                        );
                                        return $this->_update_to_table('tbl_invoices', $data, array('invoice_id' => $invoice_id));
                                    }
                                }
                            } else {
                                $data = array(
                                    'status' => 7,
                                    'contract_id' => $contract_id,
                                    'remarks' => 'Domain Ownership Changed',
                                    'uploads' => '',
                                    'user' => $this->_get_single_data('tbl_listings', array('id' => $listing_id), 'user_id')
                                );

                                if ($this->_insert_to_table('tbl_history', $data)) {
                                    if ($this->_update_to_table('tbl_opens', array('status' => 7, 'date' => date('Y-m-d H:i:s')), array('contract_id' => $contract_id))) {
                                        $invoice_id  = $this->_get_single_data('tbl_contracts', array('contract_id' => $contract_id), 'invoice_id');
                                        $data = array(
                                            'status' => 3,
                                            'updated' => date('Y-m-d H:i:s')
                                        );
                                        $this->_update_to_table('tbl_invoices', $data, array('invoice_id' => $invoice_id));
                                        return $this->_update_to_table('tbl_listings', array('status' => 5), array('domain_id' => $domain_id));
                                    }
                                }
                            }
                        } else if ($status === 4) {
                            return true;
                        }
                    }
                }
            }
            return true;
        }
    }

    /*Create a Verification File*/
    public function createVerificationFile($dataArr)
    {
        $this->load->helper('file');
        $this->load->library('zip');
        $name = $dataArr['token'] . '.txt';
        $data = $dataArr['token'];
        $this->zip->add_data($name, $data);
        if ($this->zip->archive(VERIFICATION_FILE . $dataArr['token'] . '.zip')) {
            return true;
        } else {
            return false;
        }
    }

    /*Generate Unique IDs*/
    public function _unique_id($table = 'tbl_opens', $method = 'alnum', $condition)
    {
        do {
            if ($table == 'tbl_opens') {
                $salt = mt_rand(1000000000, 9999999999999);
                $new_key = substr($salt, 0, 10);
            } else {
                $new_key = random_string($method, 10);
                $new_key = substr($salt, 0, 10);
            }
        } while ($this->_results_count($table, array($condition => $new_key)));
        return $new_key;
    }

    /*Get Userwise All Listings*/
    public function _userwise_all_listings($userid, $type = '')
    {

        $Arr = array();
        if (!empty($userid)) {
            $this->db->where('user_id', $userid);
        }

        if (!empty($type)) {
            $this->db->where('listing_option', $type);
        }
        $this->db->where_not_in('status', array(0, 6));
        $query  = $this->db->get('tbl_listings');
        $Arr    = $query->result_array();
        if (empty($Arr)) {
            $Arr = array();
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_listings.user_id');
            $this->db->where('tbl_users.username', $userid);
            $this->db->where_not_in('tbl_listings.status', 0);
            $query  = $this->db->get('tbl_listings');
            $Arr    = $query->result_array();
        }
        return $Arr;
    }

    /*Get no of Bids ListingsWise*/
    public function numberOfBids($listing_id, $type, $count = '', $status)
    {
        $this->db->where('listing_id', $listing_id);
        $this->db->where('listing_type', $type);
        if (!empty($status)) {
            $this->db->where('bid_status', $status);
            $this->db->or_where('bid_status', '3');
        }
        $query = $this->db->get('tbl_bids');
        if (empty($count)) {
            return $query->result_array();
        }
        return $query->num_rows();
    }

    /*Get no of Offers ListingsWise*/
    public function numberOfOffers($listing_id, $type, $count = "", $status)
    {
        $this->db->where('listing_id', $listing_id);
        $this->db->where('listing_type', $type);
        if (!empty($status)) {
            $this->db->group_start();
            $this->db->where('offer_status', $status);
            $this->db->or_where('offer_status', '2');
            $this->db->group_end();
        }
        $query = $this->db->get('tbl_offers');
        if (empty($count)) {
            return $query->result_array();
        }
        return $query->num_rows();
    }

    /*Get Highest Bid Details*/
    public function _get_highest_bid_details($status = '1', $listing_id = '', $listing_type = '')
    {
        if (empty($listing_id)) {
            $this->db->where('listing_id', $this->input->post('bid_listing_id'));
        } else {
            $this->db->where('listing_id', $listing_id);
        }

        if (empty($listing_type)) {
            $this->db->where('listing_type', $this->input->post('bid_listing_type'));
        } else {
            $this->db->where('listing_type', $listing_type);
        }
        $this->db->where('bid_status ', $status);
        if ($status !== '3') {
            $this->db->or_where('bid_status ', '3');
        }
        $this->db->order_by('bid_amount', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('tbl_bids');
        return $query->result_array();
    }

    /*Get Highest Offer Details*/
    public function _get_highest_offer_details($status = '1', $listing_id = '', $listing_type = '')
    {
        if (empty($listing_id)) {
            $this->db->where('listing_id', $this->input->post('bid_listing_id'));
        } else {
            $this->db->where('listing_id', $listing_id);
        }

        if (empty($listing_type)) {
            $this->db->where('listing_type', $this->input->post('bid_listing_type'));
        } else {
            $this->db->where('listing_type', $listing_type);
        }

        $this->db->where('offer_status ', $status);
        if ($status !== '2') {
            $this->db->or_where('offer_status ', '2');
        }
        $this->db->order_by('offer_amount', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('tbl_offers');
        return $query->result_array();
    }

    /*Get no of Bidders ListingsWise*/
    public function numberOfBidders($listing_id, $type, $count = "", $status)
    {
        $this->db->where('listing_id', $listing_id);
        $this->db->where('listing_type', $type);
        $this->db->where('bid_status', $status);
        $this->db->group_by('bidder_id');
        $query = $this->db->get('tbl_bids');
        if (empty($count)) {
            return $query->result_array();
        }
        return $query->num_rows();
    }

    /*Auction Ending Date*/
    public function _get_auction_ending_date($id, $table = 'tbl_listings')
    {
        $this->db->select('DATE_ADD(date, INTERVAL ' . $this->getSettingsData()[0]['auction_period'] . ' DAY) AS ENDDATE ', FALSE);
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    /*Get Bids UserDetails*/
    public function _get_all_offers($listing_id, $status = '0', $type, $sort = "tbl_offers.offer_amount", $order = 'DESC', $reviews = "", $owner = 'on')
    {
        $this->db->select('*,DATEDIFF(CURRENT_DATE(), tbl_offers.date) AS nfd,(tbl_offers.date) as offer_date');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_offers.customer_id');

        if (!empty($reviews)) {
        }

        $this->db->where('tbl_offers.listing_id', $listing_id);
        $this->db->where('tbl_offers.listing_type', $type);
        $this->db->where('tbl_offers.offer_status', $status);
        $this->db->or_where('tbl_offers.offer_status', '2');

        if ($owner === 'on') {
            $this->db->where('tbl_offers.owner_id', $this->session->userdata('user_id'));
        }

        $this->db->order_by($sort, $order);
        $query      = $this->db->get('tbl_offers');
        $dataArr    = $query->result_array();

        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']                             = $this->CommonOperationsHandler->time_elapsed_string($key['offer_date']);
                $dataArr[$i]['ratings']                         = number_format($this->get_reviews($key['customer_id'], "", "", "", "", 'avg')[0]['avg_r'], 1);
                $reservedPrice                                  = $this->database->_get_single_data('tbl_listings', array('id' => $key['listing_id'], 'status' => 1), 'website_reserveprice');

                if ($key['offer_amount'] > $reservedPrice) {
                    $dataArr[$i]['reserve']                     = 1;
                } else {
                    $dataArr[$i]['reserve']                     = 0;
                }

                $HighestBidInfo                                 = $this->_get_highest_offer_details('0', $key['listing_id'], $key['listing_type']);

                if (isset($HighestBidInfo[0]['offer_amount'])) {
                    if ($HighestBidInfo[0]['id'] === $key['id']) {
                        $dataArr[$i]['highestbid']              = $this->CommonOperationsHandler->ConvertToMillions($HighestBidInfo[0]['offer_amount']);
                        $dataArr[$i]['highestbidder']           = $this->getUserData($HighestBidInfo[0]['customer_id'])[0]['username'];
                        $dataArr[$i]['highestbidderid']         = $HighestBidInfo[0]['customer_id'];
                    }
                }

                $i++;
            }
        }
        return ($dataArr);
    }

    /*Get Bids UserDetails*/
    public function _get_all_bids($listing_id, $status = '1', $type, $sort = "tbl_bids.bid_amount", $order = 'DESC', $reviews = "", $owner = 'on')
    {
        $this->db->select('*,DATEDIFF(CURRENT_DATE(), tbl_bids.date) AS nfd,(tbl_bids.date) as bid_date');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_bids.bidder_id');

        if (!empty($reviews)) {
        }

        $this->db->where('tbl_bids.listing_id', $listing_id);
        $this->db->where('tbl_bids.listing_type', $type);
        $this->db->where('tbl_bids.bid_status', $status);
        $this->db->or_where('tbl_bids.bid_status', '3');

        if ($owner === 'on') {
            $this->db->where('tbl_bids.owner_id', $this->session->userdata('user_id'));
        }

        $this->db->order_by($sort, $order);
        $query      = $this->db->get('tbl_bids');
        $dataArr    = $query->result_array();

        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']                             = $this->CommonOperationsHandler->time_elapsed_string($key['bid_date']);
                $dataArr[$i]['ratings']                         = number_format($this->get_reviews($key['bidder_id'], "", "", "", "", 'avg')[0]['avg_r'], 1);
                $reservedPrice                                  = $this->database->_get_single_data('tbl_listings', array('id' => $key['listing_id'], 'status' => 1), 'website_reserveprice');
                if ($key['bid_amount'] > $reservedPrice) {
                    $dataArr[$i]['reserve']                     = 1;
                } else {
                    $dataArr[$i]['reserve']                     = 0;
                }

                $HighestBidInfo                                 = $this->_get_highest_bid_details('1', $key['listing_id'], $key['listing_type']);

                if (isset($HighestBidInfo[0]['bid_amount'])) {
                    if ($HighestBidInfo[0]['id'] === $key['id']) {
                        $dataArr[$i]['highestbid']              = $this->CommonOperationsHandler->ConvertToMillions($HighestBidInfo[0]['bid_amount']);
                        $dataArr[$i]['highestbidder']           = $this->getUserData($HighestBidInfo[0]['bidder_id'])[0]['username'];
                        $dataArr[$i]['highestbidderid']         = $HighestBidInfo[0]['bidder_id'];
                    }
                }
                $i++;
            }
        }
        return ($dataArr);
    }

    /*Get review info*/
    public function get_reviews($profile_id = "", $user_id = "", $count = "", $limit = 4, $start = 0, $condition = "")
    {
        if (!empty($profile_id)) {
            $userProfile = $this->getUserData($profile_id);
        }

        if (!empty($condition) && $condition === 'avg') {
            $this->db->select('*,AVG(ratings) as avg_r');
        } else {
            $this->db->select('*');
        }

        if (!empty($limit)) {
            if ($start !== 0) {
                $start = $limit * ($start - 1);
            }
            $this->db->limit($limit, $start);
        }
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_reviews.reviewer_id');
        if (!empty($profile_id)) {
            $this->db->where('tbl_reviews.user_id ', $userProfile[0]['user_id']);
        }

        if (!empty($user_id)) {
            $this->db->where('tbl_reviews.reviewer_id ', $user_id);
        }
        $this->db->where('tbl_reviews.status ', '1');
        $query = $this->db->get('tbl_reviews');

        if (!empty($count)) {
            return $query->num_rows();
        }
        return $query->result_array();
    }

    /*Get Offer*/
    public function _get_offer($bid_id, $column = 'owner_id')
    {
        $this->db->select('*,DATEDIFF(CURRENT_DATE(), tbl_offers.date) AS nfd,(tbl_offers.date) as bid_date,(tbl_offers.offer_amount) as bid_amount,(tbl_offers.customer_id) AS bidder_id,(tbl_offers.customer_id) AS bidder_id');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_offers.' . $column);
        $this->db->where('tbl_offers.id', $bid_id);
        $query = $this->db->get('tbl_offers');
        $dataArr    = $query->result_array();

        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']                         = $this->CommonOperationsHandler->time_elapsed_string($key['bid_date']);
                $dataArr[$i]['ratings']                     = number_format($this->get_reviews($key[$column], "", "", "", "", 'avg')[0]['avg_r'], 1);
                $reservedPrice                              = $this->database->_get_single_data('tbl_listings', array('id' => $key['listing_id'], 'status' => 1), 'website_reserveprice');
                if ($key['bid_amount'] > $reservedPrice) {
                    $dataArr[$i]['reserve']                 = 1;
                } else {
                    $dataArr[$i]['reserve']                 = 0;
                }

                $i++;
            }
        }
        return ($dataArr);
    }

    /*Get Table Values Offers*/
    public function _userwise_offers($userid, $group_by = "")
    {
        $this->db->select('*,COUNT(tbl_offers.id) as NOF,MAX(tbl_offers.offer_amount) as maxAmount,(tbl_listings.id) as listing_id,(tbl_listings.status) as listing_status');
        $this->db->join('tbl_offers', 'tbl_listings.id = tbl_offers.listing_id');
        $this->db->where('tbl_offers.customer_id ', $userid);
        if (!empty($group_by)) {
            $this->db->group_by("tbl_listings.id");
            $this->db->order_by("tbl_offers.date");
        }
        $query = $this->db->get('tbl_listings');
        $dataArr = $query->result_array();

        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago'] = $this->CommonOperationsHandler->time_elapsed_string($key['date']);;
                $i++;
            }
        }
        return $dataArr;
    }

    /*Get Table Values Bids*/
    public function _userwise_bids($userid, $group_by = "")
    {
        $this->db->select('*,COUNT(tbl_bids.id) as NOF,MAX(tbl_bids.bid_amount) as maxAmount,(tbl_listings.id) as listing_id,(tbl_listings.status) as listing_status');
        $this->db->join('tbl_bids', 'tbl_listings.id = tbl_bids.listing_id');
        $this->db->where('tbl_bids.bidder_id ', $userid);
        if (!empty($group_by)) {
            $this->db->group_by("tbl_bids.id");
            $this->db->order_by("tbl_bids.date");
        }
        $query = $this->db->get('tbl_listings');
        $dataArr = $query->result_array();

        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago'] = $this->CommonOperationsHandler->time_elapsed_string($key['date']);;
                $i++;
            }
        }
        return $dataArr;
    }

    /*Get Unapproved Bidders*/
    public function _get_bidders($listing_id, $status = '0')
    {
        $this->db->select('*,DATEDIFF(CURRENT_DATE(), tbl_bids.date) AS nfd,(tbl_bids.date) as bid_date');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_bids.bidder_id');
        $this->db->where('tbl_bids.listing_id', $listing_id);
        $this->db->where('tbl_bids.bid_status', $status);
        $this->db->group_by('tbl_bids.bidder_id');
        $query = $this->db->get('tbl_bids');
        $dataArr    = $query->result_array();

        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']         = $this->CommonOperationsHandler->time_elapsed_string($key['bid_date']);
                $dataArr[$i]['ratings']     = number_format($this->get_reviews($key['bidder_id'], "", "", "", "", 'avg')[0]['avg_r'], 1);
                $i++;
            }
        }
        return $dataArr;
    }

    /*Check Pending Bids*/
    public function _check_user_has_pending_bid($status = '0')
    {
        $this->db->where('listing_id', $this->input->post('bid_listing_id'));
        $this->db->where('listing_type', $this->input->post('bid_listing_type'));
        $this->db->where('bid_status ', $status);
        $this->db->where('bidder_id ', $this->input->post('bid_bidder_id'));
        $query = $this->db->get('tbl_bids');
        return $query->num_rows();
    }

    /*Check Pending Bids for emails*/
    public function _check_user_has_pending_bids($id, $bidder_id, $status = '0')
    {
        $this->db->where('listing_id', $id);
        $this->db->where('bid_status ', $status);
        $this->db->where('bidder_id ', $bidder_id);
        $query = $this->db->get('tbl_bids');
        return $query->num_rows();
    }

    /*Get the Current Price*/
    public function _get_current_price($listing_id, $listing_type = 'website')
    {
        $bids = $this->_get_all_bids($listing_id, "1", $listing_type, "", "", "", "off");
        if (!empty($bids)) {
            return max(array_column($bids, 'bid_amount'));
        } else {
            $this->db->where('id', $listing_id);
            $this->db->where('listing_type', $listing_type);
            $query = $this->db->get('tbl_listings');
            if (isset($query->result_array()[0]['website_startingprice'])) {
                return $query->result_array()[0]['website_startingprice'];
            }
        }
    }

    /*Get User Wise Listing Bids*/
    public function _get_userwise_bids($listing_id, $user_id, $group = '')
    {
        $settingsData = $this->getSettingsData();
        $this->db->select('*,(tbl_bids.id) as bid_id , (tbl_listings.date) as listing_date,(tbl_listings.status) as listing_status ,tbl_listings.website_BusinessName,tbl_listings.website_tagline,(tbl_bids.listing_type) as type');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_bids.bidder_id');
        $this->db->join('tbl_listings', 'tbl_listings.id = tbl_bids.listing_id', 'left');

        if (!empty($listing_id)) {
            $this->db->where('tbl_bids.listing_id', $listing_id);
        }

        if (!empty($user_id)) {
            $this->db->where('tbl_bids.bidder_id', $user_id);
        }

        if (!empty($group)) {
            $this->db->group_by("tbl_bids.id");
        }

        $this->db->order_by("tbl_bids.date");
        $query      = $this->db->get('tbl_bids');
        $dataArr    = $query->result_array();

        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']     = $this->CommonOperationsHandler->time_elapsed_string($key['date']);
                $dataArr[$i]['expire']  = $this->CommonOperationsHandler->time_elapsed_string(date('Y-m-d', strtotime($key['listing_date'] . ' + ' . $settingsData[0]['auction_period'] . 'days')), false, true);
                $i++;
            }
        }

        return $dataArr;
    }

    /*Get User Wise Listing Offers*/
    public function _get_userwise_offers($listing_id, $user_id, $group = '')
    {
        $this->db->select('*,(tbl_offers.id) as offer_id');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_offers.owner_id');
        $this->db->join('tbl_purchases', 'tbl_purchases.plan_id = tbl_offers.listing_id', 'left');

        if (!empty($listing_id)) {
            $this->db->where('tbl_offers.listing_id', $listing_id);
        }

        if (!empty($user_id)) {
            $this->db->where('tbl_offers.customer_id', $user_id);
        }

        if (!empty($group)) {
            $this->db->group_by("tbl_offers.id");
        }

        $this->db->order_by("tbl_offers.date");
        $query      = $this->db->get('tbl_offers');
        $dataArr    = $query->result_array();

        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']     = $this->CommonOperationsHandler->time_elapsed_string($key['date']);
                $dataArr[$i]['expire']  = $this->CommonOperationsHandler->time_elapsed_string($key['expire_date'], false, true);
                $i++;
            }
        }
        return $dataArr;
    }

    /*Get Comments*/
    public function _get_comments($limit, $start, $count = false, $listing_id, $type = 'listing')
    {
        if ($count) {
            $this->db->where('status', 1)->where('tbl_comments.listing_id', $listing_id)->where('tbl_comments.section', $type);
            $query      = $this->db->get('tbl_comments');
            return $query->num_rows();
        }

        if (!empty($limit)) {
            if ($start !== 0) {
                $start = $limit * ($start - 1);
            }
            $this->db->limit($limit, $start);
        }

        $this->db->select('*');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_comments.user_id',  'left');
        $this->db->where('tbl_comments.status', 1);
        $this->db->where('tbl_comments.listing_id', $listing_id);
        $this->db->where('tbl_comments.section', $type);
        $this->db->order_by("tbl_comments.id");
        $query      = $this->db->get('tbl_comments');
        $dataArr    = $query->result_array();

        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago'] = $this->CommonOperationsHandler->time_elapsed_string($key['date']);;
                $i++;
            }
        }
        return $dataArr;
    }

    /*Auction Ending Soons Listings*/
    public function _get_auction_ending_soon($type = '', $void = '')
    {
        $data['platforms']   =   $this->_get_activated_platforms($void);
        $data['options']     =   $this->_get_row_data('tbl_platforms', array('type' => 'option', 'status' => 1));
        $today = date('Y-m-d H:i:s');
        $this->db->select('*,DATE_ADD(date, INTERVAL ' . $this->getSettingsData()[0]['auction_period'] . ' DAY) AS ENDDATE ,DATEDIFF(DATE_ADD(date, INTERVAL ' . $this->getSettingsData()[0]['auction_period'] . ' DAY),date) AS NFD,(tbl_listings.id ) as id', FALSE);
        $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
        $this->db->group_start();
        $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
        $this->db->where('tbl_purchases.expire_date>=', $today);
        $this->db->where('tbl_purchases.purchase_date <=', $today);
        $this->db->group_end();

        $this->db->group_start();
        $this->db->where('status', '1');
        $this->db->where('sold_status', '0');
        $this->db->where('listing_option', 'auction');
        if (!empty($type)) {
            $this->db->where('tbl_listings.listing_type', $type);
        }
        $this->db->group_end();

        $this->db->group_start();
        $this->db->where_in('tbl_listings.listing_type', array_column($data['platforms'], 'platform'));
        $this->db->where_in('tbl_listings.listing_option', array_column($data['options'], 'platform'));
        $this->db->group_end();

        $this->db->order_by('ENDDATE', 'desc');
        $this->db->group_by('tbl_listings.id');
        $query = $this->db->get('tbl_listings', 10);
        $dataArr    = $query->result_array();

        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['category']    = $this->_get_single_data('tbl_categories', array('id' => $key['website_industry']), 'c_name');
                $dataArr[$i]['username']    = $this->getUserData($key['user_id'])[0]['username'];
                $dataArr[$i]['sell_type']   = $dataArr[$i]['listing_option'];
                $dataArr[$i]['sell_web']    = $dataArr[$i]['listing_type'];
                $i++;
            }
        }
        return $dataArr;
    }


    /*Get Specific Listings*/
    public function _get_specific_listing($listingType = 'sponsored', $type = "")
    {
        if ($type === 'app') {
            $data['platforms']        =   $this->_get_activated_platforms();
        } else {
            $data['platforms']      =   $this->_get_activated_platforms('app');
        }

        $data['options']     =   $this->_get_row_data('tbl_platforms', array('type' => 'option', 'status' => 1));
        $today = date('Y-m-d H:i:s');
        $this->db->select('*,(tbl_listings.id ) as listing_id');
        $this->db->join('tbl_listings', 'tbl_listings.id = tbl_purchases.plan_id');
        $this->db->group_start();
        $this->db->where('tbl_purchases.listing_type', $listingType);
        $this->db->where('tbl_purchases.expire_date>=', $today);
        $this->db->where('tbl_purchases.purchase_date <=', $today);
        $this->db->group_end();
        $this->db->where('tbl_listings.status', 1);
        $this->db->where('tbl_listings.sold_status', 0);
        if (!empty($type)) {
            $this->db->where('tbl_listings.listing_type', $type);
        }
        $this->db->group_start();
        $this->db->where_in('tbl_listings.listing_type', array_column($data['platforms'], 'platform'));
        $this->db->where_in('tbl_listings.listing_option', array_column($data['options'], 'platform'));
        $this->db->group_end();
        $this->db->group_by('tbl_listings.id');
        $query = $this->db->get('tbl_purchases');
        $dataArr    = $query->result_array();

        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['category']    = $this->_get_single_data('tbl_categories', array('id' => $key['website_industry']), 'c_name');
                $dataArr[$i]['username']    = $this->getUserData($key['user_id'])[0]['username'];
                $dataArr[$i]['sell_type']   = $dataArr[$i]['listing_option'];
                $dataArr[$i]['sell_web']    = $dataArr[$i]['listing_type'];

                if ($dataArr[$i]['listing_type'] === 'domain') {
                    $dataArr[$i]['categoryIcon']    =   'domains.svg';
                } else {
                    $dataArr[$i]['categoryIcon']    =   'website.svg';
                }

                $i++;
            }
        }
        return $dataArr;
    }


    /*Get Sponsored Listings*/
    public function _get_sponsored_listing($listingType = 'sponsored', $limit = false)
    {
        $data['platforms']   =   $this->_get_row_data('tbl_platforms', array('type' => 'listing', 'status' => 1));
        $data['options']     =   $this->_get_row_data('tbl_platforms', array('type' => 'option', 'status' => 1));
        $today = date('Y-m-d H:i:s');
        if ($limit) {
            $this->db->select('(tbl_listings.website_BusinessName ) as names');
        } else {
            $this->db->select('*,(tbl_listings.id ) as listing_id');
        }
        $this->db->join('tbl_listings', 'tbl_listings.id = tbl_purchases.plan_id');
        $this->db->where('tbl_purchases.listing_type', $listingType);
        $this->db->where('tbl_purchases.expire_date>=', $today);
        $this->db->where('tbl_purchases.purchase_date <=', $today);

        $this->db->group_start();
        $this->db->where_in('tbl_listings.listing_type', array_column($data['platforms'], 'platform'));
        $this->db->where_in('tbl_listings.listing_option', array_column($data['options'], 'platform'));
        $this->db->group_end();
        $query = $this->db->get('tbl_purchases');
        $dataArr    = $query->result_array();
        return $dataArr;
    }

    /*Count website listings categorywise*/
    public function _count_listings_categories_wise($listing_type = 'website')
    {
        $this->db->select('*,COUNT(tbl_listings.id) as count , (tbl_categories.id) as c_id');
        $this->db->join('tbl_listings', 'tbl_categories.id = tbl_listings.website_industry', 'left');
        $this->db->from('tbl_categories');
        $this->db->where('tbl_categories.c_level', 0);
        $this->db->group_by('tbl_categories.id');
        return $this->db->get()->result_array();
    }

    public function _custome_get_selected_listing_types_frontend($type, $sold = 0, $limit = 50, $listing = '', $void = 'app', $pageName = "", $start = 0, $searchterm = "")
    {
        $data['platforms']   =   $this->_get_activated_platforms('');


        $data['options']     =   $this->_get_row_data('tbl_platforms', array('type' => 'option', 'status' => 1));
        $today = date('Y-m-d H:i:s');

        if (empty($sold)) {
            $this->db->select('*,(tbl_listings.id) AS id');
            $this->db->group_start();
            $this->db->where('tbl_listings.status', '1');
            $this->db->where('tbl_listings.sold_status', $sold);
            $this->db->where_in('tbl_listings.listing_type', ['business', 'app', 'website', 'domain']);
            $this->db->group_end();

            $this->db->group_start();
            $this->db->where_in('tbl_listings.listing_type', array_column($data['platforms'], 'platform'));
            $this->db->group_end();

            //$this->db->where('sponsorship_priority <>', 4);

            // order priority of subscription while add the product
            $this->db->order_by('listing_header_priority', "desc");
            $this->db->order_by('listing_header_expiry', "desc");

            $this->db->group_by('tbl_listings.id');

            if (!empty($pageName)) {
                $this->db->where("FIND_IN_SET('$pageName',display_on_page) != ", 0);
            }

            if (!empty($searchterm)) {
                $this->db->like('tbl_listings.website_BusinessName', $searchterm);
            }
            $this->db->where('tbl_listings.sponsorship_priority <> ', '4');
            if ($start !== 0) {
                $start = $limit * ($start - 1);
            }

            $this->db->limit($limit, $start);

            $query = $this->db->get('tbl_listings');

            $listingsArr = $query->result_array();

            //    $query->free_result();

            // sponsoreship data

            $this->db->select('*,(tbl_listings.id) AS id');
            $this->db->group_start();
            $this->db->where('tbl_listings.status', '1');
            $this->db->where('tbl_listings.sold_status', $sold);
            $this->db->where_in('tbl_listings.listing_type', ['business', 'app', 'website', 'domain']);
            $this->db->group_end();

            $this->db->group_start();
            $this->db->where_in('tbl_listings.listing_type', array_column($data['platforms'], 'platform'));
            $this->db->group_end();

            $this->db->where('sponsorship_priority', 4);

            // order priority of subscription while add the product
            // $this->db->order_by('sponsorship_priority', "desc");
            //$this->db->order_by('sponsorship_expires', "desc");

            $this->db->group_by('tbl_listings.id');

            // if (!empty($pageName)) {
            //     $this->db->where("FIND_IN_SET('$pageName',display_on_page) != ", 0);
            // }

            if (!empty($searchterm)) {
                $this->db->like('tbl_listings.website_BusinessName', $searchterm);
            }

            // if ($start !== 0) {
            //     $start = $limit * ($start - 1);
            // }

            $this->db->order_by('rand()');

            $this->db->limit(SPONSORSHIP_DISPALY_LIMIT);

            $query = $this->db->get('tbl_listings');
            // pre($this->db->last_query(),1);
            $sponsorshipsArr = $query->result_array();
            //pre($sponsorshipsArr);
            //pre($listingsArr);
            $listingsArr = array_merge($sponsorshipsArr, $listingsArr);
            //pre($listingsArr,1);

        }

        if (!empty($listingsArr)) {
            $i = 0;
            foreach ($listingsArr as $listing) {
                if ($listing['listing_type'] === 'domain') {
                    $listingsArr[$i]['category']        =   $listing['listing_type'];
                    $listingsArr[$i]['categoryIcon']    =   'domains.svg';
                } else {
                    $listingsArr[$i]['category']        =   $listing['listing_type'];
                    $listingsArr[$i]['categoryIcon']    =   'website.svg';
                }

                if (isset($listing['domain_id'][0]['domain'])) {
                    $listingsArr[$i]['domain']          =   $this->_get_single_data('tbl_domains', array('id' => $listing['domain_id']), 'domain');
                    $listingsArr[$i]['verify']          =   $this->_get_single_data('tbl_domains', array('id' => $listing['domain_id']), 'status');
                } else {
                    $listingsArr[$i]['domain']          =   "";
                    $listingsArr[$i]['verify']          =   "";
                }

                $listingsArr[$i]['ago']                 =   $this->CommonOperationsHandler->time_elapsed_string($listing['date']);
                $listingsArr[$i]['username']            =   $this->_get_single_data('tbl_users', array('user_id' => $listing['user_id']), 'username');
                $i++;
            }
        }
        foreach ($listingsArr as $i => $s) {


            $invoice = $this->getSoldORNot($s['id']);
            if (isset($invoice) && !empty($invoice)) {
                $listingsArr[$i]['sold_or_not'] = 'yes';
            } else {
                $listingsArr[$i]['sold_or_not'] = 'no';
            }
        }
        //    exit;
        return $listingsArr;
    }
    /*Trending Classified Listings front end only */
    public function _get_selected_listing_types_frontend($type, $sold = 0, $limit = 50, $listing = '', $void = 'app', $pageName = "", $start = 0, $searchterm = "")
    {

        $data['platforms']   =   $this->_get_activated_platforms('');


        $data['options']     =   $this->_get_row_data('tbl_platforms', array('type' => 'option', 'status' => 1));
        $today = date('Y-m-d H:i:s');

        if (empty($sold)) {
            $this->db->select('*,(tbl_listings.id) AS id');
            $this->db->group_start();
            $this->db->where('tbl_listings.status', '1');
            $this->db->where('tbl_listings.sold_status', $sold);
            if (!empty($listing)) {
                $this->db->where($listing);
            }
            $this->db->group_end();

            $this->db->group_start();
            $this->db->where_in('tbl_listings.listing_type', array_column($data['platforms'], 'platform'));
            $this->db->group_end();

            //$this->db->where('sponsorship_priority <>', 4);

            // order priority of subscription while add the product
            $this->db->order_by('listing_header_priority', "desc");
            $this->db->order_by('listing_header_expiry', "desc");

            $this->db->group_by('tbl_listings.id');

            if (!empty($pageName)) {
                $this->db->where("FIND_IN_SET('$pageName',display_on_page) != ", 0);
            }

            if (!empty($searchterm)) {
                $this->db->like('tbl_listings.website_BusinessName', $searchterm);
            }
            $this->db->where('tbl_listings.sponsorship_priority <> ', '4');
            if ($start !== 0) {
                $start = $limit * ($start - 1);
            }

            $this->db->limit($limit, $start);

            $query = $this->db->get('tbl_listings');

            $listingsArr = $query->result_array();

            //    $query->free_result();

            // sponsoreship data

            $this->db->select('*,(tbl_listings.id) AS id');
            $this->db->group_start();
            $this->db->where('tbl_listings.status', '1');
            $this->db->where('tbl_listings.sold_status', $sold);
            if (!empty($listing)) {
                $this->db->where($listing);
            }
            $this->db->group_end();

            $this->db->group_start();
            $this->db->where_in('tbl_listings.listing_type', array_column($data['platforms'], 'platform'));
            $this->db->group_end();

            $this->db->where('sponsorship_priority', 4);

            // order priority of subscription while add the product
            // $this->db->order_by('sponsorship_priority', "desc");
            //$this->db->order_by('sponsorship_expires', "desc");

            $this->db->group_by('tbl_listings.id');

            // if (!empty($pageName)) {
            //     $this->db->where("FIND_IN_SET('$pageName',display_on_page) != ", 0);
            // }

            if (!empty($searchterm)) {
                $this->db->like('tbl_listings.website_BusinessName', $searchterm);
            }

            // if ($start !== 0) {
            //     $start = $limit * ($start - 1);
            // }

            $this->db->order_by('rand()');

            $this->db->limit(SPONSORSHIP_DISPALY_LIMIT);

            $query = $this->db->get('tbl_listings');
            // pre($this->db->last_query(),1);
            $sponsorshipsArr = $query->result_array();
            //pre($sponsorshipsArr);
            //pre($listingsArr);
            $listingsArr = array_merge($sponsorshipsArr, $listingsArr);
            //pre($listingsArr,1);

        }

        if (!empty($listingsArr)) {
            $i = 0;
            foreach ($listingsArr as $listing) {
                if ($listing['listing_type'] === 'domain') {
                    $listingsArr[$i]['category']        =   $listing['listing_type'];
                    $listingsArr[$i]['categoryIcon']    =   'domains.svg';
                } else {
                    $listingsArr[$i]['category']        =   $listing['listing_type'];
                    $listingsArr[$i]['categoryIcon']    =   'website.svg';
                }

                if (isset($listing['domain_id'][0]['domain'])) {
                    $listingsArr[$i]['domain']          =   $this->_get_single_data('tbl_domains', array('id' => $listing['domain_id']), 'domain');
                    $listingsArr[$i]['verify']          =   $this->_get_single_data('tbl_domains', array('id' => $listing['domain_id']), 'status');
                } else {
                    $listingsArr[$i]['domain']          =   "";
                    $listingsArr[$i]['verify']          =   "";
                }

                $listingsArr[$i]['ago']                 =   $this->CommonOperationsHandler->time_elapsed_string($listing['date']);
                $listingsArr[$i]['username']            =   $this->_get_single_data('tbl_users', array('user_id' => $listing['user_id']), 'username');
                $i++;
            }
        }
        foreach ($listingsArr as $i => $s) {


            $invoice = $this->getSoldORNot($s['id']);
            if (isset($invoice) && !empty($invoice)) {
                $listingsArr[$i]['sold_or_not'] = 'yes';
            } else {
                $listingsArr[$i]['sold_or_not'] = 'no';
            }
        }
        //    exit;
        return $listingsArr;
    }
    /*fetch front end  results*/
    public function _fetch_frontend_result($table, $limit = "", $start = 0, $count = false, $condition = "", $search = "", $column = "", $sort = 'date', $pageName = "")
    {
        $this->db->where('status <>', '9');
        if (!empty($search) && !empty($column)) {
            $this->db->like($column, $search);
        }

        if (!empty($condition)) {
            $this->db->where($condition);
        }

        if (!empty($pageName)) {
            $this->db->where("FIND_IN_SET('$pageName',display_on_page) != ", 0);
        }

        if ($count) {
            $query      = $this->db->get($table);
            // pre($this->db->last_query(),1);
            return $query->num_rows();
        }


        if (!empty($limit)) {
            if ($start !== 0) {
                $start = $limit * ($start - 1);
            }
            $this->db->limit($limit, $start);
        }
        $this->db->order_by($sort, 'desc');
        $query      = $this->db->get($table);
        return $query->result_array();
    }
    public function _custome_fetch_frontend_result($table, $limit = "", $start = 0, $count = false, $condition = "", $search = "", $column = "", $sort = 'date', $pageName = "")
    {
        $this->db->where('status <>', '9');
        if (!empty($search) && !empty($column)) {
            $this->db->like($column, $search);
        }
        $this->db->where_in('tbl_listings.listing_type', ['business', 'app', 'website', 'domain']);
        if (!empty($condition)) {
            $this->db->where($condition);
        }

        if (!empty($pageName)) {
            $this->db->where("FIND_IN_SET('$pageName',display_on_page) != ", 0);
        }

        if ($count) {
            $query      = $this->db->get($table);
            // pre($this->db->last_query(),1);
            return $query->num_rows();
        }


        if (!empty($limit)) {
            if ($start !== 0) {
                $start = $limit * ($start - 1);
            }
            $this->db->limit($limit, $start);
        }
        $this->db->order_by($sort, 'desc');
        $query      = $this->db->get($table);
        return $query->result_array();
    }


    /*Trending Classified Listings */
    public function _get_selected_listing_types($type, $sold = 0, $limit = 50, $listing = '', $void = 'app', $page = "")
    {
        if ($void === 'all') {
            $data['platforms']   =   $this->_get_activated_platforms('');
        } else {
            $data['platforms']   =   $this->_get_activated_platforms($void);
        }

        $data['options']     =   $this->_get_row_data('tbl_platforms', array('type' => 'option', 'status' => 1));
        $today = date('Y-m-d H:i:s');
        if (empty($sold)) {
            $this->db->select('*,(tbl_listings.id) AS id');
            $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
            $this->db->group_start();
            $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
            $this->db->where('tbl_purchases.expire_date>=', $today);
            $this->db->where('tbl_purchases.purchase_date <=', $today);
            $this->db->group_end();

            $this->db->group_start();
            $this->db->where('tbl_listings.status', '1');
            $this->db->where('tbl_listings.sold_status', $sold);
            if (!empty($listing)) {
                $this->db->where($listing);
            }
            $this->db->group_end();
            $this->db->group_start();
            $this->db->where_in('tbl_listings.listing_type', array_column($data['platforms'], 'platform'));
            $this->db->where_in('tbl_listings.listing_option', array_column($data['options'], 'platform'));
            $this->db->group_end();
            $this->db->order_by($type, "desc");
            $this->db->group_by('tbl_listings.id');
            $query = $this->db->get('tbl_listings', $limit);
            $listingsArr = $query->result_array();
        } else {
            if ($sold !== 1) {
                $this->db->select('*,(tbl_listings.id) AS id');
                $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
                $this->db->group_start();
                $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
                $this->db->where('tbl_purchases.expire_date>=', $today);
                $this->db->where('tbl_purchases.purchase_date <=', $today);
                $this->db->group_end();
            }

            $this->db->group_start();
            $this->db->where('tbl_listings.status', '1');
            $this->db->where('tbl_listings.sold_status', $sold);
            if (!empty($listing)) {
                $this->db->where($listing);
            }
            $this->db->group_end();

            $this->db->group_start();
            $this->db->where_in('tbl_listings.listing_type', array_column($data['platforms'], 'platform'));
            $this->db->where_in('tbl_listings.listing_option', array_column($data['options'], 'platform'));
            $this->db->group_end();

            $this->db->order_by($type, "desc");
            $this->db->group_by('tbl_listings.id');
            $query = $this->db->get('tbl_listings', $limit);

            $listingsArr = $query->result_array();
        }

        if (!empty($listingsArr)) {
            $i = 0;
            foreach ($listingsArr as $listing) {
                if ($listing['listing_type'] === 'domain') {
                    $listingsArr[$i]['category']        =   $listing['listing_type'];
                    $listingsArr[$i]['categoryIcon']    =   'domains.svg';
                } else {
                    $listingsArr[$i]['category']        =   $listing['listing_type'];
                    $listingsArr[$i]['categoryIcon']    =   'website.svg';
                }

                if (isset($listing['domain_id'][0]['domain'])) {
                    $listingsArr[$i]['domain']          =   $this->_get_single_data('tbl_domains', array('id' => $listing['domain_id']), 'domain');
                    $listingsArr[$i]['verify']          =   $this->_get_single_data('tbl_domains', array('id' => $listing['domain_id']), 'status');
                } else {
                    $listingsArr[$i]['domain']          =   "";
                    $listingsArr[$i]['verify']          =   "";
                }

                $listingsArr[$i]['ago']                 =   $this->CommonOperationsHandler->time_elapsed_string($listing['date']);
                $listingsArr[$i]['username']            =   $this->_get_single_data('tbl_users', array('user_id' => $listing['user_id']), 'username');
                $i++;
            }
        }

        return $listingsArr;
    }

    /*View Counter Listings/ Blog */
    public function _views_counter($listing_id, $table = 'tbl_listings')
    {
        $this->db->set('views', 'views + 1', FALSE);
        $this->db->where('id', $listing_id);
        $this->db->update($table);
    }

    /*User TOtal Earnings Calculation*/
    public function _user_total_earnings($user_id, $inv_type = 1)
    {
        $total = 0;
        $earnings = 0;
        $refunds = 0;
        $ignore = array(7, 3);
        $this->db->select('*, SUM(withdraw_amount) AS earnings');
        $this->db->where('paid_to', $user_id);
        $this->db->where_not_in('status', $ignore);
        $this->db->where('invoice_type', $inv_type);
        $this->db->group_by("paid_to");
        $query = $this->db->get('tbl_invoices');
        if (isset($query->result_array()[0]['earnings'])) {
            $earnings = $query->result_array()[0]['earnings'];
        }

        $refunds    = $this->_user_refunds($user_id);
        $debits     = $this->_user_debits($user_id);
        $total      = ($earnings + $refunds) - $debits;
        return $total;
    }

    /*User Total Debits Calculation*/
    public function _user_debits($user_id, $inv_type = 0)
    {
        $this->db->select('*, SUM(withdraw_amount + success_fee + processing_fee) AS debits');
        $this->db->where('paid_to', $user_id);
        $this->db->where('status', 1);
        $this->db->where('invoice_type', $inv_type);
        $this->db->group_by("paid_to");
        $query = $this->db->get('tbl_invoices');
        if (isset($query->result_array()[0]['debits'])) {
            return $query->result_array()[0]['debits'];
        }
        return 0;
    }

    /*User Cleared Funds*/
    public function _user_cleared_earnings($user_id, $inv_type = 1)
    {
        $total = 0;
        $earnings = 0;
        $refunds = 0;
        $this->db->select('*, SUM(withdraw_amount) AS earnings');
        $this->db->where('paid_to', $user_id);
        $this->db->where('status', 4);
        $this->db->where('invoice_type', $inv_type);
        $this->db->group_by("paid_to");
        $query = $this->db->get('tbl_invoices');
        if (isset($query->result_array()[0]['earnings'])) {
            $earnings = $query->result_array()[0]['earnings'];
        }

        $refunds    = $this->_user_refunds($user_id);
        $debits     = $this->_user_debits($user_id);
        $total      = ($earnings + $refunds) - $debits;
        return $total;
    }

    /*Pending earnings to be cleared */
    public function _user_pending_earnings($user_id, $inv_type = 1)
    {
        $ignore = array(4, 7, 3, 6);
        $this->db->select('*, SUM(withdraw_amount) AS earnings');
        $this->db->where('paid_to', $user_id);
        $this->db->where_not_in('status', $ignore);
        $this->db->where('invoice_type', $inv_type);
        $this->db->group_by("paid_to");
        $query = $this->db->get('tbl_invoices');
        if (isset($query->result_array()[0]['earnings'])) {
            return $query->result_array()[0]['earnings'];
        }
        return 0;
    }

    /*Pending earnings to be cleared */
    public function _user_refunds($user_id, $inv_type = 1)
    {
        $refunds = 0;
        $this->db->select('*, SUM(withdraw_amount + success_fee) AS refunds');
        $this->db->where('paid_by', $user_id);
        $this->db->where('status', 3);
        $this->db->where('invoice_type', $inv_type);
        $this->db->group_by("paid_by");
        $query = $this->db->get('tbl_invoices');
        if (isset($query->result_array()[0]['refunds'])) {
            $refunds =  $query->result_array()[0]['refunds'];
        }
        return $refunds;
    }

    /*Available to withdraw funds*/
    public function _user_availableto_withdraw($user_id, $inv_type = 1)
    {
        $available = 0;
        $total = 0;
        $earnings = 0;
        $refunds = 0;
        $this->db->select('*, SUM(withdraw_amount) AS earnings');
        $this->db->where('paid_to', $user_id);
        $this->db->where('status', 4);
        $this->db->where('invoice_type', $inv_type);
        $this->db->group_by("paid_to");
        $query = $this->db->get('tbl_invoices');

        if (isset($query->result_array()[0]['earnings'])) {
            $earnings = $query->result_array()[0]['earnings'];
        }

        $refunds    = $this->_user_refunds($user_id);
        $debits     = $this->_user_debits($user_id);
        $total      = ($earnings + $refunds) - $debits;

        $balance = ($total - $this->_user_withdrawals($user_id));
        return $balance;
    }

    /*Get User Withdrawals*/
    public function _user_withdrawals($user_id)
    {
        $this->db->select('*, SUM(amount) AS withdrawals');
        $this->db->where('user_id', $user_id);
        $this->db->group_start();
        $this->db->where('status', 0);
        $this->db->or_where('status', 1);
        $this->db->or_where('status', 2);
        $this->db->group_end();
        $this->db->group_by("user_id");
        $query = $this->db->get('tbl_withdrawals');
        if (isset($query->result_array()[0]['withdrawals'])) {
            return $query->result_array()[0]['withdrawals'];
        }
        return 0;
    }

    /*Get no of Clients ListingsWise*/
    public function numberOfClients($listing_id, $type, $count = "", $status)
    {
        $this->db->where('listing_id', $listing_id);
        $this->db->where('listing_type', $type);
        $this->db->where('offer_status', $status);
        $this->db->group_by('customer_id');
        $query = $this->db->get('tbl_offers');
        if (empty($count)) {
            return $query->result_array();
        }
        return $query->num_rows();
    }

    /*Get Withdrawal Statements data*/
    public function _get_withdrawals($user_id, $status = '', $limit = 5, $start = 0)
    {
        $this->db->select('*,(tbl_withdrawal_methods.method) AS w_method ,(tbl_withdrawals.status) AS status');
        $this->db->join('tbl_withdrawal_methods', 'tbl_withdrawal_methods.id = tbl_withdrawals.method');
        $this->db->where('tbl_withdrawals.user_id', $user_id);
        if (!empty($status)) {
            $this->db->where('tbl_withdrawals.status', $status);
        }

        if ($start !== 0) {
            $start = $limit * ($start - 1);
        }

        $this->db->limit($limit, $start);
        $query = $this->db->get('tbl_withdrawals');
        return $query->result_array();
    }

    /*Load History Records*/
    public function _load_history($contract_id)
    {
        $this->db->where('contract_id', $contract_id);
        $this->db->order_by('date', 'desc');
        $query = $this->db->get('tbl_history');
        return $query->result_array();
    }

    /*Get Selected Bid*/
    public function _get_bid($bid_id, $column = 'owner_id')
    {
        $this->db->select('*,DATEDIFF(CURRENT_DATE(), tbl_bids.date) AS nfd,(tbl_bids.date) as bid_date');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_bids.' . $column);
        $this->db->where('tbl_bids.id', $bid_id);
        $query = $this->db->get('tbl_bids');
        $dataArr    = $query->result_array();

        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']                         = $this->CommonOperationsHandler->time_elapsed_string($key['bid_date']);
                $dataArr[$i]['ratings']                     = number_format($this->get_reviews($key[$column], "", "", "", "", 'avg')[0]['avg_r'], 1);
                $reservedPrice                              = $this->_get_single_data('tbl_listings', array('id' => $key['listing_id'], 'status' => 1), 'website_reserveprice');
                if ($key['bid_amount'] > $reservedPrice) {
                    $dataArr[$i]['reserve']                 = 1;
                } else {
                    $dataArr[$i]['reserve']                 = 0;
                }

                $i++;
            }
        }
        return ($dataArr);
    }

    /*Get Selected Contarct*/
    public function _get_contract($id)
    {
        if ($this->_check_user($id, 'customer_id') === $this->session->userdata('user_id')) {
            $this->db->join('tbl_users', 'tbl_opens.owner_id = tbl_users.user_id');
            $this->db->where('tbl_opens.customer_id', $this->session->userdata('user_id'));
        } else {
            $this->db->join('tbl_users', 'tbl_opens.customer_id = tbl_users.user_id');
            $this->db->where('tbl_opens.owner_id', $this->session->userdata('user_id'));
        }
        $this->db->select('*,DATE(tbl_opens.delivery_time) as dateonly,TIME(tbl_opens.delivery_time) as timeonly');
        $this->db->where('tbl_opens.id', $id);
        $this->db->or_where('tbl_opens.contract_id', $id);
        $query = $this->db->get('tbl_opens');
        return $query->result_array();
    }

    /*Check user var*/
    public function _check_user($id, $column)
    {
        $this->db->where('id', $id);
        $this->db->or_where('contract_id', $id);
        $query = $this->db->get('tbl_opens');
        if (!empty($query->result_array()[0][$column])) {
            return $query->result_array()[0][$column];
        }
        return;
    }

    /*Get Invoices userwise*/
    public function _get_invoices($owner = true)
    {
        if ($owner) {
            $this->db->where('paid_to', $this->session->userdata('user_id'));
        } else {
            $this->db->or_where('paid_by', $this->session->userdata('user_id'));
        }
        $query = $this->db->get('tbl_invoices');
        return $query->result_array();
    }

    /*Discount Coupons*/
    public function discount_coupons($token)
    {
        $coupon_code    = $this->input->post('code');
        //$purchases      = $this->input->post('purchases');
        $today          = date('Y-m-d');

        $query =  $this->db->query('SELECT * FROM tbl_coupons WHERE discount_code = ' . $this->db->escape($coupon_code) . ' AND valid_from <= ' . $this->db->escape($today) . ' AND valid_till >= ' . $this->db->escape($today));
        $discount_couponArr = $query->result_array();

        if (!empty($discount_couponArr) && count($discount_couponArr) > 0) {
            // if (isset($discount_couponArr[0]['valid_listings']) && !empty($discount_couponArr[0]['valid_listings'])) {
            //  $validListingsArr    = json_decode($discount_couponArr[0]['valid_listings']);
            //  pre("ppppp");
            // pre($validListingsArr);

            //if (!empty($validListingsArr)) {
            // $purchases = array_column($purchases, 'id');
            //  if (count(array_diff($validListingsArr, $purchases)) === 0) {

            $this->session->set_userdata('checkout_coupon_', $coupon_code);

            exit(json_encode(array('error' => 0, 'discountType' => $discount_couponArr[0]['discount_type'], 'discount' => $discount_couponArr[0]['amount'], 'token' => $token)));
            //}
            // exit();
            //}
            // exit();
            // }
            //exit();
        }
        exit(json_encode(array('error' => 1, 'token' => $token)));
    }

    /*search related operations*/
    public function _search_table($data, $limit, $start, $sort, $arr = '', $count = false)
    {
        $platforms      =   $this->_get_row_data('tbl_platforms', array('type' => 'listing', 'status' => 1));
        $options        =   $this->_get_row_data('tbl_platforms', array('type' => 'option', 'status' => 1));
        $today          =   date('Y-m-d H:i:s');
        $or_conditions  =   "";
        $searchterm     =   "";
        $listing_type   =   "";

        $this->db->select('*,(tbl_listings.id) AS id');
        if (!empty($arr)) {
            if (!empty($arr['business_registeredCountry'])) {
                $data['tbl_listings.business_registeredCountry'] = $arr['business_registeredCountry'];
            }

            if (!empty($arr['category'])) {
                $data['tbl_listings.website_industry'] = $arr['category'];
            }

            if (!empty($arr['extension'])) {
                $data['tbl_listings.extension'] = $arr['extension'];
            }

            if (!empty($arr['searchterm'])) {
                $searchterm     = $arr['searchterm'];
            }

            if (!empty($arr['or_conditions'])) {
                $or_conditions  = $arr['or_conditions'];
            }

            if (!empty($arr['in_conditions'])) {
                $in_conditions  = $arr['in_conditions'];
            }

            if (in_array('auction', array_column($options, 'platform')) && in_array('classified', array_column($options, 'platform'))) {
                if (!empty($arr['listing_option'])) {
                    $data['tbl_listings.listing_option'] =  $arr['listing_option'];
                }
            }
        }

        $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
        $this->db->group_start();
        $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
        $this->db->where_in('tbl_listings.listing_type', array_column($platforms, 'platform'));
        $this->db->where('tbl_purchases.expire_date>=', $today);
        $this->db->where('tbl_purchases.purchase_date <=', $today);
        $this->db->group_end();

        if (!empty($data)) {
            if (!empty($or_conditions)) {
                $this->db->group_start();
                $this->db->where($data);
                $this->db->or_where($or_conditions);
                $this->db->group_end();
                if (!in_array('auction', array_column($options, 'platform')) || !in_array('classified', array_column($options, 'platform'))) {
                    $this->db->where_in('tbl_listings.listing_option', array_column($options, 'platform'));
                }
                $this->db->where_in('tbl_listings.listing_type', array_column($platforms, 'platform'));
            } else {
                $this->db->where($data);

                if (!empty($in_conditions)) {
                    $this->db->where_in('tbl_listings.listing_type', $in_conditions);
                }

                if (!in_array('auction', array_column($options, 'platform')) || !in_array('classified', array_column($options, 'platform'))) {
                    $this->db->where_in('tbl_listings.listing_option', array_column($options, 'platform'));
                }
                $this->db->where_in('tbl_listings.listing_type', array_column($platforms, 'platform'));
            }
        }

        if (!empty($searchterm)) {
            $this->db->group_start();
            $this->db->like('tbl_listings.website_BusinessName', $searchterm);
            $this->db->or_like('tbl_listings.website_tagline', $searchterm);
            $this->db->or_like('tbl_listings.website_metadescription', $searchterm);
            $this->db->or_like('tbl_listings.description', $searchterm);
            $this->db->group_end();
        }

        if (!empty($arr['min']) && !empty($arr['max'])) {
            $this->db->where('tbl_listings.website_buynowprice BETWEEN ' . $arr['min'] . ' AND ' . $arr['max']);
        }

        if ($count) {
            $this->db->distinct();
            $query      = $this->db->get('tbl_listings');
            return $query->num_rows();
        }

        if (!empty($limit)) {
            if ($start !== 0) {
                $start = $limit * ($start - 1);
            }
            $this->db->limit($limit, $start);
        }

        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_listings.user_id');
        $this->db->order_by($sort, 'asc');
        $this->db->distinct();
        $query      = $this->db->get('tbl_listings');
        $dataArr    = $query->result_array();

        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['category']    = $this->_get_single_data('tbl_categories', array('id' => $key['website_industry']), 'c_name');
                $dataArr[$i]['sponsored']   = $this->_get_single_data('tbl_purchases', array('plan_id' => $key['id'], 'listing_type' => 'sponsored', 'tbl_purchases.expire_date>=' => $today, 'tbl_purchases.purchase_date <=' => $today), 'expire_date');
                $dataArr[$i]['username']    = $this->getUserData($key['user_id'])[0]['username'];
                $dataArr[$i]['ago']         = $this->CommonOperationsHandler->time_elapsed_string($key['date']);
                $dataArr[$i]['sell_type']   = $dataArr[$i]['listing_option'];
                $dataArr[$i]['sell_web']    = $dataArr[$i]['listing_type'];

                if ($dataArr[$i]['listing_type'] === 'domain') {
                    $dataArr[$i]['categoryIcon']    =   'domains.svg';
                } else if ($dataArr[$i]['listing_type'] === 'app') {
                    $dataArr[$i]['categoryIcon']    =   'app.svg';
                } else {
                    $dataArr[$i]['categoryIcon']    =   'website.svg';
                }

                $i++;
            }
        }
        return $dataArr;
    }

    /*fetch blog results*/
    public function _fetch_blog_posts($limit, $start, $count = false, $sort = 'date')
    {
        if ($count) {
            $this->db->where('status', 1);
            $query      = $this->db->get('tbl_blog');
            return $query->num_rows();
        }

        $this->db->where('status', 1);
        if (!empty($limit)) {
            if ($start !== 0) {
                $start = $limit * ($start - 1);
            }
            $this->db->limit($limit, $start);
        }

        $this->db->order_by($sort, 'asc');
        $this->db->distinct();
        $query      = $this->db->get('tbl_blog');
        return $query->result_array();
    }

    /*featch most recent posts*/
    public function _fetch_most_recent($id, $type = 'max')
    {
        if ($type === 'max')
            $query = $this->db->query("select * from tbl_blog where id=(select min(id) from tbl_blog where id >" . $this->db->escape($id) . ")");
        else
            $query = $this->db->query("select * from tbl_blog where id=(select  max(id) from tbl_blog where id <" . $this->db->escape($id) . ")");
        return $query->result_array();
    }

    /**Get Monthlywise Earnings*/
    public function _get_monthlywisetotalearnings($year)
    {

        $query = $this->db->query("SELECT Months.m AS month, COALESCE(SUM(tbl_payments.AMOUNT),0) AS total FROM ( SELECT 1 as m UNION SELECT 2 as m UNION SELECT 3 as m UNION SELECT 4 as m UNION SELECT 5 as m UNION SELECT 6 as m UNION SELECT 7 as m UNION SELECT 8 as m UNION SELECT 9 as m UNION SELECT 10 as m UNION SELECT 11 as m UNION SELECT 12 as m ) as Months LEFT JOIN tbl_payments on Months.m = MONTH(tbl_payments.TIMESTAMP) AND YEAR(tbl_payments.TIMESTAMP) = " . $this->db->escape($year) . " GROUP BY Months.m");
        return $query->result_array();
    }

    /**Get UserWise Earnings*/
    public function _get_userwisemonthlyearnings($year, $userid)
    {

        $query = $this->db->query("SELECT Months.m AS month, COALESCE(SUM(tbl_invoices.withdraw_amount),0) AS total FROM ( SELECT 1 as m UNION SELECT 2 as m UNION SELECT 3 as m UNION SELECT 4 as m UNION SELECT 5 as m UNION SELECT 6 as m UNION SELECT 7 as m UNION SELECT 8 as m UNION SELECT 9 as m UNION SELECT 10 as m UNION SELECT 11 as m UNION SELECT 12 as m ) as Months LEFT JOIN tbl_invoices on Months.m = MONTH(tbl_invoices.date) AND YEAR(tbl_invoices.date) = " . $this->db->escape($year) . " AND tbl_invoices.paid_to =" . $this->db->escape($userid) . " GROUP BY Months.m");
        return $query->result_array();
    }

    /**Get Monthlywise Total Listings*/
    public function _get_monthlywisetotallistings($year)
    {

        $query = $this->db->query("SELECT Months.m AS month, COALESCE(COUNT(tbl_listings.date),0) AS total FROM ( SELECT 1 as m UNION SELECT 2 as m UNION SELECT 3 as m UNION SELECT 4 as m UNION SELECT 5 as m UNION SELECT 6 as m UNION SELECT 7 as m UNION SELECT 8 as m UNION SELECT 9 as m UNION SELECT 10 as m UNION SELECT 11 as m UNION SELECT 12 as m ) as Months LEFT JOIN tbl_listings on Months.m = MONTH(tbl_listings.date) AND YEAR(tbl_listings.date) = " . $this->db->escape($year) . " GROUP BY Months.m");
        return $query->result_array();
    }

    /*get auto complete records*/
    public function _markAsCompletedAuto($table = false)
    {
        $settingsData = $this->getSettingsData();
        $this->db->select('*,DATEDIFF(NOW(),date) as diff');
        $this->db->where('DATEDIFF(NOW(),date) > ' . $settingsData[0]['mark_as_completed']);
        $this->db->where_in('status', array(5, 8));
        $query = $this->db->get('tbl_opens');
        if ($table) {
            exit(json_encode($query->result_array()));
        }
        return $query->result_array();
    }

    /*Reset Password Request*/
    public function _reset_user_password()
    {
        $reset_token = $this->CommonOperationsHandler->_generate_unique_tokens('tbl_users');
        $this->EmailOperationsHandler->sendPasswordResetEmail($this->input->post('reset_email'), $reset_token);
        $data = array(
            'token' => $reset_token
        );
        return $this->_update_to_table('tbl_users', $data, array('email' => $this->input->post('reset_email')));
    }

    /*Change User Password Reset*/
    public function _reset_user_password_update()
    {
        $data = array(
            'password' => md5(trim($this->input->post('reset_user_password'))),
            'token' => $this->CommonOperationsHandler->_generate_unique_tokens('tbl_users')
        );

        return $this->_update_to_table('tbl_users', $data, array('email' => $this->input->post('reset_user_email')));
    }

    /*Get Withdrawals Data*/
    public function _withdrawals_data($status)
    {
        $this->db->select('*,(tbl_withdrawals.id) as id,(tbl_withdrawal_methods.method) as methodw, (tbl_withdrawals.status) as statusw , (tbl_withdrawals.fee) as fee');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_withdrawals.user_id');
        $this->db->join('tbl_withdrawal_methods', 'tbl_withdrawals.method = tbl_withdrawal_methods.id', 'left');
        $this->db->where('tbl_withdrawals.status', $status);
        $this->db->order_by('tbl_withdrawals.created_date', 'asc');
        $query = $this->db->get('tbl_withdrawals');
        return $query->result_array();
    }

    /*Get Disputes Data*/
    public function _get_disputes_data($status, $id = '')
    {
        $this->db->select('*,(tbl_opens.contract_id) as contract_id,(tbl_disputes.status) as status');
        $this->db->join('tbl_opens', 'tbl_opens.id = tbl_disputes.contract_id', 'left');
        $this->db->where('tbl_disputes.status', $status);

        if (!empty($id)) {
            $this->db->where('tbl_disputes.contract_id', $id);
        }

        $this->db->order_by('tbl_disputes.id', 'asc');
        $query = $this->db->get('tbl_disputes');
        return $query->result_array();
    }

    /*Get Reported Data*/
    public function _get_reported_data()
    {
        $this->db->select('*');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_reports.reporter');
        $this->db->join('tbl_listings', 'tbl_listings.id = tbl_reports.listing_id');
        $this->db->where('tbl_reports.status', 0);
        $this->db->order_by('tbl_reports.date', 'asc');
        $query = $this->db->get('tbl_reports');
        return $query->result_array();
    }

    /*Get Recent Contarct*/
    public function _get_recent_contract($userid = false, $closed = true, $limit = true)
    {

        if ($userid) {
            $this->db->group_start();
            $this->db->where('tbl_opens.customer_id', $this->session->userdata('user_id'));
            $this->db->or_where('tbl_opens.owner_id', $this->session->userdata('user_id'));
            $this->db->group_end();
        }

        if ($closed) {
            $this->db->group_start();
            $this->db->where_in('tbl_opens.status', array(4, 7));
            $this->db->group_end();
        } else {
            $this->db->group_start();
            $ignore = array(1, 2, 3, 5, 6, 8, 9);
            $this->db->where_in('status', $ignore);
            $this->db->group_end();
        }

        if ($limit) {
            $this->db->order_by('tbl_opens.date');
            $query  = $this->db->get('tbl_opens', 10);
        } else {
            $query  = $this->db->get('tbl_opens');
        }

        $dataArr   = $query->result_array();


        if (!empty($dataArr)) {
            $i = 0;
            foreach ($dataArr as $key) {
                @$dataArr[$i]['customer']    = $this->getUserData($key['customer_id'])[0]['username'];
                @$dataArr[$i]['owner']       = $this->getUserData($key['owner_id'])[0]['username'];
                $i++;
            }
        }

        return $dataArr;
    }

    /*Get All Auction Data*/
    public function _get_auction_data($condition, $limit, $ending = false, $count = false, $start, $void = "", $sold = false)
    {
        $data['platforms']   =   $this->_get_row_data('tbl_platforms', array('type' => 'listing', 'status' => 1));
        $data['options']     =   $this->_get_row_data('tbl_platforms', array('type' => 'option', 'status' => 1));
        $today = date('Y-m-d H:i:s');
        if ($ending) {
            $this->db->select('*,(tbl_listings.id) AS id,DATE_ADD(date, INTERVAL ' . $this->getSettingsData()[0]['auction_period'] . ' DAY) AS ENDDATE ,DATEDIFF(DATE_ADD(date, INTERVAL ' . $this->getSettingsData()[0]['auction_period'] . ' DAY),date) AS NFD', FALSE);
            $this->db->order_by('ENDDATE', 'asc');
        } else {
            $this->db->select('*,(tbl_listings.id) AS id');
            $this->db->order_by('tbl_listings.date', 'desc');
        }

        $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
        $this->db->group_start();
        $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
        $this->db->where('tbl_purchases.expire_date>=', $today);
        $this->db->where('tbl_purchases.purchase_date <=', $today);
        $this->db->group_end();

        $this->db->group_start();
        $this->db->where($condition);
        $this->db->where_not_in('tbl_listings.status', array(0, 6));
        if ($sold) {
            $this->db->where_not_in('tbl_listings.sold_status', array(1));
        }
        $this->db->group_end();

        $this->db->group_start();
        $this->db->where_in('tbl_listings.listing_type', array_column($data['platforms'], 'platform'));
        $this->db->where_in('tbl_listings.listing_option', array_column($data['options'], 'platform'));
        $this->db->group_end();

        $this->db->group_by('tbl_listings.id');

        if ($count) {
            $query      = $this->db->get('tbl_listings');
            return $query->num_rows();
        }

        if (!empty($limit)) {
            if ($start !== 0) {
                $start = $limit * ($start - 1);
            }
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get('tbl_listings');
        $userListings = $query->result_array();

        if (!empty($userListings)) {
            $i = 0;
            foreach ($userListings as $listing) {
                $userListings[$i]['listingType']                = $listing['listing_type']; {
                    $userListings[$i]['totalBids']              = $this->numberOfBids($listing['id'], $listing['listing_type'], '1', 1);
                    $userListings[$i]['totalBidders']           = $this->numberOfBidders($listing['id'], $listing['listing_type'], '1', 0);
                    $userListings[$i]['totalBidValue']          = array_sum(array_column($this->numberOfBids($listing['id'], $listing['listing_type'], '', 1), 'bid_amount'));
                    $endingArr                                  = $this->common->DateDiffCalculate($this->_get_auction_ending_date($listing['id'], 'tbl_listings')[0]['ENDDATE']);
                    $userListings[$i]['endingdays']             = $endingArr['days'];
                    $userListings[$i]['endinghours']            = $endingArr['hours'];
                    $userListings[$i]['highestbid']             = 0;
                    $userListings[$i]['highestbidder']          = 'n/a';
                    $userListings[$i]['averageBid']             = 0;
                    $userListings[$i]['reservedprice']          = $this->_get_single_data('tbl_listings', array('id' => $listing['id']), 'website_reserveprice');
                    $userListings[$i]['auctionstatus']          = 'invalid';
                    if ($endingArr['days'] >= 0 && $endingArr['hours'] >= 0) {
                        $userListings[$i]['auctionstatus']      =   'valid';
                    }

                    if (isset($this->_get_highest_bid_details('1', $listing['id'], $listing['listing_type'])[0]['bid_amount'])) {
                        $userListings[$i]['highestbidrow']         = $this->_get_highest_bid_details('1', $listing['id'], $listing['listing_type'])[0]['bid_amount'];
                        if ($userListings[$i]['highestbidrow'] > 0) {
                            $userListings[$i]['highestbid']        = $this->common->ConvertToMillions($userListings[$i]['highestbidrow']);
                        } else {
                            $userListings[$i]['highestbid']        = $listing['website_startingprice'];
                        }
                        $userListings[$i]['highestbidder']         = $this->getUserData($this->_get_highest_bid_details('1', $listing['id'], $listing['listing_type'])[0]['bidder_id'])[0]['username'];
                    }
                }
                $i++;
            }
            return $userListings;
        }
        return;
    }


    /*Get All Offers Data*/
    public function _get_offers_data($condition, $limit, $count = false, $start)
    {
        $data['platforms']   =   $this->_get_row_data('tbl_platforms', array('type' => 'listing', 'status' => 1));
        $data['options']     =   $this->_get_row_data('tbl_platforms', array('type' => 'option', 'status' => 1));
        $today = date('Y-m-d H:i:s');
        $this->db->select('*,(tbl_listings.id) AS id');
        $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
        $this->db->group_start();
        $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
        $this->db->where('tbl_purchases.expire_date>=', $today);
        $this->db->where('tbl_purchases.purchase_date <=', $today);
        $this->db->group_end();

        $this->db->group_start();
        $this->db->where($condition);
        $this->db->where_not_in('tbl_listings.status', array(0, 6));
        $this->db->group_end();

        $this->db->group_start();
        $this->db->where_in('tbl_listings.listing_type', array_column($data['platforms'], 'platform'));
        $this->db->where_in('tbl_listings.listing_option', array_column($data['options'], 'platform'));
        $this->db->group_end();

        $this->db->group_by('tbl_listings.id');

        if ($count) {
            $query      = $this->db->get('tbl_listings');
            return $query->num_rows();
        }

        if (!empty($limit)) {
            if ($start !== 0) {
                $start = $limit * ($start - 1);
            }
            $this->db->limit($limit, $start);
        }

        $this->db->order_by('tbl_listings.date', 'desc');
        $query = $this->db->get('tbl_listings');
        $userListings = $query->result_array();

        if (!empty($userListings)) {
            $i = 0;
            foreach ($userListings as $listing) {
                $userListings[$i]['listingType']            = $listing['listing_type'];
                $userListings[$i]['totalOffers']            = $this->numberOfOffers($listing['id'], $listing['listing_type'], '1', '');
                $userListings[$i]['totalClients']           = $this->numberOfClients($listing['id'], $listing['listing_type'], '1', 0);
                $userListings[$i]['totalOfferValue']        = array_sum(array_column($this->numberOfOffers($listing['id'], $listing['listing_type'], '', 1), 'offer_amount'));
                $userListings[$i]['ago']                    = $this->CommonOperationsHandler->time_elapsed_string($listing['date']);
                $userListings[$i]['highestOffer']           = 0;
                $userListings[$i]['highestClient']          = 'n/a';
                $userListings[$i]['averageOffer']           = 0;
                $userListings[$i]['minimumOffer']           = $this->_get_single_data('tbl_listings', array('id' => $listing['id']), 'website_minimumoffer');

                if (isset($this->_get_highest_offer_details('0', $listing['id'], $listing['listing_type'])[0]['offer_amount'])) {
                    $userListings[$i]['highestbidrow']      = $this->_get_highest_offer_details('0', $listing['id'], $listing['listing_type'])[0]['offer_amount'];
                    if ($userListings[$i]['highestbidrow'] > 0) {
                        $userListings[$i]['highestbid']     = $this->common->ConvertToMillions($userListings[$i]['highestbidrow']);
                    } else {
                        $userListings[$i]['highestbid']     = $listing['website_startingprice'];
                    }
                    $userListings[$i]['highestbidder']      = $this->getUserData($this->_get_highest_offer_details('0', $listing['id'], $listing['listing_type'])[0]['customer_id'])[0]['username'];
                }
                $i++;
            }
            return $userListings;
        }
        return;
    }

    /*Set Default Language*/
    public function _set_default_language($id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_languages', array('default_status' => 1));

        $this->db->where_not_in('id', $id);
        $this->db->update('tbl_languages', array('default_status' => 0));
    }

    /*User Activate Via Token*/
    public function activateViaToken($token)
    {
        if ($this->db->where('token', $token)->count_all_results('tbl_users') > 0) {
            $this->db->where('token', $token);
            return $this->db->update('tbl_users', array('user_status' => 2));
        }
        return;
    }

    /*Get List Of Bidders Below the current bid*/
    public function _get_lower_bidders($id, $highest, $exclude)
    {
        $this->db->select('*,MAX(bid_amount) as bid_amount');
        $this->db->group_start();
        $this->db->where('bid_amount < ', $highest);
        $this->db->where('listing_id', $id);
        $this->db->where('bid_status', 1);
        $this->db->where_not_in('bidder_id', $exclude);
        $this->db->group_end();
        $this->db->group_by('bidder_id');
        $query = $this->db->get('tbl_bids');
        return $query->result_array();
    }

    /*Check Listing Period is expired*/
    public function _check_listing_expiry_status($id)
    {
        if (!empty($id)) {
            $today = date('Y-m-d H:i:s');
            $this->db->select('*,(tbl_listings.id) AS id');
            $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
            $this->db->group_start();
            $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
            $this->db->where('tbl_purchases.expire_date>=', $today);
            $this->db->where('tbl_purchases.purchase_date <=', $today);
            $this->db->group_end();

            $this->db->group_start();
            $this->db->where('tbl_listings.id', $id);
            $this->db->group_end();

            $this->db->group_by('tbl_listings.id');

            $query      = $this->db->get('tbl_listings');
            if ($query->num_rows() > 0) {
                return true;
            }
        }
        return false;
    }

    /*plugin status changer*/
    public function _plugin_status_changer($id, $status)
    {
        $currentdata = $this->_get_row_data('tbl_platforms', array('id' => $id));
        if (!empty($currentdata)) {
            $this->db->group_start();
            $this->db->where('type', $currentdata[0]['type']);
            $this->db->where('status', 0);
            $this->db->where_not_in('id', $id);
            $this->db->group_end();
            $this->db->update('tbl_platforms', array('status' => 1));
        }
        return $this->_update_to_table('tbl_platforms', array('status' => $status), array('id' => $id));
    }

    /*Get Activated Platforms*/
    public function _get_activated_platforms($void = '')
    {
        $this->db->group_start();
        $this->db->where('type', 'listing');
        $this->db->where('status', 1);
        if (!empty($void)) {
            $this->db->where_not_in('platform', $void);
        }
        $this->db->group_end();
        $query = $this->db->get('tbl_platforms');
        return $query->result_array();
    }

    public function _import_excel($nameBox)
    {
        $this->load->library("upload");
        $this->load->helper("file");
        $config['upload_path']      = IMPORT_FOLDER;
        $config['allowed_types']    = 'csv';
        $config['max_size']         = 1048576;
        $this->upload->initialize($config);
        $this->upload->overwrite = true;
        if (!$this->upload->do_upload($nameBox)) {
            $error = array('error' => $this->upload->display_errors('', ''));
            if (isset($error['error'])) {
                return $error['error'];
            }
        } else {
            $import_data = $this->upload->data();
            $file = $import_data['full_path'];
            $handle = fopen($file, "r");
            if (isset($file)) {
                $data = $this->_prepare_array($handle, $this->input->post('import_type'));
                if ($data) {
                    if (!empty($data)) {
                        foreach ($data as $key) {
                            $period = $key['activate_days'];
                            unset($key['activate_days']);
                            $planid = $this->_insert_to_DB('tbl_listings', $key);
                            if (!empty($planid)) {
                                if ($this->_insert_purchasedata_admin($this->session->userdata('user_id'), array('user_membership_id' => $planid, 'user_membership_timestamp' => date('Y-m-d H:i:s'), 'listing_type' => $key['listing_type'], 'user_membership_timestamp_expiry' => date("Y-m-d", strtotime(date("Y-m-d", strtotime(date('Y-m-d H:i:s'))) . "+ " . $period . "day")), 'plan_header' => 'ADMIN'))) {
                                }
                            }
                        }
                        return true;
                    } else {
                        return "Sorry, Something went wrong. Please try again";
                    }
                } else {
                    return "Invalid Records found, Import failed";
                }
            }

            return $data;
        }
    }

    /*Prepare Array for Bulk import*/
    public function _prepare_array($handle, $importtype)
    {
        $data           = array();
        $domainArr          = array();
        $deviceData         = $this->common->detectVisitorDevice();
        $datas['settings']  = $this->database->getSettingsData();
        if ($importtype === 'bulk') {
            $i = 0;
            while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                if ($filesop[2] === 'website' || $filesop[2] === 'domain') {
                    if (!empty($filesop[0])) {
                        if ($this->_validate_domain($filesop[0])) {
                            if ($this->CheckAlreadyExists('tbl_domains', array('domain' => $filesop[0], 'user_id', $this->session->userdata('user_id'))) > 0) {
                                $domain_id = $this->_get_single_data('tbl_domains', array('domain' => $filesop[0], 'user_id', $this->session->userdata('user_id')), 'id');
                            } else {
                                $domainArr = array(
                                    'domain' => $filesop[0],
                                    'category_id' => 2,
                                    'user_id' => $this->session->userdata('user_id'),
                                    'status' => 0,
                                    'token' => $this->common->_generate_unique_tokens('tbl_domains'),
                                    'date' => date('Y-m-d H:i:s')
                                );

                                $domain_id = $this->_insert_to_DB('tbl_domains', $domainArr);
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }

                    if (!empty($filesop[3])) {
                        if (!$this->CheckAlreadyExists('tbl_categories', array('id' => $filesop[3])) > 0) {
                            return false;
                        }
                    } else {
                        return false;
                    }

                    if (empty($filesop[9])) {
                        return false;
                    }

                    if (empty($filesop[17])) {
                        return false;
                    }

                    if (!empty($datas['settings'][0]['google_api_key']) &&  $filesop[2] === 'website') {
                        $screenshot =  $this->AnalyticsOperationsHandler->snap('https://' . $filesop[0], $this->common->_generate_unique_tokens('tbl_listings', 'screenshot'), $datas['settings'][0]['google_api_key']);
                    } else {
                        $screenshot = '';
                    }

                    if (empty($filesop[19])) {
                        return false;
                    } else {
                        if ($filesop[19] === 'auction') {
                            if (!empty($filesop[20]) && !empty($filesop[21])) {
                                if ($filesop[20] > $filesop[21]) {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        } else if ($filesop[19] === 'classified') {
                            if (empty($filesop[22])) {
                                return false;
                            }
                        }
                    }

                    if (empty($filesop[25])) {
                        return false;
                    }


                    $data[$i] = array(
                        'domain_id' => $domain_id,
                        'listing_type' => $filesop[2],
                        'user_id' => $this->session->userdata('user_id'),
                        'website_BusinessName' => $filesop[0],
                        'extension' => $filesop[1],
                        'website_age' => $filesop[12],
                        'business_registeredCountry' => $filesop[11],
                        'website_industry' => $filesop[3],
                        'monetization_methods' => 'N/A',
                        'last12_monthsrevenue' => $filesop[4],
                        'last12_monthsexpenses' => $filesop[5],
                        'annual_profit' => $filesop[6],
                        'google_verified' => 0,
                        'financial_uploadVisual' => "",
                        'financial_uploadProfitLoss' => "",
                        'website_tagline' => $filesop[8],
                        'website_metadescription' => $filesop[8],
                        'website_metakeywords' => json_encode($filesop[9]),
                        'description' => $filesop[10],
                        'website_how_make_money' => $filesop[13],
                        'website_purchasing_fulfilment' => $filesop[14],
                        'website_whyselling' => $filesop[15],
                        'website_suitsfor' => $filesop[16],
                        'website_thumbnail' =>  $filesop[18],
                        'screenshot' => $screenshot,
                        'website_cover' => '',
                        'status' => 0,
                        'sold_status' => 0,
                        'deliver_in' => $filesop[17],
                        'listing_option' => $filesop[19],
                        'website_startingprice' => $filesop[20],
                        'website_reserveprice' => $filesop[21],
                        'website_minimumoffer' => $filesop[22],
                        'website_buynowprice' => $filesop[23],
                        'monthly_downloads' => '',
                        'app_url' => '',
                        'app_market' => '',
                        'user_ip' => $deviceData['ip_address'],
                        'date' => date('Y-m-d H:i:s'),
                        'token' => 'bulk-imported',
                        'activate_days' => $filesop[25]
                    );
                } else if ($filesop[2] === 'app') {
                    if (!empty($filesop[24])) {
                        if (!$this->validateApp($filesop[24])) {
                            return false;
                        }
                    } else {
                        return false;
                    }

                    if (!empty($filesop[3])) {
                        if (!$this->CheckAlreadyExists('tbl_categories', array('id' => $filesop[3])) > 0) {
                            return false;
                        }
                    } else {
                        return false;
                    }

                    if (empty($filesop[9])) {
                        return false;
                    }

                    if (empty($filesop[17])) {
                        return false;
                    }

                    if (empty($filesop[19])) {
                        return false;
                    } else {
                        if ($filesop[19] === 'auction') {
                            if (!empty($filesop[20]) && !empty($filesop[21])) {
                                if ($filesop[20] > $filesop[21]) {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        } else if ($filesop[19] === 'classified') {
                            if (empty($filesop[22])) {
                                return false;
                            }
                        }
                    }

                    if (empty($filesop[25])) {
                        return false;
                    }


                    $data[$i] = array(
                        'domain_id' => 0,
                        'listing_type' => $filesop[2],
                        'user_id' => $this->session->userdata('user_id'),
                        'website_BusinessName' => $filesop[0],
                        'extension' => $filesop[0],
                        'website_age' => $filesop[12],
                        'business_registeredCountry' => $filesop[11],
                        'website_industry' => $filesop[3],
                        'monetization_methods' => 'N/A',
                        'last12_monthsrevenue' => $filesop[4],
                        'last12_monthsexpenses' => $filesop[5],
                        'annual_profit' => $filesop[6],
                        'google_verified' => 0,
                        'financial_uploadVisual' => "",
                        'financial_uploadProfitLoss' => "",
                        'website_tagline' => $filesop[8],
                        'website_metadescription' => $filesop[8],
                        'website_metakeywords' => json_encode($filesop[9]),
                        'description' => $filesop[10],
                        'website_how_make_money' => $filesop[13],
                        'website_purchasing_fulfilment' => $filesop[14],
                        'website_whyselling' => $filesop[15],
                        'website_suitsfor' => $filesop[16],
                        'website_thumbnail' =>  $filesop[18],
                        'screenshot' => '',
                        'website_cover' => '',
                        'status' => 0,
                        'sold_status' => 0,
                        'deliver_in' => $filesop[17],
                        'listing_option' => $filesop[19],
                        'website_startingprice' => $filesop[20],
                        'website_reserveprice' => $filesop[21],
                        'website_minimumoffer' => $filesop[22],
                        'website_buynowprice' => $filesop[23],
                        'monthly_downloads' => '',
                        'app_url' => $filesop[24],
                        'app_market' => $this->CommonOperationsHandler->get_full_domain_url($filesop[24]),
                        'user_ip' => $deviceData['ip_address'],
                        'date' => date('Y-m-d H:i:s'),
                        'token' => 'bulk-imported',
                        'activate_days' => $filesop[25]
                    );
                }
                $i++;
            }
        }
        return $data;
    }


    /*Validate Domain Name*/
    public function _validate_domain($domain_name)
    {
        return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) && preg_match("/^.{1,253}$/", $domain_name) && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name));
    }

    /*Insert Listing Purchase Data*/
    public function _insert_purchasedata_admin($user_id, $Arr)
    {
        $data = array(
            'invoice_id' => $this->CommonOperationsHandler->_generate_paymentID('tbl_purchases', 'invoice_id'),
            'user_id' => $user_id,
            'plan_id' => $Arr['user_membership_id'],
            'plan_header' => $Arr['plan_header'],
            'listing_type' => $Arr['listing_type'],
            'purchase_date' => $Arr['user_membership_timestamp'],
            'expire_date' => $Arr['user_membership_timestamp_expiry']
        );

        if ($this->_update_to_DB('tbl_listings', array('status' => 1), $Arr['user_membership_id'])) {
            return $this->_insert_to_table('tbl_purchases', $data);
        }
    }

    /*Validate App URLs*/
    public function validateApp($url)
    {
        $output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $result = $this->CommonOperationsHandler->checkGooglePlayApp($url);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function _userwise_solution_listings($userId = "", $limit = "", $start = "", $search = "")
    {
        $this->db->select('s1.id ,s1.user_id, s1.name , s1.status,  s1.description,s1.date, s1.price, s1.delivery_days, c1.id as category_id,c1.c_name as category ,c2.id as sub_category_id,c2.c_name as sub_category ,s2.c_name as service_type ');
        $this->db->from('tbl_solutions as s1');
        $this->db->join('tbl_solution_categories c1', 's1.category_id = c1.id', 'left');
        $this->db->join('tbl_solution_categories c2', 's1.sub_category_id = c2.id', 'left');
        $this->db->join('tbl_solution_service_types s2', 's1.service_type_id = s2.id', 'left');
        $this->db->order_by("s1.date", 'DESC');

        if (!empty($userId)) {
            $this->db->where('s1.user_id', $userId);
        }
        if (!empty($limit) && !empty($start) && empty($search)) {
            $offset = ($start - 1) * $limit;
            $this->db->limit($limit, $offset);
        }


        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('s1.name', $search);
            $this->db->or_like('s1.price', $search);
            $this->db->or_like('c1.c_name ', $search);
            $this->db->or_like('c2.c_name ', $search);
            $this->db->or_like('s2.c_name ', $search);
            $this->db->group_end();
        }
        $query = $this->db->get();
        // pre($this->db->last_query());
        $output['solution'] =  $query->result_array();
        if (!empty($output['solution'])) {
            $this->db->select('*')->from('tbl_solution_media');
            $this->db->where_in('solution_id', array_column($output['solution'], 'id'));
            $query = $this->db->get();
            $output['solutions_media'] = $query->result_array();
        }
        return $output;
    }




    public function front_solution_listings($limit = 4, $start = 1, $search = "", $pageName = "", $condition = "")
    {
        $this->db->select('l1.id, s1.id as solutionId, s1.solution_url, s1.user_id, s1.slug, s1.name as website_BusinessName, s1.description,s1.date, s1.price, s1.delivery_days,  c1.id as category_id,c1.c_name as category ,c2.id as sub_category_id,c2.c_name as sub_category ,s2.c_name as service_type , s1.listing_header_priority');
        $this->db->from('tbl_solutions as s1');
        $this->db->order_by('s1.date', 'desc');

        if (!empty($search)) {
            $this->db->like('s1.name', $search);
        }


        if (!empty($condition)) {

            $this->db->where($condition);
        }
        if (!empty($pageName)) {
            $this->db->where("FIND_IN_SET('$pageName',s1.display_on_page) != ", 0);
        }
        $this->db->join('tbl_solution_categories c1', 's1.category_id = c1.id', 'left');
        $this->db->join('tbl_solution_categories c2', 's1.sub_category_id = c2.id', 'left');
        $this->db->join('tbl_solution_service_types s2', 's1.service_type_id = s2.id', 'left');
        $this->db->join('tbl_listings l1', 's1.id = l1.solution_id', 'left');

        //, s3.name as website_thumbnail'--$this->db->join('tbl_solution_media s3', 's1.id = s3.solution_id', 'left');


        $this->db->where('s1.status <>', '9');
        $this->db->where('s1.sponsorship_priority <>', '4');

        if (!empty($limit)) {
            $offset = ($start - 1) * $limit;
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get()->result_array();

        //  now getting again data from sponsored data
        $this->db->select('l1.id,  s1.id as solutionId, s1.solution_url, s1.user_id, s1.slug, s1.name as website_BusinessName, s1.description,s1.date, s1.price, s1.delivery_days, c1.id as category_id,c1.c_name as category ,c2.id as sub_category_id,c2.c_name as sub_category ,s2.c_name as service_type ,s1.sponsorship_priority , s1.listing_header_priority');
        $this->db->from('tbl_solutions as s1');
        $this->db->order_by('s1.date', 'desc');

        // get page wise data
        if (!empty($pageName)) {
            $this->db->where("FIND_IN_SET('$pageName',s1.display_on_page) != ", 0);
        }
        $this->db->join('tbl_solution_categories c1', 's1.category_id = c1.id', 'left');
        $this->db->join('tbl_solution_categories c2', 's1.sub_category_id = c2.id', 'left');
        $this->db->join('tbl_solution_service_types s2', 's1.service_type_id = s2.id', 'left');
        $this->db->join('tbl_listings l1', 's1.id = l1.solution_id', 'left');

        //, s3.name as website_thumbnail'--$this->db->join('tbl_solution_media s3', 's1.id = s3.solution_id', 'left');

        $this->db->where('s1.status <>', '9');
        $this->db->where('s1.sponsorship_priority = ', '4');

        if (!empty($search)) {
            $this->db->like('s1.name', $search);
        }
        $this->db->order_by('rand()');
        $this->db->limit(SPONSORSHIP_DISPALY_LIMIT);

        // collect sponsor data 
        $query_sponsor = $this->db->get()->result_array();
        // pre($query_sponsor , 1);
        $query =  array_merge($query_sponsor, $query);
        // Loop through the solution array
        foreach ($query as $i => $solution) {
            // Get an array of solutions images
            $this->db->where('solution_id', $solution['solutionId']);
            $images_query = $this->db->get('tbl_solution_media')->result_array();
            // Add the images array to the array entry for this solution
            $query[$i]['website_thumbnail'] = $images_query;
        }

        // pre($this->db->last_query(), 1);
        return  $query;
    }
    public function getSoldORNot($Id = "")
    {
        $this->db->from(' tbl_invoices');
        $this->db->where('listing_id', $Id);
        $invoices = $this->db->get();
        $invoice = $invoices->row();

        return $invoice;
    }
    public function _get_solutionById($solutionId, $userId = "")
    {
        $this->db->select('s1.id ,s1.user_id, s1.name , s1.solution_url ,s1.slug , s1.status, s1.description, s1.price, s1.delivery_days, s1.listing_header_priority, s1.sponsorship_priority,
        s1.title,s1.metadescription,s1.metakeywords,s1.display_on_page,s1.frontend_section,s1.original_minimumoffer,
        s1.original_buynowprice	,s1.original_discountprice,s1.commission_type ,s1.commission_user_product ,s1.commission_amount, s1.page_tags, 
        c1.id as category_id,c1.c_name as category , 
        c2.id as sub_category_id,c2.c_name as sub_category ,s2.c_name as service_type, s2.id as service_type_id');
        $this->db->from('tbl_solutions as s1');
        $this->db->join('tbl_solution_categories c1', 's1.category_id = c1.id', 'left');
        $this->db->join('tbl_solution_categories c2', 's1.sub_category_id = c2.id', 'left');
        $this->db->join('tbl_solution_service_types s2', 's1.service_type_id = s2.id', 'left');
        $this->db->where('s1.id', $solutionId);
        if (!empty($userId)) {
            $this->db->where('user_id', $userId);
        }
        $query = $this->db->get();
        $output['solution'] =  $query->result_array();

        if (count($output['solution']) > 0) {
            $this->db->select('*')->from('tbl_solution_media');
            $this->db->where_in('solution_id', array_column($output['solution'], 'id'));
            $query = $this->db->get();
            $output['solutions_media'] = $query->result_array();
        }
        return $output;
    }



    public function getSolutionDetailsBySlug($solutionSlug, $userId = "")
    {
        $this->db->select('l1.id , s1.id as solutionId, s1.solution_url , s1.date, s1.slug , s1.user_id, s1.name , s1.description, s1.price, s1.delivery_days, s1.title,s1.metakeywords,s1.metadescription, s1.page_tags, c1.id as category_id,c1.c_name as category ,c2.id as sub_category_id,c2.c_name as sub_category ,s2.c_name as service_type, s2.id as service_type_id', 's1.sponsorship_priority');
        $this->db->from('tbl_solutions as s1');
        $this->db->join('tbl_solution_categories c1', 's1.category_id = c1.id', 'left');
        $this->db->join('tbl_solution_categories c2', 's1.sub_category_id = c2.id', 'left');
        $this->db->join('tbl_solution_service_types s2', 's1.service_type_id = s2.id', 'left');
        $this->db->join('tbl_listings l1', 's1.id = l1.solution_id', 'left');

        $this->db->where('s1.slug', $solutionSlug);
        if (!empty($userId)) {
            $this->db->where('user_id', $userId);
        }
        $query = $this->db->get();
        $output =  $query->result_array();

        if (count($output) > 0) {
            $this->db->select('name as website_thumbnail')->from('tbl_solution_media');
            $this->db->where_in('solution_id', array_column($output, 'solutionId'));
            $query = $this->db->get();
            $solutions_media = $query->result_array();
            if (!empty($solutions_media)) {
                $output = $output[0] + $solutions_media[0];
            } else {
                $output = $output[0];
            }
        }
        return $output;
    }



    /*Get _get_category_subcatory solutions*/
    public function _get_category_subcatory($table, $id = "")
    {

        $this->db->select('p.id as id, p.c_name as c_name, c.c_name as c_parent, p.c_thumb as c_thumb ,
        p.c_description as c_description ,p.c_keywords as c_keywords ,p.url_slug as url_slug  , p.parent_id as parent_id');

        $this->db->from("$table  p");
        $this->db->join("$table  c", 'c.id = p.parent_id', 'left');
        if (!empty($id)) {
            $this->db->where('p.id',  $id);
        }
        $query = $this->db->get();
        $dataArr    = $query->result_array();
        if (!empty($dataArr)) {
            return $dataArr;
        }
    }


    //SELECT t1.id,t1.name as cat ,t2.name as parent , t1.status FROM tbl_course_category t1 LEFT JOIN tbl_course_category t2 on t1.parent_id = t2.id ORDER BY id DESC


    /*Get _get_category_subcatory solutions*/
    public function _get_catsubcat_course($table, $id = "", $limit = "", $start = "")
    {

        $this->db->select('t1.id, t1.name as category, t2.name as parent, t1.status');
        $this->db->from("$table  t1");
        $this->db->join("$table  t2", 't1.parent_id = t2.id', 'left');
        if (!empty($id)) {
            $this->db->where('t1.id',  $id);
        }
        if (!empty($limit) && !empty($start)) {
            $offset = ($start - 1) * $limit;
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('t1.id', 'DESC');
        $query = $this->db->get();
        $dataArr    = $query->result_array();
        if (!empty($dataArr)) {
            return $dataArr;
        }
    }

    public function _get_courses($id = "", $limit = "", $start = "", $condition = "", $total = "", $slug = "")
    {
        if (empty($id) && !empty($slug)) {
            $this->db->select('tbl_course.id');
            $this->db->where('tbl_course.slug',  $slug);
            $data  = $this->db->get('tbl_course')->result_array()[0];
            $id = $data['id'];
        }

        $this->db->select('t1.id,COUNT(t3.id) as lession_count, t1.name, t1.description,t1.course_category_id,t1.membership_level_id, t1.course_type, t1.metatitle as site_title , t1.slug, t1.metadescription as site_metadescription  ,t1.metakeywords as site_keywords,  t4.name as category_name , t1.status, t1.price, t1.page_tags, t2.name as image');
        $this->db->from("tbl_course t1");
        $this->db->join("tbl_course_media t2", 't1.id = t2.course_id', 'left');
        $this->db->join("tbl_course_lession t3", 't1.id = t3.course_id', 'left');
        $this->db->join("tbl_course_category t4", 't1.course_category_id = t4.id', 'left');
        $this->db->group_by('t1.id');

        if (!empty($condition)) {
            $this->db->where($condition);
        }

        if (!empty($id)) {
            $this->db->where('t1.id',  $id);
        }

        if (!empty($total)) {
            $query  = $this->db->get();
            return $query->num_rows();
        }

        if (!empty($limit) && !empty($start)) {
            $offset = ($start - 1) * $limit;
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('t1.id', 'DESC');

        $query = $this->db->get();
        $dataArr    = $query->result_array();
        // pre($this->db->last_query());
        if (!empty($dataArr)) {
            return $dataArr;
        }
    }

    public function _get_lession($table, $course_id = 0, $limit = "", $start = 0, $active = "", $slug = "", $orderBy = 'DESC')
    {

        if (!empty($slug)) {

            $this->db->select('tbl_course.id');
            $this->db->where('tbl_course.slug',  $slug);
            $data  = $this->db->get('tbl_course')->result_array();
            if (!empty($data)) {

                $course_id = $data[0]['id'];
            }
        }

        $this->db->select('*');
        $this->db->from($table);
        if (!empty($course_id)) {
            $this->db->where('course_id',  $course_id);
        }
        if (!empty($active)) {
            $this->db->where('status', $active);
        }
        if (!empty($limit)) {
            $offset = ($start - 1) * $limit;
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('id', $orderBy);
        $query = $this->db->get();
        $dataArr    = $query->result_array();
        if (!empty($dataArr)) {
            return $dataArr;
        }
    }

    public function _deleteCourseLesson($courseId = 0, $lessonId = 0, $userId = 0)
    {
        if ($courseId != 0) {
            $courseId = $this->_get_single_data('tbl_course', ['id' => $courseId], 'id');
            if ($courseId != '') {
                $this->_delete_from_table('tbl_course_lession', ['course_id' => $courseId]);
                return $this->_delete_from_table('tbl_course', ['id' => $courseId]);
            }
        }
        if ($lessonId !=  0) {
            return $this->_delete_from_table('tbl_course_lession', ['id' => $lessonId]);
        }
    }


    public function getAllPermissionsAndMenus()
    {
        $this->db->select('m1.id as id , m1.name , m1.controller, m1.action as action ,m1.permission as permission, m1.menu as menu ');
        $this->db->from("tbl_menus m1");
        $this->db->join("tbl_menus m2", 'm2.parent_id = m2.id', 'left');
        $query = $this->db->get();
        $dataArr    = $query->result_array();
        if (!empty($dataArr)) {
            return $dataArr;
        }
    }

    public function getUserAdminPermission($user_id)
    {
        $this->db->select('m1.id as id , m1.name , m1.controller, m1.action as action ,m1.permission as permission, m1.menu as menu ');
        $this->db->from("tbl_menus m1");
        $this->db->join(" tbl_admin_permission m2", 'm2.menu_id = m1.id');
        $this->db->where('m2.user_id',  $user_id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        $dataArr    = $query->result_array();

        if (!empty($dataArr)) {
            return $dataArr;
        }
    }
    public function getCheckRoutePermission($user_id, $controller, $action)
    {
        $this->db->select('m1.id as id , m1.name , m1.controller, m1.action as action ,m1.permission as permission, m1.menu as menu ');
        $this->db->from("tbl_menus m1");
        $this->db->join(" tbl_admin_permission m2", 'm2.menu_id = m1.id');
        $this->db->where('m2.user_id',  $user_id);
        $this->db->where('m1.controller',  $controller);
        $this->db->where('m1.action',  $action);

        $query = $this->db->get();
        $dataArr    = $query->result_array();


        if (!empty($dataArr)) {
            return $dataArr;
        } else {
            return false;
        }
    }


    // SELECT m1.id as id , m1.name , m1.controller, m1.action as action ,m1.permission as permission, m1.menu as menu FROM tbl_menus m1 LEFT JOIN tbl_menus m2 on m1.parent_id = m2.id

    //SELECT m1.id as id , m1.name , m1.controller, m1.action as action ,m1.permission as permission, m1.menu as menu FROM tbl_menus m1 where m1.parent_id = 0
    public function getAdminPermission()
    {
        $this->db->select("m1.id , m1.name , m1.controller, m1.action ,m1.permission , m1.menu  ");
        $this->db->from("tbl_menus m1");
        // $this->db->join("tbl_menus m2", 'm1.parent_id = m2.id');
        $this->db->where('m1.parent_id', 0);
        $query = $this->db->get();
        $dataArr1[]    = $query->result_array();

        foreach ($dataArr1 as $data) {
            foreach ($data as $val) {
                $this->db->select("m1.id , m1.name , m1.controller, m1.action ,m1.permission , m1.menu  ");
                $this->db->from("tbl_menus m1");
                $this->db->where('m1.parent_id', $val['id']);
                // ONLY LIST DATA 
                $this->db->where('m1.permission', 'list');
                // IF REMOVE ABOVE THE WE WILL GET ALL DATA
                $query = $this->db->get()->result_array();
                $dataArr[$val['name']]   = [$val] + $query;
            }
        }

        if (!empty($dataArr)) {
            return $dataArr;
        } else {
            return false;
        }
    }

    /**
     * get all permission level
     *
     * @return void
     * 
     * SELECT t1.id, t1.name, t1.status , t2.permission_slug , t2.is_allowed FROM tbl_membership_level t1 left JOIN tbl_membership_permissions t2 on t1.id = t2.membership_level_id WHERE t2.is_allowed = 1
     */
    public function getMembershipLevelPermission()
    {
        $this->db->select(' t1.id, t1.name, t1.status , t2.permission_slug , t2.is_allowed ');
        $this->db->from("tbl_membership_level t1");
        $this->db->join("tbl_membership_permissions t2", 't1.id = t2.membership_level_id');
        $this->db->where('t2.is_allowed', 1);
        $query = $this->db->get();
        $dataArr   = $query->result_array();
        $dataArr1 = [];
        $name = [];
        foreach ($dataArr as $key => $val) {
            if (!in_array($val['name'], $name)) {
                $name = [];
                $name[] =  $val['name'];
                $dataArr1[$val['name']]['id'] = $val['id'];
                array_push($dataArr1[$val['name']], $val['permission_slug']);
            } else {
                array_push($dataArr1[$val['name']], $val['permission_slug']);
            }
        }

        if (!empty($dataArr1)) {
            return $dataArr1;
        } else {
            return false;
        }
    }

    /**
     * get user's membership level
     *
     * @param [type] $user_id
     * @return void
     * 
     * select t1.id , t1.name , t1.price , t1.status , t2.permission_slug , t2.is_allowed FROM tbl_membership_level t1 left join tbl_membership_permissions t2 on t1.id = t2.membership_level_id WHERE membership_level_id = 6 and t2.is_allowed = 1
     */
    public function getUserMembershipLevelPermission($user_id)
    {
        $this->db->select("*");
        $this->db->where('t1.user_id', $user_id);
        $this->db->from("tbl_users t1");
        $user = $this->db->get()->result_array();
        //====
        $this->db->select('t1.id , t1.name , t1.price , t1.status , t2.permission_slug , t2.is_allowed ');
        $this->db->from("tbl_membership_level t1 ");
        $this->db->join(" tbl_membership_permissions t2", 't1.id = t2.membership_level_id');
        $this->db->where('t2.membership_level_id',  $user[0]['membership_level']);
        $this->db->where('t2.is_allowed ', 1);
        $this->db->group_by("t1.id");
        $query = $this->db->get();
        // echo $this->db->last_query();
        $dataArr    = $query->result_array();

        if (!empty($dataArr)) {
            return $dataArr;
        }
    }


    public function defalutMembership($membership_id = 0)
    {
        if ($membership_id != 0) {

            // get current default membership id
            $this->db->select('id');
            $this->db->where('is_default', 1);
            $this->db->from('tbl_membership_level');
            $query = $this->db->get();
            $dataArr = $query->result_array();
            if (!empty($dataArr)) {
                $currentDefaultMembershipId = $dataArr[0]['id'];
                $curretDate =  Date('Y:m:d 0:0:0');

                $data =  array("membership_level" => $membership_id, 'membership_assign_date' => $curretDate);
                $conditions = ['membership_level' => $currentDefaultMembershipId];

                // update all users have default with new default cacahe.
                $this->_update_to_table('tbl_users', $data, $conditions);
            }

            // make all zero 
            $data = ['is_default' => 0];
            $condition = 'is_default <= 2';
            $this->_update_to_table('tbl_membership_level', $data, $condition);

            // make it as default 
            $data = ['is_default' => 1];
            $condition = ['id' => $membership_id];
            $this->_update_to_table('tbl_membership_level', $data, $condition);



            // if change default membership then it will delete all cache
            $this->load->driver('cache');
            $this->cache->file->clean();
        }
    }

    public function guestMembership($membership_id = 0)
    {
        if ($membership_id != 0) {
            // make all zero 
            $data = ['is_guest' => 0];
            $condition = 'is_guest <= 2';
            $this->_update_to_table('tbl_membership_level', $data, $condition);

            // make it as guest permission 
            $data = ['is_guest' => 1];
            $condition = ['id' => $membership_id];
            $this->_update_to_table('tbl_membership_level', $data, $condition);
        }
    }

    public function getUserAllowePermission($membership_level_id =  0, $user = "")
    {

        if (!empty($membership_level_id)) {

            if (!empty($user)) {

                // $membership_plan_assigned_date = date('Y-m-d', strtotime($user[0]['membership_assign_date']));
                // $membership_row = $this->_get_row_data('tbl_membership_level', ['id' => $membership_level_id, 'status' => 1 , 'is_guest' => 0]);
                // $validity_days  =  $membership_row[0]['validity'];
                // $daysTilldate   = date('Y-m-d', strtotime($membership_plan_assigned_date. ' + '.$validity_days.' days'));
                // $today          = date('Y-m-d');
                // pre($today);
                // pre($daysTilldate,1);

                $membership_plan_date = date('Y-m-d', strtotime($user[0]['membership_assign_date']));
                $today         = date('Y-m-d');
                $daysTilldate = abs(round((strtotime($today)) - strtotime($membership_plan_date)) / 86400);
                $dataArr = $this->_get_row_data('tbl_membership_level', ['id' => $membership_level_id, 'status' => 1,  'is_guest' => 0]);
                if (count($dataArr) >  0) {
                    if ($dataArr[0]['validity'] != 1) {

                        $validity = $dataArr[0]['validity'];
                        if (!empty($validity)) {
                            if ($validity >= $daysTilldate) {
                                $dataArr = $this->_get_row_data('tbl_membership_permissions', ['membership_level_id' => $membership_level_id, 'is_allowed' => 1]);
                            } else {
                                $defaultMembership = $this->_get_row_data('tbl_membership_level', ['is_default' => 1]);
                                if (!empty($defaultMembership[0]['id']) && !empty($user[0]['id'])) {
                                    $this->_update_to_table('tbl_users', ['membership_level' => $defaultMembership[0]['id']], $user[0]['id']);
                                }
                            }
                        } else {
                            // validity is zero the it will not calculate date. 
                            $dataArr = $this->_get_row_data('tbl_membership_permissions', ['membership_level_id' => $membership_level_id, 'is_allowed' => 1]);
                        }
                    } else {
                        // if permission is never expired than given permission will called.
                        $dataArr = $this->_get_row_data('tbl_membership_permissions', ['membership_level_id' => $membership_level_id, 'is_allowed' => 1]);
                    }
                } else {
                    // if it is not guest plan then default plan
                    $dataArr = $this->_get_row_data('tbl_membership_permissions', ['membership_level_id' => $membership_level_id, 'is_allowed' => 1]);
                }
            } else {
                // allow permission to Guest
                $dataArr = $this->_get_row_data('tbl_membership_permissions', ['membership_level_id' => $membership_level_id, 'is_allowed' => 1]);
            }

            // pre($dataArr,1);

            $slugs =  array_column($dataArr, 'permission_slug');

            $arr = MEMBERSHIP_PERMISSION;

            $newArr = [];
            foreach ($arr as  $key => $val) {
                $newval =  [];
                foreach ($val as $k => $v) {
                    if (in_array($v, $slugs)) {
                        $newval[$k] = 1;
                    } else {
                        $newval[$k] = 0;
                    }
                }
                $newArr[$key] = $newval;
            }

            foreach ($newArr as $key => $val) {
                if ($key == 'course') {
                    foreach ($val as $k => $v) {
                        if (!empty($v)) {
                            $index = array_search($k, COURSE_TYPE);
                            $val[$k] = $index;
                        }
                    }
                    $newArr['course'] = $val;
                }
            }

            return $newArr;
        }
    }
    /**
     * get module wise permission
     *
     * @return void
     */
    public function getAllMembershipLevelPermission()
    {

        $this->db->select('t1.slug as parent, t2.id as id ,t2.slug as child  ');
        $this->db->from("tbl_permissions t1 ");
        $this->db->join(" tbl_permissions t2", 't1.id = t2.master_id');
        $query = $this->db->get();
        $dataArr1    = $query->result_array();

        $dataArr = [];
        foreach ($dataArr1 as $key => $val) {
            $dataArr[$val['parent']][$val['id']] = $val['child'];
        }
        if (!empty($dataArr)) {
            return $dataArr;
        }
    }


    public function getIdBySlug($table = "", $slug = "")
    {
        if (!empty($slug)  && !empty($slug)) {
            return $this->_get_single_data($table, ['slug' => $slug], 'id');
        }
    }

    public function getAllMainPermissions()
    {
        //SELECT s1.id, s1.name , s2.slug , s1.master_id FROM tbl_permissions s1  join tbl_permissions s2 on s2.master_id = s1.id and s1.status=1 ORDER by s1.name

        $this->db->select('s2.id, s1.name , s2.slug   ');
        $this->db->from("tbl_permissions s1 ");
        $this->db->join(" tbl_permissions s2", 's2.master_id = s1.id ');
        $this->db->where("s1.status = 1 ");
        $this->db->order_by('s1.name');
        $query = $this->db->get();
        $dataArr  = $query->result_array();

        if (!empty($dataArr)) {
            return $dataArr;
        }
    }


    public function all_website_count()
    {

        $sql = "SELECT SUM(FIND_IN_SET('product-category-fashion', display_on_page) > 0) as fashion , 
    SUM(FIND_IN_SET('product-category-gadgets-electronics', display_on_page) > 0) as gadgets_electronics,
    SUM(FIND_IN_SET('product-category-health', display_on_page) > 0) as health ,
    SUM(FIND_IN_SET('product-category-pets', display_on_page) > 0) as pets,
    SUM(FIND_IN_SET('product-category-sports', display_on_page) > 0) as sports,
    SUM(FIND_IN_SET('product-category-jewelry', display_on_page) > 0) as jewelry,
    SUM(FIND_IN_SET('product-category-toys', display_on_page) > 0) as toys,
    SUM(FIND_IN_SET('product-category-travel', display_on_page) > 0) as travel,
    SUM(FIND_IN_SET('product-category-home-decor', display_on_page) > 0) as home_decor
    
     FROM tbl_solutions a";
        $query = $this->db->query($sql);
        $dataArr  = $query->result_array();
        if (!empty($dataArr)) {
            return $dataArr;
        }
    }


    //SELECT b1.id , b1.icon , b1.name FROM tbl_listings l1 join tbl_users u1 on l1.user_id = u1.user_id  join tbl_badges b1 on b1.id = u1.badge_id  where l1.id = 1
    public function getUserBadge($id = 0)
    {
        if (!empty($id)) {
            //badge_id
            $this->db->select('b1.id , b1.icon , b1.name , u1.firstname as user_name');
            $this->db->from("tbl_listings l1 ");
            $this->db->join(" tbl_users u1", 'l1.user_id = u1.user_id  ');
            $this->db->join("tbl_badges b1 ", 'b1.id = u1.badge_id');
            $this->db->where("l1.id =  " . $id);
            $query = $this->db->get();
            $dataArr  = $query->result_array();

            if (!empty($dataArr)) {
                return $dataArr;
            }
        }
    }
    public function getExpertById($user_id = 0, $limit = "", $start = "", $search = "", $condition = "")
    {

        $this->db->select('*');
        $this->db->from('tbl_expert_directory');

        if (!empty($user_id) && $user_id !== 'all') {
            $this->db->where("user_id =  " . $user_id);
        }
        $this->db->order_by("created_date", 'DESC');

        if (!empty($condition)) {
            $this->db->where($condition);
        }

        if (!empty($limit) && !empty($start) && empty($search)) {
            $offset = ($start - 1) * $limit;
            $this->db->limit($limit, $offset);
        }

        if (!empty($search)) {
            $this->db->like('profile_name', $search);
            $this->db->or_like('name', $search);
            $this->db->or_like('rate ', $search);
            $this->db->or_like('created_date', $search);
            $this->db->or_like('admin_approved ', $search);
        }


        $query = $this->db->get();
        $dataArr  = $query->result_array();
        if (!empty($dataArr)) {
            return $dataArr;
        }
    }


    public function getExpertBySlug($slug = 0)
    {

        if (!empty($slug)) {
            $this->db->select('*');
            $this->db->from('tbl_expert_directory');
            $this->db->where(['slug' => $slug]);
            $query = $this->db->get();
            $dataArr  = $query->result_array();
            if (!empty($dataArr)) {
                return $dataArr;
            }
        }
    }

    public function getAllMembershipPlain()
    {

        $this->db->select('*');
        $this->db->from('tbl_membership_level');
        $this->db->where(['validity >' => 0, 'no_validity = ' => 0, 'is_default = ' => 0, ' status = ' => 1]);
        $query = $this->db->get();
        $dataArr  = $query->result_array();
        //pre($this->db->last_query());
        if (!empty($dataArr)) {
            return $dataArr;
        }
    }

    public function getCurrentMembershipPlan($user_id = 0, $limit = "", $start = "", $search = "", $count = '')
    {
        $this->db->select('u.membership_level  , u.membership_assign_date , ml.name , ml.validity, ml.price , u.user_id , u.username');
        $this->db->from("tbl_users u ");
        $this->db->join("tbl_membership_level ml ", 'ml.id = u.membership_level');
        if (!empty($user_id)) {
            $this->db->where("u.user_id =  " . $user_id);
        }

        if (!empty($count)) {
            $query = $this->db->get();
            return $dataArr  = $query->result_array();
        }

        if (!empty($limit) && !empty($start) && empty($search)) {
            $offset = ($start - 1) * $limit;
            $this->db->limit($limit, $offset);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('u.membership_level', $search);
            $this->db->or_like('ml.name', $search);
            $this->db->or_like('ml.price', $search);
            $this->db->or_like('u.membership_assign_date', $search);
            $this->db->or_like('u.username', $search);
            $this->db->group_end();
        }


        $query = $this->db->get();
        // pre($this->db->last_query());
        $dataArr  = $query->result_array();


        if (!empty($dataArr)) {
            return $dataArr;
        }
    }




    /**
     * SELECT m1.name , p1.amount , p1.plan_id ,p1.prev_plan_id, p1.adjusted_amount, DATE(p1.timestamp) AS start_date FROM `tbl_payments` p1 join tbl_membership_level m1 on m1.id = p1.plan_id WHERE p1.USER_ID = 26 and p1.PAYMENT_TYPE = 1
     */
    public function getMembershipPlanHistory($user_id = 0)
    {
        $this->db->select('m1.name , m1.validity, p1.amount , p1.plan_id ,p1.prev_plan_id, p1.adjusted_amount, DATE(p1.timestamp) AS start_date');
        $this->db->from("tbl_payments` p1 ");
        $this->db->join("tbl_membership_level m1  ", 'm1.id = p1.plan_id');
        $this->db->where("p1.USER_ID =  " . $user_id);
        $this->db->where('p1.PAYMENT_TYPE = 1');
        $this->db->order_by('p1.id', 'DESC');
        $query = $this->db->get();
        $dataArr  = $query->result_array();
        if (!empty($dataArr)) {
            return $dataArr;
        }
    }

    // get user-wise commission 

    public function getUserCommission($user_id = 0)
    {

        if ($user_id != 0) {
            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->where('user_id', $user_id);
            $query =  $this->db->get();
            $dataArr = $query->result_array();
            if (!empty($dataArr)) {
                return $dataArr;
            }
        }
    }
    public function update_batch($table, $data, $column)
    {
        return  $this->db->update_batch($table, $data, $column);
    }


    public function getListing($user_id = 0)
    {
        if ($user_id != 0) {
            $this->db->select('*');
            $this->db->from('tbl_listings');
            $this->db->where('user_id', $user_id);
            $this->db->where('commission_user_product', 1);
            $this->db->or_where('commission_user_product', 0);
            $query =  $this->db->get();
            $dataArr = $query->result_array();
            if (!empty($dataArr)) {
                return $dataArr;
            }
        }
    }

    public function getListingSolution($user_id = 0)
    {
        if ($user_id != 0) {
            $this->db->select('*');
            $this->db->from('tbl_solutions');
            $this->db->where('user_id', $user_id);
            $this->db->where('commission_user_product', 1);
            $this->db->or_where('commission_user_product', 0);
            $query =  $this->db->get();
            $dataArr = $query->result_array();
            if (!empty($dataArr)) {
                return $dataArr;
            }
        }
    }

    // method is used to get List data using list id
    public function getListingById($id = 0)
    {
        if ($id != 0) {
            $this->db->select('*');
            $this->db->from('tbl_listings');
            $this->db->where('id', $id);
            $query =  $this->db->get();
            $dataArr = $query->result_array();
            if (!empty($dataArr)) {
                return $dataArr;
            }
        }
    }

    public function getLatestImage($id)
    {
        $this->db->select('name');
        $this->db->where('solution_id', $id);
        $this->db->from('tbl_solution_media');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1, 0);
        $query =  $this->db->get();
        $dataArr = $query->result_array();
        if (!empty($dataArr)) {
            return $dataArr;
        }
    }

    public function getPageTag()
    {
        $this->db->select('page,tags');
        $this->db->from('tbl_pages_tags');
        $this->db->limit(100);
        $this->db->order_by('id', 'desc');
        $query =  $this->db->get();
        $dataArr = $query->result_array();
        return $dataArr;
    }
    public function deletePageTagsData()
    {
        $this->db->truncate('tbl_pages_tags');
    }

    public function getTagsAsPerPages($pagesArr, $table, $listing_type = "")
    {
        if ($table == "tbl_pages_tags") {
            $this->db->select('page,tags');
            $this->db->from('tbl_pages_tags');
            $this->db->where_in("page", $pagesArr);

            $query =  $this->db->get();
            $dataArr = $query->result_array();
            return $dataArr;
        } else if ($table == 'tbl_solutions') {
            $this->db->select('slug,page_tags');
            $this->db->from('tbl_solutions');
            $this->db->where_in("slug", $pagesArr);

            $query =  $this->db->get();
            $dataArr = $query->result_array();
            return $dataArr;
        } else if ($table == 'tbl_listings') {
            $this->db->select('slug,page_tags,listing_type');
            $this->db->from('tbl_listings');
            if ($listing_type != '') {
                $this->db->where("listing_type", $listing_type);
            }
            $this->db->where_in("slug", $pagesArr);

            $query =  $this->db->get();
            $dataArr = $query->result_array();
            return $dataArr;
        } else if ($table == 'tbl_course') {
            $this->db->select('slug,page_tags');
            $this->db->from('tbl_course');
            $this->db->where_in("slug", $pagesArr);

            $query =  $this->db->get();
            $dataArr = $query->result_array();
            return $dataArr;
        } else if ($table == 'tbl_blog') {
            $this->db->select('slug,blog_tags');
            $this->db->from('tbl_blog');
            $this->db->where_in("slug", $pagesArr);

            $query =  $this->db->get();
            $dataArr = $query->result_array();
            return $dataArr;
        }
    }

    public function tbl_user_surfing_pages()
    {

        $this->db->select('tbl_users.username, tbl_user_surfing_pages.user_ip, tbl_user_surfing_pages.page, tbl_user_surfing_pages.tags, tbl_user_surfing_pages.created_at');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_user_surfing_pages.user_id');

        /* $this->db->where('tbl_offers.listing_id', $listing_id);
        $this->db->where('tbl_offers.listing_type', $type);
        $this->db->where('tbl_offers.offer_status', $status);
        $this->db->or_where('tbl_offers.offer_status', '2');

        if ($owner === 'on') {
            $this->db->where('tbl_offers.owner_id', $this->session->userdata('user_id'));
        }

        $this->db->order_by($sort, $order);*/
        $query      = $this->db->get('tbl_user_surfing_pages');
        $dataArr    = $query->result_array();
        return $dataArr;
    }
    public function getListingHeaderPlanValidate()
    {
        // for check cron job query
        //SELECT * FROM `tbl_listings` where listing_header_priority > 1 and
        // listing_header_expiry < now()

        // listing table
        $data = ['listing_header_priority' =>  1, 'listing_header_expiry' => date('Y-m-d H:i:s')];
        $conditions = [
            'listing_header_priority >' => 1,
            'listing_header_expiry < ' => date('Y-m-d H:i:s')
        ];
        $this->_update_to_table('tbl_listings', $data, $conditions);

        $data = ['sponsorship_priority' =>  0, 'sponsorship_expires' => date('Y-m-d H:i:s')];
        $conditions = [
            'sponsorship_priority > ' => 1,
            'sponsorship_expires < ' => date('Y-m-d H:i:s')
        ];
        $this->_update_to_table('tbl_listings', $data, $conditions);


        // check for solution table

        $data = ['listing_header_priority' =>  1, 'listing_header_expiry' => date('Y-m-d H:i:s')];
        $conditions = [
            'listing_header_priority >' => 1,
            'listing_header_expiry < ' => date('Y-m-d H:i:s')
        ];
        $this->_update_to_table('tbl_solutions', $data, $conditions);

        $data = ['sponsorship_priority' =>  0, 'sponsorship_expires' => date('Y-m-d H:i:s')];
        $conditions = [
            'sponsorship_priority > ' => 1,
            'sponsorship_expires < ' => date('Y-m-d H:i:s')
        ];
        $this->_update_to_table('tbl_solutions', $data, $conditions);
    }


    public function getMembershipValidate()
    {

        // for check cron job query
        //select user_id, tbl_users.membership_level, tbl_users.membership_assign_date, tbl_membership_level.validity, DATE_ADD(tbl_users.membership_assign_date, INTERVAL (tbl_membership_level.validity) DAY) validTillDate from tbl_users inner join tbl_membership_level on tbl_users.membership_level = tbl_membership_level.id where tbl_users.membership_assign_date is not null AND tbl_membership_level.no_validity = 0 AND tbl_membership_level.is_guest = 0 AND DATE_ADD(tbl_users.membership_assign_date, INTERVAL (tbl_membership_level.validity) DAY) < now()

        //  'update  tbl_users set tbl_users.membership_level = '.$defaultId .' where tbl_users.user_id in (select user_id as uid from (select user_id,membership_level,membership_assign_date from tbl_users) as t1 inner join tbl_membership_level as ml on t1.membership_level = ml.id where t1.membership_assign_date is not null and DATE_ADD(t1.membership_assign_date, INTERVAL  (ml.validity) DAY) < now())'


        // first check default plan exists
        $this->db->select('*');
        $this->db->from('tbl_membership_level');
        $this->db->where('is_default', 1);
        $query =  $this->db->get();
        $dataArr = $query->result_array();
        if (!empty($dataArr)) {
            $query = $this->db->query(
                'select user_id, tbl_users.membership_level, tbl_users.membership_assign_date, tbl_membership_level.validity, DATE_ADD(tbl_users.membership_assign_date, INTERVAL (tbl_membership_level.validity) DAY) validTillDate from tbl_users inner join tbl_membership_level on tbl_users.membership_level = tbl_membership_level.id where tbl_users.membership_assign_date is not null AND tbl_membership_level.no_validity = 0 AND tbl_membership_level.is_guest = 0 AND DATE_ADD(tbl_users.membership_assign_date, INTERVAL (tbl_membership_level.validity) DAY) < now()'
            );
            $users = $query->result_array();
            $userIds = [];
            $userIds = array_column($users, 'user_id');

            // if users exists to whom plan has expired
            if (!empty($userIds)  && count($userIds) > 0) {
                $defaultMembershipPlanId = $dataArr[0]['id'];
                $curretDate =  Date('Y:m:d 0:0:0');
                $this->db->where_in("user_id", $userIds);
                $this->db->update('tbl_users', array("membership_level" => $defaultMembershipPlanId, 'membership_assign_date' => $curretDate));

                foreach ($userIds as $userId) {
                    $this->common->refreshUserMembershipLevel($defaultMembershipPlanId, $userId);
                }
            }
        }
    }


    public function get_user_surfing_pages()
    {
        $this->db->select('u1.username, tbl_user_surfing_pages.user_ip, tbl_user_surfing_pages.page, tbl_user_surfing_pages.tags, tbl_user_surfing_pages.created_at');
        $this->db->join('tbl_users u1', 'u1.user_id = tbl_user_surfing_pages.user_id', 'left');
        $this->db->order_by('id', 'desc');
        $this->db->from('tbl_user_surfing_pages');
        $this->db->limit(100);
        $query      = $this->db->get();
        $dataArr = $query->result_array();
        return $dataArr;
    }
}
