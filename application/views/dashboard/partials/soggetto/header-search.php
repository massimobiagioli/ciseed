$('#txtNominativo').puiinputtext(); 
$('#txtIndirizzo').puiinputtext(); 
$('#btnSearch').puibutton();
$('#btnSearch').click(function() {
    $('#datagrid').puidatatable('reload');    
});