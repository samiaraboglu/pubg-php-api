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
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
