<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:divide-y lg:divide-gray-200 lg:px-8">
        <div class="relative h-16 flex justify-between">
            <div class="relative z-10 px-2 flex lg:px-0">
                <div class="flex-shrink-0 flex items-center">
                    <svg class="w-6 h-6 text-orange-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                              clip-rule="evenodd"></path>
                    </svg>

                    <span class="font-bold text-gray-700 ml-2">Booking Manager</span>
                </div>
            </div>
            <div class="relative z-0 flex-1 px-2 flex items-center justify-center sm:absolute sm:inset-0">
                <div class="max-w-xs w-full">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                            <!-- Heroicon name: search -->
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input name="search" id="search"
                               class="block w-full bg-white border border-gray-300 rounded-md py-2 pl-10 pr-3 text-sm placeholder-gray-500 focus:outline-none focus:text-gray-900 focus:placeholder-gray-400 focus:ring-1 focus:ring-gray-900 focus:border-gray-900 sm:text-sm"
                               placeholder="Search" type="search">
                    </div>
                </div>
            </div>
            <div class="relative z-10 flex items-center lg:hidden">
                <!-- Mobile menu button -->
                <button
                    class="rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-900"
                    aria-expanded="false">
                    <span class="sr-only">Open menu</span>
                    <!-- Icon when menu is closed. -->
                    <!--
                      Heroicon name: menu

                      Menu open: "hidden", Menu closed: "block"
                    -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <!-- Icon when menu is open. -->
                    <!--
                      Heroicon name: x

                      Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="hidden lg:relative lg:z-10 lg:ml-4 lg:flex lg:items-center">
                <button
                    class="flex-shrink-0 bg-white rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500">
                    <span class="sr-only">View notifications</span>
                    <!-- Heroicon name: bell -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>

                <!-- Profile dropdown -->
                <div @click.away="open = false" class="flex-shrink-0 relative ml-4" x-data="{open : false}">
                    <div>
                        <button @click="open = !open"
                                class="bg-white rounded-full flex focus:outline-none hover:text-gray-500 text-gray-400 focus:text-gray-500"
                                id="user-menu" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <!--
                      Profile dropdown panel, show/hide based on dropdown state.

                      Entering: "transition ease-out duration-100"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                      Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"
                    -->
                    <div x-show="open"
                         class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1"
                         role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                        <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Your
                            Profile</a>

                        <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>

                        <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign
                            out</a>
                    </div>
                </div>
            </div>
        </div>
        <nav class="hidden lg:py-2 lg:flex lg:space-x-8" aria-label="Global">
            <a href="#"
               class="rounded-md py-2 px-3 inline-flex items-center text-sm font-medium text-gray-900 hover:bg-gray-50 hover:text-gray-900">
                Dashboard
            </a>

            <a href="#"
               class="rounded-md py-2 px-3 inline-flex items-center text-sm font-medium text-gray-900 hover:bg-gray-50 hover:text-gray-900">
                Jobs
            </a>

            <a href="#"
               class="rounded-md py-2 px-3 inline-flex items-center text-sm font-medium text-gray-900 hover:bg-gray-50 hover:text-gray-900">
                Applicants
            </a>

            <a href="#"
               class="rounded-md py-2 px-3 inline-flex items-center text-sm font-medium text-gray-900 hover:bg-gray-50 hover:text-gray-900">
                Company
            </a>
        </nav>
    </div>

    <!--
      Mobile menu, toggle classes based on menu state.

      Menu open: "block", Menu closed: "hidden"
    -->
    <nav class="hidden lg:hidden" aria-label="Global">
        <div class="pt-2 pb-3 px-2 space-y-1">
            <a href="#"
               class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-50 hover:text-gray-900">Dashboard</a>

            <a href="#"
               class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-50 hover:text-gray-900">Jobs</a>

            <a href="#"
               class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-50 hover:text-gray-900">Applicants</a>

            <a href="#"
               class="block rounded-md py-2 px-3 text-base font-medium text-gray-900 hover:bg-gray-50 hover:text-gray-900">Company</a>
        </div>
        <div class="border-t border-gray-200 pt-4 pb-3">
            <div class="px-4 flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full"
                         src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=80"
                         alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-gray-800">Lisa Marie</div>
                    <div class="text-sm font-medium text-gray-500">lisamarie@example.com</div>
                </div>
                <button
                    class="ml-auto flex-shrink-0 bg-white rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                    <span class="sr-only">View notifications</span>
                    <!-- Heroicon name: bell -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>
            </div>
            <div class="mt-3 px-2 space-y-1">
                <a href="#"
                   class="block rounded-md py-2 px-3 text-base font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-900">Your
                    Profile</a>

                <a href="#"
                   class="block rounded-md py-2 px-3 text-base font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-900">Settings</a>

                <a href="#"
                   class="block rounded-md py-2 px-3 text-base font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-900">Sign
                    out</a>
            </div>
        </div>
    </nav>
</header>
