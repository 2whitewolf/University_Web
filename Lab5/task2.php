<?php
$errors = [];
$display_result = false;
$name = $age = $team = $ticket = '';
$updates = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize inputs
    $name = trim($_POST['name'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $team = $_POST['team'] ?? '';
    $ticket = $_POST['ticket'] ?? '';
    $updates = isset($_POST['updates']);

    // Validation
    if (empty($name)) {
        $errors[] = 'Поле "Имя" обязательно для заполнения.';
    }
    if (empty($age)) {
        $errors[] = 'Поле "Возраст" обязательно для заполнения.';
    } elseif (!is_numeric($age) || $age <= 0) {
        $errors[] = 'Возраст должен быть положительным числом.';
    }
    if (empty($team)) {
        $errors[] = 'Выберите любимую команду.';
    }
    if (empty($ticket)) {
        $errors[] = 'Выберите тип билета.';
    }
    if (!$updates) {
        $errors[] = 'Необходимо согласиться на получение обновлений.';
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
    <title>Регистрация на мероприятие Formula 1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        fieldset {
            border: 2px solid #e10600;
            padding: 20px;
            border-radius: 5px;
        }
        legend {
            font-size: 1.2em;
            color: #e10600;
            font-weight: bold;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .radio-group, .checkbox-group {
            margin-bottom: 15px;
        }
        .radio-group label, .checkbox-group label {
            display: inline-block;
            margin-right: 20px;
            font-weight: normal;
        }
        input[type="submit"], input[type="reset"] {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        input[type="submit"] {
            background-color: #e10600;
            color: #fff;
        }
        input[type="reset"] {
            background-color: #ccc;
            color: #333;
        }
        .error {
            color: #e10600;
            margin-bottom: 15px;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .result p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class="form-container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <fieldset>
            <legend>Регистрация на Гран-при Formula 1</legend>
            <div>
                <label for="name">Полное имя:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" placeholder="Введите ваше имя"/>
            </div>
            <div>
                <label for="age">Возраст:</label>
                <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($age); ?>" min="1" placeholder="Введите ваш возраст"/>
            </div>
            <div>
                <label for="team">Любимая команда:</label>
                <select name="team" id="team">
                    <option value="" <?php echo empty($team) ? 'selected' : ''; ?>>-- Выберите команду --</option>
                    <option value="Mercedes" <?php echo $team === 'Mercedes' ? 'selected' : ''; ?>>Mercedes</option>
                    <option value="Red Bull" <?php echo $team === 'Red Bull' ? 'selected' : ''; ?>>Red Bull</option>
                    <option value="Ferrari" <?php echo $team === 'Ferrari' ? 'selected' : ''; ?>>Ferrari</option>
                    <option value="McLaren" <?php echo $team === 'McLaren' ? 'selected' : ''; ?>>McLaren</option>
                    <option value="Aston Martin" <?php echo $team === 'Aston Martin' ? 'selected' : ''; ?>>Aston Martin</option>
                </select>
            </div>
            <div class="radio-group">
                <label>Тип билета:</label>
                <label><input type="radio" name="ticket" value="General" <?php echo $ticket === 'General' ? 'checked' : ''; ?>> Общий вход</label>
                <label><input type="radio" name="ticket" value="Grandstand" <?php echo $ticket === 'Grandstand' ? 'checked' : ''; ?>> Трибуна</label>
                <label><input type="radio" name="ticket" value="VIP" <?php echo $ticket === 'VIP' ? 'checked' : ''; ?>> VIP</label>
            </div>
            <div class="checkbox-group">
                <label><input type="checkbox" name="updates" value="yes" <?php echo $updates ? 'checked' : ''; ?>> Согласен получать обновления о мероприятии</label>
            </div>
            <div>
                <input type="submit" value="Зарегистрироваться"/>
                <input type="reset" value="Очистить"/>
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
        <div class="result">
            <h3>Ваша регистрация</h3>
            <p><strong>Полное имя:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Возраст:</strong> <?php echo htmlspecialchars($age); ?></p>
            <p><strong>Любимая команда:</strong> <?php echo htmlspecialchars($team); ?></p>
            <p><strong>Тип билета:</strong> <?php echo htmlspecialchars($ticket); ?></p>
            <p><strong>Получать обновления:</strong> <?php echo $updates ? 'Да' : 'Нет'; ?></p>
        </div>
    <?php endif; ?>
</div>
</body>
</html>