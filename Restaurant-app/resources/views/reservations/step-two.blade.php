<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="flex items-center min-h-screen ">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-white rounded-lg shadow-xl shadow-emerald-900">
                <div class="flex flex-col md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img class="object-cover w-full h-full"
                            src="https://cdn.pixabay.com/photo/2016/11/08/06/45/couple-1807617_960_720.jpg" alt="img" />
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h3 class="mb-4 text-2xl font-bold text-rose-300">Make Reservation</h3>

                            <div class="w-full bg-gray-200 rounded-full">
                                <div
                                    class="w-100 p-1 text-xs font-medium leading-none text-center text-rose-300 bg-emerald-900 rounded-full">
                                    Step 2</div>
                            </div>

                            <form method="POST" action="{{ route('reservations.store.step.two') }}">
                                @csrf
                                <div class="sm:col-span-6 pt-5">
                                    <label for="status" class="block text-sm font-medium"> Choose Table</label>
                                    <div class="mt-1">
                                        @if ($tables->isEmpty())
                                            <div class="text-sm text-red-400">Sorry, we don't have table for this
                                                day</div>
                                        @else
                                            <select id="table_id" name="table_id"
                                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                                @foreach ($tables as $table)
                                                    <option value="{{ $table->id }}" @selected($table->id == $reservation->table_id)>
                                                        {{ $table->name }}
                                                        ({{ $table->guest_number }} Guests)
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    @error('table_id')
                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-6 p-4 flex justify-between space-x-3">
                                    <a href="{{ route('reservations.step.one') }}"
                                        class="px-4 py-2 font-bold bg-emerald-900 hover:bg-emerald-700 rounded-lg text-rose-300">Back</a>
                                    <button type="submit"
                                        class="px-4 py-2 font-bold bg-emerald-900 hover:bg-emerald-700 rounded-lg text-rose-300">Make
                                        Reservation</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-guest-layout>
