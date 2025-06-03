<div>

  <x-list-menu :title="$title" :url="$url" :id="$id" shadow class="" />


  <x-form wire:submit="{{ $id ? 'update' : 'store' }}">

    <div id="pertanyaan">

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="mb-3">
          <x-input label="Selling Price" wire:model="masterForm.selling_price" id="masterForm.selling_price"
            name="masterForm.selling_price" placeholder="selling price" :readonly="$isReadonly" prefix="Rp" />
          <div wire:loading wire:target="masterForm.name">
            Typing Selling Price ...
          </div>
        </div>

        <div class="mb-3">
          <x-input icon="o-percent-badge" label="Discount Persentage (%)" wire:model="masterForm.discount_persentage"
            id="masterForm.discount_persentage" name="masterForm.discount_persentage" placeholder="Discount Persentage"
            :readonly="$isReadonly" />
          <div wire:loading wire:target="masterForm.name">
            Typing Discount Percentage ...
          </div>
        </div>

        <div class="mb-3">
          <x-input label="Name" wire:model.blur="masterForm.name" id="masterForm.name" name="masterForm.name"
            placeholder="Name" :readonly="$isReadonly" />
          <div wire:loading wire:target="masterForm.name">
            Typing Name ...
          </div>
        </div>



        <div class="mb-3">

          <x-select label="Availability" wire:model="masterForm.availability" :options="[['id' => 'on-sale', 'name' => 'On Sale'], ['id' => 'out-of-stock', 'name' => 'Out Of Stock']]" />

          {{-- <x-input label="Availability" wire:model="masterForm.availability" id="masterForm.availability"
            name="masterForm.availability" placeholder="availability" :readonly="$isReadonly" /> --}}
        </div>
        <div wire:loading wire:target="masterForm.name">
          Choosing Availability ...
        </div>

        <div class="mb-3">
          <x-input icon="o-percent-badge" label="Discount Value" wire:model="masterForm.discount_value"
            id="masterForm.discount_value" name="masterForm.discount_value" placeholder="Discount Value"
            :readonly="true" />
          <div wire:loading wire:target="masterForm.name">
            Typing Discount Value ...
          </div>
        </div>
        <div class="mb-3">
          <x-input prefix="Rp" icon="o-percent-badge" label="Nett Price" wire:model="masterForm.nett_price"
            id="masterForm.nett_price" name="masterForm.nett_price" placeholder="Nett Price" :readonly="true" />
        </div>
        <div class="mb-3">
          <x-input label="Prepend a select">
            <x-slot:prepend>
              {{-- Add `join-item` to all prepended elements --}}
              <x-select :options="[['id' => 1, 'name' => 'KG'], ['id' => 2, 'name' => 'Gram']]" class="join-item bg-base-200" />
            </x-slot:prepend>
          </x-input>

          {{-- <x-input label="Weight" wire:model="masterForm.weight" id="masterForm.weight" name="masterForm.weight"
            placeholder="Weight" :readonly="$isReadonly" /> --}}
        </div>

        <div class="mb-3">
          <x-input label="Rating" wire:model="masterForm.rating" id="masterForm.rating" name="masterForm.rating"
            placeholder="Rating" :readonly="$isReadonly" />
        </div>

        <x-file wire:model="masterForm.image_url" label="Image" accept="image/*" crop-after-change
          {{-- :disabled="$isDisabled" --}}>
          <img
            src="{{ $masterForm->image_url ?? 'https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg?20200913095930' }}"
            class="h-48 rounded-lg" />
        </x-file>
        <div wire:loading wire:target="masterForm.name">
          Uploading Image ...
        </div>


        <div class="text-center mt-3">
          <x-errors class="text-white mb-3" />
          <x-button type="submit" :label="$id ? 'update' : 'store'" class="btn-success btn-sm text-white" />
          <x-button label="Cancel" class="btn-error btn-sm text-white" wire.click="closeModal" />
        </div>

      </div>
    </div>
  </x-form>


</div>

@script
@endscript
