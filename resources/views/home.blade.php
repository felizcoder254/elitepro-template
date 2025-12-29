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
    
    <!-- Lottie Animations -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    
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
            --gradient-glow: linear-gradient(45deg, #6366f1, #8b5cf6, #d946ef, #3b82f6);
            
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
            --shadow-glow: 0 0 40px rgba(99, 102, 241, 0.3);
            
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
            --shadow-glow: 0 0 40px rgba(99, 102, 241, 0.15);
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
        
        @keyframes glow {
            0%, 100% { box-shadow: var(--shadow-glow); }
            50% { box-shadow: 0 0 60px rgba(99, 102, 241, 0.5); }
        }
        
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: var(--primary-500) }
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
        
        .animate-glow {
            animation: glow 2s ease-in-out infinite;
        }
        
        .animate-gradient {
            background: linear-gradient(-45deg, #6366f1, #8b5cf6, #d946ef, #3b82f6);
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }
        
        /* ========== PRELOADER ========== */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--bg-primary);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }
        
        .preloader-logo {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 2rem;
            position: relative;
        }
        
        .preloader-logo span {
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            position: relative;
        }
        
        .preloader-logo span::after {
            content: 'ElitePro';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);
            -webkit-background-clip: text;
            background-clip: text;
            animation: shimmer 2s infinite;
        }
        
        .loading-bar {
            width: 200px;
            height: 4px;
            background: var(--bg-tertiary);
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }
        
        .loading-progress {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background: var(--gradient-1);
            border-radius: 2px;
            width: 0;
            transition: width 0.3s ease;
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
            background: transparent;
        }
        
        .navbar.scrolled {
            background: var(--bg-glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            padding: 0.75rem 0;
        }
        
        .navbar.active {
            background: var(--bg-glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
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
            transition: all var(--transition-base);
        }
        
        .logo:hover {
            transform: scale(1.05);
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
            transition: all var(--transition-base);
        }
        
        .logo:hover .logo-icon {
            transform: rotate(15deg);
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }
        
        @media (max-width: 1024px) {
            .nav-links {
                display: none;
            }
        }
        
        .nav-link {
            font-weight: 500;
            position: relative;
            padding: 0.5rem 0;
            cursor: pointer;
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
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }
        
        @media (max-width: 1024px) {
            .mobile-menu-btn {
                display: block;
            }
        }
        
        .mobile-menu {
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            background: var(--bg-glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem;
            display: none;
            flex-direction: column;
            gap: 1rem;
            z-index: 999;
        }
        
        .mobile-menu.active {
            display: flex;
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
            animation: glow 2s ease-in-out infinite;
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
            display: flex;
            align-items: center;
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
            background: 
                radial-gradient(circle at 20% 50%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
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
            position: relative;
        }
        
        .hero-content h1 span {
            background: linear-gradient(to right, var(--text-primary), var(--primary-400));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            position: relative;
            display: inline-block;
        }
        
        .hero-content h1 .typed-text {
            overflow: hidden;
            border-right: 2px solid var(--primary-500);
            white-space: nowrap;
            animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
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
            flex-wrap: wrap;
        }
        
        .stat-item {
            text-align: center;
            padding: 1rem;
            min-width: 120px;
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
            perspective: 1000px;
        }
        
        .dashboard-preview {
            position: relative;
            background: var(--card-bg);
            border-radius: var(--radius-xl);
            padding: 1.5rem;
            box-shadow: var(--shadow-xl);
            transform-style: preserve-3d;
            transform: perspective(1000px) rotateY(-10deg) rotateX(5deg);
            transition: transform var(--transition-base);
            cursor: pointer;
        }
        
        .dashboard-preview:hover {
            transform: perspective(1000px) rotateY(0deg) rotateX(0deg) translateY(-10px);
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
            position: relative;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 4rem;
            position: relative;
        }
        
        .section-title {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--gradient-1);
            border-radius: 2px;
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
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            border-color: var(--primary-500);
            box-shadow: var(--shadow-lg), var(--shadow-glow);
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
            transition: all var(--transition-base);
        }
        
        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            background: rgba(99, 102, 241, 0.2);
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
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.1;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .stat-card {
            padding: 2rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform var(--transition-base);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }
        
        /* ========== HOW IT WORKS ========== */
        .steps-container {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .steps-line {
            position: absolute;
            top: 40px;
            left: 40px;
            right: 40px;
            height: 2px;
            background: var(--gradient-1);
            z-index: 0;
        }
        
        .steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            position: relative;
            z-index: 1;
        }
        
        .step {
            text-align: center;
            position: relative;
        }
        
        .step-number {
            width: 80px;
            height: 80px;
            background: var(--gradient-1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            border: 4px solid var(--bg-primary);
            position: relative;
            transition: transform var(--transition-base);
        }
        
        .step:hover .step-number {
            transform: scale(1.1) rotate(5deg);
        }
        
        .step h3 {
            margin-bottom: 0.75rem;
        }
        
        .step p {
            color: var(--text-secondary);
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
            display: flex;
            flex-direction: column;
        }
        
        .pricing-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl), var(--shadow-glow);
        }
        
        .pricing-card.featured {
            border-color: var(--primary-500);
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), transparent);
            position: relative;
            overflow: hidden;
        }
        
        .pricing-card.featured::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: var(--gradient-glow);
            opacity: 0.1;
            animation: gradient-shift 15s ease infinite;
            pointer-events: none;
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
            z-index: 1;
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
            flex: 1;
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
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            overflow: hidden;
        }
        
        .testimonials-track {
            display: flex;
            gap: 2rem;
            transition: transform 0.5s ease;
        }
        
        .testimonial-card {
            min-width: 350px;
            padding: 2rem;
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            transition: transform var(--transition-base);
        }
        
        .testimonial-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-500);
        }
        
        .testimonial-text {
            font-style: italic;
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            font-size: 1.125rem;
            position: relative;
        }
        
        .testimonial-text::before {
            content: '"';
            font-size: 4rem;
            color: var(--primary-500);
            opacity: 0.2;
            position: absolute;
            top: -20px;
            left: -10px;
            font-family: serif;
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
        
        .slider-nav {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--bg-tertiary);
            border: none;
            cursor: pointer;
            transition: all var(--transition-base);
        }
        
        .slider-dot.active {
            background: var(--primary-500);
            transform: scale(1.2);
        }
        
        /* ========== CTA SECTION ========== */
        .cta-section {
            text-align: center;
            padding: 8rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(99, 102, 241, 0.1) 0%, transparent 50%);
            animation: pulse 4s ease-in-out infinite;
        }
        
        .cta-title {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            position: relative;
        }
        
        /* ========== FOOTER ========== */
        .footer {
            padding: 4rem 0 2rem;
            border-top: 1px solid var(--border-color);
            position: relative;
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
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
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
            display: inline-block;
        }
        
        .footer-links a:hover {
            color: var(--primary-500);
            transform: translateX(5px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
            color: var(--text-tertiary);
            font-size: 0.875rem;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
        }
        
        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--bg-tertiary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
            transition: all var(--transition-base);
        }
        
        .social-link:hover {
            background: var(--primary-500);
            color: white;
            transform: translateY(-3px);
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
            transform: rotate(15deg);
        }
        
        /* ========== MODALS ========== */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .modal.active {
            display: flex;
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        .modal-content {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideInUp 0.3s ease-out;
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }
        
        .modal-close {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-full);
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all var(--transition-fast);
        }
        
        .modal-close:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--danger);
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        /* ========== SCROLL TO TOP ========== */
        .scroll-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gradient-1);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all var(--transition-base);
            z-index: 100;
            box-shadow: var(--shadow-lg);
        }
        
        .scroll-top.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .scroll-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
        }
        
        /* ========== RESPONSIVE DESIGN ========== */
        @media (max-width: 1200px) {
            .hero-grid {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 3rem;
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
            
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 3rem;
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
            
            .cta-title {
                font-size: 2.5rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .steps {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
            
            .steps-line {
                display: none;
            }
            
            .pricing-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .testimonial-card {
                min-width: 100%;
            }
        }
        
        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 1.75rem;
            }
            
            .cta-title {
                font-size: 2rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .btn {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
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
    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="preloader-logo">
            <span>ElitePro</span>
        </div>
        <div class="loading-bar">
            <div class="loading-progress" id="loadingProgress"></div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
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
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobileMenu">
            <a href="#features" class="nav-link">Features</a>
            <a href="#how-it-works" class="nav-link">How It Works</a>
            <a href="#pricing" class="nav-link">Pricing</a>
            <a href="#testimonials" class="nav-link">Testimonials</a>
            <a href="#faq" class="nav-link">FAQ</a>
            <div class="flex gap-2">
                <a href="/login" class="btn btn-ghost" style="flex: 1;">Sign In</a>
                <a href="/register" class="btn btn-primary" style="flex: 1;">Get Started</a>
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
                    <h1>
                        <span>Master Professional Certifications with</span><br>
                        <span class="typed-text">AI-Powered Learning</span>
                    </h1>
                    <p>Join 50,000+ professionals who've accelerated their careers with our intelligent learning platform. Get personalized study plans, real-time analytics, and expert mentorship.</p>
                    
                    <div class="flex gap-4 mb-6 flex-wrap">
                        <a href="/register" class="btn btn-primary">
                            <i class="fas fa-rocket"></i>
                            Start Free Trial
                        </a>
                        <button class="btn btn-secondary" id="watchDemoBtn">
                            <i class="fas fa-play"></i>
                            Watch Demo
                        </button>
                        <a href="#pricing" class="btn btn-ghost">
                            <i class="fas fa-tags"></i>
                            View Plans
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
                        <div class="stat-item">
                            <span class="stat-number">4.9★</span>
                            <span class="stat-label">Rating</span>
                        </div>
                    </div>
                </div>
                
                <div class="hero-visual">
                    <div class="dashboard-preview">
                        <div style="background: var(--bg-secondary); border-radius: var(--radius-lg); padding: 1rem;">
                            <div style="display: flex; gap: 1rem; margin-bottom: 1rem; align-items: center;">
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
                                    <div style="width: 85%; height: 100%; background: var(--gradient-1); transition: width 1s ease;"></div>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-top: 1rem;">
                                    <div>
                                        <div style="font-size: 0.75rem; color: var(--text-tertiary);">Completed</div>
                                        <div style="font-weight: 600;">42 topics</div>
                                    </div>
                                    <div>
                                        <div style="font-size: 0.75rem; color: var(--text-tertiary);">Time Spent</div>
                                        <div style="font-weight: 600;">3h 42m</div>
                                    </div>
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
                <div class="feature-card animate-in" data-delay="0">
                    <div class="feature-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3 class="feature-title">AI-Powered Learning</h3>
                    <p class="feature-description">Adaptive learning algorithms that personalize your study plan based on performance and goals.</p>
                    <div style="margin-top: 1rem;">
                        <span class="text-sm" style="color: var(--primary-500);">Learn more →</span>
                    </div>
                </div>
                
                <div class="feature-card animate-in" data-delay="0.1">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="feature-title">Advanced Analytics</h3>
                    <p class="feature-description">Real-time progress tracking with detailed insights and performance predictions.</p>
                    <div style="margin-top: 1rem;">
                        <span class="text-sm" style="color: var(--primary-500);">Learn more →</span>
                    </div>
                </div>
                
                <div class="feature-card animate-in" data-delay="0.2">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="feature-title">Expert Mentorship</h3>
                    <p class="feature-description">1-on-1 sessions with industry experts and certification veterans.</p>
                    <div style="margin-top: 1rem;">
                        <span class="text-sm" style="color: var(--primary-500);">Learn more →</span>
                    </div>
                </div>
                
                <div class="feature-card animate-in" data-delay="0.3">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="feature-title">Mobile Learning</h3>
                    <p class="feature-description">Study anywhere with our iOS and Android apps, featuring offline access.</p>
                    <div style="margin-top: 1rem;">
                        <span class="text-sm" style="color: var(--primary-500);">Learn more →</span>
                    </div>
                </div>
                
                <div class="feature-card animate-in" data-delay="0.4">
                    <div class="feature-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3 class="feature-title">Question Bank</h3>
                    <p class="feature-description">10,000+ practice questions with detailed explanations and rationales.</p>
                    <div style="margin-top: 1rem;">
                        <span class="text-sm" style="color: var(--primary-500);">Learn more →</span>
                    </div>
                </div>
                
                <div class="feature-card animate-in" data-delay="0.5">
                    <div class="feature-icon">
                        <i class="fas fa-video"></i>
                    </div>
                    <h3 class="feature-title">Video Lessons</h3>
                    <p class="feature-description">Comprehensive video tutorials by industry leaders and subject experts.</p>
                    <div style="margin-top: 1rem;">
                        <span class="text-sm" style="color: var(--primary-500);">Learn more →</span>
                    </div>
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
            
            <div class="steps-container">
                <div class="steps-line"></div>
                <div class="steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h3>Assessment</h3>
                        <p>Take our AI-powered assessment to identify your strengths and knowledge gaps.</p>
                    </div>
                    
                    <div class="step">
                        <div class="step-number">2</div>
                        <h3>Personalized Plan</h3>
                        <p>Receive a customized study plan with daily goals and recommended resources.</p>
                    </div>
                    
                    <div class="step">
                        <div class="step-number">3</div>
                        <h3>Track & Excel</h3>
                        <p>Monitor progress with real-time analytics and adapt your study strategy.</p>
                    </div>
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
                
                <div style="margin-top: 1.5rem;">
                    <div style="display: inline-flex; background: var(--bg-tertiary); padding: 0.25rem; border-radius: var(--radius-full);">
                        <button class="btn btn-ghost" id="monthlyBtn" style="border-radius: var(--radius-full); padding: 0.5rem 1.5rem;">Monthly</button>
                        <button class="btn btn-primary" id="yearlyBtn" style="border-radius: var(--radius-full); padding: 0.5rem 1.5rem;">Yearly (Save 20%)</button>
                    </div>
                </div>
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
                        <li>Mobile app access</li>
                    </ul>
                    
                    <a href="/register?plan=starter" class="btn btn-secondary" style="width: 100%; margin-top: auto;">Get Started</a>
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
                        <li>Priority support</li>
                        <li>Certification guarantee</li>
                    </ul>
                    
                    <a href="/register?plan=professional" class="btn btn-primary" style="width: 100%; margin-top: auto;">Get Started</a>
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
                        <li>White-label solution</li>
                    </ul>
                    
                    <a href="/contact" class="btn btn-secondary" style="width: 100%; margin-top: auto;">Contact Sales</a>
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
                <div class="testimonials-track" id="testimonialsTrack">
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
                    
                    <div class="testimonial-card">
                        <div class="testimonial-text">
                            "The analytics dashboard helped me identify my weak areas and focus my studies more effectively."
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">DR</div>
                            <div>
                                <div style="font-weight: 600;">David Roberts</div>
                                <div style="color: var(--text-tertiary); font-size: 0.875rem;">Cybersecurity Specialist</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="slider-nav" id="sliderNav">
                    <button class="slider-dot active" data-index="0"></button>
                    <button class="slider-dot" data-index="1"></button>
                    <button class="slider-dot" data-index="2"></button>
                    <button class="slider-dot" data-index="3"></button>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <p class="section-subtitle">Everything you need to know about ElitePro</p>
            </div>
            
            <div style="max-width: 800px; margin: 0 auto;">
                <div class="faq-item" style="border-bottom: 1px solid var(--border-color); padding: 1.5rem 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;" class="faq-question">
                        <h3 style="font-size: 1.125rem;">How does the AI learning assistant work?</h3>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer" style="margin-top: 1rem; display: none;">
                        <p style="color: var(--text-secondary);">Our AI analyzes your performance, learning patterns, and goals to create a personalized study plan. It adapts in real-time based on your progress and identifies areas that need more focus.</p>
                    </div>
                </div>
                
                <div class="faq-item" style="border-bottom: 1px solid var(--border-color); padding: 1.5rem 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;" class="faq-question">
                        <h3 style="font-size: 1.125rem;">Can I access ElitePro on mobile?</h3>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer" style="margin-top: 1rem; display: none;">
                        <p style="color: var(--text-secondary);">Yes! We have iOS and Android apps that sync with your web progress. You can study offline and pick up right where you left off.</p>
                    </div>
                </div>
                
                <div class="faq-item" style="border-bottom: 1px solid var(--border-color); padding: 1.5rem 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;" class="faq-question">
                        <h3 style="font-size: 1.125rem;">What certifications do you support?</h3>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer" style="margin-top: 1rem; display: none;">
                        <p style="color: var(--text-secondary);">We support 50+ certifications across IT, project management, cybersecurity, cloud computing, and more. Check our full list on the certifications page.</p>
                    </div>
                </div>
                
                <div class="faq-item" style="border-bottom: 1px solid var(--border-color); padding: 1.5rem 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;" class="faq-question">
                        <h3 style="font-size: 1.125rem;">Is there a free trial available?</h3>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer" style="margin-top: 1rem; display: none;">
                        <p style="color: var(--text-secondary);">Yes! We offer a 14-day free trial with full access to all features. No credit card required to start.</p>
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
            
            <div class="flex gap-4 justify-center flex-wrap">
                <a href="/register" class="btn btn-primary" style="padding: 1rem 2rem;">
                    <i class="fas fa-rocket"></i>
                    Start Free Trial
                </a>
                <button class="btn btn-secondary" id="bookDemoBtn" style="padding: 1rem 2rem;">
                    <i class="fas fa-calendar"></i>
                    Book a Demo
                </button>
                <a href="/contact" class="btn btn-ghost" style="padding: 1rem 2rem;">
                    <i class="fas fa-comment"></i>
                    Contact Sales
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-logo">ElitePro</div>
                    <p class="footer-description">
                        The ultimate platform for professional certification preparation. 
                        Powered by AI, driven by results.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-youtube"></i>
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
    
    <!-- Scroll to Top Button -->
    <div class="scroll-top" id="scrollTop">
        <i class="fas fa-chevron-up"></i>
    </div>
    
    <!-- Demo Video Modal -->
    <div class="modal" id="demoModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">ElitePro Demo</div>
                <button class="modal-close" id="closeDemoModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div style="position: relative; padding-bottom: 56.25%; height: 0; margin-bottom: 1rem;">
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: var(--bg-secondary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-play" style="font-size: 3rem; color: var(--primary-500);"></i>
                    </div>
                </div>
                <p style="color: var(--text-secondary);">Watch a 3-minute demo of how ElitePro can transform your certification preparation journey.</p>
            </div>
        </div>
    </div>
    
    <!-- Book Demo Modal -->
    <div class="modal" id="bookDemoModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Book a Demo</div>
                <button class="modal-close" id="closeBookDemoModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="demoForm" style="display: flex; flex-direction: column; gap: 1rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Full Name</label>
                        <input type="text" class="search-input" style="width: 100%;" placeholder="Enter your full name" required>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email Address</label>
                        <input type="email" class="search-input" style="width: 100%;" placeholder="Enter your email" required>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Company</label>
                        <input type="text" class="search-input" style="width: 100%;" placeholder="Enter your company name">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Preferred Date & Time</label>
                        <input type="datetime-local" class="search-input" style="width: 100%;">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="cancelBookDemo">Cancel</button>
                <button class="btn btn-primary" id="submitDemoRequest">Submit Request</button>
            </div>
        </div>
    </div>

    <script>
        // ========== PRELOADER ==========
        document.addEventListener('DOMContentLoaded', function() {
            const preloader = document.getElementById('preloader');
            const loadingProgress = document.getElementById('loadingProgress');
            
            // Simulate loading progress
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 10;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    
                    // Hide preloader
                    setTimeout(() => {
                        preloader.style.opacity = '0';
                        preloader.style.visibility = 'hidden';
                    }, 500);
                }
                loadingProgress.style.width = `${progress}%`;
            }, 100);
        });
        
        // ========== THEME TOGGLE ==========
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = themeToggle.querySelector('i');
        
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('light');
            
            if (document.documentElement.classList.contains('light')) {
                themeIcon.className = 'fas fa-sun';
                localStorage.setItem('theme', 'light');
                showNotification('Light theme activated');
            } else {
                themeIcon.className = 'fas fa-moon';
                localStorage.setItem('theme', 'dark');
                showNotification('Dark theme activated');
            }
        });
        
        // Set initial theme
        const savedTheme = localStorage.getItem('theme') || 'dark';
        if (savedTheme === 'light') {
            document.documentElement.classList.add('light');
            themeIcon.className = 'fas fa-sun';
        }
        
        // ========== NAVBAR SCROLL EFFECT ==========
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            const scrollTop = document.getElementById('scrollTop');
            
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            
            // Show/hide scroll to top button
            if (window.scrollY > 500) {
                scrollTop.classList.add('visible');
            } else {
                scrollTop.classList.remove('visible');
            }
        });
        
        // ========== MOBILE MENU ==========
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            mobileMenuBtn.querySelector('i').className = mobileMenu.classList.contains('active') 
                ? 'fas fa-times' 
                : 'fas fa-bars';
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                mobileMenu.classList.remove('active');
                mobileMenuBtn.querySelector('i').className = 'fas fa-bars';
            }
        });
        
        // ========== SMOOTH SCROLLING ==========
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const target = document.querySelector(targetId);
                if (target) {
                    // Close mobile menu if open
                    mobileMenu.classList.remove('active');
                    mobileMenuBtn.querySelector('i').className = 'fas fa-bars';
                    
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // ========== SCROLL TO TOP ==========
        document.getElementById('scrollTop').addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // ========== INTERSECTION OBSERVER ==========
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = entry.target.dataset.delay || 0;
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, delay * 1000);
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
        
        // ========== TESTIMONIAL SLIDER ==========
        const testimonialsTrack = document.getElementById('testimonialsTrack');
        const sliderNav = document.getElementById('sliderNav');
        const sliderDots = sliderNav.querySelectorAll('.slider-dot');
        
        let currentSlide = 0;
        const slideWidth = 350; // testimonial card width + gap
        const totalSlides = testimonialsTrack.children.length;
        
        function updateSlider() {
            testimonialsTrack.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
            
            // Update dots
            sliderDots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }
        
        // Dot navigation
        sliderDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                updateSlider();
            });
        });
        
        // Auto slide
        let slideInterval = setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }, 5000);
        
        // Pause on hover
        testimonialsTrack.addEventListener('mouseenter', () => {
            clearInterval(slideInterval);
        });
        
        testimonialsTrack.addEventListener('mouseleave', () => {
            slideInterval = setInterval(() => {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateSlider();
            }, 5000);
        });
        
        // ========== FAQ ACCORDION ==========
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                const icon = this.querySelector('.faq-icon');
                
                // Toggle current answer
                answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
                icon.className = answer.style.display === 'block' 
                    ? 'fas fa-chevron-up faq-icon' 
                    : 'fas fa-chevron-down faq-icon';
                
                // Close other answers
                document.querySelectorAll('.faq-answer').forEach(otherAnswer => {
                    if (otherAnswer !== answer) {
                        otherAnswer.style.display = 'none';
                        otherAnswer.previousElementSibling.querySelector('.faq-icon').className = 'fas fa-chevron-down faq-icon';
                    }
                });
            });
        });
        
        // ========== PRICING TOGGLE ==========
        const monthlyBtn = document.getElementById('monthlyBtn');
        const yearlyBtn = document.getElementById('yearlyBtn');
        
        monthlyBtn.addEventListener('click', () => {
            monthlyBtn.classList.remove('btn-ghost');
            monthlyBtn.classList.add('btn-primary');
            yearlyBtn.classList.remove('btn-primary');
            yearlyBtn.classList.add('btn-ghost');
            
            // Update prices
            document.querySelectorAll('.pricing-price').forEach(price => {
                if (price.textContent.includes('$29')) {
                    price.textContent = '$29';
                } else if (price.textContent.includes('$79')) {
                    price.textContent = '$79';
                }
            });
            
            showNotification('Switched to monthly billing');
        });
        
        yearlyBtn.addEventListener('click', () => {
            yearlyBtn.classList.remove('btn-ghost');
            yearlyBtn.classList.add('btn-primary');
            monthlyBtn.classList.remove('btn-primary');
            monthlyBtn.classList.add('btn-ghost');
            
            // Update prices
            document.querySelectorAll('.pricing-price').forEach(price => {
                if (price.textContent.includes('$29')) {
                    price.textContent = '$23';
                } else if (price.textContent.includes('$79')) {
                    price.textContent = '$63';
                }
            });
            
            showNotification('Switched to yearly billing (20% off)');
        });
        
        // ========== MODAL FUNCTIONALITY ==========
        // Demo Video Modal
        const demoModal = document.getElementById('demoModal');
        const watchDemoBtn = document.getElementById('watchDemoBtn');
        const closeDemoModal = document.getElementById('closeDemoModal');
        
        watchDemoBtn.addEventListener('click', () => {
            demoModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
        
        closeDemoModal.addEventListener('click', () => {
            demoModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
        
        demoModal.addEventListener('click', (e) => {
            if (e.target === demoModal) {
                demoModal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
        
        // Book Demo Modal
        const bookDemoModal = document.getElementById('bookDemoModal');
        const bookDemoBtn = document.getElementById('bookDemoBtn');
        const closeBookDemoModal = document.getElementById('closeBookDemoModal');
        const cancelBookDemo = document.getElementById('cancelBookDemo');
        const submitDemoRequest = document.getElementById('submitDemoRequest');
        
        bookDemoBtn.addEventListener('click', () => {
            bookDemoModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
        
        closeBookDemoModal.addEventListener('click', () => {
            bookDemoModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
        
        cancelBookDemo.addEventListener('click', () => {
            bookDemoModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
        
        bookDemoModal.addEventListener('click', (e) => {
            if (e.target === bookDemoModal) {
                bookDemoModal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
        
        submitDemoRequest.addEventListener('click', () => {
            const form = document.getElementById('demoForm');
            if (form.checkValidity()) {
                // In a real app, you would submit the form here
                showNotification('Demo request submitted successfully!');
                bookDemoModal.classList.remove('active');
                document.body.style.overflow = 'auto';
                form.reset();
            } else {
                form.reportValidity();
            }
        });
        
        // ========== NOTIFICATION SYSTEM ==========
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: var(--card-bg); border: 1px solid var(--border-color); border-radius: var(--radius-md); box-shadow: var(--shadow-lg);">
                    <div style="font-size: 1.25rem;">
                        ${type === 'success' ? '✅' : 'ℹ️'}
                    </div>
                    <div style="flex: 1; font-size: 0.875rem;">${message}</div>
                    <button onclick="this.parentElement.parentElement.remove()" style="background: none; border: none; color: var(--text-tertiary); cursor: pointer;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            // Add styles
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                z-index: 2000;
                animation: slideInUp 0.3s ease-out;
            `;
            
            document.body.appendChild(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.style.animation = 'fadeIn 0.3s ease-out reverse';
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        }
        
        // ========== TYPING ANIMATION ==========
        const typedText = document.querySelector('.typed-text');
        const texts = ['AI-Powered Learning', 'Personalized Coaching', 'Advanced Analytics', 'Expert Mentorship'];
        let textIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        
        function type() {
            const currentText = texts[textIndex];
            
            if (isDeleting) {
                typedText.textContent = currentText.substring(0, charIndex - 1);
                charIndex--;
            } else {
                typedText.textContent = currentText.substring(0, charIndex + 1);
                charIndex++;
            }
            
            if (!isDeleting && charIndex === currentText.length) {
                // Pause at end
                isDeleting = true;
                setTimeout(type, 2000);
            } else if (isDeleting && charIndex === 0) {
                // Move to next text
                isDeleting = false;
                textIndex = (textIndex + 1) % texts.length;
                setTimeout(type, 500);
            } else {
                // Continue typing/deleting
                setTimeout(type, isDeleting ? 50 : 100);
            }
        }
        
        // Start typing animation
        setTimeout(type, 1000);
        
        // ========== COUNTER ANIMATION ==========
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 30);
        }
        
        // Animate stats on scroll
        const statNumbers = document.querySelectorAll('.stat-number');
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const number = entry.target.textContent.replace(/[^0-9]/g, '');
                    if (number && !entry.target.classList.contains('animated')) {
                        entry.target.classList.add('animated');
                        animateCounter(entry.target, parseInt(number));
                    }
                }
            });
        }, { threshold: 0.5 });
        
        statNumbers.forEach(stat => {
            statsObserver.observe(stat);
        });
        
        // ========== HOVER EFFECTS ==========
        // Add hover effects to feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                const icon = this.querySelector('.feature-icon');
                icon.style.transform = 'scale(1.1) rotate(5deg)';
            });
            
            card.addEventListener('mouseleave', function() {
                const icon = this.querySelector('.feature-icon');
                icon.style.transform = 'scale(1) rotate(0deg)';
            });
        });
        
        // ========== FORM VALIDATION ==========
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                showNotification('Form submitted successfully!', 'success');
                this.reset();
            });
        });
        
        // ========== KEYBOARD SHORTCUTS ==========
        document.addEventListener('keydown', (e) => {
            // T for theme toggle
            if (e.key === 't' && e.altKey) {
                e.preventDefault();
                themeToggle.click();
            }
            
            // / for search focus
            if (e.key === '/' && !e.ctrlKey) {
                e.preventDefault();
                showNotification('Press Ctrl+K to search');
            }
            
            // Escape to close modals
            if (e.key === 'Escape') {
                demoModal.classList.remove('active');
                bookDemoModal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
        
        // ========== PROGRESS ANIMATION IN HERO ==========
        const progressBar = document.querySelector('.dashboard-preview .progress-fill');
        setInterval(() => {
            const randomProgress = Math.floor(Math.random() * 20) + 75;
            progressBar.style.width = `${randomProgress}%`;
        }, 3000);
    </script>
</body>
</html>