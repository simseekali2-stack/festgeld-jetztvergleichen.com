@extends('layouts.app')

@push('styles')
<style>
  .impressum-page {
    background: #f8fafc;
    min-height: 100vh;
    color: #334155;
  }

  .impressum-top-line {
    height: 4px;
    width: 100%;
    background: linear-gradient(90deg, #7f1d1d 0%, #dc2626 100%);
  }

  .impressum-header {
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
  }

  .impressum-container {
    max-width: 1000px;
    margin: 0 auto;
    padding-left: 1.5rem;
    padding-right: 1.5rem;
  }

  .impressum-header-inner {
    padding-top: 1.25rem;
    padding-bottom: 1.25rem;
  }

  .impressum-logo {
    height: 3.5rem;
    width: auto;
    display: block;
  }

  .impressum-main {
    padding-top: 3rem;
    padding-bottom: 4rem;
  }

  .impressum-back {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #dc2626;
    font-weight: 700;
    text-decoration: none;
    margin-bottom: 2rem;
    transition: all 0.2s ease;
  }

  .impressum-back:hover {
    color: #b91c1c;
    transform: translateX(-4px);
  }

  .impressum-title {
    font-size: 2.5rem;
    line-height: 1.2;
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -0.03em;
    margin-bottom: 0.5rem;
  }

  .impressum-subtitle {
    color: #64748b;
    font-size: 1rem;
    margin-bottom: 2.5rem;
  }

  .impressum-content {
    display: flex;
    flex-direction: column;
    gap: 2.5rem;
  }

  .impressum-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 1.25rem;
    padding: 2.25rem;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .impressum-card:hover {
    box-shadow: 0 15px 40px rgba(15, 23, 42, 0.06);
  }

  .impressum-card h2 {
    font-size: 1.4rem;
    line-height: 1.4;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #f1f5f9;
    padding-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .impressum-card h3 {
    font-size: 1.15rem;
    font-weight: 700;
    color: #991b1b;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
  }

  .impressum-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  @media (min-width: 768px) {
    .impressum-grid {
      grid-template-columns: 1fr 1fr;
    }
  }

  .impressum-text {
    color: #475569;
    font-size: 1rem;
    line-height: 1.8;
  }

  .impressum-text p {
    margin-bottom: 1rem;
  }

  .impressum-text p:last-child {
    margin-bottom: 0;
  }

  .impressum-text a {
    color: #dc2626;
    text-decoration: none;
    font-weight: 600;
    word-break: break-word;
    transition: color 0.15s ease;
  }

  .impressum-text a:hover {
    color: #991b1b;
    text-decoration: underline;
  }

  /* Registry Card Details */
  .registry-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 0.75rem;
    padding: 1.25rem;
    margin-top: 1rem;
  }

  .registry-title {
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 0.5rem;
    font-size: 1.05rem;
  }

  .registry-row {
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
  }

  .registry-row strong {
    color: #334155;
  }

  .impressum-footer {
    background: #0b1329;
    padding-top: 3rem;
    padding-bottom: 3rem;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
  }

  .impressum-footer-inner {
    text-align: center;
    color: #ffffff;
  }

  .impressum-footer-copy {
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 1rem;
    font-weight: 600;
  }

  .impressum-footer-note {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.4);
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.8;
  }
</style>
@endpush

@section('title', 'Impressum | festgeld-jetztvergleichen.com')

@section('content')
<div class="impressum-page">
  <div class="impressum-top-line"></div>

  <header class="impressum-header">
    <div class="impressum-container impressum-header-inner">
      <a href="{{ url('/') }}" aria-label="festgeld-jetztvergleichen.com Startseite">
        <img src="/logo.svg" alt="festgeld-jetztvergleichen.com" class="impressum-logo" style="height: 3.5rem; width: auto; object-fit: contain;">
      </a>
    </div>
  </header>

  <main class="impressum-container impressum-main">
    <a href="{{ url('/') }}" class="impressum-back">
      <span aria-hidden="true">←</span>
      <span>Zurück zur Startseite</span>
    </a>

    <h1 class="impressum-title">Impressum</h1>
    <p class="impressum-subtitle">Gesetzliche Pflichtangaben und rechtliche Hinweise nach § 5 DDG und § 18 MstV</p>

    <div class="impressum-content">

      <!-- Section 1: Provider and Contact -->
      <section class="impressum-card">
        <h2>
          <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #dc2626;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
          Angaben gemäß § 5 DDG
        </h2>

          <div class="registry-card">
            <div class="registry-title">Kontakt &amp; Anschrift</div>
            <div class="registry-row"><strong>Name:</strong> Dennis Missfeldt</div>
            <div class="registry-row"><strong>Geschäftsführung:</strong> Diplom-Volkswirt Dennis Missfeldt</div>
            <div class="registry-row"><strong>Anschrift:</strong><br>
              Alstertor 15<br>
              20095 Hamburg
            </div>
            <div class="registry-row"><strong>Mobil:</strong> <a href="tel:+4915776884663">+49 (0) 157 76884663</a></div>
            <div class="registry-row"><strong>E-Mail:</strong> <a href="mailto:info@festgeld-jetztvergleichen.com">info@festgeld-jetztvergleichen.com</a></div>
            <div class="registry-row"><strong>Steuernummer:</strong> 48/162/00526 (Finanzamt Hamburg-Mitte)</div>
            <div class="registry-row"><strong>Umsatzsteuer-ID:</strong> DE 222437159</div>
          </div>
        </div>
      </section>

      <!-- Section 2: Responsible Person -->
      <section class="impressum-card">
        <h2>
          <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #dc2626;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
          Verantwortlicher im Sinne des § 18 Abs. 2 MstV
        </h2>
        <div class="impressum-text">
          <div class="registry-card">
            <div class="registry-row"><strong>Verantwortlich für den Inhalt:</strong></div>
            <div class="registry-row">Dennis Missfeldt</div>
            <div class="registry-row"><strong>Anschrift:</strong><br>
              Alstertor 15<br>
              20095 Hamburg
            </div>
          </div>
        </div>
      </section>

      <!-- Section 3: Professional Registrations & Permissions -->
      <section class="impressum-card">
        <h2>
          <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #dc2626;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
          Gewerberechtliche Erlaubnisse &amp; Registrierungen
        </h2>
        
        <div class="impressum-text">
          <p>Hier finden Sie die Details zu den erteilten gewerberechtlichen Erlaubnissen und Registrierungen im Vermittlerregister:</p>

          <div class="impressum-grid">
            
            <!-- § 34d GewO Permission Card -->
            <div class="registry-card">
              <div class="registry-title" style="color: #991b1b; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.5rem; margin-bottom: 0.75rem;">
                Erlaubnis nach § 34d GewO
              </div>
              <div class="registry-row"><strong>Berufsbezeichnung:</strong> Versicherungsmakler nach § 34d Abs. 1 Gewerbeordnung; Bundesrepublik Deutschland</div>
              <div class="registry-row"><strong>Registrierungsnummer:</strong> D-CW3N-JH3HE-87</div>
              <div class="registry-row"><strong>Zuständige Aufsichtsbehörde:</strong><br>
                Industrie- und Handelskammer Hamburg<br>
                Adolphsplatz 1<br>
                20457 Hamburg<br>
                <a href="https://www.hk24.de" target="_blank" rel="noopener noreferrer">www.hk24.de</a>
              </div>
              <div class="registry-row"><strong>Mitgliedschaft:</strong> Mitglied der Industrie- und Handelskammer Hamburg</div>
              <div class="registry-row"><strong>Staat der Verleihung:</strong> Bundesrepublik Deutschland</div>
              <div class="registry-row" style="font-size: 0.85rem; color: #64748b; margin-top: 0.75rem;">
                <strong>Berufsrechtliche Regelungen:</strong> § 34d Gewerbeordnung (GewO), §§ 59-68 Gesetz über den Versicherungsvertrag (VVG), Verordnung über die Versicherungsvermittlung und -beratung (VersVermV), abrufbar unter <a href="https://www.gesetze-im-internet.de" target="_blank" rel="noopener noreferrer">www.gesetze-im-internet.de</a>
              </div>
            </div>

            <!-- § 34f GewO Permission Card -->
            <div class="registry-card">
              <div class="registry-title" style="color: #991b1b; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.5rem; margin-bottom: 0.75rem;">
                Erlaubnis nach § 34f GewO
              </div>
              <div class="registry-row"><strong>Berufsbezeichnung:</strong> Finanzanlagenvermittler nach § 34f Abs. 1 Gewerbeordnung; Bundesrepublik Deutschland</div>
              <div class="registry-row"><strong>Registrierungsnummer:</strong> D-F-131-J2R7-27</div>
              <div class="registry-row"><strong>Zuständige Aufsichtsbehörde:</strong><br>
                Industrie- und Handelskammer Hamburg<br>
                Adolphsplatz 1<br>
                20457 Hamburg<br>
                <a href="https://www.hk24.de" target="_blank" rel="noopener noreferrer">www.hk24.de</a>
              </div>
              <div class="registry-row"><strong>Mitgliedschaft:</strong> Mitglied der Industrie- und Handelskammer Hamburg</div>
              <div class="registry-row"><strong>Staat der Verleihung:</strong> Bundesrepublik Deutschland</div>
              <div class="registry-row" style="font-size: 0.85rem; color: #64748b; margin-top: 0.75rem;">
                <strong>Berufsrechtliche Regelungen:</strong> § 34f Gewerbeordnung (GewO), Finanzanlagenvermittlungsverordnung (FinVermV), abrufbar unter <a href="https://www.gesetze-im-internet.de" target="_blank" rel="noopener noreferrer">www.gesetze-im-internet.de</a>
              </div>
            </div>

          </div>

          <p style="margin-top: 1rem;">
            Die Eintragungen im Vermittlerregister können online unter 
            <a href="https://www.vermittlerregister.info" target="_blank" rel="noopener noreferrer">www.vermittlerregister.info</a> 
            eingesehen werden.
          </p>
        </div>
      </section>

      <!-- Section 4: Dispute Resolution -->
      <section class="impressum-card">
        <h2>
          <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #dc2626;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          Verbraucherstreitbeilegung &amp; Schlichtungsstellen
        </h2>
        <div class="impressum-text">
          <p>
            Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit, die Sie unter 
            <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="noopener noreferrer">https://ec.europa.eu/consumers/odr</a> finden.
            Unsere E-Mail-Adresse finden Sie im Anbieterbereich.
          </p>
          <p>
            Wir sind weder bereit noch verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.
          </p>
        </div>
      </section>

      <!-- Section 5: Legal Disclaimers -->
      <section class="impressum-card">
        <h2>
          <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #dc2626;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
          Haftungsausschluss &amp; Urheberrecht
        </h2>
        <div class="impressum-text">
          <h3 style="margin-top: 0;">Haftung für Inhalte</h3>
          <p>
            Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.
          </p>
          
          <h3>Haftung für Links</h3>
          <p>
            Unser Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.
          </p>

          <h3>Urheberrecht</h3>
          <p>
            Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.
          </p>
        </div>
      </section>

    </div>
  </main>

  <footer class="impressum-footer">
    <div class="impressum-container impressum-footer-inner">
      <p class="impressum-footer-copy">
        © {{ date('Y') }} festgeld-jetztvergleichen.com · Alle Rechte vorbehalten.
      </p>
      <p class="impressum-footer-note">
        Der Betreiber ist selbstständiger Versicherungsmakler mit einer Erlaubnis nach § 34d Abs. 1 GewO und selbstständiger Finanzanlagenvermittler mit einer Erlaubnis nach § 34f Abs. 1 GewO.
      </p>
    </div>
  </footer>
</div>
@endsection