<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);

class payments extends CI_Controller
{

	private static $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('DatabaseOperationsHandler', 'database');
		$this->load->model('CommonOperationsHandler', 'common');
		$this->load->model('EmailOperationsHandler', 'email_op');
		$this->load->library('paymentgateway');

		self::$data['categoriesData']				=	$this->database->_count_listings_categories_wise();
		self::$data['languages']					=	$this->database->load_all_languages();
		self::$data['default_currency']				=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies', array('default_status' => '1'), 'currency'), 'symbol');
		self::$data['userdata'] 					= 	$this->database->getUserData($this->session->userdata('user_id'));
		self::$data['selectedLanguage'] 			= 	$this->common->is_language();
		self::$data['listingCount']					= 	$this->database->_count_listings_user_wise();
		self::$data['imagesData']					=	$this->database->_get_row_data('tbl_siteimages', array('id' => 1));
		self::$data['announcements']                =   $this->database->_get_row_data('tbl_announcement', array('status' => 1));
		self::$data['payments']                     =   $this->database->_get_row_data('tbl_payment_settings', array('status' => 1));
		self::$data['settings']                     =   $this->database->_get_row_data('tbl_settings', array('id' => 1));
		self::$data['token'] 						= 	$this->security->get_csrf_hash();

		if (self::$data['settings'][0]['ssl_enable'] === '1') {
			force_ssl();
		}
	}
	public function validatePayment()
	{

		$total  		= 	$this->session->userdata('checkout_actual_total_');
		$coupon_code  	=  	$this->session->userdata('checkout_coupon_');
		$return_url   	= 	$this->session->userdata('checkout_url_');
		$feeAmt       	=   $this->session->userdata('checkout_fee_');
		$discount		=   0;

		if (!empty($coupon_code)) {

			$today          = date('Y-m-d');
			$query 			=  $this->db->query('SELECT * FROM tbl_coupons WHERE discount_code = ' . $this->db->escape($coupon_code) . ' AND valid_from <= ' . $this->db->escape($today) . ' AND valid_till >= ' . $this->db->escape($today));
			$discount_couponArr = $query->result_array();

			// if  having discount.
			if (!empty($discount_couponArr) && count($discount_couponArr) > 0) {
				$discountType 	= 	$discount_couponArr[0]['discount_type'];
				$discount		=	number_format($discount_couponArr[0]['amount'], 2, '.', '');

				$total 			=   number_format($total, 2, '.', '');
				$feeAmt 		=   number_format($feeAmt, 2, '.', '');
				if ($discountType == 0) {
					$discount = $total * ($discount / 100);
					$gtotal = ($total - $discount) + $feeAmt;
					if ($gtotal < 1) {
						$gtotal = 0;
					}
					return [
						'total' 		=> 	$gtotal,
						'discount' 		=>	$discount,
						'returnUrl' 		=>  $return_url
					];
				} else if ($discountType == 1) {
					$gtotal = ($total - $discount) + $feeAmt;
					if ($gtotal < 1) {
						$gtotal = 0;
					}
					return [
						'total' 		=> 	$gtotal,
						'discount' 		=>	$discount,
						'returnUrl' 		=>  $return_url
					];
				}
			} else {
				// error wrong discount code comes
				$this->session->set_flashdata('error_message', "Coupon code is not found");
				redirect($return_url);
			}
			// if not coupon code
		} else {
			$gtotal = $total + $feeAmt;
		}

		return [
			'total' 		=> 	$gtotal,
			'discount' 		=>	$discount,
			'returnUrl' 	=>  $return_url
		];
	}

	/*Contract Payment Function*/
	public function pay_contract()
	{

		// echo "tet"; exit;
		if (!empty($this->session->userdata('user_id'))) {
			if ($this->input->post('txt_paytotal') > 0) {
				switch ($this->input->post('paymentType')) {
					case 'PayPal_Express':
						$this->PayPal_Express_contract();
						break;
					case 'PayPal_Pro':
						$this->PayPal_Pro();
						break;
					case 'Stripe':
					//echo "sss"; exit;
						$this->stripe();
						break;
					default:
						return;
				}
			} else {
				$data['errors'] = 'Your Total amount should be greater than 0';
				$data = html_escape($this->security->xss_clean($data));
				$this->load->view('main/checkout', $data);
				return;
			}
		} else {
			$data['errors'] = 'Your login session has expired. Please login to continue';
			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('main/checkout', $data);
			return;
		}
	}

	public function PayPal_Express_contract()
	{
		$default_currency 	=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies', array('default_status' => '1'), 'currency'), 'code');
		$currency 			= 'USD';

		if (!empty($default_currency)) {
			$currency = $default_currency;
		}

		if (!empty($this->session->userdata('user_id'))) {
			$itemsArr 			= array();
			$user_data 			= $this->database->getUserData($this->session->userdata('user_id'));
			$payment_id  		= $this->_generate_paymentID();
		}

		if (!empty($this->input->post('txt_type'))) {
			switch ($this->input->post('txt_type')) {
				case 'buynow':
					$sale = 'direct';
					break;
				case 'contract':
					$sale = 'contract';
					break;
				default:
					return;
			}
		}

		if (!empty($user_data)) {

			$itemsArr[0] = array(
				'id' => $this->input->post('txt_id'),
				'name' => $this->input->post('txt_description'),
				'quantity' => 1,
				'price' => $this->input->post('txt_paytotal'),
				'sale' => $sale
			);

			$valTransc = array(
				'user_id' => $user_data[0]['user_id'],
				'user_email' => $user_data[0]['email'],
				'user_username' => $user_data[0]['username'],
				'listing_id' => $this->input->post('txt_id'),
				'amount' => number_format($this->input->post('txt_paytotal'), 2, '.', ''),
				'transactionId' => $payment_id,
				'description' => 'INVOICE :' . $payment_id,
				'currency' => $currency,
				'payment_method' => 'PAYPAL',
				'clientIp' => $this->input->ip_address(),
				'returnUrl' => base_url() . PAYMENT_PAYPAL_RETURN,
				'cancelUrl' => base_url() . PAYMENT_CANCEL,
				'domain_list' => json_encode($itemsArr)
			);

			try {
				$purchaseProc = new paymentgateway('PayPal_Express', true);
				$this->session->set_userdata('paypal_data', $valTransc);

				// $data 	= $purchaseProc->sendPurchaseExpress($cardInput,$valTransc,$itemsArr);
				$data 	= $purchaseProc->sendPurchaseExpress($valTransc, $itemsArr);

				$url 	= $data;
				header("Location: $url");
			} catch (Exception $e) {
				$url 	= base_url() . PAYMENT_FAIL;
				$this->fail($valTransc);
			}
		} else {
			$data['errors'] = 'Invalid User';
			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('main/checkout', $data);
			return;
		}
	}

	/*Insert Purchases*/
	public function InsertDomainPurchaseData($user_id, $Arr)
	{
		$datas = self::$data;
		if (!empty($Arr['domain_list'])) {
			foreach (json_decode($Arr['domain_list'], true) as $domain) {

				$domain_id  =   $this->database->_get_single_data('tbl_listings', array('id' => $domain['id']), 'domain_id');
				if ($domain['sale'] === 'direct') {

					$data = array(
						'user_id' => $user_id,
						'domain_id' => $domain_id,
						'listing_id' => $domain['id'],
						'amount' => $domain['price'],
						'invoice_id' => $Arr['transactionId'],
					);

					$contract_id = $this->common->open_direct_contract($data['listing_id']);

					$Arr['contract_id'] = $contract_id;

					$contractArr = array(
						'user_id' => $user_id,
						'domain_id' => $domain_id,
						'contract_id' => $contract_id,
						'listing_id' => $domain['id'],
						'amount' => $domain['price'],
						'invoice_id' => $Arr['transactionId'],
					);

					// code for updating solution table
					if ($this->session->has_userdata('lisiting_type')) {
						if ($this->session->userdata('lisiting_type') == 'solution') {
							if ($this->database->_update_to_DB('tbl_solutions', array('sold_status' => 1), $data['listing_id'])) {
								if (!empty($contract_id)) {
									$this->database->_insert_to_table('tbl_domain_purchases', $data);
									if ($this->database->_insert_to_table('tbl_contracts', $contractArr)) {
										$this->common->change_contract_status($contract_id, 1);
										$this->common->change_delivery_date($contract_id, 1);
										$this->common->create_invoice($contractArr);
										/*email notification*/
										if ($datas['settings'][0]['email_notifications'] === '1') {
											$this->email_op->_send_invoice_email('payment', $Arr, 'direct');
										}
										/**/
									}
								}
							}
						}
					} else {
						if ($this->database->_update_to_DB('tbl_listings', array('sold_status' => 1), $data['listing_id'])) {
							if (!empty($contract_id)) {
								$this->database->_insert_to_table('tbl_domain_purchases', $data);
								if ($this->database->_insert_to_table('tbl_contracts', $contractArr)) {
									$this->common->change_contract_status($contract_id, 1);
									$this->common->change_delivery_date($contract_id, 1);

									$contractArr['discount'] 		=	$Arr['discount'];
									$contractArr['amount'] 			=	$Arr['original_amount'];

									$this->common->create_invoice($contractArr);
									/*email notification*/
									if ($datas['settings'][0]['email_notifications'] === '1') {
										$this->email_op->_send_invoice_email('payment', $Arr, 'direct');
									}
									/**/
								}
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

					$Arr['contract_id'] = $data['contract_id'];

					// code for updating solution table
					if ($this->session->has_userdata('lisiting_type')) {
						if ($this->session->userdata('lisiting_type') == 'solution') {
							if ($this->database->_update_to_DB('tbl_solutions', array('sold_status' => 1), $data['listing_id'])) {
								if ($this->database->_insert_to_table('tbl_contracts', $data)) {
									$this->common->change_contract_status($domain['sale'], 1);
									$this->common->change_delivery_date($domain['sale'], 1);
									$this->common->create_invoice($data);
									/*email notification*/
									if ($datas['settings'][0]['email_notifications'] === '1') {
										$this->email_op->_send_invoice_email('payment', $Arr, 'contract');
									}
									/**/
								}
							}
						}
					} else {
						if ($this->database->_update_to_DB('tbl_listings', array('sold_status' => 1), $data['listing_id'])) {
							if ($this->database->_insert_to_table('tbl_contracts', $data)) {
								$this->common->change_contract_status($domain['sale'], 1);
								$this->common->change_delivery_date($domain['sale'], 1);

								$data['discount'] 			=	$Arr['discount'] ?? '';
								$data['amount'] 			=	$Arr['original_amount'] ?? '';

								$this->common->create_invoice($data);
								/*email notification*/
								if ($datas['settings'][0]['email_notifications'] === '1') {
									$this->email_op->_send_invoice_email('payment', $Arr, 'contract');
								}
								/**/
							}
						}
					}
				}
			}
		}
	}


	/*PayPal Pro */
	public function PayPal_Pro()
	{
		$default_currency 	=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies', array('default_status' => '1'), 'currency'), 'code');
		$currency 			= 'USD';

		if (!empty($default_currency)) {
			$currency = $default_currency;
		}

		if (!empty($this->session->userdata('user_id'))) {
			$itemsArr 			= array();
			$user_data 			= $this->database->getUserData($this->session->userdata('user_id'));
			$payment_id  		= $this->_generate_paymentID();
		}

		if (!empty($this->input->post('txt_type'))) {
			switch ($this->input->post('txt_type')) {
				case 'buynow':
					$sale =	'direct';
					break;
				case 'contract':
					$sale =	$this->input->post('txt_contract');
					break;
				default:
					return;
			}
		}

		if (!empty($user_data)) {

			$itemsArr[0] = array(
				'id' => $this->input->post('txt_id'),
				'name' => $this->input->post('txt_description'),
				'quantity' => 1,
				'price' => $this->input->post('txt_paytotal'),
				'sale' => $sale
			);

			$cardInput = array(
				'firstName' => $this->input->post('name'),
				'lastName' => '',
				'number' => $this->input->post('number'),
				'cvv' => $this->input->post('security-code'),
				'expiryMonth' => $this->input->post('txt_month'),
				'expiryYear' => $this->input->post('txt_year'),
				'email' => $this->input->post('txt_useremail')
			);

			$valTransc = array(
				'user_id' => $this->session->userdata('user_id'),
				'user_email' => $user_data[0]['email'],
				'user_username' => $user_data[0]['username'],
				'listing_id' => $this->input->post('txt_id'),
				'amount' => number_format($this->input->post('txt_paytotal'), 2, '.', ''),
				'transactionId' => $payment_id,
				'description' => 'INVOICE :' . $payment_id,
				'currency' => $currency,
				'payment_method' => 'PAYPAL',
				'clientIp' => $this->input->ip_address(),
				'returnUrl' => base_url() . PAYMENT_PAYPAL_RETURN,
				'cancelUrl' => base_url() . PAYMENT_CANCEL,
				'domain_list' => json_encode($itemsArr)
			);

			try {

				try {
					$purchaseProc = new paymentgateway('PayPal_Pro', true);
					$this->session->set_userdata('paypal_data', $valTransc);
					$data 	= $purchaseProc->sendPurchase($cardInput, $valTransc, $itemsArr);
					if (isset($data['ACK']) && $data['ACK'] == 'Success') {
						$this->session->set_userdata('paypal_data', $valTransc);
						$this->direct_payments($data, $valTransc, 'outside', 'PayPal Pro');
						$url 	= base_url() . PAYMENT_SUCCESS;
						$this->success($valTransc, $data);
					} else {
						$url 	= base_url() . PAYMENT_FAIL;
						$this->fail($valTransc, $data);
					}
				} catch (Exception $e) {
					$url 	= base_url() . PAYMENT_FAIL;
					$this->fail($valTransc);
				}
			} catch (Exception $e) {
				if (!empty($this->session->userdata('user_id'))) {
					$data = self::$data;
					$data['errors'] = 	$e->getMessage();
					$this->session->set_userdata('errors', $data['errors']);
					redirect('checkout/' . $this->input->post('txt_type') . '/' . $this->input->post('txt_id'));
					return;
				}
				redirect('login');
			}
		}
	}

	/*direct_payments*/
	public function direct_payments($data, $paypal_data, $type = 'outside', $method)
	{
		if (!empty($paypal_data)) {
			$data = array(
				'PAYMENT_ID' => $paypal_data['transactionId'],
				'AMOUNT' => $paypal_data['amount'],
				'METHOD' => $method,
				'ACK' => $data['ACK'],
				'USER_ID' => $paypal_data['user_id'],
				'PLAN_ID' => $paypal_data['listing_id'],
				'PAYMENT_TYPE' => !empty($this->session->userdata('lisiting_type_membership')) && $this->session->userdata('lisiting_type_membership') ? 1 : 0,
				'TOKEN' => '',
				'PAYMENTINFO_0_TRANSACTIONID' => $data['TRANSACTIONID'],
				'CORRELATIONID' => $data['CORRELATIONID'],
				'PAYER_ID' => $data['CORRELATIONID'],
				'PAYMENTINFO_0_TRANSACTIONTYPE' => '',
				'PAYMENTINFO_0_FEEAMT' => '',
				'PAYMENTINFO_0_PAYMENTTYPE' => '',
				'PAYMENTINFO_0_TAXAMT' => '',
				'PREV_PLAN_ID' =>  !empty($this->session->userdata('old_membership_id')) ? $this->session->userdata('old_membership_id') : 0,
				'ADJUSTED_AMOUNT' => !empty($this->session->userdata('old_memberhip_balance_amount'))  ? $this->session->userdata('old_memberhip_balance_amount') : 0,
			);
			$this->database->_insert_to_DB('tbl_payments', $data);

			$this->session->unset_userdata('lisiting_type_membership');
			$this->session->unset_userdata('old_membership_id');
			$this->session->unset_userdata('old_memberhip_balance_amount');

			if (empty($data['PAYMENT_TYPE'])) {
				if ($type === 'outside') {
					$this->InsertDomainPurchaseData($paypal_data['user_id'], $paypal_data);
				} else {
					if (!empty($this->session->userdata('listing_data'))) {
						$listing_data = $this->session->userdata('listing_data');
					}

					foreach ($listing_data as $key) {
						$this->InsertPurchaseData($key['user_id'], array('user_membership_id' => $key['listing_id'], 'user_membership_timestamp' => date('Y-m-d H:i:s'), 'listing_type' => $key['listing_type'], 'period' =>  $key['period'], 'user_membership_timestamp_expiry' => date("Y-m-d H", strtotime(date("Y-m-d", strtotime(date('Y-m-d H:i:s'))) . "+ " . $key['period'] . "day")), 'plan_header' => $key['plan_header'], 'listing_type_name' => $key['listing_type_name']));
					}
				}
			}
			return;
		}
	}


	/*Stripe */
	public function stripe()
	{
		$default_currency 	=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies', array('default_status' => '1'), 'currency'), 'code');
		$currency 			= 'USD';

		if (!empty($default_currency)) {
			$currency = $default_currency;
		}

		if (!empty($this->session->userdata('user_id'))) {
			$itemsArr 			= array();
			$user_data 			= $this->database->getUserData($this->session->userdata('user_id'));
			$payment_id  		= $this->_generate_paymentID();
		}

		if (!empty($this->input->post('txt_type'))) {
			switch ($this->input->post('txt_type')) {
				case 'buynow':
					$sale =	'direct';
					break;
				case 'contract':
					$sale =	$this->input->post('txt_contract');
					break;
				default:
					return;
			}
		}

		if (!empty($user_data)) {

			$payAmt 	=  $this->input->post('txt_paytotal');
			$arr 		= 	$this->validatePayment();

			if (!empty($payAmt) && count($arr) > 0) {
				if (intval($payAmt) != intval($arr['total'])) {
					// $this->session->set_flashdata('error_message', [$arr, $payAmt]);
					$this->session->set_flashdata('error_message', "Something Went Wrong... Please Try again...");
					$this->session->unset_userdata('checkout_actual_total_');
					$this->session->unset_userdata('checkout_coupon_');
					$this->session->unset_userdata('checkout_url_');
					$this->session->unset_userdata('checkout_fee_');
					redirect($arr['returnUrl']);
				} else {
					$this->session->unset_userdata('checkout_actual_total_');
					$this->session->unset_userdata('checkout_coupon_');
					$this->session->unset_userdata('checkout_url_');
					$this->session->unset_userdata('checkout_fee_');


					$itemsArr[0] = array(
						'id' => $this->input->post('txt_id'),
						'name' => $this->input->post('txt_description'),
						'quantity' => 1,
						'price' => $this->input->post('txt_paytotal'),
						'sale' => $sale
					);

					$cardInput = array(
						'firstName' => $this->input->post('name'),
						'lastName' => '',
						'number' => $this->input->post('number'),
						'cvv' => $this->input->post('security-code'),
						'expiryMonth' => $this->input->post('txt_month'),
						'expiryYear' => $this->input->post('txt_year'),
						'email' => $this->input->post('txt_useremail'),
						'token' => $this->input->post('token')
					);

					$valTransc = array(
						'user_id' => $this->session->userdata('user_id'),
						'user_email' => $user_data[0]['email'],
						'user_username' => $user_data[0]['username'],
						'listing_id' => $this->input->post('txt_id'),
						'amount' => number_format($this->input->post('txt_paytotal'), 2, '.', ''),
						'original_amount' => number_format($this->input->post('txt_paytotal_original'), 2, '.', ''),
						'discount' 		=> $arr['discount'] ?? 0,
						'transactionId' => $payment_id,
						'description' => 'INVOICE :' . $payment_id,
						'currency' => $currency,
						'payment_method' => 'STRIPE',
						'clientIp' => $this->input->ip_address(),
						'returnUrl' => base_url() . PAYMENT_PAYPAL_RETURN,
						'cancelUrl' => base_url() . PAYMENT_CANCEL,
						'domain_list' => json_encode($itemsArr)
					);


					try {

						try {
							$purchaseProc = new paymentgateway('Stripe', true);
							$this->session->set_userdata('paypal_data', $valTransc);
							$tempdata 	= $purchaseProc->completePurchaseStripe($cardInput, $valTransc, $itemsArr);

							if (isset($tempdata['status']) && $tempdata['status'] == 'succeeded') {

								$data = array(
									'TRANSACTIONID' => $tempdata['id'],
									'ACK' => $tempdata['status'],
									'CORRELATIONID' => $tempdata['source']['fingerprint'],
									'PAYER_ID' => $tempdata['source']['last4']
								);

								$this->session->set_userdata('paypal_data', $valTransc);

								$this->direct_payments($data, $valTransc, 'outside', 'Stripe');
								$url 	= base_url() . PAYMENT_SUCCESS;
								$this->success($valTransc, $data);
								$plain_id 				= 	$itemsArr[0]['id'];
								if (isset($plain_id) && !empty($plain_id) && !empty($this->session->userdata('membership_buy_module'))) {
									$date_issued 	=  date('Y-m-d');
									$userId 		=  $this->session->userdata('user_id');
									$this->database->_update_to_table('tbl_users', array('membership_level' => $plain_id, 'membership_assign_date' => $date_issued), ['user_id = ' => $userId]);
									$this->common->refreshUserMembershipLevel($plain_id, $userId);

									$this->session->unset_userdata('membership_buy_module');
								} else {

									$productDetails = $this->database->getListingById($valTransc['listing_id']);
									if (isset($productDetails[0]['website_BusinessName'])) {
										$this->session->set_userdata('buy_message', 'Your payment has been processed successfully -  ' . $productDetails[0]['website_BusinessName']);
									}
								}
							} else {
								$url 	= base_url() . PAYMENT_FAIL;
								$this->fail($valTransc, $tempdata);
							}
						} catch (Exception $e) {
							$url 	= base_url() . PAYMENT_FAIL;
							$this->fail($valTransc);
						}
					} catch (Exception $e) {
						if (!empty($this->session->userdata('user_id'))) {
							$data = self::$data;
							$data['errors'] = 	$e->getMessage();
							$this->session->set_userdata('errors', $data['errors']);
							redirect('checkout/' . $this->input->post('txt_type') . '/' . $this->input->post('txt_id'));
							return;
						}
						$this->session->set_flashdata('error_message', $e);
						redirect('login');
					}
				}
			}
		}
	}


	/*All Formats Return Page*/
	public function return($type = 'outside')
	{

		if (!empty($this->session->userdata('paypal_data'))) {
			$paypal_data = $this->session->userdata('paypal_data');

			if (!empty($this->session->userdata('listing_data'))) {
				$listing_data = $this->session->userdata('listing_data');
			}

			if (isset($_GET['token']) && isset($_GET['PayerID'])) {
				$data = array(
					'token' 	=> $_GET['token'],
					'PayerID' 	=> $_GET['PayerID'],
					'currency' 	=> $paypal_data['currency'],
					'amount' 	=> $paypal_data['amount']
				);

				$purchaseProc = new paymentgateway('PayPal_Express', true);
				$returnedData = $purchaseProc->completePurchasePaypal($data);
			} else {
				if ($type !== 'free') {

					$data = array(
						'token' 	=> $_GET['token'],
						'PayerID' 	=> '',
						'currency' 	=> $paypal_data['currency'],
						'amount' 	=> $paypal_data['amount']
					);

					$returnedData['ACK'] = 'FAILED';
				} else {
					foreach ($listing_data as $key) {
						$this->InsertPurchaseData($key['user_id'], array('user_membership_id' => $key['listing_id'], 'user_membership_timestamp' => date('Y-m-d H:i:s'), 'listing_type' => $key['listing_type'], 'user_membership_timestamp_expiry' => date("Y-m-d", strtotime(date("Y-m-d", strtotime(date('Y-m-d H:i:s'))) . "+ " . $key['period'] . "day")), 'plan_header' => $key['plan_header']));
					}

					$url 	= base_url() . PAYMENT_SUCCESS;
					$this->success($paypal_data, '');
					return;
				}
			}

			if ($returnedData['ACK'] === 'Success') {

				// Check this request is coming for solution
				if ($this->session->has_userdata('lisiting_type')) {

					$lisiting_type = $this->session->userdata('lisiting_type');

					if ($lisiting_type == 'solution') {

						$this->AddPaymentData($returnedData, $paypal_data);
						if ($type === 'outside') {
							$this->InsertDomainPurchaseData($paypal_data['user_id'], $paypal_data);
						}
						$this->session->unset_userdata('lisiting_type');
						// This below code is commented because this case is not generated
						// else
						// {
						// 	echo "success else".'<br/>';
						// 	pre($listing_data); die;
						// 	foreach ($listing_data as $key) {
						// 		$this->InsertPurchaseData($key['user_id'],array('user_membership_id'=>$key['listing_id'],'user_membership_timestamp'=>date('Y-m-d H:i:s'),'listing_type'=>$key['listing_type'],'user_membership_timestamp_expiry'=> date("Y-m-d" , strtotime(date("Y-m-d",strtotime(date('Y-m-d H:i:s')))."+ ".$key['period']."day")),'plan_header'=>$key['plan_header']));
						// 	}
						// }
						// $url 	= base_url().PAYMENT_SUCCESS;
					}
				} else {
					$this->AddPaymentData($returnedData, $paypal_data);
					if ($type === 'outside') {
						$this->InsertDomainPurchaseData($paypal_data['user_id'], $paypal_data);
					} else {
						// echo "success else".'<br/>';
						foreach ($listing_data as $key) {
							$this->InsertPurchaseData($key['user_id'], array('user_membership_id' => $key['listing_id'], 'user_membership_timestamp' => date('Y-m-d H:i:s'), 'listing_type' => $key['listing_type'], 'user_membership_timestamp_expiry' => date("Y-m-d", strtotime(date("Y-m-d", strtotime(date('Y-m-d H:i:s'))) . "+ " . $key['period'] . "day")), 'plan_header' => $key['plan_header']));
						}
					}
					// $url 	= base_url().PAYMENT_SUCCESS;
				}

				// Old Code
				// $this->AddPaymentData($returnedData,$paypal_data);
				// if($type === 'outside'){
				// 	$this->InsertDomainPurchaseData($paypal_data['user_id'],$paypal_data);
				// }
				// else
				// {
				// 	echo "success else".'<br/>';
				// 	foreach ($listing_data as $key) {
				// 		$this->InsertPurchaseData($key['user_id'],array('user_membership_id'=>$key['listing_id'],'user_membership_timestamp'=>date('Y-m-d H:i:s'),'listing_type'=>$key['listing_type'],'user_membership_timestamp_expiry'=> date("Y-m-d" , strtotime(date("Y-m-d",strtotime(date('Y-m-d H:i:s')))."+ ".$key['period']."day")),'plan_header'=>$key['plan_header']));
				// 	}
				// }
				$url 	= base_url() . PAYMENT_SUCCESS;
				$this->success($paypal_data, $returnedData);
			} else if ($returnedData['ACK'] === 'SuccessWithWarning') {
				$this->AddPaymentData($returnedData, $paypal_data);
				if ($type === 'outside') {
					$this->InsertDomainPurchaseData($paypal_data['user_id'], $paypal_data);
				} else {
					foreach ($listing_data as $key) {
						$this->InsertPurchaseData($key['user_id'], array('user_membership_id' => $key['listing_id'], 'user_membership_timestamp' => date('Y-m-d H:i:s'), 'listing_type' => $key['listing_type'], 'user_membership_timestamp_expiry' => date("Y-m-d", strtotime(date("Y-m-d", strtotime(date('Y-m-d H:i:s'))) . "+ " . $key['period'] . "day")), 'plan_header' => $key['plan_header']));
					}
				}
				$url 	= base_url() . PAYMENT_SUCCESS;
				$this->success($paypal_data, $returnedData);
			} else {
				$url 	= base_url() . PAYMENT_FAIL;
				$this->fail($paypal_data, $returnedData);
			}
		}
	}

	/*Open Direct Contract*/
	public function open_direct_contract($listing_id)
	{
		if (!empty($listing_id)) {
			$this->database->_update_to_table('tbl_opens', array('status' => 7), array('listing_id' => $listing_id, 'status' => 0));
			$listing    =  $this->database->_get_row_data('tbl_listings', array('id' => $listing_id));
			$data = array(
				'contract_id' => $this->database->_unique_id('tbl_opens', 'alnum', 'contract_id'),
				'listing_id' => $listing_id,
				'bid_id' => 'direct',
				'type' => 'direct',
				'customer_id' => $this->session->userdata('user_id'),
				'owner_id' => $listing[0]['user_id'],
				'delivery_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + " . $listing[0]['deliver_in'] . " day")),
				'delivery' => $listing[0]['deliver_in'],
				'status' => 1,
				'date' => date('Y-m-d H:i:s')
			);
			return $this->database->_insert_to_DB('tbl_opens', $data);
		}
		return;
	}

	/*Insert Listing Purchase Data*/
	public function InsertPurchaseData($user_id, $Arr)
	{
		$datas = self::$data;


		$data = array(
			'invoice_id' => $this->_generate_paymentID('tbl_purchases', 'invoice_id'),
			'user_id' => $user_id,
			'plan_id' => $Arr['user_membership_id'],
			'plan_header' => $Arr['plan_header'],
			'listing_type' => $Arr['listing_type'],
			'purchase_date' => $Arr['user_membership_timestamp'],
			'expire_date' => $Arr['user_membership_timestamp_expiry']
		);

		/*email notification*/
		if ($datas['settings'][0]['email_notifications'] === '1') {
			$this->email_op->_send_invoice_email('listing', $data, 'admin');
		}
		/**/

		// Old Code
		// if($this->database->_update_to_DB('tbl_listings',array('status'=>1),$Arr['user_membership_id'])){
		//     return $this->database->_insert_to_DB('tbl_purchases',$data);
		// }

		$listArr = [];
		if (!empty($Arr['plan_header']) && trim($Arr['listing_type']) == 'sponsored') {
			// if matches then sponsorship value taken from constant file.
			$listing_sponsorship_priority =  array_search($Arr['plan_header'], LISTING_HEADER_SPONSORSHIP);
			if (!empty($listing_sponsorship_priority)) {
				$duration = 1;
				if(isset($Arr['period'])) {
					$duration = $Arr['period'];	
				}
				
				$listArr['sponsorship_priority'] = $listing_sponsorship_priority;
				$listArr['sponsorship_expires'] = 	 Date('Y-m-d H:i:s ', strtotime('+' . $duration . ' days'));
				$listArr['status']  = 9;

				if (isset($Arr['listing_type_name']) && $Arr['listing_type_name'] == 'solution' && isset($Arr['user_membership_id']) && isset($list[0]) && isset($list[0]['solution_id'])) {
					$list = $this->database->_get_row_single_data('tbl_listings', ['id' => $Arr['user_membership_id']]);
					$solution_id = $list[0]['solution_id'];
					$this->database->_update_to_DB(' tbl_solutions', $listArr, $solution_id);
				}

				if(isset($Arr['user_membership_id'])) {
					$this->database->_update_to_DB('tbl_listings', $listArr, $Arr['user_membership_id']);
				}
				
			} else {
				$listArr['status']  = 9;
			}
		} else {
			$listArr['status']  = 9;
		}

		// if ($this->database->_update_to_DB('tbl_listings', $listArr, $Arr['user_membership_id'])) {
		// 	return $this->database->_insert_to_DB('tbl_purchases', $data);
		// }

		// New Code


		if ($this->session->has_userdata('lisiting_type')) {
			if ($Arr['listing_type'] == 'solution') {
				return $this->database->_insert_to_DB('tbl_purchases', $data);
			} else {
				// if($this->database->_update_to_DB('tbl_listings',array('status'=>1),$Arr['user_membership_id'])){
				//     return $this->database->_insert_to_DB('tbl_purchases',$data);
				// }
				// update status = 9 pending for approval...
				if ($this->database->_update_to_DB('tbl_listings', array('status' => 9), $Arr['user_membership_id'])) {
					return $this->database->_insert_to_DB('tbl_purchases', $data);
				}
			}
		}
	}


	/*Listing Payment*/
	public function proceedtoPayment()
	{
		if (!empty($this->session->userdata('user_id'))) {
			switch ($this->input->post('branch_1_pay_1')) {
				case 'payvia_card':
					$this->PayPal_Pro_int();
					break;
				case 'payvia_paypal':
					$this->PayPal_Express_int();
					break;
				case 'payvia_stripe':
					$this->Stripe_int();
					break;
				case 'free_checkout':
					$this->free_checkout();
					break;
				default:
					return;
			}
		} else {
			$data['errors'] = 'Your login session has expired. Please login to continue';
			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('main/checkout', $data);
			return;
		}
	}


	/*Free Checkout*/
	public function free_checkout()
	{
		$ListingDataArr 	=   array();
		$default_currency 	=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies', array('default_status' => '1'), 'currency'), 'code');
		$currency 			=   'USD';

		if (!empty($default_currency)) {
			$currency = $default_currency;
		}

		if (!empty($this->session->userdata('user_id'))) {
			$ListingDataHeader 	= $this->database->_get_row_data('tbl_listing_header', array('listing_id' => $this->input->post('txt_payid')));
			$ListingData 		= $this->database->_get_row_data('tbl_listings', array('id' => $this->input->post('txt_listingid')));
			$userdata 			= $this->database->getUserData($this->session->userdata('user_id'));
			$payment_id  		= $this->_generate_paymentID();
			$totalAmount		= 0;

			$listing_type      	= $ListingDataHeader[0]['listing_type'];
			$totalAmount		= $ListingDataHeader[0]['listing_price'];
			$listing_type_name  = "aa";
			if (!empty($this->input->post('txt_sponsored_id'))) {
				$sponsoredArr 			= $this->database->_get_row_data('tbl_listing_header', array('listing_id' => $this->input->post('txt_sponsored_id')));
				if (isset($sponsoredArr[0]['listing_price'])) {
					$sponsored 			= $sponsoredArr[0]['listing_price'];
					$totalAmount 		= floatval($sponsored) + floatval($ListingDataHeader[0]['listing_price']);
					$listing_type      	= $ListingDataHeader[0]['listing_type'] . ' & ' . $sponsoredArr[0]['listing_type'];
					$listing_type_name  = $ListingDataHeader[0]['listing_type'];
				}

				$ListingDataArr[0] = array(
					'user_id' => $userdata[0]['user_id'],
					'user_email' => $userdata[0]['email'],
					'user_username' => $userdata[0]['username'],
					'listing_id' => $ListingData[0]['id'],
					'plan_header' => $sponsoredArr[0]['listing_id'],
					'listing_type' => $sponsoredArr[0]['listing_type'],
					'amount' => number_format($totalAmount, 2, '.', ''),
					'period' => $sponsoredArr[0]['listing_duration'],
					'transactionId' => $payment_id,
					'description' => 'Listing :' . $listing_type,
					'currency' => $currency,
					'payment_method' => 'FREE',
					'clientIp' => $this->input->ip_address(),
					'returnUrl' => base_url() . PAYMENT_PAYPAL_RETURN . '/free',
					'cancelUrl' => base_url() . PAYMENT_CANCEL,
					'listing_type_name' => $listing_type_name
				);
			}

			$valTransc[0] = array(
				'user_id' => $userdata[0]['user_id'],
				'user_email' => $userdata[0]['email'],
				'user_username' => $userdata[0]['username'],
				'listing_id' => $ListingData[0]['id'],
				'plan_header' => $ListingDataHeader[0]['listing_id'],
				'listing_type' => $ListingDataHeader[0]['listing_type'],
				'amount' => number_format($totalAmount, 2, '.', ''),
				'period' => $ListingDataHeader[0]['listing_duration'],
				'transactionId' => $payment_id,
				'description' => 'Listing :' . $listing_type,
				'currency' => $currency,
				'payment_method' => 'FREE',
				'clientIp' => $this->input->ip_address(),
				'returnUrl' => base_url() . PAYMENT_PAYPAL_RETURN . '/free',
				'cancelUrl' => base_url() . PAYMENT_CANCEL,
				'listing_type_name'  =>  $listing_type_name,

			);

			$cardInput = array(
				'firstName' => '',
				'lastName' => '',
				'number' => '',
				'cvv' => '',
				'expiryMonth' => '',
				'expiryYear' => '',
				'email' => ''
			);

			try {
				$this->session->set_userdata('paypal_data', $valTransc[0]);
				$this->session->set_userdata('listing_data', array_merge($ListingDataArr, $valTransc));

				// add plan header to listing of product
				$this->addPlanHeaderIntoListing($ListingDataHeader, $ListingData);

				header("Location: " . base_url() . PAYMENT_PAYPAL_RETURN . '/free');
			} catch (Exception $e) {
				$url 	= base_url() . PAYMENT_FAIL;
				$this->fail($valTransc);
			}
		}
	}

	/*Paypal Express Listings*/
	public function PayPal_Express_int()
	{
		$ListingDataArr = array();
		$default_currency 	=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies', array('default_status' => '1'), 'currency'), 'code');
		$currency 			= 'USD';

		if (!empty($default_currency)) {
			$currency = $default_currency;
		}

		if (!empty($this->session->userdata('user_id'))) {
			$ListingDataHeader 	= $this->database->_get_row_data('tbl_listing_header', array('listing_id' => $this->input->post('txt_payid')));
			$ListingData 		= $this->database->_get_row_data('tbl_listings', array('id' => $this->input->post('txt_listingid')));
			$userdata 			= $this->database->getUserData($this->session->userdata('user_id'));
			$payment_id  		= $this->_generate_paymentID();
			$totalAmount		= 0;

			$listing_type      	= $ListingDataHeader[0]['listing_type'];
			$totalAmount		= $ListingDataHeader[0]['listing_price'];
			$listing_type_name  = 'aa';
			if (!empty($this->input->post('txt_sponsored_id'))) {
				$sponsoredArr 			= $this->database->_get_row_data('tbl_listing_header', array('listing_id' => $this->input->post('txt_sponsored_id')));
				if (isset($sponsoredArr[0]['listing_price'])) {
					$sponsored 			= $sponsoredArr[0]['listing_price'];
					$totalAmount 		= floatval($sponsored) + floatval($ListingDataHeader[0]['listing_price']);
					$listing_type      	= $ListingDataHeader[0]['listing_type'] . ' & ' . $sponsoredArr[0]['listing_type'];
					$listing_type_name  = $ListingDataHeader[0]['listing_type'];
				}

				$ListingDataArr[0] = array(
					'user_id' => $userdata[0]['user_id'],
					'user_email' => $userdata[0]['email'],
					'user_username' => $userdata[0]['username'],
					'listing_id' => $ListingData[0]['id'],
					'plan_header' => $sponsoredArr[0]['listing_id'],
					'listing_type' => $sponsoredArr[0]['listing_type'],
					'amount' => number_format($totalAmount, 2, '.', ''),
					'period' => $sponsoredArr[0]['listing_duration'],
					'listing_type_name'  =>  $listing_type_name,
					'transactionId' => $payment_id,
					'description' => 'Listing :' . $listing_type,
					'currency' => $currency,
					'payment_method' => 'PAYPAL',
					'clientIp' => $this->input->ip_address(),
					'returnUrl' => base_url() . PAYMENT_PAYPAL_RETURN . '/sponsored',
					'cancelUrl' => base_url() . PAYMENT_CANCEL
				);
			}

			$valTransc[0] = array(
				'user_id' => $userdata[0]['user_id'],
				'user_email' => $userdata[0]['email'],
				'user_username' => $userdata[0]['username'],
				'listing_id' => $ListingData[0]['id'],
				'plan_header' => $ListingDataHeader[0]['listing_id'],
				'listing_type' => $ListingDataHeader[0]['listing_type'],
				'amount' => number_format($totalAmount, 2, '.', ''),
				'period' => $ListingDataHeader[0]['listing_duration'],
				'transactionId' => $payment_id,
				'description' => 'Listing :' . $listing_type,
				'currency' => $currency,
				'payment_method' => 'PAYPAL',
				'clientIp' => $this->input->ip_address(),
				'returnUrl' => base_url() . PAYMENT_PAYPAL_RETURN . '/sponsored',
				'cancelUrl' => base_url() . PAYMENT_CANCEL,
				'listing_type_name'  =>  $listing_type_name
			);

			$cardInput = array(
				'firstName' => '',
				'lastName' => '',
				'number' => '',
				'cvv' => '',
				'expiryMonth' => '',
				'expiryYear' => '',
				'email' => ''
			);

			try {
				$purchaseProc = new paymentgateway('PayPal_Express', true);
				$this->session->set_userdata('paypal_data', $valTransc[0]);
				$this->session->set_userdata('listing_data', array_merge($ListingDataArr, $valTransc));
				$data 	= $purchaseProc->sendPurchaseExpress($cardInput, $valTransc[0]);
				$url 	= $data;
				header("Location: $url");
			} catch (Exception $e) {
				$url 	= base_url() . PAYMENT_FAIL;
				$this->fail($valTransc);
			}
		}
	}

	/*Paypal Pro Listings*/
	public function PayPal_Pro_int()
	{
		$ListingDataArr = array();
		$default_currency 	=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies', array('default_status' => '1'), 'currency'), 'code');
		$currency 			= 'USD';

		if (!empty($default_currency)) {
			$currency = $default_currency;
		}

		if (!empty($this->session->userdata('user_id'))) {
			$itemsArr 			= array();
			$payment_id  		= $this->_generate_paymentID();
			$ListingDataHeader 	= $this->database->_get_row_data('tbl_listing_header', array('listing_id' => $this->input->post('txt_payid')));
			$ListingData 		= $this->database->_get_row_data('tbl_listings', array('id' => $this->input->post('txt_listingid')));
			$userdata 			= $this->database->getUserData($this->session->userdata('user_id'));
			$totalAmount		= 0;

			$listing_type      	= $ListingDataHeader[0]['listing_type'];
			$totalAmount		= $ListingDataHeader[0]['listing_price'];
		}

		if (!empty($this->input->post('txt_listingid')) && !empty($ListingData)) {
			$redirectURL = base_url() . 'user/create_listings/' . $ListingData[0]['listing_type'] . '/' . $ListingData[0]['id'];
			$this->session->set_userdata('url', $redirectURL);
		}

		if (!empty($userdata)) {

			if (!empty($this->input->post('txt_sponsored_id'))) {
				$sponsoredArr 			= $this->database->_get_row_data('tbl_listing_header', array('listing_id' => $this->input->post('txt_sponsored_id')));
				if (isset($sponsoredArr[0]['listing_price'])) {
					$sponsored 			= $sponsoredArr[0]['listing_price'];
					$totalAmount 		= floatval($sponsored) + floatval($ListingDataHeader[0]['listing_price']);
					$listing_type      	= $ListingDataHeader[0]['listing_type'] . ' & ' . $sponsoredArr[0]['listing_type'];
				}

				$ListingDataArr[0] = array(
					'user_id' => $userdata[0]['user_id'],
					'user_email' => $userdata[0]['email'],
					'user_username' => $userdata[0]['username'],
					'listing_id' => $ListingData[0]['id'],
					'plan_header' => $sponsoredArr[0]['listing_id'],
					'listing_type' => $sponsoredArr[0]['listing_type'],
					'amount' => number_format($totalAmount, 2, '.', ''),
					'period' => $sponsoredArr[0]['listing_duration'],
					'transactionId' => $payment_id,
					'description' => 'Listing :' . $listing_type,
					'currency' => $currency,
					'payment_method' => 'PAYPAL',
					'clientIp' => $this->input->ip_address(),
					'returnUrl' => base_url() . PAYMENT_PAYPAL_RETURN . '/sponsored',
					'cancelUrl' => base_url() . PAYMENT_CANCEL
				);
			}

			$valTransc[0] = array(
				'user_id' => $userdata[0]['user_id'],
				'user_email' => $userdata[0]['email'],
				'user_username' => $userdata[0]['username'],
				'listing_id' => $ListingData[0]['id'],
				'plan_header' => $ListingDataHeader[0]['listing_id'],
				'listing_type' => $ListingDataHeader[0]['listing_type'],
				'amount' => number_format($totalAmount, 2, '.', ''),
				'period' => $ListingDataHeader[0]['listing_duration'],
				'transactionId' => $payment_id,
				'description' => 'Listing :' . $listing_type,
				'currency' => $currency,
				'payment_method' => 'PAYPAL',
				'clientIp' => $this->input->ip_address(),
				'returnUrl' => base_url() . PAYMENT_PAYPAL_RETURN . '/sponsored',
				'cancelUrl' => base_url() . PAYMENT_CANCEL
			);

			$cardInput = array(
				'firstName' => $this->input->post('name'),
				'lastName' => '',
				'number' => $this->input->post('number'),
				'cvv' => $this->input->post('security-code'),
				'expiryMonth' => $this->input->post('txt_month'),
				'expiryYear' => $this->input->post('txt_year'),
				'email' => $this->input->post('txt_useremail')
			);

			try {

				try {
					$purchaseProc = new paymentgateway('PayPal_Pro', true);
					$this->session->set_userdata('paypal_data', $valTransc[0]);
					$this->session->set_userdata('listing_data', array_merge($ListingDataArr, $valTransc));
					$data 	= $purchaseProc->sendPurchase($cardInput, $valTransc[0]);
					if (isset($data['ACK']) && $data['ACK'] == 'Success') {
						$this->session->set_userdata('paypal_data', $valTransc[0]);
						$this->direct_payments($data, $valTransc[0], 'internal', 'PayPal Pro');
						$url 	= base_url() . PAYMENT_SUCCESS;
						$this->session->unset_userdata('listing_data');
						$this->success($valTransc[0], $data);
					} else {
						$url 	= base_url() . PAYMENT_FAIL;
						$this->fail($valTransc[0], $data);
					}
				} catch (Exception $e) {
					$url 	= base_url() . PAYMENT_FAIL;
					$this->fail($valTransc[0]);
				}
			} catch (Exception $e) {
				if (!empty($this->session->userdata('user_id'))) {
					$data = self::$data;
					$data['errors'] = 	$e->getMessage();
					$this->session->set_userdata('errors', $data['errors']);
					redirect($this->session->set_userdata('url'));
					return;
				}
				redirect('login');
			}
		}
	}

	/*Paypal Pro Listings*/
	public function Stripe_int()
	{
		$ListingDataArr = array();
		$default_currency 	=	$this->common->getCurrency($this->database->_get_single_data('tbl_currencies', array('default_status' => '1'), 'currency'), 'code');
		$currency 			= 'USD';

		if (!empty($default_currency)) {
			$currency = $default_currency;
		}

		if (!empty($this->session->userdata('user_id'))) {
			$itemsArr 			= array();
			$payment_id  		= $this->_generate_paymentID();

			$ListingDataHeader 	= $this->database->_get_row_data('tbl_listing_header', array('listing_id' => $this->input->post('txt_payid')));

			$ListingData 		= $this->database->_get_row_data('tbl_listings', array('id' => $this->input->post('txt_listingid')));
			$userdata 			= $this->database->getUserData($this->session->userdata('user_id'));
			$totalAmount		= 0;

			if(isset($ListingDataHeader[0]) && isset($ListingDataHeader[0]['listing_type'])) {
				$listing_type      	= $ListingDataHeader[0]['listing_type'];
			}

			if(isset($ListingDataHeader[0]) && isset($ListingDataHeader[0]['listing_price'])) {
				$totalAmount		= $ListingDataHeader[0]['listing_price'];
			}
			
			
		}

		if (!empty($this->input->post('txt_listingid')) && !empty($ListingData)) {
			$redirectURL = base_url() . 'user/create_listings/' . $ListingData[0]['listing_type'] . '/' . $ListingData[0]['id'];
			$this->session->set_userdata('url', $redirectURL);
		}

		if (!empty($userdata)) {

			if (!empty($this->input->post('txt_sponsored_id'))) {
				$sponsoredArr 			= $this->database->_get_row_data('tbl_listing_header', array('listing_id' => $this->input->post('txt_sponsored_id')));
				if (isset($sponsoredArr[0]['listing_price'])) {
					$sponsored 			= $sponsoredArr[0]['listing_price'];
					$totalAmount 		= floatval($sponsored) + floatval($ListingDataHeader[0]['listing_price']);
					$listing_type      	= $ListingDataHeader[0]['listing_type'] . ' & ' . $sponsoredArr[0]['listing_type'];
					$listing_type_name  = $ListingDataHeader[0]['listing_type'];
				}

				$ListingDataArr[0] = array(
					'user_id' => $userdata[0]['user_id'],
					'user_email' => $userdata[0]['email'],
					'user_username' => $userdata[0]['username'],
					'listing_id' => $ListingData[0]['id'],
					'plan_header' => $sponsoredArr[0]['listing_id'],
					'listing_type' => $sponsoredArr[0]['listing_type'],
					'amount' => number_format($totalAmount, 2, '.', ''),
					'period' => $sponsoredArr[0]['listing_duration'],
					'transactionId' => $payment_id,
					'description' => 'Listing :' . $listing_type,
					'currency' => $currency,
					'payment_method' => 'PAYPAL',
					'clientIp' => $this->input->ip_address(),
					'returnUrl' => base_url() . PAYMENT_PAYPAL_RETURN . '/sponsored',
					'cancelUrl' => base_url() . PAYMENT_CANCEL,
					'listing_type_name' => $listing_type_name
				);
			}

			$valTransc[0] = array(
				'user_id' => $userdata[0]['user_id'],
				'user_email' => $userdata[0]['email'],
				'user_username' => $userdata[0]['username'],
				'listing_id' => $ListingData[0]['id'],
				'plan_header' => $ListingDataHeader[0]['listing_id'],
				'listing_type' => $ListingDataHeader[0]['listing_type'],
				'amount' => number_format($totalAmount, 2, '.', ''),
				'period' => $ListingDataHeader[0]['listing_duration'],
				'transactionId' => $payment_id,
				'description' => 'Listing :' . $listing_type,
				'currency' => $currency,
				'payment_method' => 'PAYPAL',
				'clientIp' => $this->input->ip_address(),
				'returnUrl' => base_url() . PAYMENT_PAYPAL_RETURN . '/sponsored',
				'cancelUrl' => base_url() . PAYMENT_CANCEL,
				'listing_type_name' => 'aa'
			);

			$cardInput = array(
				'firstName' => $this->input->post('name'),
				'lastName' => '',
				'number' => $this->input->post('number'),
				'cvv' => $this->input->post('security-code'),
				'expiryMonth' => $this->input->post('txt_month'),
				'expiryYear' => $this->input->post('txt_year'),
				'email' => $this->input->post('txt_useremail'),
				'token' => $this->input->post('token')
			);

			try {

				try {
					$purchaseProc = new paymentgateway('Stripe', true);
					$this->session->set_userdata('paypal_data', $valTransc[0]);
					$this->session->set_userdata('listing_data', array_merge($ListingDataArr, $valTransc));
					$tempdata 	= $purchaseProc->completePurchaseStripe($cardInput, $valTransc[0]);
					if (isset($tempdata['status']) && $tempdata['status'] == 'succeeded') {

						$data = array(
							'TRANSACTIONID' => $tempdata['id'],
							'ACK' => $tempdata['status'],
							'CORRELATIONID' => $tempdata['source']['fingerprint'],
							'PAYER_ID' => $tempdata['source']['last4']
						);

						$this->session->set_userdata('paypal_data', $valTransc[0]);
						$this->direct_payments($data, $valTransc[0], 'internal', 'Stripe');

						
						$url 	= base_url() . PAYMENT_SUCCESS;

						// add plan header to listing of product
						$this->addPlanHeaderIntoListing($ListingDataHeader, $ListingData);
						
						if(isset($ListingDataArr[0]) && isset($ListingDataArr[0]['listing_type_name']) == 'solution') {
							$data['solution_url'] = base_url() . 'user/manage_solutions';
							$this->session->set_userdata('solution_success','Successfully process done');
						}
						$this->session->unset_userdata('listing_data');
						$this->success($valTransc[0], $data);
					} else {
						$url 	= base_url() . PAYMENT_FAIL;
						$this->fail($valTransc[0], $tempdata);
					}
				} catch (Exception $e) {
					$url 	= base_url() . PAYMENT_FAIL;
					$this->fail($valTransc[0]);
				}
			} catch (Exception $e) {
				if (!empty($this->session->userdata('user_id'))) {
					$data = self::$data;
					$data['errors'] = 	$e->getMessage();
					$this->session->set_userdata('errors', $data['errors']);
					redirect($this->session->set_userdata('url'));
					return;
				}
				redirect('login');
			}
		}
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

	/*Unique Payment ID Generation*/
	private function _generate_paymentID($table = 'tbl_payments', $column = 'id')
	{
		do {
			$salt = base_convert(bin2hex($this->security->get_random_bytes(64)), 16, 36);
			if ($salt === FALSE) {
				$salt = hash('sha256', time() . mt_rand());
			}
			$new_key = substr($salt, 0, 10);
		} while ($this->database->_results_count($table, array($column => $new_key)));
		return $new_key;
	}

	/*Success Return*/
	public function success($data, $returned)
	{
		$DATA['PAYMENT'] 	= $data;
		// echo "<pre>";
		// echo  print_r($DATA['PAYMENT'] );
		// exit;
		$DATA['RETURNED']	= $returned;
		$DATA = html_escape($this->security->xss_clean($DATA));
		$this->load->view('payments/success_new', $DATA);

		//$this->loadPage('payments/success_new', $DATA);
	}

	function loadPage($template, $data = null)
	{
		$data['template_name'] 		= 	$template;
		$data['data'] 				= 	$data;
		// $data 						= 	html_escape($this->security->xss_clean($data));
		$this->load->view('main/master-template', $data);
	}

	/*Fail Return*/
	public function fail($data, $reason = '')
	{
		$DATA['PAYMENT'] 	= $data;
		$DATA['REASON'] 	= $reason;
		$DATA = html_escape($this->security->xss_clean($DATA));
		$this->load->view('payments/fail', $DATA);
	}

	/*Cancel Return*/
	public function cancel()
	{
		$this->load->view('payments/cancel');
	}

	/*Add Payments Data*/
	public function AddPaymentData($data, $sessiondata)
	{
		$data = array(
			'PAYMENT_ID' => $sessiondata['transactionId'],
			'AMOUNT' => $data['PAYMENTINFO_0_AMT'],
			'METHOD' => $data['PAYMENTINFO_0_TRANSACTIONTYPE'],
			'ACK' => $data['ACK'],
			'USER_ID' => $sessiondata['user_id'],
			'PLAN_ID' => $sessiondata['listing_id'],
			'TOKEN' => $data['TOKEN'],
			'PAYMENTINFO_0_TRANSACTIONID' => $data['PAYMENTINFO_0_TRANSACTIONID'],
			'CORRELATIONID' => $data['CORRELATIONID'],
			'PAYER_ID' => $data['CORRELATIONID'],
			'PAYMENTINFO_0_TRANSACTIONTYPE' => $data['PAYMENTINFO_0_TRANSACTIONTYPE'],
			'PAYMENTINFO_0_FEEAMT' => $data['PAYMENTINFO_0_FEEAMT'],
			'PAYMENTINFO_0_PAYMENTTYPE' => $data['PAYMENTINFO_0_PAYMENTTYPE'],
			'PAYMENTINFO_0_TAXAMT' => $data['PAYMENTINFO_0_TAXAMT']
		);


		// If solution sold then below code is work otherwise no
		if ($this->session->has_userdata('lisiting_type')) {

			$lisiting_type = $this->session->userdata('lisiting_type');
			$data['listing_type'] = $lisiting_type;
		}

		// get original price and commission status
		$list = $this->database->_get_row_data('tbl_listing', array(
			'user_id' => $sessiondata['user_id'],
			'id' => $sessiondata['listing_id']
		));
		if (!empty($list)) {
			$data1 = [
				'original_minimumoffer' => $listing[0]['original_minimumoffer'] ?? 0,
				'original_buynowprice' => $listing[0]['original_buynowprice'] ?? 0,
				'original_discountprice' => $listing[0]['original_discountprice'] ?? 0,
				'commission_type' => $listing[0]['commission_type'] ?? 0,
				'commission_user_product	' => $listing[0]['commission_user_product	'] ?? 0,
				'commission_amount	' => $listing[0]['commission_amount	'] ?? 0,
			];
			$data = array_merge($data, $data1);
		}
		$this->database->_insert_to_DB('tbl_payments', $data);
	}
}
