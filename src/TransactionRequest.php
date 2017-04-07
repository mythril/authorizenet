<?php

namespace Mythril\AuthorizeNet;

class TransactionRequest implements Details {
	protected $transactionType;
	protected $amount;
	public function __construct($transactionType, $amount) {
		$this->transactionType = $transactionType;
		$this->amount = $amount;
	}

	protected $deets = array();
	public function add(Details $deets) {
		$this->deets[$deets->getFieldName()] = $deets->getData();
	}

	public function getFieldName() {
		return "transactionRequest";
	}

	public function getData() {
		$data = array(
			'transactionType' => $this->transactionType,
			'amount' => $this->amount,
		);

		foreach ($this->deets as $fieldName => $fData) {
			$data[$fieldName] = $fData;
		}

		return $data;
	}
}
