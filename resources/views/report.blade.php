<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>

<body>
    <div class="d-flex" style="height: 100vh; overflow: hidden; background-color:black">
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
                <li class="nav-item mb-4 {{ Request::is('managefilm') ? 'bg-primary' : '' }}" 
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="/managefilm" class="nav-link text-white d-flex align-items-center">
                        <img src="{{ asset('images/Setting.png') }}" alt="film" width="60" height="60" class="me-2">
                        <h4><b>Manage Film</b></h4>
                    </a>
                </li>
                <li class="nav-item mb-4 {{ Request::is('report') ? 'bg-primary' : '' }}"
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="/report" class="nav-link text-white d-flex align-items-center">
                        <img src="{{ asset('images/alert.png') }}" alt="film" width="60" height="60"class="me-2">
                        <h4><b>Report</b></h4>
                    </a>
                </li>
                <li class="nav-item mb-4">
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
                <a href=""><img src="{{ asset('images/account.png') }}" alt="Profile" class="rounded-circle"
                        width="40" height="40"></a>
            </nav>

            <!-- Main Content -->
            <div class="bg-black text-white px-5 py-4" style="overflow-y: auto;">
                <h2>Daftar Komentar Dilaporkan</h2>

                @if ($lapor->count() > 0)
                    <table class="table table-dark table-striped mt-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pengguna</th>
                                <th>Film</th>
                                <th>Komentar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lapor as $index => $komen)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $komen->user->name }}</td>
                                    <td>{{ $komen->film->judul }}</td>
                                    <td>{{ $komen->komen }}</td>
                                    <td>
                                        <form action="{{ route('hapus.komen.lapor', $komen->id) }}" method="POST" style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus Komentar</button>
                                        </form>
                                        {{-- <form action="{{ route('batalkan.lapor', $komen->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button class="btn btn-secondary btn-sm" onclick="return confirm('Batalkan laporan?')">Batalkan</button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mt-4">Tidak ada komentar yang dilaporkan saat ini.</p>
                @endif
            </div>
        </div>
    </div>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
