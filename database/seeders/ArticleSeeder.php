<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use Database\Factories\ArticleCategoryFactory;
use Database\Factories\ArticleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            'Indoor Plants' => [
                ['title' => 'The Best Low-Light Indoor Plants for Your Home', 'content' => 'Discover the top low-light indoor plants that thrive even in dark corners of your home.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 1, 'manager_id' => 1],
                ['title' => 'How to Create a Beautiful Indoor Plant Display', 'content' => 'Tips and tricks for arranging indoor plants to enhance your home decor.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 1, 'manager_id' => 1],
                ['title' => 'Caring for Indoor Plants During Winter', 'content' => 'Keep your indoor plants thriving during the colder months with these tips.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 1, 'manager_id' => 1],
                ['title' => 'The Best Indoor Plants for Improving Air Quality', 'content' => 'Learn which indoor plants can help purify the air in your home.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 1, 'manager_id' => 1],
                ['title' => 'How to Water Indoor Plants Properly', 'content' => 'Master the art of watering indoor plants to keep them healthy and happy.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 1, 'manager_id' => 1],
                ['title' => 'Best Plants for Indoor Hanging Baskets', 'content' => 'Explore the top plants that look stunning in indoor hanging baskets.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 1, 'manager_id' => 1],
                ['title' => 'How to Create a DIY Indoor Herb Garden', 'content' => 'Step-by-step guide to growing herbs indoors and enjoying fresh flavors all year long.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 1, 'manager_id' => 1],
                ['title' => 'The Best Indoor Plants for Beginners', 'content' => 'A guide to easy-care indoor plants that are perfect for beginners.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 1, 'manager_id' => 1],
            ],
        
            'Outdoor Gardening' => [
                ['title' => 'How to Start an Outdoor Vegetable Garden', 'content' => 'A complete guide to starting your own vegetable garden in your backyard.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 2, 'manager_id' => 1],
                ['title' => 'Top Perennials for Low-Maintenance Gardens', 'content' => 'Discover perennial plants that require minimal care and return year after year.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 2, 'manager_id' => 1],
                ['title' => 'Creating a Butterfly Garden: Best Plants to Attract Pollinators', 'content' => 'Learn how to attract butterflies and other pollinators with the right plants.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 2, 'manager_id' => 1],
                ['title' => 'How to Build Raised Garden Beds: A DIY Guide', 'content' => 'A step-by-step guide to building raised beds for your outdoor garden.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 2, 'manager_id' => 1],
                ['title' => 'The Best Plants for Shade Gardens', 'content' => 'Explore the best plants that thrive in shady outdoor garden areas.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 2, 'manager_id' => 1],
                ['title' => 'How to Start a Container Garden on Your Balcony', 'content' => 'Learn how to grow plants in containers, perfect for small outdoor spaces.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 2, 'manager_id' => 1],
                ['title' => 'Companion Planting for a Thriving Outdoor Garden', 'content' => 'Discover the benefits of planting certain species together in your garden.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 2, 'manager_id' => 1],
                ['title' => 'Organic Pest Control Solutions for Your Outdoor Garden', 'content' => 'Natural solutions to keep pests away from your plants.', 'image' => 'images/events/seed/ev1.png', 'article_category_id' => 2, 'manager_id' => 1],
            ],
        
            'Plant Care Tips' => [
                ['title' => 'The Ultimate Guide to Watering Your Plants Properly', 'content' => 'Learn the dos and don’ts of watering to keep your plants healthy.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 3, 'manager_id' => 1],
                ['title' => 'How to Prune Plants for Maximum Growth', 'content' => 'A guide to pruning your plants for healthier and bushier growth.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 3, 'manager_id' => 1],
                ['title' => 'The Importance of Fertilizing Your Plants', 'content' => 'Tips on how to choose and apply fertilizers to give your plants the nutrients they need.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 3, 'manager_id' => 1],
                ['title' => 'Top 5 Signs Your Plant Needs Repotting', 'content' => 'Learn when and how to repot your plants for optimal growth.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 3, 'manager_id' => 1],
                ['title' => 'The Best Ways to Care for Succulents', 'content' => 'Keep your succulents thriving with these essential care tips.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 3, 'manager_id' => 1],
                ['title' => 'How to Prevent and Treat Common Plant Diseases', 'content' => 'A guide to recognizing and treating diseases that affect plants.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 3, 'manager_id' => 1],
                ['title' => 'Using Mulch for Healthier Plants', 'content' => 'Learn how to use mulch to improve soil health and moisture retention.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 3, 'manager_id' => 1],
                ['title' => 'How to Keep Your Plants Healthy During a Heatwave', 'content' => 'Tips for keeping your plants hydrated and cool during hot weather.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 3, 'manager_id' => 1],
            ],
        
            'Sustainable Living' => [
                ['title' => 'How to Start Living a Zero-Waste Lifestyle', 'content' => 'Tips and tricks for reducing your waste and living sustainably.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 4, 'manager_id' => 1],
                ['title' => 'The Benefits of Sustainable Gardening', 'content' => 'Learn how sustainable gardening practices can benefit both you and the environment.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 4, 'manager_id' => 1],
                ['title' => 'How to Make Your Own Eco-Friendly Cleaning Products', 'content' => 'DIY recipes for non-toxic cleaning solutions.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 4, 'manager_id' => 1],
                ['title' => 'Composting at Home: A Beginner’s Guide', 'content' => 'How to turn kitchen scraps into nutrient-rich compost for your garden.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 4, 'manager_id' => 1],
                ['title' => 'The Basics of Rainwater Harvesting', 'content' => 'How to set up a system to collect and use rainwater.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 4, 'manager_id' => 1],
                ['title' => 'The Importance of Reducing Plastic Waste', 'content' => 'Learn the impact of plastic waste and how you can minimize it.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 4, 'manager_id' => 1],
                ['title' => 'How to Live Off the Grid Sustainably', 'content' => 'An introduction to off-grid living and self-sufficiency.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 4, 'manager_id' => 1],
                ['title' => 'The Role of Permaculture in Sustainable Living', 'content' => 'Discover how permaculture principles can guide a sustainable lifestyle.', 'image' => 'images/events/seed/ev2.png', 'article_category_id' => 4, 'manager_id' => 1],
            ],
        
            'Rare Plants' => [
                ['title' => 'The Most Exotic Rare Plants You Can Grow at Home', 'content' => 'A showcase of rare and exotic plants perfect for collectors.', 'image' => 'images/events/seed/ev3.png', 'article_category_id' => 5, 'manager_id' => 1],
                ['title' => 'How to Care for Carnivorous Plants', 'content' => 'Tips on growing and caring for carnivorous plants like Venus flytraps.', 'image' => 'images/events/seed/ev3.png', 'article_category_id' => 5, 'manager_id' => 1],
                ['title' => 'Rare Orchids and How to Grow Them', 'content' => 'A guide to cultivating rare orchid varieties at home.', 'image' => 'images/events/seed/ev3.png', 'article_category_id' => 5, 'manager_id' => 1],
                ['title' => 'Uncommon Cacti and Succulents for Your Collection', 'content' => 'Discover unique and hard-to-find cacti and succulents.', 'image' => 'images/events/seed/ev3.png', 'article_category_id' => 5, 'manager_id' => 1],
                ['title' => 'Growing Rare Tropical Plants in Non-Tropical Climates', 'content' => 'Learn how to adapt tropical plants to grow in different climates.', 'image' => 'images/events/seed/ev3.png', 'article_category_id' => 5, 'manager_id' => 1],
                ['title' => 'The World’s Most Expensive Plants and Why They’re So Prized', 'content' => 'Explore the most valuable plants in the world and what makes them special.', 'image' => 'images/events/seed/ev3.png', 'article_category_id' => 5, 'manager_id' => 1],
                ['title' => 'How to Propagate Rare Plants Successfully', 'content' => 'A step-by-step guide to propagating rare plants for growth and trade.', 'image' => 'images/events/seed/ev3.png', 'article_category_id' => 5, 'manager_id' => 1],
                ['title' => 'Conservation Efforts to Protect Rare Plant Species', 'content' => 'Learn about global efforts to save rare and endangered plant species.', 'image' => 'images/events/seed/ev3.png', 'article_category_id' => 5, 'manager_id' => 1],
            ],
        
            'Green Innovations' => [
                ['title' => 'The Latest Trends in Sustainable Technology', 'content' => 'An overview of cutting-edge green tech innovations.', 'image' => 'images/events/seed/ev4.png', 'article_category_id' => 6, 'manager_id' => 1],
                ['title' => 'Vertical Farming: A Revolution in Urban Agriculture', 'content' => 'Explore the benefits and future of vertical farming in cities.', 'image' => 'images/events/seed/ev4.png', 'article_category_id' => 6, 'manager_id' => 1],
                ['title' => 'The Role of AI in Sustainable Farming', 'content' => 'How artificial intelligence is shaping the future of agriculture.', 'image' => 'images/events/seed/ev4.png', 'article_category_id' => 6, 'manager_id' => 1],
                ['title' => 'Solar-Powered Greenhouses: Growing Off the Grid', 'content' => 'Learn about the rise of solar-powered greenhouses and their benefits.', 'image' => 'images/events/seed/ev4.png', 'article_category_id' => 6, 'manager_id' => 1],
                ['title' => 'Hydroponics: Growing Plants Without Soil', 'content' => 'A beginner’s guide to growing plants with hydroponic systems.', 'image' => 'images/events/seed/ev4.png', 'article_category_id' => 6, 'manager_id' => 1],
                ['title' => 'How Biodegradable Plastics are Changing the Future', 'content' => 'Discover the potential of biodegradable plastics in reducing waste.', 'image' => 'images/events/seed/ev4.png', 'article_category_id' => 6, 'manager_id' => 1],
                ['title' => 'The Future of Green Transportation', 'content' => 'An in-depth look at the latest developments in eco-friendly transportation.', 'image' => 'images/events/seed/ev4.png', 'article_category_id' => 6, 'manager_id' => 1],
                ['title' => 'How Smart Irrigation Systems are Saving Water', 'content' => 'Learn about intelligent irrigation systems that optimize water use in farming.', 'image' => 'smart_irrigation.jpg', 'article_category_id' => 6, 'manager_id' => 1],
            ]
        ];

        
        foreach ($articles as $category => $categoryArticles) {
            $categoryId = ArticleCategory::where('name', $category)->first()->id;
            foreach ($categoryArticles as $article) {
                Article::create([
                    'title' => $article['title'],
                    'content' => $article['content'],
                    'image' => $article['image'],
                    'article_category_id' => $categoryId,
                    'manager_id' => 1, // Assuming a manager with ID 1 exists
                ]);
            }
        }
        /*ArticleCategory::all()->each(function ($articleCategory) {
            ArticleFactory::new()->count(20)->create([
                'article_category_id' => $articleCategory->id,
                'manager_id' => 1
            ]);
        });*/
    }
}