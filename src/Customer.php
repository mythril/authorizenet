<?php

namespace Mythril\AuthorizeNet;

class Customer implements Details {
	protected $email;
	
	function email($email) {
		$this->email = $email;
		return $this;
	}

	public function getFieldName() {
		return 'customer';
	}
	
	public function getData() {
		return array(
			'email' => $this->email
		);
	}
}
