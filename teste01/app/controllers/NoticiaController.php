<?php

class NoticiaController extends ControllerBase
{
    private $mensagemDeErro = '';

    public function listaAction()
    {
        $this->view->noticias = Noticia::find();
        $this->view->pick("noticia/listar");
    }

    public function cadastrarAction()
    {
        
        $this->view->pick("noticia/cadastrar");

    }

    public function editarAction($id)
    {
        $this->view->noticia = Noticia::findFirst($id);
        if (!$this->view->noticia) {
            $this->flashSession->error('Notícia inexistente.');
            return $this->response->redirect(array('for' => 'noticia.lista'));
        }
        $this->view->pick("noticia/editar");
    }

    public function salvarAction()
    {
        $form = $this->forms->get('noticia');

        if (!$form->isValid($_POST)) {
            $messages = $form->getMessages();
            foreach($messages as $message) {
                $this->flashSession->error($message);
            }
            return $this->response->redirect(array('for' => 'noticia.lista'));
        }

        if ($this->request->get('noticia_id')) {
            $noticia = Noticia::findFirst($this->request->get('noticia_id'));
        } else {
            $noticia = new Noticia();
            $noticia->data_cadastro = date('Y-m-d H:i:s', time());
        }

        $noticia->titulo = $this->request->getPost('titulo');
        $noticia->texto = $this->request->getPost('texto');
        $noticia->data_ultima_atualizacao = date('Y-m-d H:i:s', time());

        if (!$noticia->save()) {
            $this->flashSession->error('Ocorreu um erro inesperado.');
            return $this->response->redirect(array('for' => 'noticia.lista'));
        }

        $this->flashSession->success('Notícia salva com sucesso.');
        return $this->response->redirect(array('for' => 'noticia.lista'));
    }
    
    public function excluirAction($id)
    {
        $noticia = Noticia::findFirst($id);
        if (!$noticia || !$noticia->delete()) {
            $this->flashSession->error('Ocorreu um erro inesperado.');
            return $this->response->redirect(array('for' => 'noticia.lista'));
        }
        $this->flashSession->success('Noticia excluida com sucesso.');
        return $this->response->redirect(array('for' => 'noticia.lista'));
    }
}