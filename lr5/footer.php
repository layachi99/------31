<footer class="site-footer mt-5">
    <div class="footer-top-nav">
        <div class="container">
            <ul class="footer-menu">
                <li><a href="enterprises.php">УПРАВЛЕНИЕ ПРЕДПРИЯТИЕМ</a></li>
                <li><a href="policy.html">ПОЛИТИКА ПОРТАЛА</a></li>
                <li><a href="#">ВЫСТАВКИ</a></li>
                <li><a href="about.html">О ПРОЕКТЕ</a></li>
                <li><a href="#">НОВОСТИ КОМПАНИЙ</a></li>
                <li><a href="#">ОБЗОР РЫНКОВ</a></li>
                <li><a href="#">СТАВКИ НА СПОРТ</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <span class="footer-year">2000 — 2025 © Equipnet.ru</span>
                    <div class="mt-2">
                        <small class="text-muted">Лабораторная работа №5 - PHP + MySQL</small>
                    </div>
                    <div class="footer-counter-wrap mt-2">
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <p class="footer-text">
                        Система управления производственными предприятиями.<br>
                        База данных MySQL, веб-интерфейс на PHP.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column align-items-md-end">
                        <p class="footer-text text-md-right mb-2">
                            <strong>База данных:</strong><br>
                            <small>10 регионов, 10 предприятий</small><br>
                            <small>10 показателей, 10 записей</small>
                        </p>
                        <div class="footer-social">
                            <a href="#" class="mr-2"><i class="fab fa-vk fa-lg"></i></a>
                            <a href="#"><i class="fab fa-youtube fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
    <?php if(isset($_GET['success'])): ?>
        alert('Операция выполнена успешно!');
    <?php endif; ?>
    $('.delete-btn').on('click', function() {
        return confirm('Вы уверены, что хотите удалить эту запись?');
    });
    $('.format-number').each(function() {
        var num = parseFloat($(this).text());
        if (!isNaN(num)) {
            $(this).text(num.toLocaleString('ru-RU'));
        }
    });
});
</script>
</body>
</html>