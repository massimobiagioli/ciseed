<script type="text/javascript">

$(function() {
    <?php $this->load->view($customHeaderDetail); ?>
    initButtonsDetail();
});

function initButtonsDetail() {
    // Pulsante OK
    $('#btnOk').puibutton();
    $('#btnOk').click(function() {
        alert("OK");
    });

    // Pulsante Annulla
    $('#btnCancel').puibutton();
    $('#btnCancel').click(function() {
        alert("Cancel");
    });    
};

</script>
