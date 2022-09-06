<?php

namespace App\Classes;

class IpgBdvCheckPaymentResponse
{	
    // propiedades
	public $status;
	public $success;
	public $responseCode;
	public $responseMessage;

	public $idLetter;
	public $idNumber;
	public $amount;
	public $currency;
	public $reference;
	public $title;
	public $description;

	public $token;
	public $transactionId;
	public $paymentMethodCode;
	public $paymentMethodDescription;
	public $authorizationCode;
	public $paymentMethodNumber;
	public $paymentDate;
}