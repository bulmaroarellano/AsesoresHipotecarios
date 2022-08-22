<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['destino', 'monto_solicitado', 'plazo'];

    protected $searchableFields = ['*'];

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
