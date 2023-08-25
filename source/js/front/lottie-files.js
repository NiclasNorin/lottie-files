
class LottieFiles {
    constructor(animation) {
        this.container = animation.querySelector('[data-js-lottie-player-container]');
        this.player = animation.querySelector('lottie-player');

        this.startAnimation();
    }

    startAnimation() {
        if (this.container && this.player) {
            this.setupLottieAnimation();
        }
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

        this.player.addEventListener('error', () => {
            console.error('Error in playing this animation.')
            this.player.stop();
            this.removePlayer();
            return;
        });

        this.container.addEventListener('click', () => {
            this.player.togglePlay();
        });

        if (this.player.hasAttribute('controls')) return;

        this.player.addEventListener('play', () => {
            pauseButton.classList.remove('u-display--none');
            playButton.classList.add('u-display--none');
        });

        this.player.addEventListener('pause', (e) => {
            pauseButton.classList.add('u-display--none');
            playButton.classList.remove('u-display--none'); 
        });

        if (!this.player.hasAttribute('autoplay')) {
            const pauseEvent = new Event('pause');
            this.player.dispatchEvent(pauseEvent);
        }
    }

    removePlayer() {
        this.container.remove()
    }
}

export function initializeLottieFiles() {
    
    const lottieAnimations = [...document.querySelectorAll('[data-js-lottie-animation]')];
    lottieAnimations.forEach(animation => {
        new LottieFiles(animation);
    });
}