<?php
namespace MundoCRM\Leads;

use ErrorException;
use GuzzleHttp\Client as ClientHttp;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\SenderInterface;

/**
 * @method LeadsSender send()
 */

class Sender implements SenderInterface
{
    /** @var array Default request options */
    private $data;
    private $host;
    private $query;

    /**
     * If you don't send the country, make sure the cell 
     * phone and phone number get the country code at 
     * the start, otherwise the phone validator might fail.
     */

    function __construct(string $app_key, string $sources_id, array $data, array $items, bool $debug = false){
        /**
         * Default host, check the website if this is updated, 
         * by default the repository might update that.
         */
        $this->host = "https://api.mundocrm.ar/v1/webhook/landing";
        
        // Getting referer url data
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

        //Getting referer ip
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : [];

        // Creating data from the params sent to the constructor.
        $this->data = [
            "app_key" => $app_key,
            "source_id" => $sources_id,
            "fields" => [
                "firstname" => $this->getData("firstname", $data),
                "lastname" => $this->getData("lastname", $data),
                "dni" => $this->getData("dni", $data),
                "email" => $this->getData("email", $data),
                "phone" => $this->getData("phone", $data),
                "cellphone" => $this->getData("cellphone", $data),
                "country" => $this->getData("country", $data),
                "address" => $this->getData("address", $data),
                "state" => $this->getData("state", $data),
                "city" => $this->getData("city", $data),
                "zip" => $this->getData("zip", $data),
                "message" => $this->getData("message", $data),
                "schedule" => $this->getData("schedule", $data),
            ],
            "items" => $items,
            "notes" => "",
            "ip" => $ip,
            "method" => "form",
            "url" => $referer,
        ];

        // Parse, if exist, the utm values fro the url.
        $this->query = $this->parseUtm(parse_url($referer, PHP_URL_QUERY));

        if(count($this->query) > 0) {
            foreach ($this->query as $field_key => $field) {
                if (strpos($field_key, "utm") !== false)
                    $this->data["utm"][str_replace("utm_", "", $field_key)] = $field;
            }
        }

        // Reset demo values if is on test mode. Only for deug.
        if($debug || (isset($_SERVER["SERVER_NAME"]) && ($_SERVER["SERVER_NAME"] == "localhost" || $_SERVER["SERVER_NAME"] == "127.0.0.1"))){
            $this->data["source_id"] = "62004b96eac2ba68c17a86a3";
            $this->data["app_key"] = "8601d871-d1e0-42bf-9d30-e0573cab3963";
            $this->data["ip"] = "186.108.64.200";
            $this->host = "http://api.mundocrm.test/v1/webhook/landing";
        }
    }

    /**
     * @param string $query
     * 
     * @return array strings
     */
    private function parseUtm($query){
        $result = [];
        if($query){
            $values = explode("&", $query);
            foreach($values as $value){
                $val = explode("=", $value);
                $result[$val[0]] = $val[1];
            }
        }

        return $result;
    }

    /**
     * @param array $data
     * @param string $value
     * 
     * @return string value
     */
    private function getData($value, $data){
        return isset($data[$value]) ? $data[$value] : null;
    }

    
    public function send(){
        try{
            $client = new ClientHttp();
            $request = $client->request('POST', $this->host, ['json'=> $this->data]);
            return json_decode($request->getBody());
        } catch (ErrorException $err) {
            http_response_code(500);
            print_r("ErrorException");
            return json_encode(['status' => 'error', 'type' => 'internel_error', 'status_code' => 500, 'message' => "Error interno"]);
        } catch (RequestException $err) {
            $response = $err->getResponse();
            $content = $response->getBody()->getContents();
            http_response_code($err->getCode());
            return json_decode($content);
        }
    }
}