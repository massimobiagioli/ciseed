<script type="text/javascript">
    var cols = [];
    <?php foreach ($gridCols as $gridCol): ?>
        cols.push({
            field: '<?=$gridCol['field']?>',
            headerText: '<?=$gridCol['headerText']?>',
            sortable: <?=$gridCol['sortable']?>,
        });
    <?php endforeach; ?>
    $(function() {
        $('#tabview').puitabview();        
        
        $('#datagrid').puidatatable({            
            lazy: true,
            caption: '<?=$gridCaption?>',
            selectionMode: 'single',
            paginator: {
                rows: <?=$gridRows?>,
                totalRecords: 0
            },
            columns: cols,
            datasource: function(callback, ui) {                
                <?php $this->load->view($datagridCustomFilters); ?>
                var queryData = {
                    limit: <?=$gridRows?>,
                    offset: ui.first,
                    filters: getFilters(),
                    sort: [
                        {
                            field: ui.sortField,
                            type: (ui.sortOrder === 1 ? "ASC" : "DESC")
                        }
                    ]
                };
                var encodedParams = encodeURIComponent(btoa(JSON.stringify(queryData))),                                                                                
                    uriCount = '<?php echo base_url(); ?><?php echo index_page(); ?>/api/<?=$model?>/count/' + encodedParams,               
                    uri = '<?php echo base_url(); ?><?php echo index_page(); ?>/api/<?=$model?>/' + encodedParams,
                    count = 0,
                    that = this;
                
                // Effettua la count
                $.ajax({
                    type: "GET",
                    url: uriCount,
                    dataType: "json",                
                    success: function(response) {
                        count = parseInt(response.RC);

                        // Carica i dati
                        $.ajax({
                            type: "GET",
                            url: uri,
                            dataType: "json",                
                            context: that,
                            success: function(response) {
                                callback.call(that, response);                        
                                $('#datagrid').puidatatable('setTotalRecords', count);
                                $('#tabview').puitabview('select', 1);
                            }
                        });
                    }
                });                
            }
        });                
        
        <?php $this->load->view($customHeaderSearch); ?>
    });
</script>
