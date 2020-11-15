

<DOCTYPE>

<head>
    <style>
        .center
        {
            margin-left: auto;
            margin-right: auto;
        }
    </style>

    <script>

        function imageClick(url) { window.location = url;
        }
    </script>
</head>
    <div class="center">
        <img src="pill_img/goodbye.gif" width="100%"  height="100%" alt="Doctor waving goodbye" onclick="imageClick('login.php')">
    </div>

    <script type="text/javascript">
        window.history.forward();
        function noBack()
        {
            window.history.forward();
        }
    </script>

    <body onLoad="noBack();" onpageshow="if (persisted) noBack();" onUnload="">
    </body>
</DOCTYPE>


<?php

file_put_contents("form-save.txt", "");
