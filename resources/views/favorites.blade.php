<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>managefilm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>

<body class="bg-black text-white" style="background-color: black;">
    <div class="d-flex" style="height: 100vh; overflow: hidden;">
        <!-- Sidebar -->
        <div class="sidebar text-white p-3">
            <a href="#" class="text-white p-3 h1" style="text-decoration:none"><b>FIVOY</b></a>
            <ul class="nav flex-column">
                <li class="nav-item mb-4 {{ Request::is('dashboard') ? 'bg-primary' : '' }}"
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="/dashboard" class="nav-link text-white d-flex align-items-center">
                        <img src="{{ asset('images/filmm.png') }}" alt="film" width="60" height="60"
                            class="me-2">
                        <h4><b>Film</b></h4>
                    </a>
                </li>
                <li class="nav-item mb-4 {{ Request::is('libraries') ? 'bg-primary' : '' }}"
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="/libraries" class="nav-link text-white d-flex align-items-center">
                        <img src="{{ asset('images/history.png') }}" alt="film" width="60" height="60"
                            class="me-2">
                        <h4><b>Libraries</b></h4>
                    </a>
                </li>
                <li class="nav-item mb-4 {{ Request::is('Favorites') ? 'bg-primary' : '' }}"
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="/favorites" class="nav-link text-white d-flex align-items-center">
                        <img src="{{ asset('images/favorites.png') }}" alt="film" width="60" height="60"
                            class="me-2">
                        <h4><b>Favorites</b></h4>
                    </a>
                </li>
                <li class="nav-item mb-4 {{ Request::is('Account') ? 'bg-primary' : '' }}"
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="/profile" class="nav-link text-white d-flex align-items-center">
                        <img src="{{ asset('images/account1.png') }}" alt="film" width="60" height="60"
                            class="me-2">
                        <h4><b>Account</b></h4>
                    </a>
                </li>
            </ul>
            <div class="mt-auto">
                <a href="/logout" class="btn btn-danger w-100">Logout</a>
            </div>
        </div>

        <!-- Main Area (navbar + content) -->
        <div class="flex-grow-1 d-flex flex-column overflow-hidden">
            <!-- Top Navbar -->
            <nav class="navbar px-3" style="background-color: rgb(63, 51, 51)">
                <form class="d-flex flex-grow-1 me-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                <a href=""><img src="{{ asset('images/account.png') }}" alt="Profile" class="rounded-circle"
                    width="40" height="40"></a>
            </nav>

            <!-- Main Content -->
            <div class="bg-black text-white px-5 pb-5" style="max-height: 90vh; overflow-y: auto;">
                <div class="my-4">
                    <h2 class="mb-4">{{session('user')['name']}}, ini film-film yang Kamu Sukai:</h2>

                    @if($films->isEmpty())
                        <div class="alert alert-info">Kamu belum menyukai film apapun.</div>
                    @else
                        <div class="d-flex flex-wrap gap-4">
                            @foreach ($films as $film)
                                <div class="d-flex bg-dark rounded p-2" style="width: 23%; min-width: 250px;">
                                    <img src="{{ asset('storage/' . $film->foto) }}" alt="Poster"
                                        style="width: 100px; height: 150px; object-fit: cover; border-radius: 5px;">
                                    <div class="ms-3 d-flex flex-column justify-content-between">
                                        <div>
                                            <h6 class="mb-2 text-white">{{ $film->judul }}</h6>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            {{-- button read more --}}
                                            <form>                                                                                                                        
                                            <a class="btn btn-light btn-sm" style="width: 100px; background-color:antiquewhite " 
                                            href="{{route('film.view',['id'=>$film->id])}}">Read More</a> 
                                            </form>
                                            {{-- button edit film --}}
                                            <form action="{{route('get.edit',['id'=>$film->id, 'judul'=> $film->judul])}}" method="GET">                                                                                                                        
                                                <button type="submit" class="btn btn-primary btn-sm" style="width: 100px; background-color:rgb(10, 80, 221)">Edit</button>
                                            </form>
                                            {{-- button hapus film --}}
                                            <form action="{{route('hapus.film',$film->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" style="width: 100px; background-color: rgb(191, 60, 60)" 
                                                    onclick="return confirm('yakin hapus film?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4">← Kembali</a>
                </div>
            </div>

            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
