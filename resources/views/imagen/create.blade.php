<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen</title>
</head>
<body>
    <h1>Subir Imagen</h1>
    <form action="{{ route('subir.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Selecciona una imagen:</label>
        <input type="file" name="file" id="file" required>
        <button type="submit">Subir</button>
    </form>
</body>
</html>
