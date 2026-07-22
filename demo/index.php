<?php
    session_start();
    ob_start();
    require_once 'admin/db.php';
    require_once 'inc/api.php';

    $api = new API();
    $banks = $api->get('api/credits/list')['data'];

    usort($banks, function($a, $b) {
        $rateA = $a['interest_rate'] ?? 0;
        $rateB = $b['interest_rate'] ?? 0;
        return $rateB <=> $rateA;
    });

    $amount = 25000;
    $duration = 12;

    if (!empty($_GET)) {
        $amount = isset($_GET['amount']) ? intval($_GET['amount']) : 25000;
        $duration = isset($_GET['duration']) ? intval($_GET['duration']) : 12;
        if (isset($amount)) { $amount = max(0, $amount); }
        if (isset($duration)) { $duration = min(120, max(1, $duration)); }

        $params = [
            'amount' => $amount ?? 25000,
            'currency' => 'EUR',
            'duration' => $duration ?? 12,
            'duration_unit' => 'months',
        ];

        foreach ($banks as $key => $bank) {
            if (isset($bank['min_amount']) && $params['amount'] < $bank['min_amount']) { unset($banks[$key]); continue; }
            if (isset($bank['max_amount']) && $params['amount'] > $bank['max_amount']) { unset($banks[$key]); continue; }
            if (isset($bank['min_term']) && $params['duration'] < $bank['min_term']) { unset($banks[$key]); continue; }
            if (isset($bank['max_term']) && $params['duration'] > $bank['max_term']) { unset($banks[$key]); continue; }
        }
    }

    $head_title = "Ana Sayfa";
    include 'layout/header.php';
?>

    <section id="hero" class="bg-gradient-to-br from-blue-950 to-blue-700 min-h-[70vh] text-white flex items-center">
        <div class="container py-12 md:py-24 grid grid-cols-1 md:grid-cols-2 mx-auto gap-8 md:gap-12 px-4">
            <div>
                <div class="text-3xl md:text-5xl font-bold leading-tight mb-4 md:mb-6 text-white text-shadow-md">
                Maximieren Sie Ihre Rendite mit unserem Festgeld-Vergleich
                </div>
                <div class="text-lg md:text-xl text-[rgba(255,255,255,.75)]">
                    Vergleichen Sie die besten Festgeld-Angebote und finden Sie die höchsten Zinssätze für Ihre Anlage.
                </div>
            </div>
            <div>
                <div class="bg-gradient-to-br from-white to-gray-300 p-6 md:p-8 rounded shadow-lg w-full md:w-3/4 md:ml-auto">
                    <div class="text-xl md:text-2xl font-bold text-gray-900">
                        Festgeld Rechner
                    </div>
                    <form method="GET" action="" class="mt-4 md:mt-6 space-y-4">
                        <div>
                            <label for="amount" class="block font-semibold mb-2 text-slate-700">Anlagebetrag</label>
                            <div class="grid grid-cols-2 sm:grid-cols-[6fr_1fr] gap-1 text-black">
                                <input type="number" id="amount" name="amount" value="<?php echo isset($params['amount']) ? $params['amount'] : 25000; ?>" class="w-full bg-white border border-gray-300 rounded-xs px-3 py-2 text-base">
                                <select id="currency" class="w-full bg-white border border-gray-300 rounded-xs px-3 py-2">
                                    <option value="EUR">€</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="duration" class="block font-semibold mb-2 text-slate-700">Laufzeit</label>
                            <div class="grid grid-cols-2 sm:grid-cols-[2fr_1fr] gap-1 text-black">
                                <input type="number" id="duration" name="duration" value="<?php echo isset($params['duration']) ? $params['duration'] : 12; ?>" class="w-full bg-white border border-gray-300 rounded-xs px-3 py-2" placeholder="12">
                                <select id="duration-unit" name="duration-unit" class="w-full bg-white border border-gray-300 rounded-xs px-3 py-2">
                                    <option value="months">Monate</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-br hover:from-blue-800 hover:to-blue-600 py-4 text-white font-bold rounded-xs from-gray-700 to-gray-900 transition cursor-pointer">
                            Angebote vergleichen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-12 border-b border-gray-200 shadow-inner">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 md:gap-0">
                <!-- Item 1 -->
                <div class="flex flex-col items-center text-center px-6 md:border-r border-gray-300">
                    <div class="w-32 h-44 flex items-center justify-center mb-4">
                        <img src="./public/s1.webp" alt="Zertifikat 1" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-blue-900 font-medium text-lg leading-tight max-w-[200px]">
                        Exzellenter Service und beste Finanzlösungen
                    </p>
                </div>
                <!-- Item 2 -->
                <div class="flex flex-col items-center text-center px-6 md:border-r border-gray-300">
                    <div class="w-32 h-44 flex items-center justify-center mb-4">
                        <img src="./public/s2.webp" alt="Zertifikat 2" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-blue-900 font-medium text-lg leading-tight max-w-[200px]">
                        Top-Zinsen für Ihre sichere Geldanlage – mehrfach ausgezeichnet
                    </p>
                </div>
                <!-- Item 3 -->
                <div class="flex flex-col items-center text-center px-6 md:border-r border-gray-300">
                    <div class="w-32 h-44 flex items-center justify-center mb-4">
                        <img src="./public/s3.webp" alt="Zertifikat 3" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-blue-900 font-medium text-lg leading-tight max-w-[200px]">
                        Attraktive Zinsen und maximale Flexibilität – das Beste Tagesgeld
                    </p>
                </div>
                <!-- Item 4 -->
                <div class="flex flex-col items-center text-center px-6">
                    <div class="w-32 h-44 flex items-center justify-center mb-4">
                        <img src="./public/s4.webp" alt="Zertifikat 4" class="max-w-full max-h-full object-contain">
                    </div>
                    <p class="text-blue-900 font-medium text-lg leading-tight max-w-[240px]">
                        1. Platz für die digitale Vermögensverwaltung in der Kategorie Robo-Advisor Performance
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="list">
        <div class="container mx-auto px-4 text-center mb-12 mt-8">
            <h2 class="text-blue-800 font-bold text-4xl">Aktuelle Angebote</h2>
        </div>
        <div class="container mx-auto px-4">
            <?php if (!empty($banks)): ?>
                <?php foreach ($banks as $bank): if ($bank['id'] === '5fcc7312-7754-4a1e-96fd-53e70f3b1514') continue; ?>
                    <div class="bg-white shadow-xl rounded-md p-4 md:p-8 flex flex-col lg:flex-row gap-4 lg:gap-6 mb-6">
                        <div class="w-full lg:w-[200px] flex justify-center items-center">
                            <img src="<?php echo htmlspecialchars($bank['banks']['logo_url'] ?? 'https://placehold.co/200x200'); ?>" alt="<?php echo htmlspecialchars($bank['banks']['name'] ?? 'Bank'); ?>" class="max-w-[150px] lg:max-w-full"/>
                        </div>
                        <div class="flex-1">
                            <span class="text-xl md:text-2xl text-gray-800 font-bold"><?php echo htmlspecialchars($bank['banks']['name'] ?? 'N/A'); ?></span>
                            <div class="text-sm text-gray-600 mt-2"><?php echo htmlspecialchars($bank['credit_type'] ?? ''); ?></div>
                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 mt-4">
                                <div class="bg-white border border-slate-300 rounded-lg p-3 md:p-4 shadow-sm text-center">
                                    <div class="text-gray-500 text-xs md:text-sm mb-2">Zinssatz</div>
                                    <div class="text-2xl md:text-3xl text-green-600 font-bold"><?php echo number_format($bank['interest_rate'] ?? 0, 2); ?>%</div>
                                </div>
                                <div class="bg-white border border-slate-300 rounded-lg p-3 md:p-4 shadow-sm text-center">
                                    <div class="text-gray-500 text-xs md:text-sm mb-2">Laufzeit</div>
                                    <div class="text-lg md:text-2xl text-gray-800 font-bold"><?php echo $duration; ?> <span class="text-sm text-gray-500">Monate</span></div>
                                </div>
                                <div class="bg-white border border-slate-300 rounded-lg p-3 md:p-4 shadow-sm text-center">
                                    <div class="text-gray-500 text-xs md:text-sm mb-2">Zinsbetrag</div>
                                    <div class="text-lg md:text-2xl text-gray-800 font-bold">€<?php echo number_format($bank['interest_rate'] * $amount / 100, 2); ?></div>
                                </div>
                                <div class="bg-white border border-slate-300 rounded-lg p-3 md:p-4 shadow-sm text-center">
                                    <div class="text-gray-500 text-xs md:text-sm mb-2">Anlagebetrag</div>
                                    <div class="text-lg md:text-2xl text-gray-800 font-bold">€<?php echo number_format($amount, 2); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center lg:justify-end w-full lg:w-1/5">
                            <button type="button" class="w-full lg:w-auto bg-gradient-to-br from-blue-700 to-blue-900 hover:from-blue-800 hover:to-blue-600 text-white font-bold py-3 px-6 rounded-xs transition cursor-pointer open-modal-btn" data-bank-id="<?php echo htmlspecialchars($bank['bank_id'] ?? ''); ?>" data-credit-option-id="<?php echo htmlspecialchars($bank['id'] ?? ''); ?>" data-bank-name="<?php echo htmlspecialchars($bank['banks']['name'] ?? 'Bank'); ?>" data-requested-amount="<?=$amount?>" data-requested-term="<?=$duration?>">
                                Weitere Infos
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center text-gray-600 py-8">Keine Angebote verfügbar</div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Content Sections (Sizin orijinal içeriğinizin düzenlenmiş hali) -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-5xl">
            <h2 class="text-blue-800 text-3xl font-bold text-center mb-12">In nur drei einfachen Schritten Festgeld anlegen</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-slate-50 p-6 rounded-xl border border-slate-100 shadow-sm">
                    <div class="text-blue-600 text-2xl font-black mb-4">01</div>
                    <div class="font-bold text-lg mb-2">Angebote vergleichen</div>
                    <div class="text-gray-600">Nutzen Sie die Plattform, um verschiedene Festgeldangebote übersichtlich gegenüberzustellen.</div>
                </div>
                <div class="bg-slate-50 p-6 rounded-xl border border-slate-100 shadow-sm">
                    <div class="text-blue-600 text-2xl font-black mb-4">02</div>
                    <div class="font-bold text-lg mb-2">Konto eröffnen</div>
                    <div class="text-gray-600">Mit wenigen Klicks eröffnen Sie bir Konto bei der ausgewählten Bank.</div>
                </div>
                <div class="bg-slate-50 p-6 rounded-xl border border-slate-100 shadow-sm">
                    <div class="text-blue-600 text-2xl font-black mb-4">03</div>
                    <div class="font-bold text-lg mb-2">Geld anlegen</div>
                    <div class="text-gray-600">Überweisen Sie den Betrag ve schon beginnt Ihre Anlage zu wachsen.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal ve Scripts -->
    <div id="applicationModal" class="hidden fixed inset-0 z-[111] items-center justify-center p-4" style="background: rgba(0, 0, 0, 0.7);">
        <style>
            .iti { width: 100% !important; display: block !important; }
            .iti__flag-container { z-index: 10; }
            /* Modal içinde bayrak listesinin düzgün görünmesi için */
            .iti--container { z-index: 10000; }
        </style>
        <div class="bg-white rounded-xl w-full max-w-2xl shadow-2xl overflow-hidden">
            <div class="bg-blue-900 text-white px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-bold">Kontakt</h2>
                <button id="closeModal" class="text-white text-3xl">&times;</button>
            </div>
            <form id="applicationForm" class="p-6 space-y-4">
                <input type="hidden" id="bankId" name="bank_id">
                <input type="hidden" id="creditOptionId" name="credit_option_id">
                <input type="hidden" id="requestedAmount" name="requested_amount">
                <input type="hidden" id="requestedTerm" name="requested_term">
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="first_name" required placeholder="Vorname *" class="w-full border p-3 rounded">
                    <input type="text" name="last_name" required placeholder="Nachname *" class="w-full border p-3 rounded">
                </div>
                <input type="email" name="email" required placeholder="E-Mail *" class="w-full border p-3 rounded">
                <input type="tel" id="phone" name="phone" placeholder="Telefon" class="w-full border p-3 rounded">
                <div id="formMessage" class="hidden p-4 rounded text-sm"></div>
                <button type="submit" class="w-full bg-blue-700 text-white font-bold py-3 rounded hover:bg-blue-800 transition">Anfrage senden</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/intlTelInput.min.js"></script>
    <script>
        $(function() {
            const phoneInput = document.querySelector("#phone");
            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "de",
                countryOrder: ["de", "ch", "at", "it", "gr", "fr"],
                separateDialCode: true,
                dropdownContainer: document.body,
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/utils.js",
            });

            $('.open-modal-btn').on('click', function() {
                $('#bankId').val($(this).data('bank-id'));
                $('#creditOptionId').val($(this).data('credit-option-id'));
                $('#requestedAmount').val($(this).data('requested-amount'));
                $('#requestedTerm').val($(this).data('requested-term'));
                $('#applicationModal').removeClass('hidden').addClass('flex');
                $('body').css('overflow', 'hidden');
            });
            $('#closeModal, #applicationModal').on('click', function(e) {
                if (e.target === this) {
                    $('#applicationModal').addClass('hidden').removeClass('flex');
                    $('body').css('overflow', '');
                }
            });
            $('#applicationForm').on('submit', function(e) {
                e.preventDefault();
                const btn = $(this).find('button');
                btn.prop('disabled', true).text('Sends...');
                const formData = Object.fromEntries(new FormData(this));
                // Seçilen ülke kodu ile birlikte tam numarayı al
                const fullPhone = iti.getNumber();
                if (fullPhone) {
                    formData.phone = fullPhone;
                } else if (formData.phone) {
                    // iti.getNumber() boş dönerse (geçersiz numara durumu vb.), manuel olarak ülke kodunu ekle
                    const countryData = iti.getSelectedCountryData();
                    if (countryData && countryData.dialCode) {
                        formData.phone = "+" + countryData.dialCode + formData.phone.replace(/^0+/, '');
                    }
                }
                
                $.ajax({
                    url: 'inc/submit_application.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    success: function(res) {
                        $('#formMessage').removeClass('hidden').addClass('bg-green-100 text-green-800').text('Erfolgreich gesendet!');
                        setTimeout(() => $('#closeModal').click(), 2000);
                    },
                    error: function() { $('#formMessage').removeClass('hidden').addClass('bg-red-100 text-red-800').text('Fehler!'); },
                    complete: function() { btn.prop('disabled', false).text('Anfrage senden'); }
                });
            });
        });

        const asc = <?=json_encode(isset($_GET['amount']))?>;

        if (asc) {
            $('html, body').animate({
                scrollTop: $('#list').offset().top
            }, 1000);
        }
    </script>

<?php include 'layout/footer.php'; ?>