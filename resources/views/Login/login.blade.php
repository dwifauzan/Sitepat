<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | LATELINK</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center px-4 py-12" style="background: linear-gradient(135deg, #2563EB 0%, #DC2626 100%);">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <div class="w-16 h-16 rounded-2xl bg-primary-600 flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-2xl">L</span>
                </div>
                <h1 class="text-2xl font-bold text-slate-800">LATELINK</h1>
                <p class="text-sm text-slate-500 mt-1">SMA KENSA Bondowoso</p>
            </div>

            <form action="{{ route('loginAction') }}" method="post">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                        <input type="text" name="name" id="name" placeholder="Masukan Username" autofocus
                            class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm px-4 py-2.5">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                        <input type="password" name="password" id="password" placeholder="Masukan Password"
                            class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm px-4 py-2.5">
                    </div>

                    @if (session()->has('pesan'))
                        <div class="p-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                            {{ session('pesan') }}
                        </div>
                    @endif

                    <button type="submit" class="w-full py-2.5 px-4 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
