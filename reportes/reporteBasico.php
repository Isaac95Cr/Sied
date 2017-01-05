<?php

// Include the main TCPDF library (search for installation path).
require '../libraries/tcpdf/tcpdf.php';
require_once '../libraries/Curl/Curl.php';


$curl = new Curl();
$curl->post('localhost/Sied/api/usuarios/allFrom', "123");
if ($curl->error) {
    echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
} else {
    // echo 'Data server received via POST:' . "\n";
    $response = "";
    ($curl->response);
    $json = json_decode($curl->response, true);
    $user = $json["data"]["usuario"];
    //print_r($user);
}

$curl2 = new Curl();
$curl2->post('localhost/Sied/api/metas/all', json_encode(array("id" => "123", 'ID' => '123',)));

if ($curl2->error) {
    echo 'Error: ' . $curl2->errorCode . ': ' . $curl2->errorMessage . "\n";
} else {
    // echo 'Data server received via POST:' . "\n";
    $response = "";
    $json2 = json_decode($curl2->response, true);
    $metas = $json2["data"];
    //print_r($metas);
}

$curl3 = new Curl();
$curl3->post('localhost/Sied/api/competencias/allFromUser', json_encode(array("id" => "123", 'ID' => '123',)));

if ($curl3->error) {
    echo 'Error: ' . $curl3->errorCode . ': ' . $curl3->errorMessage . "\n";
} else {
    // echo 'Data server received via POST:' . "\n";
    $response = "";
    $json3 = json_decode($curl3->response, true);
    $competencias = $json3["data"];
   // print_r($competencias);
}

$curl4 = new Curl();
$curl4->post('localhost/Sied/api/evaluacionCompetencias/allAutoFromUser', json_encode(array("id" => "123", 'ID' => '123',)));

if ($curl4->error) {
    echo 'Error: ' . $curl4->errorCode . ': ' . $curl4->errorMessage . "\n";
} else {
    // echo 'Data server received via POST:' . "\n";
    $response = "";
    $json4 = json_decode($curl4->response, true);
    $notas = explode(",", $json4["data"][0]["evaluacion"]);

    //print_r(explode(",", $notas["evaluacion"]));
    //explode(",", $notas["evaluacion"]);
}

$curl5 = new Curl();
$curl5->post('localhost/Sied/api/perfilCompetencias/allFromUser',json_encode(array("id" => "123", 'ID' => '123',)));

if ($curl5->error) {
    echo 'Error: ' . $curl5->errorCode . ': ' . $curl5->errorMessage . "\n";
} else {
    // echo 'Data server received via POST:' . "\n";
    $response = "";
    $json5 = json_decode($curl5->response, true);
    $perfil = $json5["data"];

    //print_r($json5);
    //explode(",", $notas["evaluacion"]);
}

// create new PDF document

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
$pdf->SetHeaderData('repretel.jpg', PDF_HEADER_LOGO_WIDTH, "", "Reporte basico");
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(5, PDF_MARGIN_TOP, 5, false);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set default font subsetting mode
$pdf->setFontSubsetting(true);
$pdf->SetFont('times', '', 9, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Set some content to print
$html = '
    <table style="border-collapse: separate;border-spacing:  18px;">
    <tr>
    <td colspan="2"><h3>Nombre:&nbsp;&nbsp;</h3>' . $user['nombre'] . ' ' . $user['apellido1'] . ' ' . $user['apellido2'] . '</td>
    <td colspan="2"><h3>N&uacute;mero de cédula:&nbsp;&nbsp;</h3>' . $user['id'] . '</td>
    </tr>
    <tr>
    <td colspan="2"><h3>Empresa:&nbsp;&nbsp;</h3>' . $user['empresa'] . '</td>
    <td colspan="2"><h3>Departamento:&nbsp;&nbsp;</h3>' . $user['departamento'] . '</td>
    </tr>
    </table>
    <h1>Metas</h1>
    <table style="border-collapse: separate;border-spacing:  8px;">' .
        '<tr><th colspan="2"></th><th></th><th><b>Evaluable</b></th><th><b>Peso</b></th><th><b>Evaluación</b></th></tr>';
$totalMetas = 0;
foreach ($metas as $row) {
    if ($row['evaluable'] == "1") {
        $totalMetas += ($row["peso"] / 100) * $row["evaluacion"];
    }
    $html .= '<tr><td colspan="3"><b>' . $row['titulo'] .
            '</b><p> ' . $row['descripcion'] . '</p> </td>' .
            '<td><p></p>' . $row['evaluable'] . '</td>' .
            '<td><p></p>' . $row['peso'] . '</td>' .
            '<td><p></p>' . $row['evaluacion'] . '</td>' .
            '</tr>';
}
$html .= '<tr><td></td><td></td><td></td><td></td><td colspan="2"><b>Total: </b>' . $totalMetas . '</td></tr>';
$html .= '</table>';


$html .= ' <h1>Competencias tipo: '.$perfil["nombre"].'</h1>';
$i = 0;
$sumDetalle = 0;
$totalCompetencias = 0;
foreach ($competencias as $competencia) {

    $html .= '<h2>Competencia: ' . $competencia["titulo"] . '</h2>' .
            '<p><b>Descripción: </b> ' . $competencia["descripcion"] . '</p>';
    $html .='<table style="border-collapse: separate;border-spacing:  8px;">';
    foreach ($competencia["detalles"] as $detalle) {
        $html .= '<tr>'
                . '<td colspan="2"><p>' . $detalle["descripcion"] . '</p></td>';
        if ($notas[$i] != null) {
            $html .='<td>' . $notas[$i] . '</td>';
            $sumDetalle +=$notas[$i];
        }
        $html .= '</tr>';
        $i++;
    }
    $totalCompetencias += ($sumDetalle / count($notas)) * ($competencia["peso"] / 100);
    $html .= '</table>';
}
$total = ($totalMetas * 0.4) + ($totalCompetencias * 0.6);
$html .= '<tr><td></td><td></td><td colspan="2"><b>Total: ' . $totalCompetencias . '</b></td></tr>';
$html .='<h2>Ponderado Final: ' . $total . '</h2>';
$pdf->writeHTML($html, true, false, true, false, '');

function validar($opcion) {
    if ($opcion == 1) {
        return 'checked = "checked" ';
    } else {
        return false;
    }
}

// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Reporte_Colisiones_' . '.pdf', 'I');
?>