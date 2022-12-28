<?php
    session_start();
    if ($_SESSION['user']) {
        header('Location: feedback.php');
    }
    require_once '../components/header.php';
?>

<main class="d-flex justify-content-center align-items-center full-height bg-secondary">
    <form class="col-12 col-sm-10 col-md-6 col-lg-4 p-3 border rounded bg-secondary shadow-lg" action="../handlers/signup.php" method="post">
        <h1 class="mb-3">Регистрация</h1>
        <div class="form-floating mb-3 shadow-sm">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Введите Email">
            <label for="floatingInput">Введите Email</label>
        </div>
        <div class="form-floating mb-3 shadow-sm">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Введите пароль">
            <label for="floatingPassword">Введите пароль</label>
        </div>
        <div class="form-floating mb-3 shadow-sm">
            <input type="password" name="password-confirm" class="form-control" id="floatingPassword" placeholder="Повторите пароль">
            <label for="floatingPassword">Повторите пароль</label>
        </div>
        <?php
            if ($_SESSION['message']) {
                echo '<p class="mb-3">' . $_SESSION['message'] . '</p>';
            }
            unset($_SESSION['message']);
        ?>
        <div class="col-auto d-flex justify-content-end gap-3 mb-5">
            <button type="reset" class="btn btn-danger shadow-sm">Очистить форму</button>
            <button type="submit" class="btn btn-success shadow-sm">Зарегистрироваться</button>
        </div>
        <p class="text-center mb-0">Уже есть аккаунт? <a href="./login.php" class="text-decoration-none">Войти</a></p>
    </form>
</main>

<?php require_once '../components/footer.php' ?>