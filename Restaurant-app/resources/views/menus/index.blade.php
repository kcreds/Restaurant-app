<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="bg-emerald-900 px-3">
            <h1 class="font-bold text-5xl mb-2 text-rose-300">Menu</h1>
            <hr class="mb-10 py-1 bg-rose-300 h-1">
            </div>
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach ($menus as $menu)
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg shadow-emerald-900">
                    <img class="w-full h-48" src="{{ Storage::url($menu->image) }}" alt="Image" />
                    <div class="px-6 py-4">
                        <h4 class="mb-3 text-xl font-semibold tracking-tight dark:text-rose-300 uppercase">
                            {{ $menu->name }}</h4>
                        <p class="leading-normal text-gray-700">{{ $menu->description }}.</p>
                    </div>
                    <div class="flex items-center justify-between p-4">
                        <span class="text-xl dark:text-rose-300">${{ $menu->price }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>