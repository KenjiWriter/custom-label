<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Custom Label Creator') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
    
    <!-- Advanced Professional Theme System -->
    <style>
        /* Light Theme - Ultra Professional with Multiple Shades */
        .theme-light {
            /* Primary Backgrounds - 8 shades of white/gray */
            --bg-primary: #ffffff;
            --bg-secondary: #fafbfc;
            --bg-tertiary: #f4f6f8;
            --bg-quaternary: #eef2f6;
            --bg-quinary: #e8ecf0;
            --bg-senary: #e2e6ea;
            --bg-septenary: #dce0e4;
            --bg-octonary: #d6dade;
            
            /* Card Backgrounds - 6 levels */
            --bg-card: #ffffff;
            --bg-card-hover: #fafbfc;
            --bg-card-active: #f4f6f8;
            --bg-card-selected: #eef2f6;
            --bg-card-disabled: #f8f9fa;
            --bg-card-overlay: rgba(255, 255, 255, 0.95);
            
            /* Text Colors - 12 shades */
            --text-primary: #0a0e13;
            --text-secondary: #1a1f2e;
            --text-tertiary: #2a3142;
            --text-quaternary: #3a4256;
            --text-quinary: #4a536a;
            --text-senary: #5a637e;
            --text-septenary: #6a7392;
            --text-octonary: #7a83a6;
            --text-nonary: #8a93ba;
            --text-denary: #9aa3ce;
            --text-elevenary: #aab3e2;
            --text-twelvenary: #bac3f6;
            
            /* Border Colors - 8 shades */
            --border-primary: #e2e8f0;
            --border-secondary: #d6dce4;
            --border-tertiary: #cad0d8;
            --border-quaternary: #bec4cc;
            --border-quinary: #b2b8c0;
            --border-senary: #a6acb4;
            --border-septenary: #9aa0a8;
            --border-octonary: #8e949c;
            
            /* Accent Colors - Orange gradient system */
            --accent-primary: #f97316;
            --accent-secondary: #ea580c;
            --accent-tertiary: #dc2626;
            --accent-quaternary: #b91c1c;
            --accent-light: #fed7aa;
            --accent-lighter: #fef3c7;
            --accent-lightest: #fffbeb;
            
            /* Shadows - 6 levels */
            --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
        }
        
        /* Dark Theme - Complex Multi-Shade System */
        .theme-dark {
            /* Primary Backgrounds - 12 shades of dark */
            --bg-primary: #0a0e13;
            --bg-secondary: #111827;
            --bg-tertiary: #1e293b;
            --bg-quaternary: #2d3748;
            --bg-quinary: #374151;
            --bg-senary: #4a5568;
            --bg-septenary: #6b7280;
            --bg-octonary: #9ca3af;
            --bg-nonary: #d1d5db;
            --bg-denary: #e5e7eb;
            --bg-elevenary: #f3f4f6;
            --bg-twelvenary: #f9fafb;
            
            /* Card Backgrounds - 8 levels */
            --bg-card: #1e293b;
            --bg-card-hover: #2d3748;
            --bg-card-active: #374151;
            --bg-card-selected: #4a5568;
            --bg-card-disabled: #111827;
            --bg-card-overlay: rgba(30, 41, 59, 0.95);
            --bg-card-glass: rgba(30, 41, 59, 0.8);
            --bg-card-blur: rgba(30, 41, 59, 0.6);
            
            /* Text Colors - 15 shades */
            --text-primary: #f8fafc;
            --text-secondary: #e2e8f0;
            --text-tertiary: #cbd5e1;
            --text-quaternary: #94a3b8;
            --text-quinary: #64748b;
            --text-senary: #475569;
            --text-septenary: #334155;
            --text-octonary: #1e293b;
            --text-nonary: #0f172a;
            --text-denary: #f1f5f9;
            --text-elevenary: #e2e8f0;
            --text-twelvenary: #cbd5e1;
            --text-thirteenary: #94a3b8;
            --text-fourteenary: #64748b;
            --text-fifteenary: #475569;
            
            /* Border Colors - 10 shades */
            --border-primary: #334155;
            --border-secondary: #475569;
            --border-tertiary: #64748b;
            --border-quaternary: #94a3b8;
            --border-quinary: #cbd5e1;
            --border-senary: #e2e8f0;
            --border-septenary: #f1f5f9;
            --border-octonary: #f8fafc;
            --border-nonary: #ffffff;
            --border-denary: #1e293b;
            
            /* Accent Colors - Enhanced orange system */
            --accent-primary: #f97316;
            --accent-secondary: #ea580c;
            --accent-tertiary: #dc2626;
            --accent-quaternary: #b91c1c;
            --accent-light: #fed7aa;
            --accent-lighter: #fef3c7;
            --accent-lightest: #fffbeb;
            --accent-glow: rgba(249, 115, 22, 0.3);
            --accent-shadow: rgba(249, 115, 22, 0.2);
            
            /* Enhanced Shadows - 8 levels */
            --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.3);
            --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.4), 0 1px 2px -1px rgb(0 0 0 / 0.4);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.4), 0 2px 4px -2px rgb(0 0 0 / 0.4);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.4), 0 4px 6px -4px rgb(0 0 0 / 0.4);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.4), 0 8px 10px -6px rgb(0 0 0 / 0.4);
            --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.5);
            --shadow-glow: 0 0 20px var(--accent-glow);
            --shadow-accent: 0 0 30px var(--accent-shadow);
        }
        
        /* Gradient Theme - Complex Multi-Layer Gradients */
        .theme-gradient {
            /* Primary Backgrounds - Complex gradient system */
            --bg-primary: #ffffff;
            --bg-secondary: linear-gradient(135deg, #fef3c7 0%, #fed7aa 25%, #fdba74 50%, #f97316 75%, #ea580c 100%);
            --bg-tertiary: linear-gradient(45deg, #fef3c7 0%, #fed7aa 20%, #fdba74 40%, #f97316 60%, #ea580c 80%, #dc2626 100%);
            --bg-quaternary: linear-gradient(225deg, #fef3c7 0%, #fed7aa 30%, #fdba74 60%, #f97316 90%, #ea580c 100%);
            --bg-quinary: linear-gradient(315deg, #fef3c7 0%, #fed7aa 15%, #fdba74 30%, #f97316 45%, #ea580c 60%, #dc2626 75%, #b91c1c 100%);
            --bg-senary: radial-gradient(circle at top left, #fef3c7 0%, #fed7aa 25%, #fdba74 50%, #f97316 75%, #ea580c 100%);
            --bg-septenary: radial-gradient(circle at top right, #fef3c7 0%, #fed7aa 20%, #fdba74 40%, #f97316 60%, #ea580c 80%, #dc2626 100%);
            --bg-octonary: radial-gradient(circle at bottom left, #fef3c7 0%, #fed7aa 30%, #fdba74 60%, #f97316 90%, #ea580c 100%);
            
            /* Card Backgrounds - Glass morphism system */
            --bg-card: rgba(255, 255, 255, 0.95);
            --bg-card-hover: rgba(255, 255, 255, 0.98);
            --bg-card-active: rgba(255, 255, 255, 0.9);
            --bg-card-selected: rgba(254, 243, 199, 0.8);
            --bg-card-disabled: rgba(255, 255, 255, 0.7);
            --bg-card-overlay: rgba(255, 255, 255, 0.9);
            --bg-card-glass: rgba(255, 255, 255, 0.1);
            --bg-card-blur: rgba(255, 255, 255, 0.05);
            
            /* Text Colors - Warm gradient text */
            --text-primary: #7c2d12;
            --text-secondary: #9a3412;
            --text-tertiary: #c2410c;
            --text-quaternary: #dc2626;
            --text-quinary: #b91c1c;
            --text-senary: #991b1b;
            --text-septenary: #7f1d1d;
            --text-octonary: #5f1a1a;
            --text-nonary: #3f1717;
            --text-denary: #1f1414;
            --text-elevenary: #0f0a0a;
            --text-twelvenary: #fef3c7;
            --text-thirteenary: #fed7aa;
            --text-fourteenary: #fdba74;
            --text-fifteenary: #f97316;
            
            /* Border Colors - Gradient borders */
            --border-primary: #fed7aa;
            --border-secondary: #fdba74;
            --border-tertiary: #f97316;
            --border-quaternary: #ea580c;
            --border-quinary: #dc2626;
            --border-senary: #b91c1c;
            --border-septenary: #991b1b;
            --border-octonary: #7f1d1d;
            --border-nonary: #5f1a1a;
            --border-denary: #3f1717;
            
            /* Accent Colors - Full spectrum */
            --accent-primary: #ea580c;
            --accent-secondary: #dc2626;
            --accent-tertiary: #b91c1c;
            --accent-quaternary: #991b1b;
            --accent-light: #fed7aa;
            --accent-lighter: #fef3c7;
            --accent-lightest: #fffbeb;
            --accent-glow: rgba(234, 88, 12, 0.4);
            --accent-shadow: rgba(234, 88, 12, 0.3);
            
            /* Enhanced Shadows - Gradient shadows */
            --shadow-xs: 0 1px 2px 0 rgb(251 146 60 / 0.2);
            --shadow-sm: 0 1px 3px 0 rgb(251 146 60 / 0.3), 0 1px 2px -1px rgb(251 146 60 / 0.3);
            --shadow-md: 0 4px 6px -1px rgb(251 146 60 / 0.3), 0 2px 4px -2px rgb(251 146 60 / 0.3);
            --shadow-lg: 0 10px 15px -3px rgb(251 146 60 / 0.3), 0 4px 6px -4px rgb(251 146 60 / 0.3);
            --shadow-xl: 0 20px 25px -5px rgb(251 146 60 / 0.3), 0 8px 10px -6px rgb(251 146 60 / 0.3);
            --shadow-2xl: 0 25px 50px -12px rgb(251 146 60 / 0.4);
            --shadow-glow: 0 0 20px var(--accent-glow);
            --shadow-accent: 0 0 30px var(--accent-shadow);
        }
        
        /* Apply theme variables with advanced styling */
        body {
            background: var(--bg-primary);
            color: var(--text-primary);
            transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            font-feature-settings: "rlig" 1, "calt" 1, "kern" 1;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        .theme-dark body {
            background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 25%, var(--bg-tertiary) 50%, var(--bg-quaternary) 75%, var(--bg-quinary) 100%);
            background-attachment: fixed;
        }
        
        .theme-gradient body {
            background: 
                radial-gradient(circle at 20% 80%, rgba(254, 243, 199, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(253, 186, 116, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(249, 115, 22, 0.2) 0%, transparent 50%),
                linear-gradient(135deg, #fef3c7 0%, #fed7aa 15%, #fdba74 30%, #f97316 45%, #ea580c 60%, #dc2626 75%, #b91c1c 90%, #991b1b 100%);
            background-attachment: fixed;
            background-size: 100% 100%, 100% 100%, 100% 100%, 100% 100%;
        }
        
        /* Advanced theme-aware classes */
        .bg-theme-primary { 
            background: var(--bg-primary); 
            box-shadow: var(--shadow-sm);
        }
        .bg-theme-secondary { 
            background: var(--bg-secondary); 
            box-shadow: var(--shadow-sm);
        }
        .bg-theme-tertiary { 
            background: var(--bg-tertiary); 
            box-shadow: var(--shadow-sm);
        }
        .bg-theme-card { 
            background: var(--bg-card); 
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-primary);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .bg-theme-card:hover {
            background: var(--bg-card-hover);
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }
        .bg-theme-card:active {
            background: var(--bg-card-active);
            transform: translateY(0);
        }
        
        /* Text classes with multiple shades */
        .text-theme-primary { color: var(--text-primary); }
        .text-theme-secondary { color: var(--text-secondary); }
        .text-theme-tertiary { color: var(--text-tertiary); }
        .text-theme-quaternary { color: var(--text-quaternary); }
        .text-theme-quinary { color: var(--text-quinary); }
        .text-theme-muted { color: var(--text-octonary); }
        
        /* Border classes */
        .border-theme { border-color: var(--border-primary); }
        .border-theme-light { border-color: var(--border-secondary); }
        .border-theme-lighter { border-color: var(--border-tertiary); }
        
        /* Enhanced accent system */
        .text-accent { color: var(--accent-primary); }
        .text-accent-secondary { color: var(--accent-secondary); }
        .text-accent-tertiary { color: var(--accent-tertiary); }
        
        .bg-accent { 
            background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 50%, var(--accent-tertiary) 100%);
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
        }
        .bg-accent::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .bg-accent:hover::before {
            left: 100%;
        }
        .bg-accent:hover { 
            background: linear-gradient(135deg, var(--accent-secondary) 0%, var(--accent-tertiary) 50%, var(--accent-quaternary) 100%);
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }
        
        /* Professional card styling with glass morphism */
        .theme-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            box-shadow: var(--shadow-md);
            border-radius: 16px;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            position: relative;
            overflow: hidden;
        }
        
        .theme-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border-primary), transparent);
        }
        
        .theme-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: var(--shadow-2xl);
            border-color: var(--border-secondary);
        }
        
        /* Ultra-enhanced button styling */
        .theme-button {
            background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 50%, var(--accent-tertiary) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px 28px;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.025em;
            box-shadow: var(--shadow-md);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
        }
        
        .theme-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }
        
        .theme-button:hover::before {
            left: 100%;
        }
        
        .theme-button:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: var(--shadow-2xl);
            background: linear-gradient(135deg, var(--accent-secondary) 0%, var(--accent-tertiary) 50%, var(--accent-quaternary) 100%);
        }
        
        .theme-button:active {
            transform: translateY(-1px) scale(1.02);
        }
        
        /* Advanced input styling */
        .theme-input {
            background: var(--bg-card);
            border: 2px solid var(--border-primary);
            color: var(--text-primary);
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 14px;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .theme-input:focus {
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 4px var(--accent-light), var(--shadow-lg);
            outline: none;
            background: var(--bg-card-hover);
            transform: translateY(-1px);
        }
        
        .theme-input:hover {
            border-color: var(--border-secondary);
            background: var(--bg-card-hover);
        }
        
        /* Ultra-smooth transitions for theme switching */
        * {
            transition: 
                background-color 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                color 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                border-color 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                box-shadow 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        /* Special effects for gradient theme */
        .theme-gradient .theme-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            box-shadow: var(--shadow-lg);
        }
        
        .theme-gradient .theme-card:hover {
            box-shadow: var(--shadow-2xl), var(--shadow-glow);
        }
        
        .theme-gradient .theme-button {
            box-shadow: var(--shadow-lg), var(--shadow-accent);
        }
        
        .theme-gradient .theme-button:hover {
            box-shadow: var(--shadow-2xl), var(--shadow-glow);
        }
        
        /* Fix for camera button positioning */
        label[for="avatar"] {
            position: absolute !important;
            bottom: -8px !important;
            right: -8px !important;
            z-index: 20 !important;
            background-color: #f97316 !important;
            border: 2px solid white !important;
            border-radius: 50% !important;
            padding: 8px !important;
            cursor: pointer !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
            transition: all 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 40px !important;
            height: 40px !important;
        }
        
        label[for="avatar"]:hover {
            background-color: #ea580c !important;
            transform: scale(1.1) !important;
        }
        
        label[for="avatar"] svg {
            width: 16px !important;
            height: 16px !important;
            color: white !important;
        }
    </style>
</head>
<body class="font-sans antialiased theme-light" id="theme-body">
