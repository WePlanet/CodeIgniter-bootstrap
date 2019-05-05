<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hook extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','phpmailer'));
    }

    public function index()
    {
        echo "Testing hook dotenv; checking db hostname = " . getenv('DATABASE_HOSTNAME');
    }
}
