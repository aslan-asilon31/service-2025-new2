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
      <h2 class="text-xl font-semibold text-gray-800">
        Selamat Datang, {{ Auth::guard('pegawai')->user()->nama }}
      </h2>
      <p class="text-sm text-gray-600">
        Jabatan: {{ Auth::guard('pegawai')->user()->getRoleNames()->first() ?? 'Tidak diketahui' }}
      </p>

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
