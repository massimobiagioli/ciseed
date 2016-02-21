<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('dashboardViewGetPartials')) {
    function dashboardViewGetPartials() {
        return array(
            'headerLogo' => 'dashboard/partials/dashboard-content-header-logo.php',
            'headerNavbar' => 'dashboard/partials/dashboard-content-header-navbar.php',
            'sidebar' => 'dashboard/partials/dashboard-content-sidebar.php',
            'main' => 'dashboard/partials/dashboard-content-main.php',
        );
    }   
}