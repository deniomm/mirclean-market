<?php

namespace App\Filament\Resources\Categories\Tables;

// use Filament\Actions\BulkActionGroup;
// use Filament\Actions\DeleteBulkAction;
// use Filament\Actions\EditAction;
// use Filament\Actions\ForceDeleteBulkAction;
// use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
// use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
// use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Изображение')
                    ->collection('image')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),
                TextColumn::make('parent.name')
                    ->label('Родитель')
                    ->placeholder('Корневая'),
                IconColumn::make('is_active')
                    ->label('Активна')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->sortable(),
            ]);
    }
}