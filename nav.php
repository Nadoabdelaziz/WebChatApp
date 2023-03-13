<div class="wrapper new_menu" style="background: #323232;">
    <!--Top menu -->
    <div class="sidebar" style="padding: 10px;">
        <!--profile image & text-->
        <!--menu item-->
        <!-- <div class="profile">
                    <img src="security\assets\img\safechat.jpeg" alt="profile_picture">
                    <h3>SAFE-CHAT</h3>
                </div> -->
        <div class="profile">
            <h2 style="text-align: center;color: white;margin-bottom: 12px;">User ID:</h2>
            <?php
                if(isset($_SESSION["user_id"])){
                ?>
            <h3 style="text-align: center;color: white;"><?= $_SESSION["user_id"] ?></h3>
            <?php
                }
                else{
                    ?>
            <h3 style="text-align: center;color: white;"><a href="login.php">Login In</a></h3>

            <?php
                }
            ?>
        </div>
        <!-- Auto refresh by k alle 5 minuten-->
        <div id="search">
            <input style="border-radius: 23px;" type="text" id="search-query" onfocus="check()"
                placeholder="Search for a user">
            <ul class="list-group" id="myList">
            </ul>
            <!-- <button id="close_menu" style="color:red">X</button> -->

        </div>

        <ul style="list-style-type: none;display: contents;">

            <li>
                <a href="chat.php">
                    <span class="icon"><i class="fas fa-user"></i></span>
                    <span class="item">Chats</span>
                </a>
            </li>
            <li>
                <a href="login.php">
                    <span class="icon"><i class="fas fa-exclamation-circle"></i></span>
                    <span class="item">Login</span>
                </a>
            </li>
            <li>
                <a href="register.php">
                    <span class="icon"><i class="fas fa-archive"></i></span>
                    <span class="item">Register</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <span class="icon"><i class="fas fa-cog"></i></span>
                    <span class="item">Logout</span>
                </a>
            </li>
            <li>
                <a href="register.php">
                    <span class="icon"><i class="fas fa-arrow-circle-left"></i></span>
                    <span class="item">Impressum</span>
                </a>
            </li>

        </ul>
    </div>

</div>

<style>
/* .wrapper .sidebar {
    background: rgb(5, 68, 104);
    position: fixed;
    top: 0;
    left: 0;
    width: 140px;
    height: 100%;
    padding: 40px 0;
    transition: all 0.5s ease;
} */

#search {
    margin-bottom: 50px;
    margin-top: 30px;

}

.wrapper .sidebar .profile h3 {
    color: #ffffff;
    margin: 10px 0 5px;
}

.wrapper .sidebar .profile p {
    color: rgb(206, 240, 253);
    font-size: 14px;
}


.wrapper .sidebar ul li {
    margin-bottom: 20px;
}

.wrapper .sidebar ul li a {
    color: aliceblue;
    display: block;
    padding: 13px 10px;
    border-bottom: 1px solid #10558d;
    font-size: 18px;
    position: relative;
    text-decoration: none;
    /* background: #323232; */
    border-style: hidden;

}

.wrapper .sidebar ul li a .icon {
    color: #dee4ec;
    width: 30px;
    display: inline-block;
    margin-right: 13px;

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