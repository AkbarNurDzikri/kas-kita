<?php
require_once dirname(__DIR__, 3) . '/assets/mpdf/autoload.php';

$mpdf = new \Mpdf\Mpdf([
  // 'format' => 'A4-L',
  'default_font_size' => 10,
  'margin-top' => 0,
]);
$mpdf->SetFooter('{PAGENO}');
$mpdf->showImageErrors = true;
$html = '<!DOCTYPE html>
          <html lang="en">
          <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title></title>
            <style>
              table, th, tr, td {
                border: 1px solid black;
                border-collapse: collapse;
              }

              .text-end {
                text-align: right;
              }

              .text-center {
                text-align: center;
              }

              tr:nth-child(even) {
                background-color: #f9f5f0;
              }

              .pt-mepet-atas {
                padding-top: -15px;
              }

              .mt-mepet-atas {
                margin-top: -10px;
              }

              .text-dark {
                color: black;
              }

              .text-end {
                text-align: right;
              }

              .fs-5 {
                font-size: 12px;
              }
              
              .text-grey {
                color: grey;
              }

              .text-start {
                text-align: left;
              }
            </style>
          </head>
          <body>
          <h2 class="text-center">LAPORAN KAS '. strtoupper($_SESSION['userInfo']['username']) .'</h2>
          <h3 class="text-center pt-mepet-atas">Periode '. date('d M Y', strtotime($data['tanggalLaporan']['tglMulaiLaporan'])) . ' - ' . date('d M Y', strtotime($data['tanggalLaporan']['tglSelesaiLaporan'])) .'</h3>
          <img src="'. BASEURL . '/assets/images/image-landing.png' .'" alt="brand-image" style="margin-top: -80px; width: 110px;">

            <table>
              <caption class="text-start">
                <span class=" text-grey fs-5">Tanggal Download : '. date('d-M-Y, H:i') .' WIB</span> <br>
                <b id="captionKasMasuk"></b>
                <b id="captionKasKeluar"></b>
                <b id="captionSaldo"></b>
              </caption>
              <thead>
                <tr>
                  <th class="text-center">No.</th>
                  <th class="text-center">Tanggal</th>
                  <th class="text-center">Kategori</th>
                  <th class="text-center">Kas Masuk</th>
                  <th class="text-center">Kas Keluar</th>
                  <th class="text-center">Keterangan</th>
                </tr>
              </thead>
              <tbody>';
              $no = 1;
              $totalKasMasuk = 0;
              $totalKasKeluar = 0;
              foreach($data['kas'] as $kas) {
                $totalKasMasuk += $kas['pemasukan'];
                $totalKasKeluar += $kas['pengeluaran'];
      $html .= '<tr>
                  <td class="text-center">'. $no++ .'</td>
                  <td class="text-center">'. date('d M Y', strtotime($kas['tanggal'])) .'</td>
                  <td class="text-center">'. $kas['kategori'] .'</td>
                  <td class="text-end">'. number_format($kas['pemasukan'], 0, ',', '.') .'</td>
                  <td class="text-end">'. number_format($kas['pengeluaran'], 0, ',', '.') .'</td>
                  <td class="text-center">'. $kas['keterangan'] .'</td>
                </tr>';
              }
    $html .= '</tbody>
              <tfoot>
                <tr>
                  <td colspan="3" style="border: none; color: blue;"><b>Total Kas Masuk</b></td>
                  <td colspan="2" style="border: none; color: blue;" class="text-end"><b>'. number_format($totalKasMasuk, 0, ',', '.') .'</b></td>
                  <td style="border: none;"></td>
                </tr>
                <tr>
                  <td colspan="3" style="border: none; color: red;"><b>Total Kas Keluar</b></td>
                  <td colspan="2" style="border: none; color: red;" class="text-end"><b>'. number_format($totalKasKeluar, 0, ',', '.') .'</b></td>
                  <td style="border: none;"></td>
                </tr>
                <tr>
                  <td colspan="3" style="border: none;"><b>Sisa Saldo</b></td>
                  <td colspan="2" style="border: none;" class="text-end"><b>'. number_format($totalKasMasuk - $totalKasKeluar, 0, ',', '.') .'</b></td>
                  <td style="border: none;"></td>
                </tr>
              </tfoot>
            </table>';
$html .= '</body>
        </html>';
$mpdf->WriteHTML($html);
$mpdf->Output();
?>