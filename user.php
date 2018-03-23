<html>
  <head>
    <style>
      html, body { height: 100%; width: 95%;padding: 0; margin: 0; }
      .divs{ width: 50%; height: 50%; float: left; }
      .tile {
          width: 48px;
          height: 48px;
          margin: 0px;
          padding: 0px;
          float: left;
          background-color:red;
          border: 1px solid black;
      }
      #status_{
        width:35%;
        border-radius: 25px;
        float:left;
        background-color: rgba(170,170,170,0.3);
        color: yellow;
        display: block;
        font-size: 70px;
      }

      #cost_{
        border-radius: 25px;
        float:right;
        background-color: rgba(170,170,170,0.3);
        color: yellow;
        display: block;
        font-size: 70px;
        width:35%;
      }

    .button1 {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration : none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
  }

  .button2 {
  background-color: #f44336; /* Red */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration : none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

    </style>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

    <script>
      setInterval(
        function readMeter()
        {
          url = "https://thingspeak.com/channels/421611/field/1/last.html"
          $.getJSON(url, function(data)
          {
            document.getElementById("status_").innerHTML = data + " Watts";
            money = parseInt(data)*5;
            document.getElementById("cost_").innerHTML =  "Rs. "+money.toString();
            var currentBalance = document.getElementById("currentBalance").value
            document.getElementById("currentBalance").value = currentBalance - parseInt(data)*5;
          });

          url = "https://thingspeak.com/channels/421611/field/2/last.html"
          $.getJSON(url, function(data)
          {
            var div = document.getElementById( 'change' );
            if(data == 0)
              div.style.backgroundColor='red';
            else if(data == 1)
              div.style.backgroundColor='green';
            else
              div.style.backgroundColor='blue';
          });

        },1000);

        function turnOff()
        {
          var url = "http://api.thingspeak.com/update?api_key=SLZ53XFXXZXA7NWG&field2=0"
          $.getJSON(url, function(data)
          {
            console.log(data);
            alert("Switched Off Power To All Devices")
          });
        }

        function turnOn()
        {
          var url = "http://api.thingspeak.com/update?api_key=SLZ53XFXXZXA7NWG&field2=1"
          $.getJSON(url, function(data)
          {
            console.log(data);
            alert("Switched On Power")
          });
        }
    </script>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body style="background-image:url('bulb.jpg')">

    <div class="wrapper row1">
      <header id="header" class="hoc clear">
        <div id="logo" class="fl_left">
          <h1 style="color:'yellow'"><a href="#"><br>TAMIL NADU ELECTRICITY BOARD</a></h1>
        </div>
      </header>
    </div>

    <div id="div1" class="divs">
      <br><br><br><br><br>
      <center><iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/421611/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Power+consumed&type=line&xaxis=Time&yaxis=KWh%28units%29"></iframe>
    </center>
    </div>

    <div id="div2" class="divs container">
      <br><br><br><br><br><br><br>
      <div id = "status_"></div>
      <div id = "cost_"></div>
      <br><br><br><br><br><br><br><br><br><br>
      <div class="tile" id="change"></div>
      <center><button class="button2" type="button" onClick="turnOff()">Turn Off All Devices</button></center>
      <center><button class="button1" type="button" onClick="turnOn()">Turn On Devices</button></center>
    </div>

  </body>
</html>
