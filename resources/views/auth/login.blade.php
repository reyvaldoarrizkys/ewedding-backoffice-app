<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Internal System Raturiasfitrie</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-heading { font-family: 'Playfair Display', serif; }
        .text-gold { color: #d4af37; }
        .bg-gold { background-color: #d4af37; }
        .border-gold { border-color: #d4af37; }
        .hover-bg-gold:hover { background-color: #c5a028; }
    </style>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute top-0 left-0 w-full h-96 bg-slate-900 -skew-y-6 transform origin-top-left -z-10 shadow-2xl"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-gold opacity-10 rounded-full blur-3xl -z-10"></div>
    
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 pb-6 bg-slate-900 text-center relative">
            <div class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-md">
                <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h1 class="font-heading text-2xl font-bold tracking-wider text-gold mb-1">RATURIASFITRIE</h1>
            <p class="text-slate-400 text-sm tracking-[0.2em] font-light">WEDDING</p>
        </div>
        
        <div class="p-8 pt-10">
            <h2 class="text-xl font-semibold text-slate-800 text-center mb-6">Welcome Back, Team</h2>
            
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 text-red-600 text-sm rounded-lg border border-red-100">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold transition-colors"
                        placeholder="admin@raturiasfitrie.com">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-gold focus:border-gold transition-colors"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-gold focus:ring-gold border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-slate-600">
                        Remember me
                    </label>
                </div>

                <button type="submit" class="w-full py-3 px-4 bg-gold hover:bg-yellow-600 text-white font-medium rounded-lg shadow-lg shadow-yellow-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                    Sign In
                </button>
            </form>
        </div>
        <div class="px-8 py-4 bg-slate-50 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-500">Secured Access - WO Raturiasfitrie Internal Only</p>
        </div>
    </div>
</body>
</html>
