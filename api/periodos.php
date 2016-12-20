<?php

/**
 * This class is responsible for sign up, sign in and logout.
 *
 * @copyright Copyright (c) 2014, Felipe Lunardi Farias <ffarias.dev@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
require '../database/periodoData.php';

class periodos extends Rest implements interfaceApi {

    /** @var string|null Should contain the name of this class. */
    public $class = null;

    /** @var string|null Should contain a method of this API (users). */
    public $method = null;

    public function __construct($class, $method) {

        parent::__construct();

        $this->class = $class;
        $this->method = $method;
    }

    /**
     * A simple response for this API
     * @param $status  status (error, success)
     * @param $message message/response
     * @param $code    HTTP status codes (200, 201, 204, 404, 406)
     * @param $data    
     * @return object array (for test) or json (for javascript response)
     */
    public function responseAPI($status, $message, $code, $data = array()) {

        $responseApi = json_encode(array(
            "status" => $status,
            "api" => "$this->class|$this->method",
            "message" => $message,
            "data" => $data
        ));

        if (!$this->is_test) {
            $this->response($responseApi, $code);
        } else {
            return $responseApi;
        }
    }

    public function get() {
        $data = periodoData::getActual();
        return $this->responseAPI("success", "get success!", 200, $data);
    }

    public function getAll() {
        $data = periodoData::getAll();
        return $this->responseAPI("success", "get success!", 200, $data);
    }

    public function add() {

        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);
        
        $aux = new DateTime($body['date1']['startDate']);
        $body['date1']['startDate'] = $aux->format("Y-m-d H:i:s");
        $aux = new DateTime($body['date1']['endDate']);
        $body['date1']['endDate'] = $aux->format("Y-m-d H:i:s");
        $aux = new DateTime($body['date1']['startDate']);
        $body['date2']['startDate'] = $aux->format("Y-m-d H:i:s");
        $aux = new DateTime($body['date1']['endDate']);
        $body['date2']['endDate'] = $aux->format("Y-m-d H:i:s");
        $aux = new DateTime($body['date1']['startDate']);
        $body['date3']['startDate'] = $aux->format("Y-m-d H:i:s");
        $aux = new DateTime($body['date1']['endDate']);
        $body['date3']['endDate'] = $aux->format("Y-m-d H:i:s");
        
        $data = periodoData::insert(2, $body['date1']['startDate'], $body['date1']['endDate'], $body['nombre'], $body['date2']['startDate'], $body['date2']['endDate'], $body['date3']['startDate'], $body['date3']['endDate']);
        if ($data === true) {
            return $this->responseAPI("success", "add success", 200);
        }
        return $this->responseAPI("error", "", 200);
    }

    public function set() {

        if ($this->get_request_method() != "PUT") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $id = $body['id'];

        $data = notificacionData::update($id);
        if ($data === true) {
            return $this->responseAPI("success", "set success", 200);
        }
        return $this->responseAPI("error", $data, 200);
    }

    public function __destruct() {
        return true;
    }

}
