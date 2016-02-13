<?php
require_once APPPATH . 'controllers/API_Controller.php';

class Soggetto extends API_Controller {
    
    protected function initVars() {
        $this->model = 'soggetto';
    }
    
}
