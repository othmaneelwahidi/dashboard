@extends('layouts.navigation')
@extends('layouts.navbar')

@section('content')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            form {
                margin-left: 30%;
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

            input,
            textarea {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 14px;
                background-color: #f9f9f9;
                transition: border-color 0.3s ease, background-color 0.3s ease;
            }

            input:focus,
            textarea:focus {

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
        <form action="{{ route('store.attribute', $product->id) }}" method="POST">
            @csrf
            <label for="product_name">Product:</label>
            <input disabled type="text" id="product_name" value="{{ $product->name }}" disabled>

            <label for="poids">Poids:</label>
            <input type="number" name="poids" id="poids" placeholder="Entrer le poids de produit" required>

            <label for="dimension">Dimension:</label>
            <input type="number" name="dimension" id="dimension" placeholder="Entrer les dimensions du produit" required>

            <label for="couleur">Couleur:</label>
            <input type="text" name="couleur" id="couleur" placeholder="Entrer la couleur du produit" required>

            <label for="marque">Marque:</label>
            <input type="text" name="marque" id="marque" placeholder="Entrer la marque du produit" required>

            <label for="autre">Autre:</label>
            <textarea name="autre" id="autre" placeholder="Autres attributs selon les besoins"></textarea>

            <button type="submit">Save Attribute</button>
        </form>
    </body>
@endsection
