<?php
// Указываем ключ API и ID поисковой системы Google Custom Search
$key = "AIzaSyCe-ASsKq_qnxzHwNEb-6cBsqWYs8OnAcQ";
$cx = "4748fd4e1da4c4912";
$search = "instagram";

// Если в GET-запросе есть параметр search, используем его в качестве поискового запроса
if (isset($_GET['search'])){
    $search = $_GET['search'];
}
// Формируем URL для запроса к Google Custom Search API с использованием ключа API, ID поисковой системы и поискового запроса
$url = "https://www.googleapis.com/customsearch/v1?key={$key}&cx={$cx}&q={$search}";
$ch = curl_init ( );
curl_setopt ($ch, CURLOPT_URL, $url); // устанавливаем параметр возврата результата в виде строки
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Выполнение запроса
$resultJson = curl_exec ($ch); // Виконати запит
curl_close ($ch);
// Декодируем JSON-строку в массив PHP
$arr = json_decode($resultJson, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #0066ff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0052cc;
        }
        p {
            font-size: 18px;
            margin-bottom: 10px;
        }
        a {
            color: #0066ff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<h1>My Browser</h1>
<form method="GET" action="/index.php">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" value="">
    <input type="submit" value="Перейти">
</ form >
<h1>Result</h1>
</body>
</html>
<?php
if (isset($arr['items'])) {
    foreach ($arr['items'] as $item) {
        echo '<p>'.$item['title'] . '</p>';
        echo "<a href='{$item['link']}'>".$item['link'] . '</a>';
    }
} else {
    echo "По вашему запросу ничего не найдено";
}
?>