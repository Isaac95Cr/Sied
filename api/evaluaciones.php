<?php

/**
 * This class is responsible for sign up, sign in and logout.
 *
 * @copyright Copyright (c) 2014, Felipe Lunardi Farias <ffarias.dev@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
require '../database/evaluacionPeriodoData.php';
require '../database/usuarioData.php';
require '../database/notificacionData.php';

class evaluaciones extends Rest implements interfaceApi {

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

    public function notificacionJefe() {
        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }
        $body = json_decode(file_get_contents("php://input"), true);
        $data = evaluacionPeriodoData::getEvaluacionJefeRHActual($body);  // se comprueba si ya se enviaron notificaciones antes.
        if ($data['aprobacion_j'] !== 1) {
            $data = usuarioData::setNotificacion(13, $body);  // enviar notificacion
            evaluacionPeriodoData::updateAprobacionJefe($body);  // se cambia el aprobacion_j a '1'.
        }
        return $this->responseAPI("success", "get success!", 200, $data);
    }

    public function notificacionRH() {
        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }
        $body = json_decode(file_get_contents("php://input"), true);
        $data = evaluacionPeriodoData::getEvaluacionJefeRHActual($body);  // se comprueba si ya se enviaron notificaciones antes.
        if ($data['aprobacion_rh'] !== 1) {
            $data = usuarioData::setNotificacion(14, $body);  // enviar notificacion
            evaluacionPeriodoData::updateAprobacionRH($body);  // se cambia el aprobacion_j a '1'.
        }
        return $this->responseAPI("success", "get success!", 200, $data);
    }

    public function notificacionAutoMetas() {
        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }
        $body = json_decode(file_get_contents("php://input"), true);
        $data = evaluacionPeriodoData::getEvaluacionJefeRHActual($body);  // se comprueba si ya se enviaron notificaciones antes.
        if ($data['autoev_metas'] !== 1) {
            $jefe = usuarioData::getJefe($body);
            $data = usuarioData::setNotificacion(15, $jefe['jefe']);  // enviar notificacion
            evaluacionPeriodoData::updateAutoEvaMetas($body);  // se cambia el aprobacion_j a '1'.
        }
        return $this->responseAPI("success", "get success!", 200, $data);
    }

    public function notificacionAutoCompetencias() {
        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }
        $body = json_decode(file_get_contents("php://input"), true);
        $data = evaluacionPeriodoData::getEvaluacionJefeRHActual($body);  // se comprueba si ya se enviaron notificaciones antes.
        if ($data['autoev_compet'] !== 1) {
            $jefe = usuarioData::getJefe($body);
            $data = usuarioData::setNotificacion(16, $jefe['jefe']);  // enviar notificacion
            evaluacionPeriodoData::updateAutoEvaComptetencias($body);  // se cambia el aprobacion_j a '1'.
        }
        return $this->responseAPI("success", "get success!", 200, $data);
    }
    
    public function notificacionIngreso() {
        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }
        $body = json_decode(file_get_contents("php://input"), true);
        $data = evaluacionPeriodoData::getEvaluacionJefeRHActual($body);  // se comprueba si ya se enviaron notificaciones antes.
        if ($data['ingreso'] !== 1) {
            $jefe = usuarioData::getJefe($body);
            $data = usuarioData::setNotificacion(12, $jefe['jefe']);  // enviar notificacion
            evaluacionPeriodoData::updateIngreso($body);  // se cambia el aprobacion_j a '1'.
        }
        return $this->responseAPI("success", "get success!", 200, $data);
    }

    public function notificacionEvaMetas() {
        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }
        $body = json_decode(file_get_contents("php://input"), true);
        $data = evaluacionPeriodoData::getEvaluacionJefeRHActual($body);  // se comprueba si ya se enviaron notificaciones antes.
        if ($data['eval_metas'] !== 1) {
            $data = usuarioData::setNotificacion(17, $body);  // enviar notificacion
            evaluacionPeriodoData::updateEvaMetas($body);  // se cambia el aprobacion_j a '1'.
        }
        return $this->responseAPI("success", "get success!", 200, $data);
    }

    public function notificacionEvaCompetencias() {
        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }
        $body = json_decode(file_get_contents("php://input"), true);
        $data = evaluacionPeriodoData::getEvaluacionJefeRHActual($body);  // se comprueba si ya se enviaron notificaciones antes.
        if ($data['eval_compet'] !== 1) {
            $data = usuarioData::setNotificacion(18, $body);  // enviar notificacion
            evaluacionPeriodoData::updateEvaComptetencias($body);  // se cambia el aprobacion_j a '1'.
        }
        return $this->responseAPI("success", "get success!", 200, $data);
    }

    public function __destruct() {
        return true;
    }

}
