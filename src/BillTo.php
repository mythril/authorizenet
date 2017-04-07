<?php

namespace Mythril\AuthorizeNet;

class BillTo implements Details {
	protected $firstName;
	protected $lastName;
	protected $company;
	protected $address;
	protected $city;
	protected $state;
	protected $zip;
	protected $country;

	public function firstName($firstName) {
		$this->firstName = $firstName;
		return $this;
	}

	public function lastName($lastName) {
		$this->lastName = $lastName;
		return $this;
	}

	public function company($company) {
		$this->company = $company;
		return $this;
	}

	public function address($address) {
		$this->address = $address;
		return $this;
	}

	public function city($city) {
		$this->city = $city;
		return $this;
	}

	public function state($state) {
		$this->state = $state;
		return $this;
	}

	public function zip($zip) {
		$this->zip = $zip;
		return $this;
	}

	public function country($country) {
		$this->country = $country;
		return $this;
	}

	public function getFieldName() {
		return 'billTo';
	}

	public function getData() {
		return array(
			'firstName' => $this->firstName,
			'lastName' => $this->lastName,
			'company' => $this->company,
			'address' => $this->address,
			'city' => $this->city,
			'state' => $this->state,
			'zip' => $this->zip,
			'country' => $this->country,
		);
	}
}
