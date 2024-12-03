<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Fotos</title>
    <link rel="stylesheet" href="./resources/css/index.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f0f8ff;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            height: 100vh;
            padding: 20px;
            color: #333;
        }

        h1 {
            font-size: 2.5rem;
            color: #0066cc;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.8rem;
            color: #004d99;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        form label {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        input[type="file"] {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #f7f7f7;
            font-size: 1rem;
        }

        button {
            padding: 10px 20px;
            border: none;
            background-color: #0066cc;
            color: white;
            font-size: 1.1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0057b7;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 1000px;
            margin-top: 30px;
        }

        .photo-card {
            display: flex;
            align-items: center;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .photo-card:hover {
            transform: scale(1.05);
        }

        .photo-card img {
            max-width: 80px;
            max-height: 80px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 20px;
        }

        .photo-card .info {
            flex-grow: 1;
        }

        .photo-card h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .photo-card p {
            font-size: 1rem;
            color: #777;
            margin: 5px 0;
        }

        .photo-card button {
            background-color: #ff4d4d;
            color: white;
            font-size: 1rem;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .photo-card button:hover {
            background-color: #cc0000;
        }
    </style>
</head>

<body>
    <h1>Galería de Fotos</h1>

    <!-- Formulario para subir una nueva foto -->
    <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Selecciona una foto:</label>
        <input type="file" name="file" id="file" accept="image/*" required>
        <button type="submit">Subir Foto</button>
    </form>

    <!-- Mostrar las fotos subidas -->

    @if($fotos->count() > 0)
    <a href="{{ route('foto.lista') }}">
        <button>Ver todas las fotos</button>
    </a>
    @endif
    
    <div class="gallery">
        @foreach ($fotos as $foto)
        <div class="photo-card">
        <img src="{{ route('foto.view', ['photo' => $foto->id]) }}" alt="{{ $foto->nombre_original }}">
        <div class="info">
                <h3>{{ $foto->nombre_original }}</h3>
                <p>Subida el: {{ $foto->created_at->format('d/m/Y H:i:s') }}</p>
                <form action="{{ route('foto.destroy', $foto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta foto?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    @if($fotos->count() > 0)
    <a href="{{ route('foto.lista') }}">
        <button>Ver todas las fotos</button>
    </a>
    @endif
</body>

</html>
