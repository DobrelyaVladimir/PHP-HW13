<?php
    $message = [];
    if(isset($_POST) && !empty($_POST)) {

        $regexPhone = "/^\+38 0\d{2} \d{3}-\d{2}-\d{2}$/";
        $phone = $_POST["phone"];
        $res = preg_match($regexPhone, $phone);
        if (!$res) {
            $message = ["phone"=>"Неверный формат ввода"];
        }
        $regexTextLength = "/^([а-яА-Я0-9a-zA-z]+.*\s*){1,500}$/";
        $text = $_POST["comment"];
        $res2 = preg_match($regexTextLength, $text);
        if (!$res2) {
            $message = ["comment" => "Комментарий должен содержать текст длиной от 1 до 500 слов"];
        }
        $BadWord = ["Россия", "Путин", "РФ", "Рф"];
        $newText = str_replace($BadWord, "***", $text);
        if (count($message) == 0) {
            $data = ["phone" => $phone, "text" => $newText];

        }
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <form method="post">
        <label for="phone">Номер в формате +38 0XX XXX-XX-XX</label>
        <input type="text" name="phone" placeholder="Phone number"><br>
        <?php if (count($message) > 0 && isset($message["phone"])) {
            echo "<p>$message[phone]</p>";
        } ?>
        <textarea name="comment" ></textarea><br>
        <?php if (count($message) > 0 && isset($message["comment"])) {
            echo "<p>$message[comment]</p>";
        } ?>
        <button type="submit">Send</button>
        <?php if (count($message) == 0 && isset($data)) {?>
            <div>
                <h2>Результат:</h2>
                <p>Phone: <?=$data["phone"] ?? ""?></p>
                <p>Text: <?=$data["text"] ?? ""?></p>
            </div>
        <?php } ?>
    </form>
</div>
</body>
</html>
