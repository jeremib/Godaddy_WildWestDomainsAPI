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

    public function CancelDomain($resource_id, $type = 'immediate') {
        $data = array(
            'credential' => $this->_credential,
            'sCLTRID' => $this->getClientTransactionId(),
            'sType' => $type,
            'sIDArray' => array($resource_id)
        );

        $response = $this->__call('Cancel', array($data));
        $xml  = new SimpleXMLElement($response->CancelResult);
        if (empty($xml->resdata)) {
            throw new WildWest_Reseller_Exception((string)$xml->result->msg, (string)$xml->result['code']);
        } else {
            return (string)$xml->code == 1000;
        }
    }

    public function ManageTransfer(array $domains = array(), $action = 'sendEmail') {
        $data = array(
            'credential' => $this->_credential,
            'sCLTRID' => $this->getClientTransactionId(),
            'sAction' => $action,
            'domainArray' => $domains,
        );


        $response = $this->__call('ManageTransfer', array($data));
        $xml  = new SimpleXMLElement($response->ManageTransferResult);
        if (empty($xml->resdata)) {
            throw new WildWest_Reseller_Exception((string)$xml->result->msg, (string)$xml->result['code']);
        } else {
            return (string)$xml->code == 1000;
        }
    }

    public function SetDomainLocking(array $domains = array(), $lock_val = 'yes') {
        $data = array(
            'credential' => $this->_credential,
            'sCLTRID' => $this->getClientTransactionId(),
            'sLock' => $lock_val,
            'domainArray' => $domains,
        );


        $response = $this->__call('SetDomainLocking', array($data));
        $xml  = new SimpleXMLElement($response->SetDomainLockingResult);
        if (!isset($xml->resdata) && empty($xml->resdata)) {
            throw new WildWest_Reseller_Exception((string)$xml->result->msg, (string)$xml->result['code']);
        } else {
            return (string)$xml->code == 1000;
        }
    }


}