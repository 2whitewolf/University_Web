<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест по Формуле-1</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('https://images.pexels.com/photos/701349/pexels-photo-701349.jpeg?auto=compress&cs=tinysrgb&w=1920') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 20px;
            color: #333;
            /* Запасной градиентный фон */
            background-image: linear-gradient(to bottom, #e0e0e0, #b0b0b0);
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #d32f2f;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
        .question {
            margin-bottom: 20px;
        }
        .error {
            color: #d32f2f;
            display: none;
            font-size: 0.9em;
        }
        #result {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.95);
            display: none;
        }
        .correct {
            color: #2e7d32;
            font-weight: bold;
        }
        .incorrect {
            color: #d32f2f;
            font-weight: bold;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background: #d32f2f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            transition: background 0.3s;
        }
        button:hover {
            background: #b71c1c;
        }
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="radio"], input[type="checkbox"] {
            margin-right: 10px;
        }
        label {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Тест по Формуле-1</h1>
        <div>
            <label for="username">Ваше имя:</label>
            <input type="text" id="username" name="username" placeholder="Введите ваше имя">
            <p id="usernameError" class="error">Пожалуйста, введите ваше имя.</p>
        </div>

        <div class="question">
            <p>1. Кто выиграл чемпионат Формулы-1 в 2024 году?</p>
            <input type="radio" name="q1" value="Verstappen" id="q1a"> <label for="q1a">Макс Ферстаппен</label><br>
            <input type="radio" name="q1" value="Norris" id="q1b"> <label for="q1b">Ландо Норрис</label><br>
            <input type="radio" name="q1" value="Hamilton" id="q1c"> <label for="q1c">Льюис Хэмилтон</label><br>
            <p id="q1Error" class="error">Пожалуйста, выберите ответ.</p>
        </div>

        <div class="question">
            <p>2. Какие команды вошли в тройку лидеров в Кубке конструкторов 2024?</p>
            <input type="checkbox" name="q2" value="RedBull" id="q2a"> <label for="q2a">Red Bull</label><br>
            <input type="checkbox" name="q2" value="McLaren" id="q2b"> <label for="q2b">McLaren</label><br>
            <input type="checkbox" name="q2" value="Ferrari" id="q2c"> <label for="q2c">Ferrari</label><br>
            <input type="checkbox" name="q2" value="Mercedes" id="q2d"> <label for="q2d">Mercedes</label><br>
            <p id="q2Error" class="error">Пожалуйста, выберите хотя бы один вариант.</p>
        </div>

        <div class="question">
            <p>3. На какой трассе проходит Гран-при Монако?</p>
            <input type="radio" name="q3" value="Monaco" id="q3a"> <label for="q3a">Монте-Карло</label><br>
            <input type="radio" name="q3" value="Monza" id="q3b"> <label for="q3b">Монца</label><br>
            <input type="radio" name="q3" value="Silverstone" id="q3c"> <label for="q3c">Сильверстоун</label><br>
            <p id="q3Error" class="error">Пожалуйста, выберите ответ.</p>
        </div>

        <button onclick="submitTest()">Отправить</button>

        <div id="result"></div>
    </div>

    <script>
        function submitTest() {
            // Скрыть все сообщения об ошибках и результаты
            document.querySelectorAll('.error').forEach(el => el.style.display = 'none');
            document.getElementById('result').style.display = 'none';

            // Получить значения
            const username = document.getElementById('username').value.trim();
            const q1 = document.querySelector('input[name="q1"]:checked');
            const q2 = document.querySelectorAll('input[name="q2"]:checked');
            const q3 = document.querySelector('input[name="q3"]:checked');

            // Проверка заполнения
            let isValid = true;

            if (!username) {
                document.getElementById('usernameError').style.display = 'block';
                isValid = false;
            }
            if (!q1) {
                document.getElementById('q1Error').style.display = 'block';
                isValid = false;
            }
            if (q2.length === 0) {
                document.getElementById('q2Error').style.display = 'block';
                isValid = false;
            }
            if (!q3) {
                document.getElementById('q3Error').style.display = 'block';
                isValid = false;
            }

            // Если все поля заполнены, оценить ответы и показать результаты
            if (isValid) {
                let score = 0;
                let resultHtml = `<h2>Результаты теста для ${username}</h2>`;

                // Вопрос 1
                const q1Correct = q1.value === 'Verstappen';
                if (q1Correct) score++;
                resultHtml += `
                    <p>1. Кто выиграл чемпионат Формулы-1 в 2024 году? 
                    Ваш ответ: <span class="${q1Correct ? 'correct' : 'incorrect'}">${q1.value}</span>. 
                    Правильный ответ: Verstappen</p>`;

                // Вопрос 2
                const q2Answers = Array.from(q2).map(cb => cb.value);
                const correctQ2 = ['McLaren', 'Ferrari', 'RedBull'];
                const isQ2Correct = q2Answers.length === 3 && 
                    q2Answers.every(ans => correctQ2.includes(ans)) && 
                    correctQ2.every(correct => q2Answers.includes(correct));
                if (isQ2Correct) score++;
                resultHtml += `
                    <p>2. Какие команды вошли в тройку лидеров в Кубке конструкторов 2024? 
                    Ваш ответ: <span class="${isQ2Correct ? 'correct' : 'incorrect'}">${q2Answers.join(', ')}</span>. 
                    Правильный ответ: McLaren, Ferrari, Red Bull</p>`;

                // Вопрос 3
                const q3Correct = q3.value === 'Monaco';
                if (q3Correct) score++;
                resultHtml += `
                    <p>3. На какой трассе проходит Гран-при Монако? 
                    Ваш ответ: <span class="${q3Correct ? 'correct' : 'incorrect'}">${q3.value}</span>. 
                    Правильный ответ: Monaco</p>`;

                // Итоговый результат
                resultHtml += `<p><strong>Ваш результат: ${score} из 3</strong></p>`;

                document.getElementById('result').innerHTML = resultHtml;
                document.getElementById('result').style.display = 'block';
            }
        }
    </script>
</body>
</html>