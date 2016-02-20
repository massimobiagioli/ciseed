<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->loadPartials();
    }
    
    public function index() {
        $this->load->helper('url');
        $this->load->view('dashboard/dashboard-header');
        $this->load->view('dashboard/dashboard-content', $this->getContentData());
        $this->load->view('dashboard/dashboard-footer');
    }
    
    private function loadPartials() {
        $this->load->vars(array(
            'headerLogo' => 'dashboard/partials/dashboard-content-header-logo.php',
            'headerNavbar' => 'dashboard/partials/dashboard-content-header-navbar.php',
            'sidebar' => 'dashboard/partials/dashboard-content-sidebar.php',
            'main' => 'dashboard/partials/dashboard-content-main.php',
        ));
    }
    
    private function getContentData() {
        $data = array();
        
        return $data;
    }
    
}
