<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Service;
use App\Models\Page;
use App\Models\ContactMessage;
use App\Models\Setting;
use App\Models\Bank;
use App\Services\API;
use App\Services\YandexMetrikaService;

class AdminController extends Controller
{
    public function __construct(private API $api)
    {
    }

    public function dashboard()
    {
        $blogCount = BlogPost::count();
        $serviceCount = Service::count();
        $pageCount = Page::count();
        $contactCount = ContactMessage::count();
        return view('admin.dashboard', compact('blogCount', 'serviceCount', 'pageCount', 'contactCount'));
    }

    // --- SETTINGS ---
    public function settings()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->except('_token');
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return redirect()->route('admin.settings.index')->with('success', 'Einstellungen erfolgreich gespeichert.');
    }

    // --- BLOGS ---
    public function blogs()
    {
        $blogs = BlogPost::orderBy('created_at', 'desc')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function createBlog()
    {
        return view('admin.blogs.form');
    }

    public function storeBlog(Request $request)
    {
        $data = $request->except('_token', 'featured_image_file');
        
        if ($request->hasFile('featured_image_file')) {
            $path = $request->file('featured_image_file')->store('uploads/blogs', 'public');
            $data['featured_image'] = '/storage/' . $path;
        }

        BlogPost::create($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog Beitrag erstellt.');
    }

    public function editBlog($id)
    {
        $blog = BlogPost::findOrFail($id);
        return view('admin.blogs.form', compact('blog'));
    }

    public function updateBlog(Request $request, $id)
    {
        $blog = BlogPost::findOrFail($id);
        $data = $request->except(['_token', '_method', 'featured_image_file']);
        
        if ($request->hasFile('featured_image_file')) {
            $path = $request->file('featured_image_file')->store('uploads/blogs', 'public');
            $data['featured_image'] = '/storage/' . $path;
        }

        $blog->update($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog Beitrag aktualisiert.');
    }

    public function deleteBlog($id)
    {
        BlogPost::findOrFail($id)->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog Beitrag gelöscht.');
    }

    // --- SERVICES ---
    public function services()
    {
        $services = Service::orderBy('sort_order', 'asc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function createService()
    {
        return view('admin.services.form');
    }

    public function storeService(Request $request)
    {
        Service::create($request->except('_token'));
        return redirect()->route('admin.services.index')->with('success', 'Service erstellt.');
    }

    public function editService($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.form', compact('service'));
    }

    public function updateService(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->except(['_token', '_method']));
        return redirect()->route('admin.services.index')->with('success', 'Service aktualisiert.');
    }

    public function deleteService($id)
    {
        Service::findOrFail($id)->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service gelöscht.');
    }

    // --- PAGES ---
    public function pages()
    {
        $pages = Page::orderBy('created_at', 'desc')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function createPage()
    {
        return view('admin.pages.form');
    }

    public function storePage(Request $request)
    {
        Page::create($request->except('_token'));
        return redirect()->route('admin.pages.index')->with('success', 'Seite erstellt.');
    }

    public function editPage($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.form', compact('page'));
    }

    public function updatePage(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->update($request->except(['_token', '_method']));
        return redirect()->route('admin.pages.index')->with('success', 'Seite aktualisiert.');
    }

    public function deletePage($id)
    {
        Page::findOrFail($id)->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Seite gelöscht.');
    }

    // --- CONTACTS ---
    public function contacts()
    {
        $contacts = ContactMessage::orderBy('created_at', 'desc')->get();
        // Read all automatically when viewed or handle individually. For now, just listing.
        return view('admin.contacts.index', compact('contacts'));
    }

    public function deleteContact($id)
    {
        ContactMessage::findOrFail($id)->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Nachricht gelöscht.');
    }

    // --- BANKS ---
    public function banks()
    {
        $payload = $this->api->get('api/credits/list');
        $offers = is_array($payload) && isset($payload['data']) ? $payload['data'] : [];

        $banks = [];
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
                        'country' => $offer['banks']['country_name'] ?? ($offer['banks']['country'] ?? ''),
                    ];
                }
            }
        }

        // Apply same filters as frontend (remove specific bank ID)
        $banks = array_filter($banks, function($b) {
            return $b['id'] !== '9b998fb1-00a2-4481-9c40-03a5ccbf7c85';
        });

        usort($banks, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        // Get local descriptions
        $localDescriptions = Bank::whereIn('bank_id', array_column($banks, 'id'))->get()->pluck('description', 'bank_id')->toArray();

        return view('admin.banks.index', compact('banks', 'localDescriptions'));
    }

    public function updateBankDescription(Request $request)
    {
        $request->validate([
            'bank_id' => 'required',
            'description' => 'nullable'
        ]);

        Bank::updateOrCreate(
            ['bank_id' => $request->bank_id],
            ['description' => $request->description]
        );

        return response()->json(['success' => true, 'message' => 'Beschreibung aktualisiert.']);
    }

    // --- ANALYTICS ---
    public function analytics(Request $request, YandexMetrikaService $metrika)
    {
        $period = (int) $request->query('period', 30);
        $date2  = date('Y-m-d');
        $date1  = date('Y-m-d', strtotime("-{$period} days"));

        $configured = $metrika->isConfigured();
        $summary         = [];
        $topPages        = [];
        $trafficSources  = [];
        $highBouncePages = [];
        $dailyVisits     = [];
        $deviceStats     = [];

        if ($configured) {
            $summary         = $metrika->getSummary($date1, $date2);
            $topPages        = $metrika->getTopPages($date1, $date2);
            $trafficSources  = $metrika->getTrafficSources($date1, $date2);
            $highBouncePages = $metrika->getHighBouncePages($date1, $date2);
            $dailyVisits     = $metrika->getDailyVisits($date1, $date2);
            $deviceStats     = $metrika->getDeviceStats($date1, $date2);
        }

        return view('admin.analytics', compact(
            'configured', 'period', 'summary',
            'topPages', 'trafficSources', 'highBouncePages',
            'dailyVisits', 'deviceStats'
        ));
    }
}