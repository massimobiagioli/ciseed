<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Gestione view di base
 */
if (!function_exists('dashboardViewGetPartials')) {
    function dashboardViewGetPartials() {
        return array(
            'headerLogo' => 'dashboard/partials/dashboard-content-header-logo.php',
            'headerNavbar' => 'dashboard/partials/dashboard-content-header-navbar.php',
            'sidebar' => 'dashboard/partials/dashboard-content-sidebar.php',
            'main' => 'dashboard/partials/dashboard-content-main.php'            
        );
    }   
}

/**
 * Gestione view parziali di base
 */
if (!function_exists('dashboardViewGetPartialsBase')) {
    function dashboardViewGetPartialsBase($options) {
        return array(
            'customHeader' => 'dashboard/partials/dashboard-header-' . $options['viewRenderType'] . '.php',
            'customContent' => 'dashboard/partials/dashboard-content-' . $options['viewRenderType'] . '.php',
            'customSearch' => 'dashboard/partials/' . $options['model'] . '/content-search.php',
            'customHeaderSearch' => 'dashboard/partials/' . $options['model'] . '/header-search.php',
            'datagridCustomFilters' => 'dashboard/partials/' . $options['model'] . '/' . $options['viewRenderType'] . '-filters.php',
            'sidebarMenuActions' => 'dashboard/partials/dashboard-content-sidebar-actions.php'
        );     
    }   
}

/**
 * Gestione view parziali di dettaglio
 */
if (!function_exists('dashboardViewGetPartialsBaseDetail')) {
    function dashboardViewGetPartialsBaseDetail($options) {
        return array(
            'customHeader' => 'dashboard/partials/dashboard-header-detail.php',
            'customContent' => 'dashboard/partials/dashboard-content-detail.php',
            'customDetail' => 'dashboard/partials/' . $options['model'] . '/detail.php',
            'customHeaderDetail' => 'dashboard/partials/' . $options['model'] . '/header-detail.php',
            'sidebarMenuActions' => 'dashboard/partials/dashboard-content-sidebar-actions.php'
        );     
    }   
}
