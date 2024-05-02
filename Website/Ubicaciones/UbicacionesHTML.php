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
    <link rel="stylesheet" href="UbicacionStyle2.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
    <title>Ubicaciones</title>
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

            <li class="nav-item">
                <a href="../UsuariosTab/UsuariosHTML.php" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        class="bi bi-house-fill" viewBox="0 0 16 16">
                        <g>
                            <path fill="currentColor" class="fa-secondary"
                                d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill="currentColor" class="fa-secondary"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </g>

                    </svg>

                    <span class="link-text">Usuarios</span>
                    
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
            <h1>Ubicaciones</h1>
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
                            <th>ID Ubicacion</th>
                            <th>Ubicación</th>
                            <th>Notas</th>
                            <th></th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('ShowUbicaciones.php')
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

        <button type="button" class="bottom-itemadd" onclick="window.location.href = 'FormUbicaciones.php';">
            <span class="bottom-item__text">Añadir</span>
            <span class="bottom-item-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0M8 1c-1.573 0-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4s.875 1.755 1.904 2.223C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777C13.125 5.755 14 5.007 14 4s-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1"/>
                    <path fill-rule="evenodd"
                        d="M2 7v-.839c.457.432 1.004.751 1.49.972C4.722 7.693 6.318 8 8 8s3.278-.307 4.51-.867c.486-.22 1.033-.54 1.49-.972V7c0 .424-.155.802-.411 1.133a4.51 4.51 0 0 0-4.815 1.843A12 12 0 0 1 8 10c-1.573 0-3.022-.289-4.096-.777C2.875 8.755 2 8.007 2 7m6.257 3.998L8 11c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13h.027a4.55 4.55 0 0 1 .23-2.002m-.002 3L8 14c-1.682 0-3.278-.307-4.51-.867-.486-.22-1.033-.54-1.49-.972V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-1.3-1.905" />
                </svg>
            </span>
        </button>
        </div>
    </nav>

    <script src="UbicacionesJS.js"></script>
</body>

</html>