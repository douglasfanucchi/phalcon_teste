<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class NoticiaForm extends Form
{
	public function initialize()
	{
		$titulo = new Text('titulo');
		$titulo->addValidator(
			new PresenceOf(['message' => 'O campo título é obrigatório!'])
		);
		$titulo->addValidator(
			new StringLength([
				'max' => '255',
				'messageMaximum' => 'Tamanho máximo do título é de 255 caracteres!',
			])
		);

		$this->add($titulo);
	}
}
