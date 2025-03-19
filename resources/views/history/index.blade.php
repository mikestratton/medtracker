<x-layouts.app title="Medication History">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">


            @php $i = 1; @endphp
                    @foreach($events as $event)
                        <p>Date: {{ $event->date }}, Time: {{ $event->time }}, <br>
                            Medication Taken? {{ $event->has_taken_medication == 1 ? 'Yes' : 'No' }}
                            <br>
                            Note: {{ $event->note }}
                        </p>
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
