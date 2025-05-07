<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 4 (Additional): Class-Based Transactions</title>
    <style>
        table { border-collapse: collapse; width: 100%; max-width: 800px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Task 4 (Additional): Class-Based Transactions</h1>
    <?php
    class Transaction {
        private $id;
        private $date;
        private $amount;
        private $description;
        private $merchant;

        public function __construct($id, $date, $amount, $description, $merchant) {
            $this->id = $id;
            $this->date = $date;
            $this->amount = $amount;
            $this->description = $description;
            $this->merchant = $merchant;
        }

        public function getId() { return $this->id; }
        public function getDate() { return $this->date; }
        public function getAmount() { return $this->amount; }
        public function getDescription() { return $this->description; }
        public function getMerchant() { return $this->merchant; }

        public static function calculateTotalAmount($transactions) {
            return array_reduce($transactions, function($carry, $item) {
                return $carry + $item->getAmount();
            }, 0);
        }

        public static function calculateAverage($transactions) {
            if (count($transactions) === 0) return 0;
            return self::calculateTotalAmount($transactions) / count($transactions);
        }
    }

    $transactions = [
        new Transaction(1, "2019-01-01", 100.00, "Payment for groceries", "SuperMart"),
        new Transaction(2, "2020-02-15", 75.50, "Dinner with friends", "Local Restaurant"),
        new Transaction(3, "2021-03-10", 50.25, "Online subscription", "Streaming Service"),
        new Transaction(4, "2022-04-20", 200.75, "Electronics purchase", "Tech Store"),
    ];
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
                <td><?php echo $transaction->getId(); ?></td>
                <td><?php echo $transaction->getDate(); ?></td>
                <td><?php echo number_format($transaction->getAmount(), 2); ?></td>
                <td><?php echo $transaction->getDescription(); ?></td>
                <td><?php echo $transaction->getMerchant(); ?></td>
            </tr>
        <?php } ?>
    </table>
    <?php
    echo "<br>Total Amount: $" . number_format(Transaction::calculateTotalAmount($transactions), 2);
    echo "<br>Average Amount: $" . number_format(Transaction::calculateAverage($transactions), 2);
    ?>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>