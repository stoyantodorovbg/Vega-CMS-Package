<template>
    <div class="row">
        <!-- Create Model -->
        <button-link v-if="add_create_button" :prop_data="getButtonCreatePropData()"></button-link>
        <!-- Filters -->
        <menage-filters :fields="fieldsFiltersSettings"></menage-filters>

        <section class="section-grid">
            <div class="row">
                <!-- Settings -->
                <customize-model-index :fields="fieldsGridSettings"></customize-model-index>
                <!-- Models -->
                <div class="col-lg-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <cell-th v-for="field in displayedFields" :key="field.name" :content="field.name"></cell-th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(model, key) in models.data" :key="key">
                            <cell-td v-for="field in displayedFields" :key="field.name" :content="model[field.name]"></cell-td>
                            <td>
                                <icon-link v-if="actions.show" :prop_data="getIconShowData(model.id)"></icon-link>
                                <icon-link v-if="actions.edit" :prop_data="getIconEditData(model.id)"></icon-link>
                                <icon-link v-if="actions.delete"
                                           :prop_data="getIconDeleteData()"
                                           @click.native="renderModal(model.id)"
                                ></icon-link>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Pagination -->
        <pagination :data="models"
                    @pagination-change-page="load"
                    :limit="100"
        ></pagination>

        <!-- Modal window -->
        <delete-confirmation v-show="deleting" :request_data="deleteRequestData"></delete-confirmation>
    </div>
</template>

<script>
import Pagination from "laravel-vue-pagination";
import CellTd from '../../components/table/CellTd'
import CellTh from '../../components/table/CellTh'
import IconLink from "../../components/links/IconLink";
import ButtonLink from "../../components/links/ButtonLink";
import MenageFilters from "../../components/filters/MenageFilters";
import DeleteConfirmation from "../../components/modals/DeleteConfirmation";
import CustomizeModelIndex from "../../components/table/CustomizeModelIndex";

export default {
    components: {
        Pagination,
        CellTd,
        CellTh,
        CustomizeModelIndex,
        MenageFilters,
        ButtonLink,
        IconLink,
        DeleteConfirmation
    },

    props: {
        default_filters: {
            type: Object,
            default: function () {
                return {};
            },
        },
        actions: {
            type: Object,
            default: function() {
                return {
                    delete: 1,
                    edit: 1,
                    show: 1,
                }
            },
        },
        model_name: {
            type: String,
            default: '\\Vegacms\\Cms\\Models\\User',
        },
        items_per_page: {
            type: Number,
            default: 20,
        },
        add_create_button: {
            type: Boolean,
            default: true,
        }
    },

    data() {
        return {
            models: {},
            displayedFields: [],
            modelFields: {},
            defaultFieldsCount: 10,
            deleting: false,
            deleteRequestData: {},
            initial: true,
            page: 1,
        }
    },

    computed: {
        fieldsGridSettings: {
            get: function() {
                let fieldSettings = [];
                let counter = 0;
                let localStorageSettings = JSON.parse(localStorage.adminIndexDisplaySettings)[this.model_name];
                if(localStorageSettings) {
                    for(let field in this.modelFields) {
                        if(localStorageSettings[this.modelFields[field]]) {
                            fieldSettings.push({
                                name: localStorageSettings[this.modelFields[field]].name,
                                visibility: localStorageSettings[this.modelFields[field]].visibility,
                                position: localStorageSettings[this.modelFields[field]].position,
                            });
                            counter++;
                        }
                    }
                } else {
                    for(let field in this.modelFields) {
                        fieldSettings.push({
                            name: this.modelFields[field],
                            visibility: true,
                            position: counter,
                        });
                        counter++;
                    }
                }
                return fieldSettings;
            },
        },
        fieldsFiltersSettings: {
            get: function() {
                let fieldSettings = [];
                for(let field in this.modelFields) {
                    fieldSettings.push({
                        name: this.modelFields[field],
                        visibility: true,
                    });
                }

                return fieldSettings;
            },
        },
        modelNameSlug: {
            get: function () {
                return this.model_name.split('\\').pop().replace(/([a-z])([A-Z])/g, '$1-$2').toLowerCase();
            }
        }
    },

    mounted() {
        this.load();
        this.setLocalStorageSettings();

    },

    methods: {
        load(page) {
            if(page) {
                this.page = page;
            }
            axios.get('/admin/' + this.$store.getters.locale + 'index', {
                    params: {
                        model: this.model_name,
                        filters: this.default_filters,
                        items_per_page: this.items_per_page,
                        page: this.page,
                    }
                }
            ).then((response) => {
                this.models = response.data;
                if(this.initial) {
                    this.setFields(this.models.data, this.defaultFieldsCount);
                    this.initial = false;
                }
            });
        },

        setFields(models, defaultFieldsCount = 10) {
            let localStorageFields = JSON.parse(localStorage.getItem('adminIndexDisplaySettings'))[this.model_name]
            let displayedFields = [];
            if(localStorageFields) {
                Object.keys(localStorageFields).forEach(function(key) {
                    if(localStorageFields[key].visibility == true) {
                        displayedFields.push(localStorageFields[key].name)
                    }
                });
            } else {
                displayedFields =  Object.keys(this.models.data[0]);
                if(defaultFieldsCount > this.modelFields.length) {
                    defaultFieldsCount = this.modelFields.length;
                    displayedFields = this.modelFields.slice(0, defaultFieldsCount);
                }
            }
            this.modelFields = Object.keys(this.models.data[0]);

            let counter = 0;
            for(let field of displayedFields) {
                this.displayedFields.push({
                    name: field,
                    position: counter,
                    visibility: true
                });
                counter++;
            }
        },

        changeFieldVisibility(fieldName, fieldVisibility, position) {
            let self = this;
            this.fieldsGridSettings.forEach(function(field) {
                if(fieldName === field.name) {
                    field.visibility = fieldVisibility;
                    if(fieldVisibility) {
                        self.displayedFields.push({
                            name: fieldName,
                            position: position,
                            visibility: fieldVisibility
                        });
                    } else {
                        self.displayedFields = self.displayedFields.filter(e => e.name !== field.name);
                    }

                    return field;
                }
            });
            this.displayedFields.sort(function(a, b){return a.position - b.position});
            this.storeBrowserSettings(this.fieldsGridSettings)
        },

        updateFilters(fieldName, value, type) {
            if(typeof this.default_filters[fieldName] === 'undefined') {
                this.default_filters[fieldName] = {
                    types: {
                        [type]: {
                            value: value,
                        }
                    }
                }
            } else if(typeof this.default_filters[fieldName] !== 'undefined' &&
                typeof this.default_filters[fieldName].types[type] === 'undefined'
            ) {
                this.default_filters[fieldName].types[type] = {
                    value: value
                }
            } else {
                this.default_filters[fieldName].types[type].value = value;
            }
        },
        storeBrowserSettings(fields) {
            let params = {
                settings: fields,
                modelName: this.model_name
            };
            let localStorageSettings = JSON.parse(localStorage.adminIndexDisplaySettings);
            if(!localStorageSettings[params.modelName]) {
                localStorageSettings[params.modelName] = {};
            }
            for (let setting of params.settings) {
                localStorageSettings[params.modelName][setting.name] = {
                    name: setting.name,
                    visibility: setting.visibility,
                    position: setting.position,
                };
            }

            localStorage.removeItem('adminIndexDisplaySettings');
            localStorage.setItem('adminIndexDisplaySettings', JSON.stringify(localStorageSettings));
        },
        setLocalStorageSettings() {
            if(!localStorage.adminIndexDisplaySettings) {
                localStorage.setItem('adminIndexDisplaySettings', JSON.stringify({}));
            }
        },
        getButtonCreatePropData() {
            return {
                url: '/admin/' + this.$store.getters.locale + '' +
                    this.$pluralize(this.model_name.split('\\').pop().replace(/([a-z0-9])([A-Z])/g, '$1-$2').toLowerCase()) +
                    '/create',
                text: 'Create ' + this.model_name.split('\\').pop(),
                htmlClass: 'btn btn-main float-right mt-3 mb-3'
            }
        },
        getIconShowData(itemId) {
            return {
                url: '/admin/' +
                    this.$store.getters.locale +
                    this.$pluralize(this.modelNameSlug) +
                    '/' +
                    itemId,
                icon_class: 'fas fa-eye'
            }
        },
        getIconEditData(itemId) {
            return {
                url: '/admin/' +
                    this.$store.getters.locale +
                    this.$pluralize(this.modelNameSlug) +
                    '/' +
                    itemId +
                    '/edit',
                icon_class: 'fas fa-pencil-alt'
            }
        },
        getIconDeleteData() {
            return {
                url: '#',
                icon_class: 'far fa-trash-alt'
            }
        },
        renderModal(itemId) {
            this.deleting = true;
            this.deleteRequestData = {
                'slug': itemId,
                'modelName': this.modelNameSlug,
                'modelPath': this.model_name,
            };
            document.getElementById('deleteModelModalTrigger').click();
        }
    }
}
</script>
