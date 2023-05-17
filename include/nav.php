<body>
    <header>
      <div class="logo"><a href="user.php"><img src="assets/img/Melks.png" alt="Melks Logo" width="200px" height="60px"></a></div>
      <div class="navmenu">Welcome!</div>
      <div class="mobile"><i class="fa-solid fa-bars"></i></div>
      
    </header>
    <div class="nav-cont">
    <p><i class="fa-solid fa-user"></i> <?php echo $user['name']; ?></p>
            <p><i class="fa-solid fa-envelope"></i> <?php echo $user['email']; ?></p>
            <p><i class="fa-solid fa-right-from-bracket"></i><a href="logout.php">Logout</a></p>
</div>
    