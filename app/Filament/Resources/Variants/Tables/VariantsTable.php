<?php

namespace App\Filament\Resources\Variants\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;

class VariantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Цена')
                    ->money('RUB')
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('Остаток')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Активен')
                    ->boolean(),
                TextColumn::make('product.name')
                    ->label('Группа')
                    ->placeholder('—'),
                TextColumn::make('primaryCategory.name')
                    ->label('Осн. категория')
                    ->placeholder('—'),
                TextColumn::make('categories.name')
                    ->label('Категории')
                    ->badge(),
            ])
            ->filters([
                SelectFilter::make('product')
                    ->relationship('product', 'name'),
                SelectFilter::make('primaryCategory')
                    ->relationship('primaryCategory', 'name'),
                SelectFilter::make('categories')
                    ->relationship('categories', 'name')
                    ->multiple(),
            ]);
    }
}