<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wattimetro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="speedometer-container">
        <div class="speedometer-text">
            <div class="static">Power</div>
            <div class="dynamic">
                <span class="watts">0</span>
                <span class="unit">W</span>
            </div>
        </div>
        <div class="center-point"></div>
        <div class="speedometer-center-hide"></div>
        <div class="speedometer-bottom-hide"></div>
        <div class="arrow-container">
            <div class="arrow-wrapper arrow-angle">
                <div class="arrow"></div>
            </div>
        </div>
        <div class="speedometer-scale speedometer-scale-1 "></div>
        <div class="speedometer-scale speedometer-scale-2"></div>
        <div class="speedometer-scale speedometer-scale-3"></div>
        <div class="speedometer-scale speedometer-scale-4"></div>
        <div class="speedometer-scale speedometer-scale-5"></div>
        <div class="speedometer-scale speedometer-scale-6"></div>
        <div class="speedometer-scale speedometer-scale-7"></div>
        <div class="speedometer-scale speedometer-scale-8"></div>
        <div class="speedometer-scale speedometer-scale-9"></div>
        <div class="speedometer-scale speedometer-scale-10"></div>
        <div class="speedometer-scale speedometer-scale-11"></div>
        <div class="speedometer-scale speedometer-scale-12"></div>
        <div class="speedometer-scale speedometer-scale-13"></div>
        <div class="speedometer-scale speedometer-scale-14"></div>
        <div class="speedometer-scale speedometer-scale-15"></div>
        <div class="speedometer-scale speedometer-scale-16"></div>
        <div class="speedometer-scale speedometer-scale-17"></div>
        <div class="speedometer-scale speedometer-scale-18"></div>
        <div class="speedometer-scale speedometer-scale-19"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        const speedometerScale = 19;
        const maxSpeed = 36;
        var speed = 0;
        var currentScale = 1;

        setInterval(function() { // Ajax request at each time interval
          $.ajax({
            url : 'db_query.php',
            type : 'POST',
            success : function (result) {
            speed = result;
            changeText();
            changeArrowAngle();
            changeActive();
            },
          });
        }, 500)
        

        /* function getPower() {
            speed = <?php require "db_query.php"?>;
        } */

        function changeArrowAngle() {
            angle = calculateArrowAngle();
            $('.arrow-angle').css({'transform': 'rotate(' + angle + 'deg)'});
        }

        function changeActive() {
            proportion = speed / maxSpeed;
            currentScale = parseInt(proportion * speedometerScale);

            let activeScales = $('.speedometer-scale').slice(0, currentScale);
            activeScales.each(function() {
                $(this).addClass('active-scale');
            });

            let inactiveScales = $('.speedometer-scale').slice(currentScale + 1, maxSpeed + 2);
            inactiveScales.each(function() {
                $(this).removeClass('active-scale');
            });
        }

        function changeText() {
            $('.watts').text(speed);
        }

        function calculateArrowAngle() {
            proportion = speed / maxSpeed;
            angle = proportion * 180;
            return (angle);
        }
    </script>
</body>
</html>