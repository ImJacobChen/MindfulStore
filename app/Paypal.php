<?php

namespace App;

class Paypal {
	/**
	 * Last error message(s)
	 * @var  array
	 */
	protected $_errors = array();

	/**
	 * API Credentials
	 * Use the correct credentials for the environment in use (Live / Sandbox)
	 * @var array
	 */
	protected $_credentials = array(
		'USER' => 'imjacobchen-facilitator_api1.gmail.com',
		'PWD' => '6FST3ZV4KYCVTPVV',
		'SIGNATURE' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31ApfwYMPI.1psinLy0s8eNksZGCie',
	);

	/**
	 * API endpoint
	 * Live -
	 * Sandbox - https://api-3t.sandbox.paypal.com/nvp
	 * @var string
	 */
	protected $_endPoint = 'https://api-3t.sandbox.paypal.com/nvp';

	/**
	 * API Version
	 * @var string
	 */
	protected $_version = '104.0';

	/**
	 * Make API request
	 *
	 * @param string $method string API method to request
	 * @param array $params Additional request parameters
	 * @return array / boolean Response array / boolean false on failure
	 */
	public function request($method, $params = array()){
		$this -> _errors = array();
		if ( empty($method) ) { //Check if API method is not empty
			$this -> _errors = array('API method is missing');
			return false;
		}

		//Our request parameters
		$requestParams = array(
			'METHOD' => $method,
			'VERSION' => $this -> _version
		) + $this -> _credentials;

		//Building our NVP string
		$request = http_build_query($requestParams + $params);

		//cURL settings
		$curlOptions = array(
			CURLOPT_URL => $this -> _endPoint,
			CURLOPT_VERBOSE => 1,
			CURLOPT_SSL_VERIFYPEER => true,
			CURLOPT_SSL_VERIFYHOST => 2,
			CURLOPT_CAINFO => dirname(__FILE__) . '/Certs/cacert.pem', //CA cert file
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $request
		);

		$ch = curl_init();
		curl_setopt_array($ch, $curlOptions);

		//Sending our request - $response will hold the API Response
		$response = curl_exec($ch);

		//Checking for cURL errors
		if (curl_errno($ch)) {
			$this -> _errors = curl_error($ch);
			curl_close($ch);
			echo $this -> _errors;
			return false;
			//Handle errors
		} else {
			curl_close($ch);
			$responseArray = array();
			parse_str($response,$responseArray); //Break the NVP string to an array
			return $responseArray;
		}
	}
}