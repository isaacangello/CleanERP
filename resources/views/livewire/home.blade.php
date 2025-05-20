<div x-ref="mainContent" class="card bg-white  mt-5 rounded-xl shadow-lg ">
    <div class=" header p-4 border-b">
        <h2 class="uppercase uppercase-text">welcome, {{ Auth::user()->name }}</h2>
    </div>
    <div class="card-body">
      <div class="block">
        <div class="w-full">
          <div class="card bg-white/60 p-4 rounded-xl shadow-lg">
            <h2 class="uppercase uppercase-text">Your Profile</h2>
            <div class="mt-4">
              <p class="text-gray-500">Name: {{ Auth::user()->name }}</p>
              <p class="text-gray-500">Email: {{ Auth::user()->email }}</p>
              <p class="text-gray-500">Role: {{ Auth::user()->role }}</p>
            </div>
          </div>
        </div>
          <div class="w-full">
              <div class="card bg-white/60 p-4 rounded-xl shadow-lg">
                  <h2 class="uppercase uppercase-text">Services</h2>
                  <div class="mt-4">
                      <p class="text-gray-500 flex gap-2">
                          <a  href="{{ route('week') }}"  class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              This Week residential:
                              <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                        {{ $this->allServices() }}
                                </span>
                          </a>
                          <a  href="{{ route('week') }}"  class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              This Week commercial:
                              <span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                    0
                                </span>
                          </a>
                      </p>
                  </div>
              </div>
              <br><br>
          </div>
      </div>

    </div>
</div>
