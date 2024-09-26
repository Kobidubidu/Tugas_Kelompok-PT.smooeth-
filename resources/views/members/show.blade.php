{{-- resources/views/members/show.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Anggota</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Detail Anggota</h1>

        <div class="card">
            <div class="card-header">
                Data Anggota
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        {{-- Menampilkan gambar anggota --}}
                        <img src="{{ asset('storage/members/' . $members->image) }}" alt="Gambar {{ $members->nama }}" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Nama: </strong>{{ $members->nama }}</li>
                            <li class="list-group-item"><strong>NIS: </strong>{{ $members->nis }}</li>
                            <li class="list-group-item"><strong>Kelas: </strong>{{ $members->kelas }}</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-4">
                    {{-- Tombol untuk kembali ke halaman index --}}
                    <a href="{{ route('members.index') }}" class="btn btn-primary">Kembali ke Daftar</a>

                    {{-- Tombol untuk mengedit anggota --}}
                    <a href="{{ route('members.edit', $members->id) }}" class="btn btn-warning">Edit</a>

                    {{-- Tombol untuk menghapus anggota --}}
                    <form action="{{ route('members.destroy', $members->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
