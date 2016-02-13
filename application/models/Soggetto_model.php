<?php
require_once APPPATH . 'models/API_Model.php';

class Soggetto_model extends API_Model {
    
    protected function initVars() {
        $this->tableName = 'soggetti';
        $this->pk = 'sog_id';
    }
        
}
