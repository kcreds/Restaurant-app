<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="m-2 p-2 bg-slate-100 rounded">


                <form method="POST" action="{{ route('admin.menus.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">
                            Name</label>
                        <input name="name" type="name" id="name"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700"
                            placeholder="" value="{{ old('name') }}" required>

                        @error('name')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description"
                            class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">Description</label>
                        <textarea id="description" name="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-indigo-700 focus:border-indigo-700 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700"
                            placeholder="">{{ old('description') }}</textarea>

                        @error('description')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-m font-medium text-gray-900 dark:text-dark"
                            for="image">Image</label>
                        <input
                            class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-white dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="image" name="image" id="image" type="file">

                        @error('image')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="categories"
                            class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">Categories</label>
                        <select name="categories[]" id="categories" size="5"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700"
                            multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        @error('categories')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="price" min="0.00" max="10000.00"
                            class="block mb-2 text-m font-medium text-gray-900 dark:text-dark">
                            Price</label>
                        <input type="number" name="price" id="price"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-indigo-700 dark:focus:border-indigo-700"
                            placeholder="" required>

                        @error('price')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-end m-2 p-2">
                        <button type="submit"
                            class="text-white mt-5 px-4 py-2 mr-2  bg-indigo-500 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-m w-full sm:w-auto text-center dark:bg-indigo-500 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700">Save</button>

                        <a href="{{ route('admin.categories.index') }}"
                            class="text-white mt-5 px-4 py-2  bg-indigo-500 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-m w-full sm:w-auto text-center dark:bg-indigo-500 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-admin-layout>
