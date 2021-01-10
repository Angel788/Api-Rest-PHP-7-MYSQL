<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="crud/update.php" method="post" enctype="multipart/form-data">
        <input type="text" placeholder="Escribe el id" name="idprod">
        <input type="text" placeholder="Escribe la marca" name="marca">
        <input type="text" placeholder="Ecribe el modelo" name="name">
        <input type="text" placeholder="Ecribe el numero de Serie" name="noserie">
        <input type="text" placeholder="Ecribe el costo" name="costo">
        <input type="text" placeholder="Ecribe la descripcion" name="descripcion">
        <input type="file" name="imagen">
        <input type="submit" value="">
    </form>
</body>

</html>