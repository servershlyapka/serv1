<?php
// Проверка метода запроса
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "405 Not Allowed";
    exit;
}

// Конфигурация
$domain = $_SERVER['SERVER_NAME'];
$adminemail = "shlyapka.ua@gmail.com"; // e-mail админа
$header = "From: \"Заявка на микродоз\" <admin@$domain>\n";
$header .= "Content-type: text/html; charset=\"utf-8\"";

$date = date("d.m.y"); // число.месяц.год
$time = date("H:i"); // часы:минуты:секунды
$backurl = "thank.php"; // Страница после отправки письма

// Принимаем данные с формы
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$comment = $_POST['comment'] ?? '';

$urll = $_SERVER['SERVER_NAME'];
$url = $_SERVER['REQUEST_URI'];

$msg = "
<p>Телефон: $phone </p>
<p>Имя: $name </p>
<p>Количество: $comment </p>
";

// Отправляем письмо админу
mail($adminemail, "$date $time Заявка на микродоз", $msg, $header);

// Сохраняем в базу данных (файл)
$f = fopen("message.txt", "a+");
fwrite($f, "\n $date $time Заявка на микродоз");
fwrite($f, "\n $msg ");
fwrite($f, "\n ---------------");
fclose($f);

// Перенаправляем пользователя
header("Location: $backurl");
exit;
?>