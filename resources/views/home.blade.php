<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Электроэпиляция в Пятигорске — Бачурина Елена</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --ease: cubic-bezier(.2,.8,.2,1);
            --glass-bg: rgba(255, 255, 255, .62);
            --glass-bg-strong: rgba(255, 255, 255, .74);
            --glass-border: rgba(15, 23, 42, .14);
            --glass-border-strong: rgba(15, 23, 42, .18);
            --shadow: 0 20px 60px rgba(15, 23, 42, .12);
        }
        @keyframes floaty { 0%,100% { transform: translate3d(0,0,0); } 50% { transform: translate3d(0,-14px,0); } }
        @keyframes fadeUp { from { opacity: 0; transform: translate3d(0,18px,0);} to { opacity: 1; transform: translate3d(0,0,0);} }
        @keyframes glow { 0%,100% { opacity:.55; filter: blur(50px);} 50% { opacity:.85; filter: blur(60px);} }
        @keyframes shimmer { 0% { transform: translateX(-120%);} 100% { transform: translateX(220%);} }
        @keyframes bob { 0%,100% { transform: translate3d(0,0,0);} 50% { transform: translate3d(0,10px,0);} }
        .floaty { animation: floaty 7.5s var(--ease) infinite; }
        .glow { animation: glow 7s var(--ease) infinite; }
        .reveal { opacity: 0; transform: translate3d(0,18px,0); }
        .reveal.is-visible { animation: fadeUp .8s var(--ease) both; }
        .glass {
            background: radial-gradient(120% 120% at 20% 0%, rgba(255,255,255,.85), rgba(255,255,255,.55)) , var(--glass-bg);
            backdrop-filter: blur(18px) saturate(1.35);
            -webkit-backdrop-filter: blur(18px) saturate(1.35);
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow);
        }
        .glass-strong {
            background: radial-gradient(120% 120% at 20% 0%, rgba(255,255,255,.92), rgba(255,255,255,.68)) , var(--glass-bg-strong);
            border: 1px solid var(--glass-border-strong);
        }
        .card { position: relative; overflow: hidden; transition: transform .35s var(--ease), box-shadow .35s var(--ease), border-color .35s var(--ease); }
        .card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(140% 90% at 10% 0%, rgba(255,255,255,.65), transparent 60%);
            opacity: .55;
            pointer-events: none;
        }
        .card:hover { transform: translate3d(0,-7px,0) scale(1.012); box-shadow: 0 24px 70px rgba(15,23,42,.14); border-color: var(--glass-border-strong); }
        .btn { position: relative; overflow: hidden; }
        .btn::after { content: ""; position: absolute; inset: -2px; background: linear-gradient(120deg, transparent, rgba(255,255,255,.55), transparent); transform: translateX(-120%); }
        .btn:hover::after { animation: shimmer 1.1s var(--ease); }
        .intro-scroll { animation: bob 1.8s var(--ease) infinite; }

        .intro-stage {
            --intro-p: 0;
        }
        .intro-backdrop {
            opacity: calc(1 - (var(--intro-p) * .85));
            transform: translate3d(0, calc(var(--intro-p) * -18px), 0);
            transition: opacity .12s linear;
            will-change: opacity, transform;
        }
        .intro-content {
            opacity: calc(1 - var(--intro-p));
            transform: translate3d(0, calc(var(--intro-p) * -26px), 0) scale(calc(1 - (var(--intro-p) * .04)));
            filter: blur(calc(var(--intro-p) * 6px));
            will-change: opacity, transform, filter;
        }

        details.faq > summary { list-style: none; }
        details.faq > summary::-webkit-details-marker { display: none; }
        details.faq > summary .chev { transition: transform .25s var(--ease), opacity .25s var(--ease); opacity: .7; }
        details.faq[open] > summary .chev { transform: rotate(180deg); opacity: 1; }
        details.faq .faq-body {
            overflow: hidden;
            max-height: 0px;
            opacity: 0;
            transition: max-height .42s var(--ease), opacity .28s var(--ease);
            will-change: max-height, opacity;
        }
        details.faq[open] .faq-body {
            max-height: var(--faq-h, 420px);
            opacity: 1;
        }
        @media (prefers-reduced-motion: reduce) {
            details.faq .faq-body { transition: none; }
            details.faq > summary .chev { transition: none; }
        }

        .contact-card { position: relative; overflow: hidden; }
        .contact-card::before {
            content: "";
            position: absolute;
            inset: 0;
            padding: 1px;
            border-radius: 1.5rem;
            background: linear-gradient(135deg,
                rgba(var(--brand-rgb, 15,23,42), .65),
                rgba(255,255,255,.75),
                rgba(var(--brand-rgb, 15,23,42), .30)
            );
            -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity .35s var(--ease);
            pointer-events: none;
        }
        .contact-card::after {
            content: "";
            position: absolute;
            inset: -40% -20% auto -20%;
            height: 140%;
            background: radial-gradient(closest-side, rgba(var(--brand-rgb, 15,23,42), .22), transparent 70%);
            filter: blur(22px);
            opacity: 0;
            transform: translate3d(0, 8px, 0);
            transition: opacity .35s var(--ease), transform .35s var(--ease);
            pointer-events: none;
        }
        .contact-card:hover::after { opacity: 1; transform: translate3d(0, 0, 0); }
        .contact-card:hover::before { opacity: 1; }
        .contact-icon {
            background: radial-gradient(120% 120% at 30% 0%, rgba(255,255,255,.95), rgba(255,255,255,.68));
            border: 1px solid rgba(15,23,42,.10);
            box-shadow: 0 14px 38px rgba(15,23,42,.10);
        }
        .contact-cta {
            background: rgba(var(--brand-rgb, 15,23,42), .10);
            border: 1px solid rgba(var(--brand-rgb, 15,23,42), .18);
            color: rgb(15,23,42);
        }
        .contact-card:hover .contact-cta {
            background: rgba(var(--brand-rgb, 15,23,42), .16);
            border-color: rgba(var(--brand-rgb, 15,23,42), .24);
        }

        @media (hover: hover) and (pointer: fine) {
            .contact-card {
                transition: transform .35s var(--ease), box-shadow .35s var(--ease);
                transform-style: preserve-3d;
            }
            .contact-card:hover {
                transform: translate3d(0,-8px,0) rotateX(1.2deg) rotateY(-1.2deg);
                box-shadow: 0 28px 80px rgba(15,23,42,.16);
            }
        }
    </style>
</head>
<body class="bg-white text-slate-900 antialiased">

<header id="siteHeader" class="fixed top-0 left-0 right-0 z-40 opacity-0 -translate-y-2 pointer-events-none transition-all duration-300">
    <div class="mx-auto max-w-6xl px-4 py-3 flex items-center justify-between">
        <a href="#top" class="font-semibold tracking-tight">Электролог КМВ</a>
        <nav class="hidden md:flex gap-6 text-sm text-slate-700">
            <a class="hover:text-slate-900" href="#about">О процедуре</a>
            <a class="hover:text-slate-900" href="#price">Прайс</a>
            <a class="hover:text-slate-900" href="#book">Запись</a>
            <a class="hover:text-slate-900" href="#contacts">Контакты</a>
        </nav>
        <a href="#book" class="btn inline-flex items-center rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">
            Записаться
        </a>
    </div>
</header>

<main id="top">
    <section id="intro" class="intro-stage relative min-h-screen overflow-hidden">
        <div class="intro-backdrop absolute inset-0 -z-10">
            <div class="absolute -top-28 -left-28 h-[34rem] w-[34rem] rounded-full bg-slate-200 opacity-70 glow"></div>
            <div class="absolute -bottom-32 -right-32 h-[38rem] w-[38rem] rounded-full bg-slate-100 opacity-90 glow" style="animation-delay: 1.6s"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-white via-white to-slate-50/70"></div>
        </div>

        <div class="intro-content mx-auto max-w-6xl px-4 pt-24 pb-16 min-h-screen flex items-center">
            <div class="w-full">
                <div class="reveal">
                    <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/70 px-3 py-1 text-xs text-slate-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-slate-900"></span>
                        Приём по записи
                    </div>
                    <h1 class="mt-6 text-4xl md:text-7xl font-semibold tracking-tight leading-[1.02]">
                        Электроэпиляция
                        <span class="block text-slate-700">г. Пятигорск</span>
                    </h1>
                    <div class="mt-6 text-lg md:text-xl text-slate-700">
                        Бачурина Елена
                    </div>
                    <div class="mt-10 flex flex-col sm:flex-row gap-3">
                        <a href="https://www.instagram.com/elektrolog_kmv/?utm_source=site&utm_medium=intro_button&utm_campaign=ig_follow" target="_blank" rel="noopener noreferrer" class="btn w-full sm:w-auto inline-flex justify-center rounded-full px-6 py-3 text-sm font-medium text-white" style="background: linear-gradient(90deg, #F58529, #DD2A7B, #8134AF, #515BD4);">
                            Instagram • подписаться
                        </a>
                        <a href="#book" class="btn w-full sm:w-auto inline-flex justify-center rounded-full border border-slate-300 bg-white/70 px-6 py-3 text-sm font-medium text-slate-900 hover:bg-slate-50">
                            Записаться
                        </a>
                        <a href="#content" class="btn w-full sm:w-auto inline-flex justify-center rounded-full bg-slate-900 px-6 py-3 text-sm font-medium text-white hover:bg-slate-800">
                            Открыть сайт
                        </a>
                    </div>
                </div>

                <div class="mt-14 flex justify-center">
                    <a href="#content" class="intro-scroll inline-flex items-center gap-2 rounded-full glass px-4 py-3 text-xs text-slate-700">
                        <span>Листай вниз</span>
                        <span aria-hidden="true">↓</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div id="content">
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="absolute -top-24 -left-24 h-[26rem] w-[26rem] rounded-full bg-slate-200 opacity-70 glow"></div>
            <div class="absolute -bottom-28 -right-28 h-[30rem] w-[30rem] rounded-full bg-slate-100 opacity-90 glow" style="animation-delay: 1.5s"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-white via-white to-slate-50/60"></div>
        </div>

        <div class="mx-auto max-w-6xl px-4 py-16 md:py-24">
            <div class="grid gap-10 md:grid-cols-1 items-center">
                <div class="reveal">
                    <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/70 px-3 py-1 text-xs text-slate-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-slate-900"></span>
                        Электроэпиляция • по записи
                    </div>
                    <h1 class="mt-5 text-4xl md:text-6xl font-semibold tracking-tight">
                        Электроэпиляция
                        <span class="block text-slate-700">Гладкая кожа — навсегда</span>
                    </h1>
                    <a href="https://www.instagram.com/elektrolog_kmv/?utm_source=site&utm_medium=hero_link&utm_campaign=ig_follow" target="_blank" rel="noopener noreferrer" class="mt-4 inline-flex items-center gap-2 text-sm font-medium text-slate-900 hover:text-slate-700">
                        Смотреть работы в Instagram
                        <span aria-hidden="true">→</span>
                    </a>
                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <button id="heroBookBtn" type="button" class="btn w-full sm:w-auto inline-flex justify-center rounded-full bg-slate-900 px-6 py-3 text-sm font-medium text-white hover:bg-slate-800">
                            Записаться
                        </button>
                        <button id="heroPriceBtn" type="button" class="btn w-full sm:w-auto inline-flex justify-center rounded-full border border-slate-300 bg-white/70 px-6 py-3 text-sm font-medium text-slate-900 hover:bg-slate-50">
                            Прайс
                        </button>
                    </div>
                    <div id="heroPriceHost" class="mt-8 hidden"></div>
                    <div class="mt-8 max-w-xl">
                        <div class="rounded-3xl glass glass-strong p-6">
                            <div class="text-sm font-semibold">Как проходит запись</div>
                            <div class="mt-3 space-y-2 text-sm text-slate-700">
                                <div class="flex gap-3"><span class="text-slate-500">1.</span><span>Выберите дату и время.</span></div>
                                <div class="flex gap-3"><span class="text-slate-500">2.</span><span>Оставьте заявку.</span></div>
                                <div class="flex gap-3"><span class="text-slate-500">3.</span><span>Я подтверждаю запись и отвечаю в удобном мессенджере.</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="mx-auto max-w-6xl px-4 py-16">
        <div class="flex items-end justify-between gap-6 flex-wrap">
            <div class="reveal">
                <h2 class="text-2xl md:text-3xl font-semibold tracking-tight">Минимум слов — максимум ощущения</h2>
                <div class="mt-2 text-sm text-slate-700">Чисто. Спокойно. По записи.</div>
            </div>
        </div>
        <div class="mt-8 reveal">
            <div class="rounded-3xl glass glass-strong p-6">
                <div class="text-sm font-semibold">Как проходит процедура</div>
                <div class="mt-3 text-sm text-slate-700 max-w-prose">
                    Перед началом я уточняю пожелания и особенности кожи, подбираю режим и иглу. Работаю аккуратно, с соблюдением стерильности. После процедуры — рекомендации по уходу.
                </div>
            </div>
        </div>
    </section>

    <section id="why" class="mx-auto max-w-6xl px-4 pb-16">
        <div class="reveal">
            <h2 class="text-2xl md:text-3xl font-semibold tracking-tight">Почему выбирают нас</h2>
            <p class="mt-2 text-sm text-slate-700">Про результат, безопасность и комфорт — без лишней суеты.</p>
        </div>

        <div class="mt-8 grid gap-4 md:grid-cols-2">
            <div class="reveal card rounded-3xl glass p-6">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 h-6 w-6 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs">✔</div>
                    <div>
                        <div class="text-sm font-semibold">Опытный мастер</div>
                        <div class="mt-1 text-sm text-slate-700">Процедуры проводит Бачурина Елена — мастер с большим стажем работы в электроэпиляции. Глубокое понимание техники, кожи и роста волос позволяет добиваться стабильного и безопасного результата.</div>
                    </div>
                </div>
            </div>

            <div class="reveal card rounded-3xl glass p-6">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 h-6 w-6 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs">✔</div>
                    <div>
                        <div class="text-sm font-semibold">Единственный метод навсегда</div>
                        <div class="mt-1 text-sm text-slate-700">Электроэпиляция — это 100% удаление волос навсегда, независимо от цвета волос и типа кожи. Подходит для лица и тела, в том числе для сложных и гормонозависимых зон.</div>
                    </div>
                </div>
            </div>

            <div class="reveal card rounded-3xl glass p-6">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 h-6 w-6 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs">✔</div>
                    <div>
                        <div class="text-sm font-semibold">Современное оборудование</div>
                        <div class="mt-1 text-sm text-slate-700">В работе используется профессиональное оборудование последнего поколения, обеспечивающее точное воздействие, комфорт и минимальную травматичность кожи.</div>
                    </div>
                </div>
            </div>

            <div class="reveal card rounded-3xl glass p-6">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 h-6 w-6 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs">✔</div>
                    <div>
                        <div class="text-sm font-semibold">Индивидуальный подход</div>
                        <div class="mt-1 text-sm text-slate-700">Каждая процедура подбирается индивидуально: учитываются особенности кожи, чувствительность и цели клиентки. Никакого «потока» — только внимательная и аккуратная работа.</div>
                    </div>
                </div>
            </div>

            <div class="reveal card rounded-3xl glass p-6">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 h-6 w-6 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs">✔</div>
                    <div>
                        <div class="text-sm font-semibold">Безопасность и стерильность</div>
                        <div class="mt-1 text-sm text-slate-700">Строгое соблюдение санитарных норм. Используются одноразовые стерильные иглы, которые вскрываются при клиенте.</div>
                    </div>
                </div>
            </div>

            <div class="reveal card rounded-3xl glass p-6">
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 h-6 w-6 rounded-full bg-slate-900 text-white flex items-center justify-center text-xs">✔</div>
                    <div>
                        <div class="text-sm font-semibold">Комфортная атмосфера</div>
                        <div class="mt-1 text-sm text-slate-700">Спокойная, доброжелательная обстановка, бережное отношение и поддержка на всех этапах процедуры.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="faq" class="mx-auto max-w-6xl px-4 pb-16">
        <div class="reveal">
            <h2 class="text-2xl md:text-3xl font-semibold tracking-tight">Вопрос‑ответ</h2>
            <p class="mt-2 text-sm text-slate-700">Коротко и по делу — чтобы было спокойно перед записью.</p>
        </div>

        <div class="mt-8 grid gap-3">
            <details class="faq reveal card rounded-3xl glass p-6">
                <summary class="flex items-center justify-between cursor-pointer select-none">
                    <span class="text-sm font-semibold">Что такое электроэпиляция?</span>
                    <span class="chev">▾</span>
                </summary>
                <div class="faq-body">
                    <div class="pt-3 text-sm text-slate-700">Электроэпиляция — это метод удаления волос с помощью электрического импульса, который разрушает волосяной фолликул. Это единственный способ удаления волос навсегда, признанный эффективным для любого типа кожи и цвета волос.</div>
                </div>
            </details>

            <details class="faq reveal card rounded-3xl glass p-6">
                <summary class="flex items-center justify-between cursor-pointer select-none">
                    <span class="text-sm font-semibold">Подходит ли электроэпиляция для лица?</span>
                    <span class="chev">▾</span>
                </summary>
                <div class="faq-body">
                    <div class="pt-3 text-sm text-slate-700">Да, электроэпиляция идеально подходит для лица, включая подбородок, верхнюю губу и зону бровей. Процедура выполняется максимально аккуратно с использованием специальных одноразовых игл для лица.</div>
                </div>
            </details>

            <details class="faq reveal card rounded-3xl glass p-6">
                <summary class="flex items-center justify-between cursor-pointer select-none">
                    <span class="text-sm font-semibold">Больно ли это?</span>
                    <span class="chev">▾</span>
                </summary>
                <div class="faq-body">
                    <div class="pt-3 text-sm text-slate-700">Ощущения индивидуальны и зависят от зоны и чувствительности кожи. Используются современные техники и оборудование, которые делают процедуру максимально комфортной. Большинство клиенток отмечают, что ощущения вполне терпимые.</div>
                </div>
            </details>

            <details class="faq reveal card rounded-3xl glass p-6">
                <summary class="flex items-center justify-between cursor-pointer select-none">
                    <span class="text-sm font-semibold">Сколько процедур потребуется?</span>
                    <span class="chev">▾</span>
                </summary>
                <div class="faq-body">
                    <div class="pt-3 text-sm text-slate-700">Количество процедур зависит от зоны, густоты волос и индивидуальных особенностей организма. Волосы удаляются постепенно, по мере их роста. Результат накапливается, и с каждым сеансом волос становится всё меньше.</div>
                </div>
            </details>

            <details class="faq reveal card rounded-3xl glass p-6">
                <summary class="flex items-center justify-between cursor-pointer select-none">
                    <span class="text-sm font-semibold">Есть ли противопоказания?</span>
                    <span class="chev">▾</span>
                </summary>
                <div class="faq-body">
                    <div class="pt-3 text-sm text-slate-700">Да, как и у любой процедуры, существуют противопоказания. Перед началом работы мастер обязательно проконсультирует вас и ответит на все вопросы, чтобы процедура была безопасной именно для вас.</div>
                </div>
            </details>

            <details class="faq reveal card rounded-3xl glass p-6">
                <summary class="flex items-center justify-between cursor-pointer select-none">
                    <span class="text-sm font-semibold">Можно ли делать электроэпиляцию при светлых или седых волосах?</span>
                    <span class="chev">▾</span>
                </summary>
                <div class="faq-body">
                    <div class="pt-3 text-sm text-slate-700">Да. В отличие от лазерной эпиляции, электроэпиляция эффективно удаляет светлые, рыжие, седые и пушковые волосы.</div>
                </div>
            </details>

            <details class="faq reveal card rounded-3xl glass p-6">
                <summary class="flex items-center justify-between cursor-pointer select-none">
                    <span class="text-sm font-semibold">Остаются ли следы на коже?</span>
                    <span class="chev">▾</span>
                </summary>
                <div class="faq-body">
                    <div class="pt-3 text-sm text-slate-700">При правильной технике и соблюдении рекомендаций кожа восстанавливается естественным образом. Временные покраснения — нормальная реакция и проходят самостоятельно.</div>
                </div>
            </details>

            <details class="faq reveal card rounded-3xl glass p-6">
                <summary class="flex items-center justify-between cursor-pointer select-none">
                    <span class="text-sm font-semibold">Как подготовиться к процедуре?</span>
                    <span class="chev">▾</span>
                </summary>
                <div class="faq-body">
                    <div class="pt-3 text-sm text-slate-700">Перед процедурой не рекомендуется загорать и использовать агрессивные средства для кожи. Более подробные рекомендации мастер даст на консультации.</div>
                </div>
            </details>

            <details class="faq reveal card rounded-3xl glass p-6">
                <summary class="flex items-center justify-between cursor-pointer select-none">
                    <span class="text-sm font-semibold">Почему важно выбрать опытного мастера?</span>
                    <span class="chev">▾</span>
                </summary>
                <div class="faq-body">
                    <div class="pt-3 text-sm text-slate-700">Электроэпиляция — это ювелирная работа. Опыт мастера напрямую влияет на результат, комфорт и состояние кожи. Работа Бачуриной Елены — это сочетание профессионализма, аккуратности и заботы о каждой клиентке.</div>
                </div>
            </details>
        </div>
    </section>

    <section id="price" class="bg-slate-50 border-y border-slate-200">
        <div class="mx-auto max-w-6xl px-4 py-16">
            <div class="flex items-end justify-between gap-6 flex-wrap">
                <div>
                    <h2 class="text-2xl font-semibold tracking-tight">Прайс</h2>
                    <p class="mt-2 text-sm text-slate-700">Стоимость процедуры и одноразовых игл.</p>
                </div>
                <div class="text-xs text-slate-500">актуально</div>
            </div>

            <div class="mt-8 grid gap-4 md:grid-cols-3">
                <div class="reveal card rounded-3xl glass p-6">
                    <div class="text-sm text-slate-500">Стоимость</div>
                    <div class="mt-2 text-3xl font-semibold" id="priceMain">—</div>
                    <div class="mt-1 text-sm text-slate-700" id="priceMinute">—</div>
                </div>
                <div class="reveal card rounded-3xl glass p-6">
                    <div class="text-sm text-slate-500">Минимальная процедура</div>
                    <div class="mt-2 text-3xl font-semibold" id="priceMin">—</div>
                    <div class="mt-1 text-sm text-slate-700">рублей</div>
                </div>
                <div class="reveal card rounded-3xl glass p-6">
                    <div class="text-sm text-slate-500">Одноразовая игла</div>
                    <div class="mt-3 space-y-2 text-sm text-slate-700">
                        <div class="flex justify-between"><span>Тело</span><span class="font-medium" id="needleBody">—</span></div>
                        <div class="flex justify-between"><span>Лицо</span><span class="font-medium" id="needleFace">—</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="book" class="mx-auto max-w-6xl px-4 py-16">
        <div class="grid gap-10 md:grid-cols-2">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight">Онлайн‑запись</h2>
                <p class="mt-3 text-sm text-slate-700">Выберите дату → время → отправьте заявку.</p>

                <div class="mt-8 rounded-3xl glass glass-strong p-6 reveal">
                    <div class="text-sm font-medium">Дата</div>
                    <div class="mt-3 flex gap-3 items-center">
                        <input id="date" type="date" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm" />
                        <button id="loadSlots" class="btn rounded-2xl bg-slate-900 px-4 py-3 text-sm font-medium text-white hover:bg-slate-800">Показать время</button>
                    </div>

                    <div class="mt-6">
                        <div class="text-sm font-medium">Время</div>
                        <div id="slots" class="mt-3 grid grid-cols-2 sm:grid-cols-3 gap-2"></div>
                        <div id="slotsEmpty" class="mt-3 hidden text-sm text-slate-600">На выбранную дату слотов нет. Попробуйте другую дату.</div>
                    </div>
                </div>
            </div>

            <div>
                <div class="rounded-3xl glass glass-strong p-6 reveal">
                    <div class="text-sm font-medium">Данные</div>
                    <form id="bookingForm" class="mt-4 grid gap-3">
                        <input name="name" placeholder="Ваше имя" class="rounded-2xl border border-slate-300 px-4 py-3 text-sm" required />
                        <input id="phone" name="phone" placeholder="Телефон" inputmode="tel" autocomplete="tel" class="rounded-2xl border border-slate-300 px-4 py-3 text-sm" required />
                        <input name="telegram_username" placeholder="Telegram (необязательно)" class="rounded-2xl border border-slate-300 px-4 py-3 text-sm" />

                        <div class="grid grid-cols-2 gap-3">
                            <select name="needle_type" class="rounded-2xl border border-slate-300 px-4 py-3 text-sm">
                                <option value="">Тип иглы (необязательно)</option>
                                <option value="body">Тело</option>
                                <option value="face">Лицо</option>
                            </select>
                            <select name="duration_minutes" class="rounded-2xl border border-slate-300 px-4 py-3 text-sm">
                                <option value="60">Длительность: 60 мин</option>
                                <option value="90">90 мин</option>
                                <option value="120">120 мин</option>
                            </select>
                        </div>

                        <textarea name="note" rows="3" placeholder="Комментарий (необязательно)" class="rounded-2xl border border-slate-300 px-4 py-3 text-sm"></textarea>

                        <input id="starts_at" name="starts_at" type="hidden" />

                        <button class="btn mt-2 rounded-2xl bg-slate-900 px-5 py-3 text-sm font-medium text-white hover:bg-slate-800" type="submit">Отправить</button>

                        <div id="formMsg" class="hidden rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800"></div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <section id="contacts" class="bg-slate-50 border-t border-slate-200">
        <div class="mx-auto max-w-6xl px-4 py-16">
            <h2 class="text-2xl font-semibold tracking-tight">Контакты</h2>
            <p class="mt-3 text-sm text-slate-700">
                Напишите в удобный мессенджер — отвечу и подберу время.
            </p>

            <div class="mt-8 grid gap-4 md:grid-cols-3">
                <a class="reveal card contact-card rounded-3xl glass p-6 group" style="--brand-rgb: 215, 44, 122" href="https://www.instagram.com/elektrolog_kmv/?utm_source=site&utm_medium=contacts_card&utm_campaign=ig_follow" target="_blank" rel="noopener noreferrer">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <div class="text-sm text-slate-500">Instagram</div>
                                <span class="inline-flex items-center rounded-full border border-slate-200 bg-white/60 px-2 py-0.5 text-[11px] text-slate-600">профиль</span>
                            </div>
                            <div class="mt-2 text-lg font-semibold tracking-tight group-hover:text-slate-900">@elektrolog_kmv</div>
                            <div class="mt-1 text-sm text-slate-700">Быстрые ответы и примеры работ</div>
                            <div class="mt-4 inline-flex items-center gap-2 rounded-2xl px-3 py-2 text-xs font-medium contact-cta">
                                Подписаться
                                <span aria-hidden="true">→</span>
                            </div>
                        </div>
                        <div class="h-11 w-11 rounded-2xl flex items-center justify-center contact-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <defs>
                                    <linearGradient id="ig" x1="2" y1="22" x2="22" y2="2" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#F58529"/>
                                        <stop offset="0.33" stop-color="#DD2A7B"/>
                                        <stop offset="0.66" stop-color="#8134AF"/>
                                        <stop offset="1" stop-color="#515BD4"/>
                                    </linearGradient>
                                </defs>
                                <rect x="4" y="4" width="16" height="16" rx="5" stroke="url(#ig)" stroke-width="1.8"/>
                                <circle cx="12" cy="12" r="4" stroke="url(#ig)" stroke-width="1.8"/>
                                <circle cx="17" cy="7" r="1" fill="url(#ig)"/>
                            </svg>
                        </div>
                    </div>
                </a>

                <a class="reveal card contact-card rounded-3xl glass p-6 group" style="--brand-rgb: 29, 161, 242" href="https://t.me/elektrolog_kmv1" target="_blank" rel="noopener noreferrer">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <div class="text-sm text-slate-500">Telegram</div>
                                <span class="inline-flex items-center rounded-full border border-slate-200 bg-white/60 px-2 py-0.5 text-[11px] text-slate-600">чат</span>
                            </div>
                            <div class="mt-2 text-lg font-semibold tracking-tight group-hover:text-slate-900">@elektrolog_kmv1</div>
                            <div class="mt-1 text-sm text-slate-700">Вопросы, слоты, консультация</div>
                            <div class="mt-4 inline-flex items-center gap-2 rounded-2xl px-3 py-2 text-xs font-medium contact-cta">
                                Написать
                                <span aria-hidden="true">→</span>
                            </div>
                        </div>
                        <div class="h-11 w-11 rounded-2xl flex items-center justify-center contact-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M20.5 5.8c.2-.8-.6-1.5-1.4-1.2L4.6 10.3c-.9.4-.9 1.7.1 2l3.8 1.2 1.5 4.6c.3 1 1.6 1.2 2.2.4l2.2-2.8 3.9 2.8c.7.5 1.7.1 1.9-.8l2.3-11.9Z" fill="#1DA1F2" fill-opacity="0.95"/>
                                <path d="M9.2 13.4 18.1 7.9c.3-.2.6.2.4.5l-7.2 7.2c-.3.3-.5.7-.6 1.1l-.3 2.2" stroke="#0B86D4" stroke-width="1.3" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                </a>

                <a class="reveal card contact-card rounded-3xl glass p-6 group" style="--brand-rgb: 37, 211, 102" href="https://wa.me/79604949073" target="_blank" rel="noopener noreferrer">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <div class="text-sm text-slate-500">WhatsApp</div>
                                <span class="inline-flex items-center rounded-full border border-slate-200 bg-white/60 px-2 py-0.5 text-[11px] text-slate-600">быстро</span>
                            </div>
                            <div class="mt-2 text-lg font-semibold tracking-tight group-hover:text-slate-900">+7 960 494‑90‑73</div>
                            <div class="mt-1 text-sm text-slate-700">Запись и вопросы</div>
                            <div class="mt-4 inline-flex items-center gap-2 rounded-2xl px-3 py-2 text-xs font-medium contact-cta">
                                Написать
                                <span aria-hidden="true">→</span>
                            </div>
                        </div>
                        <div class="h-11 w-11 rounded-2xl flex items-center justify-center contact-icon">
                            <svg class="block" width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid meet">
                                <circle cx="12" cy="12" r="10" fill="#25D366" fill-opacity="0.95"/>
                                <path d="M15.6 14.8 14.5 15.6c-.4.3-1 .3-1.5 0-1.2-.7-2.2-1.7-2.9-2.9-.3-.5-.3-1.1 0-1.5l.8-1.1c.2-.3.2-.8 0-1.1L9.8 7.2c-.3-.5-.9-.7-1.4-.4l-.6.3c-.8.4-1.3 1.2-1.3 2.1 0 4.6 3.7 8.3 8.3 8.3.9 0 1.7-.5 2.1-1.3l.3-.6c.3-.5.1-1.1-.4-1.4l-1.6-.8c-.3-.2-.7-.1-1 .1Z" fill="white" fill-opacity="0.95"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mt-4">
                <div class="reveal card rounded-3xl glass p-6">
                    <div class="text-sm text-slate-500">Город проведения</div>
                    <div class="mt-2 text-lg font-medium">Пятигорск</div>
                </div>
            </div>
        </div>
    </section>
    </div>
</main>

<a href="https://www.instagram.com/elektrolog_kmv/?utm_source=site&utm_medium=sticky_mobile&utm_campaign=ig_follow" target="_blank" rel="noopener noreferrer" class="fixed bottom-4 right-4 z-50 sm:hidden" aria-label="Instagram">
    <span class="inline-flex h-14 w-14 items-center justify-center rounded-full shadow-lg" style="background: linear-gradient(135deg, #F58529, #DD2A7B, #8134AF, #515BD4);">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <rect x="6" y="6" width="12" height="12" rx="4" stroke="white" stroke-width="2"/>
            <circle cx="12" cy="12" r="3" stroke="white" stroke-width="2"/>
            <circle cx="16.7" cy="7.3" r="1" fill="white"/>
        </svg>
    </span>
</a>

<div id="igPopup" class="fixed inset-0 z-[60] hidden">
    <div id="igPopupBackdrop" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
    <div class="relative mx-auto max-w-lg px-4 py-10">
        <div class="glass glass-strong rounded-[2rem] p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-sm font-semibold">Больше работ — в Instagram</div>
                    <div class="mt-2 text-sm text-slate-700">Подпишитесь на профиль — там примеры работ, ответы на вопросы и свободные окна.</div>
                </div>
                <button id="igPopupClose" type="button" class="btn inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/70 px-3 py-2 text-sm font-medium text-slate-900 hover:bg-slate-50">✕</button>
            </div>
            <div class="mt-4 flex flex-col sm:flex-row gap-3">
                <a href="https://www.instagram.com/elektrolog_kmv/?utm_source=site&utm_medium=popup&utm_campaign=ig_follow" target="_blank" rel="noopener noreferrer" class="btn w-full sm:w-auto inline-flex justify-center rounded-full px-6 py-3 text-sm font-medium text-white" style="background: linear-gradient(90deg, #F58529, #DD2A7B, #8134AF, #515BD4);">
                    Подписаться
                </a>
                <button id="igPopupLater" type="button" class="btn w-full sm:w-auto inline-flex justify-center rounded-full border border-slate-300 bg-white/70 px-6 py-3 text-sm font-medium text-slate-900 hover:bg-slate-50">
                    Позже
                </button>
            </div>
        </div>
    </div>
</div>

<div id="bookingModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
    <div class="relative mx-auto max-w-5xl px-3 sm:px-4 py-4 sm:py-6">
        <div class="glass glass-strong rounded-[2rem] p-4 md:p-6 max-h-[calc(100vh-2rem)] overflow-y-auto">
            <div class="flex items-center justify-between">
                <div class="text-sm font-semibold">Запись</div>
                <button id="bookingClose" type="button" class="btn inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/70 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-slate-50">
                    Закрыть
                </button>
            </div>
            <div id="heroBookHost" class="mt-4"></div>
        </div>
    </div>
</div>

<footer class="border-t border-slate-200">
    <div class="mx-auto max-w-6xl px-4 py-8 text-xs text-slate-500 flex items-center justify-between">
        <div>© <span id="year"></span> Электроэпиляция Пятигорск</div>
        <div></div>
    </div>
</footer>

<script>
    const $ = (id) => document.getElementById(id);

    let preferredDateChosen = false;

    const io = new IntersectionObserver((entries) => {
        for (const e of entries) {
            if (e.isIntersecting) {
                e.target.classList.add('is-visible');
                io.unobserve(e.target);
            }
        }
    }, { threshold: 0.12 });

    document.querySelectorAll('.reveal').forEach((el) => io.observe(el));

    function setMsg(text) {
        const el = $('formMsg');
        el.classList.remove('hidden');
        el.textContent = text;
    }

    function clearMsg() {
        const el = $('formMsg');
        el.classList.add('hidden');
        el.textContent = '';
    }

    function formatTime(iso) {
        const d = new Date(iso);
        return d.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
    }

    function formatIsoLocal(iso) {
        const d = new Date(iso);
        const pad = (n) => String(n).padStart(2,'0');
        const yyyy = d.getFullYear();
        const mm = pad(d.getMonth()+1);
        const dd = pad(d.getDate());
        const hh = pad(d.getHours());
        const mi = pad(d.getMinutes());
        const ss = pad(d.getSeconds());
        return `${yyyy}-${mm}-${dd} ${hh}:${mi}:${ss}`;
    }

    async function loadPrice() {
        try {
            const res = await fetch('/api/public/price');
            const data = await res.json();
            const perMin = Number(data.rub_per_minute || 0);
            $('priceMain').textContent = `${perMin * 60} ₽/час`;
            $('priceMinute').textContent = `${perMin} ₽/минута`;
            $('priceMin').textContent = `${data.minimum_procedure_rub ?? '—'}`;
            $('needleBody').textContent = `${data.needles?.body ?? '—'} ₽`;
            $('needleFace').textContent = `${data.needles?.face ?? '—'} ₽`;
        } catch (e) {
            // ignore
        }
    }

    async function loadSlots() {
        clearMsg();
        $('slots').innerHTML = '';
        $('slotsEmpty').classList.add('hidden');

        const date = $('date').value;
        if (!date) {
            setMsg('Выберите дату.');
            return;
        }

        preferredDateChosen = true;

        const url = new URL('/api/public/slots', window.location.origin);
        url.searchParams.set('date', date);
        url.searchParams.set('duration_minutes', document.querySelector('select[name=duration_minutes]').value);

        const res = await fetch(url.toString());
        const data = await res.json();

        const slots = Array.isArray(data.slots) ? data.slots : [];
        if (slots.length === 0) {
            $('slotsEmpty').classList.remove('hidden');
            return;
        }

        for (const s of slots) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'rounded-2xl border border-slate-300 px-3 py-2 text-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400';
            btn.textContent = formatTime(s.starts_at);
            btn.dataset.startsAt = s.starts_at;
            btn.addEventListener('click', () => {
                document.querySelectorAll('#slots button').forEach(b => b.classList.remove('bg-slate-900','text-white','border-slate-900'));
                btn.classList.add('bg-slate-900','text-white','border-slate-900');
                $('starts_at').value = formatIsoLocal(s.starts_at);
            });
            $('slots').appendChild(btn);
        }
    }

    $('loadSlots').addEventListener('click', () => {
        preferredDateChosen = true;
        loadSlots();
    });
    document.querySelector('select[name=duration_minutes]').addEventListener('change', () => {
        if ($('date').value) loadSlots();
    });

    $('bookingForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        clearMsg();

        const form = e.currentTarget;
        const fd = new FormData(form);

        if (!fd.get('starts_at') && preferredDateChosen && $('date')?.value) {
            fd.set('preferred_date', $('date').value);
        }

        const payload = Object.fromEntries(fd.entries());

        const res = await fetch('/api/public/appointments', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload),
        });

        if (!res.ok) {
            const err = await res.json().catch(() => ({}));
            setMsg(err.message || 'Не удалось отправить заявку. Проверьте данные.');
            return;
        }

        setMsg('Заявка отправлена. Я свяжусь с вами для подтверждения.');
        form.reset();
        preferredDateChosen = false;
        $('slots').innerHTML = '';
        $('slotsEmpty').classList.add('hidden');
    });

    document.addEventListener('DOMContentLoaded', () => {
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }

        if (window.location.hash) {
            history.replaceState(null, '', window.location.pathname + window.location.search);
            window.scrollTo({ top: 0, left: 0, behavior: 'auto' });
        }

        const heroPriceHost = $('heroPriceHost');
        const heroBookHost = $('heroBookHost');
        const heroPriceBtn = $('heroPriceBtn');
        const heroBookBtn = $('heroBookBtn');
        const bookingModal = $('bookingModal');
        const bookingClose = $('bookingClose');

        const igPopup = $('igPopup');
        const igPopupClose = $('igPopupClose');
        const igPopupLater = $('igPopupLater');
        const igPopupBackdrop = $('igPopupBackdrop');

        const closeIgPopup = () => {
            if (!igPopup) return;
            igPopup.classList.add('hidden');
            try { localStorage.setItem('ig_popup_dismissed', '1'); } catch (e) {}
        };

        const openIgPopupOnce = () => {
            if (!igPopup) return;
            try {
                if (localStorage.getItem('ig_popup_dismissed') === '1') return;
            } catch (e) {}
            setTimeout(() => {
                if (!document.hidden) igPopup.classList.remove('hidden');
            }, 900);
        };

        if (igPopupClose) igPopupClose.addEventListener('click', closeIgPopup);
        if (igPopupLater) igPopupLater.addEventListener('click', closeIgPopup);
        if (igPopupBackdrop) igPopupBackdrop.addEventListener('click', closeIgPopup);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && igPopup && !igPopup.classList.contains('hidden')) closeIgPopup();
        });

        const priceSection = $('price');
        if (priceSection && heroPriceHost) {
            const inner = priceSection.querySelector('.mx-auto');
            if (inner) heroPriceHost.appendChild(inner);
            priceSection.remove();
        }

        const bookSection = $('book');
        if (bookSection && heroBookHost) {
            const inner = bookSection.firstElementChild;
            if (inner) heroBookHost.appendChild(inner);
            bookSection.remove();
        }

        const closeModal = () => {
            if (!bookingModal) return;
            bookingModal.classList.add('hidden');
            document.documentElement.classList.remove('overflow-hidden');
            document.body.classList.remove('overflow-hidden');
        };

        const openModal = () => {
            if (!bookingModal) return;
            bookingModal.classList.remove('hidden');
            document.documentElement.classList.add('overflow-hidden');
            document.body.classList.add('overflow-hidden');
        };

        const togglePrice = (forceOpen = null) => {
            if (!heroPriceHost) return;
            const isHidden = heroPriceHost.classList.contains('hidden');
            const willOpen = forceOpen === null ? isHidden : !!forceOpen;

            if (willOpen) {
                closeModal();
                heroPriceHost.classList.remove('hidden');
            } else {
                heroPriceHost.classList.add('hidden');
                heroPriceBtn?.focus?.();
            }
        };

        if (heroPriceBtn && heroPriceHost) {
            heroPriceBtn.addEventListener('click', () => {
                togglePrice();
            });
        }

        if (heroBookBtn) {
            heroBookBtn.addEventListener('click', () => {
                if (heroPriceHost) heroPriceHost.classList.add('hidden');
                openModal();
            });
        }

        if (bookingClose) bookingClose.addEventListener('click', closeModal);
        if (bookingModal) {
            bookingModal.addEventListener('click', (e) => {
                if (e.target === bookingModal || e.target === bookingModal.firstElementChild) closeModal();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeModal();
            });
        }

        openIgPopupOnce();

        document.addEventListener('click', (e) => {
            const a = e.target instanceof Element ? e.target.closest('a[href^="#"]') : null;
            if (!a) return;

            const href = a.getAttribute('href') || '';
            if (href === '#price') {
                e.preventDefault();
                togglePrice();
                return;
            }
            if (href === '#book') {
                e.preventDefault();
                if (heroPriceHost) heroPriceHost.classList.add('hidden');
                openModal();
            }
        });

        $('year').textContent = new Date().getFullYear();
        loadPrice();

        const header = $('siteHeader');
        header.classList.add('glass');
        const onScroll = () => {
            if (window.scrollY > 40) {
                header.classList.remove('opacity-0', '-translate-y-2', 'pointer-events-none');
                header.classList.add('opacity-100', 'translate-y-0');
            } else {
                header.classList.add('opacity-0', '-translate-y-2', 'pointer-events-none');
                header.classList.remove('opacity-100', 'translate-y-0');
            }
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();

        const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const intro = $('intro');
        if (!prefersReducedMotion && intro) {
            let raf = 0;

            const updateIntro = () => {
                raf = 0;
                const rect = intro.getBoundingClientRect();
                const introHeight = Math.max(1, rect.height);
                const y = Math.max(0, -rect.top);
                const p = Math.min(1, y / introHeight);
                intro.style.setProperty('--intro-p', String(p));
            };

            const scheduleIntro = () => {
                if (raf) return;
                raf = window.requestAnimationFrame(updateIntro);
            };

            window.addEventListener('scroll', scheduleIntro, { passive: true });
            window.addEventListener('resize', scheduleIntro);
            scheduleIntro();
        }

        if (!prefersReducedMotion && intro) {
            const content = $('content');
            let snapTimer = 0;
            let snapping = false;
            let suppressUntil = 0;

            const suppressSnapBriefly = () => {
                suppressUntil = Date.now() + 800;
            };

            document.addEventListener('click', (e) => {
                const a = e.target instanceof Element ? e.target.closest('a[href^="#"]') : null;
                if (a) suppressSnapBriefly();
            }, true);
            window.addEventListener('hashchange', suppressSnapBriefly);

            const maybeSnap = () => {
                snapTimer = 0;
                if (snapping) return;
                if (Date.now() < suppressUntil) return;

                const introTop = intro.offsetTop;
                const introHeight = Math.max(1, intro.offsetHeight);
                const y = window.scrollY;

                if (y < introTop - 2 || y > introTop + introHeight + 2) return;

                const p = Math.min(1, Math.max(0, (y - introTop) / introHeight));
                const target = p > 0.22 ? introTop + introHeight : introTop;

                if (Math.abs(y - target) < 6) return;

                snapping = true;
                window.scrollTo({ top: target, left: 0, behavior: 'smooth' });

                window.setTimeout(() => {
                    snapping = false;
                    if (target >= introTop + introHeight && content) {
                        content.focus?.();
                    }
                }, 420);
            };

            const scheduleSnap = () => {
                if (snapping) return;
                window.clearTimeout(snapTimer);
                snapTimer = window.setTimeout(maybeSnap, 120);
            };

            window.addEventListener('scroll', scheduleSnap, { passive: true });
            window.addEventListener('resize', scheduleSnap);
        }

        const faqItems = Array.from(document.querySelectorAll('details.faq'));
        if (faqItems.length) {
            const setFaqHeight = (item) => {
                const body = item.querySelector('.faq-body');
                if (!body) return;
                const inner = body.firstElementChild;
                const h = inner ? inner.scrollHeight : body.scrollHeight;
                item.style.setProperty('--faq-h', `${h + 16}px`);
            };

            faqItems.forEach((item) => {
                if (item.open) setFaqHeight(item);
            });

            faqItems.forEach((item) => {
                item.addEventListener('toggle', () => {
                    if (!item.open) return;
                    setFaqHeight(item);
                    faqItems.forEach((other) => {
                        if (other !== item) other.open = false;
                    });
                });
            });

            window.addEventListener('resize', () => {
                faqItems.forEach((item) => {
                    if (item.open) setFaqHeight(item);
                });
            });
        }

        if ($('date')) {
            $('date').addEventListener('change', () => {
                preferredDateChosen = true;
            });
        }

        const phone = $('phone');
        if (phone) {
            const setCaret = (pos) => {
                try {
                    phone.setSelectionRange(pos, pos);
                } catch (e) {}
            };

            const normalizeNational10 = (rawDigits) => {
                let d = String(rawDigits || '').replace(/\D/g, '');

                // If user starts with 8XXXXXXXXXX -> treat as 7XXXXXXXXXX
                if (d.startsWith('8')) {
                    d = '7' + d.slice(1);
                }

                // If country code present (7XXXXXXXXXX) -> strip leading 7
                if (d.startsWith('7')) {
                    d = d.slice(1);
                }

                // If user starts with 9 -> it becomes +7 (9..)
                // At this point we keep 10 digits of national number.
                if (d.length > 10) {
                    d = d.slice(0, 10);
                }

                return d;
            };

            const countNationalDigitsBeforeCaret = (value, caretPos) => {
                const sub = String(value || '').slice(0, Math.max(0, caretPos));
                let digits = sub.replace(/\D/g, '');
                if (digits.startsWith('8')) digits = '7' + digits.slice(1);
                if (digits.startsWith('7')) digits = digits.slice(1);
                if (digits.length > 10) digits = digits.slice(0, 10);
                return digits.length;
            };

            const caretPosForNationalDigits = (formatted, count) => {
                if (count <= 0) return 2; // right after +7

                let seen = 0;
                for (let i = 0; i < formatted.length; i++) {
                    const ch = formatted[i];
                    if (ch >= '0' && ch <= '9') {
                        // skip the leading country digit '7' from +7
                        if (i === 1 && formatted[0] === '+' && ch === '7') continue;
                        seen++;
                        if (seen >= count) return i + 1;
                    }
                }
                return formatted.length;
            };

            const formatPhone = (raw) => {
                const nat = normalizeNational10(raw);

                const a = nat.slice(0, 3);
                const b = nat.slice(3, 6);
                const c = nat.slice(6, 8);
                const e = nat.slice(8, 10);

                let out = '+7';
                if (a.length) out += ' (' + a;
                if (a.length === 3) out += ')';
                if (b.length) out += ' ' + b;
                if (c.length) out += '-' + c;
                if (e.length) out += '-' + e;
                return out;
            };

            const ensurePrefix = () => {
                if (!phone.value) {
                    phone.value = '+7';
                    setCaret(2);
                }
            };

            phone.addEventListener('focus', ensurePrefix);
            phone.addEventListener('click', () => {
                ensurePrefix();
                if (phone.selectionStart < 2) setCaret(2);
            });

            phone.addEventListener('input', () => {
                const caretPos = phone.selectionStart ?? phone.value.length;
                const digitsBefore = countNationalDigitsBeforeCaret(phone.value, caretPos);
                const formatted = formatPhone(phone.value);
                phone.value = formatted;
                setCaret(caretPosForNationalDigits(formatted, digitsBefore));
            });

            phone.addEventListener('keydown', (e) => {
                if (e.key !== 'Backspace') return;

                // Allow clearing the whole field easily
                if (phone.value === '+7') {
                    e.preventDefault();
                    phone.value = '';
                    return;
                }

                // Make backspace delete a digit even near formatting characters like ')' or '-'
                const start = phone.selectionStart ?? 0;
                const end = phone.selectionEnd ?? 0;
                if (start !== end) return;

                const digitsBefore = countNationalDigitsBeforeCaret(phone.value, start);
                if (digitsBefore <= 0) {
                    e.preventDefault();
                    phone.value = '+7';
                    setCaret(2);
                    return;
                }

                e.preventDefault();
                const nat = normalizeNational10(phone.value);
                const idx = digitsBefore - 1;
                const newNat = nat.slice(0, idx) + nat.slice(idx + 1);
                const formatted = formatPhone(newNat);
                phone.value = formatted;
                setCaret(caretPosForNationalDigits(formatted, idx));
            });

            phone.addEventListener('blur', () => {
                if (phone.value === '+7') {
                    phone.value = '';
                }
            });
        }
    });
</script>

</body>
</html>
