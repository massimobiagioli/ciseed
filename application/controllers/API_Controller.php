<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Superclasse controller
 */
class API_Controller extends CI_Controller {    
    
    protected $model;
    
    public function __construct() {        
        parent::__construct();     
        $this->initVars();
        $this->authenticateCORS();
    }
    
    /**
     * Inizializzazione variabili
     * Implementare nelle sottoclassi
     */
    protected function initVars() {
    }
    
    /**
     * Caricamento dati model per chiave
     * @param int $id ID model
     */
    public function load($id) {
        // Controllo autorizzazioni
        if (!$this->checkAuth()) {
            $this->handleUnhautorized();
            die();
        }
                
        $this->preLoad($id);
        
        // Effettua caricamento da model
        $this->loadModel();
        $data = $this->fetchModelRecord($id);
        if (!$data) {
            $this->handleInternalError();
            die();
        }
        
        $this->postLoad($id);
        
        // Gestione risposta json
        $this->handleJsonResponse($data);
    }
    
    /**
     * Carica dati del record dal model, in funzione della chiave passata
     * @param int $id ID record
     * @return Dati reperiti dal model in caso di esito potitivo, altrimenti false
     */
    protected function fetchModelRecord($id) {
        $modelName = $this->model;
        return $this->$modelName->load($id);
    }
    
    protected function preLoad($id) {
    }
    
    protected function postLoad($id) {        
    }
    
    /**
     * Caricamento dati
     * @param string $filters queryData serializzato in json
     */
    public function query($filters) {        
        // Controllo autorizzazioni
        if (!$this->checkAuth()) {
            $this->handleUnhautorized();
            die();
        }
        
        // Parsing dei parametri in ingresso
        $queryData = $this->parseQueryFilters($filters);
        if ($queryData == null) {
            $this->handleInternalError();
            die();
        }
        
        $this->preQuery($queryData);
        
        // Effettua caricamento da model
        $this->loadModel();
        $data = $this->fetchModelQuery($queryData);
        if (!$data) {
            $this->handleInternalError();
            die();
        }
                
        $this->postQuery($queryData);
        
        // Gestione risposta json
        $this->handleJsonResponse($data);
    }
    
    protected function fetchModelQuery($queryData) {
        $modelName = $this->model;
        return $this->$modelName->query($queryData);
    }
    
    private function parseQueryFilters($filters) {
        return json_decode(base64_decode(urldecode($filters)));
    }
    
    protected function preQuery($queryData) {        
    }
    
    protected function postQuery($queryData) {        
    }
    
    public function insert() {
        if (!$this->checkAuth()) {
            $this->handleUnhautorized();
            die();
        }
        
        $toInsert = $this->parseInsertData();
        $this->preInsert($toInsert);
        
        $this->postInsert($toInsert);
    }
    
    private function parseInsertData() {
        // TODO ...
    }
    
    protected function preInsert($toInsert) {    
    }
    
    protected function postInsert($toInsert) {        
    }
    
    public function update($id) {
        if (!$this->checkAuth()) {
            $this->handleUnhautorized();
            die();
        }
        
        $toUpdate = $this->parseUpdateData();
        $old = null;
        $this->preUpdate($toUpdate, $old);
        
        $this->postUpdate($toUpdate, $old);        
    }

    private function parseUpdateData() {
        // TODO ...        
    }
    
    protected function preUpdate($toUpdate) {
        
    }
    
    protected function postUpdate($toUpdate) {        
    }

    public function delete($id) {
        if (!$this->checkAuth()) {
            $this->handleUnhautorized();
            die();
        }
        
        $toDelete = null;
        $this->preDelete($toDelete);
        
        $this->postDelete($toDelete);
    }
    
    protected function preDelete($toDelete) {        
    }
    
    protected function postDelete($toDelete) {        
    }    
    
    private function checkAuth() {
        //$authKey = $this->input->request_headers()['X-AUTH'];
        
        // TODO ....
        
        return true;
    }
    
    protected function loadModel() {
        $this->load->model($this->model . '_model', $this->model, TRUE);
        $this->loadCustomModels();
    }
    
    protected function loadCustomModels() {        
    }

    private function handleJsonResponse($data) {
        $this->output->set_content_type('application/json')
                     ->set_status_header('200')
                     ->set_output(json_encode($data));
    }
    
    private function handleUnhautorized() {
        $this->setStatusHeader('401');
    }
    
    private function handleInternalError() {
        $this->setStatusHeader('500');
    }
    
    private function setStatusHeader($status) {
        $this->output->set_status_header($status);
    }
        
    private function authenticateCORS() {        
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
    }
    
}