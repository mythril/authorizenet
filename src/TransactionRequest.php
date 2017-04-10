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

	//... how can such an obvious flaw pass undetected in a financial
	// setting
	protected static $brokenOrdering = array(
		'transactionType',
		'amount',
		'currencyCode',
		'payment',
		'profile',
		'solution',
		'callId',
		'terminalNumber',
		'authCode',
		'refTransId',
		'splitTenderId',
		'order',
		'lineItems',
		'tax',
		'duty',
		'shipping',
		'taxExempt',
		'poNumber',
		'customer',
		'billTo',
		'shipTo',
		'customerIP',
		'cardholderAuthentication',
		'retail',
		'employeeId',
		'transactionSettings',
		'userFields',
	);

	public function getData() {
		$data = array(
			'transactionType' => $this->transactionType,
			'amount' => $this->amount,
		);

		foreach (self::$brokenOrdering as $fieldName) {
			if (!empty($this->deets[$fieldName])) {
				$data[$fieldName] = $this->deets[$fieldName];
			}
		}

		return $data;
	}
}
