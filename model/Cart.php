<?php

class Cart {

    /**
     * Cart list
     * @var array
     */
    protected $_cart = [];

    /**
     * Cart constructor.
     */
    public function __construct()
    {
        $this->_cart = $_SESSION['cart'] ?? [];
    }

    /**
     * Get cart list
     *
     * @return array
     */
    public function getCart()
    {
        return $this->_cart;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        $total = 0;

        foreach ($this->getCart() as $item) {
            $total += ($item['product']['price'] * $item['quantity']);
        }

        return $total;
    }

    /**
     * Add product to cart
     *
     * @param string $product
     */
    public function addProduct(string $product)
    {
        $product = Products::getInstance()->getByName($product);

        if ($product) {
            if (isset($this->_cart[$product['name']])) {
                $this->_cart[$product['name']]['quantity']++;
            } else {
                $this->_cart[$product['name']] = [
                    'product' => $product,
                    'quantity' => 1
                ];
            }

            $this->_updateCart();
        }
    }

    /**
     * Delete product from cart
     *
     * @param string $product
     */
    public function deleteProduct(string $product)
    {
        $product = Products::getInstance()->getByName($product);

        if ($product) {
            if (isset($this->_cart[$product['name']])) {
                unset($this->_cart[$product['name']]);
            }

            $this->_updateCart();
        }
    }

    /**
     * Update cart and redirect
     */
    protected function _updateCart()
    {
        $_SESSION['cart'] = $this->_cart;

        if (isset($_SERVER['REQUEST_URI'])) {
            $requestUriParts = explode('?', $_SERVER['REQUEST_URI'], 2);
            $uri = $requestUriParts[0];

            header('Location: ' . $uri);
            exit;
        }
    }
}