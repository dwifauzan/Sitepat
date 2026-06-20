<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 · LATELINK SMAKENSA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center px-4 bg-gradient-to-br from-blue-600 via-violet-700 to-red-600">
        <div class="text-center">
            <h1 class="text-8xl font-bold text-white mb-4">404</h1>
            <p class="text-xl text-white/80 mb-8">Halaman tidak ditemukan</p>
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-blue-600 font-medium rounded-lg hover:bg-slate-100 transition-colors duration-150">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>
</body>
</html>
