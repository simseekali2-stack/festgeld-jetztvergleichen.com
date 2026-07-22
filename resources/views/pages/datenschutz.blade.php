@extends('layouts.app')

@push('styles')
<style>
  .impressum-page {
    background: #f7f1e7;
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
    max-width: 1120px;
    margin: 0 auto;
    padding-left: 1rem;
    padding-right: 1rem;
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
    padding-top: 2rem;
    padding-bottom: 3rem;
  }

  .impressum-back {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #dc2626;
    font-weight: 600;
    text-decoration: none;
    margin-bottom: 1.5rem;
    transition: color 0.2s ease;
  }

  .impressum-back:hover {
    color: #991b1b;
    text-decoration: none;
  }

  .impressum-title {
    font-size: 1.5rem;
    line-height: 2rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.75rem;
  }

  .impressum-title-line {
    width: 6rem;
    height: 2px;
    background: #dc2626;
    margin-bottom: 1.5rem;
  }

  .impressum-content {
    display: flex;
    flex-direction: column;
    gap: 2rem;
  }

  .impressum-section h2 {
    font-size: 1.15rem;
    line-height: 1.6rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.75rem;
  }

  .impressum-section h3 {
    font-size: 1.05rem;
    line-height: 1.5rem;
    font-weight: 600;
    color: #dc2626;
    margin-top: 1rem;
    margin-bottom: 0.5rem;
  }

  .impressum-section h4 {
    font-size: 1rem;
    line-height: 1.5rem;
    font-weight: 700;
    color: #374151;
    margin-top: 0.9rem;
    margin-bottom: 0.4rem;
  }

  .impressum-text {
    color: #374151;
    font-size: 1rem;
    line-height: 1.75;
  }

  .impressum-text p {
    margin-bottom: 0.45rem;
  }

  .impressum-text ul {
    margin: 0.5rem 0 0.75rem 1.25rem;
    padding-left: 1rem;
    list-style: disc;
  }

  .impressum-text li {
    margin-bottom: 0.35rem;
  }

  .impressum-text a {
    color: #dc2626;
    text-decoration: underline;
    word-break: break-word;
  }

  .impressum-text a:hover {
    color: #991b1b;
  }

  .hidden-info-box {
    margin-top: 0.75rem;
    margin-bottom: 0.75rem;
    padding: 1rem;
    border: 1px dashed #d9d2c6;
    border-radius: 0.25rem;
    background: rgba(255, 255, 255, 0.55);
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }

  .hidden-info-row {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
    min-width: 0;
  }

  .hidden-info-icon {
    color: #dc2626;
    font-size: 0.95rem;
    flex-shrink: 0;
  }

  .hidden-info-label {
    font-size: 0.9rem;
    color: #4b5563;
    line-height: 1.4;
  }

  .hidden-info-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.35rem;
    background: #dc2626;
    color: #ffffff;
    border: 0;
    border-radius: 0.25rem;
    padding: 0.55rem 0.95rem;
    font-size: 0.85rem;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s ease;
    width: fit-content;
  }

  .hidden-info-button:hover {
    background: #b91c1c;
  }

  .hidden-info-content {
    display: none;
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid #e5e7eb;
    color: #374151;
    line-height: 1.7;
  }

  .hidden-info-content.is-visible {
    display: block;
  }

  .notice-box {
    padding: 1rem;
    border-left: 4px solid #dc2626;
    background: rgba(220, 38, 38, 0.08);
    margin-top: 0.75rem;
    margin-bottom: 0.75rem;
  }

  .info-box {
    padding: 1rem;
    border-left: 4px solid #7f1d1d;
    background: rgba(127, 29, 29, 0.06);
    margin-top: 0.75rem;
    margin-bottom: 0.75rem;
  }

  .impressum-footer {
    background: #06122a;
    padding-top: 2rem;
    padding-bottom: 2rem;
  }

  .impressum-footer-inner {
    text-align: center;
    color: #ffffff;
  }

  .impressum-footer-copy {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.72);
    margin-bottom: 0.75rem;
  }

  .impressum-footer-note {
    font-size: 0.78rem;
    color: rgba(255, 255, 255, 0.42);
    max-width: 760px;
    margin: 0 auto;
    line-height: 1.6;
  }

  @media (min-width: 640px) {
    .hidden-info-box {
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
    }
  }

  @media (min-width: 768px) {
    .impressum-main {
      padding-top: 3rem;
      padding-bottom: 4rem;
    }

    .impressum-title {
      font-size: 1.75rem;
      line-height: 2.25rem;
    }

    .impressum-section h2 {
      font-size: 1.25rem;
      line-height: 1.75rem;
    }
  }
</style>
@endpush

@section('title', $title ?? 'Datenschutzerklärung | TagesgeldTicker.com')

@section('content')
<div class="impressum-page">
  <div class="impressum-top-line"></div>

  <header class="impressum-header">
    <div class="impressum-container impressum-header-inner">
      <a href="{{ url('/') }}" aria-label="Startseite">
        @if(config('settings.logo'))
          <img src="{{ asset(config('settings.logo')) }}" alt="Logo" class="impressum-logo">
        @else
          <strong style="color:#dc2626;font-size:1.35rem;">TagesgeldTicker.com</strong>
        @endif
      </a>
    </div>
  </header>

  <main class="impressum-container impressum-main">
    <a href="{{ url('/') }}" class="impressum-back">
      <span aria-hidden="true">←</span>
      <span>Zurück zur Startseite</span>
    </a>

    <h1 class="impressum-title">Datenschutzerklärung</h1>
    <div class="impressum-title-line"></div>

    <div class="impressum-content">

      <section class="impressum-section">
        <h2>1. Datenschutz auf einen Blick</h2>

        <div class="impressum-text">
          <h3>Allgemeine Hinweise</h3>

          <p>
            Die folgenden Hinweise geben einen einfachen Überblick darüber, was mit Ihren personenbezogenen Daten passiert,
            wenn Sie diese Website besuchen. Personenbezogene Daten sind alle Daten, mit denen Sie persönlich identifiziert
            werden können.
          </p>

          <h3>Wichtiger Hinweis zu unserem Geschäftsmodell</h3>

          <p>
            Wir sind ein Vergleichsportal. Wenn Sie unser Kontaktformular ausfüllen, können Ihre Angaben zur Bearbeitung
            Ihrer Anfrage verarbeitet und, soweit erforderlich, an geeignete Partner oder Finanzdienstleister weitergegeben
            werden.
          </p>

          <p>
            Wir selbst erbringen keine Finanzberatung, keine Anlagevermittlung und keine Finanzdienstleistungen.
            Unser Portal dient ausschließlich der Information, Anfrageaufnahme und Weiterleitung.
          </p>

          <p><strong>Verantwortliche Stelle für diese Website:</strong></p>

          <div class="company-register-info" style="margin-top: 1rem; margin-bottom: 1.5rem; padding: 1.5rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; background-color: #f8fafc; font-size: 0.95rem; line-height: 1.6; color: #334155;">
            <div style="font-weight: 700; border-bottom: 2px solid #dc2626; padding-bottom: 0.5rem; margin-bottom: 1rem; color: #0f172a; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;">
              <span>Verantwortlicher Betreiber</span>
            </div>
            <div style="display: grid; grid-template-columns: 1fr; gap: 0.75rem;">
              <div><strong>Name:</strong> Dennis Missfeldt</div>
              <div><strong>Berufsbezeichnung:</strong> Diplom-Volkswirt, selbstständiger Versicherungsmakler und Finanzanlagenvermittler</div>
              <div><strong>Geschäftsanschrift:</strong> Alstertor 15, 20095 Hamburg</div>
              <div><strong>Mobil:</strong> <a href="tel:+4915776884663">+49 (0) 157 76884663</a></div>
              <div><strong>E-Mail:</strong> <a href="mailto:info@tagesgeldticker.com">info@tagesgeldticker.com</a></div>
              <div><strong>Erlaubnis nach § 34d GewO:</strong> D-CW3N-JH3HE-87 (Versicherungsmakler)</div>
              <div><strong>Erlaubnis nach § 34f GewO:</strong> D-F-131-J2R7-27 (Finanzanlagenvermittler)</div>
            </div>
          </div>

          <h3>Datenerfassung auf dieser Website</h3>

          <p>
            Die Datenverarbeitung auf dieser Website erfolgt durch den Websitebetreiber. Die Kontaktdaten können Sie dieser
            Datenschutzerklärung sowie dem Impressum dieser Website entnehmen.
          </p>
        </div>
      </section>

      <section class="impressum-section">
        <h2>2. Hosting und Content Delivery Networks</h2>

        <div class="impressum-text">
          <p>
            Diese Website wird bei einem externen Dienstleister gehostet. Die personenbezogenen Daten, die auf dieser Website
            erfasst werden, werden auf den Servern des Hosters gespeichert.
          </p>

          <p>
            Hierbei kann es sich insbesondere um IP-Adressen, Kontaktanfragen, Meta- und Kommunikationsdaten,
            Vertragsdaten, Kontaktdaten, Namen, Websitezugriffe und sonstige Daten handeln, die über eine Website
            generiert werden.
          </p>

          <p>
            Der Einsatz des Hosters erfolgt zum Zweck der sicheren, schnellen und effizienten Bereitstellung unseres
            Online-Angebots.
          </p>
        </div>
      </section>

      <section class="impressum-section">
        <h2>3. Allgemeine Hinweise und Pflichtinformationen</h2>

        <div class="impressum-text">
          <h3>Datenschutz</h3>

          <p>
            Die Betreiber dieser Seiten nehmen den Schutz Ihrer persönlichen Daten sehr ernst. Wir behandeln Ihre
            personenbezogenen Daten vertraulich und entsprechend der gesetzlichen Datenschutzvorschriften sowie dieser
            Datenschutzerklärung.
          </p>

          <p>
            Wenn Sie diese Website benutzen, werden verschiedene personenbezogene Daten erhoben. Diese Datenschutzerklärung
            erläutert, welche Daten wir erheben und wofür wir sie nutzen. Sie erläutert auch, wie und zu welchem Zweck das
            geschieht.
          </p>

          <h3>Hinweis zur verantwortlichen Stelle</h3>

          <p>
            Die verantwortliche Stelle für die Datenverarbeitung auf dieser Website ist:
          </p>

          <div class="company-details-block" style="margin-top: 1rem; margin-bottom: 1.5rem; padding: 1.25rem; border: 1px solid #e2e8f0; border-radius: 0.375rem; background-color: #f8fafc; font-size: 0.95rem; line-height: 1.6; color: #334155;">
            <strong>Dennis Missfeldt</strong><br>
            Alstertor 15<br>
            20095 Hamburg<br>
            Deutschland<br><br>
            E-Mail: <a href="mailto:info@tagesgeldticker.com">info@tagesgeldticker.com</a><br>
            Mobil: <a href="tel:+4915776884663">+49 (0) 157 76884663</a>
          </div>

          <p>
            Verantwortliche Stelle ist die natürliche oder juristische Person, die allein oder gemeinsam mit anderen über
            die Zwecke und Mittel der Verarbeitung von personenbezogenen Daten entscheidet.
          </p>

          <h3>Speicherdauer</h3>

          <p>
            Soweit innerhalb dieser Datenschutzerklärung keine speziellere Speicherdauer genannt wurde, verbleiben Ihre
            personenbezogenen Daten bei uns, bis der Zweck für die Datenverarbeitung entfällt. Wenn Sie ein berechtigtes
            Löschersuchen geltend machen oder eine Einwilligung zur Datenverarbeitung widerrufen, werden Ihre Daten gelöscht,
            sofern wir keine anderen rechtlich zulässigen Gründe für die Speicherung Ihrer personenbezogenen Daten haben.
          </p>

          <h3>Widerruf Ihrer Einwilligung zur Datenverarbeitung</h3>

          <p>
            Viele Datenverarbeitungsvorgänge sind nur mit Ihrer ausdrücklichen Einwilligung möglich. Sie können eine bereits
            erteilte Einwilligung jederzeit widerrufen. Die Rechtmäßigkeit der bis zum Widerruf erfolgten Datenverarbeitung
            bleibt vom Widerruf unberührt.
          </p>

          <h3>Beschwerderecht bei der zuständigen Aufsichtsbehörde</h3>

          <p>
            Im Falle von Verstößen gegen die DSGVO steht den Betroffenen ein Beschwerderecht bei einer Aufsichtsbehörde zu.
            Das Beschwerderecht besteht unbeschadet anderweitiger verwaltungsrechtlicher oder gerichtlicher Rechtsbehelfe.
          </p>
        </div>
      </section>

      <section class="impressum-section">
        <h2>4. Datenerfassung auf dieser Website</h2>

        <div class="impressum-text">
          <h3>Cookies</h3>

          <p>
            Unsere Internetseiten verwenden sogenannte Cookies. Cookies sind kleine Datenpakete und richten auf Ihrem
            Endgerät keinen Schaden an. Sie werden entweder vorübergehend für die Dauer einer Sitzung oder dauerhaft auf
            Ihrem Endgerät gespeichert.
          </p>

          <p>
            Cookies können technisch notwendig sein, um bestimmte Funktionen der Website bereitzustellen. Andere Cookies
            können zur Analyse des Nutzerverhaltens verwendet werden, sofern hierfür eine entsprechende Rechtsgrundlage
            besteht.
          </p>

          <h3>Server-Log-Dateien</h3>

          <p>
            Der Provider der Seiten erhäbt und speichert automatisch Informationen in sogenannten Server-Log-Dateien, die
            Ihr Browser automatisch an uns übermittelt. Dies können insbesondere sein:
          </p>

          <ul>
            <li>Browsertyp und Browserversion</li>
            <li>verwendetes Betriebssystem</li>
            <li>Referrer URL</li>
            <li>Hostname des zugreifenden Rechners</li>
            <li>Uhrzeit der Serveranfrage</li>
            <li>IP-Adresse</li>
          </ul>

          <p>
            Eine Zusammenführung dieser Daten mit anderen Datenquellen wird nicht vorgenommen, soweit dies nicht zur
            Aufklärung rechtswidriger Nutzung oder zur Sicherheit des Angebots erforderlich ist.
          </p>

          <h3>Kontaktformular und Anfrageübermittlung</h3>

          <p>
            Wenn Sie uns per Kontaktformular Anfragen zukommen lassen, werden Ihre Angaben aus dem Anfrageformular inklusive
            der von Ihnen dort angegebenen Kontaktdaten zwecks Bearbeitung der Anfrage und für den Fall von Anschlussfragen
            bei uns gespeichert.
          </p>

          <p><strong>Art der verarbeiteten Daten:</strong></p>

          <ul>
            <li>Anrede</li>
            <li>Vor- und Nachname</li>
            <li>E-Mail-Adresse</li>
            <li>Telefonnummer</li>
            <li>Anlagebetrag und gewünschte Laufzeit</li>
            <li>IP-Adresse und Zeitpunkt der Anfrage</li>
            <li>technische Daten wie User-Agent und Referrer</li>
          </ul>

          <p><strong>Zweck der Datenverarbeitung:</strong></p>

          <p>
            Die Daten werden zum Zweck der Bearbeitung Ihrer Anfrage, der Kontaktaufnahme sowie gegebenenfalls der
            Weiterleitung an geeignete Partner oder Finanzdienstleister verarbeitet.
          </p>

          <p><strong>Rechtsgrundlage:</strong></p>

          <p>
            Die Verarbeitung erfolgt, soweit eine Einwilligung eingeholt wurde, auf Grundlage von Art. 6 Abs. 1 lit. a DSGVO.
            Soweit die Verarbeitung zur Durchführung vorvertraglicher Maßnahmen erforderlich ist, erfolgt sie auf Grundlage
            von Art. 6 Abs. 1 lit. b DSGVO. Im Übrigen kann die Verarbeitung auf Grundlage unseres berechtigten Interesses
            gemäß Art. 6 Abs. 1 lit. f DSGVO erfolgen.
          </p>

          <div class="notice-box">
            <p>
              <strong>Wichtiger Hinweis:</strong> Bereits übermittelte Daten können von uns nicht in jedem Fall zurückgeholt
              werden. Für die weitere Verarbeitung durch einen eigenständigen Empfänger ist der jeweilige Empfänger
              verantwortlich.
            </p>
          </div>
        </div>
      </section>

      <section class="impressum-section">
        <h2>5. Weitergabe von Daten</h2>

        <div class="impressum-text">
          <p>
            Eine Übermittlung Ihrer personenbezogenen Daten an Dritte findet nur statt, wenn dies zur Bearbeitung Ihrer
            Anfrage erforderlich ist, Sie eingewilligt haben, eine gesetzliche Verpflichtung besteht oder eine sonstige
            Rechtsgrundlage nach der DSGVO vorliegt.
          </p>

          <p><strong>Mögliche Empfänger Ihrer Daten:</strong></p>

          <div class="company-details-block" style="margin-top: 1rem; margin-bottom: 1.5rem; padding: 1.25rem; border: 1px solid #e2e8f0; border-radius: 0.375rem; background-color: #f8fafc; font-size: 0.95rem; line-height: 1.6; color: #334155;">
            Je nach Anfrage können Daten an geeignete Partner, Vermittler oder Finanzdienstleister übermittelt werden,
            soweit dies zur Bearbeitung Ihrer Anfrage erforderlich ist oder Sie hierzu eingewilligt haben.
          </div>

          <p>
            Mit einer erfolgreichen Übermittlung kann der jeweilige Empfänger eigenständiger Verantwortlicher im Sinne von
            Art. 4 Nr. 7 DSGVO werden. Betroffenenrechte hinsichtlich der weiteren Verarbeitung sind dann direkt gegenüber
            dem jeweiligen Empfänger geltend zu machen.
          </p>
        </div>
      </section>

      <section class="impressum-section">
        <h2>6. Datenübermittlung in Drittländer</h2>

        <div class="impressum-text">
          <p>
            Sofern eine Übermittlung personenbezogener Daten an Empfänger außerhalb der Europäischen Union oder des
            Europäischen Wirtschaftsraums erfolgt, geschieht dies nur, soweit hierfür eine geeignete Rechtsgrundlage und
            geeignete Garantien bestehen.
          </p>

          <p>
            Geeignete Garantien können insbesondere EU-Standardvertragsklauseln, ein Angemessenheitsbeschluss der
            EU-Kommission oder eine ausdrückliche Einwilligung der betroffenen Person sein.
          </p>

          <div class="info-box">
            <p>
              Bei einer Datenübermittlung in Drittländer kann ein von der EU abweichendes Datenschutzniveau bestehen.
              Darüber informieren wir Sie, soweit eine solche Übermittlung im konkreten Fall relevant ist.
            </p>
          </div>
        </div>
      </section>

      <section class="impressum-section">
        <h2>7. Ihre Rechte als betroffene Person</h2>

        <div class="impressum-text">
          <p>
            Sie haben nach der DSGVO umfassende Rechte bezüglich Ihrer personenbezogenen Daten.
          </p>

          <h3>Ihre Betroffenenrechte im Einzelnen</h3>

          <ul>
            <li><strong>Auskunftsrecht:</strong> Sie können Auskunft über Ihre gespeicherten personenbezogenen Daten verlangen.</li>
            <li><strong>Berichtigungsrecht:</strong> Sie können die Berichtigung unrichtiger oder unvollständiger Daten verlangen.</li>
            <li><strong>Löschungsrecht:</strong> Sie können unter bestimmten Voraussetzungen die Löschung Ihrer Daten verlangen.</li>
            <li><strong>Einschränkung der Verarbeitung:</strong> Sie können unter bestimmten Voraussetzungen die Einschränkung der Verarbeitung verlangen.</li>
            <li><strong>Datenübertragbarkeit:</strong> Sie können die Herausgabe bestimmter Daten in einem strukturierten, gängigen und maschinenlesbaren Format verlangen.</li>
            <li><strong>Widerspruchsrecht:</strong> Sie können der Verarbeitung Ihrer Daten aus Gründen widersprechen, die sich aus Ihrer besonderen Situation ergeben.</li>
            <li><strong>Widerrufsrecht:</strong> Sie können eine erteilte Einwilligung jederzeit mit Wirkung für die Zukunft widerrufen.</li>
          </ul>

          <h3>Geltendmachung Ihrer Rechte</h3>

          <p>
            Zur Geltendmachung Ihrer Rechte wenden Sie sich bitte an die verantwortliche Stelle:
          </p>

          <div class="company-details-block" style="margin-top: 1rem; margin-bottom: 1.5rem; padding: 1.25rem; border: 1px solid #e2e8f0; border-radius: 0.375rem; background-color: #f8fafc; font-size: 0.95rem; line-height: 1.6; color: #334155;">
            <strong>Dennis Missfeldt</strong><br>
            Alstertor 15<br>
            20095 Hamburg<br>
            Deutschland<br>
            E-Mail: <a href="mailto:info@tagesgeldticker.com">info@tagesgeldticker.com</a>
          </div>

          <p>
            Wir werden Ihre Anfrage unverzüglich, spätestens aber innerhalb eines Monats beantworten. In komplexen Fällen
            kann diese Frist um zwei weitere Monate verlängert werden.
          </p>
        </div>
      </section>

      <section class="impressum-section">
        <h2>8. Soziale Medien</h2>

        <div class="impressum-text">
          <p>
            Wir können Onlinepräsenzen innerhalb sozialer Netzwerke unterhalten, um mit Interessenten und Nutzern zu
            kommunizieren und über unsere Leistungen zu informieren.
          </p>

          <p>
            Beim Besuch solcher Profile gelten zusätzlich die Datenschutzbestimmungen der jeweiligen Plattformbetreiber.
          </p>
        </div>
      </section>

      <section class="impressum-section">
        <h2>9. Plugins und Tools</h2>

        <div class="impressum-text">
          <h3>Lokale Schriftarten</h3>

          <p>
            Diese Seite kann zur einheitlichen Darstellung von Schriftarten lokal eingebundene Web Fonts nutzen.
            Eine Verbindung zu Servern externer Schriftanbieter findet dabei nicht statt, sofern die Schriften lokal
            bereitgestellt werden.
          </p>

          <h3>Externe Links</h3>

          <p>
            Unsere Website kann Links zu externen Websites enthalten. Für die Inhalte und die Datenschutzpraktiken der
            verlinkten Seiten sind ausschließlich deren Betreiber verantwortlich.
          </p>
        </div>
      </section>

      <section class="impressum-section">
        <h2>10. Aktualität und Änderung dieser Datenschutzerklärung</h2>

        <div class="impressum-text">
          <p>
            Diese Datenschutzerklärung ist aktuell gültig. Durch die Weiterentwicklung unserer Website oder aufgrund
            geänderter gesetzlicher beziehungsweise behördlicher Vorgaben kann es notwendig werden, diese Datenschutzerklärung
            zu ändern.
          </p>

          <p>
            <strong>Stand:</strong> {{ date('F Y') }}
          </p>
        </div>
      </section>

    </div>
  </main>

  <footer class="impressum-footer">
    <div class="impressum-container impressum-footer-inner">
      <p class="impressum-footer-copy">
        © {{ date('Y') }} tagesgeldticker.com · Alle Rechte vorbehalten.
      </p>

      <p class="impressum-footer-note">
        Der Betreiber ist selbstständiger Versicherungsmakler mit einer Erlaubnis nach § 34d Abs. 1 GewO und selbstständiger Finanzanlagenvermittler mit einer Erlaubnis nach § 34f Abs. 1 GewO.
      </p>
    </div>
  </footer>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.hidden-info-button');

    const eyeSvg = `<svg class="inline-block align-text-bottom" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:1rem;height:1rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>`;
    const eyeOffSvg = `<svg class="inline-block align-text-bottom" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:1rem;height:1rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path></svg>`;

    buttons.forEach(function (button) {
      button.addEventListener('click', function () {
        const targetId = button.getAttribute('data-target');
        const target = document.getElementById(targetId);

        if (!target) {
          return;
        }

        target.classList.toggle('is-visible');

        const btnIcon = button.querySelector('.btn-icon');
        const btnText = button.querySelector('.btn-text');

        if (target.classList.contains('is-visible')) {
          if (btnIcon) btnIcon.innerHTML = eyeOffSvg;
          if (btnText) btnText.textContent = 'Ausblenden';
        } else {
          if (btnIcon) btnIcon.innerHTML = eyeSvg;
          if (btnText) btnText.textContent = 'Anzeigen';
        }
      });
    });
  });
</script>
@endsection