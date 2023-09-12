<div class="flex flex-col px-8 mx-auto my-6 max-w-7xl xl:px-5 py-12">
    <div class="text-gray-900 text-3xl font-bold leading-9">Visits</div>
    <div class="flex justify-between py-4">
        <div class="justify-start items-center gap-6 inline-flex">
            <div class="justify-start items-center gap-1.5 flex">
                <div class="pr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                        fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6 6V5C6 4.20435 6.31607 3.44129 6.87868 2.87868C7.44129 2.31607 8.20435 2 9 2H11C11.7956 2 12.5587 2.31607 13.1213 2.87868C13.6839 3.44129 14 4.20435 14 5V6H16C16.5304 6 17.0391 6.21071 17.4142 6.58579C17.7893 6.96086 18 7.46957 18 8V11.57C15.4396 12.5187 12.7305 13.003 10 13C7.2695 13.003 4.56037 12.5188 2 11.57V8C2 7.46957 2.21071 6.96086 2.58579 6.58579C2.96086 6.21071 3.46957 6 4 6H6ZM8 5C8 4.73478 8.10536 4.48043 8.29289 4.29289C8.48043 4.10536 8.73478 4 9 4H11C11.2652 4 11.5196 4.10536 11.7071 4.29289C11.8946 4.48043 12 4.73478 12 5V6H8V5ZM9 10C9 9.73478 9.10536 9.48043 9.29289 9.29289C9.48043 9.10536 9.73478 9 10 9H10.01C10.2752 9 10.5296 9.10536 10.7171 9.29289C10.9046 9.48043 11.01 9.73478 11.01 10C11.01 10.2652 10.9046 10.5196 10.7171 10.7071C10.5296 10.8946 10.2752 11 10.01 11H10C9.73478 11 9.48043 10.8946 9.29289 10.7071C9.10536 10.5196 9 10.2652 9 10Z"
                            fill="#9CA3AF" />
                        <path
                            d="M2 13.692V16C2 16.5304 2.21071 17.0392 2.58579 17.4142C2.96086 17.7893 3.46957 18 4 18H16C16.5304 18 17.0391 17.7893 17.4142 17.4142C17.7893 17.0392 18 16.5304 18 16V13.692C15.4224 14.5608 12.7201 15.0026 10 15C7.204 15 4.513 14.54 2 13.692Z"
                            fill="#9CA3AF" />
                    </svg>
                </div>
                <div class="text-gray-500 text-sm font-normal leading-tight flex-1">
                    {{ date_format(now(), 'm/d/Y') }}
                </div>
            </div>
            <div class="justify-start items-center gap-1.5 flex">
                <div class="pr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                        fill="none">
                        <path
                            d="M8.433 7.418C8.588 7.315 8.779 7.222 9 7.151V8.849C8.79973 8.78623 8.60896 8.6964 8.433 8.582C8.07 8.34 8 8.114 8 8C8 7.886 8.07 7.66 8.433 7.418ZM11 12.849V11.151C11.22 11.222 11.412 11.315 11.567 11.418C11.931 11.661 12 11.886 12 12C12 12.114 11.93 12.34 11.567 12.582C11.391 12.6964 11.2003 12.7862 11 12.849Z"
                            fill="#9CA3AF" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M10 18C12.1217 18 14.1566 17.1571 15.6569 15.6569C17.1571 14.1566 18 12.1217 18 10C18 7.87827 17.1571 5.84344 15.6569 4.34315C14.1566 2.84285 12.1217 2 10 2C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18ZM11 5C11 4.73478 10.8946 4.48043 10.7071 4.29289C10.5196 4.10536 10.2652 4 10 4C9.73478 4 9.48043 4.10536 9.29289 4.29289C9.10536 4.48043 9 4.73478 9 5V5.092C8.40268 5.19833 7.83276 5.42344 7.324 5.754C6.602 6.234 6 7.009 6 8C6 8.99 6.602 9.765 7.324 10.246C7.804 10.566 8.378 10.791 9 10.908V12.849C8.609 12.722 8.32 12.532 8.157 12.345C8.0724 12.2412 7.96782 12.1554 7.84945 12.0928C7.73107 12.0302 7.60133 11.992 7.46791 11.9804C7.33449 11.9689 7.20012 11.9843 7.07276 12.0257C6.9454 12.0671 6.82765 12.1336 6.72649 12.2214C6.62534 12.3091 6.54284 12.4163 6.48389 12.5365C6.42494 12.6568 6.39075 12.7876 6.38334 12.9214C6.37592 13.0551 6.39544 13.1889 6.44073 13.3149C6.48602 13.441 6.55617 13.5566 6.647 13.655C7.209 14.304 8.06 14.731 9 14.908V15C9 15.2652 9.10536 15.5196 9.29289 15.7071C9.48043 15.8946 9.73478 16 10 16C10.2652 16 10.5196 15.8946 10.7071 15.7071C10.8946 15.5196 11 15.2652 11 15V14.908C11.5973 14.8017 12.1672 14.5766 12.676 14.246C13.398 13.766 14 12.991 14 12C14 11.01 13.398 10.235 12.676 9.754C12.1672 9.42344 11.5973 9.19833 11 9.092V7.151C11.391 7.278 11.68 7.468 11.843 7.655C11.9284 7.75631 12.0331 7.83965 12.1509 7.90016C12.2688 7.96067 12.3975 7.99716 12.5296 8.00749C12.6617 8.01783 12.7945 8.00182 12.9204 7.96038C13.0462 7.91894 13.1626 7.85291 13.2627 7.76612C13.3628 7.67932 13.4447 7.5735 13.5035 7.4548C13.5624 7.33609 13.5971 7.20688 13.6056 7.07465C13.6141 6.94243 13.5962 6.80984 13.553 6.68458C13.5098 6.55932 13.4422 6.44389 13.354 6.345C12.791 5.696 11.941 5.269 11 5.092V5Z"
                            fill="#9CA3AF" />
                    </svg>
                </div>
                <div class="text-gray-500 text-sm font-normal leading-tight flex-1">{{ $visits->total() }} Visits</div>
            </div>
        </div>
        <div class="flex gap-2">
            <div class="relative max-w-xs">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input name="dates" type="text" wire:change="handleChangeSearchDate" id="daterange"
                    class="bg-gray-50 border border-gray-300 shadow text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Select Dates">
            </div>
            <button onclick="openAddVisitModal()"
                class="w-32 h-full px-4 py-2 rounded-md shadow border border-gray-300 justify-center items-center inline-flex">
                <div class="justify-start items-start gap-2 flex">
                    <div class="w-5 h-5 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none">
                            <path
                                d="M13.586 3.58598C13.7705 3.39496 13.9912 3.24259 14.2352 3.13778C14.4792 3.03296 14.7416 2.97779 15.0072 2.97548C15.2728 2.97317 15.5361 3.02377 15.7819 3.12434C16.0277 3.2249 16.251 3.3734 16.4388 3.56119C16.6266 3.74897 16.7751 3.97228 16.8756 4.21807C16.9762 4.46386 17.0268 4.72722 17.0245 4.99278C17.0222 5.25834 16.967 5.52078 16.8622 5.76479C16.7574 6.0088 16.605 6.22949 16.414 6.41398L15.621 7.20698L12.793 4.37898L13.586 3.58598ZM11.379 5.79298L3 14.172V17H5.828L14.208 8.62098L11.378 5.79298H11.379Z"
                                fill="#6B7280" />
                        </svg>
                    </div>
                    <div class="text-gray-700 text-sm font-medium leading-tight">Add Visits</div>
                </div>
            </button>
            <button onclick="openPrintVisitModal({{ count($selected_rows) }})"
                class="w-44 h-full px-4 py-2 rounded-md shadow border border-gray-300 justify-center items-center inline-flex">
                <div class="justify-start items-start gap-2 flex">
                    <div class="w-5 h-5 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.5863 4.58598C12.7708 4.39496 12.9915 4.2426 13.2355 4.13778C13.4795 4.03296 13.742 3.97779 14.0075 3.97548C14.2731 3.97317 14.5364 4.02378 14.7822 4.12434C15.028 4.2249 15.2513 4.37341 15.4391 4.56119C15.6269 4.74898 15.7754 4.97228 15.876 5.21807C15.9765 5.46387 16.0271 5.72722 16.0248 5.99278C16.0225 6.25834 15.9673 6.52078 15.8625 6.76479C15.7577 7.0088 15.6053 7.22949 15.4143 7.41398L12.4143 10.414C12.0393 10.7889 11.5307 10.9996 11.0003 10.9996C10.47 10.9996 9.96138 10.7889 9.58633 10.414C9.39772 10.2318 9.14512 10.131 8.88292 10.1333C8.62073 10.1356 8.36991 10.2408 8.18451 10.4262C7.9991 10.6116 7.89393 10.8624 7.89165 11.1246C7.88937 11.3868 7.99017 11.6394 8.17232 11.828C8.92244 12.5779 9.93967 12.9991 11.0003 12.9991C12.061 12.9991 13.0782 12.5779 13.8283 11.828L16.8283 8.82798C17.557 8.07357 17.9601 7.06316 17.951 6.01438C17.9419 4.96559 17.5212 3.96234 16.7796 3.22071C16.038 2.47907 15.0347 2.0584 13.9859 2.04928C12.9371 2.04017 11.9267 2.44335 11.1723 3.17198L9.67232 4.67198C9.57681 4.76423 9.50063 4.87457 9.44822 4.99658C9.39581 5.11858 9.36823 5.2498 9.36707 5.38258C9.36592 5.51536 9.39122 5.64704 9.4415 5.76993C9.49178 5.89283 9.56604 6.00448 9.65993 6.09838C9.75382 6.19227 9.86547 6.26652 9.98837 6.3168C10.1113 6.36708 10.2429 6.39239 10.3757 6.39123C10.5085 6.39008 10.6397 6.36249 10.7617 6.31008C10.8837 6.25767 10.9941 6.18149 11.0863 6.08598L12.5863 4.58598ZM7.58632 9.58598C7.96138 9.21104 8.47 9.00041 9.00032 9.00041C9.53065 9.00041 10.0393 9.21104 10.4143 9.58598C10.5066 9.68149 10.6169 9.75767 10.7389 9.81008C10.8609 9.86249 10.9921 9.89008 11.1249 9.89123C11.2577 9.89239 11.3894 9.86708 11.5123 9.8168C11.6352 9.76652 11.7468 9.69227 11.8407 9.59838C11.9346 9.50448 12.0089 9.39283 12.0591 9.26993C12.1094 9.14704 12.1347 9.01536 12.1336 8.88258C12.1324 8.7498 12.1048 8.61858 12.0524 8.49658C12 8.37457 11.9238 8.26423 11.8283 8.17198C11.0782 7.4221 10.061 7.00083 9.00032 7.00083C7.93967 7.00083 6.92244 7.4221 6.17232 8.17198L3.17232 11.172C2.79028 11.541 2.48556 11.9823 2.27592 12.4704C2.06628 12.9584 1.95594 13.4833 1.95132 14.0144C1.94671 14.5455 2.04791 15.0722 2.24904 15.5638C2.45016 16.0554 2.74717 16.502 3.12274 16.8776C3.49832 17.2531 3.94492 17.5501 4.43651 17.7513C4.92809 17.9524 5.45481 18.0536 5.98593 18.049C6.51705 18.0444 7.04193 17.934 7.52994 17.7244C8.01796 17.5148 8.45934 17.21 8.82832 16.828L10.3283 15.328C10.4238 15.2357 10.5 15.1254 10.5524 15.0034C10.6048 14.8814 10.6324 14.7502 10.6336 14.6174C10.6347 14.4846 10.6094 14.3529 10.5591 14.23C10.5089 14.1071 10.4346 13.9955 10.3407 13.9016C10.2468 13.8077 10.1352 13.7334 10.0123 13.6832C9.88938 13.6329 9.7577 13.6076 9.62492 13.6087C9.49214 13.6099 9.36092 13.6375 9.23892 13.6899C9.11692 13.7423 9.00657 13.8185 8.91432 13.914L7.41432 15.414C7.22983 15.605 7.00914 15.7574 6.76513 15.8622C6.52113 15.967 6.25869 16.0222 5.99313 16.0245C5.72757 16.0268 5.46421 15.9762 5.21842 15.8756C4.97262 15.7751 4.74932 15.6266 4.56153 15.4388C4.37375 15.251 4.22524 15.0277 4.12468 14.7819C4.02412 14.5361 3.97352 14.2727 3.97582 14.0072C3.97813 13.7416 4.0333 13.4792 4.13812 13.2352C4.24294 12.9912 4.3953 12.7705 4.58632 12.586L7.58632 9.58598Z"
                                fill="#6B7280" />
                        </svg>
                    </div>
                    <div class="text-gray-700 text-sm font-medium leading-tight">Print Notes</div>
                </div>
            </button>
            <button
                class="w-40 h-full px-4 py-2 bg-indigo-600 rounded-md shadow border border-gray-300 justify-center items-center inline-flex">
                <div class="justify-start items-start gap-2 flex">
                    <div class="w-5 h-5 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.7074 5.29303C16.8949 5.48056 17.0002 5.73487 17.0002 6.00003C17.0002 6.26519 16.8949 6.5195 16.7074 6.70703L8.70741 14.707C8.51988 14.8945 8.26557 14.9998 8.00041 14.9998C7.73524 14.9998 7.48094 14.8945 7.29341 14.707L3.29341 10.707C3.11125 10.5184 3.01045 10.2658 3.01273 10.0036C3.01501 9.74143 3.12018 9.49062 3.30559 9.30521C3.491 9.1198 3.74181 9.01464 4.00401 9.01236C4.2662 9.01008 4.5188 9.11087 4.70741 9.29303L8.00041 12.586L15.2934 5.29303C15.4809 5.10556 15.7352 5.00024 16.0004 5.00024C16.2656 5.00024 16.5199 5.10556 16.7074 5.29303Z"
                                fill="white" />
                        </svg>
                    </div>
                    <div class="text-white text-sm font-medium leading-tight">Upload Visits</div>
                </div>
            </button>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400"
                style="background: #E6E9F3">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox"
                                wire:change="handleSelectAll($event.target.checked)"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        LAST NAME
                    </th>
                    <th scope="col" class="px-6 py-3">
                        FIRST NAME
                    </th>
                    <th scope="col" class="px-6 py-3">
                        DATE OF VISIT
                    </th>
                    <th scope="col" class="px-6 py-3">
                        VISIT TYPE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        STATUS
                    </th>
                    <th scope="col" class="px-6 py-3">
                        READY
                    </th>
                    <th scope="col" class="px-6 py-3">
                        COMPLETE
                    </th>
                    <th scope="col" class="px-6 py-3">
                        EDIT
                    </th>
                    <th scope="col" class="px-6 py-3">
                        DELETE
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visits as $key => $visit)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox"
                                    wire:change="handleSelectRow({{ $visit->id }})"
                                    {{ in_array($visit->id, $selected_rows) ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            #{{ $visit->id }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $visit->last_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $visit->first_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ date_format(date_create($visit->visit_at), 'm/d/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $visit->visit_type }}
                        </td>
                        <td class="px-6 py-4">
                            <?php $i = $visit->status == 'complete' ? 'green' : ($visit->status == 'processing' ? 'blue' : ($visit->status == 'not_started' ? 'red' : 'gray')); ?>
                            <span
                                class="bg-{{ $i }}-100 text-{{ $i }}-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                {{ strtoupper(formatString($visit->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox"
                                    {{ $visit->ready ? 'checked' : '' }} disabled
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Fill
                                Out</a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="cursor-pointer" onclick="openEditVisitModal({{ $visit->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3.25023 10.26L5.72023 12.73L12.4102 6.03999L9.95023 3.55999L3.25023 10.26ZM0.990234 14.99L4.85023 13.6L2.39023 11.16L0.990234 14.99ZM13.2402 0.98999C12.7602 0.98999 12.3202 1.18999 12.0002 1.49999L10.5602 2.93999L13.0302 5.40999L14.4702 3.96999C14.7902 3.64999 14.9802 3.21999 14.9802 2.72999C14.9902 1.77999 14.2102 0.98999 13.2402 0.98999Z"
                                        fill="#101840" />
                                </svg>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="cursor-pointer" onclick="openDeleteVisitModal({{ $visit->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 16 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M14.1082 4.69647H1.87293C1.6094 4.69647 1.40234 4.90353 1.40234 5.16706C1.40234 5.43059 1.6094 5.63765 1.87293 5.63765H2.34352V15.0494C2.34352 15.5671 2.76705 15.9906 3.2847 15.9906H12.6965C13.2141 15.9906 13.6376 15.5671 13.6376 15.0494V5.63765H14.1082C14.3718 5.63765 14.5788 5.43059 14.5788 5.16706C14.5788 4.90353 14.3718 4.69647 14.1082 4.69647ZM6.10823 13.1671C6.10823 13.6847 5.6847 14.1082 5.16705 14.1082C4.6494 14.1082 4.22587 13.6847 4.22587 13.1671V7.52C4.22587 7.00235 4.6494 6.57882 5.16705 6.57882C5.6847 6.57882 6.10823 7.00235 6.10823 7.52V13.1671ZM8.93176 13.1671C8.93176 13.6847 8.50823 14.1082 7.99058 14.1082C7.47293 14.1082 7.0494 13.6847 7.0494 13.1671V7.52C7.0494 7.00235 7.47293 6.57882 7.99058 6.57882C8.50823 6.57882 8.93176 7.00235 8.93176 7.52V13.1671ZM11.7553 13.1671C11.7553 13.6847 11.3318 14.1082 10.8141 14.1082C10.2965 14.1082 9.87293 13.6847 9.87293 13.1671V7.52C9.87293 7.00235 10.2965 6.57882 10.8141 6.57882C11.3318 6.57882 11.7553 7.00235 11.7553 7.52V13.1671ZM13.6376 1.87294H9.87293C9.87293 1.35529 9.4494 0.931763 8.93176 0.931763H7.0494C6.53176 0.931763 6.10823 1.35529 6.10823 1.87294H2.34352C1.82587 1.87294 1.40234 2.29647 1.40234 2.81412V3.75529H14.5788V2.81412C14.5788 2.29647 14.1553 1.87294 13.6376 1.87294Z"
                                        fill="#101840" />
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
            {{ $visits->links('pagination::tailwind') }}
        </div>
    </div>

    <div id="printVisitModal" x-data x-init="$watch('$store.printVisitModal.open', value => {
        if (value === true) { document.body.classList.add('overflow-hidden') } else { document.body.classList.remove('overflow-hidden'); }
    });" x-show="$store.printVisitModal.open"
        class="fixed inset-0 z-10 z-30 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="$store.printVisitModal.open" @click="$store.printVisitModal.open = false;"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity" x-cloak>
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <div x-show="$store.printVisitModal.open" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full sm:p-6"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline" x-cloak>
                <div>
                    <div class="mt-3 flex justify-between items-center sm:mt-5">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                            Print Selected Visits
                        </h3>
                        <div class="mt-2">
                            <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" viewBox="0 0 16 16" fill="none"
                                @click="$store.printVisitModal.open = false;">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.9928 4.99715C11.9928 4.44747 11.5431 3.99774 10.9934 3.99774C10.7135 3.99774 10.4637 4.10768 10.2838 4.28757L7.99517 6.5862L5.70654 4.29756C5.52664 4.10768 5.27679 3.99774 4.99696 3.99774C4.44729 3.99774 3.99756 4.44747 3.99756 4.99715C3.99756 5.27698 4.10749 5.52683 4.28738 5.70672L6.57602 7.99536L4.28738 10.284C4.10749 10.4639 3.99756 10.7137 3.99756 10.9936C3.99756 11.5432 4.44729 11.993 4.99696 11.993C5.27679 11.993 5.52664 11.883 5.70654 11.7031L7.99517 9.41451L10.2838 11.7031C10.4637 11.883 10.7135 11.993 10.9934 11.993C11.5431 11.993 11.9928 11.5432 11.9928 10.9936C11.9928 10.7137 11.8829 10.4639 11.703 10.284L9.41432 7.99536L11.703 5.70672C11.8829 5.52683 11.9928 5.27698 11.9928 4.99715ZM7.99523 0C3.57787 0 0 3.57787 0 7.99523C0 12.4126 3.57787 15.9905 7.99523 15.9905C12.4126 15.9905 15.9905 12.4126 15.9905 7.99523C15.9905 3.57787 12.4126 0 7.99523 0ZM7.99572 13.9918C4.68769 13.9918 1.9993 11.3034 1.9993 7.99536C1.9993 4.68733 4.68769 1.99893 7.99572 1.99893C11.3037 1.99893 13.9921 4.68733 13.9921 7.99536C13.9921 11.3034 11.3137 13.9918 7.99572 13.9918Z"
                                    fill="#8F95B2" />
                            </svg>
                        </div>
                    </div>
                    <div class="shadow mt-6 sm:mt-5 rounded-md">
                        <div class="px-8 py-16">
                            <div class="text-gray-500 text-sm font-medium font-['Inter'] leading-tight">Print or
                                download the selected office visits</div>

                            <div class="flex items-center mt-4">
                                <input id="visit-id-checkbox" type="checkbox" wire:model="show_visit_id"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="visit-id-checkbox"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Visit ID</label>
                            </div>
                            <div class="flex items-center mt-4">
                                <input checked id="last-name-checkbox" type="checkbox" wire:model="show_last_name"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="last-name-checkbox"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last Name</label>
                            </div>
                            <div class="flex items-center mt-4">
                                <input checked id="first-name-checkbox" type="checkbox" wire:model="show_first_name"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="first-name-checkbox"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">First Name</label>
                            </div>
                            <div class="flex items-center mt-4">
                                <input checked id="visit-type-checkbox" type="checkbox" wire:model="show_visit_type"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="visit-type-checkbox"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Visit Type</label>
                            </div>
                            <div class="flex items-center mt-4">
                                <input checked id="visit-at-checkbox" type="checkbox" wire:model="show_visit_at"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="visit-at-checkbox"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Visit At</label>
                            </div>
                            <div class="flex items-center mt-4">
                                <input checked id="status-checkbox" type="checkbox" wire:model="show_status"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="status-checkbox"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Status</label>
                            </div>
                            <div class="flex items-center mt-4">
                                <input checked id="ready-checkbox" type="checkbox" wire:model="show_ready"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="ready-checkbox"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ready</label>
                            </div>
                        </div>
                        <form id="print_visit_form" wire:submit.prevent="printVisits">

                            <div class="bg-gray-100 flex justify-end py-3 pr-5">
                                <button
                                    class="inline-flex justify-center px-4 py-1 ml-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md shadow-sm bg-blue-600 hover:bg-wave-500 focus:outline-none focus:border-wave-700 focus:shadow-outline-wave sm:text-sm sm:leading-5"
                                    id="apply-crop" type="submit">Print</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6">

                </div>
            </div>
        </div>
    </div>
    <script>
        window.openAddVisitModal = function() {
            Alpine.store('lgModal').type = 'add-visit';
            Alpine.store('lgModal').openModal();
        }
        window.openPrintVisitModal = function(selected_rows) {
            if (selected_rows == 0) {
                popToast('danger', 'Please select visits to print.');
                return;
            }
            Alpine.store('printVisitModal').openModal();
        }
        window.openEditVisitModal = function(visit_id) {
            Alpine.store('editVisitModal').openModal();
            Livewire.emit('editVisit', visit_id);
            // Alpine.store('editVisitModal').visit_id = visit_id;
        }
        window.openDeleteVisitModal = function(visit_id) {
            Alpine.store('deleteVisitModal').openModal();
            Livewire.emit('deleteVisit', visit_id);
        }
    </script>
</div>
@push('footer-scripts')
    <script>
        $('input[name="dates"]').daterangepicker({
            autoUpdateInput: false,
        });

        $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            Livewire.emit('dateRangeUpdated',
                picker.startDate.format('YYYY-MM-DD'),
                picker.endDate.format('YYYY-MM-DD')
            );
        });

        $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
            Livewire.emit('dateRangeUpdated',
                null,
                null
            );
        });
    </script>
@endpush
