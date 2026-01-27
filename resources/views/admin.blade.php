<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админ — Электроэпиляция</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, .72);
            --glass-border: rgba(15, 23, 42, .14);
            --shadow: 0 20px 60px rgba(15, 23, 42, .12);
        }
        .glass {
            background: radial-gradient(120% 120% at 20% 0%, rgba(255,255,255,.9), rgba(255,255,255,.55)), var(--glass-bg);
            backdrop-filter: blur(18px) saturate(1.35);
            -webkit-backdrop-filter: blur(18px) saturate(1.35);
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow);
        }
        .btn { position: relative; overflow: hidden; }
        .btn:disabled { opacity: .55; cursor: not-allowed; }
    </style>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">

<div class="mx-auto max-w-6xl px-4 py-10">
    <div class="flex items-start justify-between gap-6 flex-wrap">
        <div>
            <div class="text-xs text-slate-500">Админ-панель</div>
            <h1 class="mt-2 text-2xl md:text-3xl font-semibold tracking-tight">Электроэпиляция • Пятигорск</h1>
            <div class="mt-2 text-sm text-slate-700">Управление заявками и рабочими интервалами.</div>
        </div>
        <div class="flex gap-2">
            <a href="/" class="btn inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/70 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-slate-50">На сайт</a>
            <button id="logoutBtn" type="button" class="btn hidden inline-flex items-center justify-center rounded-full bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">Выйти</button>
        </div>
    </div>

    <div id="alerts" class="mt-6 space-y-2"></div>

    <div id="loginCard" class="mt-8 glass rounded-3xl p-6 max-w-xl">
        <div class="text-sm font-semibold">Вход</div>
        <div class="mt-2 text-sm text-slate-700">Введите email и пароль администратора.</div>
        <form id="loginForm" class="mt-5 grid gap-3">
            <label class="grid gap-1">
                <span class="text-xs text-slate-600">Email</span>
                <input id="email" type="email" autocomplete="username" class="h-11 rounded-2xl border border-slate-300 bg-white/80 px-4 text-sm outline-none focus:ring-2 focus:ring-slate-900/10" required>
            </label>
            <label class="grid gap-1">
                <span class="text-xs text-slate-600">Пароль</span>
                <input id="password" type="password" autocomplete="current-password" class="h-11 rounded-2xl border border-slate-300 bg-white/80 px-4 text-sm outline-none focus:ring-2 focus:ring-slate-900/10" required>
            </label>
            <div class="flex items-center justify-between gap-3 flex-wrap">
                <label class="inline-flex items-center gap-2 text-xs text-slate-600 select-none">
                    <input id="remember" type="checkbox" class="rounded border-slate-300" checked>
                    Запомнить
                </label>
                <button id="loginBtn" type="submit" class="btn inline-flex items-center justify-center rounded-full bg-slate-900 px-6 py-3 text-sm font-medium text-white hover:bg-slate-800">Войти</button>
            </div>
        </form>
    </div>

    <div id="app" class="hidden mt-8">
        <div class="glass rounded-3xl p-2">
            <div class="flex gap-2">
                <button id="tabAppointments" type="button" class="btn flex-1 rounded-2xl px-4 py-3 text-sm font-medium bg-white/80 border border-slate-200">Заявки</button>
                <button id="tabIntervals" type="button" class="btn flex-1 rounded-2xl px-4 py-3 text-sm font-medium bg-transparent">Интервалы</button>
            </div>
        </div>

        <div id="panelAppointments" class="mt-4 glass rounded-3xl p-6">
            <div class="flex items-end justify-between gap-4 flex-wrap">
                <div>
                    <div class="text-sm font-semibold">Заявки</div>
                    <div class="mt-1 text-sm text-slate-700">Список заявок с возможностью изменения статуса.</div>
                </div>
                <div class="flex items-center gap-3 flex-wrap">
                    <label class="grid gap-1">
                        <span class="text-xs text-slate-600">Поиск</span>
                        <input id="qFilter" type="text" placeholder="Имя или телефон" class="h-10 w-[220px] rounded-2xl border border-slate-300 bg-white/80 px-3 text-sm">
                    </label>
                    <label class="grid gap-1">
                        <span class="text-xs text-slate-600">Статус</span>
                        <select id="statusFilter" class="h-10 rounded-2xl border border-slate-300 bg-white/80 px-3 text-sm">
                            <option value="">Все</option>
                            <option value="pending">Ожидает</option>
                            <option value="confirmed">Подтверждено</option>
                            <option value="rescheduled">Перенос</option>
                            <option value="cancelled">Отменено</option>
                            <option value="completed">Выполнено</option>
                        </select>
                    </label>
                    <label class="grid gap-1">
                        <span class="text-xs text-slate-600">Период</span>
                        <select id="dateRangeFilter" class="h-10 rounded-2xl border border-slate-300 bg-white/80 px-3 text-sm">
                            <option value="">Любой</option>
                            <option value="today">Сегодня</option>
                            <option value="tomorrow">Завтра</option>
                            <option value="week">7 дней</option>
                        </select>
                    </label>
                    <label class="inline-flex items-center gap-2 text-xs text-slate-600 select-none pt-6">
                        <input id="noDateFilter" type="checkbox" class="rounded border-slate-300">
                        Без даты
                    </label>
                    <button id="refreshAppointments" type="button" class="btn inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/70 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-slate-50">Обновить</button>
                </div>
            </div>

            <div class="mt-5 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-slate-600">
                            <th class="py-2 pr-3">Дата/время</th>
                            <th class="py-2 pr-3">Клиент</th>
                            <th class="py-2 pr-3">Телефон</th>
                            <th class="py-2 pr-3">Источник</th>
                            <th class="py-2 pr-3">Статус</th>
                            <th class="py-2 pr-3">Действие</th>
                        </tr>
                    </thead>
                    <tbody id="appointmentsBody" class="text-slate-900"></tbody>
                </table>
            </div>

            <div class="mt-4 flex items-center justify-between gap-3 flex-wrap">
                <div id="appointmentsMeta" class="text-xs text-slate-600">—</div>
                <div class="flex gap-2">
                    <button id="prevPage" type="button" class="btn inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/70 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-slate-50">Назад</button>
                    <button id="nextPage" type="button" class="btn inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/70 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-slate-50">Вперёд</button>
                </div>
            </div>
        </div>

        <div id="panelIntervals" class="hidden mt-4 glass rounded-3xl p-6">
            <div class="flex items-end justify-between gap-4 flex-wrap">
                <div>
                    <div class="text-sm font-semibold">Рабочие интервалы</div>
                    <div class="mt-1 text-sm text-slate-700">Добавляйте интервалы, когда вы принимаете (по ним строятся слоты).</div>
                </div>
                <button id="refreshIntervals" type="button" class="btn inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/70 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-slate-50">Обновить</button>
            </div>

            <form id="intervalForm" class="mt-5 grid gap-3 md:grid-cols-4 items-end">
                <label class="grid gap-1 md:col-span-1">
                    <span class="text-xs text-slate-600">Начало</span>
                    <input id="intervalStart" type="datetime-local" class="h-11 rounded-2xl border border-slate-300 bg-white/80 px-4 text-sm" required>
                </label>
                <label class="grid gap-1 md:col-span-1">
                    <span class="text-xs text-slate-600">Конец</span>
                    <input id="intervalEnd" type="datetime-local" class="h-11 rounded-2xl border border-slate-300 bg-white/80 px-4 text-sm" required>
                </label>
                <label class="grid gap-1 md:col-span-1">
                    <span class="text-xs text-slate-600">Комментарий</span>
                    <input id="intervalNote" type="text" class="h-11 rounded-2xl border border-slate-300 bg-white/80 px-4 text-sm" placeholder="необязательно">
                </label>
                <button id="addIntervalBtn" type="submit" class="btn md:col-span-1 inline-flex items-center justify-center rounded-full bg-slate-900 px-6 py-3 text-sm font-medium text-white hover:bg-slate-800">Добавить</button>
            </form>

            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-slate-600">
                            <th class="py-2 pr-3">Начало</th>
                            <th class="py-2 pr-3">Конец</th>
                            <th class="py-2 pr-3">Комментарий</th>
                            <th class="py-2 pr-3">Действие</th>
                        </tr>
                    </thead>
                    <tbody id="intervalsBody" class="text-slate-900"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const qs = (s) => document.querySelector(s);

    const alerts = qs('#alerts');
    const loginCard = qs('#loginCard');
    const app = qs('#app');
    const logoutBtn = qs('#logoutBtn');

    const tabAppointments = qs('#tabAppointments');
    const tabIntervals = qs('#tabIntervals');
    const panelAppointments = qs('#panelAppointments');
    const panelIntervals = qs('#panelIntervals');

    const loginForm = qs('#loginForm');
    const loginBtn = qs('#loginBtn');

    const qFilter = qs('#qFilter');
    const statusFilter = qs('#statusFilter');
    const dateRangeFilter = qs('#dateRangeFilter');
    const noDateFilter = qs('#noDateFilter');
    const refreshAppointments = qs('#refreshAppointments');
    const appointmentsBody = qs('#appointmentsBody');
    const appointmentsMeta = qs('#appointmentsMeta');
    const prevPage = qs('#prevPage');
    const nextPage = qs('#nextPage');

    const refreshIntervals = qs('#refreshIntervals');
    const intervalForm = qs('#intervalForm');
    const addIntervalBtn = qs('#addIntervalBtn');
    const intervalsBody = qs('#intervalsBody');

    let appointmentsPageUrl = null;

    const toast = (type, text) => {
        const el = document.createElement('div');
        el.className = `glass rounded-2xl px-4 py-3 text-sm ${type === 'error' ? 'border border-rose-200' : 'border border-emerald-200'}`;
        el.textContent = text;
        alerts.appendChild(el);
        setTimeout(() => el.remove(), 4500);
    };

    const escapeHtml = (s) => {
        return String(s ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    };

    const getToken = () => localStorage.getItem('admin_token') || sessionStorage.getItem('admin_token') || '';
    const setToken = (t, remember) => {
        if (remember) {
            localStorage.setItem('admin_token', t);
            sessionStorage.removeItem('admin_token');
            return;
        }
        sessionStorage.setItem('admin_token', t);
        localStorage.removeItem('admin_token');
    };
    const clearToken = () => {
        localStorage.removeItem('admin_token');
        sessionStorage.removeItem('admin_token');
    };

    const apiFetch = async (url, opts = {}) => {
        const token = getToken();
        const headers = Object.assign({ 'Accept': 'application/json' }, opts.headers || {});
        if (token) headers['Authorization'] = `Bearer ${token}`;

        const res = await fetch(url, Object.assign({}, opts, { headers }));
        const ct = res.headers.get('content-type') || '';
        const data = ct.includes('application/json') ? await res.json() : await res.text();

        if (!res.ok) {
            const msg = typeof data === 'object' && data && data.message ? data.message : (typeof data === 'string' ? data : 'Ошибка');
            throw new Error(msg);
        }

        return data;
    };

    const showApp = () => {
        loginCard.classList.add('hidden');
        app.classList.remove('hidden');
        logoutBtn.classList.remove('hidden');
    };

    const showLogin = () => {
        app.classList.add('hidden');
        logoutBtn.classList.add('hidden');
        loginCard.classList.remove('hidden');
    };

    const switchTab = (tab) => {
        const isAppointments = tab === 'appointments';
        panelAppointments.classList.toggle('hidden', !isAppointments);
        panelIntervals.classList.toggle('hidden', isAppointments);

        tabAppointments.classList.toggle('bg-white/80', isAppointments);
        tabAppointments.classList.toggle('border', isAppointments);
        tabAppointments.classList.toggle('border-slate-200', isAppointments);

        tabIntervals.classList.toggle('bg-white/80', !isAppointments);
        tabIntervals.classList.toggle('border', !isAppointments);
        tabIntervals.classList.toggle('border-slate-200', !isAppointments);
    };

    const formatDateTime = (iso) => {
        if (!iso) return '—';
        const d = new Date(iso);
        if (isNaN(d.getTime())) return String(iso);
        const pad = (n) => String(n).padStart(2, '0');
        return `${pad(d.getDate())}.${pad(d.getMonth() + 1)}.${d.getFullYear()} ${pad(d.getHours())}:${pad(d.getMinutes())}`;
    };

    const toLocalInputValue = (iso) => {
        if (!iso) return '';
        const d = new Date(iso);
        if (isNaN(d.getTime())) return '';
        const pad = (n) => String(n).padStart(2, '0');
        return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
    };

    const statusLabel = (s) => {
        switch (s) {
            case 'pending': return 'ожидает';
            case 'confirmed': return 'подтверждено';
            case 'rescheduled': return 'перенос';
            case 'cancelled': return 'отменено';
            case 'completed': return 'выполнено';
            default: return s || '—';
        }
    };

    const normalizePhoneToE164 = (raw) => {
        const digits = String(raw || '').replace(/\D/g, '');
        if (!digits) return '';
        let d = digits;
        if (d.startsWith('8')) d = '7' + d.slice(1);
        if (d.startsWith('7')) d = d.slice(1);
        d = d.slice(0, 10);
        if (d.length !== 10) return '';
        return '+7' + d;
    };

    const phoneToWhatsApp = (raw) => {
        const e164 = normalizePhoneToE164(raw);
        if (!e164) return '';
        return 'https://wa.me/' + e164.replace('+', '');
    };

    const tgToLink = (raw) => {
        const s = String(raw || '').trim();
        if (!s) return '';
        const u = s.replace(/^@+/, '');
        if (!u) return '';
        return 'https://t.me/' + encodeURIComponent(u);
    };

    const fillTemplate = (tpl, ctx) => {
        return String(tpl)
            .replace(/\{\{name\}\}/g, ctx.name || '')
            .replace(/\{\{datetime\}\}/g, ctx.datetime || '')
            .replace(/\{\{id\}\}/g, ctx.id || '')
            .trim();
    };

    const copyText = async (text) => {
        try {
            await navigator.clipboard.writeText(text);
            return true;
        } catch (e) {
            return false;
        }
    };

    const renderAppointments = (payload) => {
        const items = payload?.data?.data || [];
        const meta = payload?.data;

        appointmentsBody.innerHTML = '';

        for (const row of items) {
            const startsAt = row.starts_at ? formatDateTime(row.starts_at) : 'не указаны';
            const clientNameRaw = row.client?.name || '—';
            const clientPhoneRaw = row.client?.phone || '—';
            const clientTgRaw = row.client?.telegram_username || '';

            const clientName = escapeHtml(clientNameRaw);
            const clientPhone = escapeHtml(clientPhoneRaw);
            const clientTg = escapeHtml(clientTgRaw);

            const tel = normalizePhoneToE164(clientPhoneRaw);
            const wa = phoneToWhatsApp(clientPhoneRaw);
            const tgLink = tgToLink(clientTgRaw);

            const ctx = {
                id: row.id ? String(row.id) : '',
                name: String(clientNameRaw || ''),
                datetime: row.starts_at ? formatDateTime(row.starts_at) : 'дата/время уточним',
            };

            const tplConfirm = fillTemplate('Здравствуйте, {{name}}! Подтверждаю запись на {{datetime}}. Если что-то изменится — напишите, пожалуйста.', ctx);
            const tplReschedule = fillTemplate('Здравствуйте, {{name}}! По записи #{{id}} нужно перенести время. Когда вам удобно? Напишите 2–3 варианта.', ctx);
            const tplCancel = fillTemplate('Здравствуйте, {{name}}! По записи #{{id}}: если вы передумали/не получается — напишите, пожалуйста. Можем перенести.', ctx);

            const tplConfirmEnc = encodeURIComponent(tplConfirm);
            const tplRescheduleEnc = encodeURIComponent(tplReschedule);
            const tplCancelEnc = encodeURIComponent(tplCancel);

            const tr = document.createElement('tr');
            tr.className = 'border-t border-slate-200/60';

            tr.innerHTML = `
                <td class="py-3 pr-3 whitespace-nowrap">
                    <div class="text-xs text-slate-600">${startsAt}</div>
                    <input class="startsAtInp mt-2 h-9 w-[190px] rounded-xl border border-slate-300 bg-white/80 px-2 text-sm" type="datetime-local" value="${toLocalInputValue(row.starts_at)}" data-id="${row.id}">
                </td>
                <td class="py-3 pr-3">${clientName}</td>
                <td class="py-3 pr-3 whitespace-nowrap">
                    <div>${clientPhone}</div>
                    <div class="mt-2 flex flex-wrap gap-2">
                        ${tel ? `<a class="btn inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/70 px-3 py-1 text-[11px] font-medium text-slate-900 hover:bg-slate-50" href="tel:${tel}">Позвонить</a>` : ''}
                        ${wa ? `<a class="btn inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/70 px-3 py-1 text-[11px] font-medium text-slate-900 hover:bg-slate-50" href="${wa}" target="_blank" rel="noopener noreferrer">WhatsApp</a>` : ''}
                        ${tgLink ? `<a class="btn inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/70 px-3 py-1 text-[11px] font-medium text-slate-900 hover:bg-slate-50" href="${tgLink}" target="_blank" rel="noopener noreferrer">Telegram</a>` : ''}
                    </div>
                </td>
                <td class="py-3 pr-3 whitespace-nowrap">
                    <div class="text-xs text-slate-600">${escapeHtml(row.source || '—')}</div>
                    <div class="mt-1 text-[11px] text-slate-700">${escapeHtml([row.utm_source, row.utm_medium, row.utm_campaign].filter(Boolean).join(' / ') || '—')}</div>
                </td>
                <td class="py-3 pr-3 whitespace-nowrap">
                    <select class="statusSel h-9 rounded-xl border border-slate-300 bg-white/80 px-2 text-sm" data-id="${row.id}">
                        <option value="pending" ${row.status === 'pending' ? 'selected' : ''}>ожидает</option>
                        <option value="confirmed" ${row.status === 'confirmed' ? 'selected' : ''}>подтверждено</option>
                        <option value="rescheduled" ${row.status === 'rescheduled' ? 'selected' : ''}>перенос</option>
                        <option value="cancelled" ${row.status === 'cancelled' ? 'selected' : ''}>отменено</option>
                        <option value="completed" ${row.status === 'completed' ? 'selected' : ''}>выполнено</option>
                    </select>
                    <div class="mt-2">
                        <input class="durationInp h-9 w-[120px] rounded-xl border border-slate-300 bg-white/80 px-2 text-sm" type="number" min="15" max="600" step="5" value="${row.duration_minutes ?? 60}" data-id="${row.id}" placeholder="мин">
                    </div>
                </td>
                <td class="py-3 pr-3 whitespace-nowrap">
                    <button class="saveAppointment btn inline-flex items-center justify-center rounded-full bg-slate-900 px-4 py-2 text-xs font-medium text-white hover:bg-slate-800" data-id="${row.id}">Сохранить</button>
                    <div class="mt-2">
                        <input class="noteInp h-9 w-[240px] rounded-xl border border-slate-300 bg-white/80 px-2 text-sm" type="text" value="${row.note ? String(row.note).replace(/\"/g, '&quot;') : ''}" data-id="${row.id}" placeholder="Комментарий">
                    </div>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <button class="copyTpl btn inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/70 px-3 py-1 text-[11px] font-medium text-slate-900 hover:bg-slate-50" data-id="${row.id}" data-text="${tplConfirmEnc}">Текст: подтвердить</button>
                        <button class="copyTpl btn inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/70 px-3 py-1 text-[11px] font-medium text-slate-900 hover:bg-slate-50" data-id="${row.id}" data-text="${tplRescheduleEnc}">Текст: перенос</button>
                        <button class="copyTpl btn inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/70 px-3 py-1 text-[11px] font-medium text-slate-900 hover:bg-slate-50" data-id="${row.id}" data-text="${tplCancelEnc}">Текст: отмена</button>
                    </div>
                </td>
            `;

            appointmentsBody.appendChild(tr);
        }

        const total = meta?.total ?? 0;
        const from = meta?.from ?? 0;
        const to = meta?.to ?? 0;
        appointmentsMeta.textContent = total ? `Показано ${from}–${to} из ${total}` : 'Нет данных';

        appointmentsPageUrl = meta?.path ? `${meta.path}?page=${meta.current_page}` : null;

        prevPage.disabled = !meta?.prev_page_url;
        nextPage.disabled = !meta?.next_page_url;

        prevPage.dataset.url = meta?.prev_page_url || '';
        nextPage.dataset.url = meta?.next_page_url || '';
    };

    const loadAppointments = async (url = null) => {
        const q = qFilter ? qFilter.value : '';
        const status = statusFilter.value;
        const dateRange = dateRangeFilter ? dateRangeFilter.value : '';
        const noDate = noDateFilter ? (noDateFilter.checked ? '1' : '') : '';
        const baseUrl = url || '/api/admin/appointments';
        const u = new URL(baseUrl, window.location.origin);
        if (q) u.searchParams.set('q', q);
        if (status) u.searchParams.set('status', status);
        if (dateRange) u.searchParams.set('date_range', dateRange);
        if (noDate) u.searchParams.set('no_date', '1');

        refreshAppointments.disabled = true;
        try {
            const data = await apiFetch(u.toString());
            renderAppointments(data);
        } catch (e) {
            toast('error', e.message || 'Ошибка загрузки заявок');
        } finally {
            refreshAppointments.disabled = false;
        }
    };

    const saveAppointment = async (id) => {
        const statusSel = qs(`select.statusSel[data-id="${id}"]`);
        const startsAtInp = qs(`input.startsAtInp[data-id="${id}"]`);
        const durationInp = qs(`input.durationInp[data-id="${id}"]`);
        const noteInp = qs(`input.noteInp[data-id="${id}"]`);

        const status = statusSel ? statusSel.value : null;
        const startsAt = startsAtInp ? startsAtInp.value : '';
        const duration = durationInp ? durationInp.value : '';
        const note = noteInp ? noteInp.value : '';

        const payload = { status };
        payload.starts_at = startsAt ? toIsoFromLocalInput(startsAt) : null;
        payload.duration_minutes = duration ? Number(duration) : null;
        payload.note = note ? String(note) : null;

        try {
            await apiFetch(`/api/admin/appointments/${id}`, {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            toast('ok', 'Сохранено');
            await loadAppointments();
        } catch (e) {
            toast('error', e.message || 'Не удалось сохранить');
        }
    };

    const renderIntervals = (payload) => {
        const items = payload?.data || [];
        intervalsBody.innerHTML = '';

        for (const row of items) {
            const tr = document.createElement('tr');
            tr.className = 'border-t border-slate-200/60';

            tr.innerHTML = `
                <td class="py-3 pr-3 whitespace-nowrap">
                    <div class="text-xs text-slate-600">${formatDateTime(row.starts_at)}</div>
                    <input class="wiStart mt-2 h-9 w-[190px] rounded-xl border border-slate-300 bg-white/80 px-2 text-sm" type="datetime-local" value="${toLocalInputValue(row.starts_at)}" data-id="${row.id}">
                </td>
                <td class="py-3 pr-3 whitespace-nowrap">
                    <div class="text-xs text-slate-600">${formatDateTime(row.ends_at)}</div>
                    <input class="wiEnd mt-2 h-9 w-[190px] rounded-xl border border-slate-300 bg-white/80 px-2 text-sm" type="datetime-local" value="${toLocalInputValue(row.ends_at)}" data-id="${row.id}">
                </td>
                <td class="py-3 pr-3">
                    <input class="wiNote h-9 w-[260px] rounded-xl border border-slate-300 bg-white/80 px-2 text-sm" type="text" value="${row.note ? String(row.note).replace(/"/g, '&quot;') : ''}" data-id="${row.id}" placeholder="Комментарий">
                </td>
                <td class="py-3 pr-3 whitespace-nowrap">
                    <div class="flex gap-2">
                        <button class="saveInterval btn inline-flex items-center justify-center rounded-full bg-slate-900 px-4 py-2 text-xs font-medium text-white hover:bg-slate-800" data-id="${row.id}">Сохранить</button>
                        <button class="deleteInterval btn inline-flex items-center justify-center rounded-full border border-rose-200 bg-white/70 px-4 py-2 text-xs font-medium text-rose-700 hover:bg-rose-50" data-id="${row.id}">Удалить</button>
                    </div>
                </td>
            `;
            intervalsBody.appendChild(tr);
        }
    };

    const saveInterval = async (id) => {
        const startInp = qs(`input.wiStart[data-id="${id}"]`);
        const endInp = qs(`input.wiEnd[data-id="${id}"]`);
        const noteInp = qs(`input.wiNote[data-id="${id}"]`);

        const startsAt = startInp ? startInp.value : '';
        const endsAt = endInp ? endInp.value : '';
        const note = noteInp ? noteInp.value : '';

        try {
            await apiFetch(`/api/admin/working-intervals/${id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    starts_at: toIsoFromLocalInput(startsAt),
                    ends_at: toIsoFromLocalInput(endsAt),
                    note: note || null,
                })
            });
            toast('ok', 'Сохранено');
            await loadIntervals();
        } catch (e) {
            toast('error', e.message || 'Не удалось сохранить');
        }
    };

    const loadIntervals = async () => {
        refreshIntervals.disabled = true;
        try {
            const data = await apiFetch('/api/admin/working-intervals');
            renderIntervals(data);
        } catch (e) {
            toast('error', e.message || 'Ошибка загрузки интервалов');
        } finally {
            refreshIntervals.disabled = false;
        }
    };

    const toIsoFromLocalInput = (v) => {
        if (!v) return '';
        const d = new Date(v);
        if (isNaN(d.getTime())) return '';
        return d.toISOString();
    };

    const addInterval = async () => {
        const starts = qs('#intervalStart').value;
        const ends = qs('#intervalEnd').value;
        const note = qs('#intervalNote').value;

        addIntervalBtn.disabled = true;
        try {
            await apiFetch('/api/admin/working-intervals', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    starts_at: toIsoFromLocalInput(starts),
                    ends_at: toIsoFromLocalInput(ends),
                    note: note || null,
                })
            });
            toast('ok', 'Интервал добавлен');
            qs('#intervalStart').value = '';
            qs('#intervalEnd').value = '';
            qs('#intervalNote').value = '';
            await loadIntervals();
        } catch (e) {
            toast('error', e.message || 'Не удалось добавить интервал');
        } finally {
            addIntervalBtn.disabled = false;
        }
    };

    const deleteInterval = async (id) => {
        try {
            await apiFetch(`/api/admin/working-intervals/${id}`, { method: 'DELETE' });
            toast('ok', 'Удалено');
            await loadIntervals();
        } catch (e) {
            toast('error', e.message || 'Не удалось удалить');
        }
    };

    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        loginBtn.disabled = true;

        try {
            const email = qs('#email').value;
            const password = qs('#password').value;
            const remember = qs('#remember').checked;

            const data = await apiFetch('/api/admin/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password, device_name: 'web' })
            });

            const token = data?.token || '';
            if (!token) throw new Error('Не удалось получить токен');

            setToken(token, remember);
            showApp();
            switchTab('appointments');
            await loadAppointments();
        } catch (e2) {
            toast('error', e2.message || 'Ошибка входа');
        } finally {
            loginBtn.disabled = false;
        }
    });

    logoutBtn.addEventListener('click', async () => {
        try {
            await apiFetch('/api/admin/logout', { method: 'POST' });
        } catch (e) {}
        clearToken();
        showLogin();
        toast('ok', 'Вы вышли');
    });

    tabAppointments.addEventListener('click', async () => {
        switchTab('appointments');
        await loadAppointments();
    });

    tabIntervals.addEventListener('click', async () => {
        switchTab('intervals');
        await loadIntervals();
    });

    refreshAppointments.addEventListener('click', () => loadAppointments());
    statusFilter.addEventListener('change', () => loadAppointments());
    if (qFilter) {
        let t = 0;
        qFilter.addEventListener('input', () => {
            window.clearTimeout(t);
            t = window.setTimeout(() => loadAppointments(), 220);
        });
    }
    if (dateRangeFilter) dateRangeFilter.addEventListener('change', () => loadAppointments());
    if (noDateFilter) noDateFilter.addEventListener('change', () => loadAppointments());

    prevPage.addEventListener('click', () => {
        const url = prevPage.dataset.url;
        if (url) loadAppointments(url);
    });

    nextPage.addEventListener('click', () => {
        const url = nextPage.dataset.url;
        if (url) loadAppointments(url);
    });

    appointmentsBody.addEventListener('click', (e) => {
        const btn = e.target instanceof Element ? e.target.closest('button.saveAppointment') : null;
        if (!btn) return;
        const id = btn.getAttribute('data-id');
        if (id) saveAppointment(id);
    });

    appointmentsBody.addEventListener('click', async (e) => {
        const btn = e.target instanceof Element ? e.target.closest('button.copyTpl') : null;
        if (!btn) return;

        const enc = btn.getAttribute('data-text') || '';
        if (!enc) return;

        let text = '';
        try {
            text = decodeURIComponent(enc);
        } catch (e2) {
            text = '';
        }
        if (!text) return;

        const ok = await copyText(text);
        toast(ok ? 'ok' : 'error', ok ? 'Текст скопирован' : 'Не удалось скопировать');
    });

    refreshIntervals.addEventListener('click', () => loadIntervals());

    intervalForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        await addInterval();
    });

    intervalsBody.addEventListener('click', (e) => {
        const btn = e.target instanceof Element ? e.target.closest('button.deleteInterval') : null;
        if (btn) {
            const id = btn.getAttribute('data-id');
            if (id) deleteInterval(id);
            return;
        }

        const saveBtn = e.target instanceof Element ? e.target.closest('button.saveInterval') : null;
        if (!saveBtn) return;
        const id = saveBtn.getAttribute('data-id');
        if (id) saveInterval(id);
    });

    const init = async () => {
        const token = getToken();
        if (!token) {
            showLogin();
            return;
        }

        try {
            await apiFetch('/api/admin/me');
            showApp();
            switchTab('appointments');
            await loadAppointments();
        } catch (e) {
            clearToken();
            showLogin();
        }
    };

    init();
</script>

</body>
</html>
