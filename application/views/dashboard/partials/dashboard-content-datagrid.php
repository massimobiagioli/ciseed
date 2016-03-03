<div id="tabView">
    <ul>
        <li><a href="#tabSearch">Ricerca</a></li>
        <li><a href="#tabResults">Risultati</a></li>
    </ul>
    <div>
        <div id="tabSearch">
            <?php $this->load->view($customSearch); ?>
        </div>
        <div id="tabResults">
            <div id="datagrid"></div>
        </div>
    </div>
</div>