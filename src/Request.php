<?php

namespace Mythril\AuthorizeNet;

use Exception;

class Request {
	public function post($url, array $data = array()) {
		$c = curl_init();

		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS => json_encode($data),
			CURLOPT_POST => true,
		);

		curl_setopt_array($c, $options);

		$response = curl_exec($c);

		if ($response === false) {
			$code = curl_errno($c);
			$error = curl_error($c);
			curl_close($c);
			throw new Exception("cURL issued an error while trying to contact $url: [$code] $error");
		}

		curl_close($c);

		return $response;
	}
}
