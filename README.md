# Guest House Room Booking Application

A simple room booking system where customers can browse available rooms, view details and images, and make bookings. House owners can add new properties and rooms, manage details, and monitor bookings.


## How to Run

1. Clone the repository to your local machine.
2. Import the SQL script to create the database and tables.
3. Configure the database connection in the PHP files.
4. Open the application in a web browser.


## Features

### Customer Module

- **Login**: Customers can log in to their accounts.

- **Availability Calendar**: Customers can view an availability calendar to check the availability of rooms on specific dates.

- **Room Booking**: Customers can choose available rooms on selected dates, enter personal details (name, check-in and check-out dates, email, and phone number), and make a booking. The booked room will be blocked for others.

- **Image Carousel**: Customers can view images of the rooms in a carousel format.

### Owner Module

- **Login**: Owners can log in to their accounts.

- **Add New Properties and Rooms**: Owners can add new properties and rooms, providing details such as property name, room type, amenities, and images.

- **Manage Room Details**: Owners can edit or delete existing rooms, set minimum and maximum booking periods, and specify the rent per day.

- **Monitor Bookings**: Owners can view bookings made for their properties, including customer details, check-in and check-out dates, and booking status.

## Technologies Used

- **Frontend**: [Bootstrap](https://getbootstrap.com/) for a responsive and clean user interface.

- **Backend**: Core PHP for server-side functionality.

- **Database**: MySQL for data storage.

## Database Schema

### Users Table

- **id**: Unique identifier for the user.
- **email**: Email address for user registration and communication.
- **pass**: Password for user authentication (securely hashed and salted).
- **contact**: Mobile number for contact information.
- **role**: Indicates whether the user is a house owner or a customer.
# Rooms Table
- **id**: Unique identifier for the room.
- **user_id**: Foreign key referencing the owner's user ID.
- **property_name**: Name of the property.
- **room_number**: Unique identifier for each room within a property.
- **room_type**: Type of the room (e.g., single, double, suite).
- **num_of_beds**: Number of beds in the room.
- **floor_size_sqft**: Floor size of the room.
- **min_booking_period**: Minimum booking period allowed.
- **max_booking_period**: Maximum booking period allowed.
- **rent_per_day**: Cost per day for renting the room.
- **address**: Property address.
- **city**: Property city.
- **country**: Property country.
- **contact_name**: Contact name for the property.
- **contact_email**: Contact email for the property.
- **contact_phone**: Contact phone for the property.
- **amenities**: List of amenities in the room.
- **additional_details**: Any additional details about the room.
- **photo_paths**: Paths to photos of the room.
- **status**: Status of the room (e.g., available, booked).

# Bookings Table
- **booking_id**: Unique identifier for the booking.
- **user_id**: Foreign key referencing the customer's user ID.
- **owner_id**: Foreign key referencing the owner's user ID.
- **room_number**: Foreign key referencing the room's room number.
- **checkin_date**: Date of check-in for the booking.
- **checkout_date**: Date of check-out for the booking.
- **adults**: Number of adults in the booking.
- **children**: Number of children in the booking.
- **property_name**: Name of the property booked.
- **customer_name**: Name of the customer making the booking.
- **customer_email**: Email of the customer making the booking.
- **customer_phone**: Phone number of the customer making the booking.
- **booking_date**: Date when the booking was made.
- **status**: Status of the booking (e.g., confirmed, canceled).

## Technologies Used
- HTML5
- Bootstrap5
- CSS
- PHP
- JavaScript
- jQuery
- mySQL
- Alertify.js
- SweetAlert2.js
- fullcalendar.js
