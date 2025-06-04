@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="main-content">
            <!-- Page Header -->
            <div class="block justify-between page-header md:flex">
                <div>
                    <h3
                        class="!text-defaulttextcolor dark:!text-defaulttextcolor/70 dark:text-white dark:hover:text-white text-[1.125rem] font-semibold">
                        Dashboard
                    </h3>
                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Cards Grid -->
            <div class="w-full">
                <div class="flex items-center justify-between mt-8">
                    <h3 class="text-2xl font-semibold text-defaulttextcolor dark:text-white">Overview</h3>
                </div>

                <div class="flex items-center gap-3 mt-6">
                    <form method="GET" action="{{ route('home.index') }}" class="flex items-center gap-3">
                        <select name="filter" onchange="this.form.submit()"
                            class="border border-gray-300 rounded p-2 dark:bg-[#1f2937] dark:text-white">
                            <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All</option>
                            <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>This Week</option>
                            <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>This Month</option>
                            <option value="custom" {{ request('filter') == 'custom' ? 'selected' : '' }}>Custom</option>
                        </select>

                        <!-- في حال custom نعرض تاريخين -->
                        @if (request('filter') == 'custom')
                            <input type="date" name="from" value="{{ request('from') }}"
                                class="border border-gray-300 rounded p-2 dark:bg-[#1f2937] dark:text-white">
                            <input type="date" name="to" value="{{ request('to') }}"
                                class="border border-gray-300 rounded p-2 dark:bg-[#1f2937] dark:text-white">
                            <button type="submit" class="bg-primary text-white rounded px-4 py-2">Apply</button>
                        @endif
                    </form>
                </div>

                <div class="grid grid-cols-4 gap-6 mt-6">

                    <!-- Admins Card -->
                    <div
                        class="border rounded-[10px] border-gray-300 dark:border-gray-700 overflow-hidden bg-white dark:bg-[#1f2937] flex flex-col justify-between">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-defaulttextcolor dark:text-white">Admins</h4>
                        </div>
                        <div class="p-6 flex items-center justify-between">
                            <span
                                class="text-5xl font-bold text-defaulttextcolor dark:text-white">{{ $adminsCount }}</span>
                            <a href="{{ route('admins.create') }}"
                                class="inline-flex items-center justify-center w-10 h-10 bg-primary text-white rounded-full text-2xl">+</a>
                        </div>
                    </div>

                    <!-- Clients Card -->
                    <div
                        class="border rounded-[10px] border-gray-300 dark:border-gray-700 overflow-hidden bg-white dark:bg-[#1f2937] flex flex-col justify-between">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-defaulttextcolor dark:text-white">Clients</h4>
                        </div>
                        <div class="p-6 flex items-center justify-between">
                            <span
                                class="text-5xl font-bold text-defaulttextcolor dark:text-white">{{ $clientsCount }}</span>
                            <a href="{{ route('clients.create') }}"
                                class="inline-flex items-center justify-center w-10 h-10 bg-primary text-white rounded-full text-2xl">+</a>
                        </div>
                    </div>

                    <!-- Freelancers Card -->
                    <div
                        class="border rounded-[10px] border-gray-300 dark:border-gray-700 overflow-hidden bg-white dark:bg-[#1f2937] flex flex-col justify-between">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-defaulttextcolor dark:text-white">Freelancers</h4>
                        </div>
                        <div class="p-6 flex items-center justify-between">
                            <span
                                class="text-5xl font-bold text-defaulttextcolor dark:text-white">{{ $freelancersCount }}</span>
                            <a href="{{ route('freelancers.create') }}"
                                class="inline-flex items-center justify-center w-10 h-10 bg-primary text-white rounded-full text-2xl">+</a>
                        </div>
                    </div>

                    <!-- Roles Card -->
                    <div
                        class="border rounded-[10px] border-gray-300 dark:border-gray-700 overflow-hidden bg-white dark:bg-[#1f2937] flex flex-col justify-between">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-defaulttextcolor dark:text-white">Roles</h4>
                        </div>
                        <div class="p-6 flex items-center justify-between">
                            <span
                                class="text-5xl font-bold text-defaulttextcolor dark:text-white">{{ $rolesCount }}</span>
                            <a href="{{ route('roles.create') }}"
                                class="inline-flex items-center justify-center w-10 h-10 bg-primary text-white rounded-full text-2xl">+</a>
                        </div>
                    </div>

                    <!-- Category Card -->
                    <div
                        class="border rounded-[10px] border-gray-300 dark:border-gray-700 overflow-hidden bg-white dark:bg-[#1f2937] flex flex-col justify-between">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-defaulttextcolor dark:text-white">Category</h4>
                        </div>
                        <div class="p-6 flex items-center justify-between">
                            <span
                                class="text-5xl font-bold text-defaulttextcolor dark:text-white">{{ $categoriesCount }}</span>
                            <a href="{{ route('categories.create') }}"
                                class="inline-flex items-center justify-center w-10 h-10 bg-primary text-white rounded-full text-2xl">+</a>
                        </div>
                    </div>

                    <!-- Sub Category Card -->
                    <div
                        class="border rounded-[10px] border-gray-300 dark:border-gray-700 overflow-hidden bg-white dark:bg-[#1f2937] flex flex-col justify-between">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-defaulttextcolor dark:text-white">Sub Category</h4>
                        </div>
                        <div class="p-6 flex items-center justify-between">
                            <span
                                class="text-5xl font-bold text-defaulttextcolor dark:text-white">{{ $subCategoriesCount }}</span>
                            <a href="{{ route('subCategories.create') }}"
                                class="inline-flex items-center justify-center w-10 h-10 bg-primary text-white rounded-full text-2xl">+</a>
                        </div>
                    </div>

                    <!-- Tag Card -->
                    <div
                        class="border rounded-[10px] border-gray-300 dark:border-gray-700 overflow-hidden bg-white dark:bg-[#1f2937] flex flex-col justify-between">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-defaulttextcolor dark:text-white">Tag</h4>
                        </div>
                        <div class="p-6 flex items-center justify-between">
                            <span
                                class="text-5xl font-bold text-defaulttextcolor dark:text-white">{{ $tagsCount }}</span>
                            <a href="{{ route('tags.create') }}"
                                class="inline-flex items-center justify-center w-10 h-10 bg-primary text-white rounded-full text-2xl">+</a>
                        </div>
                    </div>

                    <!-- Service Card -->
                    <div
                        class="border rounded-[10px] border-gray-300 dark:border-gray-700 overflow-hidden bg-white dark:bg-[#1f2937] flex flex-col justify-between">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                            <h4 class="text-lg font-semibold text-defaulttextcolor dark:text-white">Service</h4>
                        </div>
                        <div class="p-6 flex items-center justify-between">
                            <span
                                class="text-5xl font-bold text-defaulttextcolor dark:text-white">{{ $servicesCount }}</span>
                            <a href="{{ route('services.create') }}"
                                class="inline-flex items-center justify-center w-10 h-10 bg-primary text-white rounded-full text-2xl">+</a>
                        </div>
                    </div>
                </div>



                <!-- Requests Table -->
                <div class="mt-10">
                    <h3 class="text-2xl font-semibold text-defaulttextcolor dark:text-white mb-4">Latest Requests</h3>
                    <div class="flex gap-2 mb-4">
                        @php
                            $statuses = ['all', 'pending', 'confirmed', 'in_progress', 'cancelled', 'completed'];
                        @endphp

                        @foreach ($statuses as $item)
                            <a href="{{ route('home.index', ['status' => $item]) }}"
                                class="px-4 py-2 rounded
                {{ $status == $item ? 'bg-primary text-white' : 'bg-gray-200' }}">
                                {{ ucfirst(str_replace('_', ' ', $item)) }}
                            </a>
                        @endforeach
                    </div>


                    <div class="overflow-x-auto rounded-lg border border-gray-300 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                            <thead class="bg-gray-50 dark:bg-[#374151]">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Request Number</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Client</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Freelancer</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Start Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        End Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-[#1f2937] divide-y divide-gray-200 dark:divide-gray-600">

                                @foreach ($requests as $request)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                            <a href="{{ route('requests.show', $request->id) }}"
                                                class="text-primary font-semibold hover:underline">
                                                #{{ $request->id }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                            {{ $request->user->username ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                            {{ $request->service->user->username ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                            {{ $request->start_date }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                            {{ $request->end_date }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if ($request->status == 'completed') bg-green-100 text-green-800
                                @elseif($request->status == 'pending') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>



                <div class="mt-10">
                    <h3 class="text-2xl font-semibold text-defaulttextcolor dark:text-white mb-4">Support Tickets </h3>
                    <div class="flex gap-2 mb-4">
                        <a href="{{ route('home.index', ['ticket_status' => 'all']) }}"
                            class="px-4 py-2 rounded {{ request('ticket_status') == 'all' || !request('ticket_status') ? 'bg-primary text-white' : 'bg-gray-200' }}">
                            All
                        </a>
                        <a href="{{ route('home.index', ['ticket_status' => 'open']) }}"
                            class="px-4 py-2 rounded {{ request('ticket_status') == 'open' ? 'bg-primary text-white' : 'bg-gray-200' }}">
                            Open
                        </a>
                        <a href="{{ route('home.index', ['ticket_status' => 'closed']) }}"
                            class="px-4 py-2 rounded {{ request('ticket_status') == 'closed' ? 'bg-primary text-white' : 'bg-gray-200' }}">
                            Closed
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-[#374151]">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Code</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Client</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Subject</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Opened Date</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-[#1f2937] divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                        <a href="{{ route('tickets.show', $ticket->id) }}"
                                            class="text-primary font-semibold hover:underline">
                                            #{{ $ticket->code }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                        {{ $ticket->user->username ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                        {{ $ticket->subject }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                        {{ \Carbon\Carbon::parse($ticket->created_at)->format('Y-m-d') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                    @if ($ticket->status == 'open') bg-yellow-100 text-yellow-800
                    @elseif($ticket->status == 'closed') bg-green-100 text-green-800
                    @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>


                <div class="mt-10">
                    <h3 class="text-2xl font-semibold text-defaulttextcolor dark:text-white mb-4">Quotations </h3>
                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 mt-8">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                            <thead class="bg-gray-50 dark:bg-[#374151]">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Title</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Description</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Price</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Client</th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Request Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Comments</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-[#1f2937] divide-y divide-gray-200 dark:divide-gray-600">
                                @foreach ($quotations as $quotation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                            {{ $quotation->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                            {{ Str::limit($quotation->description, 50) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                            £{{ number_format($quotation->price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                            {{ $quotation->user->username ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                            {{ $quotation->created_at->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-defaulttextcolor dark:text-white">
                                            {{ $quotation->quotation_comments_count  }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- Cards Grid End -->

        </div>
    </div>
@endsection
