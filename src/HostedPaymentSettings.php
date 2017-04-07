<?php

namespace Mythril\AuthorizeNet;

class HostedPaymentSettings implements Details {
	protected $settings = array(
		'hostedPaymentBillingAddressOptions' => array(),
		'hostedPaymentButtonOptions' => array(),
		'hostedPaymentCustomerOptions' => array(),
		'hostedPaymentPaymentOptions' => array(),
		'hostedPaymentReturnOptions' => array(),
		'hostedPaymentSecurityOptions' => array(),
		'hostedPaymentShippingAddressOptions' => array(),
		'hostedPaymentStyleOptions' => array(),
	);

	public function showBillingAddress($param) {
		$this->settings['hostedPaymentBillingAddressOptions']['show'] = !!$param;
		return $this;
	}
	public function requireBillingAddress($param) {
		$this->settings['hostedPaymentBillingAddressOptions']['required'] = !!$param;
		return $this;
	}
	public function buttonText($param) {
		$this->settings['hostedPaymentButtonOptions']['text'] = $param;
		return $this;
	}
	public function showEmail($param) {
		$this->settings['hostedPaymentCustomerOptions']['showEmail'] = !!$param;
		return $this;
	}
	public function requireEmail($param) {
		$this->settings['hostedPaymentCustomerOptions']['requiredEmail'] = !!$param;
		return $this;
	}
	public function requireCardCode($param) {
		$this->settings['hostedPaymentPaymentOptions']['cardCodeRequired'] = !!$param;
		return $this;
	}
	public function returnUrl($param) {
		$this->settings['hostedPaymentReturnOptions']['url'] = $param;
		return $this;
	}
	public function returnUrlText($param) {
		$this->settings['hostedPaymentReturnOptions']['urlText'] = $param;
		return $this;
	}
	public function cancelUrl($param) {
		$this->settings['hostedPaymentReturnOptions']['cancelUrl'] = $param;
		return $this;
	}
	public function cancelText($param) {
		$this->settings['hostedPaymentReturnOptions']['cancelUrlText'] = $param;
		return $this;
	}
	public function useCaptcha($param) {
		$this->settings['hostedPaymentSecurityOptions']['captcha'] = !!$param;
		return $this;
	}
	public function showShippingAddress($param) {
		$this->settings['hostedPaymentShippingAddressOptions']['show'] = !!$param;
		return $this;
	}
	public function requireShippingAddress($param) {
		$this->settings['hostedPaymentShippingAddressOptions']['required'] = !!$param;
		return $this;
	}
	public function bgColor($param) {
		$this->settings['hostedPaymentStyleOptions']['bgColor'] = $param;
		return $this;
	}

	public function getFieldName() {
		return 'hostedPaymentSettings';
	}

	public function getData() {
		$setting = array();

		foreach ($this->settings as $settingName => $v) {
			$setting[] = array(
				'settingName' => $settingName,
				'settingValue' => json_encode($v),
			);
		}

		return array(
			'setting' => $setting,
		);
	}
}