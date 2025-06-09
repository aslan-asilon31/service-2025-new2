<div>
  <x-list-menu :title="$title" :url="$url" shadow />

  {{-- <x-button class="" wire:click="export">Export</x-button> --}}
  <x-drawer wire:model="filterDrawer" class="w-11/12 lg:w-1/3" title="Filter" right separator with-close-button>

    <x-form wire:submit.prevent="filter">

      <x-input label="Nama" placeholder="Filter By Nama" wire:model="filterForm.nama" icon="o-magnifying-glass"
        clearable />

      <x-input label="Email" placeholder="Filter By Email" wire:model="filterForm.email" icon="o-magnifying-glass"
        clearable />
      <x-input label="No Telp" placeholder="Filter By No Telp" wire:model="filterForm.no_telp" icon="o-magnifying-glass"
        clearable />
      <x-input label="Dibuat Oleh" placeholder="Filter By Dibuat Oleh" wire:model="filterForm.created_by"
        icon="o-magnifying-glass" clearable />
      <x-input label="Diupdate Oleh" placeholder="Filter By Diupdate Oleh" wire:model="filterForm.updated_by"
        icon="o-magnifying-glass" clearable />

      <x-select label="Is Activated" wire:model="filterForm.status" :options="[['id' => 1, 'name' => 'Yes'], ['id' => 0, 'name' => 'No']]" placeholder="- Is Activated -"
        placeholder-value="" />

      <x-datepicker label="Tanggal Dibuat" wire:model="filterForm.tgl_dibuat" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />
      <x-datepicker label="Tanggal Diupdate" wire:model="filterForm.tgl_diupdate" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />

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
      @dump($row)

      @scope('cell_action', $row)
        <x-dropdown>
          <x-menu-item title="Edit " icon="o-pencil-square" link="/pelanggan/edit/1" />
        </x-dropdown>
      @endscope

      {{--
      @scope('cell_status', $row)
        <x-badge :value="$row->status == 'aktif' ? 'Yes' : 'No'"
          class=" {{ $row->status == 'aktif' ? 'badge-primary badge-soft' : 'badge-error  badge-soft' }}" />
      @endscope --}}

    </x-table>

  </div>



  {{-- <livewire:pages.admin.sales.customer-resources.components.customer-table /> --}}

</div>
