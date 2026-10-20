
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Place - Explore Ondo</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f4;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #198754;
            text-align: center;
        }

        .intro {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
        }

        p {
            color: #333;
            margin-bottom: 18px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button {
            width: 100%;
            background-color: #198754;
            color: white;
            padding: 13px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #146c43;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #198754;
            text-decoration: none;
        }

        .current-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 10px;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Place</h1>

    <p class="intro">
        Ondo is a city rich in history and culture.
        Update the details below.
    </p>

    <form action="{{ route('places.update', $place->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <p>
            Name:
            <input type="text" name="name"
                   value="{{ old('name', $place->name) }}" required>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            Description:
            <textarea name="description">{{ old('description', $place->description) }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            Address:
            <input type="text" name="address"
                   value="{{ old('address', $place->address) }}" required>
            @error('address')
                <span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            Latitude:
            <input type="number" name="latitude" step="any"
                   min="-90" max="90"
                   value="{{ old('latitude', $place->latitude) }}">
            @error('latitude')
                <span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            Longitude:
            <input type="number" name="longitude" step="any"
                   min="-180" max="180"
                   value="{{ old('longitude', $place->longitude) }}">
            @error('longitude')
                <span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            Place Image:
            @if ($place->image)
                <br>
                <img
                    src="{{ asset('storage/' . $place->image) }}"
                    alt="{{ $place->name }}"
                    class="current-image"
                >
                <br>
            @endif

            <input type="file" name="image"
                   accept="image/jpeg,image/png,image/webp">

            <small>Choose a new image if you want to replace the current one.</small>

            @error('image')
                <br>
                <span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            <button type="submit">Update Place</button>
        </p>

    </form>

    <a href="{{ route('places') }}" class="back">Back to Places</a>

</div>

</body>
</html>
