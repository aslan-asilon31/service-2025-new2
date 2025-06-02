<?php

namespace App\Livewire\CustomerResources\Components;


use App\Models\Customer;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use Illuminate\Support\Facades\Blade;

final class CustomerTable extends PowerGridComponent
{
    public string $tableName = 'customer-table';
    public string $sortField = 'updated_at';
    public string $sortDirection = 'desc';
    public string $url = '/customers';

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
        return Customer::query();
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
                    <x-menu-item title="Show" Link="/customers/show/' . e($record->id) . '/readonly" />
                    <x-menu-item title="Edit" Link="/customers/edit/' . e($record->id) . '"/>
                </x-dropdown>'))
            ->add('id')
            ->add('name')
            ->add('created_at')
            ->add('is_activated', fn($record) => $record->is_activated ? 'Aktif' : 'Non-aktif');
    }

    public function columns(): array
    {
        return [

            Column::make('Action', 'action')
                ->bodyAttribute('text-center'),

            Column::make('Id', 'id')
                ->sortable()
                ->searchable()
                ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),

            Column::make('First Name', 'first_name')
                ->sortable()
                ->searchable()
                ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),


            Column::make('Last Name', 'last_name')
                ->sortable()
                ->searchable()
                ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),


            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable()
                ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),


            Column::make('Aktif', 'is_activated')
                ->bodyAttribute('text-center'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('id', 'product_category_firsts.id')->placeholder('ID'),
            Filter::inputText('name', 'product_category_firsts.first_name')->placeholder('First Name'),
            Filter::inputText('created_by', 'product_category_firsts.created_by')->placeholder('Created By'),
            Filter::inputText('updated_by', 'product_category_firsts.updated_by')->placeholder('Updated By'),
            Filter::datepicker('created_at', 'product_category_firsts.created_at'),
            Filter::datepicker('updated_at', 'product_category_firsts.updated_at'),
            Filter::boolean('is_activated', 'product_category_firsts.is_activated')->label('Yes', 'No'),
        ];
    }
}
