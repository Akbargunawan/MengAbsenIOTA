@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Title --}}
    <h2 class="text-lg font-semibold mb-4">List User</h2>

    {{-- Flash Message --}}
    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md flex items-center gap-2">
        <img src="{{ asset('images/LogoDashboard/Succes.svg') }}" alt="Success" class="w-8 h-8">
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Search & Actions --}}
    <div class="flex justify-between mb-4">
        <div class="flex gap-2">
            <input type="text" placeholder="Cari..." 
                   class="border border-gray-300 rounded-md px-3 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-orange-400">
            <button class="bg-[#DB7E2A] text-white px-4 py-2 rounded-md hover:bg-[#B5692B]">Cari</button>
            <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">Reset</button>
        </div>
        <a href="{{ route('users.create') }}" 
           class="flex items-center gap-1 border border-[#DB7E2A] text-[#DB7E2A] px-3 py-2 rounded-md hover:bg-[#DB7E2A] hover:text-white">
            + Tambah User
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead>
                <tr class="bg-[#DB7E2A] text-white">
                    <th class="px-4 py-2 border border-gray-200">No</th>
                    <th class="px-4 py-2 border border-gray-200">Username</th>
                    <th class="px-4 py-2 border border-gray-200">Name</th>
                    <th class="px-4 py-2 border border-gray-200">Email</th>
                    <th class="px-4 py-2 border border-gray-200">Role</th>
                    <th class="px-4 py-2 border border-gray-200">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                <tr class="{{ $index % 2 == 1 ? 'bg-gray-100' : 'bg-white' }}">
                    <td class="px-4 py-2 border border-gray-200">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border border-gray-200">{{ $user->username }}</td>
                    <td class="px-4 py-2 border border-gray-200">{{ $user->name }}</td>
                    <td class="px-4 py-2 border border-gray-200">{{ $user->email }}</td>
                    <td class="px-4 py-2 border border-gray-200">{{ $user->role }}</td>
                    <td class="px-4 py-2 border border-gray-200 flex gap-2 justify-center">
                        <a href="{{ route('users.edit', $user->id) }}">
                            <img src="{{ asset('images/LogoDashboard/edit.svg') }}" alt="Edit" class="w-5 h-5">
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <img src="{{ asset('images/LogoDashboard/delete.svg') }}" alt="Delete" class="w-5 h-5">
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @for($i = count($users); $i < 10; $i++)
                <tr class="{{ $i % 2 == 1 ? 'bg-gray-100' : 'bg-white' }}">
                    <td colspan="6" class="px-4 py-6 border border-gray-200"></td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-between items-center mt-4">
        <div>
            <label for="pageSize">Page Size</label>
            <select id="pageSize" class="border border-gray-300 rounded-md ml-2 px-2 py-1">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
        </div>

        <div class="flex items-center gap-2">
            <button class="flex items-center justify-center w-8 h-8 border border-gray-300 rounded-full text-gray-500 hover:bg-gray-200">«</button>
            <button class="flex items-center justify-center w-8 h-8 border border-gray-300 rounded-full text-gray-500 hover:bg-gray-200">‹</button>
            <button class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 text-gray-800 font-semibold">1</button>
            <button class="flex items-center justify-center w-8 h-8 border border-gray-300 rounded-full hover:bg-gray-200">2</button>
            <button class="flex items-center justify-center w-8 h-8 border border-gray-300 rounded-full hover:bg-gray-200">3</button>
            <button class="flex items-center justify-center w-8 h-8 border border-gray-300 rounded-full text-gray-500 hover:bg-gray-200">›</button>
            <button class="flex items-center justify-center w-8 h-8 border border-gray-300 rounded-full text-gray-500 hover:bg-gray-200">»</button>
        </div>
    </div>
</div>
@endsection
