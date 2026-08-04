(() => {
    const storageKey = 'firstlight-theme';
    const root = document.documentElement;
    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)');

    const storedTheme = () => {
        try {
            const theme = window.localStorage.getItem(storageKey);

            return ['light', 'dark'].includes(theme) ? theme : null;
        } catch {
            return null;
        }
    };

    const resolvedTheme = () => storedTheme() ?? (systemTheme.matches ? 'dark' : 'light');

    const applyTheme = (theme) => {
        root.dataset.theme = theme;
        root.style.colorScheme = theme;

        document.querySelector('[data-theme-color]')?.setAttribute(
            'content',
            theme === 'dark' ? '#191410' : '#fbf7f2',
        );
    };

    const updateToggle = () => {
        const toggle = document.querySelector('[data-theme-toggle]');

        if (! toggle) {
            return;
        }

        const isDark = root.dataset.theme === 'dark';
        toggle.setAttribute('aria-pressed', isDark ? 'true' : 'false');
        toggle.title = `Switch to ${isDark ? 'light' : 'dark'} mode`;
    };

    const storeTheme = (theme) => {
        try {
            window.localStorage.setItem(storageKey, theme);
        } catch {
            return;
        }
    };

    applyTheme(resolvedTheme());

    document.addEventListener('DOMContentLoaded', () => {
        const toggle = document.querySelector('[data-theme-toggle]');

        updateToggle();

        toggle?.addEventListener('click', () => {
            const theme = root.dataset.theme === 'dark' ? 'light' : 'dark';

            storeTheme(theme);
            applyTheme(theme);
            updateToggle();
        });
    });

    systemTheme.addEventListener('change', () => {
        if (storedTheme()) {
            return;
        }

        applyTheme(resolvedTheme());
        updateToggle();
    });

    window.addEventListener('storage', (event) => {
        if (event.key !== storageKey) {
            return;
        }

        applyTheme(resolvedTheme());
        updateToggle();
    });
})();
