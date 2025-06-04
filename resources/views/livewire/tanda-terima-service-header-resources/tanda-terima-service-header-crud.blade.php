<div>

  <x-list-menu :title="$title" :url="$url" :id="$id" shadow class="" />


  <x-form wire:submit="{{ $id ? 'ubah' : 'simpan' }}" class="bg-white">

    <div id="pertanyaan">

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="mb-3">
          <x-input label="Nama" wire:model.blur="masterForm.nama" id="masterForm.nama" nama="masterForm.nama"
            placeholder="Nama" :readonly="$isReadonly" />
          <div wire:loading wire:target="masterForm.nama">
            Typing Nama ...
          </div>
        </div>

        {{-- <div class="mb-3">
          <x-select label="Availability" wire:model="masterForm.availability" :options="[
              ['id' => 'batal', 'name' => 'Batal'],
              ['id' => 'draf', 'name' => 'Draf'],
              ['id' => 'selesai', 'name' => 'Selesai'],
              ['id' => 'terbit', 'name' => 'Terbit'],
              ['id' => 'arsip', 'name' => 'Arsip'],
          ]" />
        </div> --}}
        <div class="mb-3">
          <x-select label="Availability" wire:model="masterForm.availability" :options="[['id' => 'aktif', 'name' => 'Aktif'], ['id' => 'tidak-aktif', 'name' => 'Tidak Aktif']]" />
        </div>

        <div wire:loading wire:target="masterForm.availability">
          Choosing Availability ...
        </div>

        <div class="mb-3">
          <x-input icon="o-percent-badge" label="Nomor" wire:model="masterForm.nomor" id="masterForm.nomor"
            name="masterForm.nomor" placeholder="Nomor" :readonly="true" />
          <div wire:loading wire:target="masterForm.name">
            Sedang mengetik Nomor ...
          </div>
        </div>


        @dump($details)
        <x-button label="Tambah Detail Sales Order" class="btn-sm btn-success text-white" wire:click="createDetail"
          :disabled="$isDisabled" />
        <table class="table-auto w-full border border-gray-300 text-left text-sm mt-8">
          <thead class="bg-gray-100">
            <tr>
              <th class="border px-4 py-2">Action</th>
              <th class="border px-4 py-2">#</th>
              <th class="border px-4 py-2">Product Name</th>
              <th class="border px-4 py-2">Selling Price</th>
              <th class="border px-4 py-2">Quantity</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($details as $index => $row)
              <tr>
                <td class="border px-4 py-2">
                  <x-dropdown class="btn-xs" :disabled="$isDisabled">
                    <x-menu-item title="Edit" icon="o-pencil-square" wire:click="editDetail({{ $index }})" />
                    <x-menu-item title="Delete" icon="o-trash" wire:click="deleteDetail({{ $index }})"
                      wire:confirm="are you sure to delete this data ?" />
                  </x-dropdown>
                </td>
                <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2">{{ $row['product_name'] ?? '' }}</td>
                <td class="border px-4 py-2">{{ $row['selling_price'] ?? '' }}</td>
                <td class="border px-4 py-2">{{ $row['qty'] ?? '' }}</td>
              </tr>
            @empty
              <tr>
                <td class="border px-4 py-2 text-center" colspan="100%">No data available.</td>
              </tr>
            @endforelse

            <div class="text-center mt-3">
              <x-errors class="text-white mb-3" />
              <x-button type="submit" :label="$id ? 'ubah' : 'simpan'" class="btn-success btn-sm text-white" />
              <x-button label="batal" class="btn-error btn-sm text-white" wire.click="closeModal" />
            </div>

      </div>
    </div>
  </x-form>


  <hr>


  <livewire:tanda-terima-service-detail-resources.tanda-terima-service-detail-list />

</div>

@script
@endscript
