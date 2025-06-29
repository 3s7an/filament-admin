<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductResource extends Resource
{
  protected static ?string $model = Product::class;
  protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
  protected static ?string $modelLabel = 'Produkt';
  protected static ?string $pluralModelLabel = 'Produkty';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('name')
          ->label('Názov')
          ->required()
          ->maxLength(255),
        Forms\Components\RichEditor::make('description')
          ->label('Popis')
          ->toolbarButtons([
            'bold',
            'italic',
            'underline',
            'link',
            'undo',
            'redo',
          ]),
        Forms\Components\TextInput::make('price')
          ->label('Cena (€)')
          ->numeric()
          ->prefix('€')
          ->required(),
        Forms\Components\Select::make('category_id')
          ->label('Kategória')
          ->options(Category::where('is_active', true)->pluck('name', 'id'))
          ->required(),
        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
          ->label('Obrázok')
          ->collection('product_images')
          ->image(),
        Forms\Components\Toggle::make('is_active')
          ->label('Aktívny')
          ->default(true),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->label('Názov')
          ->searchable(),
        Tables\Columns\TextColumn::make('price')
          ->label('Cena')
          ->money('EUR')
          ->sortable(),
        Tables\Columns\TextColumn::make('category.name')
          ->label('Kategória')
          ->sortable(),
        Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
          ->label('Obrázok')
          ->collection('product_images'),
        Tables\Columns\IconColumn::make('is_active')
          ->label('Aktívny')
          ->boolean()
          ->action(function ($record) {
            $record->is_active = !$record->is_active;
            $record->save();
          }),
        Tables\Columns\TextColumn::make('created_at')
          ->label('Vytvorené')
          ->dateTime('d.m.Y H:i')
          ->sortable(),
        Tables\Columns\TextColumn::make('updated_at')
          ->label('Aktualizované')
          ->dateTime('d.m.Y H:i')
          ->sortable(),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\ViewAction::make(),
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\DeleteBulkAction::make(),
      ]);
  }

  public static function getPages(): array
  {
    return [
      'index' => Pages\ListProducts::route('/'),
      'create' => Pages\CreateProduct::route('/create'),
      'view' => Pages\ViewProduct::route('/{record}'),
      'edit' => Pages\EditProduct::route('/{record}/edit'),
    ];
  }
}
