<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <style>
        .sidebar {
            background-color: #1a1a2e;
            width: 280px;
            display: flex;
            flex-direction: column;
        }

        .profile-section {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: flex-start;
            margin-bottom: 5px;
        }

        .profile-info-container {
            display: flex;
            flex-direction: column;
            margin-left: 20px;
        }

        .profile-pic {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-actions {
            margin-top: 5px;
        }

        .profile-details {
            margin-top: 25px;
        }

        .detail-item {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eaeaea;
        }

        .username {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="d-flex" style="height: 100vh; overflow: hidden;">
        <!-- Sidebar -->
        <div class="sidebar text-white p-3">
            <a href="#" class="text-white p-3 h1" style="text-decoration:none"><b>FIVOY</b></a>
            <ul class="nav flex-column">
                <li class="nav-item mb-4 {{ Request::is('dashboard') ? 'bg-primary' : '' }}"
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="/dashboard" class="nav-link text-white d-flex align-items-center">
                        <img src="{{ asset('images/filmm.png') }}" alt="film" width="60" height="60" class="me-2">
                        <h4><b>Film</b></h4>
                    </a>
                </li>
                <li class="nav-item mb-4 {{ Request::is('libraries') ? 'bg-primary' : '' }}"
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="/libraries" class="nav-link text-white d-flex align-items-center">
                        <img src="{{ asset('images/history.png') }}" alt="film" width="60" height="60" class="me-2">
                        <h4><b>Libraries</b></h4>
                    </a>
                </li>
                <li class="nav-item mb-4 {{ Request::is('favorites') ? 'bg-primary' : '' }}"
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="/favorites" class="nav-link text-white d-flex align-items-center">
                        <img src="{{ asset('images/favorites.png') }}" alt="film" width="60" height="60" class="me-2">
                        <h4><b>Favorites</b></h4>
                    </a>
                </li>
                <li class="nav-item mb-4 {{ Request::is('account') ? 'bg-primary' : '' }}"
                    style="border-radius:25px; width:100%; max-width:300px;">
                    <a href="#" class="nav-link text-white d-flex align-items-center">
                        <img src="{{ asset('images/account1.png') }}" alt="film" width="60" height="60" class="me-2">
                        <h4><b>Account</b></h4>
                    </a>
                </li>
            </ul>
            <div class="mt-auto">
                <a href="/logout" class="btn btn-danger w-100">Logout</a>
            </div>
        </div>

        <!-- Main Area -->
        <div class="flex-grow-1 d-flex flex-column overflow-hidden" style="background-color:black">
            <!-- Top Navbar -->
            <nav class="navbar navbar-dark bg-black px-3">
                <form class="d-flex flex-grow-1 me-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                <a href=""><img src="{{ asset('images/account.png') }}" alt="Profile" class="rounded-circle" width="40" height="40"></a>
            </nav>

            <!-- Content -->
            <div class="flex-grow-1 overflow-auto p-4">
                <div class="profile-section">
                    <!-- Profile Header -->
                    <div class="profile-header">
                        @if(session('user')['image'] ?? false)
                            <img src="{{ asset('storage/' . session('user')['image']) }}" alt="Profile" class="profile-pic">
                        @else
                            <img src="{{ asset('images/account.png') }}" alt="Profile" class="profile-pic">
                        @endif

                        <div class="profile-info-container">
                            <h2 class="username">{{ session('user')['name'] }}</h2>
                            <!-- Button Edit -->
                            <div class="profile-actions">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal" style="background-color:#3000f0;width:170px">
                                    Edit Profile
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Details -->
                    <div class="profile-details">
                        <h5 class="mb-3">Gender</h5>
                        <div class="detail-item">
                            <p class="mb-1">{{ session('user')['gender'] ?? '-' }}</p>
                        </div>

                        <h5 class="mb-3 mt-4">Alamat</h5>
                        <div class="detail-item">
                            <p class="mb-1">{{ session('user')['alamat'] ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-white text-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ session('user')['name'] }}">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Laki Laki" {{ (session('user')['gender'] ?? '') == 'Laki Laki' ? 'checked' : '' }}>
                                <label class="form-check-label" for="male">Laki Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Perempuan" {{ (session('user')['gender'] ?? '') == 'Perempuan' ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">Perempuan</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ session('user')['alamat'] ?? '' }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
