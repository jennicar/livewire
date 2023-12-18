<header class="relative bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
        <div class="flex justify-start lg:w-0 lg:flex-1">
          <a href="#">
            <span class="sr-only">By the Pixel</span>
            <img class="h-8 w-auto sm:h-10" src="https://bythepixel.com/favicon-192.png" alt="Example Logo">
          </a>
        </div>
        <div class="md:hidden">
          <button type="button" class="bg-white p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            <span class="sr-only">Open menu</span>
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
        <nav class="hidden md:flex space-x-10">
          <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">
            Page A
          </a>
          <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">
            Page B
          </a>
          <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">
            Page C
          </a>
        </nav>
        <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
          <a href="#" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
            Page D
          </a>
        </div>
      </div>
    </div>
    {{-- Remove .hidden class to open the menu. --}}
    <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right hidden md:hidden">
      <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
        <div class="pt-5 pb-6 px-5">
          <div class="flex items-center justify-between">
            <div>
              <img class="h-8 w-auto" src="https://bythepixel.com/favicon-192.png" alt="Example Logo">
            </div>
            <div class="-mr-2">
              <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                <span class="sr-only">Close menu</span>
                <!-- Heroicon name: x -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>
          <div class="mt-6">
            <nav class="grid gap-y-8">
                <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">
                  Page A
                </a>
                <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">
                  Page B
                </a>
                <a href="#" class="text-base font-medium text-gray-500 hover:text-gray-900">
                  Page C
                </a>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
