<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Premium Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root { 
            --accent-brand: #0f172a; /* Sophisticated Dark Slate */
            --accent-hover: #1e293b;
            --text-main: #1e293b; 
            --text-secondary: #64748b;
            --field-bg: #f8fafc;
            --field-border: #e2e8f0;
            --radius-main: 20px;
        }
        
        * {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        body.modal-open { 
            overflow: hidden; 
        }

        /* Clean High-Blur Semi-Transparent Backdrop */
        .solar-overlay {
            position: fixed; 
            inset: 0; 
            background: rgba(15, 23, 42, 0.2);
            backdrop-filter: blur(16px); 
            -webkit-backdrop-filter: blur(16px);
            z-index: 9998; 
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
        }
        .modal-active .solar-overlay { 
            opacity: 1; 
            pointer-events: auto; 
        }

        /* Minimal Luxury Modal Container */
        .solar-modal-v2 {
            position: fixed; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -46%) scale(0.96);
            width: 92%; 
            max-width: 400px; /* Thoda wide kiya hai 2 columns ke liye */
            background: #ffffff; 
            border-radius: var(--radius-main);
            z-index: 9999; 
            opacity: 0; 
            visibility: hidden; 
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease, visibility 0.3s;
            box-shadow: 0 30px 60px -15px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(15, 23, 42, 0.02); 
            padding: 36px 32px;
        }
        .modal-active .solar-modal-v2 { 
            opacity: 1; 
            visibility: visible; 
            transform: translate(-50%, -50%) scale(1); 
        }

        /* Top Brand Header Section */
        .modal-head { 
            text-align: center; 
            margin-bottom: 24px; 
        }
        .modal-head .brand-logo-container {
            font-size: 22px;
            margin-bottom: 10px;
            display: inline-block;
        }
        .modal-head h2 { 
            font-size: 22px; 
            font-weight: 700; 
            color: var(--text-main);
            letter-spacing: -0.5px;
        }
        .modal-head .sub-text { 
            font-size: 13.5px; 
            font-weight: 400;
            margin-top: 6px; 
            color: var(--text-secondary); 
            line-height: 1.4;
        }

        /* Form Row Layout for 2 Inputs per Line */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        /* New Input Architecture */
        .input-group { 
            margin-bottom: 14px; 
            position: relative;
        }
        .input-group.full-width {
            grid-column: span 2;
        }
        .input-group label { 
            font-size: 11px; 
            font-weight: 600; 
            color: var(--text-main); 
            display: block; 
            margin-bottom: 5px; 
            letter-spacing: 0.3px;
        }
        .solar-field {
            width: 100%; 
            padding: 11px 14px; 
            border: 1px solid var(--field-border);
            border-radius: 10px; 
            background: var(--field-bg); 
            font-size: 13.5px; 
            font-weight: 500;
            color: var(--text-main);
            transition: all 0.2s ease;
            outline: none;
        }
        .solar-field::placeholder {
            color: #a0aec0;
        }
        .solar-field:focus { 
            border-color: var(--accent-brand); 
            background: #ffffff; 
            box-shadow: 0 0 0 3px rgba(15, 23, 42, 0.06);
        }
        
        /* Modern Textarea Styling */
        textarea.solar-field {
            resize: none;
            min-height: 80px;
            line-height: 1.5;
        }

        /* Solid High-Contrast Action Button */
        .submit-btn {
            width: 100%; 
            padding: 13px; 
            background: var(--accent-brand);
            color: #ffffff; 
            border: none; 
            border-radius: 10px; 
            font-weight: 600;
            font-size: 14px;
            cursor: pointer; 
            transition: all 0.2s ease; 
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }
        .submit-btn:hover { 
            background: var(--accent-hover);
            box-shadow: 0 8px 20px -6px rgba(15, 23, 42, 0.2);
        }
        .submit-btn:disabled {
            background: #e2e8f0;
            color: #94a3b8;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* Subtle Circular Close Element */
        .close-trigger { 
            position: absolute; 
            top: 24px; 
            right: 24px; 
            font-size: 18px; 
            cursor: pointer; 
            color: var(--text-secondary); 
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: transparent;
            transition: all 0.15s ease;
        }
        .close-trigger:hover {
            background: #f1f5f9;
            color: var(--text-main);
        }

        /* Minimal Success Layout */
        .thank-you-state {
            text-align: center;
            padding: 20px 0;
            animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive adjustment for very small mobile screens */
        @media (max-width: 480px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            .input-group.full-width {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>

<div class="solar-overlay" id="overlay"></div>

<div class="solar-modal-v2" id="mainModal">
    <div class="close-trigger" onclick="closeModal()">✕</div>

    <div class="modal-head">
        <div class="brand-logo-container"><img src="images/dmpl_logo.png" height="30" alt="DMPL"></div>
        <h2>Connect With Us</h2>
        <p class="sub-text">Please fill out the form below. Our consultants will get back to you immediately.</p>
    </div>

    <form id="serviceForm" action="mail.php" method="POST">
        <div class="form-row">
            <!-- Row 1: Full Name & Email Address -->
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" class="solar-field" placeholder="Enter your name" required>
            </div>

            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="solar-field" placeholder="you@example.com" required>
            </div>
        </div>

        <div class="form-row">
            <!-- Row 2: Phone Number & Message (Phone full width ya message ke sath adjust) -->
            <div class="input-group full-width">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="solar-field" placeholder="10-digit number" pattern="[0-9]{10}" maxlength="10" required>
            </div>
        </div>

        <div class="input-group full-width">
            <label for="message">Message</label>
            <textarea id="message" name="message" class="solar-field" placeholder="How can we help you?" required></textarea>
        </div>

        <button type="submit" class="submit-btn" id="submitBtn">
            <span>Submit Inquiry</span>
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('overlay');
    const serviceForm = document.getElementById('serviceForm');

    window.openModal = function () {
        document.body.classList.add('modal-active', 'modal-open');
    };

    window.closeModal = function () {
        document.body.classList.remove('modal-active', 'modal-open');
    };

    // Open automatically after 5s if never seen before
    setTimeout(() => {
        if (!localStorage.getItem('formModalSeen')) {
            openModal();
            localStorage.setItem('formModalSeen', 'true');
        }
    }, 5000);

    if (overlay) {
        overlay.addEventListener('click', closeModal);
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    if (serviceForm) {
        serviceForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.innerHTML = "<span>Processing...</span>";
            submitBtn.disabled = true;

            const formData = new FormData(serviceForm);

            try {
                const response = await fetch('mail.php', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) throw new Error('Network response failure');

                // Polished Minimalist Success Transition
                serviceForm.innerHTML = `
                    <div class="thank-you-state">
                        <h2 style="color: var(--text-main); margin-bottom: 8px; font-weight: 700; font-size: 20px;">Submission Received</h2>
                        <p style="color: var(--text-secondary); font-size: 13.5px; margin-bottom: 24px; line-height: 1.5;">
                            Thank you for reaching out. A team representative has been notified and will contact you via email or phone.
                        </p>
                        <button type="button" onclick="closeModal()" class="submit-btn" style="background: #f1f5f9; color: var(--text-main); box-shadow: none;">
                            Close Window
                        </button>
                    </div>
                `;
            } catch (error) {
                alert("An error occurred. Please verify your details and try again.");
                submitBtn.innerHTML = "<span>Submit Inquiry</span>";
                submitBtn.disabled = false;
            }
        });
    }
});
</script>

</body>
</html>