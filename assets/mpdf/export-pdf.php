<?php
require_once dirname(__DIR__, 3) . '/assets/vendor/mpdf/autoload.php';

$mpdf = new \Mpdf\Mpdf([
  'format' => 'A4-L',
  'default_font_size' => 10,
  'margin-top' => 0,
]);
$mpdf->SetFooter('{PAGENO}');
$html = '<!DOCTYPE html>
          <html lang="en">
          <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'. date("d/M/Y", strtotime($data['report'][0]['tanggal'])) . " (" . $data['report'][0]['operator1'] . ' - ' . $data['report'][0]['operator2'] .')</title>
            <style>
              table {
                border-collapse: collapse;
              }

              .text-center {
                text-align: center;
              }

              .text-start {
                text-align: left;
              }

              .text-end {
                text-align: right;
              }

              .text-white {
                color: white;
              }

              .center {
                margin-left: auto;
                margin-right: auto;
              }
            </style>
          </head>
          <body>
          <h1 class="text-center">Laporan Harian Recycle</h1>
          <img src="'. BASEURL . "/assets/images/logo-bfi-full-transparent.png" .'" style="width: 15rem; margin-top: -60px;">
          <hr style="color: black; margin-top: 10px;">
          
          <table style="margin-bottom: 10px;">
            <tbody>
              <tr>
                <td style="width: 75px;">Tanggal</td>
                <td style="width: 200px;">: '. date("d/M/Y", strtotime($data['report'][0]['tanggal'])) .'</td>

                <td style="width: 125px;">Temp. Extruder</td>';
                if($data['report'][0]['machine'] == 'YEI') {
                  $html .= '<td style="width: 175px;"> : '. $data['report'][0]['temp_extru1'] .'&deg; / '. $data['report'][0]['temp_extru2'] . '&deg;' . ' / ' . $data['report'][0]['temp_extru3'] .'&deg; / '. $data['report'][0]['temp_extru4'] .'&deg;' .'</td>';
                } else {
                  $html .= '<td style="width: 175px;"> : '. $data['report'][0]['temp_extru1'] .'&deg; / '. $data['report'][0]['temp_extru2'] . '&deg;' .'</td>';
                }

      $html .= '<td style="width: 125px;">RPM Roll Feeder</td>
                <td style="width: 100px;"> : '. $data['report'][0]['rpm_rollfeeder'] .'%</td>
                
                <td style="width: 75px;">Machine</td>
                <td style="width: 200px;"> : '. $data['report'][0]['machine'] .'</td>
              </tr>
              <tr>
                <td style="width: 75px;">Shift</td>
                <td style="width: 200px;">: '. $data['report'][0]['shift'] .'</td>
                
                <td style="width: 125px;">Temp. Filter Zone</td>
                <td style="width: 175px;"> : '. $data['report'][0]['temp_filterzone1'] .'&deg; / '. $data['report'][0]['temp_filterzone2'] .'&deg;</td>

                <td style="width: 125px;">RPM Screw</td>
                <td style="width: 100px;"> : '. $data['report'][0]['rpm_screw'] .'%</td>

                <td style="width: 75px;">Output</td>
                <td style="width: 200px;"> : '. number_format($data['report'][0]['output'], 2, ',', '.') .' Kg /Jam</td>
              </tr>
              <tr>
                <td style="width: 75px;">Operator 1</td>
                <td style="width: 200px;">: '. $data['report'][0]['operator1'] . '</td>

                <td style="width: 125px;">Temp. Die</td>
                <td style="width: 175px;"> : '. $data['report'][0]['temp_die1'] .'&deg; / '. $data['report'][0]['temp_die2'] .'&deg;</td>

                <td style="width: 125px;">RPM Pelletizer</td>
                <td style="width: 100px;"> : '. $data['report'][0]['rpm_pelletizer'] .'%</td>

                <td style="width: 75px;">Waste Awal</td>
                <td style="width: 200px;"> : '. number_format($data['report'][0]['waste_awal'], 2, ',', '.') .' Kg</td>
              </tr>
              <tr>
                <td style="width: 75px;">Operator 2</td>
                <td style="width: 200px;">: '. $data['report'][0]['operator2'] .'</td>
              </tr>
            </tbody>
          </table>';
          $html .= '<table border="1" class="center">
            <thead>
              <tr style="background-color: #08b1ff;" class="text-center">
                <th class="text-white" rowspan="3">No.</th>
                <th class="text-white" colspan="8">Raw Materials</th>
                <th class="text-white" rowspan="1" colspan="2">Time Process</th>
                <th class="text-white" colspan="6">Production Result</th>
              </tr>
              <tr style="background-color: #08b1ff;" class="text-center">
                <th class="text-white" colspan="2">BM1</th>
                <th class="text-white" colspan="2">BM2</th>
                <th class="text-white" colspan="3">Others</th>
                <th class="text-white" rowspan="2">Total</th>
                <th class="text-white" rowspan="2">Start</th>
                <th class="text-white" rowspan="2">Finish</th>
                <th class="text-white" colspan="2">Finish Good</th>
                <th class="text-white" colspan="2">Waste</th>
                <th class="text-white" rowspan="2">Total</th>
                <th class="text-white" rowspan="2">Remarks</th>
              </tr>
              <tr style="background-color: #08b1ff;" class="text-center">
                <th class="text-white">Product Spec</th>
                <th class="text-white">Qty</th>
                <th class="text-white">Product Spec</th>
                <th class="text-white">Qty</th>
                <th class="text-white">Product Spec</th>
                <th class="text-white">Type</th>
                <th class="text-white">Qty</th>
                <th class="text-white">Type</th>
                <th class="text-white">Qty</th>
                <th class="text-white">Type</th>
                <th class="text-white">Qty</th>
              </tr>
            </thead>
            <tbody>';
              $no = 1;
              $totalQtyRawMaterialsBm1 = 0;
              $totalQtyRawMaterialsBm2 = 0;
              $totalQtyRawMaterialsOther = 0;
              $totalQtyRawMaterials = 0;
              $totalQtyFinishGood = 0;
              $totalQtyWaste = 0;
              $totalQtyProductionResult = 0;
              foreach($data['reportDetails'] as $details) {
                $html .= '<tr>
                  <td class="text-center">'. $no++ .'</td>;
                  <td class="text-center">'. $details['bm1_material_specs'] .'</td>;
                  <td class="text-end">'. $details['bm1_material_qty'] .'</td>;
                  <td class="text-center">'. $details['bm2_material_specs'] .'</td>;
                  <td class="text-end">'. $details['bm2_material_qty'] .'</td>;
                  <td class="text-center">'. $details['other_material_specs'] .'</td>;
                  <td class="text-center">'. $details['other_material_type'] .'</td>;
                  <td class="text-end">'. $details['other_material_qty'] .'</td>;
                  <td class="text-end">'. number_format($details['bm1_material_qty'] + $details['bm2_material_qty'] + $details['other_material_qty'], 2, ',', '.') .'</td>;
                  <td class="text-center">'. date('H:i', strtotime($details['time_start'])) .'</td>;
                  <td class="text-center">'. date('H:i', strtotime($details['time_finish'])) .'</td>;
                  <td class="text-center">'. $details['product_type'] .'</td>;
                  <td class="text-end">'. $details['product_qty'] .'</td>;
                  <td class="text-center">'. $details['waste_type'] .'</td>;
                  <td class="text-end">'. $details['waste_qty'] .'</td>;
                  <td class="text-end">'. number_format($details['product_qty'] + $details['waste_qty'], 2, ',', '.') .'</td>;
                  <td class="text-center">'. $details['remarks'] .'</td>;
                </tr>';

                $totalQtyRawMaterialsBm1 += $details['bm1_material_qty'];
                $totalQtyRawMaterialsBm2 += $details['bm2_material_qty'];
                $totalQtyRawMaterialsOther += $details['other_material_qty'];
                $totalQtyRawMaterials = $totalQtyRawMaterialsBm1 + $totalQtyRawMaterialsBm2 + $totalQtyRawMaterialsOther;
                $totalQtyFinishGood += $details['product_qty'];
                $totalQtyWaste += $details['waste_qty'];
                $totalQtyProductionResult = $totalQtyFinishGood + $totalQtyWaste;
              }
    $html .= '<tfoot>
                <tr>
                  <th style="border: none;" class="text-start" colspan="2"><b>Total</b></th>
                  <th style="border: none;" class="text-end" id="totalQtyRawMaterialsBm1">'.number_format($totalQtyRawMaterialsBm1, 2, ',', '.').'</th>
                  <th style="border: none;" colspan="2" class="text-end" id="totalQtyRawMaterialsBm2">'.number_format($totalQtyRawMaterialsBm2, 2, ',', '.').'</th>
                  <th style="border: none;" colspan="3" class="text-end" id="totalQtyRawMaterialsOther">'.number_format($totalQtyRawMaterialsOther, 2, ',', '.').'</th>
                  <th style="border: none;" class="text-end" id="totalQtyRawMaterials">'.number_format($totalQtyRawMaterials, 2, ',', '.').'</th>
                  <th style="border: none;" colspan="4" class="text-end" id="totalQtyFinishGood">'.number_format($totalQtyFinishGood, 2, ',', '.').'</th>
                  <th style="border: none;" colspan="2" class="text-end" id="totalQtyWaste">'.number_format($totalQtyWaste, 2, ',', '.').'</th>
                  <th style="border: none;" class="text-end" id="totalQtyProductionResult">'.number_format($totalQtyProductionResult, 2, ',', '.').'</th>
                </tr>
              </tfoot>
            </tbody>
          </table>
          
          <table style="margin-top: 20px;">
            <tr>
              <td></td>
              <td style="color: grey; width: 500px;" class="text-center">Printed on : '. date('d/M/Y H:i') .'</td>
            </tr>
            <tr>
              <td class="text-center"><b><u>Dibuat Oleh</u></b></td>
              <td class="text-center"><b><u>Mengetahui</u></b></td>
            </tr>
            <tr>
              <td style="padding-top: 50px; width: 500px;" class="text-center">'. $data['report'][0]['operator1'] .'</td>
              <td style="padding-top: 50px; width: 500px;" class="text-center">Production Leader</td>
            </tr>
          </table>';
$html .= '</body>
        </html>';
$mpdf->WriteHTML($html);
$mpdf->Output('Laporan recycle '. date("d/M/Y", strtotime($data['report'][0]['tanggal'])) . " (" . $data['report'][0]['operator1'] . ' - ' . $data['report'][0]['operator2'] .').pdf', 'I');
?>