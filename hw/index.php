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
    <h2>Поиск количества счастливых билетов в диапазоне чисел</h2>
    <form id="main">
        <p>Введите два числа в формате ХХХХХХ</p>
        <div class="minDiv">
            <input class="min" type="text" name="min" placeholder="min">
            <p id="err1" class="hide">"Число введено не верно"</p>
        </div>
        <div class="maxDiv">
            <input class="max" type="text" name="max" placeholder="max">
            <p id="err2" class="hide">"Число введено не верно"</p>
            <p id="err3" class="hide">"Число min должно быть меньше числа max"</p>
        </div>
        <button type="submit">Run</button>
    </form>
</div>
<script>
    let form = document.querySelector("#main");
    let min = document.querySelector(".min");
    let max = document.querySelector(".max");
    let minDiv = document.querySelector(".minDiv");
    let maxDiv = document.querySelector(".maxDiv");
    let message = document.querySelector("#err1");
    let message2 = document.querySelector("#err2");
    let message3 = document.querySelector("#err3");
    let tickets = document.createElement("div");

    form.addEventListener("submit", async function (e) {
        e.preventDefault();
        tickets.innerHTML = ``;
        message.classList.remove("error");
        message2.classList.remove("error");
        message3.classList.remove("error");
        const regex = /^\d{6}$/;
        let err = 0;
        if (!regex.test(min.value)) {
            message.classList.add("error");
            err++;
        }
        if (!regex.test(max.value)) {
            message2.classList.add("error");
            err++;
        }
        if (min.value > max.value) {
            message3.classList.add("error");
            err++;
        }
        if (err === 0) {
            let response = await fetch(`happyTicket.php?min=${min.value}&max=${max.value}`);
            let res = await response.json();
            if (res) {

               tickets.innerHTML = `Количество счастливых билетов: ${res} шт.`;
               form.append(tickets);
            }
        }
    })
</script>
</body>
</html>
