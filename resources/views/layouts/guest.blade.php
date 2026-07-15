<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Eco Track</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            height: 100vh;
            width: 100%;
            overflow: hidden;
            color: #0f172a;
        }

        /* ========= LEFT HERO PANEL ========= */
        .hero-panel {
            background: linear-gradient(145deg, #059669 0%, #10b981 35%, #0d9488 70%, #0f766e 100%);
            position: relative;
            overflow: hidden;
            height: 100vh;
        }

        /* Decorative circles */
        .hero-panel::before {
            content: '';
            position: absolute;
            top: -25%;
            right: -15%;
            width: 70%;
            height: 70%;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero-panel::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -20%;
            width: 60%;
            height: 60%;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Dot grid overlay */
        .dot-grid {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255,255,255,0.08) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }

        /* Firefly / kunang-kunang particles */
        @keyframes firefly {
            0% { transform: translateY(0) translateX(0) scale(0.3); opacity: 0; filter: blur(0px); }
            15% { opacity: 1; filter: blur(1px); }
            50% { transform: translateY(-80px) translateX(20px) scale(1.2); opacity: 0.9; filter: blur(0px); }
            85% { opacity: 1; filter: blur(1px); }
            100% { transform: translateY(-160px) translateX(-10px) scale(0.4); opacity: 0; filter: blur(2px); }
        }
        .firefly {
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            pointer-events: none;
            animation: firefly 6s ease-in-out infinite;
            box-shadow: 0 0 12px 4px rgba(16, 185, 129, 0.6),
                        0 0 30px 10px rgba(16, 185, 129, 0.2);
            background: radial-gradient(circle, #ffffff 0%, #a7f3d0 40%, #10b981 100%);
        }
        .firefly:nth-child(odd) {
            width: 5px;
            height: 5px;
            box-shadow: 0 0 10px 3px rgba(16, 185, 129, 0.5),
                        0 0 25px 8px rgba(16, 185, 129, 0.15);
            background: radial-gradient(circle, #ffffff 0%, #a7f3d0 50%, #34d399 100%);
        }
        .firefly:nth-child(3n) {
            width: 7px;
            height: 7px;
            box-shadow: 0 0 15px 5px rgba(110, 231, 183, 0.7),
                        0 0 35px 12px rgba(110, 231, 183, 0.25);
            background: radial-gradient(circle, #ffffff 0%, #ecfdf5 30%, #6ee7b7 100%);
        }

        /* ========= RIGHT FORM PANEL ========= */
        .form-panel {
            height: 100vh;
            background: #ffffff;
            position: relative;
            overflow-y: auto;
        }

        /* Form card */
        .form-container {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
        }

        /* Input styling */
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            color: #0f172a;
            outline: none;
        }
        .form-input:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16,185,129,0.1);
            background: #ffffff;
        }
        .form-input:hover:not(:focus) {
            border-color: #cbd5e1;
            background: #ffffff;
        }
        .form-input::placeholder {
            color: #94a3b8;
        }

        /* Button */
        .btn-primary-custom {
            background: linear-gradient(135deg, #059669, #10b981);
            transition: all 0.3s ease;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.875rem;
            color: white;
            width: 100%;
            border: none;
            cursor: pointer;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px -8px rgba(5,150,105,0.4);
        }
        .btn-primary-custom:active {
            transform: translateY(0);
        }

        /* ========= ANIMATIONS ========= */
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.92); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .anim-left { animation: fadeInLeft 0.7s ease-out forwards; opacity: 0; }
        .anim-right { animation: fadeInRight 0.7s ease-out forwards; opacity: 0; }
        .anim-up { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        .anim-scale { animation: fadeInScale 0.6s ease-out forwards; opacity: 0; }
        .anim-slide { animation: slideUp 0.8s ease-out forwards; opacity: 0; }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }
        .delay-6 { animation-delay: 0.6s; }
        .delay-7 { animation-delay: 0.7s; }
        .delay-8 { animation-delay: 0.8s; }

        /* Hide scrollbar */
        ::-webkit-scrollbar { display: none; }

        /* Responsive: di mobile, panel kiri tetap kecil dan form full */
        @media (max-width: 1023px) {
            body { overflow-y: auto; }
            .hero-panel { height: auto; min-height: 40vh; }
            .form-panel { height: auto; min-height: 60vh; }
        }
    </style>
    @yield('styles')
</head>
<body>
    @yield('content')

    <script>
        // Firefly / kunang-kunang effect di hero panel
        (function() {
            const panel = document.querySelector('.hero-panel');
            if (!panel) return;
            for (let i = 0; i < 20; i++) {
                const p = document.createElement('div');
                p.className = 'firefly';
                p.style.left = (5 + Math.random() * 90) + '%';
                p.style.bottom = (5 + Math.random() * 70) + '%';
                p.style.animationDelay = (Math.random() * 10) + 's';
                p.style.animationDuration = (5 + Math.random() * 5) + 's';
                panel.appendChild(p);
            }
        })();
    </script>
    @yield('scripts')
</body>
</html>