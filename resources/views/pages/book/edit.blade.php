<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Halaman Edit Buku
                </h2>
                <div class="text-sm text-gray-500">Halaman untuk mengedit Data Buku</div>
            </div>
            <div>
                <a href="{{ route('book.index') }}"
                    class="bg-blue-950 text-white rounded-md py-2 px-4 text-sm">Kembali</a>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        @if ($errors->any())
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Terjadi Kesalahan!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('book.update', $book->id) }}" method="POST" class="max-w-sm mx-auto">
                        @csrf
                        @method('PUT')
                        <div class="mb-5">
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                            <select class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="code"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code</label>
                            <input type="text" name="code" value="{{ $book->bookCode->code }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Masukkan Code" required />
                        </div>

                        <div class="mb-5">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="title" value="{{ $book->title }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Masukkan Title" required />
                        </div>

                        <div class="mb-5">
                            <label for="book_shelf_id" class="block mb-2 text-sm font-medium text-gray-900">Rak Buku</label>
                            <select class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="book_shelf_id" name="book_shelf_id" required>
                                <option value="">Pilih Rak Buku</option>
                                @foreach($bookshelfs as $shelf)
                                    <option value="{{ $shelf->id }}" {{ old('book_shelf_id') == $shelf->id ? 'selected' : '' }}>
                                        {{ $shelf->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('book_shelf_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input type="text" name="description" value="{{ $book->description }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Masukkan Description" required />
                        </div>

                        <div class="mb-5">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                            <input type="text" name="year" value="{{ $book->year }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Masukkan Tahun" required />
                        </div>

                        <div class="mb-5">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publisher</label>
                            <input type="text" name="publisher" value="{{ $book->publisher }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Masukkan publisher" required />
                        </div>

                        <button type="submit"
                            class="mt-4 text-white bg-blue-950 font-medium rounded-lg text-sm w-full  px-5 py-2.5 text-center ">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
