<?php

namespace App\Filament\Resources\Variants\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Section;

class VariantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основная информация')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required(),
                        TextInput::make('sku')
                            ->label('SKU')
                            ->required(),
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('₽'),
                        TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->default(0),
                        TextInput::make('min_order_quantity')
                            ->required()
                            ->numeric()
                            ->default(1),
                        Toggle::make('is_active')
                            ->required(),
                        Select::make('product_id')
                            ->relationship('product', 'name'),
                        Select::make('primary_category_id')
                            ->relationship('primaryCategory', 'name'),
                        Select::make('categories')
                            ->relationship('categories', 'name')
                            ->multiple()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')->required()->label('Название категории'),
                                TextInput::make('slug')->required()->label('Slug'),
                            ]),
                    ])
                    ->columns(2),
                Section::make('Контент и SEO')
                    ->schema([
                        TextInput::make('h1'),
                        TextInput::make('meta_title'),
                        Textarea::make('meta_description')
                            ->columnSpanFull(),
                        Textarea::make('excerpt')
                            ->rows(3),
                        Textarea::make('description')
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('images')
                            ->label('Изображения')
                            ->collection('images')
                            ->multiple()
                            ->reorderable()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
