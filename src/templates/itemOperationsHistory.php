<?php
    /** @var $operations */
    /** @var $changeRealSumRoute */
    /** @var $operationHistoryChangeRoute */
?>

<main class="background-color: bg-white container-fluid text-center">
    <h1>История операций</h1>
    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th scope="col">Месяц</th>
            <th scope="col">Остаток</th>
            <th scope="col">Прибыль</th>
            <th scope="col">Вклад</th>
            <th scope="col">Расходы</th>
            <th scope="col">Теор. сумма</th>
            <th scope="col">Реал. сумма</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($operations as $operation): ?>
            <tr>
                <td><?= $operation['month']; ?></td>
                <td><?= $operation['balance']; ?></td>
                <td><?= $operation['profit']; ?></td>
                <td><?= $operation['deposit']; ?></td>
                <td><?= $operation['expense']; ?></td>
                <th scope="col"><?= $operation['teor_sum']; ?></th>
                <th scope="col"><?= $operation['real_sum']; ?></th>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="<?= $operationHistoryChangeRoute; ?>" class="btn btn-secondary mb-3">Изменить реальную сумму</a>
</main>
