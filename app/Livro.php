<?php

namespace App;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model implements TableInterface
{
    protected $fillable = ['title', 'subtitle', 'price'];

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        // TODO: Implement getTableHeaders() method.
        return ['#', 'Título', 'Subtitulo', 'Preço'];
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
            case 'Subtitulo':
                return $this->subtitle;
            case 'Preço':
                return $this->price;
        }
    }
}
