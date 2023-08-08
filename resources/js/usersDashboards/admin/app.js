require('../../bootstrap');

import { createApp } from 'vue';
import App from './App.vue';

document.querySelector('#app').innerHTML = "<App />";

const app = createApp(App);

app.mount('#app')