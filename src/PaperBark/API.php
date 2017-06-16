<?php

namespace PaperBark;

class API
{
	private $url = 'https://api.paperbark.io/pdf';
	private $token;

	/**
	 * Creates a new PaperBark instance.
	 *
	 * @param string $token
	 */
	public function __construct($token)
	{
		$this->token = $token;
	}

	/**
	 * Create PDF using PaperBark API
	 * @param PDF $pdf
	 * @return string - PDF Document
	 *
	 * @throws \Exception
	 */
	public function pdf($pdf)
	{
		$headers = [
			'Accept-Encoding: gzip, deflate',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token
		];

		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => $this->url,
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_POSTFIELDS => json_encode($pdf->serialize()),
			CURLOPT_USERAGENT => 'PaperBark/SDK (PHP)',
			CURLOPT_HEADER => false,
			CURLOPT_CONNECTTIMEOUT => 10,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_VERBOSE => true,
			CURLOPT_HEADER => true,
			CURLOPT_POST => true,
			CURLOPT_SSL_VERIFYPEER => true,
			CURLOPT_ENCODING => ''
		]);

		$response = curl_exec($ch);
		$success = curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200;
		$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

		curl_close($ch);

		$rawHeaders = substr($response, 0, $headerSize);
		$body = substr($response, $headerSize);

		$headers = [];
		foreach (explode(PHP_EOL, $rawHeaders) as $header) {
			$parts = explode(':', $header, 2);
			$key = isset($parts[0]) ? strtolower(trim($parts[0])) : null;
			$val = isset($parts[1]) ? trim($parts[1]) : null;

			if (!empty($key) && !empty($val))
				$headers[strtolower($key)] = $val;
		}

		if (!$success) {
			$error = null;

			if ($headers['content-type'] === 'application/json') {
				$json = json_decode($body, true);

				if (isset($json['message']))
					$error = $json['message'];
			}

			if ($error !== null)
				throw new \Exception($error);
			else
				throw new \Exception('Unknown error occurred.');
		}

		return $body;
	}
}
