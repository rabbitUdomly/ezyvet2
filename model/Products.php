<?php

class Products {

    /**
     * Class Instance
     * @var Products
     */
    protected static $_instance = null;

    /**
     * products list
     * @var array
     */
    protected $_products = [];

    /**
     * Get class instance
     *
     * @return Products
     */
    public static function getInstance()
    {
        if (static::$_instance === null) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

    /**
     * Products constructor
     */
    protected function __construct()
    {
    }

    /**
     * Products clone
     */
    protected function __clone()
    {
    }

    /**
     * Set products
     *
     * @param array $products
     */
    public function setProducts(array $products)
    {
        $this->_products = $products;
    }

    /**
     * Get products
     *
     * @return array
     */
    public function getProducts()
    {
        return $this->_products;
    }

    /**
     * Get product by name
     *
     * @param string $name
     * @return false|array
     */
    public function getByName(string $name)
    {
        $name = trim(strtolower($name));

        foreach ($this->getProducts() as $product) {
            if ($name == strtolower($product['name'])) {
                return $product;
            }
        }

        return false;
    }

    /**
     * Displayed price with 2 decimal places
     *
     * @param float $price
     * @return string
     */
    public static function priceNormalize(float $price)
    {
        return '$' . number_format($price, 2, '.', '');
    }
}