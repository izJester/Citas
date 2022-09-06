<?php

namespace App\Classes;

use App\Classes\IpgBdvCheckPaymentResponse;
use App\Classes\IpgBdvPaymentRequest;
use App\Classes\IpgBdvPaymentResponse;

class IpgBdv
{

	private $urlApi = 'https://biodemo.ex-cle.com:4443/ipg/web/api/Payment';

	function __construct($user1,$pass1){
		$this->user = $user1;
		$this->pass = $pass1;
		$this->messages = array(
				"0" => "Operación efectuada correctamente",
				"1" => "Request NO válido, verifique el formato con la documentación",
				"2" => "Parámetro 'letter' NO válido, valores permitidos V,E,P,J,G",
				"3" => "Parámetro 'number' NO válido",
				"4" => "Parámetro 'currency' NO válido, valores permitidos 1 (Bs.) o 2 (USD)",
				"5" => "Parámetro 'title' NO válido",
				"6" => "Parámetro 'reference' NO válido",
				"7" => "Parámetro 'amount' NO válido",
				"8" => "Cuenta suspendida",
				"9" => "Pago no encontrado",
				"99" => "Ha ocurrido un error en el servidor",
				"401" => "Usuario y/o clave incorrectos",
				"404" => "No se pudo conectar con el servidor BDV",
				"500" => "Ha ocurrido un error en el servidor BDV"
			);
	}
	
	public function checkPayment($paymentToken) {
		$curl = curl_init();

		$headers = [
			'Content-Type: application/json'
		];
		
		$url = $this->urlApi."/".$paymentToken;
		
		// Setear opciones, usuario y contraseña
		curl_setopt_array($curl, array(
			CURLOPT_HTTPHEADER=> $headers,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_USERAGENT => 'IPG',
			CURLOPT_HTTPGET => TRUE,
			//CURLOPT_POSTFIELDS => $str_data,
			CURLOPT_HTTPAUTH=> CURLAUTH_ANY,
			CURLOPT_TIMEOUT=> 5,
			CURLOPT_USERPWD=> "$this->user:$this->pass"
		));

		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		
		$response = new IpgBdvCheckPaymentResponse();
		$resp = curl_exec($curl);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		if ($httpcode == 200)
		{
			$auxResp = json_decode($resp); // Json decode response
			
			$response->responseCode = $auxResp->responseCode;			

			if ($auxResp->responseCode == 0)
			{
				$response->status = $auxResp->status;			
				$response->success = true;				
				$response->idLetter = $auxResp->letter;
	 			$response->idNumber = $auxResp->number;
	 			$response->amount = $auxResp->amount;
	 			$response->currency = $auxResp->currency;
	 			$response->reference = $auxResp->reference;
	 			$response->title = $auxResp->title;
	 			$response->description = $auxResp->description;
				$response->token = $auxResp->token;
				$response->transactionId = $auxResp->transactionId;
				$response->paymentMethodCode = $auxResp->paymentMethodCode;
				$response->paymentMethodDescription = $auxResp->paymentMethodDescription;
				$response->authorizationCode = $auxResp->authorizationCode;
				$response->paymentMethodNumber = $auxResp->paymentMethodNumber;
				$response->paymentDate = $auxResp->paymentDate;

			}
			else
			{
				$response->success = false;
			}
		}
		else if( $httpcode == 401 )  
		{ 
			$response->responseCode = 401;
			$response->success = false;
		} 
		else if( $httpcode == 500 )  
		{ 
			$response->responseCode = 500;
			$response->success = false;
		} 
		else
		{ 
			$response->responseCode = 404;
			$response->success = false;
		} 
		
		$response->responseMessage = $this->getMessageDescription($response->responseCode);
		
		curl_close($curl); // cerrar el request para liberar recursos
				
		return $response;

		curl_close($curl); // cerrar el request para liberar recursos	

		return $resp;
	}
	
	// métodos
    public function createPayment($paymentRequest) {
			
		$curl = curl_init();

		$headers = [
			'Content-Type: application/json'
		];		
	
		$data = array(
				"currency" => $paymentRequest->currency,
				"amount" => $paymentRequest->amount,
				"reference" => $paymentRequest->reference,
				"title" => $paymentRequest->title,
				"description" => $paymentRequest->description,
				"letter" => $paymentRequest->idLetter,
				"number" => $paymentRequest->idNumber,
				"email" => $paymentRequest->email,
				"cellphone" => $paymentRequest->cellphone,
				"urlToReturn" => $paymentRequest->urlToReturn
			);

		
		$str_data = json_encode($data);
		
		// Setear opciones, usuario y contraseña
		curl_setopt_array($curl, array(
			CURLOPT_HTTPHEADER=> $headers,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $this->urlApi,
			CURLOPT_USERAGENT => 'IPG',
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $str_data,
			CURLOPT_HTTPAUTH=> CURLAUTH_ANY,
			CURLOPT_TIMEOUT=> 5,
			CURLOPT_USERPWD=> "$this->user:$this->pass"
		));

		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			
		$response = new IpgBdvPaymentResponse();
		$resp = curl_exec($curl);
		
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		
		if ($httpcode == 200)
		{
			$auxResp = json_decode($resp); // Json decode response
			
			//echo $resp;
			$response->responseCode = $auxResp->responseCode;
			if ($auxResp->responseCode == 0)
			{
				$response->paymentId =  $auxResp->paymentId;
				$response->urlPayment =  $auxResp->urlPayment;
				$response->success = true;
			}
			else
			{
				$response->success = false;
			}
		}
		else if( $httpcode == 401 )  
		{ 
			$response->responseCode = 401;
			$response->success = false;
		} 
		else if( $httpcode == 500 )  
		{ 
			$response->responseCode = 500;
			$response->success = false;
		} 
		else
		{ 
			$response->responseCode = 404;
			$response->success = false;
		} 
		
		$response->responseMessage = $this->getMessageDescription($response->responseCode);
		
		curl_close($curl); // cerrar el request para liberar recursos
				
		return $response;
    }	
	
	 public function getMessageDescription($code) {
		 return $this->messages[$code];
	 }
}




