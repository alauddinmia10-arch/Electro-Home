<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sensors',
                'icon' => '🔬',
                'children' => [
                    'Temperature Sensor',
                    'Humidity Sensor',
                    'Motion Sensor',
                    'Ultrasonic Sensor',
                    'Gas Sensor',
                    'IR Sensor',
                    'Light Sensor',
                    'Pressure Sensor',
                ],
            ],
            [
                'name' => 'Batteries & Power',
                'icon' => '🔋',
                'children' => [
                    'Lithium Ion Battery',
                    'Lithium Polymer Battery',
                    'AA / AAA Battery',
                    '9V Battery',
                    'Battery Holder',
                    'Power Bank Module',
                    'Solar Panel',
                ],
            ],
            [
                'name' => 'Chargers & Adapters',
                'icon' => '🔌',
                'children' => [
                    'Battery Charger Module',
                    'USB Charger',
                    'DC Adapter',
                    'Wireless Charger',
                    'Fast Charger IC',
                ],
            ],
            [
                'name' => 'Microcontrollers',
                'icon' => '🖥️',
                'children' => [
                    'Arduino',
                    'ESP32 / ESP8266',
                    'Raspberry Pi',
                    'STM32',
                    'ATmega',
                    'PIC Microcontroller',
                ],
            ],
            [
                'name' => 'Motors & Drivers',
                'icon' => '⚙️',
                'children' => [
                    'DC Motor',
                    'Servo Motor',
                    'Stepper Motor',
                    'Motor Driver Module',
                    'Fan & Cooler',
                ],
            ],
            [
                'name' => 'Display & LED',
                'icon' => '💡',
                'children' => [
                    'LCD Display',
                    'OLED Display',
                    'LED Strip',
                    'Single LED',
                    'Seven Segment Display',
                    'TFT Display',
                ],
            ],
            [
                'name' => 'Communication Modules',
                'icon' => '📡',
                'children' => [
                    'Bluetooth Module',
                    'WiFi Module',
                    'RF Module',
                    'GSM / GPRS Module',
                    'LoRa Module',
                    'NFC / RFID Module',
                ],
            ],
            [
                'name' => 'Connectors & Cables',
                'icon' => '🔗',
                'children' => [
                    'Jumper Wire',
                    'USB Cable',
                    'Breadboard',
                    'PCB Board',
                    'Header Pin',
                    'Screw Terminal',
                ],
            ],
            [
                'name' => 'Resistors & Capacitors',
                'icon' => '⚡',
                'children' => [
                    'Resistor',
                    'Capacitor',
                    'Inductor',
                    'Potentiometer',
                    'Transistor',
                    'Diode',
                    'IC Chip',
                ],
            ],
            [
                'name' => 'Tools & Equipment',
                'icon' => '🔧',
                'children' => [
                    'Soldering Iron',
                    'Multimeter',
                    'Power Supply',
                    'Oscilloscope',
                    'Heat Shrink Tube',
                    'Solder Wire',
                ],
            ],
            [
                'name' => 'Robotics',
                'icon' => '🤖',
                'children' => [
                    'Robot Chassis',
                    'Wheels & Tracks',
                    'Gripper',
                    'Robotic Arm',
                    'Line Follower Kit',
                ],
            ],
            [
                'name' => 'Power Modules',
                'icon' => '🔋',
                'children' => [
                    'Buck Converter',
                    'Boost Converter',
                    'Voltage Regulator',
                    'Relay Module',
                    'Power Supply Module',
                ],
            ],
        ];

        $sortOrder = 1;
        foreach ($categories as $catData) {
            $parent = Category::firstOrCreate(
                ['slug' => Str::slug($catData['name'])],
                [
                    'name' => $catData['name'],
                    'icon' => $catData['icon'],
                    'sort_order' => $sortOrder++,
                    'status' => true,
                ]
            );

            $childOrder = 1;
            foreach ($catData['children'] as $childName) {
                Category::firstOrCreate(
                    ['slug' => Str::slug($childName)],
                    [
                        'parent_id' => $parent->id,
                        'name' => $childName,
                        'sort_order' => $childOrder++,
                        'status' => true,
                    ]
                );
            }
        }
    }
}
