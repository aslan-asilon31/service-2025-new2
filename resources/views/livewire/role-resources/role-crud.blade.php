

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
                <div class="flex ">
                    @foreach ($permissionsInGroup as $permission)
                        <div class="flex-1 p-2 m-2  bg-slate-300 border-md">
                            <input 
                                type="checkbox" 
                                wire:model="selectedPermissions" 
                                value="{{ $permission->id }}" 
                                class="form-checkbox h-4 w-4 text-blue-600  transition duration-150 ease-in-out"
                            >
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


    <x-button label="Permission Create"  Link="/permission/create" />


    <div>
        <livewire:admin.permission.component.permission-table class="bg-white p-2 m-2" />
    </div>
    <x-slot:actions>
        <x-button label="Cancel" @click="$wire.permissionList = false" />
    </x-slot:actions>
</x-modal>
 

</x-card>
