<x-layouts.app title="Prescriptions">
    <h1 class="text-[24px]">Create a New Prescription</h1>

    <hr>
    <br>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">

            <form action="{{ route('prescriptions.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Medication Name</label>
                    <input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full" value="{{ old('name') }}">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="dosage" class="block text-sm font-medium text-gray-700">Dosage</label>
                    <input type="text" name="dosage" id="dosage" class="mt-1 p-2 border rounded-md w-full" value="{{ old('dosage') }}">
                    @error('dosage') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="per_day" class="block text-sm font-medium text-gray-700">Times Per Day</label>
                    <input type="number" name="per_day" id="per_day" class="mt-1 p-2 border rounded-md w-full" value="{{ old('per_day') }}">
                    @error('per_day') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="prescriber" class="block text-sm font-medium text-gray-700">Prescriber</label>
                    <input type="text" name="prescriber" id="prescriber" class="mt-1 p-2 border rounded-md w-full" value="{{ old('prescriber') }}">
                    @error('prescriber') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="time_of_day" class="block text-sm font-medium text-gray-700">Time of Day(Morning, Afternoon or Evening)</label>
                    <input type="text" name="time_of_day" id="time_of_day" class="mt-1 p-2 border rounded-md w-full" value="{{ old('time_of_day') }}">
                    @error('time_of_day') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save Medication
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-layouts.app>
