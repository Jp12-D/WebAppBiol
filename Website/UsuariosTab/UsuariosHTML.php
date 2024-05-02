<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("location: login.php");
    exit();
}

// Si el usuario ha iniciado sesión correctamente, se puede mostrar el contenido de la página de inicio
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="UsuariosStyle2.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
    <title>Usuarios</title>
</head>

<body>

    <!--Navbar Menú Principal-->
    <nav class="navbar">
        <ul class="navbar-nav">

            <li class="logo">
                <a href="#" class="nav-link">
                    <span class="link-text logo-text">Menú</span>
                    <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="angle-double-right"
                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="svg-inline--fa fa-angle-double-right fa-w-14 fa-5x">
                        <g class="fa-group">
                            <path fill="currentColor" class="fa-secondary"
                                d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />

                        </g>

                    </svg>

                </a>
            </li>
            <li class="nav-item">
                <a href="../HomeScreen/HomeHTML.php" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        class="bi bi-house-fill" viewBox="0 0 16 16">
                        <g>
                            <path fill="currentColor" class="fa-primary"
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                            <path fill="currentColor" class="fa-secondary"
                                d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                        </g>

                    </svg>

                    <span class="link-text">Home</span>
                </a>
            </li>
          
            <li class="nav-item">
                <a href="../Ubicaciones/UbicacionesHTML.php" class="nav-link">
                    <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="Notificaciones" role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="svg-inline--fa fa-cat fa-w-16 fa-9x">
                        <g class="fa-group">
                            <path fill="currentColor" class="fa-secondary"
                                d="M0 32C0 14.3 14.3 0 32 0h72.9c27.5 0 52 17.6 60.7 43.8L257.7 320c30.1 .5 56.8 14.9 74 37l202.1-67.4c16.8-5.6 34.9 3.5 40.5 20.2s-3.5 34.9-20.2 40.5L352 417.7c-.9 52.2-43.5 94.3-96 94.3c-53 0-96-43-96-96c0-30.8 14.5-58.2 37-75.8L104.9 64H32C14.3 64 0 49.7 0 32zM244.8 134.5c-5.5-16.8 3.7-34.9 20.5-40.3L311 79.4l19.8 60.9 60.9-19.8L371.8 59.6l45.7-14.8c16.8-5.5 34.9 3.7 40.3 20.5l49.4 152.2c5.5 16.8-3.7 34.9-20.5 40.3L334.5 307.2c-16.8 5.5-34.9-3.7-40.3-20.5L244.8 134.5z" />
                        </g>

                    </svg>
                    <span class="link-text">Ubicaciones</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="../Proveedores/ProveedoresHTML.php" class="nav-link">
                    <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="Notificaciones" role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="svg-inline--fa fa-cat fa-w-16 fa-9x">
                        <g class="fa-group">
                            <path fill="currentColor" class="fa-secondary"
                                d="M50.7 58.5L0 160H208V32H93.7C75.5 32 58.9 42.3 50.7 58.5zM240 160H448L397.3 58.5C389.1 42.3 372.5 32 354.3 32H240V160zm208 32H0V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192z" />

                        </g>

                    </svg>
                    <span class="link-text">Proveedores</span>
                </a>
            </li>


            <li class="nav-item logout">
            <a href="../Login/login.php" class="nav-link" onclick="cerrarSesion()">
                    <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="Notificaciones" role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                        class="svg-inline--fa fa-cat fa-w-16 fa-9x">
                        <g class="fa-group">
                            <path fill="currentColor" class="fa-secondary"
                                d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z" />

                        </g>

                    </svg>
                    <span class="link-text">Cerrar sesión</span>
                </a>
            </li>
            
        </ul>
    </nav>

    <!--Tabla de contenido-->
    <main class="table">
        <section class="table-header">
            <h1>Usuarios</h1>
            <div class="input-group">
                <input type="search" placeholder="Search">
                <img src="../imagenes/search.svg" alt="">
            </div>
        </section>
        <section class="table-body">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>eMail</th>
                            <th>Privilegio</th>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('ShowUsuarios.php')
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!--Navbar Herramientas-->
    <nav class="navbar-bottom">
        <button class="expand-btn" onclick="expandNavbar()">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" class="bi bi-wrench-adjustable"
                viewBox="0 0 16 16">
                <path fill="currentColor" class="wrench-color-2"
                    d="M16 4.5a4.5 4.5 0 0 1-1.703 3.526L13 5l2.959-1.11q.04.3.041.61" />
                <path fill="currentColor" class="wrench-color-1"
                    d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.5 4.5 0 0 0 11.5 9m-1.292-4.361-.596.893.809-.27a.25.25 0 0 1 .287.377l-.596.893.809-.27.158.475-1.5.5a.25.25 0 0 1-.287-.376l.596-.893-.809.27a.25.25 0 0 1-.287-.377l.596-.893-.809.27-.158-.475 1.5-.5a.25.25 0 0 1 .287.376M3 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
            </svg>
        </button>

        <button type="button" class="bottom-itemadd" onclick="window.location.href = 'ValidarEntrada.php';">
            <span class="bottom-item__text">Añadir</span>
            <span class="bottom-item-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    <path fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                </svg>
            </span>
        </button>
  
        </div>
    </nav>

    <script src="UsuariosJS.js"></script>
</body>

</html>