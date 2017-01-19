<?php

/**
 * This class is responsible for sign up, sign in and logout.
 *
 * @copyright Copyright (c) 2014, Felipe Lunardi Farias <ffarias.dev@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
require '../database/usuarioData.php';
require '../database/correosData.php';
require '../database/periodoData.php';

class usuarios extends Rest implements interfaceApi {

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

        if ($this->get_request_method() === "POST") {
            $body = json_decode(file_get_contents("php://input"), true);
            if (array_key_exists("periodo", $body) && array_key_exists("departamento", $body)) {
                $periodo = $body['periodo'];
                $departamento = $body['id'];
                $data = usuarioData::getAllWhenDep($periodo, $departamento);
            } if (array_key_exists("periodo", $body)) {
                $periodo = $body['periodo'];
                $data = usuarioData::getAllWhen($periodo);
            }
        } else {
            $data = usuarioData::getAll();
            return $this->responseAPI("success", "get success!", 200, $data);
        }
    }

    public function allSolicitudes() {

        $data = usuarioData::getAllSolicitudes();

        return $this->responseAPI("success", "get success!", 200, $data);
    }

    public function allFrom() {

        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $user = usuarioData::getAllFrom($body);

        if ($user !== false) {
            $data['usuario'] = $user;
            return $this->responseAPI("success", "get success!", 200, $data);
        }
        return $this->responseAPI("error", "", $user, 200);
    }

    public function add() {

        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $nombre = $body['nombre'];
        $id = $body['id'];
        $apellido1 = $body['apellido1'];
        $apellido2 = $body['apellido2'];
        $correo = $body['correo'];
        $contrasena = md5($body['contrasena']);
        $departamento = $body['departamento']['id'];
        if (isset($body['perfil'])) {
            $perfil = usuarioData::getPerfil($body['perfil']);
        } else {
            $perfil = 0;
        }
        if (isset($body['estado'])) {
            $estado = $body['estado'];
        } else {
            $estado = 0;
        }
        $data = usuarioData::insert($id, $nombre, $apellido1, $apellido2, $correo, $estado, $contrasena, $departamento, $perfil);
        if ($data === true) {
            return $this->responseAPI("success", "Registro completado", 200, $data);
        }
        return $this->responseAPI("error", "$data", 200);
    }

    public function set() {

        if ($this->get_request_method() != "PUT") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);
        $nombre = $body['nombre'];
        $id = $body['id'];
        $apellido1 = $body['apellido1'];
        $apellido2 = $body['apellido2'];
        $correo = $body['correo'];
        $departamento = $body['departamento']['id'];
        $perfil = usuarioData::getPerfil($body['perfil']);
        $perfilCompetencia = $body['perfilcompetencia'];
        if ($body['estado'] != null) {
            $estado = $body['estado'];
        } else {
            $estado = 0;
        }$periodo = periodoData::getActual();
        $data0 = usuarioData::updateEvaluacion($id, $periodo['id'], $perfilCompetencia['id']);
        $data1 = usuarioData::update($id, $nombre, $apellido1, $apellido2, $correo, $estado, $departamento, $perfil);
        if ($data1 === true && $data0 === true) {
            return $this->responseAPI("success", "set success", 200);
        }
        return $this->responseAPI("error", $data0 . " " . $data1, 200);
    }

    public function del() {

        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $data = usuarioData::delete($body);
        if ($data === true) {
            return $this->responseAPI("success", "Usuario eliminado con éxito", 200);
        }
        return $this->responseAPI("error", "", 200);
    }

    public function setP() {

        if ($this->get_request_method() != "PUT") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);

        $token = $body['token'];
        $user = $body['user'];

        $data = usuarioData::validarToken($token);

        if ($data === true) {
            $contrasena = md5($user['contrasena']);
            $sign = JWT::getSign($token);
            usuarioData::setContrasena($contrasena, $sign);
            usuarioData::logout($token);
            return $this->responseAPI("success", "set success", 200);
        }
        return $this->responseAPI("error", $data, 200);
    }

    public function login() {

        if ($this->get_request_method() != "PUT") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }
        $body = json_decode(file_get_contents("php://input"), true);
        $id = $body['id'];
        $contrasena = md5($body['contrasena']);
        $user = usuarioData::login($id, $contrasena);
        if ($user === false) {
            return $this->responseAPI("error", "Usuario o contraseña incorrectos", 200);
        }
        if (!is_a($user, 'Exception')) {
            $token = usuarioData::token($user);
            return $this->responseAPI("success", "log success", 200, $token);
        } else {
            return $this->responseAPI("error", $user->getMessage(), 200);
        }
    }

    public function logout() {

        if ($this->get_request_method() != "PUT") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }
        $body = json_decode(file_get_contents("php://input"), true);
        $token = $body['token'];
        $data = usuarioData::logout($token);
        if ($data === true) {
            return $this->responseAPI("success", "logout success", 200);
        }
        return $this->responseAPI("error", $data, 200);
    }

    public function session() {

        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }
        $body = json_decode(file_get_contents("php://input"), true);
        $token = $body['token'];
        $data = usuarioData::validarToken($token);
        if ($data === true) {
            return $this->responseAPI("success", "logout success", 200);
        }
        return $this->responseAPI("error", $data, 200);
    }

    public function correo() {

        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }
        $body = json_decode(file_get_contents("php://input"), true);
        $id = $body['id'];
        $user = usuarioData::existe($id);
        if ($user) {
            $u = usuarioData::getAllFrom($id);
            $token = usuarioData::token($u);
            correoData::setContraseña($u, $token);
            return $this->responseAPI("success", "Envio de correo tuvo exito", 200);
        } return $this->responseAPI("error", "Algo falló", 200);
    }

    public function comprobarPassword() {

        if ($this->get_request_method() != "POST") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);
        $passwordMD5 = md5($body['contrasena']);

        $data = usuarioData::comprobarUserPassword($body['id'], $passwordMD5);

        if (isset($data)) {
            return $this->responseAPI("success", "get success!", 200, $data);
        } else {
            return $this->responseAPI("error", $data, 200);
        }
    }

    public function cambiarPasswordUser() {

        if ($this->get_request_method() != "PUT") {
            return $this->responseAPI("error", "Not allowed.", 406);
        }

        $body = json_decode(file_get_contents("php://input"), true);
        $passwordMD5 = md5($body['contrasena']);

        $data = usuarioData::cambiarContrasenaUser($passwordMD5, $body['id']);

        if (isset($data)) {
            return $this->responseAPI("success", "get success!", 200, $data);
        } else {
            return $this->responseAPI("error", $data, 200);
        }
    }

    public function __destruct() {
        return true;
    }

}
