<?php
use \Guzzle\Service\Description\ServiceDescription;
use \Guzzle\Http\Client;
use \Guzzle\Plugin\Cookie\CookiePlugin;
use \Guzzle\Plugin\Cookie\CookieJar\ArrayCookieJar;

class PushBullet{
    /**
     * @var Guzzle\Service\Client
     */
    protected $client;
    
    protected $errorStrs = array(
                    "400" => "Missing a required paramater",
                    "401" => "No valid API key provided.",
                    "402" => "Parameters were valid but the request failed.",
                    "403" => "The API key is not valid for that request.",
                    "404" => "The requested item doesn't exist.",
                    "5XX" => "something went wrong on PushBullet's side.",
                );

    public function __construct($access_token)
    {
        $headers = array(
            'Accept' => 'application/json',
            'Authorization' => "Bearer {$access_token}"
        );
        
        $url = 'https://api.pushbullet.com/api/';
        
        $this->client = new \Guzzle\Service\Client($url, array(
            //'ssl.certificate_authority' => false,
            'request.options' => array(
                'auth' => array($access_token, ''),
            )
        ));
        
        $description = ServiceDescription::factory(__DIR__.'/service.json');
        $this->client->setDescription($description);
    }
    
    public function __call($name, $arguments = array()){
        try{
            $paramaters = isset($arguments[0]) ? $arguments[0] : array();
            $command = $this->client->getCommand($name, $paramaters);
            $responseModel = $this->client->execute($command);
            return $responseModel;
        } catch (Guzzle\Http\Exception\ClientErrorResponseException $e) {
            $response = $e->getResponse();
            $httpCode = $response->getStatusCode();
            throw new \Exception($this->errorStrs[$httpCode]);
        } catch (Guzzle\Http\Exception\ServerErrorResponseException $e) {
            $response = $e->getResponse();
            $httpCode = $response->getStatusCode();
            throw new \Exception($this->errorStrs["5XX"]);
        }

    }
}

