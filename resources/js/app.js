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
