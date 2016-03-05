<?php
require_once APPPATH . 'controllers/API_Controller.php';

class Soggetto extends API_Controller {
    
    protected function initVars() {
        $this->model = 'soggetto';
        $this->gridCaption = 'Soggetti';          
        $this->gridCols = array(
            array(
                'field' => 'sog_id',
                'headerText' => 'ID',
                'sortable' => true
            ),
            array(
                'field' => 'sog_nome',
                'headerText' => 'Nome',
                'sortable' => true
            ),
            array(
                'field' => 'sog_indirizzo',
                'headerText' => 'Indirizzo',
                'sortable' => true
            )
        );        
    }        

}
