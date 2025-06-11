<div>
  <div>
    <x-list-menu :title="$title" :url="$url" :id="$id" shadow class="" />
    <x-form wire:submit="{{ $id ? 'update' : 'simpan' }}" class="bg-white p-2">

      <div id="pertanyaan">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="mb-3">
            <x-input label="Nama" wire:model.blur="headerForm.nama" id="headerForm.nama" nama="headerForm.nama"
              placeholder="Nama" :readonly="$isReadonly" />
            <div wire:loading wire:target="headerForm.nama">
              Typing Nama ...
            </div>
          </div>
          {{-- <div class="mb-3">
            <x-choices label="Pelanggan" wire:model.live="headerForm.ms_pelanggan_id" :options="$pelangganSearchable"
              placeholder="Pelanggan ..." search-function="searchPelanggan" single searchable />
            <div wire:loading wire:target="headerForm.nama">
              Typing Pelanggan ...
            </div>
          </div> --}}
          <div class="mb-3">
            <x-input label="Memo" wire:model.blur="headerForm.memo" id="headerForm.memo" nama="headerForm.memo"
              placeholder="Memo" :readonly="$isReadonly" />
            <div wire:loading wire:target="headerForm.memo">
              Typing Memo ...
            </div>
          </div>
          <div class="mb-3">
            <x-select label="Status" wire:model="headerForm.status" :options="[
                ['id' => 'batal', 'name' => 'Batal', 'disabled' => true],
                ['id' => 'draf', 'name' => 'Draf', 'disabled' => true],
                ['id' => 'selesai', 'name' => 'Selesai', 'disabled' => true],
                ['id' => 'terbit', 'name' => 'Terbit'],
                ['id' => 'arsip', 'name' => 'Arsip'],
            ]" />
          </div>
        </div>


        <div class="text-center mt-3">
          <x-errors class="text-white mb-3" />
          <x-button type="submit" :label="$id ? 'ubah' : 'simpan'" class="btn-success btn-sm text-white" />
          <x-button label="batal" class="btn-error btn-sm text-white" wire.click="closeModal" />
        </div>
      </div>
    </x-form>

    <p class="my-8">

    <div class="pb-2 ">
      <x-button label="Tambah Tanda Terima Service Detail" class="btn-sm btn-success text-white w-full"
        wire:click="buatDetail" :disabled="$isDisabled" />
    </div>

    <div class="bg-white p-2">

      <x-header title="Tanda Terima Service Detail" subtitle="">
        <x-slot:actions>
          <x-button label="Filters" @click="$wire.filterDrawer = true" responsive icon="o-funnel" class="btn-primary" />
        </x-slot:actions>
      </x-header>


      <table class="table-auto w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
          <tr>
            <th class="border px-4 py-2">Action</th>
            <th class="border px-4 py-2">#</th>
            <th class="border px-4 py-2">Barang ID</th>
            <th class="border px-4 py-2">Rak ID</th>
            <th class="border px-4 py-2">Catatan</th>
            <th class="border px-4 py-2">Qty</th>
            <th class="border px-4 py-2">Tgl Dibuat</th>
            <th class="border px-4 py-2">Dibuat Oleh</th>
            <th class="border px-4 py-2">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($this->rows as $index => $item)
            <tr>
              <td class="border px-4 py-2">
                <x-dropdown>
                  <x-menu-item title="Ubah" icon="o-pencil-square" wire:click="ubahDetail('{{ $item->id }}')" />
                  <x-menu-item title="Show" icon="o-eye"
                    link="/tanda-terima-service-detail/show/{{ $item->id }}" />
                </x-dropdown>
              </td>
              <td class="border px-4 py-2">{{ ($this->rows->firstItem() ?? 0) + $index }}</td>
              <td class="border px-4 py-2">{{ $item->ms_barang_id }}</td>
              <td class="border px-4 py-2">{{ $item->ms_rak_id }}</td>
              <td class="border px-4 py-2">{{ $item->catatan }}</td>
              <td class="border px-4 py-2 text-right">{{ $item->qty }}</td>
              <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($item->tgl_dibuat)->format('d-m-Y H:i') }}</td>
              <td class="border px-4 py-2">{{ $item->dibuat_oleh }}</td>
              <td class="border px-4 py-2">{{ ucfirst($item->status) }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center py-4 text-gray-500">Data tidak ditemukan</td>
            </tr>
          @endforelse
        </tbody>
      </table>

      <div class="mt-4">
        {{ $this->rows->links() }}
      </div>


      {{-- <x-table :headers="$this->headers" class="table-sm border border-gray-400 dark:border-gray-500" :rows="$this->rows"
        :sort-by="$sortBy" with-pagination show-empty-text>

        @scope('cell_action', $row)
          <x-dropdown>
            <x-menu-item title="Edit" icon="o-pencil-square" link="/pelanggan/edit/{{ $row->id }}" />
            <x-menu-item title="Show" icon="o-eye" link="/pelanggan/show/{{ $row->id }}" />
          </x-dropdown>
        @endscope

        @scope('cell_status', $row)
          <x-badge :value="$row->status == 'aktif' ? 'Yes' : 'No'"
            class=" {{ $row->status == 'aktif' ? 'badge-primary badge-soft' : 'badge-error  badge-soft' }}" />
        @endscope

      </x-table> --}}
    </div>



    <x-modal wire:model="modalDetail" title="Tanda Terima Service Detail" class="backdrop-blur" without-trap-focus>
      <x-form wire:submit="{{ $detailId ? 'updateDetail' : 'simpanDetail' }}"
        wire:confirm="are you sure to {{ $detailId ? 'Update' : 'Simpan' }} this data ?">

        {{-- <x-choices label="Product" wire:model.live="detailForm.product_id" :options="$productsSearchable" placeholder="Product ..."
        search-function="searchProduct" single searchable /> --}}


        <x-input label="ID" wire:model="detailForm.id" placeholder="ID" :readonly="true" />
        <x-input label="Nomor" wire:model="detailForm.nomor" placeholder="Nomor" :readonly="true" />
        <x-input label="Catatan" wire:model="detailForm.catatan" placeholder="Catatan" :readonly="$isReadonly" />
        <x-input label="Qty" wire:model="detailForm.qty" placeholder="Qty" />


        <div class="text-center mt-3">
          <x-errors class="text-white mb-3" />
          <x-button type="submit" label="{{ $detailId ? 'Update' : 'Simpan' }}"
            class="btn-success btn-sm text-white" />
        </div>
      </x-form>
    </x-modal>
  </div>
</div>
