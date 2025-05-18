<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Get all authors with their topics
        $authors = Author::with('topics')->get()->map(function($author) {
            // Convert the topics to badge format
            $badges = $author->topics->pluck('att_name')->toArray();
            
            // Construct image path - assuming filename only is stored in database
            $imagePath = null;
            if ($author->aut_photo) {
                // Check if it's a full URL
                if (filter_var($author->aut_photo, FILTER_VALIDATE_URL)) {
                    $imagePath = $author->aut_photo;
                } else {
                    // Construct path to public/images directory
                    $imagePath = asset('images/' . $author->aut_photo);
                }
            }
            
            return [
                'id' => $author->aut_id,
                'name' => $author->aut_name,
                'image' => $imagePath,
                'description' => $author->aut_body,
                'badges' => $badges
            ];
        });

        $newsletters = Newsletter::with('categories')->get()->map(function($newsletter) {
            $categories = $newsletter->categories->pluck('cat_name')->toArray();

            return [
                'id' => $newsletter->new_id,
                'title' => $newsletter->new_title,
                'frequency' => Newsletter::$frequencyOptions[$newsletter->new_frequency],
                'hour' => $newsletter->new_hour,
                'icon' => $newsletter->new_icon,
                'estimate_date' => $newsletter->new_estimate_date,
                'status' => $newsletter->new_status,
                'body' => $newsletter->new_body,
                'categories' => $categories,
                'author' => $newsletter->authors->pluck('aut_name')->toArray()[0]
            ];
        });

        return Inertia::render('Home', [
            'authors' => $authors,
            'newsletters' => $newsletters
        ]);
    }
} 