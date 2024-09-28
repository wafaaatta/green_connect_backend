<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use App\Models\Article;
use App\Models\Event;
use App\Models\Manager;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function getSystemStatistics()
    {
        // Fetch articles with their categories
        $articles = Article::with('articleCategory')->get();
        $totalArticles = $articles->count();
        
        // Get the total count for other models
        $totalEvents = Event::count();
        $totalManagers = Manager::count();
        $totalUsers = User::count();
        $totalAnnounces = Announce::count();

        // Group users by month and count the number of users created each month
        $userGraph = User::select('id', 'created_at')
            ->get()
            ->groupBy(function($user) {
                return Carbon::parse($user->created_at)->format('Y-m'); // Group by year-month
            })
            ->map(function($group) {
                return $group->count(); // Count users in each group
            });

        // Group articles, events, and announces by month and count them
        $groupedStatistics = collect();

        // For events
        $groupedEvents = Event::select('id', 'created_at')
            ->get()
            ->groupBy(function($event) {
                return Carbon::parse($event->created_at)->format('Y-m'); // Group by year-month
            })
            ->map(function($group) {
                return $group->count();
            });

        // For articles
        $groupedArticles = Article::select('id', 'created_at')
            ->get()
            ->groupBy(function($article) {
                return Carbon::parse($article->created_at)->format('Y-m');
            })
            ->map(function($group) {
                return $group->count();
            });

        // For announces
        $groupedAnnounces = Announce::select('id', 'created_at')
            ->get()
            ->groupBy(function($announce) {
                return Carbon::parse($announce->created_at)->format('Y-m');
            })
            ->map(function($group) {
                return $group->count();
            });

        // Combine grouped results by month
        $groupedStatistics = $groupedEvents->keys()->merge($groupedArticles->keys())->merge($groupedAnnounces->keys())->unique()->sort()->map(function ($month) use ($groupedEvents, $groupedArticles, $groupedAnnounces) {
            return [
                'month' => $month,
                'events' => $groupedEvents->get($month, 0),
                'articles' => $groupedArticles->get($month, 0),
                'announces' => $groupedAnnounces->get($month, 0),
            ];
        });

        // Group articles by category name and count them
        $articlesByCategory = $articles->groupBy('articleCategory.name')
            ->map(function($group) {
                return $group->count(); // Count articles in each category
            });

        return response()->json([
            'statistics' => [
                'articles' => $totalArticles,
                'events' => $totalEvents,
                'managers' => $totalManagers,
                'users' => $totalUsers,
                'announces' => $totalAnnounces,
            ],
            'userGraph' => $userGraph->map(function ($count, $month) {
                return (object) [
                    'month' => $month,
                    'count' => $count,
                ];
            })->values(),
            'groupedStatistics' => $groupedStatistics->map(function ($data) {
                return (object) $data;
            })->values(),
            'articlesByCategory' => $articlesByCategory->map(function ($count, $categoryName) {
                return (object) [
                    'category' => $categoryName,
                    'count' => $count,
                ];
            })->values() // Return a clean list of categories and their article counts
        ]);
    }
}