<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Define a relationship with the Product model
    public static function getAll()
    {
        $categories = DB::table('categories')
            ->select('id', 'name')
            ->orderBy('id', 'DESC')
            ->get();

        return $categories;
    }

    public static function createCategory($data)
    {
        DB::table('categories')->insert([
            'name' => $data['name'],
        ]);

    }
    public function updateCategory($data)
    {
        DB::table('categories')
        ->where('id', $this->id)
        ->update($data);
    }
}
