<div>

  <x-drawer wire:model="filterDrawer" class="w-11/12 lg:w-1/3" title="Filter" right separator with-close-button>

    <x-form wire:submit.prevent="filter">

      <x-input placeholder="Filter By Name" wire:model="filterForm.name" icon="o-magnifying-glass" clearable />

      <x-input placeholder="Filter By Selling Price" wire:model="filterForm.selling_price" icon="o-banknotes" clearable />

      <x-input placeholder="Filter By Image URL" wire:model="filterForm.image_url" icon="o-photo" clearable />

      <x-select wire:model="filterForm.is_activated" :options="[['id' => 1, 'name' => 'Yes'], ['id' => 0, 'name' => 'No']]" placeholder="- Is Activated -"
        placeholder-value="" />

      <x-datepicker wire:model="filterForm.created_at" icon="o-calendar" :config="['altFormat' => 'd/m/Y']" />

      <x-slot:actions>
        <x-button label="Filter" class="btn-primary" type="submit" spinner="filter" />
        <x-button label="Clear" wire:click="clear" spinner />
      </x-slot:actions>

    </x-form>
  </x-drawer>


  <x-list-menu :title="$title" :url="$url" shadow />

  <div class="my-2">
    <x-input placeholder="Search..." wire:model.live.debounce.300ms="search" icon="o-magnifying-glass" clearable />
  </div>

  <div class="">

    <x-table :headers="$this->headers" class="table-sm border border-gray-400 dark:border-gray-500" show-empty-text
      :rows="$this->rows" :sort-by="$sortBy" with-pagination>

      @scope('cell_no_urut', $row)
        {{ $row->no_urut }}
      @endscope

      @scope('cell_action', $row)
        <x-dropdown class="btn-xs">
          <x-menu-item class="" title="Edit" icon="o-pencil-square" link="/products/edit/{{ $row->id }}" />
          <x-menu-item class="" title="Show" icon="o-eye" link="/products/show/{{ $row->id }}/readonly" />
        </x-dropdown>
      @endscope

      @scope('cell_is_activated', $row)
        <x-badge :value="$row->is_activated == 1 ? 'Yes' : 'No'"
          class=" {{ $row->is_activated == 1 ? 'badge-primary badge-soft' : 'badge-error  badge-soft' }}" />
      @endscope

      @scope('cell_image_url', $row)
        <a href="{{ $row->image_url }}" target="_blank"
          class="px-4 underline underline-offset-1">{{ $row->image_url }}</a>
      @endscope

    </x-table>

  </div>

</div>
