<div>
  <div>

    <x-list-menu :title="$title" :url="$url" :id="$id" shadow class="" />


    <x-form wire:submit="{{ $id ? 'ubah' : 'simpan' }}">

      <div id="pertanyaan">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="mb-3">
            <x-input label="Nama" wire:model.blur="masterForm.nama" id="masterForm.nama" nama="masterForm.nama"
              placeholder="Nama" :readonly="$isReadonly" />
            <div wire:loading wire:target="masterForm.nama">
              Typing Nama ...
            </div>
          </div>


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



          <div class="text-center mt-3">
            <x-errors class="text-white mb-3" />
            <x-button type="submit" :label="$id ? 'ubah' : 'simpan'" class="btn-success btn-sm text-white" />
            <x-button label="batal" class="btn-error btn-sm text-white" wire.click="closeModal" />
          </div>

        </div>
      </div>
    </x-form>




  </div>
</div>
