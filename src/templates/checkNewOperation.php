<?php
    /** @var $userMonth */
    /** @var $userBalance */
    /** @var $userProfit */
    /** @var $userDeposit */
    /** @var $expenseFlat */
    /** @var $operationRoute */
    /** @var $operationHistoryRoute */
?>

<main class="background-color: bg-white container-fluid">
    <div class="text-center mainForm">
        <h1 class="font-weight-bold">Данные успешно добавлены</h1>
        <div class="userData">
            <p class="m-0"><strong>Месяц</strong> - <?= $userMonth; ?></p>
            <p class="m-0"><strong>Остаток</strong> - <?= $userBalance; ?></p>
            <p class="m-0"><strong>Прибыль</strong> - <?= $userProfit; ?></p>
            <p class="m-0"><strong>Вклад</strong> - <?= $userDeposit; ?></p>
            <p class="m-0"><strong>Расходы за квартиру</strong> - <?= $expenseFlat; ?></p>
        </div>
        <div class="row" >
            <a class="btn btn-outline-dark m-3 col" href="<?= $operationRoute; ?>">Добавить ещё запись</a>
            <a class="btn btn-outline-dark m-3 col" href="<?= $operationHistoryRoute; ?>">Перейти к истории</a>
        </div>
    </div>
</main>
