<?php

namespace Mythril\AuthorizeNet;

class Order implements Details {
	public function getFieldName() {
		return 'order';
	}

	public function getData() {
		return array(
			'invoiceNumber' => 5555
		);
	}
}
