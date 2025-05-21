<?php
namespace App\Helpers;

class Config
{
    private static $instance = null;
    private $config = [];
    
    private function __construct()
    {
        global $config;
        $this->config = $config;
    }
    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function get($key, $default = null)
    {
        $segments = explode('.', $key);
        $data = $this->config;
        
        foreach ($segments as $segment) {
            if (!isset($data[$segment])) {
                return $default;
            }
            $data = $data[$segment];
        }
        
        return $data;
    }
}
