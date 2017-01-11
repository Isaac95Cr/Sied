<?php

/**
 * This class is responsible for sign up, sign in and logout.
 *
 * @copyright Copyright (c) 2014, Felipe Lunardi Farias <ffarias.dev@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
require '../database/competenciaData.php';

class competencias extends Rest implements interfaceApi {

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
        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);
        $id = $body['id'];
        $data = competenciaData::getAllFrom($id);

        return $this->responseAPI("success", "get success!", 200, $data);
    }

    public function allFromUser() {
        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);
        $id = $body['id'];

        if (array_key_exists("periodo", $body)) {
            $periodo = $body['periodo'];
            $data = competenciaData::getAllFromUser($id, $periodo);
            return $this->responseAPI("success", "get success!", 200, $data);
        }
        $data = competenciaData::getAllFromUserActual($id);
        return $this->responseAPI("success", "get success!", 200, $data);
    }

    public function add() {

        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);
        $titulo = $body['titulo'];
        $descripcion = $body['descripcion'];
        $perfil = $body['perfil'];

        $data = competenciaData::insert($titulo, $descripcion, $perfil);
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

        $titulo = $body['titulo'];
        $descripcion = $body['descripcion'];
        $id = $body['id'];

        $data = competenciaData::update($titulo, $descripcion, $id);
        if ($data === true) {
            return $this->responseAPI("success", "set success", 200);
        }
        return $this->responseAPI("error", $data, 200);
    }

    public function setPeso() {

        if ($this->get_request_method() != "PUT") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        foreach ($body as $competencia) {
            $data = competenciaData::updatePeso($competencia['peso'], $competencia['id']);
        }

        if ($data === true) {
            return $this->responseAPI("success", "set success", 200);
        }
        return $this->responseAPI("error", $data, 200);
    }

    public function del() {

        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $id = $body['id'];

        $data = competenciaData::delete($id);
        if ($data === true) {
            return $this->responseAPI("success", "del success", 200);
        }
        return $this->responseAPI("error", $data, 200);
    }

    public function __destruct() {
        return true;
    }

}
