<template>
    <div>
        <select @change="changeLocale" v-model="selectedLocale">
            <option v-for="locale in activeLocales"  :key="locale.code" :value="locale.code">
                {{ locale.language }}
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        name: 'ChangeLocale',

        data() {
            return {
                selectedLocale: this.$store.getters.locale,
                activeLocales: this.getActiveLocales(),
            }
        },

        methods: {
            getActiveLocales() {
                axios.get('/api/' + this.$store.getters.locale + '/get-active-locales')
                    .then((response) => {
                        this.activeLocales = response.data.active_locales;
                    });
            },
            changeLocale() {
                axios.post('/api/' + this.$store.getters.locale + '/set-locale', {
                    code: this.selectedLocale,
                })
                    .then((response) => {
                        console.log(response)
                        if(response.data.useUrlLocalization) {
                            this.reloadNewLocale(response.data.oldLocaleCode ,this.selectedLocale)
                        } else {
                            // Flush success message
                        }
                    });
            },
            reloadNewLocale(oldLocale, newLocale) {
                window.location.href = window.location.href.replace(
                    '/' + oldLocale + '/',
                    '/' + newLocale + '/'
                );
            }
        }
    }
</script>
