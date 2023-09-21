@extends('theme::layouts.guest')


@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg m-auto">

        <div class="text-gray-900 text-3xl font-bold leading-9 py-6">Visits</div>

        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase" style="background: #E6E9F3">
                <tr>
                    @if ($show_visit_id)
                        <th scope="col" class="px-2 py-3">
                            ID
                        </th>
                    @endif
                    @if ($show_last_name)
                        <th scope="col" class="px-2 py-3">
                            LAST NAME
                        </th>
                    @endif
                    @if ($show_first_name)
                        <th scope="col" class="px-2 py-3">
                            FIRST NAME
                        </th>
                    @endif
                    @if ($show_visit_at)
                        <th scope="col" class="px-2 py-3">
                            DATE OF VISIT
                        </th>
                    @endif
                    @if ($show_visit_type)
                        <th scope="col" class="px-2 py-3">
                            VISIT TYPE
                        </th>
                    @endif
                    @if ($show_status)
                        <th scope="col" class="px-2 py-3">
                            STATUS
                        </th>
                    @endif
                    @if ($show_ready)
                        <th scope="col" class="px-2 py-3">
                            READY
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($visits as $key => $visit)
                    <tr
                        class="bg-white border-b hover:bg-gray-50">
                        @if ($show_visit_id)
                            <td class="px-2 py-4">
                                #{{ $visit->id }}
                            </td>
                        @endif
                        @if ($show_last_name)
                            <td class="px-2 py-4">
                                {{ $visit->last_name }}
                            </td>
                        @endif
                        @if ($show_first_name)
                            <td class="px-2 py-4">
                                {{ $visit->first_name }}
                            </td>
                        @endif
                        @if ($show_visit_at)
                            <td class="px-2 py-4">
                                {{ date_format(date_create($visit->visit_at), 'm/d/Y') }}
                            </td>
                        @endif
                        @if ($show_visit_type)
                            <td class="px-2 py-4">
                                {{ $visit->visit_type }}
                            </td>
                        @endif
                        @if ($show_status)
                            <td class="px-2 py-4">
                                <?php $i = $visit->status == 'complete' ? 'green' : ($visit->status == 'processing' ? 'blue' : ($visit->status == 'not_started' ? 'red' : 'gray')); ?>
                                <span
                                    class="bg-{{ $i }}-100 text-{{ $i }}-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                    {{ strtoupper(formatString($visit->status)) }}
                                </span>
                            </td>
                        @endif
                        @if ($show_ready)
                            <td class="px-2 py-4">
                                <div class="flex items-center">
                                    <input id="checkbox-table-search-1" type="checkbox" {{ $visit->ready ? 'checked' : '' }}
                                        disabled
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
