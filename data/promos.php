<?php
/**
 * Promos data — converted from src/lib/promos.ts
 */

declare(strict_types=1);

$PROMO_MODELS = [
        [
            "key" => "ex2-pro",
            "label" => "EX2 Pro",
            "price" => 239900000,
        ],
        [
            "key" => "ex2-max",
            "label" => "EX2 Max",
            "price" => 269900000,
        ],
        [
            "key" => "coolray-flagship",
            "label" => "Coolray Flagship",
            "price" => 377000000,
        ],
        [
            "key" => "ex5-pro",
            "label" => "EX5 Pro",
            "price" => 465000000,
        ],
        [
            "key" => "starray-emi",
            "label" => "Starray EM-i",
            "price" => 499000000,
        ],
        [
            "key" => "ex5-max",
            "label" => "EX5 Max",
            "price" => 505000000,
        ],
    ];

$PROMO_PROGRAMS = [
        [
            "id" => "cimb",
            "finance" => "CIMB Niaga Finance",
            "program" => [
                "id" => "Simulasi ADDM Kombinasi",
                "en" => "ADDM Combined Simulation",
            ],
            "period" => [
                "id" => "Lembar simulasi — Juli 2026",
                "en" => "Simulation sheet — July 2026",
            ],
            "badge" => [
                "id" => "Angsuran mulai 4,7 jt",
                "en" => "From Rp4.7M / mo",
            ],
            "highlights" => [
                [
                    "id" => "Tenor 11–59 bulan (5 & 59 bulan tersedia untuk dua varian EX2)",
                    "en" => "Tenors 11–59 months (5 options per model)",
                ],
                [
                    "id" => "Struktur ADDM kombinasi — bayar pertama sudah termasuk biaya-biaya awal",
                    "en" => "Combined ADDDM structure — first payment covers initial fees",
                ],
                [
                    "id" => "Pilihan tenor panjang hingga ±5 tahun untuk angsuran ringan",
                    "en" => "Long tenors up to ±5 years for lighter installments",
                ],
            ],
            "requirements" => [
                [
                    "id" => "KTP Suami + Istri",
                    "en" => "Husband + wife ID cards",
                ],
                [
                    "id" => "Foto selfi",
                    "en" => "Selfie photo",
                ],
                [
                    "id" => "NPWP",
                    "en" => "Tax ID (NPWP)",
                ],
            ],
            "pdf" => "/promos/simulasi-cimb-niaga.pdf",
            "models" => [
                "starray-emi",
                "ex5-pro",
                "ex5-max",
                "ex2-pro",
                "ex2-max",
            ],
            "subPrograms" => [
                [
                    "id" => "adddm",
                    "name" => [
                        "id" => "ADDM Kombinasi",
                        "en" => "ADDM Combined",
                    ],
                    "firstPaymentLabel" => [
                        "id" => "Total bayar pertama",
                        "en" => "Total first payment",
                    ],
                    "rows" => [
                        "starray-emi" => [
                            [
                                "tenor" => 11,
                                "installment" => 38204000,
                                "firstPayment" => 130730000,
                            ],
                            [
                                "tenor" => 23,
                                "installment" => 19791000,
                                "firstPayment" => 114974000,
                            ],
                            [
                                "tenor" => 35,
                                "installment" => 13553000,
                                "firstPayment" => 111755000,
                            ],
                            [
                                "tenor" => 47,
                                "installment" => 10809000,
                                "firstPayment" => 112135000,
                            ],
                            [
                                "tenor" => 59,
                                "installment" => 9956000,
                                "firstPayment" => 114412000,
                            ],
                        ],
                        "ex5-pro" => [
                            [
                                "tenor" => 11,
                                "installment" => 36366000,
                                "firstPayment" => 124521000,
                            ],
                            [
                                "tenor" => 23,
                                "installment" => 18839000,
                                "firstPayment" => 109523000,
                            ],
                            [
                                "tenor" => 35,
                                "installment" => 12902000,
                                "firstPayment" => 106460000,
                            ],
                            [
                                "tenor" => 47,
                                "installment" => 10289000,
                                "firstPayment" => 106831000,
                            ],
                            [
                                "tenor" => 59,
                                "installment" => 9477000,
                                "firstPayment" => 109012000,
                            ],
                        ],
                        "ex5-max" => [
                            [
                                "tenor" => 11,
                                "installment" => 38663000,
                                "firstPayment" => 132281000,
                            ],
                            [
                                "tenor" => 23,
                                "installment" => 20029000,
                                "firstPayment" => 116336000,
                            ],
                            [
                                "tenor" => 35,
                                "installment" => 13716000,
                                "firstPayment" => 113079000,
                            ],
                            [
                                "tenor" => 47,
                                "installment" => 10939000,
                                "firstPayment" => 113461000,
                            ],
                            [
                                "tenor" => 59,
                                "installment" => 10075000,
                                "firstPayment" => 115761000,
                            ],
                        ],
                        "ex2-pro" => [
                            [
                                "tenor" => 11,
                                "installment" => 18367000,
                                "firstPayment" => 71365000,
                            ],
                            [
                                "tenor" => 23,
                                "installment" => 9515000,
                                "firstPayment" => 64106000,
                            ],
                            [
                                "tenor" => 35,
                                "installment" => 6516000,
                                "firstPayment" => 62717000,
                            ],
                            [
                                "tenor" => 47,
                                "installment" => 5197000,
                                "firstPayment" => 63155000,
                            ],
                            [
                                "tenor" => 59,
                                "installment" => 4787000,
                                "firstPayment" => 64550000,
                            ],
                        ],
                        "ex2-max" => [
                            [
                                "tenor" => 11,
                                "installment" => 20664000,
                                "firstPayment" => 79203000,
                            ],
                            [
                                "tenor" => 23,
                                "installment" => 10705000,
                                "firstPayment" => 71016000,
                            ],
                            [
                                "tenor" => 35,
                                "installment" => 7331000,
                                "firstPayment" => 69311000,
                            ],
                            [
                                "tenor" => 47,
                                "installment" => 5847000,
                                "firstPayment" => 69759000,
                            ],
                            [
                                "tenor" => 59,
                                "installment" => 5385000,
                                "firstPayment" => 71269000,
                            ],
                        ],
                    ],
                ],
            ],
            "accent" => "#8b1d2c",
        ],
        [
            "id" => "bri",
            "finance" => "BRI Finance",
            "program" => [
                "id" => "Paket Angsuran Briflexy One — 50-50",
                "en" => "Briflexy One Installment Package — 50-50",
            ],
            "period" => [
                "id" => "Lembar simulasi — Juli 2026",
                "en" => "Simulation sheet — July 2026",
            ],
            "badge" => [
                "id" => "Setahun bayar 1×",
                "en" => "Pay once a year",
            ],
            "highlights" => [
                [
                    "id" => "Skema 50-50: setahun bayar 1× — angsuran dibayarkan pada bulan ke-12",
                    "en" => "50-50 scheme: pay once a year — installment due in month 12",
                ],
                [
                    "id" => "Bayar pertama sudah termasuk biaya administrasi, polis, asuransi & fidusia",
                    "en" => "First payment includes admin, policy, insurance & fiducia fees",
                ],
                [
                    "id" => "Asuransi All Risk — terdaftar dan diawasi OJK",
                    "en" => "All-Risk insurance — registered and supervised by OJK",
                ],
            ],
            "note" => [
                "id" => "ADDB wilayah DKI Jakarta. Harga dapat berubah sewaktu-waktu tanpa pemberitahuan.",
                "en" => "ADDB for the DKI Jakarta area. Prices may change at any time without notice.",
            ],
            "pdf" => "/promos/bri-briflexy-5050.pdf",
            "models" => [
                "ex2-pro",
                "ex2-max",
                "starray-emi",
                "ex5-pro",
                "ex5-max",
            ],
            "subPrograms" => [
                [
                    "id" => "briflexy",
                    "name" => [
                        "id" => "Briflexy One",
                        "en" => "Briflexy One",
                    ],
                    "firstPaymentLabel" => [
                        "id" => "Total bayar pertama",
                        "en" => "Total first payment",
                    ],
                    "rows" => [
                        "ex2-pro" => [
                            [
                                "tenor" => 12,
                                "installment" => 119950000,
                                "firstPayment" => 142184820,
                            ],
                        ],
                        "ex2-max" => [
                            [
                                "tenor" => 12,
                                "installment" => 134950000,
                                "firstPayment" => 159538820,
                            ],
                        ],
                        "starray-emi" => [
                            [
                                "tenor" => 12,
                                "installment" => 249500000,
                                "firstPayment" => 285648000,
                            ],
                        ],
                        "ex5-pro" => [
                            [
                                "tenor" => 12,
                                "installment" => 232500000,
                                "firstPayment" => 266540000,
                            ],
                        ],
                        "ex5-max" => [
                            [
                                "tenor" => 12,
                                "installment" => 252500000,
                                "firstPayment" => 289470000,
                            ],
                        ],
                    ],
                ],
            ],
            "accent" => "#1e4b8f",
        ],
        [
            "id" => "bni",
            "finance" => "BNI Finance",
            "program" => [
                "id" => "Paket Kemerdekaan",
                "en" => "Independence Package",
            ],
            "badge" => [
                "id" => "Termasuk Coolray Flagship",
                "en" => "Includes Coolray Flagship",
            ],
            "highlights" => [
                [
                    "id" => "Tenor 12–60 bulan dengan TDP transparan per tenor",
                    "en" => "12–60 month tenors with transparent down payment per tenor",
                ],
                [
                    "id" => "Satu-satunya lembar yang memuat Coolray Flagship",
                    "en" => "The only sheet covering the Coolray Flagship",
                ],
                [
                    "id" => "Cocok untuk dokumen lengkap — pengajuan lebih fleksibel",
                    "en" => "Great with complete documents — more flexible submission",
                ],
            ],
            "requirements" => [
                [
                    "id" => "KTP, KK, NPWP",
                    "en" => "ID card, family card, tax ID",
                ],
                [
                    "id" => "Slip gaji / SKU / NIB jika usaha",
                    "en" => "Payslip / business registration if self-employed",
                ],
                [
                    "id" => "PBB / AJB / SHM",
                    "en" => "Property tax / deed / certificate",
                ],
                [
                    "id" => "Rekening koran 3 bulan terakhir",
                    "en" => "Bank statement for the last 3 months",
                ],
            ],
            "pdf" => "/promos/bni-paket-kemerdekaan.pdf",
            "models" => [
                "ex2-pro",
                "ex2-max",
                "coolray-flagship",
                "ex5-pro",
                "starray-emi",
                "ex5-max",
            ],
            "subPrograms" => [
                [
                    "id" => "adddb",
                    "name" => [
                        "id" => "ADDB",
                        "en" => "ADDB",
                    ],
                    "firstPaymentLabel" => [
                        "id" => "TDP",
                        "en" => "Down payment",
                    ],
                    "rows" => [
                        "ex2-pro" => [
                            [
                                "tenor" => 12,
                                "installment" => 18732000,
                                "firstPayment" => 49335000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 9853000,
                                "firstPayment" => 50110000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 6896000,
                                "firstPayment" => 50955000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 5454000,
                                "firstPayment" => 51746000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 4676000,
                                "firstPayment" => 52485000,
                            ],
                        ],
                        "ex2-max" => [
                            [
                                "tenor" => 12,
                                "installment" => 21074000,
                                "firstPayment" => 54709000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 11085000,
                                "firstPayment" => 55581000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 7759000,
                                "firstPayment" => 56402000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 6136000,
                                "firstPayment" => 57171000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 5260000,
                                "firstPayment" => 58002000,
                            ],
                        ],
                        "coolray-flagship" => [
                            [
                                "tenor" => 12,
                                "installment" => 27705000,
                                "firstPayment" => 91852000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 14573000,
                                "firstPayment" => 93070000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 10200000,
                                "firstPayment" => 94216000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 8067000,
                                "firstPayment" => 95290000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 6915000,
                                "firstPayment" => 96293000,
                            ],
                        ],
                        "ex5-pro" => [
                            [
                                "tenor" => 12,
                                "installment" => 36308000,
                                "firstPayment" => 83940000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 19097000,
                                "firstPayment" => 85442000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 13367000,
                                "firstPayment" => 86856000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 9062000,
                                "firstPayment" => 89418000,
                            ],
                        ],
                        "starray-emi" => [
                            [
                                "tenor" => 12,
                                "installment" => 36666000,
                                "firstPayment" => 114348000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 19286000,
                                "firstPayment" => 115409000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 13499000,
                                "firstPayment" => 116926000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 10676000,
                                "firstPayment" => 118348000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 9152000,
                                "firstPayment" => 119675000,
                            ],
                        ],
                        "ex5-max" => [
                            [
                                "tenor" => 12,
                                "installment" => 39431000,
                                "firstPayment" => 90820000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 20740000,
                                "firstPayment" => 91894000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 14516000,
                                "firstPayment" => 92904000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 11481000,
                                "firstPayment" => 94343000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 9842000,
                                "firstPayment" => 95686000,
                            ],
                        ],
                    ],
                ],
            ],
            "accent" => "#0f6a5f",
        ],
        [
            "id" => "mandiri",
            "finance" => "Mandiri Utama Finance",
            "program" => [
                "id" => "PL EV — KKB Geely",
                "en" => "PL EV — Geely Installments",
            ],
            "badge" => [
                "id" => "EV All Risk + Banjir",
                "en" => "EV All-Risk + Flood",
            ],
            "highlights" => [
                [
                    "id" => "Kendaraan EV sudah menggunakan asuransi All Risk dan perluasan banjir",
                    "en" => "EV units already include All-Risk insurance and flood extension",
                ],
                [
                    "id" => "Total DP tercantum jelas untuk tiap tenor 12–60 bulan",
                    "en" => "Clear total down payment for every 12–60 month tenor",
                ],
                [
                    "id" => "Angsuran ringan tenor panjang — EX2 Pro mulai Rp4,5 jt/bln",
                    "en" => "Light long-tenor installments — EX2 Pro from Rp4.5M/mo",
                ],
            ],
            "requirements" => [
                [
                    "id" => "KTP suami dan istri",
                    "en" => "Husband & wife ID cards",
                ],
                [
                    "id" => "Kartu keluarga",
                    "en" => "Family card",
                ],
                [
                    "id" => "NPWP",
                    "en" => "Tax ID (NPWP)",
                ],
                [
                    "id" => "Foto asli bukti kepemilikan rumah",
                    "en" => "Original photo of home-ownership proof",
                ],
                [
                    "id" => "Foto asli slip gaji bulan terakhir",
                    "en" => "Original photo of the latest payslip",
                ],
                [
                    "id" => "Rekening tabungan 3 bulan terakhir",
                    "en" => "Savings account statements for the last 3 months",
                ],
            ],
            "pdf" => "/promos/mandiri-pl-ev-kkb.pdf",
            "models" => [
                "ex2-pro",
                "ex2-max",
                "ex5-pro",
                "starray-emi",
                "ex5-max",
            ],
            "subPrograms" => [
                [
                    "id" => "kkb",
                    "name" => [
                        "id" => "KKB",
                        "en" => "KKB",
                    ],
                    "firstPaymentLabel" => [
                        "id" => "Total DP",
                        "en" => "Total down payment",
                    ],
                    "rows" => [
                        "ex2-pro" => [
                            [
                                "tenor" => 12,
                                "installment" => 18659000,
                                "firstPayment" => 37749000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 9645000,
                                "firstPayment" => 42398000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 6646000,
                                "firstPayment" => 47202000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 5250000,
                                "firstPayment" => 51936000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 4535000,
                                "firstPayment" => 56100000,
                            ],
                        ],
                        "ex2-max" => [
                            [
                                "tenor" => 12,
                                "installment" => 20992000,
                                "firstPayment" => 41686000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 10851000,
                                "firstPayment" => 46917000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 7477000,
                                "firstPayment" => 51532000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 5906000,
                                "firstPayment" => 56577000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 5101000,
                                "firstPayment" => 61261000,
                            ],
                        ],
                        "ex5-pro" => [
                            [
                                "tenor" => 12,
                                "installment" => 36165000,
                                "firstPayment" => 61572000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 18694000,
                                "firstPayment" => 70584000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 12881000,
                                "firstPayment" => 78535000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 10027000,
                                "firstPayment" => 88603000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 8789000,
                                "firstPayment" => 93248000,
                            ],
                        ],
                        "starray-emi" => [
                            [
                                "tenor" => 12,
                                "installment" => 38810000,
                                "firstPayment" => 64952000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 20061000,
                                "firstPayment" => 66013000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 13823000,
                                "firstPayment" => 67435000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 10919000,
                                "firstPayment" => 69162000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 9431000,
                                "firstPayment" => 70395000,
                            ],
                        ],
                        "ex5-max" => [
                            [
                                "tenor" => 12,
                                "installment" => 39276000,
                                "firstPayment" => 66136000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 20302000,
                                "firstPayment" => 72145000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 13989000,
                                "firstPayment" => 81181000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 11050000,
                                "firstPayment" => 89241000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 9545000,
                                "firstPayment" => 96725000,
                            ],
                        ],
                    ],
                ],
            ],
            "accent" => "#1f3a93",
        ],
        [
            "id" => "imfi",
            "finance" => "IMFI — Indomobil Finance",
            "program" => [
                "id" => "Paket Promo Geely",
                "en" => "Geely Promo Package",
            ],
            "period" => [
                "id" => "Lembar promo — Juni 2026",
                "en" => "Promo sheet — June 2026",
            ],
            "badge" => [
                "id" => "Ada bunga 0%",
                "en" => "0% interest available",
            ],
            "highlights" => [
                [
                    "id" => "Bunga 0% tenor 5 & 11 bulan (asuransi All Risk)",
                    "en" => "0% interest for 5 & 11-month tenors (All-Risk insurance)",
                ],
                [
                    "id" => "DP ringan mulai Rp48,2 jt untuk EX2 Pro",
                    "en" => "Light down payment from Rp48.2M for the EX2 Pro",
                ],
                [
                    "id" => "Promo potongan 2 angsuran — bebas 2 angsuran pertama",
                    "en" => "2-installment cut promo — first 2 installments free",
                ],
            ],
            "requirements" => [
                [
                    "id" => "FC NPWP, KTP pemohon & suami/istri, FC kartu keluarga",
                    "en" => "Copies of tax ID, applicant & spouse IDs, family card",
                ],
                [
                    "id" => "FC PBB & rekening listrik, rekening koran 3 bulan terakhir",
                    "en" => "Property-tax & electricity bills, 3-month bank statements",
                ],
                [
                    "id" => "Slip gaji (karyawan) / SIUP & TDP (wiraswasta)",
                    "en" => "Payslip (employees) / trade license (entrepreneurs)",
                ],
                [
                    "id" => "Status tempat tinggal wajib milik sendiri • SLIK KOL 1 lancar",
                    "en" => "Must own their home • clean SLIK credit record",
                ],
                [
                    "id" => "Pembayaran wajib autodebet (Mandiri, BCA & BRI)",
                    "en" => "Auto-debit payment required (Mandiri, BCA & BRI)",
                ],
            ],
            "pdf" => "/promos/imfi-paket-promo.pdf",
            "models" => [
                "ex2-pro",
                "ex2-max",
                "ex5-pro",
                "starray-emi",
                "ex5-max",
            ],
            "subPrograms" => [
                [
                    "id" => "bunga-ringan",
                    "name" => [
                        "id" => "Bunga Ringan (Asuransi Kombinasi)",
                        "en" => "Low Interest (Combined Insurance)",
                    ],
                    "firstPaymentLabel" => [
                        "id" => "TDP",
                        "en" => "Down payment",
                    ],
                    "rows" => [
                        "ex2-pro" => [
                            [
                                "tenor" => 11,
                                "installment" => 14511000,
                                "firstPayment" => 102319170,
                            ],
                            [
                                "tenor" => 23,
                                "installment" => 7580000,
                                "firstPayment" => 96505346,
                            ],
                            [
                                "tenor" => 35,
                                "installment" => 5301000,
                                "firstPayment" => 95216375,
                            ],
                            [
                                "tenor" => 47,
                                "installment" => 4206000,
                                "firstPayment" => 94984257,
                            ],
                            [
                                "tenor" => 59,
                                "installment" => 3573000,
                                "firstPayment" => 95150566,
                            ],
                        ],
                        "ex2-max" => [
                            [
                                "tenor" => 11,
                                "installment" => 16326000,
                                "firstPayment" => 114283170,
                            ],
                            [
                                "tenor" => 23,
                                "installment" => 8528000,
                                "firstPayment" => 107492034,
                            ],
                            [
                                "tenor" => 35,
                                "installment" => 5963000,
                                "firstPayment" => 106028363,
                            ],
                            [
                                "tenor" => 47,
                                "installment" => 4732000,
                                "firstPayment" => 105755645,
                            ],
                            [
                                "tenor" => 59,
                                "installment" => 4020000,
                                "firstPayment" => 105930404,
                            ],
                        ],
                        "ex5-pro" => [
                            [
                                "tenor" => 11,
                                "installment" => 28126000,
                                "firstPayment" => 188243500,
                            ],
                            [
                                "tenor" => 23,
                                "installment" => 14691000,
                                "firstPayment" => 176470900,
                            ],
                            [
                                "tenor" => 35,
                                "installment" => 10274000,
                                "firstPayment" => 173521000,
                            ],
                            [
                                "tenor" => 47,
                                "installment" => 8152000,
                                "firstPayment" => 172670800,
                            ],
                            [
                                "tenor" => 59,
                                "installment" => 6926000,
                                "firstPayment" => 172618950,
                            ],
                        ],
                        "ex5-max" => [
                            [
                                "tenor" => 11,
                                "installment" => 30546000,
                                "firstPayment" => 203843500,
                            ],
                            [
                                "tenor" => 23,
                                "installment" => 15955000,
                                "firstPayment" => 190564500,
                            ],
                            [
                                "tenor" => 35,
                                "installment" => 11157000,
                                "firstPayment" => 187351200,
                            ],
                            [
                                "tenor" => 47,
                                "installment" => 8853000,
                                "firstPayment" => 186419800,
                            ],
                            [
                                "tenor" => 59,
                                "installment" => 7521000,
                                "firstPayment" => 186354350,
                            ],
                        ],
                        "starray-emi" => [
                            [
                                "tenor" => 11,
                                "installment" => 30183000,
                                "firstPayment" => 201503500,
                            ],
                            [
                                "tenor" => 23,
                                "installment" => 15766000,
                                "firstPayment" => 188863140,
                            ],
                            [
                                "tenor" => 35,
                                "installment" => 11025000,
                                "firstPayment" => 185689200,
                            ],
                            [
                                "tenor" => 47,
                                "installment" => 8748000,
                                "firstPayment" => 184769680,
                            ],
                            [
                                "tenor" => 59,
                                "installment" => 7432000,
                                "firstPayment" => 184706370,
                            ],
                        ],
                    ],
                ],
                [
                    "id" => "dp-ringan",
                    "name" => [
                        "id" => "DP Ringan (Asuransi Kombinasi)",
                        "en" => "Light Down Payment (Combined Insurance)",
                    ],
                    "firstPaymentLabel" => [
                        "id" => "TDP",
                        "en" => "Down payment",
                    ],
                    "rows" => [
                        "ex2-pro" => [
                            [
                                "tenor" => 12,
                                "installment" => 18232000,
                                "firstPayment" => 48230000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 9790000,
                                "firstPayment" => 48230000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 7003000,
                                "firstPayment" => 48480000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 5624000,
                                "firstPayment" => 48480000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 4951000,
                                "firstPayment" => 48480000,
                            ],
                        ],
                        "ex2-max" => [
                            [
                                "tenor" => 12,
                                "installment" => 20442000,
                                "firstPayment" => 54230000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 10965000,
                                "firstPayment" => 54480000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 7843000,
                                "firstPayment" => 54480000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 6298000,
                                "firstPayment" => 54480000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 5544000,
                                "firstPayment" => 54480000,
                            ],
                        ],
                        "ex5-pro" => [
                            [
                                "tenor" => 12,
                                "installment" => 34446000,
                                "firstPayment" => 93500000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 18475000,
                                "firstPayment" => 93500000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 13201000,
                                "firstPayment" => 93500000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 10592000,
                                "firstPayment" => 93900000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 9317000,
                                "firstPayment" => 93900000,
                            ],
                        ],
                        "ex5-max" => [
                            [
                                "tenor" => 12,
                                "installment" => 37361000,
                                "firstPayment" => 101500000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 20015000,
                                "firstPayment" => 101500000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 14301000,
                                "firstPayment" => 101900000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 11474000,
                                "firstPayment" => 101900000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 10093000,
                                "firstPayment" => 101900000,
                            ],
                        ],
                        "starray-emi" => [
                            [
                                "tenor" => 12,
                                "installment" => 36923000,
                                "firstPayment" => 100300000,
                            ],
                            [
                                "tenor" => 24,
                                "installment" => 19803000,
                                "firstPayment" => 100300000,
                            ],
                            [
                                "tenor" => 36,
                                "installment" => 14150000,
                                "firstPayment" => 100700000,
                            ],
                            [
                                "tenor" => 48,
                                "installment" => 11353000,
                                "firstPayment" => 100700000,
                            ],
                            [
                                "tenor" => 60,
                                "installment" => 9986000,
                                "firstPayment" => 100700000,
                            ],
                        ],
                    ],
                ],
                [
                    "id" => "bunga-0",
                    "name" => [
                        "id" => "Bunga 0% (Asuransi All Risk)",
                        "en" => "0% Interest (All-Risk Insurance)",
                    ],
                    "firstPaymentLabel" => [
                        "id" => "TDP",
                        "en" => "Down payment",
                    ],
                    "rows" => [
                        "ex2-pro" => [
                            [
                                "tenor" => 5,
                                "installment" => 29988000,
                                "firstPayment" => 106041070,
                            ],
                            [
                                "tenor" => 11,
                                "installment" => 14994000,
                                "firstPayment" => 94645570,
                            ],
                        ],
                        "ex2-max" => [
                            [
                                "tenor" => 5,
                                "installment" => 33738000,
                                "firstPayment" => 118470070,
                            ],
                            [
                                "tenor" => 11,
                                "installment" => 16869000,
                                "firstPayment" => 105649570,
                            ],
                        ],
                        "ex5-pro" => [
                            [
                                "tenor" => 5,
                                "installment" => 58125000,
                                "firstPayment" => 195457500,
                            ],
                            [
                                "tenor" => 11,
                                "installment" => 29063000,
                                "firstPayment" => 173370500,
                            ],
                        ],
                        "ex5-max" => [
                            [
                                "tenor" => 5,
                                "installment" => 63125000,
                                "firstPayment" => 211677500,
                            ],
                            [
                                "tenor" => 11,
                                "installment" => 31563000,
                                "firstPayment" => 187690500,
                            ],
                        ],
                        "starray-emi" => [
                            [
                                "tenor" => 5,
                                "installment" => 62375000,
                                "firstPayment" => 209244500,
                            ],
                            [
                                "tenor" => 11,
                                "installment" => 31188000,
                                "firstPayment" => 185542500,
                            ],
                        ],
                    ],
                ],
                [
                    "id" => "potongan-2",
                    "name" => [
                        "id" => "Potongan 2 Angsuran (Kombinasi)",
                        "en" => "2-Installment Cut (Combined)",
                    ],
                    "firstPaymentLabel" => [
                        "id" => "TDP",
                        "en" => "Down payment",
                    ],
                    "rows" => [
                        "ex2-pro" => [
                            [
                                "tenor" => 10,
                                "installment" => 21796000,
                                "firstPayment" => 48230000,
                            ],
                            [
                                "tenor" => 22,
                                "installment" => 10704000,
                                "firstPayment" => 48230000,
                            ],
                            [
                                "tenor" => 34,
                                "installment" => 7473000,
                                "firstPayment" => 48480000,
                            ],
                            [
                                "tenor" => 46,
                                "installment" => 5944000,
                                "firstPayment" => 48480000,
                            ],
                            [
                                "tenor" => 58,
                                "installment" => 5203000,
                                "firstPayment" => 48480000,
                            ],
                        ],
                        "ex2-max" => [
                            [
                                "tenor" => 10,
                                "installment" => 24437000,
                                "firstPayment" => 54230000,
                            ],
                            [
                                "tenor" => 22,
                                "installment" => 11989000,
                                "firstPayment" => 54480000,
                            ],
                            [
                                "tenor" => 34,
                                "installment" => 8369000,
                                "firstPayment" => 54480000,
                            ],
                            [
                                "tenor" => 46,
                                "installment" => 6656000,
                                "firstPayment" => 54480000,
                            ],
                            [
                                "tenor" => 58,
                                "installment" => 5826000,
                                "firstPayment" => 54480000,
                            ],
                        ],
                        "ex5-pro" => [
                            [
                                "tenor" => 10,
                                "installment" => 41178000,
                                "firstPayment" => 93500000,
                            ],
                            [
                                "tenor" => 22,
                                "installment" => 20200000,
                                "firstPayment" => 93500000,
                            ],
                            [
                                "tenor" => 34,
                                "installment" => 14088000,
                                "firstPayment" => 93500000,
                            ],
                            [
                                "tenor" => 46,
                                "installment" => 11195000,
                                "firstPayment" => 93900000,
                            ],
                            [
                                "tenor" => 58,
                                "installment" => 9791000,
                                "firstPayment" => 93900000,
                            ],
                        ],
                        "ex5-max" => [
                            [
                                "tenor" => 10,
                                "installment" => 44662000,
                                "firstPayment" => 101500000,
                            ],
                            [
                                "tenor" => 22,
                                "installment" => 21884000,
                                "firstPayment" => 101500000,
                            ],
                            [
                                "tenor" => 34,
                                "installment" => 15262000,
                                "firstPayment" => 101900000,
                            ],
                            [
                                "tenor" => 46,
                                "installment" => 12127000,
                                "firstPayment" => 101900000,
                            ],
                            [
                                "tenor" => 58,
                                "installment" => 10606000,
                                "firstPayment" => 101900000,
                            ],
                        ],
                        "starray-emi" => [
                            [
                                "tenor" => 10,
                                "installment" => 44140000,
                                "firstPayment" => 100300000,
                            ],
                            [
                                "tenor" => 22,
                                "installment" => 21653000,
                                "firstPayment" => 100300000,
                            ],
                            [
                                "tenor" => 34,
                                "installment" => 15100000,
                                "firstPayment" => 100700000,
                            ],
                            [
                                "tenor" => 46,
                                "installment" => 11999000,
                                "firstPayment" => 100700000,
                            ],
                            [
                                "tenor" => 58,
                                "installment" => 10494000,
                                "firstPayment" => 100700000,
                            ],
                        ],
                    ],
                ],
            ],
            "accent" => "#b45309",
        ],
    ];

$PROMO_DISCLAIMER = [
        "id" => "*Angka angsuran & DP disalin dari lembar simulasi resmi masing-masing perusahaan pembiayaan (CIMB Niaga Finance, BRI Finance, BNI Finance, Mandiri Utama Finance, dan IMFI) tanpa perubahan. Angka bersifat indikatif/proyeksi, tidak mengikat, dan sewaktu-waktu dapat berubah. Persetujuan akhir, angsuran final, dan biaya mengikuti hasil survei serta kebijakan perusahaan pembiayaan. Asumsi OTR antar lembar dapat sedikit berbeda — minta simulasi resmi terbaru via WhatsApp.",
        "en" => "*Installment & down-payment figures are copied unchanged from each financing company's official simulation sheet (CIMB Niaga Finance, BRI Finance, BNI Finance, Mandiri Utama Finance, and IMFI). Figures are indicative/projected, non-binding, and may change at any time. Final approval, installments, and fees follow the financing company's survey results and policies. OTR assumptions may differ slightly between sheets — request the latest official simulation via WhatsApp.",
    ];
