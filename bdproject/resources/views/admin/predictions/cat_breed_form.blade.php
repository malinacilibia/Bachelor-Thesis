@extends('layouts.admin')

@section('content')
    <!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Predicție Imagini - TensorFlow.js</title>

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #1e1e2f;
            color: white;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        .card {
            background-color: #2d2f3f;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            border: none;
        }

        .card-header {
            background-color: rgba(45, 47, 63, 0);
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        .card-body {
            background-color: #2d2f3f;
        }

        .card-body h5 {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .btn-custom {
            background-color: transparent;
            color: white;
            border: 1px solid #fff;
            text-transform: uppercase;
            padding: 5px 15px;
            margin-right: 10px;
        }

        .btn-custom:hover {
            background-color: #444;
            color: #fff;
            border-color: #444;
        }

        #imageElement {
            width: 100%;
            height: auto;
            display: block;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        #predictionResult {
            margin-top: 20px;
            text-align: center;
        }

        #predictionText {
            font-size: 20px;
            color: #fff;
        }

        .description {
            font-size: 18px;
            color: #ccc;
        }
        .drag-drop-zone {
            width: 100%;
            height: 200px;
            border: 2px dashed #fff;
            background-color: #3a3f52;
            color: #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .drag-drop-zone:hover {
            background-color: #444;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="card">
        <div class="card-header">
            Predicție pe Imagine - Identificare Rasă Pisică
        </div>
        <div class="card-body">
            <h5 class="card-title text-light">Bun venit, Admin!</h5>
            <p class="description">
                Pentru a identifica rasa unei pisici, te rugăm să încarci o imagine prin drag-and-drop sau apasă pe zona de mai jos pentru a selecta o imagine din computerul tău. Sistemul va procesa imaginea
                și îți va arăta rasa prezisă.
            </p>

            <div id="dragDropZone" class="drag-drop-zone">
                Trage și plasează o imagine aici sau apasă pentru a încărca
            </div>

            <form id="imageForm" style="display: none;">
                <input type="file" id="imageInput" accept="image/*" required class="form-control">
            </form>

            <img id="imageElement" class="img-fluid" style="display: none; margin-top: 20px;">

        </div>
    </div>

    <div id="predictionResult" style="margin-top: 20px;">
        <h2>Rezultatul predicției:</h2>
        <p id="predictionText"></p>
    </div>
</div>


<script>
    const classNames = [
        "Abyssinian", "Bengal", "Birman", "Bombay", "British Shorthair", "Egyptian Mau", "Maine Coon", "Persian", "Ragdoll", "Russian Blue",
        "Siamese", "Sphynx", "american_bulldog", "american_pit_bull_terrier", "basset_hound", "beagle", "boxer", "chihuahua",
        "english_cocker_spaniel", "english_setter", "german_shorthaired", "great_pyrenees", "havanese", "japanese_chin", "keeshond",
        "leonberger", "miniature pinscher", "newfoundland", "pomeranian", "pug", "saint_bernard", "samoyed", "scottish_terrier",
        "shiba_inu", "staffordshire_bull_terrier", "wheaten_terrier", "yorkshire_terrier"
    ];

    async function loadModel() {
        console.log("Încerc să încarc modelul...");
        try {
            const model = await tf.loadGraphModel('/models/model.json');
            console.log('Model încărcat:', model);
            fetch('/models/group1-shard1of4.bin')
                .then(response => {
                    if (response.ok) {
                        console.log("Fișierul group1-shard1of4.bin este accesibil.");
                    } else {
                        console.error("Fișierul group1-shard1of4.bin nu este accesibil.");
                    }
                })
                .catch(error => console.error("Eroare la încărcarea fișierului:", error));
            return model;
        } catch (error) {
            console.error("Eroare la încărcarea modelului:", error);
            console.log(error.stack);
        }
    }


    async function predictImage(image) {
        const model = await loadModel();

        const tensor = tf.browser.fromPixels(image)
            .resizeNearestNeighbor([224, 224]) // redimensionare la dimensiunea asteptata de model
            .toFloat()
            .div(tf.scalar(255)) // normalizare în [0, 1]
            .expandDims(0); // adaugam o dimensiune de batch

        console.log('Shape of tensor:', tensor.shape);

        const prediction = model.predict(tensor);
        console.log('Prediction', prediction);
        prediction.print();

        const predictedClass = prediction.argMax(-1).dataSync()[0];
        const predictedClassName = classNames[predictedClass];

        const predictionText = document.getElementById('predictionText');
        predictionText.innerText = `Rasa prezisă: ${predictedClassName}`;
    }

    document.getElementById('imageForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const imageInput = document.getElementById('imageInput');
        const file = imageInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageElement = document.getElementById('imageElement');
                imageElement.src = e.target.result;
                imageElement.style.display = 'block';
                predictImage(imageElement);
            };
            reader.readAsDataURL(file);
        }
    });

    const dragDropZone = document.getElementById('dragDropZone');
    dragDropZone.addEventListener('click', () => document.getElementById('imageInput').click());

    dragDropZone.addEventListener('dragover', function(event) {
        event.preventDefault();
        dragDropZone.style.backgroundColor = '#444';
    });

    dragDropZone.addEventListener('dragleave', function() {
        dragDropZone.style.backgroundColor = '#3a3f52';
    });

    dragDropZone.addEventListener('drop', function(event) {
        event.preventDefault();
        dragDropZone.style.backgroundColor = '#3a3f52';

        const file = event.dataTransfer.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const imageElement = document.getElementById('imageElement');
            imageElement.src = e.target.result;
            imageElement.style.display = 'block';
            predictImage(imageElement);
        };
        reader.readAsDataURL(file);
    });
</script>
</body>
</html>
@endsection
