<?php

include "CRUD.php";
include "Form.php";
class MineralRochaForm extends Form
{
    private $crud;
    private $formtipo;
    private $action;

    public function __construct($formtipo, $id = null, $action = "", $idusuario = "", $sugestao = "", $nomeForm = "")
    {
        $this->crud = new CRUD();
        $this->formtipo = $formtipo;
        $this->action = $action;
        // Configuração inicial do formulário
        parent::__construct($action, "POST", "multipart/form-data", "{$formtipo}", "col s12 m6");

        // Construir o formulário
        $this->buildForm($id, $idusuario, $sugestao, $nomeForm);
    }

    private function getCategoriaOptions()
    {
        $categoriaTable = ($this->formtipo == 'rocha') ? 'catrocha' : 'catmineral';
        $categorias = $this->crud->listar($categoriaTable);

        $options = [];
        foreach ($categorias as $dados) {
            $options[$dados['idcat']] = htmlspecialchars($dados['nome']);
        }

        return $options;
    }

    public function buildForm($id, $idusuario, $sugestao, $nomeForm)
    {
        $dados = [];
        if ($id) {
            $tabela = ($this->formtipo == 'rocha') ? 'rocha' : 'mineral';
            $colunaId = ($this->formtipo == 'rocha') ? 'idrocha' : 'idmineral';
            $dados = ($this->crud->listar($tabela, [$colunaId => $id]))[0];
        }

        // Linha 1: Nome e Categoria
        $this->addRow([
            $this->addInput("text", "nome", "Nome", !empty($dados['nome']) ? $dados['nome'] : "", ["class" => "validate", "id" => "nome"], "s6"),
            $this->addInput("select", "idcat", "", !empty($dados['idcat']) ? $dados['idcat'] : "", [
                "options" => $this->getCategoriaOptions(),
                "class" => "select-dropdown",
                "id" => "cat"
            ], "s6")
        ]);



        // Linha 2: Campo hidden para sugestão, id do usuário e Descrição (editor)
        $this->addRow([
            $this->addInput("hidden", "sugestao", "", $sugestao),
            $this->addInput("hidden", "idusuario", "", $idusuario),
            $this->addInput("hidden", "id", "", !empty($id) ? $id  : ""),
            $this->addInput("hidden", "descricao", "", !empty($dados['descricao']) ? $dados['descricao']  : ""  , ["id" => "descricao"]),
            $this->addInput("custom", 'descricao', "", !empty($dados['descricao']) ? $dados['descricao'] : "", [
                "html" => '<div id="editor-container"> {{content_value}} </div>'
            ], "s12")
        ]);

        // Linha 3: Foto de Perfil e Objeto 3D
        $this->addRow([
            $this->addInput("custom", "", "", !empty($dados['img']) ? $dados['img']  : "", [
                "html" => '
                <div class="img-area" data-img="">
                    <i class="bx bxs-cloud-upload icon"></i>
                    <h3>Envie uma Foto de Perfil</h3>
                    <p>A Imagem não pode ser maior que <span>20MB</span></p>
                    <input name="arquivo" type="file" id="Capa" style="display: none;">
                </div>'
            ], "s6"),
            $this->addInput("file", "3d", "Objeto 3D:", !empty($dados['3d']) ? $dados['3d']  : "", ["id" => "3d"], "s6")
        ]);

        // Linha 5: Botão de envio
        $this->addRow([
            $this->addInput("submit", "$nomeForm" . ucfirst($this->formtipo), "", "$nomeForm", [
                "class" => "waves-effect waves-light btn green white-text"
            ], "s12")
        ]);
    }
}