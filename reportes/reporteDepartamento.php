<?php

// Include the main TCPDF library (search for installation path).
require '../libraries/tcpdf/tcpdf.php';
require_once '../libraries/Curl/Curl.php';

$departamento = $_GET['dep'];
$dep = $_GET['nombre'];
$emp = $_GET['emp'];
$periodo = $_GET['periodo'];

$curl = new Curl();
$curl->post('localhost/Sied/api/departamentos/allUsersMetas', json_encode(array('id' => $departamento, 'periodo' => $periodo,)));

if ($curl->error) {
    echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
} else {
    // echo 'Data server received via POST:' . "\n";
    $response = "";
    $json2 = json_decode($curl->response, true);
    $users = $json2["data"];
    //print_r($json2);
}

// create new PDF document

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$header = "Empresa: $emp \nReporte por Departamento";

// set default header data
$pdf->SetHeaderData('repretel.jpg', PDF_HEADER_LOGO_WIDTH, "", $header);
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
$html = '<h1>Colaboradores de '.$dep.' </h1>';
// Set some content to print

foreach ($users as $user) {
    $html .= '<table style="border-collapse: separate;border-spacing:  8px;">';
    $html .= '<tr><td colspan="2"><b>' . $user['nombre'] . " " . $user['apellido1'] . " " . $user['apellido1'] .
            '</b></td><td></td><td></td><td></td></tr>';
    foreach ($user['metas'] as $metas) {
        $html .= '<tr><td>' . $metas['titulo'] . '</td>'
        .'<td><p>' . $metas['descripcion'] . '</p></td>'
        .'<td>' . $metas['evaluable'] . '</td>'
        .'<td>' . $metas['peso'] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</table>';
}



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
$pdf->Output('reporteBasico' . '.pdf', 'I');
//print( "header('Content-Type: application/pdf');");
?>
