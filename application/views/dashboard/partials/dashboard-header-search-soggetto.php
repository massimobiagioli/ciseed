$('#txtNominativo').puiinputtext(); 
$('#txtIndirizzo').puiinputtext(); 
$('#btnSearch').puibutton({
    click: function(event) {
        $('#tabview').puitabview('select', 1);     
        $('#datagrid').puidatatable('reload');
    }
});