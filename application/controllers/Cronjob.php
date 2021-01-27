<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('max_execution_time', 0);

class Cronjob extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('helperssl'));
        $this->load->library('form_validation');
        $this->load->model('DatabaseOperationsHandler', 'database');
        $this->load->model('CommonOperationsHandler', 'common');
       
       
    }

    public function getListingHeaderPlanValidate()
    {
        // This method will validate the listing header plan 
        // if plan will expire the shifted to regualar plan
        $this->database->getListingHeaderPlanValidate();

        // This method will validate the membership plan
        // if plan will expire the shifted to default plan
        $this->database->getMembershipValidate();

    }


    
}
