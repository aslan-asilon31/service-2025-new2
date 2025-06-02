<?php

namespace App\Livewire\ProductResources\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Number;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class ProductTable extends PowerGridComponent
{
  public string $tableName = 'products';
  public string $sortField = 'created_at';
  public string $sortDirection = 'desc';
  public string $url = '/products';

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
    return \App\Models\Product::query()
      ->join('product_category_firsts', 'products.product_category_first_id', 'product_category_firsts.id')
      ->select([
        'products.id',
        'products.availability',
        'products.name',
        'products.selling_price',
        'products.image_url',
        'product_category_firsts.name AS product_category_firsts_name',
        'products.created_by',
        'products.updated_by',
        'products.created_at',
        'products.updated_at',
        'products.is_activated',
      ]);
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
              <x-menu-item title="Show" Link="/products/show/' . e($record->id) . '/readonly" />
              <x-menu-item title="Edit" Link="/products/edit/' . e($record->id) . '"/>
          </x-dropdown>'))
      ->add('id')
      ->add('availability', fn($record) => str($record->availability)->headline())
      ->add('name')
      ->add('product_category_firsts_name')
      ->add('selling_price', fn($record) => Number::format($record->selling_price))
      ->add('image_url', fn($record) => $record->image_url ? Blade::render(sprintf('<x-button link="%s" target="_blank">%s</x-button>', e(url($record->image_url)), e($record->image_url))) : NULL)
      ->add('created_by')
      ->add('updated_by')
      ->add('created_at')
      ->add('updated_at')
      ->add('is_activated', fn($record) => $record->is_activated ? 'Yes' : 'No');
  }

  public function columns(): array
  {
    return [
      Column::make('Action', 'action')
        ->bodyAttribute('text-center')
        ->visibleInExport(false),

      Column::make('ID', 'id')
        ->sortable()
        ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),


      Column::make('Availability', 'availability')
        ->sortable()
        ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),


      Column::make('Name', 'name')
        ->sortable()
        ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),


      Column::make('Product Category First Name', 'product_category_firsts_name')
        ->sortable()
        ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),


      Column::make('Selling Price', 'selling_price')
        ->bodyAttribute('text-right')
        ->sortable()
        ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),


      Column::make('Image URL', 'image_url')
        ->sortable()
        ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),


      Column::make('Created By', 'created_by')
        ->sortable()
        ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),


      Column::make('Updated By', 'updated_by')
        ->sortable()
        ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),


      Column::make('Created At', 'created_at')
        ->sortable()
        ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),


      Column::make('Updated At', 'updated_at')
        ->sortable()
        ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),


      Column::make('Is Activated', 'is_activated')
        ->bodyAttribute('text-center')
        ->sortable()
        ->headerAttribute('text-center', 'background-color:#A16A38; color:white;text-align:center;'),

    ];
  }

  public function filters(): array
  {
    return [
      Filter::inputText('id', 'products.id')->placeholder('ID'),
      Filter::select('availability', 'products.availability')
        ->dataSource([
          [
            'id' => 'in-stock',
            'name' => 'In Stock'
          ],
          [
            'id' => 'out-of-stock',
            'name' => 'Out Of Stock'
          ]
        ])
        ->optionLabel('name')
        ->optionValue('id'),
      Filter::inputText('name', 'products.name')->placeholder('Name'),
      Filter::inputText('product_category_firsts_name', 'product_category_firsts.name')->placeholder('Product Category First Name'),
      Filter::number('selling_price', 'products.selling_price')->thousands(',')->decimal('.'),
      Filter::inputText('image_url', 'products.image_url')->placeholder('Image URL'),
      Filter::inputText('created_by', 'products.created_by')->placeholder('Created By'),
      Filter::inputText('updated_by', 'products.updated_by')->placeholder('Updated By'),
      Filter::datepicker('created_at', 'products.created_at'),
      Filter::datepicker('updated_at', 'products.updated_at'),
      Filter::boolean('is_activated', 'products.is_activated')->label('Yes', 'No'),
    ];
  }
}
