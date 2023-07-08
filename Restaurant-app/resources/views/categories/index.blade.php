<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="bg-emerald-900 px-3">
        <h1 class="font-bold text-5xl mb-2 text-rose-300">Categories</h1>
        <hr class="mb-10 py-1 bg-rose-300 h-1">
        </div>
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category->id) }}">
                    <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg shadow-emerald-900">
                        <img class="w-full h-48" src="{{ Storage::url($category->image) }}" alt="Image" />
                        <div class="px-6 py-4">
                            <h4
                                class="mb-3 text-2xl font-semibold tracking-tight text-transparent bg-clip-text dark:text-rose-300 uppercase">
                                {{ $category->name }}</h4>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
</x-guest-layout>
