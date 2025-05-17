<?php
// Initialize variables for form data and errors
$name = $email = $comment = "";
$nameErr = $emailErr = $commentErr = $agreementErr = "";
$successMessage = "";

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Form validation on submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Name validation
    if (empty($_POST["name"])) {
        $nameErr = "Имя обязательно.";
    } else {
        $name = test_input($_POST["name"]);
        if (strlen($name) < 3 || strlen($name) > 20) {
            $nameErr = "Имя должно быть от 3 до 20 символов.";
        } elseif (!preg_match("/^[a-zA-Zа-яА-Я ]*$/", $name)) {
            $nameErr = "Запрещены специальные символы в имени.";
        }
    }

    // Email validation
    if (empty($_POST["email"])) {
        $emailErr = "Электронная почта обязательна.";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Адрес электронной почты должен соответствовать стандартам.";
        }
    }

    // Comment validation (optional, but validate if provided)
    if (!empty($_POST["comment"])) {
        $comment = test_input($_POST["comment"]);
        if (strlen($comment) > 500) { // Adding a reasonable max length for comments
            $commentErr = "Комментарий слишком длинный.";
        }
    }

    // Data processing agreement validation
    if (!isset($_POST["agreement"])) {
        $agreementErr = "Необходимо отметить согласие на обработку данных.";
    }

    // If no errors, process the form
    if ($nameErr == "" && $emailErr == "" && $commentErr == "" && $agreementErr == "") {
        $successMessage = "Форма успешно отправлена!";
        // Here you can add code to save the data (e.g., to a database)
        $name = $email = $comment = ""; // Reset fields after successful submission
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма комментариев</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"], textarea {
            width: 100%;
            max-width: 400px;
            padding: 8px;
            margin-bottom: 5px;
        }
        textarea {
            height: 100px;
        }
    </style>
</head>
<body>
    <h2>#write-comment</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>">
            <span class="error"><?php echo $nameErr; ?></span>
        </div>

        <div class="form-group">
            <label for="email">Электронная почта:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $emailErr; ?></span>
        </div>

        <div class="form-group">
            <label for="comment">Комментарий:</label>
            <textarea id="comment" name="comment"><?php echo $comment; ?></textarea>
            <span class="error"><?php echo $commentErr; ?></span>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="agreement" <?php if (isset($_POST["agreement"])) echo "checked"; ?>>
                Согласен с обработкой данных?
            </label>
            <span class="error"><?php echo $agreementErr; ?></span>
        </div>

        <input type="submit" value="Отправить">
    </form>

    <?php if ($successMessage != ""): ?>
        <p class="success"><?php echo $successMessage; ?></p>
    <?php endif; ?>
</body>
</html>