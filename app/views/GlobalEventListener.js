import { listenerCallback as langCallback } from "./blocks/LangTpl/script";

const GlobalEventListener = () => {

    document.addEventListener('click', function (event) {
        [
            langCallback,
        ]
            .forEach(item => {
                item(event);
            });
    }, false);
};

GlobalEventListener();
