<?php

namespace Logistica\Custom;

use Exception;

class FormatCode
{
	public function toShortMode($code)
	{
		//PS1600003
		$code = substr($code, 0, 2).'-'.substr($code, -5);
		return $code;
	}

	public function toNumberMode($oc)
	{
		$code = substr($oc,-5);
		return $code;
	}
}

?>