
class LottieFiles {
    constructor(container) {
        this.container = container;
        this.player = container.querySelector('lottie-player');

        this.player && this.setupLottieAnimation();
    }
    
    setupLottieAnimation() {
        if (!this.player.hasAttribute('data-js-lottie-files-src')) return;
        const url = this.player.getAttribute('data-js-lottie-files-src');

        if (url) {
            this.player.load(url);
        } else {
            this.removePlayer();
            return;
        }

        this.setupLottieListeners();
    }

    setupLottieListeners() {
        const pauseButton = this.container.querySelector('[data-js-lottie-pause-button]');
        const playButton = this.container.querySelector('[data-js-lottie-play-button]');

        this.player.addEventListener('click', (e) => {
            this.player.togglePlay();
            console.log(e);
        });

        this.player.addEventListener('play', () => {
            pauseButton.classList.remove('u-display--none');
            playButton.classList.add('u-display--none');
        });

        this.player.addEventListener('pause', (e) => {
            pauseButton.classList.add('u-display--none');
            playButton.classList.remove('u-display--none'); 
        });

        this.player.addEventListener('error', () => {
            console.error('Error in playing this animation.')
            this.player.stop();
            this.removePlayer();
        });
    }

    removePlayer() {
        this.container.remove()
    }
}

export function initializeLottieFiles() {
    
    const lottieContainers = [...document.querySelectorAll('[data-js-lottie-player-container]')];
    lottieContainers.forEach(container => {
        new LottieFiles(container);
    });
}