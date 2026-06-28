<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login · LATELINK SMAKENSA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center px-4 py-12 bg-gradient-to-br from-blue-600 via-violet-700 to-red-600">
        <div class="w-full max-w-sm bg-white/95 backdrop-blur rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <div class="w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-white text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-slate-800">LATELINK</h1>
                <p class="text-sm text-slate-500 mt-1">SMKN 1 Bondowoso</p>
            </div>

            @if (session()->has('pesan'))
                <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('pesan') }}
                </div>
            @endif

            <form action="/login/exceute" method="post">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fas fa-user"></i>
                            </div>
                            <input type="text" name="name" id="name" placeholder="Masukan Username" autofocus
                                class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm pl-10 pr-4 py-2.5">
                        </div>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" name="password" id="password" placeholder="Masukan Password"
                                class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 text-sm pl-10 pr-10 py-2.5">
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors" onclick="const input = this.parentElement.querySelector('input'); input.type = input.type === 'password' ? 'text' : 'password'; this.querySelector('i').classList.toggle('fa-eye'); this.querySelector('i').classList.toggle('fa-eye-slash');">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Masuk ke Sistem
                    </button>
                </div>
            </form>

            <p class="text-xs text-slate-400 text-center mt-4">&copy; {{ date('Y') }} SMKN 1 Bondowoso</p>
        </div>
    </div>
</body>
</html>
