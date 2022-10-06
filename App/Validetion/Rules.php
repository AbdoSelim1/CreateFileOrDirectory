<?php

namespace App\Validetion;

class Rules
{

    private array $massages = [];

    public function required($key): self
    {

        if ($key == "" || empty($key)) {
            $this->massages["required"][$this->varName($key)] = "This {$this->removeSlach($this->varName($key))} is Required";
        }

        return $this;
    }

    private function removeSlach(string $key): string
    {
        if (str_contains($key, '_')) {
            $key = str_replace("_", " ", $key);
        }
        return $key;
    }

    public function in(string $var, array $in): self
    {
        $not = "";
        foreach ($in as $key => $value) {
            if ($var === $value) {
                return $this;
            } else {
                $not .= $value . ",";
            }
        }
        if ($not != "") {
            $not = rtrim($not, ",");
            $this->massages['in'][$this->varName($var)]  = "This {$this->removeSlach($this->varName($var))}  Must be of {$not}";
        }


        return $this;
    }

    public function max(string $var, int $max = 20): self
    {
        $length = strlen($var);
        if ($length <= $max) {
            return $this;
        } else {
            $this->massages['max'][$this->varName($var)] = "This {$this->removeSlach($this->varName($var))}  Invalid , Must be less than {$max} Characters.";
        }
        return $this;
    }

    public function getMassages(): array
    {
        return $this->massages;
    }

    public static function getMass()
    {
        return (new self)->massages;
    }
    function varName($var)
    {
        foreach ($_POST as $var_name => $value) {
            if ($value === $var) {
                return $var_name;
            }
        }

        return false;
    }
}
