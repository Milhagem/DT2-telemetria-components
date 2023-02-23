<?php
  require "db_query.php";
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Temperatura da Bateria</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<div id="wrapper">	
	<div id="termometer">
		<div id="temperature" style="height:0" data-value="0°C"></div>
		<div id="graduations"></div>
	</div>
	
	<div id="playground">		
		<div id="range">
			<input id="minTemp" type="text" value="0">
			<input type="range" min="0" max="70" value="24">
			<input id="maxTemp" type="text" value="70">
		</div>
		<p id="unit">Celcius C°</p>
	</div>
	
</div>
  <script>
      const units = {
      Celcius: "°C",
      Fahrenheit: "°F" };
    
    
    const config = {
      minTemp: 0,
      maxTemp: 70,
      unit: "Celcius" };
    
    
    // Change min and max temperature values

    const tempValueInputs = document.querySelectorAll("input[type='text']");
    
    tempValueInputs.forEach(input => {
      input.addEventListener("change", event => {
        const newValue = event.target.value;
    
        if (isNaN(newValue)) {
          return input.value = config[input.id];
        } else {
          config[input.id] = input.value;
          range[input.id.slice(0, 3)] = config[input.id]; // Update range
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
    const range = document.querySelector("input[type='range']");
    const temperature = document.getElementById("temperature");
    
    function setTemperature() {
      temperature.style.height = (<?php echo $temperature; ?> - config.minTemp) / (config.maxTemp - config.minTemp) * 100 + "%";
      temperature.dataset.value = <?php echo $temperature; ?> + units[config.unit];
    }
    
    range.addEventListener("input", setTemperature);
    setTimeout(setTemperature, 1000);
  </script>

</body>
</html>
