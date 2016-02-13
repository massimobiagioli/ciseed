<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Superclasse Model
 */
class API_Model extends CI_Model {        
    
    protected $tableName; 
    protected $pk;
    
    public function __construct() {
        parent::__construct();
        $this->initVars();
    }
    
    /**
     * Inizializzazione variabili
     * Implementare nelle sottoclassi
     */
    protected function initVars() {        
    }
    
    /**
     * Caricamento record per chiave
     * @param int $id ID tabella
     * @return mixed Record identificato dalla chiave se trovato, altrimenti false
     */
    public function load($id) {
        try {
            $query = $this->db->get_where($this->tableName, array($this->pk => $id));                
            $results = $query->result();            
            if (count($results) == 0) {
                return false;
            }
            return $results[0];
        } catch (Exception $ex) {
            return false;
        }
    }    
    
    /**
     * Caricamento dati in funzione dei criteri di ricerca/ordinamento in ingresso
     * @param object $queryData Oggetto QueryData
     * @return mixed Dati che soddisfano i criteri di ricerca, altrimenti fal['value']se
     */
    public function query($queryData) {
        try {            
            $this->db->select('*')
                      ->from($this->tableName)
                      ->where($this->getQueryFilters($queryData->filters))            
                      ->limit($queryData->limit)
                      ->offset($queryData->offset);   
            $query = $this->db->get();  
            
            return $query->result();
        } catch (Exception $ex) {
            return false;
        }
    }    
    
    private function getQueryFilters($inputFilters) {
        $queryFilters = array();
        
        foreach ($inputFilters as $inputFilter) {
            $k = $inputFilter->name . ($inputFilter->operator ? (' ' . $inputFilter->operator) : '');
            $queryFilters[$k] = $inputFilter->value;
        }
        
        return $queryFilters;
    }
    
    public function getTableName() {
        return $this->tableName;
    }
            
}
