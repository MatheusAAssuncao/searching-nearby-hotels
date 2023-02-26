# Nearby Hotels

## Description
Library to retrieve the list of hotels from one or more data sources and calculate the shortest distance or lowest price given a coordinate.

## A little context
John decided to spend the weekend away with his family, and to do that he needs to find a hotel nearby the chosen location. For John there are 2 important factors for the right hotel choice - location and price, therefore he needs to search places surrounding a specific location, identified by Latitude and Longitude and get the list of results ordered by proximity to the place or by price per night.

## Instructions
Clone the repository and run the following commands:

```sh
composer update
```

Then, you can use the library by running the following command:

```sh
Search::getNearbyHotels($latitude, $longitude, $orderby)
```

## Parameters
- $latitude
- $longitude
- $orderby (proximity or pricepernight)

## Sample output
- Hotel Lisbon, 1.7 KM, 23.56 EUR
- Hotel London, 8 KM, 11.56 EUR
- Hotel XPTO, 21.56 KM, 99.56 EUR

> Note: project suggested by the <a href="https://en.xlr8rms.com/" target="_blank">XLR8RMS</a> and developed by me (: