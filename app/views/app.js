import './GlobalEventListener.js';
import './blocks/LangTpl/script.js';
import 'highlight.js/styles/github.css';

import hljs from 'highlight.js';

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('pre code').forEach((block) => {
    hljs.highlightBlock(block);
  });
});
