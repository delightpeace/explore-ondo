
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Ondo</title>
</head>

<body style="margin: 0; padding: 30px; font-family: Arial, sans-serif; background-color: #f4f7f5; color: #26352d;">

    <h1 style="text-align: center; color: #176b45; margin-bottom: 30px;">
        Explore Ondo
    </h1>

    <h2 style="color: #176b45;">Add a New Place</h2>

    <form action="{{ route('places.add') }}" method="post"  enctype="multipart/form-data" >
          style="max-width: 600px; margin: 20px auto; padding: 25px; background-color: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">

    

        <div style="margin-bottom: 18px;">
            <label for="name" style="display: block; margin-bottom: 8px; font-weight: bold;">
                Place Name
            </label>
            <input type="text" id="name" name="name" required
                   style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 18px;">
            <label for="description" style="display: block; margin-bottom: 8px; font-weight: bold;">
                Description
            </label>
            <textarea id="description" name="description" required
                      style="width: 100%; min-height: 100px; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box;"></textarea>
        </div>

        <div style="margin-bottom: 18px;">
            <label for="address" style="display: block; margin-bottom: 8px; font-weight: bold;">
                Address
            </label>
            <input type="text" id="address" name="address" required
                   style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 18px;">
            <label for="lat" style="display: block; margin-bottom: 8px; font-weight: bold;">
                Latitude
            </label>
            <input type="number" step="any" id="lat" name="lat"
                   placeholder="e.g. 7.0925"
                   style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 18px;">
            <label for="lng" style="display: block; margin-bottom: 8px; font-weight: bold;">
                Longitude
            </label>
            <input type="number" step="any" id="lng" name="lng"
                   placeholder="e.g. 4.8410"
                   style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 18px;">
            <label for="image" style="display: block; margin-bottom: 8px; font-weight: bold;">
                Place Image
            </label>
            <input type="file" id="image" name="image" accept="image/*"
                   style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box;">
        </div>

        <button type="submit"
                style="padding: 12px 20px; background-color: #176b45; color: white; border: none; border-radius: 6px; cursor: pointer;">
            Add Place
        </button>
    </form>

    <h2 style="color: #176b45; margin-top: 40px;">
        Popular Places in Ondo
    </h2>

    @foreach ($places as $place)
        <article style="margin: 15px 0; padding: 20px; background-color: white; border-radius: 10px; border-left: 5px solid #176b45;">

            <h3 style="margin-top: 0; color: #176b45;">
                {{ $place->name }}
            </h3>

            @if ($place->image)
                <img src="{{ asset('storage/' . $place->image) }}"
                     alt="{{ $place->name }}"
                     style="width: 100%; max-width: 400px; height: auto; border-radius: 8px; margin-bottom: 15px;">
            @endif

            <p>{{ $place->description }}</p>

            <p>
                <strong>Address:</strong> {{ $place->address }}
            </p>

            @if ($place->lat !== null && $place->lng !== null)
                <p><strong>Latitude:</strong> {{ $place->lat }}</p>
                <p><strong>Longitude:</strong> {{ $place->lng }}</p>

                <a href="https://www.google.com/maps?q={{ $place->lat }},{{ $place->lng }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   style="color: #176b45; font-weight: bold;">
                    View on Google Maps
                </a>
            @endif

            <div style="margin-top: 15px;">

                <a href="{{ route('places.edit', $place->id) }}"
                   style="display: inline-block; background-color: #198754; color: white; padding: 10px 18px; text-decoration: none; border-radius: 5px; margin-right: 8px;">
                    Edit Place
                </a>

                <form action="{{ route('places.delete', $place->id) }}"
                      method="POST"
                      style="display: inline-block;"
                      onsubmit="return confirm('Are you sure you want to delete this place?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            style="padding: 10px 20px; background-color: #dc3545; color: white; border: none; border-radius: 6px; cursor: pointer;">
                        Delete
                    </button>
                </form>

            </div>
        </article>

@foreach ($place->images as $image)
    <img src="{{ asset('storage/' . $image->path) }}"
         alt="{{ $image->label ?? $place->name }}"
         style="width: 100%; max-width: 400px; height: auto; border-radius: 8px;">
@endforeach

    @endforeach

</body>
</html>
