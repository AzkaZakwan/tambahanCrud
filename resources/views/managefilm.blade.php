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
                 <li class="nav-item mb-4 {{ Request::is('film') ? 'bg-primary' : '' }}"
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="#" class="nav-link text-white d-flex align-items-center">
                        <img src="{{ asset('images/filmm.png') }}" alt="film" width="60" height="60"
                            class="me-2">
                        <h4><b>Film</b></h4>
                    </a>
                </li>
                <li class="nav-item mb-4 {{ Request::is('managefilm*') ? 'bg-primary' : '' }}" 
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="/managefilm" class="nav-link text-white d-flex align-items-center">
                        <img src="{{ asset('images/Setting.png') }}" alt="film" width="60" height="60" class="me-2">
                        <h4><b>Manage Film</b></h4>
                    </a>
                </li>
                <li class="nav-item mb-4 {{ Request::is('report*') ? 'bg-primary' : '' }}"
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="/report" class="nav-link text-white d-flex align-items-center">
                        <img src="{{ asset('images/alert.png') }}" alt="film" width="60" height="60"class="me-2">
                        <h4><b>Report</b></h4>
                    </a>
                </li>
                <li class="nav-item mb-4 {{ Request::is('Account*') ? 'bg-primary' : '' }}"
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="#" class="nav-link text-white d-flex align-items-center">
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
    <div class="bg-black text-white px-5 py-4" style="max-height: 90vh; overflow-y: auto;">
        <!-- Alert -->
        @if (session('status'))
        <div id="status-alert" class="alert alert-success text-center position-fixed top-0 start-50 translate-middle-x mt-3"
             style="z-index: 9999; width: auto; max-width: 80%;">
            {{ session('status') }}
        </div>
        @endif

        <!-- Tambah Film -->
        <div class="container bg-dark p-4 rounded mb-5" style="max-width: 600px;">
            <h3 class="text-white mb-4">{{ $film->exists ? 'Edit Film' : 'Tambah Film' }}</h3>
            <form action="{{ $film->exists ? route('put.edit', $film->id) : route('post.tambah') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if ($film->exists) @method('PUT') @endif

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" placeholder="Judul film" value="{{ old('judul', $film->judul) }}">
                    @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" name="foto" accept="image/*">
                    @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi film">{{ old('deskripsi', $film->deskripsi) }}</textarea>
                    @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="views" class="form-label">Views</label>
                    <input type="number" class="form-control" name="views" placeholder="Jumlah views" value="{{ old('views', $film->views) }}">
                    @error('views') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <div class="row">
                        @foreach ($genres as $item)
                        <div class="col-md-6 mb-2">
                            <div class="form-check bg-secondary p-2 rounded">
                                <input class="form-check-input" type="checkbox" name="genre[]" id="genre{{ $item->id }}"
                                       value="{{ $item->id }}"
                                       {{ (is_array(old('genre', [])) && in_array($item->id, old('genre', []))) ? 'checked' : '' }}>
                                <label class="form-check-label" for="genre{{ $item->id }}">{{ $item->genre }}</label>
                            </div>
                        </div>
                        @endforeach
                        @error('genre') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">
                    {{ $film->exists ? 'Update Film' : 'Tambah Film' }}
                </button>
            </form>
        </div>

        <!-- List Film -->
        <div class="row g-4">
            @foreach ($films as $film)
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card bg-dark text-white h-100">
                    <img src="{{ asset('storage/' . $film->foto) }}" class="card-img-top" alt="Poster"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $film->judul }}</h5>
                        <div class="mt-auto d-flex flex-column gap-2">
                            <a href="{{ route('film.view', ['id' => $film->id]) }}" class="btn btn-light btn-sm">Read More</a>
                            <form action="{{ route('get.edit', ['id' => $film->id, 'judul' => $film->judul]) }}" method="GET">
                                <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                            </form>
                            <form action="{{ route('hapus.film', $film->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus film?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(function () {
            const alert = document.getElementById('status-alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);
    </script>
</div>
</body>
</html>

