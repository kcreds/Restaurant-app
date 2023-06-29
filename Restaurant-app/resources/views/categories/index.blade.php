<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <h1 class="font-bold text-5xl mb-2 text-green-400">Categories</h1>
        <hr class="mb-10 bg-gradient-to-r from-green-400 to-blue-500 h-1">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category->id) }}">
                    <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                        <img class="w-full h-48" src="{{ Storage::url($category->image) }}" alt="Image" />
                        <div class="px-6 py-4">
                            <h4
                                class="mb-3 text-xl font-semibold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400 uppercase">
                                {{ $category->name }}</h4>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
</x-guest-layout>
