<?php

/**
 * Class Usuario
 */
class Usuario
{

    /**
     * @var string
     */
    private $filename = "registros.txt";

    /**
     * @var
     */
    public $nome;
    /**
     * @var
     */
    public $sobrenome;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $telefone;


    /**
     * @return string
     * @throws Exception
     */
    public function create()
    {
        try {

            //Primeiro registro
            if (!file_exists($this->filename)) {
                fopen($this->filename, "a");
            } //Próximos registros
            else {
                $linhasReg = file($this->filename); //Todos as linhas do arquivo
                foreach ($linhasReg as $l) {
                    $l = json_decode($l);
                    if ($l->email == $this->email)
                        throw new Exception("Não foi possível inserir! Email já cadastrado");
                }
            }

            $array = [
                'nome' => $this->nome,
                'sobrenome' => $this->sobrenome,
                'email' => $this->email,
                'telefone' => $this->telefone,
            ];

            file_put_contents($this->filename, json_encode($array) . "\n", FILE_APPEND);
            return $message = "Registro inserido";

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    public function update()
    {
        try {

            //Primeiro registro
            if (!file_exists($this->filename)) {
                http_response_code(404);
                throw new Exception("Não foi possível atualizar! Nenhum registro encontrado");
            } //Próximos registros
            else {
                $linhasReg = file($this->filename); //Todos as linhas do arquivo
                $newLines = '';
                $find = false;
                foreach ($linhasReg as $l) {
                    $l = json_decode($l);
                    if ($l->email == $this->email) {
                        $l->nome = $this->nome;
                        $l->sobrenome = $this->sobrenome;
                        $l->email = $this->email;
                        $l->telefone = $this->telefone;
                        $find = true;
                    }
                    $newLines .= json_encode($l) . "\n";
                }
            }

            if ($find) {
                file_put_contents($this->filename, $newLines);
                return $message = "Registro atualizado";
            } else {
                http_response_code(404);
                throw new Exception("Registro não encontrado");
            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    public function delete()
    {
        try {

            //Primeiro registro
            if (!file_exists($this->filename)) {
                http_response_code(404);
                throw new Exception("Não foi possível excluir! Nenhum registro encontrado");
            } //Próximos registros
            else {
                $linhasReg = file($this->filename); //Todos as linhas do arquivo
                $newLines = '';
                $find = false;
                foreach ($linhasReg as $l) {
                    $l = json_decode($l);
                    if ($l->email == $this->email) {
                        $find = true;
                    } else {
                        $newLines .= json_encode($l) . "\n";
                    }
                }
            }

            if ($find) {
                file_put_contents($this->filename, $newLines);
                return $message = "Registro excluido";
            } else {
                http_response_code(404);
                throw new Exception("Registro não encontrado");
            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return array
     * @throws Exception
     */
    public function listAll()
    {
        try {
            if (!file_exists($this->filename)) {
                http_response_code(404);
                throw new Exception("Nenhum registro encontrado!");
            } else {
                $registros = file($this->filename); //Todos as linhas do arquivo
                if ($registros) {
                    foreach ($registros as $r)
                        $array[] = json_decode($r);

                    return $array;
                } else {
                    http_response_code(404);
                    throw new Exception("Nenhum registro encontrado!");
                }
            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    public function checkPhoneData($data)
    {
        $lenght = strlen($data);
        return (($lenght == 10 || $lenght == 11) && ctype_digit($data));
    }

    /**
     * @param $data
     * @return mixed
     */
    public function checkEmailData($data)
    {
        return (filter_var($data, FILTER_VALIDATE_EMAIL));
    }

}
