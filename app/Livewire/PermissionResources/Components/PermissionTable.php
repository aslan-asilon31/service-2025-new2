<?php

namespace App\Livewire\PermissionResources\Components;

use App\Models\Position;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class PermissionTable extends PowerGridComponent
{
    public string $tableName = 'permission-table-hs6ulb-table';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
    public string $url = '/permissions';

    public function setUp(): array
    {

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Position::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('action', fn($record) => Blade::render('
            <x-dropdown no-x-anchor class="btn-sm">
                <x-menu-item title="Edit" Link="/permissions/edit/' . e($record->id) . '"/>
            </x-dropdown>'))
            ->add('id')
            ->add('name')
            ->add('is_activated', fn($record) => $record->is_activated ? 'Aktif' : 'Non-aktif')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [

            Column::make('Action', 'action')
                ->bodyAttribute('text-center'),

            Column::make('Nama', 'name')
                ->sortable(),

            Column::make('Aktif', 'is_activated')
                ->bodyAttribute('text-center'),

        ];
    }


    public function filters(): array
    {
        return [
            Filter::inputText('id', 'employees.id')->placeholder('Id'),
            Filter::inputText('name', 'employees.name')->placeholder('Name'),
            Filter::inputText('aktif', 'employees.is_activated')->placeholder('Email'),

        ];
    }
}
