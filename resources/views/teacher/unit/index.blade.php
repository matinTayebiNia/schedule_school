<x-teacher-layout>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-center text-sm font-light">
                        <thead
                            class="border-b bg-neutral-50 font-medium">
                        <tr>
                            <th scope="col" class=" px-6 py-4">زمان</th>
                            @foreach($weekdays as $key=>$day)
                                <th scope="col" class=" px-6 py-4">{{$day}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($calendarData as $time => $days)
                        <tr class="border-b">
                            <td class="whitespace-nowrap  px-6 py-4 font-medium">{{$time}}</td>
                            @foreach($days as $value)
                                @if (is_array($value))
                                    <td rowspan="{{ $value['rowspan'] }}" class="align-middle text-xl bg-gray-100 border-2 border-gray-300 p-3  text-center" >
                                        <a href="{{route("teacher.units.show",$value["unit_id"])}}">
                                            {{ $value['class_name'] }}<br>
                                            معلم: {{ $value['teacher_name'] }}<br>
                                            درس: {{$value["lessen_name"]}}
                                        </a>
                                    </td>
                                @elseif ($value === 1)
                                    <td class="align-middle text-center"> - </td>
                                @endif
                            @endforeach
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>
