<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | ElitePro</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-50: #eef2ff;
            --primary-100: #e0e7ff;
            --primary-500: #6366f1;
            --primary-600: #4f46e5;
            --gradient-1: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
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
            --radius-lg: 24px;
            --radius-full: 9999px;
            --glass-blur: blur(20px);
            --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        
        .light {
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
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }
        
        .auth-bg {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }
        
        .auth-bg-gradient {
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 50%, rgba(99, 102, 241, 0.15) 0%, transparent 50%),
                       radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                       radial-gradient(circle at 40% 80%, rgba(6, 182, 212, 0.1) 0%, transparent 50%);
        }
        
        .floating-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            animation: float 6s ease-in-out infinite;
        }
        
        .orb-1 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.2) 0%, transparent 70%);
            top: 10%;
            left: 5%;
        }
        
        .orb-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
            bottom: 5%;
            right: 10%;
            animation-delay: 2s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.05); }
        }
        
        .auth-container {
            width: 100%;
            max-width: 440px;
        }
        
        .auth-card {
            background: var(--card-bg);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }
        
        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-1);
        }
        
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .auth-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .auth-logo-icon {
            width: 36px;
            height: 36px;
            background: var(--gradient-1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .auth-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .auth-subtitle {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }
        
        .input-group {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-500);
            z-index: 1;
        }
        
        .form-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            background: rgba(255, 255, 255, 0.08);
        }
        
        .password-strength {
            margin-top: 0.5rem;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
        }
        
        .strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
        }
        
        .strength-0 { width: 0%; background: #ef4444; }
        .strength-25 { width: 25%; background: #ef4444; }
        .strength-50 { width: 50%; background: #f59e0b; }
        .strength-75 { width: 75%; background: #10b981; }
        .strength-100 { width: 100%; background: #10b981; }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 1rem;
            background: var(--gradient-1);
            color: white;
            border: none;
            border-radius: var(--radius-full);
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            color: var(--text-secondary);
            font-size: 0.95rem;
        }
        
        .auth-link {
            color: var(--primary-500);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .auth-link:hover {
            color: var(--primary-600);
        }
        
        .theme-toggle {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            width: 44px;
            height: 44px;
            border-radius: var(--radius-full);
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        
        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            color: #fecaca;
            font-size: 0.95rem;
        }
        
        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .terms-checkbox input {
            margin-top: 0.25rem;
            accent-color: var(--primary-500);
        }
        
        .terms-checkbox label {
            font-size: 0.95rem;
            color: var(--text-secondary);
            line-height: 1.4;
        }
        
        .terms-link {
            color: var(--primary-500);
            text-decoration: none;
        }
        
        .terms-link:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 480px) {
            .auth-card {
                padding: 2rem 1.5rem;
            }
            
            .auth-title {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="auth-bg">
        <div class="auth-bg-gradient"></div>
        <div class="floating-orb orb-1"></div>
        <div class="floating-orb orb-2"></div>
    </div>
    
    <button class="theme-toggle" id="themeToggle">
        <i class="fas fa-moon"></i>
    </button>
    
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <div class="auth-logo-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    ElitePro
                </div>
                <h1 class="auth-title">Join ElitePro</h1>
                <p class="auth-subtitle">Start your journey to professional excellence</p>
            </div>
            
            @if($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" name="name" class="form-input" placeholder="Enter your full name" required value="{{ old('name') }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" class="form-input" placeholder="Enter your email" required value="{{ old('email') }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password" id="password" class="form-input" placeholder="Create a password" required onkeyup="checkPasswordStrength(this.value)">
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar" id="passwordStrength"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm your password" required>
                    </div>
                </div>
                
                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        I agree to the <a href="/terms" class="terms-link">Terms of Service</a> and <a href="/privacy" class="terms-link">Privacy Policy</a>
                    </label>
                </div>
                
                <button type="submit" class="btn">
                    <i class="fas fa-user-plus"></i>
                    Create Account
                </button>
            </form>
            
            <div class="auth-footer">
                Already have an account? <a href="{{ route('login') }}" class="auth-link">Sign in here</a>
            </div>
        </div>
    </div>
    
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
        
        // Password Strength Checker
        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('passwordStrength');
            let strength = 0;
            
            // Length check
            if (password.length >= 8) strength += 25;
            
            // Lowercase check
            if (/[a-z]/.test(password)) strength += 25;
            
            // Uppercase check
            if (/[A-Z]/.test(password)) strength += 25;
            
            // Special character or number check
            if (/[0-9]/.test(password) || /[^A-Za-z0-9]/.test(password)) strength += 25;
            
            // Update strength bar
            strengthBar.className = 'strength-bar';
            if (strength <= 25) {
                strengthBar.classList.add('strength-25');
            } else if (strength <= 50) {
                strengthBar.classList.add('strength-50');
            } else if (strength <= 75) {
                strengthBar.classList.add('strength-75');
            } else {
                strengthBar.classList.add('strength-100');
            }
        }
        
        // Form validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.querySelector('input[name="password_confirmation"]').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match. Please check and try again.');
                return false;
            }
            
            if (password.length < 8) {
                e.preventDefault();
                alert('Password must be at least 8 characters long.');
                return false;
            }
        });
    </script>

    {{-- Add this right before </body> in your register.blade.php --}}
<div id="session-debug" style="position: fixed; bottom: 20px; right: 20px; background: #1e293b; color: white; padding: 15px; border-radius: 10px; border: 1px solid #4f46e5; z-index: 9999; max-width: 300px; display: none;">
    <h4 style="margin-bottom: 10px; color: #8b5cf6;">Session Debug</h4>
    <div id="debug-content"></div>
    <button onclick="document.getElementById('session-debug').style.display='none'" style="margin-top: 10px; background: #ef4444; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Close</button>
</div>

<script>
// Debug session and cookies
function debugSession() {
    const debugDiv = document.getElementById('debug-content');
    let html = '';
    
    // Check cookies
    html += '<strong>Cookies found:</strong><br>';
    const cookies = document.cookie.split(';');
    
    if (cookies.length === 0 || (cookies.length === 1 && cookies[0].trim() === '')) {
        html += '❌ No cookies found<br>';
    } else {
        cookies.forEach(cookie => {
            const [name, value] = cookie.trim().split('=');
            html += `${name}: ${value ? value.substring(0, 20) + '...' : 'empty'}<br>`;
        });
    }
    
    // Check for laravel_session specifically
    const hasLaravelSession = cookies.some(c => c.includes('laravel_session'));
    html += `<br><strong>laravel_session:</strong> ${hasLaravelSession ? '✅ Found' : '❌ NOT FOUND'}<br>`;
    
    // Show CSRF token
    const csrfToken = document.querySelector('input[name="_token"]')?.value;
    html += `<br><strong>CSRF Token:</strong> ${csrfToken ? csrfToken.substring(0, 10) + '...' : 'Not found'}`;
    
    debugDiv.innerHTML = html;
}

// Run debug on page load
document.addEventListener('DOMContentLoaded', function() {
    debugSession();
    document.getElementById('session-debug').style.display = 'block';
    
    // Debug form submission
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        console.log('=== FORM SUBMIT DEBUG ===');
        console.log('Cookies at submit:', document.cookie);
        console.log('CSRF Token:', document.querySelector('input[name="_token"]').value);
        
        // Check if we have session cookie
        const cookies = document.cookie.split(';');
        const hasSession = cookies.some(c => c.includes('laravel_session'));
        
        if (!hasSession) {
            console.warn('⚠️ WARNING: No laravel_session cookie found! Form will likely get 419 error.');
            
            // Try to set cookie manually as last resort
            const csrfToken = document.querySelector('input[name="_token"]').value;
            if (csrfToken) {
                // Create a session cookie manually
                const sessionId = 'manual_' + Math.random().toString(36).substring(2);
                document.cookie = `laravel_session=${sessionId}; path=/; domain=.onrender.com; secure; samesite=none`;
                console.log('Attempted to set manual session cookie:', sessionId);
            }
        }
        
        // Continue with form submission
    });
});

// Force cookie setting function (call this if cookies are missing)
function forceSetCookie() {
    const csrfToken = document.querySelector('input[name="_token"]').value;
    if (!csrfToken) return;
    
    // Generate a session ID
    const sessionId = 'force_' + Math.random().toString(36).substring(2) + '_' + Date.now();
    
    // Set cookie with Render-compatible settings
    document.cookie = `laravel_session=${sessionId}; path=/; domain=.onrender.com; secure; samesite=none; max-age=7200`;
    document.cookie = `debug_force_set=true; path=/; domain=.onrender.com; secure; samesite=none`;
    
    alert('Forced cookie set. Try submitting form now.');
    debugSession();
}
</script>
    // Add this to your register.blade.php RIGHT NOW
<script>
// EMERGENCY COOKIE FIX - Run immediately
(function() {
    console.log('=== EMERGENCY COOKIE FIX ===');
    
    // Check current cookies
    console.log('Current cookies:', document.cookie);
    
    // Get CSRF token from form
    const csrfToken = document.querySelector('input[name="_token"]')?.value;
    console.log('CSRF token:', csrfToken ? csrfToken.substring(0, 10) + '...' : 'None');
    
    // Generate session ID
    const sessionId = 'emergency_' + Date.now() + '_' + Math.random().toString(36).substring(2);
    
    // Set the cookie with EXACT Render settings
    const cookieSettings = [
        `laravel_session=${sessionId}`,
        'path=/',
        'domain=.onrender.com',
        'secure',
        'samesite=none',
        'max-age=7200' // 2 hours
    ].join('; ');
    
    document.cookie = cookieSettings;
    
    console.log('Set emergency cookie:', cookieSettings);
    console.log('New cookies:', document.cookie);
    
    // Update debug display
    setTimeout(() => {
        if (typeof debugSession === 'function') {
            debugSession();
        }
    }, 100);
    
    // Also set via fetch to ensure server knows
    if (csrfToken) {
        fetch('/set-emergency-session', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ session_id: sessionId }),
            credentials: 'include' // IMPORTANT: send cookies
        }).catch(e => console.log('Fetch error (expected):', e.message));
    }
})();

// Create the emergency session route
</script>
</body>
</html>
