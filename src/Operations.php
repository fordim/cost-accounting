<?php

namespace App;

final class Operations
{
    private const HOST = 'localhost';
    private const DATABASE = 'accounting';
    private const USER = 'root';
    private const PASSWORD = '';

    /** @var Database */
    private static $instance = null;

    private $link = null;

    private function __construct()
    {
        $this->link = @mysqli_connect(
            self::HOST,
            self::USER,
            self::PASSWORD,
            self::DATABASE
        ) or die('Ошибка подключения к MySQL' . mysqli_error($this->link));
    }

    public function __destruct()
    {
        @mysqli_close($this->link);
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new Operations();
        }
        return self::$instance;
    }

    private function fetchData(string $sql): array {
        $result = mysqli_query($this->link, $sql) or die('Ошибка ' . mysqli_error($this->link));
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    private function requestVerification(string $escapestr): string
    {
        return htmlentities(mysqli_real_escape_string($this->link, $escapestr));
    }

    private function insertData(string $sql): int
    {
        $result = mysqli_query($this->link, $sql) or die ('Ошибка, при попытке сделать запись в БД ' . mysqli_error($this->link));
        return mysqli_insert_id($this->link);
    }

    public function processFormAddCashing(string $name, float $sum, string $card, float $percent, int $userId){
        $name = $this->requestVerification($name);
        $sum = $this->requestVerification($sum);
        $profit = $sum * ($percent/100);

        $sql = "INSERT INTO history_cashing(user_id, name, amount, card, percent, profit)
                VALUE ($userId, '$name', $sum, '$card', $percent, $profit)";

        $this->insertData($sql);
    }

    public function getUserCashingHistory(int $userId, string $dateFrom, string $dateTo){
        $dateFrom = $this->requestVerification($dateFrom);
        $dateTo = $this->requestVerification($dateTo);
        $sql = "SELECT hc.created_at, hc.name, hc.amount, hc.card, hc.percent, hc.profit
                FROM history_cashing as hc
                JOIN users AS u ON hc.user_id = u.id
                WHERE u.id = $userId AND DATE(hc.created_at) BETWEEN '$dateFrom' AND '$dateTo'
                ORDER BY hc.created_at";

        return $this->fetchData($sql);
    }

    public function getSummaryOfCashingProfit(int $userId, string $dateFrom, string $dateTo){
        $dateFrom = $this->requestVerification($dateFrom);
        $dateTo = $this->requestVerification($dateTo);
        $sql = "SELECT hc.profit
                FROM history_cashing as hc
                JOIN users AS u ON hc.user_id = u.id
                WHERE u.id = $userId AND DATE(hc.created_at) BETWEEN '$dateFrom' AND '$dateTo'";

        $arProfit = $this->fetchData($sql);
        $allProfit = 0;
        for($i = 0; $i <= count($arProfit) - 1; $i++){
            $allProfit += $arProfit[$i]['profit'];
        }

        return $allProfit;
    }

    public function getSummaryOfCashingAmount(int $userId, string $dateFrom, string $dateTo){
        $dateFrom = $this->requestVerification($dateFrom);
        $dateTo = $this->requestVerification($dateTo);
        $sql = "SELECT hc.amount
                FROM history_cashing as hc
                JOIN users AS u ON hc.user_id = u.id
                WHERE u.id = $userId AND DATE(hc.created_at) BETWEEN '$dateFrom' AND '$dateTo'";

        $arAmount = $this->fetchData($sql);
        $allAmount = 0;
        for($i = 0; $i <= count($arAmount) - 1; $i++){
            $allAmount += $arAmount[$i]['amount'];
        }

        return $allAmount;
    }

    public function processFormAddOperation(string $month, float $sum, float $profit, float $deposit, float $expenseFlat, float $expensePetrol, int $userId){
        $sum = $this->requestVerification($sum);
        $deposit = $this->requestVerification($deposit);
        $expenseFlat = $this->requestVerification($expenseFlat);
        $expensePetrol = $this->requestVerification($expensePetrol);

        $expense = $expenseFlat + $expensePetrol;

        $sql = "INSERT INTO history_operations(user_id, month, teor_sum, profit, deposit, expense)
                VALUE ($userId, '$month', $sum, $profit, $deposit, $expense)";

        $this->insertData($sql);
    }

    public function getUserOperationsHistory(int $userId){
        $sql = "SELECT ho.month, ho.teor_sum, ho.profit, ho.deposit
                FROM history_operations as ho
                JOIN users AS u ON ho.user_id = u.id
                WHERE u.id = $userId
                ORDER BY ho.month";

        return $this->fetchData($sql);
    }
}
