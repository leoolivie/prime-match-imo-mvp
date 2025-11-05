<nav class="bg-blue-600 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-white text-2xl font-bold">
                    Prime Match Imo
                </a>
            </div>
            
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-white">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            Sair
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-blue-200 px-3 py-2">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded">
                        Cadastrar
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
