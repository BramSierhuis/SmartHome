<?php
class Type
{
    public $id;
    public $name;
    public $description;
    public $is_input;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getIsInput(): bool
    {
        return $this->is_input;
    }

    /**
     * @param mixed $is_input
     */
    public function setIsInput($is_input): void
    {
        $this->is_input = $is_input;
    }
}