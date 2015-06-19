<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;


class ApiController extends BaseController
{

	protected $statusCode = 200;

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;

		return $this;
	}

	public function responseNotFound($message = 'Not Found!')
	{

		return $this->setStatusCode(404)->respondWithError($message);

	}

	public function responseInternalError($message = 'Not Found!')
	{

		return $this->setStatusCode(500)->respondWithError($message);

	}

	public function respond($data, $headers = [])
	{

		return response()->json($data, $this->getStatusCode(), $headers);

	}

	public function respondWithError($message)
	{
		return $this->respond([
			'error' => [
				'message' 	=> 	$message,
				'code'		=>	$this->getStatusCode()
			]
		]);
	}
}