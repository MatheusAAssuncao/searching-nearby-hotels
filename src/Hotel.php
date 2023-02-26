<?php
    
namespace Source;

class Hotel {
    protected $name;
    protected $latitude;
    protected $longitude;
    protected $pricepernight;
    protected $distance;
    
    public function __construct($name, $latitude, $longitude, $pricepernight, $distance) {
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->pricepernight = $pricepernight;
        $this->distance = $distance;
    }

    public function getName() {
        return $this->name;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function getPricepernight() {
        return $this->pricepernight;
    }

    public function getDistance() {
        return $this->distance;
    }

    public function __toString() {
        return $this->name . ', ' . round($this->distance, 2) . ' KM, ' . number_format($this->pricepernight, 2) . ' EUR';
    }
}
?>