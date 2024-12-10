@extends('layouts.navigation')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        form {
    margin-left:30%;
            padding: 20px;
            border-radius: 8px;
        
            width: 100%;
            max-width: 600px;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            font-size: 16px;
            color: #333;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        input:focus, textarea:focus {
        
            background-color: #fff;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        button:focus {
            outline: none;
        }

        /* Responsive design */
        @media screen and (max-width: 768px) {
            form {
                padding: 15px;
                width: 90%;
            }

            button {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
<form method="POST" action="{{ route('produits.store') }}">
    @csrf <!-- CSRF token for security -->

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description" required></textarea>
    </div>

    <div>
        <label for="sku">SKU</label>
        <input type="text" id="sku" name="sku" required>
    </div>

    <div>
        <label for="barcode">Code-Barre</label>
        <input type="text" id="barcode" name="barcode" required>
    </div>

    <div>
        <label for="prix">Prix</label>
        <input type="number" id="prix" name="prix" required>
    </div>

    <div>
        <label for="min_quantity">Quantité minimale</label>
        <input type="number" id="min_quantity" name="min_quantity" required>
    </div>

    <div>
        <label for="max_quantity">Quantité maximale</label>
        <input type="number" id="max_quantity" name="max_quantity" required>
    </div>

    <div>
        <label for="supplier">Fournisseur</label>
        <input type="text" id="supplier" name="supplier" required>
    </div>

    <button type="submit">Soumettre</button>
</form>
</body>
</html>
@endsection