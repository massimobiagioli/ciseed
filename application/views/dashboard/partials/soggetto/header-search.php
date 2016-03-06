$('#txtNominativo').puiinputtext(); 
$('#txtIndirizzo').puiinputtext(); 
$('#btnSearch').puibutton();
$('#btnSearch').click(function() {
    
    if (!App.data.initDatagrid) {
        App.data.initDatagrid = true;        
        loadDataGrid();
    }
    
    App.data.newFilters = true;
    
    $('#datagrid').puidatatable('reload');        
});