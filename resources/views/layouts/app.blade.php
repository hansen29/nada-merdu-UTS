<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nada Merdu Studio') - Sistem Informasi Studio Musik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen">
    <nav class="bg-slate-900 border-b border-slate-800">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-4">
            <div>
                <a href="{{ route('rooms.index') }}" class="text-xl font-bold text-amber-400 tracking-wide">
                    NADA MERDU STUDIO
                </a>
                <p class="text-xs text-slate-400">Master Data Ruangan & Alat Musik</p>
            </div>
            <div class="flex items-center gap-3 text-sm">
                <a href="{{ route('rooms.index') }}"
                   class="px-3 py-2 rounded-lg {{ request()->routeIs('rooms.*') ? 'bg-amber-500 text-slate-950 font-semibold' : 'bg-slate-800 text-slate-200 hover:bg-slate-700' }}">
                    Ruangan Studio
                </a>
                <a href="{{ route('instruments.index') }}"
                   class="px-3 py-2 rounded-lg {{ request()->routeIs('instruments.*') ? 'bg-amber-500 text-slate-950 font-semibold' : 'bg-slate-800 text-slate-200 hover:bg-slate-700' }}">
                    Alat Musik
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-emerald-950 border border-emerald-700 px-4 py-3 text-emerald-300 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-rose-950 border border-rose-700 px-4 py-3 text-rose-300 text-sm">
                <p class="font-semibold mb-1">Periksa kembali input berikut:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>