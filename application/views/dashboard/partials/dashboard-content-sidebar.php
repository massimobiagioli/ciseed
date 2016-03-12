<aside class="left-side sidebar-offcanvas">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="active">
                <a href="<?php echo base_url(); ?><?php echo index_page(); ?>/soggetto">
                    <i class="fa fa-male"></i> <span>Soggetti</span>                    
                </a>
            </li>            
        </ul>
        
        <!-- Custom Actions -->
        <?php $this->load->view($sidebarMenuActions); ?>
        
    </section>
    <!-- /.sidebar -->
</aside>