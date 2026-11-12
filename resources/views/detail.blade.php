
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

        .notice {
            margin: 0 0 18px;
            padding: 12px 14px;
            border: 1px solid #bdd7bd;
            border-radius: 6px;
            background: #eef7ed;
            color: #245631;
        }

        .photo-section {
            margin-bottom: 24px;
            padding: 18px;
            border: 1px solid #e4e8df;
            border-radius: 8px;
            background: #fbfcf9;
        }

        .photo-section h2 {
            margin: 0 0 14px;
            color: #1c2b24;
            font-size: 18px;
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(125px, 1fr));
            gap: 12px;
        }

        .photo-item {
            overflow: hidden;
            border: 1px solid #e4e8df;
            border-radius: 7px;
            background: #fff;
        }

        .photo-item img {
            display: block;
            width: 100%;
            height: 110px;
            margin: 0;
            object-fit: cover;
        }

        .photo-item form { padding: 8px; }

        .remove-photo {
            width: 100%;
            padding: 8px;
            background: #fff;
            color: #a2382f;
            font-size: 12px;
            border: 1px solid #e7c7c3;
        }

        .remove-photo:hover { background: #fff2f0; }

        .empty-photos {
            margin: 0;
            color: #68736b;
            font-size: 14px;
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

    @if (session('status'))
        <div class="notice" role="status">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="notice" role="alert">Please review the highlighted fields and try again.</div>
    @endif

    <section class="photo-section" aria-labelledby="photos-heading">
        <h2 id="photos-heading">Current photos ({{ $place->images->count() }})</h2>
        @if ($place->images->isNotEmpty())
            <div class="photo-grid">
                @foreach ($place->images as $image)
                    <div class="photo-item">
                        <img src="{{ $image->path ? asset('storage/' . $image->path) : asset($image->url) }}" alt="{{ $image->label ?: $place->name }}">
                        <form action="{{ route('places.image.delete', [$place->id, $image->id]) }}" method="post" onsubmit="return confirm('Remove this photo from the place?')">
                            @csrf
                            @method('DELETE')
                            <button class="remove-photo" type="submit">Remove photo</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p class="empty-photos">No photos have been added for this place yet.</p>
        @endif
    </section>

    <form action="{{ route('places.update', $place->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <p>
            Name:
            <input type="text" name="name"
                   value="{{ old('name', $place->name) }}" required>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            Category:
            <select name="category">
                <option value="">Choose a category</option>
                <option value="attractions" @selected(old('category', $place->category) === 'attractions')>Attractions & heritage</option>
                <option value="schools" @selected(old('category', $place->category) === 'schools')>Schools & education</option>
                <option value="stays" @selected(old('category', $place->category) === 'stays')>Hotels, stays & resorts</option>
                <option value="worship" @selected(old('category', $place->category) === 'worship')>Churches & places of worship</option>
                <option value="markets" @selected(old('category', $place->category) === 'markets')>Markets & shopping</option>
                <option value="food" @selected(old('category', $place->category) === 'food')>Food & restaurants</option>
                <option value="health" @selected(old('category', $place->category) === 'health')>Healthcare</option>
                <option value="events" @selected(old('category', $place->category) === 'events')>Events & festivals</option>
                <option value="motor-parks" @selected(old('category', $place->category) === 'motor-parks')>Motor parks & transport</option>
                <option value="services" @selected(old('category', $place->category) === 'services')>Useful services</option>
            </select>
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
            <input type="number" name="lat" step="any"
                   min="-90" max="90"
                   value="{{ old('lat', $place->lat) }}">
            @error('lat')
                <span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            Longitude:
            <input type="number" name="lng" step="any"
                   min="-180" max="180"
                   value="{{ old('lng', $place->lng) }}">
            @error('lng')
                <span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            Add photos:
            <input type="file" name="images[]" multiple
                   accept="image/jpeg,image/png,image/webp">

            <small>You can choose more than one JPG, PNG or WebP image. Each image can be up to 2 MB.</small>

            @if ($errors->has('image') || $errors->has('images') || $errors->has('images.*'))
                <br>
                <span class="error">{{ $errors->first('image') ?: $errors->first('images') ?: $errors->first('images.*') }}</span>
            @endif
        </p>

        <p>
            <button type="submit">Update Place</button>
        </p>

    </form>

    <a href="{{ route('places') }}" class="back">Back to Places</a>

</div>

</body>
</html>
