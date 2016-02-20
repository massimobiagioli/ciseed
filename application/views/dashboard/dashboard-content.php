<body class="skin-black">
    
    <!-- Header -->
    <header class="header">            
        <!-- Logo -->
        <?php $this->load->view($headerLogo); ?>            

        <!-- Navbar -->
        <?php $this->load->view($headerNavbar); ?>
    </header>
    
    <!-- Content -->
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Sidebar -->
        <?php $this->load->view($sidebar); ?>

        <!-- Main -->
        <?php $this->load->view($main); ?>
