@extends('layouts.app')

@section('title', 'Tambah User')
@section('page', 'Tambah User')

@section('content')
<div x-data="userForm()" class="space-y-6 min-h-[80vh] pb-24 relative">

    <h2 class="font-semibold text-lg mb-4 border-b pb-2">Tambah User</h2>

    <!-- Form -->
    <form id="createUserForm" class="flex flex-col h-full" @submit.prevent="submitForm">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-grow">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" x-model="form.username" placeholder="Username" required
                       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-[#DB7E2A] focus:ring-[#DB7E2A]">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" x-model="form.email" placeholder="Email" required
                       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-[#DB7E2A] focus:ring-[#DB7E2A]">
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" x-model="form.name" placeholder="Name" required
                       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-[#DB7E2A] focus:ring-[#DB7E2A]">
            </div>

            <div>
                <label class="block text-sm mb-1">Role</label>
                <select x-model="form.role" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#DB7E2A]" required>
                    <option value="" disabled selected>Pilih Role</option>
                    <option value="Karyawan">Karyawan</option>
                    <option value="PIC">PIC</option>
                    <option value="HRD">HRD</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" x-model="form.password" placeholder="Password" required
                       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-[#DB7E2A] focus:ring-[#DB7E2A]">
            </div>
        </div>

        <!-- Garis horizontal -->
        <hr class="border-gray-300 mt-8">

        <!-- Tombol -->
        <div class="relative w-full mt-4">
            <div class="absolute right-0 flex space-x-2">
                <a href="{{ route('users.index') }}" 
                   class="px-4 py-2 border rounded text-[#DB7E2A] border-[#DB7E2A] hover:bg-orange-50">Batal</a>
                <button type="button" @click="openConfirm = true"
                        class="px-4 py-2 rounded bg-[#DB7E2A] text-white hover:bg-[#B5692B]">
                    Simpan
                </button>
            </div>
        </div>
    </form>

    <!-- Modal Konfirmasi -->
    <div x-show="openConfirm" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" x-transition>
        <div class="bg-white p-6 rounded-2xl w-[400px] shadow-lg">
            <div class="flex flex-col items-center space-y-4">
                <img src="{{ asset('images/LogoDashboard/ask-validation.svg') }}" alt="Confirm" class="w-80 h-60">
                <p class="text-center font-semibold">Apakah Anda yakin ingin menambahkan data User?</p>
                <div class="flex justify-center gap-4 mt-4">
                    <button type="button" @click="openConfirm = false" class="px-4 py-2 border border-[#DB7E2A] text-[#DB7E2A] rounded hover:bg-orange-50">
                        Batal
                    </button>
                    <button type="button" @click="submitForm" class="px-4 py-2 bg-[#DB7E2A] text-white rounded hover:bg-[#B5692B]">
                        Ya, Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sukses -->
    <div x-show="openSuccess" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" x-transition>
        <div class="bg-white p-6 rounded-2xl w-[400px] shadow-lg text-center">
            <img src="{{ asset('images/LogoDashboard/Succes.svg') }}" alt="Success" class="w-40 h-40 mx-auto">
            <p class="font-semibold mt-4">User berhasil ditambahkan</p>
            <button @click="openSuccess = false; resetForm()" class="mt-4 px-4 py-2 bg-[#DB7E2A] text-white rounded hover:bg-[#B5692B]">
                Tutup
            </button>
        </div>
    </div>

</div>

<script>
function userForm() {
    return {
        openConfirm: false,
        openSuccess: false,
        form: {
            username: '',
            name: '',
            email: '',
            role: '',
            password: '',
        },
        submitForm() {
            // Kirim data via fetch/AJAX
            fetch('{{ route("users.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(this.form)
            })
            .then(res => res.json())
            .then(res => {
                if(res.success){
                    this.openConfirm = false;
                    this.openSuccess = true;
                }
            })
            .catch(err => console.log(err));
        },
        resetForm() {
            this.form.username = '';
            this.form.name = '';
            this.form.email = '';
            this.form.role = '';
            this.form.password = '';
        }
    }
}
</script>
@endsection
