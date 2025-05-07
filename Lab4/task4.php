<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 4: Associative Arrays and Functions</title>
    <style>
        table { border-collapse: collapse; width: 100%; max-width: 800px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Task 4: Associative Arrays and Functions</h1>
    <?php
    $transactions = [
        [
            "transaction_id" => 1,
            "transaction_date" => "2019-01-01",
            "transaction_amount" => 100.00,
            "transaction_description" => "Payment for groceries",
            "merchant_name" => "SuperMart",
        ],
        [
            "transaction_id" => 2,
            "transaction_date" => "2020-02-15",
            "transaction_amount" => 75.50,
            "transaction_description" => "Dinner with friends",
            "merchant_name" => "Local Restaurant",
        ],
        [
            "transaction_id" => 3,
            "transaction_date" => "2021-03-10",
            "transaction_amount" => 50.25,
            "transaction_description" => "Online subscription",
            "merchant_name" => "Streaming Service",
        ],
        [
            "transaction_id" => 4,
            "transaction_date" => "2022-04-20",
            "transaction_amount" => 200.75,
            "transaction_description" => "Electronics purchase",
            "merchant_name" => "Tech Store",
        ],
    ];

    function calculateTotalAmount($transactions) {
        return array_reduce($transactions, function($carry, $item) {
            return $carry + $item['transaction_amount'];
        }, 0);
    }

    function calculateAverage($transactions) {
        if (count($transactions) === 0) return 0;
        return calculateTotalAmount($transactions) / count($transactions);
    }

    function mapTransactionDescriptions($transactions) {
        return array_map(function($transaction) {
            return $transaction['transaction_description'];
        }, $transactions);
    }
    ?>
    <table>
        <tr style="background-color: #a6a6a6; color: #252525">
            <th colspan="5">Transaction Records</th>
        </tr>
        <tr style="background-color: #a6a6a6; color: #252525">
            <th>ID</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Description</th>
            <th>Merchant</th>
        </tr>
        <?php foreach ($transactions as $transaction) { ?>
            <tr>
                <td><?php echo $transaction['transaction_id']; ?></td>
                <td><?php echo $transaction['transaction_date']; ?></td>
                <td><?php echo number_format($transaction['transaction_amount'], 2); ?></td>
                <td><?php echo $transaction['transaction_description']; ?></td>
                <td><?php echo $transaction['merchant_name']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <?php
    echo "<br>Total Amount: $" . number_format(calculateTotalAmount($transactions), 2);
    echo "<br>Average Amount: $" . number_format(calculateAverage($transactions), 2);
    echo "<br>Descriptions: <pre>";
    print_r(mapTransactionDescriptions($transactions));
    echo "</pre>";
    ?>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>