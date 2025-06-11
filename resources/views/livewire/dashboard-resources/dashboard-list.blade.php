<div>
  <!-- HEADER -->
  <x-header title="Hello" separator progress-indicator>
    <x-slot:middle class="!justify-end">
      <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
    </x-slot:middle>
    <x-slot:actions>
      <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" class="btn-primary" />
    </x-slot:actions>
  </x-header>


  <x-card>
    <div class="space-y-4 p-4">

      <div class="w-10/12">
        <div class="flex flex-row">
          <div class="bg-no-repeat bg-blue-200 border border-blue-300 rounded-xl w-7/12 mr-2 p-6 shadow-lg "
            style="background-image: url(); background-position: 90% center;">
            <div class="flex justify-between">
              <div>
                <p class="text-2xl text-indigo-900 ">Selamat Datang
                  <br><strong>{{ Auth::guard('pegawai')->user()->nama }}</strong>
                </p>
              </div>
              <div>
                <img src="{{ asset('frontend/assets/img/flat-img1.png') }}" class="w-48" alt=""
                  srcset="">
              </div>
            </div>

          </div>

          <div class="bg-no-repeat bg-blue-100 border border-blue-200  rounded-xl w-5/12 ml-2 p-6"
            style=" background-position: 100% 40%;">
            Chart1
          </div>
        </div>
        <div class="flex flex-row h-64 mt-6">
          <div class="bg-white bg-blue-100 border border-blue-200 rounded-xl shadow-lg px-6 py-4 w-4/12">
            a
          </div>
          <div class="bg-white bg-blue-100 border border-blue-200 rounded-xl shadow-lg mx-6 px-6 py-4 w-4/12">
            b
          </div>
          <div class="bg-white bg-blue-100 border border-blue-200 rounded-xl shadow-lg px-6 py-4 w-4/12">
            c
          </div>
        </div>
      </div>

      {{-- <h2 class="text-xl font-semibold text-gray-800">
        Selamat Datang, {{ Auth::guard('pegawai')->user()->nama }}
      </h2>
      <p class="text-sm text-gray-600">
        Jabatan: {{ $user_role ?? 'Tidak diketahui' }}
      </p> --}}

    </div>
  </x-card>


  <!-- FILTER DRAWER -->
  <x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
    <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass"
      @keydown.enter="$wire.drawer = false" />

    <x-slot:actions>
      <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
      <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
    </x-slot:actions>
  </x-drawer>
</div>
