<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section class="relative bg-cover bg-center bg-no-repeat"
        style="background-image: url('<?= BASE_URL ?>img/image.png');">
        <div class="absolute inset-0 bg-black/40"></div> <!-- Overlay gelap -->
        <div class="relative z-10 mx-auto max-w-screen-xl px-4 py-24 text-white">
            <h1 class="text-4xl font-bold sm:text-5xl">
                Understand user flow and
                <strong class="text-indigo-400"> increase </strong>
                conversions
            </h1>

            <p class="mt-4 text-lg">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, nisi. Natus, provident accusamus
                impedit minima harum corporis iusto.
            </p>

            <div class="mt-6 flex gap-4">
                <a class="inline-block rounded bg-indigo-600 px-5 py-3 font-medium text-white hover:bg-indigo-700"
                    href="#">
                    Get Started
                </a>
                <a class="inline-block rounded border border-white px-5 py-3 font-medium text-white hover:bg-white hover:text-indigo-700"
                    href="#">
                    Learn More
                </a>
            </div>
        </div>
    </section>
</body>

</html>