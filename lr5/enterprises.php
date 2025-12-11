<?php
include 'db_connect.php';
$page_title = "Производственные предприятия - База данных";
$region_filter = isset($_GET['region']) ? intval($_GET['region']) : 0;
$search_filter = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$min_output = isset($_GET['min_output']) ? floatval($_GET['min_output']) : 0;
$sql = "SELECT e.*, r.name as region_name 
        FROM enterprises e 
        LEFT JOIN regions r ON e.region_id = r.id 
        WHERE 1=1";
if ($region_filter > 0) {
    $sql .= " AND e.region_id = $region_filter";
}
if (!empty($search_filter)) {
    $sql .= " AND e.name LIKE '%$search_filter%'";
}
if ($min_output > 0) {
    $sql .= " AND e.annual_output_rub >= $min_output";
}
$sql .= " ORDER BY e.annual_output_rub DESC";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Ошибка запроса: " . mysqli_error($conn));
}
$regions_sql = "SELECT * FROM regions ORDER BY name";
$regions_result = mysqli_query($conn, $regions_sql);
?>

<?php include 'header.php'; ?>

<main class="py-4">
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h1 class="h2 mb-2"><i class="fas fa-industry text-primary mr-2"></i>Производственные предприятия</h1>
                <p class="text-muted mb-0">База данных производственных предприятий России</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="add_enterprise.php" class="btn btn-success">
                    <i class="fas fa-plus-circle mr-1"></i> Добавить
                </a>
            </div>
        </div>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="" class="row">
                    <div class="col-md-4 mb-3">
                        <select class="form-control" name="region">
                            <option value="0">Все регионы</option>
                            <?php while($region = mysqli_fetch_assoc($regions_result)): ?>
                                <option value="<?= $region['id'] ?>" 
                                    <?= ($region_filter == $region['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($region['name']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="text" class="form-control" name="search" 
                               value="<?= htmlspecialchars($search_filter) ?>"
                               placeholder="Поиск...">
                    </div>
                    <div class="col-md-4 mb-3">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-search mr-1"></i> Поиск
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <?php if(mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): 
                    $enterprise_id = $row['id'];
                    $image_path = "";
                    if (file_exists("images/" . $enterprise_id . ".jpg")) {
                        $image_path = "images/" . $enterprise_id . ".jpg";
                    }
                    else {
                        $image_path = "images/default.jpg";
                    }
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border">
                            <div class="card-img-top-container" style="height: 200px; overflow: hidden;">
                                <img src="<?= $image_path ?>" 
                                     class="card-img-top"
                                     alt="<?= htmlspecialchars($row['name']) ?>"
                                     style="width: 100%; height: 100%; object-fit: cover;"
                                     onerror="this.src='images/default.jpg'">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-primary mb-2">
                                    <?= htmlspecialchars($row['name']) ?>
                                </h5>
                                <div class="mb-3">
                                    <span class="badge badge-info">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        <?= htmlspecialchars($row['region_name']) ?>
                                    </span>
                                </div>
                                <p class="card-text text-muted small">
                                    <?= htmlspecialchars(substr($row['description'], 0, 100)) ?>
                                    <?php if(strlen($row['description']) > 100): ?>...<?php endif; ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        <small class="text-muted">Выработка:</small><br>
                                        <span class="text-success font-weight-bold">
                                            <?= number_format($row['annual_output_rub'], 0, '.', ' ') ?> ₽
                                        </span>
                                    </div>
                                    <div>
                                        <span class="badge badge-secondary">
                                            ID: <?= $enterprise_id ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top-0 pt-0">
                                <div class="d-flex justify-content-between">
                                    <a href="enterprise_detail.php?id=<?= $row['id'] ?>" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye mr-1"></i> Подробнее
                                    </a>
                                    <a href="edit_enterprise.php?id=<?= $row['id'] ?>" 
                                       class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-edit mr-1"></i> Редактировать
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-industry fa-4x text-light"></i>
                            </div>
                            <h4 class="text-muted mb-3">Предприятия не найдены</h4>
                            <a href="add_enterprise.php" class="btn btn-primary">
                                <i class="fas fa-plus-circle mr-1"></i> Добавить предприятие
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<style>
.card {
    transition: transform 0.3s;
    border-radius: 10px;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.card-img-top-container {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.badge {
    font-weight: 500;
    padding: 5px 10px;
}
.btn-sm {
    padding: 5px 10px;
    font-size: 0.875rem;
}
</style>

<?php include 'footer.php'; ?>

<?php
mysqli_free_result($result);
mysqli_free_result($regions_result);
mysqli_close($conn);
?>