<?php

namespace Pubg\Object;

Class Lifetime
{
    /**
     * @var array
     */
    protected $data;

    /**
     * Set data
     *
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
