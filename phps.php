<?php

//$cacheFile = 'cache/data.cache';
//$cacheTime = 3600; // Время жизни кеша (1 час)
//
//// Проверяем, существует ли кеш и не устарел ли он
//if (file_exists($cacheFile) && time() - filemtime($cacheFile) < $cacheTime) {
//    // Если кеш актуален, используем его
//    $data = file_get_contents($cacheFile);
//} else {
//    // Если кеша нет или он устарел, генерируем данные
//    $data = generateData(); // Ваша функция для генерации данных
//
//    // Сохраняем данные в кеш
//    file_put_contents($cacheFile, $data);
//}
//
//echo $data;

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (!empty($_GET['del']) &&
        (intval($_GET['del'])) !==0)
    {
        $del = $_GET['del'];
    }
} else $del = 0;
?>


<?php
function  showRowHtml($row)
{
    ob_start();
    ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['flag']; ?></td>
            <td><form method="get" action="phps.php">
                    <input type="hidden" name="del" value=<?php echo $row['id'];?> required>
                    <button type="submit">Удалить</button>
                </form></td>
        </tr>
    <?php
    return ob_get_clean();
}
// Настройки подключения
$host = 'localhost'; // Адрес сервера базы данных
$dbname = 'test_db'; // Имя базы данных
$username = 'test_user'; // Имя пользователя базы данных
$password = '1111'; // Пароль пользователя базы данных

try {

    // Создание нового объекта PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Установка режима обработки ошибок PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL-запрос
    $sql = "DELETE FROM user WHERE id = :id";

    // Подготовка запроса
    $stmt = $pdo->prepare($sql);

    // Связывание параметров
    $stmt->bindValue(':id', $del, PDO::PARAM_INT);

    // Выполнение запроса
    $stmt->execute();

    // Пример выполнения запроса
    $stmt = $pdo->query("SELECT * FROM user");

    echo "    <table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Имя пользователя</th>
                    <th>Email</th>
                    <th>Дата создания</th>
                </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo showRowHtml($row);
    }

    echo "</table>";
//    // SQL-запрос
//    $sql = "SELECT * FROM user WHERE id > :age";

//    // Подготовка запроса
//    $stmt = $pdo->prepare($sql);
//
//    // Связывание параметров
//    $stmt->bindValue(':age', 1, PDO::PARAM_INT);
//
//    // Выполнение запроса
//    $stmt->execute();
//
//    // Извлечение всех результатов
//    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//    // Вывод результатов
//    foreach ($results as $row) {
//        echo "ID: " . $row['id'] . " | Name: " . $row['name'] . " | Flag: " . $row['flag'] . "<br>";
//
//        echo "Подключение успешно!";
//    }
//
//    // SQL-запрос
//    $sql = "INSERT INTO user (name, date, flag) VALUES (:name, NOW(), :flag)";
//
//    // Подготовка запроса
//    $stmt = $pdo->prepare($sql);
//
//    // Связывание параметров
//    $stmt->bindValue(':name', 'Bill Crage', PDO::PARAM_STR);
//    //$stmt->bindValue(':date', date_timestamp_get(date()), PDO::PARAM_STR);
//    $stmt->bindValue(':flag', 'f', PDO::PARAM_STR);
//
//    // Выполнение запроса
//    $stmt->execute();
//    echo date_timestamp_get(date());
//    echo "Данные успешно добавлены!";
} catch (PDOException $e) {
   echo "Ошибка: " . $e->getMessage();
}

//// Функция, которая принимает callback как аргумент
//function processUserInput($input, $callback) {
//    echo "Вы ввели: $input\n";
//    // Вызов переданной callback-функции
//    $callback($input);
//}
//
//// Функция обратного вызова
//function toUpperCase($input) {
//    echo "Ваш текст в верхнем регистре: " . strtoupper($input) . "\n";
//}
//
//processInput("Привет, мир!", 'toUpperCase');

