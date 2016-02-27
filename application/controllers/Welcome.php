<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->loadPartials();
    }

    public function index() {
        $this->load->helper('url');
        $this->load->view('dashboard/dashboard-header', $this->getHeaderData());
        $this->load->view('dashboard/dashboard-content', $this->getContentData());
        $this->load->view('dashboard/dashboard-footer');
    }

    private function loadPartials() {
        $this->load->helper('dahsboard_view_getpartial');
        
        // partials generiche
        $this->load->vars(dashboardViewGetPartials());
        
        // partials specifiche della welcome page
        $this->load->vars(array(
            'customHeader' => 'dashboard/partials/dashboard-header-welcome.php',
            'customContent' => 'dashboard/partials/dashboard-content-welcome.php'              
        ));
    }

    private function getHeaderData() {
        return array();
    }
    
    private function getContentData() {
        return array();
    }

}
