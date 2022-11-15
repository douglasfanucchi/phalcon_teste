<?php



use Phalcon\Mvc\Model;

class Noticia extends Model
{
    public $id;
    public $data_cadastro;
    public $data_ultima_atualizacao;
    public $titulo;
    public $texto;

    public function initialize()
    {
        $this->setSource("noticia");
    }
}