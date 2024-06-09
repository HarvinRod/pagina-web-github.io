<?php 
include 'BD/conexion.php';
?>

<link href="css/bootstrap.min.css" rel="stylesheet">

<?php 
    $libreria = new BDLibreria(); 
    $autores = $libreria->getautores(); 
    $libros = $libreria->gettitulos(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de Harvin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/Favicon.ico" type="image/x-icon">


    <!Barra de Navegacion!>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="#inicio"><img src="img/logo.png" alt="Logo" width="40" height="40"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#inicio">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#libros">Libros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#autores">Autores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#contacto">Contacto</a>
            </li>
        </ul>
    </div>
</nav>

  <!Inicio!>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div class="container" id="inicio">
        <div class="col-md-12 text-center">
            <img src="img/Inicio.png" class="img-fluid rounded mx-auto d-block" style="max-height: 500px;" alt="Imagen Biblioteca">
            <h1 class="display-4 mt-3 mb-4">Biblioteca de Harvin</h1>
            <hr class="my-2">
            <p></p>
            <p class="lead">                    
            </p>
        </div>
    </div>
</div>
    <!Autores!>
<div class="bg-success py-4" id="autores">
<div class="container" id="autores">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <h1 class="display-4 text-white">Autores</h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <?php foreach($autores as $autor) { ?>
        <div class="col-md-4">
            <div class="card mb-3 cuadro-verde">
                <div class="card-body">
                    <p class="nombre-autor"><?php echo $autor['nombre'] . ' ' . $autor['apellido']; ?></p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<!Libros!>
<div class="bg-success py-4" id="libros">
<div class="container" id="libros">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <h1 class="display-4 text-white">Libros</h1>
            </div>
        </div>
    </div>
</div>

<<div class="container">
    <div class="row">
        <?php foreach($libros as $libro) { ?>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $libro['titulo']; ?></h5>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

    </div>
</div>
    <!Formulario de Contacto!>
<div class="bg-success py-4" id="contacto">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <h1 class="display-4 text-white">Formulario de Contacto</h1>
            </div>
        </div>
    </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexionBD = new ConexionBD();
    $pdo = $conexionBD->getConexion();

    $correo = htmlspecialchars($_POST['correo']);
    $nombre = htmlspecialchars($_POST['nombre']);
    $asunto = htmlspecialchars($_POST['asunto']);
    $comentario = htmlspecialchars($_POST['comentario']);
    $fecha = date('Y-m-d H:i:s');
    
    try {
        $consulta = "INSERT INTO contacto (fecha, correo, nombre, asunto, comentario) VALUES (:fecha, :correo, :nombre, :asunto, :comentario)";
        $stmt = $pdo->prepare($consulta);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':asunto', $asunto);
        $stmt->bindParam(':comentario', $comentario);
        $stmt->execute();
        echo "<div class='alert alert-success' role='alert'>¡Datos de contacto insertados correctamente!</div>";
    } catch (PDOException $e) {
        echo "Error al insertar datos de contacto: " . $e->getMessage();
    }
}
?>

<link href="css/bootstrap.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">         
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" id="correo" name="correo" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="asunto">Asunto:</label>
                    <input type="text" id="asunto" name="asunto" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="comentario">Comentario:</label>
                    <textarea id="comentario" name="comentario" class="form-control" rows="4" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="text" id="fecha" name="fecha" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg btn-block">Enviar</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</div>
<footer class="bg-success text-white py-2 fixed-bottom">
    <div class="container text-center">
        <p class="mb-0">&copy; <?php echo date("Y"); ?> Harvin Rodriguez. Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
