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
          <div class="bg-no-repeat bg-blue-200 border border-blue-300 rounded-xl w-7/12 mr-2 p-6"
            style="background-image: url(); background-position: 90% center;">
            <p class="text-2xl text-indigo-900">Selamat Datang
              <br><strong>{{ Auth::guard('pegawai')->user()->nama }}</strong>
            </p>
            <span
              class="bg-blue-300 text-xl text-white inline-block rounded-full mt-12 px-8 py-2"><strong>01:51</strong></span>
          </div>

          <div class="bg-no-repeat bg-orange-200 border border-orange-300 rounded-xl w-5/12 ml-2 p-6"
            style="background-image: url(https://previews.dropbox.com/p/thumb/AAuwpqWfUgs9aC5lRoM_f-yi7OPV4txbpW1makBEj5l21sDbEGYsrC9sb6bwUFXTSsekeka5xb7_IHCdyM4p9XCUaoUjpaTSlKK99S_k4L5PIspjqKkiWoaUYiAeQIdnaUvZJlgAGVUEJoy-1PA9i6Jj0GHQTrF_h9MVEnCyPQ-kg4_p7kZ8Yk0TMTL7XDx4jGJFkz75geOdOklKT3GqY9U9JtxxvRRyo1Un8hOObbWQBS1eYE-MowAI5rNqHCE_e-44yXKY6AKJocLPXz_U4xp87K4mVGehFKC6dgk_i5Ur7gspuD7gRBDvd0sanJ9Ybr_6s2hZhrpad-2WFwWqSNkh/p.png?fv_content=true&size_mode=5); background-position: 100% 40%;">
            <p class="text-5xl text-indigo-900">Inbox <br><strong>23</strong></p>
            <a href=""
              class="bg-orange-300 text-xl text-white underline hover:no-underline inline-block rounded-full mt-12 px-8 py-2"><strong>See
                messages</strong></a>
          </div>
        </div>
        <div class="flex flex-row h-64 mt-6">
          <div class="bg-white rounded-xl shadow-lg px-6 py-4 w-4/12">
            a
          </div>
          <div class="bg-white rounded-xl shadow-lg mx-6 px-6 py-4 w-4/12">
            b
          </div>
          <div class="bg-white rounded-xl shadow-lg px-6 py-4 w-4/12">
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
