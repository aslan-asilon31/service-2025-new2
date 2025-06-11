<div>


  <x-button label="Tambah Detail Tanda Terima Service Detail" class="btn-sm btn-success text-white" wire:click="buat" />

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

      @scope('cell_action', $row)
        <x-dropdown>
          <x-menu-item title="Edit" icon="o-pencil-square" link="/pelanggan/edit/{{ $row->id }}" />
          <x-menu-item title="Show" icon="o-eye" link="/pelanggan/show/{{ $row->id }}" />
        </x-dropdown>
      @endscope

      @scope('cell_status', $row)
        <x-badge :value="$row->status == 'aktif' ? 'Aktif' : 'Tidak Aktif'"
          class=" {{ $row->status == 'aktif' ? 'badge-primary badge-soft' : 'badge-error  badge-soft' }}" />
      @endscope

    </x-table>

  </div>



  <x-modal wire:model="modalDetail" title="Tanda Terima Service Detail" class="backdrop-blur" without-trap-focus>
    <x-form wire:submit="{{ $detailId ? 'updateDetail' : 'simpanDetail' }}"
      wire:confirm="are you sure to {{ $detailId ? 'Update' : 'Simpan' }} this data ?">


      {{-- <x-choices label="Product" wire:model.live="detailForm.product_id" :options="$productsSearchable" placeholder="Product ..."
        search-function="searchProduct" single searchable /> --}}

      <x-input label="Selling Price" wire:model="detailForm.selling_price" placeholder="Selling Price" />

      <x-input label="Quantity" wire:model="detailForm.qty" placeholder="Qty" />

      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" label="{{ $detailId ? 'Update' : 'Simpan' }}" class="btn-success btn-sm text-white" />
      </div>
    </x-form>
  </x-modal>


</div>
