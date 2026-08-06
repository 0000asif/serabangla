<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>সেরা বাংলা ৬৪ - মসলা কম্বো অফার</title>

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

        .combo-section {
            padding: 5px 15px;
            background: #fff;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h2 {
            font-size: 42px;
            font-weight: 800;
            color: #ea1f22;
        }

        .section-title p {
            font-size: 18px;
            color: #666;
        }

        .combo-grid {
            max-width: 1400px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .combo-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 35px rgba(0, 0, 0, .12);
            position: relative;
            transition: .3s;
            padding: 10px;

        }

        .combo-card:hover {
            transform: translateY(-8px);
        }

        .popular {
            border: 3px solid #ea1f22;
            transform: scale(1.04);
        }

        .popular-badge {
            position: absolute;
            top: 15px;
            right: -35px;
            background: #ea1f22;
            color: #fff;
            padding: 8px 40px;
            transform: rotate(45deg);
            font-size: 14px;
            font-weight: 700;
            z-index: 9;
        }

        .combo-title {
            text-align: center;
            font-size: 28px;
            font-weight: 800;
            color: #ea1f22;
            margin-bottom: 10px;
        }

        .combo-list li {
            font-size: 16px;
            text-align: left;
            padding: 10px 0;
            font-weight: 600;
        }

        .bn64-price-box {
            text-align: center;
            background: #fff3f3;
            padding: 15px;
            border-radius: 12px;
            margin: 20px 0;
            font-weight: 700;
        }

        .bn64-price-box span {
            /* display: block; */
            font-size: 42px;
            color: #ea1f22;
            font-weight: 800;
        }

        .delivery {
            text-align: center;
            margin-bottom: 20px;
        }

        @media(max-width:992px) {

            .combo-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media(max-width:768px) {

            .combo-grid {
                grid-template-columns: 1fr;
            }

            .popular {
                transform: none;
            }

            .section-title h2 {
                font-size: 32px;
            }

            .combo-title {
                font-size: 24px;
            }

            .bn64-price-box span {
                font-size: 34px;
            }
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

        .combo-image {
            width: 100%;
            text-align: center;
            margin: 15px 0;
        }

        .combo-image img {
            width: 100%;
            max-width: 400px;
            height: auto;
            display: block;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .1);
        }

        @media (max-width: 576px) {
            .combo-image img {
                max-width: 100%;
            }
        }

        .scratch-offer {
            padding: 5px 15px;
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
            padding: 5px 15px;
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

            font-size: 16px;
            font-family: inherit;
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

        .qty-control span {
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
            padding: 5px 15px;
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
            margin: 0 auto 12px;
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
            bottom: 20px;
            right: 20px;
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
            color: white;
            transform: scale(1.1);
        }

        .combo-selector {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .combo-option {
            position: relative;
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 45px 15px 15px;
            border: 2px solid #e5e5e5;
            border-radius: 18px;

            background: #fff;
            cursor: pointer;

            transition: all .3s ease;
            overflow: hidden;
        }

        .combo-option:hover {
            border-color: #ea1f22;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .combo-option input[type="radio"] {
            width: 22px;
            height: 22px;
            accent-color: #ea1f22;
        }

        .combo-option:has(input:checked) {
            border-color: #ea1f22;
            background: #fff8f8;
            box-shadow: 0 10px 30px rgba(234, 31, 34, .15);
        }

        .combo-thumb img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 14px;
        }

        .combo-info {
            flex: 1;
        }

        .combo-info h4 {
            font-size: 22px;
            font-weight: 700;
        }

        .combo-info p {
            margin: 0 0 5px;
            color: #666;
            font-size: 14px;
        }

        .combo-summary {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .combo-summary span {
            padding: 6px 10px;
            border-radius: 30px;
            background: #f5f5f5;
            border: 1px solid #eee;
            font-size: 12px;
            font-weight: 500;
        }

        .combo-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 15px;
        }

        .combo-price {
            color: #ea1f22;
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
        }

        .combo-price small {
            font-size: 16px;
        }

        .qty-control {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .qty-control button {
            width: 25px;
            height: 25px;
            border: none;
            border-radius: 50%;
            background: #ea1f22;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: .3s;
        }

        .qty-control button:hover {
            background: #c81316;
        }

        .qty-control span {
            min-width: 30px;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
        }

        .popular-tag {
            position: absolute;
            top: 18px;
            right: -42px;

            width: 160px;

            background: #ea1f22;
            color: #fff;

            text-align: center;
            padding: 6px 0;

            font-size: 12px;
            font-weight: 700;

            transform: rotate(45deg);
        }

        .combo-summary {
            margin: 8px 0;
            font-size: 13px;
            color: #666;
            line-height: 1.6;
            /* display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; */
            /* overflow: hidden; */
        }

        .combo-option:has(input:checked) .combo-summary {
            color: #444;
        }

        @media(max-width:768px) {

            .combo-option {
                flex-wrap: wrap;
                padding: 5px;
            }

            .combo-thumb img {
                width: 80px;
                height: 80px;
            }

            .combo-info h4 {
                font-size: 18px;
            }

            .combo-price {
                font-size: 24px;
            }

            .combo-right {
                width: 100%;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }

            .combo-summary span {
                font-size: 8px;
            }

            .combo-info p {
                font-size: 12px;
            }

            .combo-summary {
                gap: 1px;
            }
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
                দেশের বিভিন্ন জেলার বিখ্যাত মসলা, এখন একসাথে!
            </h1>

            <p class="bn64-hero-desc">
                কম্বো অর্ডার করে Scratch Card ঘষে জিতে নিন

                <span class="">
                    Fridge, Smart TV, AC, Gold Necklace
                </span>

                সহ ৫০+ আকর্ষণীয় পুরস্কার।
            </p>



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


        <div class="section-title">
            <h2>আমাদের কম্বো সমূহ</h2>
        </div>

        <div class="combo-grid">

            <!-- Combo 1 -->
            <div class="combo-card popular">

                <div class="popular-badge " style="background-color: #4CAF50">
                    সর্বাধিক বিক্রিত
                </div>

                <div class="combo-image">
                    <img src="{{ asset('image/combo1.jpg') }}" alt="মসলা কম্বো ১">
                </div>

                <div class="combo-content">

                    <h3 class="combo-title">মসলা কম্বো ১</h3>


                    <div class="bn64-price-box">
                        কম্বো প্রাইস মাত্র <span>৯৯৯ ৳</span>
                    </div>

                    <div class="delivery">
                        🚚 ফ্রি হোম ডেলিভারি
                    </div>

                    <a onclick="scrollToForm()" class="order-btn">
                        <i class="fa-solid fa-cart-shopping"></i>
                        অর্ডার করতে চাই
                        <i class="fa-solid fa-arrow-down"></i>
                    </a>

                </div>

            </div>

            <!-- Combo 2 -->
            <div class="combo-card popular">

                <div class="popular-badge">
                    🔥 সর্বাধিক জনপ্রিয়
                </div>

                <div class="combo-image">
                    <img src="{{ asset('image/combo2.jpg') }}" alt="মসলা কম্বো ২">
                </div>

                <div class="combo-content">

                    <h3 class="combo-title">মসলা কম্বো ২</h3>

                    <div class="bn64-price-box">
                        কম্বো প্রাইস মাত্র <span>১৩৯৯ ৳</span>
                        <del>১৪২০ ৳</del>
                    </div>

                    <div class="delivery">
                        🚚 ফ্রি হোম ডেলিভারি
                    </div>

                    <a onclick="scrollToForm()" class="order-btn">
                        <i class="fa-solid fa-cart-shopping"></i>
                        অর্ডার করতে চাই
                        <i class="fa-solid fa-arrow-down"></i>
                    </a>

                </div>

            </div>

            <!-- Combo 3 -->
            <div class="combo-card popular">

                <div class="combo-image">
                    <img src="{{ asset('image/combo3.jpg') }}" alt="মসলা কম্বো ৩">
                </div>

                <div class="combo-content">

                    <h3 class="combo-title">মসলা কম্বো ৩</h3>



                    <div class="bn64-price-box">
                        কম্বো প্রাইস মাত্র <span>১৬৯৯ ৳</span>
                        <del>১৭৮৫ ৳</del>
                    </div>

                    <div class="delivery">
                        🚚 ফ্রি হোম ডেলিভারি
                    </div>

                    <a onclick="scrollToForm()" class="order-btn">
                        <i class="fa-solid fa-cart-shopping"></i>
                        অর্ডার করতে চাই
                        <i class="fa-solid fa-arrow-down"></i>
                    </a>

                </div>

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
                Dinner Set ও Shopping Voucher সহ
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

            <h2>কেন সেরা বাংলা ৬৪ এর মসলা কিনবেন?</h2>

            <ul class="why-list">

                <li>
                    <i class="fa-solid fa-circle-check"></i>
                    <div>
                        <strong>খাঁটি ও বাছাইকৃত মসলা</strong>
                    </div>
                </li>

                <li>
                    <i class="fa-solid fa-circle-check"></i>
                    <div>
                        <strong>আসল স্বাদ ও সুগন্ধ</strong>
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
                        <strong>স্বাস্থ্যসম্মত প্রক্রিয়াজাতকরণ</strong>
                    </div>
                </li>


                <li>
                    <i class="fa-solid fa-circle-check"></i>
                    <div>
                        <strong>বাংলাদেশের বিভিন্ন জেলার সেরা মসলা</strong>
                    </div>
                </li>

                <li>
                    <i class="fa-solid fa-circle-check"></i>
                    <div>
                        <strong>প্রতিদিনের রান্নায় বাড়তি স্বাদ ও ঘ্রাণ </strong>
                    </div>
                </li>

            </ul>


        </div>

    </section>



    {{-- Product selection and form --}}
    <section class="form-section" id="order-form">

        <div class="form-wrapper">

            <!-- LEFT SIDE -->
            <div class="customer-form">

                <h2>অর্ডার সম্পন্ন করুন</h2>
                <div class="combo-selector">

                    <div class="combo-selector">
                        <!-- COMBO 3 -->
                        <label class="combo-option">

                            <input type="radio" name="combo" value="combo3" onchange="selectCombo('combo3')">

                            <div class="combo-thumb">
                                <img src="{{ asset('image/combo3.jpg') }}" alt="">
                            </div>

                            <div class="combo-info">

                                <h4>মসলা কম্বো ৩</h4>

                                <p>৯ আইটেমের ফ্যামিলি প্যাক</p>

                                <p class="combo-summary">
                                    মিষ্টি মরিচ গুঁড়া, ঝাল মরিচ গুঁড়া, হলুদ গুঁড়া, জিরা গুঁড়া, মেজবানি মসলা গুঁড়া, ধনিয়া
                                    গুঁড়া, গরম মসলা গুঁড়া, ঘি, বালাচাও
                                </p>
                            </div>

                            <div class="combo-right">


                                <div class="qty-control">

                                    <button type="button"
                                        onclick="event.stopPropagation();changeCardQty('combo3',-1)">
                                        −
                                    </button>

                                    <span id="combo3Qty">1</span>

                                    <button type="button"
                                        onclick="event.stopPropagation();changeCardQty('combo3',1)">
                                        +
                                    </button>

                                </div>
                                <div class="combo-price" id="combo3Price">
                                    ১৬৯৯ <small>৳</small>
                                </div>

                            </div>

                        </label>


                        <!-- COMBO 2 -->
                        <label class="combo-option  active popular">

                            <div class="popular-tag">
                                জনপ্রিয়
                            </div>

                            <input type="radio" name="combo" value="combo2" checked
                                onchange="selectCombo('combo2')">

                            <div class="combo-thumb">
                                <img src="{{ asset('image/combo2.jpg') }}" alt="">
                            </div>

                            <div class="combo-info">

                                <h4>মসলা কম্বো ২</h4>

                                <p>৮ আইটেমের প্রিমিয়াম প্যাক</p>

                                <p class="combo-summary">

                                    মিষ্টি মরিচ গুঁড়া, ঝাল মরিচ গুঁড়া, হলুদ গুঁড়া, জিরা গুঁড়া, মেজবানি মসলা গুঁড়া, ধনিয়া
                                    গুঁড়া, গরম মসলা গুঁড়া, ঘি
                                </p>

                            </div>

                            <div class="combo-right">


                                <div class="qty-control">

                                    <button type="button"
                                        onclick="event.stopPropagation();changeCardQty('combo2',-1)">
                                        −
                                    </button>

                                    <span id="combo2Qty">1</span>

                                    <button type="button"
                                        onclick="event.stopPropagation();changeCardQty('combo2',1)">
                                        +
                                    </button>

                                </div>
                                <div class="combo-price" id="combo2Price">
                                    ১৩৯৯ <small>৳</small>
                                </div>

                            </div>

                        </label>

                        <!-- COMBO 1 -->
                        <label class="combo-option  popular">

                            <div class="popular-tag" style="background-color: #4CAF50">
                                সর্বাধিক বিক্রিত
                            </div>

                            <input type="radio" name="combo" value="combo1" onchange="selectCombo('combo1')">

                            <div class="combo-thumb">
                                <img src="{{ asset('image/combo1.jpg') }}" alt="">
                            </div>

                            <div class="combo-info">

                                <h4>মসলা কম্বো ১</h4>

                                <p>৬ আইটেমের স্পেশাল মসলা প্যাক</p>


                                <p class="combo-summary">
                                    মিষ্টি মরিচ গুঁড়া, ঝাল মরিচ গুঁড়া, হলুদ গুঁড়া, জিরা গুঁড়া, মেজবানি মসলা গুঁড়া, ধনিয়া
                                    গুঁড়া
                                </p>



                            </div>

                            <div class="combo-right">

                                <div class="qty-control">

                                    <button type="button"
                                        onclick="event.stopPropagation();changeCardQty('combo1',-1)">
                                        −
                                    </button>

                                    <span id="combo1Qty">1</span>

                                    <button type="button"
                                        onclick="event.stopPropagation();changeCardQty('combo1',1)">
                                        +
                                    </button>

                                </div>
                                <div class="combo-price" id="combo1Price">
                                    ৯৯৯ <small>৳</small>
                                </div>


                            </div>

                        </label>





                    </div>


                </div>


                <p class="form-subtitle" style="margin-top:10px">
                    আপনার তথ্য প্রদান করুন
                </p>

                <form id="orderForm">
                    @csrf
                    <div class="form-group">
                        <label>আপনার নাম *</label>
                        <input placeholder="আপনার নাম লিখুন" type="text" id="name" required>
                    </div>
                    <div class="form-group">
                        <label>মোবাইল নম্বর *</label><input type="tel" id="phone" maxlength="11"
                            placeholder="01XXXXXXXXX"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,11)" required>
                    </div>
                    <div class="form-group">
                        <label>সম্পূর্ণ ঠিকানা *</label>
                        <textarea id="address" placeholder="সম্পূর্ণ ডেলিভারি ঠিকানা লিখুন" required rows="4"></textarea>
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

                                        <img src="{{ asset('image/combo1.jpg') }}" id="summaryImage" alt="Achar">

                                        <div class="summary-product-info">

                                            <h5 id="summaryProductName">মসলা কম্বো ১</h5>

                                            <span>
                                                Qty × <span id="qtyText">1</span>
                                            </span>
                                        </div>

                                    </div>
                                </td>

                                <td class="summary-price" id="subtotal">
                                    999৳
                                </td>

                            </tr>
                        </tbody>

                    </table>

                    <div class="summary-row">
                        <span>ডেলিভারি চার্জ</span>
                        <span style="color:green;font-weight:700;">ফ্রি</span>
                    </div>

                    <div class="summary-total">
                        <span>মোট</span>
                        <span id="totalPrice">999৳</span>
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

    <script>
        const combos = {
            combo1: {
                name: "মসলা কম্বো ১",
                price: 999,
                image: "{{ asset('image/combo1.jpg') }}"
            },
            combo2: {
                name: "মসলা কম্বো ২",
                price: 1399,
                image: "{{ asset('image/combo2.jpg') }}"
            },
            combo3: {
                name: "মসলা কম্বো ৩",
                price: 1699,
                image: "{{ asset('image/combo3.jpg') }}"
            }
        };

        let selectedCombo = "combo2";
        let selectedQty = 1;

        document.addEventListener("DOMContentLoaded", function() {
            updateCardPrices();
            renderSelectedCombo();
        });

        function selectCombo(comboId) {

            selectedCombo = comboId;
            selectedQty = 1;

            document.getElementById("combo1Qty").innerText = 1;
            document.getElementById("combo2Qty").innerText = 1;
            document.getElementById("combo3Qty").innerText = 1;

            updateCardPrices();
            renderSelectedCombo();
        }

        function changeCardQty(comboId, change) {

            if (comboId !== selectedCombo) {
                return;
            }

            let newQty = selectedQty + change;

            if (newQty < 1) {
                newQty = 1;
            }

            selectedQty = newQty;

            document.getElementById(comboId + "Qty").innerText = selectedQty;

            updateCardPrices();
            renderSelectedCombo();
        }

        function updateCardPrices() {

            document.getElementById('combo1Price').innerHTML =
                combos.combo1.price + ' <small>৳</small>';

            document.getElementById('combo2Price').innerHTML =
                combos.combo2.price + ' <small>৳</small>';

            document.getElementById('combo3Price').innerHTML =
                combos.combo3.price + ' <small>৳</small>';

            document.getElementById(selectedCombo + 'Price').innerHTML =
                (combos[selectedCombo].price * selectedQty) + ' <small>৳</small>';
        }

        function renderSelectedCombo() {

            const combo = combos[selectedCombo];

            const total = combo.price * selectedQty;

            document.getElementById("summaryImage").src = combo.image;

            document.getElementById("summaryProductName").innerText = combo.name;

            document.getElementById("qtyText").innerText = selectedQty;

            document.getElementById("subtotal").innerText = total + " ৳";

            document.getElementById("totalPrice").innerText = total + " ৳";
        }

        document.getElementById('orderForm').addEventListener('submit', submitForm);

        function submitForm(event) {

            event.preventDefault();

            const phone = document.getElementById('phone').value.trim();

            if (!/^01\d{9}$/.test(phone)) {

                Swal.fire({
                    icon: 'warning',
                    title: 'ভুল মোবাইল নম্বর',
                    text: 'অনুগ্রহ করে ১১ সংখ্যার সঠিক মোবাইল নম্বর লিখুন।'
                });

                document.getElementById('phone').focus();

                return;
            }

            const combo = combos[selectedCombo];

            const total = combo.price * selectedQty;

            const data = {
                _token: document.querySelector('meta[name="csrf-token"]').content,

                customer_name: document.getElementById('name').value,

                customer_phone: phone,

                customer_address: document.getElementById('address').value,

                order_note: document.getElementById('order_note').value,

                subtotal: total,

                total: total,

                product: combo.name + " (" + selectedQty + " পিস)"
            };

            console.log(data);

            fetch("{{ route('order.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": data._token,
                        "Accept": "application/json"
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {

                    if (!response.ok) {
                        throw new Error("Failed");
                    }

                    return response.text();
                })
                .then(() => {

                    Swal.fire({
                        icon: 'success',
                        title: 'অর্ডার সফল হয়েছে',
                        text: 'আমাদের প্রতিনিধি শীঘ্রই আপনার সাথে যোগাযোগ করবে।'
                    });

                    selectedQty = 1;

                    document.getElementById(selectedCombo + "Qty").innerText = 1;

                    document.getElementById('orderForm').reset();

                    updateCardPrices();

                    renderSelectedCombo();
                })
                .catch(error => {

                    console.log(error);

                    Swal.fire({
                        icon: 'error',
                        title: 'দুঃখিত!',
                        text: 'অর্ডার গ্রহণ করা যায়নি। আবার চেষ্টা করুন।'
                    });

                });
        }

        function scrollToForm() {

            document.getElementById('order-form').scrollIntoView({
                behavior: 'smooth'
            });

        }
    </script>


    <a href="https://wa.me/8801344314426" class="whatsapp-float" target="_blank">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <footer>
        <p>&copy; 2026 সেরা বাংলা ৬৪ - সব অধিকার সংরক্ষিত</p>
        <div class="footer-actions"> <a href="tel:+8809640646464" class="contact-btn call-btn"> <i
                    class="fa-solid fa-headset"></i> +880 9640-646464 </a> <a href="https://wa.me/8801344314426"
                target="_blank" class="contact-btn whatsapp-btn"> <i class="fa-brands fa-whatsapp"></i> WhatsApp:
                01344-314426 </a> </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
