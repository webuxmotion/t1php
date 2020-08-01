const langBlock = document.querySelector('.js-lang-block');

const listenerCallback = ({ target }) => {
    
    if (target.closest('.js-lang-button')) {
        langBlock.classList.toggle('is-active');
    }
    if (target.closest('.js-lang-block')) return;

    langBlock.classList.remove('is-active');
};

export { listenerCallback };
