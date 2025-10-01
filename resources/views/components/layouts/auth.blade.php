{{-- resources/views/components/layouts/auth.blade.php --}}
<x-layouts.head :title="$title ?? 'Welcome Back - Login & Registration'" />

<x-layouts.header />

    <style>
    .auth-container {
        min-height: calc(100vh - 100px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.25rem;
        background: #f8fafc;
    }
    
    .auth-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        max-width: 1000px;
        width: 100%;
        gap: 0;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        min-height: 400px;
    }
        
    .auth-form-section {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .auth-info-section {
        background: linear-gradient(135deg, #fff7ed 0%, #fef3e7 100%);
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
    }
        
    .auth-header {
        text-align: center;
        margin-bottom: 0.3rem;
    }
    
    .auth-header .icon {
        width: 24px;
        height: 24px;
        background: #ea580c;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.2rem;
        color: white;
        font-size: 10px;
    }
    
    .auth-header h1 {
        color: #1f2937;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 0.3rem;
    }
    
    .auth-header p {
        color: #6b7280;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }
    
    .auth-tabs {
        display: flex;
        gap: 0.2rem;
        margin-bottom: 0.4rem;
    }
    
    .auth-tab {
        flex: 1;
        padding: 0.3rem 0.4rem;
        border: 1px solid #e5e7eb;
        background: white;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.2rem;
        text-decoration: none;
        color: #374151;
        font-size: 0.7rem;
    }
    
    .auth-tab.active {
        background: #ea580c;
        color: white;
        border-color: #ea580c;
    }
    
    .auth-tab:hover:not(.active) {
        border-color: #d1d5db;
    }
    
    .form-section h2 {
        color: #1f2937;
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 0.1rem;
    }
    
    .form-section p {
        color: #6b7280;
        margin-bottom: 0.4rem;
        font-size: 0.65rem;
    }
    
    .form-group {
        margin-bottom: 0.4rem;
    }
    
    .form-label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.15rem;
        font-size: 0.65rem;
    }
    
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: #ffffff;
        position: relative;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #ea580c;
        box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.1);
    }
    
    .form-input:hover {
        border-color: #d1d5db;
    }
    
    .btn-primary {
        width: 100%;
        background: linear-gradient(135deg, #ea580c 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 0.75rem 1rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(234, 88, 12, 0.3);
    }
    
    .btn-primary:active {
        transform: translateY(0);
    }
    
    .forgot-password {
        text-align: right;
        margin-top: 0.5rem;
    }
    
    .forgot-password a {
        color: #ea580c;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .forgot-password a:hover {
        color: #dc2626;
    }
    
    .remember-me {
        display: flex;
        align-items: center;
        margin: 0.4rem 0;
    }
    
    .remember-me input[type="checkbox"] {
        margin-right: 0.2rem;
        width: 0.8rem;
        height: 0.8rem;
        accent-color: #ea580c;
    }
    
    .remember-me label {
        color: #374151;
        font-size: 0.65rem;
        cursor: pointer;
    }
    
    .divider {
        display: flex;
        align-items: center;
        margin: 0.5rem 0;
        color: #6b7280;
        font-size: 0.65rem;
    }
    
    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e5e7eb;
    }
    
    .divider span {
        padding: 0 0.6rem;
    }
    
    .social-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.3rem;
        margin-top: 0.3rem;
    }
    
    .social-btn {
        padding: 0.3rem 0.4rem;
        border: 1px solid #e5e7eb;
        background: white;
        border-radius: 4px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.2rem;
        font-size: 0.65rem;
        text-decoration: none;
        color: #374151;
    }
    
    .social-btn:hover {
        border-color: #d1d5db;
        transform: translateY(-1px);
    }
    
    .info-section {
        text-align: center;
    }
    
    .info-icon {
        width: 28px;
        height: 28px;
        background: #ea580c;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.3rem;
        color: white;
        font-size: 12px;
    }
    
    .info-section h2 {
        color: #1f2937;
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 0.2rem;
    }
    
    .info-section p {
        color: #6b7280;
        font-size: 0.65rem;
        margin-bottom: 0.4rem;
    }
    
    .features {
        text-align: left;
        margin-bottom: 0.4rem;
    }
    
    .feature {
        display: flex;
        align-items: flex-start;
        gap: 0.3rem;
        margin-bottom: 0.3rem;
    }
    
    .feature-icon {
        width: 18px;
        height: 18px;
        border-radius: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 8px;
        flex-shrink: 0;
    }
    
    .feature-icon.green { background: #10b981; }
    .feature-icon.blue { background: #3b82f6; }
    .feature-icon.purple { background: #8b5cf6; }
    
    .feature-content h3 {
        color: #1f2937;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }
    
    .feature-content p {
        color: #6b7280;
        font-size: 0.8rem;
        margin: 0;
    }
    
    .testimonial {
        background: white;
        padding: 0.4rem;
        border-radius: 4px;
        margin-top: 0.4rem;
    }
    
    .testimonial-header {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        margin-bottom: 0.3rem;
    }
    
    .testimonial-avatar {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #ea580c;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.5rem;
    }
    
    .testimonial-info h4 {
        color: #1f2937;
        font-weight: 600;
        margin: 0 0 0.1rem 0;
        font-size: 0.7rem;
    }
    
    .testimonial-info p {
        color: #6b7280;
        font-size: 0.6rem;
        margin: 0;
    }
    
    .stars {
        color: #ea580c;
        font-size: 0.7rem;
    }
    
    .testimonial-text {
        color: #374151;
        font-style: italic;
        margin: 0;
        font-size: 0.65rem;
        line-height: 1.1;
    }
    
    .decorative-shapes {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
        overflow: hidden;
    }
    
    .shape {
        position: absolute;
        border-radius: 50%;
        opacity: 0.08;
    }
    
    .shape-1 {
        width: 60px;
        height: 60px;
        background: #ea580c;
        top: -20px;
        right: -20px;
    }
    
    .shape-2 {
        width: 45px;
        height: 45px;
        background: #f59e0b;
        bottom: -12px;
        left: -12px;
    }
    
    .shape-3 {
        width: 35px;
        height: 35px;
        background: #dc2626;
        top: 50%;
        right: -6px;
    }
        
    @media (max-width: 768px) {
        .auth-wrapper {
            grid-template-columns: 1fr;
            margin: 0.05rem;
            min-height: 200px;
        }
        
        .auth-form-section,
        .auth-info-section {
            padding: 0.4rem;
        }
        
        .auth-header h1 {
            font-size: 0.9rem;
        }
        
        .social-buttons {
            grid-template-columns: 1fr;
        }
        }
    </style>

<div class="auth-container">
    <div class="auth-wrapper">
        <div class="auth-form-section">
    {{ $slot }}
        </div>
        <div class="auth-info-section">
            <div class="decorative-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
            </div>
            <div class="info-section">
                <div class="info-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1M10 17L6 13L7.41 11.59L10 14.17L16.59 7.58L18 9L10 17Z"/>
                    </svg>
                </div>
                <h2>Secure & Trusted</h2>
                <p>Your financial data is protected with bank-level security and encryption.</p>
                
                <div class="features">
                    <div class="feature">
                        <div class="feature-icon green">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"/>
                            </svg>
                        </div>
                        <div class="feature-content">
                            <h3>256-bit SSL Encryption</h3>
                            <p>Military-grade security for all transactions.</p>
                        </div>
                    </div>
                    
                    <div class="feature">
                        <div class="feature-icon blue">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2M12 20C7.59 20 4 16.41 4 12S7.59 4 12 4 20 7.59 20 12 16.41 20 12 20M12.5 7H11V13L16.25 16.15L17 14.92L12.5 12.25V7Z"/>
                            </svg>
                        </div>
                        <div class="feature-content">
                            <h3>24/7 Monitoring</h3>
                            <p>Continuous security monitoring and alerts.</p>
                        </div>
                    </div>
                    
                    <div class="feature">
                        <div class="feature-icon purple">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 4C18.2 4 20 5.8 20 8S18.2 12 16 12 12 10.2 12 8 13.8 4 16 4M16 13C18.67 13 24 14.33 24 17V20H8V17C8 14.33 13.33 13 16 13M8 12C10.2 12 12 10.2 12 8S10.2 4 8 4 4 5.8 4 8 5.8 12 8 12M8 13C5.33 13 0 14.33 0 17V20H6V17C6 15.9 6.9 15 8 15"/>
                            </svg>
                        </div>
                        <div class="feature-content">
                            <h3>Trusted by 50,000+</h3>
                            <p>Join thousands of satisfied users.</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">SJ</div>
                        <div class="testimonial-info">
                            <h4>Sarah Johnson</h4>
                            <p>Small Business Owner</p>
                        </div>
                        <div class="stars">★★★★★</div>
                    </div>
                    <p class="testimonial-text">"PayFlow made managing my business payments incredibly simple. The interface is intuitive and the security gives me peace of mind."</p>
                </div>
            </div>
        </div>
    </div>
</div>

    @livewireScripts
@stack('scripts')
