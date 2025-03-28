<x-layouts.app title="Prescriptions">
    <h1 class="text-[24px]">Prescriptions</h1>
    <form action="/prescriptions/create" method="get">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Add a Prescription
{{--        <a href="/prescriptions/create">Add Prescription</a>--}}
    </button>
    </form>
    <hr>
    <br>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-6">

        @php $x=1; @endphp
        @if($prescriptions)
            @foreach($prescriptions as $prescription)
                    <form class="space-y-6 p-4 rounded shadow-lg rounded-lg border border-gray-300"
                          action="{{ isset($prescription) ? route('prescriptions.update', $prescription) : route('prescriptions.store') }}"
                          method="POST">
                        @csrf
                        @if(isset($prescription))
                            @method('PATCH')
                        @endif

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Medication Name</label>
                            <input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full"
                                   value="{{ old('name') ?? (isset($prescription) ? $prescription->name : '') }}">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="dosage" class="block text-sm font-medium text-gray-700">Dosage</label>
                            <input type="text" name="dosage" id="dosage" class="mt-1 p-2 border rounded-md w-full"
                                   value="{{ old('dosage') ?? (isset($prescription) ? $prescription->dosage : '') }}">
                            @error('dosage') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="per_day" class="block text-sm font-medium text-gray-700">Times Per Day</label>
                            <input type="number" name="per_day" id="per_day" class="mt-1 p-2 border rounded-md w-full"
                                   value="{{ old('per_day') ?? (isset($prescription) ? $prescription->per_day : '') }}">
                            @error('per_day') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="prescriber_id" class="block text-sm font-medium text-gray-700">Prescriber</label>
                            <select name="prescriber_id" id="prescriber_id" class="mt-1 p-2 border rounded-md w-full">
                                <option value="">Select a Prescriber</option>
                                @foreach($prescribers as $prescriber)
                                    <option value="{{ $prescriber->id }}"
                                        {{ old('prescriber_id') == $prescriber->id || (isset($prescription) && $prescription->prescriber_id == $prescriber->id) ? 'selected' : '' }}>
                                        {{ $prescriber->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('prescriber_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="time_of_day" class="block text-sm font-medium text-gray-700">Time of Day(Morning, Afternoon or Evening)</label>
                            <input type="text" name="time_of_day" id="time_of_day" class="mt-1 p-2 border rounded-md w-full"
                                   value="{{ old('time_of_day') ?? (isset($prescription) ? $prescription->time_of_day : '') }}">
                            @error('time_of_day') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ isset($prescription) ? 'Update' : 'Save' }}
                            </button>

                            @if(isset($prescription))
                                <button type="submit" class="bg-red-400 hover:bg-red-600 text-white py-2 px-4 rounded"
                                        name="_action" value="delete"
                                        onclick="return confirm('Are you sure you want to delete this prescription?')">
                                    X
                                </button>
                            @endif
                        </div>
                    </form>
{{--                    <form class="space-y-6 p-4 rounded shadow-lg rounded-lg border border-gray-300" action="{{ route('prescriptions.update', $prescription) }}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('PATCH')--}}

{{--                        <div class="mb-4">--}}
{{--                            <label for="name" class="block text-sm font-medium text-gray-700">Medication Name</label>--}}
{{--                            <input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full" value="{{ old('name') ?? $prescription->name }}">--}}
{{--                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror--}}
{{--                        </div>--}}

{{--                        <div class="mb-4">--}}
{{--                            <label for="dosage" class="block text-sm font-medium text-gray-700">Dosage</label>--}}
{{--                            <input type="text" name="dosage" id="dosage" class="mt-1 p-2 border rounded-md w-full" value="{{ old('dosage') ?? $prescription->dosage }}">--}}
{{--                            @error('dosage') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror--}}
{{--                        </div>--}}

{{--                        <div class="mb-4">--}}
{{--                            <label for="per_day" class="block text-sm font-medium text-gray-700">Times Per Day</label>--}}
{{--                            <input type="number" name="per_day" id="per_day" class="mt-1 p-2 border rounded-md w-full" value="{{ old('per_day') ?? $prescription->per_day }}">--}}
{{--                            @error('per_day') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror--}}
{{--                        </div>--}}

{{--                        <div class="mb-4">--}}
{{--                            <label for="prescriber" class="block text-sm font-medium text-gray-700">Prescriber</label>--}}
{{--                            <input type="text" name="prescriber" id="prescriber" class="mt-1 p-2 border rounded-md w-full" value="{{ old('prescriber') ?? $prescription->prescriber }}">--}}
{{--                            @error('prescriber') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror--}}
{{--                        </div>--}}

{{--                        <div class="mb-4">--}}
{{--                            <label for="time_of_day" class="block text-sm font-medium text-gray-700">Time of Day(Morning, Afternoon or Evening)</label>--}}
{{--                            <input type="text" name="time_of_day" id="time_of_day" class="mt-1 p-2 border rounded-md w-full" value="{{ old('time_of_day') ?? $prescription->time_of_day }}">--}}
{{--                            @error('time_of_day') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror--}}
{{--                        </div>--}}

{{--                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>--}}
{{--                    </form>--}}
{{--                <form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST" class="inline" >--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}

{{--                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white  py-1 px-2 rounded"--}}
{{--                                onclick="return confirm('Are you sure you want to delete this prospect?')">--}}
{{--                            x--}}
{{--                        </button>--}}


{{--                </form>--}}

                @php $x++ @endphp
            @endforeach
        @endif


        </div>
    </div>
</x-layouts.app>
