<div class="flex flex-col px-8 mx-auto my-6 max-w-7xl xl:px-5 py-12">
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
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-56 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                        @foreach ($specialties as $specialty)
                            <li>
                                <div class="flex items-center ml-6">
                                    <input id="{{ $specialty->id }}" type="checkbox"
                                        wire:change.debounce.200ms="set_filter_specialty('{{ $specialty->id }}')"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
        <div class="ml-2 relative pt-4">
            <a href="{{ route('wave.templates.create') }}"
                class="w-40 h-12 mt-6 px-4 py-2 bg-indigo-600 rounded-md shadow border border-gray-300 justify-center items-center inline-flex">
                <div class="text-white text-sm font-medium leading-tight flex gap-1 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create New
                </div>
            </a>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400"
                style="background: #E6E9F3">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        VISIT TYPE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        DATE CREATED
                    </th>
                    <th scope="col" class="px-6 py-3">
                        LAST USED
                    </th>
                    <th scope="col" class="px-6 py-3">
                        STATUS
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($templates as $key => $template)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            {{ $template->visit_type }}
                        </td>
                        <td class="px-6 py-4">
                            #{{ $template->id }}
                        </td>
                        <td class="px-6 py-4">
                            {{ date_format(date_create($template->created_at), 'm/d/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $template->last_used ? date_format(date_create($template->last_used), 'm/d/Y') : '' }}
                        </td>
                        <td class="px-6 py-4">
                            <?php $i = $template->status == 'published' ? 'green' : 'gray'; ?>
                            <span
                                class="bg-{{ $i }}-100 text-{{ $i }}-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                {{ strtoupper(formatString($template->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex gap-4">
                            <a href="{{ route('wave.templates.edit', $template->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3.25023 10.26L5.72023 12.73L12.4102 6.03999L9.95023 3.55999L3.25023 10.26ZM0.990234 14.99L4.85023 13.6L2.39023 11.16L0.990234 14.99ZM13.2402 0.98999C12.7602 0.98999 12.3202 1.18999 12.0002 1.49999L10.5602 2.93999L13.0302 5.40999L14.4702 3.96999C14.7902 3.64999 14.9802 3.21999 14.9802 2.72999C14.9902 1.77999 14.2102 0.98999 13.2402 0.98999Z"
                                        fill="#8F95B2" />
                                </svg>
                            </a>
                            <div class="cursor-pointer" onclick="openDeleteNoteTemplate({{ $template->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M14.1082 4.69647H1.87293C1.6094 4.69647 1.40234 4.90353 1.40234 5.16706C1.40234 5.43059 1.6094 5.63765 1.87293 5.63765H2.34352V15.0494C2.34352 15.5671 2.76705 15.9906 3.2847 15.9906H12.6965C13.2141 15.9906 13.6376 15.5671 13.6376 15.0494V5.63765H14.1082C14.3718 5.63765 14.5788 5.43059 14.5788 5.16706C14.5788 4.90353 14.3718 4.69647 14.1082 4.69647ZM6.10823 13.1671C6.10823 13.6847 5.6847 14.1082 5.16705 14.1082C4.6494 14.1082 4.22587 13.6847 4.22587 13.1671V7.52C4.22587 7.00235 4.6494 6.57882 5.16705 6.57882C5.6847 6.57882 6.10823 7.00235 6.10823 7.52V13.1671ZM8.93176 13.1671C8.93176 13.6847 8.50823 14.1082 7.99058 14.1082C7.47293 14.1082 7.0494 13.6847 7.0494 13.1671V7.52C7.0494 7.00235 7.47293 6.57882 7.99058 6.57882C8.50823 6.57882 8.93176 7.00235 8.93176 7.52V13.1671ZM11.7553 13.1671C11.7553 13.6847 11.3318 14.1082 10.8141 14.1082C10.2965 14.1082 9.87293 13.6847 9.87293 13.1671V7.52C9.87293 7.00235 10.2965 6.57882 10.8141 6.57882C11.3318 6.57882 11.7553 7.00235 11.7553 7.52V13.1671ZM13.6376 1.87294H9.87293C9.87293 1.35529 9.4494 0.931763 8.93176 0.931763H7.0494C6.53176 0.931763 6.10823 1.35529 6.10823 1.87294H2.34352C1.82587 1.87294 1.40234 2.29647 1.40234 2.81412V3.75529H14.5788V2.81412C14.5788 2.29647 14.1553 1.87294 13.6376 1.87294Z"
                                        fill="#8F95B2" />
                                </svg>
                            </div>
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
