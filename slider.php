<html>
<head>
<script>
function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("passengers").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("pic").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("POST", "edge.php?q=" + str, true);
        xmlhttp.send();
		alert("fdsf","rewrw")
    }
}
</script>
</head>
<body>
<form action="edge.php" method="POST">
    <input type="range" width="100"  min="0" max="10" step="0.1" value="1" id="foo" name="passengers" onchange='document.getElementById("bar").value = "Slider Value = " + document.getElementById("foo").value;'/>
<input type="text" name="bar" id="bar" value="Slider Value = 1" disabled />
<br />
<input type=submit value=Submit />
</form>

<?php
if(isset($_POST["passengers"])){
    //echo "Number of selected passengers are:".$_POST["passengers"];
    // Your Slider value is here, do what you want with it. Mail/Print anything..
} else{
//Echo "Please slide the Slider Bar and Press Submit.";
}
?>
<figure>
<iframe src="edge.php" name="pic" width="600" height="600"> </iframe>
<figcaption> hello from upcast </figcaption>
</figure>

</body>
</html>