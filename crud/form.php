<?php
class Form
{
    private $action;
    private $method;
    private $enctype;
    private $id;
    private $class;
    private $rows = [];
    private $formtipo;

    public function __construct($action = "", $method = "POST", $enctype = "multipart/form-data", $formtipo = "", $class = "col s12 m6")
    {
        $this->action = $action;
        $this->method = $method;
        $this->enctype = $enctype;
        $this->formtipo = $formtipo;
        $this->id = "cad{$formtipo}";
        $this->class = $class;
    }

    public function addRow(array $inputs = [])
    {
        $this->rows[] = $inputs;
    }

    public function addInput($type, $name, $label = "", $value = "", $attributes = [], $colSize = "s12", $customClass = "input-field col")
    {
        return [
            'type' => $type,
            'name' => $name,
            'label' => $label,
            'value' => htmlspecialchars($value, ENT_QUOTES, 'UTF-8'),
            'attributes' => $attributes,
            'customClass' => $customClass,
            'colSize' => $colSize
        ];
    }
    public function render()
    {
        $formHTML = "<form action='{$this->action}' method='{$this->method}' enctype='{$this->enctype}' id='{$this->id}' class='{$this->class}'>\n";

        foreach ($this->rows as $row) {
            $formHTML .= "\t<div class='row'>\n";
            foreach ($row as $input) {
                // Define a classe personalizada e o tamanho da coluna
                $customClass = $input['customClass'];
                $colSize = $input['colSize'];

                // Não aplica a classe input-field para inputs do tipo hidden
                if ($input['type'] !== 'hidden') {
                    $formHTML .= "\t\t<div class='{$customClass} {$colSize}'>\n";
                }

                if ($input['type'] === 'custom') {

                    $customHtml = str_replace("{{content_value}}", $input['value'], $input['attributes']['html']);

                    $formHTML .= "\t\t\t" . $customHtml . "\n";
                } else {
                    if (!empty($input['label'])) {
                        $formHTML .= "\t\t\t<label for='{$input['name']}'>{$input['label']}</label>\n";
                    }

                    $attributesString = $this->parseAttributes($input['attributes']);

                    switch ($input['type']) {
                        case "select":
                            $formHTML .= $this->renderSelect($input['name'], $input['value'], $attributesString, $input['attributes']);
                            break;
                        case "textarea":
                            $formHTML .= "\t\t\t<textarea name='{$input['name']}' id='{$input['name']}' {$attributesString}>{$input['value']}</textarea>\n";
                            break;
                        case "hidden":
                            $formHTML .= "\t\t\t<input type='{$input['type']}' name='{$input['name']}' value='{$input['value']}' id='{$input['name']}' {$attributesString}>\n";
                            break;
                        default:
                            $formHTML .= "\t\t\t<input type='{$input['type']}' name='{$input['name']}' value='{$input['value']}' id='{$input['name']}' {$attributesString}>\n";
                    }
                }

                if ($input['type'] !== 'hidden') {
                    $formHTML .= "\t\t</div>\n";
                }
            }
            $formHTML .= "\t</div>\n";
        }

        $formHTML .= "</form>\n";
        return $formHTML;
    }

    private function renderSelect($name, $selectedValue, $attributesString, $attributes)
    {
        $html = "<select name='{$name}' id='{$name}' {$attributesString}>\n";

        if (isset($attributes['options']) && is_array($attributes['options'])) {
            foreach ($attributes['options'] as $value => $label) {
                $selected = ($value == $selectedValue) ? "selected" : "";
                $html .= "<option value='{$value}' {$selected}>{$label}</option>\n";
            }
        }

        $html .= "</select>\n";
        return $html;
    }

    private function parseAttributes($attributes)
    {
        $attributesString = "";
        if (is_array($attributes)) {
            foreach ($attributes as $key => $value) {
                if ($key !== 'options') {
                    $attributesString .= "{$key}='" . htmlspecialchars($value) . "' ";
                }
            }
        }
        return $attributesString;
    }
}
