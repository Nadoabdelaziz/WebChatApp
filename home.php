<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <style>
            body {
                font-family: "Lato", sans-serif;
            }

            .sidenav {
                text-align: center;
                height: 100%;
                width: 20%;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                padding-top: 20px;
            }

            .sidenav a {
                padding: 6px 6px 19px 1px;
                text-decoration: none;
                font-size: xx-large;
                color: #818181;
                display: block;
            }

            .sidenav a:hover {
                color: #f1f1f1;
            }

            .main {
                margin-left: 200px;
                /* Same as the width of the sidenav */
            }

            @media screen and (max-height: 450px) {
                .sidenav {
                    padding-top: 15px;
                }

                .sidenav a {
                    font-size: 18px;
                }
            }
        </style> -->
    </head>

    <body>

        <!-- <div class="sidenav">
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Clients</a>
            <a href="#">Contact</a>
        </div>-->

        <div class="main" style="padding: 37px;">
            <!--<div class="profile">
                <img src="https://1.bp.blogspot.com/-vhmWFWO2r8U/YLjr2A57toI/AAAAAAAACO4/0GBonlEZPmAiQW4uvkCTm5LvlJVd_-l_wCNcBGAsYHQ/s16000/team-1-2.jpg"
                    alt="profile_picture">
                <h3>Anamika Roy</h3>
                <p>Designer</p>
            </div> -->
            <?php
                echo "<center><h2>SafeChat</h2></br>Sie suchen nach einer sicheren und zuverlässigen Chat-Plattform?</br> SafeChat ist die Lösung! </br>Unsere Plattform ermöglicht es Ihnen, sich mit einer User-ID zwischen 1 und 100000 zu registrieren</br> und sicher mit Freunden und Kollegen zu chatten.</br>

                Unsere Verschlüsselungstechnologie garantiert,</br> dass Ihre Nachrichten und persönlichen Daten immer geschützt sind.</br> Sie können sich sicher sein, dass Ihre Unterhaltungen privat bleiben</br> und dass Ihre Daten sicher aufbewahrt werden.</br></br>

                Mit SafeChat erhalten Sie Zugriff auf eine Vielzahl von Funktionen,</br> darunter: alle 3 stunden alte  nachrichten werden automatisch gelöscht,</br>ips werden nicht geloggt, user & nachrichten sind mit hash & salts verschlüsselt.</br> Unsere Benutzeroberfläche ist intuitiv und einfach zu bedienen,</br> so dass Sie schnell und einfach in Kontakt bleiben können.</br>
                Egal ob via Android App , iOS App oder Web-Browser.</br>

                Registrieren Sie sich noch heute bei SafeChat und erleben Sie die Zukunft des Chats</br> - sicher, zuverlässig und vollgepackt mit Funktionen.</br> Wir freuen uns darauf, Sie in unserer Community begrüßen zu dürfen!</center>
                </br>

                <center><h4>Android App | iOS App  </h4></center>
                <center><h5>Donations: </h5></center>
                <center><h5>Protected By:</h5> <h6>Web-Application Firwall </h6></center>
                ";
           ?>
        </div>

        <div class="wrapper">
            <!--Top menu -->
            <div class="sidebar">
                <!--profile image & text-->
                <!--menu item-->
                <!-- <div class="profile">
                    <img src="security\assets\img\safechat.jpeg" alt="profile_picture">
                    <h3>SAFE-CHAT</h3>
                </div> -->

                <ul style="margin-left: -25px;">
                    <li>
                        <a href="#">
                            <span class="icon"><i class="fas fa-home"></i></span>
                            <span class="item">Search</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php">
                            <span class="icon"><i class="fas fa-desktop"></i></span>
                            <span class="item">Chats</span>
                        </a>
                    </li>
                    <li>
                        <a href="login.php">
                            <span class="icon"><i class="fas fa-user-friends"></i></span>
                            <span class="item">Login</span>
                        </a>
                    </li>
                    <li>
                        <a href="register.php">
                            <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
                            <span class="item">Register</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <script>
        var hamburger = document.querySelector(".hamburger");
        var menu_item = document.querySelector(".item");

        hamburger.addEventListener("click", function() {
            document.querySelector("body").classList.toggle("active");
        });

        menu_item.addEventListener("click", function() {
            document.querySelector("a").classList.toggle("active");
        });
        </script>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

        * {
            list-style: none;
            text-decoration: none;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }

        .main {
            margin-left: 140px;
            /* Same as the width of the sidenav */
        }

        body {
            background: #f5f6fa;
        }

        .wrapper .sidebar {
            background: rgb(5, 68, 104);
            position: fixed;
            top: 0;
            left: 0;
            width: 140px;
            height: 100%;
            padding: 40px 0;
            transition: all 0.5s ease;
        }

        .wrapper .sidebar .profile {
            margin-bottom: 30px;
            text-align: center;
        }

        .wrapper .sidebar .profile img {
            display: block;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin: 0 auto;
        }

        .wrapper .sidebar .profile h3 {
            color: #ffffff;
            margin: 10px 0 5px;
        }

        .wrapper .sidebar .profile p {
            color: rgb(206, 240, 253);
            font-size: 14px;
        }

        .wrapper .sidebar ul li a {
            display: block;
            padding: 13px 30px;
            border-bottom: 1px solid #10558d;
            color: rgb(241, 237, 237);
            font-size: 18px;
            position: relative;
        }

        .wrapper .sidebar ul li a .icon {
            color: #dee4ec;
            width: 30px;
            display: inline-block;
        }

        .wrapper .sidebar ul li a:hover,
        .wrapper .sidebar ul li a.active {
            color: #0c7db1;

            background: white;
            border-right: 2px solid rgb(5, 68, 104);
        }

        .wrapper .sidebar ul li a:hover .icon,
        .wrapper .sidebar ul li a.active .icon {
            color: #0c7db1;
        }

        .wrapper .sidebar ul li a:hover:before,
        .wrapper .sidebar ul li a.active:before {
            display: block;
        }

        @media screen and (max-height: 450px) {
            .sidebar {
                width: 120px;
            }

            .sidebar a {
                font-size: 18px;
            }
        }
        </style>
    </body>

</html>