<div class="flex flex-col px-8 mx-auto my-6 max-w-7xl xl:px-5">
    <div class="flex justify-end py-6 flex-wrap">
        <div class="mx-2 relative pt-4">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">
                Search for Note
            </label>
            <input type="text" id="first_name" name="first_name" required placeholder="Search by visit type" wire:ignore
                wire:keydown.debounce.200ms="search($event.target.value)"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-72 p-2.5">
        </div>
        <div class="mx-2 relative pt-4">
            <label for="visit_type" class="block mb-2 text-sm font-medium text-gray-900">Filter By Specialty</label>
            <div class="relative">
                <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-52 py-2.5 px-4 inline-flex items-center justify-between"
                    type="button">
                    Filter by Specialties
                    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownHover" wire:ignore
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-56">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownHoverButton">
                        @foreach ($specialties as $specialty)
                            <li>
                                <div class="flex items-center ml-6">
                                    <input id="{{ $specialty->id }}" type="checkbox"
                                        wire:change.debounce.200ms="set_filter_specialty('{{ $specialty->id }}')"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="{{ $specialty->id }}" class="ml-2 flex px-4 py-2">
                                        <span class="text-xs font-medium mr-2 px-2.5 py-0.5 rounded select-none"
                                            style="color: {{ $specialty->color }}; background: {{ $specialty->bg_color }}">
                                            {{ $specialty->name }}
                                        </span>
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase"
                style="background: #E6E9F3">
                <tr>
                    <th scope="col" class="px-6 py-3 w-4/12" style="min-width: 250px;">
                        VISIT TYPE
                    </th>
                    <th scope="col" class="px-2 py-3 w-1/12" style="min-width: 40px;">
                        ID
                    </th>
                    <th scope="col" class="px-2 py-3 w-1.5/12" style="min-width: 100px;">
                        DATE CREATED
                    </th>
                    <th scope="col" class="px-2 py-3 w-1.5/12" style="min-width: 100px;">
                        LAST USED
                    </th>
                    <th scope="col" class="px-2 py-3 w-1.5/12" style="min-width: 100px;">
                        STATUS
                    </th>
                    <th scope="col" class="px-2 py-3 w-1/12" style="min-width: 40px;">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($templates as $key => $template)
                    <tr
                        class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            {{ $template->visit_type }}
                        </td>
                        <td class="px-2 py-4">
                            #{{ $template->id }}
                        </td>
                        <td class="px-2 py-4">
                            {{ date_format(date_create($template->created_at), 'm/d/Y') }}
                        </td>
                        <td class="px-2 py-4">
                            {{ $template->last_used ? date_format(date_create($template->last_used), 'm/d/Y') : '' }}
                        </td>
                        <td class="px-2 py-4">
                            <?php $i = $template->sample_note ? 'green' : 'red'; ?>
                            <span
                                class="bg-{{ $i }}-100 text-{{ $i }}-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                {{ $template->sample_note ? 'Published' : 'Not Published' }}
                            </span>
                        </td>
                        <td class="px-2 py-4 flex gap-4 justify-center">
                            <a href="{{ route('wave.templates.sample.edit', $template->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3.25023 10.26L5.72023 12.73L12.4102 6.03999L9.95023 3.55999L3.25023 10.26ZM0.990234 14.99L4.85023 13.6L2.39023 11.16L0.990234 14.99ZM13.2402 0.98999C12.7602 0.98999 12.3202 1.18999 12.0002 1.49999L10.5602 2.93999L13.0302 5.40999L14.4702 3.96999C14.7902 3.64999 14.9802 3.21999 14.9802 2.72999C14.9902 1.77999 14.2102 0.98999 13.2402 0.98999Z"
                                        fill="#8F95B2" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row my-10">
        <div class="col-md-12">
            {{ $templates->links('pagination::tailwind') }}
        </div>
    </div>
    <script>
        window.openDeleteNoteTemplate = function(template_id) {
            Alpine.store('deleteNoteTemplateModal').openModal();
            Livewire.emit('deleteNoteTemplate', template_id);
        }
    </script>
</div>
