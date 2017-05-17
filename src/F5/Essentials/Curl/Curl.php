<?php


namespace F5\Essentials\Curl;


/**
 * @author Daniel Bonatti <daniel@f5sg.com.br>
 */
class Curl {


	/**
	 * get data of $url by Curl
	 * @param type $url 
	 * @return String
	 */
	public static function getData($url) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);
		$data = curl_exec($ch);

		curl_close($ch);

		return $data;
	}
	

}