<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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

    .bg-primary {
      background-color: blue;
    }
  </style>
</head>
<body>
  <?php
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Report Recycle.xls");
  ?>
  <h2 class="text-center">Recycle Report</h2>
  <p class="text-center" style="margin-top: -10px;"><b>Periode <?= date('d/M/Y', strtotime($data['start_period'])) ?> s.d. <?= date('d/M/Y', strtotime($data['finish_period'])) ?></b></p>
  
  <table border="1">
    <caption class="text-start">Downloaded at : <?= date('d/M/y H:i') ?> WIB [ by <?= $_SESSION['userInfo']['fullname'] ?> ]</caption>
    <thead>
      <tr class="text-center">
        <th rowspan="2" class="bg-primary text-white">Tanggal</th>
        <th rowspan="2" class="bg-primary text-white">Shift</th>
        <th rowspan="2" class="bg-primary text-white">Operator</th>
        <th colspan="5" class="bg-primary text-white">Raw Materials</th>
        <th colspan="5" class="bg-primary text-white">Finish Good</th>
        <th colspan="3" class="bg-primary text-white">Waste Process</th>
        <th rowspan="2" class="bg-primary text-white">Remarks</th>
      </tr>
      <tr>
        <th class="bg-primary text-white">Clear</th>
        <th class="bg-primary text-white">White</th>
        <th class="bg-primary text-white">Zak Resin</th>
        <th class="bg-primary text-white">Reject</th>
        <th class="bg-primary text-white">Total</th>
        
        <th class="bg-primary text-white">Clear</th>
        <th class="bg-primary text-white">White</th>
        <th class="bg-primary text-white">Noblen</th>
        <th class="bg-primary text-white">Purging</th>
        <th class="bg-primary text-white">Total</th>

        <th class="bg-primary text-white">Powder</th>
        <th class="bg-primary text-white">Frozen</th>
        <th class="bg-primary text-white">Total</th>
      </tr>
    </thead>
    <tbody>
      <?php $totalRMClear = 0 ?>
      <?php $totalRMWhite = 0 ?>
      <?php $totalRMZakResin = 0 ?>
      <?php $totalRMReject = 0 ?>

      <?php $totalFGClear = 0 ?>
      <?php $totalFGWhite = 0 ?>
      <?php $totalFGNoblen = 0 ?>
      <?php $totalFGPurging = 0 ?>

      <?php $totalWastePowder = 0 ?>
      <?php $totalWasteFrozen = 0 ?>

      <?php foreach($data['reportDetails'] as $report) : ?>
      <?php $totalRM = $report['rm_clear'] + $report['rm_white'] + $report['rm_zak_resin'] + $report['rm_reject'] ?>
      <?php $totalFG = $report['fg_clear'] + $report['fg_white'] + $report['fg_noblen'] + $report['fg_purging'] ?>
      <?php $totalWaste = $report['waste_powder'] + $report['waste_frozen'] ?>
      <tr>
        <td class="text-center"><?= date('d/M/Y', strtotime($report['tanggal'])) ?></td>
        <td class="text-center"><?= $report['shift'] ?></td>
        <td class="text-center"><?= $report['operator1'] . ' - ' . $report['operator2'] ?></td>
        <td class="text-end"><?= number_format($report['rm_clear'], 2, '.', ',') ?></td>
        <td class="text-end"><?= number_format($report['rm_white'], 2, '.', ',') ?></td>
        <td class="text-end"><?= number_format($report['rm_zak_resin'], 2, '.', ',') ?></td>
        <td class="text-end"><?= number_format($report['rm_reject'], 2, '.', ',') ?></td>
        <td class="text-end"><?= number_format($totalRM, 2, '.', ',') ?></td>

        <td class="text-end"><?= number_format($report['fg_clear'], 2, '.', ',') ?></td>
        <td class="text-end"><?= number_format($report['fg_white'], 2, '.', ',') ?></td>
        <td class="text-end"><?= number_format($report['fg_noblen'], 2, '.', ',') ?></td>
        <td class="text-end"><?= number_format($report['fg_purging'], 2, '.', ',') ?></td>
        <td class="text-end"><?= number_format($totalFG, 2, '.', ',') ?></td>

        <td class="text-end"><?= number_format($report['waste_powder'], 2, '.', ',') ?></td>
        <td class="text-end"><?= number_format($report['waste_frozen'], 2, '.', ',') ?></td>
        <td class="text-end"><?= number_format($report['waste_powder'] + $report['waste_frozen'], 2, '.', ',') ?></td>

        <td class="text-center"><?= $report['remarks'] ?></td>
      </tr>

      <?php $totalRMClear += $report['rm_clear'] ?>
      <?php $totalRMWhite += $report['rm_white'] ?>
      <?php $totalRMZakResin += $report['rm_zak_resin'] ?>
      <?php $totalRMReject += $report['rm_reject'] ?>

      <?php $totalFGClear += $report['fg_clear'] ?>
      <?php $totalFGWhite += $report['fg_white'] ?>
      <?php $totalFGNoblen += $report['fg_noblen'] ?>
      <?php $totalFGPurging += $report['fg_purging'] ?>

      <?php $totalWastePowder += $report['waste_powder'] ?>
      <?php $totalWasteFrozen += $report['waste_frozen'] ?>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="3" class="text-center">Total</th>
        <th class="text-end"><?= number_format($totalRMClear, 2, '.', ',') ?></th>
        <th class="text-end"><?= number_format($totalRMWhite, 2, '.', ',') ?></th>
        <th class="text-end"><?= number_format($totalRMZakResin, 2, '.', ',') ?></th>
        <th class="text-end"><?= number_format($totalRMReject, 2, '.', ',') ?></th>
        <th class="text-end"><?= number_format($totalRMClear + $totalRMWhite + $totalRMZakResin + $totalRMReject, 2, '.', ',') ?></th>
        
        <th class="text-end"><?= number_format($totalFGClear, 2, '.', ',') ?></th>
        <th class="text-end"><?= number_format($totalFGWhite, 2, '.', ',') ?></th>
        <th class="text-end"><?= number_format($totalFGNoblen, 2, '.', ',') ?></th>
        <th class="text-end"><?= number_format($totalFGPurging, 2, '.', ',') ?></th>
        <th class="text-end"><?= number_format($totalFGClear + $totalFGWhite  + $totalFGNoblen + $totalFGPurging, 2, '.', ',') ?></th>

        <th class="text-end"><?= number_format($totalWastePowder, 2, '.', ',') ?></th>
        <th class="text-end"><?= number_format($totalWasteFrozen, 2, '.', ',') ?></th>
        <th class="text-end"><?= number_format($totalWastePowder + $totalWasteFrozen, 2, '.', ',') ?></th>
      </tr>
    </tfoot>
  </table>
</body>
</html>