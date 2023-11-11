<aside
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0"
    aria-label="Sidenav" id="drawer-navigation">
    <div class="overflow-y-auto py-5 px-3 h-full bg-dark-pink">
        <ul class="space-y-2">
            @if (Auth::user()->user_role == 1)
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900">
                            <i class="fa-solid fa-gauge"></i>
                        </span>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('booking.index') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <span class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900">
                        <i class="fa-solid fa-calendar"></i>
                    </span>
                    <span class="ml-3">Bookings</span>
                </a>
            </li>
            @if (Auth::user()->user_role == 2)
                <li>
                    <a href="{{ route('nail-custom.index') }}"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900">
                            <i class="fa-solid fa-palette"></i>
                        </span>
                        <span class="ml-3">Nail Customization</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->user_role == 1)
                <li>
                    <a href="{{ route('users.index') }}"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <span class="ml-3">Customer Management</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff.index') }}"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900">
                            <i class="fa-solid fa-users"></i>
                        </span>
                        <span class="ml-3">Staff Management</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('reports.index') }}"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900">
                            <i class="fa-solid fa-chart-simple"></i>
                        </span>
                        <span class="ml-3">Sales Report</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('sms.index') }}"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <span class="ml-3">SMS Management</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('activity.index') }}"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <span class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </span>
                        <span class="ml-3">Activity Log</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg group hover:bg-gray-100"
                        aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                        <span class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900">
                            <i class="fa-solid fa-tag"></i>
                        </span>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Settings</span>
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul id="dropdown-pages" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('services.index') }}"
                                class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100">Services</a>
                        </li>
                        <li>
                            <a href="{{ route('products.index') }}"
                                class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100">Products</a>
                        </li>
                        <li>
                            <a href="{{ route('branches.index') }}"
                                class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100">Branch</a>
                        </li>
                        <li>
                            <a href="{{ route('nail-colors.index') }}"
                                class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100">Nail
                                Colors</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</aside>
