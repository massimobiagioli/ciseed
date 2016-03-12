<div class="ui-grid">
    <?php if ($action === 'edit'): ?>
    <div class="ui-grid-row" style="margin: 5px;">
        <div align="right" class="ui-grid-col-3" style="margin: 5px;">Nominativo</div>
        <div class="ui-grid-col-9">
            <input id="txtID" type="text" value="<?=$row['sog_id']?>" size="10" disabled="disabled" style="text-align: center"/>            
        </div>
    </div>    
    <?php endif; ?>
    <div class="ui-grid-row" style="margin: 5px;">
        <div align="right" class="ui-grid-col-3" style="margin: 5px;">Nominativo</div>
        <div class="ui-grid-col-9">
            <input id="txtNominativo" type="text" value="<?=$row['sog_nome']?>" size="50"/>
        </div>
    </div>
    <div class="ui-grid-row" style="margin: 5px;">
        <div align="right" class="ui-grid-col-3" style="margin: 5px;">Indirizzo</div>
        <div class="ui-grid-col-9">
            <input id="txtIndirizzo" type="text" value="<?=$row['sog_indirizzo']?>" size="50" />
        </div>
    </div>    
</div>