@extends('layouts.app')

@php
    // ─────────────────────────────────────────────────────────────
    // iRes System — dedicated product page
    // Bilingual: each section reads from $isRtl to pick AR/EN copy
    // Screenshot placeholders use the `.ires-screenshot` styling
    // ─────────────────────────────────────────────────────────────

    $stats = [
        ['value' => '33+', 'label_ar' => 'وحدة وميزة',          'label_en' => 'Features & modules'],
        ['value' => '7',   'label_ar' => 'تقارير تشغيلية',     'label_en' => 'Operations reports'],
        ['value' => '6',   'label_ar' => 'قنوات بيع مدعومة',    'label_en' => 'Supported sales channels'],
        ['value' => '∞',   'label_ar' => 'مواقع للمخزون',       'label_en' => 'Inventory locations'],
    ];

    $capabilities = [
        [
            'slot' => 'pos',
            'icon' => 'point_of_sale',
            'title_ar' => 'نقطة بيع POS سريعة وعملية',
            'title_en' => 'Fast, focused POS',
            'shot_ar' => 'شاشة الكاشير',
            'shot_en' => 'POS / cashier screen',
            'desc_ar' => 'واجهة كاشير مصممة للعمل السريع داخل المطعم، تقلل خطوات الكاشير قدر الإمكان خصوصًا في أوقات الضغط.',
            'desc_en' => 'A cashier UI built for the rush — fewest possible clicks per order, designed for peak-hour flow.',
            'bullets_ar' => [
                'إنشاء الطلبات بسرعة واختيار نوع الطلب',
                'إضافة عميل أو اختياره وتسجيل ملاحظات على كل صنف',
                'دفع نقدي / كارت مع تحديد ماكينة البنك ورقم الإيصال',
                'تطبيق الخصومات حسب الصلاحيات وطباعة الإيصالات',
                'متابعة طلبات الكاشير خلال الوردية وإحصائيات كل درج',
            ],
            'bullets_en' => [
                'Create orders fast and pick order type',
                'Add or select a customer, attach per-item notes',
                'Cash & card payment with bank-terminal and receipt-number capture',
                'Permission-gated discounts and one-click receipt printing',
                'Live shift order list with per-drawer cash and operation stats',
            ],
        ],
        [
            'slot' => 'channels',
            'icon' => 'sell',
            'title_ar' => 'أنواع الطلبات والقنوات',
            'title_en' => 'Order types & sales channels',
            'shot_ar' => 'إعدادات قنوات البيع',
            'shot_en' => 'Sales-channel configuration',
            'desc_ar' => 'دعم تيك أواي، دليفري، بيك أب، طلبات الموقع والكول سنتر وقنوات خارجية — مع أسعار مختلفة لكل قناة.',
            'desc_en' => 'Takeaway, delivery, pickup, web, call-center and external channels — each with its own pricing rules.',
            'bullets_ar' => [
                'تسعير منفصل لكل قناة بيع',
                'دعم الأصناف متعددة الأحجام',
                'إعداد قنوات إضافية بدون تطوير',
            ],
            'bullets_en' => [
                'Per-channel price lists',
                'Multi-size item pricing',
                'Add new sales channels without code changes',
            ],
        ],
        [
            'slot' => 'kitchen',
            'icon' => 'kitchen',
            'title_ar' => 'شاشة المطبخ',
            'title_en' => 'Kitchen Display',
            'shot_ar' => 'شاشة المطبخ',
            'shot_en' => 'Kitchen display screen',
            'desc_ar' => 'شاشة خاصة للمطبخ تعرض الطلبات المؤكدة فقط، مع تفاصيل واضحة لكل طلب وزر إنهاء التحضير.',
            'desc_en' => 'A dedicated kitchen screen showing only confirmed orders, with clear details and a one-tap "ready" action.',
            'bullets_ar' => [
                'رقم الطلب والأصناف والكميات وملاحظات كل صنف',
                'حالة الطلب وزر إنهاء التحضير',
                'الانتقال التلقائي للمرحلة التالية حسب نوع الطلب',
            ],
            'bullets_en' => [
                'Order number, items, quantities, per-item notes',
                'Status indicator and one-tap finish-prep',
                'Auto-routes to next stage by order type',
            ],
        ],
        [
            'slot' => 'counter',
            'icon' => 'takeout_dining',
            'title_ar' => 'شاشات التسليم والكاونتر',
            'title_en' => 'Pickup & counter screens',
            'shot_ar' => 'شاشات التسليم',
            'shot_en' => 'Handover screens',
            'desc_ar' => 'شاشات تسليم متعددة: عامة، فردية، زوجية، ومخصصة لتجهيز وتسليم طلبات الدليفري — لتقليل التزاحم.',
            'desc_en' => 'Multiple counter displays — general, single-lane, dual-lane, and a dedicated delivery prep+handover screen.',
            'bullets_ar' => [
                'تنظيم تسليم وقت الذروة',
                'تقليل أخطاء التسليم',
                'شاشة دليفري مخصصة',
            ],
            'bullets_en' => [
                'Smoother peak-hour pickup',
                'Fewer handover mistakes',
                'Dedicated delivery prep screen',
            ],
        ],
        [
            'slot' => 'dispatch',
            'icon' => 'fact_check',
            'title_ar' => 'لوحة Dispatch للطلبات الخارجية',
            'title_en' => 'Dispatch board for external orders',
            'shot_ar' => 'لوحة الديسباتش',
            'shot_en' => 'Dispatch board',
            'desc_ar' => 'طلبات الموقع والكول سنتر لا تدخل المطبخ مباشرة — تمر بمراجعة موظف الديسباتش أولًا لمنع الطلبات الوهمية.',
            'desc_en' => 'Website and call-center orders go through a Dispatch review before reaching the kitchen — no fake orders, no wasted prep.',
            'bullets_ar' => [
                'مراجعة بيانات العميل والهاتف والعنوان',
                'تعديل أو رفض الطلب قبل التأكيد',
                'متابعة طلبات الدليفري حتى التسليم',
            ],
            'bullets_en' => [
                'Verify customer phone and address',
                'Edit or reject orders before confirmation',
                'Track delivery orders end-to-end',
            ],
        ],
        [
            'slot' => 'customer',
            'icon' => 'groups',
            'title_ar' => 'إدارة العملاء',
            'title_en' => 'Customer management',
            'shot_ar' => 'بطاقة العميل',
            'shot_en' => 'Customer profile card',
            'desc_ar' => 'إضافة وعرض العملاء من الكاشير ولوحة الإدارة، مع سجل الطلبات السابقة وإجمالي قيمتها.',
            'desc_en' => 'Add or look up customers from POS or admin, with full order history and lifetime value at a glance.',
            'bullets_ar' => [
                'اسم العميل ورقم الهاتف والعنوان',
                'طلبات العميل السابقة وآخر طلب',
                'إجمالي الطلبات والقيمة',
            ],
            'bullets_en' => [
                'Name, phone, address',
                'Past orders and last-order info',
                'Total orders and lifetime spend',
            ],
        ],
    ];

    $inventory = [
        ['icon' => 'warehouse',         'title_ar' => 'مخزون متعدد المواقع',   'title_en' => 'Multi-location inventory', 'desc_ar' => 'مخزن رئيسي، مطعم، مطبخ، وأي موقع إضافي — مع رصيد منفصل لكل صنف في كل موقع.', 'desc_en' => 'Main store, restaurant, kitchen, and any extra location — separate balances per item per location.'],
        ['icon' => 'receipt_long',      'title_ar' => 'المشتريات والاستلام',   'title_en' => 'Purchases & receiving',    'desc_ar' => 'فواتير المشتريات مرتبطة بالموردين، مع تحديد مكان الاستلام وتحديث الكميات والتكلفة تلقائيًا.', 'desc_en' => 'Purchase invoices linked to suppliers and receiving location — quantities and cost update automatically.'],
        ['icon' => 'paid',              'title_ar' => 'متوسط تكلفة المخزون',  'title_en' => 'Weighted-average cost',    'desc_ar' => 'حساب متوسط تكلفة الصنف من فواتير الشراء — لتسعير أدق وتقارير فود كوست حقيقية.', 'desc_en' => 'Weighted-average cost from purchases — for sharper pricing and true food-cost reporting.'],
        ['icon' => 'menu_book',         'title_ar' => 'وصفات الأصناف',          'title_en' => 'Item recipes',             'desc_ar' => 'تعريف وصفة لكل صنف بمكوناته وكمياته — يخصم النظام المكونات تلقائيًا عند البيع.', 'desc_en' => 'Define a recipe per item — components are auto-deducted from stock on every sale.'],
        ['icon' => 'soup_kitchen',      'title_ar' => 'التشغيلة والإنتاج الداخلي', 'title_en' => 'Production / prep batches', 'desc_ar' => 'منتجات مُجهزة (عجائن، خلطات، تحضيرات يومية) تُنتج من الخامات وتُستخدم داخل الوصفات لاحقًا.', 'desc_en' => 'Prep batches (doughs, mixes, daily prep) produced from raw stock and used by item recipes.'],
        ['icon' => 'move_down',         'title_ar' => 'طلبات صرف المخزون',     'title_en' => 'Stock issue requests',     'desc_ar' => 'سيناريو طلب → مراجعة → موافقة → تحويل، موثّق بمن طلب ومن وافق ومن نفّذ.', 'desc_en' => 'Request → review → approve → transfer — every step logged with the user behind it.'],
        ['icon' => 'description',       'title_ar' => 'قوالب طلبات الصرف',     'title_en' => 'Issue-request templates',  'desc_ar' => 'قوالب جاهزة للطلبات المتكررة (خضار يومية، أدوات تغليف، تحضيرات) — طلب جديد بضغطة واحدة.', 'desc_en' => 'Reusable templates for recurring requests (daily veg, packaging, prep) — new request in one click.'],
        ['icon' => 'inventory',         'title_ar' => 'الجرد اليومي الجماعي',  'title_en' => 'Bulk daily stocktake',     'desc_ar' => 'صفحة جرد جماعية لكل أصناف الموقع، مع الفرق والسبب — تُسجَّل كحركات مخزون موثقة عند الاعتماد.', 'desc_en' => 'One screen to count all items in a location with variance and reason — posted as stock movements when approved.'],
        ['icon' => 'delete_sweep',      'title_ar' => 'الهالك المعتمد',         'title_en' => 'Approved waste',           'desc_ar' => 'تسجيل الهالك بسبب وكمية وقيمة — لا يخصم إلا بعد الاعتماد، ويظهر في تقرير مخصص.', 'desc_en' => 'Log waste with reason, quantity and value — only deducted after approval and surfaced in a dedicated report.'],
    ];

    $financial = [
        ['icon' => 'account_balance',        'title_ar' => 'الصندوق والبنك',  'title_en' => 'Cash & bank',     'desc_ar' => 'رصيد الصندوق والبنك، الإيداع والسحب، التحويلات، وأثر المشتريات والمصروفات لحظيًا.', 'desc_en' => 'Cash and bank balances, deposits, withdrawals, transfers, and the live impact of purchases and expenses.'],
        ['icon' => 'badge',                   'title_ar' => 'العهد',           'title_en' => 'Employee custody', 'desc_ar' => 'إنشاء عهدة لموظف، تمويلها، استخدامها في المشتريات والمصروفات، وكشف حركة كامل لكل موظف.', 'desc_en' => 'Issue an employee custody, fund it, spend it on purchases or expenses, and view a full per-employee statement.'],
        ['icon' => 'savings',                'title_ar' => 'السلف',           'title_en' => 'Salary advances',  'desc_ar' => 'تسجيل السلف بالتاريخ والمبلغ والملاحظات مع تقارير شهرية شاملة لكل موظف.', 'desc_en' => 'Log advances with date, amount, and notes — monthly reports per employee included.'],
        ['icon' => 'handshake',              'title_ar' => 'الشركاء',         'title_en' => 'Partner accounts',  'desc_ar' => 'إيداعات وسحوبات الشركاء، كشف حركة، ومتابعة الرصيد أو صافي الحركة.', 'desc_en' => 'Partner deposits and withdrawals, statement, and live balance / net activity.'],
        ['icon' => 'calculate',              'title_ar' => 'محاسبة مبسطة عملية', 'title_en' => 'Simple, practical accounting', 'desc_ar' => 'مالية مبسطة مناسبة لمطعم — بدون تعقيد أنظمة ERP الكبيرة، وتعطيك الوضع المالي التشغيلي بوضوح.', 'desc_en' => 'Lean financials sized to a restaurant — no enterprise-ERP overhead, just clear operational visibility.'],
    ];

    $reports = [
        ['icon' => 'today',          'title_ar' => 'تقرير اليومية',          'title_en' => 'Daily operations',    'desc_ar' => 'كل اليوم: مبيعات كاش وفيزا، قنوات خارجية، مشتريات، مصروفات، سلف وعهد، حركات الصندوق والبنك.', 'desc_en' => 'A full day in one view: cash/card sales, external channels, purchases, expenses, advances, custody, cash & bank movements.'],
        ['icon' => 'bar_chart',      'title_ar' => 'تقرير المبيعات',         'title_en' => 'Sales report',        'desc_ar' => 'مبيعات حسب الفترة، نوع الدفع، قناة البيع، نوع الطلب، الكاشير، الأصناف والفئات.', 'desc_en' => 'Sales by period, payment type, channel, order type, cashier, item and category.'],
        ['icon' => 'shopping_cart',  'title_ar' => 'تقرير المشتريات',        'title_en' => 'Purchases report',    'desc_ar' => 'كل تفاصيل فواتير المشتريات: مورد، صنف، كمية، سعر، إجمالي، استلام، وطريقة دفع. تصدير Excel.', 'desc_en' => 'Full purchase-invoice detail: supplier, item, qty, price, total, receiving location, payment — Excel export.'],
        ['icon' => 'restaurant',     'title_ar' => 'تقرير الفود كوست',       'title_en' => 'Food cost',           'desc_ar' => 'تكلفة الطعام شهريًا من استهلاك الوصفات والتكلفة الفعلية للمخزون.', 'desc_en' => 'Monthly food cost from recipe consumption and real inventory cost.'],
        ['icon' => 'compare_arrows', 'title_ar' => 'المخزون والتحويلات',    'title_en' => 'Inventory & transfers', 'desc_ar' => 'أرصدة وحركات المخزون والتحويلات بين المواقع — بكل تفاصيل من طلب ومن نفذ ومن استلم.', 'desc_en' => 'Balances, movements, and inter-location transfers — with full request/issue/receive audit.'],
        ['icon' => 'auto_delete',    'title_ar' => 'تقرير الهوالك',         'title_en' => 'Waste report',        'desc_ar' => 'كل الهالك بالموقع والصنف والكمية والسبب والتكلفة — مع من طلب ومن وافق.', 'desc_en' => 'All waste by location, item, quantity, reason, and cost — with requester and approver.'],
        ['icon' => 'trending_up',    'title_ar' => 'الأرباح والخسائر',       'title_en' => 'Operational P&L',     'desc_ar' => 'إجمالي المبيعات، الخصومات، صافي المبيعات، تكلفة البضاعة، مجمل الربح، المصروفات، صافي الربح التشغيلي.', 'desc_en' => 'Gross sales, discounts, net sales, COGS, gross profit, expenses, operational net profit.'],
    ];

    $roles = [
        ['icon' => 'point_of_sale', 'label_ar' => 'كاشير',     'label_en' => 'Cashier'],
        ['icon' => 'soup_kitchen',  'label_ar' => 'شيف',       'label_en' => 'Chef'],
        ['icon' => 'warehouse',     'label_ar' => 'مسؤول مخزن','label_en' => 'Stock manager'],
        ['icon' => 'manage_accounts','label_ar' => 'مدير مطعم','label_en' => 'Restaurant manager'],
        ['icon' => 'calculate',     'label_ar' => 'محاسب',     'label_en' => 'Accountant'],
        ['icon' => 'workspace_premium','label_ar' => 'مالك',  'label_en' => 'Owner'],
        ['icon' => 'admin_panel_settings','label_ar' => 'أدمن','label_en' => 'Admin'],
    ];

    $audience = [
        ['icon' => 'lunch_dining', 'label_ar' => 'مطاعم الفول والطعمية',           'label_en' => 'Foul & ta‘meya restaurants'],
        ['icon' => 'fastfood',     'label_ar' => 'الوجبات السريعة',                'label_en' => 'Quick-service restaurants'],
        ['icon' => 'delivery_dining','label_ar' => 'مطاعم التيك أواي والدليفري',  'label_en' => 'Takeaway & delivery brands'],
        ['icon' => 'inventory',    'label_ar' => 'مطاعم بمخزون يومي وتشغيل مطبخ', 'label_en' => 'Kitchens with daily stock and prep'],
        ['icon' => 'paid',         'label_ar' => 'مطاعم تحتاج ضبط الفود كوست',     'label_en' => 'Operations that need food-cost control'],
        ['icon' => 'hub',          'label_ar' => 'مطاعم تريد ربط الكاشير بالمطبخ والمخزون والحسابات', 'label_en' => 'Brands tying POS → kitchen → stock → accounting'],
    ];

    $value = [
        ['icon' => 'speed',           'ar' => 'تقليل أخطاء الكاشير وتسريع عملية الطلب',  'en' => 'Cut cashier mistakes, speed up order taking'],
        ['icon' => 'kitchen',         'ar' => 'تنظيم عمل المطبخ ومتابعة التسليم',          'en' => 'Organize the kitchen and track every handoff'],
        ['icon' => 'inventory_2',     'ar' => 'ضبط المخزون ومراقبة الهالك',                'en' => 'Control inventory and monitor waste'],
        ['icon' => 'paid',            'ar' => 'معرفة تكلفة كل صنف وتحليل الفود كوست',      'en' => 'Know true item cost and analyze food cost'],
        ['icon' => 'badge',           'ar' => 'متابعة العهد والسلف وحركات الموظفين',        'en' => 'Track custody, advances, and employee activity'],
        ['icon' => 'insights',        'ar' => 'مبيعات يومية وتحليل أرباح وخسائر',           'en' => 'Daily sales and operational P&L'],
        ['icon' => 'verified',        'ar' => 'قرارات تشغيلية أفضل ببيانات لحظية',          'en' => 'Better operational decisions with live data'],
    ];

    // Helper for the screenshot placeholder boxes
    $shotLabel = $isRtl ? 'صورة الشاشة ستوضع هنا' : 'Screenshot will be added here';

    // Returns the URL for an uploaded screenshot at a given slot, or null when empty.
    // The admin uploads under products → iRes Screenshots and Filament stores
    // them in the `screenshots` JSON column keyed by slot name.
    $shotUrl = function (string $slot) use ($product): ?string {
        $path = data_get($product->screenshots, $slot);
        return $path ? asset('storage/' . $path) : null;
    };
@endphp

@section('seo')
    @include('partials.seo', [
        'seoTitle' => $isRtl ? 'نظام إدارة المطاعم iRes System | رُقي' : 'iRes System — Restaurant Management Platform | RoQay',
        'seoDescription' => $isRtl
            ? 'iRes System من رُقي — منصة تشغيل مطاعم متكاملة: POS، شاشة مطبخ، دليفري، مخزون متعدد المواقع، وصفات وفود كوست، تقارير وأرباح تشغيلية.'
            : 'iRes System by RoQay — a full restaurant operations platform: POS, kitchen display, dispatch, multi-location inventory, recipes, food cost, reports and operational P&L.',
        'seoKeywords' => $isRtl
            ? 'iRes, نظام مطاعم, POS مطاعم, شاشة مطبخ, إدارة مخزون, فود كوست, رُقي'
            : 'iRes System, restaurant POS, kitchen display, restaurant inventory, food cost, RoQay',
        'seoImage' => $product->og_image ?? $product->featured_image,
    ])
    @php
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'SoftwareApplication',
            'name' => 'iRes System',
            'description' => $isRtl ? $product->short_description_ar : $product->short_description_en,
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web, Windows, macOS, Linux, Android, iOS',
            'offers' => [
                '@type' => 'Offer',
                'availability' => 'https://schema.org/InStock',
            ],
        ];
        if ($product->featured_image) {
            $schema['image'] = asset('storage/' . $product->featured_image);
        }
    @endphp
    @include('partials.schemas', ['schemas' => [$schema]])

    {{-- Page-specific styles for screenshot placeholders + glow accents --}}
    <style>
        .ires-screenshot {
            position: relative;
            border-radius: 1rem;
            background:
                radial-gradient(at 30% 0%, rgba(59,130,246,0.15), transparent 60%),
                radial-gradient(at 100% 100%, rgba(6,182,212,0.18), transparent 55%),
                linear-gradient(180deg, #0b1326 0%, #0f1c34 100%);
            border: 1px dashed rgba(148,163,184,0.45);
            color: rgba(226,232,240,0.85);
            overflow: hidden;
        }
        /* When an admin-uploaded screenshot fills the frame, drop the placeholder background */
        .ires-screenshot.is-filled {
            background: none;
            border: 0;
        }
        .ires-screenshot.is-filled > img {
            position: absolute; inset: 0;
            width: 100%; height: 100%;
            object-fit: cover;
            border-radius: 1rem;
        }
        .ires-screenshot__frame {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            min-height: 240px;
            padding: 1.25rem;
            text-align: center;
            flex-direction: column;
            gap: .5rem;
        }
        .ires-screenshot__chip {
            font-size: .7rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(125, 211, 252, 0.9);
            background: rgba(14,165,233,0.08);
            border: 1px solid rgba(14,165,233,0.25);
            padding: .25rem .6rem;
            border-radius: 999px;
        }
        .ires-screenshot__label {
            font-weight: 700;
            color: #f1f5f9;
        }
        .ires-screenshot__hint {
            font-size: .8rem;
            color: rgba(148,163,184,.8);
        }
        .ires-screenshot__dots {
            position: absolute;
            top: 12px; inset-inline-start: 14px;
            display: flex; gap: 6px;
        }
        .ires-screenshot__dots span {
            width: 10px; height: 10px; border-radius: 50%;
        }
        .ires-gradient-text {
            background: linear-gradient(90deg, #60a5fa, #22d3ee);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        @keyframes iresFloatY { 0%,100% { transform: translateY(0);} 50% { transform: translateY(-8px);} }
        .ires-float { animation: iresFloatY 6s ease-in-out infinite; }
    </style>
@endsection

@section('content')

    {{-- ─────────────────────────────────────────────────────────────
         HERO
    ───────────────────────────────────────────────────────────── --}}
    <section class="relative bg-[#0a1628] overflow-hidden pt-32 pb-20">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-25"></div>
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600/30 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-cyan-600/20 rounded-full blur-[120px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            @include('partials.breadcrumbs', ['items' => [
                ['label' => $isRtl ? 'المنتجات' : 'Products', 'url' => route($locale . '.products')],
                ['label' => $isRtl ? 'نظام iRes' : 'iRes System'],
            ]])

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mt-10">
                <div class="space-y-7 text-center lg:text-start">
                    <div class="inline-flex items-center gap-2 bg-cyan-500/10 border border-cyan-500/20 rounded-full px-4 py-1.5 text-cyan-300 font-medium text-sm">
                        <span class="material-icons-round text-sm">restaurant_menu</span>
                        {{ $isRtl ? 'iRes System — نظام إدارة المطاعم من رُقي' : 'iRes System — Restaurant Management by RoQay' }}
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight">
                        @if($isRtl)
                            نظام متكامل لإدارة وتشغيل <span class="ires-gradient-text">المطاعم</span>
                        @else
                            A complete <span class="ires-gradient-text">restaurant</span> operations platform
                        @endif
                    </h1>

                    <p class="text-lg md:text-xl text-gray-300 leading-relaxed">
                        {{ $isRtl
                            ? 'نظام رُقي لإدارة المطاعم هو منصة تشغيل تربط بين الكاشير، المطبخ، التسليم، المخزون، المشتريات، المالية، والتقارير في نظام واحد سهل وسريع — من تسجيل الطلب وحتى معرفة تكلفة الصنف وصافي الأرباح.'
                            : 'iRes connects POS, kitchen, dispatch, inventory, purchasing, finance, and reporting into one fast system — from order entry to per-item cost and net profit, in real time.' }}
                    </p>

                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                        <a href="#demo" class="bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white px-8 py-4 rounded-xl text-lg font-bold transition-all shadow-[0_0_25px_rgba(6,182,212,0.35)] hover:shadow-[0_0_35px_rgba(6,182,212,0.55)] transform hover:-translate-y-1 flex items-center gap-2">
                            <span class="material-icons-round">rocket_launch</span>
                            {{ $isRtl ? 'اطلب تجربة النظام' : 'Request a demo' }}
                        </a>
                        <a href="#capabilities" class="bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white px-8 py-4 rounded-xl text-lg font-bold transition-all transform hover:-translate-y-1">
                            {{ $isRtl ? 'اكتشف المميزات' : 'Explore features' }}
                        </a>
                    </div>

                    {{-- Quick stats strip --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6">
                        @foreach($stats as $s)
                            <div class="bg-white/5 border border-white/10 rounded-xl py-3 px-2 text-center backdrop-blur-sm">
                                <div class="text-2xl md:text-3xl font-extrabold text-white">{{ $s['value'] }}</div>
                                <div class="text-xs text-gray-400 mt-1">{{ $isRtl ? $s['label_ar'] : $s['label_en'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Hero screenshot: uploaded image if present, otherwise a styled placeholder --}}
                <div class="relative perspective-1000">
                    <div class="ires-screenshot aspect-[4/3] shadow-2xl ires-float {{ $shotUrl('hero') ? 'is-filled' : '' }}">
                        @if($url = $shotUrl('hero'))
                            <img src="{{ $url }}" alt="{{ $isRtl ? 'واجهة الكاشير - iRes POS' : 'iRes POS — cashier screen' }}" loading="lazy">
                        @else
                            <div class="ires-screenshot__dots">
                                <span style="background:#ef4444"></span>
                                <span style="background:#eab308"></span>
                                <span style="background:#22c55e"></span>
                            </div>
                            <div class="ires-screenshot__frame">
                                <span class="material-icons-round text-5xl text-cyan-300/80">point_of_sale</span>
                                <span class="ires-screenshot__chip">{{ $isRtl ? 'لقطة شاشة' : 'Screenshot' }}</span>
                                <div class="ires-screenshot__label">{{ $isRtl ? 'واجهة الكاشير - iRes POS' : 'iRes POS — cashier screen' }}</div>
                                <div class="ires-screenshot__hint">{{ $shotLabel }}</div>
                            </div>
                        @endif
                    </div>

                    {{-- Floating badges --}}
                    <div class="absolute {{ $isRtl ? '-left-6' : '-right-6' }} top-10 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl shadow-xl p-4 flex items-center gap-3 ires-float" style="animation-delay:1s;">
                        <div class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center">
                            <span class="material-icons-round text-green-400">kitchen</span>
                        </div>
                        <div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-wider">{{ $isRtl ? 'المطبخ' : 'Kitchen' }}</div>
                            <div class="text-white font-bold text-sm">{{ $isRtl ? '12 طلب نشط' : '12 active orders' }}</div>
                        </div>
                    </div>
                    <div class="absolute {{ $isRtl ? '-right-6' : '-left-6' }} bottom-10 bg-white/10 backdrop-blur-xl border border-white/20 rounded-xl shadow-xl p-4 flex items-center gap-3 ires-float" style="animation-delay:2.5s;">
                        <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center">
                            <span class="material-icons-round text-blue-400">paid</span>
                        </div>
                        <div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-wider">{{ $isRtl ? 'فود كوست' : 'Food cost' }}</div>
                            <div class="text-white font-bold text-sm">{{ $isRtl ? 'تحديث لحظي' : 'Real-time' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-[calc(100%+1.3px)] h-[60px] md:h-[110px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,121.22,194.2,110.6,238.33,103.11,280.24,80.7,321.39,56.44Z" class="fill-slate-50"></path>
            </svg>
        </div>
    </section>

    {{-- ─────────────────────────────────────────────────────────────
         WHY THIS SYSTEM
    ───────────────────────────────────────────────────────────── --}}
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="text-cyan-600 font-bold uppercase tracking-wider text-sm mb-3">{{ $isRtl ? 'لماذا iRes؟' : 'Why iRes?' }}</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $isRtl ? 'إدارة المطاعم لا تعتمد فقط على شاشة كاشير' : 'Running a restaurant is more than a POS screen' }}
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed mb-6">
                    {{ $isRtl
                        ? 'المشكلة الحقيقية في الربط بين الطلبات، المطبخ، التسليم، المخزون، المشتريات، تكلفة الأصناف، العهد، المصروفات، التقارير، ومتابعة الأداء. iRes يجمع كل هذه الأجزاء في منصة واحدة مترابطة، بحيث يصبح كل طلب وكل حركة مخزون وكل مصروف مسجلًا ومفهومًا.'
                        : 'The real problem is connecting orders, kitchen, delivery, inventory, purchasing, item cost, custody, expenses, reports, and performance tracking. iRes ties all of that into one coherent platform — every order, every stock movement, every expense recorded and understandable.' }}
                </p>
                <a href="#capabilities" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-800">
                    {{ $isRtl ? 'شاهد كل ما يغطيه النظام' : 'See everything iRes covers' }}
                    <span class="material-icons-round {{ $isRtl ? 'rotate-180' : '' }}">arrow_forward</span>
                </a>
            </div>

            {{-- Connected-domains visual --}}
            <div class="relative">
                <div class="grid grid-cols-3 gap-3">
                    @php
                        $nodes = [
                            ['icon'=>'point_of_sale','ar'=>'الطلبات','en'=>'Orders','color'=>'blue'],
                            ['icon'=>'kitchen','ar'=>'المطبخ','en'=>'Kitchen','color'=>'orange'],
                            ['icon'=>'delivery_dining','ar'=>'التسليم','en'=>'Delivery','color'=>'green'],
                            ['icon'=>'warehouse','ar'=>'المخزون','en'=>'Inventory','color'=>'cyan'],
                            ['icon'=>'shopping_cart','ar'=>'المشتريات','en'=>'Purchasing','color'=>'purple'],
                            ['icon'=>'paid','ar'=>'تكلفة الصنف','en'=>'Item cost','color'=>'amber'],
                            ['icon'=>'badge','ar'=>'العهد والمصروفات','en'=>'Custody & expenses','color'=>'pink'],
                            ['icon'=>'bar_chart','ar'=>'التقارير','en'=>'Reports','color'=>'indigo'],
                            ['icon'=>'insights','ar'=>'متابعة الأداء','en'=>'Performance','color'=>'teal'],
                        ];
                    @endphp
                    @foreach($nodes as $n)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 text-center hover:shadow-lg transition-shadow">
                            <div class="w-10 h-10 mx-auto mb-2 rounded-lg flex items-center justify-center bg-{{ $n['color'] }}-100 text-{{ $n['color'] }}-600">
                                <span class="material-icons-round">{{ $n['icon'] }}</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-800">{{ $isRtl ? $n['ar'] : $n['en'] }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="absolute inset-0 pointer-events-none rounded-2xl ring-1 ring-blue-200/40"></div>
            </div>
        </div>
    </section>

    {{-- ─────────────────────────────────────────────────────────────
         CORE CAPABILITIES (POS / Channels / Kitchen / Delivery / Dispatch / Customers)
    ───────────────────────────────────────────────────────────── --}}
    <section id="capabilities" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="text-cyan-600 font-bold uppercase tracking-wider text-sm mb-3">{{ $isRtl ? 'القدرات الأساسية' : 'Core capabilities' }}</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $isRtl ? 'كل ما يحتاجه المطعم في الواجهة الأمامية' : 'Everything the front of house needs' }}</h2>
                <p class="text-lg text-gray-600">{{ $isRtl ? 'كاشير، قنوات بيع، مطبخ، تسليم، ديسباتش، وعملاء — مصممة لتشغيل سريع وموثق.' : 'POS, channels, kitchen, handover, dispatch, and customers — built for fast, traceable operations.' }}</p>
            </div>

            <div class="space-y-20">
                @foreach($capabilities as $i => $c)
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                        <div class="{{ $i % 2 === 1 ? 'lg:order-2' : '' }}">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                    <span class="material-icons-round">{{ $c['icon'] }}</span>
                                </div>
                                <span class="text-xs font-bold uppercase tracking-wider text-cyan-600">{{ $isRtl ? 'القدرة' : 'Capability' }} {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ $isRtl ? $c['title_ar'] : $c['title_en'] }}</h3>
                            <p class="text-gray-600 text-lg leading-relaxed mb-6">{{ $isRtl ? $c['desc_ar'] : $c['desc_en'] }}</p>
                            <ul class="space-y-3">
                                @foreach(($isRtl ? $c['bullets_ar'] : $c['bullets_en']) as $b)
                                    <li class="flex items-start gap-3 text-gray-700">
                                        <span class="material-icons-round text-cyan-500 mt-0.5 shrink-0">check_circle</span>
                                        <span>{{ $b }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Screenshot: uploaded image for this capability slot, else placeholder --}}
                        <div class="{{ $i % 2 === 1 ? 'lg:order-1' : '' }}">
                            <div class="ires-screenshot aspect-[16/10] shadow-xl {{ $shotUrl($c['slot']) ? 'is-filled' : '' }}">
                                @if($url = $shotUrl($c['slot']))
                                    <img src="{{ $url }}" alt="{{ $isRtl ? $c['shot_ar'] : $c['shot_en'] }}" loading="lazy">
                                @else
                                    <div class="ires-screenshot__dots">
                                        <span style="background:#ef4444"></span>
                                        <span style="background:#eab308"></span>
                                        <span style="background:#22c55e"></span>
                                    </div>
                                    <div class="ires-screenshot__frame">
                                        <span class="material-icons-round text-5xl text-cyan-300/80">{{ $c['icon'] }}</span>
                                        <span class="ires-screenshot__chip">{{ $isRtl ? 'لقطة شاشة' : 'Screenshot' }}</span>
                                        <div class="ires-screenshot__label">{{ $isRtl ? $c['shot_ar'] : $c['shot_en'] }}</div>
                                        <div class="ires-screenshot__hint">{{ $shotLabel }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─────────────────────────────────────────────────────────────
         INVENTORY MANAGEMENT
    ───────────────────────────────────────────────────────────── --}}
    <section class="py-20 bg-gradient-to-b from-slate-50 to-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <div class="text-cyan-600 font-bold uppercase tracking-wider text-sm mb-3">{{ $isRtl ? 'إدارة المخزون' : 'Inventory management' }}</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $isRtl ? 'تحكم كامل من المخزن للمطبخ للوصفة' : 'Full control — from store, to kitchen, to recipe' }}</h2>
                <p class="text-lg text-gray-600">{{ $isRtl ? 'مخزون متعدد المواقع، وصفات، تشغيلات، طلبات صرف باعتماد، جرد جماعي، وهالك موثق.' : 'Multi-location stock, recipes, prep batches, approved issue requests, bulk stocktake, and tracked waste.' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach($inventory as $item)
                    <div class="bg-white rounded-2xl p-6 border border-gray-200 hover:border-cyan-300 hover:shadow-xl transition-all group">
                        <div class="w-12 h-12 bg-cyan-50 text-cyan-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-cyan-600 group-hover:text-white transition-colors">
                            <span class="material-icons-round">{{ $item['icon'] }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $isRtl ? $item['title_ar'] : $item['title_en'] }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $isRtl ? $item['desc_ar'] : $item['desc_en'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Wide screenshot: uploaded inventory image if present --}}
            <div class="ires-screenshot aspect-[21/9] shadow-2xl {{ $shotUrl('inventory') ? 'is-filled' : '' }}">
                @if($url = $shotUrl('inventory'))
                    <img src="{{ $url }}" alt="{{ $isRtl ? 'شاشة الجرد اليومي / حركات المخزون' : 'Bulk stocktake / inventory movements screen' }}" loading="lazy">
                @else
                    <div class="ires-screenshot__dots">
                        <span style="background:#ef4444"></span>
                        <span style="background:#eab308"></span>
                        <span style="background:#22c55e"></span>
                    </div>
                    <div class="ires-screenshot__frame">
                        <span class="material-icons-round text-5xl text-cyan-300/80">warehouse</span>
                        <span class="ires-screenshot__chip">{{ $isRtl ? 'لقطة شاشة' : 'Screenshot' }}</span>
                        <div class="ires-screenshot__label">{{ $isRtl ? 'شاشة الجرد اليومي / حركات المخزون' : 'Bulk stocktake / inventory movements screen' }}</div>
                        <div class="ires-screenshot__hint">{{ $shotLabel }}</div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ─────────────────────────────────────────────────────────────
         FINANCIAL MODULE
    ───────────────────────────────────────────────────────────── --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
            <div>
                <div class="text-cyan-600 font-bold uppercase tracking-wider text-sm mb-3">{{ $isRtl ? 'المالية والحسابات' : 'Financials & accounting' }}</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $isRtl ? 'موديول مالي عملي — مناسب لمطعم وليس لشركة ERP' : 'Practical financials — sized for a restaurant, not an ERP' }}
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed mb-8">
                    {{ $isRtl
                        ? 'الصندوق، البنك، العهد، السلف، الشركاء، والمحاسبة المبسطة — لتعرف وضعك المالي التشغيلي بوضوح وبدون تعقيد.'
                        : 'Cash, bank, custody, advances, partners, and a lean accounting layer — clear operational visibility without enterprise complexity.' }}
                </p>

                <div class="space-y-4">
                    @foreach($financial as $f)
                        <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-10 h-10 bg-white text-blue-600 rounded-lg flex items-center justify-center shrink-0 shadow-sm border border-blue-100">
                                <span class="material-icons-round">{{ $f['icon'] }}</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">{{ $isRtl ? $f['title_ar'] : $f['title_en'] }}</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $isRtl ? $f['desc_ar'] : $f['desc_en'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:sticky lg:top-24">
                <div class="ires-screenshot aspect-[4/5] shadow-2xl {{ $shotUrl('financial') ? 'is-filled' : '' }}">
                    @if($url = $shotUrl('financial'))
                        <img src="{{ $url }}" alt="{{ $isRtl ? 'لوحة الصندوق والبنك والعهد' : 'Cash, bank & custody dashboard' }}" loading="lazy">
                    @else
                        <div class="ires-screenshot__dots">
                            <span style="background:#ef4444"></span>
                            <span style="background:#eab308"></span>
                            <span style="background:#22c55e"></span>
                        </div>
                        <div class="ires-screenshot__frame">
                            <span class="material-icons-round text-5xl text-cyan-300/80">account_balance</span>
                            <span class="ires-screenshot__chip">{{ $isRtl ? 'لقطة شاشة' : 'Screenshot' }}</span>
                            <div class="ires-screenshot__label">{{ $isRtl ? 'لوحة الصندوق والبنك والعهد' : 'Cash, bank & custody dashboard' }}</div>
                            <div class="ires-screenshot__hint">{{ $shotLabel }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ─────────────────────────────────────────────────────────────
         REPORTS
    ───────────────────────────────────────────────────────────── --}}
    <section class="py-20 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-30 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:3rem_3rem] [mask-image:radial-gradient(ellipse_60%_60%_at_50%_0%,#000_60%,transparent_100%)]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <div class="text-cyan-400 font-bold uppercase tracking-wider text-sm mb-3">{{ $isRtl ? 'التقارير' : 'Reports' }}</div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $isRtl ? '7 تقارير تشغيلية تجاوب أهم أسئلتك اليومية' : '7 operations reports that answer your day-to-day questions' }}</h2>
                <p class="text-lg text-gray-300">{{ $isRtl ? 'من اليومية الشاملة وحتى الأرباح والخسائر التشغيلية — مع تصدير Excel.' : 'From a full daily report to operational P&L — Excel export included.' }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-12">
                @foreach($reports as $r)
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-cyan-500/10 text-cyan-300 flex items-center justify-center mb-4 border border-cyan-500/20">
                            <span class="material-icons-round">{{ $r['icon'] }}</span>
                        </div>
                        <h3 class="text-lg font-bold mb-2">{{ $isRtl ? $r['title_ar'] : $r['title_en'] }}</h3>
                        <p class="text-gray-300 text-sm leading-relaxed">{{ $isRtl ? $r['desc_ar'] : $r['desc_en'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="ires-screenshot aspect-[21/9] shadow-2xl {{ $shotUrl('reports') ? 'is-filled' : '' }}">
                @if($url = $shotUrl('reports'))
                    <img src="{{ $url }}" alt="{{ $isRtl ? 'تقرير اليومية الشامل / الأرباح والخسائر' : 'Daily report / operational P&L' }}" loading="lazy">
                @else
                <div class="ires-screenshot__dots">
                    <span style="background:#ef4444"></span>
                    <span style="background:#eab308"></span>
                    <span style="background:#22c55e"></span>
                </div>
                <div class="ires-screenshot__frame">
                    <span class="material-icons-round text-5xl text-cyan-300/80">insights</span>
                    <span class="ires-screenshot__chip">{{ $isRtl ? 'لقطة شاشة' : 'Screenshot' }}</span>
                    <div class="ires-screenshot__label">{{ $isRtl ? 'تقرير اليومية الشامل / الأرباح والخسائر' : 'Daily report / operational P&L' }}</div>
                    <div class="ires-screenshot__hint">{{ $shotLabel }}</div>
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ─────────────────────────────────────────────────────────────
         PERMISSIONS & USERS
    ───────────────────────────────────────────────────────────── --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($roles as $r)
                        <div class="bg-slate-50 border border-slate-100 rounded-xl p-4 text-center hover:bg-blue-50 hover:border-blue-200 transition-colors">
                            <div class="w-10 h-10 mx-auto mb-2 rounded-lg bg-blue-600 text-white flex items-center justify-center">
                                <span class="material-icons-round">{{ $r['icon'] }}</span>
                            </div>
                            <div class="text-sm font-semibold text-gray-800">{{ $isRtl ? $r['label_ar'] : $r['label_en'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="order-1 lg:order-2">
                <div class="text-cyan-600 font-bold uppercase tracking-wider text-sm mb-3">{{ $isRtl ? 'الصلاحيات والمستخدمين' : 'Permissions & users' }}</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $isRtl ? 'كل مستخدم يرى فقط ما يخص دوره' : 'Each user sees only what their role allows' }}
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed mb-6">
                    {{ $isRtl
                        ? 'نظام صلاحيات مرن يتحكم في من يبيع، من يعتمد الخصومات، من يوافق على طلبات المخزون والهالك، من يشاهد التقارير، من يدير المالية، ومن يعدّل المنيو.'
                        : 'A flexible permission system controls who can sell, approve discounts, sign off on stock requests and waste, view reports, manage financials, and edit the menu.' }}
                </p>
                <ul class="space-y-3 text-gray-700">
                    @foreach([
                        ['ar' => 'تحكم دقيق في كل إجراء حساس', 'en' => 'Fine-grained control over every sensitive action'],
                        ['ar' => 'تنفيذ مبدأ أقل صلاحية ممكنة', 'en' => 'Enforces principle of least privilege'],
                        ['ar' => 'سجل من نفّذ ومن وافق على كل عملية', 'en' => 'Audit trail of who did and who approved each operation'],
                    ] as $p)
                        <li class="flex items-start gap-3">
                            <span class="material-icons-round text-cyan-500 mt-0.5">check_circle</span>
                            <span>{{ $isRtl ? $p['ar'] : $p['en'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- ─────────────────────────────────────────────────────────────
         ONLINE ORDERING + RELEASE NOTES + NOTIFICATIONS
    ───────────────────────────────────────────────────────────── --}}
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Online ordering --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                            <span class="material-icons-round">language</span>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider text-cyan-600">{{ $isRtl ? 'الموقع الإلكتروني' : 'Online ordering' }}</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $isRtl ? 'موقع طلبات للعملاء' : 'Customer-facing ordering site' }}</h3>
                    <p class="text-gray-600 mb-5 leading-relaxed">
                        {{ $isRtl
                            ? 'واجهة ويب لعرض المطعم، قائمة الطعام والأسعار، السلة، الطلب كزائر، دليفري أو استلام — كل الطلبات تدخل مسار مراجعة Dispatch قبل ظهورها في المطبخ.'
                            : 'A web storefront for menu, prices, cart, guest checkout, delivery or pickup — every order is reviewed in the Dispatch board before reaching the kitchen.' }}
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach([
                            ['ar' => 'معلومات المطعم وقائمة الطعام', 'en' => 'Restaurant info & menu', 'icon' => 'restaurant_menu'],
                            ['ar' => 'سلة وطلب كزائر', 'en' => 'Cart and guest checkout', 'icon' => 'shopping_cart'],
                            ['ar' => 'دليفري أو استلام', 'en' => 'Delivery or pickup', 'icon' => 'delivery_dining'],
                            ['ar' => 'مراجعة Dispatch قبل المطبخ', 'en' => 'Dispatch review before kitchen', 'icon' => 'fact_check'],
                        ] as $f)
                            <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-lg">
                                <span class="material-icons-round text-blue-600">{{ $f['icon'] }}</span>
                                <span class="text-gray-700 text-sm font-medium">{{ $isRtl ? $f['ar'] : $f['en'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="px-8 pb-8">
                    <div class="ires-screenshot aspect-[16/7] shadow-lg {{ $shotUrl('online_orders') ? 'is-filled' : '' }}">
                        @if($url = $shotUrl('online_orders'))
                            <img src="{{ $url }}" alt="{{ $isRtl ? 'موقع الطلبات للعملاء' : 'Customer ordering site' }}" loading="lazy">
                        @else
                            <div class="ires-screenshot__dots">
                                <span style="background:#ef4444"></span>
                                <span style="background:#eab308"></span>
                                <span style="background:#22c55e"></span>
                            </div>
                            <div class="ires-screenshot__frame">
                                <span class="material-icons-round text-4xl text-cyan-300/80">storefront</span>
                                <span class="ires-screenshot__chip">{{ $isRtl ? 'لقطة شاشة' : 'Screenshot' }}</span>
                                <div class="ires-screenshot__label">{{ $isRtl ? 'موقع الطلبات للعملاء' : 'Customer ordering site' }}</div>
                                <div class="ires-screenshot__hint">{{ $shotLabel }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Release notes + Notifications stacked --}}
            <div class="space-y-8">
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center mb-3">
                        <span class="material-icons-round">campaign</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $isRtl ? 'ملاحظات الإصدارات' : 'Release notes' }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ $isRtl
                            ? 'يعرض النظام Release Notes داخل لوحة الإدارة بعد كل تحديث، ليعرف المستخدمون ما الذي تم إضافته وما الذي تغير وكيف تعمل المميزات الجديدة. تظهر مرة واحدة لكل مستخدم ويمكن الرجوع لها لاحقًا.'
                            : 'In-app release notes appear once per user after every update — explaining what was added, what changed, and how new features work. Always available to re-read later.' }}
                    </p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center mb-3">
                        <span class="material-icons-round">notifications_active</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $isRtl ? 'الإشعارات الداخلية' : 'In-app notifications' }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ $isRtl
                            ? 'إشعارات داخل البوابة ولوحة الإدارة — مثل إشعار المالك عند تسجيل طلب عليه، إشعارات الموافقات، وإشعارات مستقبلية للمخزون والمالية والتشغيل.'
                            : 'Notifications inside the portal and admin — e.g. owner alerts when an order references them, approval requests, and upcoming inventory / finance / operations alerts.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ─────────────────────────────────────────────────────────────
         TECHNICAL + CUSTOMIZABLE
    ───────────────────────────────────────────────────────────── --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-2xl p-8 shadow-xl">
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-icons-round text-cyan-300 text-3xl">code</span>
                    <h3 class="text-2xl font-bold">{{ $isRtl ? 'مبني بتقنيات حديثة' : 'Built on modern stack' }}</h3>
                </div>
                <p class="text-gray-300 mb-6">{{ $isRtl ? 'النظام مبني على Laravel ويعتمد هيكلًا واضحًا قابلًا للتوسع.' : 'Built on Laravel, with a clean architecture designed to scale.' }}</p>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    @foreach([
                        ['ar' => 'Backend قوي وآمن', 'en' => 'Solid, secure backend'],
                        ['ar' => 'Admin Panel متكامل', 'en' => 'Full admin panel'],
                        ['ar' => 'POS سريع', 'en' => 'Fast POS'],
                        ['ar' => 'شاشات تشغيل منفصلة', 'en' => 'Separate ops screens'],
                        ['ar' => 'تقارير متعددة', 'en' => 'Multiple reports'],
                        ['ar' => 'نظام صلاحيات', 'en' => 'Permission system'],
                        ['ar' => 'دعم RTL والعربية', 'en' => 'RTL + Arabic'],
                        ['ar' => 'تصميم متجاوب', 'en' => 'Responsive design'],
                    ] as $t)
                        <div class="flex items-center gap-2 bg-white/5 rounded-lg p-2 border border-white/10">
                            <span class="material-icons-round text-cyan-300 text-base">check</span>
                            <span>{{ $isRtl ? $t['ar'] : $t['en'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-600 to-cyan-600 text-white rounded-2xl p-8 shadow-xl relative overflow-hidden">
                <div class="absolute -right-12 -top-12 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
                <div class="flex items-center gap-3 mb-4 relative z-10">
                    <span class="material-icons-round text-3xl">tune</span>
                    <h3 class="text-2xl font-bold">{{ $isRtl ? 'قابل للتخصيص حسب مطعمك' : 'Customizable to your restaurant' }}</h3>
                </div>
                <p class="mb-6 text-blue-50 relative z-10">{{ $isRtl ? 'النظام يتوسع معك حسب طبيعة العمل.' : 'iRes extends as your operation grows.' }}</p>
                <ul class="space-y-3 relative z-10">
                    @foreach([
                        ['ar' => 'إضافة فروع', 'en' => 'Add branches'],
                        ['ar' => 'إضافة قنوات بيع جديدة', 'en' => 'Add new sales channels'],
                        ['ar' => 'تقارير مخصصة', 'en' => 'Custom reports'],
                        ['ar' => 'تكامل مع تطبيقات التوصيل', 'en' => 'Delivery-app integrations'],
                        ['ar' => 'بوابة عملاء', 'en' => 'Customer portal'],
                        ['ar' => 'إشعارات متقدمة', 'en' => 'Advanced notifications'],
                        ['ar' => 'الدفع الإلكتروني مستقبلاً', 'en' => 'Online payment (future)'],
                    ] as $t)
                        <li class="flex items-center gap-3"><span class="material-icons-round text-cyan-200">arrow_forward</span><span>{{ $isRtl ? $t['ar'] : $t['en'] }}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- ─────────────────────────────────────────────────────────────
         WHO IS IT FOR
    ───────────────────────────────────────────────────────────── --}}
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <div class="text-cyan-600 font-bold uppercase tracking-wider text-sm mb-3">{{ $isRtl ? 'لمن هذا النظام' : 'Who it’s for' }}</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $isRtl ? 'مناسب للمطاعم التي تحتاج تشغيلًا حقيقيًا' : 'Built for restaurants that need real operations control' }}</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($audience as $a)
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-xl transition-all flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <span class="material-icons-round">{{ $a['icon'] }}</span>
                        </div>
                        <div class="text-gray-800 font-medium leading-relaxed">{{ $isRtl ? $a['label_ar'] : $a['label_en'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─────────────────────────────────────────────────────────────
         VALUE DELIVERED
    ───────────────────────────────────────────────────────────── --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <div class="text-cyan-600 font-bold uppercase tracking-wider text-sm mb-3">{{ $isRtl ? 'القيمة' : 'Value' }}</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $isRtl ? 'ماذا تكسب باستخدام iRes؟' : 'What you get with iRes' }}</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 max-w-6xl mx-auto">
                @foreach($value as $v)
                    <div class="flex items-start gap-4 p-5 bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-100 rounded-xl">
                        <div class="w-11 h-11 rounded-xl bg-white text-blue-600 flex items-center justify-center shrink-0 shadow-sm">
                            <span class="material-icons-round">{{ $v['icon'] }}</span>
                        </div>
                        <div class="text-gray-800 font-semibold leading-relaxed pt-1.5">{{ $isRtl ? $v['ar'] : $v['en'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─────────────────────────────────────────────────────────────
         FAQ
    ───────────────────────────────────────────────────────────── --}}
    @if(count($faqs) > 0)
    <section class="py-20 bg-slate-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div class="text-cyan-600 font-bold uppercase tracking-wider text-sm mb-3">{{ $isRtl ? 'الأسئلة الشائعة' : 'FAQ' }}</div>
                <h2 class="text-3xl font-bold text-gray-900">{{ $isRtl ? 'إجابات سريعة على أكثر الأسئلة شيوعًا' : 'Quick answers to the most common questions' }}</h2>
            </div>
            <div class="space-y-4" x-data="{ active: 0 }">
                @foreach($faqs as $index => $faq)
                    <div class="border border-gray-200 rounded-xl bg-white overflow-hidden">
                        <button @click="active = active === {{ $index }} ? null : {{ $index }}" class="w-full flex items-center justify-between p-5 text-start focus:outline-none hover:bg-gray-50 transition-colors">
                            <span class="font-bold text-gray-900">{{ $isRtl ? $faq->question_ar : $faq->question_en }}</span>
                            <span class="material-icons-round text-gray-400 transition-transform duration-300" :class="active === {{ $index }} ? 'rotate-180' : ''">expand_more</span>
                        </button>
                        <div x-show="active === {{ $index }}" x-collapse x-cloak>
                            <div class="p-5 pt-0 text-gray-600 border-t border-gray-100 leading-relaxed">
                                {{ $isRtl ? $faq->answer_ar : $faq->answer_en }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ─────────────────────────────────────────────────────────────
         FINAL CTA + DEMO FORM
    ───────────────────────────────────────────────────────────── --}}
    <section id="demo" class="py-20 bg-gradient-to-br from-[#0a1628] to-[#0f1c34] relative overflow-hidden">
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-25"></div>
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600/30 rounded-full blur-[120px]"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                <div class="p-8 md:p-12 text-center border-b border-gray-100 bg-gradient-to-br from-blue-600 to-cyan-600 text-white">
                    <h2 class="text-3xl md:text-4xl font-bold mb-3">{{ $isRtl ? 'شغّل مطعمك بذكاء' : 'Run your restaurant smarter' }}</h2>
                    <p class="text-blue-100 max-w-2xl mx-auto">
                        {{ $isRtl
                            ? 'قلل الأخطاء، سرّع الخدمة، راقب المخزون، واعرف تكلفة كل صنف ومبيعاتك اليومية من مكان واحد. اطلب تجربة iRes اليوم.'
                            : 'Cut errors, speed up service, watch your stock, and know item cost and daily sales from one place. Request an iRes demo today.' }}
                    </p>
                </div>

                <div class="p-8 md:p-12">
                    @if(session('success'))
                        <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 flex items-center gap-3">
                            <span class="material-icons-round">check_circle</span>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route($locale . '.contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="interested_product" value="iRes System">
                        <div class="hidden">
                            <label>Leave this empty</label>
                            <input type="text" name="website_url" value="">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'الاسم الكريم' : 'Full Name' }} <span class="text-red-500">*</span></label>
                                <input type="text" name="name" required class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" value="{{ old('name') }}">
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'اسم المطعم' : 'Restaurant name' }}</label>
                                <input type="text" name="company_name" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" value="{{ old('company_name') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'البريد الإلكتروني' : 'Email Address' }} <span class="text-red-500">*</span></label>
                                <input type="email" name="email" required dir="ltr" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" value="{{ old('email') }}">
                                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'رقم الهاتف' : 'Phone Number' }}</label>
                                <input type="text" name="phone" dir="ltr" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ $isRtl ? 'ملاحظات إضافية' : 'Additional Notes' }}</label>
                            <textarea name="message" rows="4" class="w-full bg-slate-50 border border-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold py-4 rounded-xl shadow-lg transition-all transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            <span class="material-icons-round">rocket_launch</span>
                            {{ $isRtl ? 'اطلب تجربة iRes الآن' : 'Request iRes demo now' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- ─────────────────────────────────────────────────────────────
         RELATED PRODUCTS
    ───────────────────────────────────────────────────────────── --}}
    @if($relatedProducts->count() > 0)
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">{{ $isRtl ? 'منتجات أخرى من رُقي' : 'Other products by RoQay' }}</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedProducts as $rp)
                    <a href="{{ route($locale . '.product.show', $isRtl ? $rp->slug_ar : $rp->slug_en) }}" class="block bg-slate-50 hover:bg-white border border-gray-200 hover:border-blue-200 hover:shadow-xl rounded-2xl p-6 transition-all">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">
                            <span class="material-icons-round">{{ $rp->icon ?? 'apps' }}</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">{{ $isRtl ? $rp->title_ar : $rp->title_en }}</h3>
                        <p class="text-gray-600 text-sm line-clamp-3">{{ $isRtl ? $rp->short_description_ar : $rp->short_description_en }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection
