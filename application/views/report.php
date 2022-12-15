<!DOCTYPE html>
<html>

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Report</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <style type="text/css">
 { background-color:#FFFFE0;border-collapse:collapse;color:#000;font-size:18px; }
 th { background-color:#BDB76B;color:white;width:50%; }
 td,  th { padding:5px;border:0; }
 td { border-bottom:1px dotted #BDB76B; }
</style>
</head>

<body>
    <h1 class="text-center bg-info">Report Penjualan</h1>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th style="width: 150px;">Transaction</th>
                <th style="width: 90px;">User</th>
                <th style="width: 100px;">Total</th>
                <th style="width: 100px;">Date</th>
                <th style="width: 200px;">Item</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($data as $d) : ?>
                <tr>
                    <td style="text-align: center;"><?= $d->document_code ?></td>
                    <td style="text-align: center;"><?= $d->user ?></td>
                    <td><?= "Rp " . number_format($d->total, 0, ",", ".") . ',-'; ?></td>
                    <td style="text-align: center;"><?= $d->date ?></td>
                    <td style="min-height: 100px;">
                        <?php 
                        $item_ = $items[$d->document_code];
                        for ($i=0; $i < sizeof($item_); $i++) :?>
                                <?= $item_[$i]->product_name . ' X ' . $item_[$i]->quantity ?> <br>
                        <?php endfor ?>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        <tbody>
    </table>
</body>

</html>