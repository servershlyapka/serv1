<html>
<head>
<meta http-equiv="Content-Language" content="ru">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Дякую! Ваше замовлення прийнято!</title>
<link type="text/css" href="images/send.css" rel="stylesheet" charset="windows-1251"/>

<? 
// ----------------------------конфигурация-------------------------- // 
$domain = $_SERVER['SERVER_NAME'];
$adminemail="shlypka.ua@gmail.com"; // e-mail админа 

$header="From: \"Заявка на мікродозинг\" <admin@$domain>\n"; // от кого
$header.="Content-type: text/html; charset=\"utf-8\""; // кодировка

$date=date("d.m.y"); // число.месяц.год 
 
$time=date("H:i"); // часы:минуты:секунды 
 
$backurl="spasibo/index.html";  // На какую страничку переходит после отправки письма 
 
//---------------------------------------------------------------------- // 
 
  
 
// Принимаем данные с формы 
 
$name=$_POST['name']; 
  
$phone=$_POST['phone']; 

$urll=$_SERVER['SERVER_NAME'];
$url=$_SERVER['REQUEST_URI'];

$msg=" 

<p>Телефон: $phone </p>

<p>Имя: $name </p>

"; 
 
 // Отправляем письмо админу  
 
mail("$adminemail", "$to $date $time Заявка 
на мікродозинг", "$msg", "$header"); 
 
// Сохраняем в базу данных 
 
$f = fopen("message.txt", "a+"); 
 
fwrite($f," \n $date $time Заявка 
на мікродозинг"); 
 
fwrite($f,"\n $msg "); 
 
fwrite($f,"\n ---------------"); 
 
fclose($f); 
 
 
// Выводим сообщение пользователю 



echo ' ';

 print "<p></p><script><!-- 
function reload() {location = \"$backurl\"}; setTimeout('reload()', 0); 
//--></script>"; 
exit; 
 
?>