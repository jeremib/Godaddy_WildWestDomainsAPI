<?php
function godaddy_wwd_autoload($class) {
	if ( file_exists(__DIR__ . '/WildWestDomainsAPI/library/' . str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php') ) {
		require_once __DIR__ . '/WildWestDomainsAPI/library/' . str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
	}

}

spl_autoload_register('godaddy_wwd_autoload');

class Godaddy_WildWestDomainsAPI extends \WildWest_Reseller_Client{
    /**
     * Gets information about items that have been previously ordered.
     *
     * @return
     */
    public function ModifyNameServer(array $domains = array(), array $nameservers = array())
    {
        $data = array(
            'credential' => $this->_credential,
            'sCLTRID' => $this->getClientTransactionId(),
            'domainArray' => $domains,
            'nsArray' => $nameservers
        );

        $response = $this->__call('UpdateNameServer', array($data));

        $xml  = new SimpleXMLElement($response->UpdateNameServerResult);

        if (empty($xml->resdata)) {
            throw new WildWest_Reseller_Exception((string)$xml->result->msg->error, (string)$xml->result['code']);
        } else {
            return (string)$xml->code == 1000;
        }
    }
}