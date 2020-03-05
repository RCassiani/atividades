<?php

class SelectField
{
    private $types = [
      1=> "Administrador",
      2=> "Gerente",
      3=> "Vendedor",
      4=> "Lojista"
    ];

    public function getFieldTipo() {
        $field = "<select name='tipo' id='tipo' required>";
        $field .= "<option value=''>Selecione...</option>";
        foreach ($this->types as $k => $v){
            $field .= "<option value='$k'>$v</option>";
        }
        $field .= "</select>";

        return $field;
    }
}