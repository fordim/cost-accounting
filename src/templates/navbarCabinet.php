<?php
    /** @var $mainRoute */
    /** @var $cabinetRoute */
    /** @var $historyRoute */
    /** @var $categoryRoute */
    /** @var $userName */
    /** @var $logoutRoute */
    /** @var $cashingRoute */
    /** @var $cashingHistoryRoute */
    /** @var $operationRoute */
    /** @var $operationHistoryRoute */
?>

<nav class="navbar navbar-dark navbar-expand-md bg-dark sticky-top container-fluid">
    <a href="#" class="navbar-brand">
        <img src="img/user.svg" alt="ava" width="50" height="50">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a href="<?= $mainRoute; ?>" class="nav-link">Главная</a>
            </li>
            <li class="nav-item active">
                <a href="<?= $cabinetRoute; ?>" class="nav-link">Внесение расходов</a>
            </li>
            <li class="nav-item active">
                <a href="<?= $historyRoute; ?>" class="nav-link">История</a>
            </li>
            <li class="nav-item active">
                <a href="<?= $categoryRoute; ?>" class="nav-link">Категории</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Операции
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item text-white" href="<?= $cashingRoute; ?>">Обналичивание</a>
                    <a class="dropdown-item text-white" href="<?= $cashingHistoryRoute; ?>">История обналичивания</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-white" href="<?= $operationRoute; ?>">Операции</a>
                    <a class="dropdown-item text-white" href="<?= $operationHistoryRoute; ?>">История операций</a>
                </div>
        </ul>
        <ul class="navbar-nav my-sm-0">
            <li class="nav-item active">
                <a href="#" class="nav-link"><?= $userName['name']; ?></a>
            </li>
            <li class="nav-item active">
                <a class="btn btn-outline-light my-2 my-sm-0" href="<?= $logoutRoute; ?>">Выйти</a>
            </li>
        </ul>
    </div>
</nav>
