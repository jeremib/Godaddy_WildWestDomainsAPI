<?php
function godaddy_wwd_autoload($class) {
	if ( file_exists(__DIR__ . '/WildWestDomainsAPI/library/' . str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php') ) {
		require_once __DIR__ . '/WildWestDomainsAPI/library/' . str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
	}

}

spl_autoload_register('godaddy_wwd_autoload');

class Godaddy_WildWestDomainsAPI extends \WildWest_Reseller_Client{

}