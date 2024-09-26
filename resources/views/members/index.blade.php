{{-- resources/views/members/index.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Anggota</h1>

        {{-- Tombol untuk menambah anggota baru --}}
        <a href="{{ route('members.create') }}" class="btn btn-primary mb-3">Tambah Anggota</a>

        {{-- Cek apakah ada data members --}}
        @if ($members->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Gambar</th>
                        <th>Action</th> {{-- Tambahan kolom Action --}}
                    </tr>
                </thead>
                <tbody>
                    {{-- Looping data members --}}
                    @foreach ($members as $index => $member)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $member->nama }}</td>
                            <td>{{ $member->nis }}</td>
                            <td>{{ $member->kelas }}</td>
                            <td>
                                <img src="{{ asset('storage/members/' . $member->image) }}" alt="Gambar {{ $member->nama }}" width="100">
                            </td>
                            <td>
                                {{-- Tombol untuk menampilkan detail anggota --}}
                                <a href="{{ route('members.show', $member->id) }}" class="btn btn-info btn-sm">Lihat</a>

                                {{-- Tombol untuk mengedit anggota --}}
                                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                {{-- Tombol untuk menghapus anggota --}}
                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            {{ $members->links() }}
        @else
            {{-- Pesan jika belum ada data --}}
            <div class="alert alert-warning">
                Belum ada data yang tersedia.
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
