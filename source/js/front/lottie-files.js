
class LottieFiles {
    constructor(player) {
        this.player = player;
        player && this.setupLottieAnimation();
    }
    
    setupLottieAnimation() {
        if (!this.player.hasAttribute('data-js-lottie-files-src')) return;
        const url = this.player.getAttribute('data-js-lottie-files-src');

        if (url) {
            this.player.load(url);
        } else {
            this.removePlayer();
        }

        this.player.addEventListener('click', () => {
            this.player.togglePlay();
        });

        this.player.addEventListener('error', () => {
            this.player.stop();
            this.removePlayer();
        });
    }

    removePlayer() {
        this.player.remove()
    }
}

export function initializeLottieFiles() {
    const lottieElements = [...document.querySelectorAll('lottie-player')];
    lottieElements.forEach(player => {
        new LottieFiles(player);
    });
}