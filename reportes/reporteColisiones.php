<?php

// Include the main TCPDF library (search for installation path).
require '../libraries/tcpdf/tcpdf.php';
require_once '../libraries/Curl/Curl.php';


$curl = new Curl();
$curl->post('Sied/api/usuarios/allFrom', "123");
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
$curl2->post('Sied/api/metas/all', json_encode(array("id" => "123", 'ID' => '123',)));

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
$curl3->post('Sied/api/competencias/allFromUser', json_encode(array("id" => "123", 'ID' => '123',)));

if ($curl3->error) {
    echo 'Error: ' . $curl3->errorCode . ': ' . $curl3->errorMessage . "\n";
} else {
    // echo 'Data server received via POST:' . "\n";
    $response = "";
    $json3 = json_decode($curl3->response, true);
    $competencias = $json3["data"];
    print_r($curl3->response);
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
    <td colspan="2"><b>Nombre:&nbsp;&nbsp;</b>' . $user['nombre'] . ' ' . $user['apellido1'] . ' ' . $user['apellido2'] . '</td>
    <td colspan="2"><b>N&uacute;mero de cédula:&nbsp;&nbsp;</b>' . $user['id'] . '</td>
    </tr>
    </table>
    <h1>Metas</h1>
    <table style="border-collapse: separate;border-spacing:  18px;">
    <tr>
        <td><b>Meta</b></td>
        <td><b>Descripcion</b></td>
        <td><b>Evaluable</b></td>
        <td><b>Peso</b></td>
    </tr>';
foreach ($metas as $row) {
    $html .= '<tr>
                        <td>
                            ' . $row['titulo'] . '
                        </td>
                        <td>
                            ' . $row['descripcion'] . '
                        </td>
                        <td>
                            ' . $row['evaluable'] . '
                        </td>
                        <td>
                            ' . $row['peso'] . '
                        </td>
                    </tr>';
}
$html .= '</table>';
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