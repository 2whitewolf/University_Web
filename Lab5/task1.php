<?php
$errors = [];
$display_result = false;
$name = $email = $review = $comment = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and trim input values
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $review = $_POST['review'] ?? '';
    $comment = trim($_POST['comment'] ?? '');

    // Validation
    if (empty($name)) {
        $errors[] = 'Поле "Имя" обязательно для заполнения.';
    }
    if (empty($email)) {
        $errors[] = 'Поле "Email" обязательно для заполнения.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Введите корректный email адрес.';
    }
    if (empty($review)) {
        $errors[] = 'Выберите оценку сервиса.';
    }
    if (empty($comment)) {
        $errors[] = 'Поле "Комментарий" обязательно для заполнения.';
    }

    // If no errors, allow displaying the result
    if (empty($errors)) {
        $display_result = true;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма отзыва</title>
    <style>
        .form { max-width: 500px; margin: 20px auto; }
        fieldset { padding: 20px; }
        label { font-weight: bold; }
        input, textarea { width: 100%; padding: 5px; margin-top: 5px; }
        .error { color: red; }
    </style>
</head>
<body>
<div class="form">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <fieldset>
            <legend>Оставьте отзыв!</legend>
            <div id="main_info" style="display: flex; flex-direction: column; gap: 10px;">
                <div>
                    <label for="name">Имя:
                        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>"/>
                    </label>
                </div>
                <div>
                    <label for="email">Email:
                        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>"/>
                    </label>
                </div>
            </div>
            <div id="extra_info">
                <div>
                    <p><label for="review">Оцените наш сервис!</label></p>
                    <div style="display: flex; flex-direction: column;">
                        <p><input type="radio" name="review" value="10" <?php echo ($review === '10') ? 'checked' : ''; ?>>Хорошо</p>
                        <p><input type="radio" name="review" value="8" <?php echo ($review === '8') ? 'checked' : ''; ?>>Удовлетворительно</p>
                        <p><input type="radio" name="review" value="5" <?php echo ($review === '5') ? 'checked' : ''; ?>>Плохо</p>
                    </div>
                </div>
            </div>
            <div id="message_info">
                <div>
                    <p><label for="comment">Ваш комментарий: </label></p>
                    <textarea id="comment" name="comment" cols="30" rows="10" class="comment"><?php echo htmlspecialchars($comment); ?></textarea>
                </div>
            </div>
            <div id="buttons" style="display: flex; flex-direction: row; gap: 10px; margin-top: 10px;">
                <input type="submit" value="Отправить"/>
                <input type="reset" value="Удалить"/>
            </div>
        </fieldset>
    </form>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($display_result): ?>
        <div id="result">
            <p>Ваше имя: <b><?php echo htmlspecialchars($name); ?></b></p>
            <p>Ваш e-mail: <b><?php echo htmlspecialchars($email); ?></b></p>
            <p>Оценка товара: <b><?php echo htmlspecialchars($review); ?></b></p>
            <p>Ваше сообщение: <b><?php echo htmlspecialchars($comment); ?></b></p>
        </div>
    <?php endif; ?>
</div>
</body>
</html>