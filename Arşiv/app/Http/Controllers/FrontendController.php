<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Page;
use App\Models\Bank;
use App\Services\API;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function __construct(private API $api)
    {
    }

    public function welcome()
    {
        $key = 'credits_list_payload_v3';
        $payload = Cache::get($key);

        if (!is_array($payload)) {
            $payload = $this->api->get('api/credits/list');
            if ($payload !== []) {
                // Remove specified bank ID
                $payload['data'] = array_filter($payload['data'], function ($item) {
                    return $item['credit_type'] === 'Festgeld' && $item['bank_id'] !== '9b998fb1-00a2-4481-9c40-03a5ccbf7c85';
                });

                Cache::put($key, $payload, 60);
            }
        }

        $offers = is_array($payload) && isset($payload['data']) ? $payload['data'] : [];

        // Final cleaning (ensure it's an array and sorted)
        if (!is_array($offers))
            $offers = [];

        // Remove another specific ID mentioned in JS: 5fcc7312-7754-4a1e-96fd-53e70f3b1514
        $offers = array_filter($offers, function ($bank) {
            return ($bank['id'] ?? '') !== "5fcc7312-7754-4a1e-96fd-53e70f3b1514";
        });

        // Sort by interest rate desc as in JS
        usort($offers, function ($a, $b) {
            return (float) ($b['interest_rate'] ?? 0) <=> (float) ($a['interest_rate'] ?? 0);
        });

        $title = config('settings.site_title');
        $description = config('settings.site_description');

        $latestPosts = BlogPost::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        $latestServices = Service::where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->limit(3)
            ->get();

        return view('welcome', compact('offers', 'title', 'description', 'latestPosts', 'latestServices'));
    }

    public function tagesgeld()
    {
        $key = 'credits_tagesgeld_payload_v1';
        $payload = Cache::get($key);

        if (!is_array($payload)) {
            $payload = $this->api->get('api/credits/list');
            if (!empty($payload)) {
                $payload['data'] = array_filter($payload['data'], function ($item) {
                    return $item['credit_type'] === 'Tagesgeld';
                });
                Cache::put($key, $payload, 60);
            }
        }

        $offers = is_array($payload) && isset($payload['data']) ? $payload['data'] : [];

        if (!is_array($offers)) {
            $offers = [];
        }

        usort($offers, function ($a, $b) {
            return (float) ($b['interest_rate'] ?? 0) <=> (float) ($a['interest_rate'] ?? 0);
        });

        $title = 'Tagesgeld Vergleich 2025 | Banken Online Vergleich';
        $description = 'Vergleichen Sie die besten Tagesgeld-Angebote und sichern Sie sich die höchsten Zinsen für Ihr flexibles Tagesgeldkonto.';

        return view('tagesgeld', compact('offers', 'title', 'description'));
    }

    public function bankIndex()
    {
        $key = 'credits_list_payload_v3';
        $payload = Cache::get($key);

        if (!is_array($payload)) {
            $payload = $this->api->get('api/credits/list');
            if ($payload !== []) {
                // Remove specified bank ID
                $payload['data'] = array_filter($payload['data'], function ($item) {
                    return $item['bank_id'] !== '9b998fb1-00a2-4481-9c40-03a5ccbf7c85';
                });
                Cache::put($key, $payload, 60);
            }
        }

        $offers = is_array($payload) && isset($payload['data']) ? $payload['data'] : [];

        $banks = [];
        $bankIdsFromApi = [];

        foreach ($offers as $offer) {
            if (isset($offer['banks']) && !empty($offer['banks']['id'])) {
                $bankIdsFromApi[] = $offer['banks']['id'];
            }
        }
        $bankIdsFromApi = array_unique($bankIdsFromApi);

        // Get local descriptions
        $localDescriptions = Bank::whereIn('bank_id', $bankIdsFromApi)->get()->pluck('description', 'bank_id')->toArray();

        $seenBankIds = [];
        foreach ($offers as $offer) {
            if (isset($offer['banks']) && !empty($offer['banks']['id'])) {
                $bankId = $offer['banks']['id'];
                if (!in_array($bankId, $seenBankIds)) {
                    $seenBankIds[] = $bankId;
                    $banks[] = [
                        'id' => $bankId,
                        'name' => $offer['banks']['name'] ?? 'N/A',
                        'logo' => $offer['banks']['logo_url'] ?? '',
                        'description' => $localDescriptions[$bankId] ?? ($offer['banks']['description'] ?? 'Ein renommiertes europäisches Finanzinstitut, das für Stabilität, erstklassigen Service und attraktive Anlagekonditionen steht. Durch die Einbindung in das europäische Einlagensicherungssystem bietet es Anlegern ein Höchstmaß an Sicherheit.'),
                        'country' => $offer['banks']['country_name'] ?? ($offer['banks']['country'] ?? ''),
                    ];
                }
            }
        }

        // Sort banks by name
        usort($banks, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        $title = "Unsere Partnerbanken | Banken Online Vergleich";
        $description = "Übersicht unserer erstklassigen Partnerbanken aus ganz Europa. Vergleichen Sie Angebote von renommierten Instituten mit höchster Sicherheit.";

        return view('banken', compact('banks', 'title', 'description'));
    }

    public function blogIndex()
    {
        $posts = Cache::remember('public_blog_posts_v2', 3600, function () {
            return BlogPost::where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->get();
        });

        // Fail-safe for serialization issues
        if ($posts instanceof \__PHP_Incomplete_Class) {
            Cache::forget('public_blog_posts_v2');
            return redirect(request()->fullUrl());
        }

        $title = "Blog | Banken Online Vergleich";
        $description = "Aktuelle News & Ratgeber zu Festgeld, Tagesgeld und nachhaltigen Finanzstrategien. Banken Online Vergleich";

        return view('blog.index', compact('posts', 'title', 'description'));
    }

    public function blogShow($slug)
    {
        $post = Cache::remember('public_blog_post_v2_' . $slug, 3600, function () use ($slug) {
            return BlogPost::where('slug', $slug)->where('status', 'published')->firstOrFail();
        });

        if ($post instanceof \__PHP_Incomplete_Class) {
            Cache::forget('public_blog_post_v2_' . $slug);
            return redirect(request()->fullUrl());
        }

        $title = $post->meta_title ?: $post->title;
        $description = $post->meta_description ?: $post->excerpt;

        return view('blog.show', compact('post', 'title', 'description', 'slug'));
    }

    public function serviceIndex()
    {
        $services = Service::where('status', 'active')
            ->orderBy('sort_order')
            ->get();

        $title = "Services | Banken Online Vergleich";
        $description = "Professionelle Finanzservices mit Fokus auf Sicherheit, Transparenz und Performance.";

        return view('services.index', compact('services', 'title', 'description'));
    }

    public function showDynamicContent($slug)
    {
        // 1. Try Service
        $service = Service::where('slug', $slug)
            ->where('status', 'active')
            ->first();

        if ($service) {
            $title = $service->meta_title ?: ($service->title . ' | Services');
            $description = $service->meta_description ?: $service->excerpt;
            if ($description === null || trim((string) $description) === '') {
                $description = Str::limit(strip_tags((string) $service->content), 160);
            }

            return view('services.show', compact('service', 'title', 'description', 'slug'));
        }

        // 2. Try Page
        $page = Page::where('slug', $slug)->where('status', 'published')->first();

        if (!$page) {
            // Try absolute match for sitemap style slugs
            $page = Page::where('slug', '/' . $slug)->where('status', 'published')->first();
        }

        if ($page) {
            $title = $page->meta_title ?: $page->title;
            $description = $page->meta_description ?: 'Banken Online Vergleich';

            return view('pages.show', compact('page', 'title', 'description', 'slug'));
        }

        abort(404);
    }

    public function serviceShow($slug)
    {
        return $this->showDynamicContent($slug);
    }

    public function pageShow($slug)
    {
        return $this->showDynamicContent($slug);
    }

    public function sitemap()
    {
        $blogs = BlogPost::where('status', 'published')->orderBy('updated_at', 'desc')->get();
        $services = Service::where('status', 'active')->orderBy('updated_at', 'desc')->get();
        $pages = Page::where('status', 'published')->orderBy('updated_at', 'desc')->get();

        return response()->view('sitemap', compact('blogs', 'services', 'pages'))
            ->header('Content-Type', 'text/xml');
    }
}
