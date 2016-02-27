<script type="text/javascript">
    $(function() {
        $('#datagrid').puidatatable({
            lazy: true,
            caption: '<?php echo $gridCaption; ?>',
            paginator: {
                rows: 10,
                totalRecords: 4
            },
            columns: [
                {field:'sog_id', headerText: 'ID', sortable:true},
                {field:'sog_nome', headerText: 'Nome', sortable:true},
                {field:'sog_indirizzo', headerText: 'Indirizzo', sortable:true}
            ],
            datasource: function(callback, ui) {
                var queryData = {
                    "limit": 10,
                    "offset": ui.first,
                    "filters": [],
                    "sort": [
                        {
                            "field": ui.sortField,
                            "type": (ui.sortOrder === 1 ? "ASC" : "DESC")
                        }
                    ]
                };
                var enc = encodeURIComponent(btoa(JSON.stringify(queryData)));                                
                var uri = '<?php echo base_url(); ?><?php echo index_page(); ?>/api/<?php echo $model; ?>/' + enc;                
                $.ajax({
                    type: "GET",
                    url: uri,
                    dataType: "json",                
                    context: this,
                    success: function(response) {
                        callback.call(this, response);
                    }
                });
            }
        });
    });
</script>
