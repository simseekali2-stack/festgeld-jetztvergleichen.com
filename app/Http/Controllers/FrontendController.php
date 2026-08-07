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

    private function getRatingsMap(): array
    {
        $banksPayload = Cache::remember('banks_list_ratings_v1', 300, function () {
            return $this->api->get('api/banks/list');
        });

        $ratingsMap = [];
        $items = is_array($banksPayload) ? (isset($banksPayload['data']) ? $banksPayload['data'] : $banksPayload) : [];
        if (is_array($items)) {
            foreach ($items as $b) {
                if (!empty($b['id'])) {
                    $r = $b['rating'] ?? 'AAA';
                    $ratingsMap[$b['id']] = [
                        'rating' => $r,
                        'score'  => match ($r) {
                            'AAA' => '5.0',
                            'AA+' => '4.9',
                            'AA'  => '4.8',
                            'A+'  => '4.7',
                            'BBB+','BBB' => '4.5',
                            default => '4.8'
                        }
                    ];
                }
            }
        }
        return $ratingsMap;
    }

    public function welcome()
    {
        $key = 'credits_list_raw_v1';
        $payload = Cache::get($key);

        if (!is_array($payload)) {
            $payload = $this->api->get('api/credits/list');
            if ($payload !== []) {
                Cache::put($key, $payload, 60);
            }
        }

        $allOffers = is_array($payload) && isset($payload['data']) ? array_values($payload['data']) : [];

        // Filter for Festgeld and remove mock/tier banks
        $offers = array_values(array_filter($allOffers, function ($item) {
            $creditType = $item['credit_type'] ?? 'Festgeld';
            $bankId = $item['bank_id'] ?? '';
            $bankName = strtolower($item['banks']['name'] ?? '');

            if ($creditType !== 'Festgeld') {
                return false;
            }

            if ($bankId === '9b998fb1-00a2-4481-9c40-03a5ccbf7c85') {
                return false;
            }

            if (empty($bankName) || 
                str_contains($bankName, 'tier') || 
                str_contains($bankName, 'festgeld-') || 
                str_contains($bankName, 'tagesgeld-') || 
                str_contains($bankName, 'mock')) {
                return false;
            }

            return true;
        }));

        usort($offers, function ($a, $b) {
            return (float) ($b['interest_rate'] ?? 0) <=> (float) ($a['interest_rate'] ?? 0);
        });

        $ratingsMap = $this->getRatingsMap();
        $bankOffers = [];

        if (!empty($offers)) {
            foreach ($offers as $idx => $offer) {
                $bName = $offer['banks']['name'] ?? 'Partnerbank EU';
                $bCountry = $offer['banks']['country_name'] ?? ($offer['banks']['country'] ?? '🇪🇺 EU-Mitgliedstaat');
                $bLogo = $offer['banks']['logo_url'] ?? '';
                $rawRate = (float) ($offer['interest_rate'] ?? 0);
                $rate = $rawRate > 0 ? round($rawRate, 2) : 3.25;

                $minAmount = (float) ($offer['min_amount'] ?? 0);
                $amount = $minAmount > 0 ? (int) $minAmount : 25000;
                $rangeLabel = 'ab ' . number_format($amount, 0, ',', '.') . ' €';

                $bankId = $offer['bank_id'] ?? '';
                $ratingInfo = $ratingsMap[$bankId] ?? ['rating' => 'AAA', 'score' => '5.0'];

                $bankOffers[] = [
                    'key' => 'bank_' . ($offer['id'] ?? $idx),
                    'label' => 'Festgeld',
                    'range' => $rangeLabel,
                    'rate' => $rate,
                    'rate_prefix' => ($idx % 2 == 0) ? 'ab ' : 'bis zu ',
                    'amount' => $amount,
                    'bank_name' => $bName,
                    'country' => $bCountry,
                    'id' => $offer['id'] ?? '',
                    'bank_id' => $bankId,
                    'bank_logo' => $bLogo,
                    'rating' => $ratingInfo['rating'],
                    'score' => $ratingInfo['score'],
                ];
            }
        }

        $tiers = $bankOffers;

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

        $allOffers = is_array($payload) && isset($payload['data']) ? array_values($payload['data']) : [];

        // Filter for Tagesgeld and remove mock/tier banks
        $offers = array_values(array_filter($allOffers, function ($item) {
            $creditType = $item['credit_type'] ?? '';
            $bankId = $item['bank_id'] ?? '';
            $bankName = strtolower($item['banks']['name'] ?? '');

            if ($creditType !== 'Tagesgeld') {
                return false;
            }

            if ($bankId === '9b998fb1-00a2-4481-9c40-03a5ccbf7c85') {
                return false;
            }

            if (empty($bankName) || 
                str_contains($bankName, 'tier') || 
                str_contains($bankName, 'festgeld-') || 
                str_contains($bankName, 'tagesgeld-') || 
                str_contains($bankName, 'mock')) {
                return false;
            }

            return true;
        }));

        usort($offers, function ($a, $b) {
            return (float) ($b['interest_rate'] ?? 0) <=> (float) ($a['interest_rate'] ?? 0);
        });

        $ratingsMap = $this->getRatingsMap();
        $bankOffers = [];

        if (!empty($offers)) {
            foreach ($offers as $idx => $offer) {
                $bName = $offer['banks']['name'] ?? 'Partnerbank EU';
                $bCountry = $offer['banks']['country_name'] ?? ($offer['banks']['country'] ?? '🇪🇺 EU-Mitgliedstaat');
                $bLogo = $offer['banks']['logo_url'] ?? '';
                $rawRate = (float) ($offer['interest_rate'] ?? 0);
                $rate = $rawRate > 0 ? round($rawRate, 2) : 3.10;

                $minAmount = (float) ($offer['min_amount'] ?? 0);
                $amount = $minAmount > 0 ? (int) $minAmount : 25000;
                $rangeLabel = 'ab ' . number_format($amount, 0, ',', '.') . ' €';

                $bankId = $offer['bank_id'] ?? '';
                $ratingInfo = $ratingsMap[$bankId] ?? ['rating' => 'AAA', 'score' => '5.0'];

                $bankOffers[] = [
                    'key' => 'bank_' . ($offer['id'] ?? $idx),
                    'label' => 'Tagesgeld',
                    'range' => $rangeLabel,
                    'rate' => $rate,
                    'rate_prefix' => ($idx % 2 == 0) ? 'ab ' : 'bis zu ',
                    'amount' => $amount,
                    'bank_name' => $bName,
                    'country' => $bCountry,
                    'id' => $offer['id'] ?? '',
                    'bank_id' => $bankId,
                    'bank_logo' => $bLogo,
                    'rating' => $ratingInfo['rating'],
                    'score' => $ratingInfo['score'],
                    'color' => '#f97316',
                    'glow' => 'rgba(249,115,22,0.25)',
                    'border' => 'rgba(249,115,22,0.6)',
                ];
            }
        }

        $tiers = $bankOffers;

        $title = 'Tagesgeld Vergleich 2026 | Festgeld Vergleichen';
        $description = 'Vergleichen Sie die besten Tagesgeld-Angebote und sichern Sie sich die höchsten Zinsen für Ihr flexibles Tagesgeldkonto.';

        return view('tagesgeld', compact('offers', 'title', 'description', 'tiers'));
    }

    public function bankIndex()
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

        $banks = [];
        $seenBankIds = [];

        foreach ($offers as $offer) {
            if (isset($offer['banks']) && !empty($offer['banks']['id'])) {
                $bankId = $offer['banks']['id'];
                $bankName = strtolower($offer['banks']['name'] ?? '');

                if ($bankId === '9b998fb1-00a2-4481-9c40-03a5ccbf7c85') {
                    continue;
                }

                if (empty($bankName) || 
                    str_contains($bankName, 'tier') || 
                    str_contains($bankName, 'festgeld-') || 
                    str_contains($bankName, 'tagesgeld-') || 
                    str_contains($bankName, 'mock')) {
                    continue;
                }

                if (!in_array($bankId, $seenBankIds)) {
                    $seenBankIds[] = $bankId;
                    $banks[] = [
                        'id' => $bankId,
                        'name' => $offer['banks']['name'] ?? 'N/A',
                        'logo' => $offer['banks']['logo_url'] ?? '',
                        'description' => '',
                        'country' => $offer['banks']['country_name'] ?? ($offer['banks']['country'] ?? ''),
                    ];
                }
            }
        }

        $bankIdsFromApi = array_column($banks, 'id');
        $localDescriptions = Bank::whereIn('bank_id', $bankIdsFromApi)->get()->pluck('description', 'bank_id')->toArray();

        foreach ($banks as &$b) {
            $b['description'] = $localDescriptions[$b['id']] ?? ($offer['banks']['description'] ?? 'Ein renommiertes europäisches Finanzinstitut, das für Stabilität, erstklassigen Service und attraktive Anlagekonditionen steht. Durch die Einbindung in das europäische Einlagensicherungssystem bietet es Anlegern ein Höchstmaß an Sicherheit.');
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
