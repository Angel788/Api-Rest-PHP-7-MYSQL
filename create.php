<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Bienvendio a mi api rest con PHP7 NATIVO</h1>
    <form action="crud/create.php" method="post" enctype="multipart/form-data" id="form">
        <input type="text" placeholder="Escribe la marca" name="marca">
        <input type="text" placeholder="Ecribe el modelo" name="name">
        <input type="text" placeholder="Ecribe el numero de Serie" name="noserie">
        <input type="text" placeholder="Ecribe el costo" name="costo">
        <input type="text" placeholder="Ecribe la descripcion" name="descripcion">
        <input type="file" name="imagen" id="">
        <input type="submit" value="">
    </form>
    <div id="eror"></div>

</body>

</html>