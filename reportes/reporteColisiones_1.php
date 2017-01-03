<?php
// Include the main TCPDF library (search for installation path).
require_once '../libraries/tcpdf/tcpdf.php';
//require_once 'Conexion.php';
/*VARIABLES QUE VIENEN DE CONSULTAREVISION.PHP*/

$variable = filter_input(INPUT_GET, 'variable', FILTER_SANITIZE_STRING);
$user = $user->empresa;
$sql1="Select * from intra_solicitudes,intra_revisionentrada where SO_chofer = REE_chofer and SO_chofer = '".$variable."' and SO_estado='Finalizada' and REE_colision = '1' and SO_empresa='".$user."' group by SO_numero";
$resultado = mysql_query($sql1) or die(mysql_error());

$sql2="Select * from intra_choferes where CH_numLicencia = '".$variable."'";
$resultado2 = mysql_query($sql2) or die(mysql_error());
$row2=mysql_fetch_array($resultado2);
// create new PDF document
// create new PDF document

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
$pdf->SetHeaderData('repretel.jpg', PDF_HEADER_LOGO_WIDTH, "","Reporte de colisiones");
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(5,PDF_MARGIN_TOP,5,false);
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
    <td colspan="2"><b>Nombre:&nbsp;&nbsp;</b>'.$row2['CH_nombre'].' '.$row2['CH_apellido1'].' '.$row2['CH_apellido2'].'</td>
    <td colspan="2"><b>N&uacute;mero de licencia:&nbsp;&nbsp;</b>'.$row2['CH_numLicencia'].'</td>
    </tr>
    <tr>
        <td><b># Solicitud</b></td>
        <td><b>Placa</b></td>
        <td><b>Fecha de entrada</b></td>
        <td><b>Departamento</b></td>
    </tr>';
            while($row=mysql_fetch_array($resultado))
            {
                $html .= '
                    <tr>
                        <td>
                            '.$row['SO_numero'].'
                        </td>
                        <td>
                            '.$row['SO_placa'].'
                        </td>
                        <td>
                            '.$row['REE_fechaEntrada'].'
                        </td>
                        <td>
                            '.$row['SO_depDes'].'
                        </td>
                    </tr>';
            }
            
            $html .= '
        </table>
    ';
 $pdf->writeHTML($html, true, false, true, false, '');       
function validar($opcion)
{
    if($opcion == 1)
    {
        return 'checked = "checked" ';
    }
    else
    {
        return false;
    }
}
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Reporte_Colisiones_'.$row2['CH_numLicencia'].'.pdf', 'I');
?>