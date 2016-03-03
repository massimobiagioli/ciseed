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
                totalRecords: 4
            },
            columns: cols,
            datasource: function(callback, ui) {
                var queryData = {
                    limit: <?=$gridRows?>,
                    offset: ui.first,
                    filters: [],
                    sort: [
                        {
                            field: ui.sortField,
                            type: (ui.sortOrder === 1 ? "ASC" : "DESC")
                        }
                    ]
                };
                var encodedParams = encodeURIComponent(btoa(JSON.stringify(queryData)));                                
                var uri = '<?php echo base_url(); ?><?php echo index_page(); ?>/api/<?=$model?>/' + encodedParams;                
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
        
        $('#tabView').puitabview();
        
        
    });
</script>
