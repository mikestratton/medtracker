<x-layouts.app title="Medication History">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-6">

            @foreach($events as $event)
                <form class="space-y-6 p-4 rounded shadow-lg rounded-lg border border-gray-300 <?php echo ($event->has_taken_medication == 1) ? 'bg-green-400/20' : 'bg-red-400/20'; ?>" action="{{ route('events.update', $event->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="user_id" value="{{ $event->user_id }}">
                    <input type="hidden" name="form_id" value="history_form">

                    <div class="form-group">
                        <label for="has_taken_medication">Has Taken Medication:</label>
                        <select class="<?php echo ($event->has_taken_medication == 1) ? 'bg-green-400/20' : 'bg-red-400/20'; ?>" name="has_taken_medication" id="has_taken_medication" class="form-control px-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="1" {{ $event->has_taken_medication == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ $event->has_taken_medication == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') ?? $event->date }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="time">Time:</label>
                        <input type="time" name="time" id="time" class="form-control" value="{{ old('time') ?? $event->time }}">
                    </div>

                    <div class="form-group">
                        <label for="note">Note:</label><br>
                        <textarea name="note" id="note" class="form-control block w-full rounded-md border-gray-300 shadow-sm
                         focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3 resize-none bg-amber-200">{{ old('note', $event->note) }}</textarea>
                    </div>

                    <button type="submit" name="_action" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                </form>

{{--                <p class="p-2 <?php echo ($event->has_taken_medication == 1) ? 'bg-green-400/20' : 'bg-red-400/20'; ?> ">Date: {{ $event->date }}, Time: {{ $event->time }}, <br>--}}
{{--                    Medication Taken? {{ $event->has_taken_medication == 1 ? 'Yes' : 'No' }}--}}
{{--                    <br>--}}
{{--                    Note: {{ $event->note }}--}}
{{--                </p>--}}
            @endforeach
{{--                    @endfor--}}



{{--            @foreach($events as $event)--}}
{{--                <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">--}}
{{--                    <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />--}}

{{--                <p class="mx-10 my-4">Date: {{ $event->date }}<br>--}}
{{--                    Time: {{ \Carbon\Carbon::parse($event->time)->format('g:i A') }} <br>--}}
{{--                    Note: {{ $event->note }} <br>--}}
{{--                    Taken: {{ $event->has_taken_medication == 0 ? 'False' : 'True' }}--}}
{{--                </p>--}}
{{--                </div>--}}
{{--            @endforeach--}}

            {{--<div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>--}}
{{--        </div>--}}
{{--        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />--}}


        </div>
    </div>
</x-layouts.app>
