<?php
    
namespace Source;

use Exception;

class Search
{
    /**
     * max number of hotels to return
     */
    protected static $max_results = 12;
    /**
     * max distance in KM that a hotel can be from the user's location
     */
    protected static $distance_limit = 75;

    /**
     * Get nearby hotels and sort them by proximity or price per night
     * The source data is from the XLR8 API
     * @param $latitude
     * @param $longitude
     * @param $orderby - 'proximity' or 'pricepernight'
     * 
     * @return array
     * @throws \Exception
     */
    public static function getNearbyHotels($latitude, $longitude, $orderby = 'proximity')
    {
        $data = DataSource::getData();
        if (empty($data)) {
            throw new Exception('No data found');
        }

        $hotels = self::populateObjectsHotel($data, $latitude, $longitude);
        self::sortArray($hotels, $orderby);

        return self::formatResults($hotels);
    }

    protected static function populateObjectsHotel(array $data, $latitude, $longitude) : array
    {
        $hotels = [];

        foreach ($data as $item) {
            $distance = Distance::calculate($latitude, $longitude, (float) $item[1], (float) $item[2], 'K');
            if ($distance > self::$distance_limit) {
                continue;
            }
            
            $hotels[] = new Hotel($item[0], $item[1], $item[2], $item[3], $distance);
        }

        return $hotels;
    }

    protected static function sortArray(&$hotels, $orderby)
    {
        if ($orderby == 'pricepernight') {
            usort($hotels, function(Hotel $a, Hotel $b) {
                if ($a->getPricepernight() == $b->getPricepernight()) {
                    return 0;
                }
                return ($a->getPricepernight() < $b->getPricepernight()) ? -1 : 1;
            });
        } else {
            usort($hotels, function(Hotel $a, Hotel $b) {
                if ($a->getDistance() == $b->getDistance()) {
                    return 0;
                }
                return ($a->getDistance() < $b->getDistance()) ? -1 : 1;
            });
        }
    }

    protected static function formatResults($hotels) : string
    {
        $text = '';
        foreach ($hotels as $hotel) {
            if (self::$max_results == 0) {
                break;
            }

            $text .= $hotel->__toString() . '<br>';
            self::$max_results--;
        }

        return $text;
    }
}
?>