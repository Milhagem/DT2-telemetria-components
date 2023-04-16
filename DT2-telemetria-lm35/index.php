<!DOCTYPE html>
<html lang="pt" >
<head>
  <meta charset="UTF-8">
  <title>Temperatura da Bateria</title>
  <link rel="stylesheet" href="css/estilos.css">

</head>
<body>
<div id="wrapper">	
	<div id="termometer">
		<div id="temperature" style="height:0" data-value="0°C"></div>
		<div id="graduations"></div>
	</div>
	
	<div id="playground">		
		<div id="range">
      <span>Mínima: </span>
			<input id="minTemp" type="text" lm35Templue="70">
		</div>
		<p id="unit">Celcius C°</p>
	</div>
	
</div>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
  <script>
    const units = {
    Celcius: "°C",
    Fahrenheit: "°F" };

    const config = {
      minTemp: 0,
      maxTemp: 70,
      unit: "Celcius" };

    var lm35Temp = <?php require "db_query.php" ?>; 

    // Change min and max temperature values
    const tempValueInputs = document.querySelectorAll("input[type='text']");

    tempValueInputs.forEach(input => {
      input.addEventListener("change", event => {
      const newValue = event.target.value;

      if (isNaN(newValue)) {
          return input.value = config[input.id];
      } else {
          config[input.id] = input.value;
          return setTemperature(); // Update temperature
      }
      });
    });

    // Switch unit of temperature
    const unitP = document.getElementById("unit");

    unitP.addEventListener("click", () => {
      config.unit = config.unit === "Celcius" ? "Fahrenheit" : "Celcius";
      unitP.innerHTML = config.unit + ' ' + units[config.unit];
      return setTemperature();
    });

    // Change temperature
    setInterval(function() { // Ajax request at each time interval
      $.ajax({
      url : 'db_query.php',
      type : 'POST',
      success : function (result) {
      lm35Temp = result;
      setTemperature();
      },
      error : function () {
          console.log ('error');
      }
      });
    }, 3000)

    function setTemperature() {
      temperature.style.height = (lm35Temp - config.minTemp) / (config.maxTemp - config.minTemp) * 100 + "%";
      temperature.dataset.value = lm35Temp + units[config.unit];
    }

    range.addEventListener("input", setTemperature);
    setTimeout(setTemperature, 1000);
</script>

</body>
</html>

