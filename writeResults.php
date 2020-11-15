 <?php include('server.php') ?>
<DOCTYPE xmlns="http://www.w3.org/1999/html">
<head>
    <style>
        body {
            width: 100vw;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .curved-div {
            position: relative;
            background: #ADD8E6;
            color: #FFF;
            text-align: center;
            overflow: hidden;
        }
        .curved-div svg {
            display: block;
        }
        .curved-div.upper {
            background: #BA55D3;
        }
        .curved-div h1 {
            font-size: 6rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            margin-top:0rem;
        }
        .curved-div p {
            font-size: 1rem;
            margin:0 5rem 0rem 5rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        .color
        {
            color: black;
            float: left;
        }
        textarea
        {
            height: 110px;
            width: 500px;
        }
        .form
        {
            background-color: yellow;
            width: 700px;
            height: 100px;
            float: right;
            font-size: 20px;
            margin-right: 50px;
            color: black;
            font-weight: bolder;
            font-family: "Droid Sans Mono";
        }
        .left
        {
            float: left;
            margin-bottom: 10px;

        }
        .error
        {

            width: 100%;
            color: #D8000C;
            background-color: #FFD2D2;
            border-color: #D8000C;
            height: 20px;
            text-align: center;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="curved-div upper">
    <h2>ONLY ACCESSIBLE FOR DOCTORS</h2>
    <svg viewBox="0 0 1440 319">
        <path fill="#ADD8E6" fill-opacity="1" d="M0,32L48,80C96,128,192,224,288,224C384,224,480,128,576,90.7C672,53,768,75,864,96C960,117,1056,139,1152,149.3C1248,160,1344,160,1392,160L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>
</div>
<div class="curved-div">
    <h1 class="color">PATIENT LOG:</h1>
    <div class="left">
        <?php include('error.php'); ?>
    </div>

    <div class="form">
        <form method="post" action="writeResults.php" class="form">
    <label for="patientID">Patient ID:</label>
    <input type="text" id="PID" name="PID" placeholder="">
        <br>
        <br>
    <label for="subject">Results: </label>
        <br>
    <textarea id="results" name="results"maxlength="200" placeholder=""></textarea>
        <br>
        <br>

        <input type="Submit" id="REPORT" value="REPORT" name="REPORT">
    </div>
    <svg viewBox="0 0 1440 319">
        <path fill="#BA55D3" fill-opacity="1" d="M0,32L48,80C96,128,192,224,288,224C384,224,480,128,576,90.7C672,53,768,75,864,96C960,117,1056,139,1152,149.3C1248,160,1344,160,1392,160L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>
</form>
</div>
</body>

</DOCTYPE>