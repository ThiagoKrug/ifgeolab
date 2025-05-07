<?php
class QuestionarioForm extends Form
{
    private $crud;
    private $formtipo;
    private $action;

    public function __construct($formtipo, $id = null, $action = "", $nomeform = "")
    {
        $this->crud = new CRUD();
        $this->formtipo = $formtipo;
        $this->action = $action;
        // Configuração inicial do formulário
        parent::__construct($action, "POST", "multipart/form-data", "{$formtipo}", "col s12 m6");

        // Construir o formulário
        $this->buildForm($id, $nomeform);
    }

    public function buildForm($id, $nomeform)
    {
        $dados = [];
        if ($id) {
            $tabela = 'questoes';
            $colunaId = 'id_questao';
            $dados = ($this->crud->listar($tabela, [$colunaId => $id]))[0];
        }

        $this->addRow([
            $this->addInput("text", "nome", "Nome", !empty($dados['nome']) ? $dados['nome'] : "", ["class" => "validate"], "s6"),
            $this->addInput("custom", 'descricao', "", !empty($dados['descricao']) ? $dados['descricao'] : "", [
                "html" => '<div id="editor-container"> {{content_value}} </div>'
            ], "s12")
        ]);

        $this->addRow([
            $this->addInput("radio", "alternativas", "Alternativa A", "A", ["id" => "1"], "s2"),
            $this->addInput("radio", "alternativas", "Alternativa B", "B", ["id" => "2"], "s2"),
            $this->addInput("radio", "alternativas", "Alternativa C", "C", ["id" => "3"], "s2"),
            $this->addInput("radio", "alternativas", "Alternativa D", "D", ["id" => "4"], "s2"),
            $this->addInput("radio", "alternativas", "Alternativa E", "E", ["id" => "5"], "s2")
        ]);

        $this->addRow([
            $this->addInput("text", "alternativa1", "Alternativa A:", !empty($dados['alternativaA']) ? $dados['alternativaA'] : "", "", "s4")
        ]);
        $this->addRow([
            $this->addInput("text", "alternativa2", "Alternativa B:", !empty($dados['alternativaB']) ? $dados['alternativaB'] : "", "", "s4")
        ]);
        $this->addRow([
            $this->addInput("text", "alternativa3", "Alternativa C:", !empty($dados['alternativaC']) ? $dados['alternativaC'] : "", "", "s4")
        ]);
        $this->addRow([
            $this->addInput("text", "alternativa4", "Alternativa D:", !empty($dados['alternativaD']) ? $dados['alternativaD'] : "", "", "s4")
        ]);
        $this->addRow([
            $this->addInput("text", "alternativa5", "Alternativa E:", !empty($dados['alternativaE']) ? $dados['alternativaE'] : "", "", "s4")
        ]);

        $this->addRow([
            $this->addInput("submit", "$nomeform" . ucfirst($this->formtipo), "", "$nomeform", [
                "class" => "waves-effect waves-light btn green white-text"
            ], "s12")
        ]);
    }
}