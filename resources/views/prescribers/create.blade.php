<x-layouts.app title="Prescriptions">
    <h1 class="text-[24px]">Create a New Prescription</h1>

    <hr>
    <br>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">

            <form action="{{ route('prescribers.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Prescriber Name</label>
                    <input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full" value="{{ old('name') }}">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="dosage" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" class="mt-1 p-2 border rounded-md w-full" value="{{ old('dosage') }}">
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="organization" class="block text-sm font-medium text-gray-700">Organization</label>
                    <input type="number" name="organization" id="organization" class="mt-1 p-2 border rounded-md w-full" value="{{ old('organization') }}">
                    @error('per_day') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save Prescriber
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-layouts.app>
