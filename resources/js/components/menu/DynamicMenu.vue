<template>
    <nav>
        <menu-items-container v-if="menuData.status"
                              :menuData="menuData"
        ></menu-items-container>
    </nav>
</template>

<script>
import { mapGetters } from 'vuex';
import MenuItemsContainer from "./MenuItemsContainer";

export default {
    name: 'DynamicMenu',

    components: {
        MenuItemsContainer,
    },

    props: {
        menu_id: {
            type: Number,
            default: 1
        },
    },

    data() {
        return {
            menuData: {},
            baseUrl: ''
        }
    },

    mounted() {
        this.load();
    },

    computed: {
        ...mapGetters(['locale']),
    },

    methods: {
        load() {

            this.baseUrl = '/';//= '/Vega-CMS-Documentation/public/';
            // this.$store.getters.locale === this.locale;
            axios.get(this.baseUrl + this.locale + 'menu-data', {
                    params: {
                        menu_id: this.menu_id
                    }
                }
            ).then((response) => {
                this.menuData = response.data.menu;
            });
        }
    }
}
</script>
