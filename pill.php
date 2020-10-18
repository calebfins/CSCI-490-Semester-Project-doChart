<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        alert("Currently viewing DoChart Pill database... \n\nOpen to all patients and providers.");

    </script>
    <link rel="stylesheet" href="mystyle.css">

    <link rel="icon" type="image/png" href="pill_img/pillbottle.png">
    <meta name="description" content="Pills in the DoChart Database">
    <meta name="keywords" content="HTML,CSS,JavaScript">
    <meta name="author" content="Jamecia Moore">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DoChart Pills</title>
    <script>
        function imageClick(url) {
            window.location = url;
        }
    </script>
</head>

<body>

<!-- Will be changing the location of the pill image directs -->
<img src="pill_img/pills.png" title="Home" id="backHome" class="logo" alt="Image of pill/Floating" onclick="imageClick('login.php')">
<!-- Related to the table & search bar -->
<input type="text" name="search" id="search" placeholder="Enter Drug Identification Number..." />

<table class="redTable">
    <thead>
    <tr>
        <th title="Field #1">DIN</th>
        <th title="Field #2">Name</th>
        <th title="Field #3">Type</th>
        <th title="Field #4">Temperature</th>
        <th title="Field #5">Company</th>
    </tr>
    </thead>
    <tbody id="tab"></tbody>
</table>

<script>
    function readTextFile(file, callback) {
        var rawFile = new XMLHttpRequest();
        rawFile.overrideMimeType("application/json");
        rawFile.open("GET", file, true);
        rawFile.onreadystatechange = function() {
            if (rawFile.readyState === 4 && rawFile.status == "200") {
                callback(rawFile.responseText);
            }
        }
        rawFile.send(null);
    }
    // Reads in the content form the list.json file - that contains the pill information
    readTextFile("list.json", function(text){
        var myTable = JSON.parse(text);
        <!-- The building portion has to take place first -->
        buildTable(myTable);
        <!-- Based on what the user searches-->
        const searchInput = document.getElementById("search");
        const rows = document.querySelectorAll("tbody tr");
        console.log(rows);
        searchInput.addEventListener("keyup", function(event) {
            const q = event.target.value.toLowerCase();
            rows.forEach((row) => {
                row.querySelector("td").textContent.toLowerCase().startsWith(q) ?
                    (row.style.display = "table-row") :
                    (row.style.display = "none");
            });
        });
    });

    <!--  This is where the table is built and things are added into the table-->
    function buildTable(data){
        var table = document.getElementById('tab')

        for (var i = 0; i < data.length; i++){
            var row = `<tr>
							<td>${data[i].DIN}</td>
							<td>${data[i].pill_name}</td>
							<td>${data[i].pill_type}</td>
							<td>${data[i].pill_temp}</td>
							<td>${data[i].pill_company}</td>
					  </tr>`
            table.innerHTML += row


        }
    }

</script>
</body>
</html>