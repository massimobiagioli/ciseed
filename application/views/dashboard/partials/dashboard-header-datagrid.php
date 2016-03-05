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
        $('#datagrid').puidatatable({            
            lazy: true,
            caption: '<?=$gridCaption?>',
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
                var encodedParams = encodeURIComponent(btoa(JSON.stringify(queryData)));                                
                                
                // Effettua la count
                var uriCount = '<?php echo base_url(); ?><?php echo index_page(); ?>/api/<?=$model?>/count/' + encodedParams,               
                    uri = '<?php echo base_url(); ?><?php echo index_page(); ?>/api/<?=$model?>/' + encodedParams,
                    count = 0,
                    that = this;
                
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
                            }
                        });
                    }
                });                
            }
        });
        
        $('#tabview').puitabview();
        
        <?php $this->load->view($customHeaderSearch); ?>
    });
</script>
