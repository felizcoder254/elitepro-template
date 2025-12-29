<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | ElitePro - Premium Learning Dashboard</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        /* ========== ELITE DASHBOARD DESIGN SYSTEM ========== */
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
            
            /* Success/Warning/Danger Colors */
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
            
            /* Effects */
            --glass-blur: blur(20px);
            --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.3);
            --shadow-xl: 0 25px 80px rgba(0, 0, 0, 0.4);
            --shadow-inner: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            
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
            
            /* Sidebar */
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
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
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            transition: background-color var(--transition-base);
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
        
        /* ========== DASHBOARD LAYOUT ========== */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* ========== SIDEBAR ========== */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--bg-glass);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1000;
            transition: width var(--transition-base);
            overflow: hidden;
        }
        
        .sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }
        
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 800;
            font-size: 1.5rem;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            white-space: nowrap;
        }
        
        .sidebar-logo-icon {
            width: 36px;
            height: 36px;
            background: var(--gradient-1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }
        
        .sidebar-toggle {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-full);
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all var(--transition-fast);
            flex-shrink: 0;
        }
        
        .sidebar-toggle:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        
        .sidebar-nav {
            flex: 1;
            padding: 1.5rem 0;
            overflow-y: auto;
        }
        
        .nav-group {
            margin-bottom: 1.5rem;
        }
        
        .nav-group-title {
            padding: 0.5rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-tertiary);
            letter-spacing: 0.05em;
            white-space: nowrap;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: var(--text-secondary);
            transition: all var(--transition-fast);
            position: relative;
            white-space: nowrap;
            cursor: pointer;
        }
        
        .nav-link:hover {
            color: var(--primary-500);
            background: rgba(99, 102, 241, 0.05);
        }
        
        .nav-link.active {
            color: var(--primary-500);
            background: rgba(99, 102, 241, 0.1);
            border-right: 3px solid var(--primary-500);
        }
        
        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--gradient-1);
        }
        
        .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .nav-badge {
            margin-left: auto;
            padding: 0.25rem 0.5rem;
            background: var(--primary-500);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: var(--radius-full);
            min-width: 24px;
            text-align: center;
        }
        
        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--border-color);
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-full);
            background: var(--gradient-1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            flex-shrink: 0;
            cursor: pointer;
        }
        
        .user-info {
            flex: 1;
            min-width: 0;
        }
        
        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .user-role {
            font-size: 0.85rem;
            color: var(--text-tertiary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        /* ========== MAIN CONTENT ========== */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left var(--transition-base);
        }
        
        .sidebar.collapsed ~ .main-content {
            margin-left: var(--sidebar-collapsed);
        }
        
        /* ========== TOP NAVBAR ========== */
        .top-nav {
            position: sticky;
            top: 0;
            z-index: 900;
            background: var(--bg-glass);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2rem;
        }
        
        .nav-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        
        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .nav-search {
            position: relative;
            width: 300px;
        }
        
        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-full);
            color: var(--text-primary);
            font-size: 0.95rem;
            transition: all var(--transition-fast);
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            background: rgba(255, 255, 255, 0.08);
        }
        
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-tertiary);
        }
        
        .search-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--card-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            margin-top: 0.5rem;
            max-height: 300px;
            overflow-y: auto;
            display: none;
            z-index: 1000;
        }
        
        .search-suggestion {
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: background-color var(--transition-fast);
        }
        
        .search-suggestion:hover {
            background: rgba(99, 102, 241, 0.1);
        }
        
        .nav-icon-btn {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-full);
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all var(--transition-fast);
            position: relative;
        }
        
        .nav-icon-btn:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--primary-500);
        }
        
        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 20px;
            height: 20px;
            background: var(--danger);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* ========== DASHBOARD CONTENT ========== */
        .dashboard-content {
            padding: 2rem;
        }
        
        /* ========== STATS GRID ========== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            transition: all var(--transition-base);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            border-color: var(--primary-500);
            box-shadow: var(--shadow-lg);
        }
        
        .stat-card::before {
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
        
        .stat-card:hover::before {
            opacity: 1;
        }
        
        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .stat-icon.primary {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary-500);
        }
        
        .stat-icon.success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }
        
        .stat-icon.warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }
        
        .stat-icon.info {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info);
        }
        
        .stat-trend {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .trend-up {
            color: var(--success);
        }
        
        .trend-down {
            color: var(--danger);
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.25rem;
        }
        
        .stat-label {
            color: var(--text-tertiary);
            font-size: 0.95rem;
        }
        
        .stat-change {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-tertiary);
        }
        
        /* ========== CHARTS & GRAPHS ========== */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        @media (max-width: 1200px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .chart-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
        }
        
        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        
        .chart-title {
            font-weight: 600;
            font-size: 1.125rem;
        }
        
        .chart-period {
            display: flex;
            gap: 0.5rem;
        }
        
        .period-btn {
            padding: 0.5rem 1rem;
            background: transparent;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all var(--transition-fast);
        }
        
        .period-btn.active {
            background: var(--primary-500);
            color: white;
            border-color: var(--primary-500);
        }
        
        .chart-container {
            height: 300px;
            position: relative;
        }
        
        /* ========== ACTIVITY FEED ========== */
        .activity-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            height: 100%;
        }
        
        .activity-list {
            list-style: none;
        }
        
        .activity-item {
            display: flex;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
            transition: transform var(--transition-fast);
        }
        
        .activity-item:hover {
            transform: translateX(4px);
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .activity-icon.completed {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }
        
        .activity-icon.started {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info);
        }
        
        .activity-icon.pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .activity-time {
            font-size: 0.875rem;
            color: var(--text-tertiary);
        }
        
        /* ========== COURSES GRID ========== */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .course-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: all var(--transition-base);
        }
        
        .course-card:hover {
            transform: translateY(-4px);
            border-color: var(--primary-500);
            box-shadow: var(--shadow-lg);
        }
        
        .course-image {
            height: 160px;
            background: var(--gradient-1);
            position: relative;
            overflow: hidden;
        }
        
        .course-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.25rem 0.75rem;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: var(--radius-full);
        }
        
        .course-content {
            padding: 1.5rem;
        }
        
        .course-category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary-500);
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: var(--radius-full);
            margin-bottom: 0.75rem;
        }
        
        .course-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.125rem;
        }
        
        .course-description {
            color: var(--text-tertiary);
            font-size: 0.95rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        
        .course-progress {
            margin-bottom: 1rem;
        }
        
        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }
        
        .progress-bar {
            height: 6px;
            background: var(--bg-tertiary);
            border-radius: var(--radius-full);
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: var(--gradient-1);
            border-radius: var(--radius-full);
            transition: width 1s ease-in-out;
        }
        
        .course-actions {
            display: flex;
            gap: 0.5rem;
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
        
        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
        
        .btn-block {
            width: 100%;
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
        
        /* ========== MODAL ========== */
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
        }
        
        .modal-content {
            background: var(--card-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalSlideIn 0.3s ease-out;
        }
        
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
        
        .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }
        
        /* ========== NOTIFICATION DROPDOWN ========== */
        .notification-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 350px;
            background: var(--card-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            margin-top: 0.5rem;
            display: none;
            z-index: 1000;
        }
        
        .notification-dropdown.active {
            display: block;
            animation: fadeIn 0.2s ease-out;
        }
        
        .dropdown-header {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .notification-list {
            max-height: 400px;
            overflow-y: auto;
        }
        
        .notification-item {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            transition: background-color var(--transition-fast);
            cursor: pointer;
        }
        
        .notification-item:hover {
            background: rgba(99, 102, 241, 0.05);
        }
        
        .notification-item.unread {
            background: rgba(99, 102, 241, 0.1);
        }
        
        /* ========== TOAST NOTIFICATIONS ========== */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--card-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1rem;
            min-width: 300px;
            max-width: 400px;
            box-shadow: var(--shadow-lg);
            z-index: 3000;
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s ease-out;
        }
        
        .toast.show {
            transform: translateX(0);
            opacity: 1;
        }
        
        .toast.success {
            border-left: 4px solid var(--success);
        }
        
        .toast.error {
            border-left: 4px solid var(--danger);
        }
        
        .toast.info {
            border-left: 4px solid var(--info);
        }
        
        /* ========== LOADING SKELETON ========== */
        .skeleton {
            background: linear-gradient(90deg, 
                var(--bg-tertiary) 0%, 
                var(--bg-secondary) 50%, 
                var(--bg-tertiary) 100%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: var(--radius-md);
        }
        
        .skeleton-loader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--bg-primary);
            display: flex;
            z-index: 9999;
        }
        
        /* ========== RESPONSIVE DESIGN ========== */
        @media (max-width: 1200px) {
            .sidebar {
                width: var(--sidebar-collapsed);
            }
            
            .sidebar:not(.collapsed) {
                width: var(--sidebar-width);
            }
            
            .main-content {
                margin-left: var(--sidebar-collapsed);
            }
            
            .sidebar:not(.collapsed) ~ .main-content {
                margin-left: var(--sidebar-width);
            }
        }
        
        @media (max-width: 768px) {
            .dashboard-content {
                padding: 1rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .courses-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-search {
                width: 200px;
            }
            
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0 !important;
            }
            
            .mobile-menu-toggle {
                display: flex;
            }
            
            .notification-dropdown {
                width: 300px;
                right: -50px;
            }
        }
        
        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-search {
                display: none;
            }
            
            .notification-dropdown {
                width: calc(100vw - 2rem);
                right: 1rem;
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
        
        /* ========== ANIMATIONS ========== */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        .animate-slide-in {
            animation: slideIn 0.3s ease-out;
        }
        
        /* ========== SCROLLBAR ========== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--bg-tertiary);
            border-radius: var(--radius-full);
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-500);
        }
    </style>
</head>
<body>
    <!-- Toast Container -->
    <div id="toastContainer"></div>
    
    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <div class="sidebar-logo-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <span class="logo-text">ElitePro</span>
                </div>
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
            
            <nav class="sidebar-nav">
                <div class="nav-group">
                    <div class="nav-group-title">Dashboard</div>
                    <a href="#" class="nav-link active" data-page="dashboard">
                        <div class="nav-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <span class="nav-text">Overview</span>
                    </a>
                    <a href="#" class="nav-link" data-page="analytics">
                        <div class="nav-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <span class="nav-text">Analytics</span>
                    </a>
                    <a href="#" class="nav-link" data-page="performance">
                        <div class="nav-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <span class="nav-text">Performance</span>
                        <span class="nav-badge">3</span>
                    </a>
                </div>
                
                <div class="nav-group">
                    <div class="nav-group-title">Learning</div>
                    <a href="#" class="nav-link" data-page="courses">
                        <div class="nav-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <span class="nav-text">My Courses</span>
                        <span class="nav-badge">5</span>
                    </a>
                    <a href="#" class="nav-link" data-page="certifications">
                        <div class="nav-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <span class="nav-text">Certifications</span>
                    </a>
                    <a href="#" class="nav-link" data-page="practice">
                        <div class="nav-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        <span class="nav-text">Practice Tests</span>
                        <span class="nav-badge">12</span>
                    </a>
                    <a href="#" class="nav-link" data-page="ai-tutor">
                        <div class="nav-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <span class="nav-text">AI Tutor</span>
                    </a>
                </div>
                
                <div class="nav-group">
                    <div class="nav-group-title">Community</div>
                    <a href="#" class="nav-link" data-page="study-groups">
                        <div class="nav-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="nav-text">Study Groups</span>
                    </a>
                    <a href="#" class="nav-link" data-page="leaderboard">
                        <div class="nav-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <span class="nav-text">Leaderboard</span>
                    </a>
                    <a href="#" class="nav-link" data-page="mentors">
                        <div class="nav-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <span class="nav-text">Expert Mentors</span>
                    </a>
                </div>
                
                <div class="nav-group">
                    <div class="nav-group-title">Account</div>
                    <a href="#" class="nav-link" data-page="profile">
                        <div class="nav-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="nav-text">Profile</span>
                    </a>
                    <a href="#" class="nav-link" data-page="settings">
                        <div class="nav-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <span class="nav-text">Settings</span>
                    </a>
                    <a href="#" class="nav-link" data-page="billing">
                        <div class="nav-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <span class="nav-text">Billing</span>
                    </a>
                </div>
            </nav>
            
            <div class="sidebar-footer">
                <div class="user-profile">
                    <div class="user-avatar" id="userAvatar">JS</div>
                    <div class="user-info">
                        <div class="user-name" id="userName">John Smith</div>
                        <div class="user-role">Premium Member</div>
                    </div>
                    <button class="nav-icon-btn" id="userMenuToggle">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Navigation -->
            <nav class="top-nav">
                <div class="nav-content">
                    <button class="nav-icon-btn mobile-menu-toggle" id="mobileMenuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <h1 class="page-title" id="pageTitle">Dashboard Overview</h1>
                    
                    <div class="nav-actions">
                        <div class="nav-search">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" class="search-input" id="searchInput" placeholder="Search courses, topics...">
                            <div class="search-suggestions" id="searchSuggestions"></div>
                        </div>
                        
                        <div style="position: relative;">
                            <button class="nav-icon-btn" id="notificationBtn">
                                <i class="fas fa-bell"></i>
                                <span class="notification-badge" id="notificationCount">3</span>
                            </button>
                            <div class="notification-dropdown" id="notificationDropdown">
                                <div class="dropdown-header">
                                    <h3 style="font-size: 1rem; margin: 0;">Notifications</h3>
                                    <button class="btn-text" id="markAllRead" style="font-size: 0.875rem;">Mark all read</button>
                                </div>
                                <div class="notification-list" id="notificationList">
                                    <!-- Notifications loaded via JS -->
                                </div>
                            </div>
                        </div>
                        
                        <button class="theme-toggle" id="themeToggle">
                            <i class="fas fa-moon"></i>
                        </button>
                    </div>
                </div>
            </nav>
            
            <!-- Dashboard Content -->
            <div class="dashboard-content" id="dashboardContent">
                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon primary">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i>
                                <span>12%</span>
                            </div>
                        </div>
                        <div class="stat-value">85%</div>
                        <div class="stat-label">Overall Progress</div>
                        <div class="stat-change">+8% from last week</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon success">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i>
                                <span>24%</span>
                            </div>
                        </div>
                        <div class="stat-value">42h</div>
                        <div class="stat-label">Study Time</div>
                        <div class="stat-change">+8h from last week</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon warning">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i>
                                <span>18%</span>
                            </div>
                        </div>
                        <div class="stat-value">156</div>
                        <div class="stat-label">Completed Topics</div>
                        <div class="stat-change">+24 from last week</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon info">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i>
                                <span>6%</span>
                            </div>
                        </div>
                        <div class="stat-value">#48</div>
                        <div class="stat-label">Global Rank</div>
                        <div class="stat-change">Moved up 12 positions</div>
                    </div>
                </div>
                
                <!-- Charts & Activity Grid -->
                <div class="charts-grid">
                    <!-- Main Chart -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <div class="chart-title">Study Progress Analytics</div>
                            <div class="chart-period">
                                <button class="period-btn active" data-period="week">Week</button>
                                <button class="period-btn" data-period="month">Month</button>
                                <button class="period-btn" data-period="quarter">Quarter</button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="progressChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Activity Feed -->
                    <div class="activity-card">
                        <div class="chart-header">
                            <div class="chart-title">Recent Activity</div>
                            <button class="btn-text" id="viewAllActivity">View All</button>
                        </div>
                        <ul class="activity-list" id="activityList">
                            <!-- Activity items loaded via JS -->
                        </ul>
                    </div>
                </div>
                
                <!-- Courses Grid -->
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 style="font-size: 1.5rem; font-weight: 700;">Active Courses</h2>
                        <button class="btn-text" id="viewAllCourses">
                            <span>View All Courses</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                    
                    <div class="courses-grid" id="coursesGrid">
                        <!-- Course cards loaded via JS -->
                    </div>
                </div>
                
                <!-- Upcoming Tests -->
                <div class="chart-card">
                    <div class="chart-header">
                        <div class="chart-title">Upcoming Practice Tests</div>
                        <button class="btn btn-primary btn-sm" id="scheduleTestBtn">
                            <i class="fas fa-plus"></i>
                            Schedule New Test
                        </button>
                    </div>
                    
                    <div style="margin-top: 1.5rem;">
                        <div class="tests-grid" id="upcomingTests">
                            <!-- Tests loaded via JS -->
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- User Menu Modal -->
    <div class="modal" id="userMenuModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Account Settings</div>
                <button class="modal-close" id="closeUserMenu">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <button class="modal-menu-item" id="editProfileBtn">
                        <i class="fas fa-user" style="color: var(--primary-500);"></i>
                        <span>Edit Profile</span>
                    </button>
                    <button class="modal-menu-item" id="accountSettingsBtn">
                        <i class="fas fa-cog" style="color: var(--primary-500);"></i>
                        <span>Account Settings</span>
                    </button>
                    <button class="modal-menu-item" id="billingBtn">
                        <i class="fas fa-credit-card" style="color: var(--primary-500);"></i>
                        <span>Billing & Subscription</span>
                    </button>
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border-color);">
                        <button class="btn btn-danger btn-block" id="logoutBtn">
                            <i class="fas fa-sign-out-alt"></i>
                            Sign Out
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Profile Edit Modal -->
    <div class="modal" id="profileEditModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Edit Profile</div>
                <button class="modal-close" id="closeProfileEdit">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="profileForm" style="display: flex; flex-direction: column; gap: 1rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Full Name</label>
                        <input type="text" class="search-input" style="width: 100%;" id="profileName" value="John Smith">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email</label>
                        <input type="email" class="search-input" style="width: 100%;" id="profileEmail" value="john@example.com">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Avatar Initials</label>
                        <input type="text" class="search-input" style="width: 100%;" id="profileAvatar" maxlength="2" value="JS">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Study Preferences</label>
                        <div style="display: flex; gap: 1rem;">
                            <label style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" checked>
                                <span>Daily Reminders</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 0.5rem;">
                                <input type="checkbox" checked>
                                <span>Weekly Reports</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="cancelProfileEdit">Cancel</button>
                <button class="btn btn-primary" id="saveProfile">Save Changes</button>
            </div>
        </div>
    </div>
    
    <!-- Schedule Test Modal -->
    <div class="modal" id="scheduleTestModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Schedule Practice Test</div>
                <button class="modal-close" id="closeScheduleTest">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="testForm" style="display: flex; flex-direction: column; gap: 1rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Test Subject</label>
                        <select class="search-input" style="width: 100%;" id="testSubject">
                            <option value="">Select subject</option>
                            <option value="AWS Certification">AWS Certification</option>
                            <option value="Data Structures">Data Structures</option>
                            <option value="System Design">System Design</option>
                            <option value="Machine Learning">Machine Learning</option>
                            <option value="Web Development">Web Development</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Date & Time</label>
                        <input type="datetime-local" class="search-input" style="width: 100%;" id="testDateTime">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Duration (minutes)</label>
                        <input type="number" class="search-input" style="width: 100%;" id="testDuration" min="30" max="240" value="120">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="cancelScheduleTest">Cancel</button>
                <button class="btn btn-primary" id="saveTest">Schedule Test</button>
            </div>
        </div>
    </div>
    
    <script>
        // ========== DATA MANAGEMENT ==========
        const sampleData = {
            activities: [
                { type: 'completed', title: 'Completed AWS Certification Module', time: '10 minutes ago' },
                { type: 'started', title: 'Started Advanced Algorithms Course', time: '2 hours ago' },
                { type: 'pending', title: 'Practice Test Scheduled for Tomorrow', time: '5 hours ago' },
                { type: 'completed', title: 'Achieved "Advanced Learner" Badge', time: 'Yesterday' },
                { type: 'started', title: 'Joined Cloud Computing Study Group', time: '2 days ago' },
                { type: 'completed', title: 'Finished React Fundamentals', time: '3 days ago' },
                { type: 'started', title: 'Started Docker & Kubernetes Course', time: '1 week ago' }
            ],
            courses: [
                { category: 'Cloud Computing', title: 'AWS Certified Solutions Architect', 
                  description: 'Master AWS services and design distributed systems on AWS.', 
                  progress: 65, status: 'In Progress' },
                { category: 'Data Science', title: 'Machine Learning Fundamentals', 
                  description: 'Learn core ML concepts and implement algorithms from scratch.', 
                  progress: 30, status: 'Up Next' },
                { category: 'Web Development', title: 'Advanced React & TypeScript', 
                  description: 'Build scalable React applications with TypeScript best practices.', 
                  progress: 100, status: 'Completed' },
                { category: 'DevOps', title: 'Docker & Kubernetes Mastery', 
                  description: 'Containerization and orchestration at scale.', 
                  progress: 45, status: 'In Progress' }
            ],
            tests: [
                { title: 'AWS Certification', date: 'Tomorrow, 10:00 AM', duration: '120 minutes' },
                { title: 'Data Structures', date: 'Nov 25, 2:00 PM', duration: '90 minutes' },
                { title: 'System Design', date: 'Nov 28, 11:00 AM', duration: '180 minutes' }
            ],
            notifications: [
                { id: 1, title: 'New course available', message: 'Advanced DevOps course just added', time: '5 min ago', read: false },
                { id: 2, title: 'Study group invite', message: 'You\'ve been invited to join Cloud Study Group', time: '1 hour ago', read: false },
                { id: 3, title: 'Progress milestone', message: 'You completed 50% of AWS course', time: '3 hours ago', read: true },
                { id: 4, title: 'Weekly report', message: 'Your weekly learning report is ready', time: '1 day ago', read: true }
            ],
            searchSuggestions: [
                'AWS Certification',
                'Machine Learning',
                'React Development',
                'Data Structures',
                'System Design',
                'DevOps Fundamentals',
                'Cloud Computing',
                'TypeScript Advanced'
            ]
        };

        // ========== CHART.JS IMPLEMENTATION ==========
        let progressChart;

        function initializeCharts() {
            const ctx = document.getElementById('progressChart').getContext('2d');
            
            // Destroy existing chart if it exists
            if (progressChart) {
                progressChart.destroy();
            }
            
            // Chart data
            const data = {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Study Hours',
                    data: [3, 5, 4, 6, 8, 4, 5],
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#6366f1',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            };

            // Chart configuration
            const config = {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(30, 41, 59, 0.9)',
                            titleColor: '#f8fafc',
                            bodyColor: '#cbd5e1',
                            borderColor: 'rgba(148, 163, 184, 0.2)',
                            borderWidth: 1,
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.parsed.y} hours`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(148, 163, 184, 0.1)'
                            },
                            ticks: {
                                color: 'var(--text-tertiary)'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(148, 163, 184, 0.1)'
                            },
                            ticks: {
                                color: 'var(--text-tertiary)'
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    animations: {
                        tension: {
                            duration: 1000,
                            easing: 'linear'
                        }
                    }
                }
            };

            // Create chart
            progressChart = new Chart(ctx, config);
        }

        // ========== TOAST NOTIFICATION SYSTEM ==========
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <div style="font-size: 1.25rem;">
                        ${type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️'}
                    </div>
                    <div style="flex: 1;">
                        <div style="font-weight: 600; margin-bottom: 0.25rem;">
                            ${type === 'success' ? 'Success' : type === 'error' ? 'Error' : 'Info'}
                        </div>
                        <div style="font-size: 0.875rem; color: var(--text-secondary);">
                            ${message}
                        </div>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" style="background: none; border: none; color: var(--text-tertiary); cursor: pointer;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            document.getElementById('toastContainer').appendChild(toast);
            
            // Show toast
            setTimeout(() => toast.classList.add('show'), 10);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }

        // ========== DATA RENDERING FUNCTIONS ==========
        function renderActivities() {
            const activityList = document.getElementById('activityList');
            activityList.innerHTML = '';
            
            sampleData.activities.slice(0, 5).forEach(activity => {
                const li = document.createElement('li');
                li.className = 'activity-item';
                li.innerHTML = `
                    <div class="activity-icon ${activity.type}">
                        <i class="fas ${
                            activity.type === 'completed' ? 'fa-check' :
                            activity.type === 'started' ? 'fa-play' : 'fa-clock'
                        }"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">${activity.title}</div>
                        <div class="activity-time">${activity.time}</div>
                    </div>
                `;
                activityList.appendChild(li);
            });
        }

        function renderCourses() {
            const coursesGrid = document.getElementById('coursesGrid');
            coursesGrid.innerHTML = '';
            
            sampleData.courses.forEach(course => {
                const card = document.createElement('div');
                card.className = 'course-card';
                card.innerHTML = `
                    <div class="course-image">
                        <div class="course-badge">${course.status}</div>
                    </div>
                    <div class="course-content">
                        <div class="course-category">${course.category}</div>
                        <h3 class="course-title">${course.title}</h3>
                        <p class="course-description">${course.description}</p>
                        
                        <div class="course-progress">
                            <div class="progress-label">
                                <span>Progress</span>
                                <span>${course.progress}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: ${course.progress}%;"></div>
                            </div>
                        </div>
                        
                        <div class="course-actions">
                            <button class="btn ${
                                course.status === 'In Progress' ? 'btn-primary' : 'btn-secondary'
                            } btn-sm btn-block" data-course="${course.title}">
                                <i class="fas ${
                                    course.status === 'In Progress' ? 'fa-play' :
                                    course.status === 'Up Next' ? 'fa-book-open' : 'fa-redo'
                                }"></i>
                                ${
                                    course.status === 'In Progress' ? 'Continue Learning' :
                                    course.status === 'Up Next' ? 'Start Learning' : 'Review Course'
                                }
                            </button>
                        </div>
                    </div>
                `;
                coursesGrid.appendChild(card);
            });
        }

        function renderTests() {
            const testsGrid = document.getElementById('upcomingTests');
            testsGrid.innerHTML = '';
            
            sampleData.tests.forEach(test => {
                const testDiv = document.createElement('div');
                testDiv.style.cssText = 'background: var(--bg-secondary); padding: 1rem; border-radius: var(--radius-md);';
                testDiv.innerHTML = `
                    <div style="font-weight: 600; margin-bottom: 0.5rem;">${test.title}</div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-tertiary); margin-bottom: 0.5rem;">
                        <i class="fas fa-calendar"></i>
                        <span>${test.date}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-tertiary);">
                        <i class="fas fa-clock"></i>
                        <span>${test.duration}</span>
                    </div>
                `;
                testsGrid.appendChild(testDiv);
            });
        }

        function renderNotifications() {
            const notificationList = document.getElementById('notificationList');
            const notificationCount = document.getElementById('notificationCount');
            
            notificationList.innerHTML = '';
            
            const unreadCount = sampleData.notifications.filter(n => !n.read).length;
            notificationCount.textContent = unreadCount;
            
            sampleData.notifications.forEach(notification => {
                const item = document.createElement('div');
                item.className = `notification-item ${notification.read ? '' : 'unread'}`;
                item.innerHTML = `
                    <div style="font-weight: 600; margin-bottom: 0.25rem;">${notification.title}</div>
                    <div style="font-size: 0.875rem; color: var(--text-secondary); margin-bottom: 0.25rem;">
                        ${notification.message}
                    </div>
                    <div style="font-size: 0.75rem; color: var(--text-tertiary);">
                        ${notification.time}
                    </div>
                `;
                item.addEventListener('click', () => {
                    notification.read = true;
                    renderNotifications();
                    showToast('Notification marked as read', 'success');
                });
                notificationList.appendChild(item);
            });
        }

        // ========== SEARCH FUNCTIONALITY ==========
        function setupSearch() {
            const searchInput = document.getElementById('searchInput');
            const searchSuggestions = document.getElementById('searchSuggestions');
            
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                
                if (query.length === 0) {
                    searchSuggestions.style.display = 'none';
                    return;
                }
                
                const filtered = sampleData.searchSuggestions.filter(item => 
                    item.toLowerCase().includes(query)
                );
                
                if (filtered.length > 0) {
                    searchSuggestions.innerHTML = filtered.map(item => 
                        `<div class="search-suggestion">${item}</div>`
                    ).join('');
                    searchSuggestions.style.display = 'block';
                    
                    // Add click handlers to suggestions
                    searchSuggestions.querySelectorAll('.search-suggestion').forEach(suggestion => {
                        suggestion.addEventListener('click', function() {
                            searchInput.value = this.textContent;
                            searchSuggestions.style.display = 'none';
                            showToast(`Searching for "${this.textContent}"`, 'info');
                        });
                    });
                } else {
                    searchSuggestions.style.display = 'none';
                }
            });
            
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchSuggestions.style.display = 'none';
                    if (this.value.trim()) {
                        showToast(`Searching for "${this.value}"`, 'info');
                    }
                }
            });
            
            // Close suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                    searchSuggestions.style.display = 'none';
                }
            });
        }

        // ========== EVENT HANDLERS ==========
        function setupEventHandlers() {
            // Theme Toggle
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = themeToggle.querySelector('i');
            
            themeToggle.addEventListener('click', () => {
                document.documentElement.classList.toggle('light');
                
                if (document.documentElement.classList.contains('light')) {
                    themeIcon.className = 'fas fa-sun';
                    localStorage.setItem('theme', 'light');
                    showToast('Light theme activated', 'success');
                } else {
                    themeIcon.className = 'fas fa-moon';
                    localStorage.setItem('theme', 'dark');
                    showToast('Dark theme activated', 'success');
                }
            });
            
            // Set initial theme
            const savedTheme = localStorage.getItem('theme') || 'dark';
            if (savedTheme === 'light') {
                document.documentElement.classList.add('light');
                themeIcon.className = 'fas fa-sun';
            }
            
            // Sidebar Toggle
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarIcon = sidebarToggle.querySelector('i');
            
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                
                if (sidebar.classList.contains('collapsed')) {
                    sidebarIcon.className = 'fas fa-chevron-right';
                    showToast('Sidebar collapsed', 'info');
                } else {
                    sidebarIcon.className = 'fas fa-chevron-left';
                    showToast('Sidebar expanded', 'info');
                }
            });
            
            // Mobile Menu Toggle
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                });
            }
            
            // Navigation Links
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Update active state
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update page title
                    const pageTitle = document.getElementById('pageTitle');
                    const navText = this.querySelector('.nav-text').textContent;
                    pageTitle.textContent = navText;
                    
                    // Show notification for page change
                    showToast(`Navigated to ${navText}`, 'info');
                    
                    // Close mobile sidebar if open
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('active');
                    }
                });
            });
            
            // Notification Dropdown
            const notificationBtn = document.getElementById('notificationBtn');
            const notificationDropdown = document.getElementById('notificationDropdown');
            
            notificationBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                notificationDropdown.classList.toggle('active');
            });
            
            // Mark all as read
            document.getElementById('markAllRead').addEventListener('click', (e) => {
                e.stopPropagation();
                sampleData.notifications.forEach(n => n.read = true);
                renderNotifications();
                showToast('All notifications marked as read', 'success');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', () => {
                notificationDropdown.classList.remove('active');
            });
            
            // User Menu Modal
            const userMenuToggle = document.getElementById('userMenuToggle');
            const userMenuModal = document.getElementById('userMenuModal');
            const closeUserMenu = document.getElementById('closeUserMenu');
            
            userMenuToggle.addEventListener('click', () => {
                userMenuModal.classList.add('active');
            });
            
            closeUserMenu.addEventListener('click', () => {
                userMenuModal.classList.remove('active');
            });
            
            // Profile Edit
            document.getElementById('editProfileBtn').addEventListener('click', () => {
                userMenuModal.classList.remove('active');
                document.getElementById('profileEditModal').classList.add('active');
            });
            
            // Close profile modal
            document.getElementById('closeProfileEdit').addEventListener('click', () => {
                document.getElementById('profileEditModal').classList.remove('active');
            });
            
            document.getElementById('cancelProfileEdit').addEventListener('click', () => {
                document.getElementById('profileEditModal').classList.remove('active');
            });
            
            // Save profile
            document.getElementById('saveProfile').addEventListener('click', () => {
                const name = document.getElementById('profileName').value;
                const avatar = document.getElementById('profileAvatar').value;
                
                document.getElementById('userName').textContent = name;
                document.getElementById('userAvatar').textContent = avatar;
                
                document.getElementById('profileEditModal').classList.remove('active');
                showToast('Profile updated successfully', 'success');
            });
            
            // Schedule Test
            document.getElementById('scheduleTestBtn').addEventListener('click', () => {
                document.getElementById('scheduleTestModal').classList.add('active');
            });
            
            // Close schedule modal
            document.getElementById('closeScheduleTest').addEventListener('click', () => {
                document.getElementById('scheduleTestModal').classList.remove('active');
            });
            
            document.getElementById('cancelScheduleTest').addEventListener('click', () => {
                document.getElementById('scheduleTestModal').classList.remove('active');
            });
            
            // Save test
            document.getElementById('saveTest').addEventListener('click', () => {
                const subject = document.getElementById('testSubject').value;
                const dateTime = document.getElementById('testDateTime').value;
                const duration = document.getElementById('testDuration').value;
                
                if (!subject || !dateTime) {
                    showToast('Please fill in all fields', 'error');
                    return;
                }
                
                const date = new Date(dateTime);
                const formattedDate = date.toLocaleDateString('en-US', { 
                    weekday: 'long', 
                    month: 'short', 
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                // Add to sample data
                sampleData.tests.unshift({
                    title: subject,
                    date: formattedDate,
                    duration: `${duration} minutes`
                });
                
                renderTests();
                document.getElementById('scheduleTestModal').classList.remove('active');
                showToast('Test scheduled successfully', 'success');
                
                // Reset form
                document.getElementById('testForm').reset();
            });
            
            // View all buttons
            document.getElementById('viewAllActivity').addEventListener('click', () => {
                showToast('Showing all activities', 'info');
            });
            
            document.getElementById('viewAllCourses').addEventListener('click', () => {
                showToast('Showing all courses', 'info');
            });
            
            // Period buttons
            document.querySelectorAll('.period-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    const period = this.dataset.period;
                    showToast(`Viewing ${period} data`, 'info');
                    
                    // Update chart data based on period
                    // This would normally fetch new data from an API
                });
            });
            
            // Course card buttons
            document.addEventListener('click', function(e) {
                if (e.target.closest('.course-actions .btn')) {
                    const btn = e.target.closest('.btn');
                    const courseTitle = btn.closest('.course-card').querySelector('.course-title').textContent;
                    
                    if (btn.classList.contains('btn-primary')) {
                        showToast(`Continuing "${courseTitle}"`, 'success');
                    } else {
                        showToast(`Starting "${courseTitle}"`, 'success');
                    }
                }
            });
            
            // Logout
            document.getElementById('logoutBtn').addEventListener('click', () => {
                if (confirm('Are you sure you want to sign out?')) {
                    showToast('Signed out successfully', 'success');
                    setTimeout(() => {
                        alert('Redirecting to login page...');
                        // In a real app, this would redirect to login
                    }, 1000);
                }
            });
            
            // Close modals when clicking outside
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.remove('active');
                    }
                });
            });
            
            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl + K for search
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    document.getElementById('searchInput').focus();
                }
                
                // Escape to close modals
                if (e.key === 'Escape') {
                    document.querySelectorAll('.modal.active').forEach(modal => {
                        modal.classList.remove('active');
                    });
                    notificationDropdown.classList.remove('active');
                }
                
                // T for theme toggle
                if (e.key === 't' && e.altKey) {
                    e.preventDefault();
                    themeToggle.click();
                }
                
                // M for menu toggle
                if (e.key === 'm' && e.altKey) {
                    e.preventDefault();
                    sidebarToggle.click();
                }
            });
        }

        // ========== INITIALIZATION ==========
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all components
            initializeCharts();
            renderActivities();
            renderCourses();
            renderTests();
            renderNotifications();
            setupSearch();
            setupEventHandlers();
            
            // Add fade-in animations
            document.querySelectorAll('.stat-card, .chart-card, .course-card').forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
                el.classList.add('animate-fade-in');
            });
            
            // Show welcome toast
            setTimeout(() => {
                showToast('Welcome to ElitePro Dashboard!', 'success');
            }, 1000);
            
            // Simulate data loading
            setTimeout(() => {
                console.log('Dashboard data loaded successfully');
            }, 500);
        });

        // ========== WINDOW RESIZE HANDLER ==========
        window.addEventListener('resize', function() {
            // Reinitialize charts on resize
            if (progressChart) {
                progressChart.resize();
            }
            
            // Auto-collapse sidebar on small screens
            if (window.innerWidth <= 768) {
                document.querySelector('.sidebar').classList.remove('collapsed');
            }
        });
    </script>
</body>
</html>