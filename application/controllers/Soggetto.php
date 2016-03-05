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
    
    protected function loadCustomPartialsModel() {
        return array(
            'customSearch' => 'dashboard/partials/dashboard-content-search-soggetto.php',
            'customHeaderSearch' => 'dashboard/partials/dashboard-header-search-soggetto.php',
            'datagridCustomFilters' => 'dashboard/partials/dashboard-header-datagrid-filters-soggetto.php'
        );
    }

}
