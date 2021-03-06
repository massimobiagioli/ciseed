<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Superclasse controller
 */
class API_Controller extends CI_Controller {    
    
    const VIEW_RENDER_TYPE_DATAGRID = 'datagrid';
    
    protected $model;
    protected $gridCaption;
    protected $gridCols;
    protected $gridRows = 10;
    protected $viewRenderType = self::VIEW_RENDER_TYPE_DATAGRID;
    
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
     * Render paginazione
     */
    public function index() {
        $this->loadPartialsIndex();
        $this->load->helper('url');
        $this->load->view('dashboard/dashboard-header', $this->getHeaderData());
        $this->load->view('dashboard/dashboard-content', $this->getContentData());
        $this->load->view('dashboard/dashboard-footer');
    }
    
    private function loadPartialsIndex() {
        $this->load->helper('dahsboard_view_getpartial');
        
        // partials generiche
        $this->load->vars(dashboardViewGetPartials());
        
        // partials specifiche (base)        
        $this->loadPartialsBase();
        
        // partials specifiche (model)
        $this->loadPartialsModel();
    }
    
    protected function loadPartialsBase() {
        $this->load->vars(dashboardViewGetPartialsBase(array(
            'model' => $this->model,
            'viewRenderType' => $this->viewRenderType
        )));        
    }
    
    protected function loadPartialsModel() {        
    }
    
    /**
     * Render dettaglio
     */
    public function detail($id) {        
        $this->loadPartialsDetail();
        $this->load->helper('url');
        $this->load->view('dashboard/dashboard-header', $this->getHeaderDataDetail($id));
        $this->load->view('dashboard/dashboard-content', $this->getContentDataDetail($id));
        $this->load->view('dashboard/dashboard-footer');        
    }

    private function loadPartialsDetail() {
        $this->load->helper('dahsboard_view_getpartial');
        
        // partials generiche
        $this->load->vars(dashboardViewGetPartials());
        
        // partials specifiche (base)        
        $this->loadPartialsBaseDetail();
        
        // partials specifiche (model)
        $this->loadPartialsModelDetail();        
    }
        
    protected function loadPartialsBaseDetail() {
        $this->load->vars(dashboardViewGetPartialsBaseDetail(array(
            'model' => $this->model
        )));
    }
    
    protected function loadPartialsModelDetail() {        
    }
        
    protected function getHeaderData() {
        $this->loadModel();
        $modelName = $this->model;        
        
        return array(
            'model' => $this->model,
            'pk' => $this->$modelName->getPk(),
            'gridCaption' => $this->gridCaption,
            'gridCols' => $this->gridCols,
            'gridRows' => $this->gridRows
        );
    }    
    
    protected function getContentData() {
        return array();
    }        
    
    protected function getHeaderDataDetail() {
        return array(
            'action' => 'edit'
        );
    }    
    
    protected function getContentDataDetail($id) {
        $this->loadModel();
        $row = $this->fetchModelRecord($id);
        
        return array(
            'row' => (array)$row,
            'action' => 'edit'
        );
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
        $row = $this->fetchModelRecord($id);
        if (!$row) {
            $this->handleInternalError();
            die();
        }
        
        $this->postLoad($row);
        
        // Gestione risposta json
        $this->handleJsonResponse($row);
    }
    
    /**
     * Effettua operazioni pre-caricamento record
     * (Personalizzare nelle sottoclassi)
     * @param int $id ID del record da caricare
     */
    protected function preLoad($id) {
    }

    /**
     * Effettua operazioni post-caricamento record
     * (Personalizzare nelle sottoclassi)
     * @param array $row Record caricato
     */
    protected function postLoad($row) {        
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

    /**
     * Effettua conteggio dei record per una query
     * @param string $filters queryData serializzato in json
     */
    public function countQuery($filters) {        
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
        
        // Effettua caricamento da model
        $this->loadModel();
        $data = $this->countModelQuery($queryData);
        if (!$data) {
            $this->handleInternalError();
            die();
        }
                
        // Gestione risposta json
        $this->handleJsonResponse($data);
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
        if ($data === false) {
            $this->handleInternalError();
            die();
        }
                
        $this->postQuery($queryData, $data);
        
        // Gestione risposta json
        $this->handleJsonResponse($data);
    }

    /**
     * Effettua operazioni pre-caricamento dati
     * (Personalizzare nelle sottoclassi)
     * @param object $queryData QueryData
     */    
    protected function preQuery($queryData) {        
    }

    /**
     * Effettua operazioni post-caricamento dati
     * (Personalizzare nelle sottoclassi)
     * @param object $queryData QueryData
     * @param array $data Dati caricati dal model
     */        
    protected function postQuery($queryData, $data) {        
    }
    
    /**
     * Carica dati dal model, in funzione del QueryData
     * @param int $queryData QueryData
     * @return Dati reperiti dal model in caso di esito potitivo, altrimenti false
     */
    protected function fetchModelQuery($queryData) {
        $modelName = $this->model;
        return $this->$modelName->query($queryData);
    }
    
    /**
     * Conta record per una specifica query
     * @param int $queryData QueryData
     * @return Conteggio dei record in caso di esito potitivo, altrimenti false
     */
    protected function countModelQuery($queryData) {
        $modelName = $this->model;
        return $this->$modelName->countQuery($queryData);
    }
    
    /**
     * Inserimento di un nuovo elemento
     */
    public function insert() {
        // Controllo autorizzazioni
        if (!$this->checkAuth()) {
            $this->handleUnhautorized();
            die();
        }
        
        // Effettua il parsing dei dati in ingresso
        $toInsert = $this->parseInputData();
        
        $this->preInsert($toInsert);
        
        // Effettua salvataggio dei dati
        $this->loadModel();
        $inserted = $this->insertModel($toInsert);
        if (!$inserted) {
            $this->handleInternalError();
            die();
        }
        
        $this->postInsert($inserted);
        
        // Gestione risposta json
        $this->handleJsonResponse($inserted);
    }

    /**
     * Effettua operazioni pre-inserimento record
     * (Personalizzare nelle sottoclassi)
     * @param array $toInsert Elemento da inserire
     */        
    protected function preInsert($toInsert) {    
    }

    /**
     * Effettua operazioni post-inserimento record
     * (Personalizzare nelle sottoclassi)
     * @param array $inserted Elemento inserito
     */        
    protected function postInsert($inserted) {        
    }
    
    /**
     * Effettua inserimento di un nuovo elemento
     * @param object $toInsert Dati da inserire
     * @return mixed Nuovo elemento inserito se esito positivo, altrimenti false
     */
    protected function insertModel($toInsert) {
        $modelName = $this->model;
        return $this->$modelName->insert($toInsert);
    }
    
    /**
     * Aggiornamento di un elemento esistente
     * @param int $id ID dell'elemento da aggiornare
     */
    public function update($id) {
        // Controllo autorizzazioni
        if (!$this->checkAuth()) {
            $this->handleUnhautorized();
            die();
        }
        
        // Effettua il parsing dei dati in ingresso
        $toUpdate = $this->parseInputData();
        
        $this->preUpdate($id, $toUpdate);
        
        // Effettua salvataggio dei dati
        $this->loadModel();
        $updated = $this->updateModel($id, $toUpdate);
        if (!$updated) {
            $this->handleInternalError();
            die();
        }
        
        $this->postUpdate($updated);
        
        // Gestione risposta json
        $this->handleJsonResponse($updated);
    }    
    
    /**
     * Effettua operazioni pre-aggiornamento record
     * (Personalizzare nelle sottoclassi)
     * @param int $id ID dell'elemento da aggornare
     * @param array $toUpdate Elemento da aggiornare
     */      
    protected function preUpdate($id, $toUpdate) {        
    }

    /**
     * Effettua operazioni post-aggiornamento record
     * (Personalizzare nelle sottoclassi)
     * @param array $updated Elemento aggiornato
     */      
    protected function postUpdate($updated) {        
    }
    
    /**
     * Effettua aggiornamento di un record esistente
     * @param object $toUpdate Dati da aggiornare
     * @return mixed Elemento aggiornato se esito positivo, altrimenti false
     */
    protected function updateModel($id, $toUpdate) {
        $modelName = $this->model;
        return $this->$modelName->update($id, $toUpdate);
    }
    
    /**
     * Effettua cancellazione di un elemento
     * @param int $id ID dell'elemento da cancellare
     */
    public function delete($id) {
        // Controllo autorizzazioni
        if (!$this->checkAuth()) {
            $this->handleUnhautorized();
            die();
        }
                
        $this->preDelete($id);
        
        // Effettua cancellazione dei dati
        $this->loadModel();
        $deleted = $this->deleteModel($id);
        if (!$deleted) {
            $this->handleInternalError();
            die();
        }
        
        $this->postDelete($deleted);
        
        // Gestione risposta json
        $this->handleJsonResponse($deleted);
    }
    
    /**
     * Effettua operazioni pre-cancellazione record
     * (Personalizzare nelle sottoclassi)
     * @param int $id ID dell'elemento da cancellare
     */      
    protected function preDelete($id) {        
    }

    /**
     * Effettua operazioni post-cancellazione record
     * (Personalizzare nelle sottoclassi)
     * @param array $deleted Elemento cancellato
     */      
    protected function postDelete($deleted) {        
    }    
    
    /**
     * Effettua canvellazione di un record esistente
     * @param int $id ID elemento da cancellare
     * @return mixed Elemento cancellato se esito positivo, altrimenti false
     */
    protected function deleteModel($id) {
        $modelName = $this->model;
        return $this->$modelName->delete($id);
    }
    
    /**
     * Effettua controllo autenticazione
     * (Il metodo standard effettua il controllo su "X-AUTH" presente nell'header della request)
     * @return boolean true se autenticato, altrimenti false
     */
    protected function checkAuth() {
        //$authKey = $this->input->request_headers()['X-AUTH'];
        
        // TODO ....
        
        return true;
    }
    
    /**
     * Effettua il caricamento dei model necessari alla manipolazione dei dati
     */
    private function loadModel() {
        $this->load->model($this->model . '_model', $this->model, TRUE);
        $this->loadCustomModels();
    }
    
    /**
     * Effettua il caricamento di model personalizzati
     * (Personalizzare nelle sottoclassi)
     */
    protected function loadCustomModels() {        
    }
    
    private function parseQueryFilters($filters) {
        return json_decode(base64_decode(urldecode($filters)));
    }

    private function parseInputData() {
        return json_decode(file_get_contents("php://input"));
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