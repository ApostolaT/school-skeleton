<?php
namespace School\Validator;

class ValidatorCollection implements \Iterator, \Countable
{
    private array   $validatorCollection;
    private int     $index;
    private int     $count;

    public function __construct()
    {
        $this->validatorCollection  = [];
        $this->index                = 0;
        $this->count                = 0;
    }

    public function addValidator(ValidatorInterface $validator): self
    {
        $this->validatorCollection[] = $validator;
        ++$this->count;
    }

    public function removeValidator(ValidatorInterface $validator): self
    {
        foreach ($this->validatorCollection as $key => $value) {
            if ($validator !== $value) {
                continue;
            }

            unset($this->validatorCollection[$key]);
            $this->validatorCollection = array_values($this->validatorCollection);
            --$this->count;
            break;
        }

        return $this;
    }

    public function current()
    {
        return $this->validatorCollection[$this->index];
    }

    public function next()
    {
        ++$this->index;
    }

    public function key()
    {
        return $this->index;
    }

    public function valid()
    {
        return $this->index < $this->count;
    }

    public function rewind()
    {
        $this->index = 0;
    }

    public function count()
    {
        return $this->count;
    }
}