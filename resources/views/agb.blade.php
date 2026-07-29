@extends('layouts.app')

@push('styles')
<style>
  .legal-hero-section {
    background:
      radial-gradient(circle at top left, rgba(37, 99, 235, 0.35), transparent 35%),
      linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%) !important;
    position: relative;
    padding-top: 5rem;
    padding-bottom: 5rem;
    overflow: hidden;
  }

  .legal-hero-section::after {
    content: "";
    position: absolute;
    width: 360px;
    height: 360px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.08);
    right: -120px;
    top: -120px;
  }

  .legal-content-section {
    padding: 4rem 0;
    background: #f8fafc;
  }

  .legal-container {
    max-width: 900px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 1.5rem;
    padding: 3.5rem;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
    border: 1px solid rgba(226, 232, 240, 1);
  }

  .legal-back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    margin-bottom: 2rem;
    color: #dc2626;
    font-size: 0.95rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .legal-back-link:hover {
    color: #b91c1c;
    transform: translateX(-4px);
  }

  .legal-title {
    font-size: 2.35rem;
    font-weight: 900;
    color: #0f172a;
    margin-bottom: 0.75rem;
    letter-spacing: -0.03em;
  }

  .legal-subtitle {
    color: #64748b;
    margin-bottom: 2.5rem;
    font-size: 0.98rem;
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 1.25rem;
  }

  .legal-heading {
    font-size: 1.35rem;
    font-weight: 800;
    color: #0f172a;
    margin-top: 2.5rem;
    margin-bottom: 1rem;
    border-left: 3px solid #dc2626;
    padding-left: 0.75rem;
  }

  .legal-text {
    color: #475569;
    font-size: 1rem;
    line-height: 1.8;
    margin-bottom: 1.25rem;
  }

  .legal-text strong {
    color: #0f172a;
  }

  .legal-list {
    list-style-type: disc;
    margin-left: 1.75rem;
    margin-bottom: 1.5rem;
    color: #475569;
  }

  .legal-list li {
    margin-bottom: 0.6rem;
    line-height: 1.75;
  }

  .legal-warning-box {
    background: #fdfbf7;
    border: 1px solid #ebdcb9;
    border-left: 4px solid #dc2626;
    border-radius: 1rem;
    padding: 1.5rem;
    margin: 1.5rem 0 2rem;
  }

  .legal-warning-box .legal-text {
    margin-bottom: 0;
  }

  .legal-reveal {
    margin: 1.5rem 0 2rem;
    padding: 1.25rem;
    border-radius: 1rem;
    background: #f8fafc;
    border: 1px dashed #cbd5e1;
  }

  .legal-text a,
  .legal-container a {
    color: #dc2626;
    text-decoration: none;
    font-weight: 600;
    word-break: break-word;
    overflow-wrap: anywhere;
    transition: color 0.15s ease;
  }

  .legal-text a:hover,
  .legal-container a:hover {
    color: #b91c1c;
    text-decoration: underline;
  }

  .legal-footer-note {
    margin-top: 3.5rem;
    padding-top: 2rem;
    border-top: 1px solid #e2e8f0;
    color: #64748b;
    font-size: 0.85rem;
    line-height: 1.8;
  }

  @media (max-width: 768px) {
    .legal-hero-section {
      padding-top: 4rem;
      padding-bottom: 4rem;
    }

    .legal-content-section {
      padding: 2.5rem 0;
    }

    .legal-container {
      padding: 2rem 1.5rem;
      border-radius: 1.25rem;
    }

    .legal-title {
      font-size: 1.85rem;
    }

    .legal-heading {
      font-size: 1.2rem;
      margin-top: 2rem;
    }

    .legal-text {
      font-size: 0.95rem;
    }
  }
</style>
@endpush

@section('content')
  <section class="legal-hero-section text-white text-center">
    <div class="container mx-auto px-4 relative z-10">
      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">
        Allgemeine Geschäftsbedingungen (AGB)
      </h1>
      <p class="text-red-100 text-sm md:text-base mt-3 max-w-2xl mx-auto">
        Nutzungsbedingungen und rechtliche Rahmenbedingungen für {{ parse_url(url('/'), PHP_URL_HOST) }}.
      </p>
    </div>
  </section>

  <section class="legal-content-section">
    <div class="container mx-auto px-4">
      <div class="legal-container">

        <a href="{{ url('/') }}" class="legal-back-link">
          ← Zurück zur Startseite
        </a>

        <h2 class="legal-title">Allgemeine Geschäftsbedingungen (AGB)</h2>
        <p class="legal-subtitle">
          Stand: {{ config('settings.terms_updated_at', 'Juni 2026') }}
        </p>

        <h3 class="legal-heading">§ 1 Geltungsbereich</h3>
        <p class="legal-text">
          Diese Allgemeinen Geschäftsbedingungen, nachfolgend „AGB“, gelten für alle Leistungen,
          Inhalte und Funktionen, die über die Website
          <strong>{{ parse_url(url('/'), PHP_URL_HOST) }}</strong>, nachfolgend „Website“ oder
          „Portal“, bereitgestellt werden.
        </p>

        <p class="legal-text">
          Die Website dient als Vergleichsportal für Festgeld-Angebote und als Informationsplattform.
          Betreiberin der Website ist Heidrun Ursel Friederich, selbstständige Finanzanlagenvermittlerin
          nach § 34f GewO. Die Vermittlung von konkreten
          Finanzprodukten erfolgt im Rahmen der gesetzlichen Erlaubnisse der Betreiberin oder deren
          Kooperationspartner.
        </p>

        <div class="legal-warning-box">
          <p class="legal-text">
            <strong>Wichtiger Hinweis:</strong><br>
            Alle auf dieser Website bereitgestellten Informationen dienen ausschließlich der
            allgemeinen Information und dem unverbindlichen Vergleich. Sie stellen für sich genommen keine
            Abschlussverpflichtung oder ein verbindliches Angebot der Banken dar. Ein rechtswirksamer Vertrag über
            eine Geldanlage kommt erst nach Prüfung durch die jeweilige Bank zustande.
          </p>
        </div>

        <h3 class="legal-heading">§ 2 Leistungsbeschreibung und Geschäftsmodell</h3>
        <p class="legal-text">
          Unser Service umfasst insbesondere:
        </p>

        <ul class="legal-list">
          <li>die Bereitstellung eines unverbindlichen Vergleichsportals für Festgeld-Angebote,</li>
          <li>Informationsdienstleistungen rund um Festgeld, Zinsen und Anlagezeiträume,</li>
          <li>die Darstellung allgemeiner Produkt- und Konditionsinformationen,</li>
          <li>die Entgegennahme von Kontaktanfragen interessierter Nutzer,</li>
          <li>die Beratung und Vermittlung im Rahmen der gewerberechtlichen Erlaubnisse nach § 34f GewO durch die Betreiberin oder kooperierende Vertriebspartner.</li>
        </ul>

        <p class="legal-text">
          Wir prüfen und vergleichen ausgewählte Festgeld-Angebote nach den auf der Website
          dargestellten Kriterien. Die Darstellung der Angebote ist unverbindlich und erhebt keinen
          Anspruch auf Vollständigkeit des gesamten Marktes.
        </p>

        <p class="legal-text">
          Ein Vertrag über ein Finanzprodukt, etwa Festgeld oder Tagesgeld, kommt ausschließlich
          zwischen dem Nutzer und dem jeweiligen Anbieter, der jeweiligen Bank oder dem jeweiligen
          Finanzdienstleister zustande.
        </p>

        <h3 class="legal-heading">Wichtiger Hinweis zu unserem Geschäftsmodell</h3>
        <p class="legal-text">
          Wir sind ein verifizierter Vermittlungs- und Informationsdienst. Sofern Nutzer über unser Portal
          Kontaktanfragen stellen, können die eingehenden Anfragen direkt durch die Betreiberin Heidrun Ursel Friederich
          oder an sie angeschlossene, lizensierte Kooperationspartner bearbeitet werden.
          Dies geschieht ausschließlich, um dem Nutzer ein maßgeschneidertes Angebot für die gewünschte Geldanlage zu erstellen.
        </p>

        <h3 class="legal-heading">Empfänger der Daten</h3>
        <p class="legal-text">
          Ihre Daten können an folgende Vertragspartner übermittelt werden:
        </p>

        <div class="legal-reveal" style="border-style: solid; border-color: #ebdcb9; background-color: #faf8f5;">
          <div id="partner-daten">
            <strong>Heidrun Ursel Friederich</strong><br>
            Distelweg 8<br>
            22339 Hamburg<br>
            E-Mail: <a href="mailto:info@festgeld-jetztvergleichen.com">info@festgeld-jetztvergleichen.com</a>
          </div>
        </div>

        <h3 class="legal-heading">Weitergabe personenbezogener Daten</h3>
        <p class="legal-text">
          Sofern Nutzer über das Kontaktformular personenbezogene Daten übermitteln, erfolgt die
          Weitergabe dieser Daten an einen Kooperationspartner ausschließlich auf Grundlage
          der ausdrücklichen Einwilligung gemäß Art. 6 Abs. 1 lit. a DSGVO.
        </p>

        <h3 class="legal-heading">Vertragliche Verpflichtungen der Lead-Abnehmer</h3>
        <p class="legal-text">
          Der Betreiber schließt mit Kooperationspartnern verbindliche Verträge, welche insbesondere
          folgende Pflichten enthalten:
        </p>

        <ul class="legal-list">
          <li>zweckgebundene Nutzung ausschließlich zur Kontaktaufnahme bezüglich konkreter Festgeld-Angebote,</li>
          <li>Verbot der unbefugten Weiterveräußerung oder unbefugten Weitergabe an unbeteiligte Dritte,</li>
          <li>Einhaltung sämtlicher datenschutzrechtlicher Vorschriften (DSGVO),</li>
          <li>Lösch- und Sperrpflichten bei Nichtzustandekommen eines Vertrags oder nach Widerruf,</li>
          <li>angemessene technische und organisatorische Maßnahmen zum Schutz personenbezogener Daten.</li>
        </ul>

        <h3 class="legal-heading">§ 3 Nutzung der Website</h3>
        <p class="legal-text">
          Die Nutzung unserer Website ist grundsätzlich kostenlos. Durch die Nutzung der Website
          erkennt der Nutzer diese AGB in ihrer jeweils gültigen Fassung an.
        </p>

        <p class="legal-text">
          Der Nutzer verpflichtet sich:
        </p>

        <ul class="legal-list">
          <li>wahrheitsgemäße und vollständige Angaben im Kontaktformular zu machen,</li>
          <li>die Website nicht für rechtswidrige Zwecke zu nutzen,</li>
          <li>keine Schadsoftware, automatisierten Abfragen, Bots oder Scraper einzusetzen,</li>
          <li>die Rechte Dritter zu respektieren,</li>
          <li>keine Handlungen vorzunehmen, die die Sicherheit, Verfügbarkeit oder Integrität der Website beeinträchtigen können.</li>
        </ul>

        <p class="legal-text">
          Die Nutzung der Inhalte ist ausschließlich for den privaten, nicht-kommerziellen Gebrauch
          gestattet. Jede automatisierte Auswertung, systematische Vervielfältigung oder gewerbliche
          Nutzung der dargestellten Daten ist ohne vorherige schriftliche Zustimmung untersagt.
        </p>

        <h3 class="legal-heading">§ 4 Datenschutz und Datenverarbeitung</h3>
        <p class="legal-text">
          Der Schutz personenbezogener Daten ist uns wichtig. Details zur Verarbeitung
          personenbezogener Daten, zu Empfängern, Speicherdauer, Betroffenenrechten und
          Rechtsgrundlagen finden Sie in unserer Datenschutzerklärung.
        </p>

        <p class="legal-text">
          Die Übermittlung personenbezogener Daten an einen Kooperationspartner erfolgt ausschließlich
          auf Grundlage der ausdrücklichen Einwilligung des Nutzers gemäß Art. 6 Abs. 1 lit. a DSGVO.
        </p>

        <h3 class="legal-heading">§ 5 Haftungsausschluss</h3>
        <p class="legal-text">
          Alle Informationen auf dieser Website dienen nur der allgemeinen Information.
        </p>

        <p class="legal-text">
          Wir bemühen uns, die dargestellten Informationen, Zinssätze, Laufzeiten und Konditionen
          aktuell und korrekt zu halten. Da sich Konditionen von Banken und Anbietern kurzfristig
          ändern können, übernehmen wir keine Gewähr für Richtigkeit, Vollständigkeit, Aktualität,
          Verfügbarkeit oder Eignung der bereitgestellten Informationen.
        </p>

        <p class="legal-text">
          Wir übernehmen keine Haftung für:
        </p>

        <ul class="legal-list">
          <li>die Richtigkeit, Vollständigkeit oder Aktualität der dargestellten Angebote der Banken,</li>
          <li>Entscheidungen, die Nutzer aufgrund der bereitgestellten Informationen treffen,</li>
          <li>Schäden durch die Nutzung der Website oder verlinkter Angebote,</li>
          <li>das Zustandekommen oder Nichtzustandekommen eines Vertrags mit Dritten (Banken),</li>
          <li>die weitere Verarbeitung personenbezogener Daten nach rechtmäßiger Übermittlung an einen Partner im Rahmen der Beratung.</li>
        </ul>

        <p class="legal-text">
          Die Haftung ist, soweit gesetzlich zulässig, auf Vorsatz und grobe Fahrlässigkeit beschränkt.
          Unberührt bleibt die Haftung für Schäden aus der Verletzung des Lebens, des Körpers oder
          der Gesundheit sowie für Schäden aus der Verletzung wesentlicher Vertragspflichten
          beziehungsweise Kardinalpflichten.
        </p>

        <h3 class="legal-heading">§ 6 Widerruf und Kündigung</h3>
        <p class="legal-text">
          Der Nutzer kann eine erteilte Einwilligung zur Datenverarbeitung und Datenweitergabe
          jederzeit mit Wirkung für die Zukunft widerrufen. Der Widerruf berührt nicht die
          Rechtmäßigkeit der bis zum Widerruf erfolgten Verarbeitung.
        </p>

        <p class="legal-text">
          Für den Widerruf können Sie uns unter den im Impressum angegebenen Kontaktdaten erreichen.
        </p>

        <h3 class="legal-heading">§ 7 Änderungen der AGB</h3>
        <p class="legal-text">
          Wir behalten uns vor, diese AGB jederzeit mit Wirkung für die Zukunft zu ändern, soweit dies
          aufgrund gesetzlicher Änderungen, technischer Anpassungen, Änderungen unseres Angebots
          oder aus sonstigen sachlichen Gründen erforderlich ist.
        </p>

        <h3 class="legal-heading">§ 8 Externe Links und Anbieterinformationen</h3>
        <p class="legal-text">
          Unsere Website kann Links zu externen Websites Dritter enthalten. Auf deren Inhalte,
          Verfügbarkeit und Datenschutzpraktiken haben wir keinen Einfluss. Für die Inhalte der
          verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber verantwortlich.
        </p>

        <h3 class="legal-heading">§ 9 Urheberrecht und Nutzungsrechte</h3>
        <p class="legal-text">
          Die auf dieser Website erstellten Inhalte, Texte, Vergleichsstrukturen, Grafiken, Layouts
          und sonstigen Bestandteile unterliegen dem deutschen Urheberrecht und sonstigen Schutzrechten.
        </p>

        <h3 class="legal-heading">§ 10 Verbraucherschlichtung</h3>
        <p class="legal-text">
          Wir sind weder bereit noch verpflichtet, an Streitbeilegungsverfahren vor einer
          Verbraucherschlichtungsstelle teilzunehmen.
        </p>

        <h3 class="legal-heading">§ 11 Schlussbestimmungen</h3>
        <p class="legal-text">
          Es gilt das Recht der Bundesrepublik Deutschland unter Ausschluss des UN-Kaufrechts.
        </p>

        <p class="legal-text">
          Sollten einzelne Bestimmungen dieser AGB ganz oder teilweise unwirksam sein oder werden,
          bleibt die Wirksamkeit der übrigen Bestimmungen unberührt. Anstelle der unwirksamen
          Bestimmung gelten die gesetzlichen Vorschriften.
        </p>

        <h3 class="legal-heading">Anbieter</h3>

        <div class="legal-reveal" style="border-style: solid; border-color: #ebdcb9; background-color: #faf8f5;">
          <div id="anbieter-daten">
            <strong>Heidrun Ursel Friederich</strong><br>
            Distelweg 8<br>
            22339 Hamburg<br><br>

            E-Mail: <a href="mailto:info@festgeld-jetztvergleichen.com">info@festgeld-jetztvergleichen.com</a><br>
            Telefon: <a href="tel:+4915776884663">+49 (0) 157 76884663</a>
          </div>
        </div>

        <p class="legal-text">
          E-Mail: <a href="mailto:info@festgeld-jetztvergleichen.com">info@festgeld-jetztvergleichen.com</a>
        </p>

        <div class="legal-footer-note">
          <p class="mb-2">
            &copy; {{ date('Y') }} {{ parse_url(url('/'), PHP_URL_HOST) }} · Alle Rechte vorbehalten.
          </p>
          <p>
            Die Betreiberin ist selbstständige Finanzanlagenvermittlerin mit einer Erlaubnis nach § 34f Abs. 1 GewO.
          </p>
        </div>

      </div>
    </div>
  </section>
@endsection