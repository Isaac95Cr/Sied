<?php

/**
 * This class is responsible for sign up, sign in and logout.
 *
 * @copyright Copyright (c) 2014, Felipe Lunardi Farias <ffarias.dev@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
require '../database/metasData.php';

class metas extends Rest implements interfaceApi {

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

    public function all() {
        if ($this->get_request_method() != "POST" && $this->get_request_method() != "GET") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }
        if ($this->get_request_method() == "POST") {
            $body = json_decode(file_get_contents("php://input"), true);
            $id = $body['id'];
            $data = metasData::getAllFromUser($id);
            return $this->responseAPI("success", "get success!", 200, $data);
        } else {
            $data = metasData::getAll();
            return $this->responseAPI("success", "get success!", 200, $data);
        }
        return $this->responseAPI("success", "get success!", 200, $data);
    }

    public function allFrom() {

        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $data = metasData::getAllFrom($body);
        return $this->responseAPI("success", "get success!", 200, $data);
    }

    public function add() {

        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $data = metasData::insert($body['is_Evaluable'], $body['peso'], $body['titulo'], $body['descripcion'], $body['usuario']
        );

        if ($data === true) {
            return $this->responseAPI("success", "add success", 200);
        }
        return $this->responseAPI("error", "", 200);
    }

    public function del() {

        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $data = metasData::delete($body['id']);
        if ($data === true) {
            return $this->responseAPI("success", "del success", 200);
        }
        return $this->responseAPI("error", "", 200);
    }

    public function set() {

        if ($this->get_request_method() != "PUT") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $data = metasData::update($body['is_Evaluable'], $body['titulo'], $body['descripcion'], $body['id']);
        if ($data === true) {
            return $this->responseAPI("success", "set success", 200);
        }
        return $this->responseAPI("error", "", 200);
    }

    public function aprobarMeta() {

        if ($this->get_request_method() != "PUT") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        if ($body['comentario'] !== "") {
            $data = metasData::desaprobarMeta($body['id'], $body['comentario']);
        } else {
            $data = metasData::aprobarMeta($body['id'], $body['comentario']);
        }

        if ($data === true) {
            return $this->responseAPI("success", "set success", 200);
        }
        return $this->responseAPI("error", "", 200);
    }

    public function setEvaluacion() {

        if ($this->get_request_method() != "PUT") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $data = metasData::updateEvaluacion($body);
        if ($data === true) {
            return $this->responseAPI("success", "set success", 200);
        }
        return $this->responseAPI("error", "", 200);
    }
    public function setAuto() {

        if ($this->get_request_method() != "PUT") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);
        $data = metasData::updateAuto($body) ;
        if ($data === true) {
            return $this->responseAPI("success", "set success", 200);
        }
        return $this->responseAPI("error", "", 200);
    }
    
    public function setPeso() {

        if ($this->get_request_method() != "PUT") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $data = metasData::updatePeso($body);
        if ($data === true) {
            return $this->responseAPI("success", "set success", 200);
        }
        return $this->responseAPI("error", "", 200);
    }

    public function __destruct() {
        return true;
    }

}
