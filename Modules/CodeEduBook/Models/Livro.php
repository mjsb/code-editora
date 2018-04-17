<?php

namespace CodeEduBook\Models;

use CodeEduBook\Models\Categoria;
use CodeEduUser\Models\User;
use Bootstrapper\Interfaces\TableInterface;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livro extends Model implements TableInterface
{
    use FormAccessible;
    use SoftDeletes;
    use BookStorageTrait;
    use BookThumbnailTrait;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'subtitle',
        'price',
        'author_id',
        'dedication',
        'description',
        'website',
        'percent_complete',
        'published'
    ];

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */

    public function author(){
        return $this->belongsTo(\CodeEduUser\Models\User::class);
    }

    public function categorias() {
        return $this->belongsToMany(Categoria::class, "livro_categoria")->withTrashed();
    }

    public function formCategoriasAttribute() {
        return $this->categorias->pluck('id')->all();
    }

    public function getTableHeaders()
    {
        // TODO: Implement getTableHeaders() method.
        return ['#', 'Título', 'Autor', 'Preço'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        // TODO: Implement getValueForHeader() method.
        switch ($header){
            case '#':
                return $this->id;
            case 'Título':
                return $this->title;
            case 'Autor':
                return $this->author->name;
            case 'Preço':
                return $this->price;
        }
    }
}
