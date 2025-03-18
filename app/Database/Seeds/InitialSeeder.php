<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        // Users Seeder
        $this->db->table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@busticket.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'phone' => '08123456789',
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->db->table('users')->insert([
            'name' => 'User Demo',
            'email' => 'user@busticket.com',
            'password' => password_hash('user123', PASSWORD_DEFAULT),
            'phone' => '08987654321',
            'role' => 'user',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Routes Seeder
        $routes = [
            [
                'origin' => 'Jakarta',
                'destination' => 'Bandung',
                'distance' => 150,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'origin' => 'Jakarta',
                'destination' => 'Surabaya',
                'distance' => 800,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'origin' => 'Jakarta',
                'destination' => 'Yogyakarta',
                'distance' => 450,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'origin' => 'Bandung',
                'destination' => 'Jakarta',
                'distance' => 150,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'origin' => 'Surabaya',
                'destination' => 'Jakarta',
                'distance' => 800,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('routes')->insertBatch($routes);

        // Buses Seeder
        $buses = [
            [
                'name' => 'Bus Ekonomi A',
                'plate_number' => 'B 1234 EKA',
                'type' => 'ekonomi',
                'capacity' => 45,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Bus Bisnis B',
                'plate_number' => 'B 5678 BSA',
                'type' => 'bisnis',
                'capacity' => 35,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Bus Eksekutif C',
                'plate_number' => 'B 9012 EKA',
                'type' => 'eksekutif',
                'capacity' => 25,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('buses')->insertBatch($buses);

        // Schedules Seeder
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        $dayAfterTomorrow = date('Y-m-d', strtotime('+2 days'));

        $schedules = [
            [
                'route_id' => 1, // Jakarta - Bandung
                'bus_id' => 1, // Bus Ekonomi A
                'departure_date' => $tomorrow,
                'departure_time' => '08:00:00',
                'arrival_time' => '11:00:00',
                'price' => 100000,
                'available_seats' => 45,
                'status' => 'scheduled',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'route_id' => 1, // Jakarta - Bandung
                'bus_id' => 2, // Bus Bisnis B
                'departure_date' => $tomorrow,
                'departure_time' => '10:00:00',
                'arrival_time' => '13:00:00',
                'price' => 150000,
                'available_seats' => 35,
                'status' => 'scheduled',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'route_id' => 2, // Jakarta - Surabaya
                'bus_id' => 3, // Bus Eksekutif C
                'departure_date' => $tomorrow,
                'departure_time' => '20:00:00',
                'arrival_time' => '08:00:00',
                'price' => 350000,
                'available_seats' => 25,
                'status' => 'scheduled',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'route_id' => 4, // Bandung - Jakarta
                'bus_id' => 1, // Bus Ekonomi A
                'departure_date' => $dayAfterTomorrow,
                'departure_time' => '08:00:00',
                'arrival_time' => '11:00:00',
                'price' => 100000,
                'available_seats' => 45,
                'status' => 'scheduled',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'route_id' => 3, // Jakarta - Yogyakarta
                'bus_id' => 2, // Bus Bisnis B
                'departure_date' => $dayAfterTomorrow,
                'departure_time' => '18:00:00',
                'arrival_time' => '04:00:00',
                'price' => 200000,
                'available_seats' => 35,
                'status' => 'scheduled',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        $this->db->table('schedules')->insertBatch($schedules);
    }
}