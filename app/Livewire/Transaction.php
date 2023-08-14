<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Transaction as TransactionModel;
use Livewire\WithPagination;


class Transaction extends Component
{
    use WithPagination;

    public string $search = '';
    public string $sortColumn = 'name';
    public string $sortOrder = 'asc';


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
//        dd($this->sortOrder);
        if($this->sortColumn === $field)
        {
            $this->sortOrder = $this->sortOrder == 'asc' ? 'desc' : 'asc';
        }else{
            $this->sortOrder = 'asc';
        }
        $this->sortColumn = $field;

    }

    public function render()
    {
        DB::connection()->enableQueryLog();
        $transactions = TransactionModel::when($this->search,  function( Builder $query, string $search){
                 return $query->where('name', 'like', '%'.$search.'%');
            })->orderBy($this->sortColumn, $this->sortOrder)->paginate(10);
        $queries = DB::getQueryLog();
        $last_query = end($queries);
//        dd($last_query);
        return view('livewire.transaction', compact('transactions'))->extends('layouts.app');;
    }
}
