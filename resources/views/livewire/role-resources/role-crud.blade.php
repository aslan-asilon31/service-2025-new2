<x-card :title="$title" shadow separator class="border shadow">

  <div class="grid grid-cols-2 mb-4">
    <div>
      <x-button label="List" link="{{ $url }}" class="btn-ghost btn-outline" />

      @if ($id)
        <x-button label="Buat" link="{{ $url . '/buat' }}" class="btn-ghost btn-outline" />
      @endif

      @if ($id && $isReadonly)
        <x-button label="Ubah" link="{{ $url . '/ubah/' . $id }}" class="btn-ghost btn-outline" />
      @endif

      <x-button label="Permission List" @click="$wire.permissionList = true" />

    </div>
    <div class="text-right">
      @if ($id && !$isReadonly)
        <x-button label="Delete" wire:click="delete" wire:confirm="Do you want to delete this data?"
          class="btn-ghost btn-outline text-red-500" />
      @endif
    </div>
  </div>

  <form wire:submit.prevent="update">

    @foreach ($groupedPermissions as $group => $permissionsInGroup)
      <div class="mb-6 border-2 p-8">
        <h4 class="text-lg font-semibold mb-2">{{ ucfirst($group) }}</h4>
        <button type="button" onclick="checkAllInGroup('{{ Str::slug($group) }}', true)"
          class="btn btn-xs btn-outline mr-2">Check All</button>
        <button type="button" onclick="checkAllInGroup('{{ Str::slug($group) }}', false)"
          class="btn btn-xs btn-outline">Uncheck All</button>
        <div class="flex ">
          @foreach ($permissionsInGroup as $permission)
            <div class="flex-1 p-2 m-2  bg-slate-300 border-md">

              <input type="checkbox" wire:model="selectedPermissions" value="{{ $permission->id }}"
                class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out permission-checkbox-{{ Str::slug($group) }}">


              {{-- <input type="checkbox" wire:model="selectedPermissions" value="{{ $permission->id }}"
                class="form-checkbox h-4 w-4 text-blue-600  transition duration-150 ease-in-out"> --}}
              <label class="ml-2 text-gray-700">{{ ucfirst($permission->name) }}</label>
            </div>
          @endforeach
        </div>
      </div>
    @endforeach


    <button type="submit" class="btn btn-primary mt-3">Update Permissions</button>

  </form>


  <!-- Loading Indicator -->
  <div id="loadingIndicator" style="display: none; text-align: center; margin-top: 20px;">
    <p>Loading...</p>
    <div class="loader"></div> <!-- You can add a spinner here -->
  </div>

  <script>
    function checkAllInGroup(groupClass, check) {
      const checkboxes = document.querySelectorAll(`.permission-checkbox-${groupClass}`);
      checkboxes.forEach((checkbox) => {
        checkbox.checked = check;
        checkbox.dispatchEvent(new Event('change'));
      });
    }

    function toggleCheckboxes(source) {
      const checkboxes = document.querySelectorAll('input[type="checkbox"][wire\\:model="masterForm.permissions"]');
      checkboxes.forEach((checkbox) => {
        checkbox.checked = source.checked;
        checkbox.dispatchEvent(new Event('change')); // Trigger change event to update Livewire
      });

      if (!source.checked) {
        @this.refreshData();
      }

    }
  </script>


  <x-modal wire:model="permissionList" title="Daftar Permission" class="backdrop-blur">

    {{-- Tombol Create Permission --}}
    <div class="mb-4">
      <x-button label="Permission Create" link="/permission/create" />
    </div>

    {{-- Tabel Permission --}}
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200 rounded-md">
        <thead class="bg-gray-100 text-xs uppercase">
          <tr>
            <th class="px-4 py-2 border">#</th>
            <th class="px-4 py-2 border">Name</th>
            <th class="px-4 py-2 border">Group</th>
            <th class="px-4 py-2 border">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($allPermissions as $index => $permission)
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-2 border">{{ $index + 1 }}</td>
              <td class="px-4 py-2 border">{{ $permission->name }}</td>
              <td class="px-4 py-2 border">{{ $permission->group }}</td>
              <td class="px-4 py-2 border space-x-2">
                <x-button label="Edit" class="btn-xs" wire:click="editPermission({{ $permission->id }})" />
                <x-button label="Delete" class="btn-xs text-red-600"
                  wire:click="confirmDelete({{ $permission->id }})" />
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-4 py-2 text-center text-gray-500 border">No permissions found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Modal Actions --}}
    <x-slot:actions>
      <x-button label="Cancel" @click="$wire.permissionList = false" />
    </x-slot:actions>

  </x-modal>



</x-card>
