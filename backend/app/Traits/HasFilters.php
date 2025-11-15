<?php

namespace App\Traits;

trait HasFilters
{
    /**
     * Aplica filtros de busca genéricos
     */
    public function scopeSearch($query, string $term, array $fields = ['nome'])
    {
        return $query->where(function($q) use ($term, $fields) {
            foreach ($fields as $field) {
                $q->orWhere($field, 'like', "%{$term}%");
            }
        });
    }

    /**
     * Filtro por status ativo/inativo
     */
    public function scopeActive($query, bool $active = true)
    {
        return $query->where('ativo', $active);
    }

    /**
     * Filtro por data
     */
    public function scopeDateRange($query, string $field, ?string $start = null, ?string $end = null)
    {
        if ($start) {
            $query->whereDate($field, '>=', $start);
        }

        if ($end) {
            $query->whereDate($field, '<=', $end);
        }

        return $query;
    }
}

