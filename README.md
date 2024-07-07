# Technical Interview Challenge 1

## Installation

1. Install docker compose https://docs.docker.com/compose/install/#scenario-one-install-docker-desktop
2. Clone the repository
2. Run `docker-compose up`
4. Run `docker-compose exec my-app composer install -o`
3. Run `docker-compose exec my-app php artisan migrate`
4. Load in browser http://localhost:8081

## Assumptions and Actions taken

1. **Practical Scenario with Aisles:**
   - The parking lot is designed with practical considerations, including aisles for vehicle movement.
   - Aisles are necessary for vehicles to move in and out of parking spots efficiently.
   - There are 2 rows of parking spots between 2 aisles

2. **Parking a van:**
   - When parking a van the the spot provided within the post request is considered the 1st spot to be occupied
   - Vans can park horizontally, occupying three consecutive regular spots.

4. **Caching Mechanism:**
   - Redis is used for caching the parking lot data to enhance performance.
   - The cache is cleared whenever a vehicle is parked or unparked to ensure data consistency.

5. **Vehicle Types and Parking Logic:**
   - Vehicles can be of three types: car, motorcycle, or van.
   - Each type has specific parking logic:
     - Motorcycles can park in any unoccupied spot.
     - Cars can park in any unoccupied regular spot.
     - Vans can park in any three consecutive unoccupied regular spots.

7. **Data Representation:**
   - The parking lot data is represented in a grid format, grouped by rows.
   - Each spot in the grid is defined by its row and column position, type, and occupancy status.

8. **Cache Duration:**
   - The parking lot data is cached for a duration of 60 minutes to improve performance.

## Seeding Data

Run

```
php artian db:seed
```

## UI

A rough representation of the park can be seen at 

/parking-lot

## API Endpoints

### Get Parking Lot Data

**GET** `/api/parking-lot`

Retrieve the current state of the parking lot, grouped by rows.

### Park a Vehicle

**POST** `/api/parking-spot/{id}/park`

Park a vehicle in a specific parking spot.

#### Request Body

```json
{
    "vehicle_type": "car"
}
```

- `vehicle_type` can be `car`, `motorcycle`, or `van`.

### Unpark a Vehicle

**POST** `/api/parking-spot/{id}/unpark`

Unpark a vehicle from a specific parking spot.

Unlike the parking scenario for vans, if any of the 3 parking spots are given to unpark the system will automatically detect if it is a van that is parked within the spot and will vacate the other respective parking spots