<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Strona Główna Korepetycji</title>

    <!-- Dodaj link do Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans bg-gray-100">

<!-- Nawigacja -->
<nav class="bg-white p-6">
    <div class="container mx-auto flex justify-between items-center">
        <a class="text-2xl font-semibold text-gray-800" href="#">System Korepetycji</a>
        <div class="flex space-x-4">
            <a href="{{ route('login') }}" class="text-gray-800 px-4 py-2">Zaloguj</a>
            <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Zarejestruj</a>
        </div>
    </div>
</nav>

<!-- Treść strony głównej -->
<div class="container mx-auto mt-8">
    <div class="p-8 bg-white shadow-md rounded-md">
        <h1 class="text-4xl font-bold mb-4">Witaj w Systemie Korepetycji!</h1>
        <p class="text-gray-700 leading-relaxed">
            Jesteśmy tutaj, aby pomóc Ci w osiągnięciu sukcesu edukacyjnego poprzez oferowanie wysokiej jakości korepetycji.
        </p>
        <p class="text-gray-700 leading-relaxed mt-4">
            Niezależnie od tego, czy potrzebujesz wsparcia w nauce matematyki, fizyki, języków obcych czy innych przedmiotów,
            nasz zespół doświadczonych korepetytorów jest gotów pomóc Ci w zdobyciu wiedzy i umiejętności.
        </p>
        <hr class="my-6">
        <p class="text-gray-700">
            Skorzystaj z naszych usług, aby podnieść swoje umiejętności edukacyjne. Zarejestruj się już dziś i znajdź
            idealnego korepetytora dla siebie!
        </p>
        <a href="{{ route('register') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-md">Zarejestruj się teraz</a>
    </div>
</div>

</body>
</html>
