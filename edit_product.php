<?php
session_start();

// Asegúrate de que no haya salida antes de estas líneas

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != true) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['info']['RolID'] <> "1") {
    header('Location: index.php');
    exit;
}

include("BD/conexion.php");
$consulta_categoria = mysqli_query($con, "SELECT * FROM categorias");
$consulta_marca = mysqli_query($con, "SELECT * FROM marcas");

// Evita cualquier salida HTML antes de esta parte del código
if (isset($_GET["nik"])) {
    $nik = mysqli_real_escape_string($con, strip_tags($_GET["nik"], ENT_QUOTES));  // Escapando Caracteres
    $sql = mysqli_query($con, "SELECT * FROM productos WHERE ProductoID='$nik'");
    if (mysqli_num_rows($sql) == 0) {
        header("Location: index.php");
        exit; // Asegúrate de que el script termine aquí
    } else {
        $row = mysqli_fetch_assoc($sql);
    }
}

if (isset($_POST['update'])) {
    $nombre = mysqli_real_escape_string($con, strip_tags($_POST["NombreProducto"], ENT_QUOTES));
    $descripcion = mysqli_real_escape_string($con, strip_tags($_POST["Descripcion"], ENT_QUOTES));
    $precio = mysqli_real_escape_string($con, strip_tags($_POST["Precio"], ENT_QUOTES));
    $stock = mysqli_real_escape_string($con, strip_tags($_POST["Stock"], ENT_QUOTES));
    $categoria = mysqli_real_escape_string($con, strip_tags($_POST["id_categoria"], ENT_QUOTES));
    $marca = mysqli_real_escape_string($con, strip_tags($_POST["id_marca"], ENT_QUOTES));
    $descuento = mysqli_real_escape_string($con, strip_tags($_POST["Descuento"], ENT_QUOTES));

    // Verificar si el nombre del producto ya existe
    $resultados = mysqli_query($con, "SELECT * FROM productos WHERE NombreProducto='$nombre'");
    if (mysqli_num_rows($resultados) > 0 && $nombre != $row['NombreProducto']) {
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>El Nombre del Producto ya existe en la base de datos!</div>';
    } else {
        // Si hay una imagen, procesarla
        if (isset($_FILES['Imagen']) && $_FILES['Imagen']['error'] == UPLOAD_ERR_OK) {
            $imagen = file_get_contents($_FILES['Imagen']['tmp_name']);
            $update = $con->prepare("UPDATE productos SET NombreProducto=?, Descripcion=?, Precio=?, Stock=?, Imagen=?, CategoriaID=?, MarcaID=?, Descuento=? WHERE ProductoID=?");
            $update->bind_param("sssssssss", $nombre, $descripcion, $precio, $stock, $imagen, $categoria, $marca, $descuento, $nik);
        } else {
            $update = $con->prepare("UPDATE productos SET NombreProducto=?, Descripcion=?, Precio=?, Stock=?, CategoriaID=?, MarcaID=?, Descuento=? WHERE ProductoID=?");
            $update->bind_param("ssssssss", $nombre, $descripcion, $precio, $stock, $categoria, $marca, $descuento, $nik);
        }

        // Ejecutar la actualización
        if ($update->execute()) {
          $_SESSION['mensaje'] = "El producto ha sido actualizado con éxito.";
          header("Location: list_productos.php");
          exit;
        } else {
          $_SESSION['mensaje'] = "! Error, no se pudo actualizar el producto.";
          header("Location: list_productos.php");
          exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/producto_style.css">
    <link rel="stylesheet" href="CSS/index_style.css">
    <title>Editar Producto</title>
</head>
<?php include("nav.php"); ?>
<body id="body">
  <br>
  <div class="form-container">
  <h2>Editar Producto</h2>
  <hr>
  <div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
      <label for="NombreProducto">Nombre del Producto:</label>
      <input type="text" id="NombreProducto" name="NombreProducto" value="<?php echo $row['NombreProducto'] ?>" required>
      <label for="Descripcion">Descripción:</label>
      <input type="text" id="Descripcion" name="Descripcion" value="<?php echo $row['Descripcion'] ?>" required>
      <label for="Precio">Precio:</label>
      <input type="number" id="Precio" name="Precio" value="<?php echo $row['Precio'] ?>" step="0.01" required>
      <label for="Stock">Stock:</label>
      <input type="number" id="Stock" name="Stock" value="<?php echo $row['Stock'] ?>" required>
      <label for="Imagen">Imagen del Producto:</label>
      <input type="file" id="Imagen" name="Imagen">
      <label for="CategoriaID">Categoría:</label>
      <select name="id_categoria" class="form-control" id="">
        <?php 
          while ($categoria = mysqli_fetch_assoc($consulta_categoria)) {
            $selected = ($categoria['CategoriaID'] == $row['CategoriaID']) ? 'selected' : '';
            echo '<option value="'.$categoria['CategoriaID'].'"'.$selected.'>'.$categoria['NombreCategoria'].'</option>';
          }
        ?>   
      </select>
      <label for="MarcaID">Marca:</label>
      <select name="id_marca" class="form-control" id="">
        <?php 
          while ($marca = mysqli_fetch_assoc($consulta_marca)) {
            $selected = ($marca['MarcaID'] == $row['MarcaID']) ? 'selected' : '';
            echo '<option value="'.$marca['MarcaID'].'"'.$selected.'>'.$marca['NombreMarca'].'</option>';
          }
        ?>   
      </select>
      <label for="Descuento">Descuento:</label>
      <input type="number" id="Descuento" name="Descuento" value="<?php echo $row['Descuento'] ?>" step="0.01" required>
      <input type="submit" name="update" value="Actualizar Producto">
      <a href="list_productos.php" class="btn btn-danger">Cancelar</a>
    </form>
  </div>
</body>
</html>
