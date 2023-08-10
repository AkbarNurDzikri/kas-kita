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
  </style>
</head>
<body>
  <table border="1">
    <thead>
      <tr>
        <th rowspan="3">No.</th>
        <th rowspan="3">Tanggal</th>
        <th rowspan="3">Shift</th>
        <th rowspan="3">Operator Recycle</th>
        <th rowspan="3">Mesin</th>
        <th colspan="6">Raw Materials</th>
      </tr>
      <tr>
        <th colspan="2">BM1</th>
        <th colspan="2">BM2</th>
        <th colspan="2">Other Materials</th>
      </tr>
      <tr>
        <th>Product Spec</th>
        <th>Qty</th>
        <th>Product Spec</th>
        <th>Qty</th>
        <th>Product Spec</th>
        <th>Qty</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; ?>
      <?php foreach($data['reportDetails'] as $report) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $report['tanggal'] ?></td>
          <td><?= $report['shift'] ?></td>
          <td><?= $report['operator1'] . ', ' . $report['operator2'] ?></td>
          <td><?= $report['machine'] ?></td>
          <td><?= $report['bm1_material_specs'] ?></td>
          <td><?= $report['bm1_material_qty'] ?></td>
          <td><?= $report['bm2_material_specs'] ?></td>
          <td><?= $report['bm2_material_qty'] ?></td>
          <td><?= $report['other_material_specs'] ?></td>
          <td><?= $report['other_material_qty'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>