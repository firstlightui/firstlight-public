const copyButtons = document.querySelectorAll('[data-copy-target]');

const copyText = async (text) => {
    if (navigator.clipboard?.writeText) {
        await navigator.clipboard.writeText(text);

        return;
    }

    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.className = 'fixed top-0 left-0 opacity-0';
    document.body.append(textArea);
    textArea.select();

    if (! document.execCommand('copy')) {
        textArea.remove();
        throw new Error('Copy command was not accepted.');
    }

    textArea.remove();
};

copyButtons.forEach((button) => {
    button.addEventListener('click', async () => {
        const source = document.querySelector(`[data-copy-source="${button.dataset.copyTarget}"]`);
        const label = button.querySelector('[data-copy-label]');

        if (! source || ! label) {
            return;
        }

        try {
            await copyText(source.textContent.trim());
            label.textContent = 'Copied';
        } catch {
            label.textContent = 'Copy failed';
        }

        window.setTimeout(() => {
            label.textContent = 'Copy';
        }, 1800);
    });
});

const documentationCodeBlocks = document.querySelectorAll('.docs-prose pre');
const copyIcon = `
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <rect width="14" height="14" x="8" y="8" rx="2"></rect>
        <path d="M16 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
    </svg>
`;
const copiedIcon = `
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="m5 12 4 4L19 6"></path>
    </svg>
`;

documentationCodeBlocks.forEach((pre) => {
    const code = pre.querySelector('code');

    if (! code || pre.closest('.docs-code-block')) {
        return;
    }

    const wrapper = document.createElement('div');
    const button = document.createElement('button');

    wrapper.className = 'docs-code-block';
    button.type = 'button';
    button.className = 'docs-code-copy';
    button.innerHTML = copyIcon;
    button.title = 'Copy code';
    button.setAttribute('aria-label', 'Copy code');
    button.setAttribute('aria-live', 'polite');

    pre.before(wrapper);
    wrapper.append(pre);
    wrapper.prepend(button);

    button.addEventListener('click', async () => {
        try {
            await copyText(code.textContent.trim());
            button.innerHTML = copiedIcon;
            button.dataset.state = 'copied';
            button.title = 'Copied';
            button.setAttribute('aria-label', 'Copied to clipboard');
        } catch {
            button.dataset.state = 'error';
            button.title = 'Copy failed';
            button.setAttribute('aria-label', 'Copy failed');
        }

        window.setTimeout(() => {
            button.innerHTML = copyIcon;
            button.removeAttribute('data-state');
            button.title = 'Copy code';
            button.setAttribute('aria-label', 'Copy code');
        }, 1800);
    });
});

const componentCatalogues = document.querySelectorAll('[data-component-catalogue]');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

componentCatalogues.forEach((catalogue) => {
    const track = catalogue.querySelector('[data-component-catalogue-track]');
    const slides = [...catalogue.querySelectorAll('[data-component-catalogue-slide]')];
    const previous = catalogue.querySelector('[data-component-catalogue-previous]');
    const next = catalogue.querySelector('[data-component-catalogue-next]');
    const current = catalogue.querySelector('[data-component-catalogue-current]');

    if (! track || ! previous || ! next || ! current || slides.length === 0) {
        return;
    }

    let activeIndex = 0;
    let scrollFrame;

    const updateState = () => {
        activeIndex = Math.min(
            slides.length - 1,
            Math.max(0, Math.round(track.scrollLeft / track.clientWidth)),
        );
        current.textContent = `${activeIndex + 1} / ${slides.length}`;
        previous.disabled = activeIndex === 0;
        next.disabled = activeIndex === slides.length - 1;
    };

    const goTo = (index) => {
        const nextIndex = Math.min(slides.length - 1, Math.max(0, index));

        track.scrollTo({
            left: nextIndex * track.clientWidth,
            behavior: reducedMotion.matches ? 'auto' : 'smooth',
        });
    };

    previous.addEventListener('click', () => goTo(activeIndex - 1));
    next.addEventListener('click', () => goTo(activeIndex + 1));
    track.addEventListener('scroll', () => {
        window.cancelAnimationFrame(scrollFrame);
        scrollFrame = window.requestAnimationFrame(updateState);
    }, { passive: true });
    track.addEventListener('keydown', (event) => {
        if (! ['ArrowLeft', 'ArrowRight'].includes(event.key)) {
            return;
        }

        event.preventDefault();
        goTo(activeIndex + (event.key === 'ArrowRight' ? 1 : -1));
    });

    updateState();
});
