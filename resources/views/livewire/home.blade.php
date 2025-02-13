<div x-ref="mainContent" class="card bg-white/60  mt-5 rounded-xl shadow-lg ">
    <div class=" header p-4 border-b">
        <h2 class="uppercase uppercase-text">welcome, {{ Auth::user()->name }}</h2>
    </div>
    <div class="card-body">
      <div class="flex">
          <a target="_blank" href="https://meet.google.com/pbx-ngck-evi"
             class="btn btn-outline btn-primary btn-sm border-r-0 rounded-r-none"
          >
            Chamada Principal
          </a>
          <a target="_blank" href="https://meet.google.com/vvh-zxmn-cjc"
             class="btn btn-outline btn-primary btn-sm rounded-none"
          >
            Chamada Residencial
          </a>
          <a target="_blank" href="https://meet.google.com/cot-jkcr-dgw"
             class="label btn btn-outline btn-primary btn-sm rounded-none"
          >
              Chamada Comercial
          </a>
          <a target="_blank" href="https://meet.google.com/mec-cngi-feo"
             class="label btn btn-outline btn-primary btn-sm rounded-l-none"
          >
            Chamada Extra
          </a>
      </div>
    </div>
</div>
