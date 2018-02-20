<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model implements TableInterface
{
    protected $fillable = [ 'name'];

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */

    public function getTableHeaders()
    {
        // TODO: Implement getTableHeaders() method.
        return ['#', 'Nome'];
    }

    public function livros() {
        return $this->belongsToMany(Livro::class);
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
            case 'Nome':
                return $this->name;

        }
    }
}