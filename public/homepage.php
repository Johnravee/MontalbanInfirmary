<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/homePage.css?v=<?php echo time() ?>">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="icon" href="../Images/logo.png">

    <title>Montalban Infirmary</title>
</head>

<body>
    <header>
        <a href="../public/homepage.php"><img src="../Images/logo.png" alt="Infirmary Logo" id="logo"></a>
        <h1 id="tittle">MONTALBAN INFIRMARY HOSPITAL</h1>
    </header>

    <main>
        <section class="section1">
            <img src="../Images/banner.jpg" alt="banner" id="banner">

            <div class="moto">
                <h2>
                    Your health is our top
                    <span id="prio">Priority</span>
                </h2>

                <p style="color: #ffff; 
                font-size: 1em;
                 font-weight: lighter;
                 letter-spacing: 1px;
            ">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe asperiores corporis, assumenda omnis nisi
                    unde.</p>
            </div>


            <!-- Links -->
            <div class="container">
                <div class="wrapper">
                    <div class="link">
                        <img src="../Images/DoctorsLink.png" alt="" id="linkImage">
                        <a href="#" class="linkSite">
                            Doctors
                        </a>
                    </div>

                    <div class="link">
                        <img src="../Images/appointment.jpg" alt="" id="linkImage">
                        <a href="loginPage.php" class="linkSite">
                            Book
                        </a>
                    </div>

                    <div class="link">
                        <img src="../Images/docCareer.jpg" alt="" id="linkImage">
                        <a href="#" class="linkSite">
                            Careers
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section2">
            <h2 id="about">about</h2>

            <div class="aboutContent">
                <div class="content1" data-aos="fade-right">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod impedit, molestias sed libero cumque
                    unde sequi laboriosam pariatur maxime nobis quibusdam in soluta deleniti quam quae aperiam. Quam ea
                    quia voluptatem ullam praesentium modi rerum non nam ad suscipit. Cupiditate eos ducimus consectetur
                    reiciendis possimus, cumque minima vero eius dolorem.
                </div>

                <div class="content2" data-aos="fade-left">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo mollitia eaque eveniet nam officia,
                    nulla eum architecto ratione tempore incidunt. Nam tempore tenetur quos quidem soluta possimus, quam
                    doloremque eos natus atque est adipisci a aut maxime magni exercitationem? Aliquam.
                </div>
            </div>
        </section>
    </main>

    <footer>
        <table class="Table">
            <thead>
                <tr>
                    <th>Header</th>
                    <th>Header</th>
                    <th>Header</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="#">???????</a></td>
                    <td><a href="#">???????</a></td>
                    <td><a href="#">???????</a></td>
                </tr>
                <tr>
                    <td><a href="#">???????</a></td>
                    <td><a href="#">???????</a></td>
                    <td><a href="#">???????</a></td>
                </tr>
                <tr>
                    <td><a href="#">???????</a></td>
                    <td><a href="#">???????</a></td>
                    <td><a href="#">???????</a></td>
                </tr>
            </tbody>
        </table>
    </footer>
    <div id="copy">
        Copyright &copy;2022 Montalban Infirmary Hospital.All right reserved.
    </div>






</body>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init();
</script>

</html>