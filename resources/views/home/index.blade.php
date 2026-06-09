<!doctype html>
<html lang="bn" class="scroll-smooth h-full">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
    <title>Premium Desi Achar Combo</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --primary: #ff6b00;
            --secondary: #ffb703;
            --accent: #d62828;
        }

        body {
            background: linear-gradient(135deg, #fff7ed, #fff1e6, #fff8dc);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #ff6b00, #ffb703, #d62828);
            background-size: 200% 200%;
            animation: gradientMove 8s ease infinite;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        .glow {
            box-shadow: 0 10px 40px rgba(255, 107, 0, .4);
        }

        .blob {
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle at center, #ffb70355, transparent);
            border-radius: 50%;
            filter: blur(60px);
            z-index: 1;
            pointer-events: none;
        }

        @media(max-width:640px) {
            .blob {
                width: 220px;
                height: 220px;
            }
        }
    </style>
</head>

<body class="text-gray-800 antialiased selection:bg-orange-200 w-full min-h-full overflow-x-hidden relative">

    <!-- Ironclad Wrapper to stop any element from extending past the viewport edge -->
    <main class="relative w-full overflow-hidden block">

        <!-- Background Blobs safely locked inside wrapper -->
        <div class="blob top-[-100px] left-[-100px]"></div>
        <div class="blob bottom-[10%] right-[-100px]"></div>

        <!-- 🔥 Top Offer Banner -->
        <section
            class="gradient-bg text-white text-center py-3 px-4 text-sm sm:text-base font-semibold tracking-wide shadow-sm relative z-10">
            🔥 Limited Offer! First 50 Orders Get FREE Sample Jar 🎁
        </section>

        <!-- HERO -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16 lg:py-24 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">

                <!-- Text Content -->
                <div class="text-center lg:text-left order-2 lg:order-1">
                    <h1
                        class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight text-gray-900 mb-4 sm:mb-6">
                        🥭 আসল ঘরোয়া স্বাদের <span class="text-orange-600 block sm:inline">Desi Achar Combo</span>
                    </h1>

                    <p class="text-base sm:text-lg text-gray-600 mb-6 sm:mb-8 max-w-xl mx-auto lg:mx-0">
                        ৩ রকমের প্রিমিয়াম আচার — আম, মিক্সড ভেজ, নিম্বু। ছোট ব্যাচে তৈরি, কোনো প্রিজারভেটিভ নেই।
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 px-2 sm:px-0">
                        <a href="#checkout"
                            class="w-full sm:w-auto text-center px-8 py-4 bg-orange-600 text-white rounded-full glow font-bold hover:bg-orange-700 active:scale-95 transform transition duration-200">
                            Order Now — ৳420
                        </a>
                        <a href="#gallery"
                            class="w-full sm:w-auto text-center px-8 py-4 border-2 border-orange-600 text-orange-600 rounded-full font-bold hover:bg-orange-600 hover:text-white active:scale-95 transform transition duration-200">
                            View Gallery
                        </a>
                    </div>

                    <div
                        class="mt-8 pt-6 border-t border-orange-100 flex flex-wrap justify-center lg:justify-start gap-x-6 gap-y-3 text-xs sm:text-sm font-medium text-gray-600">
                        <div class="flex items-center gap-1.5">⭐ <span class="font-bold text-gray-900">4.9</span> Rating
                        </div>
                        <div class="flex items-center gap-1.5">🚚 Delivery</div>
                        <div class="flex items-center gap-1.5">🛡 7 Days Guarantee</div>
                    </div>
                </div>

                <!-- Image View -->
                <div class="order-1 lg:order-2 flex justify-center w-full">
                    <div class="relative w-full max-w-xs sm:max-w-md lg:max-w-none px-2 sm:px-0">
                        <div
                            class="absolute inset-0 bg-gradient-to-tr from-orange-400 to-yellow-300 rounded-3xl transform rotate-3 scale-102 opacity-30 blur-sm">
                        </div>
                        <img src="https://picsum.photos/600/600?random=1" alt="Desi Achar Combo Main Pack"
                            class="relative rounded-3xl shadow-2xl w-full object-cover aspect-square">
                    </div>
                </div>

            </div>
        </section>

        <!-- 🥭 Combo Details -->
        <section class="bg-white py-12 sm:py-24 border-y border-orange-100 relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-center text-gray-900 mb-3">
                    What's Inside the Combo?
                </h2>
                <p class="text-center text-gray-500 mb-10 max-w-md mx-auto text-xs sm:text-sm px-4">প্রতিটি প্যাকেজে
                    পাচ্ছেন আমাদের সেরা তিনটি ঐতিহ্যবাহী আচারের স্বাদ</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">

                    <div
                        class="bg-orange-50/60 p-5 sm:p-8 rounded-2xl shadow-sm border border-orange-100/50 text-center hover:shadow-md transition duration-300 flex flex-col justify-between">
                        <div>
                            <img src="https://picsum.photos/400/400?random=12" alt="Mango Pickle"
                                class="rounded-xl mb-4 sm:mb-6 w-full object-cover aspect-square shadow-sm">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900">Mango Pickle</h3>
                            <p class="text-gray-600 mt-2 text-xs sm:text-sm">ঝাল-মশলাদার আসল দেশি স্বাদ</p>
                        </div>
                    </div>

                    <div
                        class="bg-yellow-50/60 p-5 sm:p-8 rounded-2xl shadow-sm border border-yellow-100/50 text-center hover:shadow-md transition duration-300 flex flex-col justify-between">
                        <div>
                            <img src="https://picsum.photos/400/400?random=13" alt="Mixed Veg Pickle"
                                class="rounded-xl mb-4 sm:mb-6 w-full object-cover aspect-square shadow-sm">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900">Mixed Veg</h3>
                            <p class="text-gray-600 mt-2 text-xs sm:text-sm">সবজি ও মশলার পারফেক্ট ব্লেন্ড</p>
                        </div>
                    </div>

                    <div
                        class="bg-red-50/60 p-5 sm:p-8 rounded-2xl shadow-sm border border-red-100/50 text-center hover:shadow-md transition duration-300 sm:col-span-2 lg:col-span-1 flex flex-col justify-between sm:max-w-md sm:mx-auto lg:max-w-none lg:w-full">
                        <div>
                            <img src="https://picsum.photos/400/400?random=14" alt="Lime Pickle"
                                class="rounded-xl mb-4 sm:mb-6 w-full object-cover aspect-square shadow-sm">
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900">Lime Pickle</h3>
                            <p class="text-gray-600 mt-2 text-xs sm:text-sm">টক-ঝাল লেবুর স্পেশাল</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- WHY BUY FROM US -->
        <section class="py-12 sm:py-24 bg-gradient-to-b from-orange-50/50 to-yellow-50/50 relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <h2 class="text-2xl sm:text-4xl font-extrabold text-center text-gray-900 mb-4">
                    কেন এটি আমাদের থেকে কিনবেন?
                </h2>

                <p class="text-center text-gray-600 max-w-2xl mx-auto mb-10 text-xs sm:text-sm px-2">
                    আমরা শুধু আচার বিক্রি করি না — আমরা ঘরোয়া স্বাদ, বিশ্বাস এবং মানের প্রতিশ্রুতি দেই। প্রতিটি জার
                    হাতে তৈরি, স্বাস্থ্যকর এবং প্রিমিয়াম প্যাকেজিং এ সরবরাহ করা হয়।
                </p>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 lg:gap-8">

                    <div
                        class="bg-white p-3 sm:p-6 rounded-2xl shadow-sm border border-orange-100 text-center transition duration-300">
                        <div class="text-2xl sm:text-4xl mb-2">🥭</div>
                        <h3 class="font-bold text-[11px] sm:text-base text-gray-900">100% Authentic Taste</h3>
                        <p class="text-gray-500 text-[10px] sm:text-xs mt-1">ঘরোয়া রেসিপি ও খাঁটি স্বাদ</p>
                    </div>

                    <div
                        class="bg-white p-3 sm:p-6 rounded-2xl shadow-sm border border-orange-100 text-center transition duration-300">
                        <div class="text-2xl sm:text-4xl mb-2">🛡</div>
                        <h3 class="font-bold text-[11px] sm:text-base text-gray-900">No Preservatives</h3>
                        <p class="text-gray-500 text-[10px] sm:text-xs mt-1">কোনো কৃত্রিম উপাদান নয়</p>
                    </div>

                    <div
                        class="bg-white p-3 sm:p-6 rounded-2xl shadow-sm border border-orange-100 text-center transition duration-300">
                        <div class="text-2xl sm:text-4xl mb-2">🚚</div>
                        <h3 class="font-bold text-[11px] sm:text-base text-gray-900">Fast Delivery</h3>
                        <p class="text-gray-500 text-[10px] sm:text-xs mt-1">দ্রুত ও নিরাপদ ডেলিভারি</p>
                    </div>

                    <div
                        class="bg-white p-3 sm:p-6 rounded-2xl shadow-sm border border-orange-100 text-center transition duration-300">
                        <div class="text-2xl sm:text-4xl mb-2">💯</div>
                        <h3 class="font-bold text-[11px] sm:text-base text-gray-900">Satisfaction</h3>
                        <p class="text-gray-500 text-[10px] sm:text-xs mt-1">৭ দিনের গ্যারান্টি</p>
                    </div>

                </div>
            </div>
        </section>

        <!-- 📸 Gallery -->
        <section id="gallery"
            class="py-12 sm:py-24 bg-gradient-to-r from-orange-100/70 to-yellow-100/70 relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl sm:text-4xl font-extrabold text-center text-gray-900 mb-8">Real Product Shots</h2>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                    <img src="https://picsum.photos/400/400?random=21" alt="Pickle close shot"
                        class="rounded-xl sm:rounded-2xl shadow-md w-full object-cover aspect-square">
                    <img src="https://picsum.photos/400/400?random=22" alt="Achar process"
                        class="rounded-xl sm:rounded-2xl shadow-md w-full object-cover aspect-square">
                    <img src="https://picsum.photos/400/400?random=23" alt="Premium Jar Packaging"
                        class="rounded-xl sm:rounded-2xl shadow-md w-full object-cover aspect-square">
                    <img src="https://picsum.photos/400/400?random=24" alt="Spices mix"
                        class="rounded-xl sm:rounded-2xl shadow-md w-full object-cover aspect-square">
                </div>
            </div>
        </section>

        <!-- FREE DELIVERY SECTION -->
        <section class="py-12 sm:py-16 bg-orange-600 text-white text-center shadow-inner relative overflow-hidden z-10">
            <div
                class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]">
            </div>
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                <h2 class="text-2xl sm:text-4xl font-extrabold mb-3">
                    🚚 ফ্রি ডেলিভারি অফার!
                </h2>

                <p class="text-sm sm:text-lg mb-6 max-w-xl mx-auto text-orange-50 px-2">
                    ৳৮০০ টাকার বেশি অর্ডার করলেই সারা বাংলাদেশে সম্পূর্ণ ফ্রি ডেলিভারি সুবিধা উপভোগ করুন।
                </p>

                <a href="#checkout"
                    class="inline-block px-8 py-4 bg-white text-orange-600 font-bold rounded-full hover:bg-orange-50 active:scale-95 transform transition duration-200 shadow-lg text-sm sm:text-base">
                    Order Now & Get Free Delivery
                </a>

            </div>
        </section>

        <!-- ⭐ Reviews -->
        <section class="py-12 sm:py-24 bg-white relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl sm:text-4xl font-extrabold text-center text-gray-900 mb-8">Customer Reviews</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                    <div
                        class="bg-orange-50/50 p-5 rounded-2xl border border-orange-100/60 shadow-sm flex flex-col justify-between">
                        <p class="text-gray-700 italic text-xs sm:text-sm">“এক কথায় অসাধারণ! প্যাকেজিং থেকে শুরু করে
                            আচারের ভেতরের মশলার ভারসাম্য—সব ঠিকঠাক ছিল।”</p>
                        <div
                            class="mt-4 font-bold text-gray-900 flex items-center justify-between border-t border-orange-100/50 pt-2 text-xs">
                            <span>— Rumana</span>
                            <span class="text-amber-500">⭐⭐⭐⭐⭐</span>
                        </div>
                    </div>
                    <div
                        class="bg-yellow-50/50 p-5 rounded-2xl border border-yellow-100/60 shadow-sm flex flex-col justify-between">
                        <p class="text-gray-700 italic text-xs sm:text-sm">“Packaging খুব ভালো ছিল। লিক হওয়ার কোনো ভয়
                            নেই। মিক্সড ভেজ আচারটা আমার বেশি পছন্দ হয়েছে।”</p>
                        <div
                            class="mt-4 font-bold text-gray-900 flex items-center justify-between border-t border-yellow-100/50 pt-2 text-xs">
                            <span>— Sabbir</span>
                            <span class="text-amber-500">⭐⭐⭐⭐⭐</span>
                        </div>
                    </div>
                    <div
                        class="bg-red-50/50 p-5 rounded-2xl border border-red-100/60 shadow-sm flex flex-col justify-between">
                        <p class="text-gray-700 italic text-xs sm:text-sm">“স্বাদ একদম ঘরোয়া। একদম নানি-দাদিদের হাতের
                            তৈরি আচারের স্মৃতির কথা মনে করিয়ে দেয়।”</p>
                        <div
                            class="mt-4 font-bold text-gray-900 flex items-center justify-between border-t border-red-100/50 pt-2 text-xs">
                            <span>— Mitu</span>
                            <span class="text-amber-500">⭐⭐⭐⭐⭐</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CHECKOUT SECTION -->
        <section id="checkout"
            class="py-12 sm:py-24 bg-gradient-to-b from-orange-50/60 to-yellow-50/60 border-t border-orange-100 relative z-10"
            x-data="checkoutSystem()">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                <h2 class="text-xl sm:text-3xl font-extrabold mb-8 text-center text-gray-900">
                    আপনার তথ্য দিন এবং অর্ডার সম্পূর্ণ করুন
                </h2>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10">

                    <!-- ================= LEFT SIDE FORM ================= -->
                    <div
                        class="bg-white p-5 sm:p-8 rounded-2xl shadow-xl border border-orange-100/40 lg:col-span-7 order-1">

                        <h3 class="text-base sm:text-xl font-bold text-gray-900 mb-4 sm:mb-6 flex items-center gap-2">
                            <span class="p-1.5 bg-orange-100 text-orange-600 rounded-lg text-xs sm:text-sm">📋</span>
                            গ্রাহক তথ্য
                        </h3>

                        <form class="space-y-4" @submit.prevent="alert('অর্ডার সফলভাবে গ্রহণ করা হয়েছে!')">

                            <div>
                                <label class="block text-[11px] font-semibold text-gray-600 mb-1">আপনার নাম *</label>
                                <input type="text" placeholder="যেমন: মো: আরিফ হোসেন"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition text-[16px]"
                                    required>
                            </div>

                            <div>
                                <label class="block text-[11px] font-semibold text-gray-600 mb-1">মোবাইল নম্বর
                                    *</label>
                                <input type="tel" placeholder="যেমন: 017XXXXXXXX"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition text-[16px]"
                                    required>
                            </div>

                            <div>
                                <label class="block text-[11px] font-semibold text-gray-600 mb-1">ইমেইল এড্রেস
                                    (ঐচ্ছিক)</label>
                                <input type="email" placeholder="arif@example.com"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition text-[16px]">
                            </div>

                            <div>
                                <label class="block text-[11px] font-semibold text-gray-600 mb-1">পুরো ঠিকানা *</label>
                                <textarea rows="3" placeholder="গ্রাম/রোড, থানা, জেলা উল্লেখ করুন"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition text-[16px]"
                                    required></textarea>
                            </div>

                            <div class="border border-orange-200 rounded-xl p-3 bg-orange-50/40">
                                <label class="flex items-center gap-3 cursor-pointer select-none">
                                    <input type="radio" checked
                                        class="w-4 h-4 text-orange-600 focus:ring-orange-500 border-gray-300">
                                    <span class="font-semibold text-gray-800 text-xs sm:text-base">ক্যাশ অন
                                        ডেলিভারি</span>
                                </label>
                            </div>

                            <div>
                                <label class="block text-[11px] font-semibold text-gray-600 mb-1">অর্ডার নোট
                                    (ঐচ্ছিক)</label>
                                <textarea rows="2" placeholder="ডেলিভারি সংক্রান্ত অনুরোধ থাকলে লিখুন..."
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition text-[16px]"></textarea>
                            </div>

                            <label class="flex items-start gap-2 text-xs sm:text-sm cursor-pointer py-1 text-gray-600">
                                <input type="checkbox" required
                                    class="mt-0.5 rounded text-orange-600 focus:ring-orange-500 border-gray-300">
                                <span>আমি শর্তাবলী এবং প্রাইভেসি পলিসি মেনে অর্ডার দিচ্ছি</span>
                            </label>

                            <button type="submit" :disabled="qty < 1"
                                class="w-full bg-orange-600 text-white py-4 rounded-xl font-bold hover:bg-orange-700 active:scale-98 transform transition disabled:bg-gray-400 disabled:cursor-not-allowed text-sm sm:text-lg shadow-md">
                                অর্ডার কনফার্ম করুন — ৳<span x-text="finalTotal"></span>
                            </button>

                        </form>
                    </div>


                    <!-- ================= RIGHT SIDE ORDER SUMMARY ================= -->
                    <div
                        class="bg-white p-5 sm:p-8 rounded-2xl shadow-xl border border-orange-100/40 lg:col-span-5 flex flex-col justify-between order-2">
                        <div>
                            <h3
                                class="text-base sm:text-xl font-bold text-gray-900 mb-4 sm:mb-6 flex items-center gap-2">
                                <span
                                    class="p-1.5 bg-orange-100 text-orange-600 rounded-lg text-xs sm:text-sm">🛒</span>
                                অর্ডার সামারি
                            </h3>

                            <!-- Empty Cart UI -->
                            <div class="text-center py-6" x-show="qty < 1">
                                <p class="text-gray-400 text-base mb-2">আপনার কার্ট খালি!</p>
                                <button @click="qty = 1"
                                    class="text-orange-600 font-bold text-xs hover:underline">পণ্য যোগ করুন</button>
                            </div>

                            <!-- Product Item Block -->
                            <div class="bg-gray-50 p-4 rounded-xl mb-4" x-show="qty >= 1">
                                <div class="flex justify-between items-center gap-2">
                                    <div>
                                        <div class="font-bold text-gray-900 text-xs sm:text-base">Desi Achar Combo
                                        </div>
                                        <div class="text-[11px] text-gray-500 mt-0.5">পরিমাণ: <span
                                                class="font-semibold text-gray-700" x-text="qty"></span> টি</div>
                                    </div>
                                    <div class="font-bold text-gray-900 text-sm sm:text-base whitespace-nowrap">
                                        ৳<span x-text="subtotal"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Calculations List -->
                            <div class="space-y-2.5 text-xs sm:text-sm border-t border-gray-100 pt-4">
                                <div class="flex justify-between text-gray-600">
                                    <span>সাবটোটাল:</span>
                                    <span class="font-medium text-gray-900">৳ <span x-text="subtotal"></span></span>
                                </div>

                                <div class="flex justify-between text-gray-600">
                                    <span>ডেলিভারি চার্জ:</span>
                                    <span class="font-medium text-gray-900"
                                        x-text="delivery === 0 ? 'ফ্রি' : '৳ ' + delivery"></span>
                                </div>

                                <div class="flex justify-between text-green-600 font-medium">
                                    <span>ডিসকাউন্ট:</span>
                                    <span>- ৳ <span x-text="discount"></span></span>
                                </div>
                            </div>

                            <div class="my-4 border-t border-dashed border-gray-200"></div>

                            <div class="flex justify-between font-extrabold text-base sm:text-xl text-gray-900">
                                <span>মোট পরিশোধ:</span>
                                <span class="text-orange-600">৳ <span x-text="finalTotal"></span></span>
                            </div>

                            <!-- Promotion Alerts -->
                            <div class="mt-4 space-y-2">
                                <div
                                    class="p-3 bg-orange-50 text-orange-800 rounded-xl text-[11px] sm:text-xs font-medium">
                                    🎁 ২০০০ টাকার বেশি অর্ডারে ১০% ইন্সট্যান্ট ডিসকাউন্ট!
                                </div>
                                <div class="p-3 bg-emerald-50 text-emerald-800 rounded-xl text-[11px] sm:text-xs font-medium"
                                    x-show="subtotal > 0 && subtotal < 800">
                                    💡 আর মাত্র ৳<span x-text="800 - subtotal"></span> টাকার অর্ডার করলেই ফ্রি
                                    ডেলিভারি!
                                </div>
                            </div>
                        </div>

                        <!-- Quantity Controls -->
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <div class="text-[11px] sm:text-xs font-bold text-gray-700 mb-2">পণ্যের পরিমাণ পরিবর্তন
                                করুন:</div>

                            <div class="flex items-center gap-3">
                                <button type="button" @click="decrease()"
                                    class="w-10 h-10 sm:w-12 sm:h-12 bg-orange-100 text-orange-600 font-bold rounded-xl hover:bg-orange-200 transition text-lg flex items-center justify-center select-none">−</button>
                                <input type="number" min="0" x-model.number="qty"
                                    class="w-14 h-10 sm:w-16 sm:h-12 text-center border border-gray-300 rounded-xl font-bold text-base focus:outline-none focus:border-orange-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                <button type="button" @click="increase()"
                                    class="w-10 h-10 sm:w-12 sm:h-12 bg-orange-600 text-white font-bold rounded-xl hover:bg-orange-700 transition text-lg flex items-center justify-center select-none">+</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-6 text-center text-gray-500 text-xs border-t border-orange-100 bg-white relative z-10">
            © 2026 Desi Achar Premium Combo — All Rights Reserved
        </footer>

    </main>

    <script>
        function checkoutSystem() {
            return {
                price: 420,
                qty: 1,
                delivery: 110,

                init() {
                    this.$watch('subtotal', value => {
                        if (value >= 800 || value === 0) {
                            this.delivery = 0;
                        } else {
                            this.delivery = 110;
                        }
                    });
                },

                get subtotal() {
                    return this.price * (parseInt(this.qty) || 0);
                },

                get discount() {
                    if (this.subtotal >= 2000) {
                        return Math.round(this.subtotal * 0.10);
                    }
                    return 0;
                },

                get finalTotal() {
                    const total = this.subtotal + this.delivery - this.discount;
                    return total > 0 ? total : 0;
                },

                increase() {
                    this.qty = (parseInt(this.qty) || 0) + 1;
                },
                decrease() {
                    if (this.qty > 0) {
                        this.qty = (parseInt(this.qty) || 0) - 1;
                    }
                }
            }
        }
    </script>
</body>

</html>
