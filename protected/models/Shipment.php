<?php

/**
 * This is the model class for table "shipments".
 *
 * The followings are the available columns in table 'shipments':
 * @property integer $id
 * @property integer $userId
 * @property integer $company_id
 * @property string $consigneeCompanyName
 * @property string $consigneeAddress
 * @property string $consigneeCity
 * @property string $consigneePostalCode
 * @property string $consigneeCountryCode
 * @property string $consigneeCountryName
 * @property string $consigneePersonName
 * @property string $consigneePhoneNumber
 * @property string $consigneePhoneExt
 * @property string $consigneeFax
 * @property string $consigneeTelex
 * @property string $consigneeEmail
 * @property integer $numberOfPieces
 * @property string $pieceId
 * @property integer $piecePackageType
 * @property string $pieceWeight
 * @property string $packageType
 * @property string $shipmentWeight
 * @property string $shipperCompanyName
 * @property string $shipperAddress
 * @property string $shipperCity
 * @property string $shipperPostalCode
 * @property string $shipperCountryCode
 * @property string $shipperCountryName
 * @property string $shipperPersonName
 * @property string $shipperPhoneNumber
 * @property string $shipperPhoneExt
 * @property string $shipperFax
 * @property string $shipperTelex
 * @property string $shipperEmail
 * @property string $xmlRequest
 * @property string $xmlResponse
 * @property string $waybill
 * @property string $barcode1
 * @property string $barcode2
 * @property string $barcode3
 * @property string $productCode
 * @property string $charge
 * @property string $upCharge
 */
class Shipment extends CActiveRecord
{
	const SHIPPER_DATA_ADDRESS = 1;
	
	public $xmlObj;
	public $regionAp = array(
		'AE' => 'UNITED ARAB EMIRATES',
		'AF' => 'AFGHANISTAN',
		'AL' => 'ALBANIA',
		'AM' => 'ARMENIA',
		'AU' => 'AUSTRALIA',
		'BA' => 'BOSNIA AND HERZEGOVINA',
		'BD' => 'BANGLADESH',
		'BH' => 'BAHRAIN',
		'BN' => 'BRUNEI',
		'BY' => 'BELARUS',
		'CI' => 'COTE DIVOIRE',
		'CN' => 'CHINA ',
		'CY' => 'CYPRUS',
		'DZ' => 'ALGERIA',
		'EG' => 'EGYPT',
		'FJ' => 'FIJI',
		'GH' => 'GHANA',
		'HK' => 'HONG KONG',
		'HR' => 'CROATIA',
		'ID' => 'INDONESIA',
		'IL' => 'ISRAEL',
		'IN' => 'INDIA',
		'IQ' => 'IRAQ',
		'IR' => 'IRAN (ISLAMIC REPUBLIC OF)',
		'JO' => 'JORDAN',
		'JP' => 'JAPAN',
		'KE' => 'KENYA',
		'KG' => 'KYRGYZSTAN',
		'KR' => 'KOREA',
		'KW' => 'KUWAIT',
		'KZ' => 'KAZAKHSTAN',
		'LA' => 'LAO PEOPLES DEMOCRATIC REPUBLIC',
		'LB' => 'LEBANON',
		'LK' => 'SRI LANKA',
		'MA' => 'MOROCCO',
		'MD' => 'MOLDOVA',
		'MK' => 'MACEDONIA',
		'MM' => 'MYANMAR',
		'MO' => 'MACAU',
		'MT' => 'MALTA',
		'MU' => 'MAURITIUS',
		'MY' => 'MALAYSIA',
		'NA' => 'NAMIBIA',
		'NG' => 'NIGERIA',
		'NP' => 'NEPAL',
		'NZ' => 'NEW ZEALAND',
		'OM' => 'OMAN',
		'PH' => 'PHILIPPINES',
		'PK' => 'PAKISTAN',
		'QA' => 'QATAR',
		'RE' => 'REUNION',
		'RS' => 'SERBIA',
		'RU' => 'RUSSIAN FEDERATION',
		'SA' => 'SAUDI ARABIA',
		'SD' => 'SUDAN',
		'SG' => 'SINGAPORE',
		'SN' => 'SENEGAL',
		'SY' => 'SYRIA',
		'TH' => 'THAILAND',
		'TJ' => 'TAJIKISTAN',
		'TR' => 'TURKEY',
		'TW' => 'TAIWAN',
		'UA' => 'UKRAINE',
		'UZ' => 'UZBEKISTAN',
		'VN' => 'VIETNAM',
		'YE' => 'YEMEN',
		'ZA' => 'SOUTH AFRICA',
	);
	public $regionEa = array(
		'AT' => 'AUSTRIA',
		'BE' => 'BELGIUM',
		'BG' => 'BULGARIA',
		'CH' => 'SWITZERLAND',
		'CZ' => 'CZECH',
		'DE' => 'GERMANY',
		'DK' => 'DENMARK',
		'EE' => 'ESTONIA',
		'ES' => 'SPAIN',
		'FI' => 'FINLAND',
		'FR' => 'FRANCE',
		'GB' => 'UNITED KINGDOM',
		'GR' => 'GREECE',
		'HU' => 'HUNGARY',
		'IE' => 'IRELAND',
		'IS' => 'ICELAND',
		'IT' => 'ITALY',
		'LT' => 'LITHUANIA',
		'LU' => 'LUXEMBOURG',
		'LV' => 'LATVIA',
		'NL' => 'NETHERLANDS ',
		'NO' => 'NORWAY',
		'PL' => 'POLAND',
		'PT' => 'PORTUGAL',
		'RO' => 'ROMANIA',
		'SE' => 'SWEDEN',
		'SI' => 'SLOVENIA',
		'SK' => 'SLOVAKIA',
	);
	public $regionAm = array(
		'AG' => 'ANTIGUA',
		'AI' => 'ANGUILLA',
		'AR' => 'ARGENTINA',
		'AW' => 'ARUBA',
		'BB' => 'BARBADOS',
		'BM' => 'BERMUDA',
		'BO' => 'BOLIVIA',
		'BR' => 'BRAZIL',
		'BS' => 'BAHAMAS',
		'CA' => 'CANADA',
		'CL' => 'CHILE',
		'CO' => 'COLOMBIA',
		'CR' => 'COSTA RICA',
		'DM' => 'DOMINICA',
		'DO' => 'DOMINICAN REPUBLIC',
		'EC' => 'ECUADOR',
		'GD' => 'GRENADA',
		'GF' => 'FRENCH GUYANA',
		'GP' => 'GUADELOUPE',
		'GT' => 'GUATEMALA',
		'GU' => 'GUAM',
		'GY' => 'GUYANA (BRITISH)',
		'HN' => 'HONDURAS',
		'HT' => 'HAITI',
		'JM' => 'JAMAICA',
		'KN' => 'ST. KITTS',
		'KY' => 'CAYMAN ISLANDS',
		'LC' => 'ST. LUCIA',
		'MQ' => 'MARTINIQUE',
		'MX' => 'MEXICO',
		'NI' => 'NICARAGUA',
		'PA' => 'PANAMA',
		'PE' => 'PERU',
		'PR' => 'PUERTO RICO',
		'PY' => 'PARAGUAY',
		'SR' => 'SURINAME',
		'SV' => 'EL SALVADOR',
		'TC' => 'TURKS AND CAICOS ISLANDS',
		'TT' => 'TRINIDAD AND TOBAGO',
		'US' => 'UNITED STATES OF AMERICA',
		'UY' => 'URUGUAY',
		'VC' => 'ST. VINCENT',
		'VE' => 'VENEZUELA',
		'VG' => 'VIRGIN ISLANDS (BRITISH)',
		'XC' => 'CURACAO',
		'XM' => 'ST. MAARTEN',
		'XN' => 'NEVIS',
		'XY' => 'ST. BARTHELEMY',
	);

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Shipment the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shipments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, company_id, consigneeCompanyName, consigneeAddress, consigneeCity, consigneePostalCode, consigneeCountryCode, consigneePersonName, consigneePhoneNumber, numberOfPieces, shipmentWeight, shipperCompanyName, shipperAddress, shipperCountryCode, shipperPersonName, shipperPhoneNumber, productCode', 'required'),
			array('userId, company_id, numberOfPieces, piecePackageType', 'numerical', 'integerOnly' => true),
			array('consigneeCompanyName, consigneeCity, shipperCompanyName', 'length', 'max' => 45),
			array('consigneePostalCode, consigneeCountryName, pieceId, shipperPostalCode, shipperCountryName', 'length', 'max' => 10),
			array('consigneeCountryCode, shipperCountryCode', 'length', 'max' => 5),
			array('consigneePersonName, shipperPersonName', 'length', 'max' => 40),
			array('consigneePhoneNumber, consigneeFax, consigneeTelex, shipperPhoneNumber, shipperFax, shipperTelex', 'length', 'max' => 30),
			array('consigneePhoneExt, shipperPhoneExt', 'length', 'max' => 7),
			array('consigneeEmail, shipperEmail, waybill', 'length', 'max' => 90),
			array('pieceWeight,charge,upCharge,packageType, shipmentWeight', 'length', 'max' => 12),
			array('shipperCity, xmlRequest, xmlResponse, barcode1, barcode2, barcode3', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, consigneeCompanyName, consigneeAddress, consigneeCity, consigneePostalCode, consigneeCountryCode, consigneeCountryName, consigneePersonName, consigneePhoneNumber, consigneePhoneExt, consigneeFax, consigneeTelex, consigneeEmail, numberOfPieces, pieceId, piecePackageType, pieceWeight, packageType, shipmentWeight, shipperCompanyName, shipperAddress, shipperCity, shipperPostalCode, shipperCountryCode, shipperCountryName, shipperPersonName, shipperPhoneNumber, shipperPhoneExt, shipperFax, shipperTelex, shipperEmail, xmlRequest, xmlResponse, waybill, barcode1, barcode2, barcode3', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userId' => 'User',
			'consigneeCompanyName' => 'Company Name',
			'consigneeAddress' => 'Address',
			'consigneeCity' => 'City',
			'consigneePostalCode' => 'Postal Code',
			'consigneeCountryCode' => 'Country',
			'consigneeCountryName' => 'Country Name',
			'consigneePersonName' => 'Person Name',
			'consigneePhoneNumber' => 'Phone Number',
			'consigneePhoneExt' => 'Phone Ext',
			'consigneeFax' => 'Fax',
			'consigneeTelex' => 'Telex',
			'consigneeEmail' => 'Email',
			'numberOfPieces' => 'Number Of Pieces',
			'pieceId' => 'Piece',
			'piecePackageType' => 'Piece Package Type',
			'pieceWeight' => 'Piece Weight',
			'packageType' => 'Package Type',
			'shipmentWeight' => 'Shipment Weight',
			'shipperCompanyName' => 'Company Name',
			'shipperAddress' => 'Address',
			'shipperCity' => 'City',
			'shipperPostalCode' => 'Postal Code',
			'shipperCountryCode' => 'Country',
			'shipperCountryName' => 'Country Name',
			'shipperPersonName' => 'Person Name',
			'shipperPhoneNumber' => 'Phone Number',
			'shipperPhoneExt' => 'Phone Ext',
			'shipperFax' => 'Fax',
			'shipperTelex' => 'Telex',
			'shipperEmail' => 'Email',
			'xmlRequest' => 'Xml Request',
			'xmlResponse' => 'Xml Response',
			'waybill' => 'Waybill',
			'barcode1' => 'Barcode1',
			'barcode2' => 'Barcode2',
			'barcode3' => 'Barcode3',
		);
	}

	/**
	 * Retrieves a list of findimodels based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('userId', $this->userId);
		$criteria->compare('company_id', $this->company_id);
		$criteria->compare('consigneeCompanyName', $this->consigneeCompanyName, true);
		$criteria->compare('consigneeAddress', $this->consigneeAddress, true);
		$criteria->compare('consigneeCity', $this->consigneeCity, true);
		$criteria->compare('consigneePostalCode', $this->consigneePostalCode, true);
		$criteria->compare('consigneeCountryCode', $this->consigneeCountryCode, true);
		$criteria->compare('consigneeCountryName', $this->consigneeCountryName, true);
		$criteria->compare('consigneePersonName', $this->consigneePersonName, true);
		$criteria->compare('consigneePhoneNumber', $this->consigneePhoneNumber, true);
		$criteria->compare('consigneePhoneExt', $this->consigneePhoneExt, true);
		$criteria->compare('consigneeFax', $this->consigneeFax, true);
		$criteria->compare('consigneeTelex', $this->consigneeTelex, true);
		$criteria->compare('consigneeEmail', $this->consigneeEmail, true);
		$criteria->compare('numberOfPieces', $this->numberOfPieces);
		$criteria->compare('pieceId', $this->pieceId, true);
		$criteria->compare('piecePackageType', $this->piecePackageType);
		$criteria->compare('pieceWeight', $this->pieceWeight, true);
		$criteria->compare('packageType', $this->packageType, true);
		$criteria->compare('shipmentWeight', $this->shipmentWeight, true);
		$criteria->compare('shipperCompanyName', $this->shipperCompanyName, true);
		$criteria->compare('shipperAddress', $this->shipperAddress, true);
		$criteria->compare('shipperCity', $this->shipperCity, true);
		$criteria->compare('shipperPostalCode', $this->shipperPostalCode, true);
		$criteria->compare('shipperCountryCode', $this->shipperCountryCode, true);
		$criteria->compare('shipperCountryName', $this->shipperCountryName, true);
		$criteria->compare('shipperPersonName', $this->shipperPersonName, true);
		$criteria->compare('shipperPhoneNumber', $this->shipperPhoneNumber, true);
		$criteria->compare('shipperPhoneExt', $this->shipperPhoneExt, true);
		$criteria->compare('shipperFax', $this->shipperFax, true);
		$criteria->compare('shipperTelex', $this->shipperTelex, true);
		$criteria->compare('shipperEmail', $this->shipperEmail, true);
		$criteria->compare('xmlRequest', $this->xmlRequest, true);
		$criteria->compare('xmlResponse', $this->xmlResponse, true);
		$criteria->compare('waybill', $this->waybill, true);
		$criteria->compare('barcode1', $this->barcode1, true);
		$criteria->compare('barcode2', $this->barcode2, true);
		$criteria->compare('barcode3', $this->barcode3, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function beforeSave()
	{
		$arrContry = $this->countryList();
		$this->consigneeCountryName = $arrContry[$this->consigneeCountryCode];
		$this->shipperCountryName = $arrContry[$this->shipperCountryCode];
		return parent::beforeSave();
	}
	
	public function afterSave()
	{
		if(!$this->isNewRecord)
		{
			if($this->getScenario() == 'createWaybill')
			{
				$transaction =  new Transaction;
				$transaction->company_id = $this->company_id;
				$transaction->shipmentId = $this->id;
				$transaction->charges = $this->upCharge;
				$transaction->created = time();
				if(!$transaction->save(false))
					throw new CException(400, 'There is an error, please contact your administrator');
			}
		}
		return parent::afterSave();
	}

	public function countryList()
	{
		return $this->regionAm + $this->regionAp + $this->regionEa;
	}

	public function generateXmlRequest()
	{
		$xmlConf = XmlConfig::model()->findByPk(XmlConfig::USED_CONF);
	
		$current_time = time();
		$this->xmlObj = simplexml_load_file(Yii::app()->basePath . '/data/XmlRequest.xml');

		$this->xmlObj->Request->ServiceHeader->SiteID = $xmlConf->siteID;
		$this->xmlObj->Request->ServiceHeader->Password = $xmlConf->password;
		$this->xmlObj->Request->ServiceHeader->MessageTime = date('c', $current_time);
		$this->xmlObj->Request->ServiceHeader->MessageReference = $xmlConf->mref();
		$this->xmlObj->Reference->ReferenceID = $this->id;
		
		$this->xmlObj->Billing->ShipperAccountNumber = $xmlConf->shipperAccountNumber;
		$this->xmlObj->Billing->ShippingPaymentType = $xmlConf->shippingPaymentType;
		$this->xmlObj->Billing->BillingAccountNumber = $xmlConf->billingAccountNumber;
		$this->xmlObj->Billing->DutyPaymentType = $xmlConf->dutyPaymentType;
		//Consignee Data
		$this->xmlObj->Consignee->CompanyName = $this->consigneeCompanyName;
		$this->xmlObj->Consignee->AddressLine[0] = $this->consigneeAddress;
		$this->xmlObj->Consignee->City = $this->consigneeCity;
		$this->xmlObj->Consignee->PostalCode = $this->consigneePostalCode;
		$this->xmlObj->Consignee->CountryCode = $this->consigneeCountryCode;
		$this->xmlObj->Consignee->CountryName = $this->consigneeCountryName;
		$this->xmlObj->Consignee->Contact->PersonName = $this->consigneePersonName;
		$this->xmlObj->Consignee->Contact->PhoneNumber = $this->consigneePhoneNumber;
		$this->xmlObj->Consignee->Contact->PhoneExtension = is_numeric($this->consigneePhoneExt) ? $this->consigneePhoneExt : 2222;
		$this->xmlObj->Consignee->Contact->FaxNumber = is_numeric($this->consigneeFax) ? $this->consigneeFax : 2222222222;
		$this->xmlObj->Consignee->Contact->Telex = is_numeric($this->consigneeTelex) ? $this->consigneeTelex : 2222222222;
		$this->xmlObj->Consignee->Contact->Email->From = $this->consigneeEmail;
		$this->xmlObj->Consignee->Contact->Email->To = $this->consigneeEmail;
		//Shipper
		$this->xmlObj->Shipper->CompanyName = $this->shipperCompanyName;
		$this->xmlObj->Shipper->AddressLine[0] = $this->shipperAddress;
		$this->xmlObj->Shipper->City = $this->shipperCity;
		$this->xmlObj->Shipper->PostalCode = $this->shipperPostalCode;
		$this->xmlObj->Shipper->CountryCode = $this->shipperCountryCode;
		$this->xmlObj->Shipper->CountryName = $this->shipperCountryName;
		$this->xmlObj->Shipper->Contact->PersonName = $this->shipperPersonName;
		$this->xmlObj->Shipper->Contact->PhoneNumber = $this->shipperPhoneNumber;
		$this->xmlObj->Shipper->Contact->PhoneExtension = is_numeric($this->shipperPhoneExt) ? $this->shipperPhoneExt : 2222;
		$this->xmlObj->Shipper->Contact->FaxNumber = is_numeric($this->shipperFax) ? $this->shipperFax : 2222222222;
		$this->xmlObj->Shipper->Contact->Telex = is_numeric($this->shipperTelex) ? $this->shipperTelex : 2222222222;
		$this->xmlObj->Shipper->Contact->Email->From = $this->shipperEmail;
		$this->xmlObj->Shipper->Contact->Email->To = $this->shipperEmail;
		$this->xmlObj->ShipmentDetails->Date = date('Y-m-d', $current_time);
		//Shipment
		$this->xmlObj->ShipmentDetails->GlobalProductCode = $this->productCode;
		$this->xmlObj->ShipmentDetails->LocalProductCode = $this->productCode;
		
		$event = new CreateXmlRequestEvent($this);
		$event->model =$this;
		
		$this->onCreateWaybill($event);
		
		return $event->isValid;
	}
	
	public function onCreateWaybill($event)
	{
		$this->raiseEvent('onCreateWaybill', $event);
	}

	public function generatePdf()
	{
		set_time_limit(1200);
		
		$xmlResponse = simplexml_load_string($this->xmlResponse);
		$fileName = dirname(Yii::app()->basePath) . '/pdf/waybill.pdf';

		$pdf = new Zend_Pdf();

		$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
		$width = $page->getWidth(); // A4 : 595
		$height = $page->getHeight(); // A4 : 842
		$imagePath = dirname(Yii::app()->basePath) . '/pdf/invoice.png';
		$image = Zend_Pdf_Image::imageWithPath($imagePath);
		$page->drawImage($image, 300, 150, 550, 835);

		$page = $this->contentPdf($page, $this, $xmlResponse);

		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA_BOLD);
		$page->setFont($font, 8);
		$page->drawText($xmlResponse->ProductShortName, 314, 805, 'UTF-8');
		$page->setFont($font, 6);
		$page->drawText('XML PI v4.0', 314, 799, 'UTF-8');

		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);
		$page->setFont($font, 5);
		$page->drawText('Order #' . $this->id, 314, 597, 'UTF-8');
		$page->drawText('Piece Weight:', 420, 597, 'UTF-8');

		$barcode_binary = base64_decode($xmlResponse->Barcodes->AWBBarCode);
		$tmp_dir = dirname(__FILE__) . '/temp';
		$png_file = tempnam($tmp_dir, 'foo') . '.png';
		file_put_contents($png_file, $barcode_binary);
		$image = Zend_Pdf_Image::imageWithPath($png_file);
		$page->drawImage($image, 320, 500, 480, 550);

		$barcode_binary = base64_decode($xmlResponse->Barcodes->OriginDestnBarcode);
		// Temporary dir
		$tmp_dir = dirname(__FILE__) . '/temp';
		$png_file = tempnam($tmp_dir, 'foo') . '.png';
		file_put_contents($png_file, $barcode_binary);
		$image = Zend_Pdf_Image::imageWithPath($png_file);
		$page->drawImage($image, 320, 440, 520, 490);

		$barcode_binary = base64_decode($xmlResponse->Barcodes->DHLRoutingBarCode);
		$tmp_dir = dirname(__FILE__) . '/temp';
		$png_file = tempnam($tmp_dir, 'foo') . '.png';
		file_put_contents($png_file, $barcode_binary);
		$image = Zend_Pdf_Image::imageWithPath($png_file);
		$page->drawImage($image, 320, 380, 520, 430);

		$page->setFont($font, 8);
		$page->drawText('WAYBILL ' . $xmlResponse->AirwayBillNumber, 380, 493, 'UTF-8');
		$page->drawText('(2L) ' . $xmlResponse->DHLRoutingCode, 380, 433, 'UTF-8');
		$page->drawText('(J) ' . $xmlResponse->Pieces->Piece->LicensePlate, 380, 370, 'UTF-8');

		//colomn 7
		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);
		$page->setFont($font, 5);
		$page->drawText('Content: ' . $xmlResponse->Contents, 314, 570, 'UTF-8');

		$imagePath = dirname(Yii::app()->basePath) . '/pdf/label1.png';
		$image = Zend_Pdf_Image::imageWithPath($imagePath);
		$page->drawImage($image, 0, 500, 23, 750);
		$pdf->pages[] = $page;

		// ARCIVE
		$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
		$width = $page->getWidth(); // A4 : 595
		$height = $page->getHeight(); // A4 : 842
		$imagePath = dirname(Yii::app()->basePath) . '/pdf/invoice2.png';
		$image = Zend_Pdf_Image::imageWithPath($imagePath);
		$page->drawImage($image, 300, 150, 550, 835);

		$page = $this->contentPdf($page, $this, $xmlResponse);
		$page = $this->contentPdf($page, $this, $xmlResponse);
		$imagePath = dirname(Yii::app()->basePath) . '/pdf/label2.png';
		$image = Zend_Pdf_Image::imageWithPath($imagePath);
		$page->drawImage($image, 0, 500, 23, 750);

		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA_BOLD);
		$page->setFont($font, 8);
		$page->drawText('*ARCHIVE DOC*', 314, 805, 'UTF-8');
		$page->setFont($font, 6);
		$page->drawText('Do not attach to package', 314, 799, 'UTF-8');

		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);
		$page->setFont($font, 5);
		$page->drawText('Order #' . $this->id, 314, 597, 'UTF-8');
		$page->drawText('Shipment Weight:', 411, 597, 'UTF-8');

		$barcode_binary = base64_decode($xmlResponse->Barcodes->AWBBarCode);
		$tmp_dir = dirname(__FILE__) . '/temp';
		$png_file = tempnam($tmp_dir, 'foo') . '.png';
		file_put_contents($png_file, $barcode_binary);
		$image = Zend_Pdf_Image::imageWithPath($png_file);
		$page->drawImage($image, 320, 500, 480, 550);

		$page->setFont($font, 8);
		$page->drawText('WAYBILL ' . $xmlResponse->AirwayBillNumber, 380, 493, 'UTF-8');

		//colomn 7
		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);
		$page->setFont($font, 5);
		$page->drawText('DHL standard Terms and Conditions apply. Warsaw convention may olso apply.', 314, 570, 'UTF-8');
		$page->drawText('Shipment may be carried via intermediated stopping places DHL deems appropriate.', 314, 565, 'UTF-8');
		$page->drawText('Content: ' . $xmlResponse->Contents, 314, 560, 'UTF-8');

		$page->setFont($font, 6);
		$page->drawText('Product                   : ' . $xmlResponse->GlobalProductCode . ' ' . $xmlResponse->ProductShortName, 314, 462, 'UTF-8');
		$page->drawText('Service                   : ', 314, 456, 'UTF-8');
		$page->drawText('DTP Account No     : ', 314, 450, 'UTF-8');
		$page->drawText('Insurance value      : ' . $xmlResponse->InsuredAmount, 314, 444, 'UTF-8');
		$page->drawText('Declared Value       : ' . $xmlResponse->Dutiable->DeclaredValue . ' ' . $xmlResponse->Dutiable->DeclaredCurrency, 314, 438, 'UTF-8');
		$page->drawText('Terms of Trade       : ' . $xmlResponse->Dutiable->TermsofTrade, 314, 432, 'UTF-8');

		$page->drawText('Licence plates of Pieces in Shipment : ', 314, 410, 'UTF-8');
		$page->drawText('-(' . $xmlResponse->Pieces->Piece->DataIdentifier . ')' . $this->spacepablic($xmlResponse->Pieces->Piece->LicensePlate), 314, 403, 'UTF-8');

		$pdf->pages[] = $page;
		$fileName = $xmlResponse->AirwayBillNumber . '.pdf';

		header('Content-type: application/x-pdf');
		header('Content-Disposition: inline; filename="' . $fileName . '"');
		header('filename: ' . $fileName);
		echo $pdf->render();
		return $pdf->render();
	}

	public function contentPdf($page, $model, $xmlResponse)
	{
		//header
		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA_BOLD);
		$page->setFillColor(Zend_Pdf_Color_Html::color('#FFFFFF'));
		$page->setFont($font, 15);
		$page->drawText($xmlResponse->ProductContentCode, 425, 805, 'UTF-8');

		//From
		$page->setFillColor(Zend_Pdf_Color_Html::color('#000000'));
		$page->setFont($font, 7);
		$page->drawText('From :', 314, 784, 'UTF-8');
		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);
		$page->setFont($font, 6);
		$page->drawText($xmlResponse->Shipper->CompanyName, 340, 784, 'UTF-8');
		$page->drawText($xmlResponse->Shipper->Contact->PersonName, 340, 778, 'UTF-8');
		$page->drawText($xmlResponse->Shipper->AddressLine[0], 340, 772, 'UTF-8');
		$page->drawText($xmlResponse->Shipper->AddressLine[1], 340, 766, 'UTF-8');
		$page->drawText('Ph:' . $xmlResponse->Shipper->Contact->PhoneNumber, 440, 766, 'UTF-8');
		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA_BOLD);
		$page->setFont($font, 7);
		$page->drawText($xmlResponse->Shipper->City . ' ' . $xmlResponse->Shipper->DivisionCode . ' ' . $xmlResponse->Shipper->PostalCode, 340, 754, 'UTF-8');
		$page->drawText($xmlResponse->Shipper->CountryName, 340, 746, 'UTF-8');
		$page->drawText($xmlResponse->OriginServiceArea->ServiceAreaCode, 510, 770, 'UTF-8');
		$page->drawText('Origin :', 510, 780, 'UTF-8');

		//To
		$page->setFont($font, 9);
		$page->drawText('To :', 314, 728, 'UTF-8');
		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);
		$page->setFont($font, 8);
		$page->drawText($xmlResponse->Consignee->CompanyName, 337, 728, 'UTF-8');
		$page->drawText($xmlResponse->Consignee->Contact->PersonName, 337, 718, 'UTF-8');
		$page->drawText($xmlResponse->Consignee->AddressLine[0], 337, 708, 'UTF-8');
		$page->drawText($xmlResponse->Consignee->AddressLine[1], 337, 698, 'UTF-8');
		$page->drawText('Ph:' . $xmlResponse->Consignee->Contact->PhoneNumber, 440, 728, 'UTF-8');
		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA_BOLD);
		$page->setFont($font, 10);
		$page->drawText($xmlResponse->Consignee->City . ' ' . $xmlResponse->Consignee->DivisionCode . ' ' . $xmlResponse->Consignee->PostalCode, 337, 680, 'UTF-8');
		$page->drawText($xmlResponse->Consignee->CountryName, 337, 670, 'UTF-8');

		//colomn 4
		$page->drawText($xmlResponse->OriginServiceArea->OutboundSortCode, 314, 640, 'UTF-8');
		$page->setFont($font, 13);
		$page->drawText($xmlResponse->Consignee->CountryCode . '-' . $xmlResponse->DestinationServiceArea->ServiceAreaCode . '-' . $xmlResponse->DestinationServiceArea->FacilityCode, 380, 640, 'UTF-8');
		$page->setFont($font, 10);
		$page->drawText($xmlResponse->DestinationServiceArea->InboundSortCode, 520, 640, 'UTF-8');

		//colomn 5
		$page->setFont($font, 18);
		$page->setFillColor(Zend_Pdf_Color_Html::color('#FFFFFF'));
		$page->drawText($xmlResponse->InternalServiceCode, 314, 611, 'UTF-8');
		$page->setFillColor(Zend_Pdf_Color_Html::color('#000000'));
		$page->setFont($font, 8);
		$page->drawText($xmlResponse->DeliveryDateCode, 497, 608, 'UTF-8');
		$page->drawText($xmlResponse->DeliveryTimeCode, 520, 608, 'UTF-8');
		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);
		$page->setFont($font, 8);
		$page->drawText('Day', 497, 618, 'UTF-8');
		$page->drawText('Time', 515, 618, 'UTF-8');

		//colomn 6
		$page->setFont($font, 5);
		$page->drawText('Date', 420, 584, 'UTF-8');
		$page->drawText('Piece:', 507, 597, 'UTF-8');
		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA_BOLD);
		$page->setFont($font, 6);
		$page->drawText($xmlResponse->Pieces->Piece->Weight . ' Kg', 453, 597, 'UTF-8');
		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);
		$page->setFont($font, 6);
		$page->drawText($xmlResponse->ShipmentDate, 434, 584, 'UTF-8');
		$font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA_BOLD);
		$page->setFont($font, 12);
		$page->drawText('1/1', 507, 585, 'UTF-8');

		return $page;
	}

	public function spacepablic($str)
	{
		$n = '';
		$read = str_split($str, 4);
		foreach ($read as $r)
		{
			$n .= $r . ' ';
		}
		return $n;
	}
}