<x-layouts.app title="Prescriptions">
    <h1 class="text-[24px]">Prescriptions</h1>
    <form action="/prescriptions/create" method="get">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    Add Prescription
{{--        <a href="/prescriptions/create">Add Prescription</a>--}}
    </button>
    </form>
    <hr>
    <br>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">

        @if($prescriptions)
            @foreach($prescriptions as $prescription)
            <form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST" class="inline" >
                @csrf
                @method('DELETE')
                <p>ID: {{$prescription->id }}<br>Name: {{ $prescription->name }} <br>Dosage: {{ $prescription->dosage }}<br>Times per day: {{ $prescription->per_day }} <br>
                    Time of day: {{ $prescription->time_of_day }}<br> Prescriber: {{ $prescription->prescriber }} <br><br>


                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white  py-1 px-2 rounded"
                            onclick="return confirm('Are you sure you want to delete this prospect?')">
                        x
                    </button>

                </p>
            </form>


            @endforeach
        @endif


        </div>
    </div>
</x-layouts.app>
