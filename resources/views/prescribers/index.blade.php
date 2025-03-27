<x-layouts.app title="Prescribers">
    <h1 class="text-[24px]">Prescribers</h1>
    <form action="/prescribers/create" method="get">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Add a Prescriber
    </button>
    </form>
    <hr>
    <br>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-6">

        @if($prescribers)
            @foreach($prescribers as $prescriber)
                    <form class="space-y-6 p-4 rounded shadow-lg rounded-lg border border-gray-300"
                          action="{{ isset($prescriber) ? route('prescribers.update', $prescriber->id) : route('prescribers.store') }}"
                          method="POST">
                        @csrf

                        @if(isset($prescriber))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Prescriber Name</label>
                            <input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full"
                                   value="{{ old('name') ?? (isset($prescriber) ? $prescriber->name : '') }}">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="dosage" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone" class="mt-1 p-2 border rounded-md w-full"
                                   value="{{ old('phone') ?? (isset($prescriber) ? $prescriber->phone : '') }}">
                            @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="organization" class="block text-sm font-medium text-gray-700">Organization</label>
                            <input type="text" name="organization" id="organization" class="mt-1 p-2 border rounded-md w-full"
                                   value="{{ old('organization') ?? (isset($prescriber) ? $prescriber->organization : '') }}">
                            @error('organization') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ isset($prescriber) ? 'Update' : 'Save' }}
                            </button>

                            @if(isset($prescriber))
                                <button type="submit" class="bg-red-400 hover:bg-red-600 text-white py-2 px-4 rounded"
                                        name="_action" value="delete"
                                        onclick="return confirm('Are you sure you want to delete this prescriber?')">
                                    X
                                </button>
                            @endif
                        </div>
                    </form>
            @endforeach
        @endif


        </div>
    </div>
</x-layouts.app>
