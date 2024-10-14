<?php

namespace Database\Seeders;

use App\Models\Event;
use Database\Factories\EventFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            ['title' => 'Community Tree Planting', 'description' => 'Join us for a day of tree planting to help reforest our city parks.', 'event_date' => '2024-04-22 10:00:00', 'organized_by' => 'Green Earth Org', 'location' => 'Central Park', 'image' => 'images/events/seed/ev1.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Sustainable Gardening Workshop', 'description' => 'Learn how to garden sustainably using eco-friendly techniques.', 'event_date' => '2024-05-15 14:00:00', 'organized_by' => 'Eco Gardeners', 'location' => 'Eco Community Center', 'image' => 'images/events/seed/ev1.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Plant Swap Meet', 'description' => 'Swap your plants with fellow enthusiasts and discover new species.', 'event_date' => '2024-06-10 09:00:00', 'organized_by' => 'Plant Lovers Club', 'location' => 'Green Village Hall', 'image' => 'images/events/seed/ev1.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Indoor Plants Care Seminar', 'description' => 'Expert tips on how to care for indoor plants to keep them thriving.', 'event_date' => '2024-07-05 12:00:00', 'organized_by' => 'Indoor Green', 'location' => 'City Botanical Gardens', 'image' => 'images/events/seed/ev1.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Greenhouse Management Workshop', 'description' => 'Learn how to set up and manage your own greenhouse for year-round gardening.', 'event_date' => '2024-08-20 10:00:00', 'organized_by' => 'Urban Farmers Union', 'location' => 'Riverside Greenhouse', 'image' => 'images/events/seed/ev1.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Herb Gardening Basics', 'description' => 'Learn how to grow and maintain a thriving herb garden.', 'event_date' => '2024-09-12 16:00:00', 'organized_by' => 'Green Thumb', 'location' => 'Herb Haven Garden', 'image' => 'images/events/seed/ev2.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Native Plants Workshop', 'description' => 'Discover the benefits of growing native plants in your garden.', 'event_date' => '2024-10-05 13:00:00', 'organized_by' => 'Native Plant Society', 'location' => 'Wildflower Park', 'image' => 'images/events/seed/ev2.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Composting 101', 'description' => 'Learn how to turn your kitchen and yard waste into rich compost for your plants.', 'event_date' => '2024-10-15 09:00:00', 'organized_by' => 'Eco Farmers', 'location' => 'Community Garden', 'image' => 'images/events/seed/ev2.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Urban Farming Conference', 'description' => 'A two-day event focused on growing food in urban environments.', 'event_date' => '2024-11-01 09:00:00', 'organized_by' => 'City Growers Network', 'location' => 'Convention Center', 'image' => 'images/events/seed/ev2.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Rainwater Harvesting Workshop', 'description' => 'Learn how to collect and use rainwater to irrigate your garden.', 'event_date' => '2024-11-10 11:00:00', 'organized_by' => 'Green Water Solutions', 'location' => 'Eco Center', 'image' => 'images/events/seed/ev2.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Rare Plant Expo', 'description' => 'Explore and purchase rare and exotic plants from around the world.', 'event_date' => '2024-12-05 10:00:00', 'organized_by' => 'Rare Flora Society', 'location' => 'Botanical Exhibition Hall', 'image' => 'images/events/seed/ev3.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Community Garden Day', 'description' => 'Come together to help maintain the local community garden.', 'event_date' => '2024-12-20 09:00:00', 'organized_by' => 'Community Green Volunteers', 'location' => 'Sunnyvale Garden', 'image' => 'images/events/seed/ev3.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Houseplant Propagation Workshop', 'description' => 'Learn how to propagate your houseplants and grow new ones from cuttings.', 'event_date' => '2025-01-10 15:00:00', 'organized_by' => 'Home Growers Collective', 'location' => 'Plant Nursery', 'image' => 'images/events/seed/ev3.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Succulent Care & Design Workshop', 'description' => 'Get hands-on experience designing and caring for succulent arrangements.', 'event_date' => '2025-01-22 13:00:00', 'organized_by' => 'Succulent Society', 'location' => 'Garden Design Studio', 'image' => 'images/events/seed/ev3.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Green Roof Installation Seminar', 'description' => 'Learn about the benefits of green roofs and how to install one.', 'event_date' => '2025-02-12 10:00:00', 'organized_by' => 'Eco Builders', 'location' => 'City Eco Park', 'image' => 'images/events/seed/ev3.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Botanical Art Exhibition', 'description' => 'A display of artwork inspired by plants and nature.', 'event_date' => '2025-03-01 10:00:00', 'organized_by' => 'Green Arts Collective', 'location' => 'Art & Garden Museum', 'image' => 'images/events/seed/ev4.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Edible Landscape Design Workshop', 'description' => 'Learn how to design a beautiful and edible landscape.', 'event_date' => '2025-03-15 11:00:00', 'organized_by' => 'Edible Cities', 'location' => 'City Park Pavilion', 'image' => 'images/events/seed/ev4.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Plant-Based Cooking Class', 'description' => 'Discover delicious plant-based recipes in this hands-on cooking class.', 'event_date' => '2025-04-10 14:00:00', 'organized_by' => 'Green Chefs', 'location' => 'Healthy Living Kitchen', 'image' => 'images/events/seed/ev4.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Forest Bathing Experience', 'description' => 'Reconnect with nature through a guided forest bathing session.', 'event_date' => '2025-04-22 08:00:00', 'organized_by' => 'Nature Walkers', 'location' => 'Maplewood Forest', 'image' => 'images/events/seed/ev4.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
            ['title' => 'Permaculture Basics Workshop', 'description' => 'Learn the basics of permaculture and sustainable living.', 'event_date' => '2025-05-01 09:00:00', 'organized_by' => 'Green Futures', 'location' => 'Sustainable Living Center', 'image' => 'images/events/seed/ev4.png', 'manager_id' => 1, 'organizer_email' => 'waffaatta04@gmail.com'],
        ];
        
        //EventFactory::new()->count(count: 200)->create();

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}