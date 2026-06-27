<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raturiasfitrie Wedding Organizer Rias Pengantin Depok | Make Up Jabodetabek</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-heading { font-family: 'Playfair Display', serif; }
        .text-gold { color: #d4af37; }
        .bg-gold { background-color: #d4af37; }
        .border-gold { border-color: #d4af37; }
        .hover-bg-gold:hover { background-color: #c5a028; }
        
        .hero-bg {
            background-image: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.9)), url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Basic Fade In Animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased overflow-x-hidden selection:bg-gold selection:text-white">

    <!-- Navbar -->
    <nav class="absolute w-full z-50 px-6 py-4 md:px-12 md:py-6 flex justify-between items-center">
        <a href="{{ route('landing') }}" class="flex items-center gap-3 transition-transform hover:scale-105">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Raturiasfitrie" class="h-14 md:h-20 w-auto object-contain shrink-0">
            <h1 class="font-heading text-xl md:text-2xl font-bold tracking-widest text-gold leading-tight">RATURIASFITRIE<br><span class="text-white text-[10px] md:text-xs tracking-[0.2em] font-light block mt-1">WEDDING ORGANIZER</span></h1>
        </a>
        <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-full border border-gold/30 text-gold hover:bg-gold hover:text-white transition-all text-xs md:text-sm tracking-wider font-medium backdrop-blur-sm">STAFF LOGIN</a>
    </nav>

    <!-- Hero Section -->
    <section class="hero-bg min-h-screen flex items-center justify-center relative px-6 text-center">
        <!-- Decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gold/20 rounded-full blur-3xl mix-blend-overlay"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl mix-blend-overlay"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto space-y-8 animate-fade-in-up mt-16">
            <div class="inline-block px-4 py-1.5 rounded-full border border-gold/40 text-gold text-xs font-semibold tracking-[0.2em] uppercase mb-4 backdrop-blur-md bg-white/5 shadow-xl">
                Momen Indah, Kenangan Abadi
            </div>
            <h2 class="font-heading text-5xl md:text-7xl font-bold text-white leading-tight drop-shadow-lg">
                Wujudkan Pernikahan <br>
                <span class="text-gold italic font-light">Impian Anda</span>
            </h2>
            <p class="text-slate-300 text-lg md:text-xl font-light max-w-2xl mx-auto leading-relaxed drop-shadow-md">
                Raturiasfitrie Wedding Organizer hadir untuk merangkai setiap detail hari bahagia Anda menjadi mahakarya yang tak terlupakan.
            </p>
            <div class="pt-8">
                <a href="#paket" class="inline-flex items-center gap-2 px-8 py-4 bg-gold hover:bg-yellow-600 text-white rounded-full font-medium tracking-wide transition-all shadow-lg shadow-gold/20 hover:shadow-gold/40 hover:-translate-y-1">
                    Lihat Pilihan Paket
                    <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                </a>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-pulse">
            <svg class="w-6 h-6 text-gold/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </section>

    <!-- Packages Section -->
    <section id="paket" class="py-24 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="text-center mb-16">
                <h3 class="font-heading text-4xl md:text-5xl font-bold text-slate-900 mb-4">Paket Eksklusif Kami</h3>
                <div class="w-24 h-1 bg-gold mx-auto rounded-full mb-6"></div>
                <p class="text-slate-500 max-w-2xl mx-auto text-lg">Pilih paket pernikahan yang disesuaikan dengan kebutuhan dan visi perayaan cinta Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($packages as $package)
                    <div class="group relative bg-white rounded-3xl p-8 border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] transition-all duration-500 hover:-translate-y-2 flex flex-col h-full overflow-hidden">
                        <!-- Card decorative background shape -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gold/5 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                        
                        <div class="absolute top-6 right-6 p-2 pointer-events-none opacity-20 group-hover:opacity-40 transition-opacity">
                            <svg class="w-12 h-12 text-gold" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        </div>
                        
                        <div class="mb-6 z-10 relative">
                            <div class="inline-block px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-xs font-semibold mb-4">PILIHAN PAKET</div>
                            <h4 class="font-heading text-2xl font-bold text-slate-800 mb-3 group-hover:text-gold transition-colors">{{ $package->nama_paket }}</h4>
                            <div class="flex items-baseline gap-1">
                                <span class="text-sm font-semibold text-slate-400">Rp</span>
                                <span class="text-3xl font-black text-slate-900 tracking-tight">{{ number_format($package->harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <div class="flex-1 z-10 relative">
                            <p class="text-slate-600 leading-relaxed text-sm mb-8 whitespace-pre-line">{{ $package->deskripsi }}</p>
                        </div>
                        
                        <div class="pt-6 border-t border-slate-100 z-10 mt-auto relative">
                            <a href="https://wa.me/6287749298785?text={{ urlencode('Halo Admin Raturiasfitrie, saya tertarik dan ingin konsultasi mengenai ' . $package->nama_paket . '.') }}" target="_blank" class="flex justify-center items-center gap-2 w-full px-6 py-3.5 bg-slate-50 group-hover:bg-gold group-hover:text-white text-slate-700 font-semibold rounded-xl transition-all shadow-sm">
                                <svg class="w-5 h-5 text-emerald-500 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.418-.1.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-5.824 4.74-10.563 10.564-10.563 5.826 0 10.564 4.739 10.564 10.563 0 5.825-4.738 10.563-10.564 10.563z"/></svg>
                                Tanya via WA
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-3xl border border-slate-100 shadow-sm">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <p class="text-slate-500 font-medium text-lg">Katalog paket pernikahan sedang diperbarui.</p>
                        <p class="text-slate-400 text-sm mt-2">Silakan hubungi admin kami untuk informasi lebih lanjut.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Location & Contact Footer -->
    <footer class="bg-slate-900 text-slate-300 py-20 border-t border-slate-800 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-gold/5 rounded-full blur-3xl -mr-[250px] -mt-[250px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1 md:grid-cols-12 gap-12 relative z-10">
            <!-- Brand -->
            <div class="md:col-span-5 space-y-6">
                <h1 class="font-heading text-3xl font-bold tracking-widest text-gold leading-tight">RATURIASFITRIE<br><span class="text-white text-sm tracking-[0.2em] font-light">WEDDING ORGANIZER</span></h1>
                <p class="max-w-md text-slate-400 leading-relaxed">
                    Partner terpercaya Anda dalam mewujudkan hari bahagia yang sempurna. Desain elegan, manajemen profesional, dan memori yang tak ternilai.
                </p>
                <div class="flex space-x-4 pt-2">
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-gold hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-gold hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="md:col-span-3 space-y-6">
                <h4 class="text-white font-semibold text-lg tracking-wider uppercase">Menu Cepat</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-slate-400 hover:text-gold transition-colors inline-block hover:translate-x-1 transform duration-200">Beranda</a></li>
                    <li><a href="#paket" class="text-slate-400 hover:text-gold transition-colors inline-block hover:translate-x-1 transform duration-200">Katalog Paket</a></li>
                    <li><a href="{{ route('login') }}" class="text-slate-400 hover:text-gold transition-colors inline-block hover:translate-x-1 transform duration-200">Area Staf</a></li>
                </ul>
            </div>

            <!-- Contact & Location -->
            <div class="md:col-span-4 space-y-6">
                <h4 class="text-white font-semibold text-lg tracking-wider uppercase">Hubungi Kami</h4>
                <ul class="space-y-5">
                    <li class="flex items-start gap-4">
                        <div class="mt-1 p-2.5 bg-slate-800/80 rounded-xl text-gold shadow-inner border border-slate-700/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-white font-medium mb-1">Lokasi Kami</p>
                            <p class="text-slate-400 text-sm leading-relaxed">Jl. Raya Kalimulya No.51, Kalimulya,<br>Kec. Cilodong, Kota Depok, Jawa Barat 16413</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="mt-1 p-2.5 bg-slate-800/80 rounded-xl text-gold shadow-inner border border-slate-700/50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <p class="text-white font-medium mb-1">WhatsApp / Telepon</p>
                            <p class="text-slate-400 text-sm">0877 - 4929 - 8785</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 md:px-12 mt-16 pt-8 border-t border-slate-800/50 text-center text-slate-500 text-sm relative z-10">
            &copy; {{ date('Y') }} Raturiasfitrie Wedding. All rights reserved. Built with ❤️.
        </div>
    </footer>

    <!-- Floating WhatsApp CTA -->
    <a href="https://wa.me/6287749298785?text=Halo%20Admin%20Raturiasfitrie,%20saya%20ingin%20konsultasi%20mengenai%20paket%20wedding." target="_blank" class="fixed bottom-8 right-8 z-50 bg-emerald-500 hover:bg-emerald-600 text-white p-4 rounded-full shadow-[0_8px_30px_rgb(16,185,129,0.4)] hover:shadow-[0_15px_40px_rgb(16,185,129,0.6)] transition-all hover:-translate-y-2 group flex items-center gap-0 hover:gap-3 overflow-hidden border border-emerald-400/30 backdrop-blur-sm">
        <svg class="w-8 h-8 flex-shrink-0 animate-pulse group-hover:animate-none" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.418-.1.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-5.824 4.74-10.563 10.564-10.563 5.826 0 10.564 4.739 10.564 10.563 0 5.825-4.738 10.563-10.564 10.563z"/></svg>
        <span class="max-w-0 opacity-0 group-hover:max-w-xs group-hover:opacity-100 font-bold tracking-wide text-sm whitespace-nowrap transition-all duration-300 ease-in-out pr-2">
            Konsultasi via WA
        </span>
    </a>

</body>
</html>
