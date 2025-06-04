<x-card :title="$title" shadow separator class="border shadow">

  <div class="grid grid-cols-2 mb-4">
    <div>
      <x-button label="List" link="{{ $url }}" class="btn-ghost btn-outline" />

      @if ($id)
        <x-button label="Create" link="{{ $url . '/create' }}" class="btn-ghost btn-outline" />
      @endif

      @if ($id && $isReadonly)
        <x-button label="Edit" link="{{ $url . '/edit/' . $id }}" class="btn-ghost btn-outline" />
      @endif

    </div>
    <div class="text-right">
      @if ($id && !$isReadonly)
        <x-button label="Delete" wire:click="delete" wire:confirm="Do you want to delete this data?"
          class="btn-ghost btn-outline text-red-500" />
      @endif
    </div>
  </div>

<h2 class="divider font-semibold">{{ $position->name }}</h2>
  
  <x-form wire:submit="{{ $id ? 'update' : 'store' }}" wire:confirm="Are you sure?">
    
    <div class="" style="height: 500px; overflow: auto;">
      <table class="min-w-full divide-y divide-gray-200">
          <th class="px-4 py-2 text-left">
            <x-checkbox id="checkAll" label="Check All" onclick="toggleCheckboxes(this)" />
          </th>

          <tbody class="bg-white divide-y divide-gray-200">
              <!-- Repeat this block for each row -->
              @forelse ($pages as $page)
                <tr>
                    <td class="px-4 py-2  text-left font-bold">{{ $page->name }}</td>
                    @foreach($page->permissions as $permission )
                    <td class="px-4 py-2  text-left"><x-checkbox label="{{ $permission->action_id }}" wire:model="masterForm.permissions" value="{{ $permission->id }}"  /></td>
                    @endforeach

                </tr>
              @empty
                <tr>
                    <td colspan="100%" class="text-center">No pages available.</td>
                </tr>
              @endforelse

              <!-- Repeat for other rows -->
          </tbody>
      </table>
    </div>

    @if (!$isReadonly)
      <div class="text-center mt-3">
        <x-errors class="text-white mb-3" />
        <x-button type="submit" :label="$id ? 'Update' : 'Store'" class="btn-success btn-sm text-white" />
      </div>
    @endif
  </x-form>

  
    <!-- Loading Indicator -->
    <div id="loadingIndicator" style="display: none; text-align: center; margin-top: 20px;">
      <p>Loading...</p>
      <div class="loader"></div> <!-- You can add a spinner here -->
  </div>
  
  <script>
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
</x-card>