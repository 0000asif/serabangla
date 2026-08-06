<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ 'সেরা বাংলা ৬৪ - আচার কম্বো অফার' }} </title>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-88Z3243CY7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-88Z3243CY7');
    </script>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Meta Description & Keywords --}}
    <meta name="description" content="{{ $settings->meta_description ?? ($settings->desc ?? '') }}">
    <meta name="keywords" content="{{ $settings->meta_keywords ?? '' }}">


    {{-- Indexing --}}
    @if (isset($settings->allow_indexing) && !$settings->allow_indexing)
        <meta name="robots" content="noindex, nofollow">
    @endif


    {{-- Favicon --}}
    <link rel="icon" type="image/png"
        href="{{ $settings->favicon ? asset('settings/' . $settings->favicon) : asset('image/logo31.png') }}">
    <link rel="shortcut icon"
        href="{{ $settings->favicon ? asset('settings/' . $settings->favicon) : asset('image/logo31.png') }}">

    {{-- Open Graph Image --}}
    <meta property="og:image"
        content="{{ $settings->logo ? asset('settings/' . $settings->logo) : asset('image/logo31.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


    {{-- Google Analytics --}}
    @if (!empty($settings->google_analytics))
        {!! $settings->google_analytics !!}
    @endif

    {{-- Custom Header Scripts --}}
    @if (!empty($settings->custom_header_scripts))
        {!! $settings->custom_header_scripts !!}
    @endif

    <!-- Meta Pixel Code -->
    <script>
        ! function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1744816276690668');
        fbq('track', 'PageView');
    </script>

    <!-- TikTok Pixel Code Start -->
    <script>
        !function (w, d, t) {
            w.TiktokAnalyticsObject = t; var ttq = w[t] = w[t] || []; ttq.methods = ["page", "track", "identify", "instances", "debug", "on", "off", "once", "ready", "alias", "group", "enableCookie", "disableCookie", "holdConsent", "revokeConsent", "grantConsent"], ttq.setAndDefer = function (t, e) {t[e] = function () {t.push([e].concat(Array.prototype.slice.call(arguments, 0)))}}; for (var i = 0; i < ttq.methods.length; i++)ttq.setAndDefer(ttq, ttq.methods[i]); ttq.instance = function (t) {
                for (
                    var e = ttq._i[t] || [], n = 0; n < ttq.methods.length; n++)ttq.setAndDefer(e, ttq.methods[n]); return e
            }, ttq.load = function (e, n) {
                var r = "https://analytics.tiktok.com/i18n/pixel/events.js", o = n && n.partner; ttq._i = ttq._i || {}, ttq._i[e] = [], ttq._i[e]._u = r, ttq._t = ttq._t || {}, ttq._t[e] = +new Date, ttq._o = ttq._o || {}, ttq._o[e] = n || {}; n = document.createElement("script")
                    ; n.type = "text/javascript", n.async = !0, n.src = r + "?sdkid=" + e + "&lib=" + t; e = document.getElementsByTagName("script")[0]; e.parentNode.insertBefore(n, e)
            };


            ttq.load('D9B7SL3C77U5KEVKNJI0');
            ttq.page();
        }(window, document, 'ttq');
    </script>

    <!-- ========== TIKTOK & FACEBOOK EVENT TRACKING FUNCTIONS ========== -->
    <script>
        // ============================
        // PRODUCT DATA
        // ============================
        const productData = {
            id: 'achar_combo_1',
            name: 'রসুন, আম, তেঁতুল ও জলপাইের আচার',
            price: 1099,
            deliveryCharge: 100,
            category: 'Achar Combo'
        };

        // ============================
        // TIKTOK EVENT TRACKING FUNCTIONS
        // ============================
        function trackTikTokEvent(eventName, params) {
            if (typeof ttq !== 'undefined') {
                try {
                    ttq.track(eventName, params);
                    console.log('🎯 TikTok ' + eventName + ':', params);
                } catch (e) {
                    console.warn('TikTok tracking error:', e);
                }
            } else {
                console.warn('TikTok pixel not loaded yet');
            }
        }

        // Track ViewContent when product is viewed
        function trackViewContent(qty) {
            qty = qty || 1;
            trackTikTokEvent('ViewContent', {
                content_id: productData.id,
                content_name: productData.name,
                content_type: 'product',
                value: productData.price * qty,
                currency: 'BDT',
                content_category: productData.category
            });
        }

        // Track AddToCart when quantity changes
        function trackAddToCart(qty) {
            qty = qty || 1;
            trackTikTokEvent('AddToCart', {
                content_id: productData.id,
                content_name: productData.name,
                content_type: 'product',
                value: productData.price * qty,
                quantity: qty,
                currency: 'BDT',
                content_category: productData.category
            });
        }

        // Track InitiateCheckout when user clicks order button
        function trackInitiateCheckout(qty) {
            qty = qty || 1;
            const total = (productData.price * qty) + productData.deliveryCharge;
            trackTikTokEvent('InitiateCheckout', {
                content_id: productData.id,
                content_name: productData.name,
                value: total,
                currency: 'BDT',
                quantity: qty,
                content_type: 'product'
            });
        }

        // Track Complete Payment (fixes the TikTok warning)
        function trackCompletePayment(qty, total, phone, email, name) {
            qty = qty || 1;
            var params = {
                content_id: productData.id,
                content_name: productData.name,
                value: total,
                currency: 'BDT',
                quantity: qty,
                content_type: 'product'
            };

            // Phone is required for Complete Payment
            if (phone && phone.trim() !== '') {
                params.phone = phone.trim();
            }

            // Email is also recommended for Complete Payment
            if (email && email.trim() !== '') {
                params.email = email.trim();
            }

            if (name && name.trim() !== '') {
                params.customer_name = name.trim();
            }

            trackTikTokEvent('CompletePayment', params);
        }

        // Track Purchase when order is successfully placed
        function trackPurchase(qty, total, phone, name) {
            qty = qty || 1;
            var params = {
                content_id: productData.id,
                content_name: productData.name,
                value: total,
                currency: 'BDT',
                quantity: qty,
                content_type: 'product'
            };

            if (phone && phone.trim() !== '') {
                params.phone = phone.trim();
            }

            trackTikTokEvent('Purchase', params);
        }

        // ============================
        // FACEBOOK EVENT TRACKING
        // ============================
        function trackFacebookEvent(eventName, params) {
            if (typeof fbq !== 'undefined') {
                try {
                    // Ensure currency is properly formatted
                    if (params.currency) {
                        params.currency = 'BDT';
                    }
                    // Make sure value is a number
                    if (params.value) {
                        params.value = parseFloat(params.value);
                    }
                    fbq('track', eventName, params);
                    console.log('📘 Facebook ' + eventName + ':', params);
                } catch (e) {
                    console.warn('Facebook tracking error:', e);
                }
            }
        }
    </script>
    <!-- ========== END EVENT TRACKING FUNCTIONS ========== -->

    <!-- TikTok Pixel Code End -->
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1744816276690668&ev=PageView&noscript=1" />
    </noscript>
    <!-- End Meta Pixel Code -->

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Hind Siliguri', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        header {
            background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
            color: white;
            padding: 15px 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .contact-info {
            display: flex;
            gap: 20px;
            font-size: 14px;
        }

        .contact-info span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .hero {
            background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(20px);
            }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 15px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
        }

        .hero p {
            font-size: 24px;
            margin-bottom: 30px;
            font-weight: 500;
        }

        .hero .badge {
            display: inline-block;
            background: #FFD700;
            color: #FF6B35;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: bold;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .cta-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 40px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: white;
            color: #FF6B35;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
        }

        .btn-secondary:hover {
            background: white;
            color: #FF6B35;
        }

        .products-section {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .section-title {
            font-size: 36px;
            text-align: center;
            margin-bottom: 50px;
            color: #FF6B35;
            position: relative;
            padding-bottom: 20px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: #FF6B35;
            border-radius: 2px;
        }

        .combo-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 40px;
        }

        .combo-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .combo-header {
            background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .combo-header h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .price-badge {
            display: inline-block;
            background: #FFD700;
            color: #FF6B35;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 24px;
            font-weight: bold;
            margin: 15px 0;
        }

        .combo-body {
            padding: 30px;
        }

        .items-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 25px 0;
        }

        .item {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            border-left: 4px solid #FF6B35;
            transition: all 0.3s ease;
        }

        .item:hover {
            background: #fff3e0;
            transform: translateX(5px);
        }

        .item-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .item-name {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .item-size {
            font-size: 14px;
            color: #777;
        }

        .delivery-badge {
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
            margin: 15px 0;
            font-weight: bold;
        }

        .scratch-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 20px;
            margin: 60px 0;
        }

        .scratch-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .scratch-title {
            font-size: 40px;
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
        }

        .prizes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin: 40px 0;
        }

        .prize {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .prize:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.6);
            transform: scale(1.05);
        }

        .prize-icon {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .prize-name {
            font-weight: bold;
            font-size: 14px;
        }


        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .feature {
            text-align: center;
            padding: 25px;
            background: #f8f9fa;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .feature:hover {
            background: #fff3e0;
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 50px;
            margin-bottom: 15px;
        }

        .feature-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #FF6B35;
        }

        .form-section {
            background: #fff;
            padding: 15px 0;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            color: #FF6B35;
            margin-bottom: 30px;
            font-size: 28px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #FF6B35;
            box-shadow: 0 0 10px rgba(255, 107, 53, 0.1);
        }

        .price-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
            border-left: 4px solid #FF6B35;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .summary-row.total {
            font-size: 20px;
            font-weight: bold;
            color: #FF6B35;
            padding-top: 10px;
            border-top: 2px solid #ddd;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .footer-actions {
            margin-top: 12px;
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .contact-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Call button */
        .call-btn {
            background: white;
            color: #c62828;
        }

        .call-btn:hover {
            background: #ffebee;
            transform: translateY(-2px);
        }

        /* WhatsApp button */
        .whatsapp-btn {
            background: #25D366;
            color: white;
        }

        .whatsapp-btn:hover {
            background: #1da851;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 32px;
            }

            .hero p {
                font-size: 18px;
            }

            .section-title {
                font-size: 28px;
            }

            .cta-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .contact-info {
                flex-direction: column;
                gap: 10px;
            }

            .header-content {
                flex-direction: column;
                gap: 15px;
            }

            .scratch-title {
                font-size: 28px;
            }
        }

        .combo-section {
            padding: 15x 15px;
            background: #fff;
        }

        .combo-card {
            max-width: 800px;
            margin: auto;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 35px rgba(0, 0, 0, .12);
            border: 2px solid #f1f1f1;
        }

        .combo-image img {
            width: 100%;
            display: block;
        }

        .combo-content {
            padding: 25px;
        }

        .combo-list {
            list-style: none;
            padding: 0;
            margin: 0 0 25px;
        }

        .combo-list li {
            font-size: 22px;
            padding: 10px 0;
            border-bottom: 1px dashed #ddd;
            text-align: center;
            font-weight: 600;
        }

        .combo-list li:last-child {
            border: none;
        }

        .price-area {
            text-align: center;
            margin-bottom: 25px;
        }

        .price-area span {
            display: block;
            font-size: 20px;
            color: #444;
        }

        .price-area h2 {
            font-size: 48px;
            color: #d50000;
            margin: 5px 0;
            font-weight: 800;
        }

        .delivery {
            background: #ea1f22;
            color: #fff;
            /* display: inline-block; */
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 24px;
            font-weight: 700;
        }

        .order-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background: #27c015;
            color: #fff;
            text-decoration: none;
            padding: 18px;
            font-size: 22px;
            font-weight: 700;
            border-radius: 12px;
            animation: pulse 1.5s infinite;
            cursor: pointer;
        }

        .order-btn i {
            animation: bounce 1s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(5px);
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 0, 0, .5);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(255, 0, 0, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
            }
        }

        @media(max-width:768px) {

            .combo-content {
                padding: 18px;
            }

            .combo-list li {
                font-size: 18px;
                text-align: left;
            }

            .price-area h2 {
                font-size: 36px;
            }

            .order-btn {
                font-size: 22px;
                padding: 15px;
            }

        }

        .scratch-offer {
            padding: 15px 15px;
        }

        .offer-box {
            max-width: 800px;
            margin: auto;
            text-align: center;
            background: #fff;
            border: 2px dashed #fbc02d;
            border-radius: 15px;
            padding: 25px;
        }

        .offer-box h2 {
            font-size: 30px;
            color: #27c015;
            margin-bottom: 10px;
        }

        .offer-box p {
            margin: 8px 0;
            font-size: 18px;
        }

        .highlight {
            font-weight: 700;
            color: #222;
            margin-bottom: 20px !important;
            text-align: justify;
        }

        .offer-note {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 0, 0, .1);
            text-align: left;
        }

        .offer-note p {
            font-size: 16px;
            color: #444;
            line-height: 1.8;
            margin-bottom: 10px;
            text-align: justify;
        }

        @media(max-width:768px) {

            .offer-box h2 {
                font-size: 24px;
            }

            .offer-box p {
                font-size: 16px;
            }

            .offer-note p {
                font-size: 15px;
            }

        }

        .why-choose {
            padding: 15px 15px;
        }

        .why-box {
            max-width: 800px;
            margin: auto;
            background: #fff;
            border-radius: 18px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 25px rgba(0, 0, 0, .08);
        }

        .why-box h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 32px;
            color: #fff;
            background: #ea1f22;
            border-radius: 10px;
            padding: 8px;
        }

        .why-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .why-list li {
            display: flex;
            gap: 15px;
            align-items: flex-start;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }

        .why-list li:last-child {
            border-bottom: none;
        }

        .why-list i {
            color: #2e7d32;
            font-size: 24px;
            margin-top: 4px;
        }

        .why-list strong {
            display: block;
            font-size: 19px;
            margin-bottom: 4px;
            color: #111;
        }

        .why-list span {
            color: #666;
            font-size: 15px;
            line-height: 1.6;
        }

        @media(max-width:768px) {

            .why-box {
                padding: 22px;
            }

            .why-box h2 {
                font-size: 24px;
            }

            .why-list strong {
                font-size: 17px;
            }

        }

        .form-section {
            padding: 15px 0;
            background: #fff;
        }

        .form-wrapper {
            max-width: 800px;
            margin: auto;
            display: grid;
            /* grid-template-columns: 1.4fr 1fr; */
            gap: 30px;
        }

        .customer-form,
        .order-summary {
            background: #fff;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, .08);
        }

        .customer-form h2 {
            margin-bottom: 10px;
            background: #27c015;
            border-radius: 10px;
            padding: 8px;
            color: #fff;
            display: flex;
            justify-content: center;
        }

        .form-subtitle {
            color: #27c015;
            margin-bottom: 25px;
            font-size: 20px;
            font-weight: 600;
            display: flex;
            justify-content: center;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .submit-btn {
            width: 100%;
            border: none;
            background: #e53935;
            color: #fff;
            padding: 16px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
        }

        .note {
            text-align: center;
            margin-top: 15px;
            color: #555;
        }

        .order-summary h3 {
            margin-bottom: 20px;
            background: #27c015;
            border-radius: 10px;
            padding: 8px;
            color: #fff;
            display: flex;
            justify-content: center;
        }

        .product-box {
            display: flex;
            gap: 15px;
            align-items: center;
            margin-bottom: 25px;
        }

        .product-box img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
        }

        .quantity-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .qty-control {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .qty-control button {
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background: #f1f1f1;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 24px;
            font-weight: 700;
            line-height: 1;
            padding: 0;
        }

        .qty-control input {
            width: 50px;
            text-align: center;
            border: none;
            font-weight: 700;
            font-size: 24px;
        }

        .summary-row,
        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .summary-total {
            border-top: 1px solid #eee;
            padding-top: 15px;
            font-size: 20px;
            font-weight: 700;
            color: #e53935;
        }

        @media (max-width:768px) {

            .form-wrapper {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .product-preview {
                order: 1;
            }

            .quantity-section {
                order: 2;
            }

            .customer-form {
                order: 3;
            }

            .order-summary {
                order: 4;
            }

        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }

        .summary-table th {
            text-align: left;
            padding: 12px 0;
            border-bottom: 2px solid #eee;
            font-weight: 700;
        }

        .summary-table td {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        .summary-product {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .summary-product img {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #eee;
            flex-shrink: 0;
        }

        .summary-product-info h5 {
            margin: 0;
            font-size: 14px;
            line-height: 1.4;
            font-weight: 600;
        }

        .summary-product-info span {
            color: #777;
            font-size: 13px;
        }

        .summary-price {
            text-align: right;
            font-weight: 700;
            white-space: nowrap;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #eee;
            font-size: 22px;
            font-weight: 700;
            color: #27c015;
        }

        .bn64-hero-wrap {
            padding: 15px 15px;
            background: #fff;
        }

        .bn64-hero-card {
            max-width: 800px;
            margin: auto;
            background: #fff;
            border: 2px solid #ffd54f;
            border-radius: 18px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
        }

        .bn64-offer-badge {
            display: inline-block;
            background: #e53935;
            color: #fff;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .bn64-hero-title {
            color: #27c015;
            font-size: 34px;
            font-weight: 800;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .bn64-hero-desc {
            background: #ea1f22;
            border-radius: 12px;
            padding: 15px;
            font-size: 18px;
            line-height: 1.8;
            color: #fff;
            margin-bottom: 20px;

            font-weight: 700;
        }

        .bn64-hero-desc span {
            font-weight: 700;
        }

        .bn64-price-box {
            display: block;
            width: fit-content;
            margin: 0 auto 25px;
            background: #fff;
            border: 2px solid #e53935;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 700;
        }

        .bn64-price-box span {
            color: #e53935;
            font-size: 28px;
        }

        .bn64-trust-line {
            margin-top: 15px;
            color: #666;
            font-size: 13px;
        }



        .bn64-btn-primary {
            background: #27c015;
            color: #fff;
            border: none;
            padding: 15px 35px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            animation: pulse 1.5s infinite;
        }

        .bn64-btn-primary i {
            animation: bounce 1s infinite;
        }

        /* MOBILE */
        @media(max-width:768px) {

            .bn64-hero-title {
                font-size: 26px;
            }

            .bn64-hero-card {
                padding: 25px 18px;
            }

            .bn64-price-box span {
                font-size: 16px;
            }

        }

        .bn64-header-wrap {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
            padding: 10px 15px;
            position: relative;
            z-index: 1;
        }

        /* DESKTOP */
        .bn64-header-container {
            max-width: 1100px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* LOGO */
        .bn64-logo {
            font-size: 20px;
            font-weight: 800;
            color: #e53935;
            white-space: nowrap;
        }

        /* CONTACT */
        .bn64-contact {
            display: flex;
            gap: 12px;
            font-size: 14px;
        }

        .bn64-contact-item {
            background: #ea1f22;
            border-radius: 20px;
            white-space: nowrap;
            font-size: 22px;
            padding: 10px 20px;
        }

        .bn64-contact-item a {
            color: #fff;
            text-decoration: none;
        }

        /* 🔥 MOBILE FIX */
        @media (max-width: 768px) {

            .bn64-header-container {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .bn64-logo {
                font-size: 20px;
            }

            .bn64-contact {
                display: flex;
                flex-wrap: wrap;
                /* Allow 2 rows */
                justify-content: center;
                gap: 10px;
                width: 100%;
            }

            .bn64-contact-item {
                width: 100%;
                text-align: center;
                font-size: 25px;
                padding: 10px 10px;
            }

            .bn64-contact-item a {
                color: #fff;
                text-decoration: none;
            }

            .bn64-contact-item i {
                font-size: 25px;
                margin-right: 5px;
            }
        }

        .whatsapp-float {
            position: fixed;
            right: 20px;
            bottom: 35px;
            background: #25D366;
            color: #fff;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            text-align: center;
            font-size: 28px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
            text-decoration: none;
        }

        .whatsapp-float:hover {
            background: #1ebe5d;
            color: #fff;
            transform: scale(1.1);
        }

        /* Messenger Float */
        .messenger-float {
            position: fixed;
            left: 20px;
            top: 40%;
            transform: translateY(-50%);
            background: #0084FF;
            color: #fff;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            text-align: center;
            font-size: 28px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
            text-decoration: none;
        }

        .messenger-float:hover {
            background: #006fe6;
            color: #fff;
            transform: translateY(-50%) scale(1.1);
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="bn64-header-wrap">

        <div class="bn64-header-container">

            <!-- Logo -->
            <div class="bn64-logo">
                <img src="{{ asset('image/logo31.png') }}" alt="" width="220px">
            </div>

            <!-- Contact -->
            <div class="bn64-contact">
                <div class="bn64-contact-item">
                    <i class="fa-solid fa-headset"></i>
                    <a href="tel:+8809640646464">+880 9640-646464</a>
                </div>

            </div>

        </div>

    </header>

    <!-- Hero Section -->
    <section class="bn64-hero-wrap">

        <div class="bn64-hero-card">


            <h1 class="bn64-hero-title">
                ৪ স্বাদের সুস্বাদু আচার, এখন এক কম্বোতে!
            </h1>

            <p class="bn64-hero-desc">
                কম্বো অর্ডার করে Scratch Card ঘষে জিতে নিন

                <span class="">
                    Fridge, Smart TV, AC, Gold Necklace
                </span>

                সহ ৫০+ আকর্ষণীয় পুরস্কার।
            </p>



            <div class="bn64-price-box">
                🔥 মাত্র <span>১০৯৯ ৳</span>
            </div>
            <div class="bn64-btn-group">

                <button class="bn64-btn-primary" onclick="scrollToForm()">
                    <i class="fa-solid fa-cart-shopping"></i> অর্ডার করতে চাই
                    <i class="fa-solid fa-arrow-down"></i>
                </button>

            </div>

            <div class="bn64-trust-line">
                ✅ ক্যাশ অন ডেলিভারি | ✅ সারাদেশে হোম ডেলিভারি
            </div>

        </div>

    </section>

    <section class="combo-section">

        <div class="combo-card">

            <div class="combo-image">
                <img src="{{ asset('image/acharpic.jpg') }}" alt="আচার কম্বো">
            </div>

            <div class="combo-content">



                <div class="bn64-price-box">
                    কম্বো প্রাইস মাত্র <span>১০৯৯ ৳</span>
                </div>

                <div class="price-area">

                    <div class="delivery">
                        🚚 ফ্রি হোম ডেলিভারি
                    </div>

                </div>

                <a onclick="scrollToForm()" class="order-btn " style="cursor: pointer;">
                    <i class="fa-solid fa-cart-shopping"></i> অর্ডার করতে চাই
                    <i class="fa-solid fa-arrow-down"></i>
                </a>

            </div>

        </div>

    </section>


    <section class="scratch-offer">

        <div class="offer-box">

            <h2>🎁 স্ক্র্যাচ কার্ড অফার</h2>

            <p style="font-weight:bolder; color: #ea1f22;">
                প্রতিটি অর্ডারের সাথে পাচ্ছেন ১টি Scratch Card
            </p>

            <p class="highlight">

                Fridge, Smart TV, AC, Gold Necklace, Microwave Oven, Air Fryer, Blender, Rice Cooker, Electric Kettle,
                Dinner Set সহ
                ৫০+ আকর্ষণীয় পুরস্কার জেতার সুযোগ
            </p>

            <div class="offer-note">
                <p>
                    📹 পণ্য হাতে পাওয়ার পর প্যাকেট খোলার আগে মোবাইলে
                    ভিডিও রেকর্ডিং চালু করুন এবং দেখে নিন আপনার জন্য
                    কোন উপহার অপেক্ষা করছে।
                </p>

                <p>
                    🎉 পুরস্কার জিতলে ভিডিওসহ আমাদের Facebook Page-এর
                    Inbox বা WhatsApp-এ পাঠিয়ে দিন।
                </p>

                <p>
                    ✅ যাচাই শেষে আপনার পুরস্কার পৌঁছে দেওয়া হবে।
                </p>

            </div>

        </div>

    </section>




    <!-- Why Choose Section -->
    <section class="why-choose">

        <div class="why-box">

            <h2>কেন সেরা বাংলা ৬৪ এর আচার কিনবেন?</h2>

            <ul class="why-list">

                <li>
                    <i class="fa-solid fa-circle-check"></i>
                    <div>
                        <strong>ঘরোয়া স্বাদ</strong>
                    </div>
                </li>

                <li>
                    <i class="fa-solid fa-circle-check"></i>
                    <div>
                        <strong>প্রিমিয়াম প্যাকেজিং</strong>
                    </div>
                </li>

                <li>
                    <i class="fa-solid fa-circle-check"></i>
                    <div>
                        <strong>কোন ক্ষতিকর প্রিজারভেটিভ নেই</strong>
                    </div>
                </li>

                <li>
                    <i class="fa-solid fa-circle-check"></i>
                    <div>
                        <strong>পরিবার ও অতিথিদের জন্য উপযুক্ত</strong>
                    </div>
                </li>

            </ul>


        </div>

    </section>

    <section class="form-section" id="order-form">

        <div class="form-wrapper">

            <!-- LEFT SIDE -->
            <div class="customer-form">

                <h2>অর্ডার সম্পন্ন করুন</h2>

                <div class="product-box">

                    <img src="{{ asset('image/acharpic.jpg') }}" alt="Combo">

                    <div>
                        <h4>
                            রসুন, আম, তেঁতুল ও জলপাইের আচার
                        </h4>

                        <p>৪ জার কম্বো প্যাক</p>
                        <div class="qty-control">

                            <button type="button" onclick="decreaseQty()">
                                -
                            </button>

                            <input type="text" id="quantity" value="1" readonly>

                            <button type="button" onclick="increaseQty()">
                                +
                            </button>

                        </div>
                    </div>

                </div>


                <p class="form-subtitle">
                    আপনার তথ্য প্রদান করুন
                </p>

                <form id="orderForm">
                    @csrf
                    <div class="form-group">
                        <label>আপনার নাম *</label>
                        <input placeholder="আপনার নাম লিখুন" type="text" id="name" required>
                    </div>

                    <div class="form-group">
                        <label>মোবাইল নম্বর *</label>
                        <input type="tel" id="phone" maxlength="11" placeholder="01XXXXXXXXX"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,11)" required>
                    </div>

                    <div class="form-group">
                        <label>সম্পূর্ণ ঠিকানা *</label>
                        <textarea id="address" placeholder="সম্পূর্ণ ডেলিভারি ঠিকানা লিখুন" required
                            rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label>অর্ডার নোট (Optional) </label>
                        <input placeholder="অর্ডার নোট লিখুন " type="text" id="order_note">
                    </div>


                    <table class="summary-table">

                        <thead>
                            <tr>
                                <th>পণ্য</th>
                                <th>সাবটোটাল</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>

                                <td>
                                    <div class="summary-product">

                                        <img src="{{ asset('image/acharpic.jpg') }}" alt="Achar">

                                        <div class="summary-product-info">
                                            <h5>
                                                রসুন, আম, তেঁতুল ও জলপাইের আচার
                                            </h5>

                                            <span>
                                                Qty × <span id="qtyText">1</span>
                                            </span>
                                        </div>

                                    </div>
                                </td>

                                <td class="summary-price" id="subtotal">
                                    1099 ৳
                                </td>

                            </tr>
                        </tbody>

                    </table>

                    <!-- Delivery Charge Row -->
                    <div class="summary-row" id="deliveryRow">
                        <span>ডেলিভারি চার্জ</span>
                        <span id="deliveryChargeDisplay" style="font-weight:700; color: #e53935;">+ ১০০ ৳</span>
                    </div>

                    <div class="summary-total">
                        <span>মোট</span>
                        <span id="totalPrice">1199 ৳</span>
                    </div>


                    <p class="note">
                        🚚 পণ্য হাতে পেয়ে টাকা পরিশোধ করুন
                    </p>
                    <button type="submit" class="submit-btn">
                        <i class="fa-solid fa-lock"></i> অর্ডার নিশ্চিত করুন
                    </button>

                </form>

            </div>

            <!-- RIGHT SIDE -->

        </div>

    </section>

    <!-- WhatsApp -->
    <a href="https://wa.me/8801344314426" class="whatsapp-float" target="_blank">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- Messenger -->
    {{-- <a href="https://m.me/SheraBangla64" class="messenger-float" target="_blank">
        <i class="fa-brands fa-facebook-messenger"></i>
    </a> --}}
    <!-- Footer -->

    <footer>
        <p>&copy; 2026 সেরা বাংলা ৬৪ - সব অধিকার সংরক্ষিত</p>
        <div class="footer-actions"> <a href="tel:+8809640646464" class="contact-btn call-btn"> <i
                    class="fa-solid fa-headset"></i> +880 9640-646464 </a> <a href="https://wa.me/8801344314426"
                target="_blank" class="contact-btn whatsapp-btn"> <i class="fa-brands fa-whatsapp"></i> WhatsApp:
                01344-314426 </a> </div>
    </footer>

    <!-- ========== MAIN JAVASCRIPT WITH ALL EVENTS ========== -->
    <script>
        /* =========================
           PRICE UPDATE
        ========================= */
        function updatePrice() {
            const qtyInput = document.getElementById("quantity");
            const qty = parseInt(qtyInput.value) || 1;
            const subtotal = qty * productData.price;
            const total = subtotal + productData.deliveryCharge;

            const subtotalEl = document.getElementById("subtotal");
            const totalEl = document.getElementById("totalPrice");
            const qtyText = document.getElementById("qtyText");
            const deliveryDisplay = document.getElementById("deliveryChargeDisplay");

            if (subtotalEl) subtotalEl.innerText = subtotal + " ৳";
            if (totalEl) totalEl.innerText = total + " ৳";
            if (qtyText) qtyText.innerText = qty;
            if (deliveryDisplay) deliveryDisplay.innerText = "+ " + productData.deliveryCharge + " ৳";
        }

        /* =========================
           QUANTITY CONTROL WITH TIKTOK TRACKING
        ========================= */
        function increaseQty() {
            const qtyInput = document.getElementById("quantity");
            qtyInput.value = (parseInt(qtyInput.value) || 1) + 1;
            const newQty = parseInt(qtyInput.value);
            updatePrice();

            // ===== TRACK ADDTOCART ON QUANTITY INCREASE =====
            trackAddToCart(newQty);
            console.log('✅ TikTok AddToCart tracked - Qty: ' + newQty);

            // Track Facebook AddToCart
            trackFacebookEvent('AddToCart', {
                content_name: productData.name,
                content_category: productData.category,
                value: productData.price * newQty,
                currency: 'BDT',
                quantity: newQty
            });
        }

        function decreaseQty() {
            const qtyInput = document.getElementById("quantity");
            let qty = parseInt(qtyInput.value) || 1;
            if (qty > 1) {
                qtyInput.value = qty - 1;
                const newQty = parseInt(qtyInput.value);
                updatePrice();

                // ===== TRACK ADDTOCART ON QUANTITY DECREASE =====
                trackAddToCart(newQty);
                console.log('✅ TikTok AddToCart tracked - Qty: ' + newQty);

                // Track Facebook AddToCart
                trackFacebookEvent('AddToCart', {
                    content_name: productData.name,
                    content_category: productData.category,
                    value: productData.price * newQty,
                    currency: 'BDT',
                    quantity: newQty
                });
            }
        }

        /* =========================
           SCROLL TO FORM WITH TIKTOK TRACKING
        ========================= */
        function scrollToForm() {
            const qty = parseInt(document.getElementById('quantity').value) || 1;
            const total = (productData.price * qty) + productData.deliveryCharge;

            // ===== TRACK INITIATECHECKOUT =====
            trackInitiateCheckout(qty);
            console.log('✅ TikTok InitiateCheckout tracked - Total: ' + total);

            // Track Facebook InitiateCheckout
            trackFacebookEvent('InitiateCheckout', {
                content_name: productData.name,
                content_category: productData.category,
                value: total,
                currency: 'BDT',
                quantity: qty
            });

            document.getElementById('order-form').scrollIntoView({
                behavior: 'smooth'
            });
        }

        /* =========================
           FORM SUBMIT WITH PURCHASE TRACKING
        ========================= */
        document.addEventListener('DOMContentLoaded', function () {
            // ===== TRACK VIEWCONTENT ON PAGE LOAD =====
            trackViewContent(1);
            console.log('✅ TikTok ViewContent tracked on page load');

            // Track Facebook ViewContent
            trackFacebookEvent('ViewContent', {
                content_name: productData.name,
                content_category: productData.category,
                value: productData.price,
                currency: 'BDT'
            });

            updatePrice();

            const form = document.getElementById('orderForm');
            if (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();

                    const phone = document.getElementById('phone').value.trim();

                    // Bangladesh mobile number validation
                    if (!/^01\d{9}$/.test(phone)) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ভুল মোবাইল নম্বর',
                            text: 'অনুগ্রহ করে ১১ সংখ্যার সঠিক মোবাইল নম্বর লিখুন।'
                        });
                        document.getElementById('phone').focus();
                        return;
                    }

                    const quantity = parseInt(document.getElementById('quantity').value) || 1;
                    const subtotal = quantity * productData.price;
                    const total = subtotal + productData.deliveryCharge;
                    const customerName = document.getElementById('name').value.trim();
                    const customerPhone = phone;

                    // Get CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    let token = csrfToken;
                    if (!token) {
                        const tokenInput = document.querySelector('input[name="_token"]');
                        if (tokenInput) {
                            token = tokenInput.value;
                        }
                    }

                    const data = {
                        _token: token,
                        customer_name: customerName,
                        customer_phone: customerPhone,
                        customer_address: document.getElementById('address').value.trim(),
                        order_note: document.getElementById('order_note').value.trim(),
                        subtotal: subtotal,
                        delivery_charge: productData.deliveryCharge,
                        total: total,
                        quantity: quantity,
                        product: productData.name + ' (' + quantity + ' পিস)',
                        product_id: '4',
                    };

                    console.log('📤 Sending data:', data);

                    Swal.fire({
                        title: 'অর্ডার প্রক্রিয়াকরণ...',
                        text: 'দয়া করে অপেক্ষা করুন',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    fetch("{{ route('order.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": token,
                            "Accept": "application/json"
                        },
                        body: JSON.stringify(data)
                    })
                        .then(response => {
                            if (response.status === 419) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'সেশন এক্সপায়ার!',
                                    text: 'পৃষ্ঠাটি রিফ্রেশ করুন এবং আবার চেষ্টা করুন।',
                                    confirmButtonText: 'রিফ্রেশ করুন'
                                }).then(() => {
                                    location.reload();
                                });
                                return;
                            }
                            if (!response.ok) {
                                return response.text().then(text => {
                                    throw new Error(text || 'Server error');
                                });
                            }
                            return response.json();
                        })
                        .then(response => {
                            // ===== TRACK COMPLETE PAYMENT (removes TikTok warning) =====
                            trackCompletePayment(quantity, total, customerPhone, '', customerName);
                            console.log('✅ TikTok CompletePayment tracked');

                            // ===== TRACK PURCHASE =====
                            trackPurchase(quantity, total, customerPhone, customerName);
                            console.log('✅ TikTok Purchase tracked - Total: ' + total);

                            // ===== TRACK FACEBOOK PURCHASE =====
                            trackFacebookEvent('Purchase', {
                                value: parseFloat(total),
                                currency: 'BDT',
                                content_type: 'product',
                                content_ids: [productData.id],
                                content_name: productData.name,
                                num_items: parseInt(quantity)
                            });

                            Swal.fire({
                                icon: 'success',
                                title: 'অর্ডার সফল হয়েছে!',
                                text: 'আমাদের প্রতিনিধি শীঘ্রই আপনার সাথে যোগাযোগ করবে।',
                                confirmButtonText: 'ঠিক আছে'
                            });

                            document.getElementById('orderForm').reset();
                            document.getElementById('quantity').value = 1;
                            updatePrice();
                        })
                        .catch(error => {
                            console.error('❌ Order Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'দুঃখিত!',
                                text: 'অর্ডার গ্রহণ করা যায়নি। আবার চেষ্টা করুন।'
                            });
                        });
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>