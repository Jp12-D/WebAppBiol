<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Write your comments here -->
    <title>Form2</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Se vincula el archivo de css para que de estilo-->
    <link rel="stylesheet" href="js.css">
    <link rel="stylesheet" href="FormUsers.css">
</head>

<body>
   
        <div class="center-prompt">
            <div class="container">
                <div class="row center">
                    <div class="col-md-6 text-center mx-auto">
                        <div class="card">
                            <div class="card-header">
                                Registrar Usuario
                            </div>
                            <div class="card-body">
                                <form action="action_page.php" method="post">
                                    <div class="form-group">
                                        <label for="Nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Juan" required></input>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="Apellido Paterno">Apellido paterno:</label>
                                        <input type="text" class="form-control" id="Apellido paterno" name="Apellido paterno" placeholder="Del" required></input>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="Apellido Materno">Apellido materno:</label>
                                        <input type="text" class="form-control" id="Apellido materno" name="Apellido materno" placeholder="Pueblo"></input>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="eMail">eMail:</label>
                                        <input type="email" class="form-control" id="eMail" name="eMail" placeholder="juan.delpueblo@upr.edu" required></input>
                                    </div>
                            
                                  
                                    <div class="form-group">
                                        <label for="Privilegio">Password:</label>
                                        <input type="password" class="form-control" id="Password" name="Password" maxlength="100" required></input>
                                    </div>
                            
                                    
                                    <div class="form-group">
                                        <label for="Privilegio">Privilegio:</label>
                                        <label for="admin">Admin</label>
                                        <input type="radio" name="admin" value="admin">
                            
                                        <label for="admin">Usuario</label>
                                        <input type="radio" name="usuario" value="usuario">
                            
                                    </div>
                                   
                            
                                    <div>
                                        <input type="submit">
                                       <input type="reset">
                                    </div>
                            
                                </form>
                                <div id="error-message" class="error-message mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                </div>

            </div>
        </div>
    </div>




    <script src="index.js"></script>
</body>

</html>