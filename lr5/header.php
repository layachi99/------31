<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= isset($page_title) ? $page_title : 'Управление предприятиями' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 d-flex align-items-center mb-2 mb-md-0">
                    <a href="enterprises.php" class="d-flex align-items-center text-decoration-none">
                        <img src="images/logo.svg" class="header-logo" alt="EQUIPNET.RU">
                        <div class="top-header__subtitle ml-2">Управление предприятиями</div>
                    </a>
                </div>
                <div class="col-md-4 header-search mb-2 mb-md-0">
                    <form method="GET" action="enterprises.php">
                        <div class="input-group header-search-group">
                            <input class="form-control header-search-input"
                                   name="search" 
                                   placeholder="Найти предприятие"
                                   value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                            <div class="input-group-append">
                                <button class="btn header-search-btn" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 d-flex justify-content-md-end align-items-center header-right">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <span class="text-white mr-3"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                        <a href="logout.php" class="btn header-login-btn">Выйти</a>
                    <?php else: ?>
                        <a href="enterprises.php" class="header-link mr-3">Предприятия</a>
                        <a href="indicators.php" class="header-link mr-3">Показатели</a>
                        <a href="login.php" class="btn header-login-btn">Войти</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark p-0">
                <button class="navbar-toggler ml-auto" type="button"
                        data-toggle="collapse" data-target="#mainNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" href="enterprises.php"><i class="fas fa-industry mr-1"></i> ПРЕДПРИЯТИЯ</a></li>
                        <li class="nav-item"><a class="nav-link" href="indicators.php"><i class="fas fa-chart-line mr-1"></i> ПОКАЗАТЕЛИ</a></li>
                        <li class="nav-item"><a class="nav-link" href="regions.php"><i class="fas fa-map-marker-alt mr-1"></i> РЕГИОНЫ</a></li>
                        <li class="nav-item"><a class="nav-link" href="journal.php"><i class="fas fa-book mr-1"></i> ЖУРНАЛЫ</a></li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="stats.php"><i class="fas fa-chart-pie mr-1"></i> Статистика</a></li>
                        <li class="nav-item"><a class="nav-link" href="reports.php"><i class="fas fa-file-alt mr-1"></i> Отчеты</a></li>
                        <li class="nav-item"><a class="nav-link" href="export.php"><i class="fas fa-download mr-1"></i> Экспорт</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>