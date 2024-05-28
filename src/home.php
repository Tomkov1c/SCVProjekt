<!DOCTYPE html>
<html lang="en" data-theme="light" id="darmModeID">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="style/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Nadzorna Plošča</title>
</head>
<body>
    <section id="sectionL">
        <button id="active"><i class="fa-solid fa-house"></i><p>Dom</p></button>
        <button><i class="fa-solid fa-hashtag"></i><p>Vnos</p></button>
        <button><i class="fa-solid fa-eye"></i><p>Pogled</p></button>
        <button><i class="fa-solid fa-chair"></i><p>3. TRB</p></button>
    </section>
    <section id="sectionR">
        <h1>UI Elements</h1>
        <br>
        <?php
        session_start();

        ?>
        <br>
        <h1>Heading 1</h1>
        <h2>Heading 2</h2>
        <h3>Heading 3</h3>
        <p>Adipisci ducimus accusamus saepe esse quas quae in libero cupiditate, est unde doloremque soluta, deserunt maiores eveniet dolorem labore explicabo laborum sint, quibusdam recusandae iure nemo rem sunt voluptatibus dolorem aspernatur quod?</p>
        <ol>
            <li>ipsum</li>
            <li>quos</li>
            <li>alias</li>
            <li>laboriosam</li>
        </ol>
        <ul>
            <li>ipsum</li>
            <li>quos</li>
            <li>alias</li>
            <li>laboriosam</li>
        </ul>



        <div class="highlightRow">
            <img src="images/testProfilePicture.jpeg" alt="Loading">
            <p class="name"><?=
                htmlspecialchars($_SESSION["uname"]); //v primeru da je iem zelo golgo se rabi text pomanast
                ?></p>
        </div>

        <div class="submenuSplitSelect">
            <div><p>2019/2020</p></div>
            <div><p>2020/2021</p></div>
            <div><p>2021/2022</p></div>
            <div><p>2022/2023</p></div>
            <div><p>2023/2024</p></div>
        </div>

    </section>
</body>
    <div id="devMenu">
        <h1>Zavihki</h1>
        <p>Kako bi naj zgledali zavihki na tej strani. Vsak je .html datoteka. Način navigacije na zavihke je pa odvisen od tega za kaj se bomo odločili.</p>
        <div class="display_inline_flex">
            <a href="samples/home.html"><i class="fa-solid fa-house"></i><p>Dom</p></a>
            <a href="samples/vnos.html"><i class="fa-solid fa-hashtag"></i><p>Vnos</p></a>
            <a href="samples/pogled.html"><i class="fa-solid fa-eye"></i><p>Pogled</p></a>
            <a href="samples/"><i class="fa-solid fa-chair"></i><p>Razred</p></a>
            <a href="samples/"><i class="fa-solid fa-chair"></i><p>Odjava</p></a> <!-- more it v drugo vrsto! -->
        </div>
    </div>
<script src="script/darkMode.js"></script>
<script src="script/devMenu.js"></script>
</html>