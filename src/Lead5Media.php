<?php

namespace Bcismariu\Lead5Media;

use GuzzleHttp;

class Lead5Media
{
    protected $base_url = 'http://api.l5srv.net/job_search/api/direct_email/find_jobs.srv';

    protected $method_map = [
        'setCid'    => 'CID',
        'setChid'    => 'CHID',
        'setQuery'    => 'q',
        'setLocation'    => 'l',
        'setRadius'    => 'r',
        'setStart'    => 'start',
        'setLimit'    => 'limit',
        'setFormat'    => 'format',
        'setHighlight'    => 'highlight',
        'setSorting'    => 's',
        'setAge'        => 'a',
    ];

    protected $query_parameters = [
        'CID'        => null,
        'CHID'        => null,
        'format'    => 'json',
        'q'            => null,
        'l'            => null,
        'r'            => null,
        'start'        => 0,
        'limit'        => 10,
        'highlight'    => 'off',
        's'            => 'relevance',
        'a'            => null,
    ];

    protected $client;

    public function __construct($cid, GuzzleHttp\ClientInterface $client = null)
    {
        $this->setCid($cid);

        if (!$client) {
            $client = new GuzzleHttp\Client();
        }
        $this->client = $client;
    }

    /**
     * magic method to set query parameters
     * @param  string $method     
     * @param  array $parameters 
     * @return self
     */
    public function __call($method, $parameters)
    {
        if (!isset($this->method_map[$method])) {
            throw new Exception('Method not allowed: ' . $method);
        }
        return $this->setQueryParameter($this->method_map[$method], $parameters[0]);
    }

    /**
     * retrieves the results from the L5M api
     * @return array [JobResult, ...]
     */
    public function get($limit = 0)
    {
        if ($limit) {
            $this->setLimit($limit);
        }
        return $this->getResults();
    }

    /**
     * Calls the Lead5Meadia API and returns the results
     * @return array
     */
    protected function getResults()
    {
        $payload = $this->client->request('GET', $this->base_url, [
            'query' => $this->getQueryParameters(),
        ]);

        $response = utf8_encode(trim($payload->getBody()->getContents()));
        $results = json_decode($response);

        if (!$this->resultsAreValid($results)) {
            throw new Exception('Lead5Media Results are not valid: ' . $response);
        }
        return $results;
    }

    /**
     * Validates the results format
     * @param  $results
     * @return boolean
     */
    protected function resultsAreValid($results)
    {
        return is_array($results)
            && isset($results[0])
            && isset($results[0]->response)
            && is_object($results[0]->response)
            && isset($results[0]->response->results)
            && is_array($results[0]->response->results)
        ;
    }

    /**
     * returns the query parameters
     * @return array 
     */
    public function getQueryParameters()
    {
        return $this->query_parameters;
    }

    /**
     * Sets a query paramaeter
     * @param string $key
     * @param mixed $value
     * @return  self
     */
    protected function setQueryParameter($key, $value)
    {
        if (array_key_exists($key, $this->query_parameters)) {
            $this->query_parameters[$key] = $value;
        }
        return $this;
    }
}
