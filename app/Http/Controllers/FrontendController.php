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

        // Only keep festgeld-tier-1, festgeld-tier-2, and festgeld-tier-3 offers
        $offers = array_filter($offers, function ($offer) {
            $bankName = strtolower($offer['banks']['name'] ?? '');
            return str_contains($bankName, 'festgeld-tier-1') ||
                   str_contains($bankName, 'festgeld-tier-2') ||
                   str_contains($bankName, 'festgeld-tier-3');
        });

        // Sort by interest rate desc as in JS
        usort($offers, function ($a, $b) {
            return (float) ($b['interest_rate'] ?? 0) <=> (float) ($a['interest_rate'] ?? 0);
        });

        // Setup the default/fallback tiers configuration
        $tiers = [
            'bronze' => [
                'key' => 'bronze',
                'label' => 'Festgeld',
                'range' => '10.000 € – 75.000 €',
                'rate' => 3.20,
                'amount' => 25000,
                'color' => '#cd7f32',
                'glow' => 'rgba(205,127,50,0.25)',
                'border' => 'rgba(205,127,50,0.6)',
                'id' => '',
                'bank_id' => '',
                'bank_logo' => '',
            ],
            'gold' => [
                'key' => 'gold',
                'label' => 'Festgeld',
                'range' => '75.000 € – 150.000 €',
                'rate' => 3.50,
                'amount' => 75000,
                'color' => '#d4a017',
                'glow' => 'rgba(212,160,23,0.25)',
                'border' => 'rgba(212,160,23,0.5)',
                'id' => '',
                'bank_id' => '',
                'bank_logo' => '',
            ],
            'plat' => [
                'key' => 'plat',
                'label' => 'Festgeld',
                'range' => '150.000 € +',
                'rate' => 4.65,
                'amount' => 150000,
                'color' => '#a8b8c8',
                'glow' => 'rgba(168,184,200,0.15)',
                'border' => 'rgba(168,184,200,0.25)',
                'id' => '',
                'bank_id' => '',
                'bank_logo' => '',
            ],
        ];

        // Map API data if available
        foreach ($offers as $offer) {
            $bankName = strtolower($offer['banks']['name'] ?? '');
            if (str_contains($bankName, 'festgeld-tier-1')) {
                $tiers['bronze']['rate'] = (float) ($offer['interest_rate'] ?? 3.20);
                $tiers['bronze']['id'] = $offer['id'] ?? '';
                $tiers['bronze']['bank_id'] = $offer['bank_id'] ?? '';
                $tiers['bronze']['bank_logo'] = $offer['banks']['logo_url'] ?? '';
            } elseif (str_contains($bankName, 'festgeld-tier-2')) {
                $tiers['gold']['rate'] = (float) ($offer['interest_rate'] ?? 3.50);
                $tiers['gold']['id'] = $offer['id'] ?? '';
                $tiers['gold']['bank_id'] = $offer['bank_id'] ?? '';
                $tiers['gold']['bank_logo'] = $offer['banks']['logo_url'] ?? '';
            } elseif (str_contains($bankName, 'festgeld-tier-3')) {
                $tiers['plat']['rate'] = (float) ($offer['interest_rate'] ?? 3.65);
                $tiers['plat']['id'] = $offer['id'] ?? '';
                $tiers['plat']['bank_id'] = $offer['bank_id'] ?? '';
                $tiers['plat']['bank_logo'] = $offer['banks']['logo_url'] ?? '';
            }
        }

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

        return view('welcome', compact('offers', 'title', 'description', 'latestPosts', 'latestServices', 'tiers'));
    }

    public function tagesgeld()
    {
        $key = 'credits_list_raw_v1';
        $payload = Cache::get($key);
        if (!is_array($payload)) {
            $payload = $this->api->get('api/credits/list');
            if ($payload !== []) {
                Cache::put($key, $payload, 60);
            }
        }

        $offers = is_array($payload) && isset($payload['data']) ? $payload['data'] : [];

        if (!is_array($offers)) {
            $offers = [];
        }

        // Filter for Tagesgeld type
        $offers = array_filter($offers, function ($item) {
            return ($item['credit_type'] ?? '') === 'Tagesgeld';
        });

        usort($offers, function ($a, $b) {
            return (float) ($b['interest_rate'] ?? 0) <=> (float) ($a['interest_rate'] ?? 0);
        });

        $bronzeColor = '#2563eb'; // Blue for festgeld-jetztvergleichen.com

        // Setup the default/fallback tiers configuration for Tagesgeld
        $tiers = [
            'bronze' => [
                'key' => 'bronze',
                'label' => 'Tagesgeld',
                'range' => '10.000 € – 75.000 €',
                'rate' => 2.80,
                'amount' => 25000,
                'color' => $bronzeColor,
                'glow' => 'rgba(205,127,50,0.25)',
                'border' => 'rgba(205,127,50,0.6)',
                'id' => '',
                'bank_id' => '',
                'bank_logo' => '',
            ],
            'gold' => [
                'key' => 'gold',
                'label' => 'Tagesgeld',
                'range' => '75.000 € – 150.000 €',
                'rate' => 3.10,
                'amount' => 75000,
                'color' => '#d4a017',
                'glow' => 'rgba(212,160,23,0.25)',
                'border' => 'rgba(212,160,23,0.5)',
                'id' => '',
                'bank_id' => '',
                'bank_logo' => '',
            ],
            'plat' => [
                'key' => 'plat',
                'label' => 'Tagesgeld',
                'range' => '150.000 € +',
                'rate' => 3.30,
                'amount' => 150000,
                'color' => '#a8b8c8',
                'glow' => 'rgba(168,184,200,0.15)',
                'border' => 'rgba(168,184,200,0.25)',
                'id' => '',
                'bank_id' => '',
                'bank_logo' => '',
            ],
        ];

        // Map API data if available
        $mappedKeys = [];
        foreach ($offers as $offer) {
            $bankName = strtolower($offer['banks']['name'] ?? '');
            if (str_contains($bankName, 'tagesgeld-1')) {
                $tiers['bronze']['rate'] = (float) ($offer['interest_rate'] ?? 2.80);
                $tiers['bronze']['id'] = $offer['id'] ?? '';
                $tiers['bronze']['bank_id'] = $offer['bank_id'] ?? '';
                $tiers['bronze']['bank_logo'] = $offer['banks']['logo_url'] ?? '';
                $mappedKeys['bronze'] = true;
            } elseif (str_contains($bankName, 'tagesgeld-2')) {
                $tiers['gold']['rate'] = (float) ($offer['interest_rate'] ?? 3.10);
                $tiers['gold']['id'] = $offer['id'] ?? '';
                $tiers['gold']['bank_id'] = $offer['bank_id'] ?? '';
                $tiers['gold']['bank_logo'] = $offer['banks']['logo_url'] ?? '';
                $mappedKeys['gold'] = true;
            } elseif (str_contains($bankName, 'tagesgeld-3')) {
                $tiers['plat']['rate'] = (float) ($offer['interest_rate'] ?? 3.30);
                $tiers['plat']['id'] = $offer['id'] ?? '';
                $tiers['plat']['bank_id'] = $offer['bank_id'] ?? '';
                $tiers['plat']['bank_logo'] = $offer['banks']['logo_url'] ?? '';
                $mappedKeys['plat'] = true;
            }
        }

        // Fallback: If any tier is not mapped by name, map to the top 3 overall offers
        $tagesgeldOffers = array_values($offers); // Reset keys
        if (!isset($mappedKeys['plat']) && isset($tagesgeldOffers[0])) {
            $tiers['plat']['rate'] = (float) ($tagesgeldOffers[0]['interest_rate'] ?? 3.30);
            $tiers['plat']['id'] = $tagesgeldOffers[0]['id'] ?? '';
            $tiers['plat']['bank_id'] = $tagesgeldOffers[0]['bank_id'] ?? '';
            $tiers['plat']['bank_logo'] = $tagesgeldOffers[0]['banks']['logo_url'] ?? '';
        }
        if (!isset($mappedKeys['gold']) && isset($tagesgeldOffers[1])) {
            $tiers['gold']['rate'] = (float) ($tagesgeldOffers[1]['interest_rate'] ?? 3.10);
            $tiers['gold']['id'] = $tagesgeldOffers[1]['id'] ?? '';
            $tiers['gold']['bank_id'] = $tagesgeldOffers[1]['bank_id'] ?? '';
            $tiers['gold']['bank_logo'] = $tagesgeldOffers[1]['banks']['logo_url'] ?? '';
        }
        if (!isset($mappedKeys['bronze']) && isset($tagesgeldOffers[2])) {
            $tiers['bronze']['rate'] = (float) ($tagesgeldOffers[2]['interest_rate'] ?? 2.80);
            $tiers['bronze']['id'] = $tagesgeldOffers[2]['id'] ?? '';
            $tiers['bronze']['bank_id'] = $tagesgeldOffers[2]['bank_id'] ?? '';
            $tiers['bronze']['bank_logo'] = $tagesgeldOffers[2]['banks']['logo_url'] ?? '';
        }

        $title = 'Tagesgeld Vergleich 2025 | Festgeld Vergleichen';
        $description = 'Vergleichen Sie die besten Tagesgeld-Angebote und sichern Sie sich die höchsten Zinsen für Ihr flexibles Tagesgeldkonto.';

        return view('tagesgeld', compact('offers', 'title', 'description', 'tiers'));
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

        $title = "Unsere Partnerbanken | Festgeld Vergleichen";
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

        $title = "Blog | Festgeld Vergleichen";
        $description = "Expertenbeiträge zu Festgeld, Tagesgeld und nachhaltigen Finanzstrategien.";

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

        $title = "Services | Festgeld Vergleichen";
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
            $description = $page->meta_description ?: 'Festgeld Vergleichen';

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
