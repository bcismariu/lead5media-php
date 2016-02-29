<?php

namespace Bcismariu\Lead5Media;

use GuzzleHttp;

class Lead5Media
{
	protected $base_url = 'http://api.l5srv.net/job_search/api/direct_email/find_jobs.srv';

	protected $method_map = [
		'setCid'	=> 'CID',
		'setQuery'	=> 'q',
		'setLocation'	=> 'l',
		'setRadius'	=> 'r',
		'setStart'	=> 'start',
		'setLimit'	=> 'limit',
		'setFormat'	=> 'format',
	];

	protected $query_parameters = [
		'CID'		=> null,
		'format'	=> 'json',
		'q'			=> null,
		'l'			=> null,
		'r'			=> null,
		'start'		=> 0,
		'limit'		=> 10
	];

	protected $client;

	public function __construct($cid)
	{
		$this->setCid($cid);
		$this->client = new GuzzleHttp\Client();
	}

	public function get()
	{
		$response = $this->request();
		return json_decode(utf8_encode(trim($response->getBody()->getContents())));
	}

	public function setQuery($query)
	{
		return $this->setQueryParameter('q', $query);
	}

	public function setLocation($location)
	{
		return $this->setQueryParameter('l', $location);
	}

	public function setRadius($radius)
	{
		return $this->setQueryParameter('j', $radius);
	}
	
	public function setStart($start)
	{
		return $this->setQueryParameter('start', $start);
	}

	public function setLimit($limit)
	{
		return $this->setQueryParameter('limit', $limit);
	}

	public function setFormat($format)
	{
		return $this->setQueryParameter('format', $format);
	}

	public function getQueryParameters()
	{
		return $this->query_parameters;
	}

	protected function setCid($cid)
	{
		$this->setQueryParameter('CID', $cid);
	}

	protected function setQueryParameter($key, $value)
	{
		if (array_key_exists($key, $this->query_parameters)) {
			$this->query_parameters[$key] = $value;
		}
		return $this;
	}

	private function request()
	{
		return $this->client->request('GET', $this->base_url, [
				'query'	=> $this->getQueryParameters(),
			]);
	}

}
