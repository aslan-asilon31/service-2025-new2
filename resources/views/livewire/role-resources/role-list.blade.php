<div>
  <x-list-menu :title="$title" :url="$url" shadow />


  {{-- <x-button class="" wire:click="export">Export</x-button> --}}
  <x-drawer wire:model="filterDrawer" class="w-11/12 lg:w-1/3" title="Filter" right separator with-close-button>

    <x-form wire:submit.prevent="filter">

      <x-input label="Name" placeholder="Filter By Name" wire:model="filterForm.name" icon="o-magnifying-glass"
        clearable />
      <x-datepicker label="Tanggal Dibuat" wire:model="filterForm.created_at" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />
      <x-datepicker label="Tanggal Diupdate" wire:model="filterForm.updated_at" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />

      <x-slot:actions>
        <x-button label="Filter" class="btn-primary" type="submit" spinner="filter" />
        <x-button label="Clear" wire:click="clear" spinner />
      </x-slot:actions>

    </x-form>
  </x-drawer>


  <div class="my-2">
    <x-input placeholder="Search..." wire:model.live.debounce.300ms="search" icon="o-magnifying-glass" clearable />
  </div>

  <div class="">

    <x-table :headers="$this->headers" class="table-sm border border-gray-400 dark:border-gray-500" :rows="$this->rows"
      :sort-by="$sortBy" with-pagination show-empty-text>

      @scope('cell_action', $row)
        <x-dropdown>
          <x-menu-item title="Ubah" icon="o-pencil-square" link="/role/ubah/{{ $row->id }}" />
          <x-menu-item title="Tampil" icon="o-eye" link="/role/tampil/{{ $row->id }}" />
        </x-dropdown>
      @endscope

      @scope('cell_status', $row)
        <x-badge :value="$row->status == 'aktif' ? 'Aktif' : 'Tidak Aktif'"
          class=" {{ $row->status == 'aktif' ? 'badge-primary badge-soft' : 'badge-error  badge-soft' }}" />
      @endscope

    </x-table>

  </div>

  {{-- <livewire:pages.admin.sales.customer-resources.components.customer-table /> --}}

</div>
