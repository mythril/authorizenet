<?php

namespace Mythril\AuthorizeNet;

interface APICall{
	public function getPayload(array $credentials);
	public function processResult(array $result);
}
