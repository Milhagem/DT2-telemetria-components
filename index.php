<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Display</title>
</head>

<body>
    <div class="container">
        <div class="visor">
            <div class="valor">
                <span class="tensao">0.00</span>
                <span class="unit"> V</span>
                <div class="legenda">Tensao</div>
            </div>
        </div>
        <div class="visor">
            <div class="valor">
                <span class="corrente">0.00</span>
                <span class="unit"> A</span>
            </div>
            <div class="legenda">Corrente</div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        var tensao = 0.00;
        var corrente = 0.00;

        setInterval(function () { // Ajax request at each time interval
            $.ajax({
                url: 'db_query.php',
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    tensao = result.voltage_battery;
                    corrente = result.current_motor;
                    alteraTensao(tensao);
                    alteraCorrente(corrente);
                },
            });
        }, 500);

        function alteraTensao(tensao) {
            $('.tensao').text(tensao)
        }

        function alteraCorrente(corrente) {
            $('.corrente').text(corrente)
        }
    </script>
</body>

</html>