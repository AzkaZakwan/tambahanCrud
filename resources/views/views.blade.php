<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>views</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>

<body>
    <div class="content-wrapper pt-5" style="background-color: black ;overflow-y: auto; height: 100vh;">
        
        <!-- Top Navbar -->
        <div class="flex-grow-1 d-flex flex-column">                      
                <nav class="navbar navbar-dark bg-black fixed-top ">
                    <a href="{{ session('user.role') == 'admin' ? '/managefilm' : '#' }}" class="text-white p-3 h1" style="text-decoration:none"><b>FIVOY</b></a>                                                                       
                </nav>

            <!-- Main Content -->
            <div class="d-flex flex-column gap-3 px-3 pb-3 bg-black text-white pt-5 px-4">                
                <div class="d-flex mt-5 overflow-hidden" style="padding-left:50px">
                    <img src="{{ asset('storage/' . $film->foto) }}" alt="poster film" width="200px" height="300px"
                        style="border-radius: 20px">
                    <div class="p-3">
                        <h5>{{$film->judul}}</h5>
                        <div class="rating d-flex align-items-center py-1">   
                            @if(session()->has('user')&& session('user')['role'] === 'user')
                                @if (!$sudahSuka)
                                <form action="{{route('sukai.film', $film->id)}}" method="POST">
                                    @csrf
                                    <button class="btn btn-primary" type="submit">
                                        Like
                                    </button>
                                </form>
                                @else
                                    <button class="btn btn-success" disabled>Sudah Like</button>
                                @endif
                            @endif                                                
                        </div>

                        <div class="genre d-flex flex-wrap">
                            @foreach ($film->genres as $genre)
                                <span class="badge bg-secondary me-2 mb-2">
                                    {{$genre->genre}}
                                </span>
                            @endforeach
                        </div>

                        <div class="mt-2">
                            <p style="text-align: justify"><strong>Deskripsi:</strong> <br>
                                {{$film->deskripsi}}
                            </p>
                            <p><strong>Views:</strong> <br>{{$film->views}}</p>
                        </div>
                    </div>
                </div>               

                <hr class="text-white">

                <!-- Bagian Komentar -->
                <div class="px-5">
                    <h3 class="text-white">Comments</h3>

                    <!-- Input Komentar -->
                    <div class="mb-3 d-flex align-items-center gap-2">                        
                        @if(@session('user'))
                        <form action="{{route('post.komen', $film->id)}}" method="POST">
                            @csrf
                            <textarea class="form-control" name="komen" id="commentInput" rows="1" style="width: 500px" placeholder="Tulis komentarmu di sini..."></textarea>
                            <button class="btn btn-success mt-2" type="submit" style="height: 40px;">Kirim</button>
                            </form>                                                      
                        @else
                            <p><a href="{{route('login')}}">Login terlebih dahulu untuk berkomentar</a></p>                            
                        @endauth
                    </div>

                    <!-- Daftar Komentar -->
                    <div class="mt-4">
                        @foreach ($film->komen as $komentar)
                            <div class="border rounded p-2 mb-2 bg-dark text-white">                            
                                    <strong>{{$komentar->user->name}}:</strong><br>
                                    <p class="comment-text-{{ $komentar->id }}">{{ $komentar->komen }}</p>

                                    @if (session('user.role') == 'admin')

                                        <div style="display:flex; gap:10px; align-items:flex-start;">    
                                            <form action="{{route('hapus.komen', $komentar->id)}}" method="POST" style="margin-top: auto; width: 50px">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    @elseif(session('user.id') == $komentar->user_id)
                                        <div style="display:flex; gap:10px; align-items:flex-start;">    
                                            <button class="btn btn-primary btn-sm btn-edit" style="width: 50px" data-id="{{ $komentar->id }}">Edit</button>
                                            <form action="{{route('edit.komen', $komentar->id)}}" method="POST" class="edit-form-{{ $komentar->id }}" style="display:none">
                                                @csrf
                                                @method('PUT')
                                                    <textarea name="komen" class="mb-2" rows="4">{{$komentar->komen}}</textarea>                                            
                                                    {{-- Button simpan edit dan batal edit --}}
                                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                    <button type="button" class="btn btn-secondary btn-sm btn-cancel" data-id="{{ $komentar->id }}">Batal</button>
                                            </form>  
                                             {{-- Button hapus komentar --}}
                                            <form action="{{route('hapus.komen', $komentar->id)}}" method="POST" style="margin-top: auto; width: 50px">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                            </form>                                                
                                        </div>                                        
                                    @else
                                        {{-- Button report--}}
                                        @if ($komentar->user->role != 'admin' && !$komentar->lapor)                                                                                    
                                            <form action="{{route('lapor.komen', $komentar->id)}}" method="POST" style="width: 50px; display:inline-block">
                                                @csrf
                                                <button class="btn btn-warning btn-sm">Lapor komen</button>
                                            </form>
                                        @elseif($komentar->lapor)
                                            <span class="badge bg-warning text-dark">Sudah Dilaporkan</span>
                                        @endif
                                    @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.querySelector(`.comment-text-${id}`).style.display = 'none';
                this.style.display = 'none';
                document.querySelector(`.edit-form-${id}`).style.display = 'block';
            });
        });

        document.querySelectorAll('.btn-cancel').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.querySelector(`.comment-text-${id}`).style.display = 'block';
                document.querySelector(`.btn-edit[data-id="${id}"]`).style.display = 'inline-block';
                document.querySelector(`.edit-form-${id}`).style.display = 'none';
            });
        });
    </script>
</body>

</html>
