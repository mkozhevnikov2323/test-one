<?php
    session_start();
    if (!$_SESSION['user']) {
        header('Location: login.php');
    }
    require_once '../components/header.php';
?>

<header class="container-fluid bg-dark fixed-top">
    <nav class="navbar bg-dark container d-flex justify-content-end">
        <a class="btn btn-sm btn-outline-secondary" href="../handlers/logout.php">Выход из аккаунта</a>
    </nav>
</header>
<main class="d-flex justify-content-center align-items-center full-height bg-secondary">
    <form class="col-12 col-sm-10 col-md-6 col-lg-4 p-3 border rounded bg-secondary shadow-lg" action="../handlers/sendFeedback.php" method="post">
        <h1 class="mb-3">Обратная связь</h1>
        <p>Пользователь: <?= $_SESSION['user']['email'] ?></p>

        <fieldset class="mb-3">
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control shadow-sm" id="floatingInput" placeholder="Введите имя" value="<?= $_SESSION['user']['name'] ?? '' ?>" required>
                <label for="floatingInput">Введите имя:</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control mh-150 shadow-sm" name="comment" placeholder="Leave a comment here" id="floatingTextarea" maxlength="350" required><?= $_SESSION['user']['comment'] ?? '' ?></textarea>
                <label for="floatingTextarea">Комментарий:</label>
            </div>
            <div class="form-floating">
                <select class="form-select shadow-sm" name="employeeCategory[]" id="floatingSelect" aria-label="Floating label select example">
                    <option value="0" selected>Категория сотрудника:</option>
                    <option value="1">Руководитель</option>
                    <option value="2">Ведущий специалист</option>
                    <option value="3">Специалист</option>
                </select>
                <label for="floatingSelect">Выберите категорию:</label>
            </div>
        </fieldset>

        <fieldset class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions[]" id="inlineRadio1" value="1" checked>
                <label class="form-check-label" for="inlineRadio1">Отзыв</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions[]" id="inlineRadio2" value="2">
                <label class="form-check-label" for="inlineRadio2">Предложение</label>
            </div>
        </fieldset>

        <fieldset class="mb-5">
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="salesDepartment" type="checkbox" id="inlineCheckbox1" value="1" >
                <label class="form-check-label" for="inlineCheckbox1">Отдел продаж</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="supplyDepartment" type="checkbox" id="inlineCheckbox2" value="1" >
                <label class="form-check-label" for="inlineCheckbox2">Отдел снабжения</label>
            </div>
        </fieldset>

        <?php
        if ($_SESSION['message']) {
            echo '<p class="mb-3">' . $_SESSION['message'] . '</p>';
        }
        unset($_SESSION['message']);

        if ($_SESSION['errorMessage']) {
            echo '<p class="mb-3 text-danger">' . $_SESSION['errorMessage'] . '</p>';
        }
        unset($_SESSION['errorMessage']);
        ?>

        <fieldset class="d-flex justify-content-end gap-3">
            <?php
            if ($_SESSION['user']['name'] or $_SESSION['user']['comment']) {
                echo '<a href="../src/functions/reselFields.php?reset=true" class="btn btn-danger shadow-sm">Очистить форму</a>';
            } else {
                echo '<button type="reset" class="btn btn-danger shadow-sm">Очистить форму</button>';
            }
            ?>
            <button type="submit" class="btn btn-success shadow-sm">Отправить сообщение</button>
        </fieldset>
    </form>
</main>

<?php require_once '../components/footer.php' ?>