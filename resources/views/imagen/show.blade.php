<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Fotos</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-top: 60px; /* Espacio para que no se superponga el nav */
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 2rem;
            text-align: center;
        }

        .gallery {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .photo-item {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .photo-item:hover {
            transform: scale(1.03);
        }

        .photo-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }

        .photo-info {
            flex-grow: 1;
        }

        .photo-info h3 {
            color: #333;
            margin: 0;
            font-size: 1rem;
        }

        .photo-info p {
            color: #666;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .photo-info p small {
            color: #888;
        }

        .delete-button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-button:hover {
            background-color: #ff1a1a;
        }

        a {
            text-decoration: none;
            background-color: #0066cc;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            max-width: fit-content;

            margin: 0 auto;
            
        }

        a:hover {
            background-color: #0057b7;
        }

        /* Barra de navegación */
        nav {
            background-color: #333;
            width: 100%;
            padding: 10px 0;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            padding: 10px;
            display: block;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #444;
            border-radius: 5px;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            width: 100%;
            padding: 20px 0;
            text-align: center;
            margin-top: auto; /* Asegura que el footer se quede al final de la página */
        }

        footer a {
            color: #ffcc00;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .boton-volver {
            text-align: center;
            margin-top: 20px;
        }

    </style>
</head>

<body>
    <!-- Barra de Navegación -->
    <nav>
        <ul>
            <li><a href="{{ route('foto.index') }}">Galería</a></li>
            <li><a href="{{ route('foto.lista') }}">Lista de Fotos</a></li>
            <li><a href="{{ route('foto.index') }}">Subir Foto</a></li>
        </ul>
    </nav>

    <h1>Lista de Fotos Subidas</h1>

    <div class="gallery">
        @foreach ($fotos as $foto)
            <div class="photo-item">
            <img src="{{ route('foto.view', ['photo' => $foto->id]) }}" alt="{{ $foto->nombre_original }}">
            <div class="photo-info">
                    <h3>{{ $foto->nombre_original }}</h3>
                    <p>Subida el: <small>{{ $foto->created_at->format('d/m/Y H:i:s') }}</small></p>
                </div>
                <form action="{{ route('foto.destroy', $foto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta foto?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Eliminar</button>
                </form>
            </div>
        @endforeach
    </div>
<div class="boton-volver"><a href="{{ route('foto.index') }}">Volver a la galería principal</a></div>
    

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Galería de Fotos. Todos los derechos reservados.</p>
        <p>Hecho con <span style="color: red;">♥</span> por <a href="https://github.com/mariortega83" target="_blank">Mario</a></p>
    </footer>
</body>

</html>
