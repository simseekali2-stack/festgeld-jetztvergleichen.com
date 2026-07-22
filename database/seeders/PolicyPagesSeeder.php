<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PolicyPagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Datenschutzerklaerung',
                'slug' => 'datenschutzerklaerung',
                'type' => 'privacy',
                'excerpt' => 'Informationen zur Verarbeitung personenbezogener Daten auf Festgeld Vergleichen.',
                'content' => '<h2>1. Verantwortlicher</h2><p>Festgeld Vergleichen ist verantwortlich fuer die Verarbeitung Ihrer personenbezogenen Daten gemaess den geltenden Datenschutzvorschriften.</p><h2>2. Erhebung und Verarbeitung</h2><p>Wir verarbeiten nur jene Daten, die fuer die Bereitstellung unserer Dienste erforderlich sind, insbesondere Kontakt- und Nutzungsdaten.</p><h2>3. Zweck der Verarbeitung</h2><p>Die Verarbeitung erfolgt zur Vertragsdurchfuehrung, zur Kommunikation mit Ihnen sowie zur Optimierung unseres Angebots.</p><h2>4. Speicherdauer</h2><p>Personenbezogene Daten werden nur so lange gespeichert, wie es fuer die jeweiligen Zwecke oder gesetzliche Pflichten erforderlich ist.</p><h2>5. Ihre Rechte</h2><p>Sie haben das Recht auf Auskunft, Berichtigung, Loeschung, Einschraenkung der Verarbeitung sowie Datenuebertragbarkeit.</p>',
                'status' => 'published',
                'meta_title' => 'Datenschutzerklaerung | Festgeld Vergleichen',
                'meta_description' => 'Erfahren Sie, wie Festgeld Vergleichen personenbezogene Daten verarbeitet und schuetzt.',
                'og_title' => 'Datenschutzerklaerung',
                'og_description' => 'Transparente Informationen zur Datenverarbeitung bei Festgeld Vergleichen.',
                'focus_keyword' => 'Datenschutzerklaerung',
                'robots' => 'index, follow',
                'structured_data' => '{"@context":"https://schema.org","@type":"WebPage","name":"Datenschutzerklaerung"}',
            ],
            [
                'title' => 'Cookie-Richtlinie',
                'slug' => 'cookie-richtlinie',
                'type' => 'cookies',
                'excerpt' => 'Details zur Verwendung von Cookies und aehnlichen Technologien auf unserer Plattform.',
                'content' => '<h2>1. Was sind Cookies?</h2><p>Cookies sind kleine Textdateien, die auf Ihrem Endgeraet gespeichert werden, um bestimmte Funktionen zu ermoeglichen.</p><h2>2. Welche Cookies verwenden wir?</h2><p>Wir verwenden technisch notwendige Cookies, Analyse-Cookies und optionale Komfort-Cookies.</p><h2>3. Rechtsgrundlage</h2><p>Die Nutzung technisch notwendiger Cookies erfolgt auf Grundlage berechtigter Interessen; optionale Cookies nur mit Ihrer Einwilligung.</p><h2>4. Verwaltung Ihrer Einstellungen</h2><p>Sie koennen Ihre Cookie-Einstellungen jederzeit ueber Ihren Browser oder unser Consent-Tool anpassen.</p><h2>5. Weitere Informationen</h2><p>Bei Fragen zur Cookie-Nutzung erreichen Sie uns ueber die im Impressum genannten Kontaktwege.</p>',
                'status' => 'published',
                'meta_title' => 'Cookie-Richtlinie | Festgeld Vergleichen',
                'meta_description' => 'Alle Informationen zur Cookie-Nutzung und zu Ihren Einstellungsmöglichkeiten.',
                'og_title' => 'Cookie-Richtlinie',
                'og_description' => 'Wie und warum Festgeld Vergleichen Cookies verwendet.',
                'focus_keyword' => 'Cookie-Richtlinie',
                'robots' => 'index, follow',
                'structured_data' => '{"@context":"https://schema.org","@type":"WebPage","name":"Cookie-Richtlinie"}',
            ],
            [
                'title' => 'Altersrichtlinie',
                'slug' => 'altersrichtlinie',
                'type' => 'age',
                'excerpt' => 'Regelungen zur Nutzung unserer Dienste in Bezug auf das Mindestalter.',
                'content' => '<h2>1. Mindestalter</h2><p>Unsere Dienste richten sich ausschliesslich an volljaehrige Personen, sofern gesetzlich nichts anderes bestimmt ist.</p><h2>2. Nutzung durch Minderjaehrige</h2><p>Eine Nutzung durch Minderjaehrige ist ohne ausdrueckliche Zustimmung der Erziehungsberechtigten nicht gestattet.</p><h2>3. Verifizierung</h2><p>In Einzelfaellen behalten wir uns vor, einen Alters- oder Identitaetsnachweis anzufordern.</p><h2>4. Folgen bei Verstoessen</h2><p>Bei Verstoessen gegen diese Richtlinie koennen Konten eingeschraenkt oder gesperrt werden.</p><h2>5. Kontakt</h2><p>Bei Rueckfragen zur Altersrichtlinie wenden Sie sich bitte an unseren Support.</p>',
                'status' => 'published',
                'meta_title' => 'Altersrichtlinie | Festgeld Vergleichen',
                'meta_description' => 'Regelungen zur Altersgrenze und Nutzung der Plattform Festgeld Vergleichen.',
                'og_title' => 'Altersrichtlinie',
                'og_description' => 'Informationen zur Altersgrenze fuer die Nutzung unserer Dienste.',
                'focus_keyword' => 'Altersrichtlinie',
                'robots' => 'index, follow',
                'structured_data' => '{"@context":"https://schema.org","@type":"WebPage","name":"Altersrichtlinie"}',
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}

