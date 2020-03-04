<?php

/**
 * Class Core
 */
class Core
{
    /**
     * @var
     */
    public $allowMethods;
    /**
     * @var
     */
    public $requestMethod;

    /**
     * @return array
     */
    public function getAllowMethods()
    {
        return in_array($this->requestMethod, $this->allowMethods);
    }
}