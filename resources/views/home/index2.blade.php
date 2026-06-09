<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loombongo – প্রিমিয়াম সিরাজগঞ্জ লুঙ্গি | Premium Quality Lungi</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Hind+Siliguri:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Swiper CSS for Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <style>
        :root {
            --primary: #d4af37;
            --primary-dark: #b8941f;
            --secondary: #1a1a1a;
            --light-bg: #f9f7f2;
            --text-dark: #222222;
            --text-light: #666666;
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --shadow-heavy: 0 15px 40px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Hind Siliguri', 'Inter', sans-serif;
            color: var(--text-dark);
            overflow-x: hidden;
            line-height: 1.7;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
            color: var(--secondary);
        }

        .section-title {
            position: relative;
            margin-bottom: 3rem;
            text-align: center;
        }

        .section-title:after {
            content: '';
            position: absolute;
            width: 80px;
            height: 4px;
            background: var(--primary);
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('https://images.unsplash.com/photo-1576566588028-4147f3842f27?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            min-height: 90vh;
            display: flex;
            align-items: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-block;
            background: var(--primary);
            color: var(--secondary);
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            max-width: 800px;
        }

        .cta-btn {
            background: var(--primary);
            color: var(--secondary);
            border: none;
            padding: 15px 35px;
            font-size: 1.2rem;
            font-weight: 700;
            border-radius: 50px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        .cta-btn:hover {
            background: var(--primary-dark);
            color: var(--secondary);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.4);
        }

        /* USP Section */
        .usp-section {
            background: var(--light-bg);
            padding: 5rem 0;
        }

        .usp-card {
            background: var(--white);
            border-radius: 15px;
            padding: 30px 25px;
            height: 100%;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border-top: 4px solid transparent;
            text-align: center;
        }

        .usp-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-heavy);
            border-top-color: var(--primary);
        }

        .usp-icon {
            width: 70px;
            height: 70px;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--primary);
            font-size: 1.8rem;
        }

        /* Product Slider */
        .product-section {
            padding: 5rem 0;
            background: var(--white);
        }

        .product-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            height: 100%;
            border: 1px solid #f0f0f0;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-heavy);
        }

        .product-img {
            height: 280px;
            width: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--primary);
            color: var(--secondary);
            padding: 5px 15px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.8rem;
        }

        .product-price {
            color: var(--primary);
            font-weight: 800;
            font-size: 1.5rem;
            margin: 10px 0;
        }

        .product-old-price {
            text-decoration: line-through;
            color: var(--text-light);
            font-size: 1rem;
            margin-left: 10px;
        }

        .select-btn {
            background: var(--secondary);
            color: var(--white);
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: var(--transition);
        }

        .select-btn:hover {
            background: var(--primary);
            color: var(--secondary);
        }

        .selected-btn {
            background: var(--primary);
            color: var(--secondary);
        }

        /* Review Section */
        .review-section {
            background: var(--light-bg);
            padding: 5rem 0;
        }

        .review-card {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow);
            height: 100%;
            position: relative;
        }

        .review-card:before {
            content: "\201C";
            position: absolute;
            top: 20px;
            left: 25px;
            font-size: 4rem;
            color: rgba(212, 175, 55, 0.2);
            font-family: Georgia, serif;
        }

        .review-text {
            font-style: italic;
            margin-bottom: 20px;
            padding-top: 20px;
        }

        .review-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .review-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
        }

        .review-rating {
            color: var(--primary);
            margin-bottom: 5px;
        }

        /* Order Section */
        .order-section {
            padding: 5rem 0;
            background: var(--white);
        }

        .order-form-container {
            background: var(--light-bg);
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow);
        }

        .selected-product-card {
            background: var(--white);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--shadow);
            border-left: 5px solid var(--primary);
        }

        .product-thumb {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .form-control,
        .form-select {
            padding: 12px 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
            transition: var(--transition);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
        }

        .submit-btn {
            background: var(--primary);
            color: var(--secondary);
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            font-weight: 700;
            border-radius: 10px;
            width: 100%;
            transition: var(--transition);
        }

        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);
        }

        /* Trust Badges */
        .trust-badges {
            background: var(--secondary);
            color: var(--white);
            padding: 3rem 0;
        }

        .trust-item {
            text-align: center;
            padding: 20px;
        }

        .trust-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        /* Footer */
        .footer {
            background: #111111;
            color: #aaa;
            padding: 3rem 0 1.5rem;
        }

        .footer-heading {
            color: var(--white);
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            transition: var(--transition);
        }

        .social-icon:hover {
            background: var(--primary);
            color: var(--secondary);
            transform: translateY(-5px);
        }

        /* Swiper Customization */
        .swiper {
            padding: 30px 10px 50px;
        }

        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: #ddd;
            opacity: 1;
        }

        .swiper-pagination-bullet-active {
            background: var(--primary);
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: var(--primary);
            background: rgba(255, 255, 255, 0.9);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: var(--shadow);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 1.5rem;
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 1s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Quantity Selector */
        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
        }

        .quantity-btn {
            width: 40px;
            height: 40px;
            background: #f0f0f0;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: var(--transition);
        }

        .quantity-btn:hover {
            background: var(--primary);
            color: var(--secondary);
        }

        .quantity-input {
            width: 60px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 8px;
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content fade-in">
                    <div class="hero-badge">
                        <i class="fas fa-award me-2"></i> প্রিমিয়াম কোয়ালিটি গ্যারান্টি
                    </div>
                    <h1 class="hero-title">খাঁটি সিরাজগঞ্জ লুঙ্গির ঐতিহ্য, প্রিমিয়াম কমফোর্টে</h1>
                    <p class="hero-subtitle">
                        বাজারের সাধারণ লুঙ্গিতে রঙ উঠে যাওয়া বা খসখসে ভাব? Loombongo দিচ্ছে ১০০% সফট কটন এবং
                        পাকা রঙের গ্যারান্টি। ঐতিহ্যের সেরা আরাম এখন আপনার হাতে।
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#products" class="btn cta-btn">
                            <i class="fas fa-shopping-bag"></i> কালেকশন দেখুন
                        </a>
                        <a href="#order" class="btn cta-btn"
                            style="background: transparent; border: 2px solid var(--primary); color: var(--white);">
                            <i class="fas fa-bolt"></i> দ্রুত অর্ডার করুন
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <!-- Hero image will be in background -->
                </div>
            </div>
        </div>
    </section>

    <!-- USP Section -->
    <section class="usp-section">
        <div class="container">
            <h2 class="section-title">Loombongo লুঙ্গির বিশেষত্ব</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="usp-card">
                        <div class="usp-icon">
                            <i class="fas fa-fan"></i>
                        </div>
                        <h4>উত্তম বাতাস চলাচল</h4>
                        <p>বিশেষ তাঁতের বুননে তৈরি, যা গরমে দারুণ আরামদায়ক এবং শরীরকে শীতল রাখে।</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="usp-card">
                        <div class="usp-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <h4>পাকা রঙের গ্যারান্টি</h4>
                        <p>উচ্চমানের ডাই ব্যবহার করা হয়, তাই বারবার ধোয়ায়ও রঙ অটুট থাকে।</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="usp-card">
                        <div class="usp-icon">
                            <i class="fas fa-feather-alt"></i>
                        </div>
                        <h4>মিহি সুতার বুনন</h4>
                        <p>পালকের মত নরম স্পর্শ যা পরতেই মন ভরে যায়, কোনো চুলকানি নেই।</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Slider Section -->
    <section id="products" class="product-section">
        <div class="container">
            <h2 class="section-title">আমাদের প্রিমিয়াম কালেকশন</h2>
            <p class="text-center mb-5 fs-5">উচ্চমানের সুতা ও কারুকার্যে তৈরি এক্সক্লুসিভ লুঙ্গি</p>

            <!-- Swiper Slider -->
            <div class="swiper productSwiper">
                <div class="swiper-wrapper">
                    <!-- Product 1 -->
                    <div class="swiper-slide">
                        <div class="product-card">
                            <div class="position-relative">
                                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                    class="product-img" alt="Premium Sirajganj Lungi">
                                <div class="product-badge">বেস্টসেলার</div>
                            </div>
                            <div class="p-4">
                                <h4>প্রিমিয়াম সিরাজগঞ্জ লুঙ্গি</h4>
                                <p class="text-muted">১০০% সুতি কাপড়, হ্যান্ডলুম তৈরি</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="product-price">৳ ৫৫০</span>
                                        <span class="product-old-price">৳ ৬৫০</span>
                                    </div>
                                    <div class="text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <button class="btn select-btn mt-3" data-product="1"
                                    data-name="প্রিমিয়াম সিরাজগঞ্জ লুঙ্গি" data-price="550"
                                    data-img="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80">
                                    <i class="fas fa-check-circle me-2"></i> সিলেক্ট করুন
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 2 -->
                    <div class="swiper-slide">
                        <div class="product-card">
                            <div class="position-relative">
                                <img src="https://images.unsplash.com/photo-1560769629-975ec94e6a86?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                    class="product-img" alt="Soft Comfort Cotton Lungi">
                                <div class="product-badge">নতুন</div>
                            </div>
                            <div class="p-4">
                                <h4>সফট কমফোর্ট কটন</h4>
                                <p class="text-muted">অতিরিক্ত নরম, চেক ডিজাইন</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="product-price">৳ ৪৮০</span>
                                        <span class="product-old-price">৳ ৫৬০</span>
                                    </div>
                                    <div class="text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <button class="btn select-btn mt-3" data-product="2" data-name="সফট কমফোর্ট কটন"
                                    data-price="480"
                                    data-img="https://images.unsplash.com/photo-1560769629-975ec94e6a86?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80">
                                    <i class="fas fa-check-circle me-2"></i> সিলেক্ট করুন
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 3 -->
                    <div class="swiper-slide">
                        <div class="product-card">
                            <div class="position-relative">
                                <img src="https://images.unsplash.com/photo-1544441893-675973e31985?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                    class="product-img" alt="Traditional Premium Lungi">
                                <div class="product-badge">ক্লাসিক</div>
                            </div>
                            <div class="p-4">
                                <h4>ট্রেডিশনাল প্রিমিয়াম লুঙ্গি</h4>
                                <p class="text-muted">ঐতিহ্যবাহী ডিজাইন, প্রিমিয়াম ফেব্রিক</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="product-price">৳ ৫২০</span>
                                        <span class="product-old-price">৳ ৬০০</span>
                                    </div>
                                    <div class="text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <button class="btn select-btn mt-3" data-product="3"
                                    data-name="ট্রেডিশনাল প্রিমিয়াম লুঙ্গি" data-price="520"
                                    data-img="https://images.unsplash.com/photo-1544441893-675973e31985?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80">
                                    <i class="fas fa-check-circle me-2"></i> সিলেক্ট করুন
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product 4 -->
                    <div class="swiper-slide">
                        <div class="product-card">
                            <div class="position-relative">
                                <img src="https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                    class="product-img" alt="Luxury Cotton Lungi">
                                <div class="product-badge">এক্সক্লুসিভ</div>
                            </div>
                            <div class="p-4">
                                <h4>লাক্সারি কটন লুঙ্গি</h4>
                                <p class="text-muted">বিশেষ উৎসবের জন্য, জমকালো ডিজাইন</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="product-price">৳ ৬২০</span>
                                        <span class="product-old-price">৳ ৭২০</span>
                                    </div>
                                    <div class="text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <button class="btn select-btn mt-3" data-product="4" data-name="লাক্সারি কটন লুঙ্গি"
                                    data-price="620"
                                    data-img="https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80">
                                    <i class="fas fa-check-circle me-2"></i> সিলেক্ট করুন
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <!-- Customer Reviews -->
    <section class="review-section">
        <div class="container">
            <h2 class="section-title">গ্রাহকদের প্রতিক্রিয়া</h2>
            <p class="text-center mb-5 fs-5">আমাদের সন্তুষ্ট গ্রাহকরা যা বলছেন</p>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="review-card">
                        <div class="review-text">
                            "Loombongo লুঙ্গির মান সত্যিই অসাধারণ। রঙ একদমই উঠে না, আর কাপড়ও খুব নরম। সারাদিন পরে
                            থাকলেও কোনো অস্বস্তি হয় না।"
                        </div>
                        <div class="review-author">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="review-avatar"
                                alt="Customer">
                            <div>
                                <h5 class="mb-1">রফিকুল ইসলাম</h5>
                                <div class="review-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="mb-0 text-muted">ঢাকা</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="review-card">
                        <div class="review-text">
                            "অনেকদিন ধরে সিরাজগঞ্জের লুঙ্গি খুঁজছিলাম। Loombongo-র লুঙ্গি পাওয়ায় খুব খুশি। দামের
                            তুলনায় মান অনেক ভাল।"
                        </div>
                        <div class="review-author">
                            <img src="https://randomuser.me/api/portraits/men/67.jpg" class="review-avatar"
                                alt="Customer">
                            <div>
                                <h5 class="mb-1">জাহিদ হাসান</h5>
                                <div class="review-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <p class="mb-0 text-muted">চট্টগ্রাম</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="review-card">
                        <div class="review-text">
                            "পণ্য ডেলিভারি খুব দ্রুত পেয়েছি। লুঙ্গির ফেব্রিক এবং সেলাইয়ের মান দেখে আমি মুগ্ধ। সবাইকে
                            Loombongo সুপারিশ করছি।"
                        </div>
                        <div class="review-author">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="review-avatar"
                                alt="Customer">
                            <div>
                                <h5 class="mb-1">সুবর্ণা আহমেদ</h5>
                                <div class="review-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="mb-0 text-muted">সিলেট</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="review-card">
                        <div class="review-text">
                            "পণ্য ডেলিভারি খুব দ্রুত পেয়েছি। লুঙ্গির ফেব্রিক এবং সেলাইয়ের মান দেখে আমি মুগ্ধ। সবাইকে
                            Loombongo সুপারিশ করছি।"
                        </div>
                        <div class="review-author">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="review-avatar"
                                alt="Customer">
                            <div>
                                <h5 class="mb-1">সুবর্ণা আহমেদ</h5>
                                <div class="review-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="mb-0 text-muted">সিলেট</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Badges -->
    <section class="trust-badges">
        <div class="container">
            <div class="row">
                <div class="col-md-3 trust-item">
                    <div class="trust-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h4>দ্রুত ডেলিভারি</h4>
                    <p>সারা দেশে ৩-৫ কর্মদিবসে</p>
                </div>
                <div class="col-md-3 trust-item">
                    <div class="trust-icon">
                        <i class="fas fa-undo-alt"></i>
                    </div>
                    <h4>সহজ রিটার্ন</h4>
                    <p>৭ দিনের রিটার্ন পলিসি</p>
                </div>
                <div class="col-md-3 trust-item">
                    <div class="trust-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>১০০% গ্যারান্টি</h4>
                    <p>পণ্যের মানের নিশ্চয়তা</p>
                </div>
                <div class="col-md-3 trust-item">
                    <div class="trust-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h4>ক্যাশ অন ডেলিভারি</h4>
                    <p>পণ্য হাতে পেয়ে টাকা দিন</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Order Section -->
    <section id="order" class="order-section">
        <div class="container">
            <h2 class="section-title">অর্ডার করুন এখনই</h2>
            <p class="text-center mb-5 fs-5">স্টক সীমিত, দেরি করবেন না</p>

            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="order-form-container">
                        <!-- Selected Product Display -->
                        <div id="selectedProductContainer" class="selected-product-card" style="display: none;">
                            <h5 class="mb-3">আপনার নির্বাচিত পণ্য:</h5>
                            <div class="d-flex align-items-center">
                                <img id="selectedProductImage" src="" class="product-thumb me-3"
                                    alt="Selected Product">
                                <div class="flex-grow-1">
                                    <h5 id="selectedProductName" class="mb-1"></h5>
                                    <p id="selectedProductPrice" class="text-primary fw-bold mb-2"></p>
                                    <div class="quantity-selector">
                                        <button class="quantity-btn" id="decreaseQty">-</button>
                                        <input type="number" id="productQty" class="quantity-input" value="1"
                                            min="1" max="10">
                                        <button class="quantity-btn" id="increaseQty">+</button>
                                        <span class="ms-3">টুকরা</span>
                                    </div>
                                </div>
                                <button class="btn btn-outline-danger btn-sm" id="removeProduct">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <form id="orderForm">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">আপনার নাম *</label>
                                    <input type="text" class="form-control" placeholder="পুরো নাম লিখুন" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">মোবাইল নম্বর *</label>
                                    <input type="tel" class="form-control" placeholder="01XXXXXXXXX" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">ইমেইল এড্রেস</label>
                                    <input type="email" class="form-control" placeholder="আপনার ইমেইল দিন">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">পুরো ঠিকানা *</label>
                                    <textarea class="form-control" rows="3" placeholder="বাড়ি নম্বর, রাস্তা, এলাকা, জেলা" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">জেলা *</label>
                                    <select class="form-select" required>
                                        <option selected disabled>জেলা নির্বাচন করুন</option>
                                        <option>ঢাকা</option>
                                        <option>চট্টগ্রাম</option>
                                        <option>সিলেট</option>
                                        <option>রাজশাহী</option>
                                        <option>খুলনা</option>
                                        <option>বরিশাল</option>
                                        <option>রংপুর</option>
                                        <option>ময়মনসিংহ</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">ডেলিভারি পার্টনার</label>
                                    <select class="form-select">
                                        <option selected>Sundarban Courier</option>
                                        <option>SA Paribahan</option>
                                        <option>Paperfly</option>
                                        <option>eCourier</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                        <label class="form-check-label" for="agreeTerms">
                                            আমি <a href="#" class="text-primary">শর্তাবলী</a> এবং <a
                                                href="#" class="text-primary">প্রাইভেসি পলিসি</a> মেনে অর্ডার
                                            দিচ্ছি
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn submit-btn" id="submitOrderBtn">
                                        <i class="fas fa-paper-plane me-2"></i> অর্ডার কনফার্ম করুন
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h4 class="footer-heading">Loombongo</h4>
                    <p>প্রিমিয়াম কোয়ালিটির সিরাজগঞ্জ লুঙ্গি। বাঙালিয়ানার ঐতিহ্যকে আধুনিক কমফোর্টের সাথে মেলানোর
                        প্রতিশ্রুতি।</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <h4 class="footer-heading">যোগাযোগ</h4>
                    <p><i class="fas fa-phone-alt me-2"></i> হটলাইন: ০১৮৬৭৫৭২৮০৪</p>
                    <p><i class="far fa-clock me-2"></i> সময়: সকাল ৮টা - রাত ১০টা</p>
                    <p><i class="fas fa-envelope me-2"></i> ইমেইল: support@loombongo.com</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h4 class="footer-heading">গুরুত্বপূর্ণ লিংক</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-light-50">শর্তাবলী</a></li>
                        <li><a href="#" class="text-decoration-none text-light-50">প্রাইভেসি পলিসি</a></li>
                        <li><a href="#" class="text-decoration-none text-light-50">রিটার্ন পলিসি</a></li>
                        <li><a href="#" class="text-decoration-none text-light-50">ডেলিভারি তথ্য</a></li>
                    </ul>
                </div>
            </div>
            <hr class="bg-secondary">
            <div class="text-center pt-3">
                <p class="mb-0">© ২০২৩ Loombongo. সকল স্বত্ব সংরক্ষিত।</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Initialize Swiper
        const swiper = new Swiper('.productSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 3,
                },
            },
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });

        // Product Selection Logic
        let selectedProduct = null;

        document.querySelectorAll('.select-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Reset all buttons
                document.querySelectorAll('.select-btn').forEach(btn => {
                    btn.classList.remove('selected-btn');
                    btn.innerHTML = '<i class="fas fa-check-circle me-2"></i> সিলেক্ট করুন';
                });

                // Mark current button as selected
                this.classList.add('selected-btn');
                this.innerHTML = '<i class="fas fa-check-circle me-2"></i> নির্বাচিত';

                // Get product data
                selectedProduct = {
                    id: this.dataset.product,
                    name: this.dataset.name,
                    price: this.dataset.price,
                    img: this.dataset.img,
                    quantity: 1
                };

                // Display selected product in order form
                displaySelectedProduct();
            });
        });

        // Display selected product in order form
        function displaySelectedProduct() {
            if (selectedProduct) {
                document.getElementById('selectedProductContainer').style.display = 'block';
                document.getElementById('selectedProductImage').src = selectedProduct.img;
                document.getElementById('selectedProductName').textContent = selectedProduct.name;
                document.getElementById('selectedProductPrice').textContent =
                    `৳ ${selectedProduct.price} x ${selectedProduct.quantity} = ৳ ${selectedProduct.price * selectedProduct.quantity}`;

                // Scroll to order form
                document.getElementById('order').scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }

        // Quantity controls
        document.getElementById('increaseQty').addEventListener('click', function() {
            let qtyInput = document.getElementById('productQty');
            let currentQty = parseInt(qtyInput.value);
            if (currentQty < 10) {
                qtyInput.value = currentQty + 1;
                updateQuantity();
            }
        });

        document.getElementById('decreaseQty').addEventListener('click', function() {
            let qtyInput = document.getElementById('productQty');
            let currentQty = parseInt(qtyInput.value);
            if (currentQty > 1) {
                qtyInput.value = currentQty - 1;
                updateQuantity();
            }
        });

        document.getElementById('productQty').addEventListener('change', function() {
            let qty = parseInt(this.value);
            if (qty < 1) this.value = 1;
            if (qty > 10) this.value = 10;
            updateQuantity();
        });

        function updateQuantity() {
            if (selectedProduct) {
                selectedProduct.quantity = parseInt(document.getElementById('productQty').value);
                document.getElementById('selectedProductPrice').textContent =
                    `৳ ${selectedProduct.price} x ${selectedProduct.quantity} = ৳ ${selectedProduct.price * selectedProduct.quantity}`;
            }
        }

        // Remove selected product
        document.getElementById('removeProduct').addEventListener('click', function() {
            document.getElementById('selectedProductContainer').style.display = 'none';
            selectedProduct = null;

            // Reset selection buttons
            document.querySelectorAll('.select-btn').forEach(btn => {
                btn.classList.remove('selected-btn');
                btn.innerHTML = '<i class="fas fa-check-circle me-2"></i> সিলেক্ট করুন';
            });
        });

        // Form submission
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!selectedProduct) {
                alert('দয়া করে একটি পণ্য সিলেক্ট করুন।');
                return;
            }

            // Show success message
            document.getElementById('submitOrderBtn').innerHTML =
                '<i class="fas fa-check-circle me-2"></i> অর্ডার সফল!';
            document.getElementById('submitOrderBtn').classList.remove('submit-btn');
            document.getElementById('submitOrderBtn').classList.add('btn-success');

            // Reset form after 3 seconds
            setTimeout(() => {
                document.getElementById('orderForm').reset();
                document.getElementById('selectedProductContainer').style.display = 'none';
                selectedProduct = null;

                // Reset selection buttons
                document.querySelectorAll('.select-btn').forEach(btn => {
                    btn.classList.remove('selected-btn');
                    btn.innerHTML = '<i class="fas fa-check-circle me-2"></i> সিলেক্ট করুন';
                });

                // Reset submit button
                document.getElementById('submitOrderBtn').innerHTML =
                    '<i class="fas fa-paper-plane me-2"></i> অর্ডার কনফার্ম করুন';
                document.getElementById('submitOrderBtn').classList.remove('btn-success');
                document.getElementById('submitOrderBtn').classList.add('submit-btn');

                alert('আপনার অর্ডারটি সফলভাবে গ্রহণ করা হয়েছে! আমরা শীঘ্রই আপনার সাথে যোগাযোগ করব।');
            }, 3000);
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html