var getFilters = function() {
    var filters = [],
        nominativo = $('#txtNominativo').val(),
        indirizzo = $('#txtIndirizzo').val();
        
    if (nominativo) {
        filters.push({
            name: "sog_nome",
            operator: "LIKE",
            value: "%" + nominativo + "%"           
        });
    }
    
    if (indirizzo) {
        filters.push({
            name: "sog_indirizzo",
            operator: "LIKE",
            value: "%" + indirizzo + "%"           
        });
    }    
    
    return filters;
};
