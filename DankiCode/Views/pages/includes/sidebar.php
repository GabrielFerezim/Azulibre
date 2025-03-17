<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sidebar</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;800&display=swap');
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                list-style: none;
                font-family: 'Montserrat', sans-serif;
            }

            body{
                min-height: 100vh;
            }

            .sidebar{
                width: 100px;
                height: 100vh;
                background: #ffff;
                overflow: hidden;
                transition: .5s;
                background-color: #22245B;
                margin-right: 40px;
            }

            .sidebar:hover{
                width: 300px;
            }
            .sidebar ul li:hover {
                background-color: #EEBD3E;
<<<<<<< HEAD
                color: #22245B; 
            }

            .sidebar ul li:hover a {
                color: #22245B; 
=======
                color: #22245B; /* Cor do texto ao passar o mouse */
            }

            .sidebar ul li:hover a {
                color: #22245B; /* Cor do texto ao passar o mouse */
>>>>>>> a1bfbc687f9f2a566a53efe25c462d9df81d45a9
            }

            .sidebar ul li a{
                display: flex;
                white-space: nowrap;
                text-decoration: none;
                color: #fff;
            }

            .sidebar ul li .icone{
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 1.7rem;
                min-width: 60px;
                height: 60px;
                color: #fff;
            }

            .sidebar ul li:hover .icone {
<<<<<<< HEAD
                color: #22245B;
=======
                color: #22245B; /* Cor do ícone ao passar o mouse */
>>>>>>> a1bfbc687f9f2a566a53efe25c462d9df81d45a9
            }

            .sidebar ul li .titulo{
                display: flex;
                align-items: center;
                width: 100%;
                height: 60px;
                color: #fff;
                font-size: 1rem;
                letter-spacing: .05rem;
                padding-left: 20px 
            }

            .sidebar ul li .titulo:hover{
<<<<<<< HEAD
                color: #22245B; 
=======
                color: #22245B; /* Cor do ícone ao passar o mouse */
>>>>>>> a1bfbc687f9f2a566a53efe25c462d9df81d45a9
                font-weight: bold;
            }

            .sidebar ul li.logo{
                margin-bottom: 50px;

            }

            .sidebar ul li.logo:hover{
                background: none;
            }

            .sidebar ul li.logo .icone{
                font-size: 2rem;
            }

            .sidebar ul li.logo .titulo{
                font-size: 1.7rem;
                font-weight: 500;
            }

            .sidebar ul li.conta{
                bottom: 60px;
                width: 100%;
                
            }

            .sidebar ul li:last-of-type{
                bottom: 0;
                width: 100%;

            }

            .img-logo{
                width: 70px;
                height: auto;
            }

            .libre {
                color: #EDBD3D;
            }
        </style>
    </head>
    <body>
        <nav class="sidebar">
            <ul>
                <li class="logo">
                    <a href="#">
                        <figure class="icone">
                            <img class="img-logo" src="<?php echo INCLUDE_PATH_STATIC ?>images/ColoridaAmarelo.svg" alt="Logo da AzuLibre">
                        </figure>
                        <span class="titulo"><b>Azu<span class="libre">Libre</span></b></span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo INCLUDE_PATH ?>">
                        <span class="icone"><ion-icon name="grid-outline"></ion-icon>
                        </span>
                        <span class="titulo">Feed</span>
                    </a>
                </li> 

                <li>
                    <a href="<?php echo INCLUDE_PATH ?>comunidade">
                        <span class="icone"><ion-icon name="people-outline"></ion-icon></span>
                        <span class="titulo">Comunidade</span>
                    </a>
                </li> 

                <li>
                    <a href="<?php echo INCLUDE_PATH ?>livros">
                        <span class="icone"><ion-icon name="library-outline"></ion-icon></span>
                        <span class="titulo">Livros</span>
                    </a>
                </li> 

                <li class="conta">
                    <a href="<?php echo INCLUDE_PATH ?>perfil">
                        <span class="icone"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="titulo">Perfil</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo INCLUDE_PATH ?>?logout">
                        <span class="icone"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="titulo">Sair</span>
                    </a>
                </li> 
            </ul>
        </nav>

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        
    </body>
</html>