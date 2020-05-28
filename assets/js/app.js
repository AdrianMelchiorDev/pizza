import Vue from 'vue'
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import DataTable from './components/DataTable'
import MyCard from './components/MyCard'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(DataTable)
// Vue.use(MyCard)

Vue.component(
    "my-card",
    MyCard
);

// Vue.use(MyCard)
var vm = new Vue({
    el: '#app',
    data: {
        cards: [
            {id: 1, title: 'First title'},
            {id: 2, title: 'Second title'},
            {id: 3, title: 'Third title'},
        ]
    },
    components: {
        // MyCard,
    }
});


