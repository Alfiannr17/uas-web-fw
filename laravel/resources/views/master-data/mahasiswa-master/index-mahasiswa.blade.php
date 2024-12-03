<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="container p-4 mx-auto">
    <div class="flex justify-between items-center mb-4">
        @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-500">
            {{ session('success') }}
        </div>
        @elseif (session('error'))
        <div class="mb-4 rounded-lg bg-red-50 p-4 text-red-500">
            {{ session('error') }}
        </div>
        @endif
        
      <a href="{{ route('mahasiswa-create') }}">
        <button class="px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
          Add Mahasiswa Data
        </button>
      </a>
    </div>
    <div class="flex justify-center">
      <table class="w-full max-w-4xl border border-collapse border-gray-200">
        <thead>
          <tr class="bg-gray-100">
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">ID</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">NPM</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Nama</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Program Studi</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
            <tr class="bg-white hover:bg-gray-50">
              <td class="px-4 py-2 border border-gray-200">{{ $item->id }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $item->npm }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $item->nama }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $item->prodi }}</td>
              <td class="px-4 py-2 border border-gray-200">
                <button class="px-2 text-red-600 hover:text-red-800" onclick="confirmDelete('{{ route('mahasiswa-deleted', $item->id) }} ')">Hapus</button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function confirmDelete(deleteUrl) {
        console.log(deleteUrl);
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        // Membuat form secara dinamis
        let form = document.createElement('form');
        form.method = 'POST';
        form.action = deleteUrl;

        // Tambahkan CSRF token
        let csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        // Tambahkan method spoofing untuk DELETE
        let methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        // Submit form
        document.body.appendChild(form);
        form.submit();
      }
    }
  </script>
</x-app-layout>
