{{-- Komponen Pengaturan Margin & Padding Surat SIMAS --}}
<style id="simas-page-margin-style">
    /* Injeksi dinamis margin/padding akan dimasukkan ke sini oleh simasMarginManager */
</style>

<div class="simas-margin-controller" style="display: inline-flex; align-items: center; position: relative;">
    <button type="button" id="btnToggleMarginModal" class="btn" style="background-color: #4b5563; color: white; display: inline-flex; align-items: center; gap: 6px; cursor: pointer;">
        <i class="fa-solid fa-sliders"></i> Atur Margin
    </button>

    {{-- Dropdown / Modal Panel Margin --}}
    <div id="simasMarginPanel" style="display: none; position: absolute; top: calc(100% + 10px); right: 0; background: #ffffff; border: 1px solid #d1d5db; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.25); z-index: 99999; width: 310px; padding: 16px; color: #1f2937; font-family: Arial, sans-serif; text-align: left;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px;">
            <h5 style="margin: 0; font-size: 14px; font-weight: bold; color: #111827; display: flex; align-items: center; gap: 6px;">
                <i class="fa-solid fa-ruler-combined text-primary"></i> Pengaturan Margin & Padding
            </h5>
            <button type="button" id="btnCloseMarginPanel" style="background: none; border: none; font-size: 16px; cursor: pointer; color: #9ca3af;">&times;</button>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px;">
            <div>
                <label style="font-size: 11px; font-weight: bold; display: block; margin-bottom: 4px; color: #4b5563;">Margin Atas (mm)</label>
                <input type="number" id="simas_margin_top" style="width: 100%; padding: 6px 8px; border: 1px solid #d1d5db; border-radius: 4px; font-size: 12px;" min="0" max="60" step="1">
            </div>
            <div>
                <label style="font-size: 11px; font-weight: bold; display: block; margin-bottom: 4px; color: #4b5563;">Margin Bawah (mm)</label>
                <input type="number" id="simas_margin_bottom" style="width: 100%; padding: 6px 8px; border: 1px solid #d1d5db; border-radius: 4px; font-size: 12px;" min="0" max="60" step="1">
            </div>
            <div>
                <label style="font-size: 11px; font-weight: bold; display: block; margin-bottom: 4px; color: #4b5563;">Margin Kiri (mm)</label>
                <input type="number" id="simas_margin_left" style="width: 100%; padding: 6px 8px; border: 1px solid #d1d5db; border-radius: 4px; font-size: 12px;" min="0" max="60" step="1">
            </div>
            <div>
                <label style="font-size: 11px; font-weight: bold; display: block; margin-bottom: 4px; color: #4b5563;">Margin Kanan (mm)</label>
                <input type="number" id="simas_margin_right" style="width: 100%; padding: 6px 8px; border: 1px solid #d1d5db; border-radius: 4px; font-size: 12px;" min="0" max="60" step="1">
            </div>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="font-size: 11px; font-weight: bold; display: block; margin-bottom: 4px; color: #4b5563;">Padding Kertas / Isi (mm)</label>
            <input type="number" id="simas_padding_page" style="width: 100%; padding: 6px 8px; border: 1px solid #d1d5db; border-radius: 4px; font-size: 12px;" min="0" max="40" step="1" placeholder="Opsional (contoh: 5)">
            <small style="font-size: 10px; color: #6b7280;">Memberikan ruang tambahan di dalam tepi kertas</small>
        </div>

        <div style="margin-bottom: 12px;">
            <label style="font-size: 11px; font-weight: bold; display: block; margin-bottom: 4px; color: #4b5563;">Pilihan Cepat (Preset)</label>
            <div style="display: flex; gap: 5px;">
                <button type="button" class="btn-preset" data-top="15" data-bottom="15" data-left="20" data-right="15" data-pad="0" style="flex: 1; padding: 4px 6px; font-size: 10px; border: 1px solid #d1d5db; background: #f9fafb; border-radius: 4px; cursor: pointer;">Standar</button>
                <button type="button" class="btn-preset" data-top="10" data-bottom="10" data-left="15" data-right="10" data-pad="0" style="flex: 1; padding: 4px 6px; font-size: 10px; border: 1px solid #d1d5db; background: #f9fafb; border-radius: 4px; cursor: pointer;">Sempit</button>
                <button type="button" class="btn-preset" data-top="25" data-bottom="20" data-left="25" data-right="20" data-pad="0" style="flex: 1; padding: 4px 6px; font-size: 10px; border: 1px solid #d1d5db; background: #f9fafb; border-radius: 4px; cursor: pointer;">Lebar</button>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e5e7eb; padding-top: 10px;">
            <button type="button" id="btnResetMargin" style="background: none; border: none; color: #ef4444; font-size: 11px; cursor: pointer; text-decoration: underline;">Reset Default</button>
            <button type="button" id="btnApplyMargin" style="background: #2563eb; color: #ffffff; border: none; border-radius: 4px; padding: 6px 14px; font-size: 12px; font-weight: bold; cursor: pointer;">Terapkan</button>
        </div>
    </div>
</div>

<script>
(function() {
    const storageKey = 'simas_page_margins_' + window.location.pathname;

    // Nilai default
    const defaults = {
        top: 15,
        bottom: 15,
        left: 20,
        right: 15,
        padding: 0
    };

    function loadSettings() {
        try {
            const saved = localStorage.getItem(storageKey) || localStorage.getItem('simas_page_margins_default');
            if (saved) {
                return Object.assign({}, defaults, JSON.parse(saved));
            }
        } catch(e) {
            console.warn('Gagal memuat preferensi margin:', e);
        }
        return Object.assign({}, defaults);
    }

    function saveSettings(settings) {
        try {
            localStorage.setItem(storageKey, JSON.stringify(settings));
            localStorage.setItem('simas_page_margins_default', JSON.stringify(settings));
        } catch(e) {
            console.warn('Gagal menyimpan preferensi margin:', e);
        }
    }

    function applyMarginStyles(s) {
        const styleEl = document.getElementById('simas-page-margin-style');
        if (!styleEl) return;

        const topVal = (s.top !== undefined ? s.top : 15);
        const rightVal = (s.right !== undefined ? s.right : 15);
        const bottomVal = (s.bottom !== undefined ? s.bottom : 15);
        const leftVal = (s.left !== undefined ? s.left : 20);
        const padVal = (s.padding !== undefined ? s.padding : 0);

        // Aturan CSS: 
        // 1. @page diset margin 0 agar driver print printer tidak menambahkan margin bawaan/dobel.
        // 2. Margin & Padding dokumen dikontrol langsung pada kontainer (.page, .page-portrait, .page-landscape)
        //    sehingga apa yang terlihat di layar (WYSIWYG) 100% SAMA PERSIS dengan apa yang dicetak.
        styleEl.innerHTML = `
            @page {
                margin: 0 !important;
            }
            @page portrait-page {
                margin: 0 !important;
            }
            @page landscape-page {
                margin: 0 !important;
            }
            .page, .page-portrait, .page-landscape {
                padding-top: calc(${topVal}mm + ${padVal}mm) !important;
                padding-bottom: calc(${bottomVal}mm + ${padVal}mm) !important;
                padding-left: calc(${leftVal}mm + ${padVal}mm) !important;
                padding-right: calc(${rightVal}mm + ${padVal}mm) !important;
            }
            @media screen {
                .page, .page-portrait, .page-landscape {
                    margin-top: 15px !important;
                    margin-bottom: 25px !important;
                }
            }
            @media print {
                html, body {
                    margin: 0 !important;
                    padding: 0 !important;
                    background: none !important;
                }
                .page, .page-portrait, .page-landscape {
                    box-shadow: none !important;
                    margin: 0 auto !important;
                    width: 100% !important;
                    box-sizing: border-box !important;
                }
            }
        `;
    }

    function populateInputs(s) {
        const topInput = document.getElementById('simas_margin_top');
        const bottomInput = document.getElementById('simas_margin_bottom');
        const leftInput = document.getElementById('simas_margin_left');
        const rightInput = document.getElementById('simas_margin_right');
        const padInput = document.getElementById('simas_padding_page');

        if (topInput) topInput.value = s.top;
        if (bottomInput) bottomInput.value = s.bottom;
        if (leftInput) leftInput.value = s.left;
        if (rightInput) rightInput.value = s.right;
        if (padInput) padInput.value = s.padding || 0;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const settings = loadSettings();
        populateInputs(settings);
        applyMarginStyles(settings);

        let committedSettings = Object.assign({}, settings);

        function readCurrentInputValues() {
            return {
                top: parseInt(document.getElementById('simas_margin_top').value, 10) || 0,
                bottom: parseInt(document.getElementById('simas_margin_bottom').value, 10) || 0,
                left: parseInt(document.getElementById('simas_margin_left').value, 10) || 0,
                right: parseInt(document.getElementById('simas_margin_right').value, 10) || 0,
                padding: parseInt(document.getElementById('simas_padding_page').value, 10) || 0
            };
        }

        // Live update saat input berubah
        ['simas_margin_top', 'simas_margin_bottom', 'simas_margin_left', 'simas_margin_right', 'simas_padding_page'].forEach(function(id) {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('input', function() {
                    const current = readCurrentInputValues();
                    applyMarginStyles(current);
                });
            }
        });

        const btnToggle = document.getElementById('btnToggleMarginModal');
        const panel = document.getElementById('simasMarginPanel');
        const btnClose = document.getElementById('btnCloseMarginPanel');
        const btnApply = document.getElementById('btnApplyMargin');
        const btnReset = document.getElementById('btnResetMargin');

        if (btnToggle && panel) {
            btnToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                if (panel.style.display === 'none' || !panel.style.display) {
                    panel.style.display = 'block';
                    // Simpan state sebelum edit jika ingin membatalkan
                    committedSettings = loadSettings();
                } else {
                    panel.style.display = 'none';
                    // Jika ditutup tanpa klik terapkan, kembalikan ke preferensi tersimpan
                    populateInputs(committedSettings);
                    applyMarginStyles(committedSettings);
                }
            });
        }

        if (btnClose && panel) {
            btnClose.addEventListener('click', function() {
                panel.style.display = 'none';
                populateInputs(committedSettings);
                applyMarginStyles(committedSettings);
            });
        }

        document.addEventListener('click', function(e) {
            if (panel && panel.style.display === 'block' && !panel.contains(e.target) && e.target !== btnToggle) {
                panel.style.display = 'none';
                populateInputs(committedSettings);
                applyMarginStyles(committedSettings);
            }
        });

        // Preset buttons - langsung ubah nilai input dan preview live
        document.querySelectorAll('.btn-preset').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const s = {
                    top: parseInt(this.dataset.top, 10),
                    bottom: parseInt(this.dataset.bottom, 10),
                    left: parseInt(this.dataset.left, 10),
                    right: parseInt(this.dataset.right, 10),
                    padding: parseInt(this.dataset.pad, 10) || 0
                };
                populateInputs(s);
                applyMarginStyles(s);
            });
        });

        if (btnApply) {
            btnApply.addEventListener('click', function() {
                const s = readCurrentInputValues();
                applyMarginStyles(s);
                saveSettings(s);
                committedSettings = Object.assign({}, s);
                if (panel) panel.style.display = 'none';
            });
        }

        if (btnReset) {
            btnReset.addEventListener('click', function() {
                populateInputs(defaults);
                applyMarginStyles(defaults);
                saveSettings(defaults);
                committedSettings = Object.assign({}, defaults);
            });
        }
    });
})();
</script>
