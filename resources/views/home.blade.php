<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElitePro | Advanced Certification Platform</title>
    <meta name="description" content="ElitePro - The ultimate professional certification platform with AI-powered learning, advanced analytics, and personalized coaching.">
    
    <!-- PWA Meta -->
    <meta name="theme-color" content="#6366f1">
    <link rel="manifest" href="/manifest.json">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* ========== ELITE DESIGN SYSTEM ========== */
        :root {
            /* Primary Colors */
            --primary-50: #eef2ff;
            --primary-100: #e0e7ff;
            --primary-200: #c7d2fe;
            --primary-300: #a5b4fc;
            --primary-400: #818cf8;
            --primary-500: #6366f1;
            --primary-600: #4f46e5;
            --primary-700: #4338ca;
            --primary-800: #3730a3;
            --primary-900: #312e81;
            
            /* Gradient Colors */
            --gradient-1: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
            --gradient-2: linear-gradient(135deg, #06b6d4 0%, #3b82f6 50%, #6366f1 100%);
            --gradient-glass: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            
            /* Dark Theme (Default) */
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --bg-glass: rgba(30, 41, 59, 0.7);
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --text-tertiary: #94a3b8;
            --border-color: rgba(148, 163, 184, 0.2);
            --shadow-color: rgba(0, 0, 0, 0.3);
            --card-bg: rgba(30, 41, 59, 0.5);
            
            /* Effects */
            --glass-blur: blur(20px);
            --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.3);
            --shadow-xl: 0 25px 80px rgba(0, 0, 0, 0.4);
            
            /* Spacing */
            --radius-sm: 8px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-xl: 32px;
            --radius-full: 9999px;
            
            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-base: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 500ms cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .light {
            /* Light Theme */
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            --bg-glass: rgba(255, 255, 255, 0.7);
            --text-primary: #1e293b;
            --text-secondary: #475569;
            --text-tertiary: #64748b;
            --border-color: rgba(148, 163, 184, 0.15);
            --shadow-color: rgba(0, 0, 0, 0.08);
            --card-bg: rgba(255, 255, 255, 0.7);
        }
        
        /* ========== BASE STYLES ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            overflow-x: hidden;
            transition: background-color var(--transition-base);
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            line-height: 1.2;
        }
        
        a {
            text-decoration: none;
            color: inherit;
            transition: color var(--transition-fast);
        }
        
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        
        /* ========== GLASS EFFECTS ========== */
        .glass {
            background: var(--bg-glass);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border: 1px solid var(--border-color);
            box-shadow: 0 8px 32px var(--shadow-color);
        }
        
        .glass-card {
            background: linear-gradient(
                135deg,
                rgba(255, 255, 255, 0.1) 0%,
                rgba(255, 255, 255, 0.05) 100%
            );
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
        }
        
        /* ========== ANIMATIONS ========== */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-pulse-slow {
            animation: pulse 3s ease-in-out infinite;
        }
        
        .animate-in {
            animation: slideInUp 0.6s ease-out;
        }
        
        /* ========== NAVBAR ========== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 1rem 0;
            transition: all var(--transition-base);
        }
        
        .navbar.scrolled {
            background: var(--bg-glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            padding: 0.75rem 0;
        }
        
        .nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 800;
            font-size: 1.5rem;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .logo-icon {
            width: 36px;
            height: 36px;
            background: var(--gradient-1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-link {
            font-weight: 500;
            position: relative;
            padding: 0.5rem 0;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-1);
            transition: width var(--transition-base);
        }
        
        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
        
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        /* ========== BUTTONS ========== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-full);
            font-weight: 600;
            font-size: 0.95rem;
            transition: all var(--transition-base);
            cursor: pointer;
            border: none;
            outline: none;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary {
            background: var(--gradient-1);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }
        
        .btn-secondary {
            background: transparent;
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }
        
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--primary-500);
        }
        
        .btn-ghost {
            background: transparent;
            color: var(--text-primary);
        }
        
        .btn-ghost:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left var(--transition-slow);
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        /* ========== HERO SECTION ========== */
        .hero {
            min-height: 100vh;
            padding-top: 100px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }
        
        .hero-bg-gradient {
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 50%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                       radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                       radial-gradient(circle at 40% 80%, rgba(6, 182, 212, 0.1) 0%, transparent 50%);
        }
        
        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        
        .hero-content h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, var(--text-primary), var(--primary-400));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .hero-content p {
            font-size: 1.25rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
            max-width: 600px;
        }
        
        .hero-stats {
            display: flex;
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: block;
            line-height: 1;
        }
        
        .stat-label {
            font-size: 0.875rem;
            color: var(--text-tertiary);
            margin-top: 0.5rem;
        }
        
        .hero-visual {
            position: relative;
        }
        
        .dashboard-preview {
            position: relative;
            background: var(--card-bg);
            border-radius: var(--radius-xl);
            padding: 1.5rem;
            box-shadow: var(--shadow-xl);
            transform-style: preserve-3d;
            transform: perspective(1000px) rotateY(-10deg) rotateX(5deg);
        }
        
        .dashboard-preview::before {
            content: '';
            position: absolute;
            inset: -1px;
            background: var(--gradient-1);
            border-radius: inherit;
            z-index: -1;
            opacity: 0.3;
            filter: blur(10px);
        }
        
        /* ========== FEATURES SECTION ========== */
        .section {
            padding: 6rem 0;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }
        
        .section-title {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
        }
        
        .section-subtitle {
            font-size: 1.125rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 0 auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            padding: 2rem;
            border-radius: var(--radius-lg);
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            transition: all var(--transition-base);
            position: relative;
            overflow: hidden;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary-500);
            box-shadow: var(--shadow-lg);
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-1);
            opacity: 0;
            transition: opacity var(--transition-base);
        }
        
        .feature-card:hover::before {
            opacity: 1;
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--radius-md);
            background: rgba(99, 102, 241, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            color: var(--primary-500);
        }
        
        .feature-title {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            font-weight: 700;
        }
        
        .feature-description {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }
        
        /* ========== STATS SECTION ========== */
        .stats-section {
            background: var(--gradient-2);
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            text-align: center;
        }
        
        .stat-card {
            padding: 2rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* ========== PRICING SECTION ========== */
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .pricing-card {
            padding: 2.5rem;
            border-radius: var(--radius-xl);
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            position: relative;
            transition: all var(--transition-base);
        }
        
        .pricing-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }
        
        .pricing-card.featured {
            border-color: var(--primary-500);
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), transparent);
        }
        
        .pricing-badge {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--gradient-1);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: var(--radius-full);
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .pricing-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        
        .pricing-price {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .pricing-features {
            list-style: none;
            margin: 2rem 0;
        }
        
        .pricing-features li {
            padding: 0.5rem 0;
            color: var(--text-secondary);
            position: relative;
            padding-left: 1.75rem;
        }
        
        .pricing-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary-500);
            font-weight: bold;
        }
        
        /* ========== TESTIMONIALS ========== */
        .testimonials-slider {
            display: flex;
            gap: 2rem;
            overflow-x: auto;
            padding: 1rem 0;
            scrollbar-width: none;
        }
        
        .testimonial-card {
            min-width: 350px;
            padding: 2rem;
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
        }
        
        .testimonial-text {
            font-style: italic;
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            font-size: 1.125rem;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .author-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--gradient-1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        /* ========== CTA SECTION ========== */
        .cta-section {
            text-align: center;
            padding: 6rem 0;
            background: radial-gradient(circle at center, rgba(99, 102, 241, 0.1) 0%, transparent 50%);
        }
        
        .cta-title {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        /* ========== FOOTER ========== */
        .footer {
            padding: 4rem 0 2rem;
            border-top: 1px solid var(--border-color);
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr repeat(3, 1fr);
            gap: 4rem;
            margin-bottom: 3rem;
        }
        
        .footer-logo {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            display: inline-block;
        }
        
        .footer-description {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
        }
        
        .footer-links h4 {
            font-size: 1rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .footer-links ul {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 0.5rem;
        }
        
        .footer-links a {
            color: var(--text-secondary);
            transition: color var(--transition-fast);
        }
        
        .footer-links a:hover {
            color: var(--primary-500);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
            color: var(--text-tertiary);
            font-size: 0.875rem;
        }
        
        /* ========== THEME TOGGLE ========== */
        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-full);
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all var(--transition-fast);
        }
        
        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        
        /* ========== RESPONSIVE DESIGN ========== */
        @media (max-width: 1024px) {
            .hero-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .hero-content h1 {
                font-size: 2.75rem;
            }
            
            .hero-stats {
                justify-content: center;
            }
            
            .dashboard-preview {
                transform: none;
                max-width: 600px;
                margin: 0 auto;
            }
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }
            
            .hero-content h1 {
                font-size: 2.25rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .nav-links {
                display: none;
            }
            
            .mobile-menu-btn {
                display: block;
            }
        }
        
        /* ========== UTILITY CLASSES ========== */
        .text-gradient {
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .bg-gradient {
            background: var(--gradient-1);
        }
        
        .mt-1 { margin-top: 0.5rem; }
        .mt-2 { margin-top: 1rem; }
        .mt-3 { margin-top: 1.5rem; }
        .mt-4 { margin-top: 2rem; }
        .mt-6 { margin-top: 3rem; }
        .mt-8 { margin-top: 4rem; }
        
        .mb-1 { margin-bottom: 0.5rem; }
        .mb-2 { margin-bottom: 1rem; }
        .mb-3 { margin-bottom: 1.5rem; }
        .mb-4 { margin-bottom: 2rem; }
        .mb-6 { margin-bottom: 3rem; }
        .mb-8 { margin-bottom: 4rem; }
        
        .flex { display: flex; }
        .flex-col { flex-direction: column; }
        .items-center { align-items: center; }
        .justify-center { justify-content: center; }
        .justify-between { justify-content: space-between; }
        .gap-2 { gap: 1rem; }
        .gap-4 { gap: 2rem; }
        .gap-6 { gap: 3rem; }
        
        .text-center { text-align: center; }
        .text-sm { font-size: 0.875rem; }
        .text-lg { font-size: 1.125rem; }
        .text-xl { font-size: 1.25rem; }
        .text-2xl { font-size: 1.5rem; }
        .text-3xl { font-size: 1.875rem; }
        .text-4xl { font-size: 2.25rem; }
        .text-5xl { font-size: 3rem; }
        
        .hidden { display: none; }
        @media (min-width: 768px) {
            .md-flex { display: flex; }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar glass">
        <div class="container nav-container">
            <a href="/" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                ElitePro
            </a>
            
            <div class="nav-links">
                <a href="#features" class="nav-link">Features</a>
                <a href="#how-it-works" class="nav-link">How It Works</a>
                <a href="#pricing" class="nav-link">Pricing</a>
                <a href="#testimonials" class="nav-link">Testimonials</a>
                <a href="#faq" class="nav-link">FAQ</a>
            </div>
            
            <div class="nav-actions">
                <a href="/login" class="btn btn-ghost">Sign In</a>
                <a href="/register" class="btn btn-primary">Get Started</a>
                <button class="theme-toggle" id="themeToggle">
                    <i class="fas fa-moon"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-bg">
            <div class="hero-bg-gradient"></div>
            <div class="floating-orb orb-1 animate-float" style="position: absolute; top: 20%; left: 10%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(99, 102, 241, 0.2) 0%, transparent 70%); border-radius: 50%;"></div>
            <div class="floating-orb orb-2 animate-float" style="position: absolute; bottom: 20%; right: 10%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%); border-radius: 50%; animation-delay: 2s;"></div>
        </div>
        
        <div class="container">
            <div class="hero-grid">
                <div class="hero-content animate-in">
                    <h1>Master Professional Certifications with AI-Powered Learning</h1>
                    <p>Join 50,000+ professionals who've accelerated their careers with our intelligent learning platform. Get personalized study plans, real-time analytics, and expert mentorship.</p>
                    
                    <div class="flex gap-4 mb-6">
                        <a href="/register" class="btn btn-primary">
                            <i class="fas fa-rocket"></i>
                            Start Free Trial
                        </a>
                        <a href="#demo" class="btn btn-secondary">
                            <i class="fas fa-play"></i>
                            Watch Demo
                        </a>
                    </div>
                    
                    <div class="hero-stats">
                        <div class="stat-item">
                            <span class="stat-number">94%</span>
                            <span class="stat-label">Pass Rate</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">50K+</span>
                            <span class="stat-label">Professionals</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">24/7</span>
                            <span class="stat-label">AI Support</span>
                        </div>
                    </div>
                </div>
                
                <div class="hero-visual">
                    <div class="dashboard-preview">
                        <div style="background: var(--bg-secondary); border-radius: var(--radius-lg); padding: 1rem;">
                            <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                                <div style="width: 60px; height: 60px; background: var(--gradient-1); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; color: white;">
                                    <i class="fas fa-brain"></i>
                                </div>
                                <div>
                                    <h4 style="margin-bottom: 0.25rem;">AI Learning Assistant</h4>
                                    <p style="color: var(--text-tertiary); font-size: 0.875rem;">Personalized study recommendations</p>
                                </div>
                            </div>
                            <div style="background: var(--bg-primary); border-radius: var(--radius-md); padding: 1rem;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                                    <span>Progress Today</span>
                                    <span class="text-gradient">85%</span>
                                </div>
                                <div style="height: 8px; background: var(--bg-tertiary); border-radius: 4px; overflow: hidden;">
                                    <div style="width: 85%; height: 100%; background: var(--gradient-1);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Everything You Need to Succeed</h2>
                <p class="section-subtitle">Our platform combines cutting-edge technology with proven learning methodologies</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card animate-in">
                    <div class="feature-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3 class="feature-title">AI-Powered Learning</h3>
                    <p class="feature-description">Adaptive learning algorithms that personalize your study plan based on performance and goals.</p>
                </div>
                
                <div class="feature-card animate-in" style="animation-delay: 0.1s;">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Advanced Analytics</h3>
                    <p class="feature-description">Real-time progress tracking with detailed insights and performance predictions.</p>
                </div>
                
                <div class="feature-card animate-in" style="animation-delay: 0.2s;">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="feature-title">Expert Mentorship</h3>
                    <p class="feature-description">1-on-1 sessions with industry experts and certification veterans.</p>
                </div>
                
                <div class="feature-card animate-in" style="animation-delay: 0.3s;">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="feature-title">Mobile Learning</h3>
                    <p class="feature-description">Study anywhere with our iOS and Android apps, featuring offline access.</p>
                </div>
                
                <div class="feature-card animate-in" style="animation-delay: 0.4s;">
                    <div class="feature-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3 class="feature-title">Question Bank</h3>
                    <p class="feature-description">10,000+ practice questions with detailed explanations and rationales.</p>
                </div>
                
                <div class="feature-card animate-in" style="animation-delay: 0.5s;">
                    <div class="feature-icon">
                        <i class="fas fa-video"></i>
                    </div>
                    <h3 class="feature-title">Video Lessons</h3>
                    <p class="feature-description">Comprehensive video tutorials by industry leaders and subject experts.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number" style="color: white;">10K+</div>
                    <div class="stat-label" style="color: rgba(255,255,255,0.9);">Practice Questions</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: white;">500+</div>
                    <div class="stat-label" style="color: rgba(255,255,255,0.9);">Hours of Content</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: white;">98%</div>
                    <div class="stat-label" style="color: rgba(255,255,255,0.9);">Satisfaction Rate</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" style="color: white;">50+</div>
                    <div class="stat-label" style="color: rgba(255,255,255,0.9);">Certifications</div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">How ElitePro Works</h2>
                <p class="section-subtitle">Three simple steps to certification success</p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <div class="text-center">
                    <div style="width: 80px; height: 80px; background: var(--gradient-1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: white; font-size: 1.5rem;">
                        1
                    </div>
                    <h3 style="margin-bottom: 0.75rem;">Assessment</h3>
                    <p style="color: var(--text-secondary);">Take our AI-powered assessment to identify your strengths and knowledge gaps.</p>
                </div>
                
                <div class="text-center">
                    <div style="width: 80px; height: 80px; background: var(--gradient-1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: white; font-size: 1.5rem;">
                        2
                    </div>
                    <h3 style="margin-bottom: 0.75rem;">Personalized Plan</h3>
                    <p style="color: var(--text-secondary);">Receive a customized study plan with daily goals and recommended resources.</p>
                </div>
                
                <div class="text-center">
                    <div style="width: 80px; height: 80px; background: var(--gradient-1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: white; font-size: 1.5rem;">
                        3
                    </div>
                    <h3 style="margin-bottom: 0.75rem;">Track & Excel</h3>
                    <p style="color: var(--text-secondary);">Monitor progress with real-time analytics and adapt your study strategy.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="section" style="background: var(--bg-secondary);">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Simple, Transparent Pricing</h2>
                <p class="section-subtitle">Choose the perfect plan for your certification journey</p>
            </div>
            
            <div class="pricing-grid">
                <div class="pricing-card">
                    <div class="pricing-title">Starter</div>
                    <div class="pricing-price">$29</div>
                    <div style="color: var(--text-tertiary); margin-bottom: 2rem;">per month</div>
                    
                    <ul class="pricing-features">
                        <li>Access to basic courses</li>
                        <li>500+ practice questions</li>
                        <li>Community support</li>
                        <li>Progress tracking</li>
                    </ul>
                    
                    <a href="/register?plan=starter" class="btn btn-secondary" style="width: 100%;">Get Started</a>
                </div>
                
                <div class="pricing-card featured">
                    <div class="pricing-badge">Most Popular</div>
                    <div class="pricing-title">Professional</div>
                    <div class="pricing-price">$79</div>
                    <div style="color: var(--text-tertiary); margin-bottom: 2rem;">per month</div>
                    
                    <ul class="pricing-features">
                        <li>Everything in Starter</li>
                        <li>Full question bank access</li>
                        <li>AI learning assistant</li>
                        <li>Expert mentorship sessions</li>
                        <li>Mobile app access</li>
                    </ul>
                    
                    <a href="/register?plan=professional" class="btn btn-primary" style="width: 100%;">Get Started</a>
                </div>
                
                <div class="pricing-card">
                    <div class="pricing-title">Enterprise</div>
                    <div class="pricing-price">Custom</div>
                    <div style="color: var(--text-tertiary); margin-bottom: 2rem;">contact us</div>
                    
                    <ul class="pricing-features">
                        <li>Everything in Professional</li>
                        <li>Custom content creation</li>
                        <li>Dedicated account manager</li>
                        <li>Team analytics dashboard</li>
                        <li>API access</li>
                    </ul>
                    
                    <a href="/contact" class="btn btn-secondary" style="width: 100%;">Contact Sales</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Trusted by Industry Leaders</h2>
                <p class="section-subtitle">See what professionals say about their ElitePro experience</p>
            </div>
            
            <div class="testimonials-slider">
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "ElitePro's AI-powered learning transformed how I prepared for my PMP certification. I passed on the first attempt!"
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">SJ</div>
                        <div>
                            <div style="font-weight: 600;">Sarah Johnson</div>
                            <div style="color: var(--text-tertiary); font-size: 0.875rem;">Project Manager at TechCorp</div>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "The personalized study plan and expert mentorship were game-changers for my AWS certification journey."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">MR</div>
                        <div>
                            <div style="font-weight: 600;">Michael Rodriguez</div>
                            <div style="color: var(--text-tertiary); font-size: 0.875rem;">Cloud Architect</div>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "As a working professional, the mobile app made it possible to study effectively during my commute."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">ET</div>
                        <div>
                            <div style="font-weight: 600;">Emily Thompson</div>
                            <div style="color: var(--text-tertiary); font-size: 0.875rem;">Data Scientist</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">Ready to Transform Your Career?</h2>
            <p style="font-size: 1.25rem; color: var(--text-secondary); margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                Join thousands of professionals who've accelerated their careers with ElitePro. Start your free trial today.
            </p>
            
            <div class="flex gap-4 justify-center">
                <a href="/register" class="btn btn-primary" style="padding: 1rem 2rem;">
                    <i class="fas fa-rocket"></i>
                    Start Free Trial
                </a>
                <a href="#demo" class="btn btn-secondary" style="padding: 1rem 2rem;">
                    <i class="fas fa-calendar"></i>
                    Book a Demo
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-logo text-gradient">ElitePro</div>
                    <p class="footer-description">
                        The ultimate platform for professional certification preparation. 
                        Powered by AI, driven by results.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="theme-toggle" style="width: 40px; height: 40px;">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="theme-toggle" style="width: 40px; height: 40px;">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="theme-toggle" style="width: 40px; height: 40px;">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
                
                <div class="footer-links">
                    <h4>Product</h4>
                    <ul>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#testimonials">Testimonials</a></li>
                        <li><a href="/demo">Demo</a></li>
                    </ul>
                </div>
                
                <div class="footer-links">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="/about">About</a></li>
                        <li><a href="/careers">Careers</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="/press">Press</a></li>
                    </ul>
                </div>
                
                <div class="footer-links">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="/help">Help Center</a></li>
                        <li><a href="/contact">Contact</a></li>
                        <li><a href="/privacy">Privacy Policy</a></li>
                        <li><a href="/terms">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                © 2024 ElitePro. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = themeToggle.querySelector('i');
        
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('light');
            
            if (document.documentElement.classList.contains('light')) {
                themeIcon.className = 'fas fa-sun';
                localStorage.setItem('theme', 'light');
            } else {
                themeIcon.className = 'fas fa-moon';
                localStorage.setItem('theme', 'dark');
            }
        });
        
        // Set initial theme
        const savedTheme = localStorage.getItem('theme') || 'dark';
        if (savedTheme === 'light') {
            document.documentElement.classList.add('light');
            themeIcon.className = 'fas fa-sun';
        }
        
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const target = document.querySelector(targetId);
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        // Observe animated elements
        document.querySelectorAll('.animate-in').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
        
        // Testimonial slider
        const testimonialSlider = document.querySelector('.testimonials-slider');
        if (testimonialSlider) {
            let isDown = false;
            let startX;
            let scrollLeft;
            
            testimonialSlider.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - testimonialSlider.offsetLeft;
                scrollLeft = testimonialSlider.scrollLeft;
            });
            
            testimonialSlider.addEventListener('mouseleave', () => {
                isDown = false;
            });
            
            testimonialSlider.addEventListener('mouseup', () => {
                isDown = false;
            });
            
            testimonialSlider.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - testimonialSlider.offsetLeft;
                const walk = (x - startX) * 2;
                testimonialSlider.scrollLeft = scrollLeft - walk;
            });
        }
        
        // Plan selection
        document.querySelectorAll('a[href*="plan="]').forEach(link => {
            link.addEventListener('click', function(e) {
                const plan = this.getAttribute('href').split('plan=')[1];
                localStorage.setItem('selectedPlan', plan);
            });
        });
        
        // Initialize animations on page load
        document.addEventListener('DOMContentLoaded', () => {
            // Add loaded class for entrance animations
            document.body.classList.add('loaded');
        });
    </script>
</body>
</html>