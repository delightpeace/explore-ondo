
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Ondo | Discover Ondo Town</title>
</head>

<body style="margin: 0; font-family: Arial, sans-serif; color: #26352d; background-color: #f7f9f7;">

    <!-- Navigation Bar -->
    <nav style="display: flex; justify-content: space-between; align-items: center; padding: 20px 8%; background-color: white; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
        <h2 style="margin: 0; color: #176b45;">Explore Ondo</h2>

        <div>
            <a href="/" style="margin-left: 15px; color: #176b45; text-decoration: none; font-weight: bold;">Home</a>
            <a href="#about" style="margin-left: 15px; color: #333; text-decoration: none;">About Ondo</a>
            <a href="#places" style="margin-left: 15px; color: #333; text-decoration: none;">Popular Places</a>
        </div>
    </nav>

    
<!-- Welcome Section -->
<section style="padding: 90px 8%; text-align: center; color: white; background-image: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)), url('https://nucis.ng/wp-content/uploads/2022/08/ondo.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">

    <p style="font-size: 14px; letter-spacing: 3px; text-transform: uppercase;">
        Discover the Beauty of Ondo
    </p>

    <h1 style="font-size: 44px; margin: 15px 0;">
        Welcome to Ondo Town
    </h1>

    <p style="max-width: 650px; margin: 0 auto 30px; font-size: 18px; line-height: 1.8;">
        Explore the history, culture, heritage, and remarkable places
        that make Ondo a special part of southwestern Nigeria.
    </p>

    <a href="#places" style="display: inline-block; padding: 14px 25px; background-color: white; color: #176b45; text-decoration: none; border-radius: 6px; font-weight: bold;">
        Explore Popular Places
    </a>

</section>


    <!-- About Ondo -->
    <section id="about" style="padding: 60px 8%; background-color: white;">
        <h2 style="text-align: center; color: #176b45; font-size: 30px;">
            About Ondo Town
        </h2>

        <p style="max-width: 850px; margin: 20px auto 0; line-height: 1.9; font-size: 16px; color: #555;">
           Ondo Town, also known as Ode Ondo, is a historic Yoruba town located in Ondo State, southwestern Nigeria. The town is known for its rich cultural heritage, traditional leadership, and strong community values that have been preserved across generations. Its history is closely connected to the Osemawe, the traditional ruler of Ondo Kingdom, whose palace represents an important part of the town's identity and heritage. Ondo is home to cultural celebrations, local markets, educational institutions, and thriving communities that contribute to its growth and development. With its unique traditions, welcoming people, and blend of cultural heritage and modern life, Ondo Town remains a remarkable place to explore and learn about Yoruba history and culture.
    </section>

    <!-- Popular Places -->
    <section id="places" style="padding: 60px 8%;">
        <h2 style="text-align: center; color: #176b45; font-size: 30px;">
            Popular Places in Ondo
        </h2>

        <p style="text-align: center; color: #666; margin-bottom: 35px;">
            Discover places worth knowing about in Ondo town.
        </p>

        <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">

            @foreach ($places as $place)
                <article style="flex: 1 1 250px; max-width: 350px; padding: 25px; background-color: white; border-radius: 10px; border: 1px solid #e2e9e3; box-shadow: 0 4px 12px rgba(0,0,0,0.04);">

                    <h3 style="margin-top: 0; color: #176b45; font-size: 21px;">
                        {{ $place->name }}
                    </h3>

                    <p style="line-height: 1.7; color: #555;">
                        {{ $place->description }}
                    </p>

                    <p style="line-height: 1.6; color: #555;">
                        <strong style="color: #26352d;">Address:</strong>
                        {{ $place->address }}
                    </p>


                    
                </article>
            @endforeach

        </div>
    </section>

    <!-- Footer -->
    <footer style="padding: 25px; text-align: center; background-color: #123d2b; color: white;">
        <p style="margin: 0;">&copy; {{ date('Y') }} Explore Ondo by Delight Adebisi. All rights reserved.</p>
    </footer>

</body>
</html>
