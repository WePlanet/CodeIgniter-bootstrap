<?php
defined('BASEPATH') or exit('No direct script access allowed');
use GeoIp2\Database\Reader;

class Hook extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session','phpmailer'));
        $this->load->model('hook_model');
    }

    public function index()
    {
        echo "Testing hook dotenv; checking db hostname = " . getenv('DATABASE_HOSTNAME');



        echo "<br/>base url: " . base_url();
    }

    public function location()
    {
        
        $geoip_country_path = realpath(getenv('GEOIP_CITY_PATH')."GeoLite2-City.mmdb");
        $reader = new Reader($geoip_country_path );
        
        $country_code = "";
        $client_ip_address = $_SERVER['REMOTE_ADDR'] ?? "";
        if ($client_ip_address == "" || $client_ip_address ==  "::1") 
                if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
                    $client_ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (!empty($client_ip_address)) {
            // Replace "city" with the appropriate method for your database, e.g.,"country".
            $record = $reader->city($client_ip_address);
            print($record->country->isoCode . "\n"); // 'US'
            print("<br>");
            print($record->country->name . "\n"); // 'United States'
            print("<br>");
            print($record->city->name . "\n"); // 'Minneapolis'
        }

        
    }

}
