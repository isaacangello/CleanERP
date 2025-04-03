<div x-ref="mainContent" class="card bg-white/60  mt-5 rounded-xl shadow-lg ">
    <div class=" header p-4 border-b">
        <h2 class="uppercase uppercase-text">welcome, {{ Auth::user()->name }}</h2>
    </div>
    <div class="card-body">
      <div class="flex">
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
      </div>
    </div>
</div>
