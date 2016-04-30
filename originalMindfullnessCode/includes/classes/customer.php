<?php

class Customer {
	// Customer delivery details
	protected $fullName;
	protected $emailAddress;
	protected $addressLine1;
	protected $addressLine2;
	protected $townCity;
	protected $county;
	protected $postcode;
	protected $country;
	protected $phoneNumber;
	protected $sameAsBillingAddress;

	public function addDetail($detail, $value) {
		$this->$detail = $value;
	}

	public function getDetail($detail) {
		return $this->$detail;
	}
	public function updateDetail($detail, $newValue) {
		$this->$detail = $newValue;
	}
}