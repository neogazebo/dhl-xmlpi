<?php

/**
 *
 * @author febri
 */
class CekRate extends CFormModel
{
	public $shipperCountry;
	public $shipperPostal;
	public $consigneeCountry;
	public $consigneePostal;
	public $packageWeight;
	public $company_id;
	public $xmlResponse;
	public $xmlObj;

	public function rules()
	{
		return array(
			array('company_id, shipperCountry, shipperPostal, consigneeCountry, consigneePostal, packageWeight', 'required'),
			array('shipperCountry, consigneeCountry', 'length', 'max' => 5),
			array('shipperPostal, consigneePostal', 'length', 'max' => 10),
			array('packageWeight,company_id', 'numerical', 'integerOnly' => true)
		);
	}

	public function generateXmlRequest()
	{
		$xmlConf = XmlConfig::model()->findByPk(XmlConfig::USED_CONF);
		
		$current_time = time();
		$this->xmlObj = simplexml_load_file(Yii::app()->basePath . '/data/XmlRateRequest.xml');
		
		$this->xmlObj->GetQuote->Request->ServiceHeader->SiteID = $xmlConf->siteID;
		$this->xmlObj->GetQuote->Request->ServiceHeader->Password = $xmlConf->password;
		$this->xmlObj->GetQuote->Request->ServiceHeader->MessageTime = date('c', $current_time);
		$this->xmlObj->GetQuote->Request->ServiceHeader->MessageReference = $xmlConf->mref();

		//Consignee Data
		$this->xmlObj->GetQuote->To->CountryCode = $this->consigneeCountry;
		$this->xmlObj->GetQuote->To->Postalcode = $this->consigneePostal;

		//Shipper
		$this->xmlObj->GetQuote->From->CountryCode = $this->shipperCountry;
		$this->xmlObj->GetQuote->From->Postalcode = $this->shipperPostal;

		//Pieces
		$this->xmlObj->GetQuote->BkgDetails->Pieces->Piece->Weight = $this->packageWeight;

		$event = new CreateXmlRequestEvent($this);
		$event->model =$this;
		
		$this->onCekRate($event);
		
		return $event->isValid;
	}
	
	public function onCekRate($event)
	{
		$this->raiseEvent('onCekRate', $event);
	}

	public function filterAvailableProduct(array $xmlObj)
	{
		$arrRate = array();
		$availableProduct = Product::listAllProducts('code','handlingFee');
		
		foreach ($xmlObj['QtdShp'] as $key => $val)
		{
			if(array_key_exists((string)$val->LocalProductCode, $availableProduct))
			{
				$orig_price = (string) $val->ShippingCharge;
				$price = CustomerRate::calculateRate($this->company_id, (string)$val->LocalProductCode, $orig_price);
				array_push($arrRate, array(
					'ProductShortName' => (string) $val->ProductShortName,
					'TotalTransitDays' => (string) $val->TotalTransitDays,
					'ShippingCharge' => $price,
				));
			}
		}
		return $arrRate;
	}
}

?>
