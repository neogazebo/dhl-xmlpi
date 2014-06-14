<?php

/**
 * Description of XMLSender
 * This Class is an event handler for sending xml request
 *
 * @author febri
 */
class XMLSender
{

	public function send($event)
	{
		$xmlRequest = $event->model->xmlObj->asXML();

		if (!isset($xmlRequest))
			$event->model->xmlResponse = false;

		if (($event->model instanceof Shipment))
			$event->model->xmlRequest = $xmlRequest;

		$client = new Zend_Http_Client(null, array(
			'strict' => false,
			'adapter' => 'Zend_Http_Client_Adapter_Curl',
			'persistent' => true,
			'timeout'=>1200 
		));
		$client->setUri('https://xmlpi-ea.dhl.com/XMLShippingServlet');
		$response = $client->setRawData($xmlRequest, 'text/xml')->request('POST');
		if ($response->isSuccessful())
		{
			 $xmlResponse=$response->getBody();
			 $event->model->xmlResponse = $xmlResponse;
		}
		else
			$event->model->xmlResponse = false;
	}
}

?>
