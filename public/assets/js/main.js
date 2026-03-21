// Background images
document.querySelectorAll('[data-bg]').forEach(el => {
    el.style.backgroundImage = `url('${el.dataset.bg}')`;
});

// Theme toggle, persistence and logo swap
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('themeToggle');
    const icon = toggle && toggle.querySelector('i');
    const html = document.documentElement;
    const logo = document.querySelector('.logo');

    function applyTheme(theme) {
        html.dataset.theme = theme;
        if (theme === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
        if (icon) icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        if (logo) {
            const lightSrc = logo.dataset.logoLight;
            const darkSrc = logo.dataset.logoDark;
            if (theme === 'dark' && darkSrc) logo.src = darkSrc;
            else if (lightSrc) logo.src = lightSrc;
        }
    }

    // load saved theme
    const saved = localStorage.getItem('theme');
    if (saved) applyTheme(saved);

    if (toggle) {
        toggle.addEventListener('click', () => {
            const current = html.dataset.theme === 'dark' ? 'dark' : 'light';
            const next = current === 'dark' ? 'light' : 'dark';
            applyTheme(next);
            localStorage.setItem('theme', next);
        });
    }
    // Simple chat widget handlers
    const openChat = document.getElementById('openChat');
    const closeChat = document.getElementById('closeChat');
    const chatWidget = document.getElementById('chatWidget');
    const sendChat = document.getElementById('sendChat');

    function showChat(show) {
        if (!chatWidget) return;
        // Toggle sidebar mode: when opening on wider screens, show as sidebar
        const isMobile = window.matchMedia('(max-width:720px)').matches;
        if (show && !isMobile) {
            chatWidget.classList.add('sidebar');
        } else {
            chatWidget.classList.remove('sidebar');
        }
        chatWidget.style.display = show ? 'flex' : 'none';
        chatWidget.setAttribute('aria-hidden', show ? 'false' : 'true');
        if (show) {
            const msg = document.getElementById('chatMessage');
            if (msg) msg.focus();
        }
    }

    // Bot logic is now handled exclusively by the server in ChatSubmitController

    if (openChat) openChat.addEventListener('click', () => { showChat(true); });
    if (closeChat) closeChat.addEventListener('click', () => showChat(false));
    // chat UI helpers
    function createMsgEl(type, text) {
        const wrap = document.createElement('div');
        wrap.className = 'chat-message chat-message--' + type;
        const bubble = document.createElement('div');
        bubble.className = 'chat-bubble';
        bubble.textContent = text;
        wrap.appendChild(bubble);
        return wrap;
    }

    function scrollChat() {
        const container = document.getElementById('chatMessages');
        if (!container) return;
        container.scrollTop = container.scrollHeight;
    }

    function appendAssistantPlaceholder() {
        const container = document.getElementById('chatMessages');
        if (!container) return null;
        const el = createMsgEl('assistant', '...');
        el.dataset.placeholder = '1';
        container.appendChild(el);
        scrollChat();
        return el;
    }

    if (sendChat) sendChat.addEventListener('click', () => {
        const name = document.getElementById('chatName').value || 'Visitor';
        const msgEl = document.getElementById('chatMessage');
        const msg = msgEl ? msgEl.value : '';
        const email = document.getElementById('chatEmail').value || '';
        if (!msg || !msg.trim()) { alert('Please enter a message'); return; }

        // append user message into chat
        const container = document.getElementById('chatMessages');
        if (container) {
            const userEl = createMsgEl('user', msg.trim());
            container.appendChild(userEl);
            scrollChat();
        }

        // clear input
        if (msgEl) msgEl.value = '';

        // Wait for server reply

        // add assistant placeholder while waiting for server
        const placeholder = appendAssistantPlaceholder();

        // send to server endpoint (include CSRF token)
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const csrf = csrfMeta ? csrfMeta.content : null;
        fetch('/chat', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', ...(csrf ? { 'X-CSRF-TOKEN': csrf } : {}) },
            body: JSON.stringify({ name, email, message: msg })
        }).then(r => r.json()).then(data => {
            const chatId = data.chat_id;
            const immediateReply = data.reply || data.message || 'Thanks - we received your message. An admin will reply shortly.';
            if (placeholder && placeholder.parentNode) {
                const bub = placeholder.querySelector('.chat-bubble');
                if (bub) bub.textContent = immediateReply;
                delete placeholder.dataset.placeholder;
            } else if (container) {
                const respEl = createMsgEl('assistant', immediateReply);
                container.appendChild(respEl);
            }
            scrollChat();

            if (chatId && !data.reply) {
                pollForReply(chatId, placeholder || null);
            }
        }).catch(err => {
            console.error('Chat send failed', err);
            if (placeholder && placeholder.parentNode) {
                const bub = placeholder.querySelector('.chat-bubble');
                if (bub) bub.textContent = 'Failed to send. Please try again later.';
            } else if (container) {
                container.appendChild(createMsgEl('assistant', 'Failed to send. Please try again later.'));
            }
            scrollChat();
        });
    });

    function pollForReply(chatId, placeholder) {
        let tries = 0;
        const maxTries = 12;
        const interval = setInterval(() => {
            tries += 1;
            fetch(`/chat/${chatId}`)
                .then(r => r.json())
                .then(data => {
                    if (data.reply) {
                        const container = document.getElementById('chatMessages');
                        if (placeholder && placeholder.parentNode) {
                            const bub = placeholder.querySelector('.chat-bubble');
                            if (bub) bub.textContent = data.reply;
                        } else if (container) {
                            container.appendChild(createMsgEl('assistant', data.reply));
                        }
                        scrollChat();
                        clearInterval(interval);
                    } else if (tries >= maxTries) {
                        clearInterval(interval);
                    }
                })
                .catch(() => {
                    if (tries >= maxTries) clearInterval(interval);
                });
        }, 5000);
    }

    // Handle Chat Suggestions
    document.querySelectorAll('.chat-suggestion').forEach(btn => {
        btn.addEventListener('click', function () {
            const msgEl = document.getElementById('chatMessage');
            if (msgEl) {
                msgEl.value = this.textContent;
                if (sendChat) {
                    sendChat.click();
                }
            }
        });
    });

    // Animate on scroll using IntersectionObserver
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('in-view');
        });
    }, { threshold: 0.15 });

    document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

    // Animated stat counters
    const statObserver = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const text = el.textContent.trim();
            // extract number and suffix
            const match = text.match(/^([0-9,.]+)(\D*)$/);
            if (!match) { obs.unobserve(el); return; }
            const targetNum = parseFloat(match[1].replace(/,/g, '')) || 0;
            const suffix = match[2] || '';
            let start = 0;
            const duration = 1200; // ms
            const startTime = performance.now();
            function step(now) {
                const t = Math.min(1, (now - startTime) / duration);
                const value = Math.floor(t * targetNum);
                el.textContent = value.toLocaleString() + suffix;
                if (t < 1) requestAnimationFrame(step);
                else el.textContent = targetNum.toLocaleString() + suffix;
            }
            requestAnimationFrame(step);
            obs.unobserve(el);
        });
    }, { threshold: 0.6 });

    document.querySelectorAll('.stat-value').forEach(el => statObserver.observe(el));

    // Language toggle: redirect to server-side locale switcher
    const langToggle = document.getElementById('langToggle');
    if (langToggle) {
        langToggle.addEventListener('click', () => {
            // Determine current from the document language or label
            const current = document.documentElement.getAttribute('lang') || 'en';
            const next = current === 'en' ? 'am' : 'en';
            // redirect to server route that sets session locale and redirects back
            window.location.href = `/locale/${next}`;
        });
    }

    // Contact form basic client-side validation
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const name = contactForm.querySelector('[name="name"]').value.trim();
            const email = contactForm.querySelector('[name="email"]').value.trim();
            const message = contactForm.querySelector('[name="message"]').value.trim();
            let errors = [];
            if (!name) errors.push('Name is required');
            if (!email || !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) errors.push('Valid email is required');
            if (!message) errors.push('Describe your case briefly');
            if (errors.length) {
                alert(errors.join('\n'));
                return;
            }
            // submit securely to server endpoint using fetch and CSRF token
            const tokenInput = contactForm.querySelector('input[name="_token"]');
            const token = tokenInput ? tokenInput.value : null;
            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('message', message);

            fetch(contactForm.action, {
                method: 'POST',
                headers: token ? { 'X-CSRF-TOKEN': token } : {},
                body: formData,
            }).then(res => {
                if (!res.ok) throw new Error('Network response was not ok');
                return res.text();
            }).then(() => {
                alert('Thanks — your message was received. We will contact you shortly.');
                contactForm.reset();
            }).catch(err => {
                console.error('Contact submit failed', err);
                alert('Submission failed. Please try again or call +251911259606.');
            });
        });
    }

    // Sidebar mobile toggle and collapse
    const mobileToggle = document.getElementById('mobileToggle');
    const sidebar = document.getElementById('sidebar');
    const collapseBtn = document.getElementById('collapseBtn');
    if (mobileToggle && sidebar) {
        mobileToggle.addEventListener('click', () => sidebar.classList.toggle('open'));
    }
    if (collapseBtn && sidebar) {
        collapseBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            // toggle icon direction
            const icon = collapseBtn.querySelector('i');
            if (icon) icon.className = sidebar.classList.contains('collapsed') ? 'fa fa-angle-right' : 'fa fa-angle-left';
        });
    }
});
